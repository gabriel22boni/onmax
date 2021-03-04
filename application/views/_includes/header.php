<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
   /* if ($_SERVER['HTTPS'] == 'on') {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $url, true, 301);
        exit();
    }*/
?>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="content-language" content="pt-br" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="<?php echo ($this->header_title); ?>">
	<meta name="url" content="www.onmax.com.br">
	<meta name="description" content="<?php echo ($this->header_description); ?>">
	<meta name="keywords" content="modelo, casting, agência de modelo infantil,agência de modelos infantis,agência para modelo infantil,agência de modelos,melhor agência de modelo infantis,agência maxfama,modelo infantil">
	<meta name="copyright" content="Copyright © <?php echo date('Y');?>, Todos os direitos reservados">
	<meta name="charset" content="utf-8">
	<meta name="Distribution" content="Global">
	<meta name="Rating" content="General">
	<meta name="audience" content="General">
	<meta name="autor" content="Orange Media Design">
	<meta name="company" content="On Max Fama">
	<meta name="revisit-after" content="7 Days">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="robots" content="index,follow" />	

	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon-32x32.png" sizes="32x32" />

	<meta name="twitter:card" content="summary">

	<meta property="og:title" content="<?php echo ($this->header_title); ?>" />
	    <meta property="og:image" content="<?php echo base_url(); ?>_img/og_image.jpg" />
	    <meta property="og:image:type" content="image/jpeg">
		<meta property="og:image:width" content="1200">
		<meta property="og:image:height" content="630">
		<meta property="og:url" content="<?php echo base_url(); ?>">
		<meta property="og:description" content="<?php echo ($this->header_description); ?>">
	    <meta name="twitter:title" content="<?php echo ($this->header_title); ?>" />
	    <meta name="twitter:url" content="<?php echo base_url(); ?>">
	    <meta name="twitter:description" content="<?php echo ($this->header_description); ?>" />
	    <meta name="twitter:image" content="<?php echo base_url(); ?>_img/og_image.jpg">


	<meta property="og:type" content="website">
	<meta property="og:locale" content="pt_BR" />
	<meta name="twitter:domain" content="<?php echo base_url(); ?>">

	<title><?=$this->header_title?></title>		

	<link rel="stylesheet" href="<?php echo base_url();?>_css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>_css/onmax.css?cache=<?php echo time(); ?>" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>_css/nivo-slider.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>_css/slicknav.css" type="text/css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_css/jquery.fancybox.css?v=2.1.4" media="screen" />	
	<script type="text/javascript" src="<?php echo base_url();?>_js/modernizr.custom.js"></script>

	<!-- Dados Estruturados Google -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Corporation",
      "name": "OnMax",
      "url": "http://www.onmax.com.br",
      "logo": "http://www.onmax.com.br/_img/logo_onmaxfama-de.png",
      "sameAs": [
        "https://www.facebook.com/maxfama",
        "https://www.instagram.com/maxfama_oficial",
        "https://www.youtube.com/user/maxfama"
      ]
    },
    "datePublished": "2020-12-06",
    "description": "A Max Fama é uma agencia de modelo infantil de São Paulo - SP que atua no mercado da moda desde 2002 e está entre as melhores agências de modelos infantis do Brasil."

    </script>
	
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-171262593-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	
	<!-- Global site tag (gtag.js) - Google Ads: 1034450340 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-1034450340"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'AW-1034450340');
	</script>	

</head>
<body>