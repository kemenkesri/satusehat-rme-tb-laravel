<li @if (!empty($mn_active))<?php if($mn_active == "hasil_lab"){ echo "class='nav-item active'";} ?>@endif>

<a class="nav-link" href="{!! route('hasil_diagnosis') !!}">
		<i class="fa fa-user-plus"></i>
		<span>Hasil Diagnosis</span>
	</a>

</li>