/**
 * Add vendor biography content inside the vendor info tab
 */
add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {

	$tabs['seller']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback

	return $tabs;
}
function woo_custom_description_tab_content() {
global $product;

    $author_id  = get_post_field( 'post_author', $product->get_id() );
    $author     = get_user_by( 'id', $author_id );
    $store_info = dokan_get_store_info( $author->ID );

    dokan_get_template_part(
        'global/product-tab',
        '',
        [
            'author'     => $author,
            'store_info' => $store_info,
        ]
    );
echo '<h2>Vendor Biography</h2>';	
global $product;
$seller = get_post_field( 'post_author', $product->get_id());
$author = get_user_by( 'id', $seller );
$vendor = dokan()->vendor->get( $seller );

$store_info = dokan_get_store_info( $author->ID );

if ( !empty( $store_info['vendor_biography'] ) ) { ?>
<span class="details">
<?php printf( $vendor->get_vendor_biography() ); ?>
</span>
<?php
}	
}
