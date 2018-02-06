<?php
/**
 * Do not edit anything in this file unless you know what you're doing
 */
use Roots\Sage\Config;
use Roots\Sage\Container;
/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
	$title = $title ?: __('Sage &rsaquo; Error', 'sage');
	$footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
	$message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
	wp_die($message, $title);
};
/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7', phpversion(), '>=')) {
	$sage_error(__('You must be using PHP 7 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}
/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
	$sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}
/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
	if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
		$sage_error(
			__('You must run <code>composer install</code> from the Sage directory.', 'sage'),
			__('Autoloader not found.', 'sage')
		);
	}
	require_once $composer;
}
/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
	$file = "../app/{$file}.php";
	if (!locate_template($file, true, true)) {
		$sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
	}
}, ['helpers', 'setup', 'filters', 'admin']);
/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
	'add_filter',
	['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
	array_fill(0, 4, 'dirname')
);
Container::getInstance()
->bindIf('config', function () {
	return new Config([
		'assets' => require dirname(__DIR__).'/config/assets.php',
		'theme' => require dirname(__DIR__).'/config/theme.php',
		'view' => require dirname(__DIR__).'/config/view.php',
	]);
}, true);

/* Clear the Cache
function u3_clearcache() {
	$upload_dir = wp_upload_dir();
    $files = glob($upload_dir . 'cache/*'); // get all file names
    foreach($files as $file){ // iterate files
    	if(is_file($file)) {
    		unlink($file); // delete file
    	}
    }
}
do_action( 'customize_save_after', 'u3_clearcache' );
*/

/* Custom Wordpress Shortcodes */
function u3_grid($atts, $content = "&nbsp;") {
	return '<div class="uk-grid-match uk-child-width-expand@m" uk-grid>' . do_shortcode($content) . '</div>';
}
add_shortcode('grid', 'u3_grid');
function u3_col($atts, $content = "&nbsp;") {
	return '<div class="uk-width-expand@m">' . do_shortcode($content) . '</div>';
}
add_shortcode('col', 'u3_col');
function u3_icon($atts, $content = "&nbsp;") {
	return '<div>' . $content . '</div>';
}
add_shortcode('icon', 'u3_icon');

/* <!-- --> */

/* List*/ 
function u3_list_sc($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'type'     => 'bullet'
	), $atts) );
	$output  = '<ul class="uk-list uk-list-'.$type.'">';
	$output .= do_shortcode($content);
	$output .= '</ul>';
	return $output;
}
add_shortcode('list','sc_list_sc');
function u3_li_sc($atts,$content=NULL) {
	$output = '<li>'.$content.'</li>';
	return $output;
}
add_shortcode('li','sc_li_sc');
/**
                Alert
                **/
                function air_alert_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'type'     => 'notice',
                	), $atts) );
                	if(!in_array($type,array('notice','warning','success','error','info')))
                		$type = 'notice';
                	$output = '<div class="uk-alert '.$type.'">'.$content.'<a class="uk-alert-close" href="#">×</a></div>';
                	return $output;
                }
                add_shortcode('alert','air_alert_shortcode');
/**
                Accordion
                **/
                function air_accordion_shortcode($atts,$content=NULL) {
                	$output = '<div class="accordion">'.do_shortcode($content).'</div>';
                	return $output;
                }
                add_shortcode('accordion','air_accordion_shortcode');
/**
                Accordion element
                **/
                function air_acc_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'title'      => 'Title'
                	), $atts) );
                	global $air_acc_count;
                	if(!$air_acc_count) { $air_acc_count = 1; }
                	$output  = '<div class="title"><a href="#acc-'.$air_acc_count.'"><i class="icon"></i>'.$title.'</a></div>';
                	$output .= '<div id="acc-'.$air_acc_count.'" class="inner">'.do_shortcode($content).'</div>';
                	$air_acc_count++;
                	return $output;
                }
                add_shortcode('acc','air_acc_shortcode');
/**
                Button
                **/
                function air_button_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'size'                      => false,
                		'style'                    => false,
                		'link'                       => '#',
                		'target'  => false
                	), $atts) );
                # Set classes
                	$classes = 'button';
                	if($size) { $classes .= ' '.$size; }
                	if($style) { $classes .= ' '.$style; }
                	$target = $target?' target="'.$target.'"':'';
                # Button
                	$output = '<p><a href="'.$link.'" class="'.$classes.'"'.$target.'>'.$content.'</a></p>';
                	return $output;
                }
                add_shortcode('button','air_button_shortcode');
