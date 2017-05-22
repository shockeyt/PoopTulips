<?php
/**
 * The template part for displaying content.
 * 
 * @since   1.0.0
 * @package Gecko
 */
?>
<?php do_action( 'jas_gecko_before_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb__80' ); ?> <?php jas_gecko_schema_metadata( array( 'context' => 'entry' ) ); ?>>
	<?php jas_gecko_post_thumbnail(); ?>
	
	<div class="post-content">
		<?php
			the_content( sprintf(
				__( 'Read more<span class="screen-reader-text"> "%s"</span>', 'gecko' ),
				get_the_title()
			) );
		?>
	</div><!-- .post-content -->
</article><!-- #post-# -->
<?php do_action( 'jas_gecko_after_post' ); ?>