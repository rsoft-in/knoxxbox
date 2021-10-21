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
                    showNotification('Successfully updated!', 'Update');
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
<div class="grid">
    <div class="col col-50">
        <div class="card form">
            <div>
                <label for="u_name">Full name</label>
                <input type="text" id="u_name" required="" maxlength="50">
            </div>
            <div>
                <label for="u_email">E-Mail</label>
                <input type="text" id="u_email" disabled="disabled">
            </div>
            <div>
                <label for="u_mobile">Mobile</label>
                <input type="text" id="u_mobile" required="" maxlength="15">
            </div>
        </div>
    </div>
    <div class="col col-50">
        <div class="card form">
            <div>
                <label for="u_pwd">Current Password</label>
                <input type="password" id="u_pwd" title="If you want to change, please fill in current password." maxlength="15">
            </div>
            <div>
                <label for="u_pwd_new">New Password</label>
                <input type="password" id="u_pwd_new" title="Enter your new password." maxlength="15">
            </div>
            <div class="align-right">
                <button type="button" class="p-button--brand u-float-right" id="save-details" onclick="save();">Save</button>
            </div>
        </div>
    </div>
</div>