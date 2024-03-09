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
class TG_Collection extends Widget_Base {

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
		return 'tg-collection';
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
		return __( 'Nerko Collection', 'tpcore' );
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
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Latest artworks', 'tpcore'),
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

        // _tg_collection
		$this->start_controls_section(
            '_tg_collection',
            [
                'label' => esc_html__('Collection Lists', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'collection_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Collection Thumb', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'collection_name', [
                'label' => esc_html__('Collection Item Name', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#Metaverse', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'collection_link', [
                'label' => esc_html__('Collection Item Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'collection_author_name', [
                'label' => esc_html__('Author Name', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('TheSalvare', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'collection_author_link', [
                'label' => esc_html__('Author Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_collection_list',
            [
                'label' => esc_html__('Collection List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'collection_name' => esc_html__('#Metaverse', 'tpcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // tg_button_group
        $this->start_controls_section(
            'tg_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
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
            'tg_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View more in OPENSEA', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tg_button_show' => 'yes'
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
                    'tg_button_show' => 'yes'
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
                    'tg_button_show' => 'yes'
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
                    'tg_button_show' => 'yes'
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


		<?php if ( $settings['tg_design_style']  == 'layout-2' ):

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn gradient-btn');
            } else {
                if ( ! empty( $settings['tg_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tg-button-arg', $settings['tg_btn_link'] );
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn gradient-btn');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'title');

        ?>

            <script>
                jQuery(document).ready(function($){

                    /*=============================================
                        =        Collection Active		      =
                    =============================================*/
                    var collectionSwiper = new Swiper('.collection-three-active', {
                        // Optional parameters
                        loop: false,
                        slidesPerView: 4,
                        spaceBetween: 48,
                        breakpoints: {
                            '1500': {
                                slidesPerView: 4,
                            },
                            '1200': {
                                slidesPerView: 4,
                            },
                            '992': {
                                slidesPerView: 3,
                            },
                            '768': {
                                slidesPerView: 2,
                                centeredSlides: true,
                                centeredSlidesBounds: true,
                                spaceBetween: 35,
                            },
                            '576': {
                                slidesPerView: 2,
                                centeredSlides: true,
                                centeredSlidesBounds: true,
                                spaceBetween: 30,
                            },
                            '420': {
                                slidesPerView: 2,
                                centeredSlides: true,
                                centeredSlidesBounds: true,
                                spaceBetween: 20,
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

            <!-- collection-area -->
            <section class="collection-area">
                <div class="container">

                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[-24, 0]; onview: true; delay: 200;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-65">
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

                    <div class="collection__three-wrapper">
                        <div class="swiper-container collection-three-active swiper">
                            <div class="swiper-wrapper">

                                <?php foreach ( $settings['tg_collection_list'] as $item ) : ?>
                                <div class="swiper-slide">
                                    <div class="collection__three-item">
                                        <?php if( !empty( $item['collection_image']['url'] ) ) : ?>
                                        <div class="collection__three-thumb">
                                            <a href="<?php echo esc_url( $item['collection_link'] ); ?>"><img src="<?php echo esc_url( $item['collection_image']['url'] ); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid( $item['collection_image']['url'] ), '_wp_attachment_image_alt', true); ?>"></a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty( $item['collection_name'] || $item['collection_author_name'] )) : ?>
                                        <div class="collection__three-content">

                                            <?php if(!empty( $item['collection_name'] )) : ?>
                                                <h4 class="name"><a href="<?php echo esc_url( $item['collection_link'] ); ?>"><?php echo tp_kses( $item['collection_name'] ); ?></a></h4>
                                            <?php endif; ?>

                                            <?php if(!empty( $item['collection_author_name'] )) : ?>
                                                <span class="author"><?php echo esc_html__('By', 'tpcore') ?> <?php echo tp_kses( $item['collection_author_name'] ); ?></span>
                                            <?php endif; ?>

                                        </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                            <div class="tg-swiper-pagination"></div>
                        </div>
                        <!-- Navigation -->
                        <a aria-label="Prev" href="#prev" class="tg-swiper-prev"><i class="fas fa-chevron-left"></i></a>
                        <a aria-label="Next" href="#next" class="tg-swiper-next"><i class="fas fa-chevron-right"></i></a>
                    </div>

                    <?php if(!empty( $settings['tg_button_show'] )) : ?>
                    <div class="collection__btn text-center" data-anime="opacity:[0, 1]; translateY:[-24, 0]; onview: true; delay: 200;">
                        <a <?php echo $this->get_render_attribute_string( 'tg-button-arg' ); ?> ><span><?php echo $settings['tg_btn_text']; ?></span> <i class="unicon-arrow-up-right"></i></a>
                    </div>
                    <?php endif; ?>

                </div>
            </section>
            <!-- collection-area-end -->


		<?php else:

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn gradient-btn');
            } else {
                if ( ! empty( $settings['tg_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tg-button-arg', $settings['tg_btn_link'] );
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn gradient-btn');
                }
            }

			$this->add_render_attribute('title_args', 'class', 'title');

		?>

            <!-- collection-area -->
            <section class="collection-area">
                <div class="container">

                    <?php if (!empty( $settings['tg_section_title_show'] )): ?>
                    <div class="row justify-content-center" data-anime="opacity:[0, 1]; translateY:[-24, 0]; onview: true; delay: 200;">
                        <div class="col-xl-8 col-lg-10">
                            <div class="section__title text-center title-mb-65">
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

                    <div class="row collection__items-list" data-anime="targets: > * > *; opacity:[0, 1]; translateY:[48, 0]; onview: -100; delay: anime.stagger(100);">

                        <?php foreach ( $settings['tg_collection_list'] as $item ) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-11">
                            <div class="collection__item">

                                <?php if( !empty( $item['collection_image']['url'] ) ) : ?>
                                <div class="collection__item-thumb">
                                    <a href="<?php echo esc_url( $item['collection_link'] ); ?>"><img src="<?php echo esc_url( $item['collection_image']['url'] ); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid( $item['collection_image']['url'] ), '_wp_attachment_image_alt', true); ?>"></a>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $item['collection_name'] || $item['collection_author_name'] )) : ?>
                                <div class="collection__item-content">

                                    <?php if(!empty( $item['collection_name'] )) : ?>
                                    <h4 class="name"><a href="<?php echo esc_url( $item['collection_link'] ); ?>"><?php echo tp_kses( $item['collection_name'] ); ?></a></h4>
                                    <?php endif; ?>

                                    <?php if(!empty( $item['collection_author_name'] )) : ?>
                                    <span class="author"><?php echo esc_html__('By', 'tpcore') ?> <a href="<?php echo esc_url( $item['collection_author_link'] ); ?>"><?php echo tp_kses( $item['collection_author_name'] ); ?></a></span>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>

                    <?php if(!empty( $settings['tg_button_show'] )) : ?>
                    <div class="collection__btn text-center" data-anime="opacity:[0, 1]; translateY:[-24, 0]; onview: true; delay: 200;">
                        <a <?php echo $this->get_render_attribute_string( 'tg-button-arg' ); ?> ><span><?php echo $settings['tg_btn_text']; ?></span> <i class="unicon-arrow-right"></i></a>
                    </div>
                    <?php endif; ?>

                </div>
            </section>
            <!-- collection-area-end -->


        <?php endif; ?>

    <?php
	}
}

$widgets_manager->register( new TG_Collection() );