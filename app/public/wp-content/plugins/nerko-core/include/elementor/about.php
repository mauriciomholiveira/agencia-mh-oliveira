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
class TG_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tpcore' );
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
                'default' => esc_html__('About the platform', 'tpcore'),
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

        // About group
        $this->start_controls_section(
            'tg_about', [
                'label' => esc_html__('About List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tg_about_type',
            [
                'label' => esc_html__('Select Style Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'fact' => esc_html__('Fact Style', 'tpcore'),
                    'icon' => esc_html__('Icon Style', 'tpcore'),
                    'link' => esc_html__('Link Style', 'tpcore'),
                ],
                'default' => 'fact',
            ]
        );

        $repeater->add_control(
            'about_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'About Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_sub_title', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Create and Invest', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_about_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Create your own NFT', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_about_desc', [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => tp_kses('<p>Multiple Chains, One Home. Stack up all your NFTs from across blockchains.</p>', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_about_fact_number01', [
                'label' => esc_html__('Fact Number 01', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('4,500+', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'fact'
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_fact_desc01', [
                'label' => esc_html__('Fact Desc 01', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => tp_kses('Collections Indexed <br> every 5mins.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'fact'
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_fact_number02', [
                'label' => esc_html__('Fact Number 02', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('2.5x', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'fact'
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_fact_desc02', [
                'label' => esc_html__('Fact Desc 02', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => tp_kses('Difference in Floor & Estimated NFT Value', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'fact'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_about_icon01',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tg_about_type' => ['icon', 'link']
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tg_about_icon_selected01',
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
                        'tg_about_type' => ['icon', 'link']
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tg_about_icon_content01', [
                'label' => esc_html__('Icon content 01', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => tp_kses('Collections Indexed every 5mins.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'icon'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_about_icon02',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tg_about_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tg_about_icon_selected02',
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
                        'tg_about_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tg_about_icon_content02', [
                'label' => esc_html__('Icon content 02', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => tp_kses('Difference in Floor & Estimated Value', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'icon'
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Learn more', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_about_type' => 'link'
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_link_type',
            [
                'label' => esc_html__( 'Choose Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tg_about_type' => 'link'
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_link',
            [
                'label' => esc_html__( 'Choose your link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tg_about_link_type' => '1',
                    'tg_about_type' => 'link',
                ]
            ]
        );

        $repeater->add_control(
            'tg_about_page_link',
            [
                'label' => esc_html__( 'Select Choose Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tg_about_link_type' => '2',
                    'tg_about_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'tg_about_list',
            [
                'label' => esc_html__('About - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_about_sub_title' => esc_html__('Create and Invest', 'tpcore'),
                    ],
                    [
                        'tg_about_sub_title' => esc_html__('Sync and Track', 'tpcore')
                    ],
                ],
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


            <!-- about-area -->
            <section class="about-area about-style-two">
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

                    <div class="about__row-reverse">
                        <?php foreach ( $settings['tg_about_list'] as $key => $item ) :
                            $item_img_select = $key == 0 ? '-' : '';
                            $item_content_select = $key == 0 ? '' : '-';
                            // Link
                            if ('2' == $item['tg_about_link_type']) {
                                $link = get_permalink($item['tg_about_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tg_about_link']['url']) ? $item['tg_about_link']['url'] : '';
                                $target = !empty($item['tg_about_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tg_about_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                        <div class="row align-items-center">

                            <?php if( !empty( $item['about_image']['url'] ) ) : ?>
                            <div class="col-lg-6">
                                <div class="about__img" data-anime="opacity:[0, 1]; translateX:[<?php echo esc_html( $item_img_select )?>24, 0]; onview: -250; delay: 200;">
                                    <img src="<?php echo esc_url( $item['about_image']['url'] ); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid( $item['about_image']['url'] ), '_wp_attachment_image_alt', true); ?>">
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-6">
                                <div class="about__content" data-anime="opacity:[0, 1]; translateX:[<?php echo esc_html( $item_content_select )?>24, 0]; onview: -250; delay: 300;">

                                    <div class="section__title text-start">
                                        <?php if(!empty( $item['tg_about_sub_title'] )) : ?>
                                            <span class="sub-title tg-text-gradient"><?php echo esc_html( $item['tg_about_sub_title'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if(!empty( $item['tg_about_title'] )) : ?>
                                            <h2 class="title"><?php echo tp_kses( $item['tg_about_title'] ); ?></h2>
                                        <?php endif; ?>
                                    </div>

                                    <?php if(!empty( $item['tg_about_desc'] )) : ?>
                                        <?php echo tp_kses( $item['tg_about_desc'] ); ?>
                                    <?php endif; ?>

                                    <?php if ($item['tg_about_type']  == 'link') : ?>
                                    <div class="about__content-text-btn">
                                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url( $link ); ?>"><span><?php echo esc_html( $item['tg_about_btn_text'] ); ?></span><i class="unicon-arrow-up-right"></i></a>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- about-area-end -->


        <?php elseif ( $settings['tg_design_style']  == 'layout-3' ):

			$this->add_render_attribute('title_args', 'class', 'title text-uppercase');
        ?>


            <!-- about-area -->
            <section class="about-area about-style-three">
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

                    <div class="about__row-reverse">

                        <?php foreach ( $settings['tg_about_list'] as $key => $item ) :
                            $item_img_select = $key == 0 ? '-' : '';
                            $item_content_select = $key == 0 ? '' : '-';

                            // Link
                            if ('2' == $item['tg_about_link_type']) {
                                $link = get_permalink($item['tg_about_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tg_about_link']['url']) ? $item['tg_about_link']['url'] : '';
                                $target = !empty($item['tg_about_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tg_about_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                        <div class="row align-items-center">

                            <?php if( !empty( $item['about_image']['url'] ) ) : ?>
                            <div class="col-lg-6">
                                <div class="about__img" data-anime="opacity:[0, 1]; translateX:[<?php echo esc_html( $item_img_select )?>24, 0]; onview: -250; delay: 200;">
                                    <img src="<?php echo esc_url( $item['about_image']['url'] ); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid( $item['about_image']['url'] ), '_wp_attachment_image_alt', true); ?>">
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-6">
                                <div class="about__content" data-anime="opacity:[0, 1]; translateX:[<?php echo esc_html( $item_content_select )?>24, 0]; onview: -250; delay: 300;">
                                    <div class="section__title text-start">

                                        <?php if(!empty( $item['tg_about_sub_title'] )) : ?>
                                            <span class="sub-title tg-text-gradient"><?php echo esc_html( $item['tg_about_sub_title'] ); ?></span>
                                        <?php endif; ?>

                                        <?php if(!empty( $item['tg_about_title'] )) : ?>
                                        <h2 class="title text-uppercase"><?php echo tp_kses( $item['tg_about_title'] ); ?></h2>
                                        <?php endif; ?>

                                    </div>

                                    <?php if(!empty( $item['tg_about_desc'] )) : ?>
                                        <?php echo tp_kses( $item['tg_about_desc'] ); ?>
                                    <?php endif; ?>

                                    <?php if ($item['tg_about_type']  == 'link') : ?>
                                    <div class="about__content-btn">
                                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url( $link ); ?>"><span><?php echo esc_html( $item['tg_about_btn_text'] ); ?></span>

                                            <?php if(!empty( $item['tg_about_icon01']) || !empty($item['tg_about_icon_selected01']['value']) ) : ?>
                                                    <?php tp_render_icon($item, 'tg_about_icon01', 'tg_about_icon_selected01'); ?>
                                            <?php endif; ?>

                                        </a>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
            <!-- about-area-end -->


		<?php else:
			$this->add_render_attribute('title_args', 'class', 'title');
		?>

        <!-- about-area -->
        <section class="about-area">
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

                <div class="about__row-reverse">

                    <?php foreach ( $settings['tg_about_list'] as $key => $item ) :
                        $item_img_select = $key == 0 ? '-' : '';
                        $item_content_select = $key == 0 ? '' : '-';
                    ?>
                    <div class="row align-items-center">

                        <?php if( !empty( $item['about_image']['url'] ) ) : ?>
                            <div class="col-lg-6">
                                <div class="about__img" data-anime="opacity:[0, 1]; translateX:[<?php echo esc_html( $item_img_select )?>24, 0]; onview: -250; delay: 200;">
                                    <img src="<?php echo esc_url( $item['about_image']['url'] ); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid( $item['about_image']['url'] ), '_wp_attachment_image_alt', true); ?>">
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-6">
                            <div class="about__content" data-anime="opacity:[0, 1]; translateX:[<?php echo esc_html( $item_content_select )?>24, 0]; onview: -250; delay: 300;">

                                <div class="section__title text-start">
                                    <?php if(!empty( $item['tg_about_sub_title'] )) : ?>
                                        <span class="sub-title tg-text-gradient"><?php echo esc_html( $item['tg_about_sub_title'] ); ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty( $item['tg_about_title'] )) : ?>
                                        <h2 class="title"><?php echo tp_kses( $item['tg_about_title'] ); ?></h2>
                                    <?php endif; ?>
                                </div>

                                <?php if(!empty( $item['tg_about_desc'] )) : ?>
                                    <?php echo tp_kses( $item['tg_about_desc'] ); ?>
                                <?php endif; ?>

                                <?php if ( $item['tg_about_type']  == 'icon' ) : ?>

                                    <?php if(!empty($item['tg_about_icon01']) || !empty($item['tg_about_icon_selected01']['value']) || !empty($item['tg_about_icon_content01']) || !empty($item['tg_about_icon02']) || !empty($item['tg_about_icon_selected02']['value']) || !empty($item['tg_about_icon_content02'])) : ?>

                                    <div class="about__facts-list">

                                        <?php if(!empty( $item['tg_about_icon01'] ) || !empty($item['tg_about_icon_selected01']['value']) || !empty($item['tg_about_icon_content01'] )) : ?>
                                        <div class="about__icon-box">

                                            <?php if(!empty( $item['tg_about_icon01']) || !empty($item['tg_about_icon_selected01']['value']) ) : ?>
                                                <div class="icon">
                                                    <?php tp_render_icon($item, 'tg_about_icon01', 'tg_about_icon_selected01'); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(!empty( $item['tg_about_icon_content01'] )) : ?>
                                                <p><?php echo tp_kses( $item['tg_about_icon_content01'] ); ?></p>
                                            <?php endif; ?>

                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty( $item['tg_about_icon02']) || !empty($item['tg_about_icon_selected02']['value']) || !empty($item['tg_about_icon_content02']) ) : ?>
                                        <div class="about__icon-box">

                                            <?php if(!empty( $item['tg_about_icon02']) || !empty($item['tg_about_icon_selected02']['value']) ) : ?>
                                                <div class="icon">
                                                    <?php tp_render_icon($item, 'tg_about_icon02', 'tg_about_icon_selected02'); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(!empty( $item['tg_about_icon_content02'] )) : ?>
                                                <p><?php echo tp_kses( $item['tg_about_icon_content02'] ); ?></p>
                                            <?php endif; ?>

                                        </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php endif; ?>

                                <?php else: ?>

                                    <?php if(!empty($item['tg_about_fact_number01']) || !empty($item['tg_about_fact_desc01']) || !empty($item['tg_about_fact_number02']) || !empty($item['tg_about_fact_desc02'])) : ?>
                                    <div class="about__facts-list">

                                        <?php if(!empty( $item['tg_about_fact_number01'] || $item['tg_about_fact_desc01'] )) : ?>
                                        <div class="about__fact-item">
                                            <?php if(!empty( $item['tg_about_fact_number01'] )) : ?>
                                                <h3 class="count"><?php echo esc_html( $item['tg_about_fact_number01'] ); ?></h3>
                                            <?php endif; ?>

                                            <?php if(!empty( $item['tg_about_fact_desc01'] )) : ?>
                                                <p><?php echo tp_kses( $item['tg_about_fact_desc01'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty( $item['tg_about_fact_number02'] || $item['tg_about_fact_desc02'] )) : ?>
                                        <div class="about__fact-item">
                                            <?php if(!empty( $item['tg_about_fact_number02'] )) : ?>
                                                <h3 class="count"><?php echo esc_html( $item['tg_about_fact_number02'] ); ?></h3>
                                            <?php endif; ?>

                                            <?php if(!empty( $item['tg_about_fact_desc02'] )) : ?>
                                                <p><?php echo tp_kses( $item['tg_about_fact_desc02'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </section>
        <!-- about-area-end -->

        <?php endif; ?>

    <?php
	}
}

$widgets_manager->register( new TG_About() );