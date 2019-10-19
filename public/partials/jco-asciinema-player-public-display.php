<?php

/**
 * Template Name: JCO Asciinema Single
 *
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://jessecowens.com
 * @since      1.0.0
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/public/partials
 */

if ( ! class_exists( 'BoldGrid' ) ) {
	get_header();
}

$mypost = array( 'post_type' => 'jco_asciinema_post' );
$loop = new WP_Query( $mypost );

while ( have_posts() ) : the_post();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header"><h1><?php esc_html( the_title() ); ?></h1>
<?php echo do_shortcode( '[asciinema id="' . get_the_id() . '"]') ?>
        <p><?php echo get_field('description');?></p>
    </header>
</article>
<?php
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
				'<span class="post-title">%title</span>',
	) );
endwhile;

if ( ! class_exists( 'BoldGrid' ) ) {
	get_footer();
}
?>
