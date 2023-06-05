<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_theme_mod('modern_ecommerce_slider_arrows') != ''){ ?>
    <section id="slider">
      <span class="design-right"></span>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php
          for ( $i = 1; $i <= 4; $i++ ) {
            $mod =  get_theme_mod( 'modern_ecommerce_post_setting' . $i );
            if ( 'page-none-selected' != $mod ) {
              $modern_ecommerce_slide_post[] = $mod;
            }
          }
           if( !empty($modern_ecommerce_slide_post) ) :
          $args = array(
            'post_type' =>array('post'),
            'post__in' => $modern_ecommerce_slide_post
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 image-content">
                <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 slide-content ">
                <div class="carousel-caption text-center text-md-left text-sm-left px-5 px-md-3">
                  <h2 class="slider-title"><?php the_title();?></h2>
                  <p class="mb-0"><?php echo esc_html(wp_trim_words(get_the_content(),'20') );?></p>
                  <div class="home-btn text-center text-md-left text-sm-left my-4">
                    <a class="py-3 px-4" href="<?php the_permalink(); ?>"><?php echo esc_html('Shop Now','shopkeeper-ecommerce'); ?><i class="fas fa-shopping-bag ml-2"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php if( get_theme_mod('modern_ecommerce_category_setting') != ''){ ?>
    <section id="product-services">
      <div class="container">
        <div class="services-box my-5 my-lg-0">
          <div class="row">
            <?php
              $services_category=  get_theme_mod('modern_ecommerce_category_setting');if($services_category){
              $page_query = new WP_Query(array( 'category_name' => esc_html($services_category ,'shopkeeper-ecommerce')));?>
                <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>  
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="row">
                      <div class="col-lg-4 col-md-12 col-sm-12 img-box">
                        <?php the_post_thumbnail(); ?>
                      </div>
                      <div class="col-lg-8 col-md-12 col-sm-12 text-center text-lg-left">
                        <a href="<?php the_permalink(); ?>"><h4 class="mb-2 mb-md-0"><?php the_title();?></h4></a>
                        <p class="mb-md-0"><?php echo esc_html(wp_trim_words(get_the_content(),'8') );?></p>
                      </div>
                    </div>
                  </div>
                <?php endwhile;
              wp_reset_postdata();
            }?>
          </div>
        </div>
      </div>
    </section>
  <?php }?>

  <?php if( get_theme_mod('modern_ecommerce_product_title') != '' || get_theme_mod('modern_ecommerce_product_text') != '' || get_theme_mod('modern_ecommerce_product_box_page') != ''){ ?>
    <section id="product-box" class="my-5">
      <div class="container">
        <div class="prod_head text-center mb-5">
          <?php if( get_theme_mod('modern_ecommerce_product_title') != '' ){ ?>
            <h3><?php echo esc_html(get_theme_mod('modern_ecommerce_product_title','')); ?></h3>
          <?php }?>
          <?php if( get_theme_mod('modern_ecommerce_product_text') != '' ){ ?>
            <p><?php echo esc_html(get_theme_mod('modern_ecommerce_product_text','')); ?></p>
          <?php }?>
        </div>
        <?php
          $mod =  get_theme_mod( 'modern_ecommerce_product_box_page' );
          if ( 'page-none-selected' != $mod ) {
            $modern_ecommerce_product_page[] = $mod;
          }
          if( !empty($modern_ecommerce_product_page) ) :
          $args = array(
            'post_type' =>array('page'),
            'post__in' => $modern_ecommerce_product_page
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
        ?>
        <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php the_content(); ?>
        <?php $s++; endwhile;
        wp_reset_postdata();?>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
      </div>
    </section>
  <?php }?>

  <section id="featured-cat" class="py-5 text-center">
    <div class="container">
      <?php if( get_theme_mod('shopkeeper_ecommerce_featured_cat_title') != '' ){ ?>
        <h2><?php echo esc_html(get_theme_mod('shopkeeper_ecommerce_featured_cat_title','')); ?></h2>
      <?php }?>
      <?php if( get_theme_mod('shopkeeper_ecommerce_featured_cat_text') != '' ){ ?>
        <p><?php echo esc_html(get_theme_mod('shopkeeper_ecommerce_featured_cat_text','')); ?></p>
      <?php }?>
      <div class="row mt-5">
        <?php $featured_cat = get_theme_mod('shopkeeper_ecommerce_featured_cat_increament');
        for ($i=1; $i <= $featured_cat; $i++) { ?>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="box mb-4">
              <?php if( get_theme_mod('shopkeeper_ecommerce_featured_cat_box_image'.$i) != '' ){ ?>
                <img src="<?php echo esc_url(get_theme_mod('shopkeeper_ecommerce_featured_cat_box_image'.$i)); ?>">
              <?php }?>
              <div class="box-content">
                <?php if( get_theme_mod('shopkeeper_ecommerce_featured_cat_box_title'.$i) != '' || get_theme_mod('shopkeeper_ecommerce_featured_cat_box_title_link'.$i) != ''){ ?>
                  <h3 class="title"><a href="<?php echo esc_url(get_theme_mod('shopkeeper_ecommerce_featured_cat_box_title_link'.$i)); ?>"><?php echo esc_html(get_theme_mod('shopkeeper_ecommerce_featured_cat_box_title'.$i)); ?></a></h3>
                <?php }?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>