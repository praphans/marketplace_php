$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.tabs_nav li a').each(function(){
        var $this = $(this);
		console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
            $this.parent().addClass('active');
			isActive = true;
        }
    })
})
$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.theme_menu li a').each(function(){
        var $this = $(this);
		//console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
            $this.parent().addClass('active');
			isActive = true;
        }
    })
})