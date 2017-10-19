<?php
declare(strict_types=1);


namespace kdaviesnz\geo;

class Geo implements IGeo
{

	/**
	 * Country
	 *
	 * @var string
	 */
	private $country = '';

	/**
	 * City
	 *
	 * @var string
	 */
	private $city = '';

	/**
	 * Region
	 *
	 * @var string
	 */
	private $region = '';

	/**
	 * Region code
	 *
	 * @var string
	 */
	private $region_code = '';

	/**
	 * Area code
	 *
	 * @var string
	 */
	private $area_code = '';

	/**
	 * Country code
	 *
	 * @var string
	 */
	private $country_code = '';

	/**
	 * Continent code
	 *
	 * @var string
	 */
	private $continent_code = '';

	/**
	 * Latitude
	 *
	 * @var float
	 */
	private $latitude = 0.00;

	/**
	 * Longitude
	 *
	 * @var float
	 */
	private $longitude = 0.00;

	/**
	 * Currency code
	 *
	 * @var string
	 */
	private $currency_code = '';

	/**
	 * Currency symbol
	 *
	 * @var string
	 */
	private $currency_symbol = '';

	/**
	 * Utf8 currency symbol
	 *
	 * @var string
	 */
	private $currency_symbol_utf8 = '';

	/**
	 * Currency converter
	 *
	 * @var float
	 */
	private $currrency_converter = 0.00;
    

	/**
	 * Ip
	 *
	 * @var string
	 */
	private $ip = '';

	
	private $geo = "[]";
	
