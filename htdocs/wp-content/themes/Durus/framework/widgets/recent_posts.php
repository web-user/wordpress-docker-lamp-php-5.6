<?php
add_action('widgets_init', 'recent_posts_load_widgets');

function recent_posts_load_widgets()
{
	register_widget('recent_posts_Widget');
}

class recent_posts_Widget extends WP_Widget {
	
	function recent_posts_Widget()
	{
		$widget_ops = array('classname' => 'recent_posts', 'description' => 'Recent Posts with images');

		$control_ops = array('id_base' => 'recent-posts-widget');

		$this->WP_Widget('recent-posts-widget', 'Brad.Recent Posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		
		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>
	
		<?php
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $number ,
			'order'          => 'DESC',
		    'orderby'        => 'date',
		    'post_status'    => 'publish'
		);
		$recent_posts = new WP_Query($args);
		if($recent_posts->have_posts()):
		?>
        <ul class="widget-posts">
		<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
        <li class="widget-post">
		<?php if(has_post_thumbnail()): ?>
	    <?php the_post_thumbnail('mini'); ?>
		<?php endif; ?>
        <h6><a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a></h6>
        <p class="date"><?php echo get_the_date();?><?php echo __(' at ','brad');?><?php echo get_the_time();?></p>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        </ul>
		<?php endif; ?>
     
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent posts', 'number' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" type="text"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Number of items to show:</label>
			<input class="widefat" type="text"  id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
	<?php
	}
}
?>