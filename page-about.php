<?php
/**
 * Template Name: About
 */

get_header();
?>
<div class="main-content">
    <section class="content-section">
        <h2 class="section-title"><?php the_title(); ?></h2>

        <div class="about-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="about-text">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; ?>

            <div class="about-info">
                <h3><?php esc_html_e( 'Sobre Almacen GT', 'almacengt' ); ?></h3>
                <p><?php esc_html_e( 'Almacen GT es el marketplace centralizado que une inventarios de múltiples tiendas locales y nacionales. Nuestra misión es facilitar el acceso a productos de calidad, comparando precios y asegurando entregas rápidas.', 'almacengt' ); ?></p>

                <h3><?php esc_html_e( 'Nuestra Visión', 'almacengt' ); ?></h3>
                <p><?php esc_html_e( 'Ser el puente digital entre tiendas y clientes, promoviendo el comercio local y nacional con tecnología avanzada.', 'almacengt' ); ?></p>

                <h3><?php esc_html_e( 'Valores', 'almacengt' ); ?></h3>
                <ul>
                    <li><?php esc_html_e( 'Transparencia en precios y stock', 'almacengt' ); ?></li>
                    <li><?php esc_html_e( 'Entregas rápidas y seguras', 'almacengt' ); ?></li>
                    <li><?php esc_html_e( 'Apoyo al comercio local', 'almacengt' ); ?></li>
                    <li><?php esc_html_e( 'Innovación tecnológica', 'almacengt' ); ?></li>
                </ul>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>