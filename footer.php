<footer class="page-footer accentcolor">

    <div class="socialfooter">
        <a href="/rss" target="_blank"><i class="fa fa-rss fa-2x"></i></a>
        <a href="https://twitter.com/insideuwp" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
        <a href="https://facebook.com/insideuwp" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
        <p class="right">
          <a href="<?php echo home_url();?>/privacy-policy">privacy policy</a>
          <?php
              $getActiveTheme = wp_get_theme();
              echo $getActiveTheme->get( 'Name' ) . " v" . $getActiveTheme->get( 'Version' );
            ?>
        </p>
      </div>
    <!-- close with Wordpress footer aka adminbar etc. -->
    <?php wp_footer(); ?>
</footer>
  </body>
</html>
