$(document).ready(function() {

	//Default Action
	$(".container > div > div").hide(); //Hide all content
	$(".container > ul > li:first").addClass("active").show(); //Activate first tab
	$(".container > div > div:first").show(); //Show first tab content

	//On Click Event
	$(".container > ul > li").click(function(){
		$(".container > ul > li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".container > div > div").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
});
