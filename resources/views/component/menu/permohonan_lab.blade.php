<li @if (!empty($mn_active))<?php if($mn_active == "tb_permohonan_lab"){ echo "class='nav-item active'";} ?>@endif>
	<a class="nav-link" href="{!! route('tb_permohonan_lab') !!}">
		<i class="fa fa-user-plus"></i>
		<span>Permohonan Lab</span>
	</a>
</li>