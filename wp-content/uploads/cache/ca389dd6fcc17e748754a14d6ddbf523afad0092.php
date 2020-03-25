

<?php if(!defined('ABSPATH')) { exit; } ?>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<?php if( wc_get_page_id( 'shop' ) > 0 ): ?>
	<p class="return-to-shop text-center">
		<a class="btn btn-primary wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php echo esc_html_e( 'Return to shop', 'woocommerce' ); ?>

		</a>
	</p>
<?php endif; ?>
