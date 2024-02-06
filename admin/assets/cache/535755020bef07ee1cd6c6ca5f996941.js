

$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.inbox_theme_menu li a').each(function(){
        var $this = $(this);
		
		
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
			
            $this.parent().addClass('active');
			isActive = true;
        }
    })
})
