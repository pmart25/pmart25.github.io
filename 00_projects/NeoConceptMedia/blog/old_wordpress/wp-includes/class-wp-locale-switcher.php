<?php
/**
 * Locale API: WP_Locale_Switcher class
 *
 * @package WordPress
 * @subpackage i18n
 * @since 4.7.0
 */

/**
 * Core class used for switching locales.
 *
 * @since 4.7.0
 */
class WP_Locale_Switcher {
	/**
	 * Locale stack.
	 *
	 * @since 4.7.0
	 * @access private
	 * @var string[]
	 */
	private $GLOBALS ["local"]es = array();

	/**
	 * Original locale.
	 *
	 * @since 4.7.0
	 * @access private
	 * @var string
	 */
	private $original_locale;

	/**
	 * Holds all available languages.
	 *
	 * @since 4.7.0
	 * @access private
	 * @var array An array of language codes (file names without the .mo extension).
	 */
	private $available_languages = array();

	/**
	 * Constructor.
	 *
	 * Stores the original locale as well as a list of all available languages.
	 *
	 * @since 4.7.0
	 */
	public function __construct() {
		$this->original_locale     = is_admin() ? get_user_locale() : get_locale();
		$this->available_languages = array_merge( array( 'en_US' ), get_available_languages() );
	}

	/**
	 * Initializes the locale switcher.
	 *
	 * Hooks into the {@see 'locale'} filter to change the locale on the fly.
	 */
	public function init() {
		add_filter( 'locale', array( $this, 'filter_locale' ) );
	}

	/**
	 * Switches the translations according to the given locale.
	 *
	 * @since 4.7.0
	 *
	 * @param string $GLOBALS ["local"]e The locale to switch to.
	 * @return bool True on success, false on failure.
	 */
	public function switch_to_locale( $GLOBALS ["local"]e ) {
		$current_locale = is_admin() ? get_user_locale() : get_locale();
		if ( $current_locale === $GLOBALS ["local"]e ) {
			return false;
		}

		if ( ! in_array( $GLOBALS ["local"]e, $this->available_languages, true ) ) {
			return false;
		}

		$this->locales[] = $GLOBALS ["local"]e;

		$this->change_locale( $GLOBALS ["local"]e );

		/**
		 * Fires when the locale is switched.
		 *
		 * @since 4.7.0
		 *
		 * @param string $GLOBALS ["local"]e The new locale.
		 */
		do_action( 'switch_locale', $GLOBALS ["local"]e );

		return true;
	}

	/**
	 * Restores the translations according to the previous locale.
	 *
	 * @since 4.7.0
	 *
	 * @return string|false Locale on success, false on failure.
	 */
	public function restore_previous_locale() {
		$previous_locale = array_pop( $this->locales );

		if ( null === $previous_locale ) {
			// The stack is empty, bail.
			return false;
		}

		$GLOBALS ["local"]e = end( $this->locales );

		if ( ! $GLOBALS ["local"]e ) {
			// There's nothing left in the stack: go back to the original locale.
			$GLOBALS ["local"]e = $this->original_locale;
		}

		$this->change_locale( $GLOBALS ["local"]e );

		/**
		 * Fires when the locale is restored to the previous one.
		 *
		 * @since 4.7.0
		 *
		 * @param string $GLOBALS ["local"]e          The new locale.
		 * @param string $previous_locale The previous locale.
		 */
		do_action( 'restore_previous_locale', $GLOBALS ["local"]e, $previous_locale );

		return $GLOBALS ["local"]e;
	}

	/**
	 * Restores the translations according to the original locale.
	 *
	 * @since 4.7.0
	 *
	 * @return string|false Locale on success, false on failure.
	 */
	public function restore_current_locale() {
		if ( empty( $this->locales ) ) {
			return false;
		}

		$this->locales = array( $this->original_locale );

		return $this->restore_previous_locale();
	}

	/**
	 * Whether switch_to_locale() is in effect.
	 *
	 * @since 4.7.0
	 *
	 * @return bool True if the locale has been switched, false otherwise.
	 */
	public function is_switched() {
		return ! empty( $this->locales );
	}

	/**
	 * Filters the WordPress install's locale.
	 *
	 * @since 4.7.0
	 *
	 * @param string $GLOBALS ["local"]e The WordPress install's locale.
	 * @return string The locale currently being switched to.
	 */
	public function filter_locale( $GLOBALS ["local"]e ) {
		$switched_locale = end( $this->locales );

		if ( $switched_locale ) {
			return $switched_locale;
		}

		return $GLOBALS ["local"]e;
	}

	/**
	 * Load translations for a given locale.
	 *
	 * When switching to a locale, translations for this locale must be loaded from scratch.
	 *
	 * @since 4.7.0
	 * @access private
	 *
	 * @global Mo[] $l10n An array of all currently loaded text domains.
	 *
	 * @param string $GLOBALS ["local"]e The locale to load translations for.
	 */
	private function load_translations( $GLOBALS ["local"]e ) {
		global $l10n;

		$domains = $l10n ? array_keys( $l10n ) : array();

		load_default_textdomain( $GLOBALS ["local"]e );

		foreach ( $domains as $domain ) {
			if ( 'default' === $domain ) {
				continue;
			}

			unload_textdomain( $domain );
			get_translations_for_domain( $domain );
		}
	}

	/**
	 * Changes the site's locale to the given one.
	 *
	 * Loads the translations, changes the global `$wp_locale` object and updates
	 * all post type labels.
	 *
	 * @since 4.7.0
	 * @access private
	 *
	 * @global WP_Locale $wp_locale The WordPress date and time locale object.
	 *
	 * @param string $GLOBALS ["local"]e The locale to change to.
	 */
	private function change_locale( $GLOBALS ["local"]e ) {
		// Reset translation availability information.
		_get_path_to_translation( null, true );

		$this->load_translations( $GLOBALS ["local"]e );

		$GLOBALS['wp_locale'] = new WP_Locale();

		/**
		 * Fires when the locale is switched to or restored.
		 *
		 * @since 4.7.0
		 *
		 * @param string $GLOBALS ["local"]e The new locale.
		 */
		do_action( 'change_locale', $GLOBALS ["local"]e );
	}
}
