
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card strpied-tabled-with-hover main-layer">
				<div class="card-header ">
					<h5>{{$menu}}</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped table-hover">
						<tr>
							<td>No Sediaan </td>
							<td> <b>: </b>{{$hasil_lab->no_sediaan}}</td>
						</tr>
						<tr>
							<td>Lokasi Anatomi Penyakit </td>
							<td> <b>: </b>{{$hasil_lab->lokasi_anatomi}}</td>
						</tr>
						<tr>
							<td>Tanggal Permohonan</td>
							<td> <b>: </b>{{$hasil_lab->tanggal_daftar}}</td>
						</tr>						

						<tr>
							<td>Tanggal Contoh Uji Diterima / Konfirmasi Penerimaan</td>
							<td> <b>: </b>{{$hasil_lab->tgl_contoh_uji}}</td>
						</tr>						



						<tr>
							<td>Penerima</td>
							<td> <b>: </b>{{$hasil_lab->penerima}}</td>
						</tr>						

						<tr>
							<td>Pemeriksa</td>
							<td> <b>: </b>{{$hasil_lab->pemeriksa}}</td>
						</tr>						




					<!-- 	<tr>
							<td>Contoh Uji</td>
							<td> <b>: </b>{{$hasil_lab->contoh_uji}}</td>
						</tr> -->						

						<tr>
							<td>Alasan Pemeriksaan</td>
							<td> <b>: </b>{{$hasil_lab->contoh_uji}}</td>
						</tr>

						<tr>
							<td>Jenis Pemeriksaan</td>
							<td> <b>: </b>{{$hasil_lab->jenis_pemeriksaan}}</td>
						</tr>


					</table>						
				
        <div class="card-footer col-md-12">
            <div class="float-right">
                <a href="javascript:void(0)" onclick="kembali()" class="btn btn-primary btn-sm">Kembali</a>
            </div>
        </div>
	</div>
</div>