
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
							<td> <b>: </b>{{$permohonan_lab->no_sediaan}}</td>
						</tr>
						<tr>
							<td>Lokasi Anatomi Penyakit </td>
							<td> <b>: </b>{{$permohonan_lab->lokasi_anatomi}}</td>
						</tr>
						<tr>
							<td>Tanggal Permohonan</td>
							<td> <b>: </b>{{$permohonan_lab->tanggal_permohonan}}</td>
						</tr>						

						<tr>
							<td>Tanggal Pengambilan Contoh Uji</td>
							<td> <b>: </b>{{$permohonan_lab->tanggal_pengambilan}}</td>
						</tr>						



						<tr>
							<td>Tanggal Pengiriman</td>
							<td> <b>: </b>{{$permohonan_lab->tanggal_pengiriman}}</td>
						</tr>						



						<tr>
							<td>Contoh Uji</td>
							<td> <b>: </b>{{$permohonan_lab->contoh_uji}}</td>
						</tr>						

						<tr>
							<td>Pengirim</td>
							<td> <b>: </b>{{$permohonan_lab->pengirim}}</td>
						</tr>


						<tr>
							<td>Alasan Pemeriksaan</td>
							<td> <b>: </b>{{$permohonan_lab->contoh_uji}}</td>
						</tr>

						<tr>
							<td>Jenis Pemeriksaan</td>
							<td> <b>: </b>{{$permohonan_lab->jenis_pemeriksaan}}</td>
						</tr>


					</table>						
				
        <div class="card-footer col-md-12">
            <div class="float-right">
                <a href="javascript:void(0)" onclick="kembali()" class="btn btn-primary btn-sm">Kembali</a>
            </div>
        </div>
	</div>
</div>