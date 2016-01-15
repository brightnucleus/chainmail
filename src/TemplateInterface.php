<?php
/**
 * TemplateInterface
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

/**
 * Interface TemplateInterface
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface TemplateInterface extends Renderable, Validatable, Sanitizable {

	/**
	 * Get an array of Sections that are used by this template.
	 *
	 * @since 1.0.0
	 *
	 * @return array Sections that are used by this template.
	 */
	public function get_used_sections();
}