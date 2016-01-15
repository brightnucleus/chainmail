<?php
/**
 * AbstractTemplate
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Template;

use RuntimeException;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\TemplateInterface;
use BrightNucleus\ChainMail\Support\ConfigInterface;

/**
 * Abstract Class AbstractTemplate
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Template
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractTemplate implements TemplateInterface {

	/**
	 * Name of the view to use for rendering.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $view_name;

	/**
	 * Configuration Settings.
	 *
	 * @since 1.0.0
	 *
	 * @var ConfigInterface
	 */
	protected $config;

	/**
	 * Instantiate an AbstractTemplate object.
	 *
	 * @since 1.0.0
	 *
	 * @param ConfigInterface $config
	 */
	public function __construct( ConfigInterface $config ) {
		$this->config = $config;
		$this->set_view_name();
	}

	/**
	 * Set the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 */
	abstract protected function set_view_name();

	/**
	 * Get the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 *
	 * @return string Name of the view.
	 */
	protected function get_view_name() {
		return $this->view_name;
	}

	/**
	 * Get an array of Sections that are used by this template.
	 *
	 * @since 1.0.0
	 *
	 * @return array Sections that are used by this template.
	 */
	abstract public function get_used_sections();

	/**
	 * Render the template for a given context.
	 *
	 * @since 1.0.0
	 *
	 * @param array $context The context in which to render the template.
	 * @return string The rendered content.
	 * @throws RuntimeException
	 */
	public function render( array $context ) {

		$view_location = $this->get_view_location( $context );
		$view_type     = $this->config->get_key( 'view_type' );

		$view_factory = new Factory( $this->config, 'view_types' );
		$view         = $view_factory->create( $view_type, $view_location );

		return $view->render( $context );
	}

	/**
	 * Get the location of the view that is used for rendering.
	 *
	 * @since 1.0.0
	 *
	 * @param array $context Context for which to get the view location.
	 * @return string
	 */
	protected function get_view_location( array $context ) {
		$view_root = $this->config->get_key( 'views_root' );

		return $view_root . '/templates/' . $context['format'] . '/' . $this->get_view_name();
	}

	/**
	 * Validate the content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Content to validate.
	 * @return mixed Validated content.
	 */
	public function validate( $content ) {
		return $content;
	}

	/**
	 * Sanitize the content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Content to sanitize.
	 * @return mixed Sanitized content.
	 */
	public function sanitize( $content ) {
		return $content;
	}
}