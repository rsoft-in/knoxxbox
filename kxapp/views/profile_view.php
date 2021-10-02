<script>
    $(document).ready(function() {
        getProfile();
    });

    function getProfile() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>/profile/get",
            data: "",
            success: function(data) {
                if (data.indexOf('{') >= 0) {
                    var obj = JSON.parse(data);
                    $('#u_name').val(obj.name);
                    $('#u_email').val(obj.email);
                    $('#u_mobile').val(obj.mobile);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function save() {
        if ($('#u_pwd_new').val() != "" && $('#u_pwd').val() == "") {
            return;
        }
        var vld = $(document).validate();
        if (!vld)
            return false;

        var d = {
            'name': $('#u_name').val(),
            'mobile': $('#u_mobile').val(),
            'pwd': $('#u_pwd').val(),
            'pwd_new': $('#u_pwd_new').val()
        }
        postdata = JSON.stringify(d);
        $.ajax({
            type: "POST",
            url: "profile/update",
            data: "postdata=" + postdata,
            success: function(data) {
                hideProgress();
                if (data == "SUCCESS") {
                    showToast('Successfully updated!');
                    dialog.close();
                    get_courses();
                } else {
                    alert(data);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                hideProgress();
                alert(errorThrown);
            }
        });
    }
</script>
<form>
    <div class="row">
        <div class="col-6">
            <label for="full-name-stacked" class="p-form__label">Full name</label>
            <input type="text" id="u_name" autocomplete="name" required="" maxlength="50">

            <label for="u_email" class="p-form__label">E-Mail</label>
            <input type="text" id="u_email" autocomplete="email" disabled="disabled">

            <label for="u_mobile" class="p-form__label">Mobile</label>
            <input type="text" id="u_mobile" autocomplete="mobile" required="" maxlength="15">
        </div>
        <div class="col-6">
            <label for="u_pwd" class="p-form__label">Current Password</label>
            <input type="password" id="u_pwd" title="If you want to change, please fill in." maxlength="15">

            <label for="u_pwd_new" class="p-form__label">New Password</label>
            <input type="password" id="u_pwd_new" title="Enter your new password." maxlength="15">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="button" class="p-button--positive u-float-right" id="save-details" onclick="save();">Save</button>
        </div>
    </div>
</form>