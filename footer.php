<footer class="page-footer accentcolor hide-on-small-only">
  <div class="socialfooter center-align">
        <a href="/rss" target="_blank"><i class="fa fa-rss fa-2x"></i></a>
        <p class="right">
            <a href="https://jadewp.demo.miboutech.com" target="_blank">powered by: Jade for Wordpress</a>
    </p>
</div>
    <!-- Compiled and minified JavaScript -->
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-2.2.4.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/materialize.min.js"></script>
    <script>
    $(document).ready(function(){
      // Activate the side menu
      // Initialize collapse button
      $('.button-collapse').sideNav({
            edge: 'right', // Choose the horizontal origin
            closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
          }
        );
    $('.slider').slider({indicators: false});

     });
    </script>
    <!-- close with Wordpress footer aka adminbar etc. -->
    <?php wp_footer(); ?>
</footer>
  </body>
</html>
