<div id="t207" class="ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-5" role="tabpanel" style="display: block;" aria-expanded="true" aria-hidden="false">
    <div class="card">
        <div class="card-header">
            <h4>Tb terduga</h4>
        </div>
        <div class="card-body">
            <form id="tbcForm" action="javascript:void(0)" method="POST">
                <div class="form-container">


           <div class="form-group">
                    @if(isset($pasien))
                        <input type="hidden" name="id" class="form-control" value="{{ $pasien->id }}" autocomplete="off">
                    @endif
                    <label style="width: 150px;">Pilih Pasien</label>
                    <select id="person_id" name="person_id" class="form-control" required>
                        <option value="">--Pilih Pasien--</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id_pasien }}">{{ $patient->nama_pasien }}</option>
                        @endforeach
                    </select>
                </div>



                    <div class="form-group">
                        @if(isset($pasien))
                        <input type="hidden" name="id" class="form-control" value="{{isset($pasien) ? $pasien->id : ''}}" autocomplete="off">
                        @endif
                        <label style="width: 150px;">Tipe Pasien TB </label>
                        <select id="tipe_pasien_id" name="tipe_pasien_id" class="form-control" required>
                                 <option value="">--Pilih Tipe Pasien--</option>
                                   <option value="1" selected="">Baru</option>
                                   <option value="2">TBC Ekstra Paru</option>
                                   <option value="3">Diobati setelah gagal kategori 1</option>
                                   <option value="4">Diobati setelah gagal kategori 2</option>
                                   <option value="5">Diobati setelah putus berobat</option>
                                   <option value="6">Diobati setelah gagal pengobatan lini 2</option>
                                   <option value="7">Pernah diobati tidak diketahui hasilnya</option>
                                   <option value="8">Tidak diketahui</option>
                                   <option value="9">Lain-lain</option>
                                   <option value="10">Diobati setelah gagal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="width: 150px;">Kriteria TB </label>
                        <select id="terduga_tb_id" name="terduga_tb_id" class="form-control" required>
                                 <option value="">--Pilih Tipe Pasien--</option>
                                   <option value="1" selected="">Terduga TB SO</option>
                                   <option value="2">Terduga TB RO</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="width: 150px;">Riwayat DM </label>
                        <select id="status_dm_id" name="status_dm_id" class="form-control" required>
                               <option value="1">Ya</option>
                                  <option value="2">Tidak</option>
                                  <option value="3" selected="">Tidak Diketahui</option>
                        </select>
                    </div>

                      <div class="form-group">
                        <label style="width: 150px;">Imunisasi BCG </label>
                        <select id="imunisasi_bcg_id" name="imunisasi_bcg_id" class="form-control" required>
                               <option value="1">Ya</option>
                                  <option value="2">Tidak</option>
                                  <option value="3" selected="">Tidak Diketahui</option>
                        </select>
                    </div>

                               <div class="form-group">
                        <label style="width: 150px;">HIV</label>
                        <select id="status_hiv_id" name="status_hiv_id" class="form-control" required>
                               <option value="1">Ya</option>
                                  <option value="2">Tidak</option>
                                  <option value="3" selected="">Tidak Diketahui</option>
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
    
    document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('nama_pasien');
            const suggestions = document.getElementById('suggestions');

            input.addEventListener('input', async function () {
                const query = this.value;

                // Hapus saran lama
                suggestions.innerHTML = '';

                if (query.length < 2) return; // Mulai menampilkan saran setelah 2 karakter

                try {
                    // Fetch data dari backend
                    const response = await fetch(`/autocomplete/pasien?query=${query}`);
                    const data = await response.json();

                    // Menampilkan hasil
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.textContent = item.nama_pasien;
                        div.setAttribute('data-id', item.id_pasien);

                        // Event saat saran diklik
                        div.addEventListener('click', function () {
                            input.value = this.textContent;
                            suggestions.innerHTML = ''; // Bersihkan dropdown
                        });

                        suggestions.appendChild(div);
                    });
                } catch (error) {
                    console.error('Error fetching suggestions:', error);
                }
            });

            // Menyembunyikan dropdown saat klik di luar elemen
            document.addEventListener('click', function (e) {
                if (!input.contains(e.target) && !suggestions.contains(e.target)) {
                    suggestions.innerHTML = '';
                }
            });
        });
    $(document).ready(function(){

     
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

          // Debugging: Log form data
    for (var [key, value] of data.entries()) {
        console.log(key + ': ' + value);
    }
        $('#btn-save').attr('disabled',true);
        $.ajax({
            url : "{{route('saveterduga')}}",
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