<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.anaximandre.class.php *}
    {*purpose               Weather forecasts and report *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 16-08-20 19:19 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 20:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\anaximandre;

use \trql\mother\Mother                 as Mother;
use \trql\mother\iContext               as iContext;
use \trql\context\Context               as Context;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\thing\Thing                   as Thing;
use \trql\city\City                     as City;
use \trql\substitution\Substitution     as Substitution;
use \trql\victorhugo\VictorHugo         as VictorHugo;



use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CITY_CLASS_VERSION' ) )
    require_once( 'trql.city.class.php' );

if ( ! defined( 'SUBSTITUTION_CLASS_VERSION' ) )
    require_once( 'trql.substitution.class.php' );

if ( ! defined( 'VICTORHUGO_CLASS_VERSION' ) )
    require_once( 'trql.victorhugo.class.php' );

if ( ! defined( 'CONTEXT_CLASS_VERSION' ) )
    require_once( 'trql.context.class.php' );

defined( 'ANAXIMANDRE_CLASS_VERSION' ) or define( 'ANAXIMANDRE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Anaximandre=

    {*desc
        Weather and weather forecasts

        Anaximandre est le premier qui pense à la nécessité de faire appel à la
        science (de l'époque) pour effectuer des relevés météorologiques

        Anaximandre est donc notre classe pour faire de la météo !

    *}

    *}}
 */
/* ==================================================================================== */
class Anaximandre extends Thing implements iContext
/*------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $oCity                  = null;                     /* {*property   $oCity                      (City)                  A city or town *} */
    public      $aMercator              = null;                     /* {*property   $aMercator                  (array)                 Geo coordinates data *} */
    public      $aWeather               = null;                     /* {*property   $Weather                    (array)                                             *} */
    public      $aForecast              = null;                     /* {*property   $Forecast                   (array)                                             *} */
    public      $aWeatherTemplates      = null;                     /* {*property   $WeatherTemplates           (array)                                             *} */
    public      $aForecastTemplates     = null;                     /* {*property   $ForecastTemplates          (array)                                             *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId                 (string)                Wikidata ID. No equivalent. *} */



    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->aMercator    = array( 'countryCode'              => null,
                                     'countryName'              => null,
            			    		 'timezoneId'               => null,
            			    		 'dstOffset'                => null,
            			    		 'gmtOffset'                => null,
            			    		 'rawOffset'                => null,
            			    		 'timezoneId'               => null,
            			    		 'sunrise'                  => null,
            			    		 'sunset'                   => null,
                                     'name'                     => null,
                                     'toponymName'              => null,
                                     'lat'                      => null,
                                     'lng'                      => null,
                                     'geonameId'                => null,
                                     'fcl'                      => null,
                                     'fcode'                    => null,
                                     'fclName'                  => null,
                                     'fcodeName'                => null,
                                     'population'               => null,
                                     'adminCode1'               => null,
                                     'adminName1'               => null,
                                     'asciiName'                => null,
                                     'alternateNames'           => null,
                                     'elevation'                => null,
                                     'srtm3'                    => null,
                                     'astergdem'                => null,
                                     'continentCode'            => null,
                                     'adminCode'                => null,
                                     'adminName2'               => null,
                                     'adminCode3'               => null,
                                     'adminName3'               => null,
                                     'adminCode4'               => null,
                                     'adminName4'               => null,
                                     'alternateName'            => null,
                                     'timezone'                 => null,
                                     'bbox/west'                => null,
                                     'bbox/north'               => null,
                                     'bbox/east'                => null,
                                     'bbox/south'               => null,
                                     'bbox/accuracyLevel'       => null,
            			    	   );

        $this->aWeather     = array( 'temperature'              => null,
                                     'temperature-min'          => null,
                                     'temperature-max'          => null,
                                     'temperature-feels-like'   => null,
                                     'humidity'                 => null,
                                     'pressure'                 => null,
                                     'wind-speed'               => null,
                                     'wind-speed-unit'          => null,
                                     'wind-speed-name'          => null,
                                     'wind-direction'           => null,
                                     'wind-direction-code'      => null,
                                     'wind-direction-name'      => null,
                                     'clouds'                   => null,
                                     'clouds-name'              => null,
                                     'visibility'               => null,
                                     'precipitation'            => null,
                                     'weather'                  => null,
                                     'weather-number'           => null,
                                     'weather-icon'             => null,
                                     'lupdate'                  => null,
                                   );

        $this->aForecast    = array( 'sunrise'                  => null,
                                     'sunset'                   => null,
                                     'forecasts'                => null,
                                   );

        $this->oCity        = new City();

        return ( $this );
    }   /* End of Anaximandre.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getURL( $szURL[,$aParams] )=

        Get resources pointed to by $szURL

        {*params
            $szURL      (string)        URL to reach
            $aParams    (array)         An optional set of named parameters (associative
                                        array)
        *}

        {*return
            (string)    The resource pointed to by $szURL or an empty string if URL cannot
                        be reached.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getURL( $szURL,$aParams = null )
    /*-----------------------------------------------*/
    {
        $szAccessKey = $this->getAPIKey( 'anaximandre' );

        if ( isset( $aParams['lat'] ) && isset( $aParams['lng'] ) )
        {
            $szURL = "{$szURL}?lat={$aParams['lat']}&lon={$aParams['lng']}&APPID={$szAccessKey}&mode=xml";
            //var_dump( $szURL );
            return ( vaesoli::HTTP_GetURL( $szURL ) );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ': $aParams invalid parameter(s)',EXCEPTION_CODE_INVALID_PARAMETER );

    }   /* End of Anaximandre.getURL() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parse( $szXML )=

        Parses the XML returned by api.openweathermap.org

        {*params
            $szXML      (string)        XML to parse
        *}

        {*return
            (array)     Returns an associative array related to :
                            - weather or ...
                            - [weather] forecast
        *}

        *}}
    */
    /* ================================================================================ */
    protected function parse( $szXML )
    /*------------------------------*/
    {
        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        $aRetVal = null;

        //var_dump( $szXML );
        //echo $szXML;

        if ( $oDom->loadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                /* ******************************** */
                /* Forecast                         */
                /* ******************************** */
                if ( ( $o = $oXPath->query( '/weatherdata' ) ) && ( $o->length > 0 ) )
                {   /* forecast */

                    if ( ( $o = $oXPath->query( '/weatherdata/location/name' ) ) && ( $o->length > 0 ) )
                    {
                        $this->oCity->name  = $this->oCity->geo->name = trim( $o->item(0)->nodeValue );
                    }   /* if ( ( $o = $oXPath->query( '/weatherdata/location/name' ) ) && ( $o->length > 0 ) ) */

                    //var_dump( $this->oCity->name );

                    if ( ( $o = $oXPath->query( '/weatherdata/location/location' ) ) && ( $o->length > 0 ) )
                    {
                        $this->identifier       = $this->oCity->geo->identifier = (int) $o->item(0)->getAttribute( 'geobaseid'  );
                        $this->oCity->latitude  = $this->oCity->geo->latitude   = (float) $o->item(0)->getAttribute( 'latitude' );
                        $this->oCity->longitude = $this->oCity->geo->longitude  = (float) $o->item(0)->getAttribute( 'longitude');
                    }   /* if ( ( $o = $oXPath->query( '/weatherdata/location/location' ) ) && ( $o->length > 0 ) ) */

                    //var_dump( $this->identifier );
                    //var_dump( $this->oCity->latitude  );
                    //var_dump( $this->oCity->longitude );

                    if ( ( $o = $oXPath->query( '/weatherdata/sun' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aForecast['sunrise'] = strtotime( $o->item(0)->getAttribute( 'rise' ) );
                        $this->aForecast['sunset' ] = strtotime( $o->item(0)->getAttribute( 'set'  ) );
                    }   /* if ( ( $o = $oXPath->query( '/weatherdata/sun' ) ) && ( $o->length > 0 ) ) */

                    //var_dump( $this->aForecast['sunrise'] );
                    //var_dump( $this->aForecast['sunset' ] );

                    if ( ( $oColl = $oXPath->query( '/weatherdata/forecast/time' ) ) && ( $oColl->length > 0 ) )
                    {
                        $aForecasts = null;

                        foreach ( $oColl as $oNode )
                        {
                            $iFrom                  = strtotime( $oNode->getAttribute( 'from' ) );
                            $iTo                    = strtotime( $oNode->getAttribute( 'to'   ) );
                            $iSymbolNumber          =
                            $szSymbolName           =
                            $szSymbolCode           =
                            $szSymbolURL            =
                            $fPrecipitation         =
                            $szPrecipitationUnit    =
                            $szPrecipitationType    =
                            $fWindDirection         =
                            $szWindDirectionCode    =
                            $szWindDirectionName    =
                            $fWindSpeed             =
                            $szWindSpeedUnit        =
                            $szWindSpeedName        =
                            $fTemperature           =
                            $fTemperatureMin        =
                            $fTemperatureMax        =
                            $fTemperatureFeelsLike  =
                            $fHumidity              =
                            $szHumidityUnit         =
                            $fPressure              =
                            $szPressureUnit         =
                            $fClouds                =
                            $szCloudsName           =
                            $szCloudsUnit           = null;


                            if ( ( $o = $oXPath->query( 'symbol',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $iSymbolNumber  = (int) $o->item(0)->getAttribute( 'number' );
                                $szSymbolName   =       $o->item(0)->getAttribute( 'name'   );
                                $szSymbolCode   =       $o->item(0)->getAttribute( 'var'    );
                                $szSymbolURL    = "http://openweathermap.org/img/wn/{$szSymbolCode}@2x.png";
                            }

                            if ( ( $o = $oXPath->query( 'precipitation',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fPrecipitation         = (float) $o->item(0)->getAttribute( 'value' );
                                $szPrecipitationUnit    =         $o->item(0)->getAttribute( 'unit'  );
                                $szPrecipitationType    =         $o->item(0)->getAttribute( 'type'  );
                            }

                            if ( ( $o = $oXPath->query( 'windDirection',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fWindDirection         = (float) $o->item(0)->getAttribute( 'deg'  );
                                $szWindDirectionCode    =         $o->item(0)->getAttribute( 'code' );
                                $szWindDirectionName    =         $o->item(0)->getAttribute( 'name' );
                            }

                            if ( ( $o = $oXPath->query( 'windSpeed',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fWindSpeed             = (float) $o->item(0)->getAttribute( 'mps'  );
                                $szWindSpeedUnit        =         $o->item(0)->getAttribute( 'unit' );
                                $szWindSpeedName        =         $o->item(0)->getAttribute( 'name' );
                            }

                            if ( ( $o = $oXPath->query( 'temperature',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fTemperature           = (float) ( $o->item(0)->getAttribute( 'value' ) ) - 273.15;
                                $fTemperatureMin        = (float) ( $o->item(0)->getAttribute( 'min'   ) ) - 273.15;
                                $fTemperatureMax        = (float) ( $o->item(0)->getAttribute( 'max'   ) ) - 273.15;
                            }

                            if ( ( $o = $oXPath->query( 'feels_like',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fTemperatureFeelsLike  = (float) ( $o->item(0)->getAttribute( 'value' ) ) - 273.15;
                            }

                            if ( ( $o = $oXPath->query( 'humidity',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fHumidity              = (int) $o->item(0)->getAttribute( 'value'  );
                                $szHumidityUnit         =       $o->item(0)->getAttribute( 'unit'   );
                            }

                            if ( ( $o = $oXPath->query( 'pressure',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fPressure              = (int) $o->item(0)->getAttribute( 'value' );
                                $szPressureUnit         =       $o->item(0)->getAttribute( 'unit'  );
                            }

                            if ( ( $o = $oXPath->query( 'clouds',$oNode ) ) && ( $o->length > 0 ) )
                            {
                                $fClouds                = (float) $o->item(0)->getAttribute( 'all'   );
                                $szCloudsName           =         $o->item(0)->getAttribute( 'value' );
                                $szCloudsUnit           =         $o->item(0)->getAttribute( 'unit'  );
                            }

                            $aForecasts[] = array( 'from'                   => $iFrom                   ,
                                                   'to'                     => $iTo                     ,
                                                   'symbol'                 => $iSymbolNumber           ,
                                                   'symbol-name'            => $szSymbolName            ,
                                                   'symbol-code'            => $szSymbolCode            ,
                                                   'symbol-URL'             => $szSymbolURL             ,
                                                   'precipitation'          => $fPrecipitation          ,
                                                   'precipitation-unit'     => $szPrecipitationUnit     ,
                                                   'precipitation-type'     => $szPrecipitationType     ,
                                                   'wind-direction'         => $fWindDirection          ,
                                                   'wind-direction-code'    => $szWindDirectionCode     ,
                                                   'wind-direction-name'    => $szWindDirectionName     ,
                                                   'wind-speed'             => $fWindSpeed              ,
                                                   'wind-speed-unit'        => $szWindSpeedUnit         ,
                                                   'wind-speed-name'        => $szWindSpeedName         ,
                                                   'temperature'            => $fTemperature            ,
                                                   'temperature-min'        => $fTemperatureMin         ,
                                                   'temperature-max'        => $fTemperatureMax         ,
                                                   'temperature-feels-like' => $fTemperatureFeelsLike   ,
                                                   'humidity'               => $fHumidity               ,
                                                   'humidity-unit'          => $szHumidityUnit          ,
                                                   'pressure'               => $fPressure               ,
                                                   'pressure-unit'          => $szPressureUnit          ,
                                                   'clouds'                 => $fClouds                 ,
                                                   'clouds-name'            => $szCloudsName            ,
                                                   'clouds-unit'            => $szCloudsUnit            ,
                                                 );
                        }   /* foreach ( $oColl as $oNode ) */

                        $this->aForecast['forecasts'] = $aForecasts;

                        //var_dump( "MILESTONE 4" );
                        //var_dump( $this->aForecast['forecasts'] );
                        //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "() ... should migrate code from trql-radio.meteo.class.php");
                    }   /* if ( ( $oColl = $oXPath->query( '/weatherdata/forecast/time' ) ) && ( $oColl->length > 0 ) ) */

                    $aRetVal = $this->aForecast;
                    goto end;
                }   /* if ( ( $o = $oXPath->query( '/weatherdata' ) ) && ( $o->length > 0 ) ) */
                /* ******************************** */
                /* Weather                          */
                /* ******************************** */
                else
                {   /* weather */
                    //var_dump( "MILESTONE 1" );
                    //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "() ... should migrate code from trql-radio.meteo.class.php");

                    if ( ( $o = $oXPath->query( '//city' ) ) && ( $o->length > 0 ) )
                    {
                        $oCityNode  = $o->item(0);

                        $this->oCity->name              =
                        $this->oCity->geo->name         =
                        $szCityName                     = trim( $oCityNode->getAttribute( 'name' ) );

                        $this->identifier               =
                        $this->oCity->geo->identifier   = (int) $o->item(0)->getAttribute( 'id'  );
                    }   /* if ( ( $o = $oXPath->query( '//city' ) ) && ( $o->length > 0 ) ) */

                    //var_dump( $this->oCity->name );
                    //var_dump( $this->identifier );
                    //die();

                    if ( ( $o = $oXPath->query( '//coord' ) ) && ( $o->length > 0 ) )
                    {
                        $this->oCity->latitude   = $this->oCity->geo->latitude   = round( (float) $o->item(0)->getAttribute( 'lat' ),5 );
                        $this->oCity->longitude  = $this->oCity->geo->longitude  = round( (float) $o->item(0)->getAttribute( 'lon' ),5 );
                    }   /* if ( ( $o = $oXPath->query( '//coord' ) ) && ( $o->length > 0 ) ) */

                    //var_dump( $this->oCity->latitude );
                    //var_dump( $this->oCity->longitude );
                    //die();

                    if ( ( $o = $oXPath->query( '/current/temperature' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['temperature'    ] = (float) ( $o->item(0)->getAttribute( 'value' ) ) - 273.15;
                        $this->aWeather['temperature-min'] = (float) ( $o->item(0)->getAttribute( 'min'   ) ) - 273.15;
                        $this->aWeather['temperature-max'] = (float) ( $o->item(0)->getAttribute( 'max'   ) ) - 273.15;
                    }

                    //var_dump( $this->aWeather['temperature'    ] );
                    //var_dump( $this->aWeather['temperature-min'] );
                    //var_dump( $this->aWeather['temperature-max'] );

                    if ( ( $o = $oXPath->query( '/current/feels_like' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['temperature-feels-like'] = (float) ( $o->item(0)->getAttribute( 'value' ) ) - 273.15;
                    }

                    //var_dump( $this->aWeather['temperature-feels-like' ] );

                    if ( ( $o = $oXPath->query( '/current/humidity' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['humidity'] = (int) ( $o->item(0)->getAttribute( 'value' ) );
                    }

                    //var_dump( $this->aWeather['humidity' ] );

                    if ( ( $o = $oXPath->query( '/current/pressure' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['pressure'] = (int) ( $o->item(0)->getAttribute( 'value' ) );
                    }

                    //var_dump( $this->aWeather['pressure' ] );

                    if ( ( $o = $oXPath->query( '/current/wind/speed' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['wind-speed']           = (int) ( $o->item(0)->getAttribute( 'value' ) );
                        $this->aWeather['wind-speed-unit']      =       ( $o->item(0)->getAttribute( 'unit'  ) );
                        $this->aWeather['wind-speed-name']      =       ( $o->item(0)->getAttribute( 'name'  ) );
                    }

                    if ( ( $o = $oXPath->query( '/current/wind/direction' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['wind-direction']       = (int) ( $o->item(0)->getAttribute( 'value' ) );
                        $this->aWeather['wind-direction-code']  =       ( $o->item(0)->getAttribute( 'code'  ) );
                        $this->aWeather['wind-direction-name']  =       ( $o->item(0)->getAttribute( 'name'  ) );
                    }

                    if ( ( $o = $oXPath->query( '/current/clouds' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['clouds']               = (int) ( $o->item(0)->getAttribute( 'value' ) );
                        $this->aWeather['clouds-name']          =       ( $o->item(0)->getAttribute( 'name' ) );
                    }

                    if ( ( $o = $oXPath->query( '/current/visibility' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['visibility']           = (int) ( $o->item(0)->getAttribute( 'value' ) );
                    }

                    if ( ( $o = $oXPath->query( '/current/precipitation' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['precipitation']        =       ( $o->item(0)->getAttribute( 'mode' ) );
                    }

                    if ( ( $o = $oXPath->query( '/current/weather' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['weather']              =        ( $o->item(0)->getAttribute( 'value'  ) );
                        $this->aWeather['weather-number']       = (int)  ( $o->item(0)->getAttribute( 'number' ) );
                        $this->aWeather['weather-icon']         =        ( $o->item(0)->getAttribute( 'icon'   ) );
                    }

                    if ( ( $o = $oXPath->query( '/current/lastupdate' ) ) && ( $o->length > 0 ) )
                    {
                        $this->aWeather['lupdate']              = strtotime( $o->item(0)->getAttribute( 'value' ) );
                    }

                    $aRetVal            = $this->aWeather;
                    goto end;
                    //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "() ... should migrate code from trql-radio.meteo.class.php");
                }

                {   /* Code deactivated on 17-07-20 11:23:07 */
                    // deactivatyed on 17-07-20 11:23:07 ... $oGeoname = new Geoname();
                    // deactivatyed on 17-07-20 11:23:07 ...
                    // deactivatyed on 17-07-20 11:23:07 ... //var_dump( $this->oCity->name );
                    // deactivatyed on 17-07-20 11:23:07 ... //die();
                    // deactivatyed on 17-07-20 11:23:07 ...
                    // deactivatyed on 17-07-20 11:23:07 ... if ( is_string( $szGeoXML = $oGeoname->info( $this->oCity->latitude,$this->oCity->longitude ) ) )
                    // deactivatyed on 17-07-20 11:23:07 ... {
                    // deactivatyed on 17-07-20 11:23:07 ...     $oDom2 = new DOMDocument();
                    // deactivatyed on 17-07-20 11:23:07 ...
                    // deactivatyed on 17-07-20 11:23:07 ...     if ( $oDom2->loadXML( $szGeoXML ) )
                    // deactivatyed on 17-07-20 11:23:07 ...     {
                    // deactivatyed on 17-07-20 11:23:07 ...         if ( $oXPath2 = new DOMXPath( $oDom2 ) )
                    // deactivatyed on 17-07-20 11:23:07 ...         {
                    // deactivatyed on 17-07-20 11:23:07 ...             if ( ( $oGeoColl = $oXPath2->query( "//geoname[last()]" ) ) && ( $oGeoColl->length > 0 ) )
                    // deactivatyed on 17-07-20 11:23:07 ...             {
                    // deactivatyed on 17-07-20 11:23:07 ...                 $oGeoNode = $oGeoColl->item( 0 );
                    // deactivatyed on 17-07-20 11:23:07 ...
                    // deactivatyed on 17-07-20 11:23:07 ...                 foreach( $this->aMercator as $key => $xValue )
                    // deactivatyed on 17-07-20 11:23:07 ...                 {
                    // deactivatyed on 17-07-20 11:23:07 ...                     if ( ( $o = $oXPath2->query( $key,$oGeoNode ) ) && ( $o->length > 0 ) )
                    // deactivatyed on 17-07-20 11:23:07 ...                         $this->aMercator[$key] = $o->item( 0 )->nodeValue;
                    // deactivatyed on 17-07-20 11:23:07 ...
                    // deactivatyed on 17-07-20 11:23:07 ...                 }   /* foreach( $this->oGeoname as $key => $xValue ) */
                    // deactivatyed on 17-07-20 11:23:07 ...             }
                    // deactivatyed on 17-07-20 11:23:07 ...             //var_dump( $szGeoXML );
                    // deactivatyed on 17-07-20 11:23:07 ...             //var_dump( $this->oGeoname );
                    // deactivatyed on 17-07-20 11:23:07 ...             //die();
                    // deactivatyed on 17-07-20 11:23:07 ...         }   /* if ( $oXPath2 = new DOMXPath( $oDom2 ) ) */
                    // deactivatyed on 17-07-20 11:23:07 ...     }   /* if ( $oDom2->loadXML( $szGeoXML ) ) */
                    // deactivatyed on 17-07-20 11:23:07 ... }   /* if ( is_string( $szGeoXML = $oGeoname->info( $this->oCity->latitude,$this->oCity->longitude ) ) ) */

                    //var_dump( $szXML );
                    //var_dump( $szGeoXML );
                    //var_dump( "Line " . __LINE__ . ' of ' . __METHOD__ . '()',$this );
                }   /* Code deactivated on 17-07-20 11:23:07 */
            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( $oDom->loadXML( $szXML ) ) */

        end:
        $aRetVal['city'] = $this->oCity;
        return ( $aRetVal );
    }   /* End of Anaximandre.parse() ================================================= */
    /* ================================================================================ */


    public function weather()
    /*---------------------*/
    {
        $aRetVal    = null;
        $iArgs      = func_num_args();

        switch ( $iArgs )
        {
            case 1  :
                {
                    /*  Ici, on pourrait se poser la question de savoir si on a reçu :

                            - une array : alors c'est $aParams
                            - un int : alors c'est un geonameId
                            - une string : alors c'est une ville
                    */

                    $aParams = func_get_arg( 0 );
                }
            case 2  :
                {
                    $aParams = array( 'lat' => func_get_arg( 0 ),
                                      'lng' => func_get_arg( 1 ),
                                    );
                }
                break;
        }

        //var_dump( $aParams );
        $szCacheFile = vaesoli::FIL_RealPath( $this->home() . '/' . $this->myself['name'] . '.' . $this->method( __METHOD__ ) . '.' . md5( serialize( $aParams ) ) . '.cache' );
        $aData       = null;

        //var_dump( $szCacheFile );
        //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "()" );


        if ( $this->remembering )
        {
            if ( $this->fileExistsAndNoOlderThan( $szCacheFile,300 ) )
                $aData = $this->getHashFile( $szCacheFile );
        }

        if ( is_null( $aData ) )
        {
            $aData = $this->getURL( "http://api.openweathermap.org/data/2.5/weather",$aParams );

            if ( $this->storing )
                $this->saveHashFile( $szCacheFile,$aData );
        }   /* if ( is_null( $aData ) ) */

        if ( ! is_null( $aData ) )
            $aRetVal = $this->parse( $aData );

        end:
        return ( $aRetVal );

    }   /* End of Anaximandre.weather() =============================================== */
    /* ================================================================================ */


    public function forecast()
    /*-----------------------*/
    {
        $aRetVal    = null;
        $iArgs      = func_num_args();

        switch ( $iArgs )
        {
            case 1  :
                {
                    /*  Ici, on pourrait se poser la question de savoir si on a reçu :

                            - une array : alors c'est $aParams
                            - un int : alors c'est un geonameId
                            - une string : alors c'est une ville
                    */

                    $aParams = func_get_arg( 0 );
                }
            case 2  :
                {
                    $aParams = array( 'lat' => func_get_arg( 0 ),
                                      'lng' => func_get_arg( 1 ),
                                    );
                }
                break;
        }

        //var_dump( $aParams );
        $szCacheFile = vaesoli::FIL_RealPath( $this->home() . '/' . $this->myself['name'] . '.' . $this->method( __METHOD__ ) . '.' . md5( serialize( $aParams ) ) . '.cache' );
        $aData       = null;

        //var_dump( $szCacheFile );
        //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "()" );


        if ( $this->remembering )
        {
            if ( $this->fileExistsAndNoOlderThan( $szCacheFile,300 ) )
                $aData = $this->getHashFile( $szCacheFile );
        }

        if ( is_null( $aData ) )
        {
            $aData = $this->getURL( "http://api.openweathermap.org/data/2.5/forecast",$aParams );

            if ( $this->storing )
                $this->saveHashFile( $szCacheFile,$aData );
        }   /* if ( is_null( $aData ) ) */

        if ( ! is_null( $aData ) )
            $aRetVal = $this->parse( $aData );

        end:
        return ( $aRetVal );
    }   /* End of Anaximandre.forecast() ============================================== */
    /* ================================================================================ */


    /* Loader des templates ne devrait se faire que via la classe VictorHugo */

    public function loadTemplates()
    /*---------------------------*/
    {
        $this->loadWeatherTemplates();
        $this->loadForecastTemplates();
    }   /* End of Anaximandre.loadTemplates() ========================================= */
    /* ================================================================================ */


    public function loadWeatherTemplates()
    /*----------------------------------*/
    {
        if ( is_dir( $this->home() ) )
        {
            $this->aWeatherTemplates = $this->loadSentences( $this->home() . '/weather.templates.txt' );
        }
        else
        {
            throw new \Exception( __METHOD__ . '() at line ' . __LINE__ . ' of ' . basename( __FILE__ ) . ': Invalid home (Error #' . EXCEPTION_CODE_INVALID_HOME . ')',EXCEPTION_CODE_INVALID_HOME );
        }

    }   /* End of Anaximandre.loadWeatherTemplates() ================================== */
    /* ================================================================================ */


    public function loadForecastTemplates()
    /*-----------------------------------*/
    {
        if ( is_dir( $szHome = $this->home() ) )
        {
            $this->aForecastTemplates = $this->loadSentences( $this->home() . '/forecast.templates.txt' );
        }
        else
        {
            throw new \Exception( __METHOD__ . '() at line ' . __LINE__ . ' of ' . basename( __FILE__ ) . ': Invalid home (Error #' . EXCEPTION_CODE_INVALID_HOME . ')',EXCEPTION_CODE_INVALID_HOME );
        }
    }   /* End of Anaximandre.loadForecastTemplates() ================================= */
    /* ================================================================================ */


    public function hasTemplates()
    /*--------------------------*/
    {
        return ( $this->hasWeatherTemplates() || $this->hasForecastTemplates() );
    }   /* End of Anaximandre.hasTemplates() ========================================== */
    /* ================================================================================ */


    public function hasWeatherTemplates()
    /*---------------------------------*/
    {
        return ( is_array( $this->aWeatherTemplates ) && count( $this->aWeatherTemplates ) > 0 );
    }   /* End of Anaximandre.hasWeatherTemplates() =================================== */
    /* ================================================================================ */


    public function hasForecastTemplates()
    /*------------------------------------*/
    {
        return ( is_array( $this->aForecastTemplates ) && count( $this->aForecastTemplates ) > 0 );
    }   /* End of Anaximandre.hasForecastTemplates() ================================== */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        //echo __LINE__," ... " . __METHOD__ . "() : SHOULD RETURN TEMPLATES\n";
    }   /* End of Anaximandre.templates() ============================================= */
    /* ================================================================================ */


    /* Cette méthode devrait être implémentée dans un objet de type "memory" */
    protected function getLongTermMemoryFile( $szTopic = null )
    /*-------------------------------------------------------*/
    {
        if ( is_null( $szTopic ) )
            $szFile = $this->home() . '/memory.cache';
        else
            $szFile = $this->home() . '/' . $szTopic . '/memory.cache';

        return ( vaesoli::FIL_RealPath( $szFile) );

    }   /* End of Anaximandre.getLongTermMemoryFile() ================================= */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aSubsts    = null;
        $oSubst     = new Substitution();

        if ( is_file( $szFile = $this->getLongTermMemoryFile( 'substitutions' ) ) )
        {
            $aSubsts = $this->getHashFile( $szFile );
        }

        if ( is_null( $aSubsts ) )
        {
            echo __LINE__," ... " . __METHOD__ . "() : SHOULD CREATE DEFAULT SUBSTITUTIONS!!!\n";

            // ATENTION, CECI NE SONT QUE LES SUBSTITUTIONS SUR LE TEMPS ... PAS SUR LES PREVISIONS

            $oSubst->add( '%city%'                  ,'VILLE'                                              );    /* 01 */
            $oSubst->add( '%country%'               ,'PAYS'                                               );    /* 02 */
            $oSubst->add( '%temperature%'           ,round( $this->aWeather['temperature'],0 )            );    /* 03 */
            $oSubst->add( '%temperature-min%'       ,round( $this->aWeather['temperature-min'],0 )        );    /* 04 */
            $oSubst->add( '%temperature-max%'       ,round( $this->aWeather['temperature-max'],0 )        );    /* 05 */
            $oSubst->add( '%temperature-feels-like%',round( $this->aWeather['temperature-feels-like'],0 ) );    /* 06 */
            $oSubst->add( '%humidity%'              ,round( $this->aWeather['humidity'],0 )               );    /* 07 */
            $oSubst->add( '%pressure%'              ,round( $this->aWeather['pressure'],0 )               );    /* 08 */
            $oSubst->add( '%wind-speed%'            ,round( $this->aWeather['wind-speed'],0 )             );    /* 09 */
            $oSubst->add( '%wind-speed-unit%'       ,$this->aWeather['wind-speed-unit']                   );    /* 10 */
            $oSubst->add( '%wind-speed-name%'       ,$this->aWeather['wind-speed-name']                   );    /* 11 */
            $oSubst->add( '%weather%'               ,$this->aWeather['weather']                           );    /* 12 */
            $oSubst->add( '%date%'                  ,date( 'd/m/Y',$this->aWeather['lupdate'] )           );    /* 13 */
            $oSubst->add( '%time%'                  ,date( 'H:i',$this->aWeather['lupdate'] )             );    /* 14 */

            if ( $this->storing && true )
            {
                if ( ! is_dir( dirname( $szFile ) ) )
                    vaesoli::FIL_MkDir( dirname( $szFile ) );

                if ( is_dir( dirname( $szFile ) ) )
                {
                    if ( $oSubst->save( $szFile ) )
                        echo __LINE__," ... {$szFile} SAVED\n";
                    else
                        echo __LINE__," ... {$szFile} CANNOT BE SAVED\n";
                }
            }
        }   /* if ( is_null( $aSubsts ) ) */

        //var_dump( $szFile );
        //echo __LINE__," ... " . __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n";
        //die();

        return ( $aSubsts );
    }   /* End of Anaximandre.substitutions() ========================================= */
    /* ================================================================================ */


    public function speak( $szType = 'weather',$iWhen = null ) : string
    /*---------------------------------------------------------------*/
    {
        static $oVH = null;

        if ( is_null( $oVH ) )
            $oVH = new VictorHugo();

        switch ( strtolower( trim( $szType ) ) )
        {
            case 'weather'      :
                {
                    $data = $this->aWeather;
                }   /* weather */
                break;
            case 'forecast'     :
                {
                    $data = $this->aForecast;
                }   /* forecast */
                break;
            default             :
                {
                    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": UNKNOWN szType (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );
                }   /* forecast */
                break;
        }   /* switch ( strtolower( trim( $szType ) ) ) */

        $oContext               = new Context();

        $oContext->originator   = $this;
        $oContext->verb         = $szType;
        $oContext->data         = $data;


        /* Attention, avec un object static ... on ne fait qu'ajouter le même contexte à l'objet !!! */
        $oVH->addContext( $oContext );

        $szRetVal = $oVH->speak();

        return ( $szRetVal );

    }   /* End of Anaximandre.speak() ================================================= */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Anaximandre.sing() ================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        $this->backup();
    }   /* End of Anaximandre.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class Anaximandre ======================================================= */
/* ==================================================================================== */
?>