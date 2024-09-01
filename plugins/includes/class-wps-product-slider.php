<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WPS_Product_Slider {

    public function __construct() {
        add_shortcode( 'wps_product_slider', array( $this, 'render_slider' ) );
    }

    public function render_slider( $atts ) {
        $atts = shortcode_atts( array(
            'limit'    => 10,
            'category' => '',
        ), $atts, 'wps_product_slider' );
    
        // Generate a unique class for each slider
        $unique_class = 'wps-slider-' . sanitize_html_class( $atts['category'] );
    
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => $atts['limit'],
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $atts['category'],
                ),
            ),
        );
    
        $query = new WP_Query( $args );
    
        if ( $query->have_posts() ) {
            ob_start();
            echo '<div class="wps-slider-wrapper ' . esc_attr( $unique_class ) . '">';
            echo '<div class="wps-arrow wps-prev">&lt;</div>'; // Previous arrow
            echo '<div class="wps-slider">';
            while ( $query->have_posts() ) {
                $query->the_post();
                $product = wc_get_product( get_the_ID() );
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                $discount = '';
                if ( $sale_price && $regular_price > $sale_price ) {
                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                    $discount = '<span class="wps-discount">-' . $discount_percentage . '% Off</span>';
                }
                echo '<div class="wps-slide">';
                echo $discount;
                echo '<a href="' . get_permalink() . '" class="wps-link">';
                echo '<div class="wps-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'medium' ) . '</div>';
                echo '<h2 class="wps-title">' . get_the_title() . '</h2>';
                echo '<p class="wps-price">';
                if ( $sale_price ) {
                    echo '<span class="wps-regular-price">' . wc_price( $regular_price ) . '</span> ';
                    echo '<span class="wps-sale-price">' . wc_price( $sale_price ) . '</span>';
                } else {
                    echo wc_price( $regular_price );
                }
                echo '</p>';
                echo '</a>';
                echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" data-product_id="' . get_the_ID() . '" class="wps-add-to-cart add_to_cart_button ajax_add_to_cart">' . esc_html__( 'Add to cart', 'text-domain' ) . '</a>';
                echo '</div>';
            }
            echo '</div>'; // Close the slider div
            echo '<div class="wps-arrow wps-next">&gt;</div>'; // Next arrow
            echo '</div>'; // Close the wrapper div
            wp_reset_postdata();
            return ob_get_clean();

        } else {
            return '<p>No products found</p>';
        }
    }
    
    
}

?>
