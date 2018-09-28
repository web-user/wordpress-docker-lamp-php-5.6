<?php

/* Skills (Bar)
---------------------------------------------------------- */

class WPBakeryShortCode_VC_Progress_Bar extends WPBakeryShortCode {
	
  protected  function content( $atts , $content = null , $helper = false) {
		
      $output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = '';
      extract( shortcode_atts( array(
         'title' => '',
         'values' => '',
         'units' => '',
         'bar_color' => 'default',
         'options' => '',
         'el_class' => ''
          ), $atts ) );
      
	  $el_class = $this->getExtraClass($el_class);
      $bar_options = '';
      $options = explode(",", $options);
      if (in_array("animated", $options)) $bar_options .= " animated-stripes";
      if (in_array("striped", $options)) $bar_options .= " progress-striped";
	  
      $graph_lines = explode(",", $values);
      $max_value = 0.0;
      $graph_lines_data = array();
	  
      foreach ($graph_lines as $line) {
      $new_line = array();
      $color_index = 2;
      $data = explode("|", $line);
      $new_line['value'] = isset($data[0]) ? $data[0] : 0;
      $new_line['percentage_value'] = isset($data[1]) && preg_match('/^\d{1,2}\%$/', $data[1]) ? (float)str_replace('%', '', $data[1]) : false;
     if($new_line['percentage_value']!=false) {
        $new_line['label'] = isset($data[2]) ? $data[2] : '';
     } else {
        $new_line['label'] = isset($data[1]) ? $data[1] : '';
     }
	 
    if($new_line['percentage_value']===false && $max_value < (float)$new_line['value']) {
        $max_value = $new_line['value'];
    }

    $graph_lines_data[] = $new_line;
}

   foreach($graph_lines_data as $line) {
    $unit = ($units!='') ? ' <strong>' .  $line['value'] . $units . '</strong>' : '';
    $output .= '<div class="progress-wrap">';
    $output .= '<p class="bar-text">'. $line['label'] . $unit .'</p>';
    if($line['percentage_value'] !== false) {
        $percentage_value = $line['percentage_value'];
    } elseif($max_value > 100.00) {
        $percentage_value = (float)$line['value'] > 0 && $max_value > 100.00 ? round((float)$line['value']/$max_value*100, 4) : 0;
    } else {
        $percentage_value = $line['value'];
    }
    $output .= '<div class="progress '.$bar_options.' '.$bar_color.'"><div class="bar" data-percentage-value="'.($percentage_value).'" data-value="'.$line['value'].'"></div></div>';
    $output .= '</div>';
	}

   
   return $output . $this->endBlockComment('progress_bar') . "\n";
   
   }
}