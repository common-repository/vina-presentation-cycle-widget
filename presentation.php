<?php
/*
Plugin Name: Vina Presentation Cycle Widget
Plugin URI: http://VinaThemes.biz
Description: A great WordPress Slider to display featured posts in Presentation Cycle.
Version: 1.0
Author: VinaThemes
Author URI: http://VinaThemes.biz
Author email: mr_hiennc@yahoo.com
Demo URI: http://VinaDemo.biz
Forum URI: http://VinaForum.biz
License: GPLv3+
*/

//Defined global variables
if(!defined('VINA_PRESENTATION_DIRECTORY')) 	define('VINA_PRESENTATION_DIRECTORY', dirname(__FILE__));
if(!defined('VINA_PRESENTATION_INC_DIRECTORY')) define('VINA_PRESENTATION_INC_DIRECTORY', VINA_PRESENTATION_DIRECTORY . '/includes');
if(!defined('VINA_PRESENTATION_URI')) 			define('VINA_PRESENTATION_URI', get_bloginfo('url') . '/wp-content/plugins/vina-presentation-widget');
if(!defined('VINA_PRESENTATION_INC_URI')) 		define('VINA_PRESENTATION_INC_URI', VINA_PRESENTATION_URI . '/includes');

//Include library
if(!defined('TCVN_FUNCTIONS')) {
    include_once VINA_PRESENTATION_INC_DIRECTORY . '/functions.php';
    define('TCVN_FUNCTIONS', 1);
}
if(!defined('TCVN_FIELDS')) {
    include_once VINA_PRESENTATION_INC_DIRECTORY . '/fields.php';
    define('TCVN_FIELDS', 1);
}

class Presentation_Widget extends WP_Widget 
{
	function Presentation_Widget()
	{
		$widget_ops = array(
			'classname' => 'presentation_widget',
			'description' => __("A great WordPress Slider to display featured posts in Presentation Cycle.")
		);
		$this->WP_Widget('presentation_widget', __('Vina Presentation Cycle Widget'), $widget_ops);
	}
	
