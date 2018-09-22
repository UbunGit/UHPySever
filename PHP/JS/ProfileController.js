
function imgPreview(fileDom) {
    //判断是否支持FileReader
    if(window.FileReader) {
        var reader = new FileReader();
    } else {
        alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
    }
    //获取文件
    var file = fileDom.files[0];
    var imageType = /^image\//;
    //是否是图片
    if(!imageType.test(file.type)) {
        alert("请选择图片！");
        return;
    }
    //读取完成
    reader.onload = function(e) {
        //获取图片dom
        var img = document.getElementById("head_image");
        //图片路径设置为读取的图片
        img.src = e.target.result;

        var options = new FormData();
        options.append('file', file);  //添加图片信息的参数
        options.append('upType',1002);  //类型
        options.append('inefaceMode','saveUpFile');
        options.append('userID',getCookieValue("userID"));


        $.ajax({

            url: httpURL_UPAndDown,
            type: 'POST',
            cache: false, //上传文件不需要缓存
            data: options,
            dataType : "json",// jsonp数据类型
            processData: false, // 告诉jQuery不要去处理发送的数据
            contentType: false, // 告诉jQuery不要去设置Content-Type请求头
            success: function (data) {

                if(data.infoCode==0){
                    show_err_msg ('上传成功！');
                    var userInfo = data.result;
                    setCookie('headImage', userInfo.headImage, 20, "");
                    location.reload();
                }else{
                    show_err_msg(data.result);
                }
            },
            error: function (data) {
                show_err_msg("上传失败");
            }
        })
    };
    reader.readAsDataURL(file);
}


$(function() {


    $(".btn-save").click(function() {


        var inputArr = {
            "inefaceMode" : "replaceUserData",
            "userID" : getCookieValue("userID"),
            "userName" : $("input[name='username']").val(),
            "phone" : $("input[name='phone']").val(),
            "email" : $("input[name='email']").val()
        };
        var json = JSON.stringify(inputArr);

        $.ajax({
            type : 'POST',
            url : httpURL_interFace,
            data : json,
            dataType : "json",// jsonp数据类型
            contentType : "json",
            success : function(data) {

                if (data.infoCode == 0) {

                    setCookie('userName', inputArr.userName, 20, "");
                    setCookie('phone', inputArr.phone, 20, "");
                    setCookie('email', inputArr.email, 20, "");
                    location.reload();

                } else {
                    var msg = data.result;
                    show_err_msg(msg);
                }
            },
            error : function(e) {
                show_err_msg(e.statusText);
            }
        });

    });
});


