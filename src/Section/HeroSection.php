<?php
/**
 * HeroSection
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Section;

/**
 * Class HeroSection
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class HeroSection extends AbstractSection {

	/**
	 * Set the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 */
	protected function set_view_name() {
		$this->view_name = 'HeroSection';
	}
}