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

use BrightNucleus\ChainMail\Exception\InvalidDomain;
use BrightNucleus\ChainMail\Support\Domain;

/**
 * Class DomainTest.
 *
 * @since  1.0.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class DomainTest extends \PHPUnit_Framework_TestCase
{

    /** @dataProvider dataProviderTestCreation */
    public function testCreation($input, $string)
    {
        $domain = new Domain($input);
        $this->assertInstanceOf(Domain::class, $domain);
        $this->assertEquals($string, (string)$domain);
    }

    public function dataProviderTestCreation()
    {
        return [
            [
                'google.com',
                'google.com',
            ],
        ];
    }

    /** @dataProvider dataProviderTestThrowsException */
    public function testThrowsException($input, $exception)
    {
        $this->expectException($exception);
        new Domain($input);
    }

    public function dataProviderTestThrowsException()
    {
        return [
            [
                '  rubbish  ',
                InvalidDomain::class,
            ],
        ];
    }
}
