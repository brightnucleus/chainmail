<?php
/**
 * BrightNucleus Chainmail Component.
 *
 * @package   BrightNucleus/Chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Section;

use BrightNucleus\Chainmail\Exception\FailedToInitialiseSectionException;
use BrightNucleus\ChainMail\SectionInterface;
use BrightNucleus\Config\ConfigInterface;
use BrightNucleus\View\ViewBuilder;
use RuntimeException;

/**
 * Abstract Class AbstractSection.
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
     * ViewBuilder to create template and section views.
     *
     * @since 1.0.0
     *
     * @var ViewBuilder
     */
    protected $viewBuilder;

    /**
     * Instantiate a AbstractSection object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config    Configuration settings.
     * @param array           $arguments Arguments that are passed through the constructor.
     *                                   Contained elements:
     *                                   string $section, string $content
     *
     * @throws RuntimeException
     */
    public function __construct($config, array $arguments)
    {
        $this->config = $config;
        list($section, $content, $this->viewBuilder) = $arguments;
        $this->setSectionName($section);
        $this->content = $content;
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
     * Set the name of the Section.
     *
     * @since 1.0.0
     *
     * @param string|null $section Optional. Name of the section.
     *
     * @throws FailedToInitialiseSectionException If no section name was passed.
     * @throws FailedToInitialiseSectionException If an unknown section name was passed.
     */
    protected function setSectionName($section = null)
    {
        if (null === $section) {
            throw new FailedToInitialiseSectionException(
                'Initialised section without passing it a section name.'
            );
        }
        if (! array_key_exists($section, $this->config['sections'])) {
            throw new FailedToInitialiseSectionException(
                'Initialised section with an unknown section name.'
            );
        }
        $this->sectionName = $section;
    }

    /**
     * Render the current Renderable for a given context.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the Renderable.
     *
     * @return string Rendered output of the Renderable.
     * @throws RuntimeException
     */
    public function render(array $context)
    {

        $viewName = $this->getViewName($context);
        $view     = $this->viewBuilder->create($viewName);

        $context['css_class'] = $this->getCSSClass();
        $context['content']   = $this->content;

        return $view->render($context);
    }

    /**
     * Get the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the template.
     *
     * @return string Name of the view.
     */
    protected function getViewName(array $context)
    {
        return $this->config['sections'][$this->getSectionName()]['view_name']
               . '.' . $context['format'];
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
