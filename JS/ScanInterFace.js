/**
 *  接口查询页面
 */

$(function() {
	
	/**
	 * 保存接口信息
	 */
	$(".exitinfo-form" ).submit(function(e) {
		
		var req = GetRequest(location.search);   
		var repInteFaceName = req['interFaceName']; 

		var params = $(".exitinfo-form").serialize();  // http request parameters.   
		params = decodeURIComponent(params, true ); 
		var req = GetRequest(params); 
		var options = new Object(); 
		options['inefaceMode'] ='replaceInteface';
		options['repInteFaceName'] = repInteFaceName;
		Object.assign(options, req); 
		replaceInteface(options);
		return false;
	});
	
	/**
	 * 保存接口信息
	 */
	$(".versions-form" ).submit(function(e) {
		var req = GetRequest(location.search);   
		var repInteFaceName = req['interFaceName']; 
		
		var params = $(".versions-form").serialize();  // http request parameters.   
		params = decodeURIComponent(params, true ); 
		var req = GetRequest(params); 
		var options = new Object(); 
		options['inefaceMode'] ='replaceInteface';
		options['repInteFaceName'] = repInteFaceName;
		Object.assign(options, req); 
		replaceInteface(options);
		return false;
	});
	
/**
 *  修改接口基本信息
 * @param options
 * @returns
 */	
	function replaceInteface(options){
		
		var json = JSON.stringify(options);
		show_loading()
		$.ajax({
			type : 'POST',
			url : httpURL_samrtHome,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					show_err_msg('添加成功');
					document.URL="./ScanInterFace.php";

				} else {
					var msg = data.result;
					show_err_msg(msg);
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
			}
		});
	};
});

function parameterChange(row,type){

	var jqInputs = $('input', row);
	var req = GetRequest(location.search);   
	var repInteFaceName = req['interFaceName']; 
	var options = new Object(); 
	options['inefaceMode'] ='addParametervalue';
	options['parameterFatherName'] = repInteFaceName;
	options['parameterTypeuse'] = type;
	options['parameterName'] =jqInputs[0].value;
	options['parameterDescribe'] =jqInputs[1].value;
	options['parameterCanNil'] =jqInputs[2].value;
	options['parameterBeginVersions'] =jqInputs[3].value;
	options['parameterEndVersions'] =jqInputs[4].value;
	options['parameterType'] =jqInputs[5].value;
	var json = JSON.stringify(options);
	show_loading()
	$.ajax({
			type : 'POST',
			url : httpURL_samrtHome,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					location.reload([true]) 
					return true;

				} else {
					var msg = data.result;
					show_err_msg(msg);
					return false;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
				return false;
			}
		});
}

function deleteparameter(row){
	
	var jqInputs = $('input', row);
	var req = GetRequest(location.search);   
	var repInteFaceName = req['interFaceName']; 
	var options = new Object(); 
	options['inefaceMode'] ='deleteParameter';
	options['parameterId'] = row.id;
	var json = JSON.stringify(options);
	alert(json);
	show_loading()
	$.ajax({
			type : 'POST',
			url : httpURL_samrtHome,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					location.reload([true]) 
					return true;

				} else {
					var msg = data.result;
					show_err_msg(msg);
					return false;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
				return false;
			}
		});
		
}




