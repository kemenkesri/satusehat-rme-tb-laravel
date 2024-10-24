<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mediator\SatuSehat\Lib\Client\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $clientId = 'cf98YLQXGn13zA5JvtaxEamGYz2StpAI4BJD4NiFZPpTeFue';
        $clientSecret = 'klKeKBKgaFiI8hr9bs4OZ0x7XuGtIIg3uie7gXNEnCRxMRzCVZAiJehG4DO0jdVT';

// Optional: if we want to use sub-national mediator (ISL DKI or East Java CenterView)
        Configuration::setConfigurationConstant(
            'development',
            new \Mediator\SatuSehat\Lib\Client\ConfigurationConstant(
                'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken',
                'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/refreshtoken',
                'https://mediator-satusehat.kemkes.go.id/api-dev/satusehat/rme/v1.0',
                'https://mediator-satusehat.kemkes.go.id/api-dev/satusehat/rme/v1.0',
                null,// $clientId,
                null,// $clientSecret,
                '1hwfrilvZYbngNXJoH2zRsQOD8va',
                '+07:00'
            )
        );
    }
}
