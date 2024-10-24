<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPemeriksaan
{
    const MIKROSKOPIS = 'Pemeriksaan Mikroskopis';
    const TCM = 'Pemeriksaan Xpert (TCM)';

    public static function getValues()
    {
        return [
            'mikroskopis' => self::MIKROSKOPIS,
            'tcm' => self::TCM,
        ];
    }
}
