<?php
get_header();
if(have_posts()):
	while (have_posts()): the_post();
	/*get_template_part('content',get_post_format());
	if(has_post_thumbnail()) {?>has-thumbnail <?php } ?>
	<div class="thumbnail">
			<a href="<?php the_permalink(); ?>">	?>
	<?php if( $post . 'post-formats' == 'gallery' ){
		get_template_part('content-gallery');
	}*/?>
	<?php if(has_post_format('gallery',$post)){
		get_template_part('content-gallery');?>
		<div class="about-author clearfix">
				<div class="about-author-image">
					<?php echo get_avatar(get_the_author_meta('ID'),512);?>
					<p><?php echo get_the_author_meta('nickname');?></p>
				</div>
				<?php $otherauthorposts = new Wp_Query(array(
						'author'=>get_the_author_meta('ID'),
						'posts_per_page'=>2,
						'post__not_in'=>array(get_the_ID())
					));?>
				<div class="about-author-text">
					<h3>About the Author</h3>
					<?php echo wpautop(get_the_author_meta('description'));?>
					<?php if($otherauthorposts->have_posts()){ ?>
					<div class="other-posts">
						<h4>Other posts by <?php echo get_the_author_meta('nickname');?></h4>
						<ul>
							<?php while($otherauthorposts->have_posts()){
								$otherauthorposts->the_post();?>
								<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
							<?php } ?>
						</ul>
					</div>
					<?php } wp_reset_postdata(); ?>
				</div>
				
			</div>
	<?php } else{ ?>
	<article class="post">
		
		<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		<p class="meta"><?php the_time('D F j,Y g:i a'); ?> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php the_author(); ?></a> | Posted in 
			<?php 
				$categories = get_the_category();
				$seperator = ", ";
				$output = "";
				if($categories){
					foreach ($categories as $category) {
						$output .= '<a href="' .get_category_link($category->term_id) .'">' . $category->cat_name .'</a>' . $seperator;
					}
					echo trim($output, $seperator);
				}
			?>
		</p>
		<?php the_post_thumbnail('banner-image');?>
		<?php 
			if($post->post_excerpt){
				the_excerpt();
			}else {
				the_content();
			}?>
			<div class="about-author clearfix">
				<div class="about-author-image">
					<?php echo get_avatar(get_the_author_meta('ID'),512);?>
					<p><?php echo get_the_author_meta('nickname');?></p>
				</div>
				<?php $otherauthorposts = new Wp_Query(array(
						'author'=>get_the_author_meta('ID'),
						'posts_per_page'=>2,
						'post__not_in'=>array(get_the_ID())
					));?>
				<div class="about-author-text">
					<h3>About the Author</h3>
					<?php echo wpautop(get_the_author_meta('description'));?>
					<?php if($otherauthorposts->have_posts()){ ?>
					<div class="other-posts">
						<h4>Other posts by <?php echo get_the_author_meta('nickname');?></h4>
						<ul>
							<?php while($otherauthorposts->have_posts()){
								$otherauthorposts->the_post();?>
								<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
							<?php } ?>
						</ul>
					</div>
					<?php } wp_reset_postdata(); ?>
					<?php if(count_user_posts(get_the_author_meta('ID')) > 2){?>
					<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>">View all posts by <?php echo get_the_author_meta('nickname');?></a>
					<?php } ?>
				</div>
				
			</div>
	</article>
<?php 	}
	endwhile;
	
	else :
		echo "<p>no content found</p>";
endif;

get_footer();

?>