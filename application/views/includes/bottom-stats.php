<?php $player = $this->session->player;
$xp  = ($player['xp'] / $player['next_level']);
$xp = $xp * 100;

$chat=$this->session->chat;

?>




<div id="bottom-stats" class="text-center">
    <div class="col-xs-12">
        <div class="progress" style="width: 78%">
            <div class="progress-bar animated slideInLeft" role="progressbar" aria-valuenow="70"
                 aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $xp;?>%; background-color: #ae81ff; font-weight: 900; color: #000; text-align: left">
                <span> &nbsp; XP &nbsp; Level: <?php echo $player['level'];?></span>
            </div>
        </div>
        <button id="chat-button" class="btn btn-black">chat <i class="glyphicon glyphicon-comment" ></i> </button>
    </div>
</div>
<div id="chat-window">
    <div class="chat-terminal">
        <div class="chat-screen">

        </div>
        <br/>
        <div class="chat-input-box">
            <select name="chat-color" id="chat-color" style="color:#212121">
                <option value="white" selected>WHITE</option>
                <option value="green">GREEN</option>
                <option value="orange">ORANGE</option>
                <option value="blue">BLUE</option>
                <option value="fuschia">FUSCHIA</option>
                <option value="purple">PURPLE</option>
                <option value="yellow">YELLOW</option>
                <option value="grey">GREY</option>

            </select>
            <span class="green"></span> &nbsp;#!
            <input class="white" id="chat-input" type="text" name="message" maxlength="140" onkeypress="return enterKey(event);">
            <button type="submit" id="chat-send"> <i class="glyphicon glyphicon-envelope green"></i></button>
        </div>
    </div>

</div>