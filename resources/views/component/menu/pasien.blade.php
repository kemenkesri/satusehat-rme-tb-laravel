<li @if (!empty($mn_active))<?php if($mn_active == "pasien"){ echo "class='nav-item active'";} ?>@endif>
	<a class="nav-link" href="{!! route('pasien') !!}">
		<i class="fa fa-user-plus"></i>
		<span>Pasien</span>
	</a>
</li>