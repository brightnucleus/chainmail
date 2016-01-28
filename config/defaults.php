<?php
/**
 * ChainMail default configuration settings.
 *
 * These defaults can be overridden by providing an instance of a
 * `ConfigInterface` to the `ChainMail` constructor.
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

return [
    /*
     * Root location that contains the view files to be rendered. These are
     * referenced by the individual sections & templates when choosing a
     * specific view to be rendered.
     */
    'view_root_locations' => [
        'default' => __DIR__ . '/../views/',
    ],

    /*
     * Type of view rendering system to use.
     */
    'view_type'           => 'PHPView',

    /*
     * The default template to when none is specified.
     */
    'default_template'    => 'BasicTemplate',

    /*
     * The formats in which an email can be rendered.
     * Each format needs a `MailInterface` implementation, a
     * `ValidatorInterface` implementation, as well as a `SanitizerInterface`
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
     * The `MailInterface` implementations that are provided.
     */
    'mails'               => [
        'HTMLMail' => [
            'class_name' => '\BrightNucleus\ChainMail\Mail\HTMLMail',
        ],
        'TextMail' => [
            'class_name' => '\BrightNucleus\ChainMail\Mail\TextMail',
        ],
    ],

    /*
     * The `ValidatorInterface` implementations that are provided.
     */
    'validators'          => [
        'HTMLValidator' => [
            'class_name' => '\BrightNucleus\ChainMail\Validator\HTMLValidator',
        ],
        'TextValidator' => [
            'class_name' => '\BrightNucleus\ChainMail\Validator\TextValidator',
        ],
    ],

    /*
     * The `SanitizerInterface` implementations that are provided.
     */
    'sanitizers'          => [
        'HTMLSanitizer' => [
            'class_name' => '\BrightNucleus\ChainMail\Sanitizer\HTMLSanitizer',
        ],
        'TextSanitizer' => [
            'class_name' => '\BrightNucleus\ChainMail\Sanitizer\TextSanitizer',
        ],
    ],

    /*
     * The `ViewInterface` implementations that are provided.
     */
    'view_types'          => [
        'PHPView' => '\BrightNucleus\ChainMail\View\PHPView',
    ],

    /*
     * The `TemplateInterface` implementations that are provided.
     *
     * Each template also defines what sections it intends to use, and what
     * view it intends to use for rendering.
     */
    'templates'           => [
        'BasicTemplate'       => [
            'class_name'    => '\BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections' => [
                'HeaderSection',
                'BodySection',
                'FooterSection',
            ],
            'view_name'     => 'GenericTemplate',
            'view_location' => 'default',
        ],
        'HeroTemplate'        => [
            'class_name'    => '\BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections' => [
                'HeaderSection',
                'HeroTemplate',
                'BodySection',
                'FooterSection',
            ],
            'view_name'     => 'GenericTemplate',
            'view_location' => 'default',
        ],
        'SidebarTemplate'     => [
            'class_name'    => '\BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections' => [
                'HeaderSection',
                'BodySection',
                'SidebarTemplate',
                'FooterSection',
            ],
            'view_name'     => 'GenericTemplate',
            'view_location' => 'default',
        ],
        'HeroSidebarTemplate' => [
            'class_name'    => '\BrightNucleus\ChainMail\Template\GenericTemplate',
            'sections' => [
                'HeaderSection',
                'HeroTemplate',
                'BodySection',
                'SidebarTemplate',
                'FooterSection',
            ],
            'view_name'     => 'GenericTemplate',
            'view_location' => 'default',
        ],
    ],

    /*
     * The `SectionInterface` implementations that are provided.
     *
     * Each section also defines what view it intends to use for rendering.
     */
    'sections'            => [
        'HeaderSection'  => [
            'class_name'    => '\BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'     => 'GenericSection',
            'view_location' => 'default',
        ],
        'BodySection'    => [
            'class_name'    => '\BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'     => 'GenericSection',
            'view_location' => 'default',
        ],
        'FooterSection'  => [
            'class_name'    => '\BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'     => 'GenericSection',
            'view_location' => 'default',
        ],
        'HeroSection'    => [
            'class_name'    => '\BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'     => 'GenericSection',
            'view_location' => 'default',
        ],
        'SidebarSection' => [
            'class_name'    => '\BrightNucleus\ChainMail\Section\GenericSection',
            'view_name'     => 'GenericSection',
            'view_location' => 'default',
        ],
    ],
];