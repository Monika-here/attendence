
$(document).ready(function() {
  $('body').on('keyup', '.token', function (e) {
    var _this = $(this);
    console.log(_this);
    _this.parents('form').find('button[type="submit"]').addClass('disabled');
    var _value = _this.val();
    var _input_valid = 0;
    _input_valid = (/^\d{6}$/.test(_value)) ? 1 : _input_valid;
    if(_input_valid){
      _this.parents('form').find('button[type="submit"]').removeClass('disabled');
    }
  });
});
