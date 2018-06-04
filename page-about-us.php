<?php
get_header();
if(have_posts()):
	while (have_posts()): the_post(); ?>
	<article class="page">
		<?php 
			if(has_children() OR $post->post_parent > 0)
					{
		?>
		<nav class="site-nav children">
			<span class='parent'><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></span>
			<ul>
				<?php 
				$args = array(
					'child_of' => get_top_ancestor_id(),
					'title_li' => ''
					);
					?>
				<?php wp_list_pages($args); ?>
			</ul>
		</nav>
		<?php } ?>
		<h2 ><?php the_title();?></h2>
		<?php the_content();?>
	</article>
	<?php endwhile;
	
else :
	echo "<p>no content found</p>";
endif;?>
<h3>Blog Posts About Us</h3>
<div class="about-list">
	<?php 
	$currentpage = get_query_var('paged');

	$aboutposts = new Wp_Query(array(
		'category_name' => 'about',
		'posts_per_page' => 2,
		'paged' => $currentpage
		));
	if($aboutposts->have_posts()) :
		while($aboutposts->have_posts()) :
			$aboutposts->the_post();?>
			<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li><?php
		endwhile;
		echo paginate_links(array(
			'total'=>$aboutposts->max_num_pages
			));
	endif;
?>	
</div>
<?php get_footer();
?>