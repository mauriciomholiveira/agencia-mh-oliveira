<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nerko Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TG_Hero_Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hero-banner';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Hero Banner', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tg_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _tg_image
        $this->start_controls_section(
            '_tg_bg_section',
            [
                'label' => esc_html__('Section Background', 'tpcore'),
                'condition' => [
                    'tg_design_style!' => 'layout-4',
                ]
            ]
        );

        $this->add_control(
            'tg_bg',
            [
                'label' => esc_html__( 'Choose Background Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_bg_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Supercharge your NFT Adventure', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Find the right NFT collections to buy within the platform.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
                'condition' => [
                    'tg_design_style!' => 'layout-4',
                ]
            ]
        );

        $this->add_control(
            'tg_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        // tg_btn_button_group
        $this->start_controls_section(
            'tg_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'tg_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View in OPENSEA', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tg_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tg_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tg_btn_link',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tg_btn_link_type' => '1',
                    'tg_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tg_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tg_btn_link_type' => '2',
                    'tg_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // tg_button_group
        $this->start_controls_section(
            'tg_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'condition' => [
                    'tg_design_style!' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'tg_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_btn_text2',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Browse collection', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tg_btn_link_type2',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tg_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tg_btn_link2',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tg_btn_link_type2' => '1',
                    'tg_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tg_btn_page_link2',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tg_btn_link_type2' => '2',
                    'tg_button_show' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // Content Separator
        $this->start_controls_section(
            'tg_banner_separator',
            [
                'label' => esc_html__('Separator Shape', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-4',
                ]
            ]
        );

        $this->add_control(
            'tg_separator_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Choose Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'separator_size',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        // Banner Fact
        $this->start_controls_section(
            '_tg_banner_fact',
            [
                'label' => esc_html__('Banner Fact', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-4',
                ]
            ]
        );

        $this->add_control(
            'tg_hide_fact',
            [
                'label' => esc_html__( 'Hide Banner Fact?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $fact = new \Elementor\Repeater();

        $fact->add_control(
            'tg_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('2k+', 'tpcore'),
                'label_block' => true,
            ]
        );

        $fact->add_control(
            'tg_fact_desc',
            [
                'label' => esc_html__('Fact Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Collection items', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_fact_list',
            [
                'label' => esc_html__('Fact Lists', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $fact->get_controls(),
                'default' => [
                    [
                        'tg_fact_number' => esc_html__('2k+', 'tpcore'),
                        'tg_fact_desc' => esc_html__('Collection items', 'tpcore'),
                    ],
                    [
                        'tg_fact_number' => esc_html__('0.55', 'tpcore'),
                        'tg_fact_desc' => esc_html__('Floor price (eth)', 'tpcore'),
                    ],
                    [
                        'tg_fact_number' => esc_html__('2.5x', 'tpcore'),
                        'tg_fact_desc' => esc_html__('Estimated value', 'tpcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Community
        $this->start_controls_section(
            'tg_community_section',
            [
                'label' => __( 'Banner Community', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tg_community_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Choose Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tg_community_items',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_community_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tg_community_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tg_community_member',
            [
                'label' => esc_html__('Total Member', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('47k+', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_community_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Community members', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        // _banner_shape
        $this->start_controls_section(
            '_tg_left_shape_section',
            [
                'label' => esc_html__('Content Shapes', 'tpcore'),
                'condition' => [
                    'tg_design_style!' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'tp_content_shapes_show',
            [
                'label' => esc_html__( 'Hide Shapes', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_shape_image01',
            [
                'label' => esc_html__( 'Choose top shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image02',
            [
                'label' => esc_html__( 'Choose middle shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image03',
            [
                'label' => esc_html__( 'Choose bottom shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image04',
            [
                'label' => esc_html__( 'Choose bottom left shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => 'layout-2',
                ]
            ]
        );

        $this->add_control(
            'tg_shape_image05',
            [
                'label' => esc_html__( 'Choose bottom right shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => 'layout-2',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_shape_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();


        // _tg_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('Thumbnail', 'tpcore'),
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-4'],
                ]
            ]
        );

        $this->add_control(
            'tg_first_image',
            [
                'label' => esc_html__( 'Choose First Image', 'tpcore' ),
                'description' => esc_html__( 'Image size 600 x 800 would be better', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_second_image',
            [
                'label' => esc_html__( 'Choose Second Image', 'tpcore' ),
                'description' => esc_html__( 'Image size 600 x 800 would be better', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();


        // _tg_slider
        $this->start_controls_section(
            '_tg_slider_section',
            [
                'label' => esc_html__('Slider Collection', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-4',
                ]
            ]
        );

        $this->add_control(
            'tg_hide_arrow',
            [
                'label' => esc_html__( 'Hide Slider Arrow?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_hide_dots',
            [
                'label' => esc_html__( 'Hide Slider Dots?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $slider = new \Elementor\Repeater();

        $slider->add_control(
            'tg_slider_image',
            [
                'label' => esc_html__( 'Choose Slider Image', 'tpcore' ),
                'description' => esc_html__( 'Image size 600 x 800 would be better', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $slider->add_control(
            'collection_link', [
                'label' => esc_html__('Collection Item Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_collection_slides',
            [
                'title_field' => esc_html__( 'Collection Items', 'tpcore' ),
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $slider->get_controls(),
                'default' => [
                    [
                        'tg_slider_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tg_slider_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_slider_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        // _banner_right_shape
        $this->start_controls_section(
            '_tg_right_shape_section',
            [
                'label' => esc_html__('Thumbnail Shapes', 'tpcore'),
                'condition' => [
                    'tg_design_style!' => 'layout-2',
                ]
            ]
        );

        $this->add_control(
            'tp_images_shapes_show',
            [
                'label' => esc_html__( 'Hide Shapes', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_image_shape01',
            [
                'label' => esc_html__( 'Choose shape 01', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_image_shape02',
            [
                'label' => esc_html__( 'Choose shape 02', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_image_shape03',
            [
                'label' => esc_html__( 'Choose shape 03', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'tg_image_shape04',
            [
                'label' => esc_html__( 'Choose shape 04', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'tg_image_shape05',
            [
                'label' => esc_html__( 'Choose shape 05', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'tg_image_shape06',
            [
                'label' => esc_html__( 'Choose shape 06', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_image_shape_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        // _banner_circle_text
        $this->start_controls_section(
            '_tg_banner_circle_section',
            [
                'label' => esc_html__('Circle Content', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'circle_text',
            [
                'label' => esc_html__('Enter your circle text here', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('view in opensea • view in opensea •', 'tpcore'),
                'placeholder' => esc_html__('Type circle Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_circle_link_type',
            [
                'label' => esc_html__('Circle Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tg_circle_link',
            [
                'label' => esc_html__('Circle external link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tg_circle_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tg_circle_page_link',
            [
                'label' => esc_html__('Select Link Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tg_circle_link_type' => '2',
                ]
            ]
        );

        $this->end_controls_section();


		// TAB_STYLE
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'tpcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'tpcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'tpcore' ),
					'uppercase' => __( 'UPPERCASE', 'tpcore' ),
					'lowercase' => __( 'lowercase', 'tpcore' ),
					'capitalize' => __( 'Capitalize', 'tpcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        if ( !empty($settings['tg_bg']['url']) ) {
            $tg_bg_url = !empty($settings['tg_bg']['id']) ? wp_get_attachment_image_url( $settings['tg_bg']['id'], $settings['tg_bg_size_size']) : $settings['tg_bg']['url'];
            $tg_bg_alt = get_post_meta($settings["tg_bg"]["id"], "_wp_attachment_image_alt", true);
        }

		?>

		<?php if ( $settings['tg_design_style']  == 'layout-2' ):

            // All Shapes
            if ( !empty($settings['tg_shape_image01']['url']) ) {
                $tg_shape_image01 = !empty($settings['tg_shape_image01']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image01']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image01']['url'];
                $tg_shape_alt01  = get_post_meta($settings["tg_shape_image01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image02']['url']) ) {
                $tg_shape_image02 = !empty($settings['tg_shape_image02']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image02']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image02']['url'];
                $tg_shape_alt02  = get_post_meta($settings["tg_shape_image02"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image03']['url']) ) {
                $tg_shape_image03 = !empty($settings['tg_shape_image03']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image03']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image03']['url'];
                $tg_shape_alt03  = get_post_meta($settings["tg_shape_image03"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image04']['url']) ) {
                $tg_shape_image04 = !empty($settings['tg_shape_image04']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image04']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image04']['url'];
                $tg_shape_alt04  = get_post_meta($settings["tg_shape_image04"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image05']['url']) ) {
                $tg_shape_image05 = !empty($settings['tg_shape_image05']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image05']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image05']['url'];
                $tg_shape_alt05  = get_post_meta($settings["tg_shape_image05"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['tg_btn_link_type2']) {
                $this->add_render_attribute('tg-button-arg2', 'href', get_permalink($settings['tg_btn_page_link2']));
                $this->add_render_attribute('tg-button-arg2', 'target', '_self');
                $this->add_render_attribute('tg-button-arg2', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg2', 'class', 'banner__btn btn gradient-btn gradient-btn-2');
            } else {
                if ( ! empty( $settings['tg_btn_link2']['url'] ) ) {
                    $this->add_link_attributes( 'tg-button-arg2', $settings['tg_btn_link2'] );
                    $this->add_render_attribute('tg-button-arg2', 'class', 'banner__btn btn gradient-btn gradient-btn-2');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <script>
                jQuery(document).ready(function($){
                    $("[data-background]").each(function () {
                        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
                    })
                });
            </script>

            <!-- banner-area -->
            <section id="home" class="banner-area banner-style-two position-relative">
                <div class="banner__background-wrap">
                    <div class="background" data-background="<?php echo esc_url($tg_bg_url); ?>"></div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-9">
                            <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                            <div class="banner__content-two" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">

                                <?php if(!empty( $settings['tp_content_shapes_show']) ) : ?>

                                    <?php if(!empty( $tg_shape_image01 )) : ?>
                                    <img class="top-left" src="<?php echo esc_url($tg_shape_image01); ?>" width="44" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: -20%; left: 50%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_shape_image02 )) : ?>
                                    <img class="top-right" src="<?php echo esc_url($tg_shape_image02); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: 20%; right: -20%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 420;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_shape_image03 )) : ?>
                                    <img class="left-align" src="<?php echo esc_url($tg_shape_image03); ?>" width="16" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="top: 16%; left: -16%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 420;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_shape_image04 )) : ?>
                                    <img class="bottom-left" src="<?php echo esc_url($tg_shape_image04); ?>" width="44" alt="<?php echo esc_attr($tg_shape_alt04); ?>" style="bottom: -16%; left: 16%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 440;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_shape_image05 )) : ?>
                                    <img class="bottom-right" src="<?php echo esc_url($tg_shape_image05); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt05); ?>" style="bottom: -16%; right: 16%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 440;">
                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php
                                    if ( !empty($settings['tg_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tg_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tg_title' ] )
                                    );
                                endif;
                                ?>

                                <?php if ( !empty($settings['tg_description']) ) : ?>
                                <p class="desc"><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                <?php endif; ?>

                                <?php if(!empty( $settings['tg_button_show'] )) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'tg-button-arg2' ); ?>>
                                        <span><?php echo $settings['tg_btn_text2']; ?></span>
                                    </a>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-area-end -->

		<?php elseif ( $settings['tg_design_style']  == 'layout-3' ):

            if ( !empty($settings['tg_first_image']['url']) ) {
                $tg_first_image = !empty($settings['tg_first_image']['id']) ? wp_get_attachment_image_url( $settings['tg_first_image']['id'], $settings['tg_image_size_size']) : $settings['tg_first_image']['url'];
                $tg_first_image_alt  = get_post_meta($settings["tg_first_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_second_image']['url']) ) {
                $tg_second_image = !empty($settings['tg_second_image']['id']) ? wp_get_attachment_image_url( $settings['tg_second_image']['id'], $settings['tg_image_size_size']) : $settings['tg_second_image']['url'];
                $tg_second_image_alt  = get_post_meta($settings["tg_second_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Shapes
            if ( !empty($settings['tg_image_shape01']['url']) ) {
                $tg_image_shape01 = !empty($settings['tg_image_shape01']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape01']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape01']['url'];
                $tg_image_shape_alt01  = get_post_meta($settings["tg_image_shape01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape02']['url']) ) {
                $tg_image_shape02 = !empty($settings['tg_image_shape02']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape02']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape02']['url'];
                $tg_image_shape_alt02  = get_post_meta($settings["tg_image_shape02"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape03']['url']) ) {
                $tg_image_shape03 = !empty($settings['tg_image_shape03']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape03']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape03']['url'];
                $tg_image_shape_alt03  = get_post_meta($settings["tg_image_shape03"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape04']['url']) ) {
                $tg_image_shape04 = !empty($settings['tg_image_shape04']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape04']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape04']['url'];
                $tg_image_shape_alt04  = get_post_meta($settings["tg_image_shape04"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape05']['url']) ) {
                $tg_image_shape05 = !empty($settings['tg_image_shape05']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape05']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape05']['url'];
                $tg_image_shape_alt05  = get_post_meta($settings["tg_image_shape05"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape06']['url']) ) {
                $tg_image_shape06 = !empty($settings['tg_image_shape06']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape06']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape06']['url'];
                $tg_image_shape_alt06  = get_post_meta($settings["tg_image_shape06"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['tg_btn_link_type2']) {
                $this->add_render_attribute('tg-button-arg2', 'href', get_permalink($settings['tg_btn_page_link2']));
                $this->add_render_attribute('tg-button-arg2', 'target', '_self');
                $this->add_render_attribute('tg-button-arg2', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg2', 'class', 'banner__btn btn gradient-btn gradient-btn-2');
            } else {
                if ( ! empty( $settings['tg_btn_link2']['url'] ) ) {
                    $this->add_link_attributes( 'tg-button-arg2', $settings['tg_btn_link2'] );
                    $this->add_render_attribute('tg-button-arg2', 'class', 'banner__btn btn gradient-btn gradient-btn-2');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <script>
                jQuery(document).ready(function($){
                    $("[data-background]").each(function () {
                        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
                    })
                });
            </script>

            <!-- banner-area -->
            <section id="home" class="banner-area banner-style-three position-relative">
                <div class="banner__background-wrap">
                    <div class="background" data-background="<?php echo esc_url( $tg_bg_url ); ?>"></div>
                </div>
                <div class="banner__three-inner">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">

                            <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                            <div class="col-lg-6">
                                <div class="banner__content" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">

                                    <?php
                                        if ( !empty($settings['tg_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tg_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tg_title' ] )
                                        );
                                    endif;
                                    ?>

                                    <?php if ( !empty($settings['tg_description']) ) : ?>
                                    <p class="desc"><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['tg_button_show'] )) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'tg-button-arg2' ); ?>>
                                            <span><?php echo $settings['tg_btn_text2']; ?></span> <i class="unicon-arrow-up-right"></i>
                                        </a>
                                    <?php endif; ?>

                                    <div class="banner__community">
                                        <ul class="list-wrap banner__community-members">

                                            <?php foreach ($settings['tg_community_items'] as $item) :
                                                if ( !empty($item['tg_community_image']['url']) ) {
                                                    $tg_community_image_url = !empty($item['tg_community_image']['id']) ? wp_get_attachment_image_url( $item['tg_community_image']['id'], $settings['thumbnail_size']) : $item['tg_community_image']['url'];
                                                    $tg_community_image_alt = get_post_meta($item["tg_community_image"]["id"], "_wp_attachment_image_alt", true);
                                                }
                                            ?>
                                            <li><img src="<?php echo esc_url($tg_community_image_url); ?>" width="48" alt="<?php echo esc_attr($tg_community_image_alt); ?>"></li>
                                            <?php endforeach; ?>

                                        </ul>

                                        <?php if(!empty( $settings['tg_community_member'] || $settings['tg_community_description'] )) : ?>
                                        <div class="banner__community-numbers">

                                            <?php if(!empty( $settings['tg_community_member'] )) : ?>
                                            <h5 class="count"><?php echo esc_html( $settings['tg_community_member'] ); ?></h5>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['tg_community_description'] )) : ?>
                                                <span><?php echo esc_html( $settings['tg_community_description'] ); ?></span>
                                            <?php endif; ?>

                                        </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-6">
                                <div class="banner__images-two" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">

                                    <?php if(!empty( $settings['tp_images_shapes_show']) ) : ?>

                                        <?php if(!empty( $tg_image_shape01 )) : ?>
                                        <img class="shape-one" width="40" src="<?php echo esc_url($tg_image_shape01); ?>" alt="<?php echo esc_attr($tg_image_shape_alt01); ?>" style="top: -8%; right: 40%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_image_shape02 )) : ?>
                                        <img class="shape-two" width="64" src="<?php echo esc_url($tg_image_shape02); ?>" alt="<?php echo esc_attr($tg_image_shape_alt02); ?>" style="top: 24%; right: 24%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_image_shape03 )) : ?>
                                        <img class="shape-three" width="80" src="<?php echo esc_url($tg_image_shape03); ?>" alt="<?php echo esc_attr($tg_image_shape_alt03); ?>" style="top: 0%; right: 0%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_image_shape04 )) : ?>
                                        <img class="shape-four" width="40" src="<?php echo esc_url($tg_image_shape04); ?>" alt="<?php echo esc_attr($tg_image_shape_alt04); ?>" style="bottom: 16%; left: -8%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_image_shape05 )) : ?>
                                        <img class="shape-five" width="64" src="<?php echo esc_url($tg_image_shape05); ?>" alt="<?php echo esc_attr($tg_image_shape_alt05); ?>" style="bottom: 24%; left: 10%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_image_shape06 )) : ?>
                                        <img class="shape-six" width="80" src="<?php echo esc_url($tg_image_shape06); ?>" alt="<?php echo esc_attr($tg_image_shape_alt06); ?>" style="bottom: 0%; left: 24%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <div class="banner__images-grid-two">
                                        <?php if(!empty( $tg_first_image )) : ?>
                                        <div class="image-grid-item" style="transform: rotate(10.84deg)">
                                            <div class="main-image">
                                                <canvas width="272" height="272"></canvas>
                                                <img src="<?php echo esc_url( $tg_first_image ); ?>" alt="<?php echo esc_attr($tg_first_image_alt); ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="image-grid-item">
                                            <div class="main-image">
                                                <canvas width="272" height="272"></canvas>
                                            </div>
                                        </div>
                                        <div class="image-grid-item">
                                            <div class="main-image">
                                                <canvas width="272" height="272"></canvas>
                                            </div>
                                        </div>
                                        <?php if(!empty( $tg_second_image )) : ?>
                                        <div class="image-grid-item" style="transform: rotate(-10.25deg)">
                                            <div class="main-image">
                                                <canvas width="272" height="272"></canvas>
                                                <img src="<?php echo esc_url( $tg_second_image ); ?>" alt="<?php echo esc_attr($tg_second_image_alt); ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-area-end -->

        <?php elseif ( $settings['tg_design_style']  == 'layout-4' ):

            // separator
            if ( !empty($settings['tg_separator_image']['url']) ) {
                $tg_separator_image_url = !empty($settings['tg_separator_image']['id']) ? wp_get_attachment_image_url( $settings['tg_separator_image']['id'], $settings['separator_size_size']) : $settings['tg_separator_image']['url'];
                $tg_separator_image_alt = get_post_meta($settings["tg_separator_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Shapes
            if ( !empty($settings['tg_shape_image01']['url']) ) {
                $tg_shape_image01 = !empty($settings['tg_shape_image01']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image01']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image01']['url'];
                $tg_shape_alt01  = get_post_meta($settings["tg_shape_image01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image02']['url']) ) {
                $tg_shape_image02 = !empty($settings['tg_shape_image02']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image02']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image02']['url'];
                $tg_shape_alt02  = get_post_meta($settings["tg_shape_image02"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image03']['url']) ) {
                $tg_shape_image03 = !empty($settings['tg_shape_image03']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image03']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image03']['url'];
                $tg_shape_alt03  = get_post_meta($settings["tg_shape_image03"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape01']['url']) ) {
                $tg_image_shape01 = !empty($settings['tg_image_shape01']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape01']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape01']['url'];
                $tg_image_shape_alt01  = get_post_meta($settings["tg_image_shape01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape02']['url']) ) {
                $tg_image_shape02 = !empty($settings['tg_image_shape02']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape02']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape02']['url'];
                $tg_image_shape_alt02  = get_post_meta($settings["tg_image_shape02"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['tg_btn_link_type2']) {
                $this->add_render_attribute('tg-button-arg3', 'href', get_permalink($settings['tg_btn_page_link2']));
                $this->add_render_attribute('tg-button-arg3', 'target', '_self');
                $this->add_render_attribute('tg-button-arg3', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg3', 'class', 'banner__btn btn gradient-btn gradient-btn-2');
            } else {
                if ( ! empty( $settings['tg_btn_link2']['url'] ) ) {
                    $this->add_link_attributes( 'tg-button-arg3', $settings['tg_btn_link2'] );
                    $this->add_render_attribute('tg-button-arg3', 'class', 'banner__btn btn gradient-btn gradient-btn-2');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'title text-uppercase');

        ?>

            <script>
                jQuery(document).ready(function($){

                    /*=============================================
                        =        Banner Active		      =
                    =============================================*/
                    var bannerSwiper = new Swiper('.banner__collection-active', {
                        // Optional parameters
                        loop: false,
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true,
                        },
                        slidesPerView: 1,
                        spaceBetween: 24,
                        breakpoints: {
                            '1500': {
                                slidesPerView: 1,
                            },
                            '1200': {
                                slidesPerView: 1,
                            },
                            '992': {
                                slidesPerView: 1,
                            },
                            '768': {
                                slidesPerView: 1,
                            },
                            '576': {
                                slidesPerView: 1,
                            },
                            '0': {
                                slidesPerView: 1,
                            },
                        },
                        pagination: {
                            el: '.tg-swiper-pagination',
                            clickable: true,
                        },
                        // Navigation arrows
                        navigation: {
                            nextEl: ".tg-swiper-next",
                            prevEl: ".tg-swiper-prev",
                        },
                    });

                });
            </script>

            <!-- banner-area -->
            <section class="banner-area banner-style-four position-relative">
                <div class="container">
                    <div class="banner__four-inner">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-6">
                                <div class="banner__content text-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                                    <?php if(!empty( $settings['tp_content_shapes_show']) ) : ?>
                                        <?php if(!empty( $tg_shape_image01 )) : ?>
                                        <img src="<?php echo esc_url($tg_shape_image01); ?>" width="44" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: -10%; left: 50%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_shape_image02 )) : ?>
                                        <img src="<?php echo esc_url($tg_shape_image02); ?>" width="16" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: 16%; left: -4%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 420;">
                                        <?php endif; ?>

                                        <?php if(!empty( $tg_shape_image03 )) : ?>
                                        <img src="<?php echo esc_url($tg_shape_image03); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: -16%; left: 16%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 440;">
                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <?php
                                        if ( !empty($settings['tg_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tg_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tg_title' ] )
                                        );
                                    endif;
                                    ?>

                                    <?php if(!empty( $settings['tg_button_show'] )) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'tg-button-arg3' ); ?> >
                                        <span><?php echo $settings['tg_btn_text2']; ?></span>
                                    </a>
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_separator_image_url )) : ?>
                                    <div class="section-divider">
                                        <img src="<?php echo esc_url($tg_separator_image_url); ?>" alt="<?php echo esc_attr($tg_separator_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['tg_hide_fact'] )) : ?>
                                    <div class="banner__fact-wrap">

                                        <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                                        <div class="banner__fact-item">

                                            <?php if (!empty( $item['tg_fact_number']) ): ?>
                                                <h4 class="count"><?php echo tp_kses( $item['tg_fact_number'] ); ?></h4>
                                            <?php endif; ?>

                                            <?php if (!empty( $item['tg_fact_desc']) ): ?>
                                                <span><?php echo tp_kses( $item['tg_fact_desc'] ); ?></span>
                                            <?php endif; ?>

                                        </div>
                                        <?php endforeach; ?>

                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-center">
                                    <div class="banner__four-images" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">

                                        <?php if(!empty( $settings['tp_images_shapes_show']) ) : ?>

                                            <?php if(!empty( $tg_image_shape01 )) : ?>
                                            <img src="<?php echo esc_url($tg_image_shape01); ?>" width="44" class="shape" alt="<?php echo esc_attr($tg_image_shape_alt01); ?>" style="top: 75%; left: -20%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 460;">
                                            <?php endif; ?>

                                            <?php if(!empty( $tg_image_shape02 )) : ?>
                                            <img src="<?php echo esc_url($tg_image_shape02); ?>" width="28" class="shape" alt="<?php echo esc_attr($tg_image_shape_alt02); ?>" style="top: 16%; right: -16%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 480;">
                                            <?php endif; ?>

                                            <img class="shape dashed-line has-active-light" width="300" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/blob-dashed.svg" alt="Blog dashed" style="top: -6%; left: -16%; fill: transparent; opacity: .1;">
                                            <img class="shape dashed-line has-active-dark" width="300" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/blob-dashed-light.svg" alt="Blog dashed" style="top: -6%; left: -16%; fill: transparent; opacity: .1;">

                                            <img class="shape dashed-line has-active-light" width="300" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/blob-dashed.svg" alt="Blog dashed" style="bottom: 4%; right: -16%; fill: transparent; opacity: .1;">
                                            <img class="shape dashed-line has-active-dark" width="300" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/blob-dashed-light.svg" alt="Blog dashed" style="bottom: 4%; right: -16%; fill: transparent; opacity: .1;">

                                        <?php endif; ?>

                                        <div class="banner__collection">
                                            <div class="swiper banner__collection-active">
                                                <div class="swiper-wrapper">

                                                    <?php foreach ($settings['tg_collection_slides'] as $item) :
                                                        if ( !empty($item['tg_slider_image']['url']) ) {
                                                            $tg_slider_image_url = !empty($item['tg_slider_image']['id']) ? wp_get_attachment_image_url( $item['tg_slider_image']['id'], $settings['tg_slider_size_size']) : $item['tg_slider_image']['url'];
                                                            $tg_slider_image_alt = get_post_meta($item["tg_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                                        }
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="banner__collection-item">
                                                            <div class="banner__collection-item-inner">
                                                                <canvas width="400" height="600"></canvas>
                                                                <img src="<?php echo esc_url($tg_slider_image_url); ?>" alt="<?php echo esc_attr($tg_slider_image_alt); ?>">

                                                                <?php if(!empty( $item['collection_link'] )) : ?>
                                                                <a href="<?php echo esc_url( $item['collection_link'] ); ?>" target="_blank" class="link"></a>
                                                                <?php endif; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>

                                                </div>

                                                <?php if(!empty( $settings['tg_hide_dots'] )) : ?>
                                                <!-- Pagination -->
                                                <div class="tg-swiper-pagination"></div>
                                                <?php endif; ?>

                                            </div>

                                            <?php if(!empty( $settings['tg_hide_arrow'] )) : ?>
                                            <!-- Navigation -->
                                            <a aria-label="Prev" href="#prev" class="tg-swiper-prev"><i class="fas fa-chevron-left"></i></a>
                                            <a aria-label="Next" href="#next" class="tg-swiper-next"><i class="fas fa-chevron-right"></i></a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-area-end -->


		<?php else:

            if ( !empty($settings['tg_first_image']['url']) ) {
                $tg_first_image = !empty($settings['tg_first_image']['id']) ? wp_get_attachment_image_url( $settings['tg_first_image']['id'], $settings['tg_image_size_size']) : $settings['tg_first_image']['url'];
                $tg_first_image_alt  = get_post_meta($settings["tg_first_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_second_image']['url']) ) {
                $tg_second_image = !empty($settings['tg_second_image']['id']) ? wp_get_attachment_image_url( $settings['tg_second_image']['id'], $settings['tg_image_size_size']) : $settings['tg_second_image']['url'];
                $tg_second_image_alt  = get_post_meta($settings["tg_second_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // All Shapes
            if ( !empty($settings['tg_shape_image01']['url']) ) {
                $tg_shape_image01 = !empty($settings['tg_shape_image01']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image01']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image01']['url'];
                $tg_shape_alt01  = get_post_meta($settings["tg_shape_image01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image02']['url']) ) {
                $tg_shape_image02 = !empty($settings['tg_shape_image02']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image02']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image02']['url'];
                $tg_shape_alt02  = get_post_meta($settings["tg_shape_image02"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image03']['url']) ) {
                $tg_shape_image03 = !empty($settings['tg_shape_image03']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image03']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image03']['url'];
                $tg_shape_alt03  = get_post_meta($settings["tg_shape_image03"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape01']['url']) ) {
                $tg_image_shape01 = !empty($settings['tg_image_shape01']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape01']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape01']['url'];
                $tg_image_shape_alt01  = get_post_meta($settings["tg_image_shape01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_image_shape02']['url']) ) {
                $tg_image_shape02 = !empty($settings['tg_image_shape02']['id']) ? wp_get_attachment_image_url( $settings['tg_image_shape02']['id'], $settings['tg_image_shape_size_size']) : $settings['tg_image_shape02']['url'];
                $tg_image_shape_alt02  = get_post_meta($settings["tg_image_shape02"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'banner__btn btn gradient-btn');
            } else {
                if ( ! empty( $settings['tg_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tg-button-arg', $settings['tg_btn_link'] );
                    $this->add_render_attribute('tg-button-arg', 'class', 'banner__btn btn gradient-btn');
                }
            }

            // Link
            if ('2' == $settings['tg_circle_link_type']) {
                $this->add_render_attribute('tg-link-arg', 'href', get_permalink($settings['tg_circle_page_link']));
                $this->add_render_attribute('tg-link-arg', 'target', '_self');
                $this->add_render_attribute('tg-link-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-link-arg', 'class', 'tg-circle-text');
            } else {
                if ( ! empty( $settings['tg_circle_link']['url'] ) ) {
                    $this->add_link_attributes( 'tg-link-arg', $settings['tg_circle_link'] );
                    $this->add_render_attribute('tg-link-arg', 'class', 'tg-circle-text');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'title');

		?>

            <script>
                jQuery(document).ready(function($){
                    $("[data-background]").each(function () {
                        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
                    })
                });
            </script>

            <!-- banner-area -->
            <section id="home" class="banner-area banner-padding position-relative">
                <div class="banner__background-wrap">
                    <div class="background" data-background="<?php echo esc_url($tg_bg_url); ?>"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                        <div class="col-lg-6">
                            <div class="banner__content" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">

                                <?php if(!empty( $settings['tp_content_shapes_show']) ) : ?>
                                    <?php if(!empty( $tg_shape_image01 )) : ?>
                                    <img src="<?php echo esc_url($tg_shape_image01); ?>" width="44" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: -25%; left: 38%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 400;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_shape_image02 )) : ?>
                                    <img src="<?php echo esc_url($tg_shape_image02); ?>" width="16" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: 14%; left: -12%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 420;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_shape_image03 )) : ?>
                                    <img src="<?php echo esc_url($tg_shape_image03); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: -16%; left: 12%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 440;">
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php
                                    if ( !empty($settings['tg_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tg_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tg_title' ] )
                                    );
                                endif;
                                ?>

                                <?php if ( !empty($settings['tg_description']) ) : ?>
                                <p class="desc"><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                <?php endif; ?>

                                <?php if(!empty( $settings['tg_btn_button_show'] )) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'tg-button-arg' ); ?>>
                                        <span><?php echo $settings['tg_btn_text']; ?></span> <i class="unicon-arrow-right"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-6">
                            <div class="banner__images" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">

                                <?php if(!empty( $settings['tp_images_shapes_show']) ) : ?>

                                    <?php if(!empty( $tg_image_shape01 )) : ?>
                                    <img src="<?php echo esc_url($tg_image_shape01); ?>" width="44" class="shape" alt="<?php echo esc_attr($tg_image_shape_alt01); ?>" style="top: 67%; left: -21%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 460;">
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_image_shape02 )) : ?>
                                    <img src="<?php echo esc_url($tg_image_shape02); ?>" width="28" class="shape" alt="<?php echo esc_attr($tg_image_shape_alt02); ?>" style="top: -4%; right: 16%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: true; delay: 480;">
                                    <?php endif; ?>

                                    <img class="shape dashed-line has-active-light" width="300" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/blob-dashed.svg" alt="Blog dashed" style="top: -10%; right: 17%; fill: transparent; opacity: .1;">

                                    <img class="shape dashed-line has-active-dark" width="300" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/blob-dashed-light.svg" alt="Blog dashed" style="top: -10%; right: 17%; fill: transparent; opacity: .1;">

                                    <svg style="top: -17%; opacity: .3;" class="shape" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#F796FF" d="M47.5,-67.2C55.9,-59.3,53.2,-37.9,56.7,-20.1C60.2,-2.3,69.9,11.8,70.8,27.3C71.7,42.9,63.8,59.9,50.6,64.4C37.3,68.9,18.6,60.8,-0.3,61.2C-19.3,61.6,-38.6,70.7,-53.5,66.7C-68.4,62.8,-78.9,45.9,-78.8,29.5C-78.7,13.2,-67.9,-2.7,-59.8,-16.8C-51.6,-31,-46,-43.3,-36.5,-50.9C-27,-58.4,-13.5,-61.1,3,-65.2C19.6,-69.4,39.1,-75.1,47.5,-67.2Z" transform="translate(100 100)">
                                    </svg>
                                <?php endif; ?>

                                <div class="banner__images-grid">

                                    <?php if(!empty( $tg_first_image )) : ?>
                                        <div class="left"><img src="<?php echo esc_url( $tg_first_image ); ?>" alt="<?php echo esc_attr($tg_first_image_alt); ?>"></div>
                                    <?php endif; ?>

                                    <?php if(!empty( $tg_second_image )) : ?>
                                        <div class="right"><img src="<?php echo esc_url( $tg_second_image ); ?>" alt="<?php echo esc_attr($tg_second_image_alt); ?>"></div>
                                    <?php endif; ?>

                                </div>

                                <?php if(!empty( $settings['circle_text'] )) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'tg-link-arg' ); ?>>
                                    <svg class="tg-circle-text-path tg-animation-spin" viewBox="0 0 100 100" width="120" height="120">
                                        <defs><path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"></defs>
                                        <text font-size="11.75">
                                            <textPath xlink:href="#circle"><?php echo esc_html( $settings['circle_text'] ); ?></textPath>
                                        </text>
                                    </svg>
                                    <i class="unicon-arrow-up-right"></i>
                                </a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-area-end -->

        <?php endif; ?>

        <?php

	}

}

$widgets_manager->register( new TG_Hero_Banner() );