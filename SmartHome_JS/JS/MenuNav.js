/**
 * 
 */
$(function() {
	 $('.menuNav').click(function() {
		
	        window.location.href = ($(this).attr("href"));
	   });
	 $('.leftNavMenu').click(function() {
			var path = window.location.protocol+"//"+ window.location.hostname + window.location.pathname+"?interFaceName="+$(this).text();

	        window.location.href = (path);
	    });
	 $('.userInfo').click(function(){
		 alert("kk");
	 });
}); 