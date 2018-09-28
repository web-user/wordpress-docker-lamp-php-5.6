<?php get_header(); ?>

<section id="section_0" class="section section-error">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span8">
          <div class="inner-content">
            <div id="error-404">
              <h1>
                <?php _e('Error: 404', 'brad'); ?>
              </h1>
              <p>
                <?php _e("404 error, couldn't find the content you were looking for.", 'brad'); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="span4">
          <div class="inner-content">
            <div class="search-form-404 clearfix">
            <h3><?php echo _e('Search Our Website','brad-framework');?></h3>
             <p><?php _e('Use the below form to search what you was looking for:', 'brad'); ?></p>
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
