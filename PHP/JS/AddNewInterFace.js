/**
 * 
 */
$(function() {
	
	/**
	 * 保存接口信息
	 */
	$(".saveIneface").click(function(e) {
		var interFaceName = document.getElementsByName("interFaceName")[0].value;
		var interFaceDescribe = document.getElementsByName("interFaceNameStr")[0].value;
		if(interFaceName == ""){
			alert("接口名称不能为空");return false;
		}
		if(interFaceDescribe == "" ){
			alert("接口描述信息不能为空");return false;
		}
		options =  {
				'inefaceMode' :'addInterFace'
			};
		var baseinfo = $(".baseinfo-form").serializeArray();
		$.each(baseinfo, function(i, field){
			options[field.name]=field.value;
		    });
		var json = JSON.stringify(options);
				alert(httpURL_samrtHome+json);
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
