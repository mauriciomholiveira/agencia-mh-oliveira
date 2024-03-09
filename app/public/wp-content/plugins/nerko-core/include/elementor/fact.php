<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nerko Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TG_Fact extends Widget_Base {

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
		return 'tp-fact';
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
		return __( 'Fact', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Fact group
        $this->start_controls_section(
            'tg_fact',
            [
                'label' => esc_html__('Fact List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tg_fact_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'description' => esc_html__( 'The icon type works only for layout style 2' ),
                'options' => [
                    'none' => esc_html__('None', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'image' => esc_html__('Image', 'tpcore'),
                ],
                'default' => 'none',
            ]
        );

        $repeater->add_control(
            'tg_fact_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_fact_icon_type' => 'image'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_fact_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tg_fact_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tg_fact_selected_icon',
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
                        'tg_fact_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tg_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('4,000+', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_fact_desc',
            [
                'label' => esc_html__('Fact Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Wallets Connected', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_fact_list',
            [
                'label' => esc_html__('Fact Lists', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_fact_number' => esc_html__('4,000+', 'tpcore'),
                        'tg_fact_desc' => esc_html__('Wallets Connected', 'tpcore'),
                    ],
                    [
                        'tg_fact_number' => esc_html__('20,000+', 'tpcore'),
                        'tg_fact_desc' => esc_html__('Collections Indexed every 5 mins.', 'tpcore'),
                    ],
                    [
                        'tg_fact_number' => esc_html__('2.5x', 'tpcore'),
                        'tg_fact_desc' => esc_html__('Difference in Floor & Estimated Value', 'tpcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // _fact_shape
        $this->start_controls_section(
            '_tg_fact_shape_section',
            [
                'label' => esc_html__('Fact Shapes', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_shapes_show',
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
                'label' => esc_html__( 'Choose bottom shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image02',
            [
                'label' => esc_html__( 'Choose top shape', 'tpcore' ),
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


        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'tocore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'tocore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .tp-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .tp-el-title',
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .tp-el-subtitle',
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .tp-el-content p',
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

        <?php if ( $settings['tg_design_style'] == 'layout-2' ) :

            // All Shapes
            if ( !empty($settings['tg_shape_image01']['url']) ) {
                $tg_shape_image01 = !empty($settings['tg_shape_image01']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image01']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image01']['url'];
                $tg_shape_alt01  = get_post_meta($settings["tg_shape_image01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image02']['url']) ) {
                $tg_shape_image02 = !empty($settings['tg_shape_image02']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image02']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image02']['url'];
                $tg_shape_alt02  = get_post_meta($settings["tg_shape_image02"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

            <script>
                jQuery(document).ready(function($){

                    if ($('.fact__item > i').length) {
                        $('.fact__item > i').addClass('tg-text-gradient');
                    }

                });
            </script>

            <!-- fact-area -->
            <section class="fact-area fact-style-two">
                <div class="container">
                    <div class="fact__items-wrap position-relative">

                        <?php if(!empty( $settings['tp_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                            <img class="shape" src="<?php echo esc_url($tg_shape_image01); ?>" width="32" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="bottom: -32%; left: 30%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: -250; delay: 200;">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                            <img class="shape" src="<?php echo esc_url($tg_shape_image02); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: -25%; right: 25%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: -250; delay: 200;">
                            <?php endif; ?>

                        <?php endif; ?>

                        <div class="row justify-content-center" data-anime="targets: > *; opacity:[0, 1]; scale:[0.5, 1]; onview: -250; delay: anime.stagger(100);">

                            <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="fact__item text-center">

                                    <?php if($item['tg_fact_icon_type'] !== 'image') : ?>
                                        <?php if (!empty($item['tg_fact_icon']) || !empty($item['tg_fact_selected_icon']['value'])) : ?>
                                            <?php tp_render_icon($item, 'tg_fact_icon', 'tg_fact_selected_icon'); ?>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['tg_fact_image']['url'])): ?>
                                            <img style="max-height: 54px;" src="<?php echo $item['tg_fact_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tg_fact_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_fact_number']) ): ?>
                                        <h2 class="fact__count"><?php echo tp_kses( $item['tg_fact_number'] ); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_fact_desc']) ): ?>
                                        <span class="meta"><?php echo tp_kses( $item['tg_fact_desc'] ); ?></span>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- fact-area-end -->

        <?php elseif ( $settings['tg_design_style'] == 'layout-3' ) :

            // All Shapes
            if ( !empty($settings['tg_shape_image01']['url']) ) {
                $tg_shape_image01 = !empty($settings['tg_shape_image01']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image01']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image01']['url'];
                $tg_shape_alt01  = get_post_meta($settings["tg_shape_image01"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tg_shape_image02']['url']) ) {
                $tg_shape_image02 = !empty($settings['tg_shape_image02']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image02']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image02']['url'];
                $tg_shape_alt02  = get_post_meta($settings["tg_shape_image02"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

            <!-- fact-area -->
            <section class="fact-area fact-style-three">
                <div class="container">
                    <div class="fact__items-wrap position-relative">

                        <?php if(!empty( $settings['tp_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                            <img class="shape" src="<?php echo esc_url($tg_shape_image01); ?>" width="32" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="bottom: -32%; left: 30%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: -250; delay: 200;">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                            <img class="shape" src="<?php echo esc_url($tg_shape_image02); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: -25%; right: 25%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: -250; delay: 200;">
                            <?php endif; ?>

                        <?php endif; ?>

                        <div class="row justify-content-center" data-anime="targets: > *; opacity:[0, 1]; scale:[0.5, 1]; onview: -250; delay: anime.stagger(100);">

                            <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="fact__item text-center">

                                    <?php if (!empty( $item['tg_fact_number']) ): ?>
                                        <h2 class="fact__count"><?php echo tp_kses( $item['tg_fact_number'] ); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_fact_desc']) ): ?>
                                        <span class="meta"><?php echo tp_kses( $item['tg_fact_desc'] ); ?></span>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- fact-area-end -->

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

        ?>

            <!-- fact-area -->
            <section class="fact-area">
                <div class="container">
                    <div class="fact__items-wrap position-relative">

                        <?php if(!empty( $settings['tp_shapes_show']) ) : ?>

                            <?php if(!empty( $tg_shape_image01 )) : ?>
                            <img class="shape" src="<?php echo esc_url($tg_shape_image01); ?>" width="32" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="bottom: -32%; left: 30%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: -250; delay: 200;">
                            <?php endif; ?>

                            <?php if(!empty( $tg_shape_image02 )) : ?>
                            <img class="shape" src="<?php echo esc_url($tg_shape_image02); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: -25%; right: 25%" data-anime="opacity:[0, 1]; scale:[0, 1]; onview: -250; delay: 200;">
                            <?php endif; ?>

                        <?php endif; ?>

                        <div class="row justify-content-center" data-anime="targets: > *; opacity:[0, 1]; scale:[0.5, 1]; onview: -250; delay: anime.stagger(100);">

                            <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-8">
                                <div class="fact__item text-center">

                                    <?php if (!empty( $item['tg_fact_number']) ): ?>
                                        <h2 class="fact__count tg-text-gradient"><?php echo tp_kses( $item['tg_fact_number'] ); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_fact_desc']) ): ?>
                                        <span class="meta"><?php echo tp_kses( $item['tg_fact_desc'] ); ?></span>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- fact-area-end -->

        <?php endif; ?>

    <?php
	}
}

$widgets_manager->register( new TG_Fact() );