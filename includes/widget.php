<?php
defined('ABSPATH') or die('No script kiddies please!'); // Exit if accessed directly.

class Nafeza_Prayer_Time_Widget extends WP_Widget {

    public function __construct() {
        $widget_details = array( 
            'classname' => 'nafeza_prayer_time_widget', 
            'description' => esc_html__( 'Widget for Prayer Time', 'nafeza-prayer-time' ) 
        );
        parent::__construct( 'nafeza_prayer_time_widget', esc_html__( 'Prayer Times From Nafeza', 'nafeza-prayer-time' ), $widget_details );
    }

    public function form( $instance ) {
        $title = !empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nafeza-prayer-time' );
        ?>
<p>
  <label
    for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'nafeza-prayer-time' ); ?></label>
  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
    value="<?php echo esc_attr( $title ); ?>">
</p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

    public function widget( $args, $instance ) {
        echo wp_kses_post($args['before_widget']);
        if ( !empty( $instance['title'] ) ) :
            echo wp_kses_post($args['before_title']) . esc_html(apply_filters( 'widget_title', $instance['title'] )) . wp_kses_post($args['after_title']);
        endif;
        nafeza_prayer_times_shortcode();
        echo wp_kses_post($args['after_widget']);
    }

}

add_action( 'widgets_init', 'na_pt_widget' );

function na_pt_widget() {
    register_widget('Nafeza_Prayer_Time_Widget');
}