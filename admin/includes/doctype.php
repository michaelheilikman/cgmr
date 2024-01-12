<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="language" content="French">
    <meta http-equiv="Cache-control" content="no-store">
    <meta name="reply-to" content="<?= $replyTo ?>">
    <meta name="google-site-verification" content="<?= $googleSearchConsole ?>" />
    <meta name="publisher" content="<?= $company ?>">
    <meta name="robots" content="index, follow">
    <meta name="distribution" content="global">
    <meta name="author" lang="fr" content="<?= $author ?>">
    <meta name="copyright" content="<?= $company ?>">
    <meta name="identifier-url" content="./">
    <?php if(isset($pageTitle)): ?>
        <title><?php echo $websiteDetail ?> | <?php echo $pageTitle ?></title>
    <?php else: ?>
        <title><?php echo $websiteDetail ?> | <?php echo $page ?></title>
    <?php endif; ?>
    <link rel="stylesheet" href="<?= $path ?>css/admin.css?v=<?= $noCacheFile ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $path ?>img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $path ?>img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $path ?>img/favicon/favicon-16x16.png">
</head>
<body>