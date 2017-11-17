/**
 * 
 */

$(document).ready(function() {
	options = {
		'inefaceMode' : 'getfactionList'
	};
	options['fatherId'] = '0';
	var json = JSON.stringify(options);

	$.ajax({
		type : 'POST',
		url : httpURL_interFace,
		data : json,
		dataType : "json",//jsonp数据类型  
		contentType : "json",
		success : function(data) {
		},
		error : function(e) {
			show_err_msg(e.statusText);
		}
	});
});



$(function() {
	/**
	 * 接口添加参数
	 */
	$('.saveParameter').click(function() {
		var interFaceName = $('.newIntetFace').text();

		options = {
			'inefaceMode' : 'addParametervalue',
			'parameterFatherName' : interFaceName
		};
		$('.parameterVal').each(function(i) {
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
			url : httpURL_interFace,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {
				if (data.inforCode == 0) {

				} else {

				}
			},
			error : function(e) {
				show_err_msg(e.statusText);
			}

		});
	});
});