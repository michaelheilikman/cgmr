<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $website ?> | Extranet - <?php echo $page ?></title>
<link rel="stylesheet" type="text/css" href="<?php if($page == "edit"){echo "../";}else{} ?>css/jquery.datetimepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php if($page == "edit"){echo "../";}else{} ?>css/admin.css?v=<?= $noCacheFile ?>" />
<link rel="stylesheet" type="text/css" href="<?php if($page == "edit"){echo "../";}else{} ?>css/simple-sidebar.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path ?>backoffice/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<!-- favicons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $path ?>img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $path ?>img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $path ?>img/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo $path ?>img/favicon/site.webmanifest">
</head>
<body id="load">

<div class="siteBg"></div>