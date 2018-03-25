<?php
$player = $this->session->player;
$hp  = ($player['hp'] / $player['max_hp']);
$hp = $hp * 100;
?>

    <?php if ($player['message']){?>
<div class="col-xs-12">
        <h5 class="text-center system-message"><span class="blue text-center"><?php echo $player['message']; ?> <a href="<?php echo site_url('messages/delete')?>"><i class="glyphicon glyphicon-trash del_message"></i></a></span> </h5>
</div>
    <?php } // end IF ?>

