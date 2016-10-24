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

namespace BrightNucleus\ChainMail;

use BrightNucleus\ChainMail\Support\EmailAddress;
use RuntimeException;

/**
 * Interface Mail.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface Mail extends Renderable
{

    /**
     * Set the template that the email will use.
     *
     * @since 1.0.0
     *
     * @param string|Template $template Template to use.
     *
     * @return Mail
     */
    public function setTemplate($template);

    /**
     * Get the instance of the template.
     *
     * @since 1.0.0
     *
     * @return Template
     */
    public function getTemplate();

    /**
     * Add a section to the Mail.
     *
     * @since 1.0.0
     *
     * @param string $type    Type of section to add.
     * @param string $content Content of the section.
     *
     * @return Mail
     * @throws RuntimeException
     */
    public function addSection($type, $content);

    /**
     * Send the email to one or more recipients.
     *
     * @since 1.0.0
     *
     * @param Recipients|EmailAddress|array|string $recipients
     *
     * @return Mail
     */
    public function sendTo($recipients);
}
