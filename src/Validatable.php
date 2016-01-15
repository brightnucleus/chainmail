<?php
/**
 * Validatable
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

/**
 * Interface Validatable
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface Validatable {

	/**
	 * Validate the content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Content to validate.
	 * @return mixed Validated content.
	 */
	public function validate( $content );

}