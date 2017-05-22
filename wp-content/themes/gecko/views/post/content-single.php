<?php
/**
 * The template part for displaying single posts.
 * 
 * @since   1.0.0
 * @package Gecko
 */
?>
<?php do_action( 'jas_gecko_before_single_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php jas_gecko_schema_metadata( array( 'context' => 'entry' ) ); ?>>
	<?php
		if ( ! cs_get_option( 'blog-detail-title' ) ) {
			the_title( '<h1 class="post-title mg__0 fs__30" ' . jas_gecko_schema_metadata( array( 'context' => 'entry_title', 'echo' => false ) ) . '>', '</h1>', true );

			echo '<div class="post-meta-inside flex mb__20">';
				jas_gecko_post_meta();
				jas_gecko_posted_on();
			echo '</div>';

			if ( has_post_thumbnail() ) {
				echo '<div class="post-thumbnail mb__20">';
					the_post_thumbnail();
				echo '</div>';
			}
		}
	?>	
	<div class="post-content" <?php jas_gecko_schema_metadata( array( 'context' => 'entry_content' ) ); ?>>
		<?php
			the_content( sprintf(
				__( 'Read more<span class="screen-reader-text"> "%s"</span>', 'gecko' ),
				get_the_title()
			) );
		?>
	</div>
</article><!-- #post-# -->
<?php do_action( 'jas_gecko_after_single_post' ); ?>