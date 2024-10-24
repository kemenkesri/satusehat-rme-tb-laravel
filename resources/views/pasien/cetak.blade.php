<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">nama_pasien</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">alamat_pasien</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">no_asuransi_pasien</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">jenis_asuransi_pasien</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">nik_pasien</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">status_kewarganegaraan</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">no_telepon</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">gol_darah</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">nama_ayah</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">nama_ibu</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">jenis_kelamin</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">tempat_lahir</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">tgl_lahir</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">agama</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">pendidikan_terakhir</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">status_pernikahan</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">jenis_pekerjaan</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">no_rm</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">puskesmas_id</th>
      <th class="center" width="30" style="font-weight:bold;text-align: center;">provinsi_id</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">kabupaten_id</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">kecamatan_id</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">desa_id</th>
      <th class="center" width="10" style="font-weight:bold;text-align: center;">no_rm_lama</th>
    </tr>    
  </thead>
  <tbody id="panelHasil">
    @foreach ($data as $key => $item)
        <tr>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->nama_pasien }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->alamat_pasien }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->no_asuransi_pasien }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->jenis_asuransi_pasien }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->nik_pasien }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->status_kewarganegaraan }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->no_telepon }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->gol_darah }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->nama_ayah }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->nama_ibu }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->jenis_kelamin }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->tempat_lahir }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->tgl_lahir }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->agama }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->pendidikan_terakhir }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->status_pernikahan }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->jenis_pekerjaan }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->kd_pasien }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->puskesmas_id }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->provinsi_id }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->kabupaten_id }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->kecamatan_id }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->desa_id }}</td>
        <td style="padding: 5px;" align="center" valign="middle">{{ $item->no_rm_lama }}</td>
        </tr>
    @endforeach        
  </tbody>
</table>
