<?php
/**
 * BrightNucleus ChainMail Component.
 *
 * @package   BrightNucleus/ChainMail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

/**
 * Interface Renderable.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface Renderable
{

    /**
     * Render the current Renderable for a given context.
     *
     * @since 1.0.0
     *
     * @param array $context The context in which to render the Renderable.
     *
     * @return string Rendered output of the Renderable.
     */
    public function render(array $context);
}
