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

/** @var SectionInterface $header */
$header = $context['sections']['HeaderSection'];
/** @var SectionInterface $hero */
$hero = $context['sections']['HeroSection'];
/** @var SectionInterface $body */
$body = $context['sections']['BodySection'];
/** @var SectionInterface $footer */
$footer = $context['sections']['FooterSection'];

echo $header->render( $context );
echo $hero->render( $context );
echo $body->render( $context );
echo $footer->render( $context );