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
     * Name of the Section.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $sectionName;

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
     * @throws RuntimeException
     */
    public function __construct($config, $arguments)
    {
        $this->config = $config;
        list($section, $content) = $arguments;
        $this->setSectionName($section);
        $this->content = $content;
    }

    /**
     * Set the name of the Section.
     *
     * @since 1.0.0
     *
     * @param string $section Optional. Name of the section.
     * @throws RuntimeException
     */
    protected function setSectionName($section = null)
    {
        if (null === $section) {
            throw new RuntimeException('Initialised section without passing it a section name.');
        }
        if ( ! array_key_exists($section, $this->config['sections'])) {
            throw new RuntimeException('Initialised section with an unknown section name.');
        }
        $this->sectionName = $section;
    }

    /**
     * Get the name of the Section.
     *
     * @since 1.0.0
     *
     * @return string Name of the section.
     */
    public function getSectionName()
    {
        return $this->sectionName;
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
        return $this->config['sections'][$this->getSectionName()]['view_name'];
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
        $viewType     = $this->config['view_type'];

        $viewFactory = new Factory($this->config, 'view_types');
        $view        = $viewFactory->create($viewType, $viewLocation);

        $context['css_class'] = $this->getCSSClass();

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
        return $this->getViewRoot() . '/sections/' . $context['format'] . '/' . $this->getViewName();
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
        $viewRootKey = $this->config['sections'][$this->getSectionName()]['view_location'];

        return $viewRoots[$viewRootKey];
    }

    /**
     * Get the CSS class that is used for the section.
     *
     * @since 1.0.0
     *
     * @return string
     */
    protected function getCSSClass()
    {
        return $this->config['sections'][$this->getSectionName()]['css_class'];
    }
}
