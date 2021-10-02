<script type="text/javascript">
    $(document).ready(function() {
        if ('<?php echo $msg ? 'true' : 'false' ?>' === 'true') {
            showNotification('Check your email to verify your account!');
        }
        $('.flogin').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                sign_in();
            }
        });
        $('#u_name').focus();
        $('#sign-in-btn').click(function() {
            sign_in();
        });

        $('#register-btn').click(function() {
            location.href = 'login/register';
        });

        function sign_in() {
            var postdata = {
                'u': $('#u_name').val(),
                'p': $('#u_pwd').val(),
                'r': $('#chk-remember').is(":checked")
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/login/checkLogin",
                data: "postdata=" + postdata,
                success: function(data) {
                    if (data === 'true')
                        location.href = 'home';
                    else {
                        showNotification('Invalid Login', 'Error');
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
        <!-- <h3 class="p-card__title">Sign-In</h3> -->
        <p class="p-card__content">
        <form>
            <label for="u_name">Email address</label>
            <input type="email" class="flogin" id="u_name" name="u_name" placeholder="example@mail.com" autocomplete="email" value='<?php echo $kx_cookie_u ?>'>
        </form>
        <form>
            <label for="u_pwd">Password</label>
            <input type="password" class="flogin" id="u_pwd" name="u_pwd" autocomplete="current-password" value='<?php echo $kx_cookie_p ?>'>
        </form>
        <form>
            <label class="p-checkbox">
                <input type="checkbox" id="chk-remember" aria-labelledby="chk-remember" class="p-checkbox__input" checked>
                <span class="p-checkbox__label">Remember Me</span>
            </label>
        </form>
        <div class="u-align--left">
            <button class="p-button--brand" id="sign-in-btn" type="button">Login</button>
            <button class="p-button--neutral is-inline" id="register-btn" type="button">Register</button>
        </div>
        </p>
    </div>
</div>