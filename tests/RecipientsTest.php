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
use Doctrine\Common\Collections\Collection;

/**
 * Class RecipientsTest.
 *
 * @since  1.0.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class RecipientsTest extends \PHPUnit_Framework_TestCase
{

    /** @dataProvider dataProviderTestCreation */
    public function testCreation($input, $count)
    {
        $recipients = new Recipients($input);
        $this->assertInstanceOf(Recipients::class, $recipients);
        $this->assertInstanceOf(ArrayCollection::class, $recipients);
        $this->assertInstanceOf(Collection::class, $recipients);
        $this->assertCount($count, $recipients);
    }

    public function dataProviderTestCreation()
    {
        return [
            [
                [
                    'email@example.invalid',
                ],
                1,
            ],
            [
                [
                    'email1@example.invalid',
                    'email2@example.invalid',
                ],
                2,
            ],
            [
                [
                    new EmailAddress('email@example.invalid'),
                ],
                1,
            ],
            [
                [
                    new EmailAddress('email1@example.invalid'),
                    new EmailAddress('email2@example.invalid'),
                ],
                2,
            ],
            [
                [
                    'email1@example.invalid',
                    new EmailAddress('email2@example.invalid'),
                ],
                2,
            ],
            [
                [
                    new Recipients(
                        [
                            new EmailAddress('email1@example.invalid'),
                            new EmailAddress('email2@example.invalid'),
                        ]
                    ),
                ],
                2,
            ],
            [
                [
                    'email1@example.invalid',
                    new EmailAddress('email2@example.invalid'),
                    new Recipients(
                        [
                            new EmailAddress('email3@example.invalid'),
                            new EmailAddress('email4@example.invalid'),
                        ]
                    ),
                ],
                4,
            ],
            [
                [
                    'email1@example.invalid',
                    new EmailAddress('email2@example.invalid'),
                    new Recipients(
                        [
                            new Recipients([
                                'email3@example.invalid',
                                'email4@example.invalid',
                            ]),
                            new EmailAddress('email5@example.invalid'),
                            'email6@example.invalid',
                        ]
                    ),
                ],
                6,
            ],
        ];
    }
}
