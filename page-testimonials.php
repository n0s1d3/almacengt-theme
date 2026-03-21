<?php
/**
 * Template Name: Testimonials
 */

get_header();
?>
<div class="main-content">
    <section class="content-section">
        <h2 class="section-title"><?php the_title(); ?></h2>

        <div class="testimonials-grid">
            <?php
            $comments = get_comments( array(
                'post_type' => 'product',
                'status' => 'approve',
                'number' => 10,
                'orderby' => 'comment_date',
                'order' => 'DESC',
            ) );

            if ( $comments ) {
                foreach ( $comments as $comment ) {
                    $product = get_post( $comment->comment_post_ID );
                    echo '<div class="testimonial-card">';
                    echo '<div class="testimonial-content">' . wp_kses_post( $comment->comment_content ) . '</div>';
                    echo '<div class="testimonial-meta">';
                    echo '<strong>' . esc_html( $comment->comment_author ) . '</strong> - ';
                    echo '<a href="' . get_permalink( $product->ID ) . '">' . esc_html( $product->post_title ) . '</a>';
                    echo '<div class="testimonial-date">' . esc_html( date( 'F j, Y', strtotime( $comment->comment_date ) ) ) . '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>' . esc_html__( 'No hay testimonios disponibles.', 'almacengt' ) . '</p>';
            }
            ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>