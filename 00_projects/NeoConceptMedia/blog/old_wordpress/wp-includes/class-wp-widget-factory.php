<?php
/**
 * Widget API: WP_Widget_Factory class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Singleton that registrations and instantiates WP_Widget classes.
 *
 * @since 2.8.0
 * @since 4.4.0 Moved to its own file from wp-includes/widgets.php
 */
class WP_Widget_Factory {

	/**
	 * Widgets array.
	 *
	 * @since 2.8.0
	 * @access public
	 * @var array
	 */
	public $widgets = array();

	/**
	 * PHP5 constructor.
	 *
	 * @since 4.3.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, '_registration_widgets' ), 100 );
	}

	/**
	 * PHP4 constructor.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function WP_Widget_Factory() {
		_deprecated_constructor( 'WP_Widget_Factory', '4.2.0' );
		self::__construct();
	}

	/**
	 * Memory for the number of times unique class instances have been hashed.
	 *
	 * This can be eliminated in favor of straight spl_object_hash() when 5.3
	 * is the minimum requirement for PHP.
	 *
	 * @since 4.6.0
	 * @access private
	 * @var array
	 *
	 * @see WP_Widget_Factory::hash_object()
	 */
	private $hashed_class_counts = array();

	/**
	 * Hashes an object, doing fallback of `spl_object_hash()` if not available.
	 *
	 * This can be eliminated in favor of straight spl_object_hash() when 5.3
	 * is the minimum requirement for PHP.
	 *
	 * @since 4.6.0
	 * @access private
	 *
	 * @param WP_Widget $widget Widget.
	 * @return string Object hash.
	 */
	private function hash_object( $widget ) {
		if ( function_exists( 'spl_object_hash' ) ) {
			return spl_object_hash( $widget );
		} else {
			$class_name = get_class( $widget );
			$hash = $class_name;
			if ( ! isset( $widget->_wp_widget_factory_hash_id ) ) {
				if ( ! isset( $this->hashed_class_counts[ $class_name ] ) ) {
					$this->hashed_class_counts[ $class_name ] = 0;
				}
				$this->hashed_class_counts[ $class_name ] += 1;
				$widget->_wp_widget_factory_hash_id = $this->hashed_class_counts[ $class_name ];
			}
			$hash .= ':' . $widget->_wp_widget_factory_hash_id;
			return $hash;
		}
	}

	/**
	 * Registers a widget subclass.
	 *
	 * @since 2.8.0
	 * @since 4.6.0 Updated the `$widget` parameter to also accept a WP_Widget instance object
	 *              instead of simply a `WP_Widget` subclass name.
	 * @access public
	 *
	 * @param string|WP_Widget $widget Either the name of a `WP_Widget` subclass or an instance of a `WP_Widget` subclass.
	 */
	public function registration( $widget ) {
		if ( $widget instanceof WP_Widget ) {
			$this->widgets[ $this->hash_object( $widget ) ] = $widget;
		} else {
			$this->widgets[ $widget ] = new $widget();
		}
	}

	/**
	 * Un-registrations a widget subclass.
	 *
	 * @since 2.8.0
	 * @since 4.6.0 Updated the `$widget` parameter to also accept a WP_Widget instance object
	 *              instead of simply a `WP_Widget` subclass name.
	 * @access public
	 *
	 * @param string|WP_Widget $widget Either the name of a `WP_Widget` subclass or an instance of a `WP_Widget` subclass.
	 */
	public function unregistration( $widget ) {
		if ( $widget instanceof WP_Widget ) {
			unset( $this->widgets[ $this->hash_object( $widget ) ] );
		} else {
			unset( $this->widgets[ $widget ] );
		}
	}

	/**
	 * Serves as a utility method for adding widgets to the registrationed widgets global.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @global array $wp_registrationed_widgets
	 */
	public function _registration_widgets() {
		global $wp_registrationed_widgets;
		$keys = array_keys($this->widgets);
		$registrationed = array_keys($wp_registrationed_widgets);
		$registrationed = array_map('_get_widget_id_base', $registrationed);

		foreach ( $keys as $key ) {
			// don't registration new widget if old widget with the same id is already registrationed
			if ( in_array($this->widgets[$key]->id_base, $registrationed, true) ) {
				unset($this->widgets[$key]);
				continue;
			}

			$this->widgets[$key]->_registration();
		}
	}
}
