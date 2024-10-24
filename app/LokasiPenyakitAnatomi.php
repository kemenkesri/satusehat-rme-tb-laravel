<?php

namespace App;

class LokasiPenyakitAnatomi
{
    const PTB = 'TBC Paru';
    const EPTB = 'TBC Ekstra Paru';

    public static function getValues()
    {
        return [
            'PTB' => self::PTB,
            'EPTB' => self::EPTB,
        ];
    }
}
