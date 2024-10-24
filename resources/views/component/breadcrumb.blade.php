<style>
    .breadcrumb-item+.breadcrumb-item::before {
        content : ">" !important;
        font-weight: bold;
    }
    .breadcrumb {
        background-color: unset !important;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('dashboardPosyandu')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        @if (isset($breadcrumb))
        <li class="breadcrumb-item active" aria-current="page">
            <span style="font-size: 10pt; font-family: system-ui;">{{$breadcrumb}}</span>
        </li>
        @endif
    </ol>
</nav>