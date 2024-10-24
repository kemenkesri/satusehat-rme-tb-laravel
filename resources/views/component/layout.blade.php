<!DOCTYPE html> 
<html lang="en">

@php $auth = Auth::user(); @endphp
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('/assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" href="{{ url('/assets/img/favicon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>SIKUAT</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<link href="{{ url('/assets/css/demo.css')}}" rel="stylesheet" />

	<link href="{{ url('/assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>



	<link href="{{ asset('plugins/customselect/src/jquery-customselect.css') }}" rel='stylesheet' />
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ url('/assets/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('datetime/css/bootstrap-datetimepicker.min.css') }}"/>
	
	<style type="text/css">
		table thead tr th, table tbody tr td{
			font-size: 13px !important;
		}

		   /* Styling untuk dropdown suggestions */
        .autocomplete-suggestions {
            border: 1px solid #ccc;
            background-color: #fff;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            z-index: 1000;
            width: 100%;
        }

        .autocomplete-suggestions div {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-suggestions div:hover {
            background-color: #e9e9e9;
        }
		.cardKustom {
			position: relative;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-direction: column;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
			border: 1px solid rgba(0, 0, 0, 0.125);
			border-radius: 0.25rem;
		}
		
		.cardKustom {
			border-radius: 4px;
			background-color: #FFFFFF;
			margin-bottom: 30px;
		}
		.card .card-category, .card label{
			color: #000;
		}
		.sidebar:after, body>.navbar-collapse:after {
			background: #9368E9;
			background: -moz-linear-gradient(top, #9368e963 0%, #943bea 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #9368E9), color-stop(100%, #943bea));
			background: -webkit-linear-gradient(top, #9368e963 0%, #943bea 100%);
			background: -o-linear-gradient(top, #9368e963 0%, #943bea 100%);
			background: -ms-linear-gradient(top, #9368e963 0%, #943bea 100%);
			background: linear-gradient(to bottom, #9368e963 0%, #943bea 100%);
			background-size: 150% 150%;
			z-index: 3;
			opacity: 1;
		}
		.dropdown-menu{
			visibility: visible !important;
			opacity: 1 !important;
		}
		.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
			padding: 8px;
			vertical-align: middle;
		}
		.select2{
			width: 100% !important;
		}
		.sidebar .nav .nav-link, body>.navbar-collapse .nav .nav-link {
			text-transform: capitalize !important;
		}
		
		.label-required:after {
			content: '*';
			color: red;
			margin-left: 5px;
		}
	</style>
	@yield('extended_css')
</head>

<style type="text/css">
	/* .table-striped tbody tr:nth-of-type(odd){
		font-size: 12px;
	}
	.table>tbody>tr{
		font-size: 12px;
	}
	.dataTables_empty {
		display: revert !important;
	} */
</style>

<style>
	.label-title{
		font-weight: 700 !important;
        color: #0e0e0e !important;
	}
	.label-required:after {
		content: '*' !important;
		color: red !important;
		margin-left: 5px !important;
	} 
	label{
		color: #0e0e0e !important;
	}
</style>
<body>
	<div class="wrapper">
		<div class="sidebar" data-image="{{ url('/assets/img/sidebar-5.jpg')}}">
			@include('component.sidebar')
		</div>
		<div class="main-panel">
			@include('component.navbar')
			<div class="content">
				@yield('content')
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav>
						<ul class="footer-menu">
							{{-- <li>
								<a href="#">
									Home
								</a>
							</li>
							<li>
								<a href="#">
									Company
								</a>
							</li> --}}
						</ul>
						<p class="copyright text-center">
							©
							<script>
								document.write(new Date().getFullYear())
							</script>
							<a href="#">Dinas Kesehatan Kab.Sidoarjo</a>
						</p>
					</nav>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{url('/')}}/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="{{url('/')}}/assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="{{url('/')}}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<script src="{{url('/')}}/assets/js/plugins/bootstrap-switch.js"></script>

	<script src="{{url('/')}}/assets/js/plugins/chartist.min.js"></script>
	<script src="{{url('/')}}/assets/js/plugins/bootstrap-notify.js"></script>
	<script src="{{url('/')}}/assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
	<script src="{{url('/')}}/assets/js/demo.js"></script>
	<script src="{{ asset('js/datagrid.js') }}"></script>
	<script src="{{ asset('datetime/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('datetime/js/bootstrap-datetimepicker.js') }}"></script>
	<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>

	<script src="{{ asset('plugins/sweetalert/sweetalert-dev.js') }}"></script>
	<script src="{{ asset('plugins/customselect/src/jquery-customselect.js') }}"></script>

	<!-- Select2 -->
	<script src="{{ url('/assets/js/select2.full.min.js') }}"></script>
	<script src="{{ url('/ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript" src="{{url('js/jquery.maskMoney.js')}}"></script>
	<!-- jQuery Mask Plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

	<!-- Font family -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

	{{-- <!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Bootstrap Datepicker JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}


	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

	<script src="{{asset('datepicker/year/yearpicker.js')}}"></script>

	<script type="text/javascript">
		const segment = window.location.href.split('/')
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		function formatNumber(angka) {
			$(angka).val(angka.value.toString().replace(/[^,\d]/g, ""));
		}

		function dateCurrent(){
			let date = new Date()
			let days = date.getDate().toString().padStart(2, 0)
			let months = (date.getMonth() + 1).toString().padStart(2, 0)
			let years = date.getFullYear().toString()
			return {years: years, months: months, days: days}
		}
		$.fn.yearPicker = function(v){
			let $this = $(this)
			$this.yearpicker({
				year: Number(dateCurrent().years),
				endYear: Number(dateCurrent().years),
			})
		}

		$.fn.onlyNumeric = function(e){
			let regex = new RegExp("^[0-9\b]+$") // Rules hanya bisa [ numerik ]
			let key = String.fromCharCode(!e.charCode ? e.which : e.charCode) // Ambil karakter on keypress
			if(!regex.test(key)){ // Bool, jika "key" memenuhi rules dari regex, value==true
				e.preventDefault()
				return false
			}
		}

		// Reset form end
		$.fn.disableBtn = function(bool=true){ // Disable enable button
			if (bool) {
				// Simpan konten sebelum mengubahnya
				this.data('prevContent', this.html());
				// Set konten baru
				let html = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...';
				this.attr('disabled', true).html(html);
			} else {
				// Kembalikan konten sebelumnya
				let prevContent = this.data('prevContent') || 'SIMPAN'; // Default 'SIMPAN' jika tidak ada konten sebelumnya
				this.removeAttr('disabled').html(prevContent);
			}
		}

		function formatNumber(param) {
			$(param).val(param.value.toString().replace(/[^,\d]/g, ""));
		}

		function Kosong() {
			swal({
				title: "Maaf !",
				text: "Fitur Belum Bisa Digunakan !!",
				type: "warning",
				timer: 2000,
				showConfirmButton: false
			});
		}

		@if(!empty(Session::get('message')))
		swal({
			title : "{{ Session::get('title') }}",
			text : "{{ Session::get('message') }}",
			type : "{{ Session::get('type') }}",
			showConfirmButton: true
		});
		@endif
	</script>
	@yield('extended_js')
</body>
@yield('modal_section')
</html>