<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="card strpied-tabled-with-hover main-layer">
				<div class="card-header ">
					<h5>{{$menu}}</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped table-hover">
						<tr>
							<td>Kode Pasien <small>(No RM Pasien)</small></td>
							<td> <b>: </b>{{$pasien->kode_puskesmas.$pasien->kd_pasien}}</td>
						</tr>
						<tr>
							<td>Nama Pasien <small>(Nama Lengkap)</small></td>
							<td> <b>: </b>{{$pasien->nama_pasien}}</td>
						</tr>
						<tr>
							<td>Puskesmas</td>
							<td> <b>: </b>{{$pasien->nama_puskesmas}}</td>
						</tr>						
						<tr>
							<td>Kode Faskes</td>
							<td> <b>: </b>{{$pasien->kode_faskes}}</td>
						</tr>						
						<tr>
							<td>Jenis Kelamin</td>
							<td><b>: </b>@if ($pasien->jenis_kelamin == "P")
                                Perempuan @else Laki-laki @endif</td>
						</tr>						
						<tr>
							<td>Alamat Lengkap</td>
							<td><b>: </b>{{$pasien->alamat_pasien}}, Desa.{{($pasien->desa_id) ? $pasien->mst_kelurahan->KELURAHAN : ''}}, Kec.{{($pasien->kecamatan_id) ? $pasien->mst_kecamatan->KECAMATAN : ''}}<br>
                                Kab.{{($pasien->kabupaten_id) ? $pasien->mst_kabupaten->KABUPATEN : ''}}, Prov.{{($pasien->provinsi_id) ? $pasien->mst_provinsi->PROVINSI : ''}}
                            </td>												
						</tr>
						<tr>
							<td>NIK</td>
							<td><b>: </b>{{$pasien->nik_pasien}}</td>
						</tr>						
						<tr>
							<td>No Telp</td>
							<td><b>: </b>{{$pasien->no_telepon}}</td>
						</tr>
						<tr>
							<td>Jenis No Telp</td>
							<td> <b>:</b>{{$pasien->jenis_no_telepon}}</td>
						</tr>
						<tr>
							<td>Email Pasien</td>
							<td> <b>: </b>{{$pasien->surat_elektronik}}</td>
						</tr>
						<tr>
							<td>Gol Darah</td>
							<td> <b>: </b>{{$pasien->gol_darah}}</td>
						</tr>
						{{-- <tr>
							<td>Jenis Kelamin</td>
							<td> <b>: </b>{{$pasien->jenis_kelamin}}</td>
						</tr> --}}
						<tr>
							<td>Tempat, Tanggal Lahir</td>
							<td> <b>: </b>{{$pasien->tempat_lahir}}, {{$pasien->tgl_lahir}}</td>
						</tr>
						<tr>
							<td>Usia</td>
							<td> <b>: </b>{{$pasien->usia}}</td>
						</tr>
						<tr>
							<td>Agama</td>
							<td> <b>:</b>{{$pasien->agama}}</td>
						</tr>
						<tr>
							<td>Riwayat Alergi</td>
							<td> <b>:</b>{{$pasien->riwayat_alergi}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card strpied-tabled-with-hover main-layer">
				<div class="card-header ">
					<h5>Data Lain & Keluarga Pasien</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped table-hover">
						<tr>
							<td>Jenis Pekerjaan</td>
							<td> <b>: </b>{{$pasien->jenis_pekerjaan}}</td>
						</tr>
						<tr>
							<td>Pendidikan Terakhir</td>
							<td> <b>: </b>{{$pasien->pendidikan_terakhir}}</td>
						</tr>
						<tr>
							<td>Suku</td>
							<td> <b>: </b>{{$pasien->suku}}</td>
						</tr>
						<tr>
							<td>Kewarganegaraam</td>
							<td> <b>: </b>{{$pasien->kewarganegaraan}}</td>
						</tr>
						<tr>
							<td>Status Kewarganegaraan</td>
							<td> <b>: </b>{{$pasien->status_kewarganegaraan}}</td>
						</tr>
						<tr>
							<td>No Asuransi</td>
							<td> <b>: </b>{{$pasien->no_asuransi_pasien}}</td>
						</tr>
						<tr>
							<td>Jenis Asuransi</td>
							<td> <b>: </b>{{$pasien->jenis_asuransi_pasien}}</td>
						</tr>
						<tr>
							<td>Kode POS</td>
							<td> <b>: </b>{{$pasien->kode_pos}}</td>
						</tr>
						<tr>
							<td>Nama Ayah</td>
							<td> <b>: </b>{{$pasien->nama_ayah}}</td>
						</tr>
						<tr>
							<td>Nama Ibu</td>
							<td> <b>: </b>{{$pasien->nama_ibu}}</td>
						</tr>
						<tr>
							<td>Nama Kepala Keluarga</td>
							<td> <b>: </b>{{$pasien->nama_pasangan}}</td>
						</tr>
						<tr>
							<td>Tgl Kematian Pasien </td>
							<td> <b>: </b>{{$pasien->tgl_kematian}}</td>
						</tr>
						<tr>
							<td>Keterangan Lain Pasien</td>
							<td> <b>: </b> {{$pasien->ket_identitas_pasien}}</td>
						</tr>					
					</table>
				</div>
			</div>
		</div>

        <div class="card-footer col-md-12">
            <div class="float-right">
                <a href="javascript:void(0)" onclick="kembali()" class="btn btn-primary btn-sm">Kembali</a>
            </div>
        </div>
	</div>
</div>