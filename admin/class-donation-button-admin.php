<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Donation_Button
 * @subpackage Donation_Button/admin
 * @author     mbj-webdevelopment <mbjwebdevelopment@gmail.com>
 */
class Donation_Button_Admin {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load_dependencies();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-donation-button-admin-display.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-donation-button-general-setting.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-donation-button-html-output.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-donation-button-admin-widget.php';
    }

    public function paypal_donation_button_woocommerce_standard_parameters($paypal_args) {
        if( isset($paypal_args['BUTTONSOURCE']) ) {
            $paypal_args['BUTTONSOURCE'] = 'mbjtechnolabs_SP';
        } else {
            $paypal_args['bn'] = 'mbjtechnolabs_SP';
        }
        return $paypal_args;
    }
}
