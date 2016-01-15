<?php
/**
 * SidebarTemplate
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Template;

/**
 * Class SidebarTemplate
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Template
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class SidebarTemplate extends AbstractTemplate {

	/**
	 * Set the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 */
	protected function set_view_name() {
		$this->view_name = 'SidebarTemplate';
	}

	/**
	 * Get an array of Sections that are used by this template.
	 *
	 * @since 1.0.0
	 *
	 * @return array Sections that are used by this template.
	 */
	public function get_used_sections() {
		return [ 'HeaderSection', 'BodySection', 'SidebarSection', 'FooterSection' ];
	}
}