/**
 * 页面加载完成
 * 
 */
$(document).ready(function() {

});
$(function() {

	$(".register").click(function() {

		var userName = $("input[name='username']").val();
		var passWord = $("input[name='passwd']").val();
		var telNO = $("input[name='telNO']").val();
		if (userName.length <= 0) {
			show_err_msg('会员账号不能为空');
			return;
		}
		if(telNO.length!=11){
			show_err_msg('手机号码不能为空');
			return;
		}
		if (passWord.length < 6 ||passWord.length >16 ) {
			show_err_msg('密码的长度必须在6～16位');
			return;
		}
		var inputArr = {
			"inefaceMode" : "register",
			"userName" : userName,
			"passWord" : passWord,
			"phone":telNO
		};
		var json = JSON.stringify(inputArr);
		$.ajax({
			type : 'POST',
			url : httpURL_interFace,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {

				if (data.inforCode == 0) {
					show_err_msg('注册成功');
					history.go(-1)
					
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
});
