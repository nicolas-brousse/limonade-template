
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php if(!empty($meta)): ?>
      <?php echo $meta; ?>
    <?php endif; ?>

    <title><?php echo 'MyApp' . (isset($page_title) ? ' | ' . $page_title : ''); ?></title>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php echo url_for("/favicon.ico") ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/css/reset.css') ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/css/lib/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/css/app.css') ?>">
    <?php if(!empty($link)): ?>
      <?php echo $link; ?>
    <?php endif; ?>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">MyApp</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li<?php echo is_current_page("/") ? ' class="active"' : '' ?>><a href="<?php echo url_for("/") ?>">Home</a></li>
              <li<?php echo is_current_page("/about") ? ' class="active"' : '' ?>><a href="<?php echo url_for("/about") ?>">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <?php echo partial("layouts/_flash.html.php"); ?>

      <?php echo $content; ?>

      <hr>

      <footer>
        <p>&copy; Configured by <a href="http://opsone.net">Opsone</a> 2012</p>
      </footer>

    </div> <!-- /container -->


    <script type="text/javascript">
    //<![CDATA[
      APP_BASE_URI = '<?= url_for() ?>';
    // ]]>
    </script>
    <script type="text/javascript" src="<?php echo url_for('/js/lib/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo url_for('/js/lib/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo url_for('/js/app.js') ?>"></script>
    <?php if(!empty($javascripts)): ?>
      <?php echo $javascripts; ?>
    <?php endif; ?>

  </body>
</html>