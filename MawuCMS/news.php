<?php require_once("inc/core.god.php");

if(maintenance == '1' && $myrow['rank'] < $Holo['minrank']) 
{
    header("Location: maintenance");
	exit;
}

if(isset($_GET['url'])) 
{ 
    if(!empty($_GET['url']))
    { 
        $id_noticia = (int) filtro($_GET['url']); 
        $query_noticias = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE id = '".$id_noticia."' LIMIT 1");
        if(mysqli_num_rows($query_noticias) > 0)
        { 
            $columna = mysqli_fetch_assoc($query_noticias);
			$user_n = mysqli_fetch_assoc(mysqli_query(connect::cxn_mysqli(),"SELECT id,username,look FROM users WHERE username = '". $columna['author'] ."'"));
			$noticia  = ''.$columna['id'].'';
			$noticia2 = ''.$columna['image'].'';
			$noticia3 = ''.$columna['title'].'';
			$noticia4 = ''.$columna['shortstory'].'';
			$noticia5 = ''.$columna['longstory'].'';
			$noticia6 = ''.$columna['author'].'';
			$noticia7 = ''.$columna['date'].'';
			
		} 
        else 
        { 
            header("Location: /articles");
            exit;
        } 
    } 
    else 
    { 
        header("Location: /articles");
        exit;
    } 
} 
else
{ 
        header("Location: /articles");
        exit;  
}

if(isset($_POST['resultado']))
{ 
	$urlresultado = filtrolow($_POST['urlresultado']);
    if(!empty($urlresultado))
    { 
        $checkspam = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news_form WHERE user_id = '". $myrow['id'] ."' AND newsid = '". $noticia ."'");
		
		if(mysqli_num_rows($checkspam) >= 1)
		{
			$aok = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertform3']."</div>";
		} 
		else 
		{
        $query_AddForm = mysqli_query(connect::cxn_mysqli(),"INSERT INTO cms_news_form SET newsid = '". $noticia ."', user_id = '". $myrow['id'] ."', urlresultado = '". $urlresultado ."', date = '". time() . "'");
  
        if($query_AddForm) 
        { 
            $aok = "<div class='alert alert-success' role='alert'>".$Lang['news.alertform1']."</div>";
        } 
        else 
        { 
            $aok = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertc2']."</div>";

        } 
		}
    } 
    else 
    { 
        $aok = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertform2']."</div>";
    }	
}
?>
<!DOCTYPE html>
<?php if(Loged == FALSE) { ?>
<script>
    var themed = new Date();
    var themeh = themed.getHours();

    if(themeh > <?php echo $Holo['in_auto_dark']; ?> || themeh < <?php echo $Holo['en_auto_dark']; ?>){
        document.write('<html lang="<?php echo $Holo['htmllang']; ?>" data-theme="dark">');
    } else {
		document.write('<html lang="<?php echo $Holo['htmllang']; ?>" data-theme="light">');
	};
</script>
<?php } ?>
<?php if(Loged == TRUE) { ?>
<html lang="<?php echo $Holo['htmllang']; ?>" data-theme="<?php echo $myrow['theme']; ?>">
<?php } ?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $Holo['name']; ?>: <?php echo $noticia3; ?></title>

<link rel='dns-prefetch' href='//code.jquery.com' />
<link rel='dns-prefetch' href='//cdn.jsdelivr.net' />
<link rel='dns-prefetch' href='//use.fontawesome.com' />
<link rel='dns-prefetch' href='//s.w.org' />

<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>

<link rel='stylesheet' id='wp-block-library-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/style.min.css?ver=5.3.2' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/bootstrap.min.css?ver=4.4.1' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href='https://use.fontawesome.com/releases/v5.12.1/css/all.css?ver=5.12.1' type='text/css' media='all' />
<link rel='stylesheet' id='swiper-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/swiper.min.css?ver=5.3.1' type='text/css' media='all' />
<link rel='stylesheet' id='selectize-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/selectize.css?ver=0.12.6' type='text/css' media='all' />
<link rel='stylesheet' id='style-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/style.css?ver=1.1' type='text/css' media='all' />
<link rel='stylesheet' id='theme-styles-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/style.css?ver=5.3.2' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery.js?ver=1.12.4-wp'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/simple-likes-public.js?ver=0.5'></script>