/**
                Column
                **/
                function air_column_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'size'      => 'one-third',
                		'last'       => FALSE
                	), $atts) );
                	$lastclass=$last?' last':'';
                	$output='<div class="'.strip_tags($size).$lastclass.'">'.do_shortcode($content).'</div>';
                	if($last)
                		$output.='<div class="clear"></div>';
                	return $output;
                }
                add_shortcode('column','air_column_shortcode');
/**
                Dropcap
                **/
                function air_dropcap_shortcode($atts,$content=NULL) {
                	$output = '<span class="dropcap">'.strip_tags($content).'</span>';
                	return $output;
                }
                add_shortcode('dropcap','air_dropcap_shortcode');
/**
                Highlight
                **/
                function air_highlight_shortcode($atts,$content=NULL) {
                	$output = '<span class="uk-text-primary">'.strip_tags($content).'</span>';
                	return $output;
                }
                add_shortcode('highlight','air_highlight_shortcode');
/**
                HR
                **/
                function air_hr_shortcode($atts,$content=NULL) {
                	$output = '<div class="hr"></div>';
                	return $output;
                }
                add_shortcode('hr','air_hr_shortcode');
/**
                LI
                **/
                function air_li_shortcode($atts,$content=NULL) {
                	$output = '<li>'.$content.'</li>';
                	return $output;
                }
                add_shortcode('li','air_li_shortcode');
/**
                List
                **/
                function air_list_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'type'     => 'arrow'
                	), $atts) );
                	$output  = '<ul class="uk-list uk-list-line '.$type.'">';
                	$output .= do_shortcode($content);
                	$output .= '</ul>';
                	return $output;
                }
                add_shortcode('list','air_list_shortcode');
/**
                Google Maps
                **/
                function air_googlemap_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'id'                                          => 'googlemap',
                		'latitude'                              => 0,
                		'longitude'                           => 0,
                                'maptype'                            => 'ROADMAP', // HYBRID, SATELLITE, ROADMAP, TERRAIN
                                'width'                                  => '425',
                                'height'                 => '350',
                                'scrollwheel'       => FALSE,
                                'zoom'                                   => 10,
                                'address'                              => NULL,
                                'marker'                               => TRUE,
                                'html'                                     => '',
                                'popup'                                 => FALSE,
                                'fullwidth'                            => FALSE
                            ), $atts) );
                	global $air_gmaps_loaded;
                	$output = '';
                # Google Maps API Script + jQuery plugin
                	if(!$air_gmaps_loaded) {
                		$output .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>'."\n";
                		$output .= '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery.gmap.min.js"></script>'."\n";
                	}
                # Prevent duplicate loading of scripts
                	$air_gmaps_loaded = TRUE;
                # Google Map Div
                	if(!$fullwidth) {
                		$output .= '<div id="'.$id.'" class="google-map" style="width:'.$width.'px; height:'.$height.'px"></div>'."\n";
                	} else {
                		$output .= '<div id="'.$id.'" class="google-map google-map-full" style="height:'.$height.'px"></div>'."\n";
                	}
                # Google Map Standard Options
                	$opts = array(
                		'maptype'                            => "'".$maptype."'",
                		'scrollwheel'       => $scrollwheel?'true':'false',
                		'zoom'                                   => $zoom
                	);
                # Latitude / Longitude
                	if($latitude && $longitude) {
                		$opts['latitude'] = $latitude;
                		$opts['longitude'] = $longitude;
                	}
                # Latitude and Longitude Marker
                	if(($latitude && $longitude) && $marker) {
                                # Set popup
                		$popup = $popup?'true':'false';
                                # Create marker
                		$opts['markers'] = "[
                			{
                				latitude: '".$latitude."',
                				longitude: '".$longitude."',
                				html: '".$html."',
                				popup: ".$popup.",
                			}
                		]";
                	}
                # Address
                	if($address && (!$latitude && $longitude)) { $opts['address'] = "'".$address."'"; }
                # Address Marker
                	if(!($latitude || $longitude) && $address && $marker) {
                                # Set popup
                		$popup = $popup?'true':'false';
                                # Create marker
                		$opts['markers'] = "[
                			{
                				address: '".$address."',
                				html: '".$html."',
                				popup: ".$popup.",
                			}
                		]";
                	}
                # Build Google Map Options
                	$options = '';
                	foreach($opts as $key=>$value) {
                		$options .= "\t".$key.': '.$value.','."\n";
                	}
                # Google Map Initialize
                	$output .= "
                	<script type=\"text/javascript\">
                	jQuery('#".$id."').gMap({
                		".$options."
                	});
                	</script>
                	";
                	return $output;
                }
                add_shortcode('googlemap','air_googlemap_shortcode');
