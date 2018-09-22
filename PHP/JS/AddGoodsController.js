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
            success: function (data,scress,request) {

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
};
$(function () {

    var goodsData = null;
    var goosID =GetRequest(location.href,"goodsID");


    function reloadUI() {

        $("#text_goodsName").val(goodsData.goodsName);
        $("#text_goodsType").val(goodsData.goodsType);
        $("#text_goodsReserve").val(goodsData.goodsReserve);
        $("#text_goodsNO").val(goodsData.goodsNO);

        $("#text_goodsCostPrice").val(goodsData.goodsCostPrice);
        $("#text_goodsPrice").val(goodsData.goodsPrice);
        $("#text_goodsDiscount").val(goodsData.goodsDiscount);
        $("#text_goodsMinPrice").val(goodsData.goodsMinPrice);


    }

    function replaceGoodsInfo(){

        param = {}
        var baseinfo = $(".goodsinfo_from").serializeArray();

        $.each(baseinfo, function (i, field) {
            param[field.name] = field.value;
        });
        param["goodsID"] = goosID;

        options = {
            'metho': 'replaceGoodsInfo',
            'param':param
        };
        var jsonstr = JSON.stringify(options);

        $.ajax({

            url: httpURL_Shoping,
            type: 'POST',
            data: jsonstr,
            dataType : "json",// jsonp数据类型
            processData: false, // 告诉jQuery不要去处理发送的数据
            contentType: false, // 告诉jQuery不要去设置Content-Type请求头
            success: function (data,scress,request) {
                var resuleCode = request.getResponseHeader("resultcode");
                if (resuleCode == 0) {
                    show_err_msg ('添加成功！');
                    var url = changeURL(location.href , "className", "GoodsListController");
                    location.replace(url)
                }else{
                    show_err_msg(data.result);
                }
            },
            error: function (data) {
                show_err_msg("添加失败");
            }
        })
    }
    function addGoodsInfo(){

        param = {}
        var baseinfo = $(".form-baseinfo").serializeArray();

        $.each(baseinfo, function (i, field) {
            param[field.name] = field.value;
        });

        options = {
            'metho': 'updataGoods',
            'param':param
        };
        var jsonstr = JSON.stringify(options);

        $.ajax({

            url: httpURL_Shoping,
            type: 'POST',
            data: jsonstr,
            dataType : "json",// jsonp数据类型
            processData: false, // 告诉jQuery不要去处理发送的数据
            contentType: false, // 告诉jQuery不要去设置Content-Type请求头
            success: function (data,scress,request) {
                var resuleCode = request.getResponseHeader("resultcode");
                if (resuleCode == 0) {
                    show_err_msg ('添加成功！');
                    var url = changeURL(location.href , "className", "GoodsListController");
                    location.replace(url)
                }else{
                    show_err_msg(data.result);
                }
            },
            error: function (data) {
                show_err_msg("添加失败");
            }
        })
    }


    function getGoodsInfo() {

        param = {}
        var baseinfo = $(".form-baseinfo").serializeArray();

        $.each(baseinfo, function (i, field) {
            param[field.name] = field.value;
        });

        options = {
            'metho': 'getgoodsInfoByID',
            'param':{"goodsID":goosID}
        };
        var jsonstr = JSON.stringify(options);

        $.ajax({

            url: httpURL_Shoping,
            type: 'POST',
            data: jsonstr,
            dataType : "json",// jsonp数据类型
            processData: false, // 告诉jQuery不要去处理发送的数据
            contentType: false, // 告诉jQuery不要去设置Content-Type请求头
            success: function (data,scress,request) {
                var resuleCode = request.getResponseHeader("resultcode");
                if (resuleCode == 0) {
                    goodsData = data;
                    reloadUI();
                }else{
                    show_err_msg(data.result);
                }
            },
            error: function (data) {
                show_err_msg("添加失败");
            }
        })
    }

    $(".goods-info-a").click(function (e) {
        if(goosID){
            replaceGoodsInfo();
        }else {
            addGoodsInfo();
        }
    });
    getGoodsInfo();

});


