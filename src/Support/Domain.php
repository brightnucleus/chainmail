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

use BrightNucleus\Chainmail\Exception\InvalidDomain;

/**
 * Class Domain.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Domain
{

    /**
     * Domain name.
     *
     * @var string
     */
    protected $domain;

    /**
     * Instantiate a Domain object.
     *
     * @param Domain|string $domain
     *
     * @throws InvalidDomain If the domain is not valid.
     */
    public function __construct($domain)
    {
        if ( ! $this->isValid($domain)) {
            throw InvalidDomain::from($domain);
        }

        $this->domain = (string)$domain;
    }

    /**
     * Return the domain name.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Reutrn a string representation of the Domain object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getDomain();
    }

    /**
     * @param $domain
     *
     * @return bool
     */
    protected function isValid($domain)
    {
        // TODO: Implement real validation.
        return $domain === trim($domain);
    }
}