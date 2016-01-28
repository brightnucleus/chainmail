<?php
/**
 * SanitizerInterface
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

/**
 * Interface SanitizerInterface
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface SanitizerInterface
{

    /**
     * Sanitize content for a given context.
     *
     * @since 1.0.0
     *
     * @param string $content Content to sanitize.
     * @param array  $context Context in which to sanitize.
     * @return string Sanitized content.
     */
    public function sanitize($content, array $context);
}