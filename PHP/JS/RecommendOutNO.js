
/**
 * 
 */
var socket;
var _isConnect = false;
$(document).ready(function() {
    var truecount = 0;
    var flasecount = 0;

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
				"inefaceMode" : "test",
				"userName" : "test",
				"passWord" : "passWord",
				"telNO":"telNO"
		};
		var json = JSON.stringify(inputArr);
        $("#txtContent").val("");
        truecount = 0;
        flasecount = 0;
		socket.send(json);
	}


	function displayContent(msg) {
		if (msg == '\n') {
            $("#txtContent").val("-----end------"+"\r\n"+$("#txtContent").val());
            return;
		}
        var returnData = JSON.parse(msg);
		if (returnData["Balance"]>2.4){
            truecount++;
		}else {
            flasecount++;
		}

		$("#txtContent").val(msg+"\r\n"+$("#txtContent").val());

        $(".pie-chart").sparkline([truecount,flasecount], {
            type: 'pie',
            width: '100',
            height: '100',
            borderColor: '#00bf00',
            sliceColors: ['#ef6f66', '#a8d76f']

        });
	}


    $(".pie-chart").sparkline([1,1], {
        type: 'pie',
        width: '100',
        height: '100',
        borderColor: '#00bf00',
        sliceColors: ['#ef6f66', '#a8d76f']

    });

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