<link rel="icon" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-32x32.png" sizes="32x32" />
<link rel="icon" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-180x180.png" />
<meta name="msapplication-TileImage" content="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-270x270.png" />

<script>
function goBack() {
  window.history.back();
}
</script>

</head>

<body class="home page-template-default" onselectstart='return false' ondragstart='return false'>

<?php if(Loged == TRUE) { ?>
	<nav class="navbar fixed-top navbar-expand-lg navbar-light">
	<a class="navbar-brand" style="cursor:default"><?php echo $Holo['name']; ?> Hotel<span class="tag"><?php echo $Lang['logo.tag']; ?></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul id="menu-principal" class="navbar-nav mr-auto">
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/me" class="nav-link"><?php echo $Lang['menu.index']; ?></a>
			</li>
			<li style="cursor:cell" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbar-dropdown-menu-link-59" aria-haspopup="true" aria-expanded="false"><?php echo $Lang['menu.comunidade']; ?></a>
				    <div class="sub-menu dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-menu-link-59">
						<a href="/team" class="dropdown-item"><?php echo $Lang['menu.team']; ?></a>
						<a href="/gallery" class="dropdown-item"><?php echo $Lang['menu.gallery']; ?></a>
						<a href="/famous" class="dropdown-item"><?php echo $Lang['menu.famous']; ?></a>
				    </div>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item active">
				<a href="/articles" class="nav-link active"><?php echo $Lang['menu.articles']; ?></a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/shop" class="nav-link"><font color="dark orange"><?php echo $Lang['menu.shop']; ?></font></a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/support" class="nav-link"><?php echo $Lang['menu.support']; ?></a>
			</li>
		</ul>
		
		<div class="d-flex justify-content-center align-items-center ml-auto mt-3 mt-lg-0">
		<a onclick="goBack()" class="btn btn-danger"><font color="white"><?php echo $Lang['menu.back']; ?></font></a><span style="cursor:default">    </span>
		<?php $isadmin = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM users WHERE id = '".$myrow['id']."' AND rank >= ".$Holo['minhkr']."");
        while($isadm = mysqli_fetch_assoc($isadmin)){ ?><a href="<?php echo $Holo['url'] . '/' . $Holo['panel']; ?>" target="_blank" class="btn btn-warning"><font color="white"><center><i class="fas fa-cogs"></i></center></font></a><span style="cursor:default">    </span><?php } ?>
		<?php if(maintenance == '0') { ?><a href="<?php echo $Holo['client_url']; ?>v2" class="btn btn-primary"><?php echo $Lang['menu.hotelv2']; ?></a><span style="cursor:default">    </span><a href="<?php echo $Holo['client_url']; ?>" class="btn btn-success"><?php echo $Lang['menu.hotel']; ?></a><span style="cursor:default">    </span><?php } ?>
		
			<div class="dropdown" style="cursor:cell">
			
				<div id="dropUser" class="d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="avatar pixel">
						<img src="<?php echo $Holo['avatar'] . $myrow['look']; ?> &amp;action=std&amp;direction=3&amp;head_direction=3&amp;img_format=png&amp;gesture=std&amp;headonly=0&amp;size=s" alt="<?php echo $myrow['username']; ?>">
						</div>
				</div>
					
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
						<a class="dropdown-item" href="/home/<?php echo $myrow['username']; ?>"><i class="fas fa-user text-muted mr-2"></i><?php echo $Lang['menu.myprofile']; ?></a>
						<a class="dropdown-item" href="/account/prefer"><i class="fas fa-cog text-muted mr-2"></i> <?php echo $Lang['menu.settings']; ?></a>
						<a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt text-muted mr-2"></i> <?php echo $Lang['menu.logout']; ?></a>
					</div>
			</div>
		</div>
	</div>
	</nav>
<?php } ?>
<?php if(Loged == FALSE) { ?>
	<nav class="navbar fixed-top navbar-expand-lg navbar-light">
		<a class="navbar-brand" style="cursor:default"><?php echo $Holo['name']; ?> Hotel<span class="tag"><?php echo $Lang['logo.tag']; ?></span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			
<ul id="menu-principal" class="navbar-nav mr-auto">
	<li class="menu-item menu-item-type-post_type menu-item-home current-menu-item page_item nav-item">
		<a href="/index" class="nav-link"><?php echo $Lang['menu.index']; ?></a>
	</li>
	<li class="menu-item menu-item-type-post_type_archive nav-item">
		<a href="/login" class="nav-link"><?php echo $Lang['menu.login']; ?></a>
	</li>
	<li class="menu-item menu-item-type-post_type_archive nav-item">
		<a href="/register" class="nav-link"><?php echo $Lang['menu.register']; ?></a>
	</li>
	<li class="menu-item menu-item-type-post_type menu-item-home current-menu-item page_item nav-item active">
		<a href="/articles" class="nav-link active"><?php echo $Lang['menu.articles']; ?></a>
	</li>
	<li class="menu-item menu-item-type-post_type_archive nav-item">
		<a href="/support" class="nav-link"><?php echo $Lang['menu.support']; ?></a>
	</li>
</ul>

<div class="d-flex justify-content-center align-items-center ml-auto mt-3 mt-lg-0">
		<a onclick="goBack()" class="btn btn-danger"><font color="white"><?php echo $Lang['menu.back']; ?></font></a><span style="cursor:default">    </span>
		<a href="/register" class="btn btn-success"><?php echo $Lang['menu.register']; ?></a><span style="cursor:default">    </span>
		<a href="/login" class="btn btn-primary"><?php echo $Lang['menu.loginbutton']; ?></a>
</div>

		</div>
	</nav>
<?php } ?>

	<main>

