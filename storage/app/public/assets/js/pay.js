$(document).ready(() => {
  $('#payment_proof_input').change(function() {
      const file = this.files[0];
      if (file) {
          let reader = new FileReader();
          reader.onload = function(event) {
              console.log(event.target.result);
              $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
      }
  });

  $('#email').hide();
  $('#via').hide();
  $('#total_fee_form').hide();
  $('#payment_proof').show();
  $('#imgPreview').show();
  $('#rekening_manual').show();
  $('#info_manual').show();

  $('#method').on('change', function() {
      if ($('#method').val() == 'Otomatis') {
          $('#via').show();
          $('#email').show();
          $('#total_fee_form').show();
          $('#payment_proof').hide();
          $('#imgPreview').hide();
          $('#rekening_manual').hide();
          $('#info_manual').hide();
      } else {
          $('#payment_proof').show();
          $('#imgPreview').show();
          $('#rekening_manual').show();
          $('#info_manual').show();
          $('#via').hide();
          $('#total_fee_form').hide();
          $('#email').hide();
      }
  });
});