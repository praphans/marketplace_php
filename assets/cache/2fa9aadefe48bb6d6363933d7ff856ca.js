$(function(){
    var controller = config.controller;
	var isActive = false;
	console.log("Current Working in : "+controller+" Controller");
    $('.theme_menu li a').each(function(){
        var $this = $(this);
		$this.parent().removeClass('active');
		
        if($this.attr('href').indexOf(controller) !== -1 && !isActive){
			isActive = true;
            $this.parent().addClass('active');
        }
    })
})