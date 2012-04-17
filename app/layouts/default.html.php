<!DOCTYPE HTML>
<html class="no-js" lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
    <?php if(!empty($meta)): ?>
      <?php echo $meta; ?>
    <?php endif; ?>

    <title><?php echo 'MyApp' . (isset($page_title) ? ' | ' . $page_title : ''); ?></title>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/css/reset.css') ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/css/app.css') ?>">
    <?php if(!empty($link)): ?>
      <?php echo $link; ?>
    <?php endif; ?>
</head>
<body>
  <header>
    <h1>MyApp</h1>
  </header> <!-- #header -->

  <div id="container">
    <?php foreach (flash_now() as $type=>$flashes) : ?>
      <div class="alert alert-<?= $type ?>">
        <ul>
        <?php foreach ($flashes as $flash) : ?>
          <li><?= $flash ?></li>
        <?php endforeach ?>
        </ul>
      </div>
    <?php endforeach ?>

    <?php echo $content; ?>
  </div> <!-- #container -->

  <!--
    $javascripts contains the content_for('javascripts') captured content.
  -->
  <script type="text/javascript">
  //<![CDATA[
    APP_BASE_URI = '<?= url_for() ?>';
  // ]]>
  </script>
  <script type="text/javascript" src="<?php echo url_for('/js/lib/jquery.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo url_for('/js/app.js') ?>"></script>
  <?php if(!empty($javascripts)): ?>
    <?php echo $javascripts; ?>
  <?php endif; ?>

  <div id="spinner" style="display: none;"></div>
</body>
</html>
