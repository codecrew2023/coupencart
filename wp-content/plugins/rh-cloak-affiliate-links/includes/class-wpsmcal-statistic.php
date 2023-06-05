<?php
if ( !defined( 'WPINC' ) ) die;

/**
 * Class Wpsmcal_Statistic
 *
 * @package RH Cloak Affiliate Links
 */
 
class Wpsmcal_Statistic extends Wpsmcal {

	/**
	 * Class constructor. Includes essential files and initializes the class attributes.
	 **/
	public function __construct( $version, $options ) {
		$this->version = $version;
		$this->options = $options;
		$this->meta_name = parent::get_meta_name();
	}
	
	/**
	 * Registers the actions of this class with WordPress.
	 */
	public function add_actions(){
		add_action( 'admin_init', array($this, 'create_options' ), 12 );
	}
	
	/**
	 * Activates Inside Statistics function
	 */
	public function inside_activate(){
		add_action( 'admin_menu', array( $this, 'inside_create_pages' ), 12 );
		add_action( 'wpsmcal_clickthrough', array( $this, 'count_clickthrough' ) );
		add_action( 'admin_print_footer_scripts', array( $this, 'print_modal_window' ) );
		add_action( 'wp_ajax_display_users', array( $this, 'fetch_clickthrough_users' ) );
		add_action( 'wp_ajax_display_posts', array( $this, 'fetch_clickthrough_posts' ) );
	}
	
	/**
	 * Activates Inside Statistics function
	 */
	public function analitics_activate(){
	//	add_action( 'admin_menu', array( $this, 'analitics_create_pages' ), 12 );
		add_action( 'wp_head', array( $this, 'add_ga_code' ) );
	}
	
	/**
	 * Creates the settings section, resgisters setting and adds settings fields.
	 */
	public function create_options(){
		add_settings_section( 'statistic_settings', esc_html__( 'Statistics settings', 'wpsmcal' ), array( $this, 'section_settings_desc' ), 'wpsmcal-options' );
		$fields = $this->get_settings_fields();
		foreach( $fields as $key => $value ){
			add_settings_field( $value['slug'], $value['name'], $value['callback'], $value['page'], $value['section'] );
		}
	}
	
	/**
	 * Callback function of the Section description
	 */
	function section_settings_desc() {
		esc_html_e( 'The function collects statistics on clicks of cloaking links', 'wpsmcal' );
	}
	
	/**
	 * Fields of the Settings page
	 */
	public function get_settings_fields() {
		return array(
			array(
				'slug' => 'activate_statistic',
				'name' => esc_html__( 'Enable statictics', 'wpsmcal' ),
				'callback' => array( $this, 'field_activate' ),
				'page' => 'wpsmcal-options',
				'section' => 'statistic_settings',
			),
			array(
				'slug' => 'statistic_fields',
				'name' => esc_html__( 'Statistics paged', 'wpsmcal' ),
				'callback' => array( $this, 'field_paged' ),
				'page' => 'wpsmcal-options',
				'section' => 'statistic_settings',
			),
			array(
				'slug' => 'activate_analitics',
				'name' => esc_html__( 'Enable Google Analytics', 'wpsmcal' ),
				'callback' => array( $this, 'analitics_active' ),
				'page' => 'wpsmcal-options',
				'section' => 'statistic_settings',
			),
			array(
				'slug' => 'analitics_fields',
				'name' => esc_html__( 'Google Analytics ID', 'wpsmcal' ),
				'callback' => array( $this, 'field_ga_key' ),
				'page' => 'wpsmcal-options',
				'section' => 'statistic_settings',
			),
		);
	}
	
