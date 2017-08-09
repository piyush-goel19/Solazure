<?php
get_header();?>

<div class="clearfix">
	<div class="main-column">
		<?php if(current_user_can('administrator')): ?>
		<div class="quick-post">
			<h3>Quick Add Post</h3>
			<input type="text" name="title" placeholder="Title">
			<input type="text" name="category" placeholder="Category ID to be posted in">
			<textarea name="content" placeholder="Content"></textarea>
			<button id="quick-add-btn">Create Post</button>
		</div>
	<?php endif ?>
		<?php 
		if(have_posts()):
			while (have_posts()): the_post(); 
			
			get_template_part('content',get_post_format());
			
			endwhile;
			echo paginate_links();
		else :
			echo "<p>no content found</p>";
		endif;?>
	</div>
	<?php get_sidebar();?>
</div>
<?php get_footer();
?>