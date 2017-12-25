/**
 *  接口查询页面
 */

$(function() {
	
	/**
	 * 修改接口信息
	 */
	$(".exitinfo-form" ).submit(function(e) {
		
		var repInteFaceName = GetRequest(location.search,"interFaceName");
		var params = $(".exitinfo-form").serialize();  // http request parameters.
        params = decodeURIComponent(params, true );
		var req = GetRequestmap(params);
		var options = new Object(); 
		options['inefaceMode'] ='replaceInteface';
		options['repInteFaceName'] = repInteFaceName;
		Object.assign(options,req)
		replaceInteface(options);
		return false;
	});

    /**
	 * 保存接口信息
     */
	$(".versions-form" ).submit(function(e) {

		var repInteFaceName = GetRequest(location.search,"interFaceName");
		var params = $(".versions-form").serialize();  // http request parameters.   
		params = decodeURIComponent(params, true ); 
		var req = GetRequestmap(params);
		var options = new Object(); 
		options['inefaceMode'] ='replaceInteface';
		options['repInteFaceName'] = repInteFaceName;
		Object.assign(options, req);
		replaceInteface(options);
		return false;
	});

	$(".addInterFace" ).click(function(e) {
        var url =changeURL(location.href,"className","AddInterfaceVC") ;
        location.replace(url)

	});

	$(".deleteInterface-a").click(function (e){

        var repInteFaceName = GetRequest(location.search,"interFaceName");
        var options = new Object();
        options['inefaceMode'] ='deleteInterFace';
        options['inteFaceName'] = repInteFaceName;
        deleteInterFace(options);
        alert(repInteFaceName);
    });

    $(".search-text").blur(function(){
        var url =changeURL(location.href,"searchKey",this.value) ;
        location.replace(url)
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
                    location.reload()

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

    /**
	 *
     */
    function deleteInterFace(options) {
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
                    show_err_msg('删除成功');
                    var url =changeURL(location.href,"interFaceName",null) ;
                    location.replace(url)

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
    }
});

/**
 * 修改参数
 * @param row
 * @param type
 */
function parameterChange(row,type){

	var jqInputs = $('input', row);
	var req = GetRequest(location.search);   
	var repInteFaceName = req['interFaceName'];
	alert(repInteFaceName);
	var options = new Object(); 
	options['inefaceMode'] ='addParametervalue';
	options['parameterFatherName'] = repInteFaceName;
	options['parameterTypeuse'] = type;
	options['parameterName'] =jqInputs[0].value;
	options['parameterDescribe'] =jqInputs[1].value;
	options['parameterCanNil'] =jqInputs[2].value;
	options['parameterBeginVersions'] =jqInputs[3].value;
	options['parameterEndVersions'] =jqInputs[4].value;
	options['parameterType'] =jqInputs[5].value;
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
					location.reload([true]) 
					return true;

				} else {
					var msg = data.result;
					show_err_msg(msg);
					return false;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
				return false;
			}
		});
}

function deleteparameter(row){
	
	var jqInputs = $('input', row);
	var req = GetRequest(location.search);   
	var repInteFaceName = req['interFaceName']; 
	var options = new Object(); 
	options['inefaceMode'] ='deleteParameter';
	options['parameterId'] = row.id;
	var json = JSON.stringify(options);
	alert(json);
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
					location.reload([true]) 
					return true;

				} else {
					var msg = data.result;
					show_err_msg(msg);
					return false;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
				return false;
			}
		});
		
}




