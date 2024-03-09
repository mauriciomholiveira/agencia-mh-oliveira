<?php
namespace TPCore;

use TPCore\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class TP_Core_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

    public function tp_core_elementor_category($manager)
    {
        $manager->add_category(
            'tpcore',
            array(
                'title' => esc_html__('Nerko Addons', 'tpcore'),
                'icon' => 'eicon-banner',
            )
        );
    }

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'tpcore', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'tpcore-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * tp_enqueue_editor_scripts
	 */
    function tp_enqueue_editor_scripts()
    {
        wp_enqueue_style('tp-element-addons-editor', TPCORE_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
    }





	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'tpcore-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		foreach($this->tpcore_widget_list() as $widget_file_name){
			require_once( TPCORE_ELEMENTS_PATH . "/{$widget_file_name}.php" );
		}
	}

	public function tpcore_widget_list() {
		return [
			'heading',
			'tg-btn',
			'tg-separator',
			'hero-banner',
			'brand',
			'features',
			'fact',
            'about',
			'collection',
			'roadmap',
            'team',
			'newsletter',
            'faq',
			'cta',
			'footer',
		];
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}


	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

    public function register_controls(Controls_Manager $controls_Manager)
    {
        include_once(TPCORE_ADDONS_DIR . '/controls/tpgradient.php');
        $tpgradient = 'TPCore\Elementor\Controls\Group_Control_TPGradient';
        $controls_Manager->add_group_control($tpgradient::get_type(), new $tpgradient());

        include_once(TPCORE_ADDONS_DIR . '/controls/tpbggradient.php');
        $tpbggradient = 'TPCore\Elementor\Controls\Group_Control_TPBGGradient';
        $controls_Manager->add_group_control($tpbggradient::get_type(), new $tpbggradient());
    }




    public function tp_add_custom_icons_tab($tabs = array()){


        // Append new icons
        $feather_icons = array(
            'feather-activity',
            'feather-airplay',
            'feather-alert-circle',
            'feather-alert-octagon',
            'feather-alert-triangle',
            'feather-align-center',
            'feather-align-justify',
            'feather-align-left',
            'feather-align-right',
        );

        $tabs['tg-feather-icons'] = array(
            'name' => 'tg-feather-icons',
            'label' => esc_html__('Feather Icons', 'tpcore'),
            'labelIcon' => 'tp-icon',
            'prefix' => '',
            'displayPrefix' => 'tp',
            'url' => TPCORE_ADDONS_URL . 'assets/css/feather.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
        );

        // Append new icons
        $unicon_icons = array(
            'unicon-account',
            'unicon-activity',
            'unicon-add-alt',
            'unicon-add',
            'unicon-airplay-filled',
            'unicon-airplay',
            'unicon-airport-location',
            'unicon-analytics',
            'unicon-api',
            'unicon-archive',
            'unicon-area',
            'unicon-arrow-down',
            'unicon-arrow-left',
            'unicon-arrow-right',
            'unicon-caret-sort',
            'unicon-caret-up',
            'unicon-carousel-horizontal',
            'unicon-carousel-vertical',
            'unicon-categories',
            'unicon-cd-archive',
            'unicon-center-circle',
            'unicon-center-to-fit',
            'unicon-certificate',
            'unicon-chart-column',
            'unicon-chart-line-data',
            'unicon-chart-pie',
            'unicon-chart-ring',
            'unicon-chart-stacked',
            'unicon-chart-treemap',
            'unicon-chart-venn-diagram',
            'unicon-chat-bot',
            'unicon-chat-launch',
            'unicon-chat',
            'unicon-checkbox-checked',
            'unicon-checkbox',
            'unicon-checkmark-outline',
            'unicon-checkmark',
            'unicon-chevron-down',
            'unicon-chevron-left',
            'unicon-chevron-mini',
            'unicon-chevron-right',
            'unicon-chevron-sort-down',
            'unicon-chevron-sort-up',
            'unicon-chevron-sort',
            'unicon-chevron-up',
            'unicon-circle-dash',
            'unicon-circle-measurement',
            'unicon-clean',
            'unicon-close-outline',
            'unicon-close',
            'unicon-cloud-download',
            'unicon-cloud-lightning',
            'unicon-cloud-satellite',
            'unicon-cloud-upload',
            'unicon-cobb-angle',
            'unicon-code',
            'unicon-collaborate',
            'unicon-collapse-all',
            'unicon-color-palette',
            'unicon-color-switch',
            'unicon-column',
            'unicon-compare',
            'unicon-condition-point',
            'unicon-condition-wait-point',
            'unicon-container-software',
            'unicon-contour-finding',
            'unicon-contrast',
            'unicon-copy-file',
            'unicon-copy',
            'unicon-course',
            'unicon-credentials',
            'unicon-crop',
            'unicon-currency-dollar',
            'unicon-currency',
            'unicon-cursor-1',
            'unicon-cursor-2',
            'unicon-cursor-alt',
            'unicon-cursor',
            'unicon-curve-auto-colon',
            'unicon-cut-in-half',
            'unicon-cut',
            'unicon-dashboard-reference',
            'unicon-dashboard',
            'unicon-data-1',
            'unicon-data-base-alt',
            'unicon-data-base',
            'unicon-debug',
            'unicon-delete',
            'unicon-delivery-parcel',
            'unicon-delivery-truck',
            'unicon-delivery',
            'unicon-departure',
            'unicon-devices',
            'unicon-diagram',
            'unicon-dicom-overlay',
            'unicon-direct-link',
            'unicon-direction-right-01',
            'unicon-direction-straight-right',
            'unicon-direction-straight',
            'unicon-document-add',
            'unicon-document-attachment',
            'unicon-document-blank',
            'unicon-document-download',
            'unicon-dot-mark',
            'unicon-down-to-bottom',
            'unicon-download-study',
            'unicon-download',
            'unicon-drag-horizontal',
            'unicon-drag-vertical',
            'unicon-draggable',
            'unicon-draw',
            'unicon-drop-photo-filled',
            'unicon-drop-photo',
            'unicon-earth-americas',
            'unicon-earth-europe-africa',
            'unicon-earth-filled',
            'unicon-earth',
            'unicon-edge-enhancement',
            'unicon-edge-enhancement',
            'unicon-edit',
            'unicon-edt-loop',
            'unicon-email-new',
            'unicon-email',
            'unicon-enterprise',
            'unicon-erase',
            'unicon-error-outline',
            'unicon-error',
            'unicon-event-schedule',
            'unicon-event',
            'unicon-events-alt',
            'unicon-events',
            'unicon-explore',
            'unicon-eyedropper',
            'unicon-face-dissatisfied',
            'unicon-face-satisfied',
            'unicon-fade',
            'unicon-favorite-filled',
            'unicon-favorite',
            'unicon-file-storage',
            'unicon-filter-edit',
            'unicon-filter',
            'unicon-finance',
            'unicon-fingerprint-recognition',
            'unicon-fire',
            'unicon-flag-filled',
            'unicon-flag',
            'unicon-flash-filled',
            'unicon-flash',
            'unicon-flow-connection',
            'unicon-folder-add',
            'unicon-folder-shared',
            'unicon-folder',
            'unicon-folders',
            'unicon-forum',
            'unicon-game-console',
            'unicon-gamification',
            'unicon-gift',
            'unicon-globe',
            'unicon-glyph-caution-inverted',
            'unicon-glyph-caution',
            'unicon-glyph-circle-fill',
            'unicon-glyph-square-fill',
            'unicon-glyph-undefined',
            'unicon-gradient',
            'unicon-grid',
            'unicon-group-objects-new',
            'unicon-group-objects-save',
            'unicon-group-objects-save',
            'unicon-growth',
            'unicon-gui-management',
            'unicon-gui',
            'unicon-gui-management',
            'unicon-headphones',
            'unicon-headset',
            'unicon-help-filled',
            'unicon-help',
            'unicon-hole-filling',
            'unicon-home',
            'unicon-ibm-cloud-pak-security',
            'unicon-ibm-cloud-pak-security',
            'unicon-idea',
            'unicon-identification',
            'unicon-image-copy',
            'unicon-image-search-alt',
            'unicon-image-search',
            'unicon-image',
            'unicon-in-progress',
            'unicon-incomplete',
            'unicon-increase-level',
            'unicon-industry',
            'unicon-information',
            'unicon-insert-page',
            'unicon-insert-syntax',
            'unicon-integration',
            'unicon-interactive-segmentation-cursor',
            'unicon-intersect',
            'unicon-inventory-management',
            'unicon-keyboard',
            'unicon-language',
            'unicon-laptop',
            'unicon-lasso-polygon',
            'unicon-lasso',
            'unicon-launch-study-1',
            'unicon-launch-study-2',
            'unicon-launch',
            'unicon-launch',
            'unicon-legend',
            'unicon-license-draft',
            'unicon-lifesaver',
            'unicon-light-filled',
            'unicon-light',
            'unicon-lightning',
            'unicon-link',
            'unicon-list-boxes',
            'unicon-list-bulleted',
            'unicon-list-bulleted',
            'unicon-list-dropdown',
            'unicon-list-numbered',
            'unicon-list',
            'unicon-location-current',
            'unicon-location',
            'unicon-locked',
            'unicon-login',
            'unicon-logo-delicious',
            'unicon-logo-digg',
            'unicon-logo-discord',
            'unicon-logo-facebook',
            'unicon-logo-flickr',
            'unicon-logo-github',
            'unicon-logo-google',
            'unicon-logo-instagram',
            'unicon-logo-linkedin',
            'unicon-logo-livestream',
            'unicon-logo-medium',
            'unicon-logo-pinterest',
            'unicon-logo-quora',
            'unicon-logo-skype',
            'unicon-logo-slack',
            'unicon-logo-stumbleupon',
            'unicon-logo-tumblr',
            'unicon-logo-vmware',
            'unicon-logo-xing',
            'unicon-logo-youtube',
            'unicon-logout',
            'unicon-mac-command',
            'unicon-mac-option',
            'unicon-mac-shift',
            'unicon-machine-learning',
            'unicon-magic-wand-filled',
            'unicon-magic-wand',
            'unicon-magnify',
            'unicon-manage-protection',
            'unicon-map-center',
            'unicon-map-identify',
            'unicon-map',
            'unicon-maximize',
            'unicon-media-cast',
            'unicon-media-library',
            'unicon-menu',
            'unicon-meter-alt',
            'unicon-meter',
            'unicon-microphone-filled',
            'unicon-microphone',
            'unicon-migrate-alt',
            'unicon-military-camp',
            'unicon-minimize',
            'unicon-misuse-alt',
            'unicon-misuse-outline',
            'unicon-misuse',
            'unicon-mobile-add',
            'unicon-mobile',
            'unicon-model-alt',
            'unicon-model',
            'unicon-money',
            'unicon-move',
            'unicon-mpr-toggle',
            'unicon-music',
            'unicon-name-space',
            'unicon-navaid-military',
            'unicon-new-tab',
            'unicon-nominal',
            'unicon-not-available',
            'unicon-notebook-reference',
            'unicon-notebook',
            'unicon-notification-filled',
            'unicon-notification-new',
            'unicon-notification',
            'unicon-opacity',
            'unicon-open-panel-left',
            'unicon-open-panel-top',
            'unicon-ordinal',
            'unicon-overflow-menu-horizontal',
            'unicon-overflow-menu-vertical',
            'unicon-overlay',
            'unicon-package',
            'unicon-page-break',
            'unicon-paint-brush-alt',
            'unicon-paint-brush',
            'unicon-pan-horizontal',
            'unicon-pan-vertical',
            'unicon-panel-expansion',
            'unicon-partnership',
            'unicon-password',
            'unicon-pause',
            'unicon-pedestrian-child',
            'unicon-pedestrian-family',
            'unicon-pen-fountain',
            'unicon-pen',
            'unicon-pending',
            'unicon-percentage-filled',
            'unicon-percentage',
            'unicon-phone-ip',
            'unicon-phone',
            'unicon-piggy-bank-slot',
            'unicon-piggy-bank',
            'unicon-pin-filled',
            'unicon-pin',
            'unicon-plane',
            'unicon-play-filled-alt',
            'unicon-play-filled',
            'unicon-play-outline',
            'unicon-play',
            'unicon-policy',
            'unicon-popup',
            'unicon-portfolio',
            'unicon-power',
            'unicon-presentation-file',
            'unicon-printer',
            'unicon-product',
            'unicon-progress-bar',
            'unicon-purchase',
            'unicon-query',
            'unicon-quotes',
            'unicon-radio-button-checked',
            'unicon-radio-button',
            'unicon-rain-drop',
            'unicon-receipt',
            'unicon-recently-viewed',
            'unicon-recommend',
            'unicon-recording-filled-alt',
            'unicon-recording-filled',
            'unicon-recording',
            'unicon-redo',
            'unicon-registration',
            'unicon-reminder',
            'unicon-reminder',
            'unicon-reply-all',
            'unicon-reply',
            'unicon-report-data',
            'unicon-report',
            'unicon-request-quote',
            'unicon-reset-alt',
            'unicon-reset',
            'unicon-restart',
            'unicon-result',
            'unicon-roadmap',
            'unicon-rocket',
            'unicon-rotate-180',
            'unicon-rotate-360',
            'unicon-row',
            'unicon-rss',
            'unicon-rule',
            'unicon-ruler-alt',
            'unicon-ruler',
            'unicon-run',
            'unicon-save',
            'unicon-scale',
            'unicon-scales',
            'unicon-scalpel-cursor',
            'unicon-scalpel-lasso',
            'unicon-scalpel',
            'unicon-scan',
            'unicon-screen',
            'unicon-script',
            'unicon-search-locate',
            'unicon-search',
            'unicon-security',
            'unicon-select-01',
            'unicon-select-02',
            'unicon-select-window',
            'unicon-send-alt-filled',
            'unicon-send-alt',
            'unicon-send-filled',
            'unicon-send-to-back',
            'unicon-send',
            'unicon-server-time',
            'unicon-settings-adjust',
            'unicon-settings',
            'unicon-shape-except',
            'unicon-share',
            'unicon-shopping-bag',
            'unicon-shopping-cart',
            'unicon-shopping-catalog',
            'unicon-shrink-screen',
            'unicon-shuffle',
            'unicon-signal-strength',
            'unicon-skill-level',
            'unicon-smoothing-cursor',
            'unicon-smoothing',
            'unicon-soccer',
            'unicon-software',
            'unicon-spell-check',
            'unicon-split-discard',
            'unicon-split-screen',
            'unicon-split',
            'unicon-spray-paint',
            'unicon-stacked-scrolling-1',
            'unicon-stamp',
            'unicon-star-filled',
            'unicon-star',
            'unicon-stay-inside',
            'unicon-stop-filled-alt',
            'unicon-stop',
            'unicon-store',
            'unicon-string-integer',
            'unicon-string-text',
            'unicon-sub-volume',
            'unicon-subtract-alt',
            'unicon-subtract',
            'unicon-table',
            'unicon-tablet',
            'unicon-tag-group',
            'unicon-tag',
            'unicon-task-add',
            'unicon-task-approved',
            'unicon-task-view',
            'unicon-task',
            'unicon-template',
            'unicon-term',
            'unicon-terminal',
            'unicon-text-annotation-toggle',
            'unicon-text-bold',
            'unicon-text-color',
            'unicon-text-creation',
            'unicon-text-fill',
            'unicon-text-font',
            'unicon-text-line-spacing',
            'unicon-text-mining-applier',
            'unicon-text-mining',
            'unicon-text-underline',
            'unicon-theater',
            'unicon-thumbnail-1',
            'unicon-thumbnail-2',
            'unicon-thumbs-down',
            'unicon-thumbs-up',
            'unicon-ticket',
            'unicon-time',
            'unicon-tool-box',
            'unicon-tools-alt',
            'unicon-tools',
            'unicon-touch-1',
            'unicon-touch-interaction',
            'unicon-translate',
            'unicon-trash-can',
            'unicon-trophy',
            'unicon-types',
            'unicon-umbrella',
            'unicon-unlink',
            'unicon-unlocked',
            'unicon-upload',
            'unicon-user-avatar-filled-alt',
            'unicon-user-avatar-filled',
            'unicon-user-avatar',
            'unicon-user-multiple',
            'unicon-user',
            'unicon-uv-index',
            'unicon-video-add',
            'unicon-video-chat',
            'unicon-video',
            'unicon-view-filled',
            'unicon-view-mode-1',
            'unicon-view-mode-2',
            'unicon-view-next',
            'unicon-view-off',
            'unicon-view',
            'unicon-virtual-column-key',
            'unicon-virtual-private-cloud-alt',
            'unicon-visual-recognition',
            'unicon-volume-block-storage',
            'unicon-volume-up',
            'unicon-wallet',
            'unicon-warning-alt-filled',
            'unicon-warning-alt',
            'unicon-warning-filled',
            'unicon-warning',
            'unicon-wheat',
            'unicon-wifi',
            'unicon-wikis',
            'unicon-word-cloud',
            'unicon-workspace',
            'unicon-zoom-area',
            'unicon-zoom-in-area',
            'unicon-zoom-in',
            'unicon-zoom-out-area',
            'unicon-zoom-out',
            'unicon-zoom-reset',
        );

        $tabs['tg-unicons-icons'] = array(
            'name' => 'tg-unicons-icons',
            'label' => esc_html__('Unicons Icons', 'tpcore'),
            'labelIcon' => 'tp-icon',
            'prefix' => '',
            'displayPrefix' => 'tp',
            'url' => TPCORE_ADDONS_URL . 'assets/css/unicons.css',
            'icons' => $unicon_icons,
            'ver' => '1.0.0',
        );

        // Append new icons
        $flat_icons = array(
            'flaticon-menu',
            'flaticon-menu-1',
            'flaticon-dots-menu',
            'flaticon-menu-2',
            'flaticon-close',
            'flaticon-close-1',
            'flaticon-arrowhead-up',
            'flaticon-arrow-up',
            'flaticon-plus',
            'flaticon-minus-sign',
        );

        $tabs['tg-flat-icons'] = array(
            'name' => 'tg-flat-icons',
            'label' => esc_html__('Flat Icons', 'tpcore'),
            'labelIcon' => 'tp-icon',
            'prefix' => '',
            'displayPrefix' => 'tp',
            'url' => TPCORE_ADDONS_URL . 'assets/css/default-icons.css',
            'icons' => $flat_icons,
            'ver' => '1.0.0',
        );

        $fontAwesome_icons = array(
	        'angle-up',
	        'check',
	        'times',
	        'calendar',
	        'language',
	        'shopping-cart',
	        'bars',
	        'search',
	        'map-marker',
	        'arrow-right',
	        'arrow-left',
	        'arrow-up',
	        'arrow-down',
	        'angle-right',
	        'angle-left',
	        'angle-up',
	        'angle-down',
	        'phone',
	        'users',
	        'user',
	        'map-marked-alt',
	        'trophy-alt',
	        'envelope',
	        'marker',
	        'globe',
	        'broom',
	        'home',
	        'bed',
	        'chair',
	        'bath',
	        'tree',
	        'laptop-code',
	        'cube',
	        'cog',
	        'play',
	        'trophy-alt',
	        'heart',
	        'truck',
	        'user-circle',
	        'map-marker-alt',
	        'comments',
	        'award',
	        'bell',
	        'book-alt',
	        'book-open',
	        'book-reader',
	        'graduation-cap',
	        'laptop-code',
	        'music',
	        'ruler-triangle',
	        'user-graduate',
	        'microscope',
	        'glasses-alt',
	        'theater-masks',
	        'atom'
        );

        $tabs['tg-fontawesome-icons'] = array(
            'name' => 'tg-fontawesome-icons',
            'label' => esc_html__('Fontawesome Pro!', 'tpcore'),
            'labelIcon' => 'tp-icon',
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'url' => TPCORE_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
            'icons' => $fontAwesome_icons,
            'ver' => '1.0.0',
        );

        return $tabs;
    }


	// campaign_template_fun
	public function campaign_template_fun( $campaign_template ) {

	    if ( ( get_post_type() == 'campaign' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-campaign.php';
	        $campaign_template           = $campaign_template_file_path;
	    }
	    if ( ( get_post_type() == 'tribe_events' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-event.php';
	        $campaign_template           = $campaign_template_file_path;
	    }

	    if ( ! $campaign_template ) {
	        return $campaign_template;
	    }
	    return $campaign_template;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		add_action('elementor/elements/categories_registered', [$this, 'tp_core_elementor_category']);

		// Register custom controls
	    add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

	    add_filter('elementor/icons_manager/additional_tabs', [$this, 'tp_add_custom_icons_tab']);

	    // $this->tp_add_custom_icons_tab();

	    add_action('elementor/editor/after_enqueue_scripts', [$this, 'tp_enqueue_editor_scripts'] );

	    add_filter( 'template_include', [ $this, 'campaign_template_fun' ], 99 );

		$this->add_page_settings_controls();

	}


}

// Instantiate Plugin Class
TP_Core_Plugin::instance();