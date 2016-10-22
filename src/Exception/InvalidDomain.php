<?php
/**
 * Bright Nucleus Chainmail Component.
 *
 * @package   BrightNucleus\Chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\Chainmail\Exception;

use BrightNucleus\Exception\RuntimeException;

/**
 * Class InvalidDomain.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\Chainmail\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidDomain extends RuntimeException implements ChainmailException
{

    /**
     * Create an InvalidDomain exception based on a specific domain.
     *
     * @param string $domain Email that failed validation.
     *
     * @return static
     */
    public static function from($domain)
    {
        return new static(sprintf('Invalid domain name: "%1$s".', $domain));
    }
}