  <section id="header-search-panel">
    <div class="container">
      <div class="row-fluid">
        <div class="search">
          <div>
            <form action="<?php echo home_url(); ?>/" id="header-search-form" method="get">
              <a class="close" href="#"><i class="fa-remove"></i></a>
              <input type="text"  id="header-search" name="s" value="" placeholder="<?php echo __('Search','brad');?>" autocomplete="off" />
              <!-- Create a fake search button --> 
              <span class="fake-submit-button"><i class="fa-search"></i>
              <input type="submit"  name="submit" value="submit" />
              </span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>