$(function() {

    $(".logout").click(function() {

        alert("注销");
        deleteCookie("userName","");
        deleteCookie('userID',"");
        deleteCookie('userImg',"");

        $url = './index.php';
        go ($url);
    });
});