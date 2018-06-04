<?php
get_header();?>
<div class="clearfix">
	<div class="main-column"> 
		<?php if(have_posts()):?>
		<h2>
			<?php 
			if(is_category()){
				echo 'Category Archives: '; single_cat_title();
			}elseif (is_tag()) {
				 echo 'Tag: '; single_tag_title();
			}elseif (is_author()) {
				the_post();
				echo 'Author Archives: ' . get_the_author();
				rewind_posts();
			}elseif (is_day()) {
				echo 'Date Archives: ' . get_the_date();
			}elseif (is_month()) {
				echo 'Month Archives: '. get_the_date('F Y');
			}elseif (is_year()){
				echo 'Year Archives: ' . get_the_date('Y');
			}else
				echo 'Archives:';
				?>
		</h2>
		<?php 
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