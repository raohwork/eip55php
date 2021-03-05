<?php
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this
// file, You can obtain one at https://mozilla.org/MPL/2.0/.

namespace ShoutloudTest\EIP55;

use Shoutloud\EIP55\Address;

class AddressTest extends \PHPUnit\Framework\TestCase
{
    public function validateP(): array
    {
        return [
            ["0x52908400098527886E0F7030069857D2E4169EE7", true],
            ["0x52908400098527886E0F7030069857D2E4169eE7", false],

            ["0x8617E340B3D01FA5F11F306F4090FD50E238070D", true],
            ["0x8617e340B3D01FA5F11F306F4090FD50E238070D", false],

            ["0xde709f2102306220921060314715629080e2fb77", true],
            ["0xDe709f2102306220921060314715629080e2fb77", false],

            ["0x27b1fdb04752bbc536007a920d24acb045561c26", true],
            ["0x27B1fdb04752bbc536007a920d24acb045561c26", false],

            ["0x5aAeb6053F3E94C9b9A09f33669435E7Ef1BeAed", true],
            ["0x5AAeb6053F3E94C9b9A09f33669435E7Ef1BeAed", false],
            ["0x5aaeb6053F3E94C9b9A09f33669435E7Ef1BeAed", false],
            ["0x5Aaeb6053F3E94C9b9A09f33669435E7Ef1BeAed", false],

            ["0xfB6916095ca1df60bB79Ce92cE3Ea74c37c5d359", true],
            ["0xfB6916095ca1Df60bB79Ce92cE3Ea74c37c5d359", false],
            ["0xfB6916095ca1df60bb79Ce92cE3Ea74c37c5d359", false],
            ["0xfB6916095ca1Df60bB79Ce92cE3Ea74c37c5d359", false],

            ["0xdbF03B407c01E7cD3CBea99509d93f8DDDC8C6FB", true],
            ["0xdbF03B407c01E7cD3CBea99509d93F8DDDC8C6FB", false],
            ["0xdbF03B407c01E7cD3CBea99509d93f8dDDC8C6FB", false],
            ["0xdbF03B407c01E7cD3CBea99509d93F8dDDC8C6FB", false],

            ["0xD1220A0cf47c7B9Be7A2E6BA89F429762e7b9aDb", true],
            ["0xD1220A0CF47c7B9Be7A2E6BA89F429762e7b9aDb", false],
            ["0xD1220A0cf47c7B9Be7a2E6Ba89F429762e7b9aDb", false],
            ["0xD1220A0CF47c7B9Be7a2E6Ba89F429762e7b9aDb", false],
        ];
    }
    /**
     * @dataProvider validateP
     */
    public function testValidate(string $addr, bool $expect)
    {
        $actual = Address::validate($addr);
        $msg = $expect ? "true" : "false";

        $this->assertEquals($expect, $actual, $addr . " should be " . $msg);
    }


    public function formatP(): array
    {
        return [
            ["0x52908400098527886E0F7030069857D2E4169EE7",
            ["0x52908400098527886E0F7030069857D2E4169eE7"]],

            ["0x8617E340B3D01FA5F11F306F4090FD50E238070D",
            ["0x8617e340B3D01FA5F11F306F4090FD50E238070D"]],

            ["0xde709f2102306220921060314715629080e2fb77",
            ["0xDe709f2102306220921060314715629080e2fb77"]],

            ["0x27b1fdb04752bbc536007a920d24acb045561c26",
            ["0x27B1fdb04752bbc536007a920d24acb045561c26"]],

            ["0x5aAeb6053F3E94C9b9A09f33669435E7Ef1BeAed",
            [
                "0x5AAeb6053F3E94C9b9A09f33669435E7Ef1BeAed",
                "0x5aaeb6053F3E94C9b9A09f33669435E7Ef1BeAed",
                "0x5Aaeb6053F3E94C9b9A09f33669435E7Ef1BeAed"
            ]],

            ["0xfB6916095ca1df60bB79Ce92cE3Ea74c37c5d359",
            [
                "0xfB6916095ca1Df60bB79Ce92cE3Ea74c37c5d359",
                "0xfB6916095ca1df60bb79Ce92cE3Ea74c37c5d359",
                "0xfB6916095ca1Df60bB79Ce92cE3Ea74c37c5d359"
            ]],

            ["0xdbF03B407c01E7cD3CBea99509d93f8DDDC8C6FB",
            [
                "0xdbF03B407c01E7cD3CBea99509d93F8DDDC8C6FB",
                "0xdbF03B407c01E7cD3CBea99509d93f8dDDC8C6FB",
                "0xdbF03B407c01E7cD3CBea99509d93F8dDDC8C6FB"
            ]],

            ["0xD1220A0cf47c7B9Be7A2E6BA89F429762e7b9aDb",
            [
                "0xD1220A0CF47c7B9Be7A2E6BA89F429762e7b9aDb",
                "0xD1220A0cf47c7B9Be7a2E6Ba89F429762e7b9aDb",
                "0xD1220A0CF47c7B9Be7a2E6Ba89F429762e7b9aDb"
            ]],
            ["0x0000000000000000000000000000000000000aBc",
            [
                "0xabc",
                "abc",
                "0abc",
            ]],
            ["0x00000000000000000000000000000000000000a0",
            [
                "0xgan",
                "gan",
                "0gan",
            ]],
        ];
    }
    /**
     * @dataProvider formatP
     */
    public function testFormat(string $expect, array $src)
    {
        foreach ($src as $v) {
            $actual = Address::format($v);
            $this->assertEquals($expect, $actual, sprintf(
                " input: %s\nexpect: %s\nactual: %s",
                $v, $expect, $actual
            ));
        }
    }
}
