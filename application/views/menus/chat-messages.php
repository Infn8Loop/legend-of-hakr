<?php if (isset($chat_messages)){
    $messages = $chat_messages;
foreach ($messages as $message){ ?>
<h4><span class="usernames"><?php echo $message['username'];?>:</span> &nbsp; <span class="messages"><?php echo $message['message'];?></span><br/></h4>
<?php } }   // end if , end foreach ?>