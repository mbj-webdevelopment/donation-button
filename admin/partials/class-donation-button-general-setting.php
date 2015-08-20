<?php

/**
 * @class       Donation_Button_General_Setting
 * @version	1.0.0
 * @package	donation-button
 * @category	Class
 * @author      @author     mbj-webdevelopment <mbjwebdevelopment@gmail.com>
 */
class Donation_Button_General_Setting {

    /**
     * Hook in methods
     * @since    1.0.0
     * @access   static
     */
    public static function init() {

        add_action('donation_button_general_setting', array(__CLASS__, 'donation_button_general_setting_function'));
        add_action('donation_button_email_setting', array(__CLASS__, 'donation_button_email_setting_function'));
        add_action('donation_button_help_setting', array(__CLASS__, 'donation_button_help_setting'));
        add_action('donation_button_mailchimp_setting_save_field', array(__CLASS__, 'donation_button_mailchimp_setting_save_field'));
        add_action('donation_button_mailchimp_setting', array(__CLASS__, 'donation_button_mailchimp_setting'));
        add_action('donation_button_general_setting_save_field', array(__CLASS__, 'donation_button_general_setting_save_field'));
        add_action('donation_button_email_setting_save_field', array(__CLASS__, 'donation_button_email_setting_save_field'));
    }

    public static function donation_button_email_setting_field() {
        $email_body = "Hello %first_name% %last_name%,

Thank you for your donation!

Your PayPal transaction ID is: %txn_id%
PayPal donation receiver email address: %receiver_email%
PayPal donation date: %payment_date%
PayPal donor first: %first_name%
PayPal donor last name: %last_name%
PayPal donation currency: %mc_currency%
PayPal donation amount: %mc_gross%

Thanks you very much,
Store Admin";


        update_option('donation_buttons_email_body_text_pre', $email_body);
        $settings = apply_filters('donation_buttons_email_settings', array(
            array('type' => 'sectionend', 'id' => 'email_recipient_options'),
            array('title' => __('Email settings', 'donation-button'), 'type' => 'title', 'desc' => __('Set your own sender name and email address. Default WordPress values will be used if empty.', 'donation-button'), 'id' => 'email_options'),
            array(
                'title' => __('Enable/Disable', 'donation-button'),
                'type' => 'checkbox',
                'desc' => __('Enable this email notification for donor', 'donation-button'),
                'default' => 'yes',
                'id' => 'donation_buttons_donor_notification'
            ),
            array(
                'title' => __('Enable/Disable', 'donation-button'),
                'type' => 'checkbox',
                'desc' => __('Enable this email notification for website admin', 'donation-button'),
                'default' => 'yes',
                'id' => 'donation_buttons_admin_notification'
            ),
            array(
                'title' => __('"From" Name', 'donation-button'),
                'desc' => '',
                'id' => 'donation_buttons_email_from_name',
                'type' => 'text',
                'css' => 'min-width:300px;',
                'default' => esc_attr(get_bloginfo('title')),
                'autoload' => false
            ),
            array(
                'title' => __('"From" Email Address', 'donation-button'),
                'desc' => '',
                'id' => 'donation_buttons_email_from_address',
                'type' => 'email',
                'custom_attributes' => array(
                    'multiple' => 'multiple'
                ),
                'css' => 'min-width:300px;',
                'default' => get_option('admin_email'),
                'autoload' => false
            ),
            array(
                'title' => __('Email subject', 'donation-button'),
                'desc' => '',
                'id' => 'donation_buttons_email_subject',
                'type' => 'text',
                'css' => 'min-width:300px;',
                'default' => 'Thank you for your donation',
                'autoload' => false
            ),
            array('type' => 'sectionend', 'id' => 'email_options'),
            array(
                'title' => __('Email body', 'donation-button'),
                'desc' => __('The text to appear in the Donation Email. Please read more Help section(tab) for more dynamic tag', 'donation-button'),
                'id' => 'donation_buttons_email_body_text',
                'css' => 'width:100%; height: 500px;',
                'type' => 'textarea',
                'editor' => 'false',
                'default' => $email_body,
                'autoload' => false
            ),
            array('type' => 'sectionend', 'id' => 'email_template_options'),
        ));

        return $settings;
    }

