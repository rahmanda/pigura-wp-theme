<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="description" content="Pigura adalah galeri karya artistik jurnalistik yang diwujudkan dalam bentuk ilustrasi, desain grafis dan fotografi">
	<title>
		<?php if ( is_category() ) {
			echo 'Kategori &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_tag() ) {
			echo 'Tag &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Pencarian &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo('name');
		}  elseif ( is_404() ) {
			echo 'Kesalahan 404 Tidak Ditemukan '; bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title(''); echo ' | '; bloginfo('name');
		} else {
			echo wp_title( ' | ', false, right ); bloginfo( 'name' );
		} ?>
	</title>
	<?php wp_head(); ?>
</head>
<body>
	<?php if (is_single()): ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=511256975687524&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<?php endif;?>
	<header class="nav-wrap">
		<nav>
			<span class="brand">
				<a href="<?php echo bloginfo('url'); ?>"><p>Pigura</p></a>
			</span>
			<span class="search-box box">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" accept-charset="utf-8">
					<div>
						<input type="search" name="s" class="input-search search-field" placeholder="Pencarian..." value="<?php echo get_search_query() ?>"/>
						<button type="submit" class="fa fa-search btn-search"></button>
					</div>
				</form>
			</span>
			<ul class="list-trends">
				<?php 
					$navbar = array('komik', 'fotografi', 'ilustrasi', 'infografis');
					foreach($navbar as $item) {
					?>
				<li class="<?php echo $item; ?>"><a href="<?php $url = bloginfo('url'); echo $url."/index.php/category/".$item."/"; ?>"><?php echo $item; ?></a></li>
				<?php } ?>
			</ul>
		</nav>
	</header>