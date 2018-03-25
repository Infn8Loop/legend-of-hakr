<?php $this->load->view("includes/header");
    $updatetime = ($this->session->updatetime / 60 / 60);
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo site_url('assets/images/bank.png');?>" class="img img-responsive" id="logo">
                <h3>Buy Stock Market Shares</h3>
                <h4>The current total stock market value is: $<?php echo $this->session->market['value'];?>. Shares pay out a dividend from that total value, daily.</h4>
                <p>The cost is $<?php echo (number_format($this->session->market['value'] / 100));?> per share.</p>
                <p>Next dividend payout will occur in: <?php echo number_format($updatetime, 1);?> hours.</p>
                <form method="post" action="<?php echo site_url('market')?>">
                    <input id="quantity" type="number" name="shares" value="1" data-coin="<?php echo ($this->session->market['value'] / 100);?>" min="1" max="99999">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <h3>Total: $<span id="total"><?php echo (number_format($this->session->market['value'] / 100));?></span></h3>
                </form>
                <div class="options">
                    <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a></h3>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer");?>