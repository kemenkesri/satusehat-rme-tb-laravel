<?php

namespace App\Http\Controllers\Mediator;

use App\Contracts\TBInterface;
use App\Http\Controllers\Controller;
use App\Models\SatuSehat;
use App\Models\TbPermohonanLab;
use App\Models\TbTerduga;
use App\Services\MediatorService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Mediator\SatuSehat\Lib\Client\ApiException;
use Mediator\SatuSehat\Lib\Client\Model\AddressPatient;
use Mediator\SatuSehat\Lib\Client\Model\EpisodeOfCare;
use Mediator\SatuSehat\Lib\Client\Model\Patient;
use Mediator\SatuSehat\Lib\Client\Model\SatuSehatResponse;
use Mediator\SatuSehat\Lib\Client\Model\SubmitResponse;
use Mediator\SatuSehat\Lib\Client\Model\TbSuspect;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\Diagnosis;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\HasilLab;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\PermohonanLab;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\Terduga;

use Mediator\SatuSehat\Lib\Client\Profiles\ValidationException;

class MediatorController extends Controller
{

    public function terdugaTb(Request $request, TbTerduga $tbTerduga)
    {
        $patient = new Patient(); // TODO: cannot be hardcoded
        $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
        $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
        $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded
        $patient->setAddress([new AddressPatient(
            [
                "use" => "temp", // temp = alamat domisili, home = alamat ktp
                // "country" => "id",
                "province" => "35", // kode depdagri 2 digit untuk provinsi
                "city" => "3578", // kode depdagri 4 digit untuk kab/kota
                "district" => "357801", // kode depdagri 6 digit untuk kecamatan
                "village" => "3578011002", // kode depdagri 10 digit untuk kelurahan/desa
                "rt" => "",
                "rw" => "",
                "postal_code" => "-",
                "line" => ["alamat jalan dan informasi lainnya"]
            ]
        )]);

        $tbSuspect = new TBSuspect();
        $tbSuspect
            // ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
            ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
            ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
            ->setTerdugaTbId('1') // todo: diambil dari input /database
            ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
            ->setTipePasienId('1'); //

        /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
        $kunjungan = '2024-05-24 10:27:26.405593+07';
        $service = new MediatorService(
            Terduga::class,
            '10000004',
            'ef011065-38c9-46f8-9c35-d1fe68966a3e',
            'N10000001',
            $kunjungan,
            $tbSuspect,
            $patient
        );
        $response = $service->sendTerdugaTb($request->input());

        if ($response instanceof SubmitResponse) {
            $this->storeSatuSehat($response, $tbTerduga, [
                'kunjungan' => $kunjungan,
                'pasien' => $patient->getNik(),
                'faskes' => '',
            ]);
        }

        return true;
    }

    protected function storeSatuSehat(SubmitResponse $submitResponse, TBInterface $model, array $input)
    {
        /** @var EpisodeOfCare $episodeOfCare */
        $episodeOfCare = $submitResponse->getEpisodeOfCare();
        $suspectTB = $submitResponse->getTbSuspect();

        foreach ($submitResponse->getSatusehat() as $satuSehatResponse) {
            /** @var SatuSehatResponse $satuSehatResponse */
            $data = satuSehatShowData($satuSehatResponse->getLocation());

            $satusehat = new SatuSehat([
                'resource' => $satuSehatResponse->getResourceType(),
                'resource_id' => $satuSehatResponse->getResourceId(),
                'url' => $satuSehatResponse->getLocation(),
                'data' => $data,
                'kunjungan' => $input['kunjungan'],
                'pasien' => $suspectTB->getPersonId(),
                'faskes' => $input['faskes'],
                'table_name' => $model->getModelName(),
                'table_id' => $model->getModelId(),
                'episode_of_care_id' => $episodeOfCare->getId(),
            ]);
            $satusehat->save();
        }

    }

    /**
     * @param Request $request
     * @param TbPermohonanLab $permohonanLabModel
     * @return mixed
     */
    public function permohonanLab(Request $request, TbPermohonanLab $permohonanLabModel)
    {
        $patient = new Patient(); // TODO: cannot be hardcoded
        $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
        $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
        $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded

        $tbSuspect = new TBSuspect();
        $tbSuspect
            ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
            ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
            ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
            ->setTerdugaTbId('1') // todo: diambil dari input /database
            ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
            ->setTipePasienId('1'); //

        /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
        $kunjungan = '2024-05-24 09:27:26.405593+07';
        $service = new MediatorService(
            PermohonanLab::class,
            '10000004',
            'ef011065-38c9-46f8-9c35-d1fe68966a3e',
            'N10000001',
            $kunjungan,
            $tbSuspect,
            $patient
        );
        $response = $service->sendPermohonanLab($request->input());

        if ($response instanceof SubmitResponse) {
            $this->storeSatuSehat($response, $permohonanLabModel, [
                'kunjungan' => $kunjungan,
                'pasien' => $patient->getNik(),
                'faskes' => '',
            ]);
        }

        return true;
    }

    /**
     * @param Request $request
     * @param \App\Models\HasilLab $hasilLabModel
     * @return mixed
     * @throws ApiException
     * @throws GuzzleException
     */
    public function hasilLab(Request $request, \App\Models\HasilLab $hasilLabModel)
    {
        $patient = new Patient(); // TODO: cannot be hardcoded
        $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
        $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
        $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded

        $tbSuspect = new TBSuspect();
        $tbSuspect
            ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
            ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
            ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
            ->setTerdugaTbId('1') // todo: diambil dari input /database
            ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
            ->setTipePasienId('1'); //

        /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
        $kunjungan = '2024-05-24 09:27:26.405593+07';
        $service = new MediatorService(
            HasilLab::class,
            '10000004',
            'ef011065-38c9-46f8-9c35-d1fe68966a3e',
            'N10000001',
            $kunjungan,
            $tbSuspect,
            $patient
        );

        $response = $service->sendHasilLab($request->input());
        if ($response instanceof SubmitResponse) {
            $this->storeSatuSehat($response, $hasilLabModel, [
                'kunjungan' => $kunjungan,
                'pasien' => $patient->getNik(),
                'faskes' => '',
            ]);
        }

        return true;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ApiException
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function hasilDiagnosis(Request $request): mixed
    {
        $patient = new Patient(); // TODO: cannot be hardcoded
        $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
        $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
        $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded

        $tbSuspect = new TBSuspect();
        $tbSuspect
            ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
            ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
            ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
            ->setTerdugaTbId('1') // todo: diambil dari input /database
            ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
            ->setTipePasienId('1'); //

        /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
        $service = new MediatorService(
            Diagnosis::class,
            '10000004',
            'ef011065-38c9-46f8-9c35-d1fe68966a3e',
            'N10000001',
            '2024-05-24 09:27:26.405593+07',
            $tbSuspect,
            $patient
        );
        return $service->sendHasilDiagnosa($request->input());
    }
}
