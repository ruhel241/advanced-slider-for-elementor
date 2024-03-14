jQuery(document).ready(function($) {
    var $successMessage = $("#ase-notice-success");
    var $errorMessage = $("#ase-notice-error");
    
    $successMessage.on('click', function() {
        $(this).hide();
    });

    $errorMessage.on('click', function() {
        $(this).hide();
    });


    
   var aseAddons =  $("#ase-addons-tab");

   var aseLicense =  $("#ase-license-tab");


    aseAddons.on('click', function() {
        $('.ase-addons-wrapper').show();
        $('.ase_license_box').hide();
    })

    aseLicense.on('click', function() {
        $('.ase-addons-wrapper').hide();
        $('.ase_license_box').show();
    })
    
    var aseAdminSettings = {
      
        getStatusLicense: function() {
            jQuery.post(aseProVar.ajaxurl, {
                action: 'ase_pro_lincese_ajax_actions', 
                route: 'get_license_status',
                nonce: aseProVar.nonce
            })
                .then(function(response) {
                    if ( response.data.license_data.status === 'valid' ) {
                        $( "#ase_activated_license" ).hide()
                        $( "#ase_deactivated_license" ).show();
                    } else {
                        $( "#ase_activated_license" ).show()
                        $( "#ase_deactivated_license" ).hide();
                    }
                })
                .fail(function(error) {
                    console.log('Something is wrong! Please try again');
                })
                .always(function() {
                    $("#asebooster-loading").hide();
                });
        },

        verifyLicense: function() {
            $('#ase_verify_btn').on('click', function(e) {
				$("#asebooster-loading").show();
                $('#ase_activated_license').hide();
                $("#ase_deactivated_license").hide();
                e.preventDefault();
                
                jQuery.post(aseProVar.ajaxurl, {
                    action: 'ase_pro_lincese_ajax_actions',
                    route: 'activate_license',
                    nonce: aseProVar.nonce,
                    license_key: jQuery('#ase_license_settings_field').val()
                })
                    .then(function(response) {
                        if (response.success == true) {
                            $("#asebooster-loading").hide();
                            $('#ase_activated_license').hide();
                            $("#ase_deactivated_license").show();
                            $successMessage.show();
                            $successMessage.find('p').html(response.data.message);
                            $(".asebooster_activate_message").hide();
                        } else {
							$("#asebooster-loading").hide();
							$('#ase_activated_license').show();
							$("#ase_deactivated_license").hide();
                            $errorMessage.show();
                            $errorMessage.find('p').html(response.data.message);
                        }
                    })
                    .fail(function(error) {
                        $("#asebooster-loading").hide();
                        $("#ase_activated_license").show();
                        $("#ase_deactivated_license").hide();
                        $errorMessage.show();
                        $errorMessage.find('p').html('Something is wrong! Please try again');
                    })
                    .always(function() {
                    });
            })
        },

        deactiveLicense: function() {
            $('#ase_deactive_license').on('click', function(e) {
                $("#asebooster-loading").show();
                $("#ase_deactivated_license").hide();

                e.preventDefault();
                jQuery.post(aseProVar.ajaxurl, {
                    action: 'ase_pro_lincese_ajax_actions', 
                    route: 'deactivated_license',
                    nonce: aseProVar.nonce
                })
                    .then(function(response) {
                        $("#asebooster-loading").hide();
                        $("#ase_activated_license").show();
                        $("#ase_deactivated_license").hide();
                        $successMessage.show();
                        $successMessage.find('p').html(response.data.message);
                    })
                    .fail(function(error) {
                        $errorMessage.show();
                        $errorMessage.find('p').html('Something is wrong! Please try again');
                    })
                    .always(function() {
                    });
            })
        },
        // Active Plugin 
        installHandler: function() {
            $('.ase-install-addon').on('click', function(e) {
                // console.log($(this).attr('value'));
                e.preventDefault();
                jQuery.post(aseProVar.ajaxurl, {
                    action: 'ase_pro_setup_addons',
                    route: $(this).attr('value'),
                    nonce: aseProVar.nonce
                })
                    .then(function(response) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000); 
                        $successMessage.show();
                        $successMessage.find('p').html(response.data.message);
                    })
                    .fail(function(error) {
                        $errorMessage.show();
                        $errorMessage.find('p').html('Something is wrong! Please try again');
                    })
                    .always(function() {
                    });
            })
        },

        init: function(){
            if (!!aseProVar.has_pro) {
                this.getStatusLicense();
                this.verifyLicense();
                this.deactiveLicense();
            }
            this.installHandler();
        }
    } 
    aseAdminSettings.init();
});