var adminTable;
$(document).ready(function () {

    adminTable = $('#admin_table').DataTable({

        "ajax":
            {
                type: "POST",
                url: httpURL_interFace,
                contentType: "application/json; charset=utf-8",
                data: function () {
                    var options = new Object();
                    options['inefaceMode'] = 'getAdminList';
                    return JSON.stringify(options);
                },
                dataSrc: ""
            },
        "columns": [
            {"data": "userName"},
            {"data": "permissions"},
            {"data": "phone"},
            {"data": "status"},
            {"data": null},
        ],
        "columnDefs": [

            {
                "targets": 4,
                "render": function ( data, type, full, meta ) {
                    return  '<button class="btn btn-primary btn-xs btn-Edit"><i class="fa fa-pencil"></i></button><button class="btn btn-primary btn-xs btn-remove"><i class="fa fa-trash"></i></button>';
                }
            }

        ]
    });


//新增管理员
    $('#admin_add_btn').click(function (e) {
        $url = './index.php?className=AdminEditController';
        go ($url);
    });

//修改管理员信息
    $('.btn-Edit').live('click', function (e) {

        var nRow = $(this).parents('tr')[0];
        var data = adminTable.row( nRow ).data();
        $url = './index.php?className=AdminEditController&userID='+data.userID;
        go ($url);

    });

//删除管理员
    $('.btn-remove').live('click', function (e) {

        var nRow = $(this).parents('tr')[0];
        var data = adminTable.row( nRow ).data();
        if (confirm("是否确定删除会员："+data.userName+" ?") == false) {
            return;
        }
        var inputArr = {};
        inputArr["inefaceMode"]= "removeAdmin";
        inputArr["userID"]= data.userID;
        var json = JSON.stringify(inputArr);
        $.ajax({
            type : 'POST',
            url : httpURL_interFace,
            data : json,
            headers: {
                "Content-Type": "application/json",
                "userID": "13"
            },
            success : function(data, msg, request) {

                if (request.getResponseHeader("resultcode") == 0) {
                    show_err_msg("删除成功");
                    location.reload();

                }  else {

                    show_err_msg(data);
                }
            },
            error : function(e) {
                show_err_msg(e.statusText);
            }

        });
    });
});





