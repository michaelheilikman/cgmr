<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5ZV6V8V');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="language" content="French">
    <meta http-equiv="Cache-control" content="no-store">
    <meta name="reply-to" content="<?= $replyTo ?>">
    <meta name="google-site-verification" content="<?= $googleSearchConsole ?>" /> <!--code de vérification Google Search console-->
    <meta name="publisher" content="ifip-institut du porc">
    <meta name="robots" content="index, follow">
    <meta name="distribution" content="global">
    <meta name="author" lang="fr" content="<?= $author ?>">
    <meta name="copyright" content="<?= $company ?>">
    <meta name="generator" content="html,css,php,mySQL">
    <meta name="identifier-url" content="./">
    <?php if(isset($pageTitle)): ?>
        <title><?php echo $websiteDetail ?> | <?php echo $pageTitle ?></title>
    <?php else: ?>
        <title><?php echo $websiteDetail ?> | <?php echo $page ?></title>
    <?php endif; ?>
    <link rel="stylesheet" href="<?= $path ?>css/style.css?v=<?= $noCacheFile ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $path ?>img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $path ?>img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $path ?>img/favicon/favicon-16x16.png">
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!--opengraph-->
		<?php if(isset($pageTitle)): ?>
			<meta property="og:locale" content="fr_FR" />
			<meta property="og:type" content="article" />
			<meta property="og:title" content="<?php echo $pageTitle ?>" />
			<meta property="og:url" content="<?php echo $path.''.$pageURL ?>" />
			<meta property="og:site_name" content="rmt filarmoni" />
			<meta property="article:published_time" content="<?php echo $pageDate ?>" />
			<meta property="og:description" content="<?php echo strip_tags(reduire($description, 150)) ?>"/>
			<meta property="og:image" content="<?php echo $path ?>backoffice/imgs/social/<?php echo $photo ?>.jpg" />
			<meta property="og:image:width" content="800"/>
			<meta property="og:image:height" content="414"/>
			<meta property="og:image:type" content="image/jpeg">
			<meta property="og:site_name" content="<?php echo $website ?>"/>
			<meta name="twitter:card" content="summary_large_image"/>
			<meta name="twitter:title" content="<?php echo $pageTitle ?>"/>
			<meta name="twitter:image" content="<?php echo $path ?>backoffice/imgs/social/<?php echo $photo ?>.jpg"/>
			<meta name="twitter:description" content="<?php echo strip_tags(reduire($description, 150)) ?>"/>
		<?php else: ?>
			<meta property="og:locale" content="fr_FR" />
			<meta property="og:type" content="article" />
			<meta property="og:title" content="Michael Heilikman | <?php echo $page ?>" />
			<meta property="og:url" content="<?php echo $path.''.$_SERVER['REQUEST_URI'] ?>" />
			<meta property="og:description" content="I am a Full Stack developer with a passion for web technologies and innovation, specializing in PHP, UX & UI design, and project management."/>
			<meta property="og:image" content="<?php echo $path.'img/'.$logo ?>" />
			<meta property="og:image:width" content="800"/>
			<meta property="og:image:height" content="414"/>
			<meta property="og:site_name" content="<?php echo $website ?>"/>
			<meta name="twitter:card" content="summary_large_image"/>
			<meta name="twitter:title" content="Michael Heilikman | <?php echo $page ?>"/>
			<meta name="twitter:image" content="<?php echo $path.'img/'.$logo ?>"/>
			<meta name="twitter:description" content="I am a Full Stack developer with a passion for web technologies and innovation, specializing in PHP, UX & UI design, and project management."/>
		<?php endif; ?>

</head>
<body class="bg-white text-dark">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5ZV6V8V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<?php
if(!isset($_COOKIE['verif'])): ?>
<script>
function legcook(){
	document.getElementById('legcookie');
    legcookie.style.display='none';
    document.cookie = 'verif=2; ; path=/';	
}
function refcook(){
    document.getElementById('legcookie');
    legcookie.style.display='none';
    document.cookie = 'verif=0; ; path=/';	
}
</script>
<?php endif ?>


<?php

$temps_session = 60;
$temps_actuel = date("U");

//$ip = file_get_contents("https://api.ipify.org");
if($_SERVER['HTTP_HOST'] == "localhost"){
    $ip = "176.157.134.65";
}else{
    $ip = $_SERVER['REMOTE_ADDR']; 
}
$ipAPI = file_get_contents("http://ip-api.com/json/" . $ip);
$ipdat = json_decode($ipAPI);
@$country = $ipdat->city;
@$countryCode = $ipdat->city;
@$city = $ipdat->city;
@$latitude = $ipdat->lat;
@$longitude = $ipdat->lon;
if(!empty($pageURL)){
    $pageURL;
}else{
    $pageURL = after_last('/',$_SERVER['PHP_SELF']);
}
if(isset($_SERVER['HTTP_REFERER'])){
    $referer = $_SERVER['HTTP_REFERER'];
}else{
    $referer = 'direct';
}

$sql = "SELECT * FROM visitors WHERE visitor_ip = '$ip' AND from_site = '$website'";
$query = $PDO->prepare($sql);
$query->execute();
$data = $query->rowCount();
if ($data == 0) {
    $sql2 = "INSERT INTO visitors (from_site, visitor_ip, country, countryCode, city, latitude, longitude, pageView, pageReferer) VALUES('$website', '$ip', '$country', '$countryCode', '$city', '$latitude', '$longitude', '$pageURL', '$referer')";
    $query2 = $PDO->prepare($sql2);
    $query2->execute();
}else{
    $sql4 = "INSERT INTO views (from_site, visitor_ip, country, countryCode, city, latitude, longitude, pageView, pageReferer) VALUES('$website', '$ip', '$country', '$countryCode', '$city', '$latitude', '$longitude', '$pageURL', '$referer')";
    $query4 = $PDO->prepare($sql4);
    $query4->execute();
}

$req = "SELECT * FROM online WHERE visitor_ip = '$ip' AND from_site = '$website'";
$res = $PDO->prepare($req);
$res->execute();
$online = $res->rowCount();
if ($online == 0) {
    $sql3 = "INSERT INTO online (from_site, visitor_ip, country, countryCode, city, latitude, longitude, pageView, pageReferer, time) VALUES('$website', '$ip', '$country', '$countryCode', '$city', '$latitude', '$longitude', '$pageURL', '$referer','$temps_actuel')";
    $query3 = $PDO->prepare($sql3);
    $query3->execute();

}else{
    $sql5 = "UPDATE online SET time = '$temps_actuel', pageView = '$pageURL', pageReferer = '$referer' WHERE visitor_ip = '$ip'";
    $query5 = $PDO->prepare($sql5);
    $query5->execute();
}

$session_delete_time = $temps_actuel - $temps_session ;

$sql6 = "DELETE FROM online WHERE time < $session_delete_time AND from_site = '$website'";
$query6 = $PDO->prepare($sql6);
$query6->execute();

?>