<!DOCTYPE html>
<html xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php $rdf_namespace; ?>>

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?> 
  <title><?php print $head_title; ?></title>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="vieport" content="width=device-width, target-densitydpi=600dpi, maximum-scale-1">
  <?php print $styles; ?>
  <?php print $scripts; ?> 

  <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

</head>
<body class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
