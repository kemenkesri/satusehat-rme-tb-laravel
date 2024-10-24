<?php

namespace App;

class KondisiContohUjiId
{
    const BAIK = 'Baik';
    const BOCOR = 'Bocor';
    const RUSAK = 'Rusak';
    const SAMPLE_TIDAK_DISERAHKAN = 'Sample Tidak Diserahkan';

    public static function getValues()
    {
        return [
            'baik' => self::BAIK,
            'bocor' => self::BOCOR,
            'rusak' => self::RUSAK,
            'sample_tidak_diserahkan' => self::SAMPLE_TIDAK_DISERAHKAN,

        ];
    }
}

