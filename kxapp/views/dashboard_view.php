<?php if (empty($business_id)) { ?>
    <div class="p-notification--caution">
        <div class="p-notification__content">
            <h5 class="p-notification__title">Note</h5>
            <p class="p-notification__message">You need to create your Business profile in order to start using our services.</p>
        </div>
        <div class="p-notification__meta">
            <div class="p-notification__actions">
                <a class="p-notification__action" href="<?php echo base_url()?>business">Create Business</a>
            </div>
        </div>
    </div>
<?php } ?>
