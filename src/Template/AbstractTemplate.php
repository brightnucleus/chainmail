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

namespace BrightNucleus\ChainMail\Template;

use BrightNucleus\Chainmail\Exception\FailedToInitialiseTemplate;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\Template;
use BrightNucleus\Config\ConfigInterface;
use BrightNucleus\View\ViewBuilder;
use RuntimeException;

/**
 * Abstract Class AbstractTemplate.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Template
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractTemplate implements Template
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
     * ViewBuilder to create template and section views.
     *
     * @since 1.0.0
     *
     * @var ViewBuilder
     */
    protected $viewBuilder;

    /**
     * Instantiate a AbstractTemplate object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config    Configuration settings.
     * @param array           $arguments Arguments that are passed through the constructor.
     *                                   Contained elements: string $template
     *
     * @throws RuntimeException
     */
    public function __construct($config, array $arguments)
    {
        $this->config = $config;
        list($template, $this->viewBuilder) = $arguments;
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
     *
     * @throws FailedToInitialiseTemplate If no template name was passed.
     * @throws FailedToInitialiseTemplate If an unknown template name was passed.
     */
    protected function setTemplateName($template = null)
    {
        if (null === $template) {
            throw new FailedToInitialiseTemplate('Initialised template without passing it a template name.');
        }
        if ( ! array_key_exists($template, $this->config['templates'])) {
            throw new FailedToInitialiseTemplate('Initialised template with an unknown template name.');
        }
        $this->templateName = $template;
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
     *
     * @return string The rendered content.
     */
    public function render(array $context)
    {

        $viewName = $this->getViewName($context);
        $view     = $this->viewBuilder->create($viewName);

        $sanitizerType    = $this->config['formats'][$context['format']]['sanitizer'];
        $sanitizerFactory = new Factory($this->config, 'sanitizers');
        $sanitizer        = $sanitizerFactory->create($sanitizerType);

        $output = $view->render($context);

        return $sanitizer->sanitize($output, $context);
    }

    /**
     * Get the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @param array $context Context in which to get the view name.
     *
     * @return string Name of the view.
     */
    protected function getViewName(array $context)
    {
        return $this->config['templates'][$this->getTemplateName()]['view_name']
               . '.' . $context['format'];
    }
}
