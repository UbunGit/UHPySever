$(function () {

    goodsListdata = null;
    goodsListSection = document.getElementById("goodsListSection");

    function reloadGoodsList() {

        $.each(goodsListdata, function (i, goods) {

            var goodsdiv = document.createElement("div");
            goodsdiv.setAttribute("class","col-md-4 goodsDiv");
            goodsdiv.onclick = function () {
                var url = changeURL(location.href , "className", "AddGoodsController","goodsID",goods.goodsID);
                url = url+'&goodsID='+goods.goodsID
                location.replace(url)
            }

            var goodsSection = document.createElement("section");
            goodsSection.setAttribute("class","panel");


            var imagediv= document.createElement("div");
            imagediv.setAttribute("class","pro-img-box");

            var image= document.createElement("img");
            image.setAttribute("src",goods.goodsImage);

            var addcar= document.createElement("a");
            addcar.setAttribute("class","adtocart");

            var addcari= document.createElement("i");
            addcari.setAttribute("class","fa fa-shopping-cart");

            addcar.appendChild(addcari);
            imagediv.appendChild(image);
            imagediv.appendChild(addcar);

            var titlediv = document.createElement("div");
            titlediv.setAttribute("class","panel-body text-center");

            var titleh= document.createElement("h4");
            var titlea= document.createElement("a");
            titlea.setAttribute("class","pro-title");
            titlea.innerText = goods["goodsName"];
            titleh.appendChild(titlea)

            var pricediv= document.createElement("div");
            pricediv.setAttribute("class","m-bot15");


            var strong= document.createElement("strong");
            strong.innerText = "原价:";

            var span= document.createElement("span");
            span.setAttribute("class","amount-old");
            span.innerText = changeFengTOYuan(goods.goodsPrice);



            var discountspan= document.createElement("span");
            discountspan.setAttribute("class","pro-price");
            discountspan.innerText = changeFengTOYuan(parseInt(goods.goodsPrice) *parseInt(goods.goodsDiscount));

            var goodsNO= document.createElement("p");
            goodsNO.innerText = "编号:"+goods.goodsNO;

            pricediv.appendChild(strong);
            pricediv.appendChild(span);
            pricediv.appendChild(discountspan);
            pricediv.appendChild(goodsNO);


            titlediv.appendChild(titleh)
            titlediv.appendChild(pricediv)

            goodsSection.appendChild(imagediv);
            goodsSection.appendChild(titlediv);
            goodsdiv.appendChild(goodsSection);
            goodsListSection.appendChild(goodsdiv);

        });

    }

    $(".add-btn").click(function (e) {

        var url = changeURL(location.href , "className", "AddGoodsController");
        location.replace(url)
    });



    function getGoodsList() {

        options = {
            'metho': 'getgoodsList',
            'param':{}
        };
        var jsonstr = JSON.stringify(options);
        $.ajax({
            type: 'POST',
            url: httpURL_Shoping,
            data: jsonstr,
            dataType: "json",//jsonp数据类型
            contentType: "json",
            success: function (data,scress,request) {
                var resuleCode = request.getResponseHeader("resultcode");
                if (resuleCode == 0) {
                    goodsListdata = data;
                    reloadGoodsList();
                }else{
                    show_err_msg(data.result);
                }
            },
            error: function (data) {
                show_err_msg("添加失败");
            }

        });

    }
    getGoodsList();

});