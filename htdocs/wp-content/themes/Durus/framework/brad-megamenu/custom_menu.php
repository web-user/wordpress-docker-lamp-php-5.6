<?php

/**
 * Extended version to Create HTML list of nav menu items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
*/
 
class Brad_Megamenu_walker  extends Walker_Nav_Menu {
    /**
         * @var int $columns 
         */
        var $columns = 0;
        var $rows = 1;
		var $max_columns = 0;
        var $rowsCounter = array();
        var $mega_active = 0;
    
    
    
        /**
         * @see Walker::start_lvl()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            
            $output .= "\n$indent<ul class=\"sub-menu {replace_class}\">\n";


        }
    
        /**
         * @see Walker::end_lvl()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        function end_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
			
            if($depth === 0) 
            {
                if($this->active_megamenu)
                {

                    $output = str_replace("{replace_class}", "brad-mega-menu row-fluid columns-".$this->max_columns."", $output);
                    
                    foreach($this->rowsCounter as $row => $columns)
                    {
                        $output = str_replace("{current_row_".$row."}", "span" , $output);
                    }
                    
                    $this->columns = 0;
                    $this->max_columns = 0;
                    $this->rowsCounter = array();
                    
                }
                else
                {
                    $output = str_replace("{replace_class}", "", $output);
                }
            }
        }    



        function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
            global $wp_query;
            

            
            $item_output = $li_text_block_class = $column_class = "";
            
            if($depth === 0)
            {   
                $this->active_megamenu = get_post_meta( $item->ID, '_menu_item_brad_is_megamenu', true);
            }
            
            
            if($depth === 1 && $this->active_megamenu)
            {
                $this->columns ++;
                

                $this->rowsCounter[$this->rows] = $this->columns;
                
                if($this->max_columns < $this->columns) $this->max_columns = $this->columns;
                
				if( $item->brad_megamenu_hide_title != true ){
                     $title = apply_filters( 'the_title', $item->title, $item->ID );
                    if($title != "-" && $title != '"-"')
                    {
                       $menu_brad_icon  = ! empty( $item->brad_megamenu_icon ) ? brad_icon($item->brad_megamenu_icon,'','',false) : '';
                       $attributes = ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';      
                
                       $item_output .= $args->before;
                       $item_output .= '<div class="brad-megamenu-title"'. $attributes .'>';
                       $item_output .= $menu_brad_icon;
                       $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                       $item_output .= '</div>';
                       $item_output .= $args->after;
                   }
				}
				
                $column_class  = ' {current_row_'.$this->rows.'}';
                
            }
			
            else
            {
                $menu_brad_icon  = ! empty( $item->brad_megamenu_icon ) ? brad_icon($item->brad_megamenu_icon,'','',false) : '';
                $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';            
            
                $item_output .= $args->before;
                $item_output .= '<a'. $attributes .'>';
                $item_output .= $menu_brad_icon;
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
            }
            
            
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            $class_names = $value = '';
    
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';
    
            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
            
            
            
            
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
}
?>