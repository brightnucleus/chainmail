<?php
/**
 * AbstractTemplate
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Template;

use RuntimeException;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\TemplateInterface;
use BrightNucleus\Config\ConfigInterface;

/**
 * Abstract Class AbstractTemplate
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Template
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractTemplate implements TemplateInterface
{

    /**
     * Configuration Settings.
     *
     * @since 1.0.0
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Name of the template.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $templateName;

    /**
     * Instantiate a AbstractTemplate object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config       Configuration settings.
     * @param array           $arguments    Arguments that are passed through
     *                                      the constructor. Contained
     *                                      elements: string $template
     * @throws RuntimeException
     */
    public function __construct($config, $arguments)
    {
        $this->config = $config;
        list($template) = $arguments;
        $this->setTemplateName($template);
    }

    /**
     * Get the name of the Template.
     *
     * @since 1.0.0
     *
     * @return string Name of the template.
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * Set the name of the Template.
     *
     * @since 1.0.0
     *
     * @param string|null $template Optional. Name of the template.
     * @throws RuntimeException
     */
    protected function setTemplateName($template = null)
    {
        if (null === $template) {
            throw new RuntimeException('Initialised template without passing it a template name.');
        }
        if ( ! array_key_exists($template, $this->config['templates'])) {
            throw new RuntimeException('Initialised template with an unknown template name.');
        }
        $this->templateName = $template;
    }

    /**
     * Get the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @return string Name of the view.
     */
    protected function getViewName()
    {
        return $this->config['templates'][$this->getTemplateName()]['view_name'];
    }

    /**
     * Get an array of Sections that are used by this template.
     *
     * @since 1.0.0
     *
     * @return array Sections that are used by this template.
     */
    public function getUsedSections()
    {
        return $this->config['templates'][$this->getTemplateName()]['sections'];
    }

    /**
     * Render the template for a given context.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the template.
     * @return string The rendered content.
     * @throws RuntimeException
     */
    public function render(array $context)
    {

        $viewLocation = $this->getViewLocation($context);
        $viewType     = $this->config['view_type'];

        $viewFactory = new Factory($this->config, 'view_types');
        $view        = $viewFactory->create($viewType, $viewLocation);

        $sanitizerType    = $this->config['formats'][$context['format']]['sanitizer'];
        $sanitizerFactory = new Factory($this->config, 'sanitizers');
        $sanitizer        = $sanitizerFactory->create($sanitizerType);

        $output = $view->render($context);

        return $sanitizer->sanitize($output, $context);
    }

    /**
     * Get the location of the view that is used for rendering.
     *
     * @since 1.0.0
     *
     * @param array $context Context for which to get the view location.
     * @return string
     */
    protected function getViewLocation(array $context)
    {
        return $this->getViewRoot() . '/templates/' . $context['format'] . '/' . $this->getViewName();
    }

    /**
     * Get the root location of the view that is used for rendering.
     *
     * @since 1.0.0
     *
     * @return string
     */
    protected function getViewRoot()
    {
        $viewRoots   = $this->config['view_root_locations'];
        $viewRootKey = $this->config['templates'][$this->getTemplateName()]['view_location'];

        return $viewRoots[$viewRootKey];
    }
}
