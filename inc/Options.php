<?php

/**
 * Options
 *
 * Interface for options storage
 */

namespace RichJenks\NFRecon;

class Options extends Plugin {

	/**
	 * options
	 *
	 * Structure: `$options[ $category ][ $field ]`
	 *
	 * @var array Cached options, so not hitting database every time
	 */

	protected $options;

	/**
	 * get_options
	 *
	 * Retrieves options from cache (`$this->options`) or from database
	 *
	 * @return array Plugin options
	 */

	protected function get_options() {

		// Return cache?
		// if ( isset( $this->options ) ) return $this->options;

		// Construct default options
		$defaults = array(

			'Content' => array(
				'Current URL' => false,
				'Post Title'  => false,
				'Form Name'   => false,
			),

			'User' => array(
				'IP Address'       => false,
				'Operating System' => false,
				'Browser'          => false,
				'Browser Version'  => false,
			),

			'Google Campaign' => array(
				'utm_source'  =>  false,
				'utm_medium'  =>  false,
				'utm_term'    =>  false,
				'utm_content' =>  false,
				'utm_name'    =>  false,
			),

			'Geolocation' => array(
				'City'         => false,
				'Country'      => false,
				'Country Code' => false,
				'ISP'          => false,
				'Latitude'     => false,
				'Longitude'    => false,
				'Organisation' => false,
				'Region'       => false,
				'Region Name'  => false,
				'Timezone'     => false,
				'Zip'          => false,
			),

		);

		// Get current options as array
		$options = json_decode( get_option( $this->prefix . 'options', '[]' ), true );

		// Cache merged options
		$this->options = array_replace_recursive( $defaults, $options );

		// Return options
		return $this->options;

	}

	/**
	 * set_options
	 *
	 * Puts options in storage
	 *
	 * @param array $options Plugin options
	 */

	protected function set_options( $options ) {
		update_option( $this->prefix . 'options', json_encode( $options ) );
	}

	/**
	 * integrate_options
	 *
	 * $options is a multidimensional array like `$options[ $category ][ $field ]`
	 * When provided with some options from one category
	 * this function will integrate them and return the full set of options
	 *
	 * Assumes set value is true and unset is false — because checkboxes are weird.
	 *
	 * @param array $options Category options to be integrated into full options
	 */

	protected function integrate_options( $options ) {
		var_dump( $_POST );
		var_dump( $options );
		var_dump( $this->options );
	}

}