	/**
	 * GenesisZonGeo constructor.
	 *
	 * @param string $ip ip address.
	 */
	public function __construct( $ip = '' ) {

		if ( empty ( $ip ) && isset( $_SERVER ) ) {

			$client = wp_unslash( isset( $_SERVER['HTTP_CLIENT_IP'] ) ? sanitize_key( $_SERVER['HTTP_CLIENT_IP'] ) : '' );
			$forward = wp_unslash( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? sanitize_key( $_SERVER['HTTP_X_FORWARDED_FOR'] ) : '' );
			$remote = wp_unslash( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_key( $_SERVER['REMOTE_ADDR'] ) : '' );

			if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
				$ip = $client;
			} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
				$ip = $forward;
			} else {
				$ip = $remote;
			}
		}

		if ( empty( $ip_data ) ) {
			$ip_data = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ip));
			
		}

        if ( $ip_data  ) {

            $this->geo = json_encode(array(
                "ip"=>$ip,
                "country" =>  ! empty( $ip_data->geoplugin_countryName ) ? $ip_data->geoplugin_countryName : '',
                "city" =>  ! empty( $ip_data->geoplugin_city ) ? $ip_data->geoplugin_city: '',
                "region" =>  ! empty( $ip_data->geoplugin_region) ? $ip_data->geoplugin_region : '',
                "region_code" =>  ! empty( $ip_data->geoplugin_regionCode) ? $ip_data->geoplugin_regionCode : '',
                "area_code" =>  ! empty( $ip_data->geoplugin_areaCode) ? $ip_data->geoplugin_areaCode : '',
                "country_code" =>  ! empty( $ip_data->geoplugin_countryCode) ? $ip_data->geoplugin_countryCode : '',
                "continent_code" =>  ! empty( $ip_data->geoplugin_continentCode) ? $ip_data->geoplugin_continentCode : '',
                "latitude" =>  ! empty( $ip_data->geoplugin_latitude ) ?  $ip_data->geoplugin_latitude * 1.00 : 0.00,
                "longitude" =>  ! empty( $ip_data->geoplugin_longitude ) ? $ip_data->geoplugin_longitude * 1.00 : 0.00,
                "currency_code" =>  ! empty( $ip_data->geoplugin_currencyCode) ? $ip_data->geoplugin_currencyCode : '',
                "currency_symbol" =>  ! empty( $ip_data->geoplugin_currencySymbol ) ? $ip_data->geoplugin_currencySymbol : '',
                "currency_symbol_utf8" =>  ! empty( $ip_data->geoplugin_currencySymbol_UTF8 ) ? $ip_data->geoplugin_currencySymbol_UTF8 : '',
                "currrency_converter" =>  ! empty( $ip_data->geoplugin_curencyConverter ) ? $ip_data->geoplugin_curencyConverter : ''
            ));

		}
        
	}

	public function __toString()
    {
        return $this->geo;
    }

    /**
	 * Get country.
	 *
	 * @return string
	 */
	private function getCountry() {
		return $this->country;
	}

	/**
	 * Get city.
	 *
	 * @return string
	 */
	private function getCity() {
		return $this->city;
	}

	/**
	 * Get region.
	 *
	 * @return string
	 */
	private function getRegion() {
		return $this->region;
	}

	/**
	 * Get area code.
	 *
	 * @return string
	 */
	private function getAreaCode() {
		return $this->area_code;
	}

	/**
	 * Get country code.
	 *
	 * @return string
	 */
	private function getCountryCode() {
		return $this->country_code;
	}

	/**
	 * Get continent code.
	 *
	 * @return string
	 */
	private function getContinentCode() {
		return $this->continent_code;
	}

	/**
	 * Get latitude.
	 *
	 * @return float
	 */
	private function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Get longitude.
	 *
	 * @return float
	 */
	private function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Get currency code.
	 *
	 * @return string
	 */
	private function getCurrencyCode() {
		return $this->currency_code;
	}

	/**
	 * Get currency symbol.
	 *
	 * @return string
	 */
	private function getCurrencySymbol() {
		return $this->currency_symbol;
	}

	/**
	 * Get currency symbol in UTF8 format.
	 *
	 * @return string
	 */
	private function getCurrencySymbolUtf8() {
		return $this->currency_symbol_utf8;
	}

	/**
	 * Get currency converter.
	 *
	 * @return float
	 */
	private function getCurrrencyConverter() {
		return $this->currrency_converter;
	}

	/**
	 * Get IP.
	 *
	 * @return string
	 */
	private function getIp() {
		return $this->ip;
	}

	/**
	 * Get region code.
	 *
	 * @return int
	 */
	private function getRegionCode() {
		return $this->region_code;
	}


	/**
	 * Get Amazon country extension.
	 *
	 * @return string
	 */
	private function getAmazonCountryExt() {

		$country_code = $this->getCountryCode();

		switch ( $country_code ) {

			case 'IN':
				$amazon_country_ext = 'in';
				break;
			case 'US':
				$amazon_country_ext = 'com';
				break;
			case 'CA':
				$amazon_country_ext = 'ca';
				break;
			case 'GB':
				$amazon_country_ext = 'co.uk';
				break;
			case 'CN':
				$amazon_country_ext = 'joyo.com';
				break;
			case 'JP':
				$amazon_country_ext = 'jp';
				break;
			case 'FR':
				$amazon_country_ext = 'fr';
				break;
			case 'DE':
				$amazon_country_ext = 'de';
				break;
			case 'IT':
				$amazon_country_ext = 'it';
				break;
			case 'ES':
				$amazon_country_ext = 'es';
				break;
			case 'AT':
				$amazon_country_ext = 'at';
				break;
			case 'AU':
				$amazon_country_ext = 'com.au';
				break;
			case 'BR':
				$amazon_country_ext = 'com.br';
				break;
			default:
				$amazon_country_ext = 'com';
		}

		return $amazon_country_ext;

	}

	private function getAmazonLang() {

		$amazon_ext = $this->getAmazonCountryExt();
		$am_lang = 'en_US';

		// http://www.roseindia.net/tutorials/I18N/locales-list.shtml
		switch ( $amazon_ext ) {

			case 'in':
				$am_lang = 'en_In';
				break;
			case 'com':
				$am_lang = 'en_US';
				break;
			case 'ca':
				$am_lang = 'en_CA';
				break;
			case 'co.uk':
				$am_lang = 'en_GB';
				break;
			case 'joyo.com': // china
				$am_lang = 'zh_CN';
				break;
			case 'jp':
				$am_lang = 'ja_JP';
				break;
			case 'fr':
				$am_lang = 'fr';
				break;
			case 'de':
				$am_lang = 'de';
				break;
			case 'it':
				$am_lang = 'it';
				break;
			case 'es':
				$am_lang = 'es';
				break;
			case 'at':
				$am_lang = 'de';
				break;
			case 'au':
				$am_lang = 'en_AU';
				break;
			case 'br':
				$am_lang = 'en_UK';
				break;
			default:
				$am_lang = 'en_US';
		}

		return $am_lang;

	}


	/**
	 * @param string $address
	 * @return string
	 * @see https://colinyeoh.wordpress.com/2013/02/12/simple-php-function-to-get-coordinates-from-address-through-google-services/
     */
	private static function get_coordinates( $address ) {

		$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern

		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";

		$response = file_get_contents($url);

		$json = json_decode($response,TRUE); //generate array object from the response from the web

		return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);

	}
}

