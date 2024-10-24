<?php

namespace App;

class DokterPengirim
{
    const DOKTER_A = 'Dr. Andi';
    const DOKTER_B = 'Dr. Budi';
    const DOKTER_C = 'Dr. Citra';

    public static function getValues()
    {
        return [
            'N10000001' => self::DOKTER_A,
            'N10000002' => self::DOKTER_B,
            'N10000003' => self::DOKTER_C,
        ];
    }
}

