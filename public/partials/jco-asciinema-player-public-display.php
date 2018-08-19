<?php

/**
 * Template Name: New Template
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
?>
<?php
get_header();
$mypost = array( 'post_type' => 'jco_asciinema_post' );
$loop = new WP_Query( $mypost );

while ( $loop->have_posts() ) : $loop->the_post();
	$file = get_field('asciienma_file');
	$playback_options = array(
	        "src" => $file['url'],
            "cols" => get_field('columns'),
            "rows" => get_field('rows'),
            "autoplay" => get_field('autoplay'),
            "loop" => get_field('loop'),
            "start_at" => get_field('start_at'),
            "speed" => get_field('speed'),
            "idle_time_limit" => get_field('idle_time_limit'),
            "poster_type" => get_field('poster_type'),
            "poster_time" => get_field('poster_time'),
            "poster_text" => get_field('poster_text'),
            "theme" => get_field('theme'),
            "font_size" => get_field('font_size')
    );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header"><h1><?php esc_html( the_title() ); ?></h1>
        <asciinema-player src="<?php echo $playback_options['src']; ?>"
                          cols="<?php echo $playback_options['cols']; ?>"
                          rows="<?php echo $playback_options['rows']; ?>"
                          <?php if ($playback_options['autoplay']) { echo 'autoplay="true" '; } ?>
                          <?php if ($playback_options['loop']) { echo 'loop="true"'; } ?>
                          start-at="<?php echo $playback_options['start_at']; ?>"
                          speed="<?php echo $playback_options['speed']; ?>"
                          idle-time-limit="<?php echo $playback_options['idle_time_limit']; ?>"
                          poster="<?php if ($playback_options['poster_text']) { echo 'data:text/plain,' . $playback_options['poster_text']; } else {echo 'npt:' . $playback_options['poster_time']; } ?>"
                          font-size="<?php echo $playback_options['font_size']; ?>"
                          theme="<?php echo $playback_options['theme']; ?>"

        ></asciinema-player>
        <p><?php echo get_field('description');?></p>
    </header>
</article>
<?php endwhile;
get_sidebar();
get_footer();?>
