<?php
/**
 * Partial: About (O Nas)
 *
 * Expects array $about (via set_query_var):
 *   text1  string
 *   slides array  [ { image_url, header, text } ]
 */

$about = get_query_var( 'about' );
if ( ! $about ) return;
?>

<section id="about" class="about-section">
    <div class="container">

        <header class="section-header">
            <p class="section-subtitle">
                <?php echo esc_html( $about['text1'] ); ?>
            </p>
        </header>

        <?php if ( ! empty( $about['slides'] ) ) : ?>
            <div class="slider">

                <?php foreach ( $about['slides'] as $slide ) : ?>
                    <article class="slide">
                        <div class="slide-content">

                            <?php if ( $slide['image_url'] ) : ?>
                                <img src="<?php echo esc_url( $slide['image_url'] ); ?>"
                                     alt="<?php echo esc_attr( $slide['header'] ); ?>">
                            <?php endif; ?>

                            <div class="slide-text">
                                <h3><?php echo esc_html( $slide['header'] ); ?></h3>
                                <p><?php echo esc_html( $slide['text'] ); ?></p>
                            </div>

                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>
