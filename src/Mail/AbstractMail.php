<?php
/**
 * AbstractMail
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Mail;

use RuntimeException;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\MailInterface;
use BrightNucleus\ChainMail\Support\ConfigInterface;
use BrightNucleus\ChainMail\TemplateInterface;
use BrightNucleus\ChainMail\SectionInterface;

/**
 * Abstract Class AbstractMail
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractMail implements MailInterface
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
     * Template that is used for the email.
     *
     * @since 1.0.0
     *
     * @var TemplateInterface
     */
    protected $template;

    /**
     * Content for the different sections.
     *
     * @since 1.0.0
     *
     * @var array
     */
    protected $sectionContent = [];

    /**
     * Format of the mail.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $format;

    /**
     * Instantiate an AbstractMail object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->setFormat();
    }

    /**
     * Set the format of the mail.
     *
     * @since 1.0.0
     *
     * @return string Format of the Mail.
     */
    protected function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the format of the mail.
     *
     * @since 1.0.0
     */
    abstract protected function setFormat();

    /**
     * Set the template to use for the renderer.
     *
     * @since 1.0.0
     *
     * @param string|TemplateInterface $template Template to use for the
     *                                           renderer.
     * @throws RuntimeException
     */
    public function setTemplate($template)
    {
        if (is_string($template)) {
            $template = $this->createTemplate($template);
        }
        $this->template = $template;
    }

    /**
     * Get the template to use for the renderer.
     *
     * @since 1.0.0
     *
     * @return TemplateInterface Reference to the template that is used.
     * @throws RuntimeException
     */
    public function getTemplate()
    {

        if ( ! $this->template) {
            $this->setDefaultTemplate();
        }

        if (is_string($this->template)) {
            $this->template = $this->createTemplate($this->template);
        }

        return $this->template;
    }

    /**
     * Set the template to the default template defined in the configuration.
     *
     * @since 1.0.0
     *
     * @throws RuntimeException
     */
    protected function setDefaultTemplate()
    {
        $defaultTemplate = $this->config->getKey('default_template');
        $this->setTemplate($defaultTemplate);
    }

    /**
     * Create an instance of a template.
     *
     * @since 1.0.0
     *
     * @param string $template Template to instantiate.
     * @return TemplateInterface $template Newly created instance.
     * @throws RuntimeException
     */
    protected function createTemplate($template)
    {
        $templateFactory = new Factory($this->config, 'templates');

        return $templateFactory->create($template, [$template]);
    }

    /**
     * Add a section to the Mail.
     *
     * @since 1.0.0
     *
     * @param string $type    Type of section to add.
     * @param string $content Content of the section.
     * @throws RuntimeException
     */
    public function addSection($type, $content)
    {
        $this->sectionContent[$type] = $content;
    }

    /**
     * Render the Mail for a given context.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the email.
     * @return string Rendered output of the email
     * @throws RuntimeException
     */
    public function render(array $context)
    {

        $template = $this->getTemplate();

        $context['template'] = $template;

        $sections = $template->getUsedSections();

        $sectionFactory = new Factory($this->config, 'sections');
        foreach ($sections as $section) {
            $content = null;
            if (array_key_exists($section, $this->sectionContent)) {
                $content = $this->sectionContent[$section];
            }
            $context['sections'][$section] = $sectionFactory->create($section,
                [$section, $content]);
        }

        $context['format'] = $this->getFormat();

        $context = $this->setContext($context);

        return $template->render($context);
    }

    /**
     * Set the context of the mail.
     *
     * @since 1.0.0
     *
     * @param array $context Context to set/modify.
     * @return array Updated context.
     */
    abstract protected function setContext(array $context);
}