<footer class="main-footer">
	<div class="footer-wrap">
		<div class="footer-links">
			<a href="<?php echo bloginfo('url'); ?>"><span class="logo">Pigura</span></a>
			<p class="desc">Pigura adalah galeri karya jurnalistik yang diwujudkan dalam bentuk ilustrasi, desain grafis dan fotografi. Persembahan dari Koran Kampus IPB.</p>
		</div>
		<div class="footer-links">
			<h3>Info</h3>
			<ul>
				<li><a href="<?php echo get_permalink( get_page_by_title( 'Tentang Pigura' ) ); ?>">Tentang Pigura</a></li>
				<li><a href="#">FAQ</a></li>
				<li><a href="#">Kontak</a></li>
				<li><a href="#">Lisensi</a></li>
				<li><a href="#">Iklan</a></li>
			</ul>
		</div>
		<div class="footer-links">
			<h3>Media Sosial</h3>
			<ul>
				<li><a href="https://www.facebook.com/pages/Koran-Kampus-IPB/335577896522157?fref=ts" target="_blank"><i class="fa fa-facebook-square"></i>&nbsp;Facebook</a></li>
				<li><a href="https://twitter.com/korpusIPB" target="_blank"><i class="fa fa-twitter"></i>&nbsp;Twitter</a></li>
				<li><a href="https://instagram.com/korpusipb" target="_blank"><i class="fa fa-instagram"></i>&nbsp;Instagram</a></li>
			</ul>
		</div>
		<div class="footer-links">
			<h3>Populer</h3>
			<?php pigura_popular_tag(5); ?>
		</div>
	</div>
</footer>
<?php if(is_single()):?>
	<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer>
		{lang: 'id'}
	</script>
	<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
	<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
	</script>
<?php endif;?>
</body>
</html>