<?php
/**
 * Template Data
 *
 * Single source of truth for all ACF field fetching.
 * Returns a normalised array — partials receive plain
 * PHP values (strings, arrays, URLs) and never call
 * get_field() themselves.
 *
 * Loaded via functions.php:
 *   require_once get_template_directory() . '/inc/template-data.php';
 *
 * Usage: $data = get_template_data();
 */

if ( ! function_exists( 'get_template_data' ) ) :

    function get_template_data( int $post_id = 0 ) : array {
        if ( ! $post_id ) {
            $post_id = get_queried_object_id() ?: get_the_ID();
        }

        return [
            'home_desc' => _td_home_desc( $post_id ),
            'hero'      => _td_hero( $post_id ),
            'about'     => _td_about( $post_id ),
            'product'   => _td_product( $post_id ),
            'shop'      => _td_shop( $post_id ),
        ];
    }

endif;


// ── Section data builders ─────────────────────────────────────────────────────

function _td_home_desc( int $post_id ) : ?string {
    $value = get_field( 'home_desc', $post_id );
    return $value ? (string) $value : null;
}

function _td_hero( int $post_id ) : ?array {
    $raw = get_field( 'home_hero', $post_id );
    if ( ! $raw ) return null;

    return [
        'background_url' => _td_image_url( $raw['hero_background'] ?? null ),
        'logo_url'       => _td_image_url( $raw['logo'] ?? null ),
        'text1'          => $raw['hero_text1'] ?? '',
        'text2'          => $raw['hero_text2'] ?? '',
        'button_url'     => $raw['hero_button'] ?? '',
    ];
}

function _td_about( int $post_id ) : ?array {
    $raw = get_field( 'about', $post_id );
    if ( ! $raw ) return null;

    $slides = [];
    foreach ( (array) ( $raw['about_slides'] ?? [] ) as $slide ) {
        if ( empty( $slide ) ) continue;
        $slides[] = [
            'image_url' => _td_image_url( $slide['image'] ?? null ),
            'header'    => $slide['header'] ?? '',
            'text'      => $slide['text'] ?? '',
        ];
    }

    return [
        'text1'  => $raw['about_text1'] ?? '',
        'slides' => $slides,
    ];
}

function _td_product( int $post_id ) : ?array {
    $raw = get_field( 'about_product', $post_id );
    if ( ! $raw ) return null;

    // Resolve ACF repeater here so the partial gets a plain string[].
    $features = [];
    if ( have_rows( 'product_features', $post_id ) ) {
        while ( have_rows( 'product_features', $post_id ) ) {
            the_row();
            $text = get_sub_field( 'feature_text' );
            if ( $text ) {
                $features[] = (string) $text;
            }
        }
    }

    return [
        'image_url' => _td_image_url( $raw['image'] ?? null ),
        'header'    => $raw['header'] ?? '',
        'desc'      => $raw['desc'] ?? '',
        'text'      => $raw['text'] ?? '',
        'features'  => $features,
    ];
}

function _td_shop( int $post_id ) : ?array {
    $raw = get_field( 'shop', $post_id );
    if ( ! $raw ) return null;

    return [
        'background_url' => _td_image_url( $raw['shop_background'] ?? null ),
        'title'          => $raw['shop_title'] ?? '',
        'message'        => $raw['shop_message'] ?? '',
        'description'    => $raw['shop_description'] ?? '',
    ];
}


// ── Utility ───────────────────────────────────────────────────────────────────

/**
 * Safely extracts a URL from an ACF image field.
 * Works whether ACF returns an array (image object) or a plain string URL.
 */
function _td_image_url( $image ) : string {
    if ( ! $image ) return '';
    if ( is_array( $image ) ) return esc_url( $image['url'] ?? '' );
    return esc_url( (string) $image );
}
