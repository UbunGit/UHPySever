/**
 * 
 */
$(function(){
	$(".requestInterFace").click(function(e){
	
		var inefaceMode = $('.data').attr("data_interFaceName");
		var inefacepath = $('.data').attr("data_interFacePath");

		options =  {
				'inefaceMode' :inefaceMode
			};
		$('.inputValue').each(function (i){
			  var key = $(this).attr("tag");
			  var inputValue = $(this).val();
			  if(!inputValue){
				  inputValue=''; 
			  }
			  options[key]=inputValue;

			});
		var json = JSON.stringify(options);
		
		$.ajax({
			type: 'POST',
			url: 'http://192.168.1.27:8889/'+inefacepath,
			data: json,
	        dataType : "json",//jsonp数据类型  
	        contentType: "json",
			success: function(data){
		
				if (data.inforCode==0){
					var str = JSON.stringify(data,null,'\t'); 
					$('.outPutText').html(str);
				}else{
					var msg = data.inforMsg;
					show_err_msg(msg);	
				}
			},
			error: function (e) {
				show_err_msg(e.statusText);
			}
		});

	});

});