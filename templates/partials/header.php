<header class="navbar top" role="banner">
  <div class="container">

    <div class="navbar-header">

    <?php $logo = get_field( 'global_logo', 'option' ); ?>
        
			<figure class="title-bar-title">
				<figcaption>
				<?php if( is_single() ) : ?>
				
			    <?php if ( $logo ) : ?>
		      <a class="logo logo__brand" href="<?php echo bloginfo('url');?>">
		        <img class="logo--header" src="<?php echo $logo['url']; ?>" alt="<?php echo $username; ?>">
		      </a>
					<?php else : ?>
		      <a class="logo logo__brand" href="<?php echo bloginfo('url');?>">
		        <?php echo bloginfo('name');?>
		      </a>
					<?php endif; ?>
					
				<?php elseif( is_category() ) : 
						$cats = get_the_category();
						
						if($cats) {
							$href .= '/' . get_option( 'category_base' ) . '/';
							foreach($cats as $cat){
								$href .= $cat->slug;
							}
						}
				?>
					
			    <?php if ( $logo ) : ?>
		      <a class="logo logo__brand" href="<?php echo $href;?>">
		        <img class="logo--header" src="<?php echo $logo['url']; ?>" alt="<?php echo single_cat_title(); ?>">
		      </a>
					<?php else : ?>
		      <a class="logo logo__brand" href="<?php echo $href;?>">
		        <?php echo single_cat_title();?>
		      </a>
					<?php endif; ?>
					
				<?php elseif( is_archive() ) :
						$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
						$username = get_the_author();
						if($username === 'maakuw') $username = '真ー久W';
				?>
			    <?php if ( $logo ) : ?>
		      <a class="logo logo__brand" href="<?php echo $href;?>">
		        <img class="logo--header" src="<?php echo $logo['url']; ?>" alt="<?php echo $username; ?>">
		      </a>
					<?php else : ?>
		      <a class="logo logo__brand" href="<?php echo $href;?>">
		        <?php echo $username; ?>
		      </a>
					<?php endif; ?>
		    
				<?php else: ?>
		    
			    <?php if ( $logo ) : ?>
		      <a class="logo logo__brand" href="#top">
		        <img class="logo--header" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('name'); ?>">
		      </a>
					<?php else : ?>
		      <a class="logo logo__brand" href="#top">
		        <?php echo bloginfo('name'); ?>
		      </a>
					<?php endif; ?>
		    
				<?php endif; ?>
				</figcaption>
			</figure>

      <nav class="primary-nav" id="primary-nav" role="navigation">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
        ?>
      </nav><!-- .primary-nav -->
      <?php if (has_nav_menu('secondary_navigation')) : ?>
      <div class="overlay-navigation">
        <nav class="secondary-nav" id="secondary-nav" role="navigation">
          <?php wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav navbar-nav'));?>
        </nav><!-- .secondary-nav -->
        <div class="header__social">
          <h6 class="header__social__heading">FOLLOW US</h6>
          <?php ll_get_social_list(); ?>
        </div><!-- .header__social -->
        <a class="logo__brand" href="<?php echo esc_url(home_url('/')); ?>">
          <?php echo ll_get_logo('centered'); ?>
        </a><!-- .logo__brand -->
      </div>
      <button type="button" class="navbar-toggle navbar-toggle--stand">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggle__box">
          <span class="navbar-toggle__inner"></span>
        </span><!-- .navbar-toggle__box -->
      </button><!-- .navbar-toggle -->
      <?php endif; ?>
    </div>
	  <nav class="title-bar-right">
		<?php if( is_user_logged_in() ) : ?>
			<a href="<?php echo $admin_url;?>">
				<em class="fa fa-cog"></em>
			</a>
		<?php endif; ?>
			<a href="<?php echo $user_url;?>">
				<em class="fa fa-user"></em>
			</a>
		<?php if ( shortcode_exists( 'nu_tweets' ) ) : ?>
			<a href="#twitter-feed">
				<em class="fa fa-twitter"></em>
			</a>
		<?php endif; ?>
	  </nav>
    
  </div>
</header>
