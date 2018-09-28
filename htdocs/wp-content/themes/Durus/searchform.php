
<form action="<?php echo home_url(); ?>/" id="searchform" class="search-form" method="get">
  <div>
    <input type="text" id="s" name="s" value="<?php _e('Type and Hit Enter', 'brad') ?>" onfocus="if(this.value=='<?php _e('Type and Hit Enter', 'brad') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Type and Hit Enter', 'brad') ?>';" autocomplete="off" />
    <input type="submit" value="search" class="hidden" />
  </div>
</form>
