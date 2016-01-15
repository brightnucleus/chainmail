<?php
/**
 * ChainMail
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

use RuntimeException;
use BrightNucleus\ChainMail\Support\Config;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\Support\ConfigInterface;

/**
 * Class ChainMail
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ChainMail {

	const DEFAULT_CONFIG = __DIR__ . '/../config/defaults.php';

	/**
	 * Configuration Settings.
	 *
	 * @since 1.0.0
	 *
	 * @var ConfigInterface
	 */
	protected $config;

	/**
	 * Instantiate a ChainMail object.
	 *
	 * @since 1.0.0
	 *
	 * @param ConfigInterface|null $config Optional. Configuration settings.
	 */
	public function __construct( ConfigInterface $config = null ) {
		if ( ! $config ) {
			$config = new Config( include( ChainMail::DEFAULT_CONFIG ) );
		}

		$this->config = $config;
	}

	/**
	 * Create a new mail object.
	 *
	 * @since 1.0.0
	 *
	 * @param string|null                   $format   Optional. Format to use.
	 * @param string|TemplateInterface|null $template Optional. Template to be
	 *                                                used.
	 * @return MailInterface
	 * @throws RuntimeException
	 */
	public function create_mail( $format = null, $template = null ) {
		$mail_factory = new Factory( $this->config, 'mails' );
		$mail_class   = $this->config->get_key( 'formats' )[ $format ]['mail'];
		$mail         = $mail_factory->create( $mail_class );
		$mail->set_template( $template );

		return $mail;
	}
}