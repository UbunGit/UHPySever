/**
 * 
 */


$(document).ready(function() {
	options =  {
			'inefaceMode' :'getfactionList'
		};
	options['fatherId']='0';
	var json = JSON.stringify(options);
	
	$.ajax({
		type: 'POST',
		url: httpURL_interFace,
		data: json,
        dataType : "json",//jsonp数据类型  
        contentType: "json",
		success: function(data){
			reloadPageList(data);
		},
		error: function (e) {
			show_err_msg(e.statusText);
		}
	});
});

function reloadPageList(data){
	
	if (data.inforCode==0){
		var x = document.getElementsByClassName("pageList")[0];
		var listdata = data.result;
		for (i = 0; i < listdata.length; i++) {
			var datadic = listdata[i];
			x.innerHTML = '<tr>\
			<td><a  href="'+datadic.url+' ">'+ datadic.remark +' </a></td>\
           <tr>';
		}
	}else{
		var x = document.getElementsByClassName("pageList")[0];
		x.innerHTML = '<tr>\
							<td>添加新功能:</td>\
						</tr>\
						<tr>\
							<td><input class="newIntetFace" tag="parameterName" type="text"></input></td>\
						</tr>\
						<tr>\
							<td><button class="saveParameter">确定</button></td>\
						</tr>';
	}
}

$(function() {
	/**
	 * 接口添加参数
	 */
	$('.saveParameter').click(function(){
		var interFaceName = $('.newIntetFace').text();
	
		options =  {
				'inefaceMode' :'addParametervalue',
				'parameterFatherName' :interFaceName
			};
		$('.parameterVal').each(function (i){
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