<div style="cursor:default" class="jumbotron jumbotron-fluid news cover">
					<img src="<?php echo $noticia2; ?>" class="full">
		
		<div class="container text-center">

		<ul class="post-categories">
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'gratis' AND id = '".$noticia."'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
		    <li><a href="/articles/gratis" rel="category tag"><?php echo $Lang['news.cat2']; ?></a></li>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'hotel' AND id = '".$noticia."'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
		    <li><a href="/articles/hotel" rel="category tag"><?php echo $Lang['news.cat4']; ?></a></li>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'mobis' AND id = '".$noticia."'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
		    <li><a href="/articles/mobis" rel="category tag"><?php echo $Lang['news.cat3']; ?></a></li>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'promocao' AND id = '".$noticia."'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
		    <li><a href="/articles/promocao" rel="category tag"><?php echo $Lang['news.cat1']; ?></a></li>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'sistema' AND id = '".$noticia."'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
		    <li><a href="/articles/sistema" rel="category tag"><?php echo $Lang['news.cat5']; ?></a></li>
<?php } ?>
		</ul>

			<h1 style="cursor:default"><?php echo filtro($noticia3); ?></h1>
			<p style="cursor:default"><small><?php echo filtro($noticia4); ?></small></p>

			<div class="infos">
				<div class="mx-3 mt-3">
				<?php if(Loged == TRUE) { ?>
					<a href="/home/<?php echo $user_n['username']; ?>" class="d-flex align-items-center">
						<div class="avatar pixel sm mr-2">
							<img src="<?php echo $Holo['avatar'] . $user_n['look']; ?>&amp;action=std&amp;direction=2&amp;head_direction=2&amp;img_format=png&amp;gesture=std&amp;headonly=0&amp;size=s" alt="">
						</div>

						<span data-toggle="tooltip" title="" data-original-title="<?php echo $user_n['username']; ?>"><?php echo $user_n['username']; ?></span>
					</a>
				<?php } ?>
				<?php if(Loged == FALSE) { ?>
					<a style="cursor:default" class="d-flex align-items-center">
						<div class="avatar pixel sm mr-2">
							<img src="<?php echo $Holo['avatar'] . $user_n['look']; ?>&amp;action=std&amp;direction=2&amp;head_direction=2&amp;img_format=png&amp;gesture=std&amp;headonly=0&amp;size=s" alt="">
						</div>

						<span data-toggle="tooltip" title="" data-original-title="<?php echo $user_n['username']; ?>"><?php echo $user_n['username']; ?></span>
					</a>
				<?php } ?>
				</div>

				<div class="mx-3 mt-3" style="cursor:default"><i class="fas fa-calendar mr-2"></i> <?php echo GetLast($noticia7); ?></div>

			</div>
			
		</div>
	</div>

<section>
			<div class="container">
			
