<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\UserActivity::class,

        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'cs' => \App\Http\Middleware\Cs::class,
        'antrian' => \App\Http\Middleware\Antrian::class,
        'pengguna' => \App\Http\Middleware\Pengguna::class,
        'mst_poli' => \App\Http\Middleware\MstPoli::class,
        'aps' => \App\Http\Middleware\Aps::class,
        'riwayat' => \App\Http\Middleware\Riwayat::class,
        'pemeriksaan' => \App\Http\Middleware\Pemeriksaan::class,
        'identitas' => \App\Http\Middleware\Identitas::class,
        'surat' => \App\Http\Middleware\Surat::class,
        'kotak-saran' => \App\Http\Middleware\KotakSaran::class,
        'kasir' => \App\Http\Middleware\Kasir::class,
        'farmasi' => \App\Http\Middleware\Farmasi::class,
        'dokter' => \App\Http\Middleware\Dokter::class,
        'erm' => \App\Http\Middleware\Erm::class,
        'riwayat_kunjungan_bpjs' => \App\Http\Middleware\RiwayatKunjunganBpjs::class,
        'riwayat_pendaftaran_bpjs' => \App\Http\Middleware\RiwayatPendaftaranBpjs::class,
        'icdx' => \App\Http\Middleware\Icdx::class,
        'icd9' => \App\Http\Middleware\Icd9::class,
        'mst_pelayanan' => \App\Http\Middleware\MstPelayanan::class,
        'mst-pelayanan-laborat' => \App\Http\Middleware\MstPelayananLaborat::class,
        'pasien' => \App\Http\Middleware\Pasien::class,
        'pemanggilan' => \App\Http\Middleware\Pemanggilan::class,
        'info_penyakit' => \App\Http\Middleware\InfoPenyakit::class,
        'hidup_sehat' => \App\Http\Middleware\HidupSehat::class,
        'master-obat' => \App\Http\Middleware\MasterObat::class,
        'droping-obat' => \App\Http\Middleware\DropingObat::class,
        'adj-gudang' => \App\Http\Middleware\AdjGudang::class,
        'adj-farmasi' => \App\Http\Middleware\AdjFarmasi::class,
        'laporan' => \App\Http\Middleware\Laporan::class,
        'aktifitas_system' => \App\Http\Middleware\AktifitasSystem::class,
        'puskesmas' => \App\Http\Middleware\Puskesmas::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'jkn.auth' => \App\Http\Middleware\JwtMiddleware::class,
        'xss' => \App\Http\Middleware\XSS::class,
        'obat_satu_sehat' => \App\Http\Middleware\ObatSatuSehat::class,
        'posyandu' => \App\Http\Middleware\Posyandu::class,
        'pustu' => \App\Http\Middleware\Pustu::class,

    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
