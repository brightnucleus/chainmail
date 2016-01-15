<?php
/**
 * AbstractSection
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Section;

use RuntimeException;
use BrightNucleus\ChainMail\SectionInterface;
use BrightNucleus\ChainMail\Support\ConfigInterface;
use BrightNucleus\ChainMail\Support\Factory;

/**
 * Abstract Class AbstractSection
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractSection implements SectionInterface {

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
	 * Content of the section.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $content;

	/**
	 * Instantiate a AbstractSection object.
	 *
	 * @since 1.0.0
	 *
	 * @param ConfigInterface $config  Configuration settings.
	 * @param string          $content Content of the section.
	 */
	public function __construct( $config, $content ) {
		$this->config = $config;
		$this->set_view_name();
		$this->content = $this->validate( $content );
	}

	/**
	 * Set the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 */
	abstract protected function set_view_name();

	/**
	 * Set the name of the View to use for rendering.
	 *
	 * @since 1.0.0
	 *
	 * @return string Name of the view.
	 */
	protected function get_view_name() {
		return $this->view_name;
	}

	/**
	 * Render the current Renderable for a given context.
	 *
	 * @since 1.0.0
	 *
	 * @param array $context The context in which to render the Renderable.
	 * @return string Rendered output of the Renderable.
	 * @throws RuntimeException
	 */
	public function render( array $context ) {

		$view_location = $this->get_view_location( $context );
		$view_type     = $this->config->get_key( 'view_type' );

		$view_factory = new Factory( $this->config, 'view_types' );
		$view         = $view_factory->create( $view_type, $view_location );

		$content = $this->sanitize( $this->content );

		return $view->render( $context, $content );
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

		return $view_root . '/sections/' . $context['format'] . '/' . $this->get_view_name();
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