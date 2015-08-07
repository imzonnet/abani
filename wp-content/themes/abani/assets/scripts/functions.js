(function($) {
	"use strict";
    $(document).ready(function() {
        function borderCaption(element) {
            $(element).each(function(index) {
                var firstWord = $(this).text().split(' ')[0];
                var replaceWord = "<mark>" + firstWord + "</mark>";
                var newString = $(this).html().replace(firstWord, replaceWord);
                $(this).html(newString);
            }
            );
            $(element).wrapInner('<span></span>');
        }
        function borderCaptionWithDots(element) {
            $(element).append('<div class="icon-dots"></div>');
        }
        borderCaption('.border-caption');
        borderCaptionWithDots('.with-dots');
        $('.briefcase-icon').prepend('<div class="circle-ef"><i class="fa fa-briefcase"></i></div>');
        $('.comments-icon').prepend('<div class="circle-ef"><i class="fa fa-comments-o"></i></div>');
        $('.envelope-icon').prepend('<div class="circle-ef"><i class="fa fa-envelope"></i></div>');
        $('.minimal-menu').before('<label class=\"minimal-menu-button\" for=\"mobile-nav\"><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></label><input class=\"minimal-menu-button\" type=\"checkbox\" id=\"mobile-nav\" name=\"mobile-nav\" />');
        $('.minimal-menu').find('ul.sub-menu').parent().addClass('submenu');
        $('.minimal-menu').find('ul.sub-menu').before('<input class=\"show-submenu\" type=\"checkbox\" />');
        if ($('.custom-select').length) {
            var mySelect = $('.custom-select');
            mySelect.fancySelect({
                triggerTemplate: function(optionEl) {
                    var option_data = optionEl.data('icon');
                    if (typeof option_data != 'undefined') {
                        return '<div class="icon-' + optionEl.data('icon') + '"></div><p>' + optionEl.text() + '</p>';
                    }
                    else {
                        return '<p>' + optionEl.text() + '</p>';
                    }
                }
            }
            ).on('change.fs', function() {
                var raw_val = $(this).parent().find('.options').find('.selected').attr('data-raw-value');
                if ($(this).hasClass('country-switch')) {
                    window.location.replace(raw_val);
                }
            });
        }
		if ($('.widget_categories select').length) {
            var mySelect = $('.widget_categories select');
            mySelect.fancySelect({
                triggerTemplate: function(optionEl) {
                    var option_data = optionEl.data('icon');
                    if (typeof option_data != 'undefined') {
                        return '<div class="icon-' + optionEl.data('icon') + '"></div><p>' + optionEl.text() + '</p>';
                    }
                    else {
                        return '<p>' + optionEl.text() + '</p>';
                    }
                }
            }
            ).on('change.fs', function() {
				
            });
        }
		if ($('.widget_archive select').length) {
            var mySelect = $('.widget_archive select');
            mySelect.fancySelect({
                triggerTemplate: function(optionEl) {
                    var option_data = optionEl.data('icon');
                    if (typeof option_data != 'undefined') {
                        return '<div class="icon-' + optionEl.data('icon') + '"></div><p>' + optionEl.text() + '</p>';
                    }
                    else {
                        return '<p>' + optionEl.text() + '</p>';
                    }
                }
            }
            ).on('change.fs', function() {
				
            });
        }
		
		if ($('.options-size .woo-attribute-custom-select').length){
			$('.options-size .woo-attribute-custom-select').each(function(){
				var mySelectopt = $(this);
				var variations_form = $('.variations_form');
				mySelectopt.fancySelect();
				mySelectopt.parent().find('.options').children('li').on('click',function(){
					mySelectopt.parent().find('.trigger').text($(this).text());
					mySelectopt.children('option[value=' + $(this).attr('data-raw-value') + ']').attr('selected','selected');
					variations_form.trigger( 'woocommerce_variation_select_change' ).trigger( 'check_variations');
				});
			});			
			$('.variations').on('click',function(target){				
				var tg = target.target;
				if ($(tg).hasClass('reset_variations')){
					$('.options li').removeClass('selected');
					$('.trigger').removeClass('selected');
					$('.trigger').text('Choose an option…');
				}
			});
		}
        $('.woocommerce .yith-woo-ajax-navigation a').click(function() {
            if ($(this).parent().hasClass('chosen')) {
                var url = document.URL;
                url = url.replace(/\?.+/, '');
                window.location.replace(url);
            } else {
                $(this).parent().parent().find('li').removeClass('chosen');
                $(this).parent().addClass('chosen');
            }
        });
        if ($('.woocommerce-currency-switcher').length) {
            var mySelect = $('.woocommerce-currency-switcher');
            mySelect.fancySelect().on('change.fs', function() {
                var raw_val = $(this).parent().find('.options').find('.selected').attr('data-raw-value');
                $(this).find('option').removeAttr('selected').filter('[value=' + raw_val + ']').attr('selected', true);
            });
        }

        if ($('.orderby').length) {
            var mySelect = $('.orderby');
            mySelect.fancySelect().on('change.fs', function() {
                var raw_val = $(this).parent().find('.options').find('.selected').attr('data-raw-value');
                $(this).find('option').removeAttr('selected').filter('[value=' + raw_val + ']').attr('selected', true);
                window.location.replace(document.URL + "?orderby=" + raw_val);
            }
            );
        }
       $.each($('input[type="submit"]'), function() {
            var class_submit_btn = $(this).attr('class');
            var name_submit_btn = $(this).attr('name');
            var val_submit_btn = $(this).val();
            $(this).parent().append("<button type='submit' name='" + name_submit_btn + "' class='" + class_submit_btn + " created_submit'>" + val_submit_btn + "</button>");
			$(this).hide();
        });
		$('.created_submit').on('click', function(event) {
			event.preventDefault();
			$(this).parent().children('input[type="submit"]').click();
		});
        if ($('.fancybox').length) {
            $(".fancybox").fancybox();
        }
        if ($('#slideshow').length) {
            $('#slideshow > div').allinone_bannerRotator({
                skin: 'universal', width: 1920, height: 600, width100Proc: true, responsive: true, thumbsWrapperMarginBottom: 5, showCircleTimer: false, showBottomNav: false, effectDuration: 0.7
            }
            );
        }
        if ($('#product-showcase').length) {
            $('.previews a').click(function(e) {
                e.preventDefault();
                var largeImage = $(this).attr('data-full');
                $('.selected').removeClass();
                $(this).addClass('selected');
                $('.full img').hide();
                $('.full img').attr('src', largeImage);
                $('.full img').fadeIn();
            }
            );
            $('.full').click(function(e) {
                e.preventDefault();
                var modalImage = $(this).find('img').attr('src');
                $.fancybox.open(modalImage);
            }
            );
            $('.gallery .previews').perfectScrollbar({
                suppressScrollX: true
            }
            );
        }
        if ($(".widget_product_categories").length) {
            $(".widget_product_categories .cat-parent").hover(function() {
                if ($(this).find('.children').length) {
                    $(this).find('.children').stop().show(400);
                    $(".widget_product_categories ul .cat-parent").removeClass('active');
                    $(this).addClass('active');
                }
            },function(){
				if ($(this).find('.children').length) {
                    $(this).find('.children').stop().hide(400);
                    $(".widget_product_categories ul .cat-parent").removeClass('active');
                }
			}
            );
            $(".widget_product_categories .current-cat").parent().css('display', 'block');
        }
        if ($('#map').length) {
            var map = new GMaps({
                el: '#map', lat: -12.043333, lng: -77.028333
            }
            );
            map.addMarker({
                lat: -12.042, lng: -77.028333, title: 'Marker with InfoWindow', infoWindow: {
                    content: '<h4>KYSBAG</h4>'
                }
            }
            );
        }
        if ($(".product-tabs").length) {
            $('.product-tabs').responsiveTabs({
                animation: 'slide', rotate: false, startCollapsed: 'accordion', collapsible: 'accordion', setHash: true
            }
            );
        }
        $('.minus-btn').click(function(e) {
            e.preventDefault();
            var input = $(this).parent().find('input');
            var currentVal = parseInt(input.val());
            if (currentVal > 1) {
                input.val(currentVal - 1).change();
            }
        }
        );
        $('.plus-btn').click(function(e) {
            e.preventDefault();
            var input = $(this).parent().find('input');
            var currentVal = parseInt(input.val());
            input.val(currentVal + 1).change();
        }
        );
        $('.quantity input').focusin(function() {
            $(this).data('oldValue', $(this).val());
        }
        );
        if ($("#price-slider").length) {
            $("#price-slider").slider({
                range: true, min: 1, max: 100, values: [16, 53], slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                }
            }
            );
            $("#amount").val("$" + $("#price-slider").slider("values", 0) +
                    " - $" + $("#price-slider").slider("values", 1));
        }
        $('.bygrid').click(function(e) {
            e.preventDefault();
            if ($('.products').hasClass('listview')) {
                $('.products').removeClass('listview');
                $('.products').addClass('gridview');
            }
            else {
                $('.products').addClass('gridview');
            }
            $('.bylist').removeClass('active');
            $(this).addClass('active');
        }
        );
        $('.bylist').click(function(e) {
            e.preventDefault();
            if ($('.products').hasClass('gridview')) {
                $('.products').removeClass('gridview');
                $('.products').addClass('listview');
            }
            else {
                $('.products').addClass('listview');
            }
            $('.bygrid').removeClass('active');
            $(this).addClass('active');
        }
        );
        $(window).load(function() {
            $(".topbar").stick_in_parent();
        }
        );
    }
    );
}
)(jQuery);