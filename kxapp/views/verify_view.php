<div class="p-card" style="max-width: 400px; width: 100%; margin-left: auto; margin-right: auto;">
  <h3 class="p-card__title">To verify your E-Mail address</h3>
  <p class="p-card__content">
  <form>
    <div>
      <?php echo ($email ?? '')?>
    </div>
    <input id="email" type="hidden" value="<?php echo ($email ?? '')?>">
    <label for="otp">Enter your OTP</label>
    <input type="text" id="otp" maxlength="6">

    <button id="otp_button" type="button" class="p-button--positive" onclick="verify_otp();">Continue</button>
  </form>
  </p>
</div>
<script>
  $(document).ready(function () {
    $("#otp_button").prop("disabled", true);
    $('#otp').keyup(function () {
      if (event.which == 13) {
        event.preventDefault();
      }
      if ($(this).val().length == 6) {
        $("#otp_button").prop("disabled", false);
      } else {
        $("#otp_button").prop("disabled", true);
      }
    });


  });
  function verify_otp() {
    var postdata = {
      'eml': $('#email').val(),
      'otp': $('#otp').val()
    };
    postdata = JSON.stringify(postdata);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>login/verifyOtp",
      data: "postdata=" + postdata,
      success: function (data) {
        if (data === 'SUCCESS')
          location.href = '<?php echo base_url()?>login';
        else {
          showNotification('Failed to verify', 'error');
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(errorThrown);
      }
    });
  }
</script>