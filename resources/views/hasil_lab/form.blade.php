
<div id="t207" class="ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-4" role="tabpanel" style="display: block;" aria-expanded="true" aria-hidden="false">
  <div class="accordion">
    <form id="multiStepForm" action="javascript:void(0)" method="POST">
      <!-- Step 1 -->
      <?php
      // echo '<pre>';
      //  die;?>
     @if(isset($pasien))
                        <input type="hidden" name="id" class="form-control" value="{{isset($pasien) ? $pasien->id : ''}}" autocomplete="off">
    @endif
<div class="accordion-item">
    <div class="accordion-header" id="header1">
        <h2>Tambah Informasi Terduga telah ada hasil lab</h2>
        <button type="button" class="toggle-button" data-target="#content1">&#10006;</button>
    </div>
    <div class="accordion-content active" id="content1">
        <div class="form-container">
            <fieldset>
                <!-- No. Sediaan -->
                <div class="form-item">
             

                              @if(isset($pasien))
                                  <input type="hidden" name="id" class="form-control" value="{{ $pasien->id }}" autocomplete="off">
                              @endif
                              <label style="width: 150px;">Pilih Terduga</label>
                              <select id="KD_PELAYANAN" name="KD_PELAYANAN" class="form-control" required>
                                  <option value="">--Pilih Permohonan Lab--</option>
                                  @foreach($patients as $patient)
                                      <option value="{{ $patient->no_sediaan }}">{{ $patient->no_sediaan }}</option>
                                  @endforeach
                              </select>

                </div>

                <!-- Lokasi Anatomi Penyakit -->
                <div class="form-item">
                    <label style="width: 150px;">Lokasi Anatomi Penyakit</label>
                    <select class="form-control" id="lokasi_anatomi" name="lokasi_anatomi"  required>
                      @foreach(\App\LokasiPenyakitAnatomi::getValues() as $key => $value)
                          <option value="{{ $key }}" {{ isset($pasien->lokasi_anatomi) && $key == $pasien->lokasi_anatomi ? 'selected' : '' }}>
                              {{ $value }}
                          </option>
                      @endforeach
                    </select>
                </div>

                <!-- Tanggal Permohonan -->
                <div class="form-item">
                    <label style="width: 150px;">Tanggal Permohonan</label>
                    <input type="date" class="form-control" name="tanggal_daftar"  value="{{isset($pasien) ? date('Y-m-d',strtotime($pasien->tanggal_daftar)) : ''}}" id="tanggal_daftar"  required data-required-msg="Kolom Tanggal Permohonan harus diisi">
                </div>
            </fieldset>

            <!-- Penerima -->
            <div class="form-item">
                                    <label  style="width: 150px;"for="">Penerima</label>
                                       <select name="penerima" id="penerima" class="form-control">
                                            @foreach(\App\DokterPengirim::getValues() as $key => $value)
                                                <option value="{{ $key }}"  {{ isset($pasien->penerima) && $key == $pasien->penerima ? 'selected' : '' }} >{{ $value }}</option>
                                            @endforeach
                                        </select>
            </div>

            <!-- Pemeriksa -->
            <div class="form-item">
                                    <label style="width: 150px;" for="">Pemeriksa</label>
                                       <select name="pemeriksa" id="pemeriksa" class="form-control">
                                            @foreach(\App\DokterPengirim::getValues() as $key => $value)
                                                <option value="{{ $key }}" {{ isset($pasien->pemeriksa) && $key == $pasien->pemeriksa ? 'selected' : '' }} >{{ $value }}</option>
                                            @endforeach
                                        </select>
            </div>

            <fieldset>
                <!-- Jenis Pemeriksaan -->
                <div class="form-item">
                    <label style="width: 150px;">Jenis Pemeriksaan</label>
                    <select id="jenis_pemeriksaan" name="jenis_pemeriksaan" class="form-control" required>
                        @foreach(\App\JenisPemeriksaan::getValues() as $key => $value)
                          <option value="{{ $key }}" {{ isset($pasien->jenis_pemeriksaan) && $key == $pasien->jenis_pemeriksaan ? 'selected' : '' }} >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Contoh Uji Diterima -->
                <div class="form-item">
                    <label style="width: 150px;">Tanggal Contoh Uji Diterima / Konfirmasi Penerimaan</label>
                    <input type="date" class="form-control" value="{{isset($pasien) ? date('Y-m-d',strtotime($pasien->tgl_contoh_uji)) : ''}}" name="tgl_contoh_uji" id="tgl_contoh_uji"  required data-required-msg="Kolom Tanggal Permohonan harus diisi">
                </div>

                <!-- Kondisi Contoh Uji -->
                <div class="form-item">
                    <label class="declabel2" style="width: 150px;">Konfirmasi Penerimaan Contoh Uji</label>
                    <select id="kondisi_contoh_uji_id" class="form-control" name="kondisi_contoh_uji_id"  required>
                        @foreach(\App\KondisiContohUjiId::getValues() as $key => $value)
                          <option value="{{ $key }}"  {{ isset($pasien->kondisi_contoh_uji_id) && $key == $pasien->kondisi_contoh_uji_id ? 'selected' : '' }} >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jenis Contoh Uji -->
                <div class="form-item">
                    <label class="declabel2" style="width: 150px;">Jenis Contoh Uji</label>
                    <select id="contoh_uji" name="contoh_uji" class="form-control"  required>
                        @foreach(\App\JenisContohUji::getValues() as $key => $value)
                          <option value="{{ $key }}" {{ isset($pasien->contoh_uji) && $key == $pasien->contoh_uji ? 'selected' : '' }} >{{ $value }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="contoh_uji_lain" id="contoh_uji_lain" style="display:none;">
                </div>
            </fieldset>

            <!-- Save and Continue -->
            <div class="form-item">
                <button type="button" id="goToStep2">Save and Continue</button>
            </div>
        </div>
    </div>
</div>

      <!-- Step 2 -->
      <div class="accordion-item">
        <div class="accordion-header" id="header2">
          <h2>Hasil Pemeriksaan</h2>
          <button type="button" class="toggle-button" data-target="#content2">◼</button>
        </div>
        <input type="hidden" name="contoh_uji_hidden" id="contoh_uji_hidden">
        <div class="accordion-content" id="content2">
          <div class="card" id="mikroskopis-card" >
            <div class="card-header"> Hasil Pemeriksaan Mikroskopis (BTA/lainnya) </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Contoh Uji</th>
                    <th>No. Reg Lab</th>
                    <th>Tanggal Hasil</th>
                    <th>Hasil Uji</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <select class="form-control">
                        <option value="A">A</option>
                        <option value="B">B</option>
                      </select>
                    </td>
                    <td>
                      <input type="text" name="no_reg_hasil_mikroskopis" value="{{isset($pasien) ? $pasien->no_reg_hasil : ''}}" id="no_reg_hasil_mikroskopis" class="form-control">
                    </td>
                    <td>
                      <input type="date" name="tanggal_hasil_mikroskopis"  value="{{isset($pasien) ? date('Y-m-d',strtotime($pasien->tanggal_hasil)) : ''}}" id="tanggal_hasil_mikroskopis" class="form-control">
                    </td>
                    <td>
                      <select id="hasil_mikroskopis" name="hasil_mikroskopis" class="form-control">
                        <option value=""> Pilih </option>
                        <option value="negatif">negatif</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="1+">1+</option>
                        <option value="2+">2+</option>
                        <option value="3+">3+</option>
                        <option value="tdl">tdl</option>
                      </select>
                    </td>
                    <td>
                      <textarea id="catatan_mikroskopis" name="catatan_mikroskopis" value="{{isset($pasien) ? $pasien->catatan : ''}}"  class="form-control"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p>Keterangan: Neg = Tidak ditemukan BTA dlm 100 LP, 1-9 = Ditemukan 1 – 9 BTA dlm 100 LP, 1+ = Ditemukan 10 – 99 BTA dlm 100 LP, 2+ = Ditemukan 1 – 10 BTA dlm 1 LP, 3+ = Ditemukan &gt; 10 BTA dlm 1 LP, TDL = Tidak Dilakukan</p>
            </div>
          </div>
          <div class="card" id="tcm-card" >
            <div class="card-header"> Hasil Pemeriksaan Xpert (TCM) </div>
            <div class="card-body">
              <table class="table table-bordered" style="border=bold;">
                <thead>
                  <tr>
                    <th>Contoh Uji</th>
                    <th>No. Reg Lab</th>
                    <th>Tanggal Hasil</th>
                    <th>Hasil Uji</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <select class="form-control">
                        <option value="A">A</option>
                        <option value="B">B</option>
                      </select>
                    </td>
                    <td>
                      <input type="text" name="no_reg_hasil_tcm" value="{{isset($pasien) ? $pasien->no_reg_hasil : ''}}" id="no_reg_hasil_tcm" class="form-control">
                    </td>
                    <td>
                      <input type="date" name="tanggal_hasil_tcm" value="{{isset($pasien) ? date('Y-m-d',strtotime($pasien->tanggal_hasil)) : ''}}" id="tanggal_hasil_tcm" class="form-control">
                    </td>
                    <td>
                      <select id="hasil_tcm" name="hasil_tcm" class="form-control">
                        <option value=""> Pilih </option>
                        <option value="negatif">Negatif</option>
                        <option value="rif_sen">Rif Sen</option>
                        <option value="rif_ses">Rif Res</option>
                        <option value="rif_indet">Rif Indet</option>
                        <option value="invalid">INVALID</option>
                        <option value="error">ERROR</option>
                        <option value="no_result">NO RESULT</option>
                        <option value="tdl">TDL</option>
                      </select>
                    </td>
                    <td>
                      <textarea id="catatan_tcm"  value="{{isset($pasien) ? $pasien->catatan : ''}}"  name="catatan_tcm" class="form-control"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p>Keterangan: Neg = Tidak ditemukan BTA dlm 100 LP, 1-9 = Ditemukan 1 – 9 BTA dlm 100 LP, 1+ = Ditemukan 10 – 99 BTA dlm 100 LP, 2+ = Ditemukan 1 – 10 BTA dlm 1 LP, 3+ = Ditemukan &gt; 10 BTA dlm 1 LP, TDL = Tidak Dilakukan</p>
            </div>
          </div>
          <button type="button" id="btn-save">Simpan</button>
        </div>
      </div>
    </form>
  </div>
  <style>
    .table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
      /* Ensures borders do not double */
    }

    .table thead th,
    .table tbody td {
      border: 1px solid #ddd;
      /* Adds border to table cells */
      padding: 8px;
      vertical-align: top;
    }

    .accordion {
      width: 100%;
      margin: 0 auto;
    }

    .accordion-item {
      border: 1px solid #ddd;
      margin-bottom: 10px;
      border-radius: 4px;
    }

    .accordion-header {
      background-color: #f7f7f7;
      padding: 10px 20px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .accordion-header h2 {
      margin: 0;
      font-size: 16px;
    }

    .accordion-content {
      display: none;
      padding: 20px;
      border-top: 1px solid #ddd;
    }

    .accordion-content.active {
      display: block;
    }

    .form-container {
      display: flex;
      flex-wrap: wrap;
    }

    .form-item {
      width: 100%;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
    }

    .form-item label {
      margin-right: 10px;
    }

    .form-item input,
    .form-item select,
    .form-item textarea {
      flex: 1;
    }

    .toggle-button {
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
      padding: 0;
    }
  </style>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
  $('#mikroskopis-card').hide();
  $('#tcm-card').hide();

  // Show the correct table based on the selected value
  $('#jenis_pemeriksaan').on('change', function() {
    var selectedValue = $(this).val();
    if (selectedValue === 'mikroskopis') {
      $('#mikroskopis-card').show();
      $('#tcm-card').hide();
    } else {
      $('#mikroskopis-card').hide();
      $('#tcm-card').show();
    }


  });

$('#btn-save').click(function (e) {
        e.preventDefault();
        var data = new FormData($('#multiStepForm')[0]);
        $('#btn-save').attr('disabled',true);
        $.ajax({
            url : "{{route('savehasilLab')}}",
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

  $('.toggle-button').on('click', function() {
    var targetId = $(this).data('target');
    $(targetId).toggleClass('active');
    // Toggle icon
    if ($(targetId).hasClass('active')) {
      $(this).html('&#10006;'); // X icon
    } else {
      $(this).html('&#9724;'); // Maximize icon (you can change this icon as per your preference)
    }
  });

   $('#goToStep2').on('click', function() {
    var form = $('#multiStepForm')[0];
    if (form.checkValidity()) {
      $('#content1').removeClass('active');
      $('#content2').addClass('active');
    } else {
      form.reportValidity();
    }
  });

    })
</script>
