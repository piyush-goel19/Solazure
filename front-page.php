<?php
get_header();?>
<div class="clearfix">
	<?php if(have_posts()):
		while (have_posts()): the_post();
			the_content();
		
		endwhile;
		
		else :
			echo "<p>no content found</p>";
		endif;
	?>
		<div class="home-columns clearfix">
			<div class="one-half">
				<h3 class="latest">Latest Solar Posts</h3>
				<?php 
					//two recent solar power posts 
					$solarPosts = new WP_Query('cat=4&posts_per_page=2');
					$solarPosts1 = new WP_Query('cat=4');
					if($solarPosts -> have_posts()):
						while($solarPosts ->have_posts()): $solarPosts -> the_post();?>
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<?php the_excerpt();?>
					<?php endwhile;
					else :

					endif;?>
					<h4 class="viewmore"><a href="<?php echo get_category_link(4);?>">View more&raquo;</a></h4>
					<?php wp_reset_postdata();?>
			</div>
			<div class="one-half last">
				<h3 class="latest">Latest Default</h3>
				<?php //two recent default posts 
					$defPosts = new WP_Query('cat=5&posts_per_page=2');
					if($defPosts -> have_posts()):
						while($defPosts ->have_posts()): $defPosts -> the_post();?>
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<?php the_excerpt();?>
					<?php endwhile;
					else :

					endif;?>
					<h4 class="viewmore"><a href="<?php echo get_category_link(5)?>">View more&raquo;</a></h4>
					<?php wp_reset_postdata();?>
			</div>
		</div>
</div>
<?php get_footer();
?>