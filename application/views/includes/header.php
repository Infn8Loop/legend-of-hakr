<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/style.css');?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/animate.css');?>" type="text/css"/>
    <title>Legend of Hak_R</title>
</head>
<body>
<?php
if($this->session->player){
    $player = $this->session->player;
    $hp  = ($player['hp'] / $player['max_hp']);
    $hp = $hp * 100;
}
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <?php if(isset($player)){ ?>
        <div class="progress top-hp">
            <div class="progress-bar animated slideInLeft" role="progressbar" aria-valuenow="70"
                 aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $hp;?>%; background-color: #fd971f; font-weight: 900; color: #000; text-align: left">
                <span> &nbsp; HP: <?php if($player){echo $player['hp'];}?> </span>
            </div>
        </div>

        <i class="glyphicon glyphicon-cog" id="menu-button"></i><br/>
            <span class="green">[</span><span class="fuschia">Dollars:</span><?php echo  "$" . number_format($player['dollars']);?><span class="green">]</span>
            <span class="green">[</span><span class="fuschia">Coins:</span><?php echo $player['coins'];?><span class="green">]</span>
        <?php } // end IF ?>
       <div id="top-menu">
           <?php if(isset($player)){ ?>

           <br/>
           <span class="green">[</span><span class="blue">Level:</span><?php echo $player['level'];?><span class="green">]</span>
           <span class="green">[</span><span class="blue">Power:</span><?php echo $player['power'];?><span class="green">]</span>
           <br/>
           <?php } // end IF ?>
           <?php if ($this->session->id == true){?>
               <a href="<?php echo site_url();?>">[Main Menu] </a>
               <a href="<?php echo site_url('users/logout')?>"> [Logout&nbsp;<?php echo $this->session->user['username'];?>] </a>
           <?php } // END IF ?>
           <!-- Brand and toggle get grouped for better mobile display -->

           <!-- Collect the nav links, forms, and other content for toggling -->
       </div>

    </div><!-- /.container-fluid -->
</nav>
<?php if($this->session->id){$this->load->view("includes/top-stats");} ?>