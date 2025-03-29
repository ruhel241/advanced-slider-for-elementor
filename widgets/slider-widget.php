<?php

namespace AdvancedSliderLite\Widgets;

use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use AdvancedSliderPro\Services\AdvancedSliderWidgetPro;

class AdvancedSliderLiteWidget extends Widget_Base
{
    public function get_name() 
    {
        return "ase-slider";
    }

    public function get_title() 
    {
        return esc_html__( 'Advanced Slider', 'advanced-slider-for-elementor' );
    }
    

    public function get_icon() 
    {
        return "eicon-slides";
    }

    public function get_keywords() {
		return ['slide', 'carousel', 'image', 'title', 'slider', 'advanced-slider-for-elementor'];
	}

    public function get_categories()
    {
       return ['basic'];
    }
   
    protected function register_controls()
    {
		$proNotice = [
			'title' => esc_html__( 'These are pro features', 'advanced-slider-for-elementor' ),
			'message' => esc_html__( 'These are pro features, if you want to enable these features you need to upgrade to the pro version.', 'advanced-slider-for-elementor' ),
			'link' => "https://wpcreativeidea.com/slider"
		];

        $this->start_controls_section(
			'ase_widget_content_section',
			[
				'label' => esc_html__( 'Slider', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );


        // repeater start
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ase_image', [
                'label' => esc_html__( 'Choose Image', 'advanced-slider-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                // 'default' => [
				// 	'url' => Utils::get_placeholder_image_src(),
				// ],
            ]
        );

        $repeater->add_control(
            'ase_title', [
                'label' => esc_html__( 'Title', 'advanced-slider-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Slider 1 Heading' , 'advanced-slider-for-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ase_content', [
                'label' => esc_html__( 'Content', 'advanced-slider-for-elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et. Aliquam erat volutpat. Vestibulum felis ex, ultrices posuere facilisis eget, malesuada quis elit. Nulla ac eleifend odio' , 'advanced-slider-for-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ase_button_text', [
                'label' => esc_html__( 'Button', 'advanced-slider-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Click Here' , 'advanced-slider-for-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ase_button_url',
            [
                'label'   => esc_html__( 'Button URL', 'advanced-slider-for-elementor' ),
                'type'    => Controls_Manager::URL,
                'dynamic'=> [
                    'active'  => true,
                ],
                'label_block' => true,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'ase_list',
            [
                'label' => esc_html__( 'Slider List', 'advanced-slider-for-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ase_title' => esc_html__( 'EASILY CHANGE TITLE, IMAGE, AND DESCRIPTION', 'advanced-slider-for-elementor' ),
                        'ase_content' => esc_html__( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et. Aliquam erat volutpat. Vestibulum felis ex, ultrices posuere facilisis eget, malesuada quis elit. Nulla ac eleifend odio', 'advanced-slider-for-elementor' ),
                    ],
                    [
                        'ase_title' => esc_html__( 'ADVANCED SLIDER FOR ELEMENTOR', 'advanced-slider-for-elementor' ),
                        'ase_content' => esc_html__( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et. Aliquam erat volutpat. Vestibulum felis ex, ultrices posuere facilisis eget, malesuada quis elit. Nulla ac eleifend odio', 'advanced-slider-for-elementor' ),
                    ],
                    [
                        'ase_title' => esc_html__( 'BECOME PART OF A GREAT STORY', 'advanced-slider-for-elementor' ),
                        'ase_content' => esc_html__( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et. Aliquam erat volutpat. Vestibulum felis ex, ultrices posuere facilisis eget, malesuada quis elit. Nulla ac eleifend odio', 'advanced-slider-for-elementor' ),
                    ],
                    
                ],
                'title_field' => '{{{ ase_title }}}',
            ]
        );
          // repeater end

        $this->end_controls_section();
        
        $this->start_controls_section(
			'ase_widget_background_style_section',
			[
				'label' => esc_html__( 'Additional Options', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

		if (defined('ADVANCED_SLIDER_PRO')) {
			(new AdvancedSliderWidgetPro)->additionalOptionsPro($this);
		} else {
			$this->add_control(
				'important_note_1',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => $this->get_pro_notice( [
						'title' => $proNotice['title'],
						'message' => $proNotice['message'],
						'link' => $proNotice['link'],
						'image-link' => 'additional-options.png'
					] ),
				]
			);
		}	
		
		
		$this->end_controls_section();

        $this->start_controls_section(
			'ase_slider_section',
			[
				'label' => esc_html__( 'Slider', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
			$this->add_responsive_control(
				'ase_slider_height',
				[
					'label' => esc_html__( 'Height', 'advanced-slider-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 100,
							'max' => 1000,
						],
						'vh' => [
							'min' => 10,
							'max' => 100,
						],
					],
					'default' => [
						'px' => '%',
						'size' => 400,
					],
					'size_units' => [ 'px', 'vh', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .ase-slider-container' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => defined('ADVANCED_SLIDER_PRO') ? ['ase_slider_auto_height' => ''] : [],
					// 'separator' => 'before'
				]
			);
        
			$this->add_responsive_control(
				'ase_slider_margin',
				[
					'label' => esc_html__( 'Margin', 'advanced-slider-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ase-slider-container .ase-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					// 'separator' => 'before'
				]
			);
        
			$this->add_responsive_control(
				'ase_slider_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-slider-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ase-slider-container .ase-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();

	// Background Start
		$this->start_controls_section(
			'ase_background_style_section',
			[
				'label' => esc_html__( 'Background', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'ase_widget_background_color',
					'types' => [ 'classic', 'gradient' ],
					'exclude' => [ 'image' ],
					'selector' => '{{WRAPPER}} .ase-slider-container',
					'fields_options' => [
						'background' => [
							'default' => 'gradient'
						],
						'color' => [
							'default' => '#6C27EA'
						]
					],
				]
			);
		$this->end_controls_section();
    // Background End

	// Background overlay Start
		$this->start_controls_section(
			'ase_background_overlay_style_section',
			[
				'label' => esc_html__( 'Background Overlay', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			
			if (defined('ADVANCED_SLIDER_PRO')) {
				(new AdvancedSliderWidgetPro)->backgroundOverlayPro($this);
			} else {
				$this->add_control(
					'important_notice_overlay',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => $this->get_pro_notice( [
							'title' => $proNotice['title'],
							'message' => $proNotice['message'],
							'link' => $proNotice['link'],
							'image-link' => 'overlay-options.png'
						] ),
					]
				);
			}
		$this->end_controls_section();
	// Background overlay End

    // Title Start
        $this->start_controls_section(
			'ase_widget_title_style_section',
			[
				'label' => esc_html__( 'Title', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

			if (defined('ADVANCED_SLIDER_PRO')) {
				(new AdvancedSliderWidgetPro)->titleOptionsPro($this);
			} else {
				$this->add_control(
					'important_notice_title',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => $this->get_pro_notice( [
							'title' => $proNotice['title'],
							'message' => $proNotice['message'],
							'link' => $proNotice['link'],
							'image-link' => 'text-options.png'
						] ),
					]
				);
			}
		$this->end_controls_section();
    // Title End

    // Content start
        $this->start_controls_section(
			'ase_widget_content_style_section',
			[
				'label' => esc_html__( 'Content', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		
		if (defined('ADVANCED_SLIDER_PRO')) {
			(new AdvancedSliderWidgetPro)->contentOptionsPro($this);
		} else {
			$this->add_control(
				'important_notice_content',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => $this->get_pro_notice( [
						'title' => $proNotice['title'],
						'message' => $proNotice['message'],
						'link' => $proNotice['link'],
						'image-link' => 'text-options.png'
					] ),
				]
			);
		}

        $this->end_controls_section();
    // Content End

    // Button Start
       	$this->start_controls_section(
			'ase_section_style_button',
			[
				'label' => esc_html__( 'Button', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		if (defined('ADVANCED_SLIDER_PRO')) {
			(new AdvancedSliderWidgetPro)->buttonOptionsPro($this);
		} else {
			$this->add_control(
				'important_notice_button',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => $this->get_pro_notice( [
						'title' => $proNotice['title'],
						'message' => $proNotice['message'],
						'link' => $proNotice['link'],
						'image-link' => 'button-options.png'
					] ),
				]
			);
		}

		$this->end_controls_section();

    // Button End
	
	// Arrows Start
		$this->start_controls_section(
			'ase_arrows_section',
			[
				'label' => esc_html__( 'Arrows Icon', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		
		if (defined('ADVANCED_SLIDER_PRO')) {
			(new AdvancedSliderWidgetPro)->arrowsOptionsPro($this);
		} else {
			$this->add_control(
				'important_notice_arrows',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => $this->get_pro_notice( [
						'title' => $proNotice['title'],
						'message' => $proNotice['message'],
						'link' => $proNotice['link'],
						'image-link' => 'arrow-options.png'
					] ),
				]
			);
		}

        $this->end_controls_section();
	// Arrows End

	// Dots Start
        $this->start_controls_section(
			'ase_dots_section',
			[
				'label' => esc_html__( 'Dots Icon', 'advanced-slider-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		
		if (defined('ADVANCED_SLIDER_PRO')) {
			(new AdvancedSliderWidgetPro)->dotsOptionsPro($this);
		} else {
			$this->add_control(
				'important_notice_dots',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => $this->get_pro_notice( [
						'title' => $proNotice['title'],
						'message' => $proNotice['message'],
						'link' => $proNotice['link'],
						'image-link' => 'dots-options.png'
					] ),
				]
			); 
		}

        $this->end_controls_section();
	// Dots End
    }

	public function get_pro_notice( $proNotice ) {
		ob_start();
	?>
		<div class="ase-nerd-box">
			<div class="image-box">
				<img class="ase-nerd-box-icon" src="<?php echo esc_url( ASE_PLUGIN_URL . 'assets/images/' .$proNotice['image-link'] ); ?>" />
			</div>
			<div class="ase-nerd-box-title">
				<?php Utils::print_unescaped_internal_string( $proNotice['title'] ); ?>
			</div>
			<div class="ase-nerd-box-message">
				<?php Utils::print_unescaped_internal_string( $proNotice['message'] ); ?> <br/><br/>
			</div><br/>
			<a href="<?php echo esc_url( ( $proNotice['link'] ) ); ?>" class="ase-nerd-box-link ase-button ase-button-default ase-button-go-pro" target="_blank">
				<?php echo esc_html__( 'Upgrade Now', 'advanced-slider-for-elementor' ); ?>
			</a>
		</div>
	<?php
		return ob_get_clean();
	}
	

    protected function render()
    {
		$settings = $this->get_settings_for_display();
		
		if ( $settings['ase_list'] ) {
           echo esc_html( $this->html($settings) );
        }
    }


	public function html($settings)
	{   
		$buttonSize       = 'sm';
		$showDots         = 'dots';
		$showArrows       = 'arrows';
		$titleAnimation   = '';
		$contentAnimation = '';
		$btnAnimation     = '';
		
		$this->add_render_attribute( 
			'ase_options', 
			[   
				'id'                  => 'ase-slider-' . intval($this->get_id()),
				'class'               => ['swiper ase-slider-container'],
				'data-pagination'     => '.swiper-pagination',
				'data-button-next'    => '.swiper-button-next',
				'data-button-prev'    => '.swiper-button-prev',
			]
		);

		if (defined('ADVANCED_SLIDER_PRO')) {
			
			$loop             = ($settings['ase_slider_loop'] === 'yes') ? 'true' : 'false';
			$autoPlay         = ($settings['ase_slider_autoplay'] === 'yes') ? 'true' : 'false';
			$autoHeight       = ($settings['ase_slider_auto_height'] === 'yes') ? 'true' : 'false';
			$showDots         = (in_array($settings['navigation'], ['dots', 'both']));
			$showArrows       = (in_array($settings['navigation'], ['arrows', 'both']));
			$transition       = sanitize_text_field($settings['ase_transition']);
			$slideSpeed       = intval($settings['ase_slider_slide_speed']);
			$spaceBetween     = intval($settings['ase_space_between']['size']);
			$buttonSize       = sanitize_text_field($settings['ase_button_size']);
			$mousewheel       = ($settings['ase_mousewheel'] === 'yes') ? 'true' : 'false';
			$keyboard         = ($settings['ase_keyboard'] === 'yes') ? 'true' : 'false';
			$direction        = sanitize_text_field($settings['ase_direction']);
			$titleAnimation   = sanitize_text_field($settings['ase_title_animation']);
			$contentAnimation = sanitize_text_field($settings['ase_content_animation']);
			$btnAnimation     = sanitize_text_field($settings['ase_btn_animation']);

			$this->add_render_attribute( 
				'ase_options', 
				[   
					'data-loop'          => $loop,
					'data-autoplay'      => $autoPlay,
					'data-auto-height'   => $autoHeight,
					'data-transition'    => $transition,
					'data-slider-speed'  => $slideSpeed,
					'data-space-between' => $spaceBetween,
					'data-mousewheel'    => $mousewheel,
					'data-keyboard'      => $keyboard,
					'data-direction'     => $direction
				]
			);
		}
	?>
	
		<div <?php echo wp_kses_post($this->get_render_attribute_string('ase_options')); ?>>
			<div class="swiper-wrapper">
				<?php 
					foreach ($settings['ase_list'] as $index => $item): 
						// Ensure item values are sanitized
						$item_id = isset($item['_id']) ? sanitize_text_field($item['_id']) : '';
						$sliderButtonURLKey = $this->get_repeater_setting_key('ase_button_url', 'ase_list', $index);
						
						if (!empty($item['ase_button_url']['url'])) {
							$this->add_link_attributes($sliderButtonURLKey, $item['ase_button_url']);
							$this->add_render_attribute($sliderButtonURLKey, 'class', ['elementor-button', 'ase-slide-button', 'elementor-size-' . $buttonSize]);
						}
				?>  
					<div id="<?php echo 'ase-slider-' . esc_attr($item_id); ?>" class="swiper-slide ase-slider">
						<div class="ase-background-overlay" style="background-image: url(<?php echo esc_url(isset($item['ase_image']['url']) ? $item['ase_image']['url'] : ''); ?>)"></div>
						
						<div class="ase-swiper-slide-inner">
							<?php if (!empty($item['ase_title'])): ?>
								<h1 class="title slider-title-<?php echo esc_attr($titleAnimation); ?>">
									<?php echo esc_html($item['ase_title']); ?>
								</h1>
							<?php endif; ?>
							
							<?php if (!empty($item['ase_content'])): ?>
								<p class="content slider-content-<?php echo esc_attr($contentAnimation); ?>">
									<?php echo esc_html($item['ase_content']); ?>
								</p>
							<?php endif; ?>

							<?php if (!empty($item['ase_button_text']) && !empty($item['ase_button_url']['url'])): ?>
								<div class="btn slider-btn-<?php echo esc_attr($btnAnimation); ?>">
									<a <?php echo wp_kses_post($this->get_render_attribute_string($sliderButtonURLKey)); ?>>
										<?php echo esc_html($item['ase_button_text']); ?>
									</a>
								</div>
							<?php endif; ?>
							
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
			<?php 
				if ($showDots) {
					echo '<div class="swiper-pagination"></div>';
				}
				if ($showArrows) {
					echo '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
				}
			?>
		</div>

		<?php
	}


	protected function content_template() {
	 ?>
	 <#
		var buttonSize = 'sm';
		var showDots = false;
		var showArrows = false;
		var titleAnimation = '';
		var contentAnimation = '';
		var btnAnimation = '';
		
		if (settings.ase_button_size) {
			buttonSize = settings.ase_button_size;
		}
		
		showDots = ('dots' === settings.navigation || 'both' === settings.navigation);
		showArrows = ('arrows' === settings.navigation || 'both' === settings.navigation);
		
		if (settings.ase_title_animation) {
			titleAnimation = settings.ase_title_animation;
		}
		
		if (settings.ase_content_animation) {
			contentAnimation = settings.ase_content_animation;
		}
		
		if (settings.ase_btn_animation) {
			btnAnimation = settings.ase_btn_animation;
		}
		
		view.addRenderAttribute(
			'ase_options',
			{
				'id': 'ase-slider-' + view.getID(),
				'class': ['swiper', 'ase-slider-container'],
				'data-pagination': '.swiper-pagination',
				'data-button-next': '.swiper-button-next',
				'data-button-prev': '.swiper-button-prev'
			}
		);
		
		if (typeof ADVANCED_SLIDER_PRO !== 'undefined') {
			var loop = (settings.ase_slider_loop === 'yes') ? 'true' : 'false';
			var autoPlay = (settings.ase_slider_autoplay === 'yes') ? 'true' : 'false';
			var autoHeight = (settings.ase_slider_auto_height === 'yes') ? 'true' : 'false';
			var mousewheel = (settings.ase_mousewheel === 'yes') ? 'true' : 'false';
			var keyboard = (settings.ase_keyboard === 'yes') ? 'true' : 'false';
			
			view.addRenderAttribute(
				'ase_options',
				{
					'data-loop': loop,
					'data-autoplay': autoPlay,
					'data-auto-height': autoHeight,
					'data-transition': settings.ase_transition,
					'data-slider-speed': settings.ase_slider_slide_speed,
					'data-space-between': settings.ase_space_between.size,
					'data-mousewheel': mousewheel,
					'data-keyboard': keyboard,
					'data-direction': settings.ase_direction
				}
			);
		}
		#>
		
		<div {{{ view.getRenderAttributeString('ase_options') }}}>
			<div class="swiper-wrapper">
				<# _.each(settings.ase_list, function(item, index) { 
					var sliderButtonURLKey = view.getRepeaterSettingKey('ase_button_url', 'ase_list', index);
					
					if (item.ase_button_url && item.ase_button_url.url) {
						view.addRenderAttribute(sliderButtonURLKey, 'href', item.ase_button_url.url);
						view.addRenderAttribute(sliderButtonURLKey, 'class', ['elementor-button', 'ase-slide-button', 'elementor-size-' + buttonSize]);
						
						if (item.ase_button_url.is_external) {
							view.addRenderAttribute(sliderButtonURLKey, 'target', '_blank');
						}
						
						if (item.ase_button_url.nofollow) {
							view.addRenderAttribute(sliderButtonURLKey, 'rel', 'nofollow');
						}
					}
				#>
					<div id="ase-slider-{{ item._id }}" class="swiper-slide ase-slider">
						<# if (item.ase_image && item.ase_image.url) { #>
							<div class="ase-background-overlay" style="background-image: url({{ item.ase_image.url }})"></div>
						<# } #>
						
						<div class="ase-swiper-slide-inner">
							<# if (item.ase_title) { #>
								<h1 class="title slider-title-{{ titleAnimation }}">
									{{ item.ase_title }}
								</h1>
							<# } #>
							
							<# if (item.ase_content) { #>
								<p class="content slider-content-{{ contentAnimation }}">
									{{ item.ase_content }}
								</p>
							<# } #>

							<# if (item.ase_button_text && item.ase_button_url && item.ase_button_url.url) { #>
								<div class="btn slider-btn-{{ btnAnimation }}">
									<a {{{ view.getRenderAttributeString(sliderButtonURLKey) }}}>
										{{ item.ase_button_text }}
									</a>
								</div>
							<# } #>
						</div>
					</div>
				<# }); #>
			</div>
			
			<# if (showDots) { #>
				<div class="swiper-pagination"></div>
			<# } #>
			
			<# if (showArrows) { #>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			<# } #>
		</div>
	 <?php
	}

} 