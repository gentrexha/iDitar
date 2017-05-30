var socket = io.connect( 'http://172.16.1.165:8080' );
var text;
$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();
    $( "#messageInput" ).val("");
	
	socket.emit( 'message', { name: nameVal, message: msg } );

    var _date = new Date();
    var actualContent = $( "#messages" ).html();
    var newMsgContent = '<li><div class="row msg_container send"><div class="col-md-9 col-xs-9 bubble"><div class="messages msg_sent"><p>'+msg+'</p><timedatetime="'+_date+'">'+nameVal+' • '+_date.toLocaleTimeString()+'</time></div></div><div class="col-md-3 col-xs-3 avatar"><img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name"></div></div></li>';
    var content = newMsgContent + actualContent;

    text = msg;

    $( "#messages" ).html( content );
	
	// Ajax call for saving datas
	// $.ajax({
	// 	url: "./ajax/insertNewMessage.php",
	// 	type: "POST",
	// 	data: { name: nameVal, message: msg },
	// 	success: function(data) {
			
	// 	}
	// });
	
	return false;
});

$( "#videoChatForm" ).submit( function() {
    // Generate random room name if needed
    var newHash = Math.floor(Math.random() * 0xFFFFFF).toString(16);
    const roomHash = newHash.substring(1);

    var nameVal = $( "#nameInput" ).val();
    var msg = 'videochat.html#'+roomHash;
    console.log(msg);
    // $( "#messageInput" ).val("");

    socket.emit( 'message', { name: nameVal, message: msg } );

    var _date = new Date();
    var actualContent = $( "#messages" ).html();
    var newMsgContent = '<li><div class="row msg_container send"><div class="col-md-9 col-xs-9 bubble"><div class="messages msg_sent"><p><a target="_blank" href="'+msg+'">Click to join me in a videochat!</a></p><timedatetime="'+_date+'">'+nameVal+' • '+_date.toLocaleTimeString()+'</time></div></div><div class="col-md-3 col-xs-3 avatar"><img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name"></div></div></li>';
    var content = newMsgContent + actualContent;

    text = msg;

    $( "#messages" ).html( content );


    return false;
});

socket.on( 'message', function( data ) {
    if (text !== data.message) {
        var _date = new Date();
        var actualContent = $("#messages").html();
        var newMsgContent = '<li><div class="row msg_container receive"></div><div class="col-md-3 col-xs-3 avatar"><img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name"></div><div class="col-md-9 col-xs-9 bubble"><div class="messages msg_receive"><p>' + data.message + '</p><timedatetime="' + _date + '">' + data.name + ' • ' + _date.toLocaleTimeString() + '</time></div></div></li>';
        var content = newMsgContent + actualContent;

        $("#messages").html(content);
    }
});