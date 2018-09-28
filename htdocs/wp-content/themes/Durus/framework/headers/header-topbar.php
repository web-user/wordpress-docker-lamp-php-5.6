<?php global $brad_data; ?>

<div id="top_bar" class="top-bar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span6 topbar-left-content">
          <?php 
		  if( $brad_data['topbar_left_content'] == 'socialicons' ) {
		     get_template_part('framework/headers/social-icons'); 
		  }
		  else if( $brad_data['topbar_left_content'] == 'topmenu' ) {
		     get_template_part('framework/headers/topmenu'); 
		  }
		  else if ( $brad_data['topbar_left_content'] == 'contactinfo' ){
		     get_template_part('framework/headers/contact-info'); 
		  }
		  ?>
        </div>
        <div class="span6 topbar-right-content">
          <?php 
		  if( $brad_data['topbar_right_content'] == 'socialicons' ) {
		     get_template_part('framework/headers/social-icons'); 
		  }
		  else if( $brad_data['topbar_right_content'] == 'topmenu' ) {
		     get_template_part('framework/headers/topmenu'); 
		  }
		  else if ( $brad_data['topbar_right_content'] == 'contactinfo' ){
		     get_template_part('framework/headers/contact-info'); 
		  }
		  ?>
        </div>
      </div>
    </div>
  </div>
</div>
