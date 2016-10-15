/**
 * 
 */

/**
 * 
 */
$(function() {
	 $('.memberNo').click(function() {
//		alert($(this).attr("value"))
	        window.location.href = './MemberInfo.php?memberNo='+($(this).attr("value"));
	   });
	 
}); 