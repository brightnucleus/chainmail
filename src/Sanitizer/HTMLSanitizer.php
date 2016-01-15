<?php
/**
 * HTMLSanitizer
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Sanitizer;

/**
 * Class HTMLSanitizer
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Sanitizer
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class HTMLSanitize extends AbstractSanitizer {

	/**
	 * Sanitize the content for a given context.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Content to sanitize.
	 * @param array  $context Context in which to sanitize.
	 * @return string Sanitized content.
	 */
	public function sanitize( $content, array $context ) {
		return $content;
	}
}