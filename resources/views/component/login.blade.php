<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<!--favicon-->
	<link rel="icon" type="image/png" href="{{ url('/assets/img/favicon.png') }}">
	<!--plugins-->
	<link href="{{ asset('assets2/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets2/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets2/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets2/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link href="{{ asset('assets2/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets2/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets2/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('assets2/css/icons.css')}}" rel="stylesheet">
	<title>SIKUAT | SIDOARJO</title>
	<style>
		.bg-login {
			width: 100%;
			height: 100%;
			background: url(../public/assets/img/bg-login.png) top center no-repeat;
			background-size: cover;
			/* position: relative; */
			background-attachment: fixed;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;

			/* background-image: url(../public/assets/img/bg-login.png) !important;
			background-attachment: fixed; */
		}
		#head-title1 {
			display: inline-block;
			font-weight: bold;
			font-size: 15pt;
			/* margin-left: -70px; */
		}
		#head-title2 {
			display: inline-block;
			font-weight: bold;
			font-size: 13pt;
			color: #5F8530;
			/* margin-left: -70px; */
			margin-right: 20px;
		}
		.box {
			width: 300px;
			height: 40px;
			background-color: #ffffff;
			box-shadow: 1px 1px #888888;
			border-radius: 4px;
		}
		#circle-1 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		#circle-2 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		#circle-3 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		#circle-4 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		#circle-5 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		#circle-6 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		#circle-7 {
			border-radius: 100%;
			background: green;
			width: 20px;
			height: 20px;
			margin-left: 5px;
			margin-top: 9px;
		}
		.c-font-size {
			font-size: 15pt;
			font-weight: bold;
		}
		.penghalang {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.4);
		}

		/*Modal */
		.modal-content {
			background-color: #fefefe;
			margin: 15% auto;
			padding: 5px;
			border: 1px solid #888;
			width: 80%;
		}

		/*Tombol X*/
		#tutup {
			color: #aaa;
			float: right;
			font-size: 20px;
			font-weight: bold;
		}

		#tutup:hover,
		#tutup:focus {
			color: black;
			cursor: pointer;
		}
	</style>
</head>
<body class="bg-login">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
			  <div class="row" style="margin-top: 5px;">
				<div class="col-md-1"></div>
				<div class="col-md-10">
				  <div class="row">
					<div class="col-md-3">
					 
					  <img src="{{ asset('assets/img/logo-dinkes.png')}}" class="img-responsive" alt="Responsive image"  width="70" >
					  <img src="{{ asset('assets/img/logo-sikuat.png')}}" class="img-responsive" alt="Responsive image" width="70" >
					  <img src="{{ asset('assets/img/rectangle.png')}}"  class="img-responsive" alt="Responsive image" width="4">
					</div>
					
					<div class="col-md-9">
						
					  <span id="head-title1">DINAS KESEHATAN KABUPATEN SIDOARJO</span>
					  <br>
					  <span id="head-title2">SISTEM INFORMASI KESEHATAN PUSKESMAS TERPUSAT (SIKUAT)</span>
					</div>
				  </div>
				</div>
				<div class="col-md-1"></div>
			  </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-12" style="margin-top: 120px;">
						<h5>MASUK SIKUAT</h5>
						<span style="color: #009B4C">SISTEM INFORMASI KESEHATAN PUSKESMAS TERPUSAT</span>
						<div class="row" style="margin-top: 10px">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										Gunakan username dan password untuk masuk!
									</div>
									<div class="card-body">
										<form method="post" action="{{route('dologin')}}" accept-charset="UTF-8">
											{{csrf_field()}}
											<div class="row mb-3">
												<div class="col-md-12">
													<label for="">Username</label>
													<input id="email" class="form-control" type="text" placeholder="Username" name="email" autocomplete="off">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-md-12">
													<label for="">Password</label>
													<input id="password" class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													{{-- <button type="button" class="btn btn-success"> MASUK </button> --}}
													<input class="btn btn-success btn-login" type="submit" value="Login">
												</div>
											</div>
										</form>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-md-5">
												
												<a href="javascript:void(0);"id="tombolku"><i class='bx bxs-download'></i> Download manual guide</a>
													<div id="myModal" class="penghalang">
														<div class="modal-content">
															<div class="modal-header">
															<h4 class="modal-title"> <i class="fa fa-book"></i> Download Manual Guide</h4>
															</div>
															<div class="modal-body row">
															<ul class="list-group">
																<li class="list-group-item"><a href="https://drive.google.com/u/0/uc?id=1ucF7oB5ejnksX1ZQg_TV0EIAFt5XmVqQ&export=download"><span class="pull-right"><i class='bx bxs-download'></i> Download</span></a><a href="https://drive.google.com/file/d/1ucF7oB5ejnksX1ZQg_TV0EIAFt5XmVqQ/view" style="color:#000000;"><span class="pull-left">Tampilkan Manual Guide SIKUAT <i class='bx bxs-show'></i></span></a></li>
												
															</ul>
															</div>
															<div class="modal-footer">
															<button type="button" class="btn btn-success" data-dismiss="modal" id="close">Close</button>
															</div>
														</div>
													</div>
													
											</div>
											<div class="col-md-5">
												<!-- <a href="javascript:void(0);" onclick="alert('Maintenance!');"><i class='bx bx-info-circle'></i> Pengumuman</a> -->
											</div>
											<div class="col-md-2"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-1"></div>
			<div class="col-md-1"></div>
			<div class="col-md-3">

				<div class="row">
					<div class="col-md-3" style="margin-top: 155px;">
						<ul class="list-group">
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Berorientasi Pelayanan</li>
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Akuntabel</li>
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Kompeten</li>
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Harmonis</li>
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Loyal</li>
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Adaptif</li>
							<li class="list-group-item c-font-size col-md-12 mb-2 box" style="margin-left: 15px; margin-top: 3px;"><i class="fa fa-circle"  style='color: green'></i> Kolaboratif</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <!-- Modal -->
	
	 
	</div>
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets2/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('assets2/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets2/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('assets2/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!--Password show & hide js -->
	<!-- modal -->
	<Script>
		var modal = document.getElementById('myModal');
		var btn = document.getElementById("tombolku");
		var span = document.getElementById("tutup");
		var span = document.getElementById("close");
													

		btn.onclick = function() {
			modal.style.display = "block";
		}

		span.onclick = function() {
		modal.style.display = "none";
		}
													

		window.onclick = function(e) {
		if (e.target == modal) {
		modal.style.display = "none";
		}
		}
	</Script>
	<script>
		@if(Session::has('status'))
			Swal.fire('Whooops','Username atau Password salah','error');
        @endif
	</script>
	<!--app JS-->
	<script src="{{ asset('assets2/js/app.js')}}"></script>
</body>
</html>