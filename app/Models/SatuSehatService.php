<?php

namespace App;

use GuzzleHttp\Exception\RequestException;
use Mediator\SatuSehat\Lib\Client\Api\SubmitDataApi;
use Mediator\SatuSehat\Lib\Client\Configuration;
use Mediator\SatuSehat\Lib\Client\Model\AddressPatient;
use Mediator\SatuSehat\Lib\Client\Model\Condition;
use Mediator\SatuSehat\Lib\Client\Model\Patient;
use Mediator\SatuSehat\Lib\Client\OAuthClient;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\Terduga;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\PermohonanLab;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\HasilLab;

class SatuSehatService
{
    protected $apiInstance;

    public function __construct()
    {
        $clientId = 'EgBGlnIM5DLceDLl9cKBbsQa6PIaOGArwMCr5zSuJYkURUve';
        $clientSecret = 'NsL0ECP9LBTptVrqwPv9kdeRVpFwBhR13pjsFS52RTmYmQvjTCT4TenEO6RwbSuc';

        Configuration::setConfigurationConstant(
            'development',
            new \Mediator\SatuSehat\Lib\Client\ConfigurationConstant(
                authUrl: 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken',
                tokenUrl: 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/refreshtoken',
                baseUrl: 'https://mediator-satusehat.kemkes.go.id/api-dev/satusehat/rme/v1.0',
                clientId: $clientId,
                clientSecret: $clientSecret,
                bearerToken: 'RVWrblJr9uS1PHE5JGxLNIeLWpEK',
                timezone: '+07:00',
            )
        );

        $this->apiInstance = new SubmitDataApi(
            new OAuthClient(Configuration::getDefaultConfiguration())
        );
    }

    public function createTerduga(array $data)
    {
        $terduga = new Terduga($this->apiInstance);

        $terduga->setProfile($data['profile']);
        $terduga->setOrganizationId($data['organization_id']);
        $terduga->setLocationId($data['location_id']);
        $terduga->setPractitionerNik($data['practitioner_nik']);

        $patient = new Patient();
        $patient->setNik($data['patient']['nik']);
        $patient->setName($data['patient']['name']);
        $patient->setBirthDate($data['patient']['birthDate']);
        $patient->setAddress([new AddressPatient($data['patient']['address'][0])]);
        
        $terduga->setPatient($patient);
        $terduga->setTbSuspect($data['tb_suspect']);
        $terduga->setEncounter($data['encounter']);
        $terduga->setCondition(array_map(function($condition) {
            return new Condition($condition);
        }, $data['condition']));

        $terduga->validate();

        try {

        $response = $terduga->send();
        return $response;
            
        }
        catch (RequestException $e) {
        return [
            'error' => true,
            'message' => json_decode($e->getResponse()->getBody()->getContents(), true)
        ];
    }

    }

    public function createPermohonanLab(array $data)
    {

         // Data JSON yang dihardcode
    $data = [
        "profile" => ["TB"],
        "organization_id" => "100011961",
        "location_id" => "ef011065-38c9-46f8-9c35-d1fe68966a3e",
        "practitioner_nik" => "N10000001",
        "patient" => [
            "nik" => "3515126510190001",
            "name" => "FAUZIA HAYZA AHMAD",
            "birthDate" => "2019-10-25"
        ],
        "tb_suspect" => [
            "id" => "2405101601149056",
            "person_id" => "1000001601149056",
            "fasyankes_id" => "1000119617",
            "jenis_fasyankes_id" => "1",
            "terduga_tb_id" => "1"
        ],
        "encounter" => [
            "encounter_id" => "83ef7e32-64f3-40a7-87c4-3cc59d44b4c6",
            "local_id" => "2024-05-24 09:27:26.405593+07",
            "classification" => "AMB",
            "period_start" => "2024-05-24T09:28:01+07:00",
            "period_in_progress" => "2024-05-24T09:58:01+07:00",
            "period_end" => "2024-05-24T10:58:01+07:00"
        ],
        "condition" => [
            [
                "code_condition" => "Z10"
            ]
        ]
    ];
        // var_dump($data['service_request']);die;
        $permohonanLab = new PermohonanLab($this->apiInstance);

        $permohonanLab->setProfile("TB");
        // $permohonanLab->setOrganizationId("100011961");
        // $permohonanLab->setLocationId("ef011065-38c9-46f8-9c35-d1fe68966a3e");
    //     $permohonanLab->setPractitionerNik("N10000001");

    //     $patient = new Patient();
    //     $patient->setNik("3515126510190001");
    //     $patient->setName("FAUZIA HAYZA AHMAD");
    //     $patient->setBirthDate("2019-10-25");
    //     // $patient->setAddress([new AddressPatient($data['patient']['address'][0])]);

    //     $permohonanLab->setPatient($patient);
    //     // $permohonanLab->setTbSuspect($data['tb_suspect']);
    //     $permohonanLab->setTbSuspect([
    //     "id" => "2405101601149056",
    //     "person_id" => "1000001601149056",
    //     "fasyankes_id" => "1000119617",
    //     "jenis_fasyankes_id" => "1",
    //     "terduga_tb_id" => "1",
    //     "terduga_ro_id" => null,
    //     "tipe_pasien_id" => "1"
    // ]);
    //     $permohonanLab->setEncounter([
    //     "encounter_id" => "83ef7e32-64f3-40a7-87c4-3cc59d44b4c6",
    //     "local_id" => "2024-05-24 09:27:26.405593+07",
    //     "classification" => "AMB",
    //     "period_start" => "2024-05-24T09:28:01+07:00",
    //     "period_in_progress" => "2024-05-24T09:58:01+07:00",
    //     "period_end" => "2024-05-24T10:58:01+07:00"
    // ]);
    // $permohonanLab->setCondition(array_map(function($condition) {
    //     return new Condition($condition);
    // }, $data['condition']));
    //     $permohonanLab->setTanggalPermohonan($data['tanggal_permohonan']);
    //     $permohonanLab->setDokterPengirim($data['pengirim']);    
    //     $permohonanLab->setFaskesTunjuan($data['faskes_tujuan']);
    //     $permohonanLab->setTanggalWaktuPengambilanContohUji($data['tanggal_pengambilan']);
    //     $permohonanLab->setTanggalWaktuPengirimanContohUji($data['tanggal_pengiriman']);
    //     $permohonanLab->setAlasanPemeriksaan($data['alasan_pemeriksaan']);
    //     $permohonanLab->setDugaanLokasiAnatomi($data['lokasi_anatomi']);
    //     $permohonanLab->setJenisPemeriksaan($data['jenis_pemeriksaan']);
    //     $permohonanLab->setJenisContohUji($data['contoh_uji']);
        $permohonanLab->build();

        // $permohonanLab->validate();
        $permohonanLab->validate();

        try {
            $response = $permohonanLab->send();
            return $response;
        } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => json_decode($e->getResponse()->getBody()->getContents(), true)
        ];
    }




    }
}