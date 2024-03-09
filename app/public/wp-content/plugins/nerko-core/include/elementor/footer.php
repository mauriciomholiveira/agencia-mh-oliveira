<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nerko Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TG_Footer extends Widget_Base {

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
		return 'tp-footer';
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
		return __( 'Footer', 'tpcore' );
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
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
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
                    'tg_design_style!' => 'layout-1'
                ],
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

        // tg_footer_widget
        $this->start_controls_section(
            'tg_footer_info',
            [
                'label' => esc_html__('Footer Info', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'tg_footer_widget_show',
            [
                'label' => esc_html__( 'Show / Hide Widget', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_logo',
            [
                'label' => esc_html__( 'Choose logo', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_logo_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tg_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('We make it easy to Discover, Invest and manage all your NFTs at one place.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $this->end_controls_section();

        // tg_footer_social
        $this->start_controls_section(
            'tg_footer_social',
            [
                'label' => esc_html__('Footer Social', 'tpcore'),
            ]
        );

        $this->add_control(
            'tg_hide_social',
            [
                'label' => esc_html__( 'Hide Social', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_footer_twitter', [
                'label' => esc_html__('Twitter URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_footer_discord', [
                'label' => esc_html__('Discord URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_footer_instagram', [
                'label' => esc_html__('Instagram URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_footer_telegram', [
                'label' => esc_html__('Telegram URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_footer_youtube', [
                'label' => esc_html__('YouTube URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // _footer_shape
        $this->start_controls_section(
            '_tg_footer_shape_section',
            [
                'label' => esc_html__('Footer Shapes', 'tpcore'),
                'condition' => [
                    'tg_design_style' => 'layout-1',
                ]
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
                'label' => esc_html__( 'Choose left shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image02',
            [
                'label' => esc_html__( 'Choose right shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image03',
            [
                'label' => esc_html__( 'Choose right bottom shape', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shape_image04',
            [
                'label' => esc_html__( 'Choose left bottom shape', 'tpcore' ),
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

        // tg_footer_copyright
        $this->start_controls_section(
            'tg_footer_copyright',
            [
                'label' => esc_html__('Copyright', 'tpcore'),
            ]
        );

        $this->add_control(
            'tg_footer_copyright_show',
            [
                'label' => esc_html__( 'Show / Hide Copyright', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_copyright_text',
            [
                'label' => esc_html__('Copyright Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('© 2022 Nerko. All rights reserved.', 'tpcore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tg_copy_menu_text', [
                'label' => esc_html__('Menu Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Privacy policy', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_copy_menu_url', [
                'label' => esc_html__('Menu URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_copyright_list',
            [
                'label' => esc_html__('Menu Lists', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_copy_menu_text' => esc_html__('Privacy policy', 'tpcore'),
                    ],
                    [
                        'tg_copy_menu_text' => esc_html__('Terms of use', 'tpcore'),
                    ],
                ],
            ]
        );

        $this->add_control(
            'tg_footer_backtop_show',
            [
                'label' => esc_html__( 'Back to Top', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tg_design_style' => 'layout-1',
                ]
            ]
        );

        $this->end_controls_section();

        // Tab Style
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

            // Background
            if ( !empty($settings['tg_bg']['url']) ) {
                $tg_bg_url = !empty($settings['tg_bg']['id']) ? wp_get_attachment_image_url( $settings['tg_bg']['id'], $settings['tg_bg_size_size']) : $settings['tg_bg']['url'];
                $tg_bg_alt = get_post_meta($settings["tg_bg"]["id"], "_wp_attachment_image_alt", true);
            }

            // logo
            if ( !empty($settings['tg_logo']['url']) ) {
                $tg_logo_url = !empty($settings['tg_logo']['id']) ? wp_get_attachment_image_url( $settings['tg_logo']['id'], $settings['tg_logo_size_size']) : $settings['tg_logo']['url'];
                $tg_logo_alt = get_post_meta($settings["tg_logo"]["id"], "_wp_attachment_image_alt", true);
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

            if ( !empty($settings['tg_shape_image04']['url']) ) {
                $tg_shape_image04 = !empty($settings['tg_shape_image04']['id']) ? wp_get_attachment_image_url( $settings['tg_shape_image04']['id'], $settings['tg_shape_size_size']) : $settings['tg_shape_image04']['url'];
                $tg_shape_alt04  = get_post_meta($settings["tg_shape_image04"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title');

		?>

		<?php if ( $settings['tg_design_style']  == 'layout-2' ): ?>

            <script>
                jQuery(document).ready(function($){
                    $("[data-background]").each(function () {
                        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
                    })
                });
            </script>

            <!-- footer-area -->
            <footer class="footer-area footer-style-two section-py-80">

                <?php if( !empty( $tg_bg_url ) ) : ?>
                    <div class="footer-bg" data-background="<?php echo esc_url( $tg_bg_url ); ?>"></div>
                <?php endif; ?>

                <div class="container">
                    <div class="footer__wrapper">

                        <?php if(!empty( $settings['tg_hide_social'] )) : ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-11">
                                <div class="footer__info text-center">
                                    <ul class="list-wrap footer__social">

                                        <?php if(!empty( $settings['tg_footer_twitter'] )) : ?>
                                        <li><a href="<?php echo esc_url( $settings['tg_footer_twitter'] ) ?>"><i class="fab fa-twitter"></i></a></li>
                                        <?php endif; ?>

                                        <?php if(!empty( $settings['tg_footer_discord'] )) : ?>
                                        <li><a href="<?php echo esc_url( $settings['tg_footer_discord'] ) ?>"><i class="fab fa-discord"></i></a></li>
                                        <?php endif; ?>

                                        <?php if(!empty( $settings['tg_footer_instagram'] )) : ?>
                                        <li><a href="<?php echo esc_url( $settings['tg_footer_instagram'] ) ?>"><i class="fab fa-instagram"></i></a></li>
                                        <?php endif; ?>

                                        <?php if(!empty( $settings['tg_footer_telegram'] )) : ?>
                                        <li><a href="<?php echo esc_url( $settings['tg_footer_telegram'] ) ?>"><i class="fab fa-telegram-plane"></i></a></li>
                                        <?php endif; ?>

                                        <?php if(!empty( $settings['tg_footer_youtube'] )) : ?>
                                        <li><a href="<?php echo esc_url( $settings['tg_footer_youtube'] ) ?>"><i class="fab fa-youtube"></i></a></li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $settings['tg_footer_copyright_show'] )) : ?>
                        <div class="copyright__wrapper-two">
                            <div class="row justify-content-center">
                                <div class="col-md-8">

                                    <div class="copyright__menu">
                                        <ul class="list-wrap justify-content-center">
                                            <?php foreach ( $settings['tg_copyright_list'] as $item) : ?>
                                                <?php if(!empty( $item['tg_copy_menu_url'] )) : ?>
                                                <li><a href="<?php echo esc_url( $item['tg_copy_menu_url'] ) ?>"><?php echo esc_html( $item['tg_copy_menu_text'] ) ?></a></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                    <?php if(!empty( $settings['tg_copyright_text'] )) : ?>
                                    <div class="copyright__text text-center">
                                        <p><?php echo tp_kses( $settings['tg_copyright_text'] ) ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </footer>
            <!-- footer-area-end -->

		<?php else: ?>

            <!-- footer-area -->
            <footer class="footer-area section-py-80">
                <div class="container">
                    <div class="footer__wrapper">

                        <?php if(!empty( $settings['tg_footer_widget_show']) ) : ?>

                            <?php if(!empty( $settings['tg_shapes_show']) ) : ?>

                                <?php if(!empty( $tg_shape_image01 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image01); ?>" width="32" alt="<?php echo esc_attr($tg_shape_alt01); ?>" style="top: 32%; left: 16%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image02 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image02); ?>" width="16" alt="<?php echo esc_attr($tg_shape_alt02); ?>" style="top: 8%; right: 16%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image03 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image03); ?>" width="16" alt="<?php echo esc_attr($tg_shape_alt03); ?>" style="bottom: 24%; right: 40%">
                                <?php endif; ?>

                                <?php if(!empty( $tg_shape_image04 )) : ?>
                                <img src="<?php echo esc_url($tg_shape_image04); ?>" width="24" alt="<?php echo esc_attr($tg_shape_alt04); ?>" style="bottom: -8%; left: 30%">
                                <?php endif; ?>

                            <?php endif; ?>

                            <div class="row justify-content-center">
                                <div class="col-xl-5 col-lg-7 col-md-9 col-sm-11">
                                    <div class="footer__info text-center">

                                        <?php if( !empty( $tg_logo_url ) ) : ?>
                                        <div class="footer-logo">
                                            <a href="<?php print esc_url( home_url( '/' ) );?>">
                                                <img src="<?php echo esc_url( $tg_logo_url ); ?>" width="200" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>">
                                            </a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ( !empty($settings['tg_description']) ) : ?>
                                            <p><?php echo tp_kses( $settings['tg_description'] ); ?></p>
                                        <?php endif; ?>

                                        <?php if(!empty( $settings['tg_hide_social'] )) : ?>
                                        <ul class="list-wrap footer__social">

                                            <?php if(!empty( $settings['tg_footer_twitter'] )) : ?>
                                            <li><a href="<?php echo esc_url( $settings['tg_footer_twitter'] ) ?>"><i class="fab fa-twitter"></i></a></li>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['tg_footer_discord'] )) : ?>
                                            <li><a href="<?php echo esc_url( $settings['tg_footer_discord'] ) ?>"><i class="fab fa-discord"></i></a></li>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['tg_footer_instagram'] )) : ?>
                                            <li><a href="<?php echo esc_url( $settings['tg_footer_instagram'] ) ?>"><i class="fab fa-instagram"></i></a></li>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['tg_footer_telegram'] )) : ?>
                                            <li><a href="<?php echo esc_url( $settings['tg_footer_telegram'] ) ?>"><i class="fab fa-telegram-plane"></i></a></li>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['tg_footer_youtube'] )) : ?>
                                            <li><a href="<?php echo esc_url( $settings['tg_footer_youtube'] ) ?>"><i class="fab fa-youtube"></i></a></li>
                                            <?php endif; ?>

                                        </ul>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty( $settings['tg_footer_copyright_show'] )) : ?>
                        <div class="copyright__wrapper">
                            <div class="row">

                                <?php if(!empty( $settings['tg_copyright_text'] )) : ?>
                                <div class="col-md-6">
                                    <div class="copyright__text">
                                        <p><?php echo tp_kses( $settings['tg_copyright_text'] ) ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="col-md-6">
                                    <div class="copyright__menu">
                                        <ul class="list-wrap">

                                            <?php foreach ( $settings['tg_copyright_list'] as $item) : ?>

                                                <?php if(!empty( $item['tg_copy_menu_url'] )) : ?>
                                                <li><a href="<?php echo esc_url( $item['tg_copy_menu_url'] ) ?>"><?php echo esc_html( $item['tg_copy_menu_text'] ) ?></a></li>
                                                <?php endif; ?>

                                            <?php endforeach; ?>

                                            <?php if(!empty( $settings['tg_footer_backtop_show'] )) : ?>
                                            <li class="backTop">
                                                <a href="javascript:void(0)" class="scroll-to-target" data-target="html"><i class="flaticon-arrowhead-up"></i></a>
                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </footer>
            <!-- footer-area-end -->

        <?php endif; ?>

    <?php
	}
}

$widgets_manager->register( new TG_Footer() );