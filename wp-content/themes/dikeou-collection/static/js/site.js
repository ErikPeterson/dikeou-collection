var Mobile = {
	init: function(page, $){
		this.$ = $;
		this.nav();
		if(page in this) this[page]();
	}
};

Mobile.nav = function(){
	this.$(document).on('click', 'nav', function(){
		$(this).toggleClass('active');
	})
};

(function($){
	if(window.innerWidth < 641) return Mobile.init($('body').data('template'), $);
}(jQuery))