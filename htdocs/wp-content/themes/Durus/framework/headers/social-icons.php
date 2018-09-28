<?php  global $brad_data; ?>

<ul class="social-icons clearfix">
          <?php if($brad_data['social_twitter'] != "") { ?>
          <li> <a  class="twitter" href="http://www.twitter.com/<?php echo $brad_data['social_twitter']; ?>" target="_blank" title="<?php _e( 'Twitter', 'brad' ) ?>"> <i class="fa-twitter"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_dribbble'] != "") { ?>
          <li> <a class="dribbble" href="<?php echo $brad_data['social_dribbble']; ?>" target="_blank" title="<?php _e( 'Dribbble', 'brad' ) ?>"> <i class="fa-dribbble"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_flickr'] != "") { ?>
          <li> <a  class="flickr" href="<?php echo $brad_data['social_flickr']; ?>" target="_blank" title="<?php _e( 'Flickr', 'brad' ) ?>"> <i class="fa-flickr"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_facebook'] != "") { ?>
          <li > <a class="facebook" href="<?php echo $brad_data['social_facebook']; ?>" target="_blank" title="<?php _e( 'Facebook', 'brad' ) ?>"> <i class="fa-facebook"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_skype'] != "") { ?>
          <li > <a class="skype" href="<?php echo $brad_data['social_skype']; ?>" target="_blank" title="<?php _e( 'Skype', 'brad' ) ?>"> <i class="fa-skype"></i> </a> </li>
          <?php } ?>
  
          <?php if($brad_data['social_google'] != "") { ?>
          <li class="google"> <a href="<?php echo $brad_data['social_google']; ?>" target="_blank" title="<?php _e( 'Google', 'brad' ) ?>"> <i class="fa-google-plus"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_linkedin'] != "") { ?>
          <li class="linkedin"> <a href="<?php echo $brad_data['social_linkedin']; ?>" target="_blank" title="<?php _e( 'LinkedIn', 'brad' ) ?>"> <i class="fa-linkedin"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_vimeo'] != "") { ?>
          <li class="vimeo"> <a href="<?php echo $brad_data['social_vimeo']; ?>" target="_blank" title="<?php _e( 'Vimeo', 'brad' ) ?>"> <i class="ss-social-regular ss-vimeo"></i> </a> </li>
          <?php } ?>
        
          <?php if($brad_data['social_tumblr'] != "") { ?>
          <li class="tumblr"> <a href="<?php echo $brad_data['social_tumblr']; ?>" target="_blank" title="<?php _e( 'Tumblr', 'brad' ) ?>"> <i class="fa-tumblr"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_youtube'] != "") { ?>
          <li class="youtube"> <a href="<?php echo $brad_data['social_youtube']; ?>" target="_blank" title="<?php _e( 'YouTube', 'brad' ) ?>"> <i class="fa-youtube"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_instagram'] != "") { ?>
          <li class="instagram"> <a href="<?php echo $brad_data['social_instagram']; ?>" target="_blank" title="<?php _e( 'Instgram', 'brad' ) ?>"> <i class="fa-instagram"></i> </a> </li>
          <?php } ?>
     
          <?php if($brad_data['social_behance'] != "") { ?>
          <li class="behance"> <a href="<?php echo $brad_data['social_behance']; ?>" target="_blank" title="<?php _e( 'Behance', 'brad' ) ?>"> <i class="ss-social-regular ss-behance"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_pinterest'] != "") { ?>
          <li class="pinterest"> <a href="<?php echo $brad_data['social_pinterest']; ?>" target="_blank" title="<?php _e( 'Pinterest', 'brad' ) ?>"> <i class="fa-pinterest"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_paypal'] != "") { ?>
          <li class="paypal"> <a href="<?php echo $brad_data['social_paypal']; ?>" target="_blank" title="<?php _e( 'PayPal', 'brad' ) ?>"> <i class="ss-social-regular ss-paypal"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_delicious'] != "") { ?>
          <li class="delicious"> <a href="<?php echo $brad_data['social_delicious']; ?>" target="_blank" title="<?php _e( 'Delicious', 'brad' ) ?>"> <i class="ss-social-regular ss-delicious"></i> </a> </li>
          <?php } ?>
          <?php if($brad_data['social_rss'] == true) { ?>
          <li > <a class="rss" href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="<?php _e( 'RSS', 'brad' ) ?>"> <i class="fa-rss"></i> </a> </li>
          <?php } ?>
          </ul>