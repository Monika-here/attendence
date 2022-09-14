

  $(document).ready(function() {
    feather.replace()
    var dt_table = $('#dt_table').DataTable( {
      paging: false,
      info: false,
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'excel',
          text: 'Export',
        },
      ],
      responsive: true,
      fixedHeader : {
        header : true,
        footer : true,
        headerOffset: 45
      },
    });

    /*select2 dropdowns*/
    var _wc_dd = $('.wc_dd');
    if(_wc_dd.length){
      _wc_dd.each(function(i){
        $(this).select2({
          placeholder: $( this ).data('placeholder')
        }).on('select2:select', function (e) {
          //console.log($(this).val());
        });
      })
    }
  });
  
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var _id = button.data('id');var _name = button.data('name');var _link = button.data('link');
    var modal = $(this);
    $(this).find('.modal-footer .delete-btn').attr('href', _base_url+_link);
    $(this).find('.modal-body .item-title').html('"'+_name+'"');
  });
