<?php
/**
 * Factory
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Support;

use RuntimeException;

/**
 * Class SectionFactory
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Factory {

	/**
	 * Configuration Settings.
	 *
	 * @since 1.0.0
	 *
	 * @var ConfigInterface
	 */
	protected $config;

	/**
	 * Instantiate a SectionFactory object.
	 *
	 * @since 1.0.0
	 *
	 * @param ConfigInterface $config  Configuration settings.
	 * @param string          $element The type of element to instantiate a
	 *                                 factory for.
	 * @throws RuntimeException When an unknown element type is requested.
	 */
	public function __construct( ConfigInterface $config, $element ) {

		$this->config = $config;

		if ( ! $this->config->has_key( $element ) ) {
			throw new RuntimeException( sprintf(
				'Could not instantiate Factory for unknown Element Type "%1$s".',
				$element
			) );
		}

		$this->element = $element;
	}

	/**
	 * Create and return a new instance of a section.
	 *
	 * @since 1.0.0
	 *
	 * @param string      $type      Type of section to create.
	 * @param string|null $arguments Optional. Arguments to pass to the object.
	 * @return mixed
	 * @throws RuntimeException If an unknown section type is requested.
	 */
	public function create( $type, $arguments = null ) {

		$class_map = $this->config->get_key( $this->element );

		if ( ! array_key_exists( $type, $class_map ) ) {
			throw new RuntimeException( sprintf(
				'Could not create object, unknown Type "%1$s" for "%2$s" elements.',
				$type,
				$this->element
			) );
		}

		$class_name = $class_map[ $type ];

		return new $class_name( $this->config, $arguments );
	}
}