<?php if(maintenance == '1') { ?>
	<div class="alert alert-danger" role="alert"><div id="p141"></div><br><center><?php echo $Lang['maintenance.text1']; ?> <b><?php echo $main['motivo']; ?></b>.<br><?php echo $Lang['maintenance.text2']; ?></center><br></div>
<?php } ?>
			
				<div class="reading-content">
					<div style="cursor:default" class="article-text">
						<p><small><?php echo $noticia5; ?></small></p>
<?php if(Loged == TRUE) { ?>
						<?php if($columna['active_form'] == "1") { ?>
						<p><small><hr class="my-4">
							<?php if($aok !== NULL) { echo $aok; } ?>
								<form id="loginform" method="POST">
									<p class="login-username">
										<input type="text" id="urlresultado" name="urlresultado" MAXLENGTH="280" placeholder="<?php echo $Lang['news.formfor']; ?> <?php echo $noticia3; ?>" class="input" size="20" required>
									</p>
									<p class="login-submit">
										<input type="submit" name="resultado" class="button button-primary" value="<?php echo $Lang['news.formsend']; ?>">
									</p>
								</form>
						</small></p>
						<?php } ?>
<?php } ?>
<?php if(Loged == FALSE) { ?>
						<?php if($columna['active_form'] == "1") { ?>
						<p><small><hr class="my-4"><div style="cursor:default" class="card">
								<div class="card-body text-center text-muted">
									<strong><?php echo $Lang['news.alertlogin2']; ?></strong>
								</div>
							</div>
						</small></p>
						<?php } ?>
<?php } ?>
					</div>
					
					<div class="d-flex align-items-center mt-4">
					<div class="tags">
						<i class="fas fa-tag"></i>
						<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'gratis' AND id = '".$noticia."'");
						while($newscategory = mysqli_fetch_array($newscategorys)){	
						?>
						    <a href="/articles/gratis" rel="category tag"><?php echo $Lang['news.cat2']; ?></a>
						<?php } ?>
						<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'hotel' AND id = '".$noticia."'");
						while($newscategory = mysqli_fetch_array($newscategorys)){	
						?>
						    <a href="/articles/hotel" rel="category tag"><?php echo $Lang['news.cat4']; ?></a>
						<?php } ?>
						<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'mobis' AND id = '".$noticia."'");
						while($newscategory = mysqli_fetch_array($newscategorys)){	
						?>
						    <a href="/articles/mobis" rel="category tag"><?php echo $Lang['news.cat3']; ?></a>
						<?php } ?>
						<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'promocao' AND id = '".$noticia."'");
						while($newscategory = mysqli_fetch_array($newscategorys)){	
						?>
						    <a href="/articles/promocao" rel="category tag"><?php echo $Lang['news.cat1']; ?></a>
						<?php } ?>
						<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'sistema' AND id = '".$noticia."'");
						while($newscategory = mysqli_fetch_array($newscategorys)){	
						?>
						    <a href="/articles/sistema" rel="category tag"><?php echo $Lang['news.cat5']; ?></a>
						<?php } ?>
					</div>
					</div>
				</div>
				
			<div class="reading-content size-b my-4">
