/**
 * 
 */

$(function() {
	

	function getData(type,count,beginData,enddate){
		var options = new Object(); 
		options['inefaceMode'] ='recommendData';
		options['BeginOutNO'] = beginData;
		options['EndOutNO'] = enddate;
		options['Probability'] = count;
		options['outtype'] = type;

		var json = JSON.stringify(options);
		show_loading()
		var result = null;
		$.ajax({
			type : 'POST',
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
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
			}
		});
		return result;
	}
	function reloadBar(){
		var count = $(".form-control").find("option:selected").text();
		var beginData = $("#begindate").val();
		var enddate =$("#enddate").val();
		var barChartData = {

				labels : [],
				datasets : [
					{
						fillColor : "#6ccac9",
						strokeColor : "#6ccac9",
						data : []
					},
					{
						fillColor : "#ff6c60",
						strokeColor : "#ff6c60",
						data : []
					},
					{
						fillColor : "#f8d347",
						strokeColor : "#f8d347",
						data : []
					}
					]
		};
		var gedata = getData("out_ge",count,beginData,enddate);
		for(var value in gedata){  

			barChartData.labels.push(value);
		}
		var shidata = getData("out_shi",count,beginData,enddate);
		for(var value in shidata){  

			barChartData.labels.push(value);
		}
		var baidata = getData("out_bai",count,beginData,enddate);
		for(var value in baidata){  

			barChartData.labels.push(value);
		}
		barChartData.labels =sortnique(barChartData.labels);
		for(var i in barChartData.labels){
			var count = barChartData.labels[i];
			barChartData.datasets[0].data.push(gedata[count]);
			barChartData.datasets[1].data.push(shidata[count])
			barChartData.datasets[2].data.push(baidata[count])
		}
		document.getElementById("bar").height="300";
		document.getElementById("bar").width="600";
		new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
	}
	
	$(".form-control").change(function(e){
		
		reloadBar();
	});
	$("#begindate").change(function(e){
		
		reloadBar();
	});
	
	$("#enddate").change(function(e){
		
		reloadBar();
	});
	
	reloadBar();

});


