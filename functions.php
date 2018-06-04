<?php
/* to import any style or scripts into theme*/
function learn_resources(){
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('main_js',get_template_directory_uri().'/js/main.js', NULL, 1.0, true);
	wp_localize_script('main_js','magicalData',array(
			'nonce' => wp_create_nonce('wp_rest'),
			'siteURL' => get_site_url()
		));
}
add_action('wp_enqueue_scripts', 'learn_resources');

//Navigation menus
register_nav_menus(array(
	'primary' => __('Primary Menu'),
	'footer' => __('Footer Menu')
	));
/* obtain ancestors*/
function get_top_ancestor_id(){
	global $post;
	if($post->post_parent){
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];
	}
	return $post->ID;
}
/* has children or not?*/
function has_children(){
	global $post;
	$pages = get_pages('child_of=' . $post->ID);
	return count($pages);
}
// excerpt length
function custom_excerpt_length(){
	return 25;
}
add_filter('excerpt_length','custom_excerpt_length');

//featured image support
function custom_setup_image(){
	add_theme_support('post-thumbnails');
	//register different image sizes
	add_image_size('small-thumbnail',210,120,true);
	add_image_size('banner-image',920,200,true);

	//add post format support
	add_theme_support('post-formats',array('aside','gallery','link'));
}
add_action('after_setup_theme','custom_setup_image');

//Add Widget location
function widgetinit(){
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar1',
		'before_widget' =>'<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title'=>'<h3 class="my-item">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 1',
		'id' => 'footer1',
		'before_widget' =>'<div class="widget-item w-search search">',
		'after_widget' => '</div>',
		'before_title'=>'<h3 class="my-item">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 2',
		'id' => 'footer2',
		'before_widget' =>'<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title'=>'<h3 class="my-item">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 3',
		'id' => 'footer3',
		'before_widget' =>'<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title'=>'<h3 class="my-item">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 4',
		'id' => 'footer4',
		'before_widget' =>'<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title'=>'<h3 class="my-item">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Blog Posts',
		'id' => 'posts1',
		'before_widget' =>'<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title'=>'<h3 class="my-item">',
		'after_title' => '</h3>'
	));
} 
add_action('widgets_init','widgetinit');

//customize appearance options
function customize($wp_customize){
	$wp_customize->add_setting('lwp_link_colors',array(
		'default' => '006ec3',
		'transport' => 'refresh',
	)); 
	$wp_customize->add_setting('lwp_btn_colors',array(
		'default' => '006ec3',
		'transport' => 'refresh',
	)); 
	$wp_customize->add_setting('lwp_hover_colors',array(
		'default' => 'ECECEC',
		'transport' => 'refresh',
	)); 
	$wp_customize->add_section('lwp_standard_colors',array(
			'title' => __('Standard Colors','LearningWordPress'),
			'priority' => 30,
		));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'lwp_color_control', array(
		'label' => __('Link Color','LearningWordPress'),
		'section' => 'lwp_standard_colors',
		'settings' => 'lwp_link_colors',
		)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'lwp_btn_control', array(
		'label' => __('Buttons Color','LearningWordPress'),
		'section' => 'lwp_standard_colors',
		'settings' => 'lwp_btn_colors',
		)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'lwp_hover_control', array(
		'label' => __('Hover Over Color','LearningWordPress'),
		'section' => 'lwp_standard_colors',
		'settings' => 'lwp_hover_colors',
		)));
}
add_action('customize_register','customize');

//output customize css
function apply_custom_css(){?>
	<style type="text/css">
		a:link,
		a:visited{
			color: <?php echo get_theme_mod('lwp_link_colors');?>
		}
		.site-header nav ul li.current-menu-item a:link,
		.site-header nav ul li.current-menu-item a:visited,
		.site-header nav ul li.current-page-ancestor a:link,
		.site-header nav ul li.current-page-ancestor a:visited{
			background-color: <?php echo get_theme_mod('lwp_link_colors');?>
		}
		div.search #searchsubmit{
			background-color: <?php echo get_theme_mod('lwp_btn_colors');?>
		}
		.site-header nav ul li a:hover{
			background-color: <?php echo get_theme_mod('lwp_hover_colors');?>
		}
	</style>
<?php }
add_action('wp_head','apply_custom_css');

//add footer callout section
function lwp_footer_callout($wp_customize){
	$wp_customize->add_section('lwp-callout',array(
			'title' => 'Footer Callout',
			'priority' => 50
		));
	$wp_customize->add_setting('lwp-callout-display', array(
			'default' => 'No',
			'transport' => 'refresh'
		));
	$wp_customize->add_control(new Wp_Customize_Control($wp_customize,'lwp-display-control',array(
			'label' => 'Display section?',
			'section' => 'lwp-callout',
			'settings' => 'lwp-callout-display',
			'type' => 'select',
			'choices' => array('No'=>'No','Yes'=>'Yes')
		)));
	$wp_customize->add_setting('lwp-callout-headline', array(
			'default' => 'Example Headline!',
			'transport' => 'refresh'
		));
	$wp_customize->add_control(new Wp_Customize_Control($wp_customize,'lwp-headline-control',array(
			'label' => 'Headline',
			'section' => 'lwp-callout',
			'settings' => 'lwp-callout-headline'
		)));
	$wp_customize->add_setting('lwp-callout-text', array(
			'default' => 'Example Paragraph!',
			'transport' => 'refresh'
		));
	$wp_customize->add_control(new Wp_Customize_Control($wp_customize,'lwp-text-control',array(
			'label' => 'Paragraph Text',
			'section' => 'lwp-callout',
			'settings' => 'lwp-callout-text',
			'type' => 'textarea'
		)));
	$wp_customize->add_setting('lwp-callout-link', array(
			'transport' => 'refresh'
		));
	$wp_customize->add_control(new Wp_Customize_Control($wp_customize,'lwp-link-control',array(
			'label' => 'Link',
			'section' => 'lwp-callout',
			'settings' => 'lwp-callout-link',
			'type' => 'dropdown-pages'
		)));
	$wp_customize->add_setting('lwp-callout-image', array(
			'transport' => 'refresh'
		));
	$wp_customize->add_control(new Wp_Customize_Cropped_Image_Control($wp_customize,'lwp-image-control',array(
			'label' => 'Image',
			'section' => 'lwp-callout',
			'settings' => 'lwp-callout-image',
			'width' => 750,
			'height' => 500
		)));
}
add_action('customize_register','lwp_footer_callout');
?>
