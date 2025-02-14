@extends('component.layout')

@section('extended_css')
@stop

@section('content')
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
       <div class="loading" align="center" style="display: none;">
        <img src="{!! asset('assets/img/loading.gif') !!}" width="20%" style="padding: 100px 0px;">
      </div>

      <div class="cardKustom strpied-tabled-with-hover main-layer">
        <div class="card-header ">
          <h4 class="card-title">
            {{ isset($data['title']) ? $data['title'] : '' }} 
            <span style="padding-right: 20px">              
              <!-- Button Tambah -->
              <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right" id="btn-add">Tambah Data</a>
            </span>
          </h4>
 
 
          <!-- Modal Import Excel -->
          <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <form method="post" id="importexcelsave" enctype="multipart/form-data">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                          </div>
                          <div class="modal-body">

                              <label>Pilih file excel</label>
                              <div class="form-group">
                                  <input type="file" name="file" required="required">
                              </div>

                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" id="btn-save-excel" class="btn btn-primary">Import</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>

        <div class="p-3 table-responsive">
          <table class="table table-striped table-hover" id="datatabel" style="width: 100% !important;">
            <thead>
              <tr>
                  <th>No Sediaan</th>
                  <th>Terduga TB</th>
                  <th>Tipe Pasien</th>
                  <th>Nama Pasien</th>

                  <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
<div class="other-page"></div>

</section>
@stop

@section('extended_js')
<script type="text/javascript">

  var datatabel = '';
  $(document).ready(function() {
    datatabel = $('#datatabel').DataTable({
      processing: true,
      serverSide : true,
      "ajax": "{{route('terdugaDatagrid')}}",
      "columns": [
      { data:"no_sediaan", orderable:false, sortable:false, searchable:true},
      { data:"jenis_terduga", orderable:false, searchable:true},
      { data:"jenis_pasien", orderable:false, searchable:false},
      { data:"nama_pasien", orderable:false, searchable:false},

      { data:"aksi" , "class" : "text-center", "width" : "120px", orderable:false, searchable:false},
      ]
    });
  });

  function kembali() {
    $(".main-layer").show();
    $(".other-page").hide();
  }

  $("#btn-add").on('click', function() {
    $(".loading").show();
    $(".main-layer").hide();

    $.post("{!! route('formterduga') !!}",{id:''}).done(function(data){
      if (data.status == 'success') {
        $(".loading").hide();
        $('.other-page').html(data.content).fadeIn();
      }else{
        $(".main-layer").show();
      }
    })
  });

  function detailForm(id){
    $(".loading").show();
    $(".main-layer").hide();

    $.post("{!! route('detailterduga') !!}",{id:id}).done(function(data){
      if (data.status == 'success') {
        $(".loading").hide();
        $('.other-page').html(data.content).fadeIn();
      }else{
        $(".main-layer").show();
      }
    })
  }

  function editForm(id){
    $(".loading").show();
    $(".main-layer").hide();

    $.post("{!! route('formterduga') !!}",{id:id}).done(function(data){
      console.log(data);
      if (data.status == 'success') {
        $(".loading").hide();
        $('.other-page').html(data.content).fadeIn();
      }else{
        $(".main-layer").show();
      }
    })
  }

  function deleteForm(id){
    swal({
      title:"Hapus data",
      text:"Apakah anda yakin ?",
      type:"warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Saya yakin!",
      cancelButtonText: "Batal!",
      closeOnConfirm: false
    },
    function(){
      $.post("{!! route('deleteterduga') !!}",{id:id}).done(function(data){
        if (data.status == 'success') {
          datatabel.ajax.reload();
          swal({
            title : data.head_message,
            text : data.message,
            type : data.type,
            showConfirmButton: true
          });
        }else{
          datatabel.ajax.reload();
          swal({
            title : data.head_message,
            text : data.message,
            type : data.type,
            showConfirmButton: true
          });
        }
      })
    })
  }

</script>
@stop
