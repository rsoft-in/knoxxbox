<form>
    <input type="hidden" id="b_id">
    <div class="row">
        <div class="col-6">
            <label for="b_name" class="p-form__label">Business Name</label>
            <input type="text" id="b_name" required="" maxlength="50">

            <label for="b_address" class="p-form__label">Address</label>
            <input type="text" id="b_address" required="" maxlength="250">

            <label for="b_city" class="p-form__label">City</label>
            <input type="text" id="b_city" required="" maxlength="50">

            <label for="b_pincode" class="p-form__label">Pincode</label>
            <input type="text" id="b_pincode" required="" maxlength="10">

            <label for="b_state" class="p-form__label">State</label>
            <select id="b_state">
                <option>Kerala</option>
                <option>Karnataka</option>
                <option>Tamilnadu</option>
                <option>Telangana</option>
                <option>Andhra Pradesh</option>
            </select>
        </div>
        <div class="col-6">
            <label for="b_mobile" class="p-form__label">Mobile</label>
            <input type="tel" id="b_mobile" required="" maxlength="15">

            <label for="b_email" class="p-form__label">E-Mail</label>
            <input type="email" id="b_email" required="" maxlength="250">

            <label for="b_attributes" class="p-form__label">Remarks</label>
            <textarea id="b_attributes" rows="5" maxlength="250"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="button" class="p-button--brand u-float-right" id="save" onclick="save_business();">Save</button>
        </div>
    </div>
</form>
<script>
    var mode = "add";
    $(document).ready(function() {
        get_business();
    });

    function get_business() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>/business/get",
            data: "",
            success: function(data) {
                if (data.indexOf('{') >= 0) {
                    var obj = JSON.parse(data);
                    mode = "upd";
                    $('#b_id').val(obj.id);
                    $('#b_name').val(obj.name);
                    $('#b_address').val(obj.address);
                    $('#b_city').val(obj.city);
                    $('#b_pincode').val(obj.pincode);
                    $('#b_state').val(obj.state);
                    $('#b_mobile').val(obj.mobile);
                    $('#b_email').val(obj.email);
                    $('#b_attributes').val(obj.attributes);
                }
                if (data == 'NOT-FOUND') {
                    mode = "add";
                    showNotification('Use this page to create your new Business profile', 'Welcome');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function save_business() {
        if ($('#b_name').val() == "" || $('#b_mobile').val() == "" || $('#b_email').val() == "") {
            return;
        }
        // var vld = $(document).validate();
        // if (!vld)
        //     return false;

        var d = {
            'id': $('#b_id').val(),
            'name': $('#b_name').val(),
            'mobile': $('#b_mobile').val(),
            'email': $('#b_email').val(),
            'address': $('#b_address').val(),
            'city': $('#b_city').val(),
            'pincode': $('#b_pincode').val(),
            'state': $('#b_state').val(),
            'attributes': $('#b_attributes').val(),
            'mode': mode
        }
        postdata = JSON.stringify(d);
        $.ajax({
            type: "POST",
            url: "business/update",
            data: "postdata=" + postdata,
            success: function(data) {
                // hideProgress();
                if (data == "SUCCESS") {
                    showNotification('Successfully updated!', 'Update');
                    get_business();
                } else {
                    alert(data);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                // hideProgress();
                alert(errorThrown);
            }
        });
    }
</script>