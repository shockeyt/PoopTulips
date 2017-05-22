<?php
/**
 * The template display latest post.
 *
 * @since   1.0.0
 * @package Gecko
 */

$id   = cs_get_option( 'blog-latest-slider-ids' );
$item = cs_get_option( 'blog-latest-slider-show' );

$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true
);

if ( ! empty( $id ) ) {
	$args['post__in'] = $id;
}

$query = new WP_Query( $args );
?>
<div class="jas-blog-slider jas-carousel" data-slick='{"slidesToShow": <?php echo $item ? $item : 3 ;?>,"slidesToScroll": 1, "responsive":[{"breakpoint": 960,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="post-thumbnail pr" id="slider-post-<?php the_ID(); ?>">
			<a href="<?php esc_url( the_permalink() ); ?>">
				<?php
					if ( has_post_thumbnail() ) :
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						if ( $img[1] >= 480 && $img[2] >= 310 ) {
							$image = aq_resize( $img[0], 470, 310, true );
							echo '<img src="' . esc_url( $image ) . '" width="480" height="310" alt="' . get_the_title() . '" />';
						} else {
							echo '<div class="pr placeholder mb__15">';
								echo '<img src="' . JAS_GECKO_URL . '/assets/images/placeholder.png" width="480" height="310" alt="' . get_the_title() . '" />';
								echo '<div class="pa tc fs__10">' . esc_html__( 'The photos should be at least 370px x 210px', 'gecko' ) . '</div>';
							echo '</div>';
						}
					else :
						echo '<img src="' . JAS_GECKO_URL . '/assets/images/placeholder.png" width="480" height="310" alt="' . get_the_title() . '" />';
					endif;
				?>
			</a>
			<div class="pa tc cg w__100">
				<?php jas_gecko_post_meta(); ?>
				<?php jas_gecko_post_title(); ?>
				<?php jas_gecko_posted_on(); ?>
			</div>
		</div>
	<?php
		endwhile;
		wp_reset_postdata();
	?>
</div><!-- .jas-blog-slider -->