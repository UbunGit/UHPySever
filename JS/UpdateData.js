
/**
 * 
 */
var socket;
$(document).ready(function() {

	function connect() {
		var host = "ws://" + SocketIP + ":" + SocketPORD + "/"
		socket = new WebSocket(host);
		try {

			socket.onopen = function(msg) {
				$("btnSend").disabled = false;
				alert("连接成功！");
			};

			socket.onmessage = function(msg) {
				if (typeof msg.data == "string") {
					displayContent(msg.data);
				} else {
					alert("非文本消息");
				}
			};

			socket.onclose = function(msg) {
				$("btnSend").disabled = true;
				alert("socket closed!")
			};
		} catch (ex) {
			log(ex);
		}
	}
	
	connect();
});
function send() {
	var inputArr = {
			"inefaceMode" : "upLoadData",
			"userName" : "test",
			"passWord" : "passWord",
			"telNO":"telNO"
		};
		var json = JSON.stringify(inputArr);
	socket.send(json);
}
function displayContent(msg) {
    $("#txtContent").val(msg+$("#txtContent").val()+ "\r\n"); 
   
}
window.onbeforeunload = function() {
	try {
		socket.close();
		socket = null;
	} catch (ex) {
	}
}
