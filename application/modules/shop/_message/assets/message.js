/*$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.inbox_tabs_nav li a').each(function(){
        var $this = $(this);
		console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
            //$this.parent().addClass('active');
			//isActive = true;
        }
    })
})*/
$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.inbox_theme_menu li a').each(function(){
        var $this = $(this);
		//console.log($this.attr('href')+" : "+current+" | "+$this.attr('href').indexOf(current));
		
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
			//console.log($this.attr('href')+" : "+current);
            $this.parent().addClass('active');
			isActive = true;
        }
    })
})
