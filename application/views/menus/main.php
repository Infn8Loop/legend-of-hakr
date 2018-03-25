<?php $this->load->view("includes/header"); ?>
<div id="main-menu" class="">
    <div class="container">
        <div class="row">
            <img src="<?php echo site_url('assets/images/legend.png');?>" id="logo" class="img img-responsive" />
            <div class="col-md-6">
                <dl>
                    <dt><a href="<?php echo site_url('events/create')?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Battle</span></em>()</button></a></dt>
                    <dd>Hack People for XP and Dollars</dd>
                    <dt><a href="<?php echo site_url('coffee');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Coffee_Shop</span></em>()</button></a></dt>
                    <dd>Coffee and Donuts Raise your HP</dd>
                    <dt><a href="<?php echo site_url('menus/nav/revive');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Pay The Bailer</span></em>()</button></a></dt>
                    <dd>Pay Some coins to get out of jail.<br/></dd>
                    <dt><a href="<?php echo site_url('pvp/pvplist');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">PVP</span></em>()</a></button></dt>
                    <dd>Attack other players</dd>
                    <dt><a href="<?php echo site_url('darkweb/create');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Dark_Web</span></em>()</button></a></dt>
                    <dd>More challenging, get more coins.</dd>


                </dl>
                <br/>
            </div> <!--col -->
            <div class="col-md-6">
                <dl>
                    <dt><a href="<?php echo site_url('menus/nav/bank');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Bank</span></em>()</a></button></dt>
                    <dd>Trade your cash for E-coins.</dd>
                    <dt> <a href="<?php echo site_url('menus/nav/full-stats');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Leader_Board</span></em>()</a></button></dt>
                    <dd>Check the game stats.</dd>
                    <dt> <a href="<?php echo site_url('menus/nav/buy_shares');?>"><em><button class="btn btn-black"><span class="fuschia"></span> <span class="green">Stock Market</span></em>()</a></button></dt>
                    <dd>Market Shares payout daily. </dd>
                    <dt><a href="<?php echo site_url('menus/nav/gamble');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Gamble</span></em>()</a></button></dt>
                    <dd>Gamble for coins. </dd>
                    <dt> <a href="<?php echo site_url('identity/ident_list');?>"><button class="btn btn-black"><em><span class="fuschia"></span> <span class="green">Identity Theft</span></em>()</a></button></dt>
                    <dd>Steal XP from other players. </dd>
                </dl>
            </div>
        </div><!--col -->
        <div style="width: 80vw; margin: 10px;" class="col-xs-12">
            
            <h4 class="blue">Please report bugs to <a href="mailto:mike.computerwiz@gmail.com">mike.computerwiz@gmail.com</a></h4>
        </div>
        </div>
    </div>


<?php $this->load->view("includes/footer"); ?>