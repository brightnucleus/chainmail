<?php
/**
 * BrightNucleus Chainmail Component.
 *
 * @package   BrightNucleus/Chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

use BrightNucleus\ChainMail\Support\EmailAddress;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Recipients.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Recipients extends ArrayCollection
{

    public function __construct(array $emails)
    {
        parent::__construct(array_filter(
            array_map(function ($value) {
                if ($value instanceof EmailAddress) {
                    return $value;
                }

                return new EmailAddress($value);
            }, $emails)
        ));
    }

    /**
     * Add an email address to the Recipients collection.
     *
     * @param mixed $email Email address to add.
     *
     * @return static
     */
    public function add($email)
    {
        parent::add(new EmailAddress($email));

        return $this;
    }
}