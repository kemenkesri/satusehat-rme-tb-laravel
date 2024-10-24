<?php

namespace App\Services;

use Mediator\SatuSehat\Lib\Client\Api\SubmitDataApi;
use Mediator\SatuSehat\Lib\Client\Configuration;
use Mediator\SatuSehat\Lib\Client\Model\Patient;
use Mediator\SatuSehat\Lib\Client\Model\TbSuspect;
use Mediator\SatuSehat\Lib\Client\OAuthClient;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\Diagnosis;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\HasilLab;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\PermohonanLab;

abstract class BaseService
{
    /**
     * @var PermohonanLab|Diagnosis|HasilLab
     */
    public $form;
    /**
     * @var SubmitDataApi
     */
    public $apiInstance;
    public $kunjungan;
    public $tbSuspect;
    public $practionerNik;
    public $locationId;
    public $organizationId;
    public $patient;

    public function __construct(
        string    $formClass,
        string    $organizationId,
        string    $locationId,
        string    $practionerNik,
        string    $kunjungan,
        TbSuspect $tbSuspect,
        Patient   $patient
    )
    {
        $this->patient = $patient;
        $this->organizationId = $organizationId;
        $this->locationId = $locationId;
        $this->practionerNik = $practionerNik;
        $this->tbSuspect = $tbSuspect;
        $this->kunjungan = $kunjungan;
        $this->apiInstance = new SubmitDataApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
            new OAuthClient(Configuration::getDefaultConfiguration())
        );
        $this->form = new $formClass($this->apiInstance);
    }

}
