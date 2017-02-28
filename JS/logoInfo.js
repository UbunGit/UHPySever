/**
 * 
 */

var EditinputableTable = function () {

	return {

		//main function to initiate the module
		init: function () {
			function restoreRow(oTable, nRow) {
				var aData = oTable.fnGetData(nRow);
				var jqTds = $('>td', nRow);

				for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
					oTable.fnUpdate(aData[i], nRow, i, false);
				}

				oTable.fnDraw();
			}

			function editRow(oTable, nRow) {
				var aData = oTable.fnGetData(nRow);
				var jqTds = $('>td', nRow);
				jqTds[0].innerHTML = '<input type="text" class="form-control small" value="' + aData[0] + '">';
				jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '">';
				jqTds[2].innerHTML = '<input type="text" class="form-control small" value="' + aData[2] + '">';
				jqTds[3].innerHTML = '<input type="text" class="form-control small" value="' + aData[3] + '">';
				jqTds[4].innerHTML = '<input type="text" class="form-control small" value="' + aData[4] + '">';
				jqTds[5].innerHTML = '<input type="text" class="form-control small" value="' + aData[5] + '">';
				jqTds[6].innerHTML = '<a class="delete" href="">delete</a>';
			}

			function saveRow(oTable, nRow) {
				var jqInputs = $('input', nRow);
				oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
				oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
				oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
				oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
				oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
				oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
				oTable.fnUpdate('<a class="delete" href="">delete</a>', nRow, 6, false);
				oTable.fnDraw();
			}

			function cancelEditRow(oTable, nRow) {
				var jqInputs = $('input', nRow);
				oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
				oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
				oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
				oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
				oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
				oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
				oTable.fnUpdate('<a class="delete" href="">delete</a>', nRow, 6, false);
				oTable.fnDraw();
			}

			var oTable = $('#editable-input').dataTable({
				"aLengthMenu": [
					[10, 50, 100, -1],
					[10, 50, 100, "All"] // change per page values here
					],
					// set the initial value
					"iDisplayLength": 10,
					"sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
					"sPaginationType": "bootstrap",
					"oLanguage": {
						"sLengthMenu": "_MENU_",
						"oPaginate": {
							"sPrevious": "Prev",
							"sNext": "Next"
						}
					},
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [0]
					}
					]
			});

			jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
			jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

			var nEditing = null;

			$('#editable-input a.delete').live('click', function (e) {
				e.preventDefault();

				if (confirm("Are you sure to delete this row ?") == false) {
					return;
				}

				var nRow = $(this).parents('tr')[0];
				oTable.fnDeleteRow(nRow);
			});
		}

	};

}();

$(function() {
	$('.reload').click(function (e) {

		getInfoList();
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