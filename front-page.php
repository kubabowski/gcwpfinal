<?php
/**
 * Front Page Template
 *
 * Thin controller — no ACF calls, no HTML.
 * Fetches all data once, then delegates to partials.
 */

get_header();

$data = get_template_data();
?>
<div></div>
<?php
// ── Home description ──────────────────────────────────────
if ( ! empty( $data['home_desc'] ) ) {
    set_query_var( 'home_desc', $data['home_desc'] );
    get_template_part( 'partials/home-desc' );
}

// ── Hero ──────────────────────────────────────────────────
if ( ! empty( $data['hero'] ) ) {
    set_query_var( 'hero', $data['hero'] );
    get_template_part( 'partials/hero' );
}

// ── About ─────────────────────────────────────────────────
if ( ! empty( $data['about'] ) ) {
    set_query_var( 'about', $data['about'] );
    get_template_part( 'partials/about' );
}

// ── Product ───────────────────────────────────────────────
if ( ! empty( $data['product'] ) ) {
    set_query_var( 'product', $data['product'] );
    get_template_part( 'partials/product' );
}

// ── Shop ──────────────────────────────────────────────────
if ( ! empty( $data['shop'] ) ) {
    set_query_var( 'shop', $data['shop'] );
    get_template_part( 'partials/shop' );
}

get_footer();
