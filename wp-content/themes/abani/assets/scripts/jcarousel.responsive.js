(function($) {
	"use strict";
    $(function() {
		$('.dd-select').on('click',function(){
			$('.dd-options').toggleClass('open');
			$('.dd-options').attr('style', ''); 
			$('.dd-selected').toggleClass('open');
		});
		$('.jcarousel').each(function(){
			var jcarousel = $(this);
			jcarousel.parent().children('.pages').children('.max').text(Math.ceil(jcarousel.children().children('li').length / 3));
			jcarousel
				.on('jcarousel:reload jcarousel:create', function () {
					var carousel = $(this), width = carousel.innerWidth();
					if (width >= 992) {
						width = (width / 3) - 50;
					}
					else if (width >= 768) {
						width = (width / 2) - 50;
					}
					carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
				})
				.jcarousel( {
					wrap: 'circular'
				});
			jcarousel.parent().children('.jcarousel-control-prev')
				.jcarouselControl( {
					target: '-=1',
					carousel: jcarousel
				}).on('click',function(){
					jcarousel.parent().children('.pages').children('.current').text(jcarousel.parent().children('.jcarousel-pagination').children('.active').text());
				});
			jcarousel.parent().children('.jcarousel-control-next')
				.jcarouselControl( {
					target: '+=1',
					carousel: jcarousel
				}).on('click',function(){
					jcarousel.parent().children('.pages').children('.current').text(jcarousel.parent().children('.jcarousel-pagination').children('.active').text());
				});
			jcarousel.parent().children('.jcarousel-pagination')
				.on('jcarouselpagination:active', 'a', function() {
					$(this).addClass('active');
				})
				.on('jcarouselpagination:inactive', 'a', function() {
					$(this).removeClass('active');
				})
				.on('click', function(e) {
					e.preventDefault();
				}).jcarouselPagination({
					perPage: 3,
					carousel: jcarousel,
					item: function(page) {
						return '<a href="#' + page + '">' + page + '</a>';
					}
				});
			jcarousel.parent().children('.jcarousel-pagination').children('a').on('click',function(){
				jcarousel.parent().children('.pages').children('.current').text(jcarousel.parent().children('.jcarousel-pagination').children('.active').text());
			});
			$(window).bind('load',function(){
				jcarousel.parent().children('.jcarousel-pagination').css({'left' : jcarousel.parent().parent().children('.border-caption').children('span').width() + 25});
			});
		});
    });
}
)(jQuery);