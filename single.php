<?php get_header(); ?>
<div class="main-content">
	<?php
	if(have_posts()):
		while(have_posts()) : the_post(); ?>
	<div class="pigura-post">
		<div class="pigura-wrap">
			<header class="pigura-header">
				<div class="pigura-title">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="pigura-cats">
					<?php the_category(', '); ?>
				</div>
				<div class="pigura-author">
					<div class="avatar-wrap">
						<span class="author-avatar">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
							</a>
						</span>
					</div>
					<div class="author-name"><h2><?php the_author_posts_link(); ?></h2></div>
				</div>
			</header>
			<div class="pigura-image">
			<?php the_post_thumbnail('large'); ?>
			</div>
			<div class="pigura-info">
				<div class="pigura-desc info-box">
					<h2>Deskripsi</h2>
					<p><?php the_content(); ?></p>
				</div>
				<div class="pigura-stats info-box">
					<h2>Statistik</h2>
					<table>
						<tbody>
							<tr class="loves">
								<td><i class="fa fa-heart"></i>&nbsp;&nbsp;Suka</td>
								<td class="value"><?php $loves_count = get_post_meta(get_the_ID(), "votes_count", true); if($loves_count): echo $loves_count; else: echo 0; endif; ?></td>
							</tr>
							<tr class="comments">
								<td><i class="fa fa-comment"></i>&nbsp;&nbsp;Komentar</td>
								<td class="value"><?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="pigura-tags">
					<h2>Tag</h2>
					<?php the_tags('',''); ?>
				</div>
				<div class="pigura-acts info-box">
					<span class="act-love-wrap">
						<?php
						if(hasAlreadyVoted(get_the_ID())): ?>
						<a class="voted" data-post_id="<?php echo get_the_ID(); ?>" href="#">
						<span class="act-love" id="act-voted"><i class="fa fa-heart"></i>&nbsp;&nbsp;Anda Suka</span></a>
							<?php
							else: ?>
							<a data-post_id="<?php echo get_the_ID(); ?>" href="#">
							<span class="act-love"><i class="fa fa-heart"></i>&nbsp;&nbsp;Suka</span></a>
								<?php 
								endif; ?>
					</span>
					<span class="act-share-wrap">
						<span class="act-share"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Bagikan</span>
						<div class="social-buttons">
							<span class="btn-facebook fb-like" data-href="http://ambercat.rahmanda.net" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></span>
							<span class="btn-pinterest">
								<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
							</span>
							<span class="btn-twitter">
								<a href="https://twitter.com/share" class="twitter-share-button" data-via="rahmandawibowo" data-count="none">Tweet</a>
							</span>
							<span class="btn-google">
								<span class="g-plusone" data-size="medium" data-annotation="none"></span>
							</span>
							<span class="btn-linkedin">
								<script type="IN/Share" data-counter="right"></script>
							</span>
						</div>
					</span>
				</div>
			</div>
			<div class="pigura-profile">
				<div class="author">
					<div class="avatar">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
						</a>
					</div>
					<div class="bio">
						<h2 class="name"><?php the_author_posts_link(); ?></h2>
						<p class="prof"><?php echo get_the_author_meta('profession'); ?></p>
					</div>
				</div>
				<div class="other-pigura">
					<?php 
					$args = array('posts_per_page' => 5, 'author' => get_the_author_meta('ID'), 'post__not_in' => array( get_the_ID() ));
					$related_posts = get_posts($args);
					foreach ($related_posts as $related_post) : setup_postdata($related_post); ?>
					<a href="<?php echo get_permalink($related_post->ID); ?>">
						<div>
							<?php echo get_the_post_thumbnail($related_post->ID, 'thumbnail'); ?>
						</div>
					</a>
					<?php 
					endforeach;
					wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="pigura-comments">
				<h2>Beri Komentar</h2>
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
	<?php
	endwhile;
	else :
		echo '<p>No content found.</p>';

	endif; ?>
</div>
<?php get_footer(); ?>