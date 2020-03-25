<!DOCTYPE html>
	
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) : ?><meta name="robots" content="noindex, nofollow" /> <?php endif; ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="540">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- ****** Facebook ****** -->
    <meta property="og:url" content="<?php echo site_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo bloginfo('name'); ?>" />

	<!-- ****** faviconit.com favicons ****** 
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-128.png" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-144x144.png" />
	<meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-70x70.png" />
	<meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-150x150.png" />
	<meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-310x150.png" />
	<meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-310x310.png" />
    -->

	<?php if (is_search()) : ?><meta name="robots" content="noindex, nofollow" /> <?php endif; ?>

	<title><?php px_custom_title(); ?></title>

	<?php wp_head(); ?>

</head>

<?php if(is_page()) { $page_slug = 'page-'.$post->post_name; } else { $page_slug = ''; } ?>
<body <?php body_class($page_slug); ?>>
    <div class="site-container">
        
    <?php $siteNotice = get_field('site_notice', 'options');	
    if ($siteNotice['enable_site_notice']) :?>
        <?php if (!empty($siteNotice['site_notice_text'])) : ?>
        <div class="site-notice">
            <div class="text">
                <?php echo $siteNotice['site_notice_text']; ?>
            </div>
            <a href="#" class="site-notice-dismiss">
                <span class="site-notice-x">
                </span>
            </a>
        </div>
        <?php endif; ?>
    <?php endif; ?>

	<header class="global-header<?php if (is_front_page()) : ?> home-header<?php endif; ?>">

	</header>
	<main> 