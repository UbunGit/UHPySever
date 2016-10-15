/**
 *  接口查询页面
 */

$(function() {
	/*
	 * 取消编辑1 查看 2修改 3 新增
	 */
	$('.cancelEdit').click(function(){
		window.location.href="./ScanInterFace.php";
	});
	
	/*
	 * 添加新接口1 查看 2修改 3 新增
	 */
	$('.addNewInterFace').click(function(){
		window.location.href="./AddNewInterFace.php";
	});
	
	/*
	 * 修改接口1 查看 2修改 3 新增
	 */
	$('.changeInterFace').click(function(){
		var inefaceMode = $('.data').attr("data_interFaceName");
		window.location.href='./EditInterFace.php?interFaceName='+inefaceMode;
	
	});


});