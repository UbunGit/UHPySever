/**
 *  输出历史出球号码
 */
$(function() {

	function getHistoryData(pageSize,pageNum){
		var pageNum = (GetRequest(location.href,"pageNum"))?GetRequest(location.href,"pageNum"):1;
		var options = new Object(); 
		options['inefaceMode'] ='getOmitData';
		options['pageNum'] = pageNum.toString();
        options['pageSize'] = pageSize;
		var json = JSON.stringify(options);
		show_loading()
		$.ajax({
			type : "POST",
			url : httpURL_FCAnalyse,
			data : json,
			dataType : "json",//jsonp数据类型  
			contentType : "json",
			async:false,
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					result = data.result;
					
				} else {
					var msg = data.result;
					show_err_msg(msg);
					return null;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
				return null;
			}
		});
		return result;
	}
	function showhistorydata(type){
	
		var table = $("table");
		var thead= $("table thead");
		var tr1 = getElement('tr',null);
		var th4 = getElement('th',{"innerHTML":"期数",});
        var th6 = getElement('th',{"innerHTML":"出球",});
		tr1.append(th4);
        tr1.append(th6);
		for(i=0;i<10;i++){
			var istr= i.toString()
			var th5 =getElement('th',{"className":"numeric","innerHTML":istr});
			tr1.append(th5);
		}
		thead.append(tr1);
		table.append(getHistoryTbodyElement(type));
         
	}
	function getHistoryTbodyElement(type){
		var datas;
		switch (type){
			case "个位":{
				datas=new Array("Ge_Zero","Ge_One","Ge_Two","Ge_Three","Ge_Four","Ge_Five","Ge_Six","Ge_Seven","Ge_Eight","Ge_Nine");
			}break;
			case "十位":{
				datas=new Array("Shi_Zero","Shi_One","Shi_Two","Shi_Three","Shi_Four","Shi_Five","Shi_Six","Shi_Seven","Shi_Eight","Shi_Nine");
			}break;
			case "百位":{
				datas=new Array("Bai_Zero","Bai_One","Bai_Two","Bai_Three","Bai_Four","Bai_Five","Bai_Six","Bai_Seven","Bai_Eight","Bai_Nine");
			}break;
		}
		
		var tablebody =getElement('tbody',{"className":"tbody"});
		for(var i in result){
			
			var count = result[i];
			var tr =getElement('tr',null);
			var datatd = getElement('td',{"className":"cell","data-title":"outdate","innerHTML":count['outdate']});
			tr.append(datatd);

            var datatd1 = getElement('td',{"className":"cell","data-title":"outdate","innerHTML":count['outdata']});
            tr.append(datatd1);
			for(var j in datas){
				var data = datas[j];
				var td =  returnCell(count,j,data)
				tr.append(td);
			}
			tablebody.append(tr)
		}
		
		return tablebody;
		
	}
	
	function returnCell(celldata,cellline,cellkey){
		
		if(celldata[cellkey] == 0){
			return  getElement('td',{"className":"selectCell","data-title":cellline.toString,"innerHTML":cellline});
		}else{
			return getElement('td',{"className":"cell","data-title":cellline,"innerHTML":celldata[cellkey]});
		}
	}

	$(".outType").click(function(e){

	      $(this).addClass("selectType");
	      $(this).siblings().removeClass("selectType");
	      var table= $("table");
	      var tbody= $("table tbody");
	      tbody.remove();
	      table.append(getHistoryTbodyElement($(this).text()));
	});
    $(".pageNum-a").click(function(){

    	endPageNum = this.innerHTML;
        var url =changeURL(location.href,"pageNum",endPageNum);
        location.replace(url)

    });

	if(!result){
		var result = getHistoryData('10','1');
	}
	showhistorydata("个位");
});
