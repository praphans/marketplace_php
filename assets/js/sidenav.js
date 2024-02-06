var isOpen = false;
$(document).ready(function(){
	$(".tb_toggle_menu").click(function(){
			openNav();						
	});
	$("body").click(function(){
								
	});
	
});
function openNav() {
  	isOpen = true;
  	document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
	isOpen = false;
  	document.getElementById("mySidenav").style.width = "0";
}

