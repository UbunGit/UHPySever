
$(function () {

    /**
     * 保存接口信息
     */
    $(".saveIneface-a").click(function (e) {

        var interFaceName = document.getElementsByName("interFaceName")[0].value;
        var interFaceDescribe = document.getElementsByName("interFaceNameStr")[0].value;
        if (interFaceName == "") {
            alert("接口名称不能为空");
            return false;
        }
        if (interFaceDescribe == "") {
            alert("接口描述信息不能为空");
            return false;
        }
        options = {
            'inefaceMode': 'addInterFace'
        };
        var baseinfo = $(".form-horizontal").serializeArray();
        $.each(baseinfo, function (i, field) {
            options[field.name] = field.value;
        });
        var json = JSON.stringify(options);

        $.ajax({
            type: 'POST',
            url: httpURL_samrtHome,
            data: json,
            dataType: "json",//jsonp数据类型
            contentType: "json",
            success: function (data) {

                if (data.inforCode == 0) {
                    show_err_msg('添加成功');
                    var url = changeURL(location.href, "className", "InterfaceManageVC");
                    location.replace(url)

                } else {
                    var msg = data.result;
                    show_err_msg(msg);
                }
            },
            error: function (e) {
                show_err_msg(e.statusText);
            }

        });
        return false;
    });


    // /**
    //  * 上传
    //  */
    // $('input[id=upload-input]').change(function() {
    //
    //     var formData = new FormData(); // 当前为空
    //     formData.append('username', 'Chris');
    //     formData.append('username1', 'Chri2s');
    //     $.ajax({
    //         url: httpURL_UPAndDown,
    //         type: 'POST',
    //         cache: false,
    //         data: formData,
    //         processData: false,
    //         contentType: false
    //     }).done(function(res) {
    //     }).fail(function(res) {});
    //
    // });

    /**
     * 上传
     */
    $(".upload-a").click(function (e) {

        var formData = new FormData($("#uploadForm")[0]);

        formData.append("upType","1001")
        formData.append("inefaceMode","saveUpFile")


        $.ajax({
            url: httpURL_UPAndDown,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                alert(returndata);
            },
            error: function (returndata) {
                alert(returndata);
            }
        });

    });



    /**
     * 下载
     */
    $(".downInterface-a").click(function (e) {


        options = {
            'inefaceMode': 'getfileUrl',
            'downType':10001
        };

        var json = JSON.stringify(options);

        $.ajax({
            type: 'POST',
            url: httpURL_UPAndDown,
            data: json,
            dataType: "json",//jsonp数据类型
            contentType: "json",
            success: function (data) {

                if (data.inforCode == 0) {
                    var msg = data.result["url"];
                    window.location = msg;

                } else {
                    var msg = data.result;
                    alert(msg);
                }
            },
            error: function (e) {
                show_err_msg(e.statusText);
            }

        });

    });
});
