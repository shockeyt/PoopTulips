<?php
/**
 * The template for displaying maintenance mode.
 *
 * @since   1.0.0
 * @package Gecko
 */

// Get the time
$date  = cs_get_option( 'maintenance-date' );
$month = cs_get_option( 'maintenance-month' );
$year  = cs_get_option( 'maintenance-year' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="jas-wrapper">
			<div class="jas-offline-content flex middle-xs center-xs">
				<div class="inner cw">
					<h1><?php echo cs_get_option( 'maintenance-title' ); ?></h1>
					<h3><?php echo cs_get_option( 'maintenance-message' ); ?></h3>
					<p><?php echo cs_get_option( 'maintenance-content' ); ?></p>
					
					<?php if ( cs_get_option( 'maintenance-countdown' ) ) : ?>
						<div class="jas-countdown"></div>
						<script>
							jQuery(function() {
								var endDate = "<?php echo cs_get_option( 'maintenance-month' ); ?> <?php echo cs_get_option( 'maintenance-date' ); ?>, <?php echo cs_get_option( 'maintenance-year' ); ?> 00:00:00";
								jQuery('.jas-countdown').countdown({
									date: endDate,
									render: function(data) {
									jQuery(this.el).html("<div class='pr'><span class='db cw fs__16 mt__10'>" + this.leadingZeros(data.days, 2) + "</span><span class='db'>days</span></div><div class='pr'><span class='db cw fs__16 mt__10'>" + this.leadingZeros(data.hours, 2) + "</span><span class='db'>hrs</span></div><div class='pr'><span class='db cw fs__16 mt__10'>" + this.leadingZeros(data.min, 2) + "</span><span class='db'>mins</span></div><div class='pr'><span class='db cw fs__16 mt__10'>" + this.leadingZeros(data.sec, 2) + "</span><span class='db'>secs</span></div>");
								  }
								});
							});
						</script>
					<?php endif; ?>
				</div>
			</div><!-- .jas-offline -->
		</div><!-- #jas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>