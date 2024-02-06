/*
$(".countdown_container").each(function(){
		var timestamp = $(this).attr("timestamp");
		if(timestamp)countdown(timestamp,$(this));
		console.log(timestamp);
	});
*/
function countdown(eventTime,container){
	var $clock = container,
        eventTime = moment(eventTime, 'DD-MM-YYYY HH:mm').unix(),
        currentTime = moment().unix(),
        diffTime = eventTime - currentTime,
        duration = moment.duration(diffTime * 1000, 'milliseconds'),
        interval = 1000;
	
    if(diffTime > 0) {
        var $d = $('<div class="col-md-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock),
            $h = $('<div class="col-md-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock),
            $m = $('<div class="col-md-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock),
            $s = $('<div class="col-md-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock);
			
        setInterval(function(){

            duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
            var d = moment.duration(duration).asDays(),
                h = moment.duration(duration).hours(),
                m = moment.duration(duration).minutes(),
                s = moment.duration(duration).seconds();

            d = $.trim(d).length === 1 ? '0' + d : d;
            h = $.trim(h).length === 1 ? '0' + h : h;
            m = $.trim(m).length === 1 ? '0' + m : m;
            s = $.trim(s).length === 1 ? '0' + s : s;

            $d.text(Math.round(d)+' วัน');
            $h.text(h+' ชั่วโมง');
            $m.text(m+' นาที');
            $s.text(s+' วินาที');

        }, interval);

    }

}
