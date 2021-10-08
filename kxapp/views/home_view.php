<section class="p-strip--light">
    <div class="row">
        <div class="col-8">
            <h1>Having trouble retaining your Customers?</h1>
            <p>Use our Customer Loyalty Services to boost your online shopping or POS to extend
                benefits to your valued Customers and grow your business leaps and bounds.</p>
        </div>
        <div class="col-4">
            <img src="<?php echo base_url()?>res/knoxxbox.png" style="width: 140px; border-radius: 70px;" alt="Knoxxbox">
        </div>
    </div>
</section>
<div style="margin: 20px;"></div>
<div class="row p-divider">
    <div class="col-4 p-divider__block">
        <h2>What is customer loyalty?</h2>
        <p>Customer loyalty is their willingness to repeatedly return to a company to do business with them. This is
            especially due to the delightful and remarkable experiences they have with that brand. One of the main
            reasons to promote customer loyalty is that these customers can help you grow your business faster than
            your actual sales and marketing team. There are other various reasons why customer loyalty is critical
            to your success.</p>
    </div>
    <div class="col-4 p-divider__block">
        <h2>Manage your Customer Rewards</h2>
        <p>Set your own reward schemes and manage them using our ready to use framework. Power your loyalty program
            with reward vouchers unique to your business. Optimize your loyalty program with ready analytics. Deliver
            right messages to your Customers at the right time.</p>
        <?php if (!isset($_SESSION["is_app_logged"])) { ?>
            <button type="button" onclick="location.href='<?php echo base_url() . index_page() ?>/login/register'">Register</button>
        <?php } ?>
    </div>
    <div class="col-4 p-divider__block">
        <h2>Choose a suitable Plan</h2>
        <p>We understand your business. Hence we can design a plan based on your business model. Share with us your
            ideas, and we shall deliver you a business model that suits you best.</p>
        <button type="button" onclick="location.href='<?php echo base_url() . index_page() ?>/pages/pricing'">Check Plans</button>
    </div>
</div>