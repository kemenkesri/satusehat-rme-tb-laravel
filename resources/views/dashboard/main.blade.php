@extends('component.layout')

@section('extended_css')

@stop

@section('content')
<div class="container-fluid">
    <div class="row main-layer">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover main-layer">
                <div class="card-header ">
                    <h4 class="card-title">{{ isset($data['title']) ? $data['title'] : '' }}
                    <span class="card-category float-right">
                        @if(Auth::getUser()->rules=='Loket')
                        <a href="{{url('pemanggilan')}}" target="_blank" class="btn btn-primary">Pemanggilan</a>
                        @endif
                        @if(Auth::getUser()->rules=='Loket' || Auth::getUser()->rules=='Poli')
                        <a href="{{url('pemanggilan/display')}}" target="_blank" class="btn btn-primary">Display</a>
                        @endif
                    </span>
                    </h4>
                    <hr>

                    <div class="clearfix" style="margin-bottom: 50px"></div>
                </div>

                <div class="card-body" style="min-height: 420px;">
                     <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center px-4">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pengguna</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlahPengguna}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center px-4">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Pasien</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlahPasien}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::getUser()->rules=='Administrator')
                    <div class="row">
                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center px-4">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">JML PENGGUNA LOGIN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="jmlOnline"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="other-page"></div>
</div>
@stop

@section('extended_js')
    <script type="text/javascript">
        $(document).ready(function() {
            demo.showNotification();            
        });
        counter();

        setInterval(function(){ 
            counter();
        }, 1000 * 60);

        function counter(){
            $.get("{{ route('getOnlineUsers') }}",function(data){
                $('#jmlOnline').text(data);
            });
        }
    </script>
@stop
