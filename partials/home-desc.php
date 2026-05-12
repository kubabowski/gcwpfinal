<?php
/**
 * Partial: Home Description
 *
 * Expects: string $home_desc  (via set_query_var)
 */

$home_desc = get_query_var( 'home_desc' );
if ( ! $home_desc ) return;
?>

<section class="home-desc">
    <p><?php echo esc_html( $home_desc ); ?></p>
</section>
