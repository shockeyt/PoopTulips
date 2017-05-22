( function( $ ) {
    "use strict";

    $(document).ready(function(){

        $( document.body ).bind( 'openswatch_update_images',function(event,data){
           //start your custom code here
            // data.html is html string return by filter: openswatch_image_swatch_html ,
            // use add_filter('openswatch_image_swatch_html','your function') to change it.

            // this is for storefont theme
            var html = data.html;
            var productId = data.productId;
            if(html.length > 5)
            {
                $('#product-'+productId+' .images').html(html);

                // Lightbox
                $("a.zoom").prettyPhoto({
                    hook: 'data-rel',
                    social_tools: false,
                    theme: 'pp_woocommerce',
                    horizontal_padding: 20,
                    opacity: 0.8,
                    deeplinking: false
                });
                $("a[data-rel^='prettyPhoto']").prettyPhoto({
                    hook: 'data-rel',
                    social_tools: false,
                    theme: 'pp_woocommerce',
                    horizontal_padding: 20,
                    opacity: 0.8,
                    deeplinking: false
                });

            }
           //end your custom code here
        });
    });
} )( jQuery );
