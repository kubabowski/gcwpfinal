<?php
/**
 * Partial: Hero
 *
 * Expects array $hero (via set_query_var):
 *   background_url string
 *   logo_url       string
 *   text1          string
 *   text2          string
 *   button_url     string
 */

$hero = get_query_var( 'hero' );
if ( ! $hero ) return;
?>

<section class="hero" style="background-image: url('<?php echo esc_url( $hero['background_url'] ); ?>')">

    <div class="hero-overlay"></div>

    <div class="container">
        <div class="hero-content">

            <?php if ( $hero['logo_url'] ) : ?>
                <img src="<?php echo esc_url( $hero['logo_url'] ); ?>"
                     class="hero-logo"
                     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <?php endif; ?>

            <h1 class="hero-title">
                <?php echo esc_html( $hero['text1'] ); ?>
            </h1>

            <p class="hero-tagline">
                <?php echo esc_html( $hero['text2'] ); ?>
            </p>

            <?php if ( $hero['button_url'] ) : ?>
                <a href="<?php echo esc_url( $hero['button_url'] ); ?>" class="btn btn-primary">
                    <?php esc_html_e( 'Poznaj Nas', 'your-theme' ); ?>
                </a>
            <?php endif; ?>

        </div>
    </div>

</section>
