<?php

/**********************************************
embeding video widget
***********************************************/

class widget_embed extends WP_Widget_Text { 
	
	
	function widget_embed() {
		$widget_ops = array('description' => __('Display Embed Video','brad-framework') );
		$control_ops = array( 'id_base' => 'embed' );
		$this->WP_Widget( 'embed', __('Brad.Embed_Video','brad-framework'), $widget_ops, $control_ops );
	}
	
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$embed = $instance['embed'];
		$description = $instance['description'];
		
	
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo '<div class="video">';
		echo $embed;
		if (!empty($description)) { echo '<p>' . $description . '</p>'; }
		echo '</div>';

		echo $after_widget;
	
	}
	
	
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['embed'] = $new_instance['embed'];
		$instance['description'] = $new_instance['description'];
		
		return $instance;
	}
	
	
	function form($instance) {
		
		$defaults = array( 'title' => 'Embed Widget', 'embed' => '', 'description' => '' ); 
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"  style="width: 100%;"name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'embed' ); ?>">Embed Code:</label>
			<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id( 'embed' ); ?>" style="width: 100%;" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo $instance['embed']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">Description:</label>
			<textarea class="widefat" rows="2" cols="20" style="width: 100%;"  id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $instance['description']; ?></textarea>
		</p>
		
    <?php }
}

function widget_embed_init() {
	register_widget('widget_embed');
}
add_action('widgets_init', 'widget_embed_init');

?>