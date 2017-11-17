/**
 * 
 */


$(function() {
	
	$('.reload').click(function (e) {

		getInfoList();
	});
	
	$('.logDescription a').click(function (e) {
		var els = document.getElementsByClassName('logDescription'); 
		for(var i=0; i < els.length; i++){
			var el = els[i];
			var hiddendiv = el.getElementsByTagName("span");
			hiddendiv[0].style.display="";//显示  
			hiddendiv[1].style.display="none";//隐藏  
			el.getElementsByTagName("a").innerHTML=" pack up";
		}
		if(this.innerHTML == "[More]"){
			var parentNode =  $(this).parent()[0]; 
			var divnodes = parentNode.getElementsByTagName("span");	
			divnodes[1].style.display="";//显示 
			divnodes[0].style.display="none";//隐藏  
			this.innerHTML="[pack up]";
		}else{
			this.innerHTML="[More]";
		}
		 
		
	});
	
	function getInfoList(){
		var options = new Object(); 
		options['inefaceMode'] ='deleteLog';

		var json = JSON.stringify(options);
		show_loading()
		$.ajax({
			type : 'POST',
			url : httpURL_interFace,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			success : function(data) {
				if(data["inforCode"]==0){
					hidddle_loading();
					alert('删除成功');
					location.reload(); 
				}else{
					hidddle_loading();
					show_err_msg(data["result"]);
				}
				
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
			}
		});
	};
	
	

});