<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisContohUji
{
    const DAHAK_PAGI = 'Dahak pagi';
    const DAHAK_SEWAKTU = 'Dahak sewaktu';
    const LCS = 'LCS';
    const JARINGAN = 'Jaringan';
    const BAJAH = 'Bajah';
    const BILAS_LAMBUNG = 'Bilas lambung';
    const ISOLAT = 'Isolat';
    const LAINNYA = 'Lainnya';

    public static function getValues()
    {
        return [
            'dahak_pagi' => self::DAHAK_PAGI,
            'dahak_sewaktu' => self::DAHAK_SEWAKTU,
            'lcs' => self::LCS,
            'jaringan' => self::JARINGAN,
            'bajah' => self::BAJAH,
            'bilas_lambung' => self::BILAS_LAMBUNG,
            'isolat' => self::ISOLAT,
            'lainnya' => self::LAINNYA,
        ];
    }
}

