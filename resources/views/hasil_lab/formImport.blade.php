<div class="modal fade" id="detail-dialog" tabindex="-1" role="dialog" aria-labelledby="product-detail-dialog">
    <div class="modal-dialog modal-besar">
        <div class="modal-content">
          <div class="modal-header modalHeader p-t-15">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title modalHeaderTitle" id="product-detail-dialog"><i class="material-icons">file_upload</i> <link rel="import" href="">Upload Pasien</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 modal_body_map">
                <form class="form-export" method="post" action="{{ route('importPasien') }}" enctype="multipart/form-data" target="_blank">
                  {{ csrf_field() }}
                  <div class="form-group clearfix m-b-5">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label text-left m-b-0">
                      <label for="category_absent">Import</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-b-0">
                      <div class="form-group m-b-0">
                        <div class="form-line">
                          <input type="file" name="file_excel" class="form-control" value="" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-b-15">
                    <div class="col-sm-12 m-b-0">
                      <p class="text-right">
                        <button type="button" class="btn btn-warning m-t-15 waves-effect btn-cancel" data-dismiss="modal"><i class="fa fa-chevron-left fs-14 m-r-5"></i> Kembali</button>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect btn-submit">Import <i class="fa fa-upload fs-14 m-l-5"></i></button>
                      </p>
                    </div>
                  </div>
                </form>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  var onLoad = (function() {
      $('#detail-dialog').find('.modal-dialog').css({
          'width': '40%'
      });
      $('#detail-dialog').modal('show');
  })();
  $('#detail-dialog').on('hidden.bs.modal', function() {
      $('.modal-dialog').html('');
  });

  $('#category').chosen();
  $('#category_chosen').attr('style','width:100%');

  $('.tanggal').datetimepicker({
    weekStart: 2,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
  });
  $('.tanggalAwal').datetimepicker({
    weekStart: 2,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
  });
  $('.tanggalAkhir').datetimepicker({
    weekStart: 2,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
  });
  $('.bulan').datetimepicker({
    weekStart: 2,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 4,
    minView: 3,
    forceParse: 0,
  });
  $('#category').change(function(data){
    var category = $('#category').val();
    if (category == 'today') {
      $('.panelToday').show();
      $('.panelBetween').hide();
      $('.panelBulan').hide();
    }else if (category == 'between') {
      $('.panelToday').hide();
      $('.panelBetween').show();
      $('.panelBulan').hide();
    }else{
      $('.panelToday').hide();
      $('.panelBetween').hide();
      $('.panelBulan').show();
    }
  });
</script>