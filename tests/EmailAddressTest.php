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

use BrightNucleus\ChainMail\Exception\InvalidEmailAddress;
use BrightNucleus\ChainMail\Support\Domain;
use BrightNucleus\ChainMail\Support\EmailAddress;

/**
 * Class EmailAddressTest.
 *
 * @since  1.0.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class EmailAddressTest extends \PHPUnit_Framework_TestCase
{

    /** @dataProvider dataProviderTestCreation */
    public function testCreation($input, $string, $localPart, $domain)
    {
        $email = new EmailAddress($input);
        $this->assertInstanceOf(EmailAddress::class, $email);
        $this->assertEquals($string, (string)$email);
        $this->assertEquals($string, $email->getAddress());
        $this->assertEquals($localPart, $email->getLocalPart());
        $this->assertInstanceOf(Domain::class, $email->getDomain());
        $this->assertEquals(new Domain($domain), $email->getDomain());
        $this->assertEquals($domain, (string)$email->getDomain());
    }

    public function dataProviderTestCreation()
    {
        return [
            [
                'email@example.invalid',
                'email@example.invalid',
                'email',
                'example.invalid',
            ],
            [
                new EmailAddress('email@example.invalid'),
                'email@example.invalid',
                'email',
                'example.invalid',
            ],
        ];
    }

    /** @dataProvider dataProviderTestThrowsException */
    public function testThrowsException($input, $exception)
    {
        $this->expectException($exception);
        new EmailAddress($input);
    }

    public function dataProviderTestThrowsException()
    {
        return [
            [
                '  rubbish  ',
                InvalidEmailAddress::class,
            ],
        ];
    }
}
