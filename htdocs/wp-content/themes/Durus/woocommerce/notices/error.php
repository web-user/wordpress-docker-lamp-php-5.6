<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<div class="alert woocommerce-alert alert-error">
  <?php foreach ( $messages as $message ) : ?>
  <p><?php echo wp_kses_post( $message ); ?></p>
  <?php endforeach; ?>
</div>
