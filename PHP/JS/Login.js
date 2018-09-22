/**
 * 页面加载完成
 * 
 */

$(document).ready(function() {

});
$(function() {

	$(".log").click(function() {
		
		
		var userName = $("input[name='username']").val();
		var passWord = $("input[name='passwd']").val();
		if (userName.length <= 0) {
			show_err_msg('会员账号不合法');
			return;
		}
		if (passWord.length <= 0) {
			show_err_msg('请输入正确的密码');
			return;
		}
		
		var inputArr = {
			"metho" : "login",
			"param":{
                "userName" : userName,
                "passWord" : passWord
			}
		};
		var json = JSON.stringify(inputArr);
	
		$.ajax({
			type : 'POST',
			url : httpURL_interFace,
			data : json,
			dataType : "json",// jsonp数据类型
			contentType : "json",
			success : function(data,scress,request) {
				var resuleCode = request.getResponseHeader("resultcode")
				if (resuleCode == 0) {

                    setCookie('userID', data.userID, 24, "");
					setCookie('userName', data.userName, 24, "");
					setCookie('headImage', data.headImage, 24, "");
                    setCookie('phone', data.phone, 24, "");
                    setCookie('email', data.email, 24, "");
                    setCookie('section', data.section, 24, "");
					window.location.href = "./index.php";

				} else {
					var msg = data;
					show_err_msg(msg);
				}
			},
			error : function(e) {
				show_err_msg(e.statusText);
			}
		});

	});

	$(".register").click(function() {
        $url = './index.php?className=RegisterController';
		go ($url);
		return;
	});
});
