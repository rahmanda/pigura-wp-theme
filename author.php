<?php get_header(); ?>
<div class="main-content profile-page">
	<div class="profile">
		<div class="bio">
			<div class="avatar">
				<?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
			</div>
			<div class="name">
				<h1><?php the_author();?></h1>
			</div>
			<div class="prof">
				<p><?php echo get_the_author_meta('profession'); ?></p>
			</div>
			<div class="desc">
				<p><?php echo get_the_author_meta('description'); ?></p>
			</div>
			<div class="web">
				<a href="<?php echo get_the_author_meta('user_url'); ?>"><?php echo get_the_author_meta('user_url'); ?></a>
			</div>
			<div class="social">
				<ul>
					<?php
					$facebook = get_the_author_meta('facebook');
					if($facebook): ?>
					<li class="facebook"><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
					<?php 
					endif; ?>
					<?php
					$twitter = get_the_author_meta('twitter');
					if($twitter): ?>
					<li class="twitter"><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li>
					<?php 
					endif; ?>
					<?php
					$google = get_the_author_meta('google');
					if($google): ?>
					<li class="google"><a href="<?php echo $google; ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php 
					endif; ?>
					<?php
					$dribble = get_the_author_meta('dribble');
					if($dribble): ?>
					<li class="dribble"><a href="<?php echo $dribble; ?>"><i class="fa fa-dribble"></i></a></li>
					<?php 
					endif; ?>
					<?php
					$behance = get_the_author_meta('behance');
					if($behance): ?>
					<li class="behance"><a href="<?php echo $behance; ?>"><i class="fa fa-behance"></i></a></li>
					<?php 
					endif; ?>
					<?php
					$instagram = get_the_author_meta('instagram');
					if($instagram): ?>
					<li class="instagram"><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a></li>
					<?php 
					endif; ?>
					<?php
					$linkedin = get_the_author_meta('linkedin');
					if($linkedin): ?>
					<li class="linkedin"><a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a></li>
					<?php 
					endif; ?>
				</ul>
			</div>
		</div>
		<div class="gallery-title">
			<h2>Pigura-pigura</h2>
		</div>
		<?php
		if(have_posts()): ?>
		<div class="piguras">
			<?php
			while(have_posts()) : the_post(); ?>
			<div class="pigura">
				<span class="pigura-thumb">
					<a href="<?php the_permalink(); ?>">
						<!-- get the cover / second feature image -->
						<?php 
						if( class_exists('Dynamic_Featured_Image') ) {
							global $dynamic_featured_image;
							$featured_images = $dynamic_featured_image->get_featured_images();
							if (count($featured_images) > 0) {
							?> 
								<img src="<?php echo $featured_images[0]['thumb']; ?>" />
						<?php 
							} else {
								the_post_thumbnail('thumb');
							} } else {
								the_post_thumbnail('thumb');
							}
						?>
					</a>
				</span>
				<span class="pigura-info">
					<span class="pigura-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<span class="pigura-author">
						oleh <a class="name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
					</span>
					<span class="pigura-tags">
						<?php the_tags('',', '); ?>
					</span>
				</span>
				<span class="pigura-stats">
					<span class="loves"><i class="fa fa-heart"></i>&nbsp;<?php $loves_count = get_post_meta(get_the_ID(), "votes_count", true); if($loves_count): echo $loves_count; else: echo 0; endif; ?></span>
				<span class="comments"><i class="fa fa-comment"></i>&nbsp;<?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments; ?></span>
				</span>
			</div>
			<?php
			endwhile;
			?>
		</div>
		<div class="page-control">
			<div class="control-group">
				<?php 
				previous_posts_link('<i class="fa fa-chevron-circle-left"></i>');
				next_posts_link('<i class="fa fa-chevron-circle-right"></i>'); ?>
			</div>
		</div>
		<?php
		else :
			echo '<p>No content found.</p>';

		endif;
		?>
	</div>
</div>
<?php get_footer(); ?>