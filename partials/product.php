<?php
/**
 * Partial: Product (O Produkcie)
 *
 * Expects array $product (via set_query_var):
 *   image_url string
 *   header    string
 *   desc      string
 *   text      string
 *   features  string[]
 */

$product = get_query_var( 'product' );
if ( ! $product ) return;
?>

<section id="product" class="product-section">
    <div class="container">

        <div class="product-grid">

            <?php if ( $product['image_url'] ) : ?>
                <img src="<?php echo esc_url( $product['image_url'] ); ?>"
                     alt="<?php echo esc_attr( $product['header'] ); ?>">
            <?php endif; ?>

            <div class="product-content">

                <h2><?php echo esc_html( $product['header'] ); ?></h2>

                <p><?php echo esc_html( $product['desc'] ); ?></p>

                <?php if ( $product['text'] ) : ?>
                    <p><?php echo esc_html( $product['text'] ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $product['features'] ) ) : ?>
                    <ul class="product-features">
                        <?php foreach ( $product['features'] as $feature ) : ?>
                            <li><?php echo esc_html( $feature ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>
