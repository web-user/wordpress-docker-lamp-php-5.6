<?php 
  $logo_image = magplus_get_opt('amp-logo');
  $logo_class = (!empty($logo_image['url'])) ? 'has-logo':'';
?>
<header id="#top" class="amp-wp-header <?php echo esc_attr($logo_class); ?>">
	<div>
		<a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
			<?php $site_icon_url = $this->get( 'site_icon_url' );
			if ( $site_icon_url ) : ?>
				<amp-img src="<?php echo esc_url( $site_icon_url ); ?>" width="32" height="32" class="amp-wp-site-icon"></amp-img>
			<?php endif; ?>
			<?php echo esc_html( $this->get( 'blog_name' ) ); ?>
		</a>
	</div>
</header>
