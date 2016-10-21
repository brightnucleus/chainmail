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

namespace BrightNucleus\ChainMail\View;

use BrightNucleus\View\View\AbstractView;

/**
 * Class MailView.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\View
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class MailView extends AbstractView
{

    /**
     * Check whether the Findable can handle an individual criterion.
     *
     * @since 0.1.0
     *
     * @param mixed $criterion Criterion to check.
     *
     * @return bool Whether the Findable can handle the criterion.
     */
    public function canHandle($criterion)
    {
        return $criterion === $this->uri;
    }
}
