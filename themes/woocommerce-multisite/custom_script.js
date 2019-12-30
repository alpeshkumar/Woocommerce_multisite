jQuery(document).ready(function ($)
{
	$('body').on('click', '.woocommerce .woocommerce-result-view span', function ()
    {
		$('.woocommerce .woocommerce-result-view span').removeClass('active');
		
		if($(this).hasClass("grid_view"))
		{
			$(this).addClass('active');
			$('.woocommerce .products.columns-3').addClass('grid_view');
			$('.woocommerce .products.columns-3').removeClass('list_view');
			
			Cookies.set("product_list_style","grid_view");
		}
		else
		{
			$(this).addClass('active');
			$('.woocommerce .products.columns-3').addClass('list_view');
			$('.woocommerce .products.columns-3').removeClass('grid_view');
			
			Cookies.set("product_list_style","list_view");
		}
	});
	
	$('body').on('click', 'ul.products li.product .product-thumb-wrap', function ()
	{
		window.location = $(this).next().find("a").attr("href");
		return false;
	});
	
	$('.flex-control-nav.flex-control-thumbs').addClass('owl-carousel');
		
	$('.owl-carousel.flex-control-thumbs').owlCarousel({
		dots: false,
		loop: false,
		nav: true,
		margin: 10,
		responsiveClass: true,
		responsive: {
		  479: {
			items: 3,
		  },
		  480: {
			items: 4,
		  }
		}
	});
	
	(function ($) {

		$(document).on('click', '.woocommerce-variation-add-to-cart-enabled .single_add_to_cart_button', function (e) {
			e.preventDefault();

			var $thisbutton = $(this),
					$form = $thisbutton.closest('form.cart'),
					id = $thisbutton.val(),
					product_qty = $form.find('input[name=quantity]').val() || 1,
					product_id = $form.find('input[name=product_id]').val() || id,
					variation_id = $form.find('input[name=variation_id]').val() || 0;

			var data = {
				action: 'woocommerce_ajax_add_to_cart',
				product_id: product_id,
				product_sku: '',
				quantity: product_qty,
				variation_id: variation_id,
			};

			$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

			$.ajax({
				type: 'post',
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (response) {
					$thisbutton.removeClass('added').addClass('loading');
				},
				complete: function (response) {
					$thisbutton.addClass('added').removeClass('loading');
				},
				success: function (response) {

					if (response.error & response.product_url) {
						window.location = response.product_url;
						return;
					} else {
						$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
					}
				},
			});

			return false;
		});
	})(jQuery);

});