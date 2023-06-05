<?php
/**
 * Displays Contact Details on header top
 *
 * @package Catch_Store
 */
?>

<?php
$date    = get_theme_mod( 'catch_shop_display_date' );
$email   = get_theme_mod( 'catch_shop_email' );
$address = get_theme_mod( 'catch_shop_address' );
$phone   = get_theme_mod( 'catch_shop_phone' );

if ( $date || $email  || $address || $phone ): ?>
	<div class="header-top-left">
		<ul class="contact-details">
			<?php if ( $date ) : ?>
			<li class="date"><?php echo catch_shop_get_svg( array( 'icon' => 'calendar' ) ); ?><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></li>
			<?php endif; ?>

			<?php if ( $email ) : ?>
			<li class="contact-email"><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo catch_shop_get_svg( array( 'icon' => 'email' ) );  echo esc_html( antispambot( $email ) ) ?></a></li>
			<?php endif; ?>

			<?php if ( $phone ) : ?>
			<li class="contact-phone"><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo catch_shop_get_svg( array( 'icon' => 'phone' ) ); echo esc_html( preg_replace( '/\s+/', '', $phone ) ); ?></a></li>
			<?php endif; ?>

			<?php if ( $address ) : ?>
			<li class="contact-address"><?php echo catch_shop_get_svg( array( 'icon' => 'location' ) ); echo wp_kses_post( $address ); ?></li>
			<?php endif; ?>
		</ul><!-- .contact-details -->
	</div><!-- .header-top-left -->

<?php endif; ?>
