<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace Thelia\Core;

/**
 * Root class of Thelia
 *
 * It extends Symfony\Component\HttpKernel\Kernel for changing some features
 *
 *
 * @author Manuel Raynaud <mraynaud@openstudio.fr>
 */

use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Connection\ConnectionWrapper;
use Propel\Runtime\Propel;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Yaml\Yaml;
use Thelia\Config\DatabaseConfiguration;
use Thelia\Config\DefinePropel;
use Thelia\Core\DependencyInjection\Loader\XmlFileLoader;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\Template\ParserInterface;
use Thelia\Core\Template\TemplateDefinition;
use Thelia\Core\Template\TemplateHelper;
use Thelia\Log\Tlog;
use Thelia\Model\Module;
use Thelia\Model\ModuleQuery;

class Thelia extends Kernel
{

    const THELIA_VERSION = '2.0.2';

    public function init()
    {
        parent::init();
        $this->initPropel();
    }

    protected function initPropel()
    {
        if (file_exists(THELIA_CONF_DIR . 'database.yml') === false) {
            return ;
        }

        $definePropel = new DefinePropel(new DatabaseConfiguration(),
            Yaml::parse(THELIA_CONF_DIR . 'database.yml'));
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass('thelia', 'mysql');
        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration($definePropel->getConfig());
        $serviceContainer->setConnectionManager('thelia', $manager);
        $con = Propel::getConnection(\Thelia\Model\Map\ProductTableMap::DATABASE_NAME);
        $con->setAttribute(ConnectionWrapper::PROPEL_ATTR_CACHE_PREPARES, true);
        if ($this->isDebug()) {
            $serviceContainer->setLogger('defaultLogger', Tlog::getInstance());
            $con->useDebug(true);
        }

    }

    /**
     * dispatch an event when application is boot
     */
    public function boot()
    {
        parent::boot();

        if (file_exists(THELIA_CONF_DIR . 'database.yml') === true) {
            $this->getContainer()->get("event_dispatcher")->dispatch(TheliaEvents::BOOT);
        }

    }

    /**
     * Add all module's standard templates to the parser environment
     *
     * @param ParserInterface $parser the parser
     * @param Module          $module the Module.
     */
    protected function addStandardModuleTemplatesToParserEnvironment($parser, $module)
    {
        $stdTpls = TemplateDefinition::getStandardTemplatesSubdirsIterator();

        foreach ($stdTpls as $templateType => $templateSubdirName) {
            $this->addModuleTemplateToParserEnvironment($parser, $module, $templateType, $templateSubdirName);
        }
    }

    /**
     * Add a module template directory to the parser environment
     *
     * @param ParserInterface $parser             the parser
     * @param Module          $module             the Module.
     * @param string          $templateType       the template type (one of the TemplateDefinition type constants)
     * @param string          $templateSubdirName the template subdirectory name (one of the TemplateDefinition::XXX_SUBDIR constants)
     */
    protected function addModuleTemplateToParserEnvironment($parser, $module, $templateType, $templateSubdirName)
    {
        // Get template path
        $templateDirectory = $module->getAbsoluteTemplateDirectoryPath($templateSubdirName);

        try {
            $templateDirBrowser = new \DirectoryIterator($templateDirectory);

            $code = ucfirst($module->getCode());

            /* browse the directory */
            foreach ($templateDirBrowser as $templateDirContent) {

                /* is it a directory which is not . or .. ? */
                if ($templateDirContent->isDir() && ! $templateDirContent->isDot()) {

                    $parser->addMethodCall(
                        'addTemplateDirectory',
                        array(
                            $templateType,
                            $templateDirContent->getFilename(),
                            $templateDirContent->getPathName(),
                            $code
                        )
                    );
                }
            }
        } catch (\UnexpectedValueException $ex) {
             // The directory does not exists, ignore it.
        }
    }

