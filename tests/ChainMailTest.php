<?php
/**
 * ${CLASS_NAME}
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

use BrightNucleus\ChainMail\ChainMail;

/**
 * Class ChainMailTest
 *
 * @since  1.0.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class ChainMailTest extends PHPUnit_Framework_TestCase {

	/**
	 * Test Mail creation.
	 *
	 * @since        1.0.0
	 *
	 * @dataProvider mail_creation_data_provider
	 *
	 * @param string $format
	 * @param string $template
	 * @param string $expected_mail
	 * @param string $expected_template
	 */
	public function test_mail_creation( $format, $template, $expected_mail, $expected_template ) {
		$chainmail = new ChainMail();
		$mail      = $chainmail->create_mail( $format, $template );
		$this->assertInstanceOf( $expected_mail, $mail );
		$template = $mail->get_template();
		$this->assertInstanceOf( $expected_template, $template );
	}

	/**
	 * Provides data to the test_mail_creation() method.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function mail_creation_data_provider() {
		return [
			// string $format, string $template, string $expected_mail, string $expected_template
			[ 'html', 'BasicTemplate', 'BrightNucleus\ChainMail\Mail\HTMLMail', 'BrightNucleus\ChainMail\Template\BasicTemplate' ],
			[ 'text', 'BasicTemplate', 'BrightNucleus\ChainMail\Mail\TextMail', 'BrightNucleus\ChainMail\Template\BasicTemplate' ],
			[ 'html', 'HeroTemplate', 'BrightNucleus\ChainMail\Mail\HTMLMail', 'BrightNucleus\ChainMail\Template\HeroTemplate' ],
			[ 'text', 'HeroTemplate', 'BrightNucleus\ChainMail\Mail\TextMail', 'BrightNucleus\ChainMail\Template\HeroTemplate' ],
			[ 'html', 'SidebarTemplate', 'BrightNucleus\ChainMail\Mail\HTMLMail', 'BrightNucleus\ChainMail\Template\SidebarTemplate' ],
			[ 'text', 'SidebarTemplate', 'BrightNucleus\ChainMail\Mail\TextMail', 'BrightNucleus\ChainMail\Template\SidebarTemplate' ],
			[ 'html', 'HeroSidebarTemplate', 'BrightNucleus\ChainMail\Mail\HTMLMail', 'BrightNucleus\ChainMail\Template\HeroSidebarTemplate' ],
			[ 'text', 'HeroSidebarTemplate', 'BrightNucleus\ChainMail\Mail\TextMail', 'BrightNucleus\ChainMail\Template\HeroSidebarTemplate' ],
		];
	}

	/**
	 * Test Mail rendering output.
	 *
	 * @since        1.0.0
	 *
	 * @dataProvider mail_rendering_output_data_provider
	 *
	 * @param string $format
	 * @param string $template
	 * @param string $expected_output
	 */
	public function test_mail_rendering_output( $format, $template, $expected_output ) {
		$chainmail = new ChainMail();
		$mail      = $chainmail->create_mail( $format, $template );
		$mail->add_section( 'HeaderSection', 'This is the header of the email.' );
		$mail->add_section( 'HeroSection', 'This is the hero section of the email.' );
		$mail->add_section( 'BodySection', 'This is the body of the email.' );
		$mail->add_section( 'SidebarSection', 'This is the sidebar of the email.' );
		$mail->add_section( 'FooterSection', 'This is the footer of the email.' );
		$output = $mail->render( [ ] );
		$this->assertRegExp( $expected_output, $output );
	}

	/**
	 * Provides data to the test_mail_rendering_output() method.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function mail_rendering_output_data_provider() {
		return [
			// string $format, string $template, string $expected_output
			[ 'html', 'BasicTemplate', '|^<html>.*This is the header of the email\..*This is the body of the email\..*This is the footer of the email\..*</html>$|s' ],
			[ 'text', 'BasicTemplate', '|^This is the header of the email\..*This is the body of the email\..*This is the footer of the email\.$|s' ],
			[ 'html', 'HeroTemplate', '|^<html>.*This is the header of the email\..*This is the hero section of the email\..*This is the body of the email\..*This is the footer of the email\..*</html>$|s' ],
			[ 'text', 'HeroTemplate', '|^This is the header of the email\..*This is the hero section of the email\..*This is the body of the email\..*This is the footer of the email\.$|s' ],
			[ 'html', 'SidebarTemplate', '|^<html>.*This is the header of the email\..*This is the body of the email\..*This is the sidebar of the email\..*This is the footer of the email\..*</html>$|s' ],
			[ 'text', 'SidebarTemplate', '|^This is the header of the email\..*This is the body of the email\..*This is the sidebar of the email\..*This is the footer of the email\.$|s' ],
			[ 'html', 'HeroSidebarTemplate', '|^<html>.*This is the header of the email\..*This is the hero section of the email\..*This is the body of the email\..*This is the sidebar of the email\..*This is the footer of the email\..*</html>$|s' ],
			[ 'text', 'HeroSidebarTemplate', '|^This is the header of the email\..*This is the hero section of the email\..*This is the body of the email\..*This is the sidebar of the email\..*This is the footer of the email\.$|s' ],
		];
	}
}
