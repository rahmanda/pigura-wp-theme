<?php get_header(); ?>
<div class="main-content">
	<?php
	if(have_posts()): ?>
	<?php
	while(have_posts()) : the_post(); ?>
	<div class="page">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="page-content">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
	endwhile;
	?>
	<?php
	else :
		echo '<p>No content found.</p>';

	endif;
	?>
</div>
<?php get_footer(); ?>