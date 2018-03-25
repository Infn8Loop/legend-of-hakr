<?php $this->load->view("includes/header");  $players = $this->data['players'];  ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Players &nbsp;<a href="<?php echo site_url('pvp/pvplist')?>">[<span class="fuschia">Refresh</span>]</a></h3>

                </div>
            </div>
        <div class="row">
        <div class="player-list">
        <?php if (isset($players)){?>
    <?php foreach($players as $player){ ?>
            <div class="col-xs-12 col-md-4 col-lg-3 pvp-player">
            <h4 class="text-center">
             #! <?php echo $player['username']; ?>
            Level: <?php echo $player['level']; ?>
            </h4>

            <h3 class="text-center">
            <a href="<?php echo site_url('pvp/create/' . $player['user_id'])?>">[<span class="fuschia">HACK</span>]</a>
            </h3>


            </div>
    <?php }  } // END IF END FOREACH ?>
    <div class="options">
            <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a></h3>
        </div>
            </div>
            </div>
        </div>
        <div class="bottom-pad"></div>
    </div>
<?php $this->load->view("includes/footer"); ?>