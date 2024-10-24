@extends('component.layout')

@section('extended_css')
<style>
	.list-group-item{
		background-color: #787878;
		color: #ffffff;
		font-size: 8pt;
	}
	.card:hover {
		box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
		cursor: pointer;
	}
	.fa-icon{
		font-size: 16pt;
	}
</style>
@stop

@section('content')
@include('component.breadcrumb')
<div class="container-fluid">
	<div class="row main-layer">
		<div class="col-md-3">
			<a class="card text-decoration-none" href="{{route('mainHamilNifasMenyusui')}}">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center pl-2 text-body">
						<h3 class="">{{$ibuHamil}}</h3>
						<img src="{{asset('assets/img/d-bumil.png')}}" alt="" height="70">
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between">
						<span style="align-self:center">Jumlah Ibu Hamil</span>
						<span class="fa-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
					</li>
				</ul>
			</a>
		</div>
		<div class="col-md-3">
			<a class="card text-decoration-none" href="{{route('mainHamilNifasMenyusui')}}">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center pl-2 text-body">
						<h3 class="">{{$nifasMenyusui}}</h3>
						<img src="{{asset('assets/img/d-busui.png')}}" alt="" height="70">
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between">
						<span style="align-self:center">Jumlah Ibu Ibu Nifas / Menyusui</span>
						<span class="fa-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
					</li>
				</ul>
			</a>
		</div>
		<div class="col-md-3">
			<a class="card text-decoration-none" href="{{route('mainBayiBalitaApras')}}">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center pl-2 text-body">
						<h3 class="">{{$bayiApras}}</h3>
						<img src="{{asset('assets/img/d-bayi.png')}}" alt="" height="70">
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between">
						<span style="align-self:center">Jumlah Usia Bayi, Balita, Apras</span>
						<span class="fa-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
					</li>
				</ul>
			</a>
		</div>
		<div class="col-md-3">
			<a class="card text-decoration-none" href="{{route('mainUsiaSekolahRemaja')}}">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center pl-2 text-body">
						<h3 class="">{{$usiaSekolah}}</h3>
						<img src="{{asset('assets/img/d-sekolah.png')}}" alt="" height="70">
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between">
						<span style="align-self:center">Jumlah Usia Sekolah dan Remaja</span>
						<span class="fa-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
					</li>
				</ul>
			</a>
		</div>
		<div class="col-md-3">
			<a class="card text-decoration-none" href="{{route('mainUsiaProduktifLansia')}}">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center pl-2 text-body">
						<h3 class="">{{$produktifLansia}}</h3>
						<img src="{{asset('assets/img/d-remaja.png')}}" alt="" height="70">
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between">
						<span style="align-self:center">Jumlah Usia Produktif dan Lansia</span>
						<span class="fa-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
					</li>
				</ul>
			</a>
		</div>
	</div>
</div>
@stop

@section('extended_js')
	
@stop
