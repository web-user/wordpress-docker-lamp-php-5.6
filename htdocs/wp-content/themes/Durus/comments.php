<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
    <p class="no-comments">
    <?php _e('This post is password protected. Enter the password to view comments.', 'brad'); ?>
    </p>
    <?php return; } ?>

<!-- You can start editing here. -->

   <?php if ( have_comments() ) : ?>
   <div id="comments">
        <h4 class="textuppercase title style1"><span><?php comments_number(__('No Comments', 'brad'), __('One Comment', 'brad'), __('% Comments', 'brad'));?></span></h4>
        
     <ol class="commentlist">
        <?php wp_list_comments('callback=brad_comment'); ?>
     </ol>
     
     <div class="comments-navigation">
        <div class="alignleft">
        <?php previous_comments_link(); ?>
        </div>
        <div class="alignright">
        <?php next_comments_link(); ?>
        </div>
     </div>
  </div>
  
  <?php else : // this is displayed if there are no comments so far ?>
     <?php if ( comments_open() ) : ?>
      <!-- If comments are open, but there are no comments. -->
      <?php else : // comments are closed ?>
     <?php endif; ?>
  <?php endif; ?>

  <?php if ( comments_open() ) : ?>
  
  <?php
	
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		//Custom Fields
		$fields =  array(
			'author'=> '<div class="row-fluid"><div class="span4"><div class="control-wrap"><span class="icon"><i class="ss-air ss-user"></i></span><input name="author" type="text" placeholder="' . __('Name*', 'brad') . '" size="30"' . $aria_req . ' /></div></div>',
			'email' => '<div class="span4"><div class="control-wrap"><span class="icon"><i class="ss-air ss-mail"></i></span><input name="email" type="text" placeholder="' . __('E-Mail*', 'brad') . '" size="30"' . $aria_req . ' /></div></div>',
			'url' 	=> '<div class="span4"><div class="control-wrap"><span class="icon"><i class="ss-air ss-link"></i></span><input name="url" type="text" placeholder="' . __('Website', 'brad') . '" size="30" /></div></div></div>',
		);

		//Comment Form Args
        $comments_args = array(
			'fields' => $fields,
			'title_reply'=>'<h4 class="textuppercase">'. __('Leave a reply', 'brad') .'</h4>',
			'comment_field' => '<div class="row-fluid"><div class="span12"><div class="control-wrap"><textarea id="comment" name="comment" aria-required="true" cols="58" rows="10" tabindex="4"></textarea></div></div></div>',
			'label_submit' => __('Submit comment','brad')
		);
		
		// Show Comment Form
		comment_form($comments_args); 
	?>

<?php endif; // if you delete this the sky will fall on your head ?>