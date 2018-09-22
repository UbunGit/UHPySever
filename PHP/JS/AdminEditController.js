$(document).ready(function () {

    var userID = getQueryVariable("userID");
    var adminData;

    var input_adminName = document.getElementById("input-adminName");//用户名
    var input_adminPhone = document.getElementById("input-phone");//手机号码
    var input_adminemail = document.getElementById("input-email");//邮箱地址

    var chokboxArrs = document.getElementsByName("input-permissions");
    var checkbox_admin = document.getElementById("checkbox-admin");//管理员
    var checkbox_coder = document.getElementById("checkbox-coder");//技术
    var checkbox_operator = document.getElementById("checkbox-operator");//运营
    var checkbox_user = document.getElementById("checkbox-user");//用户
    var radio_defual = $("#radio-defual");//解禁
    var radio_stop = $("#radio-stop");//禁用



    if (userID) {
        getadminData();
    }else{
        adminData = {};
    }

    function reloadeUI() {

        input_adminName.value = adminData.userName;
        input_adminPhone.value = adminData.phone;
        input_adminemail.value = adminData.email;
        if (!adminData.permissions) {
            adminData.permissions = "1.0.0.0";
        }
        permissionsarr = adminData.permissions.split(".");
        chokboxArrs.forEach(function (item, index) {
            preval = permissionsarr[item.value];
            item.checked = (preval != 0);
        });
        if (!adminData.status) {
            adminData.status = 0;
        }
        radio_defual.prop("checked", (adminData.status == 0));
        radio_stop.prop("checked", (adminData.status != 0));


    }

    function getadminData() {
        var options = new Object();
        options['inefaceMode'] = 'getAdminInfo';
        options['userID'] = userID;
        var json = JSON.stringify(options);
        show_loading()
        $.ajax({
            type: "POST",
            url: httpURL_interFace,
            data: json,
            dataType: "json",//jsonp数据类型
            headers: {
                "Content-Type": "application/json",
                "userID": "13"
            },
            userID:"12",
            //是否使用缓存
            cache:false,
            success: function (data, msg, request) {
                hidddle_loading();
                if (request.getResponseHeader("resultcode") == 0) {
                    adminData = data;
                    reloadeUI();

                } else {
                    var msg = data;
                    show_err_msg(msg);

                }
            },
            error: function (e) {
                hidddle_loading();
                show_err_msg(e.statusText);
            }
        });
    }

    function replaceUserData() {

        var options = adminData;
        options['inefaceMode'] = 'replaceUserData';
        var json = JSON.stringify(options);
        show_loading()
        $.ajax({
            type: "POST",
            url: httpURL_interFace,
            crossDomain:true,
            headers: {
                "Content-Type": "application/json",
                "userID": "13"
            },
            data: json,
            success: function (data, msg, request) {
                hidddle_loading();
                if (request.getResponseHeader("resultcode") == 0) {
                    show_err_msg("修改成功");

                } else {
                    var msg = data;
                    show_err_msg(msg);

                }
            },
            error: function (e) {
                hidddle_loading();
                show_err_msg(e.statusText);
            }
        });

    }

    function addAdmin() {

        if (adminData.userName.length <= 0) {
            show_err_msg('会员账号不能为空');
            return;
        }
        if(adminData.phone.length!=11){
            show_err_msg('手机号码不能为空');
            return;
        }

        var inputArr = adminData;
        inputArr["inefaceMode"]= "register";
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
                    show_err_msg("添加成功");
                    location.reload();
                }  else {

                    show_err_msg(data);
                }
            },
            error : function(e) {
                show_err_msg(e.statusText);
            }

        });

    }

    $("input[name='input-permissions']").click(function (e) {

        var temprearr = adminData.permissions.split(".");
        temprearr[this.value] = this.checked ? 1 : 0;
        var istrue = false;
        for (var i = temprearr.length; i > 0; i--) {
            if (istrue) {
                temprearr[i] = 1;
            }
            istrue = temprearr[i] == 1;

        }
        temprearr[0] = 1;
        adminData.permissions = temprearr.join(".");
        reloadeUI();
    });
    $("input[name='radio-status']").click(function (e) {

        adminData.status = this.value;
        reloadeUI();
    });

    $("input[name='radio-resetPassword']").click(function (e) {

        adminData.passWord = null;
        reloadeUI();
    });

    $("#a-save").click(function (e) {

        adminData.userName = input_adminName.value;
        adminData.phone = input_adminPhone.value;
        adminData.email = input_adminemail.value;

        if(userID){
            replaceUserData();
        }else {
            adminData.passWord = null;
            addAdmin();
        }

    });

});





