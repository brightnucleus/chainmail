<?php
/**
 * HTMLValidator
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Validator;

/**
 * Class HTMLValidator
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Validator
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class HTMLValidator extends AbstractValidator
{

    /**
     * Validate the content for a given context.
     *
     * @since 1.0.0
     *
     * @param string $content Content to validate.
     * @param array  $context Context in which to validate.
     * @return string Validated content.
     */
    public function validate($content, array $context)
    {
        return $content;
    }
}
