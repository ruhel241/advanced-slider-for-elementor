<?php

namespace AdvancedSliderLite\Classes;

use Elementor\Settings;

class AdminPageHandler {

	public function initialLoad()
	{
		if ( is_admin() ) {
			$page_id = Settings::PAGE_ID;
			add_action( "elementor/admin/after_create_settings/{$page_id}", function( Settings $settings ) {
				$this->register_settings_fields($settings);
			}, 11 );
		}
	}

    public function register_settings_fields($settings)
	{
		$settings->add_tab(
			'ase-settings', [
				'label' => esc_html__( 'ASE Settings', 'advanced-slider-for-elementor' ),
				'sections' => [
					'ase-plugins-section' => [
						'label' => esc_html__( '', 'advanced-slider-for-elementor' ),
						'callback' => function() {
							$this->renderPage();
						},
						'fields' => []
					],
					'ase-license-section' => [
						'callback' => function() {
							$this->licenseRender();
						},
						'fields' => []
					]
				]
			]
		);
	}


    public function renderPage()
    {
		$data = $this->getAddons(); 
	?>
		<div class="notice notice-success" id="ase-notice-success" style="display: none">
			<p>The Advanced Testimonial Pro license activated.</p>
		</div>

		<div class="notice notice-error" id="ase-notice-error" style="display: none">
			<p>Something is wrong!</p>
		</div>

        <?php if (defined('ADVANCED_SLIDER_PRO')) :?>
            <div class="ase-settings-tabs">
                <ul class="menu-tabs">
                    <li class="tab"> <a href="#tab-ase-settings" id="ase-addons-tab">Recommended Addons</a> </li>
                    <li class="tab"> <a href="#tab-ase-settings" id="ase-license-tab">License Settings</a> </li>
                </ul>
            </div>
        <?php endif; ?>
		
		<div class="ase-addons-wrapper">
			<div class="ase-addons-heading">
				<h1 style="display: initial"> Elementor Recommended Addons </h1>
				<p>	These are the Elementor addons that will help your business. </p>  
			</div>

			<div class="ase-addons-wrap">
				<?php foreach ($data as $key => $value):?>
					<div class="ase-addons-templates">
						<div class="addons-box">
							<div class="image">
								<img src="<?php echo esc_url( ASE_PLUGIN_URL . 'assets/images/'. $value['logo']); ?>" alt="">
							</div>
							<h2> <?php echo $value['title']; ?> </h2>
							<p><?php echo $value['description']; ?></p>
							<div class="btn-box">
								<?php
									if (!$value['is_installed']):
								?>	<a class="btn ase-install-addon" value="<?php echo $value['route']; ?>">
										<?php echo $value['action_text']; ?>
									</a>
								<?php else: ?>
									<a href="<?php echo $value['settings_url']; ?>" class="viewInstall" target="_blank">
										View Settings
									</a>
								<?php endif; ?>
								<a href="<?php echo $value['upgrade_to_pro_link']; ?>" class="upgrade-to-pro" target="_blank">Upgrade to Pro</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php
    }
   
   
    /**
     * Add page to admin menu callback
     */
	public function licenseRender() {
		?>
			<div class="notice notice-success" id="ase-notice-success" style="display: none">
				<p>The Advanced Slider Pro Addon license activated.</p>
			</div>

			<div class="notice notice-error" id="ase-notice-error" style="display: none">
				<p>Something is wrong!</p>
			</div>

			<div class="ase_license_box" style="display:none">
				<div id="ase_activated_license" style="display: none">
					<h3 class="title">Please Provide a license key of Advanced Slider Pro Addon</h3> 
					<div class="ase-input ase-input-group ase-input-group--append">
						<input type="text" id="ase_license_settings_field" placeholder="License Key" class="ase_input__inner">
						<div class="ase-input-group__append">
							<a href="#" id="ase_verify_btn" class="ase-button ase-button--success">
								&#128274; Verify License
							</a>
						</div>
					</div> 
					<hr style="margin: 20px 0px 30px;"> 
					<p>Don't have a license key? <a href="https://wpcreativeidea.com/" target="_blank" style="cursor:pointer">Purchase one here</a></p>
				</div>
				<div id="ase_deactivated_license" style="display: none">
					<div class="text-align-center">
						<span style="font-size: 50px;" class="el-icon el-icon-circle-check"></span>
					</div>
					<h2>You license key is valid and activated</h2>
					<hr style="margin: 20px 0px;" />
					<p>Want to deactivate this license? <a id="ase_deactive_license" href="#">Click here</a></p>
				</div>
				<div id="asebooster-loading" style="display: none">
					<h2> Loading..... </h2>
				</div>
			</div>
		<?php
	}


	/**
	 *  Addons Data
	 */

    public function getAddons()
    {
        $data = [
			'advanced-slider'    => [
                'title'          => __('Advanced Slider for Elementor', 'advanced-testimonial-carousel-for-elementor'),
                'logo'           => 'slider-logo.png',
                'is_installed'   => defined('ASE_PLUGIN_VERSION'),
                'upgrade_to_pro_link' => 'https://wpcreativeidea.com/slider',
                'settings_url'   => admin_url('admin.php?page=elementor#tab-ase-settings'),
                'action_text'    => __('Install Slider', 'advanced-testimonial-carousel-for-elementor'),
				'route'			 => 'install-ase',
                'description'    => __('Advanced Slider for Elementor. You can add background image, title, content and button, added Unlimited slider. You can customize background, title, describes and button. Additional options etc.Additional options, Styling title, content, button, background Overlay etc pro features.', 'advanced-testimonial-carousel-for-elementor')
            ],

			'advanced-testimonial' => [
                'title'          => __('Advanced Testimonial Carousel For Elementor', 'advanced-testimonial-carousel-for-elementor'),
                'logo'           => 'testimonial-logo.png',
                'is_installed'   => defined('ATC_PLUGIN_VERSION'),
                'upgrade_to_pro_link' => 'https://wpcreativeidea.com/testimonial',
                'settings_url'   => admin_url('admin.php?page=elementor#tab-atc-settings'),
                'action_text'    => __('Install Testimonial', 'advanced-testimonial-carousel-for-elementor'),
				'route'			 => 'install-atc',
                'description'    => __('Advanced Testimonial Carousel for Elementor. You can add image, name, describes, title, added Unlimited slider.
				You can customize image, name, describes, title. Additional options etc.', 'advanced-testimonial-carousel-for-elementor')
            ],

			'advanced-image-comparison'  => [
                'title'          => __('Advanced Image Comparison for Elementor', 'advanced-testimonial-carousel-for-elementor'),
                'logo'           => 'image-comparison-logo.png',
                'is_installed'   => defined('AIC_PLUGIN_VERSION'),
                'upgrade_to_pro_link' => 'https://wpcreativeidea.com/image-comparison',
                'settings_url'   => admin_url('admin.php?page=elementor#tab-aic-settings'),
                'action_text'    => __('Install Comparison', 'advanced-testimonial-carousel-for-elementor'),
				'route'			 => 'install-aic', 
                'description'    => __('Advanced Image Comparison is a fully Responsive.
				You can comparison your image. Comparison before image and after image. You can also image filtering.
				Customize image container, image radius, image border. Label customizing text color, background color border radius etc.
				You can set image overlay. Divider width, color. Handle color, background color, border radius etc.
				Additional options image visibility set, layout, move slider on click, move slider on hover, image overlay.', 'advanced-testimonial-carousel-for-elementor')
            ]
		];

        return $data;
    }
}