	function form($instance)
	{
		$instance = wp_parse_args( 
			(array) $instance, 
			array( 
				'title' 			=> '',
				'categoryId' 		=> '',
				'noItem' 			=> '5',
				'ordering' 			=> 'id',
				'orderingDirection' => 'desc',
				
				'width'			=> '600',
				'height'		=> '200',
				'speed'			=> '8000',
				'cycleSpeed'	=> '600',
				
				'showTitle'		=> 'yes',
				'showImage'		=> 'yes',
				'imageWidth'	=> '600',
				'imageHeight'	=> '200',
				'showContent'	=> 'yes',
				'readmore'		=> 'yes',
				'freeLicense'	=> 'yes',
			)
		);

		$title			= esc_attr($instance['title']);
		$categoryId		= esc_attr($instance['categoryId']);
		$noItem			= esc_attr($instance['noItem']);
		$ordering		= esc_attr($instance['ordering']);
		$orderingDirection = esc_attr($instance['orderingDirection']);
		
		$width		= esc_attr($instance['width']);
		$height		= esc_attr($instance['height']);
		$speed		= esc_attr($instance['speed']);
		$cycleSpeed	= esc_attr($instance['cycleSpeed']);
		
		$showTitle		= esc_attr($instance['showTitle']);
		$showImage		= esc_attr($instance['showImage']);
		$imageWidth		= esc_attr($instance['imageWidth']);
		$imageHeight	= esc_attr($instance['imageHeight']);
		$showContent	= esc_attr($instance['showContent']);
		$readmore		= esc_attr($instance['readmore']);
		$freeLicense 	= esc_attr($instance['freeLicense']);
		?>
        <div id="tcvn-timeline" class="tcvn-plugins-container">
            <div style="color: red; padding: 0px 0px 10px; text-align: center;">You are using free version ! <a href="http://vinathemes.biz/commercial-plugins/item/25-vina-presentation-cycle-widget.html" title="Download full version." target="_blank">Click here</a> to download full version.</div>
            <div id="tcvn-tabs-container">
                <ul id="tcvn-tabs">
                    <li class="active"><a href="#basic"><?php _e('Basic'); ?></a></li>
                    <li><a href="#display"><?php _e('Display'); ?></a></li>
                    <li><a href="#advanced"><?php _e('Advanced'); ?></a></li>
                </ul>
            </div>
            <div id="tcvn-elements-container">
                <!-- Basic Block -->
                <div id="basic" class="tcvn-telement" style="display: block;">
                    <p><?php echo eTextField($this, 'title', 'Title', $title); ?></p>
                    <p><?php echo eSelectOption($this, 'categoryId', 'Category', buildCategoriesList('Select all Categories.'), $categoryId); ?></p>
                    <p><?php echo eTextField($this, 'noItem', 'Number of Post', $noItem, 'Number of posts to show. Default is: 5.'); ?></p>
                	<p><?php echo eSelectOption($this, 'ordering', 'Post Field to Order By', 
						array('id'=>'ID', 'title'=>'Title', 'comment_count'=>'Comment Count', 'post_date'=>'Published Date'), $ordering); ?></p>
                    <p><?php echo eSelectOption($this, 'orderingDirection', 'Ordering Direction', 
						array('asc'=>'Ascending', 'desc'=>'Descending'), $orderingDirection, 
						'Select the direction you would like Articles to be ordered by.'); ?></p>
                </div>
                <!-- Display Block -->
                <div id="display" class="tcvn-telement">
                	<p><?php echo eTextField($this, 'width', 'Module Width', $width); ?></p>
                    <p><?php echo eTextField($this, 'height', 'Module Height', $height); ?></p>
                    <p><?php echo eTextField($this, 'speed', 'Slide Timeout', $speed); ?></p>
                    <p><?php echo eTextField($this, 'cycleSpeed', 'Cycle Speed', $cycleSpeed); ?></p>
                </div>
                <!-- Advanced Block -->
                <div id="advanced" class="tcvn-telement">
                    <p><?php echo eSelectOption($this, 'showTitle', 'Post Title', 
						array('yes'=>'Show post title', 'no'=>'Hide post title'), $showTitle); ?></p>
                    <p><?php echo eSelectOption($this, 'showImage', 'Show Image', 
						array('yes'=>'Yes', 'no'=>'No'), $showImage); ?></p>
                    <p><?php echo eTextField($this, 'imageWidth', 'Image Width (px)', $imageWidth); ?></p>
                    <p><?php echo eTextField($this, 'imageHeight', 'Image Height (px)', $imageHeight); ?></p>
                    <p><?php echo eSelectOption($this, 'showContent', 'Post Content', 
						array('yes'=>'Show post content', 'no'=>'Hide post content'), $showContent); ?></p>
                    <p><?php echo eSelectOption($this, 'readmore', 'Readmore', 
						array('yes'=>'Show readmore button', 'no'=>'Hide readmore button'), $readmore); ?></p>
                    <p><?php echo eSelectOption($this, 'freeLicense', 'Use Free License', 
						array('yes'=>'Yes', 'no'=>'No'), $readmore); ?></p>
                </div>
            </div>
        </div>
		<script>
			jQuery(document).ready(function($){
				var prefix = '#tcvn-timeline ';
				$(prefix + "li").click(function() {
					$(prefix + "li").removeClass('active');
					$(this).addClass("active");
					$(prefix + ".tcvn-telement").hide();
					
					var selectedTab = $(this).find("a").attr("href");
					$(prefix + selectedTab).show();
					
					return false;
				});
			});
        </script>
		<?php
	}
	
	function update($new_instance, $old_instance) 
	{
		return $new_instance;
	}
	
