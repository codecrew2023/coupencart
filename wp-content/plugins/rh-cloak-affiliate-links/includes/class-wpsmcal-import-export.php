<?php
if ( !defined( 'WPINC' ) ) die;

/**
 * Class Wpsmcal_ImportExport
 *
 * @package RH Link
 */
 
class Wpsmcal_ImportExport extends Wpsmcal {
    /**
	 * Class constructor. Includes essential files and initializes the class attributes.
	 **/
	public function __construct( $version, $options ) {
		$this->version = $version;
		$this->wpsmcal_options = $options;
		$this->options = $this->load_options();
		$rewrites = get_option( 'wpsmcal_rewrites', false );
		//var_dump($rewrites);
	}

	/**
	 * Registers the actions of this class with WordPress.
	 */
	public function add_actions(){
		add_action( 'admin_init', array($this, 'create_options' ), 11 );
		add_action( 'wp_ajax_wpsmcal_import', array($this, 'make_import' ) );
		add_action( 'wp_ajax_wpsmcal_export', array($this, 'make_export' ) );
	}

	/**
	 * Adds settings fields.
	 */
	public function create_options(){
		$fields = $this->get_settings_fields();
		foreach( $fields as $key => $value ){
			add_settings_field( $value['slug'], $value['name'], $value['callback'], $value['page'], $value['section'] );
		}
	}

	/**
	 * Fields of the Settings page
	 */
	public function get_settings_fields() {
		return array(
			array(
				'slug' => 'import_options',
				'name' => esc_html__( 'Import options', 'wpsmcal' ),
				'callback' => array( $this, 'render_import' ),
				'page' => 'wpsmcal-rewrites',
				'section' => 'rewrite_settings',
			),
			array(
				'slug' => 'export_options',
				'name' => esc_html__( 'Export options', 'wpsmcal' ),
				'callback' => array( $this, 'render_export' ),
				'page' => 'wpsmcal-rewrites',
				'section' => 'rewrite_settings',
			)
		);
	}

	/**
	 * Render import
	 */
	public function render_import() { ?>
		<div class="wpsmcal-ie-box">
			<textarea id="wpsmcal-import-field" rows="5" style="width:100%;"></textarea>
			<div class="wpsmcal-ie-box-footer">
				<button id="wpsmcal-import-submit" class='button' type="button"><?php esc_html_e( 'Import', 'wpsmcal' ); ?></button>
				<div class="wpsmcal-ie-note" id="wpsmcal-import-note"></div>
			</div>
		</div>
	<?php }

	/**
	 * Render Export
	 */
	public function render_export() { ?>
		<div class="wpsmcal-ie-box">
			<textarea id="wpsmcal-export-field" rows="5" style="width:100%;"></textarea>
			<div class="wpsmcal-ie-box-footer">
				<button id="wpsmcal-export-submit" class='button' type="button"><?php esc_html_e( 'Export', 'wpsmcal' ); ?></button>
				<div class="wpsmcal-ie-note" id="wpsmcal-export-note"></div>
			</div>
		</div>
	<?php }

	public function make_import() {
		check_ajax_referer( 'ajaxed-nonce', 'nonce' );
		$data = $_POST['data'];

		$opts = array (
			'ractive' 			=> ! empty( $data['ractive'] ) ? filter_var( $data['ractive'], FILTER_SANITIZE_STRING ) : 'yes',
			'rewrite_fields' 	=> ! empty( $data['rewrite_fields'] ) ? $this->sanitize_rewrite_fields( $data['rewrite_fields'] ) : '',
		);

		$result = update_option( 'wpsmcal_rewrites', $opts );
		wp_send_json_success( $result );
	}

	public function make_export() {
		check_ajax_referer( 'ajaxed-nonce', 'nonce' );
		$rewrites = json_encode( get_option( 'wpsmcal_rewrites', false ) );

		wp_send_json_success( $rewrites );
	}

	protected function sanitize_rewrite_fields( $fields ){
		$santized = array();
		foreach( $fields as $i => $field ){
			$santized[$i] = filter_var_array( $field, [
				'checkdomain' => FILTER_VALIDATE_DOMAIN,
				'afftag' => FILTER_SANITIZE_STRING,
				'affstring' => FILTER_SANITIZE_STRING,
				'random' =>  FILTER_VALIDATE_INT,
				'aff_move' => FILTER_SANITIZE_STRING,
				'roles_rewrite' => array(
					'filter' => FILTER_VALIDATE_INT,
					'flags'  => FILTER_REQUIRE_ARRAY,
				)
			] );
		}
		return $santized;
	}
}