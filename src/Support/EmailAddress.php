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

namespace BrightNucleus\ChainMail\Support;

use BrightNucleus\Chainmail\Exception\InvalidEmailAddress;
use Exception;

/**
 * Class EmailAddress.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class EmailAddress
{

    /**
     * The local part of the email address (before the '@' sign).
     *
     * @var string
     */
    protected $localPart;

    /**
     * The domain part of the email address (after the '@' sign).
     *
     * @var Domain
     */
    protected $domain;

    /**
     * Instantiate an EmailAddress object.
     *
     * @param EmailAddress|string $email The email to parse.
     *
     * @throws InvalidEmailAddress If the email is not valid.
     */
    public function __construct($email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailAddress::from($email);
        }

        try {
            $parts           = explode('@', $email);
            $this->localPart = trim($parts[0]);
            $this->domain    = new Domain(trim($parts[1]));
        } catch (Exception $exception) {
            throw InvalidEmailAddress::from($email);
        }
    }

    /**
     * Returns the local part of the email address.
     *
     * @return string
     */
    public function getLocalPart()
    {
        return $this->localPart;
    }

    /**
     * Returns the domain part of the email address.
     *
     * @return Domain
     */
    public function getDomainPart()
    {
        return $this->domain;
    }

    /**
     * Returns the entire email address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getLocalPart() . '@' . $this->getDomainPart();
    }

    /**
     * Convert the EmailAddress object to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getAddress();
    }
}