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

    /**
     * Instantiate a Recipients object.
     *
     * @param array $emails Array of email addresses and/or recipients.
     */
    public function __construct(array $emails)
    {
        parent::__construct([]);
        $this->add($emails);
    }

    /**
     * Add an email address to the Recipients collection.
     *
     * @param Recipients|EmailAddress|array|string $email Email address to add.
     *
     * @return static
     */
    public function add($email)
    {
        if ($email instanceof EmailAddress) {
            parent::add($email);

            return $this;
        }

        if (is_array($email) || $email instanceof Recipients) {
            array_walk($email, [$this, 'add']);

            return $this;
        }

        parent::add(new EmailAddress($email));

        return $this;
    }
}