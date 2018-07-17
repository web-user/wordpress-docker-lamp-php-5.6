<?php 

class wpmenuvml extends WP_Widget {

    /** constructor */
    function wpmenuvml() {
	
		$name =			'Wpmenuvml';
		$desc = 		'Create Vertical Menus From Any Wordpress Custom Menu';
		$id_base = 		'wpmenuvml';
		$css_class = 	'';
		$alt_option = 	'widget_wpmenuvml_navigation'; 

		$widget_ops = array(
			'classname' => $css_class,
			'description' => __( $desc, 'wpmenuvml-menu' ),
		);
		add_action( 'load-widgets.php', array(&$this, 'color_picker_load') );
		parent::WP_Widget( 'nav_menu', __('Custom Menu'), $widget_ops );
		
		$this->WP_Widget($id_base, __($name, 'wpmenuvmlmenu'), $widget_ops);
		$this->alt_option_name = $alt_option;
		

		$this->defaults = array(
			'title' => '',
			'subMenuWidth' => '150px',
			'direction' => 'right'
		);
    }
	function color_picker_load() {      
	    wp_enqueue_style( 'wp-color-picker' );          
	    wp_enqueue_script( 'wp-color-picker' );      
	} 


	function widget($args, $instance) {
		extract( $args );
		$color = '';
		if($instance['color'] != ''){
		    $color = $instance['color'];
		}

		// Get menu	
		$widget_options = wp_parse_args( $instance, $this->defaults );
		extract( $widget_options, EXTR_SKIP );
		
		$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		
		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
			
		?>

		<?php
			if( $instance['direction'] == 'right' ):
				echo "<div style='background-color: ".$instance['color']."' class='wpmenuvml-menu-right' id='".$this->id.'-item'." '>";
			?>
			<style type="text/css">
			.wpmenuvml-menu-right li ul {
				background-color: <?php echo $instance['color']; ?>;
				}
			</style>
			<?php

		else:
			echo "<div style='background-color: ".$instance['color']."' class='wpmenuvml-menu-left' id='".$this->id.'-item'." '>";
		?>
		<style type="text/css">
		.wpmenuvml-menu-left li ul {
			background-color: <?php echo $instance['color']; ?>;
			}
		</style>

		<?php
		endif;
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		
		?>
		
		</div>
		<?php
		
		echo $args['after_widget'];
	}

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		$instance['subMenuWidth'] = $new_instance['subMenuWidth'];
		$instance['direction'] = $new_instance['direction'];
		$instance['color'] = $new_instance['color'];
		
		return $instance;
	}

    /** @see WP_Widget::form */
    function form($instance) {


    	if( isset( $instance['color'] ) ){
    		$color = $instance['color'];
    	}else{
    		$color= "#fff";
    	}

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$subMenuWidth = isset( $instance['subMenuWidth'] ) ? $instance['subMenuWidth'] : '';
		$direction = isset( $instance['direction'] ) ? $instance['direction'] : '';
		
		$widget_options = wp_parse_args( $instance, $this->defaults );
		extract( $widget_options, EXTR_SKIP );

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<div class="web_color">
			

		<p>
		    <label for="<?php echo $this->get_field_name( 'color' ); ?>"><?php _e( 'Background Color Menu:' ); ?></label><br />
		    <input id="<?php echo $this->get_field_id( 'color' ); ?>" class="iris_color_der" name="<?php echo $this->get_field_name( 'color' ); ?>" type="text" value="<?php echo $color; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
	</p>
</div>
	<p>
		<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
		<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
		</select>
	</p>
	<input type="hidden" value="<?php echo $subMenuWidth; ?>" class="widefat" id="<?php echo $this->get_field_id('subMenuWidth'); ?>" name="<?php echo $this->get_field_name('subMenuWidth'); ?>" />

	<p><label for="<?php echo $this->get_field_id('direction'); ?>"><?php _e('Direction:', 'wpmenuvml-menu'); ?>
		<select name="<?php echo $this->get_field_name('direction'); ?>" id="<?php echo $this->get_field_id('direction'); ?>" >
			<option value='right' <?php selected( $direction, 'right'); ?> >Right</option>
			<option value='left' <?php selected( $direction, 'left'); ?> >Left</option>
		</select>
		</label>
	</p>
	<script type="text/javascript">
			jQuery(document).ready(function($){
				// console.log('Sfff');
				$('.iris_color_der').wpColorPicker();

			});
	</script>

	<?php 
	}
	




} // class wpmenuvml