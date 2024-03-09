<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
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
class TG_Features extends Widget_Base {

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
		return 'features';
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
		return __( 'Features', 'tpcore' );
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

        // _tg_background
        $this->start_controls_section(
            '_tg_background_section',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-5',
                ]
            ]
        );

        $this->add_control(
            'tg_bg_image',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('How to mint', 'tpcore'),
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
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
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

        // Features group
        $this->start_controls_section(
            'tg_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tg_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'label_block' => true,
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'count' => esc_html__('Count', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tg_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_features_icon_type' => 'image'
                ]

            ]
        );

        $repeater->add_control(
            'tg_hide_count', [
                'label' => esc_html__('Hide Features Count', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tg_features_icon_type' => 'count'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tg_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tg_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tg_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tg_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Connect your wallet', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_features_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Use Trust Wallet, Metamask or any wallet to connect to the app.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_features_list',
            [
                'label' => esc_html__('Features List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_features_title' => esc_html__('Connect your wallet', 'tpcore'),
                    ],
                    [
                        'tg_features_title' => esc_html__('Select your quantity', 'tpcore')
                    ],
                    [
                        'tg_features_title' => esc_html__('Confirm transaction', 'tpcore')
                    ],
                    [
                        'tg_features_title' => esc_html__('Receive your NFTs', 'tpcore')
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'tg_features_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        // _features_shape
        $this->start_controls_section(
            '_tg_features_shape_section',
            [
                'label' => esc_html__('Features Shapes', 'tpcore'),
            ]
        );

        $this->add_control(
            'tg_shapes_show',
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
                'label' => esc_html__( 'Choose left shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image03',
            [
                'label' => esc_html__( 'Choose right shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

		?>

        <?php if ( $settings['tg_design_style']  == 'layout-2' ) :

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

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <!-- choose-area -->
            <section class="choose-area">
                <div class="container">

                    <?php if (!empty( $settings['tp_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-80">

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

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="position-relative">
                        <div class="row choose__item-lists" data-anime="targets: > * > *; opacity:[0, 1]; translateY:[48, 0]; onview: -400; delay: anime.stagger(100);">

                        <?php foreach ($settings['tg_features_list'] as $key => $item) : ?>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="choose__item">

                                    <?php if (!empty( $item['tg_hide_count' ] )): ?>
                                        <div class="choose__item-count tg-text-gradient">0<?php echo esc_html($key)+1; ?>.</div>
                                    <?php endif; ?>

                                    <div class="choose__item-content">

                                        <?php if (!empty($item['tg_features_title' ])): ?>
                                            <h3 class="title"><?php echo tp_kses( $item['tg_features_title'] ); ?></h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tg_features_description'])): ?>
                                            <p><?php echo tp_kses( $item['tg_features_description'] ); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        </div>

                        <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image01); ?>" class="top-left" width="16" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: -16%; left: 8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image02); ?>" class="bottom-left" width="28" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="bottom: 16%; left: -8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image03 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image03); ?>" class="bottom-right" width="24" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: 16%; right: -8%">
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- choose-area-end -->

        <?php elseif ( $settings['tg_design_style']  == 'layout-3' ) :

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

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <!-- choose-area -->
            <section class="choose-area choose-style-two">
                <div class="container">

                    <?php if (!empty( $settings['tp_section_title_show'] )): ?>
                        <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">
                            <div class="col-xl-8 col-lg-10">
                                <div class="section__title text-center title-mb-80">

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

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="position-relative">
                        <div class="row choose__item-lists" data-anime="targets: > * > *; opacity:[0, 1]; translateY:[48, 0]; onview: -400; delay: anime.stagger(100);">

                        <?php foreach ( $settings['tg_features_list'] as $item ) : ?>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="choose__item">

                                    <?php if (!empty($item['tg_features_icon']) || !empty($item['tg_features_selected_icon']['value'])) : ?>
                                        <div class="choose__item-count tg-text-gradient">
                                            <?php tp_render_icon($item, 'tg_features_icon', 'tg_features_selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="choose__item-content">

                                        <?php if (!empty($item['tg_features_title' ])): ?>
                                            <h3 class="title"><?php echo tp_kses( $item['tg_features_title'] ); ?></h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tg_features_description'])): ?>
                                            <p><?php echo tp_kses( $item['tg_features_description'] ); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        </div>

                        <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image01); ?>" class="top-left" width="16" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: -16%; left: 8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image02); ?>" class="bottom-left" width="28" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="bottom: 16%; left: -8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image03 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image03); ?>" class="bottom-right" width="24" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: 16%; right: -8%">
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- choose-area-end -->


        <?php elseif ( $settings['tg_design_style']  == 'layout-4' ) :

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

            // separator
            if ( !empty($settings['tg_separator_image']['url']) ) {
                $tg_separator_image_url = !empty($settings['tg_separator_image']['id']) ? wp_get_attachment_image_url( $settings['tg_separator_image']['id'], $settings['separator_size_size']) : $settings['tg_separator_image']['url'];
                $tg_separator_image_alt = get_post_meta($settings["tg_separator_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title text-uppercase');

        ?>

            <!-- choose-area -->
            <section class="choose-area choose-style-three">
                <div class="container">
                    <div class="position-relative">
                        <div class="row align-items-center justify-content-center">

                            <?php if (!empty( $settings['tp_section_title_show'] )): ?>
                            <div class="col-xl-5 col-lg-8">
                                <div class="section__title text-center text-xl-start">

                                    <?php
                                        if ( !empty($settings['tg_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tg_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tg_title' ] )
                                        );
                                    endif;
                                    ?>

                                    <?php if(!empty( $tg_separator_image_url )) : ?>
                                    <div class="section-divider">
                                        <img src="<?php echo esc_url($tg_separator_image_url); ?>" class="m-0" alt="<?php echo esc_attr($tg_separator_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($settings['tg_description']) ) : ?>
                                    <p><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-xl-7 col-lg-9">
                                <div class="choose__items-wrapper" data-anime="targets: > *; opacity:[0, 1]; translateY:[24, 0]; onview: -250; delay: anime.stagger(100);">

                                    <?php foreach ( $settings['tg_features_list'] as $item ) : ?>
                                    <div class="choose__items">

                                        <?php if (!empty($item['tg_features_icon']) || !empty($item['tg_features_selected_icon']['value'])) : ?>
                                            <div class="choose__items-icon">
                                                <?php tp_render_icon($item, 'tg_features_icon', 'tg_features_selected_icon'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="choose__items-content">

                                            <?php if (!empty($item['tg_features_title' ])): ?>
                                                <h4 class="title"><?php echo tp_kses( $item['tg_features_title'] ); ?></h4>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tg_features_description'])): ?>
                                                <p><?php echo tp_kses( $item['tg_features_description'] ); ?></p>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                        <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image01); ?>" class="top-left" width="16" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: 0; left: 12%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image02); ?>" class="bottom-left" width="28" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="bottom: 16%; left: -8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image03 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image03); ?>" class="bottom-right" width="24" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: 16%; right: -8%">
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- choose-area-end -->

        <?php else:

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

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <!-- mint-area -->
            <section class="mint-area">
                <div class="container">

                    <?php if (!empty( $settings['tp_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-80">

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

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mint__lits-wrapper" data-anime="targets: > *; opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 300;">

                        <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                            <img class="shape" width="16" src="<?php echo esc_url($tg_shape_image01); ?>" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: -16%; left: 8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                            <img class="shape" width="28" src="<?php echo esc_url($tg_shape_image02); ?>" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="bottom: 16%; left: -8%">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image03 )) : ?>
                            <img class="shape" width="24" src="<?php echo esc_url($tg_shape_image03); ?>" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: 16%; right: -8%">
                            <?php endif; ?>


                        <?php endif; ?>

                        <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: -250; delay: anime.stagger(100);">
                            <?php foreach ($settings['tg_features_list'] as $item) : ?>
                            <div class="col-md-6 col-sm-9">
                                <div class="mint__item">

                                    <?php if (!empty($item['tg_features_image']['url'])): ?>
                                    <div class="mint__icon">
                                        <img class="light" src="<?php echo $item['tg_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tg_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    </div>
                                    <?php endif; ?>

                                    <div class="mint__content">

                                        <?php if (!empty($item['tg_features_title' ])): ?>
                                            <h2 class="title"><?php echo tp_kses( $item['tg_features_title'] ); ?></h2>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tg_features_description'])): ?>
                                            <p class="desc"><?php echo tp_kses( $item['tg_features_description'] ); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- mint-area-end -->

        <?php endif; ?>

    <?php
	}
}

$widgets_manager->register( new TG_Features() );