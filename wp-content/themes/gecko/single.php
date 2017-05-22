<?php
/**
 * The template for displaying all single posts.
 *
 * @since   1.0.0
 * @package Gecko
 */

// Get blog detail layout
$layout = cs_get_option( 'blog-detail-layout' );
if ( $layout == 'left-sidebar' ) {
	$content_class = 'jas-col-md-9 jas-col-sm-12 jas-col-xs-12 mt__50';
	$sidebar_class = 'jas-col-md-3 jas-col-sm-12 jas-col-xs-12 first-md';
} elseif ( $layout == 'right-sidebar' ) {
	$content_class = 'jas-col-md-9 jas-col-sm-12 jas-col-xs-12 mt__50';
	$sidebar_class = 'jas-col-md-3 jas-col-sm-12 jas-col-xs-12';
} else {
	$content_class = 'jas-col-md-12 jas-col-sm-12 jas-col-xs-12 mt__50';
	$sidebar_class = '';
}

get_header(); ?>

<div id="jas-content">
	<?php
		if ( cs_get_option( 'blog-detail-title' ) ) {
			get_template_part( 'views/common/page', 'head' );	
		}
	?>
	<div class="jas-container">
		<div class="jas-row jas-single-blog">
			<div class="<?php echo esc_attr( $content_class ); ?>">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'views/post/content', 'single' ); ?>
					
					<div class="flex between-xs tag-comment mt__40">
						<?php
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gecko' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'gecko' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );
						?>
						<?php echo jas_gecko_get_tags(); ?>

						<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
							<div class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'gecko' ), esc_html__( '1 Comment', 'gecko' ), esc_html__( '% Comments', 'gecko' ) ); ?></div>
						<?php endif; ?>
					</div>

					<?php jas_gecko_social_share(); ?>

					<?php jas_gecko_related_post(); ?>
					
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					?>
				<?php endwhile; ?>
			</div>
			
			<?php if ( 'no-sidebar' != $layout ) { ?>
				<div class="<?php echo esc_attr( $sidebar_class ); ?>">
					<?php get_sidebar(); ?>
				</div><!-- .jas-col-md-3 -->
			<?php } ?>
		</div><!-- .jas-row -->
	</div><!-- .jas-container -->
</div><!-- #jas-content -->

<?php get_footer(); ?>