	function widget($args, $instance) 
	{
		extract($args);
		
		$title 			= getConfigValue($instance, 'title',		'');
		$categoryId		= getConfigValue($instance, 'categoryId',	'');
		$noItem			= getConfigValue($instance, 'noItem',		'5');
		$ordering		= getConfigValue($instance, 'ordering',		'id');
		$orderingDirection = getConfigValue($instance, 'orderingDirection',	'desc');
		
		$width			= getConfigValue($instance, 'width',  '600');
		$height			= getConfigValue($instance, 'height', '200');
		$speed			= getConfigValue($instance, 'speed', '8000');
		$cycleSpeed		= getConfigValue($instance, 'cycleSpeed', '600');
		
		$showTitle		= getConfigValue($instance, 'showTitle',	'yes');
		$showImage		= getConfigValue($instance, 'showImage',	'yes');
		$imageWidth		= getConfigValue($instance, 'imageWidth',	'600');
		$imageHeight	= getConfigValue($instance, 'imageHeight',	'200');
		$showContent	= getConfigValue($instance, 'showContent',	'yes');
		$readmore		= getConfigValue($instance, 'readmore',		'yes');
		
		$params = array(
			'numberposts' 	=> $noItem, 
			'category' 		=> $categoryId, 
			'orderby' 		=> $order,
			'order' 		=> $orderingDirection,
		);
		
		if($categoryId == '') {
			$params = array(
				'numberposts' 	=> $noItem, 
				'orderby' 		=> $order,
				'order' 		=> $orderingDirection,
			);
		}
		
		$posts 	 = get_posts($params);
		
		echo $before_widget;
		
		if($title) echo $before_title . $title . $after_title;
		
		if(!empty($posts)) :
		?>
        <style type="text/css">
		.pc_container {
			width: <?php echo $width; ?>px;
    		height: <?php echo $height; ?>px;
		}
		.pc_container .pc_item {
			width: <?php echo $width; ?>px;
    		height: <?php echo $height; ?>px;
		}
		.pc_container .pc_bar_container {
			top: <?php echo $height + 30; ?>px;
		}
		.pc_bar_container_overflow {
			top: <?php echo $height + 30; ?>px;
		}
		.pc_item .desc {
			 width: <?php echo ($width - 100)/2; ?>px;
			 height: <?php echo $height - 20; ?>px;
		}
		</style>
        <div id="vina-presentation-container" class="vina-presentation-container pc_container">
            <?php
            foreach($posts as $post) :
				$thumbnailId = get_post_thumbnail_id($post->ID);				
				$thumbnail 	 = wp_get_attachment_image_src($thumbnailId , '70x45');	
				$altText 	 = get_post_meta($thumbnailId , '_wp_attachment_image_alt', true);
				$commentsNum = get_comments_number($post->ID);
				$postDate	 = $post->post_date;
				$image 	= VINA_PRESENTATION_URI . '/includes/timthumb.php?w='.$imageWidth.'&h='.$imageHeight.'&a=c&q=99&z=0&src=';
				$link 	= get_permalink($post->ID);
				$text   = explode('<!--more-->', $post->post_content);
				$sumary = $text[0];
			?>
            <div class="pc_item">
                <div class="desc">
                    <?php if($showTitle == 'yes') { ?><h3><?php echo $post->post_title; ?></h3><?php } ?>
                    <?php if($showContent == 'yes') { ?><p><?php echo $sumary; ?></p><?php } ?>
                    <?php if($readmore == 'yes') { ?><a class="buttonlight morebutton" href="<?php $link; ?>">Read more ...</a><?php } ?>
                </div>
                <?php if($showImage == 'yes') { ?><img src="<?php echo $image.$thumbnail[0]; ?>" alt="<?php echo $post->post_title; ?>" /><?php } ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if($freeLicense == 'yes') : ?>
        <div id="tcvn-copyright">
        	<a href="http://vinathemes.biz" title="Free download Wordpress Themes, Wordpress Plugins - VinaThemes.biz">Free download Wordpress Themes, Wordpress Plugins - VinaThemes.biz</a>
        </div>
        <?php endif; ?>
        <script type="text/javascript">
			jQuery(document).ready(function() {
				presentationCycle.containerId 		= "vina-presentation-container";
				presentationCycle.slideTimeout      = <?php echo $speed; ?>;
				presentationCycle.cycleSpeed        = <?php echo $cycleSpeed; ?>;
				presentationCycle.barImgLeft 		= "<?php echo VINA_PRESENTATION_INC_URI; ?>/images/pc_item_left.gif";
				presentationCycle.barImgRight 		= "<?php echo VINA_PRESENTATION_INC_URI; ?>/images/pc_item_right.gif";
				presentationCycle.barImgCenter 		= "<?php echo VINA_PRESENTATION_INC_URI; ?>/images/pc_item_center.gif";
				presentationCycle.barImgBarEmpty 	= "<?php echo VINA_PRESENTATION_INC_URI; ?>/images/pc_bar_empty.gif";
				presentationCycle.barImgBarFull 	= "<?php echo VINA_PRESENTATION_INC_URI; ?>/images/pc_bar_full.gif"; 
				presentationCycle.init();
			});
		</script>
		<?php
		endif;
		
		echo $after_widget;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("Presentation_Widget");'));
wp_enqueue_style('vina-admin-css', VINA_PRESENTATION_INC_URI . '/admin/css/style.css', '', '1.0', 'screen' );
wp_enqueue_script('vina-tooltips', VINA_PRESENTATION_INC_URI . '/admin/js/jquery.simpletip-1.3.1.js', 'jquery', '1.0', true);

wp_enqueue_style('vina-cycle-css', VINA_PRESENTATION_INC_URI . '/css/style.css', '', '1.0', 'screen' );
wp_enqueue_style('vina-presentation-css', VINA_PRESENTATION_INC_URI . '/css/presentationCycle.css', '', '1.0', 'screen' );

wp_enqueue_script('vina-cycle-all', VINA_PRESENTATION_INC_URI . '/js/jquery.cycle.all.min.js', 'jquery', '1.0', true);
wp_enqueue_script('vina-presentation', VINA_PRESENTATION_INC_URI . '/js/presentationCycle.js', 'jquery', '1.0', true);
?>