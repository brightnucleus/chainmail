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
use BrightNucleus\ChainMail\Support\ConfigInterface;

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
     * Name of the view to use for rendering.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $viewName;

    /**
     * Configuration Settings.
     *
     * @since 1.0.0
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Instantiate a AbstractTemplate object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config       Configuration settings.
     * @param array           $arguments    Arguments that are passed through
     *                                      the constructor. Contained
     *                                      elements: string $template
     */
    public function __construct($config, $arguments)
    {
        $this->config = $config;
        list($template) = $arguments;
        $this->setViewName($template);
    }

    /**
     * Set the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @param string $template Optional. Name of the template.
     */
    abstract protected function setViewName($template = null);

    /**
     * Get the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @return string Name of the view.
     */
    protected function getViewName()
    {
        return $this->viewName;
    }

    /**
     * Get an array of Sections that are used by this template.
     *
     * @since 1.0.0
     *
     * @return array Sections that are used by this template.
     */
    abstract public function getUsedSections();

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
        $viewType     = $this->config->getKey('view_type');

        $viewFactory = new Factory($this->config, 'view_types');
        $view        = $viewFactory->create($viewType, $viewLocation);

        $sanitizerType    = $this->config->getKey('formats')[$context['format']]['sanitizer'];
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
        $viewRoot = $this->config->getKey('views_root');

        return $viewRoot . '/templates/' . $context['format'] . '/' . $this->getViewName();
    }
}