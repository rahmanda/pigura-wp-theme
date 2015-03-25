<?php get_header(); ?>
<div class="main-content">
	<div class="archive-title">
		<h1>Tag : <?php single_tag_title(); ?></h1>
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
<?php get_footer(); ?>