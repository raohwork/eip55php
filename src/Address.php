<?php
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this
// file, You can obtain one at https://mozilla.org/MPL/2.0/.

namespace Shoutloud\EIP55;

use kornrunner\Keccak;

class Address
{
    const arr = "0123456789abcdef";

    private static function lpad(string $str): string {
        $l = strlen($str);
        if ($l >= 40) return $str;

        return str_repeat("0", 40-$l) . $str;
    }

    public static function format(string $addr): string
    {
        $addr = strtolower(trim($addr));
        if ($addr[0] == '0' and $addr[1] == 'x') {
            $addr = substr($addr, 2);
        }
        $ret = self::lpad($addr);
        $hash = Keccak::hash($ret, 256);

        for ($i = 0; $i < strlen($ret); $i++) {
            if ($ret[$i] < '0' or $ret[$i] > 'f') {
                $ret[$i] = '0';
                continue;
            }
            if ($hash[$i] >= '8' and $ret[$i] > '9') {
                $ret[$i] = strtoupper($ret[$i]);
            }
        }

        return "0x" . $ret;
    }

    public static function validate(string $addr): bool
    {
        return $addr === self::format($addr);
    }
}
