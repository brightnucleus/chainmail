<?php
/**
 * ConfigInterface
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Support;

use ArrayAccess;

/**
 * Interface ConfigInterface
 *
 * @since  1.0.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
interface ConfigInterface extends ArrayAccess
{

    /**
     * Creates a copy of the ArrayObject.
     *
     * Returns a copy of the array. When the ArrayObject refers to an object an
     * array of the public properties of that object will be returned.
     * This is implemented by \ArrayObject.
     *
     * @since 1.0.0
     *
     * @return array Copy of the array.
     */
    public function getArrayCopy();

    /**
     * Check whether the Config has a specific key.
     *
     * @since 1.0.0
     *
     * @param string $key The key to check the existence for.
     *
     * @return bool
     */
    public function hasKey($key);

    /**
     * Get the value of a specific key.
     *
     * @since 1.0.0
     *
     * @param string $key The key to get the value for.
     *
     * @return mixed
     */
    public function getKey($key);

    /**
     * Get the an array with all the keys
     *
     * @since 1.0.0
     *
     * @return mixed
     */
    public function getKeys();
}