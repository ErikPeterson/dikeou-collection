var Months = {
	'01': 'January',
	'02': 'February',
	'03': 'March',
	'04': 'April',
	'05': 'May',
	'06': 'June',
	'07': 'July',
	'08': 'August',
	'09': 'September',
	'10': 'October',
	'11': 'November',
	'12': 'December',
};

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


var Site = {
	init: function(page, $){
		this.mobile = window.innerWidth < 640;
		if(page in this) this[page].init();
		if(this.mobile) this.global.mobile.nav();
	},
	global: {
		mobile:	{
			nav: function(){
				$(document).on('click', 'nav', function(){
					$(this).toggleClass('active');
				});
			    if($('body').hasClass('home')) $('nav').addClass('active');
			}
		}
	}
};

Site.artist = {
	init: function(){
		this.menu();
		this.slideshows();
	},
	menu: function(){

		$(document).on('click', '[data-modal]', function(e){
			e.preventDefault();

			var $handle      = $(this);
			var $newModal    = $('#' + $handle.data('modal'));
			var $activeModal = $('.modals > .active');
			
			if($activeModal){
				$activeModal.removeClass('active')
				if($activeModal[0] == $newModal[0]) return;
			} 

			$newModal.addClass('active');			
		});
	},
	slideshows: function(){
		var options = {
			slide_selector: '.slide',
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

		$('.gallery .slides').each(function(){
			new Slideshow($(this), options);
		});
	}
};

Site.event = {
	init: function(){
		var options = {
			slide_selector: '.slide',
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

		$('.gallery .slides').each(function(){
			new Slideshow($(this), options);
		});
	}
};

Site.events = {
	init: function(){
		this.$list = $('section.events');

		if(this.$list.data('month')) return this.paged(this.$list.data('month') + "");
		if(this.$list.data('date'))  return this.byDate(this.$list.data('date') + "") 
	},
	paged: function(str){
		this.year  = str.slice(0,4);
		this.month = str.slice(4);
		this.pagination();
		this.monthCalendar();
	},
	pagination: function(){
		var $navEl = $('.pagination'),
			html = "";
		
		if($navEl.data('prev-page')) html += '<div class="prev"><a href="/events?month=' + $navEl.data('prev-page') + '">&lt;</a></div>';
		html += '<div class="date">' + Months[this.month] + ', ' + this.year + '</div>';
		if($navEl.data('next-page')) html += '<div class="next"><a href="/events?month=' + $navEl.data('next-page') + '">&gt;</a></div>';

		$navEl.html(html);

		if($('.event').length > 0) $('.event:last-child').after($navEl.clone());
	},
	monthCalendar: function(){
		var date = new Date(+this.year, +this.month - 1, 1, 0, 0, 0, 0),
			dates = $.unique($('[data-date]').map(function(i, el){ return "" + $(el).data('date'); })).toArray();

		console.log(date);

		this.$calendar = $('.calendar');
		this.$calendar.datepicker({
			dayNamesMin: 'S M T W T F S'.split(' '),
			minDate: date, 
			setDate: date,
			dateFormat: "yymmdd",
			nextText: ">",
			prevText: "<",
			onSelect: function(dateText){
				return window.location.search="?date=" + dateText;
			},
			beforeShowDay: function(date){
				var year = date.getFullYear() + "",
					month = date.getMonth() + 1,
					day = date.getDate();

				var formatted = year + ( month < 10 ? "0" + month : month ) + ( day < 10 ? "0" + day : day);
				if(dates.indexOf(formatted) > -1) {

					return [true, "has-events", ''];
				}
				return [true, '', ''];
			},
			onChangeMonthYear: function(y, m){
				return window.location.search = "?month=" + y + (m < 10 ? "0" + m : m);
			}

		});
		this.$calendar.datepicker("show");
	},
	byDate: function(date){

	}
};




(function($){
	Site.init($('body').data('template'));
}(jQuery))