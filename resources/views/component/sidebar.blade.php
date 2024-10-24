<div class="sidebar-wrapper">
	<div class="logo">
		<div class="text-center">
			<img src="{{ url('/assets/img/logo.png')}}" width="70px">
		</div>
		<a href="{{ url('/') }}" class="simple-text">
			SIKUAT (SIDOARJO)
		</a>
	</div>
	<ul class="nav">
		@include('component.menu.pasien')
		@include('component.menu.terduga_tb')
		@include('component.menu.permohonan_lab')
		@include('component.menu.hasil_lab')
		@include('component.menu.hasil_diagnosis')

	</ul>
</div>