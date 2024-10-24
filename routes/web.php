<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/ex', function() {
	return "exportdata";
});

Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	return "Cleared!";
});
Route::get('/', function () {
	return redirect()->route('routing');
});


Route::get('/test-service', function () {
    $service = app(App\Services\SatuSehatService::class);
    return response()->json(['message' => 'Service is working']);
});

Route::post('getKabupaten','GetController@getKabupaten')->name('get_kabupaten');
Route::post('getKecamatan','GetController@getKecamatan')->name('get_kecamatan');
Route::post('getDesa','GetController@getDesa')->name('get_desa');

Route::group(['prefix'=>'pasien'],function() {
	Route::get('/','PasienController@main')->name('pasien');
	Route::get('/datagrid','PasienController@datagrid')->name('pasienDatagrid');
	Route::post('/cari-pasien', 'PasienController@cariPasien')->name('cariPasienLoket');
	Route::post('/getDatapasien','PasienController@getDatapasien')->name('getDatapasien');
	Route::post('/import', 'PasienController@import')->name('importPasien');
	Route::post('/form','PasienController@form')->name('formpasien');
	Route::post('/save','PasienController@save')->name('savepasien');
	Route::post('/detail','PasienController@detail')->name('detailpasien');
	Route::post('/delete', 'PasienController@delete')->name('deletepasien');
	// Route::get('/delete/all/{id}', 'PasienController@deleteAll')->name('delete-pasien-all');
	// Route::get('/exportPasien','PasienController@export')->name('exportPasien');
});


#tb_terduga 

Route::group(['prefix' => 'tb_terduga'], function() {
    Route::get('/', 'TbTerdugaController@main')->name('tb_terduga');
    Route::get('/datagrid', 'TbTerdugaController@datagrid')->name('terdugaDatagrid');
    Route::post('/cari-pasien', 'TbTerdugaController@cariPasien')->name('cariPasienLoket');
    Route::post('/getDatapasien', 'TbTerdugaController@getDatapasien')->name('getDataTerduga');
    Route::post('/import', 'TbTerdugaController@import')->name('importPasien');
    Route::post('/form', 'TbTerdugaController@form')->name('formterduga');
    Route::post('/save', 'TbTerdugaController@save')->name('saveterduga');
    Route::post('/detail', 'TbTerdugaController@detail')->name('detailterduga');
    Route::post('/delete', 'TbTerdugaController@delete')->name('deleteterduga');
});


#permohonan lab 


Route::group(['prefix'=>'tb_permohonan_lab'],function() {
	Route::get('/','TbPermohonanLabController@main')->name('tb_permohonan_lab');
	Route::get('/datagrid','TbPermohonanLabController@datagrid')->name('tbpermohonanLabDatagrid');
	Route::post('/cari-pasien', 'PasienController@cariPasien')->name('cariPasienLoket');
	Route::post('/getDataPermohonanLab','TbPermohonanLabController@getDataPermohonanLab')->name('getDataPermohonanLab');
	Route::post('/import', 'PasienController@import')->name('importPasien');
	Route::post('/form','TbPermohonanLabController@form')->name('formpermohonanlab');
	Route::post('/save','TbPermohonanLabController@save')->name('savepermohonanlab');
	Route::post('/detail','TbPermohonanLabController@detail')->name('detailpermohonanlab');
	Route::post('/delete', 'TbPermohonanLabController@delete')->name('deletepermohonanLab');
	// Route::get('/delete/all/{id}', 'PasienController@deleteAll')->name('delete-pasien-all');
	// Route::get('/exportPasien','PasienController@export')->name('exportPasien');
});

#hasil Lab 

Route::group(['prefix'=>'hasil_lab'],function() {
	Route::get('/','HasilLabController@main')->name('hasil_lab');
	Route::get('/datagrid','HasilLabController@datagrid')->name('tbHasilLab');
	// Route::post('/cari-pasien', 'HasilLabController@cariPasien')->name('cariPasienLoket');
	// Route::post('/getDataPermohonanLab','HasilLabController@getDataPermohonanLab')->name('getDataPermohonanLab');
	// Route::post('/import', 'HasilLabController@import')->name('importPasien');
	Route::post('/form','HasilLabController@form')->name('formhasillab');
	Route::post('/save','HasilLabController@save')->name('savehasilLab');
	Route::post('/detail','HasilLabController@detail')->name('detailhasilLab');
	Route::post('/delete', 'HasilLabController@delete')->name('deletehasilLab');
	// Route::get('/delete/all/{id}', 'PasienController@deleteAll')->name('delete-pasien-all');
	// Route::get('/exportPasien','PasienController@export')->name('exportPasien');
});


#hasil Diagnosis 

Route::group(['prefix'=>'hasil_diagnosis'],function() {
	Route::get('/','HasilDiagnosisController@main')->name('hasil_diagnosis');
	Route::get('/datagrid','HasilDiagnosisController@datagrid')->name('tbHasilDiagnosis');
	Route::post('/form','HasilDiagnosisController@form')->name('formHasilDiagnosis');
	Route::post('/save','HasilDiagnosisController@save')->name('saveHasilDiagnosis');
	Route::post('/detail','HasilDiagnosisController@detail')->name('detailHasilDiagnosis');

	// // Route::post('/getDataPermohonanLab','HasilLabController@getDataPermohonanLab')->name('getDataPermohonanLab');
	// // Route::post('/import', 'HasilLabController@import')->name('importPasien');
	// Route::post('/form','HasilLabController@form')->name('formhasillab');
	// Route::post('/save','HasilLabController@save')->name('savehasilLab');
	// Route::post('/detail','HasilLabController@detail')->name('detailhasilLab');
	// Route::post('/delete', 'HasilLabController@delete')->name('deletehasilLab');
	// Route::get('/delete/all/{id}', 'PasienController@deleteAll')->name('delete-pasien-all');
	// Route::get('/exportPasien','PasienController@export')->name('exportPasien');
});


# Search pasien by nik

Route::post('/search-pasien-nik', 'GetController@searchDataPasienByNik')->name('searchDataPasienByNik');
Route::post('/choose-pasien-nik', 'GetController@chooseDataPasien')->name('chooseDataPasien');