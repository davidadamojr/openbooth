$(document).ready(function(){
	//transition effects between pages
	$("body").css("display", "none");
	$("body").fadeIn(1000);

	$("a.transition").click(function(event){
        event.preventDefault();
        linkLocation = this.href;
        $("body").fadeOut(500, redirectPage);     
    });
         
    function redirectPage() {
        window.location = linkLocation;
    }
})