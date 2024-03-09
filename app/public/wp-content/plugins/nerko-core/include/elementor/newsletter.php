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
class TG_Newsletter extends Widget_Base {

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
        return 'newsletter';
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
        return __( 'Newsletter', 'tpcore' );
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
                'default' => esc_html__('Never miss a drop!', 'tpcore'),
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
                'default' => esc_html__('Subscribe to our super-rare and exclusive drops & collectibles.', 'tpcore'),
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

        // Newsletter Form group
        $this->start_controls_section(
            '_tg_newsletter_form',
            [
                'label' => esc_html__('Newsletter Form', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
        'newsletter_shortCode',
            [
                'label' => __( 'Newsletter Short Code', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('[Add your short code]', 'tpcore'),
                'label_block' => true,
                'default' => __('','tpcore'),
            ]
        );

        $this->end_controls_section();

        // _newsletter_shape
        $this->start_controls_section(
            '_tg_newsletter_shape_section',
            [
                'label' => esc_html__('Newsletter Shapes', 'tpcore'),
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
                'label' => esc_html__( 'Choose left top', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image02',
            [
                'label' => esc_html__( 'Choose left bottom', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image03',
            [
                'label' => esc_html__( 'Choose right top', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image04',
            [
                'label' => esc_html__( 'Choose right bottom', 'tpcore' ),
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

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):

            $this->add_render_attribute('title_args', 'class', 'title text-uppercase');
        ?>

            <!-- newsletter-area -->
            <section class="newsletter-area style-two">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="newsletter__wrapper text-center">

                                <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                                <?php if(!empty( $tg_shape_image01 )) : ?>
                                <img class="top-left" width="16" src="<?php echo esc_url($tg_shape_image01); ?>" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: 16%; left: 8%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image02 )) : ?>
                                <img class="bottom-left" width="32" src="<?php echo esc_url($tg_shape_image02); ?>" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="bottom: 24%; left: 16%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image03 )) : ?>
                                <img class="top-right" width="24" src="<?php echo esc_url($tg_shape_image03); ?>" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="top: 16%; right: 16%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image04 )) : ?>
                                <img class="bottom-right" width="44" src="<?php echo esc_url($tg_shape_image04); ?>" alt="<?php echo esc_attr($tg_shape_alt04); ?>" style="bottom: 16%; right: 8%">
                                <?php endif; ?>

                                <?php endif; ?>

                                <div class="section__title" data-anime="targets: > *; opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: anime.stagger(100);">

                                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
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
                                            <p><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php echo do_shortcode( $settings['newsletter_shortCode'] ); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter-area-end -->

        <?php else:

            $this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <!-- newsletter-area -->
            <section class="newsletter-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="newsletter__wrapper text-center">

                                <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                                <?php if(!empty( $tg_shape_image01 )) : ?>
                                <img class="top-left" width="16" src="<?php echo esc_url($tg_shape_image01); ?>" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: 16%; left: 8%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image02 )) : ?>
                                <img class="bottom-left" width="32" src="<?php echo esc_url($tg_shape_image02); ?>" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="bottom: 24%; left: 16%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image03 )) : ?>
                                <img class="top-right" width="24" src="<?php echo esc_url($tg_shape_image03); ?>" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="top: 16%; right: 16%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image04 )) : ?>
                                <img class="bottom-right" width="44" src="<?php echo esc_url($tg_shape_image04); ?>" alt="<?php echo esc_attr($tg_shape_alt04); ?>" style="bottom: 16%; right: 8%">
                                <?php endif; ?>

                                <?php endif; ?>


                                <div class="section__title" data-anime="targets: > *; opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: anime.stagger(100);">

                                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
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
                                            <p><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php echo do_shortcode( $settings['newsletter_shortCode'] ); ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter-area-end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TG_Newsletter() );