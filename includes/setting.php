<?php

defined('ABSPATH') or die('No script kiddies please!'); // Exit if accessed directly.

add_action('admin_menu', 'nafeza_prayer_time_menu');

function nafeza_prayer_time_menu()
{
    add_options_page(esc_html__('Menu title', 'nafeza-prayer-time'), esc_html__('Prayer Times', 'nafeza-prayer-time'), 'manage_options', 'nafeza_prayer_time_admin_page', 'nafeza_prayer_time_options_page');
}

function nafeza_prayer_time_settings_api_init()
{
    add_settings_section(
        'nafeza_prayer_time_setting_section',
        esc_html__('General settings', 'nafeza-prayer-time') . '<hr />',
        '',
        'nafeza_prayer_time_admin_page'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_view_imsak',
        esc_html__('Enable Imsak', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_view_imsak',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_method',
        esc_html__('Calculation Method', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_method',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_school',
        esc_html__('Calculation School', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_school',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_fixed_location',
        esc_html__('Fixed location', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_fixed_location',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_latitude',
        esc_html__('Latitude', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_latitude',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_longitude',
        esc_html__('Longitude', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_longitude',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_city',
        esc_html__('City', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_city',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_country',
        esc_html__('Country', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_country',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_time_format',
        esc_html__('Time Format', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_time_format',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_notification',
        esc_html__('Enable Notifications', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_notification',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_notification_icon',
        esc_html__('Notification icon', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_notification_icon',
        'nafeza_prayer_time_admin_page',
        'nafeza_prayer_time_setting_section'
    );

    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_view_imsak', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_method', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_school', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_fixed_location', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_latitude', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_longitude', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_city', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_country', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_time_format', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_notification', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_section', 'nafeza_prayer_time_setting_notification_icon', array('sanitize_callback' => 'sanitize_text_field'));

    add_settings_section(
        'nafeza_prayer_time_setting_difference',
        esc_html__('Time difference', 'nafeza-prayer-time'),
        '',
        'nafeza_prayer_time_admin_page2'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_imsak_difference',
        esc_html__('IMSAK', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_imsak_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_fajr_difference',
        esc_html__('FAJR', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_fajr_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_sunrise_difference',
        esc_html__('SUNRISE', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_sunrise_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_duhur_difference',
        esc_html__('DHUHR', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_duhur_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_asr_difference',
        esc_html__('ASR', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_asr_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_maghrib_difference',
        esc_html__('MAGHRIB', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_maghrib_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );
    add_settings_field(
        'nafeza_prayer_time_setting_isha_difference',
        esc_html__('ISHA', 'nafeza-prayer-time'),
        'nafeza_prayer_time_setting_callback_isha_difference',
        'nafeza_prayer_time_admin_page2',
        'nafeza_prayer_time_setting_difference'
    );

    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_imsak_difference', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_fajr_difference', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_sunrise_difference', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_duhur_difference', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_asr_difference', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_maghrib_difference', array('sanitize_callback' => 'sanitize_text_field'));
    register_setting('nafeza_prayer_time_setting_difference', 'nafeza_prayer_time_setting_isha_difference', array('sanitize_callback' => 'sanitize_text_field'));
}

add_action('admin_init', 'nafeza_prayer_time_settings_api_init');

function nafeza_prayer_time_setting_callback_view_imsak()
{
    echo '<input name="nafeza_prayer_time_setting_view_imsak" id="nafeza_prayer_time_setting_view_imsak" type="checkbox" value="1" ' . checked(1, get_option('nafeza_prayer_time_setting_view_imsak'), false) . ' />';
}

function nafeza_prayer_time_setting_callback_method()
{
    $methods = array(
        1 => esc_html__('Muslim World League', 'nafeza-prayer-time'),
        2 => esc_html__('Islamic Society of North America', 'nafeza-prayer-time'),
        3 => esc_html__('Egyptian General Authority of Survey', 'nafeza-prayer-time'),
        4 => esc_html__('Umm Al-Qura University, Makkah', 'nafeza-prayer-time'),
        5 => esc_html__('University of Islamic Sciences', 'nafeza-prayer-time'),
        6 => esc_html__('Karachi\', \'Institute of Geophysics', 'nafeza-prayer-time'),
        7 => esc_html__('University of Tehran', 'nafeza-prayer-time'),
        8 => esc_html__('Gulf Region', 'nafeza-prayer-time'),
        9 => esc_html__('Kuwait', 'nafeza-prayer-time'),
        10 => esc_html__('Qatar', 'nafeza-prayer-time'),
        11 => esc_html__('Majlis Ugama Islam Singapura, Singapore', 'nafeza-prayer-time'),
        12 => esc_html__('Union Organization islamic de France', 'nafeza-prayer-time'),
        13 => esc_html__('Directorate of Religious Affairs, Turkey', 'nafeza-prayer-time')
    );
?>
    <select name="nafeza_prayer_time_setting_method" id="nafeza_prayer_time_setting_method">
        <?php foreach ($methods as $key => $value) : ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected(get_option('nafeza_prayer_time_setting_method'), $key); ?>>
                <?php echo esc_html($value); ?>
            </option>
        <?php endforeach; ?>
    </select>
<?php
}

function nafeza_prayer_time_setting_callback_school()
{
?>
    <select name="nafeza_prayer_time_setting_school" id="nafeza_prayer_time_setting_school">
        <option value="0" <?php selected(get_option('nafeza_prayer_time_setting_school'), 0); ?>>
            <?php esc_html_e('Shafei', 'nafeza-prayer-time'); ?></option>
        <option value="1" <?php selected(get_option('nafeza_prayer_time_setting_school'), 1); ?>>
            <?php esc_html_e('Hanafi', 'nafeza-prayer-time'); ?></option>
    </select>
<?php
}

function nafeza_prayer_time_setting_callback_fixed_location()
{
    echo '<input name="nafeza_prayer_time_setting_fixed_location" id="nafeza_prayer_time_setting_fixed_location" type="checkbox" value="1" ' . checked(1, get_option('nafeza_prayer_time_setting_fixed_location'), false) . ' /> ' . esc_html__('In case of deactivation, the location will be automatically determined by the client\'s IP', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_latitude()
{
    echo '<input name="nafeza_prayer_time_setting_latitude" id="nafeza_prayer_time_setting_latitude" type="text" value="' . esc_attr(get_option('nafeza_prayer_time_setting_latitude')) . '" />';
}

function nafeza_prayer_time_setting_callback_longitude()
{
    echo '<input name="nafeza_prayer_time_setting_longitude" id="nafeza_prayer_time_setting_longitude" type="text" value="' . esc_attr(get_option('nafeza_prayer_time_setting_longitude')) . '" />';
}

function nafeza_prayer_time_setting_callback_city()
{
    echo '<input name="nafeza_prayer_time_setting_city" id="nafeza_prayer_time_setting_city" type="text" value="' . esc_attr(get_option('nafeza_prayer_time_setting_city')) . '" />';
}

function nafeza_prayer_time_setting_callback_country()
{
    echo '<input name="nafeza_prayer_time_setting_country" id="nafeza_prayer_time_setting_country" type="text" value="' . esc_attr(get_option('nafeza_prayer_time_setting_country')) . '" />';
}

function nafeza_prayer_time_setting_callback_time_format()
{
?>
    <select name="nafeza_prayer_time_setting_time_format" id="nafeza_prayer_time_setting_time_format">
        <option value="24" <?php selected(get_option('nafeza_prayer_time_setting_time_format'), 24); ?>>24</option>
        <option value="12" <?php selected(get_option('nafeza_prayer_time_setting_time_format'), 12); ?>>12</option>
    </select>
<?php
}

function nafeza_prayer_time_options_page()
{
?>
    <div class="wrap">
        <h2><?php esc_html_e('Prayer Times Settings', 'nafeza-prayer-time'); ?></h2>
        <form action="options.php" method="POST">
            <?php settings_fields('nafeza_prayer_time_setting_section'); ?>
            <?php do_settings_sections('nafeza_prayer_time_admin_page'); ?>
            <?php submit_button(); ?>
        </form>
        <hr />
        <form action="options.php" method="POST">
            <?php settings_fields('nafeza_prayer_time_setting_difference'); ?>
            <?php do_settings_sections('nafeza_prayer_time_admin_page2'); ?>
            <?php submit_button(); ?>
        </form>
        <hr />
        <div> Shortcode : <input value="[nafeza_prayer_times]" readonly /></div>
    </div>
<?php
}

function nafeza_prayer_time_setting_callback_notification()
{
    echo '<input name="nafeza_prayer_time_setting_notification" id="nafeza_prayer_time_setting_notification" type="checkbox" value="1" ' . checked(1, get_option('nafeza_prayer_time_setting_notification'), false) . ' />';
}

function nafeza_prayer_time_setting_callback_notification_icon()
{
    $icon_url = (get_option('nafeza_prayer_time_setting_notification_icon') != '' && get_option('nafeza_prayer_time_setting_notification_icon')) ? get_option('nafeza_prayer_time_setting_notification_icon') : 'https://ps.w.org/nafeza-prayer-time/assets/icon-128x128.png';
    echo '<button type="button" class="button-secondary" id="upload-icon">' . esc_html__('Upload Icon', 'nafeza-prayer-time') . '</button> <input name="nafeza_prayer_time_setting_notification_icon" id="nafeza_prayer_time_setting_notification_icon" type="text" value="' . esc_attr(get_option('nafeza_prayer_time_setting_notification_icon')) . '" /> <button type="button" class="button-secondary" id="delete-icon">' . esc_html__('Delete') . '</button> <div><img id="nafeza_prayer_time_icon_img" src="' . esc_url($icon_url) . '" /></div>';
}

function nafeza_prayer_time_setting_callback_imsak_difference()
{
    echo '<input name="nafeza_prayer_time_setting_imsak_difference" id="nafeza_prayer_time_setting_imsak_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_imsak_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_fajr_difference()
{
    echo '<input name="nafeza_prayer_time_setting_fajr_difference" id="nafeza_prayer_time_setting_fajr_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_fajr_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_sunrise_difference()
{
    echo '<input name="nafeza_prayer_time_setting_sunrise_difference" id="nafeza_prayer_time_setting_sunrise_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_sunrise_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_duhur_difference()
{
    echo '<input name="nafeza_prayer_time_setting_duhur_difference" id="nafeza_prayer_time_setting_duhur_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_duhur_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_asr_difference()
{
    echo '<input name="nafeza_prayer_time_setting_asr_difference" id="nafeza_prayer_time_setting_asr_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_asr_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_maghrib_difference()
{
    echo '<input name="nafeza_prayer_time_setting_maghrib_difference" id="nafeza_prayer_time_setting_maghrib_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_maghrib_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function nafeza_prayer_time_setting_callback_isha_difference()
{
    echo '<input name="nafeza_prayer_time_setting_isha_difference" id="nafeza_prayer_time_setting_isha_difference" type="number" value="' . esc_attr(get_option('nafeza_prayer_time_setting_isha_difference', 0)) . '" /> ' . esc_html__('minute', 'nafeza-prayer-time');
}

function enqueue_media_uploader()
{
    wp_enqueue_media();
}

add_action("admin_enqueue_scripts", "enqueue_media_uploader");
