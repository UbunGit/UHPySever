/**
 * 
 */
var Script = function () {


    
    var barChartData = {
    		 
            labels : ["January","February","March","April","May","June","July"],
            datasets : [
                {
                    fillColor : "rgba(220,220,220,0.5)",
                    strokeColor : "rgba(220,220,220,1)",
                    data : [65,59,90,81,56,55,400]
                },
                {
                    fillColor : "rgba(151,187,205,0.5)",
                    strokeColor : "rgba(151,187,205,1)",
                    data : [28,48,40,19,96,27,500]
                },
                {
                    fillColor : "rgba(151,187,205,0.1)",
                    strokeColor : "rgba(151,187,205,1)",
                    data : [28,48,40,19,96,27,500]
                }
            ]

        };
  

    function getData(type){
    	var options = new Object(); 
    	options['inefaceMode'] ='recommendData';
    	options['BeginOutNO'] = '20020105';
    	options['EndOutNO'] = '20021230';
    	options['Probability'] = '5';
    	options['outtype'] = type;
    	
    	var json = JSON.stringify(options);
    	show_loading()
    	$.ajax({
    		type : 'POST',
    		url : httpURL_FCAnalyse,
    		data : json,
    		dataType : "json",//jsonp数据类型  
    		contentType : "json",
    		success : function(data) {
    			hidddle_loading();
    			if (data.inforCode == 0) {
    			

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
  
    var gedata = getData("out_ge");
    new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);



}();


