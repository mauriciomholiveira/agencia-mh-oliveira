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
class TG_Team extends Widget_Base {

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
		return 'tg-team';
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
		return __( 'Team', 'tpcore' );
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

        // _tg_image
        $this->start_controls_section(
            '_tg_bg_section',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-2',
                ]
            ]
        );

        $this->add_control(
            'tg_bg',
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
                'default' => esc_html__('Meet the artists', 'tpcore'),
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

		// member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_item'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'team_name',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Team Name', 'tpcore' ),
                'default' => __( 'Steps Jobs', 'tpcore' ),
                'placeholder' => __( 'Type name here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Designation', 'tpcore' ),
                'default' => __( 'Artist', 'tpcore' ),
                'placeholder' => __( 'Type designation here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tpcore' ),
                'label_off' => __( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'discord_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Discord', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your discord link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'team_name' => esc_html__('Steps Jobs', 'tpcore'),
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'team_name' => esc_html__('Andry Moray', 'tpcore'),
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'team_name' => esc_html__('Zaid Ed', 'tpcore'),
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'team_name' => esc_html__('Laila Ed', 'tpcore'),
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'team_name' => esc_html__('Almaktari', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ team_name }}}',
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

            if ( !empty($settings['tg_bg']['url']) ) {
                $tg_bg_url = !empty($settings['tg_bg']['id']) ? wp_get_attachment_image_url( $settings['tg_bg']['id'], $settings['tg_bg_size_size']) : $settings['tg_bg']['url'];
                $tg_bg_alt = get_post_meta($settings["tg_bg"]["id"], "_wp_attachment_image_alt", true);
            }

		?>

	    <!-- style 2 -->
	    <?php if ( $settings['tp_design_style'] === 'layout-2' ):

            $this->add_render_attribute( 'title_args', 'class', 'title' );
        ?>

            <script>
                jQuery(document).ready(function($){

                    /*=============================================
                        =          Data Background               =
                    =============================================*/
                    $("[data-background]").each(function () {
                        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
                    })

                });
            </script>

            <!-- team-area -->
            <section class="team-area">
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

                    <div class="team__inner-wrap">

                        <?php if(!empty( $tg_bg_url )) : ?>
                            <div class="team__inner-bg" data-background="<?php echo esc_url($tg_bg_url); ?>"></div>
                        <?php endif; ?>

                        <div class="row justify-content-center">
                            <?php foreach ( $settings['teams'] as $item ) :

                                if ( !empty($item['image']['url']) ) {
                                    $tg_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                    $tg_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="team__item-two text-center">

                                    <?php if( !empty($tg_team_image_url) ) : ?>
                                    <div class="team__item-two-thumb">
                                        <img src="<?php echo esc_url($tg_team_image_url); ?>" alt="<?php echo esc_attr($tg_team_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>

                                    <div class="team__item-two-content">
                                        <h4 class="name"><?php echo tp_kses( $item['team_name'] ); ?></h4>

                                        <?php if( !empty($item['designation']) ) : ?>
                                            <span class="designation"><?php echo tp_kses( $item['designation'] ); ?></span>
                                        <?php endif; ?>

                                        <?php if( !empty($item['show_social'] ) ) : ?>
                                        <ul class="team__social-list list-wrap">
                                            <?php if( !empty($item['web_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['email_title'] ) ) : ?>
                                            <li><a href="mailto:<?php echo esc_html( $item['email_title'] ); ?>"><i class="far fa-envelope"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['phone_title'] ) ) : ?>
                                            <li><a href="tell:<?php echo esc_html( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['discord_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['discord_title'] ); ?>"><i class="fab fa-discord"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['behance_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- team-area-end -->

        <!-- style 3 -->
	    <?php elseif ( $settings['tp_design_style'] === 'layout-3' ):

            $this->add_render_attribute( 'title_args', 'class', 'title' );
        ?>

            <!-- team-area -->
            <section class="team-area team-style-three">
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

                    <div class="team__inner-wrap">
                        <div class="row justify-content-center">
                            <?php foreach ( $settings['teams'] as $item ) :

                                if ( !empty($item['image']['url']) ) {
                                    $tg_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                    $tg_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="team__item-two text-center">
                                    <?php if( !empty($tg_team_image_url) ) : ?>
                                    <div class="team__item-two-thumb">
                                        <img src="<?php echo esc_url($tg_team_image_url); ?>" alt="<?php echo esc_attr($tg_team_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>

                                    <div class="team__item-two-content">
                                        <h4 class="name"><?php echo tp_kses( $item['team_name'] ); ?></h4>

                                        <?php if( !empty($item['designation']) ) : ?>
                                            <span class="designation"><?php echo tp_kses( $item['designation'] ); ?></span>
                                        <?php endif; ?>

                                        <?php if( !empty($item['show_social'] ) ) : ?>
                                        <ul class="team__social-list list-wrap">
                                            <?php if( !empty($item['web_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['email_title'] ) ) : ?>
                                            <li><a href="mailto:<?php echo esc_html( $item['email_title'] ); ?>"><i class="far fa-envelope"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['phone_title'] ) ) : ?>
                                            <li><a href="tell:<?php echo esc_html( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['discord_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['discord_title'] ); ?>"><i class="fab fa-discord"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['behance_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                            <?php endif; ?>

                                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                                            <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- team-area-end -->

        <!-- style 4 -->
	    <?php elseif ( $settings['tp_design_style'] === 'layout-4' ):

            $this->add_render_attribute( 'title_args', 'class', 'title text-uppercase' );
        ?>

            <!-- team-area -->
            <section class="team-area">
                <div class="container">
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
                    <div class="team__grid-wrapper team__grid-wrapper-two" data-anime="targets: > *; opacity:[0, 1]; translateY:[24, 0]; onview: -400; delay: anime.stagger(100);">

                        <?php foreach ( $settings['teams'] as $item ) :

                            if ( !empty($item['image']['url']) ) {
                                $tg_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                $tg_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                        <div class="team__item text-center">
                            <?php if( !empty($tg_team_image_url) ) : ?>
                            <div class="team__item-thumb">
                                <img src="<?php echo esc_url($tg_team_image_url); ?>" alt="<?php echo esc_attr($tg_team_image_alt); ?>">
                            </div>
                            <?php endif; ?>

                            <div class="team__item-content">
                                <h4 class="name"><?php echo tp_kses( $item['team_name'] ); ?></h4>

                                <?php if( !empty($item['designation']) ) : ?>
                                    <span class="designation"><?php echo tp_kses( $item['designation'] ); ?></span>
                                <?php endif; ?>

                                <?php if( !empty($item['show_social'] ) ) : ?>
                                <ul class="team__social-list list-wrap">
                                    <?php if( !empty($item['web_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['email_title'] ) ) : ?>
                                    <li><a href="mailto:<?php echo esc_html( $item['email_title'] ); ?>"><i class="far fa-envelope"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['phone_title'] ) ) : ?>
                                    <li><a href="tell:<?php echo esc_html( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['facebook_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['twitter_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['discord_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['discord_title'] ); ?>"><i class="fab fa-discord"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['instagram_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['youtube_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['flickr_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['behance_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['dribble_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['gitub_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
            <!-- team-area-end -->

	    <!-- style default -->
	    <?php else :
	        $this->add_render_attribute( 'title_args', 'class', 'title' );
	    ?>

            <!-- team-area -->
            <section class="team-area">
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

                    <div class="team__grid-wrapper" data-anime="targets: > *; opacity:[0, 1]; translateY:[24, 0]; onview: -400; delay: anime.stagger(100);">

                        <?php foreach ( $settings['teams'] as $item ) :

                            if ( !empty($item['image']['url']) ) {
                                $tg_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                $tg_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                        <div class="team__item text-center">
                            <?php if( !empty($tg_team_image_url) ) : ?>
                            <div class="team__item-thumb">
                                <img src="<?php echo esc_url($tg_team_image_url); ?>" alt="<?php echo esc_attr($tg_team_image_alt); ?>">
                            </div>
                            <?php endif; ?>

                            <div class="team__item-content">
                                <h4 class="name"><?php echo tp_kses( $item['team_name'] ); ?></h4>

                                <?php if( !empty($item['designation']) ) : ?>
                                    <span class="designation"><?php echo tp_kses( $item['designation'] ); ?></span>
                                <?php endif; ?>

                                <?php if( !empty($item['show_social'] ) ) : ?>
                                <ul class="team__social-list list-wrap">
                                    <?php if( !empty($item['web_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['email_title'] ) ) : ?>
                                    <li><a href="mailto:<?php echo esc_html( $item['email_title'] ); ?>"><i class="far fa-envelope"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['phone_title'] ) ) : ?>
                                    <li><a href="tell:<?php echo esc_html( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['facebook_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['twitter_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['discord_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['discord_title'] ); ?>"><i class="fab fa-discord"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['instagram_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['youtube_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['flickr_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['behance_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['dribble_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['gitub_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
            <!-- team-area-end -->

    	<?php endif; ?>

	<?php
	}
}

$widgets_manager->register( new TG_Team() );