    public static function help() {
        echo '<p>' . __('Some dynamic tags can be included in your email template :', 'wp-better-emails') . '</p>
					<ul>
						<li>' . __('<strong>%blog_url%</strong> : will be replaced with your blog URL.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%home_url%</strong> : will be replaced with your home URL.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%blog_name%</strong> : will be replaced with your blog name.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%blog_description%</strong> : will be replaced with your blog description.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%admin_email%</strong> : will be replaced with admin email.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%date%</strong> : will be replaced with current date, as formatted in <a href="options-general.php">general options</a>.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%time%</strong> : will be replaced with current time, as formatted in <a href="options-general.php">general options</a>.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%txn_id%</strong> : will be replaced with PayPal donation transaction ID.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%receiver_email%</strong> : will be replaced with PayPal donation receiver email address%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%payment_date%</strong> : will be replaced with PayPal donation date%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%first_name%</strong> : will be replaced with PayPal donation first name%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%last_name%</strong> : will be replaced with PayPal donation last name%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%mc_currency%</strong> : will be replaced with PayPal donation currency like USD', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%mc_gross%</strong> : will be replaced with PayPal donation amount', 'wp-better-emails') . '</li>
                                          </ul>';
    }

    public static function donation_button_email_setting_function() {
        $donation_button_setting_fields = self::donation_button_email_setting_field();
        $Html_output = new Donation_Button_Html_output();
        ?>
        <form id="mailChimp_integration_form" enctype="multipart/form-data" action="" method="post">
            <?php $Html_output->init($donation_button_setting_fields); ?>
            <p class="submit">
                <input type="submit" name="mailChimp_integration" class="button-primary" value="<?php esc_attr_e('Save changes', 'Option'); ?>" />
            </p>
        </form>
        <?php
    }

    public static function donation_button_setting_fields() {
        $currency_code_options = self::get_donation_button_currencies();
        foreach ($currency_code_options as $code => $name) {
            $currency_code_options[$code] = $name . ' (' . self::get_donation_button_symbol($code) . ')';
        }
        $fields[] = array('title' => __('PayPal Account Setup', 'donation-button'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');
        $fields[] = array(
            'title' => __('Enable PayPal sandbox', 'donation-button'),
            'type' => 'checkbox',
            'id' => 'donation_button_PayPal_sandbox',
            'label' => __('Enable PayPal sandbox', 'donation-button'),
            'default' => 'no',
            'css' => 'min-width:300px;',
            'desc' => sprintf(__('PayPal sandbox can be used to test payments. Sign up for a developer account <a href="%s">here</a>.', 'donation-button'), 'https://developer.paypal.com/'),
        );
        $fields[] = array(
            'title' => __('PayPal Email address to receive payments', 'donation-button'),
            'type' => 'email',
            'id' => 'donation_button_bussiness_email',
            'desc' => __('This is the Paypal Email address where the payments will go.', 'donation-button'),
            'default' => '',
            'placeholder' => 'you@youremail.com',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );
        $fields[] = array(
            'title' => __('Currency', 'donation-button'),
            'desc' => __('This is the currency for your visitors to make Payments or Donations in.', 'donation-button'),
            'id' => 'donation_button_currency',
            'css' => 'min-width:250px;',
            'default' => 'GBP',
            'type' => 'select',
            'class' => 'chosen_select',
            'options' => $currency_code_options
        );
        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');
        $fields[] = array('title' => __('Optional Settings', 'donation-button'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');
        $fields[] = array(
            'title' => __('Button Label', 'donation-button'),
            'type' => 'text',
            'id' => 'donation_button_button_label',
            'desc' => __('PayPal donation button label  (Optional).', 'donation-button'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );
        $fields[] = array(
            'title' => __('Return Page', 'donation-button'),
            'id' => 'donation_button_return_page',
            'desc' => __('URL to which the donator comes to after completing the donation; for example, a URL on your site that displays a "Thank you for your donation".', 'donation-button'),
            'type' => 'single_select_page',
            'default' => '',
            'class' => 'chosen_select_nostd',
            'css' => 'min-width:300px;',
        );
        $fields[] = array(
            'title' => __('Amount', 'donation-button'),
            'type' => 'text',
            'id' => 'donation_button_amount',
            'desc' => __('The default amount for a donation (Optional).', 'donation-button'),
            'default' => ''
        );
        $fields[] = array(
            'title' => __('Purpose', 'donation-button'),
            'type' => 'text',
            'id' => 'donation_button_purpose',
            'desc' => __('The default purpose of a donation (Optional).', 'donation-button'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );
        $fields[] = array(
            'title' => __('Reference', 'donation-button'),
            'type' => 'text',
            'id' => 'donation_button_reference',
            'desc' => __('Default reference for the donation (Optional).', 'donation-button'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );
        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');
        $fields[] = array('title' => __('Donation Button', 'donation-button'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');
        $fields[] = array(
            'title' => __('Select Donation Button', 'donation-button'),
            'id' => 'donation_button_button_image',
            'default' => 'no',
            'type' => 'radio',
            'desc' => __('Select Button.', 'donation-button'),
            'options' => array(
                'button1' => __('<img style="vertical-align: middle;" alt="small" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif">', 'donation-button'),
                'button2' => __('<img style="vertical-align: middle;" alt="large" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif">', 'donation-button'),
                'button3' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif">', 'donation-button'),
                'button4' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png">', 'donation-button'),
                'button5' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png">', 'donation-button'),
                'button6' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png">', 'donation-button'),
                'button7' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png">', 'donation-button'),
                'button8' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/en_AU/i/btn/x-click-but11.gif">', 'donation-button'),
                'button9' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/en_AU/i/btn/x-click-but21.gif">', 'donation-button'),
                'button10' => __('Custom Button ( If you select this option then pleae enter url in Custom Button textbox, Otherwise donation button will not display. )', 'donation-button')
            ),
        );
        $fields[] = array(
            'title' => __('Custom Button', 'donation-button'),
            'type' => 'text',
            'id' => 'donation_button_custom_button',
            'desc' => __('Enter a URL to a custom donation button.', 'donation-button'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );
        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');
        return $fields;
    }

    public static function donation_button_general_setting_save_field() {
        $donation_button_setting_fields = self::donation_button_setting_fields();
        $Html_output = new Donation_Button_Html_output();
        $Html_output->save_fields($donation_button_setting_fields);
    }

    public static function donation_button_email_setting_save_field() {
        $donation_button_email_setting_field = self::donation_button_email_setting_field();
        $Html_output = new Donation_Button_Html_output();
        $Html_output->save_fields($donation_button_email_setting_field);
    }

    public static function donation_button_help_setting() {
        ?>
        <div class="postbox">
            <h2><label for="title">&nbsp;&nbsp;Plugin Usage</label></h2>
            <div class="inside">      
                <p>There are a few ways you can use this plugin:</p>
                <ol>
                    <li>Configure the options below and then add the shortcode <strong>[paypal_donation_button]</strong> to a post or page (where you want the payment button)</li>
                    <li>Call the function from a template file: <strong>&lt;?php echo do_shortcode( '[paypal_donation_button]' ); ?&gt;</strong></li>
                    <li>Use the <strong>PayPal Donation</strong> Widget from the Widgets menu</li>
                </ol>
                <p><h3>Archive of PayPal Buttons and Images</h3><br>
                The following reference pages list the localized PayPal buttons and images and their URLs.
                </p>
                <p><h4>English</h4></p>
                <ul>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/AU/">Australia</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/US-UK/">United Kingdom</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/US-UK/">United States</a></li>
                </ul>
                <p><h4>Asia-Pacific</h4></p>
                <ul>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/JP/">Japan</a></li>
                </ul>
                <p><h4>EU Non-English</h4></p>
                <ul>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/DE/">Germany</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/ES/">Spain</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/FR/">France</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/IT/">Italy</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/NL/">Netherlands</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/PL/">Poland</a></li>
                </ul>
                <br>
                <h2> <label>Email dynamic tag list</label></h2>
                <?php self::help(); ?>
            </div></div>
        <?php
    }

    public static function donation_button_general_setting_function() {
        $donation_button_setting_fields = self::donation_button_setting_fields();
        $Html_output = new Donation_Button_Html_output();
        ?>
        <form id="mailChimp_integration_form" enctype="multipart/form-data" action="" method="post">
            <?php $Html_output->init($donation_button_setting_fields); ?>
            <p class="submit">
                <input type="submit" name="mailChimp_integration" class="button-primary" value="<?php esc_attr_e('Save changes', 'Option'); ?>" />
            </p>
        </form>
        <?php
    }

    public static function get_donation_button_currencies() {
        return array_unique(
                apply_filters('donation_button_currencies', array(
            'AED' => __('United Arab Emirates Dirham', 'donation-button'),
            'AUD' => __('Australian Dollars', 'donation-button'),
            'BDT' => __('Bangladeshi Taka', 'donation-button'),
            'BRL' => __('Brazilian Real', 'donation-button'),
            'BGN' => __('Bulgarian Lev', 'donation-button'),
            'CAD' => __('Canadian Dollars', 'donation-button'),
            'CLP' => __('Chilean Peso', 'donation-button'),
            'CNY' => __('Chinese Yuan', 'donation-button'),
            'COP' => __('Colombian Peso', 'donation-button'),
            'CZK' => __('Czech Koruna', 'donation-button'),
            'DKK' => __('Danish Krone', 'donation-button'),
            'DOP' => __('Dominican Peso', 'donation-button'),
            'EUR' => __('Euros', 'donation-button'),
            'HKD' => __('Hong Kong Dollar', 'donation-button'),
            'HRK' => __('Croatia kuna', 'donation-button'),
            'HUF' => __('Hungarian Forint', 'donation-button'),
            'ISK' => __('Icelandic krona', 'donation-button'),
            'IDR' => __('Indonesia Rupiah', 'donation-button'),
            'INR' => __('Indian Rupee', 'donation-button'),
            'NPR' => __('Nepali Rupee', 'donation-button'),
            'ILS' => __('Israeli Shekel', 'donation-button'),
            'JPY' => __('Japanese Yen', 'donation-button'),
            'KIP' => __('Lao Kip', 'donation-button'),
            'KRW' => __('South Korean Won', 'donation-button'),
            'MYR' => __('Malaysian Ringgits', 'donation-button'),
            'MXN' => __('Mexican Peso', 'donation-button'),
            'NGN' => __('Nigerian Naira', 'donation-button'),
            'NOK' => __('Norwegian Krone', 'donation-button'),
            'NZD' => __('New Zealand Dollar', 'donation-button'),
            'PYG' => __('Paraguayan Guaraní', 'donation-button'),
            'PHP' => __('Philippine Pesos', 'donation-button'),
            'PLN' => __('Polish Zloty', 'donation-button'),
            'GBP' => __('Pounds Sterling', 'donation-button'),
            'RON' => __('Romanian Leu', 'donation-button'),
            'RUB' => __('Russian Ruble', 'donation-button'),
            'SGD' => __('Singapore Dollar', 'donation-button'),
            'ZAR' => __('South African rand', 'donation-button'),
            'SEK' => __('Swedish Krona', 'donation-button'),
            'CHF' => __('Swiss Franc', 'donation-button'),
            'TWD' => __('Taiwan New Dollars', 'donation-button'),
            'THB' => __('Thai Baht', 'donation-button'),
            'TRY' => __('Turkish Lira', 'donation-button'),
            'USD' => __('US Dollars', 'donation-button'),
            'VND' => __('Vietnamese Dong', 'donation-button'),
            'EGP' => __('Egyptian Pound', 'donation-button'),
                        )
                )
        );
    }

    public static function get_donation_button_symbol($currency = '') {
        if (!$currency) {
            $currency = get_donation_button_currencies();
        }
        switch ($currency) {
            case 'AED' :
                $currency_symbol = 'د.إ';
                break;
            case 'BDT':
                $currency_symbol = '&#2547;&nbsp;';
                break;
            case 'BRL' :
                $currency_symbol = '&#82;&#36;';
                break;
            case 'BGN' :
                $currency_symbol = '&#1083;&#1074;.';
                break;
            case 'AUD' :
            case 'CAD' :
            case 'CLP' :
            case 'COP' :
            case 'MXN' :
            case 'NZD' :
            case 'HKD' :
            case 'SGD' :
            case 'USD' :
                $currency_symbol = '&#36;';
                break;
            case 'EUR' :
                $currency_symbol = '&euro;';
                break;
            case 'CNY' :
            case 'RMB' :
            case 'JPY' :
                $currency_symbol = '&yen;';
                break;
            case 'RUB' :
                $currency_symbol = '&#1088;&#1091;&#1073;.';
                break;
            case 'KRW' : $currency_symbol = '&#8361;';
                break;
            case 'PYG' : $currency_symbol = '&#8370;';
                break;
            case 'TRY' : $currency_symbol = '&#8378;';
                break;
            case 'NOK' : $currency_symbol = '&#107;&#114;';
                break;
            case 'ZAR' : $currency_symbol = '&#82;';
                break;
            case 'CZK' : $currency_symbol = '&#75;&#269;';
                break;
            case 'MYR' : $currency_symbol = '&#82;&#77;';
                break;
            case 'DKK' : $currency_symbol = 'kr.';
                break;
            case 'HUF' : $currency_symbol = '&#70;&#116;';
                break;
            case 'IDR' : $currency_symbol = 'Rp';
                break;
            case 'INR' : $currency_symbol = 'Rs.';
                break;
            case 'NPR' : $currency_symbol = 'Rs.';
                break;
            case 'ISK' : $currency_symbol = 'Kr.';
                break;
            case 'ILS' : $currency_symbol = '&#8362;';
                break;
            case 'PHP' : $currency_symbol = '&#8369;';
                break;
            case 'PLN' : $currency_symbol = '&#122;&#322;';
                break;
            case 'SEK' : $currency_symbol = '&#107;&#114;';
                break;
            case 'CHF' : $currency_symbol = '&#67;&#72;&#70;';
                break;
            case 'TWD' : $currency_symbol = '&#78;&#84;&#36;';
                break;
            case 'THB' : $currency_symbol = '&#3647;';
                break;
            case 'GBP' : $currency_symbol = '&pound;';
                break;
            case 'RON' : $currency_symbol = 'lei';
                break;
            case 'VND' : $currency_symbol = '&#8363;';
                break;
            case 'NGN' : $currency_symbol = '&#8358;';
                break;
            case 'HRK' : $currency_symbol = 'Kn';
                break;
            case 'EGP' : $currency_symbol = 'EGP';
                break;
            case 'DOP' : $currency_symbol = 'RD&#36;';
                break;
            case 'KIP' : $currency_symbol = '&#8365;';
                break;
            default : $currency_symbol = '';
                break;
        }
        return apply_filters('donation_button_currency_symbol', $currency_symbol, $currency);
    }

    public static function donation_button_mcapi_setting_fields() {
        $fields[] = array('title' => __('MailChimp Integration', 'donation-button'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');
        $fields[] = array('title' => __('Enable MailChimp', 'donation-button'), 'type' => 'checkbox', 'desc' => '', 'id' => 'enable_mailchimp');
        $fields[] = array(
            'title' => __('MailChimp API Key', 'donation-button'),
            'desc' => __('Enter your API Key. <a target="_blank" href="http://admin.mailchimp.com/account/api-key-popup">Get your API key</a>', 'donation-button'),
            'id' => 'mailchimp_api_key',
            'type' => 'text',
            'css' => 'min-width:300px;',
        );
        $fields[] = array(
            'title' => __('MailChimp lists', 'donation-button'),
            'desc' => __('After you add your MailChimp API Key above and save it this list will be populated.', 'Option'),
            'id' => 'mailchimp_lists',
            'css' => 'min-width:300px;',
            'type' => 'select',
            'options' => self::donation_buttons_angelleye_get_mailchimp_lists(get_option('mailchimp_api_key'))
        );
        $fields[] = array(
            'title' => __('Force MailChimp lists refresh', 'donation-button'),
            'desc' => __("Check and 'Save changes' this if you've added a new MailChimp list and it's not showing in the list above.", 'donation-button'),
            'id' => 'donation_buttons_force_refresh',
            'type' => 'checkbox',
        );
        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');
        return $fields;
    }

    public static function donation_button_mailchimp_setting() {
        $mcapi_setting_fields = self::donation_button_mcapi_setting_fields();
        $Html_output = new Donation_Button_Html_output();
        ?>
        <form id="mailChimp_integration_form" enctype="multipart/form-data" action="" method="post">
            <?php $Html_output->init($mcapi_setting_fields); ?>
            <p class="submit">
                <input type="submit" name="mailChimp_integration" class="button-primary" value="<?php esc_attr_e('Save changes', 'Option'); ?>" />
            </p>
        </form>
        <?php
    }
    public static function donation_buttons_angelleye_get_mailchimp_lists($apikey) {
        $mailchimp_lists = unserialize(get_transient('mailchimp_mailinglist'));
        if (empty($mailchimp_lists) || get_option('donation_buttons_force_refresh') == 'yes') {
            include_once DBP_PLUGIN_DIR . '/includes/class-donation-button-mcapi.php';
            $mailchimp_api_key = get_option('mailchimp_api_key');
            $apikey = (isset($mailchimp_api_key)) ? $mailchimp_api_key : '';
            $api = new Donation_Button_MailChimp_MCAPI($apikey);
            $retval = $api->lists();
            if ($api->errorCode) {
                $mailchimp_lists['false'] = __("Unable to load MailChimp lists, check your API Key.", 'eddms');
            } else {
                if ($retval['total'] == 0) {
                    $mailchimp_lists['false'] = __("You have not created any lists at MailChimp", 'eddms');
                    return $mailchimp_lists;
                }
                foreach ($retval['data'] as $list) {
                    $mailchimp_lists[$list['id']] = $list['name'];
                }
                set_transient('mailchimp_mailinglist', serialize($mailchimp_lists), 86400);
                update_option('donation_buttons_force_refresh', 'no');
            }
        }
        return $mailchimp_lists;
    }

    public static function donation_button_mailchimp_setting_save_field() {
        $mcapi_setting_fields = self::donation_button_mcapi_setting_fields();
        $Html_output = new Donation_Button_Html_output();
        $Html_output->save_fields($mcapi_setting_fields);
    }

}

Donation_Button_General_Setting::init();