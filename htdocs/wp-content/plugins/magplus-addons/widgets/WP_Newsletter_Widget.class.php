<?php
/**
 * Latest posts widget
 *
 * @package magplus
 */

class magplus_WP_Newsletter_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_newsletter_entries', 'description' => __( "Add newsletter", 'magplus-pro-addons' ) );
        parent::__construct('subscribe-widget', __( '- magplus: Newsletter', 'magplus-pro-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_newsletter_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;

        $cache = wp_cache_get('widget_newsletter_entries', 'widget');

        if ( !is_array($cache) )
        {
            $cache = array();
        }
        if ( ! isset( $args['widget_id'] ) )
        {
            $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) )
        {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);
        echo $before_widget;

        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $image_url = $instance['image_url'];
        $content   = $instance['content'];
        if(function_exists('newsletter_form')):
        ?>

        <div class="tt-border-block">
            <div class="tt-newsletter">
                <h4 class="tt-newsletter-title c-h4"><small><?php echo esc_html($title); ?></small></h4>
                <?php if(!empty($content)): ?>
                <div class="simple-text">
                    <p><?php echo esc_html($content); ?></p>
                </div>
                <?php endif; ?>
                <?php if(!empty($image_url)): ?>
                <a class="tt-newsletter-img" href="#">
                    <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" height="149" width="105" alt="">
                </a>
                <?php endif; ?>
                <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)">
                    <input class="c-input" type="text" name="nn" required="" placeholder="First Name...">
                    <input class="c-input" type="email" name="ne" required="" placeholder="Email Address...">
                    <div class="c-btn type-1 style-2 color-2 size-3">
                        <input type="submit" class="newsletter-submit" value="subscribe now">
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
        <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_newsletter_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['content'] = $new_instance['content'];
        $instance['image_url'] = $new_instance['image_url'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_newsletter_entries']) )
        {
            delete_option('widget_newsletter_entries');
        }
        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('widget_newsletter_entries', 'widget');
    }

    function form( $instance )
    {
        $title     = isset($instance['title']) ? $instance['title'] : '';
        $content   = isset($instance['content']) ? $instance['content'] : '';
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('image_url')); ?>"><?php _e( 'Image URL:', 'magplus-pro-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url')); ?>" type="text" value="<?php echo esc_attr($image_url); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e( 'Content:', "magplus-addons" ); ?></label>
        <textarea class="widefat" rows="7" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_textarea($content); ?></textarea></p>
       
        <?php
    }
}
