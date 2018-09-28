<?php global $brad_data; ?>

<div class="contact-info">
  <?php if ( $brad_data['phone_topbar'] != '') : ?>
  <span><i class="fa-phone"></i><?php echo $brad_data['phone_topbar'];?></span>
  <?php endif; ?>
  <?php if ( $brad_data['email_topbar'] != '') : ?>
  <span><i class="fa-envelope"></i><?php echo $brad_data['email_topbar'];?></span>
  <?php endif; ?>
</div>
