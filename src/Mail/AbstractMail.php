<?php
/**
 * AbstractMail
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Mail;

use RuntimeException;
use BrightNucleus\ChainMail\Support\Factory;
use BrightNucleus\ChainMail\MailInterface;
use BrightNucleus\ChainMail\Support\ConfigInterface;
use BrightNucleus\ChainMail\TemplateInterface;
use BrightNucleus\ChainMail\SectionInterface;

/**
 * Abstract Class AbstractMail
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractMail implements MailInterface {

	/**
	 * Configuration Settings.
	 *
	 * @since 1.0.0
	 *
	 * @var ConfigInterface
	 */
	protected $config;

	/**
	 * Template that is used for the email.
	 *
	 * @since 1.0.0
	 *
	 * @var TemplateInterface
	 */
	protected $template;

	/**
	 * Content for the different sections.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $section_content = [ ];

	/**
	 * Format of the mail.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $format;

	/**
	 * Instantiate an AbstractMail object.
	 *
	 * @since 1.0.0
	 *
	 * @param ConfigInterface $config
	 */
	public function __construct( ConfigInterface $config ) {
		$this->config = $config;
		$this->set_format();
	}

	/**
	 * Set the format of the mail.
	 *
	 * @since 1.0.0
	 *
	 * @return string Format of the Mail.
	 */
	protected function get_format() {
		return $this->format;
	}

	/**
	 * Set the format of the mail.
	 *
	 * @since 1.0.0
	 */
	abstract protected function set_format();

	/**
	 * Set the template to use for the renderer.
	 *
	 * @since 1.0.0
	 *
	 * @param string|TemplateInterface $template Template to use for the
	 *                                           renderer.
	 * @throws RuntimeException
	 */
	public function set_template( $template ) {
		if ( is_string( $template ) ) {
			$template = $this->create_template( $template );
		}
		$this->template = $template;
	}

	/**
	 * Get the template to use for the renderer.
	 *
	 * @since 1.0.0
	 *
	 * @return TemplateInterface Reference to the template that is used.
	 * @throws RuntimeException
	 */
	public function get_template() {

		if ( ! $this->template ) {
			$this->set_default_template();
		}

		if ( is_string( $this->template ) ) {
			$this->template = $this->create_template( $this->template );
		}

		return $this->template;
	}

	/**
	 * Set the template to the default template defined in the configuration.
	 *
	 * @since 1.0.0
	 *
	 * @throws RuntimeException
	 */
	protected function set_default_template() {
		$default_template = $this->config->get_key( 'default_template' );
		$this->set_template( $default_template );
	}

	/**
	 * Create an instance of a template.
	 *
	 * @since 1.0.0
	 *
	 * @param string $template Template to instantiate.
	 * @return TemplateInterface $template Newly created instance.
	 * @throws RuntimeException
	 */
	protected function create_template( $template ) {
		$template_factory = new Factory( $this->config, 'templates' );

		return $template_factory->create( $template );
	}

	/**
	 * Add a section to the Mail.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type    Type of section to add.
	 * @param string $content Content of the section.
	 * @throws RuntimeException
	 */
	public function add_section( $type, $content ) {
		$this->section_content[ $type ] = $content;
	}

	/**
	 * Render the Mail for a given context.
	 *
	 * @since 1.0.0
	 *
	 * @param array $context The context in which to render the email.
	 * @return string Rendered output of the email
	 * @throws RuntimeException
	 */
	public function render( array $context ) {

		$template = $this->get_template();

		$context['template'] = $template;

		$sections = $template->get_used_sections();

		$section_factory = new Factory( $this->config, 'sections' );
		foreach ( $sections as $section ) {
			$content = null;
			if ( array_key_exists( $section, $this->section_content ) ) {
				$content = $this->section_content[ $section ];
			}
			$context['sections'][ $section ] = $section_factory->create( $section, $content );
		}

		$context['format'] = $this->get_format();

		$context = $this->set_context( $context );

		return $template->render( $context );
	}

	/**
	 * Set the context of the mail.
	 *
	 * @since 1.0.0
	 *
	 * @param array $context Context to set/modify.
	 * @return array Updated context.
	 */
	abstract protected function set_context( array $context );
}