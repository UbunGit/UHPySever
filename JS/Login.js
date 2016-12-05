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
			"inefaceMode" : "log",
			"userName" : userName,
			"passWord" : passWord
		};
		var json = JSON.stringify(inputArr);
	
		$.ajax({
			type : 'POST',
			url : httpURL_interFace,
			data : json,
			dataType : "json",// jsonp数据类型
			contentType : "json",
			success : function(data) {

				if (data.inforCode == 0) {
					
					var userInfo = data.result;
					setCookie('userName', userInfo.userName, 20, "");
					setCookie('userId', userInfo.userId, 20, "");
					setCookie('userImg', userInfo.userImg, 20, "");

					if (userInfo.userLevel == 1002) {
						window.location.href = "./ScanInterFace.php";
					} else {
						window.location.href = "./index.php";
					}
				} else {
					var msg = data.result;
					show_err_msg(msg);
				}
			},
			error : function(e) {
				show_err_msg(e.statusText);
			}
		});

	});

	$(".register").click(function() {
		go ("./Register.php");
		return;
	});
});
