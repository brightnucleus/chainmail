<?php
/**
 * ChainMail
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

use RuntimeException;
use BrightNucleus\ChainMail\Support\Config;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\Support\ConfigInterface;

/**
 * Class ChainMail
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ChainMail
{

    const DEFAULT_CONFIG = __DIR__ . '/../config/defaults.php';

    /**
     * Configuration Settings.
     *
     * @since 1.0.0
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Instantiate a ChainMail object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface|null $config Optional. Configuration settings.
     */
    public function __construct(ConfigInterface $config = null)
    {

        $defaults = new Config(include(ChainMail::DEFAULT_CONFIG));

        if ( ! $config) {
            $this->config = $defaults;

            return;
        }

        $this->config = new Config(array_merge(
                (array)$defaults,
                (array)$config)
        );
    }

    /**
     * Create a new mail object.
     *
     * @since 1.0.0
     *
     * @param string|null                   $format   Optional. Format to use.
     * @param string|TemplateInterface|null $template Optional. Template to be
     *                                                used.
     * @return MailInterface
     * @throws RuntimeException
     */
    public function createMail($format = null, $template = null)
    {
        $mail_factory = new Factory($this->config, 'mails');
        $mail_class   = $this->config->getKey('formats')[$format]['mail'];
        $mail         = $mail_factory->create($mail_class);
        $mail->setTemplate($template);

        return $mail;
    }

    /**
     * Render a specific section.
     *
     * @since 1.0.0
     *
     * @param string $sectionType Type of section to render.
     * @param array  $context     The context in which to render the section.
     * @return string Rendered HTML.
     */
    public static function renderSection($sectionType, $context)
    {
        /** @var SectionInterface $section */
        $section = $context['sections'][$sectionType];

        return $section->render($context);
    }

    /**
     * Get an array of strings representing the sections that are used by the
     * template.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the section.
     * @return array Array of strings with section types.
     */
    public static function getUsedSections($context)
    {
        /** @var TemplateInterface $template */
        $template = $context['template'];

        return $template->getUsedSections();
    }
}
