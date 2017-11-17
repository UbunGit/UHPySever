
/**
 * 
 */
var socket;
var _isConnect = false;
$(document).ready(function() {

	function connect() {
		var host = "ws://" + SocketIP + ":" + SocketPORD + "/"
		socket = new WebSocket(host);
		try {

			socket.onopen = function(msg) {

				setIsConnect(true);
			};

			socket.onmessage = function(msg) {
				if (typeof msg.data == "string") {
					displayContent(msg.data);
				} else {
					alert("非文本消息");
				}
			};

			socket.onclose = function(msg) {

				setIsConnect(false);
				alert("Socket链接失败："+msg.code);
			};
		} catch (ex) {
			log(ex);
		}
	}
	function setIsConnect(isConnect){
		_isConnect = isConnect; 
		if(_isConnect){
			$("#btnSend").val("开始");
		}else{
			$("#btnSend").val("链接");
		}
	}
	jQuery('#btnSend').click(function () {
		if(_isConnect){
			send()
		}else{
			connect()
		}
		
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
	connect();
});


window.onbeforeunload = function() {
	try {
		socket.close();
		socket = null;
		setIsConnect(false);
	} catch (ex) {
	}
}




