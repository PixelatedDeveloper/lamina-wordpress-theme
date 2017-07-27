

<section class="author-profile">
<p class="postedby"><?php _e('This article was wrtten by', 'canitia'); ?></p>
<?php 
    if ( get_the_author_meta( 'description' ) ) {
    echo get_avatar( get_the_author_meta('email'), '100' ); 
?>
    <strong class="author-name"><?php the_author_posts_link();?></strong>
        <p class="author-bio">
        <br />
        <?php echo nl2br(get_the_author_meta('description'));  ?>
        </p>
 <?php  } /* end author meta */
    else {
      echo get_avatar( get_the_author_meta('email'), '50' );       
    }

?>
</section>
