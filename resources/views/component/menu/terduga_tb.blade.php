<li @if (!empty($mn_active))<?php if($mn_active == "tb_terduga"){ echo "class='nav-item active'";} ?>@endif>

<a class="nav-link" href="{!! route('tb_terduga') !!}">
		<i class="fa fa-user-plus"></i>
		<span>TB Terduga</span>
	</a>

</li>