/*!
 * jQuery 3D Watertank Plugin
 * Original author: @ajeeshvijay
 * Version: 1.0.2
 */

(function ( $ ) {
 
    $.fn.waterTank = function( options, extra ) {	
        var settings = $.extend({
            color: "#6ecff6",
            level: 33
        }, options );
        jQuery.extend( 
            jQuery.easing, { 
                _linear: function (t) { 
                    return t 
                }, 
                _easeInQuad: function (t) { return t*t }, _easeOutQuad: function (t) { return t*(2-t) }, _easeInOutQuad: function (t) { return t <.5 ? 2*t*t : -1+(4-2*t)*t }, 
                _easeInCubic: function (t) { return t*t*t },  _easeOutCubic: function (t) { return (--t)*t*t+1 }, _easeInOutCubic: function (t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 }, 
                _easeInQuart: function (t) { return t*t*t*t }, _easeOutQuart: function (t) { return 1-(--t)*t*t*t }, _easeInOutQuart: function (t) { return t<.5 ? 8*t*t*t*t : 1-8*(--t)*t*t*t }, 
                _easeInQuint: function (t) { return t*t*t*t*t }, _easeOutQuint: function (t) { return 1+(--t)*t*t*t*t }, 
                _easeInOutQuint: function (t) { return t<.5 ? 16*t*t*t*t*t : 1+16*(--t)*t*t*t*t } });

        var speed = 500;

       	function _updateTank($that, value, valortanque){

       		$that.find('._tank').fadeIn(1);
		    $that.find('._balance').stop().animate({
	        	height: $that.find('._tank').height() * ( valortanque - value ) / valortanque,
	        },{ 
		    	duration: speed,  
			    step: function() { $that.find('._balance').css("overflow","visible"); }, 
			    complete: function() { $that.find('._balance').css("overflow","visible"); },
			    easing: "_easeOutQuint"
			});
	        $that.find('._filled').stop().animate({
	        	height: $that.find('._tank').height() * value / valortanque ,
        		opacity: 1
	        },{ 
		    	duration: speed,  
			    step: function() { $that.find('._filled').css("overflow","visible"); }, 
			    complete: function() { $that.find('._filled').css("overflow","visible"); },
			    easing : "_easeOutQuint"
			});
			$that.find('._percentageTag').text();

       	}
        var tilt = {
        	'-webkit-transform' : 'rotateX(65deg) translateZ(0px)',
        	'-moz-transform' : 'rotateX(65deg) translateZ(0px)',
        	'-o-transform' : 'rotateX(65deg) translateZ(0px)',
        	transform : 'rotateX(65deg) translateZ(0px)',
        	'-moz-transform-style': 'preserve-3d',
        	'-webkit-transform-style': 'preserve-3d',
        	'transform-style': 'preserve-3d',
        }
        if (typeof options == 'number') {
		    _updateTank($(this), options);
        }else if(typeof options == 'string'){
        	if (options == 'screenshot') {
        		var output = {};
        		var $this = $(this);
        		var w = $this.width();
        		var h = $this.height();

				var $tank    = $this.find('._tank');
				var $balance = $this.find('._balance');
				var $filled  = $this.find('._filled');
	        	var ovalHeight = 177;
	        	    ovalHeight = $tank.width()/2.36;
	        	var color = $this.data('options').color;
	        	var greyColor = $balance.css('background-color');
	        	var toInt = function(px){
	        		return new Number(px.replace('px', ''));
	        	}
	        	var hexToRgbA = function(hex, alpha){
	        		alpha = alpha || '1';
	        	    var c;
	        	    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
	        	        c= hex.substring(1).split('');
	        	        if(c.length== 3){
	        	            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
	        	        }
	        	        c= '0x'+c.join('');
	        	        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+','+alpha+')';
	        	    }
	        	    throw new Error('Bad Hex');
	        	}
	        	var ellipse = function (ctx, x, y, w, h, c, img, shadow) {
	        	  var kappa = .5522848,
	        	      ox = (w / 2) * kappa, // control point offset horizontal
	        	      oy = (h / 2) * kappa, // control point offset vertical
	        	      xe = x + w,           // x-end
	        	      ye = y + h,           // y-end
	        	      xm = x + w / 2,       // x-middle
	        	      ym = y + h / 2;       // y-middle
	        	   var shadow = shadow || { blur : 0, color: '#000' };
	        	  ctx.beginPath();
	        	  ctx.moveTo(x, ym);
	        	  ctx.bezierCurveTo(x, ym - oy, xm - ox, y, xm, y);
	        	  ctx.bezierCurveTo(xm + ox, y, xe, ym - oy, xe, ym);
	        	  ctx.bezierCurveTo(xe, ym + oy, xm + ox, ye, xm, ye);
	        	  ctx.bezierCurveTo(xm - ox, ye, x, ym + oy, x, ym);
	        	  if (img) {
					  ctx.save();
  		        	  ctx.clip();
  		        	  ctx.beginPath();
  		        	  ctx.translate(w, 0);
  		        	  ctx.scale(-1, 1);
  	    			  ctx.drawImage($this.find('._canvas').get(0), ($balance.width()/100) - x, y, $balance.width(), $balance.width()/2);
  	    			  ctx.restore();
	        	  }else{
        	  		if (shadow) {
        	  			ctx.shadowBlur= shadow.blur;
        	  			ctx.shadowColor= shadow.color;
        	  			if (shadow.offsetX) {
        	  				ctx.shadowOffsetX= shadow.offsetX;
        	  			}
        	  		}
		        	ctx.fillStyle = c;
		        	ctx.fill();
	        	  }
	        	}
	        	var rect = function(ctx, x, y, w, h, c){
	        		ctx.beginPath();
	        		ctx.rect(x, y, w, h);
	        		ctx.fillStyle = c;
	        		ctx.fill();
	        	}
        		var canvas = document.createElement('canvas');
        		canvas.width = w;
        		canvas.height = h + 100;
        		canvas.style.zIndex = 8;
        		canvas.style.position = "absolute";
        		canvas.style.border = "1px solid";
				var ctx=canvas.getContext("2d");
				var x = toInt($tank.css('margin-left')) ; 
				var y = toInt($tank.css('margin-top')); 
				rect(ctx, 0, 0, canvas.width, canvas.height, '#fff');
				var gradient = ctx.createLinearGradient(0,0, 0, Number(y + $balance.height() + $filled.height() + $this.find('._reflect').height() ));
				gradient.addColorStop(0, color);
				gradient.addColorStop(1,"white");
				ctx.beginPath();
				rect(ctx, x, Number(y + $balance.height() + $filled.height()), $balance.width(), $this.find('._reflect').height(), gradient);
				ctx.beginPath();
				ellipse(ctx, x, Number(y + $balance.height() + $filled.height()) - (ovalHeight/2), $balance.width(), ovalHeight, color, 0, { 
					blur: 30, 
					color: 'rgba(0, 0, 0, 0.3)'
				});
				ellipse(ctx, x, y - (ovalHeight/2), $balance.width(), ovalHeight, greyColor);
				rect(ctx, x, y, $balance.width(), $balance.height(), greyColor);
				ctx.beginPath();
				rect(ctx, x, Number(y + $balance.height()), $filled.width(), $filled.height(), hexToRgbA(color, .8));
				ellipse(ctx, x, Number(y + $balance.height()) - (ovalHeight/2), $balance.width(), ovalHeight, color);
				ellipse(ctx, x, Number(y + $balance.height()) - (ovalHeight/2), $balance.width(), ovalHeight, 'rgba(0, 0, 0, 0.02)');
				ellipse(ctx, x, Number(y + $balance.height()) - (ovalHeight/2), $balance.width(), ovalHeight, 'rgba(0, 0, 0, 0.02)', 1);
				ellipse(ctx, x, y - (ovalHeight/2), $balance.width(), ovalHeight, 'rgba(255, 255, 255, 0.5)');
				ctx.beginPath();
				ctx.font = $this.find('._percentageTag').css('font');
				ctx.textBaseline = 'top';
				ctx.fillStyle = '#19d400';
				ctx.fillText($this.find('._percentageTag').text(), Number(x + $balance.width() + 15), Number(y + $balance.height() - 10));
        		var body = document.getElementsByTagName("body")[0];
        		body.appendChild(canvas);
        		output.base64 = canvas.toDataURL("image/jpeg", 1);
        		canvas.remove();
        		extra(output);
        	}
        }else{
        	$(this).data('options', settings);
	        if ($(this).is(':empty')){
	        	var pointerEvents = {
	        		pointerEvents : 'none'
	        	}
		        var $tank = $('<div/>').appendTo(this);
		        $tank.css({
		        	width: settings.width,
		            height: settings.height,
				    position: 'relative',
		        	transform: 'translate3d(0,0,0)'
		        }).addClass('_tank');
		        var $balance = $('<div/>').appendTo($tank);
		        $balance
		        .css({
		        	height: settings.height,
				    background: 'rgba(39, 209, 183, 0.57)',
                    //parte del codigo para cambiar de color de tanque
		        	position: 'relative',
		        	transform: 'translateZ(0px)',
		        })
		        .addClass('_balance');
		        var $balanceTopCircle = $('<div/>').appendTo($balance);
		        $balanceTopCircle
		        .css({
		        	height: settings.width,
		        	width: '100%',
		        	background: 'rgba(44, 160, 84, 0.57)',
                    //codigo de color del circlo superior
		        	borderRadius: '50%',
		        	top: 0,
		        	marginTop: -(settings.width/2),
		        	position: 'absolute'
		        })
		        .css(tilt);
			    var $topCircle = $('<div/>').appendTo($tank);
		        $topCircle
		        .css({
		        	height: settings.width,
		        	width: '100%',
		        	background: 'rgba(68, 211, 156, 0.57)',
		        	borderRadius: '50%',
		        	top: 0,
		        	marginTop: -(settings.width/2),
		        	position: 'absolute',
		        	zIndex: 500,
		        	// opacity: .2,
		        	pointerEvents: 'none'
		        })
		        .css(tilt)
		        .addClass('_topCircle');
		        var $filled = $('<div/>').appendTo($tank);
		        $filled.css({
		        	height: 0 ,
		        	position: 'relative',
		        	opacity: 0,
		        	transform: 'translate3d(0,0,0)'
		        })
		        .addClass('_filled');
		        var $filledBg = $('<div/>').appendTo($filled);
		        $filledBg.css({
		        	height: '100%',
		        	width: '100%',
		        	background: settings.color,
		        	position: 'absolute',
		        	opacity: .8,
		        	zIndex: 10
		        });
		        var $percentageTag = $('<div><div/>').appendTo($filledBg);
		        $percentageTag
		        .css({
		        	position: 'absolute',
		        	right: -85,
		        	width: 70,
		        	fontSize: 17,
        
		        	top: -10,
		        	textAlign: 'left',
		        	userSelect: 'none',
                    
		        })
		        .addClass('_percentageTag')
		        .text();
//                .text(settings.level + 'L'); si se quiere agregar el texto de al lado del tanque, igual se puede editar en la parte superior del codigo
		        var $filledTopCircle = $('<div/>').appendTo($filled);
		        $filledTopCircle
		        .css({
		        	height: settings.width,
		        	width: '100%',
		        	background: settings.color,
		        	borderRadius: '50%',
		        	top: 0,
		        	marginTop: -(settings.width/2),
		        	position: 'absolute',
		        	overflow: 'hidden',
		        	zIndex: 10
		        })
		        .css(tilt);
			    var $canvas = $('<canvas/>').appendTo($filledTopCircle);	
			    $canvas.css({
			    	opacity: .8,
			    	transform: 'rotate(90deg)'
			    })
			    .addClass('_canvas');
			    if ($canvas) {
			    	var canvas = $canvas.get(0),
			    	    /** @type {CanvasRenderingContext2D} */
			    	    ctx = canvas.getContext('2d'),
			    	    width = settings.width,
			    	    height = settings.width,
			    	    half_width = width >> 1,
			    	    half_height = height >> 1,
			    	    size = width * (height + 2) * 2,
			    	    delay = 30,
			    	    oldind = width,
			    	    newind = width * (height + 3),
			    	    riprad = 8,
			    	    ripplemap = [],
			    	    last_map = [],
			    	    ripple,
			    	    texture,
			    	    line_width = 1,
			    	    step = line_width * 18, 
			    	    count = height / line_width;
			    	canvas.width = width;
			    	canvas.height = height;
			    	with (ctx) {
			    	    fillStyle = settings.color;
			    	    fillRect(0, 0, width, height);
			    	    fillStyle = '#000';
			    	    save();
			    	    rotate(-0.785);
			    	    for (var i = 0; i < count; i++) {
			    	        fillRect(-width, i * step, width * 3, line_width);
			    	    }   
			    	    restore();
			    	}
			    	texture = ctx.getImageData(0, 0, width, height);
			    	ripple = ctx.getImageData(0, 0, width, height);
			    	
			    	for (var i = 0; i < size; i++) {
			    	    last_map[i] = ripplemap[i] = 0;
			    	}
			    	function run() {
			    	    newframe();
			    	    ctx.putImageData(ripple, 0, 0);
			    	}
			    	function disturb(dx, dy) {
			    	    dx <<= 0;
			    	    dy <<= 0;
			    	    
			    	    for (var j = dy - riprad; j < dy + riprad; j++) {
			    	        for (var k = dx - riprad; k < dx + riprad; k++) {
			    	            ripplemap[oldind + (j * width) + k] += 128;
			    	        }
			    	    }
			    	}
			    	function newframe() {
			    	    var a, b, data, cur_pixel, new_pixel, old_data;
			    	    var t = oldind; oldind = newind; newind = t;
			    	    var i = 0;
			    	    var _width = width,
			    	        _height = height,
			    	        _ripplemap = ripplemap,
			    	        _last_map = last_map,
			    	        _rd = ripple.data,
			    	        _td = texture.data,
			    	        _half_width = half_width,
			    	        _half_height = half_height;
			    	    for (var y = 0; y < _height; y++) {
			    	        for (var x = 0; x < _width; x++) {
			    	            var _newind = newind + i, _mapind = oldind + i;
			    	            data = (
			    	                _ripplemap[_mapind - _width] + 
			    	                _ripplemap[_mapind + _width] + 
			    	                _ripplemap[_mapind - 1] + 
			    	                _ripplemap[_mapind + 1]) >> 1;
			    	            data -= _ripplemap[_newind];
			    	            data -= data >> 5;
			    	            _ripplemap[_newind] = data;
			    	            data = 1024 - data;
			    	            old_data = _last_map[i];
			    	            _last_map[i] = data;
			    	            if (old_data != data) {
			    	                //offsets
			    	                a = (((x - _half_width) * data / 1024) << 0) + _half_width;
			    	                b = (((y - _half_height) * data / 1024) << 0) + _half_height;
			    	
			    	                //bounds check
			    	                if (a >= _width) a = _width - 1;
			    	                if (a < 0) a = 0;
			    	                if (b >= _height) b = _height - 1;
			    	                if (b < 0) b = 0;
			    	
			    	                new_pixel = (a + (b * _width)) * 4;
			    	                cur_pixel = i * 4;
			    	                
			    	                _rd[cur_pixel] = _td[new_pixel];
			    	                _rd[cur_pixel + 1] = _td[new_pixel + 1];
			    	                _rd[cur_pixel + 2] = _td[new_pixel + 2];
			    	            }
			    	            ++i;
			    	        }
			    	    }
			    	}
			    	canvas.onmousemove = function(/* Event */ evt) {
			    	    disturb(evt.offsetX || evt.layerX, evt.offsetY || evt.layerY);
			    	};
			    	if (settings.level >= 0) {
			    		setInterval(run, delay);	
			    		// generate random ripples
			    		var rnd = Math.random;
			    		setInterval(function() {
			    		    disturb(rnd() * width, rnd() * height);
			    		}, 700);
			    	}
			    }  
	    	    var $filledBottomCircle = $('<div/>').appendTo($filled);
	            $filledBottomCircle
	            .css({
		        	height: settings.width,
		        	width: '100%',
		        	background: settings.color,
		        	borderRadius: '50%',
		        	bottom: 0,
		        	marginBottom: -(settings.width/2),
		        	position: 'absolute',
		        	boxShadow: 'rgba(0, 0, 0, 0.3) 0px 15px 50px'
		        })
		        .css(tilt);
	    	    var $reflect = $('<div/>').appendTo($filled); 
	    	    $reflect.addClass('_reflect');
	    	    $reflect.css('background', '-moz-linear-gradient(top, '+settings.color+') 0%, rgba(255,255,255,0) 100%)');
	    	    $reflect.css('background', '-webkit-linear-gradient(top, '+settings.color+' 0%,rgba(255,255,255,0) 100%)');
	    	    $reflect.css('background', 'linear-gradient(to bottom, '+settings.color+' 0%,rgba(255,255,255,0) 100%)');
	    	    $reflect.css({
	    	    	position: 'absolute',
	    	    	width: '100%',
	    	    	// height: settings.width/2,
	    	    	// bottom: -(settings.width/2),
	    	    	height: 0,
	    	    	bottom: -((settings.height * (100-settings.level) / 100)/2),
	    	    	opacity: .4
	    	    });
	        }else{
	        	var $tank = $(this).find('_tank');
	        	var $balance = $(this).find('_balance');
	        	var $filled = $(this).find('_filled');
	        }
	        $tank.fadeOut(0);
	        var _this = $(this)
		    setTimeout(function(){
		    	_updateTank(_this, settings.level, settings.tamano);
		    }, 300);
        }
        return this;
    };
 
}( jQuery ));