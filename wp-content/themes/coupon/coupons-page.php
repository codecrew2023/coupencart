<?php
/*
Template Name: Coupons Page
*/
get_header();
?>
<div class="container" id="kt-main">
        <div class="row">
            <div class="col-md-8">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                $coupon_args = array(
                'post_type'=>'ketchup-coupon',
                'paged'=>$paged);
                
                $coupon_query = new WP_Query($coupon_args);
                if($coupon_query->have_posts()): while($coupon_query->have_posts()): $coupon_query->the_post();
            ?>
                <div class="kt-coupons" id="post-<?php the_ID(); ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <?php 
                                if(has_post_thumbnail()):the_post_thumbnail('',array('class'=>'img-responsive')); endif; 
                            ?>
                        </div>
                        <div class="col-md-9">
                            <h1 class="h3"><?php the_title(); ?></h1>
                            <p>
                            <?php 
                                echo wp_kses_post(get_post_meta(get_the_ID(),'_ktc_coupon_text',true)); 
                            ?>
                            </p>
                            <div class="kt-coupon-links">
                                <a target="_blank" href="<?php echo get_post_meta(get_the_ID(),'_ktc_coupon_url',true); ?>" class="kt-coupon-url btn btn-primary pull-right"><?php echo __('Get Coupon','coupon'); ?>
                                </a>
                                <div class="kt-coupon-code btn btn-primary pull-right"><?php echo get_post_meta(get_the_ID(),'_ktc_coupon_code',true); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
            <div id="kt-pagination">
                <div class="alignleft">
                    <?php previous_posts_link(__( '&laquo; Newer posts', 'coupon' ),$coupon_query->max_num_pages); ?>
                </div>
                <div class="alignright">
                    <?php next_posts_link(__( 'Older posts &raquo;', 'coupon' ),$coupon_query->max_num_pages); ?>
                </div>    
                </div>    
            </div>
            <div class="col-md-4">
               <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer();?>