<?php get_header(); ?>
     <div class="row">
       <?php if ( have_posts() ) : ?>
             <div class="main-content col s12 m12 l8">
               <div class="tag_heading center-align text-left-title-featured-sidebar accentcolor2">
               <h3><?php single_cat_title(); ?></h3>
               </div>
           <?php while ( have_posts() ) : the_post(); ?>

             <div class="card large">
                 <div class="card-image">
                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                     <?php if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail( array( 'class' => 'responsive-img' ) );
                           } else { ?>
                           <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-pic-available.jpg" alt="<?php the_title_attribute(); ?>" />
                           <?php }; ?>
                   </a>
                   <span class="card-title">
                     <p class="posttitle"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
                     </span>
                 </div>
                 <div class="card-content">
                   <p class="postdate center-align">
                     <i class="fa fa-clock-o"></i><time><?php echo get_the_date(); ?></time>
                     <i class="fa fa-user-secret"></i>  <?php the_author_posts_link();?>
                     <?php if( is_sticky() ) {
                       ?><i class="fa fa-star"></i> Featured
                   <?php  } ?>
                   </p>
                   <?php the_excerpt(); ?>
                 </div>
               </div>

               <!-- error handling -->
               <?php endwhile; else: ?>
                     <p><?php echo wpautop( 'Sorry, this category has no posts ..probably' ); ?></p>
               <?php endif; ?>

               <!-- navigation?-->

             <ul class="pagination center-align" role="pagination">
               <?php if( get_previous_posts_link() ) :

               previous_posts_link( '<li class="pagination-arrows newer-posts"><i class="fa fa-arrow-left fa-2x"></i></li>' );

               endif; ?>

               <li class="active"><?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; echo $paged; ?></li>
               <?php if( get_next_posts_link() ) :

               next_posts_link( '<li class="pagination-arrows older-posts"><i class="fa fa-arrow-right fa-2x"></i></li>' );

               endif; ?>
             </ul>
     </div>
       <!-- second column (widget bar) -->
       <div class="col s12 m12 l4 hide-on-med-and-down">
           <?php get_sidebar( 'primary' ); ?>
       </div>

  </div><!-- end row -->
</div><!-- container fluid END! -->

<!-- start of footer -->
<?php get_footer(); ?>
