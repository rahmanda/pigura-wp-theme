<?php

add_theme_support( 'post-thumbnails' ); 
add_filter( 'show_admin_bar', '__return_false' );

function pigura_popular_tag($number_tags) {
	$tagcloud = get_tags(array('number' => $number_tags, 'orderby' => 'count', 'order' => 'DESC', 'exclude' => '', 'include' => ''));

	$counts = $tag_links = $tag_ids = $a = array();

	foreach( $tagcloud as $tag ) {
		$counts[$tag->name] = $tag->count;
		$tag_links[$tag->name] = get_tag_link($tag->term_id);
		$tag_ids[$tag->name] = $tag->term_id;
	}

	foreach( $counts as $tag=>$count ){
		$tag_id = $tag_ids[$tag];
		$tag_link = clean_url($tag_links[$tag]);
		$tag = str_replace(' ', '&nbsp;', wp_specialchars( $tag ));
		$a[] = "<a href=\"$tag_link\" class=\"tag-link-$tag_id\">$tag</a>";
	}
	print "<ul class='pigura-popular-tag'>\r\n<li>";
	print join("</li>\r\n<li>", $a);
	print "</li>\r\n</ul>\r\n";
}

function pigura_resources() {

	wp_enqueue_script('jquery', get_template_directory_uri().'/vendor/jquery/dist/jquery.min.js');
	wp_register_script('love_post', get_template_directory_uri().'/js/pigura.js');
	wp_localize_script('love_post', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
		));
	wp_enqueue_script( 'love_post' );
	wp_enqueue_style('pigura-style', get_stylesheet_uri());
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/vendor/font-awesome/css/font-awesome.min.css');

}

add_action('wp_enqueue_scripts', 'pigura_resources');

add_action( 'show_user_profile', 'pigura_profile_social_fields' );
add_action( 'edit_user_profile', 'pigura_profile_social_fields' );

function pigura_profile_social_fields( $user ) { ?>

	<h3>Extra Information</h3>

	<table class="form-table">
		<tr>
			<th><label for="profession">Profession</label></th>

			<td>
				<input type="text" name="profession" id="profession" value="<?php echo esc_attr( get_the_author_meta( 'profession', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your profession, use comma to separate when submitting more than one profession.</span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter">Twitter</label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter url profile.</span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook">Facebook</label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your facebook url profile.</span>
			</td>
		</tr>
		<tr>
			<th><label for="google">Google+</label></th>

			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google+ url profile.</span>
			</td>
		</tr>
		<tr>
			<th><label for="dribble">Dribble</label></th>

			<td>
				<input type="text" name="dribble" id="dribble" value="<?php echo esc_attr( get_the_author_meta( 'dribble', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Dribble url profile.</span>
			</td>
		</tr>
		<tr>
			<th><label for="behance">Behance</label></th>

			<td>
				<input type="text" name="behance" id="behance" value="<?php echo esc_attr( get_the_author_meta( 'behance', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Behance url profile.</span>
			</td>
		</tr>
		<tr>
			<th><label for="instagram">Instagram</label></th>

			<td>
				<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Instagram url profile.</span>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin">Linkedin</label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Linkedin url profile.</span>
			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'pigura_save_profile_social_fields' );
add_action( 'edit_user_profile_update', 'pigura_save_profile_social_fields' );

function pigura_save_profile_social_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
	update_usermeta( $user_id, 'google', $_POST['google'] );
	update_usermeta( $user_id, 'dribble', $_POST['dribble'] );
	update_usermeta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_usermeta( $user_id, 'instagram', $_POST['instagram'] );
	update_usermeta( $user_id, 'profession', $_POST['profession'] );
	update_usermeta( $user_id, 'behance', $_POST['behance'] );
}


add_action('wp_ajax_nopriv_post-love', 'post_love');
add_action('wp_ajax_post-love', 'post_love');


function transform_base64($item, $option = "encode") {
	if($option == "encode") {
		// $serialize = serialize($item);
		$encode = base64_encode($serialize);
		return $encode;
	} else if($option == "decode") {
		$decode = base64_decode($item);
		// $unserialize = unserialize($decode);
		return $decode;
	}
}

function post_love()
{
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
     
    if(isset($_POST['post_love']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];
         
        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = $meta_IP[0];
 
        if(!is_array($voted_IP))
            $voted_IP = array();
         
        // Get votes count for the current post
        $meta_count = get_post_meta($post_id, "votes_count", true);
 
        // Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();
 
            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "votes_count", ++$meta_count);
             
            // Display count (ie jQuery return value)
            echo $meta_count;
        }
        else
            echo "already";
    }
    exit;
}
$timebeforerevote = 60 * 24 * 30; // 1 month
function hasAlreadyVoted($post_id)
{
    global $timebeforerevote;
 
    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
    $voted_IP = $meta_IP[0];
     
    if(!is_array($voted_IP))
        $voted_IP = array();
         
    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];
     
    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();
         
        // Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;
             
        return true;
    }
     
    return false;
}

// $new_general_setting = new new_general_setting();
 
// class new_general_setting {
//     function new_general_setting( ) {
//         add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
//     }
//     function register_fields() {
//         register_setting( 'general', 'seo_title', 'esc_attr' );
//         add_settings_field('fav_color', '<label for="seo_title">'.__('SEO Tagline' , 'seo_title' ).'</label>' , array(&$this, 'fields_html') , 'general' );
//     }
//     function fields_html() {
//         $value = get_option( 'seo_title', '' );
//         echo '<input type="text" id="seo_title" name="seo_title" value="' . $value . '" />';
//     }
// }
