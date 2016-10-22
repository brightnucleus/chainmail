<?php
/**
 * BrightNucleus Chainmail Component.
 *
 * @package   BrightNucleus/Chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

/**
 * Interface Template.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface Template extends Renderable
{

    /**
     * Get an array of Sections that are used by this template.
     *
     * @since 1.0.0
     *
     * @return array Sections that are used by this template.
     */
    public function getUsedSections();

    /**
     * Get the name of the Template.
     *
     * @since 1.0.0
     *
     * @return string Name of the template.
     */
    public function getTemplateName();
}
