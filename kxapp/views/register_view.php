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
            location.href = '<?php echo base_url() ?>login';
        });

        function sign_up() {
            if ($('#u_name').val() == '' || $('#u_pwd').val() == '' ||
                $('#u_email').val() == '' || $('#u_mobile').val() == '') return;
            $('#loading-bar').show();
            var postdata = {
                'name': $('#u_name').val(),
                'email': $('#u_email').val(),
                'mobile': $('#u_mobile').val(),
                'pwd': $('#u_pwd').val(),
                'r': $('#chk-remember').is(":checked")
            };
            postdata = JSON.stringify(postdata);
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
    <div class="card bordered form">
        <h1>Sign-Up</h1>
        <!--Full Name-->
        <div>
            <label for="u_name">Full Name</label>
            <input type="text" class="fregister" id="u_name" name="u_name" placeholder="Your Name">
        </div>
        <div>
            <!--Email address-->
            <label for="u_email">Email address</label>
            <input type="email" class="fregister" id="u_email" name="u_email" placeholder="example@mail.com" autocomplete="email">
        </div>
        <div>
            <!--Phone-->
            <label for="u_mobile">Mobile number</label>
            <input type="tel" class="fregister" id="u_mobile" name="u_mobile" maxlength="15" placeholder="+91">
        </div>
        <div>
            <!--Password-->
            <label for="u_pwd">Password</label>
            <input type="password" class="fregister" id="u_pwd" name="u_pwd" autocomplete="current-password" maxlength="15">
        </div>
        <div>
            <!--Terms-->
            <label class="p-checkbox">
                <input type="checkbox" aria-labelledby="chk-remember" class="p-checkbox__input">
                <span class="p-checkbox__label" id="chk-remember">I agree to Terms & Conditions</span>
            </label>
        </div>
        <div class="align-center">
            <button class="" id="sign-up-btn" type="button">Submit</button>
            <i id="loading-bar" class="p-icon--spinner u-animation--spin"></i>
            <p>Already have an account?<button class="secondary" id="login-btn">Sign-In</button></p>
        </div>
    </div>
</div>