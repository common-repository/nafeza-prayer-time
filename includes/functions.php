<?php
defined('ABSPATH') or die('No script kiddies please!'); // Exit if accessed directly.

function nafeza_prayer_times_data()
{
    if (get_option('nafeza_prayer_time_setting_fixed_location')) :
        $latitude = get_option('nafeza_prayer_time_setting_latitude', '41.011561');
        $longitude = get_option('nafeza_prayer_time_setting_longitude', '29.039444');
        $location_info = json_decode(wp_remote_retrieve_body(wp_remote_get('http://api.aladhan.com/timings/' . time() . '?latitude=' . $latitude . '&longitude=' . $longitude)));
        $timezone = isset($location_info->data->meta->timezone) ? $location_info->data->meta->timezone : 'Europe/Istanbul';
        $city = get_option('nafeza_prayer_time_setting_city', 'Istanbul');
        $country = get_option('nafeza_prayer_time_setting_country', 'Turkey');
    else :
        $ip_info = wp_remote_get('https://get.geojs.io/v1/ip/geo/' . nafeza_prayer_time_get_the_user_ip() . '.json');
        $ip_info_body = wp_remote_retrieve_body($ip_info);
        $result = json_decode($ip_info_body);

        $latitude = isset($result->latitude) ? $result->latitude : '41.011561';
        $longitude = isset($result->longitude) ? $result->longitude : '29.039444';
        $timezone = ($result->countryCode != '') ? $result->timezone : 'Europe/Istanbul';
        $city = isset($result->region) ? $result->region : 'Istanbul';
        $country = isset($result->country) ? $result->country : 'Turkey';
    endif;
    $method = get_option('nafeza_prayer_time_setting_method', '1');
    $school = get_option('nafeza_prayer_time_setting_school', '0');

    date_default_timezone_set($timezone);
    $date = time();
    $date_format = date('H:i', $date);

    $prayer_info = wp_remote_retrieve_body(wp_remote_get('http://api.aladhan.com/timings/' . $date . '?latitude=' . $latitude . '&longitude=' . $longitude . '&timezonestring=' . $timezone . '&method=' . $method . '&school=' . $school));
    $prayer_data = json_decode($prayer_info);

    $data = $prayer_data->data->timings;
    $data->city = $city;
    $data->country = $country;
    $data->Fajr = na_pt_update_time($data->Fajr, get_option('nafeza_prayer_time_setting_fajr_difference', 0));
    $data->Sunrise = na_pt_update_time($data->Sunrise, get_option('nafeza_prayer_time_setting_sunrise_difference', 0));
    $data->Dhuhr = na_pt_update_time($data->Dhuhr, get_option('nafeza_prayer_time_setting_duhur_difference', 0));
    $data->Asr = na_pt_update_time($data->Asr, get_option('nafeza_prayer_time_setting_asr_difference', 0));
    $data->Maghrib = na_pt_update_time($data->Maghrib, get_option('nafeza_prayer_time_setting_maghrib_difference', 0));
    $data->Isha = na_pt_update_time($data->Isha, get_option('nafeza_prayer_time_setting_isha_difference', 0));
    $data->Imsak = na_pt_update_time($data->Imsak, get_option('nafeza_prayer_time_setting_imsak_difference', 0));

    $datetime1 = new DateTime($date_format);
    if ($date_format < $data->Fajr) :
        $datetime2 = new DateTime($data->Fajr);
        $interval = $datetime1->diff($datetime2);
        $data->next_time_after = $interval->format('%H:%I');
        $data->next_prayer = esc_html__('FAJR', 'nafeza-prayer-time');
        $data->next_time = $data->Fajr;
    elseif ($date_format < $data->Dhuhr) :
        $datetime2 = new DateTime($data->Dhuhr);
        $interval = $datetime1->diff($datetime2);
        $data->next_time_after = $interval->format('%H:%I');
        $data->next_prayer = esc_html__('DHUHR', 'nafeza-prayer-time');
        $data->next_time = $data->Dhuhr;
    elseif ($date_format < $data->Asr) :
        $datetime2 = new DateTime($data->Asr);
        $interval = $datetime1->diff($datetime2);
        $data->next_time_after = $interval->format('%H:%I');
        $data->next_prayer = esc_html__('ASR', 'nafeza-prayer-time');
        $data->next_time = $data->Asr;
    elseif ($date_format < $data->Maghrib) :
        $datetime2 = new DateTime($data->Maghrib);
        $interval = $datetime1->diff($datetime2);
        $data->next_time_after = $interval->format('%H:%I');
        $data->next_prayer = esc_html__('MAGHRIB', 'nafeza-prayer-time');
        $data->next_time = $data->Maghrib;
    elseif ($date_format < $data->Isha) :
        $datetime2 = new DateTime($data->Isha);
        $interval = $datetime1->diff($datetime2);
        $data->next_time_after = $interval->format('%H:%I');
        $data->next_prayer = esc_html__('ISHA', 'nafeza-prayer-time');
        $data->next_time = $data->Isha;
    endif;

    return $data;
}

function na_pt_update_time($time, $update)
{
    if (!$update) {
        $update  = 0;
    }
    $endTime = strtotime($update . " minutes", strtotime($time));
    return date('H:i', $endTime);
}


function na_pt_format($time)
{
    if (get_option('nafeza_prayer_time_setting_time_format') == 12) :
        $convert = strtotime($time);
        return date("h:i A", $convert);
    else :
        return $time;
    endif;
}


function nafeza_prayer_time_setting_scripts()
{
    wp_enqueue_script('nafeza-prayer-time-setting-scripts', NAFEZA_PREYER_TIME_PLUGIN_URL . '/js/upload_icon.js', array(), '1.1.0', true);
}
add_action('admin_enqueue_scripts', 'nafeza_prayer_time_setting_scripts');


function nafeza_prayer_time_get_the_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Check IP from share internet
        $ip = sanitize_text_field($_SERVER['HTTP_CLIENT_IP']);
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // To check IP is pass from proxy
        $ip = sanitize_text_field($_SERVER['HTTP_X_FORWARDED_FOR']);
    } else {
        $ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
    }

    return $ip;
}