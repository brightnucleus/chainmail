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

use RuntimeException;

/**
 * Interface MailInterface.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface MailInterface extends Renderable
{

    /**
     * Set the template that the email will use.
     *
     * @since 1.0.0
     *
     * @param string|TemplateInterface $template Template to use.
     *
     * @return void
     */
    public function setTemplate($template);

    /**
     * Get the instance of the template.
     *
     * @since 1.0.0
     *
     * @return TemplateInterface
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
     * @return void
     * @throws RuntimeException
     */
    public function addSection($type, $content);
}
