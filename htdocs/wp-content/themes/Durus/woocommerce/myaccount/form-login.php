<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php wc_print_notices(); ?>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="row-fluid" id="customer_login">
  <div class="span6">
    <?php endif; ?>
    <div class="woocommerce-box">
      <h2>
        <?php _e( 'Login', 'woocommerce' ); ?>
      </h2>
      <form method="post" class="login brad-woocommerce-form brad-woocommerce-login">
        <?php do_action( 'woocommerce_login_form_start' ); ?>
        <p class="form-row form-row-wide">
          <label for="username">
            <?php _e( 'Username or email address', 'woocommerce' ); ?>
            <span class="required">*</span></label>
          <input type="text" class="input-text" name="username" id="username" />
        </p>
        <p class="form-row form-row-wide">
          <label for="password">
            <?php _e( 'Password', 'woocommerce' ); ?>
            <span class="required">*</span></label>
          <input class="input-text" type="password" name="password" id="password" />
        </p>
        <?php do_action( 'woocommerce_login_form' ); ?>
        <p class="form-row alignleft">
          <?php wp_nonce_field( 'woocommerce-login' ); ?>
          <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
          <label for="rememberme" class="inline">
            <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
            <?php _e( 'Remember me', 'woocommerce' ); ?>
          </label>
        </p>
        <p class="lost_password alignleft"> <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>">
          <?php _e( 'Lost your password?', 'woocommerce' ); ?>
          </a> </p>
        <div class="clear"></div>
        <?php do_action( 'woocommerce_login_form_end' ); ?>
      </form>
    </div>
    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
  </div>
  <div class="span6">
    <div class="woocommerce-box">
      <h2>
        <?php _e( 'Register', 'woocommerce' ); ?>
      </h2>
      <form method="post" class="register brad-woocommerce-form">
        <?php do_action( 'woocommerce_register_form_start' ); ?>
        <?php if ( get_option( 'woocommerce_registration_generate_username' ) === 'no' ) : ?>
        <p class="form-row form-row-wide">
          <label for="reg_username">
            <?php _e( 'Username', 'woocommerce' ); ?>
            <span class="required">*</span></label>
          <input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) esc_attr( $_POST['username'] ); ?>" />
        </p>
        <?php endif; ?>
        <p class="form-row form-row-wide">
          <label for="reg_email">
            <?php _e( 'Email address', 'woocommerce' ); ?>
            <span class="required">*</span></label>
          <input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) esc_attr( $_POST['email'] ); ?>" />
        </p>
        <p class="form-row form-row-wide">
          <label for="reg_password">
            <?php _e( 'Password', 'woocommerce' ); ?>
            <span class="required">*</span></label>
          <input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) esc_attr( $_POST['password'] ); ?>" />
        </p>
        
        <!-- Spam Trap -->
        <div style="left:-999em; position:absolute;">
          <label for="trap">
            <?php _e( 'Anti-spam', 'woocommerce' ); ?>
          </label>
          <input type="text" name="email_2" id="trap" tabindex="-1" />
        </div>
        <?php do_action( 'woocommerce_register_form' ); ?>
        <?php do_action( 'register_form' ); ?>
        <p class="form-row">
          <?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
          <input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
        </p>
        <?php do_action( 'woocommerce_register_form_end' ); ?>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
