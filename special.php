<?php
/*
Template Name: Special Layout
*/
get_header();
if(have_posts()):
	while (have_posts()): the_post(); ?>
	<article class="page">
		<h2 ><?php the_title();?></h2>
		<div class="info-box">
			<h4>Disclaimer note</h4>
			<p>please consider this. This is really important. Pay attention to whats been said by this.</p>
		</div>
		<?php the_content();?>
	</article>
	<?php endwhile;
	
	else :
		echo "<p>no content found</p>";
	endif;
get_footer();

?>