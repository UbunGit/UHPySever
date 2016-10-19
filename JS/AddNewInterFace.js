/**
 * 
 */
$(function() {
	$.validator.setDefaults({
        submitHandler: function() { alert("submitted!"); }
    });

	/*
	 * 取消编辑1 查看 2修改 3 新增
	 */
	$('.cancelEdit').click(function(){
		window.location.href="./ScanInterFace.php";
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

$('#submit').click(function(){	 
	 $("from").validate({
		 
	        rules: {
	            session_name: "required",
	            session_start_date: "required",
	            session_end_date: "required",
	        },
	        messages: {
	            session_name: "Please enter an identification for the session",
	            session_start_date: "Please enter a start date for the session",
	            session_end_date: "Please enter a end date for the session",
	        }
		 
	    });
	});
