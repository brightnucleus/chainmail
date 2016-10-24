<?php
/**
 * Bright Nucleus Chainmail Component.
 *
 * @package   BrightNucleus\ChainMail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Exception;

use BrightNucleus\Exception\RuntimeException;

/**
 * Class InvalidEmailAddress.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidEmailAddress extends RuntimeException implements ChainmailException
{

    /**
     * Create an InvalidEmailAddress exception based on a specific email.
     *
     * @param string $email Email that failed validation.
     *
     * @return static
     */
    public static function from($email)
    {
        return new static(sprintf('Invalid email address: "%1$s".', $email));
    }
}
