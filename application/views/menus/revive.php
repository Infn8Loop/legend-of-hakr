<?php $this->load->view("includes/header"); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php if ($this->session->dead == true){?>
            <h2>You're in Jail! </h2>
            <p>It will cost you: <?php echo $this->session->player['level']; ?> Coins bail to be released. You have <?php echo $this->session->player['coins'];?> E-coins.</p>
            <h3><a href="<?php echo site_url('revive');?>">[<span class="fuschia">Pay</span>]</a></h3>
            <?php } else {
                redirect(site_url());
            } ?>
        </div>
        <div class="options">
            <h3><a href="<?php echo site_url()?>">[<span class="fuschia">Menu</span>]</a></h3>
        </div>
    </div>
</div>
<?php $this->load->view("includes/footer"); ?>