<div class="swiper-container related swiper-container-initialized swiper-container-horizontal"><div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
	
	<?php $news = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE author = '".$noticia6."' ORDER BY rand() DESC LIMIT 6");
	while($new = mysqli_fetch_array($news)){
	
	$authorinfo = mysqli_fetch_assoc($authorinfo = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM users WHERE username = '".$new['author']."'"));	
	?>
	<div class="swiper-slide swiper-slide-next" style="width: 232.667px;">
		<div class="card news post-<?php echo $new['id']; ?>">
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'gratis' AND id = '".$new['id']."' AND livenews = '0'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>">
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat2']; ?>"><?php echo $Lang['news.cat2']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'hotel' AND id = '".$new['id']."' AND livenews = '0'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>">
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Holo['name']; ?> Hotel"><?php echo $Holo['name']; ?> Hotel</div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'mobis' AND id = '".$new['id']."' AND livenews = '0'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>">
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat3']; ?>"><?php echo $Lang['news.cat3']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'promocao' AND id = '".$new['id']."' AND livenews = '0'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>">
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat1']; ?>"><?php echo $Lang['news.cat1']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'sistema' AND id = '".$new['id']."' AND livenews = '0'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>">
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat5']; ?>"><?php echo $Lang['news.cat5']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'gratis' AND id = '".$new['id']."' AND livenews = '1'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>"><div class="live"><?php echo $Lang['news.cat6']; ?></div>
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat2']; ?>"><?php echo $Lang['news.cat2']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'hotel' AND id = '".$new['id']."' AND livenews = '1'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>"><div class="live"><?php echo $Lang['news.cat6']; ?></div>
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Holo['name']; ?> Hotel"><?php echo $Holo['name']; ?> Hotel</div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'mobis' AND id = '".$new['id']."' AND livenews = '1'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>"><div class="live"><?php echo $Lang['news.cat6']; ?></div>
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat3']; ?>"><?php echo $Lang['news.cat3']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'promocao' AND id = '".$new['id']."' AND livenews = '1'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>"><div class="live"><?php echo $Lang['news.cat6']; ?></div>
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat1']; ?>"><?php echo $Lang['news.cat1']; ?></div></a>
<?php } ?>
<?php $newscategorys = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE category = 'sistema' AND id = '".$new['id']."' AND livenews = '1'");
while($newscategory = mysqli_fetch_array($newscategorys)){	
?>
	<a href="/news/<?php echo $new['id']; ?>" class="cover"><img src="<?php echo $new['image']; ?>"><div class="live"><?php echo $Lang['news.cat6']; ?></div>
	<div class="cat <?php echo $new['category']; ?>" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo $Lang['news.cat5']; ?>"><?php echo $Lang['news.cat5']; ?></div></a>
<?php } ?>
	<div class="card-body">
<?php $newsbadges = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news WHERE active_badge = '1' AND id = '".$new['id']."'");
while($newsbadge = mysqli_fetch_array($newsbadges)){	
?>
		<div class="box" data-toggle="tooltip" title="" data-original-title="<?php echo $Lang['news.winbadge']; ?>"><img src="<?php echo $Holo['url_badges']; ?><?php echo $newsbadge['badge']; ?>.gif"></div>
<?php } ?>
				<h5 class="card-title mb-4"><a href="/news/<?php echo $new['id']; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo filtro($new['title']); ?>"><?php echo filtro(mb_strimwidth($new['title'], 0, 24, "...")); ?></a></h5>
		<div class="card-text">
			<div class="avatar pixel sm mr-2">
				<img src="<?php echo $Holo['avatar'] . $authorinfo['look']; ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $new['author']; ?>">
			</div>
<?php if(Loged == TRUE) { ?>
<a href="/home/<?php echo $new['author']; ?>" data-toggle="tooltip" title="<?php echo $new['author']; ?>"><?php echo $new['author']; ?></a> 
<?php } ?>
<?php if(Loged == FALSE) { ?>
<a style="cursor:default" data-toggle="tooltip" title="<?php echo $new['author']; ?>"><?php echo $new['author']; ?></a> 
<?php } ?>
			<span style="cursor:default" class="ml-auto text-muted" style="cursor:default"><i class="fas fa-calendar-alt ml-3 mr-1"></i> <?php echo GetLast($new['date']); ?></span>			
		</div>
	</div>
		</div>
	</div>
	<?php } ?>
	
		</div><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

			</div>

