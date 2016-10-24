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

/*
 * ChainMail default configuration settings.
 *
 * These defaults can be overridden by providing an instance of a
 * `ConfigInterface` to the `ChainMail` constructor.
 */
return [
    /*
     * Root location that contains the view files to be rendered. These are
     * referenced by the individual sections & templates when choosing a
     * specific view to be rendered.
     */
    'view_root_locations' => [
        'default' => realpath(__DIR__ . '/../views'),
    ],

    /*
     * The default template to when none is specified.
     */
    'default_template'    => 'BasicTemplate',

    /*
     * The formats in which an email can be rendered.
     * Each format needs a `Mail` implementation, a
     * `Validator` implementation, as well as a `Sanitizer`
     * implementation.
     */
    'formats'             => [

        /*
         * The `html` format should be the default format when using responsive
         * emails.
         */
        'html' => [
            'mail'      => 'HTMLMail',
            'validator' => 'HTMLValidator',
            'sanitizer' => 'HTMLSanitizer',
        ],

        /*
         * The `text` format is meant to be used a as a fallback, and can also
         * be sent as backup content embedded within HTML emails.
         */
        'text' => [
            'mail'      => 'TextMail',
            'validator' => 'TextValidator',
            'sanitizer' => 'TextSanitizer',
        ],
    ],

    /*
     * The `Mail` implementations that are provided.
     */
    'mails'               => [
        'HTMLMail' => [
            'class_name' => 'BrightNucleus\ChainMail\Mail\HTMLMail',
        ],
        'TextMail' => [
            'class_name' => 'BrightNucleus\ChainMail\Mail\TextMail',
        ],
    ],

    /*
     * The `Validator` implementations that are provided.
     */
    'validators'          => [
        'HTMLValidator' => [
            'class_name' => 'BrightNucleus\ChainMail\Validator\HTMLValidator',
        ],
        'TextValidator' => [
            'class_name' => 'BrightNucleus\ChainMail\Validator\TextValidator',
        ],
    ],

    /*
     * The `Sanitizer` implementations that are provided.
     */
    'sanitizers'          => [
        'HTMLSanitizer' => [
            'class_name' => 'BrightNucleus\ChainMail\Sanitizer\HTMLSanitizer',
        ],
        'TextSanitizer' => [
            'class_name' => 'BrightNucleus\ChainMail\Sanitizer\TextSanitizer',
        ],
    ],

    /*
     * ViewBuilder configuration that is passed into the `brightnucleus/view` component.
     */
    'ViewBuilder'         => [
        'ViewFinder' => [
            'Views' => [
                'MailView' => 'BrightNucleus\ChainMail\View\MailView',
            ],
        ],
    ],

    /*
     * The `Template` implementations that are provided.
     *
     * Each template also defines what sections it intends to use, and what
     * view it intends to use for rendering.
     */
    'templates'           => [
        'BasicTemplate'       => [
            'class_name' => 'BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections'   => [
                'HeaderSection',
                'BodySection',
                'FooterSection',
            ],
            'view_name'  => 'GenericTemplate',
        ],
        'HeroTemplate'        => [
            'class_name' => 'BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections'   => [
                'HeaderSection',
                'HeroSection',
                'BodySection',
                'FooterSection',
            ],
            'view_name'  => 'GenericTemplate',
        ],
        'SidebarTemplate'     => [
            'class_name' => 'BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections'   => [
                'HeaderSection',
                'BodySection',
                'SidebarSection',
                'FooterSection',
            ],
            'view_name'  => 'GenericTemplate',
        ],
        'HeroSidebarTemplate' => [
            'class_name' => 'BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections'   => [
                'HeaderSection',
                'HeroSection',
                'BodySection',
                'SidebarSection',
                'FooterSection',
            ],
            'view_name'  => 'GenericTemplate',
        ],
    ],

    /*
     * The `Section` implementations that are provided.
     *
     * Each section also defines what view it intends to use for rendering.
     */
    'sections'            => [
        'HeaderSection'  => [
            'css_class'  => 'header',
            'class_name' => 'BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'  => 'GenericSection',
        ],
        'BodySection'    => [
            'css_class'  => 'body',
            'class_name' => 'BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'  => 'GenericSection',
        ],
        'FooterSection'  => [
            'css_class'  => 'footer',
            'class_name' => 'BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'  => 'GenericSection',
        ],
        'HeroSection'    => [
            'css_class'  => 'hero',
            'class_name' => 'BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'  => 'GenericSection',
        ],
        'SidebarSection' => [
            'css_class'  => 'sidebar',
            'class_name' => 'BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'  => 'GenericSection',
        ],
    ],
];
