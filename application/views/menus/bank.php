<?php $this->load->view("includes/header"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo site_url('assets/images/bank.png');?>" class="img img-responsive" id="logo">
                <h3>Convert dollars to E-Coin</h3>
                <p>The cost is $<?php echo ($this->session->player['level'] * 100);?> per coin.</p>
                <form method="post" action="<?php echo site_url('bank')?>">
                    <input id="quantity" type="number" name="coins" value="1" data-coin="<?php echo ($this->session->player['level'] * 100);?>" min="1" max="99999">
                        <button type="submit" class="btn btn-success">Submit</button>
                    <h3>Total: $<span id="total"><?php echo ($this->session->player['level'] * 100);?></span></h3>
                </form>
                <div class="options">
                    <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a></h3>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer");?>