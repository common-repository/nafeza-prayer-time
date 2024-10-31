<?php
defined('ABSPATH') or die('No script kiddies please!'); // Exit if accessed directly.

function nafeza_prayer_times_notification($data)
{
  $icon_url = (get_option('nafeza_prayer_time_setting_notification_icon') != '' && get_option('nafeza_prayer_time_setting_notification_icon')) ? get_option('nafeza_prayer_time_setting_notification_icon') : 'https://ps.w.org/nafeza-prayer-time/assets/icon-128x128.png';
?>
  <script>
    function setCookie(name, value) {
      document.cookie = name + "=" + value + ";";
    }

    function getCookie(name) {
      var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
      return v ? v[2] : null;
    }
    var nafeza_prayer_time_notification = getCookie("nafeza_prayer_time_notification");

    if (nafeza_prayer_time_notification !== 'true') {
      if (Notification.permission !== "granted")
        Notification.requestPermission();
      else {
        var notification = new Notification('<?php echo esc_js(__('Prayer Times', 'nafeza-prayer-time')); ?>', {
          icon: "<?php echo esc_url($icon_url); ?>",
          body: "<?php echo esc_js(sprintf(__('Time remaining for %s prayer: ', 'nafeza-prayer-time'), $data->next_prayer) . $data->next_time_after); ?>"
        });
        setCookie('nafeza_prayer_time_notification', 'true');
      }
    }
  </script>
<?php
}

function nafeza_prayer_times_shortcode()
{
  $data = nafeza_prayer_times_data();
  if ($data->next_time_after && get_option('nafeza_prayer_time_setting_notification')) :
    nafeza_prayer_times_notification($data);
  endif;
?>
  <table class="nafez-prayer-time-widget" border="1">
    <thead>
      <tr>
        <th colspan="2"><?php echo esc_html($data->city); ?> / <?php echo esc_html($data->country); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php if (get_option('nafeza_prayer_time_setting_view_imsak')) : ?>
        <tr>
          <th><?php esc_html_e('IMSAK', 'nafeza-prayer-time'); ?></th>
          <td><?php echo esc_html(na_pt_format($data->Imsak)); ?></td>
        </tr>
      <?php endif; ?>
      <tr>
        <th><?php esc_html_e('FAJR', 'nafeza-prayer-time'); ?></th>
        <td><?php echo esc_html(na_pt_format($data->Fajr)); ?></td>
      </tr>
      <tr>
        <th><?php esc_html_e('SUNRISE', 'nafeza-prayer-time'); ?></th>
        <td><?php echo esc_html(na_pt_format($data->Sunrise)); ?></td>
      </tr>
      <tr>
        <th><?php esc_html_e('DHUHR', 'nafeza-prayer-time'); ?></th>
        <td><?php echo esc_html(na_pt_format($data->Dhuhr)); ?></td>
      </tr>
      <tr>
        <th><?php esc_html_e('ASR', 'nafeza-prayer-time'); ?></th>
        <td><?php echo esc_html(na_pt_format($data->Asr)); ?></td>
      </tr>
      <tr>
        <th><?php esc_html_e('MAGHRIB', 'nafeza-prayer-time'); ?></th>
        <td><?php echo esc_html(na_pt_format($data->Maghrib)); ?></td>
      </tr>
      <tr>
        <th><?php esc_html_e('ISHA', 'nafeza-prayer-time'); ?></th>
        <td><?php echo esc_html(na_pt_format($data->Isha)); ?></td>
      </tr>
    </tbody>
  </table>
<?php
}

add_shortcode('nafeza_prayer_times', 'nafeza_prayer_times_shortcode');
