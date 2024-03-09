<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nerko Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_FAQ extends Widget_Base {

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
		return 'tp-faq';
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
		return __( 'FAQ', 'tpcore' );
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
                'default' => esc_html__('Asked Questions', 'tpcore'),
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

        // Accordion
		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'What is Nerko\'s NFT Collection?' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => tp_kses('<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'What is Nerko\'s NFT Collection?', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'How we can buy and invest NFT?', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'Why we should choose Nerko\'s NFT?', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'Where we can buy and sell NFts?', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'How secure is this token?', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

        // _faq_image
        $this->start_controls_section(
            '_tg_faq_shape_section',
            [
                'label' => esc_html__('FAQ Image', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'tg_faq_img',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_img_size',
                'default' => 'full',
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
		$settings = $this->get_settings_for_display(); ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <!-- faq-area -->
            <section class="faq-area faq-style-two">
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
                        <div class="col-xxl-7 col-xl-9 col-lg-10">
                            <div class="faq__wrapper" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                                <div class="accordion" id="accordionFaq">
                                    <?php foreach ( $settings['accordions'] as $index => $item) :
                                        $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                        $aria_expanded = ($index == '0' ) ? "true" : "false";
                                        $show = ($index == '0' ) ? "show" : "";
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                            <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                                <?php echo esc_html( $item['accordion_title'] ); ?>
                                            </button>
                                        </h2>
                                        <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionFaq">
                                            <div class="accordion-body">
                                                <?php echo tp_kses( $item['accordion_description'] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- faq-area-end -->


        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ):

            // Image
            if ( !empty($settings['tg_faq_img']['url']) ) {
                $tg_faq_image = !empty($settings['tg_faq_img']['id']) ? wp_get_attachment_image_url( $settings['tg_faq_img']['id'], $settings['tg_img_size_size']) : $settings['tg_faq_img']['url'];
                $tg_faq_alt  = get_post_meta($settings["tg_faq_img"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title text-uppercase');

        ?>

            <!-- faq-area -->
            <section class="faq-area faq-style-two faq-style-three">
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

                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="faq__wrapper">
                                <div class="accordion" id="accordionFaq">

                                    <?php foreach ( $settings['accordions'] as $index => $item) :
                                        $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                        $aria_expanded = ($index == '0' ) ? "true" : "false";
                                        $show = ($index == '0' ) ? "show" : "";
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                            <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                                <?php echo esc_html( $item['accordion_title'] ); ?>
                                            </button>
                                        </h2>
                                        <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionFaq">
                                            <div class="accordion-body">
                                                <?php echo tp_kses( $item['accordion_description'] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                        <?php if(!empty( $tg_faq_image )) : ?>
                        <div class="col-xl-6 col-lg-8">
                            <div class="faq__img">
                                <img src="<?php echo esc_url($tg_faq_image); ?>" alt="<?php echo esc_attr($tg_faq_alt); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- faq-area-end -->


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <!-- faq-area -->
            <section class="faq-area">
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
                        <div class="col-xxl-7 col-xl-9 col-lg-10">
                            <div class="faq__wrapper" data-anime="opacity:[0, 1]; translateY:[24, 0]; onview: true; delay: 100;">
                                <div class="accordion" id="accordionFaq">
                                    <?php foreach ( $settings['accordions'] as $index => $item) :
                                        $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                        $aria_expanded = ($index == '0' ) ? "true" : "false";
                                        $show = ($index == '0' ) ? "show" : "";
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                            <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                                <?php echo esc_html( $item['accordion_title'] ); ?>
                                            </button>
                                        </h2>
                                        <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionFaq">
                                            <div class="accordion-body">
                                                <?php echo tp_kses( $item['accordion_description'] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- faq-area-end -->

        <?php endif; ?>

	<?php
	}

}

$widgets_manager->register( new TP_FAQ() );