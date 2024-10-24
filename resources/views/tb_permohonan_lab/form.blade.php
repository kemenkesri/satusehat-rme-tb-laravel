<style>
	.error{
		color: red !important;
	}
</style>


<div class="container-fluid" id="form-scroll">
	<div class="row">
		<div class="col-md-12">

			<div class="card strpied-tabled-with-hover main-layer">
				<div class="card-header ">
					<h4>
						{{$menu}}
						<button type="button" class="btn btn-info float-right btnCaPas" data-toggle="modal" data-target="#detail-dialog">
							<i class="fa fa-search"></i> Cari Data Permohonan Lab
						</button>
					</h4>
				</div>
				<div class="card-body">
					<form id="commentFormPasien" action="javascript:void(0)" method="post">
						{{csrf_field()}}
						@if(isset($pasien))
						<input type="hidden" name="id" class="form-control" value="{{isset($pasien) ? $pasien->id : ''}}" autocomplete="off">
						@endif
						<div class="row">
							<div class="col-lg-6">


					           <div class="form-group">
					                    @if(isset($pasien))
					                        <input type="hidden" name="id" class="form-control" value="{{ $pasien->id }}" autocomplete="off">
					                    @endif
					                    <label style="width: 150px;">Pilih Terduga</label>
					                    <select id="no_sediaan" name="no_sediaan" class="form-control" required>
					                        <option value="">--Pilih Terduga--</option>
					                        @foreach($patients as $patient)
					                            <option value="{{ $patient->no_sediaan }}">{{ $patient->no_sediaan }}</option>
					                        @endforeach
					                    </select>
					                </div>

							</div>
							<div class="col-lg-6">
								<div class="form-group nik-input">
											<label for="">Lokasi Anatomi Penyakit</label>
									<select name="lokasi_anatomi" id="lokasi_anatomi" class="form-control">
									    @foreach(\App\LokasiPenyakitAnatomi::getValues() as $key => $value)
									        <option value="{{ $key }}" {{ isset($pasien->lokasi_anatomi) && $key == $pasien->lokasi_anatomi ? 'selected' : '' }}>
									            {{ $value }}
									        </option>
									    @endforeach
									</select>
								</div>
							</div>                            
						</div>
                        <div class="row">
                        	<div class="col-lg-6">
	                        	<div class="form-group" style="position: relative;">
										<label for="">Tanggal Permohonan <small style="color: red;">*</small></label>
										<input type="text" name="tanggal_permohonan" id="tanggal_permohonan" autocomplete="off" class="form-control tgl_permohonan" value="{{isset($pasien) ? $pasien->tanggal_permohonan : ''}}">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Dokter Pengirim</label>
									   <select name="pengirim" id="pengirim" class="form-control">
								            @foreach(\App\DokterPengirim::getValues() as $key => $value)
								                <option value="{{ $key }}" {{  isset($pasien->pengirim) && $key == $pasien->pengirim ? 'selected' : '' }}>{{ $value }}</option>
								            @endforeach
								        </select>
								</div>
							</div>
                        </div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Alasan Pemeriksaan</label>
							       <select name="alasan_pemeriksaan" id="alasan_pemeriksaan" class="form-control">
							            @foreach(\App\AlasanPemeriksaan::getValues() as $key => $value)
							                <option value="{{ $key }}" {{ isset($pasien->alasan_pemeriksaan) && $key == $pasien->alasan_pemeriksaan ? 'selected' : '' }}>{{ $value }}</option>
							            @endforeach
							        </select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Jenis Pemeriksaan</label>
							        <select name="jenis_pemeriksaan" id="jenis_pemeriksaan" class="form-control">
							            @foreach(\App\JenisPemeriksaan::getValues() as $key => $value)
							                <option value="{{ $key }}" {{ isset($pasien->jenis_pemeriksaan) &&  $key == $pasien->jenis_pemeriksaan ? 'selected' : '' }}>{{ $value }}</option>
							            @endforeach
							        </select>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Jenis Contoh Uji </label>
								        <select name="contoh_uji" id="contoh_uji" class="form-control">
								            @foreach(\App\JenisContohUji::getValues() as $key => $value)
								                <option value="{{ $key }}" {{  isset($pasien->contoh_uji) && $key == $pasien->contoh_uji ? 'selected' : '' }}>{{ $value }}</option>
								            @endforeach
								        </select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Tanggal Pengambilan Contoh Uji</label>
										<input type="text" name="tanggal_pengambilan" id="tanggal_pengambilan" autocomplete="off" class="form-control tanggal_pengambilan" value="{{isset($pasien) ? $pasien->tanggal_pengambilan : ''}}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="">Tanggal Pengiriman Contoh Uji</label>
										<input type="text" name="tanggal_pengiriman" id="tanggal_pengiriman" autocomplete="off" class="form-control tanggal_pengiriman" value="{{isset($pasien) ? $pasien->tanggal_pengiriman : ''}}">
								</div>
							</div>
						</div>						
						<div class="float-right mt-3">
							<a href="javascript:void(0)" onclick="kembali()" class="btn btn-primary btn-sm">Kembali</a>
							<button type="button" class="btn btn-success bg-success btn-sm" id="btn-save">{{isset($pasien) ? 'Ubah' : 'Simpan'}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Start Modal -->
<div class="modal fade" id="detail-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header modalHeaderGreen">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div>
					<!-- <form> -->
						<div class="from-group">
							<div class="row">
								<div class="col-md-5">
									<label>MASUKKAN NAMA</label>
                                    <br>
									<input type="text" name="namaModal" class="form-control" id="namaModal">
								</div>
								<div class="col-md-5">
									<label>MASUKKAN NIK</label>
                                    <br>
									<input type="text" name="nikModal" class="form-control" id="nikModal"> <br>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-info btn-cari-pas" style="margin-top: 40px;">
										<i class="fa fa-search" aria-hidden="true"></i>
									</button>
								</div>
							</div>

						</div>
					<!-- </form> -->
				</div>
				<section class="card card-default m-b-0">
					<div class="card-body" style="overflow-y: scroll;height: 400px;">
						<table border="1" class="blok">
							<thead>
								<tr>
									<th width="100" ondblclick="nik()"></th>
									<th width="100">NIK</th>
									<th width="200" ondblclick="nama()">Nama Pasien</th>
									<th width="110" ondblclick="nobpjs()">No. Asuransi</th>
									<th width="300">Alamat</th>
									<th width="75">Jenis kel</th>
								</tr>
							</thead>
							<tbody id="result">
								<tr>
									<td contentEditable="true" class="edit">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>

					</div>
				</section>
			</div>
		</div>
	</div>
</div>
<!-- End Modal-->

<script type="text/javascript">
	$(".tgl_lahir").datetimepicker({
		autoclose: true,
		todayBtn: true,
		format: 'yyyy-mm-dd',
		startView: 4,
		minView: 2,
		maxView: 4,
	});

		$(".tgl_permohonan").datetimepicker({
		autoclose: true,
		todayBtn: true,
		format: 'yyyy-mm-dd',
		startView: 4,
		minView: 2,
		maxView: 4,
	});

		$(".tanggal_pengambilan").datetimepicker({
		autoclose: true,
		todayBtn: true,
		format: 'yyyy-mm-dd',
		startView: 4,
		minView: 2,
		maxView: 4,
	});

				$(".tanggal_pengiriman").datetimepicker({
		autoclose: true,
		todayBtn: true,
		format: 'yyyy-mm-dd',
		startView: 4,
		minView: 2,
		maxView: 4,
	});

	$(".tgl_kematian").datetimepicker({
		autoclose: true,
		todayBtn: true,
		format: 'yyyy-mm-dd',
		startView: 4,
		minView: 2,
		maxView: 4,
	});

	$(".btn-cari-pas").click(function(){
		var nama = $('#namaModal').val();
		var nik = $('#nikModal').val();
		reloadDataPasien(nama,nik);
	});

	function reloadDataPasien(nama, nik) {
		$.post("{!! route('cariPasienLoket') !!}",{nama:nama, nik:nik}).done(function(result){
			if(result.status == 'success'){
				$('#result').empty();
				$('.pagination').empty();

				if(result.data.length > 0){
					var dat = '';
					$.each(result.data, function(c,v){
						var nik = $('#nik_'+v.nik_pasien+'').val();
						var nama = (v.nama_pasien) ? v.nama_pasien  : '-';
						var noBpjs = (v.no_asuransi_pasien) ? v.no_asuransi_pasien:'0';
						var alamat = (v.alamat_pasien) ? v.alamat_pasien:'-';
						var jKelamin = (v.jenis_kelamin) ? v.jenis_kelamin:'-';
						var klik = "'"+v.nik_pasien+"','"+nama+"'";
						dat += '<tr data-id="'+nik+'"><td onclick="getdata('+klik+')"><center><button class="btn btn-sm btn-success" type="button"><i class="fa fa-plus-circle"></i></button></center></td>'+
							'<td data-name="nik" class="edit'+v.nik_pasien+'" ondblclick="editt('+klik+')">'+v.nik_pasien+' <input id="nik_'+v.nik_pasien+'" readonly type="hidden" value="'+v.nik_pasien+'"></td>'+
							'<td>'+nama+'</td>'+
							'<td>'+noBpjs+'</td>'+
							'<td>'+alamat+'</td>'+
							'<td>'+jKelamin+'</td><tr>';
					});
				}else{
					dat += '<tr><td>&nbsp;</td>'+
						'<td>&nbsp;</td>'+
						'<td>&nbsp;</td>'+
						'<td>&nbsp;</td>'+
						'<td>&nbsp;</td><tr>';
				}
				$('.btn-cari-pas').html('<i class="fa fa-search" aria-hidden="true"></i>').attr('disabled',false)
				$('#result').html(dat);
			}else{
				$('.btn-cari-pas').html('<i class="fa fa-search" aria-hidden="true"></i>').attr('disabled',false)
			}
		})
	}

	function getdata(nik,nama){
		swal({
			title: 'KONFIRMASI !',
			type: 'info',
			text: 'Yakin data sudah benar?',
			confirmButtonClass: "btn-primary",
			confirmButtonText: "Yakin",
			cancelButtonText: "Tidak",
			showCancelButton: true,
		}, function (isConfirm) {
			if(isConfirm){
				$.post("{!! route('getDatapasien') !!}",{nik:nik,nama:nama}).done(function(res){
					if(res.status == 'success'){
						var nama = res.data.nama_pasien;
						var nik = res.data.nik_pasien;

						if (res.data.tgl_lahir != null) {
							var tgl = formatDate(res.data.tgl_lahir);
						}else{
							var tgl = '';
						}

						var jnsKelamin = res.data.jenis_kelamin;
						var telp = res.data.no_telepon
						var alamat = res.data.alamat_pasien
						var agama = res.data.agama;
						var ayah = res.data.nama_ayah;
						var ibu = res.data.nama_ibu;
						var pasangan = res.data.nama_pasangan;//add
						var tempatLahir = res.data.tempat_lahir;
						var bpjs = res.data.no_asuransi_pasien;
						var jBpjs = res.data.jenis_asuransi_pasien;
						var prov = res.data.provinsi_id;
						var kab = res.data.kabupaten_id;
						var kec = res.data.kecamatan_id;
						var kel = res.data.desa_id;
						var golDarah = res.data.gol_darah;
						var pekerjaan = res.data.jenis_pekerjaan;
						var suku = res.data.suku;
						var kdPos = res.data.kode_pos;
						var sKewarganegaraan = res.data.status_kewarganegaraan;
						var kewarganegaraan = res.data.kewarganegaraan;
						var pendTerakhir = res.data.pendidikan_terakhir;
						var sPerkawinan = res.data.status_pernikahan;

						console.log(tgl)
						if(prov){
							$('#provinsi').val(prov).change()
							loadDaerah(kab,kec,kel)
						}
						$('#nama_pasien').val(nama);
						$('#nama_pasangan').val(pasangan);//add
						$('#nik_pasien').val(nik);
						$('#kewarganegaraan').val(kewarganegaraan);
						$('#status_kewarganegaraan').val(sKewarganegaraan);
						$('#suku').val(suku);
						$('#no_asuransi_pasien').val(bpjs)
						$('#jenis_asuransi_pasien').val(jBpjs)
						$('#alamat_pasien').val(alamat)
						$('#tempat_lahir').val(tempatLahir)
						$('#tgl_lahir').val(tgl)
						if(agama){
							if(agama.toLowerCase().indexOf("islam") >= 0){
								$('#agama option[value=Islam]').attr('selected','selected')
							}else if(agama.toLowerCase().indexOf("protestan") >= 0){
								$('#agama option[value=Protestan]').attr('selected','selected')
							}else if(agama.toLowerCase().indexOf("katolik") >= 0){
								$('#agama option[value=Katolik]').attr('selected','selected')
							}else if(agama.toLowerCase().indexOf("hindu") >= 0){
								$('#agama option[value=Hindu]').attr('selected','selected')
							}else if(agama.toLowerCase().indexOf("buddha") >= 0){
								$('#agama option[value=Buddha]').attr('selected','selected')
							}else if(agama.toLowerCase().indexOf("Khonghucu") >= 0){
								$('#agama option[value=Khonghucu]').attr('selected','selected')
							}
						}
						if(golDarah){
							if(golDarah.toLowerCase().indexOf("a") >= 0){
								$('#gol_darah').val('A').change()
							}else if(golDarah.toLowerCase().indexOf("b") >= 0){
								$('#gol_darah').val('B').change()
							}else if(golDarah.toLowerCase().indexOf("ab") >= 0){
								$('#gol_darah').val('AB').change()
							}else if(golDarah.toLowerCase().indexOf("o") >= 0){
								$('#gol_darah').val('O').change()
							}
						}
						if(telp){
							$('#no_telepon').val(telp)
						}
						if(jnsKelamin){
							if(jnsKelamin.toLowerCase().indexOf("l") >= 0){
								$('#jenis_kelamin').val('L').change()
							}else if(jnsKelamin.toLowerCase().indexOf("p") >= 0){
								$('#jenis_kelamin').val('P').change()
							}
						}
						$('#jenis_pekerjaan').val(pekerjaan)
						$('#nama_ibu').val(ibu)
						$('#nama_ayah').val(ayah)
						$('#kode_pos').val(kdPos)
						$('#status_pernikahan').val(sPerkawinan);
						$('#pendidikan_terakhir').val(pendTerakhir);
						swal({
							title: 'Berhasil',
							type: 'success',
							text: 'Data Berhasil Di Pilih.',
							showConfirmButton: false,
							showCancelButton: false,
							timer: 1500
						})
					}
				})
			}
		})
	}

	$('#btn-save').click(function (e) {
		e.preventDefault();
		var data = new FormData($('#commentFormPasien')[0]);
		$('#btn-save').attr('disabled',true);
		$.ajax({
			url : "{{route('savepermohonanlab')}}",
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

	$(document).ready(function() {		
		$('.select2').select2();
		$('.format_tanggal').datetimepicker({
			weekStart: 2,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0,
		});

		loadDaerah();

		$('#provinsi').change(function(){
			var id = $('#provinsi').val();
			$.post("{{route('get_kabupaten')}}",{id:id},function(data){
				var kabupaten = '<option value="">..:: Pilih Kabupaten ::..</option>';
				if(data.status=='success'){
					if(data.data.length>0){
						$.each(data.data,function(v,k){
							kabupaten+='<option value="'+k.KD_KABUPATEN+'">'+k.KABUPATEN+'</option>';
						});
					}
				}
				$('#kabupaten').html(kabupaten);
			});
		});

		$('#kabupaten').change(function(){
			var id = $('#kabupaten').val();
			$.post("{{route('get_kecamatan')}}",{id:id},function(data){
				var kecamatan = '<option value="">..:: Pilih Kecamatan ::..</option>';
				if(data.status=='success'){
					if(data.data.length>0){
						$.each(data.data,function(v,k){
							kecamatan+='<option value="'+k.KD_KECAMATAN+'">'+k.KECAMATAN+'</option>';
						});
					}
				}
				$('#kecamatan').html(kecamatan);
			});
		});

		$('#kecamatan').change(function(){
			var id = $('#kecamatan').val();
			$.post("{{route('get_desa')}}",{id:id},function(data){
				var desa = '<option value="">..:: Pilih Desa ::..</option>';
				if(data.status=='success'){
					if(data.data.length>0){
						$.each(data.data,function(v,k){
							desa+='<option value="'+k.KD_KELURAHAN+'">'+k.KELURAHAN+'</option>';
						});
					}
				}
				$('#desa').html(desa);
			});
		});

		$('#commentFormPasien').validate({
			rules:{
				nama_pasien:{
					required:true,
				},
				alamat_pasien:{
					required:true,
				},
				nik_pasien:{
					required:true,
				},
				provinsi_id:{
					required:true,
				},
				kabupaten_id:{
					required:true,
				},
				kecamatan_id:{
					required:true,
				},
				desa_id:{
					required:true,
				},
				no_telepon:{
					required:true,
				},
				jenis_kelamin:{
					required:true,
				},
				tempat_lahir:{
					required:true,
				},
				tgl_lahir:{
					required:true,
				},
				agama:{
					required:true,
				},
				pendidikan_terakhir:{
					required:true,
				},
				riwayat_alergi:{
					required:true,
				},
			},
			messages:{
				nama_pasien:{
					required:'Wajib diisi',
				},
				alamat_pasien:{
					required:'Wajib diisi',
				},
				nik_pasien:{
					required:'Wajib diisi',
				},
				provinsi_id:{
					required:'Wajib diisi',
				},
				kabupaten_id:{
					required:'Wajib diisi',
				},
				kecamatan_id:{
					required:'Wajib diisi',
				},
				desa_id:{
					required:'Wajib diisi',
				},
				no_telepon:{
					required:'Wajib diisi',
				},
				jenis_kelamin:{
					required:'Wajib diisi',
				},
				tempat_lahir:{
					required:'Wajib diisi',
				},
				tgl_lahir:{
					required:'Wajib diisi',
				},
				agama:{
					required:'Wajib diisi',
				},
				pendidikan_terakhir:{
					required:'Wajib diisi',
				},
				puskesmas_id:{
					required:'Wajib diisi',
				},
				riwayat_alergi:{
					required:'Wajib diisi'
				},
			},
		})
	})

	function loadDaerah(kab='',kec='',kel='') {
		var id = $('#provinsi').val();

		// SELECTED KABUPATEN
		var selectedkab = "{{ !empty($kab) ? $kab:'' }}";
		console.log(selectedkab)
		setTimeout(() => {
			if(kab=='-'){
				selectedkab = ''
			}else if(kab){
				selectedkab = kab
			}
			$.post("{{route('get_kabupaten')}}",{id:id},function(data){
				var kabupaten = '<option value="first">..:: Pilih Kabupaten ::..</option>';
				if(data.status=='success'){
					if(data.data.length>0){
						$.each(data.data,function(v,k){
							kabupaten+='<option value="'+k.KD_KABUPATEN+'">'+k.KABUPATEN+'</option>';
						});
					}

					$('#kabupaten').html(kabupaten);
					$('#kabupaten').val((selectedkab?selectedkab:'first')).trigger('change');
				}
			});
		},200)

		var selectedkec = "{{ !empty($kec) ? $kec:'' }}";
		setTimeout(() => {
			// SELECTED KECAMATAN
			if(kec=='-'){
				selectedkec = ''
			}else if(kec){
				selectedkec = kec
			}
				$.post("{{route('get_kecamatan')}}",{id:selectedkab},function(data){
					var kecamatan = '<option value="first">..:: Pilih Kecamatan ::..</option>';
					if(data.status=='success'){
						if(data.data.length>0){
							$.each(data.data,function(v,k){
								kecamatan+='<option value="'+k.KD_KECAMATAN+'">'+k.KECAMATAN+'</option>';
							});
						}
					}

					$('#kecamatan').html(kecamatan);
					$('#kecamatan').val((selectedkec?selectedkec:'first')).trigger('change');
				});
		}, 600);

		var selectedkel = "{{ !empty($kel) ? $kel:'' }}";
		setTimeout(() => {
			// SELECTED DESA/KELURAHAN
			if(kel=='-'){
				selectedkel = ''
			}else if(kel){
				selectedkel = kel
			}
			// if (selectedkel != "" && selectedkel != null) {
				$.post("{{route('get_desa')}}",{id:selectedkec},function(data){
					var desa = '<option value="first">..:: Pilih Desa ::..</option>';
					if(data.status=='success'){
						if(data.data.length>0){
							$.each(data.data,function(v,k){
								desa+='<option value="'+k.KD_KELURAHAN+'">'+k.KELURAHAN+'</option>';
							});
						}
					}

					$('#desa').html(desa);
					$('#desa').val((selectedkel?selectedkel:'first')).trigger('change');
				});
			// }
		}, 1200);
	}

    //deteksi umur untuk nik
    $('#tgl_lahir').on('change.datetimepicker',function(){
        var date = $(this).val();
        var today = new Date();
        var tahunDate = new Date(date);
        var umur = today.getFullYear() - tahunDate.getFullYear();
        if(umur <= 17){
            $('.nik-input').hide();
        }else{
            $('.nik-input').show();
            $('#nik_pasien').focus();
            $('#btn-save').attr('disabled','disabled');
        }
    });


    $('#tgl_permohonan').on('change.datetimepicker',function(){
        var date = $(this).val();
        var today = new Date();
        var tahunDate = new Date(date);
        var umur = today.getFullYear() - tahunDate.getFullYear();
        if(umur <= 17){
            $('.nik-input').hide();
        }else{
            $('.nik-input').show();
            $('#nik_pasien').focus();
            $('#btn-save').attr('disabled','disabled');
        }
    });


    $('input[name="nik_pasien"]').keyup(() => {
        var nik = $('input[name="nik_pasien"]').val();
        if (nik.length < 16) {
            $('#btn-save').attr('disabled','disabled');
            $('.msg-nik').html('Maaf, NOMOR INDUK KTP tidak boleh kurang dari 16');
        } else if (nik.length <= 16) {
            $('input[name="nik_pasien"]').val(nik);
            $('.msg-nik').html('');
            $('#btn-save').removeAttr('disabled');
        } else {
            $('#btn-save').attr('disabled','disabled');
            $('.msg-nik').html('Maaf, NOMOR INDUK KTP tidak boleh lebih dari 16')
        }
    })

	$('input[name="no_asuransi_pasien"]').keyup(() => {
		var no_asuransi_pasien = $('input[name="no_asuransi_pasien"]').val();

		if ($.isNumeric(no_asuransi_pasien)) {
			if (no_asuransi_pasien.length < 13) {
				$('#btn-save').attr('disabled','disabled');
				$('.msg-no_asuransi_pasien').html('Maaf, NOMOR KARTU BPJS tidak boleh kurang dari 13');
			} else if (no_asuransi_pasien.length <= 13) {
				$('input[name="no_asuransi_pasien"]').val(no_asuransi_pasien);
				$('.msg-no_asuransi_pasien').html('');
				$('#btn-save').removeAttr('disabled');
			} else {
				$('#btn-save').attr('disabled','disabled');
				$('.msg-no_asuransi_pasien').html('Maaf, NOMOR KARTU BPJS tidak boleh lebih dari 13')
			}
		}else{
			$('.msg-no_asuransi_pasien').html('Maaf, Nomor Kartu harus Inputan Number')
		}

	})

	$('input[name="nik_pasien"][max]:not([max=""])').on('input', function(ev) {
		var $this = $(this);
		var maxlength = $this.attr('max').length;
		var value = $this.val();
		if (value && value.length >= maxlength) {
			$this.val(value.substr(0, maxlength));
		}
	});

	function formatDate(date) {
		var d = date.split('-'),
		month = '' + d[1],
		day = '' + d[0],
		year = d[2];

		return [year, month, day].join('-');
	}
</script>