/**
                Plan
                **/
                function air_plan_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'name'                  => 'Plan Name',
                		'link'                       => '#',
                		'linkname'           => 'Sign Up',
                		'price'                    => '0',
                		'per'                       => false,
                		'color'                    => false,
                		'featured'            => false,
                	), $atts) );
                	$outer_style = ($featured && $color)?' style="border: 1px solid #'.$color.'"':'';
                	$class = $featured?'plan featured':'plan';
                	$per = $per?' <span>/ '.$per.'</span>':'';
                	$style = $color?' style="background:#'.$color.';"':'';
                	$button = $featured?'button large light':'button';
                	$output  = '<div class="uk-width-1-4 '.$class.'"'.$outer_style.'>';
                	$output .= '<div class="plan-head"'.$style.'>';
                	$output .= '<h3 class="uk-panel-title">'.$name.'</h3>';
                	$output .= '<div class="price">'.$price.$per.'</div>';
                $output .= '</div>'; // end .plan-head
                $output .= $content;
                if(!empty($linkname)) {
                	$output .= '<div class="signup"><a href="'.$link.'" class="uk-button uk-button'.$button.'">'.$linkname.'</a></div>';
                }
                $output .= '</div>'; // end .plan
                return $output;
            }
            add_shortcode('plan','air_plan_shortcode');
/**
                Price Table
                **/
                function air_price_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'col'        => 'col-4',
                	), $atts) );
                	$output = '<div class="pricing-table uk-grid '.$col.' fix">';
                	$output .= do_shortcode($content);
                	$output .= '<div class="clear"></div>';
                	$output .= '</div>';
                	return $output;
                }
                add_shortcode('price-table','air_price_shortcode');
/**
                Pullquote
                **/
                function air_pullquote_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'align'     => 'left',
                	), $atts) );
                	if(!in_array($align,array('left','right')))
                		$align = 'left';
                	$output = '<span class="pullquote-'.$align.'">'.strip_tags($content).'</span>';
                	return $output;
                }
                add_shortcode('pullquote','air_pullquote_shortcode');
/**
                Tabs container and links
                **/
                function air_tabs_shortcode($atts,$content=NULL) {
                	extract(shortcode_atts(array(),$atts));
                # Tab count global variable
                	global $air_tab_count;
                	$output  = '<div class="tabs fix">'."\n";
                	$output .= '<ul class="tabs-nav fix">'."\n";
                	$count = $air_tab_count = 1;
                	foreach($atts as $tab) {
                		$output.='<li><a href="#tab-'.$count.'">'.$tab.'</a></li>'."\n";
                		$count++;
                	}
                	$output .= '</ul>'."\n";
                	$output .= ''."\n";
                	$output .= do_shortcode($content);
                	$output .= ''."\n";
                	$output .= '</div>'."\n";
                # Remove wp auto formatting - <br /> tags
                	$output = str_replace(array('<br />'),'',$output);
                	return $output;
                }
                add_shortcode('tabs','air_tabs_shortcode');
/**
                Tab
                **/
                function air_tab_shortcode($atts,$content=NULL) {
                	extract(shortcode_atts(array(),$atts));
                # Tab count global variable
                	global $air_tab_count;
                # Tab
                	$output  = '<div id="tab-'.$air_tab_count.'" class="tab"><div class="tab-content">';
                	$output .= do_shortcode($content);
                	$output .= '</div></div>';
                # Increment tab count
                	$air_tab_count++;
                	return $output;
                }
                add_shortcode('tab','air_tab_shortcode');
/**
                Toggle
                **/
                function air_toggle_shortcode($atts,$content=NULL) {
                	extract( shortcode_atts( array(
                		'title'      =>           'Title',
                	), $atts) );
                	$output  = '<div class="toggle">';
                	$output .= '<div class="title"><i class="icon"></i>'.$title.'</div>';
                	$output .= '<div class="inner"><div class="content">'.do_shortcode($content).'</div></div>';
                	$output .= '</div>';
                	return $output;
                }
                add_shortcode('toggle','air_toggle_shortcode');