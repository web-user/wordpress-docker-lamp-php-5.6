<?php
/******************************************************/
/*         twitter widget
/******************************************************/		 
class widget_twitter extends WP_Widget { 
	
	// Widget Settings
	function widget_twitter() {
		$widget_ops = array('description' => __('Display your latest Tweets','brad-framework') );
		$control_ops = array( 'id_base' => 'twitter' );
		$this->WP_Widget( 'twitter', __('Brad.Twitter Widget','brad-framework'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {

		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$twitter_id = trim($instance['twitter_id']);
		$count = (int) $instance['count'];
		echo $before_widget;
		
		if($title) {
			echo $before_title.$title.$after_title;
		}

	    echo brad_get_tweets($count , $twitter_id);
		
		echo $after_widget;
	}
	
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = esc_attr($new_instance['title']);
		$instance['twitter_id'] = esc_attr($new_instance['twitter_id']);
		$instance['count'] = esc_attr($new_instance['count']);

		return $instance;
	}

     function form($instance) {
		 
		// Set up some default widget settings
		$defaults = array('title' => 'Latest Tweets', 'twitter_id' => '', 'count' => 5, 'consumer_key' => '', 'consumer_secret' => '' , 'access_token' => '' , 'access_token_secret' => '');
		$instance = wp_parse_args((array) $instance, $defaults);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
</p>
<p>
  <label for="<?php echo $this->get_field_id('twitter_id'); ?>">Your Twitter User Name: </label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>">
  <small><b>Note:</b> You need to activated the oAuth Twitter Feed Plugin and you have entered the correct api keys in settings -> Twitter Feed oauth</small>
</p>

<p>
  <label for="<?php echo $this->get_field_id('count'); ?>">Display how many tweets?</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>">
</p>
<?php
	}
}	

// Add Widget
function widget_twitter_init() {
	register_widget('widget_twitter');
}
add_action('widgets_init', 'widget_twitter_init');

?>
