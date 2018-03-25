// base URL for Ajax calls
var baseURL = "http://msrinteractive.com/hakr/";

$("#quantity").keyup(function(){
    var qty   = $("#quantity").val();
    var cost  = $("#quantity").attr('data-coin');
    var total = qty * cost;
    total = total.toFixed();
    $("#total").html(total);
});

$("#quantity").on("focus", function(){
    var qty   = $("#quantity").val();
    var cost  = $("#quantity").attr('data-coin');
    var total = qty * cost;
    total = total.toFixed();
    $("#total").html(total);
});

$("#quantity").on("change", function(){
    var qty   = $("#quantity").val();
    var cost  = $("#quantity").attr('data-coin');
    var total = qty * cost;
    total = total.toFixed();
    $("#total").html(total);
});



if($(".screen").length > 0){

    (function() {

        'use strict';

        var element, string, length;

        element = document.querySelector('.screen');
        string  = element.innerText;
        length  = string.length;

        function timer(delay, repetitions) {
            var n, i;

            n = 0;
            i = window.setInterval(function () {
                element.innerText = string.substring(0, n);
                if (n++ === repetitions) {
                    window.clearInterval(i);
                }
            }, delay);
        }

        timer(20, length);

    })();

}
$toggle = "show";
$('#menu-button').click(function(){
    console.log('click');
        $('#top-menu').toggle('slide');
});

$('#chat-button').click(function(){
    $('#chat-window').toggle('fade');
    if(window.innerWidth > 481){
        $('#chat-input').focus();
    }
});


var _post = {key: "HAKR"};

// get
setInterval(function(){
    $.ajax({
        url:  baseURL + "Chat/refresh",
        type: "POST",
        dataType: 'HTML',
        data: _post,
        success: function(data){
            setTimeout(function(){
                $('.chat-screen').html(data);
            }, 1000);
        }
    });
}, 500);

$('#chat-send').click(function(){
    sendMessage();
});

function enterKey(event){
    if(event.keyCode == 13){
        sendMessage();
    }
}


$color = localStorage.getItem('color');
if($color){
    _color = $('#chat-color').val($color);
    $('#chat-input').addClass($color);
}

function sendMessage(){
    _message = $('#chat-input').val();
    _color = $('#chat-color').val();
    $('#chat-input').val('');

    var __post = {message: _message,
        color: _color
    };
    $.ajax({
        url: baseURL + "Chat/write",
        type: "POST",
        dataType: "HTML",
        data: __post,
        success: function(data){
            setTimeout(function(){
                if(data == 'DIRTY'){
                    alert('You cannot enter CODE into the chat.');
                }
                console.log(data);
            }, 200);
        }
    });

}

$("#chat-color").change(function(event){
    $color = $("#chat-color").val();
    console.log($color);
    localStorage.setItem('color', $color);
    $('#chat-input').removeClass();
    setTimeout(function(){
        $('#chat-input').addClass($color);
    });
});