<?php
/**
 * Bright Nucleus ChainMail Component.
 *
 * @package   BrightNucleus\ChainMail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Exception;

use BrightNucleus\Exception\RuntimeException;

/**
 * Class FailedToInstantiateClass.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class FailedToInstantiateClass extends RuntimeException implements ChainMailException
{

}