<?PHP if($columna['active_comment'] == "1") { ?>
<div style="cursor:default" class="reading-content">
					
	<hr>
	
	<div class="mb-3"><h5 id="comments"><b><?php echo mysqli_num_rows(mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news_comment WHERE newsid = '".$id_noticia."'")) ?></b> <?php echo $Lang['news.comments']; ?></h5></div>

	<ul class="commentlist">

<?php
$comments = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news_comment WHERE newsid = '".$id_noticia."' ORDER BY id DESC LIMIT 45");
while($comment = mysqli_fetch_array($comments)){
$commentinfo = mysqli_fetch_assoc($commentinfo = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM users WHERE username = '".$comment['author']."'"));
?>
	<li class="comment byuser comment-author-<?php echo $comment['author']; ?> bypostauthor even thread-even depth-1 parent" id="comment-<?php echo $comment['id']; ?>">
				<div id="div-comment-<?php echo $comment['id']; ?>" class="comment-body">
					<div class="comment-author">
				<a href="/home/<?php echo $comment['author']; ?>">
					<div class="avatar pixel mx-auto" data-toggle="tooltip" title="<?php echo $last['username']; ?>">
						<a href="/home/<?php echo $comment['author']; ?>"><img src="<?php echo $Holo['avatar'] . $commentinfo['look']; ?>&action=std&direction=2&head_direction=3&img_format=png&gesture=std&headonly=0&size=s" alt="<?php echo $comment['author']; ?>"></a>
					</div>
				</a>
					</div>
			<div class="comment-details">
				<div class="comment-meta commentmetadata">
					<div class="author" data-toggle="tooltip" title="" data-original-title="<?php echo $comment['author']; ?>"><a href="/home/<?php echo $comment['author']; ?>"><?php echo $comment['author']; ?></a></div>
				</div>
				<div class="comment-text"><p><?php echo filtronosql($comment['commentaire']); ?></p></div>
				<div class="reply"><a class="time"><?php echo GetLast($comment['thedate']); ?></a></div>
			</div>
				</div>
	</li>
<?php } ?>
	
	</ul>

<?php if(Loged == TRUE) { ?>
	<div id="respond" class="comment-respond">
		<h5 id="reply-title" class="comment-reply-title"><?php echo $Lang['news.makecomment']; ?>:</h5>
		
<?php 
if(isset($_POST['addcomment']))
{ 
    $commentaire = filtrolow($_POST['Commentaire']);
	if(isset($_POST['jeton']) && ($_POST['jeton'] == $_SESSION['jeton'])) {
    if(!empty($commentaire))
    { 
        $checkspam = mysqli_query(connect::cxn_mysqli(),"SELECT * FROM cms_news_comment WHERE author = '". $myrow['username'] ."' AND newsid = '".$id_noticia."'");
		
		if(mysqli_num_rows($checkspam) >= 1)
		{
			$commentmsg = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertc6']."</div>";
		} 
		else 
		{
        $query_AddComment = mysqli_query(connect::cxn_mysqli(),"INSERT INTO cms_news_comment SET newsid = '".$id_noticia."', author = '". $myrow['username'] ."' , commentaire = '".$commentaire."', thedate = '". time() . "'");
  
        if($query_AddComment) 
        { 
            $commentmsg = "<div class='alert alert-success' role='alert'>".$Lang['news.alertc1']."</div>";
        } 
        else 
        { 
            $commentmsg = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertc2']."</div>";

        } 
		}
    } 
    else 
    { 
        $commentmsg = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertc3']."</div>";
    }	
} else {
	$commentmsg = "<div class='alert alert-danger' role='alert'>".$Lang['news.alertc4']."</div>";
}
} 

?>

<?php if($commentmsg !== NULL) { echo $commentmsg; } else { echo "<div class='alert alert-warning' role='alert'>".$Lang['news.alertc5']."</div>"; } ?>
					<form action="" id="addcomment" method="post">
						<div class="form-group form-username">
							<input class="form-control" type="text" name="Commentaire" MAXLENGTH="280" placeholder="<?php echo $Lang['news.makecomment']; ?>..." required>
						</div>
                            <input type="hidden" name="jeton" value="<?php echo $_SESSION['jeton']; ?>"> 
						<p class="form-submit">
							<input type="submit" name="addcomment" class="btn btn-primary" value="<?php echo $Lang['news.confirm']; ?>">
						</p>
					</form>

	</div>
<?php } ?>
	
				</div>
<?php } else { ?>
<?php if(Loged == TRUE) { ?>
	<div style="cursor:default" class="card">
		<div class="card-body text-center text-muted">
			<strong><?php echo $Lang['news.alertcant']; ?></strong>
		</div>
	</div>
<?php } ?>

<?php } ?>

<?php if(Loged == FALSE) { ?>
		<br>
	<div style="cursor:default" class="card">
		<div class="card-body text-center text-muted">
			<strong><?php echo $Lang['news.alertlogin']; ?></strong>
		</div>
	</div>
<?php } ?>

			</div>
		</section>

	</main>
	
	<?php require_once("Mawu/includes/footer.php"); ?>
	
<script type='text/javascript' src='https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1'></script>
<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.3.min.js?ver=3.4.1'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js?ver=1.16.0'></script>

<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery.cookie.js?ver=1.4.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/bootstrap.min.js?ver=4.4.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/swiper.min.js?ver=5.3.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/selectize.min.js?ver=0.12.6'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/moment.min.js?ver=2.22.2'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery.page.js?ver=0.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/main.js?ver=1.0'></script>
		
</body>
</html>