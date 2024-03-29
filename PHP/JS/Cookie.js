/**
 * hours为空字符串时,
 * cookie的生存期至浏览器会话结束。
 * hours为数字0时,
 * 建立的是一个失效的cookie,
 * 这个cookie会覆盖已经建立过的同名、同path的cookie（如果这个cookie存在）。
 */
function setCookie(name,value,hours,path){
  var name = escape(name);
  var value = escape(value);
  var expires = new Date();
   expires.setTime(expires.getTime() + hours*3600000);
   path = path == "" ? "" : ";path=" + path;
   _expires = (typeof hours) == "string" ? "" : ";expires=" + expires.toUTCString();
   document.cookie = name + "=" + value + _expires + path;
}

//获取cookie值
function getCookieValue(name){
  var name = escape(name);
  //读cookie属性，这将返回文档的所有cookie
  var allcookies = document.cookie;    
  //查找名为name的cookie的开始位置
   name += "=";
  var pos = allcookies.indexOf(name);  
  //如果找到了具有该名字的cookie，那么提取并使用它的值
  if (pos != -1){                       //如果pos值为-1则说明搜索"version="失败
    var start = pos + name.length;         //cookie值开始的位置
    var end = allcookies.indexOf(";",start);    //从cookie值开始的位置起搜索第一个";"的位置,即cookie值结尾的位置
    if (end == -1) end = allcookies.length;    //如果end值为-1说明cookie列表里只有一个cookie
    var value = allcookies.substring(start,end); //提取cookie的值
    return (value);              //对它解码   
     }  
  else return "";                //搜索失败，返回空字符串
}
//删除cookie
function deleteCookie(name,path){
	
  var name = escape(name);
  var expires = new Date(0);
   path = path == "" ? "" : ";path=" + path;
   document.cookie = name + "="+ ";expires=" + expires.toUTCString() + path;
}

function GetRequest(url,key) {
      
    var theRequest = new Object();   
    if (url.indexOf("?") != -1) {  
        var str = url.substr(1);    
    }else{
    	var str = url;
    } 
    strs = str.split("&");   
    for(var i = 0; i < strs.length; i ++) {  
        theRequest[strs[i].split("=")[0]]=strs[i].split("=")[1];   
    } 
    return decodeURIComponent(theRequest[key]);
}

function GetRequestmap(url) {

    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
    }else{
        var str = url;
    }
    strs = str.split("&");
    for(var i = 0; i < strs.length; i ++) {
        theRequest[strs[i].split("=")[0]]=strs[i].split("=")[1];
    }
    return theRequest;
}
function getQueryVariable(variable)
{
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}

function go(url) {   
	
	$.ajax({
        type: "GET",
        cache: false,
        url: page+url,
        data: "",
        success: function() {
        	window.location.href = page+url;
        },
        error: function() {
        	window.location.href = page+"404.php";
        }
    });
	return; 
} 

function changeURL(url,arg,arg_val){
	
	    var pattern=arg+'=([^&]*)';
	
	    var replaceText=arg+'='+arg_val;
	
	    if(url.match(pattern)){

	
	        var tmp='/('+ arg+'=)([^&]*)/gi';
            if (arg_val == null){
                tmp=url.replace(eval(tmp),null);
            }else {
                tmp=url.replace(eval(tmp),replaceText);
            }
	        return tmp;

	    }else{
	        if(url.match('[\?]')){
	            return url+'&'+replaceText;
	        }else{
	            return url+'?'+replaceText;
	        }
	    }

	    return url+'\n'+arg+'\n'+arg_val;
	}

function changeFengTOYuan(str) {

    intvalue = parseInt(str);
    if (isNaN(intvalue)){
        return "0.00";
    }else {
        return String((intvalue/100.00).toFixed(2));
    }

    }

  

