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
class tg_brand extends Widget_Base {

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
		return 'brand';
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
		return __( 'Brand', 'tpcore' );
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
            'tg_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tg_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
				'label_block' => true,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		// tg_section_title
        $this->start_controls_section(
            'tg_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

		$this->add_control(
            'tg_section_title_show',
            [
                'label' => esc_html__( 'Section Title', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_sub_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('POWERED BY AMAZING INVESTORS:', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
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

		$this->end_controls_section();

		$this->start_controls_section(
            'tg_brand_section',
            [
                'label' => __( 'Brand Item', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tg_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Dak Image', 'tpcore' ),
                'description' => esc_html__('Upload dark image for light mode', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tg_brand_image_white',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'White Image', 'tpcore' ),
                'description' => esc_html__('Upload white image for dark mode', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tg_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Type url here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tg_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'tpcore' ),
                'default' => [
                    [
                        'tg_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tg_brand_image' => [
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

        $this->end_controls_section();


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

		<?php if ( $settings['tg_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

			<!-- brand-area -->
            <div class="brand-area brand-style-two" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 300;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">

                            <?php if ( !empty($settings['tg_section_title_show']) ) : ?>
                                <h6 class="brand__title"><?php echo esc_html( $settings['tg_sub_title'] ); ?></h6>
                            <?php endif; ?>

                            <div class="brand__list">
                                <?php foreach ($settings['tg_brand_slides'] as $item) :
                                    if ( !empty($item['tg_brand_image']['url']) ) {
                                        $tg_brand_image_url = !empty($item['tg_brand_image']['id']) ? wp_get_attachment_image_url( $item['tg_brand_image']['id'], $settings['thumbnail_size']) : $item['tg_brand_image']['url'];
                                        $tg_brand_image_alt = get_post_meta($item["tg_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    if ( !empty($item['tg_brand_image_white']['url']) ) {
                                        $tg_brand_image_white_url = !empty($item['tg_brand_image_white']['id']) ? wp_get_attachment_image_url( $item['tg_brand_image_white']['id'], $settings['thumbnail_size']) : $item['tg_brand_image_white']['url'];
                                        $tg_brand_image_white_alt = get_post_meta($item["tg_brand_image_white"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                <div class="brand__item">

                                    <?php if (!empty($item['tg_brand_url'])) : ?>
                                        <a href="<?php echo esc_url($item['tg_brand_url']); ?>"><img src="<?php echo esc_url($tg_brand_image_url); ?>" class="has-active-light" alt="<?php echo esc_attr($tg_brand_image_alt); ?>"></a>
                                        <a href="<?php echo esc_url($item['tg_brand_url']); ?>"><img src="<?php echo esc_url($tg_brand_image_white_url); ?>" class="has-active-dark" alt="<?php echo esc_attr($tg_brand_image_white_alt); ?>"></a>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url($tg_brand_image_url); ?>" class="has-active-light" alt="<?php echo esc_attr($tg_brand_image_alt); ?>">
                                        <img src="<?php echo esc_url($tg_brand_image_white_url); ?>" class="has-active-dark" alt="<?php echo esc_attr($tg_brand_image_white_alt); ?>">
                                    <?php endif; ?>

                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- brand-area-end -->

		<?php else:
			$this->add_render_attribute('title_args', 'class', 'title');
		?>

        <!-- brand-area -->
        <div class="brand-area" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 300;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-12">

                        <?php if ( !empty($settings['tg_section_title_show']) ) : ?>
                            <h6 class="brand__title"><?php echo esc_html( $settings['tg_sub_title'] ); ?></h6>
                        <?php endif; ?>

                        <div class="brand__list">
                            <?php foreach ($settings['tg_brand_slides'] as $item) :
                                if ( !empty($item['tg_brand_image']['url']) ) {
                                    $tg_brand_image_url = !empty($item['tg_brand_image']['id']) ? wp_get_attachment_image_url( $item['tg_brand_image']['id'], $settings['thumbnail_size']) : $item['tg_brand_image']['url'];
                                    $tg_brand_image_alt = get_post_meta($item["tg_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                if ( !empty($item['tg_brand_image_white']['url']) ) {
                                    $tg_brand_image_white_url = !empty($item['tg_brand_image_white']['id']) ? wp_get_attachment_image_url( $item['tg_brand_image_white']['id'], $settings['thumbnail_size']) : $item['tg_brand_image_white']['url'];
                                    $tg_brand_image_white_alt = get_post_meta($item["tg_brand_image_white"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <div class="brand__item">

                                <?php if (!empty($item['tg_brand_url'])) : ?>
                                    <a href="<?php echo esc_url($item['tg_brand_url']); ?>"><img src="<?php echo esc_url($tg_brand_image_url); ?>" class="has-active-light" alt="<?php echo esc_attr($tg_brand_image_alt); ?>"></a>
                                    <a href="<?php echo esc_url($item['tg_brand_url']); ?>"><img src="<?php echo esc_url($tg_brand_image_white_url); ?>" class="has-active-dark" alt="<?php echo esc_attr($tg_brand_image_white_alt); ?>"></a>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($tg_brand_image_url); ?>" class="has-active-light" alt="<?php echo esc_attr($tg_brand_image_alt); ?>">
                                    <img src="<?php echo esc_url($tg_brand_image_white_url); ?>" class="has-active-dark" alt="<?php echo esc_attr($tg_brand_image_white_alt); ?>">
                                <?php endif; ?>

                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand-area-end -->

		<?php endif; ?>

		<?php
	}


}

$widgets_manager->register( new tg_brand() );