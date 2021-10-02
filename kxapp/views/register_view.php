<script type="text/javascript">
    $(document).ready(function() {
        $('.fregister').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                sign_in();
            }
        });
        $('#loading-bar').hide();
        $('#u_name').focus();
        $('#sign-up-btn').click(function() {
            sign_up();
        });

        $('#login-btn').click(function() {
            location.href = '<?php echo base_url()?>login';
        });

        function sign_up() {
            $('#loading-bar').show();
            var postdata = {
                'name': $('#u_name').val(),
                'email': $('#u_email').val(),
                'mobile': $('#u_mobile').val(),
                'pwd': $('#u_pwd').val(),
                'r': $('#chk-remember').is(":checked")
            };
            postdata = JSON.stringify(postdata);
            alert(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . index_page() ?>/login/createRegister",
                data: "postdata=" + postdata,
                success: function(data) {
                    $('#loading-bar').hide();
                    if (data === 'SUCCESS')
                        location.href = '<?php echo base_url() . index_page() ?>/login?msg=V';
                    else {
                        showNotification('Invalid Login', 'error');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
</script>
<div class="login-container">
    <div class="p-card">
        <img class="p-card__thumbnail" src="<?php echo base_url() ?>res/knoxxbox.png" alt="">
        <hr class="u-sv1">
        <!-- <h3 class="p-card__title">Register</h3> -->
        <p class="p-card__content">
        <form>
            <!--Full Name-->
            <label for="u_name">Full Name</label>
            <input type="text" class="fregister" id="u_name" name="u_name" placeholder="Your Name">

            <!--Email address-->
            <label for="u_email">Email address</label>
            <input type="email" class="fregister" id="u_email" name="u_email" placeholder="example@mail.com" autocomplete="email">

            <!--Phone-->
            <label for="u_mobile">Mobile number</label>
            <input type="tel" class="fregister" id="u_mobile" name="u_mobile" maxlength="15">

            <!--Password-->
            <label for="u_pwd">Password</label>
            <input type="password" class="fregister" id="u_pwd" name="u_pwd" autocomplete="current-password" maxlength="15">

            <!--Terms-->
            <label class="p-checkbox">
                <input type="checkbox" aria-labelledby="chk-remember" class="p-checkbox__input">
                <span class="p-checkbox__label" id="chk-remember">I agree to Terms & Conditions</span>
            </label>
        </form>
        <div class="u-align--left">
            <button class="p-button--brand" id="sign-up-btn" type="button">Submit</button>
            <i id="loading-bar" class="p-icon--spinner u-animation--spin"></i>
            <button class="p-button--neutral is-inline" id="login-btn">Back to Login</button>
        </div>
        </p>
    </div>
</div>