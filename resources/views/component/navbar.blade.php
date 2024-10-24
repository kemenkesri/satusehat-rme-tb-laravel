<nav class="navbar navbar-expand-lg " color-on-scroll="500">
	<div class="container-fluid">
		<a class="navbar-brand" href="#pablo"><i class="fa fa-user"></i> {{Auth::getUser() ? Auth::getUser()->name : ''}}</a>
		<button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar burger-lines"></span>
			<span class="navbar-toggler-bar burger-lines"></span>
			<span class="navbar-toggler-bar burger-lines"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navigation">
			<?php
			if(Auth::user()){
				$poli_active = (Auth::user()->rules=='Poli') ? Auth::user()->poli_id : Auth::user()->rules;
				$cek_dokter = App\Models\Dokter::where('users_id',Auth::user()->id)->first();
				if(!empty($cek_dokter)){
					$arr_list_poli = explode(",", $cek_dokter->list_poli);
					if(in_array($cek_dokter->poli_id, $arr_list_poli)){

					}else{
						array_push($arr_list_poli, $cek_dokter->poli_id);
					}
					?>
					<ul class="nav navbar-nav mr-auto">
						<li class="dropdown nav-item">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<i class="fa fa-users"></i>
								<span class="notification">{{count($arr_list_poli)}}</span>
								<span class="d-lg-none">Poli</span>
							</a>
							<ul class="dropdown-menu">
								@for($i=0;$i<count($arr_list_poli);$i++)
								<?php
								$id_poli = $arr_list_poli[$i];
								$daftar_poli = $arr_list_poli[$i];
								if(is_numeric($id_poli)){
									$daftar_poli = App\Models\MstPoli::find($id_poli)->nama_poli;
								}
								?>
								<a class="dropdown-item @if($id_poli==$poli_active) active @endif" href="javascript:void(0)" onclick="pindah('{{$id_poli}}')">{{$daftar_poli}}</a>
								@endfor
							</ul>
						</li>
					</ul>
					<?php
				}
			}
			?>
			<ul class="navbar-nav ml-auto pull-right">
				{{-- <li class="nav-item">
					<a class="nav-link" href="javascript:void(0)" onclick="ganti_password('{{Auth::user()->id}}')">
						<span class="no-icon">Account</span>
					</a>
				</li> --}}

				<li class="nav-item">
					<a class="nav-link" href="{{url('logout')}}">
						<span class="no-icon">Log out</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>