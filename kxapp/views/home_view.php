<div class="banner">
    <div>
        <h1 class="title">Having trouble retaining your Customers?</h1>
        <p class="sub-title">Use our Customer Loyalty Services to boost your online shopping or POS to extend
            benefits to your valued Customers and grow your business leaps and bounds.</p>
    </div>
</div>

<div style="margin: 20px;"></div>
<div class="grid">
    <div class="col col-33">
        <div class="card bordered">
            <h2>What is customer loyalty?</h2>
            <p>Customer loyalty is their willingness to repeatedly return to a company to do business with them. This is
                especially due to the delightful and remarkable experiences they have with that brand. One of the main
                reasons to promote customer loyalty is that these customers can help you grow your business faster than
                your actual sales and marketing team. There are other various reasons why customer loyalty is critical
                to your success.</p>
        </div>
    </div>
    <div class="col col-33">
        <div class="card bordered">
            <h2>Manage your Customer Rewards</h2>
            <p>Set your own reward schemes and manage them using our ready to use framework. Power your loyalty program
                with reward vouchers unique to your business. Optimize your loyalty program with ready analytics. Deliver
                right messages to your Customers at the right time.</p><br><br>
            <?php if (!isset($_SESSION["is_app_logged"])) { ?>
                <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url() . index_page() ?>/login/register'">Register</button>
            <?php } ?>
        </div>
    </div>
    <div class="col col-33">
        <div class="card bordered">
            <h2>Choose a suitable Plan</h2>
            <p>We understand your business. Hence we can design a plan based on your business model. Share with us your
                ideas, and we shall deliver you a business model that suits you best.</p><br><br><br><br>
            <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url() . index_page() ?>/pages/pricing'">Check Plans</button>
        </div>
    </div>
</div>