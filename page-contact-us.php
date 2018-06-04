<?php
get_header();?>
<div class="clearfix">
	<div class="column1">
	<?php if(have_posts()):
			while (have_posts()): the_post(); ?>
				<article class="page">
				<h2 ><?php the_title();?></h2>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3500.2684190707264!2d77.13238791491712!3d28.68161618239845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03b920985929%3A0xf55dd0fe6b6cc030!2sRaja+Park!5e0!3m2!1sen!2sin!4v1499884067331" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				
				</article>
			<?php endwhile;
			else :
				echo "<p>no content found</p>";
			endif;?>
	</div>
	<div class="column2">
		<?php the_content();?>
	</div>
</div>

<div class="contact-form">
	<h3 class="contact-head">WE WOULD LOVE TO HEAR FROM YOU!</h3>
	<input type="text" name="fullname" placeholder="Name" autofocus required />
	<input type="text" name="email" placeholder="Email" autofocus required />
	<input type="text" name="phone" placeholder="Contact Number" autofocus required />
	<textarea row='5' name="message" placeholder="Your Message"></textarea>
	<button>Let ME In!</button>
</div>

<?php get_footer();

?>