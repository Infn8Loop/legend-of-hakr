<?php $this->load->view("includes/header"); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <img src="<?php echo site_url('assets/images/legend.png')?>" class="img img-responsive">
            <h3>About the game</h3>
            <p>The Legend of Hak_R is a whimsical multiplayer, web-based, text game that aims to relive the nostalgia of dial-up BBS games of the early 90s.
                Go online, and hack to make dollars. Hack-battle against other players to take the lead. Laugh at the ridiculous attack names,
                in-game news and graffiti board. Invest in the stock market to make daily dividends, but make sure to convert it to E-coin
                because the market can crash at any time. Drink coffee to heal your player, or eat a donut to boost your HP above it's max.
                Steal the identity of other players to gain serious XP. Endless fun and simple gameplay combined with wit and comedy in a casual format.
            </p>

            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="panel-title">Just Login already! What are you waiting for?</h1><br/>
                    <form action="<?php echo site_url('users/login');?>" method="post">
                        <dl class="dl-horizontal">
                            <dt><label for="username">Username</label></dt>
                            <dd><input type="username" name="username"></dd>
                            <dt><label for="password">password</label></dt>
                            <dd><input type="password" name="password"></dd><br/>
                            <dt>&nbsp;</dt>
                            <dd><button type="submit" class="btn btn-success text-center">login</button></dd>
                        </dl><br/>
                        <p>Forgot your password? TOO BAD. Register a new character. </p>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">
            <h1> Welcome to the Legend</h1>
            <h3>A Pseudo-hacking (M)MORPG</h3>
            <h4>You must signup or login to continue.</h4>



            <form class="form-horizontal" action='<?php echo site_url('Users/register')?> ' method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class="">Register</legend>
                    </div>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label"  for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- E-mail -->
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">
                            <input type="email" id="email" name="email" placeholder="" class="input-xlarge">
                            <p class="help-block">Please provide your E-mail</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                            <p class="help-block">Password should be at least 4 characters</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password -->
                        <label class="control-label"  for="password_confirm">Password (Confirm)</label>
                        <div class="controls">
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
                            <p class="help-block">Please confirm password</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success">Register</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>




<?php $this->load->view("includes/footer"); ?>