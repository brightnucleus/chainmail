<?php
/**
 * AbstractView
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\View;

use BrightNucleus\ChainMail\Support\ConfigInterface;
use BrightNucleus\ChainMail\ViewInterface;

/**
 * Class View
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Support
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractView implements ViewInterface {

	/**
	 * Configuration Settings.
	 *
	 * @since 1.0.0
	 *
	 * @var ConfigInterface
	 */
	protected $config;

	/**
	 * Location of the view data.
	 *
	 * @since 1.0.0
	 *
	 * @var   1.0.0
	 */
	protected $view_location;

	/**
	 * Instantiate a View object.
	 *
	 * @since 1.0.0
	 *
	 * @param ConfigInterface $config        Configuration settings.
	 * @param string          $view_location Location of the View to render.
	 */
	public function __construct( $config, $view_location ) {
		$this->config        = $config;
		$this->view_location = $view_location;
	}
}