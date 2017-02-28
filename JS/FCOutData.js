/**
 * 
 */

$(function() {

	var frequencyDataResult = null;// 彩票某一期出球频率数据
	var outData;// 出球数据
	var balanceResult = null;// 比重数据

	var myDate = new Date();
	$("#outDate").val(formatDate(myDate));
	reloadPageData();
	balanceResult = getFC3DDataBalance();
	reloadBalanceTable();

	$(".frequency_outType").change(function(e) {
		reloadFrequency();
	});
	$("#outDate").change(function(e) {
		frequencyDataResult = getfrequencyData($("#outDate").val(), "1001");
		reloadPageData();
	});

	$(".savebalance").click(function(e) {
		var parent = $(this).parent().parent();
		var temvalue = parent.find(".fatherType");
		var balance = parent.find(".balance");
		var fatherCout = parent.find(".fatherCoutvalue");
		replaceFC3DDataBalance(temvalue.html(),fatherCout.html(),balance.find("input").val())
	});

	$(".addBalance").click(function(e) {
		var parent = $(this).parent().parent();
		var temvalue = parent.find(".fatherType input");
		var balance = parent.find(".balance input");
		var fatherCout = parent.find(".fatherCout input");
		replaceFC3DDataBalance(temvalue.val(),fatherCout.val(),balance.val())
	});
	$("#nextDate").click(function(e) {
		var myDate = new Date($("#outDate").val().replace(/-/g,   "/"));
		myDate.setDate(myDate.getDate() + 1)
		$("#outDate").val(formatDate(myDate));
		reloadPageData();
	});
	$("#prewDate").click(function(e) {
		var myDate = new Date($("#outDate").val().replace(/-/g,   "/"));
		myDate.setDate(myDate.getDate() - 1)
		$("#outDate").val(formatDate(myDate));
		reloadPageData();
	});
	
	

	function formatDate(now) {
		var year = now.getFullYear();
		var month = now.getMonth() + 1;
		var date = now.getDate();
		var hour = now.getHours();
		var minute = now.getMinutes();
		var second = now.getSeconds();
		return year + "-" + month + "-" + date;
	}

	function reloadPageData() {
		outData = getoutData($("#outDate").val());
		if (outData) {
			$(".outdataNum").html(
					"当期出球 个：" + outData["out_ge"] + "十：" + outData["out_shi"]
							+ " 百：" + outData["out_bai"]);
			frequencyDataResult = getfrequencyData(outData["outNO"]);
		} else {
			$(".outdataNum").html("当期出球 未知");
			frequencyDataResult = getfrequencyData("99999999");
		}

		reloadFrequency();
	}
	// 刷新频率table
	function reloadFrequency() {
		var tbody = $("#frequencyTable tbody");
		tbody.remove();
		var outType = $(".frequency_outType").find("option:selected").text();
		var table = $("#frequencyTable");
		table.append(getTbodyElement(outType));
	}
	// 刷新比重table
	function reloadBalanceTable() {
		var tbody = $("#FC3DDataBalanceTable tbody");
		tbody.remove();
		var table = $("#FC3DDataBalanceTable");
		table.append(getBalanceTbodyElement());
	}

	// 获取出球频率数据
	function getfrequencyData(outDate, outtype) {
		var options = new Object();
		options['inefaceMode'] = 'getFrequencyData';
		options['outdate'] = outDate;
		options['outType'] = outDate;
		var json = JSON.stringify(options);
		show_loading()
		result = null;
		$.ajax({
			type : 'POST',
			url : httpURL_FCAnalyse,
			data : json,
			dataType : "json",// jsonp数据类型
			contentType : "json",
			async : false,
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

	// 获取出球号码
	function getoutData(outDate) {
		var options = new Object();
		options['inefaceMode'] = 'getFCDatabyOutData';
		options['outdate'] = outDate;
		var json = JSON.stringify(options);
		show_loading()
		result = null;
		$.ajax({
			type : 'POST',
			url : httpURL_FCAnalyse,
			data : json,
			dataType : "json",// jsonp数据类型
			contentType : "json",
			async : false,
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					result = data.result;
				} else {
					var msg = data.result;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
			}
		});
		return result;
	}
	// 获取出球号码
	function getFC3DDataBalance() {
		var options = new Object();
		options['inefaceMode'] = 'getFC3DDataBalance';
		var json = JSON.stringify(options);
		show_loading()
		result = null;
		$.ajax({
			type : 'POST',
			url : httpURL_FCAnalyse,
			data : json,
			dataType : "json",// jsonp数据类型
			contentType : "json",
			async : false,
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					result = data.result;
				} else {
					var msg = data.result;
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
			}
		});
		return result;
	}

	//设置比重数据
	function replaceFC3DDataBalance(fatherType,fatherCout,balance){
		var options = new Object();
		options['inefaceMode'] = 'replaceFC3DDataBalance';
		options['fatherType'] = fatherType;
		options['fatherCout'] = fatherCout;
		options['balance'] = balance;
		var json = JSON.stringify(options);
		show_loading()
		result = null;
		$.ajax({
			type : 'POST',
			url : httpURL_FCAnalyse,
			data : json,
			dataType : "json",// jsonp数据类型
			contentType : "json",
			async : false,
			success : function(data) {
				hidddle_loading();
				if (data.inforCode == 0) {
					alert("修改成功");
					window.location.reload();
				} else {
					alert(data.result);
				}
			},
			error : function(e) {
				hidddle_loading();
				show_err_msg(e.statusText);
			}
		});
	}
	
	function getTbodyElement(type) {
		var datas;
		var outNum;
		
		switch (type) {
		case "个位": {
			datas = new Array("Ge_Zero", "Ge_One", "Ge_Two", "Ge_Three",
					"Ge_Four", "Ge_Five", "Ge_Six", "Ge_Seven", "Ge_Eight",
					"Ge_Nine");
			outNum =(outData)?outData["out_ge"]:10;
		}
			break;
		case "十位": {
			datas = new Array("Shi_Zero", "Shi_One", "Shi_Two", "Shi_Three",
					"Shi_Four", "Shi_Five", "Shi_Six", "Shi_Seven",
					"Shi_Eight", "Shi_Nine");
			outNum =(outData)?outData["out_shi"]:10;
		}
			break;
		case "百位": {
			datas = new Array("Bai_Zero", "Bai_One", "Bai_Two", "Bai_Three",
					"Bai_Four", "Bai_Five", "Bai_Six", "Bai_Seven",
					"Bai_Eight", "Bai_Nine");
			outNum =(outData)?outData["out_bai"]:10;
		}
			break;
		}

		var tablebody = getElement('tbody', {
			"className" : "tbody"
		});
		var frequencyDataResultlength=0;

		for(var js2 in frequencyDataResult){

			frequencyDataResultlength++;

		}
		for ( var i in frequencyDataResult) {

			var count = frequencyDataResult[i];
			var tr = getElement('tr', null);
			var datatd = getElement('td', {
				"className" : "cell",
				"data-title" : "outdate",
				"innerHTML" : i + "期统计"
			});
			tr.append(datatd);
			for ( var j in datas) {
				var data = datas[j];
				redType = (i=="all")?0.6:0.5;
				balancestr =count["balance" + data].toFixed(2);
				balanceresult =  (i=="all")?(balancestr/(frequencyDataResultlength-1)).toFixed(2):balancestr;
				
				if(balanceresult>redType){
					var td = getElement('td', {
						"className" : (outNum ==parseInt(j))?"selectCell":"cell",
						"data-title" : j.toString,
						"innerHTML" : '<ul><li>' + count[data]
								+ '</li><li class="balance_li recommendation">'
								+ balanceresult + '</li></ul>'
					})
				}else{
					var td = getElement('td', {
						"className" : (outNum ==parseInt(j))?"selectCell":"cell",
						"data-title" : j.toString,
						"innerHTML" : '<ul><li>' + count[data]
								+ '</li><li class="balance_li">'
								+ balanceresult + '</li></ul>'
					})
				}
				tr.append(td);
			}
			tablebody.append(tr)
		}
		return tablebody;
	}
	function getBalanceTbodyElement() {
		var tablebody = getElement('tbody', {
			"className" : "tbody"
		});

		var addtr = getElement('tr', null);
		tablebody.append(addtr)

		var fatherTypetd = getElement('td', {
			"className" : "fatherType",
			"data-title" : "outdate",
			"innerHTML" : '<input type="input" value =' + "" + '></input>'
		});
		var fatherCouttd = getElement('td', {
			"className" : "fatherCout",
			"data-title" : "outdate",
			"innerHTML" : '<input type="input" value = ""' + '></input>'
		});
		var balancetd = getElement('td', {
			"className" : "balance",
			"data-title" : "outdate",
			"innerHTML" : '<input type="input" weight="80px" value = ""' + '></input>'
		});
		var savetd = getElement(
				'td',
				{
					"className" : "cell",
					"data-title" : "outdate",
					"innerHTML" : '<input type="button" class="addBalance" value =" 新增"></input>'
				});

		addtr.append(fatherTypetd);
		addtr.append(fatherCouttd);
		addtr.append(balancetd);
		addtr.append(savetd);
		var tr;
		for ( var i in balanceResult) {
			
			var count = balanceResult[i];
			var fatherTypetd = getElement('td', {
				"className" : "fatherType",
				"data-title" : "outdate",
				"width":"20%",
				"innerHTML" : count["fatherType"]
			});
			var fatherCouttd = getElement('td', {
				"className" : "fatherCout",
				"data-title" : "outdate",
				"width":"20%",
				"innerHTML" : '<i class="fatherCoutvalue">'
						+ count["fatherCout"] + '</i>' + '次'
			});
			var balancetd = getElement('td', {
				"className" : "balance",
				"data-title" : "outdate",
				"width":"60%",
				"innerHTML" : '<input type="input" value =' + count["balance"]
						+ '></input>'
			});
			var savetd = getElement(
					'td',
					{
						"className" : "cell",
						"data-title" : "outdate",
						"innerHTML" : '<input type="button" class="savebalance" value ="保存"></input>'
					});

			if(i%4==0){
				linetr = getElement('tr', null);	
			}
			linetd = getElement('td', null);
			tablebody.append(linetr)
			linetr.append(linetd)
			tr = getElement('tr', null);
			linetd.append(tr)
			
			tr.append(fatherTypetd);
			tr.append(fatherCouttd);
			tr.append(balancetd);
			tr.append(savetd);
		
		}
		return tablebody;
	}

});
