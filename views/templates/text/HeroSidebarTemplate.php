<?php
/**
 * HeroSidebarTemplate Text View
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

echo ChainMail::renderSection('HeaderSection', $context);
echo ChainMail::renderSection('HeroSection', $context);
echo ChainMail::renderSection('BodySection', $context);
echo ChainMail::renderSection('SidebarSection', $context);
echo ChainMail::renderSection('FooterSection', $context);
