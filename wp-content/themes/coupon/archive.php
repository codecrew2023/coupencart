<?php get_header(); ?>
    <div class="container" id="kt-main">
        <div class="row">
            <div class="col-md-12">
                <?php echo __('You are viewing: ','coupon'); echo coupon_archive_title(); ?>
            </div>
            <div class="col-md-8">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
                 <div <?php post_class('kt-article'); ?> id="post-<?php the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>">
                    <?php
                     
                        if(has_post_thumbnail()): 
                            the_post_thumbnail('',array('class'=>'img-responsive'));
                        endif; 
                    ?>
                    </a>
                    <h1>
                        <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h1>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo __('Read More','coupon'); ?></a>
                </div>
                <div class="kt-article-divider"></div>
            <?php endwhile; endif; ?>
            
                <div id="kt-pagination">
                <div class="alignleft">
                    <?php previous_posts_link(__( '&laquo; Newer posts', 'coupon' )); ?>
                </div>
                <div class="alignright">
                    <?php next_posts_link(__( 'Older posts &raquo;', 'coupon' )); ?>
                </div>    
                </div>
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>