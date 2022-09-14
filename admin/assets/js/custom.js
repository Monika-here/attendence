

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