	/**
	 * The field to enable the function
	 */
	public function field_activate() { 
	?>
		<input type="radio" value="yes" name="wpsmcal_options[sactive]" <?php checked( $this->options['sactive'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
		<input type="radio" value="no" name="wpsmcal_options[sactive]" <?php checked( $this->options['sactive'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
	<?php
	}
	
	/**
	 * Sets up number of pages in pagination.
	 */
	public function field_paged() { ?>
		<p><input type="number" value="<?php echo $this->options['paged']; ?>" name="wpsmcal_options[paged]" /></p>
		<p class="description"><?php esc_html_e( 'Set statistics pagination.', 'wpsmcal' ); ?></p>
	<?php
	}
	
	/**
	 * The field to enable the Google Analitic
	 */
	public function analitics_active() { 
	?>
		<input type="radio" value="yes" name="wpsmcal_options[gactive]" <?php checked( $this->options['gactive'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
		<input type="radio" value="no" name="wpsmcal_options[gactive]" <?php checked( $this->options['gactive'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
		<p class="description"><?php printf( esc_html__('Please, install %s plugin and enable Analytics module.', 'wpsmcal'), '<a href="https://wordpress.org/plugins/google-site-kit/" target="_blank">Site Kit by Google</a>' ); ?></p>
	<?php
	}
	
	/**
	 * Sets up a Google Analitics key.
	 */
	public function field_ga_key() { ?>
		<p><input type="text" value="<?php echo $this->options['ga_key']; ?>" name="wpsmcal_options[ga_key]" /></p>
		<p class="description"><?php printf( esc_html__( 'You can keep this field as empty if you enabled Site Kit Google plugin and connected your Analytics account. You can also set here your separate data stream ID of Analytics (starts from G-). Here you can read how to find your %s.  ', 'wpsmcal' ), '<a href="https://support.google.com/analytics/answer/9539598" target="_blank">Google Analytics ID</a>' ); ?></p>
	<?php
	}
	
	/**
	 * Creates the statistics page in plugin menu
	 */
	public function inside_create_pages(){
		add_thickbox();
		add_submenu_page('wpsmcal-options', esc_html__( 'RH Link Pro Statistics', 'wpfepp-plugin' ), esc_html__( 'Post Statistics', 'wpsmcal' ), 'manage_options', 'wpsmcal-post-stat', array( $this, 'build_post_page' ));
		add_submenu_page('wpsmcal-options', esc_html__( 'RH Link Pro Statistics', 'wpfepp-plugin' ), esc_html__( 'User Statistics', 'wpsmcal' ), 'manage_options', 'wpsmcal-user-stat', array( $this, 'build_user_page' ));
	}
	
	/**
	 * Creates the analitics page in plugin menu
	 */
	public function analitics_create_pages(){
		add_submenu_page('wpsmcal-options', esc_html__( 'Google Statistics', 'wpfepp-plugin' ), esc_html__( 'Google Statistics', 'wpsmcal' ), 'manage_options', 'wpsmcal-analitics-stat', array( $this, 'build_ga_page' ));
	}
	
	/**
	 * Clickthrough counter.
	 */
	function count_clickthrough( $post_id ) {
		$current_time = time();
		
		//total counter
		$post_counter = intval( get_post_meta( $post_id, '_wpsmcal_clickthrough_count', true ) );
		update_post_meta( $post_id, '_wpsmcal_clickthrough_count', ( $post_counter + 1 ) );
		update_post_meta( $post_id, '_wpsmcal_clickthrough_time', $current_time );
		
		if( is_user_logged_in() ){
			$user_id = get_current_user_id();
			
			$user_counter = intval( get_user_meta( $user_id, '_wpsmcal_clickthrough_count', true ) );
			update_user_meta( $user_id, '_wpsmcal_clickthrough_count', ( $user_counter + 1 ) );
			update_user_meta( $user_id, '_wpsmcal_clickthrough_time', $current_time );
			
			//save clicked Users to Post meta array in DB
			$post_users = (array) get_post_meta( $post_id, '_wpsmcal_clickthrough_users', true );
			
			if( isset( $post_users[$user_id] ) ){
				$post_users[$user_id] = $post_users[$user_id] + 1;
			}else{
				$post_users[$user_id] = 1;
			}
			update_post_meta( $post_id, '_wpsmcal_clickthrough_users', $post_users );
			
			//save clicked Posts to User meta array DB
			$user_posts = (array) get_user_meta( $user_id, '_wpsmcal_clickthrough_posts', true );
			
			if( isset( $user_posts[$post_id] ) ){
				$user_posts[$post_id] = $user_posts[$post_id] + 1;
			}else{
				$user_posts[$post_id] = 1;
			}
			update_user_meta( $user_id, '_wpsmcal_clickthrough_posts', $user_posts );
		}
	}

	/**
	 * Print modal window in the footer.
	 */
	function print_modal_window() {
		?>
		<div id="modal_content" style="display:none;"><div class="tabs"></div></div>
		<?php
	}
	
	/**
	 * Print Google Analitics scripts in the footer.
	 */
	function add_ga_code() {
		$ga_track = '.re_track_btn';
		if( $this->options['gactive'] ): ?>
			<?php $ga_key = $this->options['ga_key']; ?>
			<?php if( !defined( 'GOOGLESITEKIT_VERSION' ) && !empty( $ga_key ) ): ?>
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_key ?>"></script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', '<?php echo $ga_key ?>');
			</script>
			<?php elseif( defined( 'GOOGLESITEKIT_VERSION' ) && !empty( $ga_key )): ?>
			<script>gtag('config', '<?php echo $ga_key ?>');</script>
			<?php endif; ?>
			<script>
				jQuery(document).ready(function($) {
				  'use strict';
					 $("<?php echo $ga_track ?>").on('click', function(event){
						gtag('event', 'click', { 'event_category': 'Rehub button clicks', 'event_label': event.target.href });
					 });
				});
			</script>
			<?php
		endif;
	}
	
	/**
	 * Sets up the statistics page for Google Analitics.
	 */
	public function build_ga_page() {
		echo '<div class="wrap" id="wpsmcal_statistics">';
		echo '<h2>' . esc_html__( 'Google Analytics', 'wpsmcal' ) . '</h2><br>';
		require_once 'analytics.php';
	}
	
	/**
	 * Sets up the statistics page for Posts.
	 */
	public function build_post_page() {
		echo '<div class="wrap" id="wpsmcal_statistics">';
		echo '<h2>' . esc_html__( 'RH Cloak Affiliate Links Statistics', 'wpsmcal' ) . '</h2><br>';
		echo '<table class="wpsmcal_table widefat" cellspacing="0"><thead><tr>';
		echo '<th><b>'. esc_html__( 'Post name', 'wpsmcal' ) .'</b></th>';
		echo '<th><b>'. esc_html__( 'Affiliate link', 'wpsmcal' ) .'</b></th>';
		echo '<th><b>'. esc_html__( 'Users', 'wpsmcal' ) .'</b></th>';
		echo '<th><b>'. esc_html__( 'Total Clicked', 'wpsmcal' ) .'</b></th></tr></thead><tbody>';
		$postOffset = (isset($_GET['paged'])) ? $_GET['paged'] : 0;
		$perPage = $this->options['paged'];
		$args = array(
			'posts_per_page' => $perPage,
			'post_status' => 'publish',
			'orderby'   => 'meta_value_num',
			'meta_key'  => '_wpsmcal_clickthrough_count',
			'meta_compare' => 'EXISTS',
			'offset' => $postOffset,
		);
		$posts = get_posts( $args );
		foreach( $posts as $post ) {
			$print_users = $this->fetch_clickthrough_users( $post->ID );
			$print = ($print_users) ? $print_users : '';
			echo '<tr>';
			echo '<td>'. $post->post_title .'</td>';
			echo '<td>'. get_post_meta( $post->ID, $this->meta_name, true ) .'</td>';
			echo '<td>'. $print .'</td>';
			echo '<td>'. get_post_meta( $post->ID, '_wpsmcal_clickthrough_count', true ) .'</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
		echo '<p align="center">';
		$nextOffset = $postOffset + $perPage;
		$prevOffset = $postOffset - $perPage;
		$showPrev = ($prevOffset >= 0) ? true : false;
		$showNext = (count($posts) >= $perPage) ? true : false;
		if( $showPrev ) echo '<a href="'. admin_url( 'admin.php?page=wpsmcal-post-stat' ) .'&amp;paged='. $prevOffset .'">'. esc_html__( 'Previous', 'wpsmcal' ) .'</a>';
		if( $showPrev && $showNext ) echo ' | ';
		if( $showNext ) echo '<a href="'. admin_url( 'admin.php?page=wpsmcal-post-stat' ) .'&amp;paged='. $nextOffset .'">'. esc_html__( 'Next', 'wpsmcal' ) .'</a>';
		echo '</p></div>';
	}
	
	/**
	 * Sets up the statistics page for Users.
	 */
	public function build_user_page() {
		echo '<div class="wrap" id="wpsmcal_statistics">';
		echo '<h2>' . esc_html__( 'RH Cloak Affiliate Links Statistics', 'wpsmcal' ) . '</h2><br>';
		echo '<table class="wpsmcal_table widefat" cellspacing="0"><thead><tr>';
		echo '<th><b>'. esc_html__( 'User name', 'wpsmcal' ) .'</b></th>';
		echo '<th><b>'. esc_html__( 'Clicked date', 'wpsmcal' ) .'</b></th>';
		echo '<th><b>'. esc_html__( 'Affiliate link', 'wpsmcal' ) .'</b></th>';
		echo '<th><b>'. esc_html__( 'Total Clicked', 'wpsmcal' ) .'</b></th></tr></thead><tbody>';
		$postOffset = (isset($_GET['paged'])) ? $_GET['paged'] : 0;
		$perPage = $this->options['paged'];
		$args = array(
			'paged' => $perPage,
			'orderby'   => 'meta_value_num',
			'meta_key'  => '_wpsmcal_clickthrough_posts',
			'meta_compare' => 'EXISTS',
			'offset' => $postOffset,
		);
		$users = get_users( $args );
		foreach( $users as $user ) {
			$last_clicked = get_user_meta( $user->ID, '_wpsmcal_clickthrough_time', true );
			$print_posts = $this->fetch_clickthrough_posts( $user->ID );
			$print = ($print_posts) ? $print_posts: '';
			echo '<tr>';
			echo '<td>'. $user->display_name .'</td>';
			echo '<td>'. date( get_option( 'date_format' ), $last_clicked ) .'</td>';
			echo '<td>'. $print .'</td>';
			echo '<td>'. intval( get_user_meta( $user->ID, '_wpsmcal_clickthrough_count', true ) ) .'</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
		echo '<p align="center">';
		$nextOffset = $postOffset + $perPage;
		$prevOffset = $postOffset - $perPage;
		$showPrev = ($prevOffset >= 0) ? true : false;
		$showNext = (count($users) >= $perPage) ? true : false;
		if( $showPrev ) echo '<a href="'. admin_url( 'admin.php?page=wpsmcal-user-stat' ) .'&amp;paged='. $prevOffset .'">'. esc_html__( 'Previous', 'wpsmcal' ) .'</a>';
		if( $showPrev && $showNext ) echo ' | ';
		if( $showNext ) echo '<a href="'. admin_url( 'admin.php?page=wpsmcal-user-stat' ) .'&amp;paged='. $nextOffset .'">'. esc_html__( 'Next', 'wpsmcal' ) .'</a>';
		echo '</p></div>';
	}

	/**
	 * Clickthrough users.
	 */
	public function fetch_clickthrough_users( $post_id = '' ){
	
		$users_data = $user_names = $user_emails = array();
		$print = false;
		$action = 'display_users';

		if( isset($_POST['action']) ){
			$nonce = sanitize_text_field( $_POST['nonce'] );
		
			if ( !wp_verify_nonce($nonce, 'ajaxed-nonce') ) wp_die( 'Nope!' ); 

			if( $_POST['action'] == $action && isset($_POST['id']) ){
				$post_id = (int) $_POST['id'];
				$print = true;
			}
		}
		
		if( !$post_id ) return;
		
		$post_users = get_post_meta( $post_id, '_wpsmcal_clickthrough_users', true );
		
		if( is_array($post_users) && count($post_users) > 1 ){
			$post_users = array_reverse($post_users, true);
			unset($post_users[0]);
			$i = 0;
			foreach( $post_users as $user_id => $count ){
				$user = get_userdata( $user_id );
				if( $print ){
					$users_data[] = sprintf( '<span class="user-name">%s</span> - <span class="user-email">%s</span><br>', $user->user_login, $user->user_email );
					$user_names[] = sprintf( '<span class="user-name">%s</span><br>', $user->user_login );
					$user_emails[] = sprintf( '<span class="user-email">%s</span><br>', $user->user_email );
				}else{
					if( $i == 2 )
						break;
					$users_data[] = sprintf( '%s &lt;%s&gt; (%d)<br>', $user->user_login, $user->user_email, $count );
				}
				$i++;
			}
		}
		
		$print_users = (!empty($users_data)) ? implode( '', $users_data ) : '';
		$print_names = (!empty($user_names)) ? implode( '', $user_names ) : '';
		$print_emails = (!empty($user_emails)) ? implode( '', $user_emails ) : '';
		
		if( !$print ) {
			if( $i == 2 ){
				$print_users .= '<a href="#" onclick="return ResModalShow('. $post_id .', 0);" class="modal-init-js">'. esc_html__( 'Show all', 'wpsmcal' ) .'</a>&hellip;';
			}
			return $print_users;
		}
		
		echo '<ul class="tabs-menu clearfix"><li class="users-emails current">'. esc_html__('Users', 'wpsmcal') .'</li><li class="users">'. esc_html__('User Names', 'wpsmcal') .'</li><li class="emails">'. esc_html__('User E-mails', 'wpsmcal') .'</li></ul><div class="tabs-item users-emails clearfix" style="display:block">'. $print_users .'</div><div class="tabs-item users clearfix">'. $print_names .'</div><div class="tabs-item emails clearfix">'. $print_emails .'</div>';
		exit;
	}
	
	/**
	 * Clickthrough posts.
	 */
	public function fetch_clickthrough_posts( $user_id = '' ){
	
		$post_data = $post_names = $post_affurls = array();
		$print = false;
		$action = 'display_posts';

		if( isset($_POST['action']) ){
			$nonce = sanitize_text_field( $_POST['nonce'] );
		
			if ( !wp_verify_nonce($nonce, 'ajaxed-nonce') ) wp_die( 'Nope!' ); 

			if( $_POST['action'] == $action && isset($_POST['id']) ){
				$user_id = (int) $_POST['id'];
				$print = true;
			}
		}
		
		if( !$user_id ) return;
		
		$user_posts = get_user_meta( $user_id, '_wpsmcal_clickthrough_posts', true );
	
		if( is_array($user_posts) && count($user_posts) > 1 ){
			$user_posts = array_reverse($user_posts, true);
			unset($user_posts[0]);
			$i = 0;

			foreach( $user_posts as $post_id => $count ){
				if( is_string( $post_id ) ){
					$post_name = esc_html__('Dealstore button', 'wpsmcal');
					$post_affurl = $post_id;
				} else{
					$post = get_post( $post_id );
					
					if( !$post ) continue;

					$post_name = get_the_title( $post_id );
					$post_affurl = get_post_meta( $post_id, $this->meta_name, true );
				}

				if( $print ){
					$post_data[] = sprintf( '<span class="post-name">%s</span> - <span class="post-affurl">%s</span><br>', $post_name, $post_affurl );
					$post_names[] = sprintf( '<span class="post-name">%s</span><br>', $post_name );
					$post_affurls[] = sprintf( '<span class="post-affurl">%s</span><br>', $post_affurl );
				}else{
					if( $i == 2 )
						break;
					$post_data[] = sprintf( '%s (%d)<br>', $post_affurl, $count );
				}
				$i++;
			}
		}
		
		$print_posts = (!empty($post_data)) ? implode( '', $post_data ) : '';
		$print_names = (!empty($post_names)) ? implode( '', $post_names ) : '';
		$print_affurls = (!empty($post_affurls)) ? implode( '', $post_affurls ) : '';
		
		if( !$print ) {
			if( $i == 2 ){
				$print_posts .= '<a href="#" onclick="return ResModalShow('. $user_id .', 1);" class="modal-init-js">'. esc_html__( 'Show all', 'wpsmcal' ) .'</a>&hellip;';
			}
			return $print_posts;
		}

		echo '<ul class="tabs-menu clearfix"><li class="posts-affurls current">'. esc_html__('Posts', 'wpsmcal') .'</li><li class="titles">'. esc_html__('Post Names', 'wpsmcal') .'</li><li class="affurls">'. esc_html__('Affiliate URLs', 'wpsmcal') .'</li></ul><div class="tabs-item posts-affurls clearfix" style="display:block">'. $print_posts .'</div><div class="tabs-item titles clearfix">'. $print_names .'</div><div class="tabs-item affurls clearfix">'. $print_affurls .'</div>';
		exit;
	}
}
