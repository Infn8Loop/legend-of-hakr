<?php $this->load->view("includes/header"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Write a message </h2>
                <p>
                    <form method="post" action="<?php echo site_url('messages/write_graffiti');?>">
                    <textarea rows="4" cols="40" class="write-graffiti" maxlength="140" name="message"></textarea>  <br/><br/>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </p>
            </div>
            <div class="options">
                <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a>

                </h3>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer"); ?>