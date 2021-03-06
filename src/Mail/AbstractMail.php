<?php
/**
 * BrightNucleus ChainMail Component.
 *
 * @package   BrightNucleus/ChainMail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Mail;

use BrightNucleus\ChainMail\Exception\InvalidTemplate;
use BrightNucleus\ChainMail\Mail;
use BrightNucleus\ChainMail\Recipients;
use BrightNucleus\ChainMail\Support\EmailAddress;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\Template;
use BrightNucleus\Config\ConfigInterface;
use BrightNucleus\Config\Exception\FailedToProcessConfigException;
use BrightNucleus\View;
use BrightNucleus\View\Location\FilesystemLocation;
use BrightNucleus\View\ViewBuilder;
use Exception;
use RuntimeException;

/**
 * Abstract Class AbstractMail.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractMail implements Mail
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
     * @var Template
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
     * ViewBuilder to create template and section views.
     *
     * @since 1.0.0
     *
     * @var ViewBuilder
     */
    protected $viewBuilder;

    /**
     * Instantiate an AbstractMail object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config The Config to use.
     *
     * @throws FailedToProcessConfigException If the Config could not be processed.
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->setFormat();

        $this->viewBuilder = new ViewBuilder($config
            ? $config->getSubConfig('ViewBuilder')
            : null
        );

        foreach ($this->config->getKey('view_root_locations') as $folder) {
            $this->viewBuilder->addLocation(
                new FilesystemLocation($folder)
            );
        }
    }

    /**
     * Get the template to use for the renderer.
     *
     * @since 1.0.0
     *
     * @return Template Reference to the template that is used.
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
     * Set the template to use for the renderer.
     *
     * @since 1.0.0
     *
     * @param string|Template $template          Template to use for the
     *                                           renderer.
     *
     * @return Mail
     * @throws InvalidTemplate If the template class could not be instantiated.
     * @throws InvalidTemplate If the template type is not recognized.
     */
    public function setTemplate($template)
    {
        try {
            if (is_string($template)) {
                $template = $this->createTemplate($template);
            }
        } catch (Exception $exception) {
            throw new InvalidTemplate(
                'Could not instantiate the template class "%1$s". Reason: "%2$s".',
                $template,
                $exception->getMessage()
            );
        }

        if ( ! $template instanceof Template) {
            throw new InvalidTemplate(
                'Could not set the template, invalid type.',
                (array)$template
            );
        }
        $this->template = $template;

        return $this;
    }

    /**
     * Add a section to the Mail.
     *
     * @since 1.0.0
     *
     * @param string $type    Type of section to add.
     * @param string $content Content of the section.
     *
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
     *
     * @return string Rendered output of the email
     */
    public function render(array $context)
    {
        $template = $this->getTemplate();

        $context['template'] = $template;

        $this->instantiateSections($template->getUsedSections(), $context);

        $context['format'] = $this->getFormat();

        $context = $this->setContext($context);

        return $template->render($context);
    }

    /**
     * Send the email to one or more recipients.
     *
     * @since 1.0.0
     *
     * @param Recipients|EmailAddress|array|string $recipients
     *
     * @return Mail
     */
    public function sendTo($recipients)
    {
        if ($recipients instanceof EmailAddress) {
            return $this->executeSend($recipients);
        }

        if (is_string($recipients)) {
            return $this->sendTo(new EmailAddress($recipients));
        }

        if ($recipients instanceof Recipients) {
            array_walk($recipients, [$this, 'sendTo']);

            return $this;
        }
    }

    /**
     * Execute the sending of one individual email.
     *
     * @since 1.0.0
     *
     * @param EmailAddress $recipient Recipient to send the email to.
     *
     * @return Mail
     */
    protected function executeSend(EmailAddress $recipient)
    {
        // Do the actual sending.
        echo "Sending email to ${recipient}...";

        return $this;
    }

    /**
     * Instantiate the requested sections for a template.
     *
     * @since 1.0.0
     *
     * @param array $sections Sections to instantiate.
     * @param array $context  The context in which to instantiate the sections.
     */
    protected function instantiateSections(array $sections, array &$context)
    {
        $sectionFactory = new Factory($this->config, 'sections');

        foreach ($sections as $section) {

            $content = null;

            if (array_key_exists($section, $this->sectionContent)) {
                $content = $this->sectionContent[$section];
            }

            $context['sections'][$section] = $sectionFactory->create(
                $section,
                [$section, $content, $this->viewBuilder]
            );
        }
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
     *
     * @return void
     */
    abstract protected function setFormat();

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
     *
     * @return Template $template Newly created instance.
     * @throws RuntimeException
     */
    protected function createTemplate($template)
    {
        $templateFactory = new Factory($this->config, 'templates');

        return $templateFactory->create($template, [$template, $this->viewBuilder]);
    }

    /**
     * Set the context of the mail.
     *
     * @since 1.0.0
     *
     * @param array $context Context to set/modify.
     *
     * @return array Updated context.
     */
    abstract protected function setContext(array $context);
}
