<?php
/**
 * The template for displaying product content within card grid
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ( ! is_search() && ! $product->is_visible() ) ) {
    return;
}
?>
<div <?php wc_product_class( 'card', $product ); ?>>
    <a href="<?php the_permalink(); ?>" class="card-image">
        <?php if ( has_post_thumbnail() ) {
            woocommerce_template_loop_product_thumbnail();
        } else {
            echo '<img src="https://placehold.co/250x200/e5e5e5/555555?text=' . esc_attr( get_the_title() ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
        } ?>
    </a>
    <div class="card-body">
        <div class="card-category"><?php echo wc_get_product_category_list( $product->get_id(), ', ' ); ?></div>
        <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="card-price"><?php echo $product->get_price_html(); ?></div>
        <?php woocommerce_template_loop_add_to_cart( array( 'class' => 'btn btn-primary' ) ); ?>
    </div>
</div>
