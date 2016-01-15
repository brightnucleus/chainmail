<?php
/**
 * ChainMail default configuration settings
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

return [
	'views_root'       => __DIR__ . '/../views/',
	'view_type'        => 'PHPView',
	'default_template' => 'BasicTemplate',
	'formats'          => [
		'html' => [
			'mail'      => 'HTMLMail',
			'validator' => 'HTMLValidator',
			'sanitizer' => 'HTMLSanitizer',
		],
		'text' => [
			'mail'      => 'TextMail',
			'validator' => 'TextValidator',
			'sanitizer' => 'TextSanitizer',
		],
	],
	'mails'            => [
		'HTMLMail' => '\BrightNucleus\ChainMail\Mail\HTMLMail',
		'TextMail' => '\BrightNucleus\ChainMail\Mail\TextMail',
	],
	'validators'       => [
		'HTMLValidator' => '\BrightNucleus\ChainMail\Validator\HTMLValidator',
		'TextValidator' => '\BrightNucleus\ChainMail\Validator\TextValidator',
	],
	'sanitizers'       => [
		'HTMLSanitizer' => '\BrightNucleus\ChainMail\Sanitizer\HTMLSanitizer',
		'TextSanitizer' => '\BrightNucleus\ChainMail\Sanitizer\TextSanitizer',
	],
	'templates'        => [
		'BasicTemplate'       => '\BrightNucleus\ChainMail\Template\BasicTemplate',
		'HeroTemplate'        => '\BrightNucleus\ChainMail\Template\HeroTemplate',
		'SidebarTemplate'     => '\BrightNucleus\ChainMail\Template\SidebarTemplate',
		'HeroSidebarTemplate' => '\BrightNucleus\ChainMail\Template\HeroSidebarTemplate',
	],
	'sections'         => [
		'HeaderSection'  => '\BrightNucleus\ChainMail\Section\GenericSection',
		'BodySection'    => '\BrightNucleus\ChainMail\Section\GenericSection',
		'FooterSection'  => '\BrightNucleus\ChainMail\Section\GenericSection',
		'HeroSection'    => '\BrightNucleus\ChainMail\Section\GenericSection',
		'SidebarSection' => '\BrightNucleus\ChainMail\Section\GenericSection',
	],
	'view_types'       => [
		'PHPView' => '\BrightNucleus\ChainMail\View\PHPView',
	],
];