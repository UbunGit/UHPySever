/**
 *  接口查询页面
 */

$(function() {
	/*
	 * 取消编辑1 查看 2修改 3 新增
	 */
	$('.cancelEdit').click(function(){
		window.location.href="./ScanInterFace.php";
	});

	/*
	 * 添加新接口1 查看 2修改 3 新增
	 */
	$('.addNewInterFace').click(function(){
		window.location.href="./AddNewInterFace.php";
	});

	/*
	 * 修改接口1 查看 2修改 3 新增
	 */
	$('.changeInterFace').click(function(){
		var inefaceMode = $('.data').attr("data_interFaceName");
		window.location.href='./EditInterFace.php?interFaceName='+inefaceMode;

	});

	/**
	 * 保存接口信息
	 */
	$(".addinfo-form").submit(function(e) {
		
		var interFaceName = document.getElementsByName("interFaceName")[0].value;
		var interFaceDescribe = document.getElementsByName("interFaceNameStr")[0].value;
		if(interFaceName == "")alert("接口名称不能为空");return false;
		if(interFaceDescribe == "" )alert("接口描述信息不能为空");return false;
		options =  {
				'inefaceMode' :'addInterFace'
		};
		var baseinfo = $(".baseinfo-form").serializeArray();
		$.each(baseinfo, function(i, field){
			options[field.name]=field.value;
		});
		var json = JSON.stringify(options);
		alert(json);
		$.ajax({
			type : 'POST',
			url : httpURL_samrtHome,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {

				if (data.inforCode == 0) {
					show_err_msg('添加成功');
					document.URL="./ScanInterFace.php";

				} else {
					var msg = data.result;
					show_err_msg(msg);
				}
			},
			error : function(e) {
				show_err_msg(e.statusText);
			}

		});
		return false;
	});
	
	/**
	 * 保存接口信息
	 */
	$(".exitinfo-form").submit(function(e) {
		alert("修改接口消息");
		
		var req = GetRequest(location.search);   
		var repInteFaceName = req['interFaceName']; 
		
		var params = $(".exitinfo-form").serialize();  // http request parameters.   
		params = decodeURIComponent(params, true ); 
		var req = GetRequest(params); 
		var options = new Object(); 
		options['inefaceMode'] ='replaceInteface';
		options['repInteFaceName'] = repInteFaceName;
		Object.assign(options, req); 
		var json = JSON.stringify(options);
		alert(json);
		$.ajax({
			type : 'POST',
			url : httpURL_samrtHome,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {

				if (data.inforCode == 0) {
					show_err_msg('添加成功');
					document.URL="./ScanInterFace.php";

				} else {
					var msg = data.result;
					show_err_msg(msg);
				}
			},
			error : function(e) {
				show_err_msg(e.statusText);
			}

		});
		return false;
	});

});