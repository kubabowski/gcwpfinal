<?php
/**
 * Partial: Shop
 *
 * Expects array $shop (via set_query_var):
 *   background_url string
 *   title          string
 *   message        string
 *   description    string
 */

$shop = get_query_var( 'shop' );
if ( ! $shop ) return;
?>

<section class="shop-section"
         style="background-image: url('<?php echo esc_url( $shop['background_url'] ); ?>')">

    <div class="container">
        <h2><?php echo esc_html( $shop['title'] ); ?></h2>
        <p><?php echo esc_html( $shop['message'] ); ?></p>
        <p><?php echo esc_html( $shop['description'] ); ?></p>
    </div>

</section>
