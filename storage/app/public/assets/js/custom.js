/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

 "use strict";
 $(document).ready(function() {
  $('#phone_number').on('keydown keyup', function(e) {
    var regExp = /[a-zA-Z]/g;
    var input = String.fromCharCode(e.which) || e.key;
    
    if(regExp.test(input)){
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Nomor WhatsApp hanya boleh mengandung angka!',
      });
      return false;
    }
  });

  $('#otp').on('keydown keyup', function(e) {
    var regExp = /[a-zA-Z]/g;
    var input = String.fromCharCode(e.which) || e.key;
    
    if(regExp.test(input)){
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Kode OTP hanya mengandung angka!',
      });
      return false;
    }

    if ($(this).val().length > 6) {
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Kode OTP hanya 6 angka!',
      });
      return false;
    }
  });

  $('#username').on('keydown', function(e) {
    if (e.keyCode == 32) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "Username tidak boleh mengandung spasi!\npenggunaan karakter diizinkan",
      });
      return false;
    }
  });

});