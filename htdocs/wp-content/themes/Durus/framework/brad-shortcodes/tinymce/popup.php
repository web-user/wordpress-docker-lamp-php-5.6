<?php
// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new brad_shortcodes( $popup );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="brad-popup">
  <div id="brad-shortcode-wrap">
    <div id="brad-sc-form-wrap">
      <?php
			$select_shortcode = array(
					'select' => 'Choose a Shortcode',
					'button' => 'Button',
					'image' => 'Image',
					'dropcap' => 'DropCap',
					'separator' => 'Separator',
					'heading' => 'Heading' ,
					'highlighted' => 'Highlighted',
					'tooltip' => 'Tooltip',
					'gap' => 'Gap',
					'checklist' => 'Checklist',
					'iconlist' => 'Icon List',
					'icon' => 'Icon',
					'social' => 'Social',
					'video' => 'Video' ,
					'pricing-table' => 'Pricing Table',
					'compare-table' => 'Compare Table',
					'columns' => 'Columns'
			);
			?>
      <table id="brad-sc-form-table" class="brad-shortcode-selector">
        <tbody>
          <tr class="form-row">
            <td class="label">Choose Shortcode</td>
            <td class="field"><div class="brad-form-select-field">
                <select name="brad_select_shortcode" id="brad_select_shortcode" class="brad-form-select brad-input">
                  <?php foreach($select_shortcode as $shortcode_key => $shortcode_value): ?>
                  <?php if($shortcode_key == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif; ?>
                  <option value="<?php echo $shortcode_key; ?>" <?php echo $selected; ?>><?php echo $shortcode_value; ?></option>
                  <?php endforeach; ?>
                </select>
              </div></td>
          </tr>
        </tbody>
      </table>
      <form method="post" id="brad-sc-form">
        <table id="brad-sc-form-table">
          <?php echo $shortcode->output; ?>
          <tbody>
            <tr class="form-row">
              <?php if( ! $shortcode->has_child ) : ?>
              <td class="label">&nbsp;</td>
              <?php endif; ?>
              <td class="<?php if( ! $shortcode->has_child ) : ?>field<?php endif; ?>"><a href="#" class="button-primary brad-insert">Insert Shortcode</a></td>
            </tr>
          </tbody>
        </table>
        <!-- /#brad-sc-form-table -->
      </form>
      
      <!-- /#brad-sc-form --> 
      
    </div>
    <!-- /#brad-sc-form-wrap -->
    
    <div class="clear"></div>
  </div>
  <!-- /#brad-shortcode-wrap --> 
  
</div>
<!-- /#brad-popup -->

</body>
</html>