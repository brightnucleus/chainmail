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

use BrightNucleus\ChainMail\Mail\HTMLMail;
use BrightNucleus\ChainMail\Mail\TextMail;
use BrightNucleus\ChainMail\Template\GenericTemplate;

/**
 * Class ChainMailTest.
 *
 * @since  1.0.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class ChainMailTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test Mail creation.
     *
     * @since        1.0.0
     *
     * @dataProvider mailCreationDataProvider
     *
     * @param string $format
     * @param string $template
     * @param string $expectedMail
     * @param string $expectedTemplate
     */
    public function testMailCreation(
        $format,
        $template,
        $expectedMail,
        $expectedTemplate
    ) {
        $chainmail = new ChainMail();
        $mail      = $chainmail->createMail($format, $template);
        $this->assertInstanceOf($expectedMail, $mail);
        $template = $mail->getTemplate();
        $this->assertInstanceOf($expectedTemplate, $template);
    }

    /**
     * Provides data to the testMailCreation() method.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function mailCreationDataProvider()
    {
        return [
            // string $format, string $template, string $expectedMail, string $expectedTemplate
            [
                'html',
                'BasicTemplate',
                HTMLMail::class,
                GenericTemplate::class,
            ],
            [
                'text',
                'BasicTemplate',
                TextMail::class,
                GenericTemplate::class,
            ],
            [
                'html',
                'HeroTemplate',
                'BrightNucleus\ChainMail\Mail\HTMLMail',
                GenericTemplate::class,
            ],
            [
                'text',
                'HeroTemplate',
                TextMail::class,
                GenericTemplate::class,
            ],
            [
                'html',
                'SidebarTemplate',
                'BrightNucleus\ChainMail\Mail\HTMLMail',
                GenericTemplate::class,
            ],
            [
                'text',
                'SidebarTemplate',
                TextMail::class,
                GenericTemplate::class,
            ],
            [
                'html',
                'HeroSidebarTemplate',
                'BrightNucleus\ChainMail\Mail\HTMLMail',
                GenericTemplate::class,
            ],
            [
                'text',
                'HeroSidebarTemplate',
                TextMail::class,
                GenericTemplate::class,
            ],
        ];
    }

    /**
     * Test Mail rendering output.
     *
     * @since        1.0.0
     *
     * @dataProvider mailRenderingOutputDataProvider
     *
     * @param string $format
     * @param string $template
     * @param string $expectedOutput
     */
    public function testMailRenderingOutput($format, $template, $expectedOutput)
    {
        $chainmail = new ChainMail();
        $mail      = $chainmail->createMail($format, $template);
        $mail->addSection('HeaderSection', 'HEADER');
        $mail->addSection('HeroSection', 'HERO');
        $mail->addSection('BodySection', 'BODY');
        $mail->addSection('SidebarSection', 'SIDEBAR');
        $mail->addSection('FooterSection', 'FOOTER');
        $output = $mail->render([]);
        $this->assertRegExp($expectedOutput, $output);
    }

    /**
     * Provides data to the testMailRenderingOutput() method.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function mailRenderingOutputDataProvider()
    {
        return [
            // string $format, string $template, string $expectedOutput
            [
                'html',
                'BasicTemplate',
                '|^<html>.*HEADER.*BODY.*FOOTER.*</html>$|s',
            ],
            ['text', 'BasicTemplate', '|^HEADER.*BODY.*FOOTER$|s'],
            [
                'html',
                'HeroTemplate',
                '|^<html>.*HEADER.*HERO.*BODY.*FOOTER.*</html>$|s',
            ],
            ['text', 'HeroTemplate', '|^HEADER.*HERO.*BODY.*FOOTER$|s'],
            [
                'html',
                'SidebarTemplate',
                '|^<html>.*HEADER.*BODY.*SIDEBAR.*FOOTER.*</html>$|s',
            ],
            ['text', 'SidebarTemplate', '|^HEADER.*BODY.*SIDEBAR.*FOOTER$|s'],
            [
                'html',
                'HeroSidebarTemplate',
                '|^<html>.*HEADER.*HERO.*BODY.*SIDEBAR.*FOOTER.*</html>$|s',
            ],
            [
                'text',
                'HeroSidebarTemplate',
                '|^HEADER.*HERO.*BODY.*SIDEBAR.*FOOTER$|s',
            ],
        ];
    }
}
