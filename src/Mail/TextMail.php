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

/**
 * Class TextMail.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class TextMail extends AbstractMail
{

    /**
     * Set the format of the mail.
     *
     * @since 1.0.0
     */
    protected function setFormat()
    {
        $this->format = 'text';
    }

    /**
     * Set the context of the renderer.
     *
     * @since 1.0.0
     *
     * @param array $context Context to set/modify.
     *
     * @return array Updated context.
     */
    protected function setContext(array $context)
    {
        return $context;
    }
}
