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

namespace BrightNucleus\ChainMail\Support;

use BrightNucleus\ChainMail\Exception\FailedToInstantiateClass;
use BrightNucleus\ChainMail\Exception\FailedToInstantiateFactory;
use BrightNucleus\Config\ConfigInterface;

/**
 * Class Factory.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Factory
{

    /**
     * Configuration Settings.
     *
     * @since 1.0.0
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Type of element the factory wants to create.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $element;

    /**
     * Instantiate a Factory object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config  Configuration settings.
     * @param string          $element The type of element to instantiate a factory for.
     *
     * @throws FailedToInstantiateFactory When an unknown element type is requested.
     */
    public function __construct(ConfigInterface $config, $element)
    {

        $this->config = $config;

        if ( ! $this->config->hasKey($element)) {
            throw new FailedToInstantiateFactory(sprintf(
                'Could not instantiate Factory for unknown Element Type "%1$s".',
                $element
            ));
        }

        $this->element = $element;
    }

    /**
     * Create and return a new instance of an element.
     *
     * @since 1.0.0
     *
     * @param string $type      Type of element to create.
     * @param mixed  $arguments Optional. Arguments to pass to the object.
     *
     * @return object New instance of the requested class.
     * @throws FailedToInstantiateClass If an unknown element type is requested.
     */
    public function create($type, $arguments = null)
    {

        $classMap = $this->config[$this->element];

        if ( ! array_key_exists($type, $classMap)) {
            throw new FailedToInstantiateClass(sprintf(
                'Could not create object, unknown Type "%1$s" for "%2$s" elements.',
                $type,
                $this->element
            ));
        }

        $className = $classMap[$type]['class_name'];

        return new $className($this->config, $arguments);
    }
}
