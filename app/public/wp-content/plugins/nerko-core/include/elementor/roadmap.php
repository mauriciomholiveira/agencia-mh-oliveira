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
class TG_Roadmap extends Widget_Base {

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
        return 'roadmap';
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
        return __( 'Road Map', 'tpcore' );
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
            'tp_design_style',
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

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tg_section_title_show',
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
                'default' => esc_html__('Nerko\'s Roadmap', 'tpcore'),
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

        // roadmap group
        $this->start_controls_section(
            'tg_roadmap',
            [
                'label' => esc_html__('RoadMap List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tg_roadmap_step', [
                'label' => esc_html__('Roadmap Phase', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Phase 01', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_roadmap_percent', [
                'label' => esc_html__('Roadmap Percentage', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => tp_kses('<span>0</span>%', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_roadmap_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Planning', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_roadmap_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Quality comes first. we took our time to plan out everything and build our production pipeline for a good quality artworks.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_roadmap_list01',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Roadmap List 01', 'tpcore' ),
                'placeholder' => __( 'List item 01', 'tpcore' ),
                'default' => esc_html__('Release website and logo', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tg_roadmap_list02',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Roadmap List 02', 'tpcore' ),
                'placeholder' => __( 'List item 02', 'tpcore' ),
                'default' => esc_html__('Grow community', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tg_roadmap_list03',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Roadmap List 03', 'tpcore' ),
                'placeholder' => __( 'List item 03', 'tpcore' ),
                'default' => esc_html__('Launch the project', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tg_roadmap_list',
            [
                'label' => esc_html__('Roadmap - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_roadmap_step' => esc_html__('Phase 01', 'tpcore'),
                    ],
                    [
                        'tg_roadmap_step' => esc_html__('Phase 02', 'tpcore'),
                    ],
                    [
                        'tg_roadmap_step' => esc_html__('Phase 03', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ tg_roadmap_step }}}',
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

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <!-- roadmap-area -->
            <section class="roadmap-area roadmap-style-two">
                <div class="container">
                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-75">
                                <?php
                                if ( !empty($settings['tg_title']) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tg_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tg_title'] )
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

                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-10">
                            <div class="roadmap__wrapper-two">
                                <?php foreach ( $settings['tg_roadmap_list'] as $item ) : ?>
                                <div class="roadmap__card style-two">

                                    <?php if (!empty( $item['tg_roadmap_percent'] )) : ?>
                                    <div class="roadmap__percent">
                                        <?php echo tp_kses( $item['tg_roadmap_percent'] ); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_step'] )) : ?>
                                    <div class="roadmap__step">
                                        <span class="tg-text-gradient d-inline-flex"><?php echo tp_kses( $item['tg_roadmap_step'] ); ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_title'] )) : ?>
                                    <h3 class="roadmap__heading"><?php echo tp_kses( $item['tg_roadmap_title'] ); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_description'] )) : ?>
                                    <p><?php echo tp_kses( $item['tg_roadmap_description'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_list01'] || $item['tg_roadmap_list02'] || $item['tg_roadmap_list03'])) : ?>
                                    <ul class="roadmap__lists list-wrap">

                                        <?php if (!empty( $item['tg_roadmap_list01'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list01'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list02'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list02'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list03'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list03'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                    </ul>
                                    <?php endif; ?>

                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- roadmap-area-end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <!-- roadmap-area -->
            <section class="roadmap-area roadmap-style-three">
                <div class="container">
                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-80">
                                <?php
                                if ( !empty($settings['tg_title']) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tg_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tg_title'] )
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

                    <div class="roadmap__wrapper-three" data-anime="targets: > * > * > *; opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: anime.stagger(100);">
                        <div class="row justify-content-center">
                            <?php foreach ( $settings['tg_roadmap_list'] as $item ) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-9">
                                <div class="roadmap__card style-three">

                                    <?php if (!empty( $item['tg_roadmap_percent'] )) : ?>
                                    <div class="roadmap__percent">
                                        <?php echo tp_kses( $item['tg_roadmap_percent'] ); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_step'] )) : ?>
                                    <div class="roadmap__step">
                                        <span class="tg-text-gradient d-inline-flex"><?php echo tp_kses( $item['tg_roadmap_step'] ); ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_title'] )) : ?>
                                    <h3 class="roadmap__heading"><?php echo tp_kses( $item['tg_roadmap_title'] ); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_description'] )) : ?>
                                    <p><?php echo tp_kses( $item['tg_roadmap_description'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_list01'] || $item['tg_roadmap_list02'] || $item['tg_roadmap_list03'])) : ?>
                                    <ul class="roadmap__lists list-wrap">

                                        <?php if (!empty( $item['tg_roadmap_list01'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list01'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list02'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list02'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list03'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list03'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                    </ul>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- roadmap-area-end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
            $this->add_render_attribute('title_args', 'class', 'title text-uppercase');
        ?>

            <!-- roadmap-area -->
            <section class="roadmap-area roadmap-style-three">
                <div class="container">
                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-80">
                                <?php
                                if ( !empty($settings['tg_title']) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tg_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tg_title'] )
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

                    <div class="roadmap__wrapper-three roadmap__wrapper-four" data-anime="targets: > * > * > *; opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: anime.stagger(100);">
                        <div class="row justify-content-center">
                            <?php foreach ( $settings['tg_roadmap_list'] as $item ) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-9">
                                <div class="roadmap__card style-three">

                                    <?php if (!empty( $item['tg_roadmap_percent'] )) : ?>
                                    <div class="roadmap__percent">
                                        <?php echo tp_kses( $item['tg_roadmap_percent'] ); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_step'] )) : ?>
                                    <div class="roadmap__step">
                                        <span class="tg-text-gradient d-inline-flex"><?php echo tp_kses( $item['tg_roadmap_step'] ); ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_title'] )) : ?>
                                    <h3 class="roadmap__heading"><?php echo tp_kses( $item['tg_roadmap_title'] ); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_description'] )) : ?>
                                    <p><?php echo tp_kses( $item['tg_roadmap_description'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty( $item['tg_roadmap_list01'] || $item['tg_roadmap_list02'] || $item['tg_roadmap_list03'])) : ?>
                                    <ul class="roadmap__lists list-wrap">

                                        <?php if (!empty( $item['tg_roadmap_list01'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list01'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list02'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list02'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list03'] )) : ?>
                                        <li>
                                            <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                            <?php echo tp_kses( $item['tg_roadmap_list03'] ); ?>
                                        </li>
                                        <?php endif; ?>

                                    </ul>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- roadmap-area-end -->

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <script>
                jQuery(document).ready(function($){

                    /*=============================================
                        =        RoadMap Active		      =
                    =============================================*/
                    var roadSwiper = new Swiper('.roadmap__active', {
                        // Optional parameters
                        loop: false,
                        slidesPerView: 1,
                        spaceBetween: 32,
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
                            el: ".tg-swiper-scrollbar",
                            type: "progressbar",
                        },
                        // Navigation arrows
                        navigation: {
                            nextEl: ".tg-swiper-next",
                            prevEl: ".tg-swiper-prev",
                        },
                    });

                });
            </script>

            <!-- roadmap-area -->
            <section class="roadmap-area">
                <div class="container">

                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-75">
                                <?php
                                if ( !empty($settings['tg_title']) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tg_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tg_title'] )
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

                    <div class="roadmap__wrapper" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 200;">
                        <div class="swiper roadmap__active">
                            <div class="swiper-wrapper" data-anime="targets: > * > *; opacity:[0, 1]; scale:[0.5, 1]; onview: -400; delay: anime.stagger(200);">
                                <?php foreach ( $settings['tg_roadmap_list'] as $item ) : ?>
                                <div class="swiper-slide">
                                    <div class="roadmap__card">

                                        <?php if (!empty( $item['tg_roadmap_percent'] )) : ?>
                                        <div class="roadmap__percent">
                                            <?php echo tp_kses( $item['tg_roadmap_percent'] ); ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_step'] )) : ?>
                                        <div class="roadmap__step">
                                            <span class="tg-text-gradient d-inline-flex"><?php echo tp_kses( $item['tg_roadmap_step'] ); ?></span>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_title'] )) : ?>
                                        <h3 class="roadmap__heading"><?php echo tp_kses( $item['tg_roadmap_title'] ); ?></h3>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_description'] )) : ?>
                                        <p><?php echo tp_kses( $item['tg_roadmap_description'] ); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty( $item['tg_roadmap_list01'] || $item['tg_roadmap_list02'] || $item['tg_roadmap_list03'])) : ?>
                                        <ul class="roadmap__lists list-wrap">

                                            <?php if (!empty( $item['tg_roadmap_list01'] )) : ?>
                                            <li>
                                                <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                                <?php echo tp_kses( $item['tg_roadmap_list01'] ); ?>
                                            </li>
                                            <?php endif; ?>

                                            <?php if (!empty( $item['tg_roadmap_list02'] )) : ?>
                                            <li>
                                                <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                                <?php echo tp_kses( $item['tg_roadmap_list02'] ); ?>
                                            </li>
                                            <?php endif; ?>

                                            <?php if (!empty( $item['tg_roadmap_list03'] )) : ?>
                                            <li>
                                                <i class="unicon-checkmark-outline tg-text-gradient d-inline-flex"></i>
                                                <?php echo tp_kses( $item['tg_roadmap_list03'] ); ?>
                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Pagination -->
                        <div class="tg-swiper-scrollbar"></div>

                        <!-- Navigation -->
                        <a aria-label="Prev" href="#prev" class="tg-swiper-prev"><i class="fas fa-chevron-left"></i></a>
                        <a aria-label="Next" href="#next" class="tg-swiper-next"><i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </section>
            <!-- roadmap-area-end -->

        <?php endif; ?>

    <?php
    }
}

$widgets_manager->register( new TG_Roadmap() );