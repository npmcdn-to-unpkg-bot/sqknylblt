<!DOCTYPE html>
<html<?php print $html_attributes ?><?php print $rdf_namespaces ?>>
<head>
  <link rel="profile" href="<?php print $grddl_profile; ?>"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <!--  <link rel="stylesheet" type="text/css" href="-->
  <? //= $theme_path ?><!--/css/full/slick.css">-->
  <?php print $styles; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php print $scripts; ?>
</head>
<body<?php print $body_attributes; ?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable">
      <?php print t('Skip to main content'); ?>
    </a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>