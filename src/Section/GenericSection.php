<?php
/**
 * GenericSection
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Section;

use RuntimeException;

/**
 * Class GenericSection
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class GenericSection extends AbstractSection {

	/**
	 * Set the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 *
	 * @param string $section Optional. Name of the section.
	 * @throws RuntimeException
	 */
	protected function set_view_name( $section = null ) {
		if ( ! $section ) {
			throw new RuntimeException( 'Initialised GenericSection without passing it a section name.' );
		}
		$this->view_name = $section;
	}
}