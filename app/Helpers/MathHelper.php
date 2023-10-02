<?php

namespace App\Helpers;

use Illuminate\Support\Exceptions\MathException;

class MathHelper {

    public static function getPercentage($fraction, $total, $decimals = 2) {
        if ($decimals > 12)
            throw new MathException('Max decimal places allowed is 12');

        $percentage = (($fraction / $total) * 100);

        return number_format($percentage, $decimals);
    }
}