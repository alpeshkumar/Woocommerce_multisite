jQuery(document).ready(function ($)
{
	$('.woocommerce .woocommerce-result-view span').click(function ()
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

});