    /**
     *
     * Load some configuration
     * Initialize all plugins
     *
     */
    protected function loadConfiguration(ContainerBuilder $container)
    {

        $loader = new XmlFileLoader($container, new FileLocator(THELIA_ROOT . "/core/lib/Thelia/Config/Resources"));
        $finder = Finder::create()
            ->name('*.xml')
            ->depth(0)
            ->in(THELIA_ROOT . "/core/lib/Thelia/Config/Resources");

        /** @var \SplFileInfo $file */
        foreach ($finder as $file) {
            $loader->load($file->getBaseName());
        }

        if (defined("THELIA_INSTALL_MODE") === false) {
            $modules = ModuleQuery::getActivated();

            $translationDirs = array();

            /** @var ParserInterface $parser */
            $parser = $container->getDefinition('thelia.parser');

            /** @var Module $module */
            foreach ($modules as $module) {

                try {
                    $definition = new Definition();
                    $definition->setClass($module->getFullNamespace());
                    $definition->addMethodCall("setContainer", array(new Reference('service_container')));

                    $container->setDefinition(
                        "module.".$module->getCode(),
                        $definition
                    );

                    $compilers = call_user_func(array($module->getFullNamespace(), 'getCompilers'));

                    foreach ($compilers as $compiler) {
                        if (is_array($compiler)) {
                            $container->addCompilerPass($compiler[0], $compiler[1]);
                        } else {
                            $container->addCompilerPass($compiler);
                        }
                    }

                    $loader = new XmlFileLoader($container, new FileLocator($module->getAbsoluteConfigPath()));
                    $loader->load("config.xml");

                    // Core module translation
                    if (is_dir($dir = $module->getAbsoluteI18nPath())) {
                        $translationDirs[$module->getTranslationDomain()] = $dir;
                    }

                    // Admin includes translation
                    if (is_dir($dir = $module->getAbsoluteAdminIncludesI18nPath())) {
                        $translationDirs[$module->getAdminIncludesTranslationDomain()] = $dir;
                    }

                    // Module back-office template, if any
                    $templates =
                        TemplateHelper::getInstance()->getList(
                            TemplateDefinition::BACK_OFFICE,
                            $module->getAbsoluteTemplateBasePath()
                        );

                    foreach ($templates as $template) {
                        $translationDirs[$module->getBackOfficeTemplateTranslationDomain($template->getName())] =
                            $module->getAbsoluteBackOfficeI18nTemplatePath($template->getName());
                    }

                    // Module front-office template, if any
                    $templates =
                        TemplateHelper::getInstance()->getList(
                            TemplateDefinition::FRONT_OFFICE,
                            $module->getAbsoluteTemplateBasePath()
                        );

                    foreach ($templates as $template) {
                        $translationDirs[$module->getFrontOfficeTemplateTranslationDomain($template->getName())] =
                            $module->getAbsoluteFrontOfficeI18nTemplatePath($template->getName());
                    }

                    $this->addStandardModuleTemplatesToParserEnvironment($parser, $module);

                } catch (\InvalidArgumentException $e) {

                    Tlog::getInstance()->addError(
                        sprintf("Failed to load module %s: %s", $module->getCode(), $e->getMessage()), $e
                    );

                    throw $e;
                }
            }

            // Load core translation
            $translationDirs['core'] = THELIA_ROOT . 'core'.DS.'lib'.DS.'Thelia'.DS.'Config'.DS.'I18n';

            // Standard templates (front, back, pdf, mail)
            $th = TemplateHelper::getInstance();

            /** @var TemplateDefinition $templateDefinition */
            foreach ($th->getStandardTemplateDefinitions() as $templateDefinition) {
                if (is_dir($dir = $templateDefinition->getAbsoluteI18nPath())) {
                    $translationDirs[$templateDefinition->getTranslationDomain()] = $dir;
                }
            }

            if ($translationDirs) {
                $this->loadTranslation($container, $translationDirs);
            }
        }
    }

    private function loadTranslation(ContainerBuilder $container, array $dirs)
    {
        $translator = $container->getDefinition('thelia.translator');

        foreach ($dirs as $domain => $dir) {

            try {
                $finder = Finder::create()
                    ->files()
                    ->depth(0)
                    ->in($dir);

                /** @var \DirectoryIterator $file */
                foreach ($finder as $file) {
                    list($locale, $format) = explode('.', $file->getBaseName(), 2);

                    $translator->addMethodCall('addResource', array($format, (string) $file, $locale, $domain));
                }
            } catch (\InvalidArgumentException $ex) {
                // Ignore missing I18n directories
                Tlog::getInstance()->addWarning("loadTranslation: missing $dir directory");
            }
        }
    }

    /**
     *
     * initialize session in Request object
     *
     * All param must be change in Config table
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */

    /**
     * Gets a new ContainerBuilder instance used to build the service container.
     *
     * @return ContainerBuilder
     */
    protected function getContainerBuilder()
    {
        return new TheliaContainerBuilder(new ParameterBag($this->getKernelParameters()));
    }

    /**
     * Builds the service container.
     *
     * @return ContainerBuilder The compiled service container
     *
     * @throws \RuntimeException
     */
    protected function buildContainer()
    {
        $container = parent::buildContainer();

        $this->loadConfiguration($container);
        $container->customCompile();

        return $container;
    }

    /**
     * Gets the cache directory.
     *
     * @return string The cache directory
     *
     * @api
     */
    public function getCacheDir()
    {
        if (defined('THELIA_ROOT')) {
            return THELIA_CACHE_DIR.DS.$this->environment;
        } else {
            return parent::getCacheDir();
        }

    }

    /**
     * Gets the log directory.
     *
     * @return string The log directory
     *
     * @api
     */
    public function getLogDir()
    {
        if (defined('THELIA_ROOT')) {
            return THELIA_LOG_DIR;
        } else {
            return parent::getLogDir();
        }
    }

    /**
     * Returns the kernel parameters.
     *
     * @return array An array of kernel parameters
     */
    protected function getKernelParameters()
    {
        $parameters = parent::getKernelParameters();

        $parameters["thelia.root_dir"] = THELIA_ROOT;
        $parameters["thelia.core_dir"] = THELIA_ROOT . "core/lib/Thelia";
        $parameters["thelia.module_dir"] = THELIA_MODULE_DIR;

        return $parameters;
    }

    /**
     * return available bundle
     *
     * Part of Symfony\Component\HttpKernel\KernelInterface
     *
     * @return array An array of bundle instances.
     *
     */
    public function registerBundles()
    {
        $bundles = array(
            /* TheliaBundle contain all the dependency injection description */
            new Bundle\TheliaBundle(),
        );

        /**
         * OTHER CORE BUNDLE CAN BE DECLARE HERE AND INITIALIZE WITH SPECIFIC CONFIGURATION
         *
         * HOW TO DECLARE OTHER BUNDLE ? ETC
         */

        return $bundles;

    }

    /**
     * Loads the container configuration
     *
     * part of Symfony\Component\HttpKernel\KernelInterface
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     *
     * @api
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        //Nothing is load here but it's possible to load container configuration here.
        //exemple in sf2 : $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
