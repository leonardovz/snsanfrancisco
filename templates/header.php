<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $systemName; ?> | Jalisco </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Cache-control" content="no-cache">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" Content="0">
  <meta name="keywords" content="<?php echo $keyWords; ?>">
  <meta name="description" content="<?php echo $descripcionServ; ?>">
  <meta name="robots" content="all">
  <meta name="author" content="WEBMASTER - Leonardo Vázquez Angulo">
  <!-- Open Graph protocol -->
  <meta property="og:title" content="Servicios y Noticias" />
  <meta property="og:site_name" content="SnSanfrancisco" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.snsanfrancisco.com" />
  <meta property="og:image" content="<?php echo $ruta; ?>/galeria/sistema/logo/5.ico" />
  <meta property="og:image:type" content="image/png" />
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />
  <meta property="og:description" content="<?php echo $keyWords; ?>" />
  <meta name="twitter:title" content="Servicios y Noticias | San Francisco de Asis  | Jalisco" />
  <meta name="twitter:image" content="<?php echo $ruta; ?>galeria/sistema/logo/5.ico" />
  <meta name="twitter:url" content="https://snsanfrancisco.com" />
  <meta name="twitter:card" content="" />

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="<?php echo $ruta; ?>recursos/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $ruta; ?>recursos/sweetalert2/sweetalert2.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/jquery-3.4.1.min.js"></script>

  <link href="<?php echo $ruta; ?>recursos/css/mdb.min.css" rel="stylesheet">
  <?php
  if (isset($acStyles) && $acStyles) {
    echo '<link href="' . $ruta . 'recursos/css/style.css" rel="stylesheet">';
  }
  if (isset($CROOPER) && $CROOPER) {
    echo '<link href="' . $ruta . 'recursos/css/addons/cropper.css" rel="stylesheet">';
    echo '<script type="text/javascript" src="' . $ruta . 'recursos/js/addons/cropper.js"></script>';
    echo '<script type="text/javascript" src="' . $ruta . 'recursos/js/addons/bootstrap.bundle.min.js"></script>';
    echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>';
  }
  if ($ANALYTICS) {
    echo '
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129896419-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag("js", new Date());

        gtag("config", "UA-129896419-1");
      </script>';
  }
   if(isset($ADSENSE) && $ADSENSE) {
    echo '<script data-ad-client="ca-pub-3411329531589521" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
  }
  if ($RECAPTCHA) {
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
  }
  ?>

  <script>
    function ruta() {
      return "<?php echo $ruta; ?>";
    }

    function rutaFILES() {
      return "<?php echo $ruta; ?>";
    }
  </script>

  <link rel="stylesheet" href="<?php echo $ruta; ?>recursos/js/addons/cropper.js">

</head>