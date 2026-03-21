<?php
/**
 * Template Name: Contact
 */

get_header();
?>
<div class="main-content">
    <section class="content-section">
        <h2 class="section-title"><?php the_title(); ?></h2>

        <div class="contact-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="contact-text">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; ?>

            <div class="contact-info">
                <h3><?php esc_html_e( 'Información de Contacto', 'almacengt' ); ?></h3>
                <p><strong><?php esc_html_e( 'Dirección:', 'almacengt' ); ?></strong> <?php esc_html_e( 'Ciudad de Guatemala, Guatemala', 'almacengt' ); ?></p>
                <p><strong><?php esc_html_e( 'Teléfono:', 'almacengt' ); ?></strong> +502 1234 5678</p>
                <p><strong><?php esc_html_e( 'Email:', 'almacengt' ); ?></strong> info@almacengt.com</p>
                <p><strong><?php esc_html_e( 'Horarios:', 'almacengt' ); ?></strong> Lunes a Viernes 8:00 AM - 6:00 PM</p>

                <h3><?php esc_html_e( 'Soporte al Cliente', 'almacengt' ); ?></h3>
                <p><?php esc_html_e( 'Para consultas sobre pedidos, productos o soporte técnico, contáctanos vía WhatsApp o email.', 'almacengt' ); ?></p>
                <p><strong>WhatsApp:</strong> +502 1234 5678</p>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>