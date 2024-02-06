$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.tags_cloud li a,.theme_menu li a').each(function(){
        var $this = $(this);
		
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
            $this.parent().addClass('active');
			isActive = true;
        }
    })
})
