(function ($) {
	"use strict";
	$(document).ready(function () {

		thim_charitywp.init();

	});

	$(window).load(function () {

		if ($('.thim-loading').length > 0) {
			$('.thim-loading').fadeOut(1000, function () {
				$('.thim-loading').remove();
				$('body').removeClass('loading');
			});
		}

		thim_charitywp.menuToggle();
		thim_charitywp.parallax();
		thim_charitywp.blog_masonry();
		thim_charitywp.homepage2_support();

	});

	var thim_charitywp = {
		init: function () {
			this.popupShare();
			this.quickview();
			this.back_to_top();
			this.contactform7();
			this.minicart_remove();
			this.searchform();
			this.widget_box();
			this.footer_bottom();
			this.donate_toggle_layout();
			this.menuFixed();
			this.widget_searchbox();
			this.action_toggle();
			this.thim_toggle_div();
			this.widget_testimonials();
			this.widget_client_logo();
			this.widget_campaign();
			this.widget_team();
			this.widget_counter_box();
			this.widget_gallery();
			this.sidebar_sticky();
			this.portfolio_layout();
			this.portfolio();
			this.post_gallery();
			this.donate();
			this.events();
			this.photo_wall();
			this.gallery_mansory();
		},

		gallery_mansory: function () {
            $('.thim-gallery-box .grid ').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function(element) {
                        return element.find('img');
                    }
                }
            });
		},

		post_gallery: function () {
			$('article.format-gallery .flexslider').flexslider({
				slideshow   : true,
				pauseOnHover: true
			});
		},

		portfolio_layout: function () {
			var $container = jQuery('.content_portfolio');
			$container.each(function () {
				var $this = jQuery(this), $width, $col, $width_unit, $height_unit;
				$col = $('.content_portfolio').attr('data-columns');
				var $spacing = parseInt($('.content_portfolio').attr('data-gutter'));

				$this.css({
					width: '100%'
				});

				if ($this.find('.item_portfolio').hasClass('five-col')) {
					$col = 5;
				} else if ($this.find('.item_portfolio').hasClass('four-col')) {
					$col = 4;
				} else if ($this.find('.item_portfolio').hasClass('three-col')) {
					$col = 3;
				} else if ($this.find('.item_portfolio').hasClass('two-col')) {
					$col = 2;
				} else {
					$col = 1;
				}

				if ($col !== 1) {
					if (($this.closest('.portfolio_column').width() + $spacing) < 768 && ($this.closest('.portfolio_column').width() + $spacing) >= 480) {
						$col = 2;
						console.log(1);
					}
					if (($this.closest('.portfolio_column').width() + $spacing) < 480) {
						$col = 1;
						$spacing = 0;
						console.log(2);
					}
				}

				$width_unit = Math.floor((parseInt($this.closest('.portfolio_column').width(), 10) - ($col - 1) * $spacing) / $col);
				$height_unit = Math.floor(parseInt($width_unit / 1.5, 10));

				$this.find('.item_portfolio').css({
					width: $width_unit
				});
				if ($col === 1) {
					$height_unit = 'auto';
				}

				if ($this.closest('.wrapper_portfolio').hasClass('multi_grid')) {
					$this.find('.item_portfolio .portfolio-image').css({
						height: $height_unit
					});
				}
				if ($this.closest('.wrapper_portfolio').hasClass('multi_grid')) {
					if ($this.find('.item_portfolio').hasClass('height_large') && $col !== 1) {
						$this.find('.item_portfolio.height_large .portfolio-image').css({
							height: $height_unit * 2 + $spacing
						});
					}
					if ($this.find('.item_portfolio').hasClass('item_large') && $col !== 1) {
						$width = $width_unit * 2 + $spacing;
						$this.find('.item_portfolio.item_large').css({
							width: $width
						});
					}
				}
				$this.imagesLoaded(function () {
					$this.css({
						width: parseInt($this.closest('.portfolio_column').width(), 10)
					});
					if ($this.closest('.wrapper_portfolio').hasClass('has_gutter')) {
						$('.content_portfolio .element-item').css({'margin-bottom': $spacing + 'px'});
						$this.isotope({
							itemSelector: '.item_portfolio',
							masonry     : {
								columnWidth: $width_unit,
								fitWidth   : true,
								gutter     : $spacing
							}
						});
					} else {
						$this.isotope({
							itemSelector: '.item_portfolio',
							masonry     : {
								columnWidth: $width_unit,
								fitColumn  : true
							}
						});
					}
				});
			});
		},

		portfolio: function () {
			jQuery(".image-popup-01").magnificPopup({
				type       : "image",
				image      : {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
				},
				key        : "image-key",
				verticalFit: true,
				mainClass  : "image-popup-style", // This same class is used for video popup
				tError     : '<a href="%url%">The image</a> could not be loaded.',
				gallery    : {
					enabled : true,
					tCounter: '%curr% of %total%' // markup of counter
				},
				callbacks  : {
					open : function () {
						this.content.addClass("fadeInLeft");
					},
					close: function () {
						this.content.removeClass("fadeInLeft");
					}
				}

			});

			jQuery('.video-popup').magnificPopup({
				type  : 'iframe',
				iframe: {
					patterns: {
						youtube  : {
							index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
							id   : 'v=',
							src  : '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
						},
						vimeo    : {
							index: 'vimeo.com/',
							id   : '/',
							src  : '//player.vimeo.com/video/%id%?autoplay=1'
						},
						srcAction: 'iframe_src'
					}
				}
			});

			var $grid = $('.content_portfolio');
			var $width = $('.entry-content-portfolio .entry-content-left').width();
			$('.entry-content-portfolio .entry-content-left iframe').css({'height': $width / 16 * 9 + 'px'});
			thim_charitywp.portfolio_layout();
			if ($('.wrapper_portfolio').hasClass('portfolio_filter')) {
				$('.portfolio-tabs').on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$('.portfolio-tabs .filter').removeClass('active');
					$(this).addClass('active');
					$grid.isotope({
						filter: filterValue
					});
				});
			}

			$(".portfolio_carousel").owlCarousel({

				lazyLoad       : true,
				nav            : true,
				navText        : [
					'<i class="fa fa-angle-left" aria-hidden="true"></i>',
					'<i class="fa fa-angle-right" aria-hidden="true"></i>'],
				navSpeed       : 600,
				loop           : true,
				responsiveClass: true,
				autoHeight     : false,
				responsive     : {
					0: {
						items: 1
					}
				}
			});
		},

		sidebar_sticky: function () {
			var margin_top = 30;
			margin_top += $('#wpadminbar').outerHeight();
			$('#sidebar').theiaStickySidebar({
				additionalMarginTop: margin_top
			});
		},


		blog_masonry: function () {
            var $blog_wrapper = $('.blog #main .archive-content,.archive.category #main .archive-content');
            $blog_wrapper.isotope({
                itemSelector   : 'article',
                percentPosition: true,
                masonry        : {
                    columnWidth: 'article',
                    fitWidth   : false
                }
            });
        },

		widget_gallery: function () {
			$('.thim-gallery').each(function () {
				var gallery_id = $(this).attr('id') + "_items";
				var per_page = $(this).data('per_page');
				$(this).find('.gallery-pagination .inner-nav').jPages({
					containerID: gallery_id,
					previous   : '',
					next       : '',
					perPage    : per_page,
					midRange   : 3,
					direction  : "random",
					animation  : "flipInY",
					keyBrowse  : true
				});
			});

			var gallery_filter = "#" + $('.thim-gallery.source-images').attr('id') + "_items";
			$(gallery_filter).magnificPopup({
				type    : 'image',
				delegate: 'a',
				gallery : {
					enabled: true
				},
				image   : {
					titleSrc: function (item) {
						return '<div class="title">' + item.el.attr('data-title') + '</div><div class="caption">' + item.el.attr('data-caption') + '</div>';
					}
				}
			});


			$('.thim-gallery.source-posts').on('click', '.media', function (e) {
				e.preventDefault();
				var elem = $(this),
					post_id = elem.attr('data-id'),
					data = {action: 'thim_gallery_popup', post_id: post_id};
				elem.addClass('loading');
				$.post(ajaxurl, data, function (response) {
					elem.removeClass('loading');
					$('.thim-gallery-show').append(response);
					$('.thim-gallery-show').magnificPopup({
						mainClass: 'my-mfp-zoom-in',
						type     : 'image',
						delegate : 'a',
						gallery  : {
							enabled: true
						},
						callbacks: {
							open: function () {
								$.magnificPopup.instance.close = function () {
									$('.thim-gallery-show').empty();
									$.magnificPopup.proto.close.call(this);
								};
							}
						}
					}).magnificPopup('open');
				});

			});


		},

		widget_counter_box: function () {
			$('.counter-box').viewportChecker({
				callbackFunction: function (elem, action) {
					$('.counter-box .display-percentage').countTo({
						formatter: function (value, options) {
							return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, '.');
						}
					});
				}
			});
		},

		widget_team: function () {
			jQuery(".thim-our-team.template-carousel .members").owlCarousel({
				lazyLoad       : true,
				nav            : true,
				navText        : false,
				navSpeed       : 600,
				loop           : true,
				responsiveClass: true,
				responsive     : {
					0   : {
						items: 1
					},
					480 : {
						items: 2
					},
					768 : {
						items: 3
					},
					1024: {
						items: 4
					}
				}
			});
		},

		widget_campaign: function () {
			jQuery(".thim-campaign.tpl-carousel .campaigns").owlCarousel({
				lazyLoad       : true,
				nav            : true,
				loop           : true,
				navText        : false,
				responsiveClass: true,
				responsive     : {
					0: {
						items: 1
					}
				},
				navSpeed       : 600,
				onInitialized  : function () {
					DONATE_Site.generate_percent();
				}
			});

            jQuery(".thim-campaign.tpl-slider .campaigns").owlCarousel({
                lazyLoad       : true,
                nav            : false,
                navText        : false,
                responsiveClass: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
					768:{
                    	items:2
					},
                    1024:{
                        items:2
                    },
					1366:{
						items:3
					}
                },
                onInitialized  : function () {
                    DONATE_Site.generate_percent();
                }
            });
		},

		widget_client_logo: function () {

			var $owlElements = $('.thim-client-logo.slider');
			$owlElements.each(function (index, ele) {
				var option_auto = $(this).data("autoplay"),
					option_items = $(this).data("items");

				$(ele).owlCarousel({
					items             : option_items,
					autoplay          : option_auto,
					autoplayHoverPause: true,
					loop              : true,
					responsiveClass   : true,
					responsive        : {
						0   : {
							items: 1
						},
						320 : {
							items: 2
						},
						480 : {
							items: 3
						},
						768 : {
							items: 4
						},
						1024: {
							items: 5
						}
					}
				});
			});
		},

		widget_testimonials: function () {
			$('.testimonial-slider').each(function () {
				var elem = $(this),
					item_visible = parseInt(elem.data('visible')),
					autoplay = elem.data('autoplay') ? true : false,
					mousewheel = elem.data('mousewheel') ? true : false;
				var testimonial_slider = $(this).thimContentSlider({
					items            : elem,
					itemsVisible     : item_visible,
					mouseWheel       : mousewheel,
					autoPlay         : autoplay,
					itemMaxWidth     : 75,
					itemMinWidth     : 75,
					activeItemRatio  : 1.18,
					activeItemPadding: 0,
					itemPadding      : 15,
					contentPosition  : 'top'
				});
			});

            $(".testimonial-slides").owlCarousel({
                items          : 1
            });
		},

		thim_toggle_div: function () {
			$('.thim-toggle-div').on('click', function (event) {
				event.preventDefault();
				var div_toggle = $(this).data('div');
				var scroll = $(this).data('scroll');

				if (scroll === true) {
					var scrollH = $(div_toggle).offset().top;
					$(div_toggle).find('.inner').slideDown();
					$('html,body').animate({
						scrollTop: scrollH
					}, 2500);
				} else {
					$(div_toggle).find('.inner').slideDown();
				}
			});
		},

		action_toggle: function () {
			$('.thim-link-panel').on('click', '.toggle', function (event) {
				event.preventDefault();
				var close = $(this).data('close'),
					open = $(this).data('open');
				$('#' + close).slideToggle();
				$('#' + open).slideToggle();
			});
		},

		widget_searchbox: function () {
			$('.thim-search-box').on('click', '.toggle-form', function (e) {
				e.preventDefault();
				$('body').toggleClass('thim-active-search');
				var $search = $(this).parent();
				setTimeout(function () {
					$search.find('.search-field').focus();
				}, 400);
			});

			$('.thim-search-box .background-toggle').on('click', function (e) {
				e.preventDefault();
				$('body').removeClass('thim-active-search');
			});
		},

		// Toggle layout for archive donate page.
		donate_toggle_layout: function () {
			$('.thim-layout-search').on('click', '.layouts i', function (event) {
				event.preventDefault();
				var layout = $(this).data('layout');
				$('.thim-layout-search .layouts i').removeClass('active');
				$(this).addClass('active');
				$('#donate_main_content').removeClass().addClass(layout);

				var data = {
					'action': 'thim_session_donate_layout',
					'layout': layout
				};

				$.ajax({
					type    : "POST",
					data    : data,
					url     : thimpress_donate.ajaxurl,
					dataType: 'json'
				}).done(function (rs) {

				});

			});
		},


		footer_bottom: function () {
			var $footer_bottom = $('#footer-bottom');
			var $footer = $('footer');
			if ($footer_bottom.length > 0) {
				$footer.css({
					"margin-bottom": $footer_bottom.height()
				})
			}
		},


		widget_box: function () {


			// Popup video for widget Thim: Box - Style Video
			$('.thim-box .toggle-video').magnificPopup({
				disableOn      : 700,
				type           : 'iframe',
				mainClass      : 'mfp-fade',
				removalDelay   : 160,
				preloader      : false,
				fixedContentPos: false
			});

		},


		searchform: function () {
			$('.search-form').on('hover', function (event) {
				event.preventDefault();
				$(this).find('.search-field').focus();
			}).on('click', '.toggle-search', function (event) {
				event.preventDefault();
				var $form = $(this).parents('.search-form');
				var $input = $form.find('.search-field');
				if ($input.val() !== '') {
					$form.submit();
				} else {
					$input.focus();
				}
			});
		},

		// Ajax remove product in mini cart
		minicart_remove: function () {
			$('.widget_shopping_cart').on('click', '.remove', function (e) {
				e.preventDefault();
				var url = $(this).attr('href');
				$('.mini_cart_item').each(function (index, value) {
					var item_href = $(value).find('a.remove').attr('href');
					if (url === item_href) {
						$(value).addClass('removing');
					}
				});

				var product_id = url.match("remove_item?=(.*)&");
				var data = {
					'action'    : 'thim_minicart_remove',
					'product_id': product_id[1]
				};

				$.ajax({
					type    : "POST",
					data    : data,
					url     : woocommerce_params.ajax_url,
					dataType: 'json'
				}).done(function (rs) {
					$('.mini_cart_item.removing').remove();
					$('.widget_shopping_cart .items-number').html(rs.count);
					if (rs.count === 0) {
						$('.widget_shopping_cart_content .cart_list').html('<li class="empty">' + rs.message + '</li>');
						$('.widget_shopping_cart_content .total,.widget_shopping_cart_content .buttons').remove();
					} else {
						$('.widget_shopping_cart_content .total .amount').html(rs.subtotal);
					}
				});
			});
		},


		contactform7: function () {
			$(".wpcf7-submit").on('click', function () {
				$(this).css("opacity", 0.2);
				$(this).parents('.wpcf7-form').addClass('processing');
				$('input:not([type=submit]), textarea').attr('style', '');
			});

			$(document).on('spam.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$(document).on('invalid.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$(document).on('mailsent.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$(document).on('mailfailed.wpcf7', function () {
				$(".wpcf7-submit").css("opacity", 1);
				$('.wpcf7-form').removeClass('processing');
			});

			$('body').on('click', 'input:not([type=submit]).wpcf7-not-valid, textarea.wpcf7-not-valid', function () {
				$(this).removeClass('wpcf7-not-valid');
			});
		},

		parallax: function () {
			$('.thim-parallax').each(function (index, element) {
				$(element).parallax("50%", 0.4);
			});

			$(window).stellar({
				horizontalOffset: 0,
				verticalOffset  : 0
			});
		},


		// Open popup when click share
		popupShare: function () {
			$('.thim-share-social, .thim-popup-share').on('click', 'a', function (event) {
				event.preventDefault();
				var shareurl = $(this).attr('href');
				var top = (screen.availHeight - 500) / 2;
				var left = (screen.availWidth - 500) / 2;
				var popup = window.open(shareurl, 'social sharing', 'width=550,height=420,left=' + left + ',top=' + top + ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
				return false;
			});
		},

		// Toggle menu
		menuToggle: function () {

			var winW = $(window).width();
			$('.menu-toggle .inner, .thim-menu > .close-menu, .thim-toggle-mobile-menu').on('click touchstart', function (e) {
				e.preventDefault();
				$('body').toggleClass('thim-active-menu');
				if (winW <= 768) {
					$('html').toggleClass('thim-mb-active');
				}
				return false;
			});

			if (winW <= 768 || $('body').hasClass('thim_header_default')) {
				var clickto = '.disable_link';
				if (winW <= 768 || $('body').hasClass('thim_header_default')) {
					clickto = '.disable_link';
				}
				$('.nav .menu-item-has-children').on('click', clickto, function (e) {
					e.preventDefault();
					var $parent = $(this).parent();
					$parent.find('> .sub-menu').slideToggle('slow');
					$parent.toggleClass('toggle');
					return false;
				});
			}

			$(document).on('keyup', function (e) {
				if ($('body').hasClass('thim-active-menu')) {
					if (e.keyCode == 27) {
						$('body').toggleClass('thim-active-menu');
					}
				}

				if ($('body').hasClass('thim-active-search')) {
					if (e.keyCode == 27) {
						$('body').toggleClass('thim-active-search');
					}
				}

			});

			$('#wrapper-container').on('click touchstart', function (e) {
				if ($('body').hasClass('thim-active-menu') || (winW <= 768 && $('body').hasClass('thim-active-menu'))) {
					$('body').toggleClass('thim-active-menu');
					if (winW <= 768) {
						$('html').toggleClass('thim-mb-active');
					}
				}
			});


			$('.menu-item-has-children > a,.menu-item-has-children > span, .widget_area > span, .widget_area > a').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');

			/* mobile menu */
			jQuery('.navbar-nav>li.menu-item-has-children .icon-toggle').on('click', function () {
				if (jQuery(this).next('ul.sub-menu').is(':hidden')) {
					jQuery(this).next('ul.sub-menu').slideDown(500, 'linear');
					jQuery(this).html('<i class="fa fa-angle-up"></i>');
				}
				else {
					jQuery(this).next('ul.sub-menu').slideUp(500, 'linear');
					jQuery(this).html('<i class="fa fa-angle-down"></i>');
				}
			});
		},


		quickview: function () {
			$('.quick-view').on('click', function (e) {
				/* add loader  */
				e.preventDefault();
				var $product = $(this).parents('.product');

				$product.toggleClass('loading');
				$(this).toggleClass('loading');
				var product_id = $(this).attr('data-prod');
				var data = {action: 'jck_quickview', product: product_id};
				$.post(ajaxurl, data, function (response) {
					$.magnificPopup.open({
						mainClass: 'my-mfp-zoom-in',
						items    : {
							src : '<div class="mfp-iframe-scaler">' + response + '</div>',
							type: 'inline'
						}
					});
					$('.quick-view').removeClass('loading');
					$('.product-card .wrapper').removeClass('animate');
					$product.toggleClass('loading');
				});
			});
		},

		back_to_top: function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#back-to-top').addClass('scrolldown').removeClass('scrollup');
				} else {
					$('#back-to-top').addClass('scrollup').removeClass('scrolldown');
				}
			});
			$('#back-to-top').click(function () {
				$('html,body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		},


		// Menu fixed
		menuFixed: function () {
			var $header = $('.site-header');
			var topH = $('.top-header').outerHeight();
			var menuH = $header.outerHeight();
			var latestScroll = 0;
			var width = $(window).width();
			var adminbar = ($('#wpadminbar').length > 0) ? $('#wpadminbar').outerHeight() : 0;
			if (width <= 639) {
				adminbar = 0;
			}
			var header_top = 0;
			var $toolbar = $('.toolbar-sidebar');
			var toolbarH = ($toolbar.length > 0) ? $toolbar.outerHeight() : 0;

			var target = header_top + toolbarH + menuH;

			var overlay = $('body').hasClass('thim_header_overlay') ? true : false;
			var position = 'relative';


			if ($('body').hasClass('thim_fixedmenu')) {

				$(window).scroll(function () {

					var current = $(this).scrollTop();

					if ($('body').hasClass('thim-active-search')) {
						$('body').removeClass('thim-active-search');
					}

					if (current >= toolbarH && current > latestScroll) {
						header_top = adminbar;
						position = 'fixed';
						var hClass = 'sticky';
						$header.css({
							position: position,
							top     : header_top
						}).addClass(hClass);
						if (current >= target) {
							if (!$header.hasClass('menu-hidden')) {
								$header.addClass('menu-hidden').removeClass('menu-show');
							}
						}
						;
					}
					if (current <= toolbarH && current < latestScroll) {
						if ($header.hasClass('menu-show')) {
							$header.removeClass('menu-show');
						}

						var hClass = '';
						if (overlay === true) {
							position = 'fixed';
							header_top = toolbarH + adminbar;
							hClass = '';
						} else {
							position = 'absolute';
							header_top = toolbarH;
							hClass = '';
						}

						$header.css({
							position: position,
							top     : header_top
						}).addClass(hClass);
						if (hClass === '') {
							$header.removeClass('sticky');
						}

						var remove_hidden = setInterval(function () {
							$header.removeClass('menu-hidden');
						}, 1000);


						setTimeout(function () {
							clearInterval(remove_hidden);
						}, 500);

					} else if (current > target && current < latestScroll) {
						if ($header.hasClass('menu-hidden')) {
							$header.removeClass('menu-hidden').addClass('menu-show');
						}
						header_top = adminbar;
						position = 'fixed';
						var hClass = 'sticky';
						$header.css({
							position: position,
							top     : header_top
						}).addClass(hClass);
					}

					latestScroll = current;
				});

				if (overlay === false) {
					$('#main-content').css({
						'padding-top': menuH
					});
				}


				setTimeout(function () {
					$header.css({
						top: $toolbar.outerHeight()
					});
				}, 500);
			}

		},

		donate: function () {
			$(document).on('change', '#myselect', function (e) {
				var val = $('select#myselect option').filter(':selected').val();
				if (val === 'other') {
					$('#myselect').after('<div class="other_donate"><span class="currency">€</span><input type="number" name="donate_input_amount" step="any" class="donate_form_input payment" min="0" id="myinput"/></div>');
				} else {
					$('.other_donate').empty();
				}
			});
		},


        events: function () {
            var $sc = $('.thim-slider-events.layout-4');

            $sc.each(function () {
                $(this).find('.owl-carousel').owlCarousel({
                    items          : 1,
                    nav            : true,
                    autoPlay       : true,
                    loop           : false,
                    navText        : [

                        '<i class="ion-ios-arrow-left"></i>',
                        '<i class="ion-ios-arrow-right"></i>']
				});
            });
        },

        photo_wall: function () {
            $('.thim-gallery-box .grid').imagesLoaded(function () {
                $('.thim-gallery-box .grid').isotope({
                    itemSelector: '.grid-item',
                    masonry     : {
                        columnWidth: '.grid-item',
                        fitColumn  : true
                    }
                });



           });

        },
        homepage2_support: function () {


            $('.siteorigin-panels-stretch.row-padding').each(function () {
                $(this).parent().addClass('panel-padding');
            });

            $('.siteorigin-panels-stretch.row-padding-left').each(function () {
                $(this).parent().addClass('panel-padding-left');
            });

            $('.siteorigin-panels-stretch.row-padding-right').each(function () {
                $(this).parent().addClass('panel-padding-right');

            });

        },
	};

})(jQuery);
