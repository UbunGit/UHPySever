var msgdsq;
//错误时：提示调用方法
function show_err_msg(msg){
	 $('.msg_bg').html('');
	 clearTimeout(msgdsq);
	 $('body').append('<div class="sub_err" style="position:absolute;top:60px;left:25%;width:auto;z-index:999999;"></div>');
	 var errhtml='<div  class="bac" style="padding:8px 0px;border:1px solid #ff0000;width:100%;margin:0 auto;background-color:#fff;color:#B90802;border:3px #ff0000 solid;text-align:center;font-size:16px;font-family:微软雅黑;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>';
	 var errhtmlfoot='</div>';	 
	 $('.msg_bg').height($(document).height());
	 $('.sub_err').html(errhtml+msg+errhtmlfoot);
	 var left=($(document).width()-$('.sub_err').width())/2;
	 $('.sub_err').css({'left':left+'px'});
	 var scroll_height=$(document).scrollTop(); 
	 $('.sub_err').animate({'top': scroll_height+120},300);
	 msgdsq=setTimeout(function(){				     
		 $('.sub_err').animate({'top': scroll_height+80},300);
		 setTimeout(function(){
			 $('.msg_bg').remove();
			 $('.sub_err').remove();
		 },300);
	 }, "1000"); 
}

//正确时：提示调用方法
function show_msg(msg,url){	
     $('.msg_bg').html('');
	 clearTimeout(msgdsq);
	 $('body').append('<div class="sub_err" style="position:absolute;top:60px;left:0;width:500px;z-index:999999;"></div>');
	 var htmltop='<div class="bac" style="padding:8px 0px;border:1px solid #090;width:100%;margin:0 auto;background-color:#FFF2F8;color:#090;border:3px #090 solid;;text-align:center;font-size:16px;"><img style="margin-right:10px;" src="../resource/loading.gif">';
	 var htmlfoot='</div>';
	 $('.msg_bg').height($(document).height());
	 var left=($(document).width()-500)/2;
	 $('.sub_err').css({'left':left+'px'});
	 $('.sub_err').html(htmltop+msg+htmlfoot);
	 var scroll_height=$(document).scrollTop(); 
	 $('.sub_err').animate({'top': scroll_height+120},500);	 
	 msgdsq=setTimeout(function(){	    
		   $('.sub_err').animate({'top': scroll_height+80},500);
		   setTimeout(function(){
			   $('.msg_bg').remove();
			   $('.sub_err').remove();
			   if(url!='')
			   {	     
				  location.href=url;
			   }		   
		   },800);	 
		   
	 }, "1200");  
}

//显示加载动画
function show_loading()
{
	
	var str='<div class="loading" style="z-index:99999;width:100%;position:absolute;left:0;top:0;text-align:center;">\
		<span class="fangkuang">\
		<i class="fa fa-spinner fa-spin fa-5x fa-fw" aria-hidden="true"></i>\
		</span>\
		</div>'
	$('body').append(str);
	var scroll_height=$(document).scrollTop(); 
	$('.loading').height($(document).height());
	$('.fangkuang').animate({'top': scroll_height+80},500);
	$('.fangkuang').css('width','200px');
	$('.fangkuang').css('height','240px');
	$('.fangkuang').css('background','rgba(0, 0, 0, 0.84)');
	$('.loading').css('background','rgba(0, 0, 0, 0.24)');
}

//显示加载动画
function hidddle_loading()
{
	$('.loading').remove();
}

/**
 * 去重排序
 * @param arr
 * @returns
 */
function sortnique(array){

	var n = [];//临时数组
    for(var i = 0;i < array.length; i++){
        if(n.indexOf(array[i]) == -1) n.push(array[i]);
    }
    var sortedArr = n.sort();
	return sortedArr;
}




