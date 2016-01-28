<?php
/**
 * HeroTemplate Text View
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

foreach (ChainMail::getUsedSections($context) as $section) {
    echo ChainMail::renderSection($section, $context);
}
