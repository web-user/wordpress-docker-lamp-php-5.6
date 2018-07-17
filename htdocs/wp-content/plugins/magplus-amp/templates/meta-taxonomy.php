<?php
if(magplus_get_opt('amp-tags-enable-switch')):
$tags = get_the_tag_list(
	'',
	_x( ', ', 'Used between list items, there is a space after the comma.', 'amp' ),
	'',
	$this->ID
); ?>
<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
	<div class="amp-wp-meta amp-wp-tax-tag">
		<?php printf( esc_html__( 'Tags: %s', 'amp' ), $tags ); ?>
	</div>
<?php endif; endif; ?>
