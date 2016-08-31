/**
 * 
 */
$(function() {
	$('.commit').click(function() {

		options =  {
				'inefaceMode' :'replaceMemberInfo'
			};
		$('.userInfo').each(function(i) {
			var key = $(this).attr("tag");
			var inputValue = $(this).val();
			if (!inputValue) {
				inputValue = '';
			}
			options[key] = inputValue;
		});
		var json = JSON.stringify(options);
		alert(json);
		$.ajax({
			type : 'POST',
			url : 'http://192.168.1.27:8889/samrtHome',
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {

				if (data.inforCode == 0) {
					show_err_msg('修改成功');

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