<?php get_header(); ?>
    <div class="container" id="kt-main">
        <div class="row">
            <div class="col-md-8">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
                <!-- Main Blog Post -->
                <div <?php post_class('kt-article'); ?> id="post-<?php the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>">
                    <?php
                        if(has_post_thumbnail()): 
                            the_post_thumbnail('',array('class'=>'img-responsive'));
                        endif; 
                    ?>
                    </a>
                    <!-- Blog Post Title -->
                    <h1>
                        <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h1>
                    <?php the_content(); ?>
                </div>
                <!-- Blog Post tags -->
                <?php if(has_tag()):?>
                <div class="kt-article-tags">         
                <?php
                echo get_the_tag_list('<i class="icon_tag_alt">  </i> '.__('Tags:','coupon').', ',',');
                ?>
                </div>
                <?php endif; ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'coupon' ) . '</span>', 'after' => '</div>' ) ); ?>
                <div class="kt-article-divider"></div>
                <!-- Blog Post Comments -->
                <div class="col-md-12">
                    <div id="kt-comments">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
            </div>
            <!-- Sidebar -->
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>