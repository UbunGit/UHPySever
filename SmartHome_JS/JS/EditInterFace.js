/**
 * 
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
	/*
	 * 添加参数
	 */
	$('.addParameter').click(function(){
		var inefaceMode = $('.data').attr("data_interFaceName");
		window.location.href='./AddParameter.php?interFaceName='+inefaceMode;
	
	});
	
	/**
	 * 保存接口信息
	 */
	$(".SaveInterFace").click(function(e) {
		options =  {
				'inefaceMode' :'replaceInteface'
			};
		$('.inteFaceVar').each(function (i){
			  var key = $(this).attr("tag");
			  var inputValue = $(this).val();
			  if(!inputValue){
				  inputValue=''; 
			  }
			  options[key]=inputValue;
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
							document.URL="./ScanInterFace.php";
							
						} else {
							var msg = data.inforMsg;
							show_err_msg(msg);
						}
					},
					error : function(e) {
						show_err_msg(e.statusText);
					}

				});
	});
});