
<div id="t207" class="ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-5" role="tabpanel" style="display: block;" aria-expanded="true" aria-hidden="false">
    <div class="card">
        <div class="card-header">
            <h4>Hasil Diagnosis</h4>
        </div>
        <div class="card-body">
            <form id="tbcForm" action="javascript:void(0)" method="POST">
                <div class="form-container">
                    <div class="form-group">
                        <label class="declabel2" style="width: 150px;">Tanggal Hasil Diagnosis</label>
                        <input type="date" name="tanggal_hasil" id="tanggal_hasil" class="form-control" value="{{isset($pasien) ? date('Y-m-d',strtotime($pasien->tanggal_hasil))  : ''}}"  required data-required-msg="Kolom No. Identitas Sediaan harus diisi">
                        <input type="hidden" id="kd_kunjungan_hidden" name="kd_kunjungan_hidden" value="2186450">
                        <input type="hidden" id="kd_puskesmas_hidden" name="kd_puskesmas_hidden" value="P7371010201">
                        <a href="https://devel.sitb.id/newtraining/Download/no_sediaan_help">
                            <img id="no_sediaan_help" src="https://devel.sitb.id/newtraining/themes/default/images/help.gif" title="No. Sediaan">
                        </a>
                        <span class="k-invalid-msg" data-for="no_sediaan"></span>
                    </div>

                    <div class="form-group">
                        <label style="width: 150px;">Lokasi Anatomi Penyakit</label>
                        <select id="lokasi_anatomi" name="lokasi_anatomi" class="form-control" required>
                                        @foreach(\App\LokasiPenyakitAnatomi::getValues() as $key => $value)
                                            <option value="{{ $key }}" {{ isset($pasien->lokasi_anatomi) && $key == $pasien->lokasi_anatomi ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                        </select>
                    </div>

                    <div>
                        <span>Foto Thoraks</span>
                        <div class="form-group">
                            <label>Hasil Pemeriksaan Thorax</label>
                            <select id="hasil_pemeriksaan" name="hasil_pemeriksaan" class="form-control">
                                <option value="">Pilih hasil</option>
                                <option value="positif">Positif</option>
                                <option value="negatif">Negatif</option>
                                <option value="TDL">Tidak dilakukan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pemeriksaan Thorax</label>
                            <input type="date" name="thorax_tanggal" id="thorax_tanggal" class="form-control"  required data-required-msg="Kolom Tanggal Permohonan harus diisi"  value="{{isset($pasien) ? date('Y-m-d',strtotime($pasien->thorax_tanggal))  : ''}}" >
                        </div>

                        <div class="form-group">
                            <label class="declabel2">Kesan Thorax</label>
                            <input type="text" name="thorax_kesan" id="thorax_kesan" class="form-control"  required data-required-msg="Kolom No. Identitas Sediaan harus diisi"   value="{{isset($pasien) ? $pasien->thorax_kesan  : ''}}">
                        </div>
                    </div>

                    <div>
                        <span>Diagnosis</span>
                        <div class="form-group">
                            <label class="declabel2" style="width: 150px;">Hasil Diagnosis</label>
                            <select id="hasil_diagnosis" name="hasil_diagnosis" class="form-control"  required>
                                <option value="1">TBC SO</option>
                                <option value="2">TBC RO</option>
                                <option value="3">Bukan TBC</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="declabel2" style="width: 150px;">Tipe Diagnosis</label>
                            <select id="tipe_diagnosis" name="tipe_diagnosis" class="form-control"  required>
                                <option value="tb-bac">Terkonfirmasi bakteriologis</option>
                                <option value="tb-clin">Terdiagnosis klinis</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="declabel2" style="width: 150px;">Tindak Lanjut Hasil Diagnosis</label>
                            <select id="tindak_lanjut" name="tindak_lanjut" class="form-control"  required>
                                <option value="0">Belum Mulai Pengobatan</option>
                                <option value="1">Akan diobati/dirujuk</option>
                                <option value="2">Lost to follow up sebelum Pengobatan</option>
                                <option value="3">Meninggal Sebelum Pengobatan</option>
                                <option value="4">Menolak Pengobatan</option>
                                <option value="5">Pengobatan Pencegahan</option>
                                <option value="6">Melanjutkan Pengobatan Sebelumnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="declabel2" style="width: 150px;">Tempat Pengobatan</label>
                        <select id="tempat_pengobatan" name="tempat_pengobatan" class="form-control" required>
                            <option value="1">Tidak Dirujuk</option>
                            <option value="2" disabled>Dirujuk ke Fasyankes</option>
                        </select>
                    </div>
                </div>
                <div class="button-container">
                    <button type="button" id="btn-save" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Kembali</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-item {
            display: flex;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-item label {
            margin-right: 10px;
        }

        .form-item input[type="text"],
        .form-item input[type="date"],
        .form-item select,
        .form-item div {
            flex: 1;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){

        // define logic tampil berdasarkan hasil pemlihan input hasil 

        function toggleThoraxFields() {
            var resultValue = $('#hasil_pemeriksaan').val();
            if (resultValue === 'TDL') {
                // $('#thorax_tanggal').closest('.form-group').hide();
                // $('#thorax_kesan').closest('.form-group').hide();
                  $('#thorax_tanggal').prop('disabled', true);
                  $('#thorax_kesan').prop('disabled', true);
            } else {
                // $('#thorax_tanggal').closest('.form-group').show();
                // $('#thorax_kesan').closest('.form-group').show();
                  $('#thorax_tanggal').prop('disabled', false);
                  $('#thorax_kesan').prop('disabled', false);
            }
        }
  
        $('#btn-save').click(function (e) {
        e.preventDefault();
        var data = new FormData($('#tbcForm')[0]);
        $('#btn-save').attr('disabled',true);
        $.ajax({
            url : "{{route('saveHasilDiagnosis')}}",
            type: "POST",
            data: data,
            contentType : false,
            processData: false
        }).done(function(data) {
            if (data.code==200) {
                swal(data.head_message,data.message,data.type);
                @if($jenis == 'antrian')
                $('.other-form').html('');
                pilih_pasien(data.data.id_pasien,data.data.nama_pasien);
                @else
                $('.other-page').fadeOut(function(){
                    $('.other-page').empty();
                    $('.main-layer').fadeIn();
                    $('#datatabel').DataTable().ajax.reload();
                });
                @endif
            } else if(data.code==240) {
                var nama = data.data.nama_pasien;
                var nik = data.data.nik_pasien;
                var noKa = data.data.no_asuransi_pasien;
                var dialog = '<p>Atas Nama :' +nama+'</p><br>'+'<p>NIK :' +nik+'</p><br>'+'<p>No. Asuransi :' +noKa+'</p><br>';
                swal({
                    html  : true,
                    title : data.message,
                    text  : dialog,
                    icon  : "info",
                    button : true,
                });
            } else{
                swal(data.head_message,data.message,data.type);
            }
            $('#btn-save').attr('disabled',false);
        }).fail(()=>{
            $('#btn-save').attr('disabled',false);
        })
    });

        function toggleDiagnosis() {
            var resultValue = $('#hasil_diagnosis').val();
            if (resultValue === '3') {
                // $('#thorax_tanggal').closest('.form-group').hide();
                // $('#thorax_kesan').closest('.form-group').hide();
                  $('#tipe_diagnosis').prop('disabled', true);
                  $('#tindak_lanjut').prop('disabled', true);
                  $('#tempat_pengobatan').prop('disabled', true);

            } else {
                // $('#thorax_tanggal').closest('.form-group').show();
                // $('#thorax_kesan').closest('.form-group').show();
                  $('#tipe_diagnosis').prop('disabled', false);
                  $('#tindak_lanjut').prop('disabled', false);
                  $('#tempat_pengobatan').prop('disabled', false);
            }
        }
  

       // Panggil fungsi setiap kali ada perubahan pada input result
        $('#hasil_pemeriksaan').change(function() {
            toggleThoraxFields();
        });


       // Panggil fungsi setiap kali ada perubahan pada input result
        $('#hasil_diagnosis').change(function() {
            toggleDiagnosis();
        });

    });
</script>