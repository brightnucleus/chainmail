<?php
/**
 * PHPView
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\View;

/**
 * Class View
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Support
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class PHPView extends AbstractView
{

    /**
     * Render the current Renderable for a given context.
     *
     * @since 1.0.0
     *
     * @param array  $context The context in which to render the Renderable.
     * @param string $content Optional. The content that the view should
     *                        represent.
     * @return string|null Rendered output of the Renderable.
     */
    public function render(array $context, $content = null)
    {

        ob_start();

        include $this->viewLocation . '.php';

        return ob_get_clean();
    }
}
