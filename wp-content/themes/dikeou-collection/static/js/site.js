var Slideshow = function(el, options){
	this.index = 0;
	this.$el = typeof el == 'string' ? $(el) : el;
	if(options) this.init(options);
};

Slideshow.prototype.init = function(options){
	
	this.options = {
		slide_selector: '.slide',
		toggle_class: '.active',
		controls: {
			next: '.next',
			prev: '.prev',
			modal: false
		}
	}

	for( var prop in options){
		if(!options.hasOwnProperty(prop)) continue;
		this.options[prop] = options[prop];
	}
	this.start_index = this.options.start_index || 0;
	this.__setSlides();
};

Slideshow.prototype.__setSlides = function(){
	this.$slides = this.$el.find(this.options.slide_selector);
	this._length = this.$slides.length;
	$.makeArray(this.$slides).forEach(this.__bindSlide.bind(this));

	this.$slides.eq(this.start_index).addClass(this.options.toggle_class);
};

Slideshow.prototype.__bindSlide = function(slide){
	var $slide =  $(slide),
		$next  =  $(slide).find(this.options.controls.next),
		$prev  =  $(slide).find(this.options.controls.prev);

		$next.click(this.next.bind(this));
		$prev.click(this.prev.bind(this));

		if(this.options.events['slide:ready']) this.options.events['slide:ready']($slide);
};

Slideshow.prototype.goto = function(index){	
	if(this.index === index) return;

	var $next    = this.$slides.eq(index),
		$current = this.$slides.eq(this.index);

		if($current.hasClass(this.options.toggle_class)) $current.removeClass(this.options.toggle_class);
		$next.addClass(this.options.toggle_class);
		this.index = index;
		if(this.options.events['slide:change']) this.options.events['slide:change']($next, $current);
};

Slideshow.prototype.next = function(e){
	e.preventDefault();
	var nextIndex = (this.index + 1) >= this._length ? 0 : this.index + 1;
	this.goto(nextIndex);
};

Slideshow.prototype.prev = function(e){
	e.preventDefault();
	var prevIndex = this.index > 0 ? this.index - 1 : this._length - 1;
	this.goto(prevIndex);
}


var Mobile = {
	init: function(page, $){
		this.$ = $;
		this.nav();
		if(page in this) this[page].init();
	},
	artist: {
		init: function(){
			this.menu();
			this.slideshows();
		},
		menu: function(){

		},
		slideshows: function(){
			var options = {
				slide_selector: '.artist-slide',
				toggle_class: 'active',
				controls: {
					prev: '.slide-prev',
					next: '.slide-next',
					modal: {
						handle: '.slide-zoom',
						modal: '.slide-modal'
					}
				},
				events: {
					'slide:ready': function($slide){
						var $handle  = $slide.find('.slide-open'),
							$content = $slide.find('.slide-content');

							$handle.click(function(){$content.toggleClass('open')}); 
					}
				}
			};

			$('.artist-gallery .slides').each(function(){
				new Slideshow($(this), options);
			});
		}
	}
};

Mobile.nav = function(){
	this.$(document).on('click', 'nav', function(){
		$(this).toggleClass('active');
	});
    if(this.$('body').hasClass('home')) $('nav').addClass('active');
};

(function($){
	if(window.innerWidth < 641) return Mobile.init($('body').data('template'), $);
}(jQuery))