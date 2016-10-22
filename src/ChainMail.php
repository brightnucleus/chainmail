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

namespace BrightNucleus\ChainMail;

use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\Config\ConfigInterface;

/**
 * Class ChainMail.
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

        $defaults = ConfigFactory::create(include(self::DEFAULT_CONFIG));

        if ( ! $config) {
            $this->config = $defaults;

            return;
        }

        $this->config = ConfigFactory::create(array_replace_recursive(
                (array)$defaults,
                (array)$config)
        );
    }

    /**
     * Render a specific section.
     *
     * @since 1.0.0
     *
     * @param string $sectionType Type of section to render.
     * @param array  $context     The context in which to render the section.
     *
     * @return string Rendered HTML.
     */
    public static function renderSection($sectionType, array $context)
    {
        /** @var Section $section */
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
     *
     * @return array Array of strings with section types.
     */
    public static function getUsedSections(array $context)
    {
        /** @var Template $template */
        $template = $context['template'];

        return $template->getUsedSections();
    }

    /**
     * Render all used sections.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the section.
     *
     * @return string Rendered HTML.
     */
    public static function renderSections(array $context)
    {
        $output = '';

        foreach (self::getUsedSections($context) as $section) {
            $output .= self::renderSection($section, $context);
        }

        return $output;
    }

    /**
     * Create a new mail object.
     *
     * @since 1.0.0
     *
     * @param string          $format   Optional. Format to use.
     * @param string|Template $template Optional. Template to be used.
     *
     * @return Mail
     */
    public function createMail($format = 'html', $template = 'BasicTemplate')
    {
        $mail_factory = new Factory($this->config, 'mails');
        $mail_class   = $this->config->getKey('formats')[$format]['mail'];
        $mail         = $mail_factory->create($mail_class);
        $mail->setTemplate($template);

        return $mail;
    }
}
