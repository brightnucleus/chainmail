<?php
/**
 * AbstractSection
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Section;

use RuntimeException;
use BrightNucleus\ChainMail\SectionInterface;
use BrightNucleus\ChainMail\Support\ConfigInterface;
use BrightNucleus\ChainMail\Support\Factory;

/**
 * Abstract Class AbstractSection
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractSection implements SectionInterface
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
     * Content of the section.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $content;

    /**
     * Instantiate a AbstractSection object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config       Configuration settings.
     * @param array           $arguments    Arguments that are passed through
     *                                      the constructor. Contained
     *                                      elements: string $section, string
     *                                      $content
     */
    public function __construct($config, $arguments)
    {
        $this->config = $config;
        list($section, $content) = $arguments;
        $this->setViewName($section);
        $this->content = $content;
    }

    /**
     * Set the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @param string $section Optional. Name of the section.
     */
    abstract protected function setViewName($section = null);

    /**
     * Set the name of the View to use for rendering.
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
     * Render the current Renderable for a given context.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the Renderable.
     * @return string Rendered output of the Renderable.
     * @throws RuntimeException
     */
    public function render(array $context)
    {

        $viewLocation = $this->getViewLocation($context);
        $viewType     = $this->config->getKey('view_type');

        $viewFactory = new Factory($this->config, 'view_types');
        $view        = $viewFactory->create($viewType, $viewLocation);

        return $view->render($context, $this->content);
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

        return $viewRoot . '/sections/' . $context['format'] . '/' . $this->getViewName();
    }
}