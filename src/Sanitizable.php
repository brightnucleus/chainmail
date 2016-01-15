<?php
/**
 * Sanitizable
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

interface Sanitizable {

	/**
	 * Sanitize the content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Content to sanitize.
	 * @return mixed Sanitized content.
	 */
	public function sanitize( $content );

}