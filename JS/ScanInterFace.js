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



