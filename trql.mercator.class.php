<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.mercator.class.php *}
    {*purpose               Set of Utility geocoordinates-oriented services (mostly based
                            on geonames.org) *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 15-08-20 12:38 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 15-08-20 12:38 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\mercator;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'MERCATOR_CLASS_VERSION' ) or define( 'MERCATOR_CLASS_VERSION','0.1' );
defined( "HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS" ) or define( "HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS",20037508.34 );

defined( "TOMTOM_INCIDENT_TYPE_UNKNOWN"                 ) or define( "TOMTOM_INCIDENT_TYPE_UNKNOWN"             , 0  );
defined( "TOMTOM_INCIDENT_TYPE_ACCIDENT"                ) or define( "TOMTOM_INCIDENT_TYPE_ACCIDENT"            , 1  );
defined( "TOMTOM_INCIDENT_TYPE_FOG"                     ) or define( "TOMTOM_INCIDENT_TYPE_FOG"                 , 2  );
defined( "TOMTOM_INCIDENT_TYPE_DANGEROUS_CONDITIONS"    ) or define( "TOMTOM_INCIDENT_TYPE_DANGEROUS_CONDITIONS", 3  );
defined( "TOMTOM_INCIDENT_TYPE_RAIN"                    ) or define( "TOMTOM_INCIDENT_TYPE_RAIN"                , 4  );
defined( "TOMTOM_INCIDENT_TYPE_ICE"                     ) or define( "TOMTOM_INCIDENT_TYPE_ICE"                 , 5  );
defined( "TOMTOM_INCIDENT_TYPE_JAM"                     ) or define( "TOMTOM_INCIDENT_TYPE_JAM"                 , 6  );
defined( "TOMTOM_INCIDENT_TYPE_LANE_CLOSED"             ) or define( "TOMTOM_INCIDENT_TYPE_LANE_CLOSED"         , 7  );
defined( "TOMTOM_INCIDENT_TYPE_ROAD_CLOSED"             ) or define( "TOMTOM_INCIDENT_TYPE_ROAD_CLOSED"         , 8  );
defined( "TOMTOM_INCIDENT_TYPE_ROAD_WORKS"              ) or define( "TOMTOM_INCIDENT_TYPE_ROAD_WORKS"          , 9  );
defined( "TOMTOM_INCIDENT_TYPE_WIND"                    ) or define( "TOMTOM_INCIDENT_TYPE_WIND"                , 10 );
defined( "TOMTOM_INCIDENT_TYPE_FLOODING"                ) or define( "TOMTOM_INCIDENT_TYPE_FLOODING"            , 11 );
defined( "TOMTOM_INCIDENT_TYPE_DETOUR"                  ) or define( "TOMTOM_INCIDENT_TYPE_DETOUR"              , 12 );
defined( "TOMTOM_INCIDENT_TYPE_CLUSTER"                 ) or define( "TOMTOM_INCIDENT_TYPE_CLUSTER"             , 13 );

defined( "TOMTOM_MAGNITUDE_OF_DELAY_UNKNOWN"            ) or define( "TOMTOM_MAGNITUDE_OF_DELAY_UNKNOWN"        ,0  );
defined( "TOMTOM_MAGNITUDE_OF_DELAY_MINOR"              ) or define( "TOMTOM_MAGNITUDE_OF_DELAY_MINOR"          ,1  );
defined( "TOMTOM_MAGNITUDE_OF_DELAY_MODERATE"           ) or define( "TOMTOM_MAGNITUDE_OF_DELAY_MODERATE"       ,2  );
defined( "TOMTOM_MAGNITUDE_OF_DELAY_MAJOR"              ) or define( "TOMTOM_MAGNITUDE_OF_DELAY_MAJOR"          ,3  );
defined( "TOMTOM_MAGNITUDE_OF_DELAY_UNDEFINED"          ) or define( "TOMTOM_MAGNITUDE_OF_DELAY_UNDEFINED"      ,4  );

defined( "GEONAMES_ERROR_14"                            ) or define( "GEONAMES_ERROR_14"                        ,4  );


/* ==================================================================================== */
/** {{*class Mercator=

    {*desc

        Geo coordinates services

    *}

    {*remark

        Gerard De Kremer, known in the Republic of Letters under his Latinized
        name of Gerardus Mercator and in French books as Gérard Mercator, born
        on 5 March 1512 in Rupelmonde and dead on 2 December 1594 in Duisburg,
        was a Flemish mathematician, GEOGRAPHER and CARTOGRAPHER, inventor of
        the map projection that bears his name.

    *}

    {*warning

        Many of the services of the Mercator class are still not-finalized
        and come in non-final implemenations.

    *}

    *}}
 */
/* ==================================================================================== */
class Mercator extends Utility implements iContext
/*----------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $aCities                = null;                     /* {*property   $aCities                    (array)                 A list of predefined cities (name, lat, long and geonameId) *} */
    public      $aCountrySynonyms       = null;                     /* {*property   $aCountrySynonyms           (array)                 Countryname to country code *} */

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

        $this->defaultCities();
        $this->setCountrySynonyms();

        //var_dump( $this->ttl );
        //die();

        return ( $this );
    }   /* End of Mercator.__construct() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAPIKey([$szSystem])=

        Get the API Key related to the system we're dealing with

        {*params
            $szSystem       (string)        Optional. [c]null[/c] by default.
        *}

        {*return
            (string)        The API Key or [c]null[/c] if not found
        *}

        {*abstract
            As we are dealing with possibly multiple external API calls, we may have
            several API keys to consider. That's what the "system" parameter is for.
        *}

        *}}
    */
    /* ================================================================================ */
    private function getAPIKey( $szSystem = null )
    /*------------------------------------------*/
    {
        if ( ! is_null( $szSystem ) )
            $szCave = "/api.{$szSystem}.key.txt";
        else
            $szCave = '/api.key.txt';

        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->szHome . $szCave ) ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of Mercator.getAPIKey() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*geoIP([$szSystem])=

        Get the API Key related to the system we're dealing with

        {*params
            $szIP           (string)        IP address to check. Optional.
                                            [c]$_SERVER['REMOTE_ADDR'][/c] by default.
        *}

        {*return
            (string)        The API Key or [c]null[/c] if not found
        *}

        {*abstract
            As we are dealing with possibly multiple external API calls, we may have
            several API keys to consider. That's what the "system" parameter is for.
        *}

        *}}
    */
    /* ================================================================================ */
    public function geoIP( $szIP = null )
    /*---------------------------------*/
    {
        $aRetVal        = null;
        $szAccessKey    = $this->getAPIKey( 'geoip' );
        $szIP           = $szIP ?? $_SERVER['REMOTE_ADDR'];
        $szCacheFile    = $this->cacheName( 'geoIP'                                     ,
                                            $xParams        = array( 'IP'   => $szIP )  ,
                                            $xAdditional    = null );

        if ( true && $this->remembering && is_file( $szCacheFile ) && $this->fileExistsAndNoOlderThan( $szCacheFile,$this->ttl ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( true && $this->remembering && ... */
        else    /* Else of ... if ( true && $this->remembering && ... */
        {
            if ( ! empty( $szJSON = $this->GetURL( $szURL = "http://api.ipstack.com/{$szIP}?access_key={$szAccessKey}" ) ) )
            {
                //var_dump( $szJSON );

                if ( $oJSON = json_decode( $szJSON ) )
                {
                    //var_dump( $oJSON );
                    //var_dump( $oJSON->location );

                    $aLanguages = null;

                    if ( isset( $oJSON->location ) && isset( $oJSON->location->langauges ) )
                    {
                        foreach( $oJSON->location->languages as $oLanguage )
                        {
                            $aLanguages[] = array( 'code'   => $oLanguage->code     ,
                                                   'name'   => $oLanguage->name     ,
                                                   'native' => $oLanguage->native   ,
                                                 );

                        }   /* foreach( $oJSON->location->languages => $aLanguage ) */
                    }   /* if ( isset( $oJSON->location ) && isset( $oJSON->location->langauges ) ) */

                    $aRetVal = array( 'type'            => $oJSON->type                 ,
                                      'continentCode'   => $oJSON->continent_code       ,
                                      'continentName'   => $oJSON->continent_name       ,
                                      'countryCode'     => $oJSON->country_code         ,
                                      'countryName'     => $oJSON->country_name         ,
                                      'regionCode'      => $oJSON->region_code          ,
                                      'regionName'      => $oJSON->region_name          ,
                                      'locality'        => $oJSON->city                 ,
                                      'postalcode'      => $oJSON->zip                  ,
                                      'latitude'        => $oJSON->latitude             ,
                                      'longitude'       => $oJSON->longitude            ,
                                      'geonameId'       => $oJSON->location->geoname_id ,
                                      'capital'         => $oJSON->location->capital    ,
                                      'languages'       => $aLanguages                  ,
                                    );

                    if ( $this->storing && is_array( $aRetVal ) && count( $aRetVal ) > 0 )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): IP data stored in {$szCacheFile}" );
                    }   /* if ( $this->storing ) */
                }   /* if ( $oJSON = json_decode( $szJSON ) ) */
            }   /* if ( ! empty( $szJSON = $this->GetURL( $szURL = "http://api.ipstack.com/{$szIP}?access_key={$szAccessKey}" ) ) ) */
        }   /* End of ... Else of ... if ( true && $this->remembering && ... */

        end:
        return ( $aRetVal );
    }   /* End of Mercator.geoIP() ==================================================== */
    /* ================================================================================ */


    //public function loadBELAddresses( $szFile )
    ///*---------------------------------------*/
    //{
    //    $szOutputFile = $szFile . '.xml';
    //
    //    if ( ( $handle = fopen( $szOutputFile,"a+" ) ) !== false )         // Tentons de l'ouvrir mode Append
    //    {
    //        $aLines = file( $szFile,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    //
    //        foreach( $aLines as $szLine )
    //        {
    //            $aParts = explode( "\t",$szLine );
    //
    //            /* Elimination des numéros (18-23 ou 530A) */
    //            $aParts[2] = trim( preg_replace( '%(?:\d)+(A|B|C)?(-|/)?\d+(A|B|C)?%si','', $aParts[2] ) );
    //            /* Elimination des chiffres en début de string */
    //            $aParts[2] = trim( preg_replace( '/\A\d+/si','',$aParts[2] ) );
    //            /* Elimination des ',' en fin de string */
    //            $aParts[2] = trim( preg_replace('/,\z/si','',$aParts[2] ) );
    //
    //            //$aParts[2] = trim( preg_replace( '%(\d)+(A|B|C)?(-|/)?\d+(A|B|C)?%si','',$aParts[2] ) );
    //            //$aParts[2] = trim( preg_replace( '%(\d)+(A|B|C)?(-|/)?\d+(A|B|C)?%si','',$aParts[2] ) );
    //
    //            /* Si un code postal belge */
    //            if ( strlen( $aParts[0] ) === 4 )
    //                fwrite( $handle,"<Address><PostalCode>{$aParts[0]}</PostalCode><Locality><![CDATA[{$aParts[1]}]]></Locality><Street><![CDATA[{$aParts[2]}]]></Street></Address>\n" );
    //        }
    //
    //        $this->echo( count( $aLines ) . "\n" );
    //
    //        fclose( $handle );
    //    }
    //
    //    $this->echo( "DONE\n" );
    //}




    public function searchAddress( $szFile,$szText )
    /*--------------------------------------------*/
    {
        $aRetVal = null;
        $tStart  = microtime( true );

        if ( $handle = fopen( $szFile, "r" ) )
        {
            echo "Looking for {$szText}\n";
            $i = 1;
            while ( ! feof( $handle ) )
            {
                $buffer = fgets( $handle );

                if ( ( $iPos = vaesoli::STR_iPos( $buffer,$szText ) ) !== -1 )
                {
                    $aRetVal[] = array( 'line'      => $i               ,
                                        'pos'       => $iPos            ,
                                        'text'      => $szText          ,
                                        'length'    => strlen( $szText ),
                                        'matched'   => $buffer          ,
                                        'perfInSec' => round( microtime( true ) - $tStart,5 )
                                      );
                }

                $i++;
            }

            fclose( $handle );
        }

        return ( $aRetVal );
    }


    // /* Cette méthode n'est pas utilisée. Elle a servi à construire des fichiers intermédiaires */
    // public function csv( $szFile )
    // /*--------------------------*/
    // {
    //     if ( ( $handle = fopen( $szFile,"r" ) ) !== false )         // Tentons de l'ouvrir en read-only
    //     {
    //         $aHeaders   = null;                                     // Le nom des champs (1ère ligne du fichier CSV)
    //         $aFields    = null;                                     // Ensemble de champs (ligne par ligne)
    // 
    //         $aFields = fgetcsv( $handle,1000,',');                  // Lisons la première ligne
    //         $iFields = count( $aFields );                           // Comptons le nombre de champs (avec le temps, la structure du fichier .CSV a évolué ... et donc le nb de champs n'est pas toujours le même)
    // 
    //         if ( $iFields > 0 )                                     // Si on est sur la première ligne (c'est la ligne du nom des champs)
    //             $aHeaders = $aFields;
    // 
    //         var_dump( $aHeaders );
    // 
    //         $i = 1;
    // 
    //         if ( is_array( $aHeaders ) )                            // Si on a des headers
    //         {
    //             $szOutputFileNL = $szFile . '.nl.2.txt';
    //             $szOutputFileFR = $szFile . '.fr.2.txt';
    // 
    //             if ( ( ( $handleNL = fopen( $szOutputFileNL,"a+" ) ) !== false ) &&
    //                  ( ( $handleFR = fopen( $szOutputFileFR,"a+" ) ) !== false )
    //                )
    //             {
    //                 $tStart = microtime( true );
    //                 while ( ( $aFields = fgetcsv( $handle,1000,',') ) !== false ) // Lisons toutes les lignes
    //                 {
    //                     //$aValues[] = array( 'EntityNumber'      => $aFields[0],
    //                     //                    'TypeOfAddress'     => $aFields[1],
    //                     //                    'CountryNL'         => $aFields[2],
    //                     //                    'CountryFR'         => $aFields[3],
    //                     //                    'Zipcode'           => $aFields[4],
    //                     //                    'MunicipalityNL'    => $aFields[5],
    //                     //                    'MunicipalityFR'    => $aFields[6],
    //                     //                    'StreetNL'          => $aFields[7],
    //                     //                    'StreetFR'          => $aFields[8],
    //                     //                    'HouseNumber'       => $aFields[9],
    //                     //                    'Box'               => $aFields[10],
    //                     //                    'ExtraAddressInfo'  => $aFields[11],
    //                     //                    'DateStrikingOff'   => $aFields[12],
    //                     //                   );
    // 
    //                     $this->echo( $i++ . "\n" );
    // 
    //                     if ( ! empty( $aFields[4] ) && preg_match( '/\d{4}/',$aFields[4] ) )
    //                     {
    //                         if ( ! empty( $aFields[5] ) && ! empty( $aFields[7] ) )
    //                         {
    //                             $aFields[7] = preg_replace( '/\(.*?\)/','',$aFields[7] );
    //                             fwrite( $handleNL,$aFields[4] . "\t" . $aFields[5] . "\t" . $aFields[7] . "\n" );
    //                         }
    // 
    //                         if ( ! empty( $aFields[6] ) && ! empty( $aFields[8] ) )
    //                         {
    //                             $aFields[8] = preg_replace( '/\(.*?\)/','',$aFields[8] );
    //                             fwrite( $handleFR,$aFields[4] . "\t" . $aFields[6] . "\t" . $aFields[8] . "\n" );
    //                         }
    //                     }
    // 
    //                     //if ( $i > 100 )
    //                     //    break;
    // 
    //                     //$aValues[] = $aFields;
    //                     //var_dump( $aFields );
    //                     //break;
    //                 }
    //                 $tEnd = microtime( true );
    //                 $this->echo( "Took " . round( $tEnd - $tStart,5 ) . " secs to process the file" );
    // 
    // 
    //                 fclose( $handleNL );
    //                 fclose( $handleFR );
    // 
    //             }
    //             else
    //             {
    //                 $this->Echo( "Cannot open OUTPUT files\n" );
    //             }
    //         }   /* if ( is_array( $aHeaders ) ) */
    // 
    //         fclose( $handle );                                      // Fermons le fichier de données CSV
    //     }   /* if ( ( $handle = fopen( $szFile,"r" ) ) !== false ) */
    // 
    //     var_dump( $aValues ?? null );
    // 
    //     $this->die( "TRAITEMENT DES ADRESSES BELGES: " . $szFile );
    // }   /* End of Mercator.csv() ====================================================== */
    // /* ================================================================================ */


    /* Final */
    public function call( $szService,$aParams )
    /*---------------------------------------*/
    {
        static $szSecret = null;

        if ( is_null( $szSecret ) )
            $szSecret = $this->getAPIKey( 'geonames' );

        $szParams = '';

        foreach ( $aParams as $szKey => $xValue )
        {
            //$szParams .= "&{$szKey}=" . rawurlencode( $xValue );
            $szParams .= "&{$szKey}=" . urlencode( $xValue );
        }   /* foreach ( $aParams as $szKey => $xValue ) */

        $szParams = "?username={$szSecret}" . $szParams;


        $szURL = "http://api.geonames.org/{$szService}{$szParams}";
        //var_dump( $szURL );
        //die();

        return ( $this->getURL( $szURL ) );
    }   /* End of Mercator.call() ===================================================== */
    /* ================================================================================ */


    /* Final */
    public function nearby()
    /*--------------------*/
    {
        $aRetVal    = null;

        $iArgs      = func_num_args();

        switch ( $iArgs )
        {
            case 1:
                {
                    $aParams = func_get_arg( 0 );
                    if ( is_array( $aParams ) && isset( $aParams['latitude'] ) && isset( $aParams['longitude'] ) )
                    {
                        $fLatitude  = $aParams['latitude'];
                        $fLongitude = $aParams['longitude'];
                    }
                    else
                    {
                        throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": Invalid parameter (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );
                    }
                }
                break;
            case 2  :
                {
                    $fLatitude  = func_get_arg( 0 );
                    $fLongitude = func_get_arg( 1 );

                    //$this->__echo( "Received 2 parameters" );
                }
                break;
            default :
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": Invalid parameter count (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETERS_COUNT . ")",EXCEPTION_CODE_INVALID_PARAMETERS_COUNT );
        }   /* switch ( $iArgs ) */

        $szCacheFile = $this->cacheName( $szMethod = 'nearby',$aParams = array( 'lat' => $fLatitude,'lng' => $fLongitude ),$xAdditional = null );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            //var_dump( "Data retrieved from cache" );
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
        }   /* if ( true && $this->remembering && is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( true && $this->remembering && is_file( $szCacheFile ) ) */
        {
            if ( ! empty( $szXML = $this->call( 'findNearby',$aParams ) ) )
            {
                if ( is_array( $aRetVal = $this->parse( $szXML,'nearby' ) ) )
                {
                    //var_dump( $aRetVal );
                    //$this->die();

                    if ( $this->storing )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): Incidents data stored in {$szCacheFile}" );
                    }   /* if ( $this->storing ) */
                }   /* if ( is_array( $aRetVal = $this->parse( $szXML ) ) */
            }   /* if ( ! empty( $szXML = $this->call( 'findNearby', ) ) ) */
        }    /* End of ... Else of ... if ( true && $this->remembering && is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.nearby() =================================================== */
    /* ================================================================================ */


    /* Final */
    protected function cacheName( $szMethod,$xParams,$xAdditional = null )
    /*------------------------------------------------------------------*/
    {
        $szMethod = str_replace( array( '\\',':','::','..' ),
                                 array( '.' ,'.','.' ,'.'  ),
                                 $szMethod );

        if ( is_null( $xAdditional ) )
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . '.cache' );
        else
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . md5( serialize( $xAdditional ) ) . '.cache' );

        return ( $szCacheFile );
    }   /* End of Mercator.cacheName() ================================================ */
    /* ================================================================================ */


    /* Final */
    /* DOC: https://gist.github.com/springmeyer/871897 */
    /* DOC: https://gis.stackexchange.com/questions/208966/converting-lat-long-to-epsg3857-coordinates */
    public function degrees2Meters()
    /*----------------------------*/
    {
        $iArgs = func_num_args();

        switch ( $iArgs )
        {
            case 1:
                {
                    $aParams = func_get_arg( 0 );

                    //$this->__echo( "Received 1 parameter" );

                    if ( is_array( $aParams ) && isset( $aParams['latitude'] ) && isset( $aParams['longitude'] ) )
                    {
                        $fLatitude  = $aParams['latitude'];
                        $fLongitude = $aParams['longitude'];
                    }
                    else
                    {
                        throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Invalid parameter (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );
                    }
                }
                break;
            case 2  :
                {
                    $fLatitude  = func_get_arg( 0 );
                    $fLongitude = func_get_arg( 1 );

                    //$this->__echo( "Received 2 parameters" );
                }
                break;
            default :
                throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Invalid parameter count (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETERS_COUNT . ")",EXCEPTION_CODE_INVALID_PARAMETERS_COUNT );
        }

        $x = $fLongitude * HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS / 180;
        /*
            $y = log( tan( ( 90 + $fLatitude ) * M_PI / 360 ) ) / ( M_PI / 180 );
            $y = $y * HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS / 180;
        */
        $y = ( log( tan( ( 90 + $fLatitude ) * M_PI / 360 ) ) / ( M_PI / 180 ) ) * HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS / 180;


        return ( array ( 'x'            => $x,
                         'longitude'    => $x,
                         'y'            => $y,
                         'latitude'     => $y,
                       ) );
    }   /* End of Mercator.degrees2Meters() =========================================== */
    /* ================================================================================ */


    /* Final */
    public function meters2Degrees()
    /*----------------------------*/
    {
        $iArgs = func_num_args();

        switch ( $iArgs )
        {
            case 1:
                {
                    $aParams = func_get_arg( 0 );

                    //$this->__echo( "Received 1 parameter" );
                    //var_dump( $aParams );
                    //die();

                    if ( is_array( $aParams ) && isset( $aParams['x'] ) && isset( $aParams['y'] ) )
                    {
                        $x = $aParams['x'];
                        $y = $aParams['y'];
                    }
                    else
                    {
                        throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Invalid parameter (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );
                    }
                }
                break;
            case 2  :
                {
                    $x = func_get_arg( 0 );
                    $y = func_get_arg( 1 );

                    //$this->__echo( "Received 2 parameters" );
                }
                break;
            default :
                throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Invalid parameter count (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETERS_COUNT . ")",EXCEPTION_CODE_INVALID_PARAMETERS_COUNT );
        }

        $fLongitude = $x / HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS * 180;
        //var_dump( 'Longitude : ' . $fLongitude );

        $fLatitude = ( atan( exp( $y * 180 / HALF_EARTH_CIRCUMFERENCE_AT_EQUATOR_IN_METERS * ( M_PI / 180 ) ) ) * 360 / M_PI ) - 90;
        //var_dump( 'Latitude : ' . $fLatitude );

        return ( array ( 'latitude'     => $fLatitude   ,
                         'y'            => $fLatitude   ,
                         'longitude'    => $fLongitude  ,
                         'x'            => $fLongitude  ,
                       ) );

    }   /* End of Mercator.meters2Degrees() =========================================== */
    /* ================================================================================ */


    /* Final ... sauf si on tombe sur d'autres types d'infos */
    public function parse( &$szXML,$szTerm )
    /*------------------------------------*/
    {
        $aRetVal = null;

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        //var_dump( strlen( $szXML ) );
        //$this->die();

        if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                if ( ( $o = $oXPath->query( "//totalResultsCount" ) ) && $o->length > 0 )
                {
                    $iResults = (int) trim( $o->item(0)->nodeValue );
                    //$this->addInfo( __METHOD__ . '(): totalResultsCount NOT found' );
                    $aRetVal['resultsCount'] = $iResults;
                }   /* if ( ( $o = $oXPath->query( "//totalResultsCount" ) ) && $o->length > 0 ) */

                /* Dans le cas où on a des geonames */
                if ( ( $o = $oXPath->query( "//geoname" ) ) && $o->length > 0 )
                {
                    //$this->__echo( "We have geonames\n" );

                    {   /* Setting nodeNames to look for */
                        $aAttributes[] = 'toponymName';
                        $aAttributes[] = 'name';
                        $aAttributes[] = 'lat';
                        $aAttributes[] = 'lng';
                        $aAttributes[] = 'geonameId';
                        $aAttributes[] = 'countryCode';
                        $aAttributes[] = 'countryName';
                        $aAttributes[] = 'fcl';
                        $aAttributes[] = 'fcode';
                        $aAttributes[] = 'fclName';
                        $aAttributes[] = 'fcodeName';
                        $aAttributes[] = 'population';
                        $aAttributes[] = 'adminCode1';
                        $aAttributes[] = 'adminName1';
                        $aAttributes[] = 'asciiName';
                        $aAttributes[] = 'alternateNames';
                        $aAttributes[] = 'elevation';
                        $aAttributes[] = 'srtm3';
                        $aAttributes[] = 'astergdem';           /* a single number giving the elevation in meters */
                        $aAttributes[] = 'continentCode';
                        $aAttributes[] = 'adminTypeName';
                        $aAttributes[] = 'adminCode2';
                        $aAttributes[] = 'adminName2';
                        $aAttributes[] = 'adminCode3';
                        $aAttributes[] = 'adminName3';
                        $aAttributes[] = 'adminCode4';
                        $aAttributes[] = 'adminName4';
                        $aAttributes[] = 'timezone';
                        $aAttributes[] = 'score';

                        /* Attention, le service ne retourne pas (encore) les infos suivantes:

                            <bbox>
                                <west>10.62294</west>
                                <north>46.68046</north>
                                <east>13.10213</east>
                                <south>44.79444</south>
                                <accuracyLevel>10</accuracyLevel>
                            </bbox>

                            Attention, les attributs de timezone ne sont pas retournés non plus

                            <timezone dstOffset="2.0" gmtOffset="1.0">Europe/Rome</timezone>

                        */
                    }   /* Setting nodeNames to look for */

                    $aGeonames = null;

                    foreach( $o as $oNode )
                    {
                        $aValues = null;

                        foreach( $aAttributes as $szAttribute )
                        {
                            $aValues[$szAttribute] = null;

                            if ( ( $o = $oXPath->query( $szAttribute,$oNode ) ) && $o->length > 0 )
                                $aValues[$szAttribute] = $o->item(0)->nodeValue;
                        }   /* foreach( $aAttributes as $szAttribute ) */

                        {   /* Repairing/normalizing some values (lat, lng, population, elevation, ...) */
                            $aValues['latitude'] = $aValues['lat'] = (float) $aValues['lat'];
                            //unset( $aValues['lat'] );

                            $aValues['longitude'] = $aValues['lng'] = (float) $aValues['lng'];
                            //unset( $aValues['lng'] );

                            $aValues['astergdem'] = (int) $aValues['astergdem'];

                            $aValues['elevation'] = (int) $aValues['elevation'];

                            $aValues['population'] = (int) $aValues['population'];

                            $aValues['score'] = (float) $aValues['score'];

                        }   /* Reparing/normalizing some values (lat, lng, population, elevation, ...) */

                        $aGeonames[] = $aValues;
                    }   /* foreach( $o as $oNode ) */

                    $aRetVal['results'] = $aGeonames;
                }   /* if ( ( $o = $oXPath->query( "//geoname" ) ) && $o->length > 0 ) */
                elseif ( ( $o = $oXPath->query( "//address" ) ) && $o->length > 0 )
                {
                    {   /* Setting nodeNames to look for */
                        $aAttributes[] = 'street';
                        $aAttributes[] = 'houseNumber';
                        $aAttributes[] = 'locality';
                        $aAttributes[] = 'postalcode';
                        $aAttributes[] = 'lat';
                        $aAttributes[] = 'lng';
                        $aAttributes[] = 'adminCode1';
                        $aAttributes[] = 'adminName1';
                        $aAttributes[] = 'adminCode2';
                        $aAttributes[] = 'adminName2';
                        $aAttributes[] = 'adminCode3';
                        $aAttributes[] = 'adminName3';
                        $aAttributes[] = 'adminCode4';
                        $aAttributes[] = 'adminName4';
                        $aAttributes[] = 'countryCode';
                    }   /* Setting nodeNames to look for */

                    $aGeonames = null;

                    foreach( $o as $oNode )
                    {
                        $aValues = null;

                        foreach( $aAttributes as $szAttribute )
                        {
                            $aValues[$szAttribute] = null;

                            if ( ( $o = $oXPath->query( $szAttribute,$oNode ) ) && $o->length > 0 )
                                $aValues[$szAttribute] = $o->item(0)->nodeValue;
                        }   /* foreach( $aAttributes as $szAttribute ) */

                        {   /* Repairing/normalizing some values (lat, lng, population, elevation, ...) */
                            $aValues['latitude'] = $aValues['lat'] = (float) $aValues['lat'];
                            $aValues['longitude'] = $aValues['lng'] = (float) $aValues['lng'];
                        }   /* Reparing/normalizing some values (lat, lng, population, elevation, ...) */

                        $aGeonames[] = $aValues;
                    }   /* foreach( $o as $oNode ) */

                    $szScore = 'low';

                    foreach( $aGeonames as $aGeoname )
                    {
                        if ( isset( $aGeoname['street'] ) && vaesoli::STR_iPos( $szTerm,$aGeoname['street'] ) !== -1 )
                        {
                            $szScore = 'high';

                            if ( isset( $aGeoname['locality'] ) && vaesoli::STR_iPos( $szTerm,$aGeoname['locality'] ) !== -1 )
                                $szScore = 'very high';
                            else
                                var_dump( $aGeoname['locality'] );

                            break;
                        }   /* if ( isset( $aGeoname['street'] ) && vaesoli::STR_iPos( $szTerm,$aGeoname['street'] ) !== -1 ) */
                        else
                        {
                            if ( isset( $aGeoname['postalcode'] ) && vaesoli::STR_iPos( $szTerm,$aGeoname['postalcode'] ) !== -1 )
                                $szScore = 'medium';

                            break;
                        }
                    }   /* foreach( $aGeonames as $aGeoname ) */

                    $aRetVal['q']       = $szTerm;
                    $aRetVal['score']   = $szScore;
                    $aRetVal['message'] = 'geoCodeAddress\'s accuracy: ' . $szScore;
                    $aRetVal['results'] = $aGeonames;
                }
                elseif ( ( $o = $oXPath->query( "//timezone/countryCode" ) ) && $o->length > 0 )
                {
                    if ( ( $o = $oXPath->query( "timezone" ) ) && $o->length > 0 )
                    {
                        {   /* Setting nodeNames to look for */
                            $aAttributes[] = 'countryCode';
                            $aAttributes[] = 'countryName';
                            $aAttributes[] = 'lat';
                            $aAttributes[] = 'lng';
                            $aAttributes[] = 'timezoneId';
                            $aAttributes[] = 'dstOffset';
                            $aAttributes[] = 'gmtOffset';
                            $aAttributes[] = 'rawOffset';
                            $aAttributes[] = 'time';
                            $aAttributes[] = 'sunrise';
                            $aAttributes[] = 'sunset';
                        }   /* Setting nodeNames to look for */

                        $aValues    = null;
                        $oNode      = $o->item(0);

                        foreach( $aAttributes as $szAttribute )
                        {
                            $aValues[$szAttribute] = null;

                            if ( ( $o = $oXPath->query( $szAttribute,$oNode ) ) && $o->length > 0 )
                                $aValues[$szAttribute] = $o->item(0)->nodeValue;
                        }   /* foreach( $aAttributes as $szAttribute ) */

                        $aRetVal['results'] = $aValues;

                        //var_dump( $aValues );
                    }   /* if ( ( $o = $oXPath->query( "timezone" ) ) && $o->length > 0 ) */
                }   /* Elseif ( ( $o = $oXPath->query( "//timezone/countryCode" ) ) && $o->length > 0 )  */
                elseif ( ( $o = $oXPath->query( "//entry" ) ) && $o->length > 0 )
                {
                    {   /* Setting nodeNames to look for */
                        $aAttributes[] = 'lang';
                        $aAttributes[] = 'title';
                        $aAttributes[] = 'summary';
                        $aAttributes[] = 'feature';
                        $aAttributes[] = 'countryCode';
                        $aAttributes[] = 'elevation';
                        $aAttributes[] = 'lat';
                        $aAttributes[] = 'lng';           /* a single number giving the elevation in meters */
                        $aAttributes[] = 'wikipediaUrl';
                        $aAttributes[] = 'thumbnailImg';
                        $aAttributes[] = 'rank';
                    }   /* Setting nodeNames to look for */

                    $aEntries = null;

                    foreach( $o as $oNode )
                    {
                        $aValues = null;

                        foreach( $aAttributes as $szAttribute )
                        {
                            $aValues[$szAttribute] = null;

                            if ( ( $o = $oXPath->query( $szAttribute,$oNode ) ) && $o->length > 0 )
                                $aValues[$szAttribute] = $o->item(0)->nodeValue;
                        }   /* foreach( $aAttributes as $szAttribute ) */

                        {   /* Repairing/normalizing some values (lat, lng, population, elevation, ...) */
                            $aValues['latitude']  = $aValues['lat'] = (float) $aValues['lat'];
                            $aValues['longitude'] = $aValues['lng'] = (float) $aValues['lng'];
                            $aValues['elevation'] = (int) $aValues['elevation'];
                            $aValues['rank']      = (float) $aValues['rank'];

                        }   /* Reparing/normalizing some values (lat, lng, elevation, ...) */

                        $aEntries[] = $aValues;
                    }   /* foreach( $o as $oNode ) */

                    $aRetVal['results'] = $aEntries;
                }
                elseif ( ( $o = $oXPath->query( "//country" ) ) && $o->length > 0 )
                {
                    {   /* Setting nodeNames to look for */
                        $aAttributes[] = 'countryCode';
                        $aAttributes[] = 'countryName';
                        $aAttributes[] = 'isoNumeric';
                        $aAttributes[] = 'isoAlpha3';
                        $aAttributes[] = 'fipsCode';           /* a single number giving the elevation in meters */
                        $aAttributes[] = 'continent';
                        $aAttributes[] = 'continentName';
                        $aAttributes[] = 'capital';
                        $aAttributes[] = 'areaInSqKm';
                        $aAttributes[] = 'population';
                        $aAttributes[] = 'currencyCode';
                        $aAttributes[] = 'languages';
                        $aAttributes[] = 'geonameId';
                        $aAttributes[] = 'west';
                        $aAttributes[] = 'north';
                        $aAttributes[] = 'east';
                        $aAttributes[] = 'south';
                        $aAttributes[] = 'postalCodeFormat';
                    }   /* Setting nodeNames to look for */

                    $aCountries = null;

                    foreach( $o as $oNode )
                    {
                        $aValues = null;

                        foreach( $aAttributes as $szAttribute )
                        {
                            $aValues[$szAttribute] = null;

                            if ( ( $o = $oXPath->query( $szAttribute,$oNode ) ) && $o->length > 0 )
                                $aValues[$szAttribute] = $o->item(0)->nodeValue;
                        }   /* foreach( $aAttributes as $szAttribute ) */

                        {   /* Repairing/normalizing some values (lat, lng, population, elevation, ...) */
                            $aValues['areaInSqKm']  = (int)     $aValues['areaInSqKm'];
                            $aValues['population']  = (int)     $aValues['population'];
                            $aValues['west']        = (float)   $aValues['west'];
                            $aValues['north']       = (float)   $aValues['north'];
                            $aValues['east']        = (float)   $aValues['east'];
                            $aValues['south']       = (float)   $aValues['south'];

                        }   /* Reparing/normalizing some values (population, west, ...) */

                        $aCountries[] = $aValues;
                    }   /* foreach( $o as $oNode ) */

                    $aRetVal['results'] = $aCountries;
                }
                elseif ( ( $o = $oXPath->query( "//poi" ) ) && $o->length > 0 )
                {
                    //$this->die( "TomTom XML" );

                    foreach( $o as $oPOINode )
                    {
                        //var_dump( $oPOINode );

                        $szID           =
                        $x              =
                        $y              =
                        $ic             =
                        $MoD            =
                        $iClusterSize   =
                        $iIncidentSize  =
                                          null;

                        if ( ( $o2 = $oXPath->query( "id",$oPOINode  ) ) && $o2->length > 0 )
                            $szID = $o2->item(0)->nodeValue;

                        if ( ( $o2 = $oXPath->query( "p/x",$oPOINode ) ) && $o2->length > 0 )
                            $x = (float) $o2->item(0)->nodeValue;

                        if ( ( $o2 = $oXPath->query( "p/y",$oPOINode ) ) && $o2->length > 0 )
                            $y = (float) $o2->item(0)->nodeValue;

                        if ( ( $o2 = $oXPath->query( "ic",$oPOINode ) ) && $o2->length > 0 )
                            $ic = (int) $o2->item(0)->nodeValue;

                        if ( ( $o2 = $oXPath->query( "ty",$oPOINode ) ) && $o2->length > 0 )
                            $MoD = (int) $o2->item(0)->nodeValue;

                        if ( ( $o2 = $oXPath->query( "cs",$oPOINode ) ) && $o2->length > 0 )
                            $iClusterSize = (int) $o2->item(0)->nodeValue;

                        if ( ( $CPOIColl = $oXPath->query( "cpoi",$oPOINode ) ) && $CPOIColl->length > 0 )
                        {
                            if ( ( $o2 = $oXPath->query( "l",$oPOINode ) ) && $o2->length > 0 )
                                $iIncidentSize = (int) $o2->item(0)->nodeValue;

                            $aIncidents = null;

                            foreach( $CPOIColl as $oNode )
                            {
                                $xx = null;
                                $yy = null;

                                $aSingleIncident = array( 'id'                      => null     ,
                                                          'type'                    => null     ,
                                                          'type-str'                => 'unknown',
                                                          'coords'                  => null     ,
                                                          'delay'                   => null     ,
                                                          'delay-str'               => 'unknown',
                                                          'delay-length-in-sec'     => null     ,
                                                          'description'             => null     ,
                                                          'cause'                   => null     ,
                                                          'location-start'          => null     ,
                                                          'location-end'            => null     ,
                                                          'incident-size-in-meters' => null     ,
                                                          'estimated-end-utc'       => null     ,
                                                          'estimated-end-date'      => null     ,
                                                        );

                                if ( ( $o2 = $oXPath->query( "id",$oNode  ) ) && $o2->length > 0 )
                                    $aSingleIncident['id'] = $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "p/x",$oPOINode ) ) && $o2->length > 0 )
                                    $xx = (float) $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "p/y",$oPOINode ) ) && $o2->length > 0 )
                                    $yy = (float) $o2->item(0)->nodeValue;


                                if ( ( $o2 = $oXPath->query( "ic",$oNode  ) ) && $o2->length > 0 )
                                {
                                    $aSingleIncident['type']        = (int) $o2->item(0)->nodeValue;
                                    $aSingleIncident['type-str']    = $this->tomtomTypeOfIncident( $aSingleIncident['type'] );
                                }

                                $aCoords = $this->meters2Degrees( $xx,$yy );

                                if ( is_array( $aGeoData = $this->nearby( $aCoords ) ) && isset( $aGeoData['results'] ) )
                                    $aCoords['nearby-data'] = $aGeoData['results'][0];

                                $aSingleIncident['coords'] = $aCoords;

                                if ( ( $o2 = $oXPath->query( "ty",$oNode ) ) && $o2->length > 0 )
                                {
                                    $aSingleIncident['delay']       = (int) $o2->item(0)->nodeValue;
                                    $aSingleIncident['delay-str']   = $this->tomtomTypeOfDelay( $aSingleIncident['delay'] );
                                }

                                if ( ( $o2 = $oXPath->query( "dl",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['delay-length-in-sec'] = (int) $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "d",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['description'] = $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "f",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['location-start'] = $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "t",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['location-end'] = $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "l",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['incident-size-in-meters'] = (int) $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "r",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['paths-blocked'] = $o2->item(0)->nodeValue;

                                if ( ( $o2 = $oXPath->query( "ed",$oNode ) ) && $o2->length > 0 )
                                {
                                    $aSingleIncident['estimated-end-utc']  = strtotime( $o2->item(0)->nodeValue );
                                    $aSingleIncident['estimated-end-date'] = date( 'd-m-Y',$aSingleIncident['estimated-end-utc'] );
                                }

                                if ( ( $o2 = $oXPath->query( "c",$oNode ) ) && $o2->length > 0 )
                                    $aSingleIncident['cause'] = $o2->item(0)->nodeValue;

                                //var_dump( $aSingleIncident );
                                $aIncidents[] = $aSingleIncident;
                            }   /* foreach( $CPOIColl as $oNode ) */
                        }   /* if ( ( $CPOIColl = $oXPath->query( "cpoi",$oPOINode ) ) && $CPOIColl->length > 0 ) */

                        $aCoords = $this->meters2Degrees( $x,$y );

                        if ( is_array( $aGeoData = $this->nearby( $aCoords ) ) )
                            $aCoords['nearby-data'] = $aGeoData['results'][0];

                        $aRetVal['results']['incidents'][] = array( 'id'                        => $szID                                ,
                                                                    'type'                      => $ic                                  ,
                                                                    'type-str'                  => $this->tomtomTypeOfIncident( $ic )   ,
                                                                    'coords'                    => $aCoords                             ,
                                                                    'delay'                     => $MoD                                 ,
                                                                    'delay-str'                 => $this->tomtomTypeOfDelay( $MoD )     ,
                                                                    'incident-count'            => $iClusterSize                        ,
                                                                    'incident-size-in-meters'   => $iIncidentSize                       ,
                                                                    'incidents'                 => $aIncidents                          ,
                                                                  );
                    }   /* foreach( $o as $oPOINode ) */
                }   /* elseif ( ( $o = $oXPath->query( "//poi" ) ) && $o->length > 0 ) */
                elseif ( ( $o = $oXPath->query( "//totalResultsCount" ) ) && $o->length > 0 )
                {
                    $this->addInfo( __METHOD__ . "(): Invalid XML" );
                    $this->__echo( __METHOD__ . "(): geonames XML - no result" );
                }
                elseif ( ( $o = $oXPath->query( "//status" ) ) && $o->length > 0 )
                {
                    $iErrCode = $o->item(0)->getAttribute( 'value' );
                    $this->addInfo( __METHOD__ . "(): Error occurred (geonames #{$iErrCode})" );
                    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Error occurred (ErrCode: " . EXCEPTION_CODE_NO_RESULTS_FOUND . " - no results found)",EXCEPTION_CODE_NO_RESULTS_FOUND );
                }
                else
                {
                    $this->addInfo( __METHOD__ . "(): Invalid XML" );
                    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Invalid XML (ErrCode: " . EXCEPTION_CODE_XML_INVALID . ")",EXCEPTION_CODE_XML_INVALID );
                }
            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( $oDom->LoadXML( $szXML ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.parse() ==================================================== */
    /* ================================================================================ */


    /* Final */
    // API Key: TgelzGQzSBwMCfLvGXSHSniWAXqTtEkL
    // Doc: https://developer.tomtom.com/traffic-api/traffic-api-documentation-traffic-incidents/incident-details
    // API Explorer: https://developer.tomtom.com/content/traffic-api-explorer
    // https://api.tomtom.com/traffic/services/4/incidentDetails/s3/6841263.950712%2C511972.674418%2C6886056.049288%2C582676.925582/10/-1/xml?key=TgelzGQzSBwMCfLvGXSHSniWAXqTtEkL
    public function trafficIncidents( $aParams )
    /*----------------------------------------*/
    {
        $aRetVal = null;


        if ( isset( $aParams['geonameId1'] ) && isset( $aParams['geonameId2'] ) )
        {
            //var_dump( "ON EST ICI");
            //die();

            //$aRetVal1   = $this->get( array( 'geonameId' => $aParams['geonameId1'] ) );
            $aParams1   = array( 'geonameId' => $aParams['geonameId1'] );
            $aRetVal1   = $this->get( $aParams1 );
            $aCoords1   = array( 'latitude'     => $aRetVal1['results'][0]['latitude'   ],
                                 'longitude'    => $aRetVal1['results'][0]['longitude'  ],
                               );

            $aParams2   = array( 'geonameId' => $aParams['geonameId2'] );
            $aRetVal2   = $this->get( $aParams2 );
            $aCoords2   = array( 'latitude'     => $aRetVal2['results'][0]['latitude'   ],
                                 'longitude'    => $aRetVal2['results'][0]['longitude'  ],
                               );

            //var_dump( $this->degrees2Meters( 38.898717,-77.035974 ) );
            $aGeo1 = $this->degrees2Meters( $aCoords1 );
            $aGeo2 = $this->degrees2Meters( $aCoords2 );

            //var_dump( $aGeo1,$aGeo2 );

            $szAccessKey    = $this->getAPIKey( 'traffic' );
            //var_dump( $aParams );
            //var_dump( $szAccessKey );
            //die();

            // Here ...We should get the TomTom API Key from an external alibaba cave
            $szURL = "https://api.tomtom.com/traffic/services/4/incidentDetails/s3/{$aGeo1['latitude']},{$aGeo1['longitude']},{$aGeo2['latitude']},{$aGeo2['longitude']}/10/-1/xml?key={$szAccessKey}&language=en&expandCluster=true";

            $szCacheFile = $this->cacheName( $szMethod = 'trafficIncidents',$xParams = $szURL,$xAdditional = null );

            if ( true && $this->remembering && is_file( $szCacheFile ) && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 900 /* 15 min */) )
            {
                //var_dump( "Data retrieved from cache" );
                $aRetVal = $this->getCache( $szCacheFile );
                $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
                //goto end;
            }   /* if ( is_file( $szCacheFile ) ) */
            else    /* Else of ... if ( is_file( $szCacheFile ) ) */
            {
                if ( ! empty( $szXML = $this->getURL( $szURL ) ) )
                {
                    //var_dump( $szXML );
                    //die();
                    if ( is_array( $aRetVal = $this->parse( $szXML,'traffic' ) ) )
                    {
                        //var_dump( $aRetVal );
                        //$this->die();

                        if ( $this->storing )
                        {
                            $this->saveHashFile( $szCacheFile,$aRetVal );
                            $this->addInfo( __METHOD__ . "(): Incidents data stored in {$szCacheFile}" );
                        }   /* if ( $this->storing ) */
                    }   /* if ( is_array( $aRetVal = $this->parse( $szXML ) ) */
                }   /* if ( ! empty( $szRetXML ) ) */
            }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        }   /* if ( isset( $aParams['geonameId1'] ) && isset( $aParams['geonameId2'] ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.trafficIncidents()========================================== */
    /* ================================================================================ */


    protected function tomtomTypeOfIncident( $ic )
    /*------------------------------------------*/
    {
        switch ( $ic )
        {
            case TOMTOM_INCIDENT_TYPE_UNKNOWN               : return ( "Unknown"              );
            case TOMTOM_INCIDENT_TYPE_ACCIDENT              : return ( "Accident"             );
            case TOMTOM_INCIDENT_TYPE_FOG                   : return ( "Fog"                  );
            case TOMTOM_INCIDENT_TYPE_DANGEROUS_CONDITIONS  : return ( "Dangerous Conditions" );
            case TOMTOM_INCIDENT_TYPE_RAIN                  : return ( "Rain"                 );
            case TOMTOM_INCIDENT_TYPE_ICE                   : return ( "Ice"                  );
            case TOMTOM_INCIDENT_TYPE_JAM                   : return ( "Jam"                  );
            case TOMTOM_INCIDENT_TYPE_LANE_CLOSED           : return ( "Lane Closed"          );
            case TOMTOM_INCIDENT_TYPE_ROAD_CLOSED           : return ( "Road Closed"          );
            case TOMTOM_INCIDENT_TYPE_ROAD_WORKS            : return ( "Road Works"           );
            case TOMTOM_INCIDENT_TYPE_WIND                  : return ( "Wind"                 );
            case TOMTOM_INCIDENT_TYPE_FLOODING              : return ( "Flooding"             );
            case TOMTOM_INCIDENT_TYPE_DETOUR                : return ( "Detour"               );
            case TOMTOM_INCIDENT_TYPE_CLUSTER               : return ( "Cluster"              );
            default                                         : return ( "Unknown"              );
        }
    }   /* End of Mercator.tomtomTypeOfIncident()====================================== */
    /* ================================================================================ */


    protected function tomtomTypeOfDelay( $MoD )
    /*----------------------------------------*/
    {
        switch ( $MoD ) /* Magnitude of Delay */
        {
            case TOMTOM_MAGNITUDE_OF_DELAY_UNKNOWN          : return ( "Unknown"              );
            case TOMTOM_MAGNITUDE_OF_DELAY_MINOR            : return ( "Minor"                );
            case TOMTOM_MAGNITUDE_OF_DELAY_MODERATE         : return ( "Moderate"             );
            case TOMTOM_MAGNITUDE_OF_DELAY_MAJOR            : return ( "Major"                );
            case TOMTOM_MAGNITUDE_OF_DELAY_UNDEFINED        : return ( "Undefined"            );
            default                                         : return ( "Unknown"              );
        }
    }   /* End of Mercator.tomtomTypeOfIncident()====================================== */
    /* ================================================================================ */


    /* Code qui va sur geoname MAIS ... il est préférable de prendre le service "Countries" de Mother */
    public function countryOLD( $xParams = null )
    /*--------------------------------------*/
    {
        $aRetVa = null;

        if     ( is_string( $xParams ) )
        {
            if ( isset( $this->aCountrySynonyms[ $szCountry = strtolower( trim( $xParams ) )] ) )
                $xParams = $this->aCountrySynonyms[ $szCountry ];

            //var_dump( $this->aCountrySynonyms['belgium'] );
            //var_dump( $szCountry );
            //var_dump( $xParams );
            $aParams['country'] = trim( $xParams );
        }
        elseif ( is_array( $xParams ) )
            $aParams = $xParams;
        elseif ( is_null( $xParams ) )
            $aParams = array();

        $aParams['maxRows'] = $aParams['maxRows'] ?? 2000;          /* Default number of results returned */
        $szCacheFile        = $this->cacheName( __METHOD__,$aParams,date( 'Ym' ) ); /* 3rd parameter : Pour avoir des données population à jour mensuellement */

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            //var_dump( 'countries RETRIEVED' );
            //die();
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            /* Si j'ai un geonameId dans les paramètres mais PAS de latitude et longitude */
            if ( is_array( $aParams ) )
            {
                //var_dump( $aParams );
                if ( ! empty( $szXML = $this->call( $szService = 'countryInfo',$aParams ) ) )
                {
                    //var_dump( $aParams );
                    if ( is_array( $aTmp = $this->parse( $szXML,$aParams ) ) )
                        $aRetVal = array_merge( array( 'service' => $szService ),$aTmp );
                    else
                        goto end;

                    if ( $this->storing )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                        //var_dump( 'timezone SAVED' );
                    }   /* if ( $this->storing ) */
                }   /* if ( ! empty( $szXML = $this->call( $szService = 'countryInfo',$aParams ) ) ) */
            }   /* if ( $aParams['geonameId'] && ! isset( $aParams['lat'] ) && ! isset( $aParams['lng'] ) ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.country() ================================================== */
    /* ================================================================================ */


    public function country( $szCountry = null )
    /*----------------------------------------*/
    {
        $aRetVal    = null;

        $szCountry  = $this->countrySynonym( $szCountry );

        $szCacheFile = $this->cacheName( 'country',$szCountry,$xAdditional = null );

        if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 30 * 6 /* ±6 months */ ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 30 ) ) */
        else    /* Else of ... if ( true && $this->remembering && ... ) */
        {
            if ( ! is_null( $aRetVal = $this->countries( $szCountry ) ) )
            {
                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }   /* if ( ! is_null( $aRetVal = $this->countries( $szCountry ) ) ) */
        }    /* End of ... Else of ... if ( true && $this->remembering && ... ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.country() ================================================== */
    /* ================================================================================ */


    /* Final */
    public function getGeonameId( $szTerm )
    /*-----------------------------------*/
    {
        $szRetVal = null;

        if ( is_null( $aTmp = $this->lookup( $szTerm ) ) )
        {
            //var_dump( $aTmp );
            if ( is_array( $aTmp = $this->search( $szTerm ) ) && isset( $aTmp['results'] ) )
            {
                //var_dump( $szTerm,$aTmp );
                $szRetVal = $aTmp['results'][0]['geonameId'];
            }   /* if ( is_array( $aTmp = $this->search( $szTerm ) ) && isset( $aTmp['results'] ) ) */
        }   /* if ( is_null( $aTmp = $this->lookup( $szTerm ) ) ) */
        else    /* Else of ... if ( is_null( $aTmp = $this->lookup( $szTerm ) ) ) */
        {
            $szRetVal = $aTmp['geonameId'];
        }   /* End of ... Else of ... if ( is_null( $aTmp = $this->lookup( $szTerm ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of Mercator.getGeonameId() ============================================= */
    /* ================================================================================ */


    /*  Cette méthode permet de codifier la nature d'une voie

        On peut avoir pas mal d'exceptions. Par exemple, Rue du Mail on aura qlq chose
        qui dira que "Rue" est un "path" et que "Mail" est aussi un "path" !

        Pour l'instant, la nature des voies ne fonctionne qu'en français car je ne
        dispose pas des valeurs en néerlandais, anglais, ...

    */
    public function pathNatures( $szQuery = null )
    /*------------------------------------------*/
    {
        $aRetVal = null;
        static $staticData = null;

        {   // Ce code a servi à normaliser le fichier XML
            //require_once( 'D:/websites/vaesoli.org/www/httpdocs/vaesoli/include/LSCursor.class.php' );
            //
            //$szFile     = "D:/websites/snippet-center/q/common/resources/xml/nature-des-voies.xml";
            //$oCursor    = new \LSCursor( "Paths",$szFile );
            //
            //if ( $oCursor->Open() )
            //{
            //    while( ! $oCursor->EOF() )
            //    {
            //        $szField = 'Code';              $oCursor->Replace( $szField,trim( $oCursor->Field( $szField ) ) );
            //        $szField = 'Name/@cleaned';     $oCursor->Replace( $szField,trim( $oCursor->Field( $szField ) ) );
            //        $szField = 'Name';              $oCursor->Replace( $szField,trim( $oCursor->Field( $szField ) ) );
            //
            //        $oCursor->Skip();
            //    }
            //
            //    if ( $oCursor->Dirty() )
            //    {
            //        echo "<p>Should save the cursor</p>\n";
            //        $oCursor->save( $szNewFile = $szFile . '.new.xml' );
            //    }
            //
            //    closeCursor:
            //
            //    $oCursor->close();
        }   // Ce code a servi à normaliser le fichier XML

        /* If we have no internal static data, build it */
        if ( is_null( $staticData ) )
        {
            $szFile     = "D:/websites/snippet-center/q/common/resources/xml/nature-des-voies.xml";

            $oDom = new DOMDocument();

            if ( $oDom->load( $szFile ) )
            {
                //echo "<p>File opened</p>";
                if ( $oXPath = new DOMXPath( $oDom ) )
                {
                    if ( ( $oColl = $oXPath->query( '//PathNature' ) ) && $oColl->length > 0 )
                    {
                        foreach( $oColl as $oNode )
                        {
                            $szCode     =
                            $szName     =
                            $szLang     =
                            $szCleaned  = null;

                            if ( ( $o = $oXPath->query( 'Code',$oNode ) ) && $o->length > 0 )
                                $szCode = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Name',$oNode ) ) && $o->length > 0 )
                            {
                                $szName     = $o->item(0)->nodeValue;
                                $szLang     = $o->item(0)->getAttribute( 'lang' );
                                $szCleaned  = $o->item(0)->getAttribute( 'cleaned' );
                            }

                            $staticData[$szCleaned] = array( 'code'     => $szCode      ,
                                                             'cleaned'  => $szCleaned   ,
                                                             'lang'     => $szLang      ,
                                                             'name'     => $szName      ,
                                                           );

                            //if ( empty( $szCleaned ) )
                            //    $this->die( "Houston, we have a problem" );
                            //
                            //var_dump( $szCode,$szName,$szLang,$szCleaned,'-----' );
                        }
                    }   /* if ( ( $oColl = $oXPath->query( '//PathNature' ) ) && $oColl->length > 0 ) */
                }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
            }   /* if ( $oDom->load( $szFile ) ) */
        }   /* if ( is_null( $staticData ) ) */

        if ( ! is_null( $szQuery ) )
        {
            //$this->die( "Looking for '{$szQuery}'" );
            $aRetVal = $staticData[trim( strtolower( $szQuery ) )] ?? null;
        }

        end:

        return ( $aRetVal );
    }   /* End of Mercator.pathNatures() ============================================== */
    /* ================================================================================ */


    public function BELCities()
    /*-----------------------*/
    {
        static $staticData = null;

        if ( is_null( $staticData ) )
        {
            $aLines = file( $szFile = 'd:/websites/snippet-center/q/common/trql.classes.home/trql.bcekbo.class/data/bel-cities2.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

            foreach( $aLines as $szLine )
            {
                $aParts = explode( "\t",$szLine );
                $staticData[trim( strtolower( $aParts[0] ) )] = $aParts[0];
                $staticData[trim( strtolower( $aParts[1] ) )] = $aParts[1];
            }

            // Ceci est du code qui aide à créer un autre fichier avec les
            // données débarrassées des accents
            //if ( $h = fopen( $szFile . '.new.txt','a+' ) )
            //{
            //    foreach( $aLines as $szLine )
            //    {
            //        fwrite( $h,$szLine . "\n" );
            //        fwrite( $h,vaesoli::STR_stripAccents( $szLine ) . "\n" );
            //    }
            //    fclose( $h );
            //}
            //die();
        }   /* if ( is_null( $staticData ) ) */

        return ( $staticData );
    }   /* End of Mercator.BELCities() ================================================ */
    /* ================================================================================ */


    /* Final */
    // https://www.geonames.org/export/geonames-search.html
    // https://www.geonames.org/maps/addresses.html#geoCodeAddress
    public function search( $szTerm )
    /*-----------------------------*/
    {
        $aRetVal            = null;

        if      ( is_string( $szTerm ) )
            $aParams['q'] = trim( $szTerm );
        elseif ( is_array( $szTerm ) )
            $aParams      = $szTerm;

        $aParams['maxRows'  ] = min( $aParams['maxRows'] ?? 1000,1000 );/* Default number of results returned */
        $aParams['style'    ] =      $aParams['style'] ?? 'full';   /* Default verbosity */
        $aParams['service'  ] = 'search-geoCodeAddress';            /* THIS service (with a variation) */

        $szCacheFile        = $this->cacheName( __METHOD__,$aParams );

        if ( false && $this->remembering && is_file( $szCacheFile ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            if ( is_string( $szTerm ) && strlen( $szTerm ) <= 3 )
            {
                //$this->echo( "Probablement un code pays\n" );

                //if ( ! is_null( $aTmp = $this->countries() ) )
                if ( ! is_null( $aTmp = $this->countries( $szTerm ) ) )
                {
                    //var_dump( $aTmp );

                    $aRetVal['service']         = 'search';
                    $aRetVal['resultsCount']    = count( $aTmp );
                    $aRetVal['results']         = $aTmp;

                    goto storing;
                }   /* if ( ! is_null( $aTmp = $this->countries( $szTerm ) ) ) */
            }   /* if ( is_string( $szTerm ) && strlen( $szTerm ) <= 3 ) */

            // Si résultat vide OU si recherche infructueuse
            if ( empty( $szXML = $this->call( $szService = 'search',$aParams ) ) || vaesoli::STR_iPos( $szXML,'<totalResultsCount>0</totalResultsCount>' ) !== -1 )
            {
                $this->addInfo( __METHOD__ . "(): switching to geoCodeAddress" );
                $szXML = $this->call( $szService = 'geoCodeAddress',$aParams );
                //var_dump( $szXML );
                //die();
            }
            else
            {
                //var_dump( "PAS VIDE" );
                //var_dump( $szXML );
            }

            if ( ! empty( $szXML ) )
            {
                $aRetVal = array_merge( array( 'service' => $szService ),$this->parse( $szXML,$szTerm ) );
                //var_dump( $szTerm );
                //var_dump( $aRetVal );
                //$this->die();
                storing:
                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }   /* if ( ! empty( $szXML = $this->call( $szService = 'search',$aParams ) ) ) */
            else
            {
                $this->addInfo( __METHOD__ . "(): no return" );
            }

        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.search() =================================================== */
    /* ================================================================================ */


    /* Final */
    // https://www.geonames.org/export/web-services.html#timezone
    public function timezone( $aParams,$bTime = null )
    /*-----------------------------------------------*/
    {
        $aRetVal            = null;
        //$aParams['maxRows'] = $aParams['maxRows'] ?? 200;           /* Default number of results returned */
        //$aParams['now']     = date( 'Ymd' );
        $szCacheFile        = $this->cacheName( __METHOD__,$aParams,isset( $bTime ) ? date('YmdHis' ) : date('Ymd' ) ); /* 3rd parameter : Pour avoir toujours le sunrise et le sunset à jour, voir le time aussi */

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            //var_dump( 'timezone RETRIEVED' );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            /* Si j'ai un geonameId dans les paramètres mais PAS de latitude et longitude */
            if ( is_array( $aParams ) && isset( $aParams['geonameId'] ) && ( ! isset( $aParams['lat'] ) || ! isset( $aParams['lng'] ) ) )
            {
                $aInfo          = $this->get( $aParams );
                $aParams['lat'] = $aInfo['results'][0]['lat'];
                $aParams['lng'] = $aInfo['results'][0]['lng'];
            }   /* if ( $aParams['geonameId'] && ! isset( $aParams['lat'] ) && ! isset( $aParams['lng'] ) ) */
            elseif ( is_string( $aParams ) )
            {
                $aInfo          = $this->search( $aParams );
                $aBestResult    = null;
                $fBestScore     = PHP_INT_MIN;

                foreach( $aInfo['results'] as $aResult )
                {
                    if ( $aResult['score'] > $fBestScore )
                    {
                        $fBestScore = $aResult['score'];
                        $aBestResult = $aResult;
                    }   /* if ( $aResult['score'] > $fBestScore ) */
                }   /* foreach( $aInfo['results'] as $aResult ) */

                if ( is_null( $aBestResult ) )
                    goto end;

                $aParams = array();
                $aParams['lat'] = $aBestResult['latitude'];
                $aParams['lng'] = $aBestResult['longitude'];
            }   /* elseif ( is_string( $aParams ) ) */

            if ( ! empty( $szXML = $this->call( $szService = 'timezone',$aParams ) ) )
            {
                $aRetVal = array_merge( array('service' => 'timezone' ),$this->parse( $szXML,'dummy' ) );

                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                    //var_dump( 'timezone SAVED' );
                }   /* if ( $this->storing ) */
            }
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.timezone() ================================================= */
    /* ================================================================================ */


    /* Final */
    public function time( $szCountry )
    /*------------------------------*/
    {
        return ( $this->timezone( $szCountry,true ) );
    }   /* End of Mercator.time() ===================================================== */
    /* ================================================================================ */


    /* Final */
    /* http://api.geonames.org/get?geonameId=1&username=demo. */
    /* ================================================================================ */
    /** {{*get( $aParams )=

        Get geonames info via theit 'get' service

        {*params
            $aParams        (array)     Array of parameters that are sent to geonames when
                                        invoking THEIR 'get' service
        *}

        {*return
            (array)         Associative array with all results coming from geonames, get
                            service
        *}

        *}}
    */
    /* ================================================================================ */
    public function get( $aParams )
    /*---------------------------*/
    {
        $aRetVal        = null;
        //$aParams['maxRows'] = $aParams['maxRows'] ?? 200;           /* Default number of results returned */
        $szCacheFile    = $this->cacheName( __METHOD__,$aParams );

        //var_dump( $aParams );
        //die("Dying at " . __LINE__ );
        if ( ! isset( $aParams['geonameId'] ) )
        {
            $this->addInfo( $szMsg = __METHOD__ . "() at line " . __LINE__ . ": Invalid parameter (geonameId NOT found) (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")" );
            throw new \Exception( $szMsg,EXCEPTION_CODE_INVALID_PARAMETER );
            goto end;
        }   /* if ( ! isset( $aParams['geonameId'] ) ) */

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            //die("Dying at " . __LINE__ );

            if ( ! empty( $szXML = $this->call( $szService = 'get',$aParams ) ) )
            {
                //var_dump( "AFTER call()" );
                var_dump( $szXML );
                //die( "Dying at " . __LINE__ );

                $aRetVal = array_merge( array( 'service' => 'get' ),$this->parse( $szXML,'get' ) );

                //die( "Dying at " . __LINE__ );

                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }   /* if ( ! empty( $szXML = $this->call( $szService = 'get',$aParams ) ) ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.get() ====================================================== */
    /* ================================================================================ */


    /* Final */
    /* https://www.geonames.org/export/wikipedia-webservice.html#wikipediaSearch */
    public function wikipedia( $szTerm )
    /*--------------------------------*/
    {
        $aRetVal = null;

        if      ( is_string( $szTerm ) )
            $aParams['q'] = $szTerm;
        elseif ( is_array( $szTerm ) )
            $aParams      = $szTerm;

        $aParams['maxRows'] = min( $aParams['maxRows'] ?? 1000,1000 );/* Default number of results returned */
        $aParams['style' ]  =      $aParams['style'] ?? 'full';     /* Default verbosity */
        $szCacheFile        = $this->cacheName( __METHOD__,$aParams );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            if ( ! empty( $szXML = $this->call( $szService = 'wikipediaSearch',$aParams ) ) )
            {
                if ( is_array( $aTmp = $this->parse( $szXML ) ) )
                    $aRetVal = array_merge( array( 'service'    => 'wikipedia'  ,
                                                   'term'       => $aParams['q'],
                                                   'lupdate'    => time()       ,
                                                 ),$aTmp );
                else
                    goto end;

                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }   /* if ( ! empty( $szXML = $this->call( $szService = 'wikipediaSearch',$aParams ) ) ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Mercator.wikipedia() ================================================ */
    /* ================================================================================ */


    // https://www.geonames.org/export/place-hierarchy.html#children
    public function children( $aParams )
    /*--------------------------------*/
    {
        $szRetVal           = null;
        $aParams['maxRows'] = $aParams['maxRows'] ?? 200;           /* Default number of results returned */
        $szCacheFile        = $this->cacheName( __METHOD__,$aParams );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $szRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            $szRetVal = $this->call( $szService = 'children',$aParams );

            if ( $this->storing )
            {
                $this->saveHashFile( $szCacheFile,$szRetVal );
                $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
            }   /* if ( $this->storing ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $szRetVal );
    }   /* End of Mercator.children() ================================================= */
    /* ================================================================================ */


    public function lookup( $szCity )
    /*-----------------------------*/
    {
        if ( $aRetVal = $this->aCities[strtolower( trim( $szCity ) )] ?? null )
            $this->addInfo( __METHOD__ . "(): {$szCity} FOUND" );
        else
            $this->addInfo( __METHOD__ . "(): {$szCity} NOT found" );

        //$this->addInfo( __METHOD__ . '():results' . $szCity );

        return ( $aRetVal );
    }   /* End of Mercator.lookup() =================================================== */
    /* ================================================================================ */


    public function infoAt( $fLat,$fLong,$iMaxRows = 1 )
    /*------------------------------------------------*/
    {
        $aRetVal        = null;

        /* Cette ligne est douteuse !!! On devrait utiliser la méthode cacheName() */
        $szCacheFile    = vaesoli::FIL_RealPath( $this->szHome. "/%{$fLat}%,%{$fLong}%.info.cache" );

        if ( false && $this->remembering && is_file( $szCacheFile ) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            $szAccessKey = $this->getAPIKey( 'geonames' );

            /* Cette ligne est douteuse !!! On devrait utiliser la méthode call(), puis faire un parsing du résultat */
            if ( $iMaxRows > 1 )
                $szXML = $this->getURL( $szURL = "http://api.geonames.org/extendedFindNearby?lat={$fLat}&lng={$fLong}&username={$szAccessKey}&maxRows=15&style=full" );
            else
                $szXML = $this->getURL( $szURL = "http://api.geonames.org/findNearby?lat={$fLat}&lng={$fLong}&username={$szAccessKey}&maxRows=1&style=full" );

            if ( ! is_null( $szXML) )
            {
                $oDom = new DOMDocument();

                if ( $oDom->loadXML( $szXML ) )
                {
                    $oXPath = new DOMXPath( $oDom );
                    $o = $oXPath->query( '//geoname' );
                    if ( $o && $o->length > 0 )
                    {
                        $oNode = $o->item(0);
                        //var_dump( "FOUND RESULTS");

                        $aRetVal = array( 'toponymName'     =>          $oXPath->query( 'toponymName'   ,$oNode )->item(0)->nodeValue,
                                          'name'            =>          $oXPath->query( 'name'          ,$oNode )->item(0)->nodeValue,
                                          'latitude'        => (float)  $oXPath->query( 'lat'           ,$oNode )->item(0)->nodeValue,
                                          'longitude'       => (float)  $oXPath->query( 'lng'           ,$oNode )->item(0)->nodeValue,
                                          'geonameId'       =>          $oXPath->query( 'geonameId'     ,$oNode )->item(0)->nodeValue,
                                          'countryCode'     =>          $oXPath->query( 'countryCode'   ,$oNode )->item(0)->nodeValue,
                                          'countryName'     =>          $oXPath->query( 'countryName'   ,$oNode )->item(0)->nodeValue,
                                          'fcl'             =>          $oXPath->query( 'fcl'           ,$oNode )->item(0)->nodeValue,
                                          'fcode'           =>          $oXPath->query( 'fcode'         ,$oNode )->item(0)->nodeValue,
                                          'fclName'         =>          $oXPath->query( 'fclName'       ,$oNode )->item(0)->nodeValue,
                                          'fcodeName'       =>          $oXPath->query( 'fcodeName'     ,$oNode )->item(0)->nodeValue,
                                          'population'      => (int)    $oXPath->query( 'population'    ,$oNode )->item(0)->nodeValue,
                                          'adminCode1'      =>          $oXPath->query( 'adminCode1'    ,$oNode )->item(0)->nodeValue,
                                          'adminName1'      =>          $oXPath->query( 'adminName1'    ,$oNode )->item(0)->nodeValue,
                                          'asciiName'       =>          $oXPath->query( 'asciiName'     ,$oNode )->item(0)->nodeValue,
                                          'alternateNames'  =>          $oXPath->query( 'alternateNames',$oNode )->item(0)->nodeValue,
                                          'elevation'       =>          $oXPath->query( 'elevation'     ,$oNode )->item(0)->nodeValue,
                                          'srtm3'           =>          $oXPath->query( 'srtm3'         ,$oNode )->item(0)->nodeValue,
                                          'astergdem'       =>          $oXPath->query( 'astergdem'     ,$oNode )->item(0)->nodeValue,
                                          'continentCode'   =>          $oXPath->query( 'continentCode' ,$oNode )->item(0)->nodeValue,
                                          'adminCode2'      =>          $oXPath->query( 'adminCode2'    ,$oNode )->item(0)->nodeValue,
                                          'adminName2'      =>          $oXPath->query( 'adminName2'    ,$oNode )->item(0)->nodeValue,
                                          'timezone'        =>          $oXPath->query( 'timezone'      ,$oNode )->item(0)->nodeValue,
                                          'distance'        => (float)  $oXPath->query( 'distance'      ,$oNode )->item(0)->nodeValue,
                                        );
                        //var_dump( $aRetVal );
                    }
                }
            }

            //var_dump( $szURL );

            if ( $this->storing )
            {
                $this->saveHashFile( $szCacheFile,$aRetVal );
                $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
            }   /* if ( $this->storing ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:
        return ( $aRetVal  );
    }   /* End of Mercator.infoAt() =================================================== */
    /* ================================================================================ */


    public function info( $szCity )
    /*---------------------------*/
    {
        $szRetVal       = null;
        /* Cette ligne est douteuse !!! On devrait utiliser la méthode cacheName() */
        $szCacheFile    = vaesoli::FIL_RealPath( $this->szHome. "/%{$szCity}%.info.cache" );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $szRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            $szAccessKey = $this->getAPIKey( 'geonames' );

            /* Cette ligne est douteuse !!! On devrait utiliser la méthode call(), puis faire un parsing du résultat */
            $szRetVal = $this->getURL( "http://api.geonames.org/search?q={$szCity}&maxRows=1000&lang=fr&username={$szAccessKey}&style=full" );

            if ( $this->storing )
            {
                $this->saveHashFile( $szCacheFile,$szRetVal );
                $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
            }   /* if ( $this->storing ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:
        return ( $szRetVal  );
    }   /* End of Mercator.info() ===================================================== */
    /* ================================================================================ */


    protected function defaultCities()
    /*------------------------------*/
    {
        $this->addInfo( __METHOD__ . "(): Default cities set" );

        $aCities   = null;

        if ( false )
        {
            $aCities[] = "Nashville";

            if ( is_array( $aCities ) )
            {
                $szAccessKey = $this->getAPIKey( 'geonames' );

                foreach( $aCities as $szCity )
                {
                    if ( ! empty( $szXML = $this->getURL( "http://api.geonames.org/search?q={$szCity}&maxRows=20&lang=fr&username={$szAccessKey}" ) ) )
                    {
                        $oDom   = new DOMDocument();

                        if ( $oDom->LoadXML( $szXML ) )
                        {
                            //echo __LINE__," ... DOM loaded\n";
                            if ( $oXPath = new DOMXPath( $oDom ) )
                            {
                                //echo __LINE__," ... XPath created\n";

                                if ( ( $oGeoNamesColl = $oXPath->query( "//geoname[1]" ) ) && $oGeoNamesColl->length > 0 )
                                {
                                    //echo __LINE__," ... first node FOUND\n";
                                    $oNode = $oGeoNamesColl->item( 0 );

                                    $szName =
                                    $fLat   =
                                    $fLong  =
                                    $szID   = null;

                                    if ( ( $o = $oXPath->query( 'name',$oNode ) ) && $o->length > 0 )
                                        $szName = trim( $o->item(0)->nodeValue );

                                    if ( ( $o = $oXPath->query( 'lat',$oNode ) ) && $o->length > 0 )
                                        $fLat = (float) $o->item(0)->nodeValue;

                                    if ( ( $o = $oXPath->query( 'lng',$oNode ) ) && $o->length > 0 )
                                        $fLong = (float) $o->item(0)->nodeValue;

                                    if ( ( $o = $oXPath->query( 'geonameId',$oNode ) ) && $o->length > 0 )
                                        $szID = trim( $o->item(0)->nodeValue );

                                    echo '$this->aCities["' . strtolower( $szName ) . '"] = array( "lat"       => ' . $fLat  . ',' . "\n" .
                                         '                                    "lng"       => ' . $fLong . ',' . "\n" .
                                         '                                    "geonameId" => ' . $szID  . ',' . "\n" .
                                         '                                  );' . "\n\n";
                                }
                            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
                        }   /* if ( $oDom->LoadXML( $szXML ) ) */
                    }   /* if ( ! empty( $szXML = $this->getURL( "http://api.geonames.org/search?q={$szCity}&maxRows=20&lang=fr&username=<key>" ) ) ) */
                }   /* foreach( $aCities as $szCity ) */

                $this->__die();
            }   /* if ( is_array( $aCities ) ) */
        }   /* if ( false ) */

        if ( $this->remembering )
        {
            // Alors voir si je trouve ce dont je veux me souvenir !

        }

        {   /* Set the cities */

            /* En réalité, il faudrait aller chercher toutes ces données de la
            mémoire long terme de la classe Mercator (voir Mother.memorize() ...
            qui ne fait encore rien où j'ai documenté le fonctionnement général
            de la mémoire */

            // Il faudrait que je puisse AUSSI me rappeler de ceci et le charger depuis
            // une mémoire de long terme !!!



            $this->aCities['eilat'] = array( 'lat'       => 29.55805,
                                                'lng'       => 34.94821,
                                                'geonameId' => 295277,
                                              );


            $this->aCities['izmir']     = array( 'lat'       => 38.41273,
                                                 'lng'       => 27.13838,
                                                 'geonameId' => 311046,
                                               );

            $this->aCities['jérusalem'] = array( 'lat'       => 31.78199,
                                                'lng'       => 35.21961,
                                                'geonameId' => 7498240,
                                              );

            $this->aCities['limoges'] = array( 'lat'       => 45.83362,
                                                'lng'       => 1.24759,
                                                'geonameId' => 2998286,
                                              );


            $this->aCities['aix-en-provence']   = array( 'lat'          => 43.5283      ,
                                                         'lng'          => 5.44973      ,
                                                         'geonameId'    => 3038354      ,
                                                       );
            $this->aCities['ajaccio']           = array( 'lat'          => 41.91886     ,
                                                         'lng'          => 8.73812      ,
                                                         'geonameId'    => 3038334      ,
                                                       );
            $this->aCities['alexandrie']        = array( 'lat'          => 31.20176     ,
                                                         'lng'          => 29.91582     ,
                                                         'geonameId'    => 361058       ,
                                                        );
            $this->aCities['alger']             = array( 'lat'          => 36.73225     ,
                                                         'lng'          => 3.08746      ,
                                                         'geonameId'    => 2507480      ,
                                                       );
            $this->aCities['amsterdam']         = array( 'lat'          => 52.37403     ,
                                                         'lng'          => 4.88969      ,
                                                         'geonameId'    => 2759794      ,
                                                       );
            $this->aCities['antalya']           = array( 'lat'          => 36.90812     ,
                                                         'lng'          => 30.69556     ,
                                                         'geonameId'    => 323777       ,
                                                       );
            $this->aCities['assouan']           = array( 'lat'          => 24.09082     ,
                                                         'lng'          => 32.89942     ,
                                                         'geonameId'    => 359792       ,
                                                       );
            $this->aCities['avignon']           = array( 'lat'          => 43.94834     ,
                                                         'lng'          => 4.80892      ,
                                                         'geonameId'    => 3035681      ,
                                                       );
            $this->aCities['athènes']           = array( 'lat'          => 37.98376     ,
                                                         'lng'          => 23.72784     ,
                                                         'geonameId'    => 264371       ,
                                                       );
            $this->aCities['bangalore']         = array( 'lat'          => 12.97194     ,
                                                         'lng'          => 77.59369     ,
                                                         'geonameId'    => 1277333      ,
                                                        );
            $this->aCities['bangkok']           = array( 'lat'          => 13.75398     ,
                                                         'lng'          => 100.50144    ,
                                                         'geonameId'    => 1609350      ,
                                                       );
            $this->aCities['barcelone']         = array( 'lat'          => 41.38879     ,
                                                         'lng'          => 2.15899      ,
                                                         'geonameId'    => 3128760      ,
                                                       );
            $this->aCities['bergerac']          = array( 'lat'          => 44.85157     ,
                                                         'lng'          => 0.48171      ,
                                                         'geonameId'    => 3033391      ,
                                                       );
            $this->aCities['berlin']            = array( 'lat'          => 52.52437     ,
                                                         'lng'          => 13.41053     ,
                                                         'geonameId'    => 2950159      ,
                                                       );
            $this->aCities['beyrouth']          = array( 'lat'          => 33.89332     ,
                                                         'lng'          => 35.50157     ,
                                                         'geonameId'    => 276781       ,
                                                       );
            $this->aCities['béziers'] =          array( 'lat'           => 43.34122     ,
                                                        'lng'           => 3.21402      ,
                                                        'geonameId'     => 3032833      ,
                                                       );
            $this->aCities['biarritz']          = array( 'lat'          => 43.48055     ,
                                                         'lng'          => -1.55684     ,
                                                         'geonameId'    => 3032797      ,
                                                       );
            $this->aCities['bolzano']           = array( 'lat'          => 46.49067     ,
                                                         'lng'          => 11.33982     ,
                                                         'geonameId'    => 3181913      ,
                                                      );
            $this->aCities['bordeaux']          = array( 'lat'          => 44.84044     ,
                                                         'lng'          => -0.5805      ,
                                                         'geonameId'    => 3031582      ,
                                                       );
            $this->aCities['boston']            = array( 'lat'          => 42.35843     ,
                                                         'lng'          => -71.05977    ,
                                                         'geonameId'    => 4930956      ,
                                                       );
            $this->aCities['brest']             = array( 'lat'          => 52.09755     ,
                                                         'lng'          => 23.68775     ,
                                                         'geonameId'    => '629634'     ,
                                                      );
            $this->aCities['bucarest']          = array( 'lat'          => 44.43225     ,
                                                         'lng'          => 26.10626     ,
                                                         'geonameId'    => '683506'     ,
                                                      );
            $this->aCities['bruxelles']         = array( 'lat'          => 50.85045     ,
                                                         'lng'          => 4.34878      ,
                                                         'geonameId'    => '2800866'    ,
                                                       );
            $this->aCities['cannes']            = array( 'lat'          => 43.55135     ,
                                                         'lng'          => 7.01275      ,
                                                         'geonameId'    => 3028808      ,
                                                       );
            $this->aCities['calcutta']          = array( 'lat'          => 22.56263     ,
                                                         'lng'          => 88.36304     ,
                                                         'geonameId'    => 1275004      ,
                                                       );
            $this->aCities['carcassonne']       = array( 'lat'          => 43.21649     ,
                                                         'lng'          => 2.34863      ,
                                                         'geonameId'    => 3028641      ,
                                                       );
            $this->aCities['chambéry']          = array( 'lat'          => 45.56628     ,
                                                         'lng'          => 5.92079      ,
                                                         'geonameId'    => 3027422      ,
                                                       );
            $this->aCities['chennai']           = array( 'lat'          => 13.08784     ,
                                                         'lng'          => 80.27847     ,
                                                         'geonameId'    => 1264527      ,
                                                       );
            $this->aCities['clermont-ferrand']  = array( 'lat'          => 45.77969     ,
                                                         'lng'          => 3.08682      ,
                                                         'geonameId'    => 3024635      ,
                                                       );
            $this->aCities['colmar']            = array( 'lat'          => 48.08078     ,
                                                         'lng'          => 7.35584      ,
                                                         'geonameId'    => 3024297      ,
                                                       );
            $this->aCities['cork']              = array( 'lat'          => 51.89797     ,
                                                         'lng'          => -8.47061     ,
                                                         'geonameId'    => 2965140      ,
                                                       );
            $this->aCities['dallas']            = array( 'lat'          => 32.78306     ,
                                                         'lng'          => -96.80667    ,
                                                         'geonameId'    => 4684888      ,
                                                        );
            $this->aCities['damas']             = array( 'lat'          => 33.5102      ,
                                                         'lng'          => 36.29128     ,
                                                         'geonameId'    => '70654'      ,
                                                        );
            $this->aCities['djibouti']          = array( 'lat'          => 11.58901     ,
                                                         'lng'          => 43.14503     ,
                                                         'geonameId'    => '223817'     ,
                                                       );
            $this->aCities['dublin']            = array( 'lat'          => 53.33306     ,
                                                         'lng'          => -6.24889     ,
                                                         'geonameId'    => '2964574'    ,
                                                        );
            $this->aCities['dubrovnik']         = array( 'lat'          => 42.64125     ,
                                                         'lng'          => 18.10909     ,
                                                         'geonameId'    => '3201047'    ,
                                                      );
            $this->aCities['florence']          = array( 'lat'          => 43.77925     ,
                                                         'lng'          => 11.24626     ,
                                                         'geonameId'    => '3176959'    ,
                                                       );
            $this->aCities['genève']            = array( 'lat'          => 46.20222     ,
                                                         'lng'          => 6.14569      ,
                                                         'geonameId'    => '2660646'    ,
                                                        );
            $this->aCities['goa']               = array( 'lat'          => 15.33333     ,
                                                         'lng'          => 74.08333     ,
                                                         'geonameId'    => 1271157      ,
                                                       );
            $this->aCities['hanoï']             = array( 'lat'          => 21.0245      ,
                                                         'lng'          => 105.84117    ,
                                                         'geonameId'    => 1581130      ,
                                                       );
            $this->aCities['istanbul']          = array( 'lat'          => 41.01384     ,
                                                         'lng'          => 28.94966     ,
                                                         'geonameId'    => 745044       ,
                                                       );
            $this->aCities['ko samui']          = array( 'lat'          => 9.50376      ,
                                                         'lng'          => 99.99357     ,
                                                         'geonameId'    => 1606595      ,
                                                       );
            $this->aCities['lausanne']          = array( 'lat'          => 46.516       ,
                                                         'lng'          => 6.63282      ,
                                                         'geonameId'    => 2659994      ,
                                                       );
            $this->aCities['le caire']          = array( 'lat'          => 30.06263     ,
                                                         'lng'          => 31.24967     ,
                                                         'geonameId'    => 360630       ,
                                                       );
            $this->aCities['lisbonne']          = array( 'lat'          => 38.71667     ,
                                                         'lng'          => -9.13333     ,
                                                         'geonameId'    => 2267057      ,
                                                       );
            $this->aCities['liverpool']         = array( 'lat'          => 53.41058     ,
                                                         'lng'          => -2.97794     ,
                                                         'geonameId'    => 2644210      ,
                                                       );
            $this->aCities['londres']           = array( 'lat'          => 51.50853     ,
                                                         'lng'          => -0.12574     ,
                                                         'geonameId'    => 2643743      ,
                                                       );
            $this->aCities['los angeles']       = array( 'lat'          => 34.05223     ,
                                                         'lng'          => -118.24368   ,
                                                         'geonameId'    => 5368361      ,
                                                       );
            $this->aCities['lyon']              = array( 'lat'          => 45.74846     ,
                                                         'lng'          => 4.84671      ,
                                                         'geonameId'    => 2996944      ,
                                                       );
            $this->aCities['málaga']            = array( 'lat'          => 36.72016     ,
                                                         'lng'          => -4.42034     ,
                                                         'geonameId'    => 2514256      ,
                                                       );
            $this->aCities['nairobi']           = array( 'lat'          => -1.28333     ,
                                                         'lng'          => 36.81667     ,
                                                         'geonameId'    => 184745       ,
                                                       );
            $this->aCities['naples']            = array( 'lat'          => 40.85216     ,
                                                         'lng'          => 14.26811     ,
                                                         'geonameId'    => 3172394      ,
                                                       );
            $this->aCities["nashville"]         = array( 'lat'          => 36.16589     ,
                                                         'lng'          => -86.78444    ,
                                                         'geonameId'    => 4644585      ,
                                                       );
            $this->aCities['nice']              = array( 'lat'          => 43.70313     ,
                                                         'lng'          => 7.26608      ,
                                                         'geonameId'    => 2990440      ,
                                                       );
            $this->aCities['nicosie']           = array( 'lat'          => 35.17531     ,
                                                         'lng'          => 33.3642      ,
                                                         'geonameId'    => 146268       ,
                                                       );
            $this->aCities['new york']          = array( 'lat'          => 40.71427     ,
                                                         'lng'          => -74.00597    ,
                                                         'geonameId'    => 5128581      ,
                                                       );
            $this->aCities['macao']             = array( 'lat'          => 22.20056     ,
                                                         'lng'          => 113.54611    ,
                                                         'geonameId'    => 1821274      ,
                                                       );
            $this->aCities['madrid']            = array( 'lat'          => 40.4165      ,
                                                         'lng'          => -3.70256     ,
                                                         'geonameId'    => 3117735      ,
                                                       );
            $this->aCities['manille']           = array( 'lat'          => 14.6042      ,
                                                         'lng'          => 120.9822     ,
                                                         'geonameId'    => '1701668'    ,
                                                        );
            $this->aCities['médine']            = array( 'lat'          => 24.46861     ,
                                                         'lng'          => 39.61417     ,
                                                         'geonameId'    => '109223'     ,
                                                       );
            $this->aCities['miami']             = array( 'lat'          => 25.77427     ,
                                                         'lng'          => -80.19366    ,
                                                         'geonameId'    => 4164138      ,
                                                       );
            $this->aCities['milan']             = array( 'lat'          => 45.46427     ,
                                                         'lng'          => 9.18951      ,
                                                         'geonameId'    => '3173435'    ,
                                                       );
            $this->aCities['mostar']            = array( 'lat'          => 43.34333     ,
                                                         'lng'          => 17.80806     ,
                                                         'geonameId'    => '3194828'    ,
                                                       );
            $this->aCities['mumbai']            = array( 'lat'          => 19.07283     ,
                                                         'lng'          => 72.88261     ,
                                                         'geonameId'    => 1275339      ,
                                                       );
            $this->aCities['neuchâtel']         = array( 'lat'          => 46.99179     ,
                                                         'lng'          => 6.931        ,
                                                         'geonameId'    => 2659496      ,
                                                       );
            $this->aCities['marseille']         = array( 'lat'          => 43.29695     ,
                                                         'lng'          => 5.38107      ,
                                                         'geonameId'    => 2995469      ,
                                                       );
            $this->aCities['montauban']         = array( 'lat'          => 44.01759     ,
                                                         'lng'          => 1.3542       ,
                                                        'geonameId'     => 2993002      ,
                                                       );
            $this->aCities['montpellier']       = array( 'lat'          => 43.61093     ,
                                                         'lng'          => 3.87635      ,
                                                         'geonameId'    => 2992166      ,
                                                       );
            $this->aCities['palerme']           = array( 'lat'          => 38.13205     ,
                                                         'lng'          => 13.33561     ,
                                                         'geonameId'    => 2523920      ,
                                                       );
            $this->aCities['paris']             = array( 'lat'          => 48.85341     ,
                                                         'lng'          => 2.3488       ,
                                                         'geonameId'    => 2988507      ,
                                                       );
            $this->aCities['pékin']             = array( 'lat'          => 39.9075      ,
                                                         'lng'          => 116.39723    ,
                                                         'geonameId'    => 1816670      ,
                                                       );
            $this->aCities['pescara']           = array( 'lat'          => 42.4584      ,
                                                         'lng'          => 14.20283     ,
                                                         'geonameId'    => 3171168      ,
                                                       );
            $this->aCities['pise']              = array( 'lat'          => 43.70853     ,
                                                         'lng'          => 10.4036      ,
                                                         'geonameId'    => 3170647      ,
                                                       );
            $this->aCities['poitiers']          = array( 'lat'          => 46.58261     ,
                                                         'lng'          => 0.34348      ,
                                                         'geonameId'    => 2986495      ,
                                                       );
            $this->aCities['perpignan']         = array( 'lat'          => 42.69764     ,
                                                         'lng'          => 2.89541      ,
                                                         'geonameId'    => 2987914      ,
                                                       );
            $this->aCities['philadelphie']      = array( 'lat'          => 39.95233     ,
                                                         'lng'          => -75.16379    ,
                                                         'geonameId'    => 4560349      ,
                                                       );
            $this->aCities['phuket']            = array( 'lat'          => 7.89059      ,
                                                         'lng'          => 98.3981      ,
                                                         'geonameId'    => 1151254      ,
                                                       );
            $this->aCities['portland']          = array( 'lat'          => 18.13333     ,
                                                         'lng'          => -76.53333    ,
                                                         'geonameId'    => 3488997      ,
                                                       );
            $this->aCities['porto']             = array( 'lat'          => 41.14961     ,
                                                         'lng'          => -8.61099     ,
                                                         'geonameId'    => 2735943,
                                                       );
            $this->aCities['prague']            = array( 'lat'          => 50.08804     ,
                                                         'lng'          => 14.42076     ,
                                                         'geonameId'    => 3067696      ,
                                                       );
            $this->aCities['rimini']            = array( 'lat'          => 44.05755     ,
                                                         'lng'          => 12.56528     ,
                                                         'geonameId'    => 3169361      ,
                                                       );
            $this->aCities['riyad']             = array( 'lat'          => 24.68773     ,
                                                         'lng'          => 46.72185     ,
                                                         'geonameId'    => 108410       ,
                                                       );
            $this->aCities['rome']              = array( 'lat'          => 41.89193     ,
                                                         'lng'          => 12.51133     ,
                                                         'geonameId'    => 3169070      ,
                                                       );
            $this->aCities['ho chi minh city']  = array( 'lat'          => 10.82302     ,
                                                         'lng'          => 106.62965    ,
                                                         'geonameId'    => 1566083      ,
                                                       );
            $this->aCities['saigon']            = array( 'lat'          => 10.82302     ,
                                                         'lng'          => 106.62965    ,
                                                         'geonameId'    => 1566083      ,
                                                       );
            $this->aCities['saint-étienne']     = array( 'lat'          => 45.43389     ,
                                                         'lng'          => 4.39         ,
                                                         'geonameId'    => 2980291      ,
                                                       );
            $this->aCities['san francisco']     = array( 'lat'          => 37.77493     ,
                                                         'lng'          => -122.41942   ,
                                                         'geonameId'    => 5391959      ,
                                                       );
            $this->aCities['seattle']           = array( 'lat'          => 47.60621     ,
                                                         'lng'          => -122.33207   ,
                                                         'geonameId'    => 5809844      ,
                                                       );
            $this->aCities['séville']           = array( 'lat'          => 37.38283     ,
                                                         'lng'          => -5.97317     ,
                                                         'geonameId'    => 2510911      ,
                                                       );
            $this->aCities['sion']              = array( 'lat'          => 46.22739     ,
                                                         'lng'          => 7.35559      ,
                                                         'geonameId'    => 2658576      ,
                                                       );
            $this->aCities['sofia']             = array( 'lat'          => 42.69751     ,
                                                         'lng'          => 23.32415     ,
                                                         'geonameId'    => 727011       ,
                                                        );
            $this->aCities['split']             = array( 'lat'          => 43.50891     ,
                                                         'lng'          => 16.43915     ,
                                                         'geonameId'    => 3190261      ,
                                                        );
            $this->aCities['spokane']           = array( 'lat'          => 47.65966     ,
                                                         'lng'          => -117.42908   ,
                                                         'geonameId'    => 5811696      ,
                                                       );
            $this->aCities['stornoway']         = array( 'lat'          => 58.20925     ,
                                                         'lng'          => -6.38649     ,
                                                         'geonameId'    => 2636790      ,
                                                       );
            $this->aCities['strasbourg']        = array( 'lat'          => 48.58392     ,
                                                         'lng'          => 7.74553      ,
                                                         'geonameId'    => 2973783      ,
                                                       );
            $this->aCities['suez']              = array( 'lat'          => 29.97371     ,
                                                         'lng'          => 32.52627     ,
                                                         'geonameId'    => 359796       ,
                                                        );
            $this->aCities['swansea']           = array( 'lat'          => 51.62079     ,
                                                         'lng'          => -3.94323     ,
                                                         'geonameId'    => 2636432      ,
                                                      );
            $this->aCities['syracuse']          = array( 'lat'          => 43.04812     ,
                                                         'lng'          => -76.14742    ,
                                                         'geonameId'    => 5140405      ,
                                                       );
            $this->aCities['tel-aviv']          = array( 'lat'          => 32.08088     ,
                                                         'lng'          => 34.78057     ,
                                                         'geonameId'    => 293397       ,
                                                       );
            $this->aCities['thessalonique']     = array( 'lat'          => 40.64361     ,
                                                         'lng'          => 22.93086     ,
                                                         'geonameId'    => 734077       ,
                                                      );
            $this->aCities['tirana']            = array( 'lat'          => 41.3275      ,
                                                         'lng'          => 19.81889     ,
                                                         'geonameId'    => 3183875      ,
                                                       );
            $this->aCities['toulon']            = array( 'lat'          => 43.12442     ,
                                                         'lng'          => 5.92836      ,
                                                         'geonameId'    => 2972328      ,
                                                       );
            $this->aCities['toulouse']          = array( 'lat'          => 43.60426     ,
                                                         'lng'          => 1.44367      ,
                                                         'geonameId'    => 2972315      ,
                                                       );
            $this->aCities['tunis']             = array( 'lat'          => 36.81897     ,
                                                         'lng'          => 10.16579     ,
                                                         'geonameId'    => 2464470      ,
                                                       );
            $this->aCities['venise']            = array( 'lat'          => 45.43713     ,
                                                         'lng'          => 12.33265     ,
                                                         'geonameId'    => 3164603      ,
                                                       );
            if ( $this->storing )
                $this->memorize( 'default cities','cities',$this->aCities );
        }   /* Set the cities */

    }   /* End of Mercator.defaultCities() ============================================ */
    /* ================================================================================ */


    public function countrySynonym( $szCountry )
    /*----------------------------------------*/
    {
        //var_dump( $this->aCountrySynonyms );
        //die();
        return ( $this->aCountrySynonyms[ strtolower( trim( $szCountry ) ) ] ?? $szCountry );
    }   /* End of Mercator.defaultCities() ============================================ */
    /* ================================================================================ */


    protected function setCountrySynonyms()
    /*-----------------------------------*/
    {
        $this->addInfo( __METHOD__ . "(): Country synonyms set" );

        $szCacheFile = $this->cacheName( __METHOD__,null );

        if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 30 * 3 /* ±3 months */ ) )
        {
            $this->aCountrySynonyms = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): country synonyms obtained from {$szCacheFile}" );
            //var_dump( 'timezone RETRIEVED' );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            if ( is_array( $aCountries = $this->countries() ) )
            {
                $this->aCountrySynonyms = null;

                foreach( $aCountries as $szKey => $aCountry )
                {
                    foreach( $aCountry['names'] as $aName )
                    {
                        $this->aCountrySynonyms[ strtolower( trim( $aName['value'  ] ) ) ] =
                        $this->aCountrySynonyms[ strtolower( trim( $aName['cleaned'] ) ) ] = $szKey;
                    }   /* foreach( $aCountry['names'] as $aName ) */
                }   /* foreach( $aCountries as $szKey => $aCountry ) */

                if ( true )
                {   /* Manual adjustment */
                    $this->aCountrySynonyms["hexagone"]     = "FR";
                    $this->aCountrySynonyms["angleterre"]   = "GB";
                    $this->aCountrySynonyms["england"]      = "GB";
                    $this->aCountrySynonyms["royaume-uni"]  = "GB";
                }   /* Manual adjustment */

                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$this->aCountrySynonyms );
                    $this->addInfo( __METHOD__ . "(): country synonyms stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */

            }   /* if ( is_array( $aCountries = $this->countries() ) ) */
            //var_dump( $this->aCountrySynonyms );
            //$this->die( "Constitution des synonymes" );
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        if ( false )
        {   /* Set the country synonyms */

            /* Ces données devraient être extraites du fichier countries.xml dont on extrait
               TOUTES les langues qu'on a dans le fichier, avec les données cleaned également
            */

            $this->aCountrySynonyms["afghanistan"]                                  = "AF";
            $this->aCountrySynonyms["afrique du sud"]                               = "ZA";
            $this->aCountrySynonyms["albania"]                                      = "AL";
            $this->aCountrySynonyms["albanie"]                                      = "AL";
            $this->aCountrySynonyms["algeria"]                                      = "DZ";
            $this->aCountrySynonyms["algérie"]                                      = "DZ";
            $this->aCountrySynonyms["allemagne"]                                    = "DE";
            $this->aCountrySynonyms["american samoa"]                               = "AS";
            $this->aCountrySynonyms["andorra"]                                      = "AD";
            $this->aCountrySynonyms["andorre"]                                      = "AD";
            $this->aCountrySynonyms["angola"]                                       = "AO";
            $this->aCountrySynonyms["anguilla"]                                     = "AI";
            $this->aCountrySynonyms["antarctica"]                                   = "AQ";
            $this->aCountrySynonyms["antarctique"]                                  = "AQ";
            $this->aCountrySynonyms["antigua and barbuda"]                          = "AG";
            $this->aCountrySynonyms["antigua et barbuda"]                           = "AG";
            $this->aCountrySynonyms["arabie saoudite"]                              = "SA";
            $this->aCountrySynonyms["argentina"]                                    = "AR";
            $this->aCountrySynonyms["argentine"]                                    = "AR";
            $this->aCountrySynonyms["armenia"]                                      = "AM";
            $this->aCountrySynonyms["arménie"]                                      = "AM";
            $this->aCountrySynonyms["aruba"]                                        = "AW";
            $this->aCountrySynonyms["australia"]                                    = "AU";
            $this->aCountrySynonyms["australie"]                                    = "AU";
            $this->aCountrySynonyms["austria"]                                      = "AT";
            $this->aCountrySynonyms["autriche"]                                     = "AT";
            $this->aCountrySynonyms["azerbaijan"]                                   = "AZ";
            $this->aCountrySynonyms["azerbaïdjan"]                                  = "AZ";
            $this->aCountrySynonyms["bahamas"]                                      = "BS";
            $this->aCountrySynonyms["bahrain"]                                      = "BH";
            $this->aCountrySynonyms["bahreïn"]                                      = "BH";
            $this->aCountrySynonyms["bangladesh"]                                   = "BD";
            $this->aCountrySynonyms["barbade"]                                      = "BB";
            $this->aCountrySynonyms["barbados"]                                     = "BB";
            $this->aCountrySynonyms["belarus"]                                      = "BY";
            $this->aCountrySynonyms["belgique"]                                     = "BE";
            $this->aCountrySynonyms["belgium"]                                      = "BE";
            $this->aCountrySynonyms["belize"]                                       = "BZ";
            $this->aCountrySynonyms["benin"]                                        = "BJ";
            $this->aCountrySynonyms["bermuda"]                                      = "BM";
            $this->aCountrySynonyms["bermudes"]                                     = "BM";
            $this->aCountrySynonyms["bhoutan"]                                      = "BT";
            $this->aCountrySynonyms["bhutan"]                                       = "BT";
            $this->aCountrySynonyms["biélorussie"]                                  = "BY";
            $this->aCountrySynonyms["bolivia"]                                      = "BO";
            $this->aCountrySynonyms["bolivie"]                                      = "BO";
            $this->aCountrySynonyms["bonaire, saint-eustache et saba"]              = "BQ";
            $this->aCountrySynonyms["bonaire, sint eustatius, and saba"]            = "BQ";
            $this->aCountrySynonyms["bosnia and herzegovina"]                       = "BA";
            $this->aCountrySynonyms["bosnie-herzégovine"]                           = "BA";
            $this->aCountrySynonyms["botswana"]                                     = "BW";
            $this->aCountrySynonyms["bouvet island"]                                = "BV";
            $this->aCountrySynonyms["brazil"]                                       = "BR";
            $this->aCountrySynonyms["british indian ocean territory"]               = "IO";
            $this->aCountrySynonyms["british virgin islands"]                       = "VG";
            $this->aCountrySynonyms["brunei"]                                       = "BN";
            $this->aCountrySynonyms["brunéi darussalam"]                            = "BN";
            $this->aCountrySynonyms["brésil"]                                       = "BR";
            $this->aCountrySynonyms["bulgaria"]                                     = "BG";
            $this->aCountrySynonyms["bulgarie"]                                     = "BG";
            $this->aCountrySynonyms["burkina faso"]                                 = "BF";
            $this->aCountrySynonyms["burundi"]                                      = "BI";
            $this->aCountrySynonyms["bénin"]                                        = "BJ";
            $this->aCountrySynonyms["cabo verde"]                                   = "CV";
            $this->aCountrySynonyms["cambodge"]                                     = "KH";
            $this->aCountrySynonyms["cambodia"]                                     = "KH";
            $this->aCountrySynonyms["cameroon"]                                     = "CM";
            $this->aCountrySynonyms["cameroun"]                                     = "CM";
            $this->aCountrySynonyms["canada"]                                       = "CA";
            $this->aCountrySynonyms["cap-vert"]                                     = "CV";
            $this->aCountrySynonyms["cayman islands"]                               = "KY";
            $this->aCountrySynonyms["centrafrique"]                                 = "CF";
            $this->aCountrySynonyms["central african republic"]                     = "CF";
            $this->aCountrySynonyms["chad"]                                         = "TD";
            $this->aCountrySynonyms["chile"]                                        = "CL";
            $this->aCountrySynonyms["chili"]                                        = "CL";
            $this->aCountrySynonyms["china"]                                        = "CN";
            $this->aCountrySynonyms["chine"]                                        = "CN";
            $this->aCountrySynonyms["christmas island"]                             = "CX";
            $this->aCountrySynonyms["chypre"]                                       = "CY";
            $this->aCountrySynonyms["cocos [keeling] islands"]                      = "CC";
            $this->aCountrySynonyms["colombia"]                                     = "CO";
            $this->aCountrySynonyms["colombie"]                                     = "CO";
            $this->aCountrySynonyms["comores"]                                      = "KM";
            $this->aCountrySynonyms["comoros"]                                      = "KM";
            $this->aCountrySynonyms["congo republic"]                               = "CG";
            $this->aCountrySynonyms["congo-brazzaville"]                            = "CG";
            $this->aCountrySynonyms["cook islands"]                                 = "CK";
            $this->aCountrySynonyms["corée du nord"]                                = "KP";
            $this->aCountrySynonyms["corée du sud"]                                 = "KR";
            $this->aCountrySynonyms["costa rica"]                                   = "CR";
            $this->aCountrySynonyms["croatia"]                                      = "HR";
            $this->aCountrySynonyms["croatie"]                                      = "HR";
            $this->aCountrySynonyms["cuba"]                                         = "CU";
            $this->aCountrySynonyms["curaçao"]                                      = "CW";
            $this->aCountrySynonyms["cyprus"]                                       = "CY";
            $this->aCountrySynonyms["czechia"]                                      = "CZ";
            $this->aCountrySynonyms["côte d'ivoire"]                                = "CI";
            $this->aCountrySynonyms["danemark"]                                     = "DK";
            $this->aCountrySynonyms["denmark"]                                      = "DK";
            $this->aCountrySynonyms["djibouti"]                                     = "DJ";
            $this->aCountrySynonyms["dominica"]                                     = "DM";
            $this->aCountrySynonyms["dominican republic"]                           = "DO";
            $this->aCountrySynonyms["dominique"]                                    = "DM";
            $this->aCountrySynonyms["dr congo"]                                     = "CD";
            $this->aCountrySynonyms["ecuador"]                                      = "EC";
            $this->aCountrySynonyms["egypt"]                                        = "EG";
            $this->aCountrySynonyms["el salvador"]                                  = "SV";
            $this->aCountrySynonyms["equatorial guinea"]                            = "GQ";
            $this->aCountrySynonyms["eritrea"]                                      = "ER";
            $this->aCountrySynonyms["espagne"]                                      = "ES";
            $this->aCountrySynonyms["estonia"]                                      = "EE";
            $this->aCountrySynonyms["estonie"]                                      = "EE";
            $this->aCountrySynonyms["eswatini"]                                     = "SZ";
            $this->aCountrySynonyms["ethiopia"]                                     = "ET";
            $this->aCountrySynonyms["falkland islands"]                             = "FK";
            $this->aCountrySynonyms["faroe islands"]                                = "FO";
            $this->aCountrySynonyms["fidji"]                                        = "FJ";
            $this->aCountrySynonyms["fiji"]                                         = "FJ";
            $this->aCountrySynonyms["finland"]                                      = "FI";
            $this->aCountrySynonyms["finlande"]                                     = "FI";
            $this->aCountrySynonyms["france"]                                       = "FR";
            $this->aCountrySynonyms["french guiana"]                                = "GF";
            $this->aCountrySynonyms["french polynesia"]                             = "PF";
            $this->aCountrySynonyms["french southern territories"]                  = "TF";
            $this->aCountrySynonyms["gabon"]                                        = "GA";
            $this->aCountrySynonyms["gambia"]                                       = "GM";
            $this->aCountrySynonyms["gambie"]                                       = "GM";
            $this->aCountrySynonyms["georgia"]                                      = "GE";
            $this->aCountrySynonyms["germany"]                                      = "DE";
            $this->aCountrySynonyms["ghana"]                                        = "GH";
            $this->aCountrySynonyms["gibraltar"]                                    = "GI";
            $this->aCountrySynonyms["greece"]                                       = "GR";
            $this->aCountrySynonyms["greenland"]                                    = "GL";
            $this->aCountrySynonyms["grenada"]                                      = "GD";
            $this->aCountrySynonyms["grenade"]                                      = "GD";
            $this->aCountrySynonyms["groenland"]                                    = "GL";
            $this->aCountrySynonyms["grèce"]                                        = "GR";
            $this->aCountrySynonyms["guadeloupe"]                                   = "GP";
            $this->aCountrySynonyms["guam"]                                         = "GU";
            $this->aCountrySynonyms["guatemala"]                                    = "GT";
            $this->aCountrySynonyms["guernesey"]                                    = "GG";
            $this->aCountrySynonyms["guernsey"]                                     = "GG";
            $this->aCountrySynonyms["guinea"]                                       = "GN";
            $this->aCountrySynonyms["guinea-bissau"]                                = "GW";
            $this->aCountrySynonyms["guinée équatoriale"]                           = "GQ";
            $this->aCountrySynonyms["guinée"]                                       = "GN";
            $this->aCountrySynonyms["guinée-bissau"]                                = "GW";
            $this->aCountrySynonyms["guyana"]                                       = "GY";
            $this->aCountrySynonyms["guyane"]                                       = "GF";
            $this->aCountrySynonyms["géorgie du sud-et-les îles sandwich du sud"]   = "GS";
            $this->aCountrySynonyms["géorgie"]                                      = "GE";
            $this->aCountrySynonyms["haiti"]                                        = "HT";
            $this->aCountrySynonyms["haïti"]                                        = "HT";
            $this->aCountrySynonyms["heard island and mcdonald islands"]            = "HM";
            $this->aCountrySynonyms["helvétie"]                                     = "CH";
            $this->aCountrySynonyms["hexagone"]                                     = "FR";
            $this->aCountrySynonyms["honduras"]                                     = "HN";
            $this->aCountrySynonyms["hong kong"]                                    = "HK";
            $this->aCountrySynonyms["hongrie"]                                      = "HU";
            $this->aCountrySynonyms["hungary"]                                      = "HU";
            $this->aCountrySynonyms["iceland"]                                      = "IS";
            $this->aCountrySynonyms["inde"]                                         = "IN";
            $this->aCountrySynonyms["india"]                                        = "IN";
            $this->aCountrySynonyms["indonesia"]                                    = "ID";
            $this->aCountrySynonyms["indonésie"]                                    = "ID";
            $this->aCountrySynonyms["irak"]                                         = "IQ";
            $this->aCountrySynonyms["iran"]                                         = "IR";
            $this->aCountrySynonyms["iraq"]                                         = "IQ";
            $this->aCountrySynonyms["ireland"]                                      = "IE";
            $this->aCountrySynonyms["irlande"]                                      = "IE";
            $this->aCountrySynonyms["islande"]                                      = "IS";
            $this->aCountrySynonyms["isle of man"]                                  = "IM";
            $this->aCountrySynonyms["israel"]                                       = "IL";
            $this->aCountrySynonyms["israël"]                                       = "IL";
            $this->aCountrySynonyms["italie"]                                       = "IT";
            $this->aCountrySynonyms["italy"]                                        = "IT";
            $this->aCountrySynonyms["ivory coast"]                                  = "CI";
            $this->aCountrySynonyms["jamaica"]                                      = "JM";
            $this->aCountrySynonyms["jamaïque"]                                     = "JM";
            $this->aCountrySynonyms["japan"]                                        = "JP";
            $this->aCountrySynonyms["japon"]                                        = "JP";
            $this->aCountrySynonyms["jersey"]                                       = "JE";
            $this->aCountrySynonyms["jordan"]                                       = "JO";
            $this->aCountrySynonyms["jordanie"]                                     = "JO";
            $this->aCountrySynonyms["kazakhstan"]                                   = "KZ";
            $this->aCountrySynonyms["kenya"]                                        = "KE";
            $this->aCountrySynonyms["kirghizistan"]                                 = "KG";
            $this->aCountrySynonyms["kiribati"]                                     = "KI";
            $this->aCountrySynonyms["kosovo"]                                       = "XK";
            $this->aCountrySynonyms["koweït"]                                       = "KW";
            $this->aCountrySynonyms["kuwait"]                                       = "KW";
            $this->aCountrySynonyms["kyrgyzstan"]                                   = "KG";
            $this->aCountrySynonyms["laos"]                                         = "LA";
            $this->aCountrySynonyms["latvia"]                                       = "LV";
            $this->aCountrySynonyms["lebanon"]                                      = "LB";
            $this->aCountrySynonyms["lesotho"]                                      = "LS";
            $this->aCountrySynonyms["lettonie"]                                     = "LV";
            $this->aCountrySynonyms["liban"]                                        = "LB";
            $this->aCountrySynonyms["liberia"]                                      = "LR";
            $this->aCountrySynonyms["libya"]                                        = "LY";
            $this->aCountrySynonyms["libye"]                                        = "LY";
            $this->aCountrySynonyms["liechtenstein"]                                = "LI";
            $this->aCountrySynonyms["lithuania"]                                    = "LT";
            $this->aCountrySynonyms["lituanie"]                                     = "LT";
            $this->aCountrySynonyms["luxembourg"]                                   = "LU";
            $this->aCountrySynonyms["macao"]                                        = "MO";
            $this->aCountrySynonyms["macédoine du nord"]                            = "MK";
            $this->aCountrySynonyms["madagascar"]                                   = "MG";
            $this->aCountrySynonyms["malaisie"]                                     = "MY";
            $this->aCountrySynonyms["malawi"]                                       = "MW";
            $this->aCountrySynonyms["malaysia"]                                     = "MY";
            $this->aCountrySynonyms["maldives"]                                     = "MV";
            $this->aCountrySynonyms["mali"]                                         = "ML";
            $this->aCountrySynonyms["malta"]                                        = "MT";
            $this->aCountrySynonyms["malte"]                                        = "MT";
            $this->aCountrySynonyms["maroc"]                                        = "MA";
            $this->aCountrySynonyms["marshall islands"]                             = "MH";
            $this->aCountrySynonyms["martinique"]                                   = "MQ";
            $this->aCountrySynonyms["maurice"]                                      = "MU";
            $this->aCountrySynonyms["mauritania"]                                   = "MR";
            $this->aCountrySynonyms["mauritanie"]                                   = "MR";
            $this->aCountrySynonyms["mauritius"]                                    = "MU";
            $this->aCountrySynonyms["mayotte"]                                      = "YT";
            $this->aCountrySynonyms["mexico"]                                       = "MX";
            $this->aCountrySynonyms["mexique"]                                      = "MX";
            $this->aCountrySynonyms["micronesia"]                                   = "FM";
            $this->aCountrySynonyms["micronésie"]                                   = "FM";
            $this->aCountrySynonyms["moldavie"]                                     = "MD";
            $this->aCountrySynonyms["moldova"]                                      = "MD";
            $this->aCountrySynonyms["monaco"]                                       = "MC";
            $this->aCountrySynonyms["mongolia"]                                     = "MN";
            $this->aCountrySynonyms["mongolie"]                                     = "MN";
            $this->aCountrySynonyms["montenegro"]                                   = "ME";
            $this->aCountrySynonyms["montserrat"]                                   = "MS";
            $this->aCountrySynonyms["monténégro"]                                   = "ME";
            $this->aCountrySynonyms["morocco"]                                      = "MA";
            $this->aCountrySynonyms["mozambique"]                                   = "MZ";
            $this->aCountrySynonyms["myanmar"]                                      = "MM";
            $this->aCountrySynonyms["namibia"]                                      = "NA";
            $this->aCountrySynonyms["namibie"]                                      = "NA";
            $this->aCountrySynonyms["nauru"]                                        = "NR";
            $this->aCountrySynonyms["nepal"]                                        = "NP";
            $this->aCountrySynonyms["netherlands"]                                  = "NL";
            $this->aCountrySynonyms["new caledonia"]                                = "NC";
            $this->aCountrySynonyms["new zealand"]                                  = "NZ";
            $this->aCountrySynonyms["nicaragua"]                                    = "NI";
            $this->aCountrySynonyms["niger"]                                        = "NE";
            $this->aCountrySynonyms["nigeria"]                                      = "NG";
            $this->aCountrySynonyms["nioué"]                                        = "NU";
            $this->aCountrySynonyms["niue"]                                         = "NU";
            $this->aCountrySynonyms["norfolk island"]                               = "NF";
            $this->aCountrySynonyms["north korea"]                                  = "KP";
            $this->aCountrySynonyms["north macedonia"]                              = "MK";
            $this->aCountrySynonyms["northern mariana islands"]                     = "MP";
            $this->aCountrySynonyms["norvège"]                                      = "NO";
            $this->aCountrySynonyms["norway"]                                       = "NO";
            $this->aCountrySynonyms["nouvelle-calédonie"]                           = "NC";
            $this->aCountrySynonyms["nouvelle-zélande"]                             = "NZ";
            $this->aCountrySynonyms["népal"]                                        = "NP";
            $this->aCountrySynonyms["oman"]                                         = "OM";
            $this->aCountrySynonyms["ouganda"]                                      = "UG";
            $this->aCountrySynonyms["ouzbékistan"]                                  = "UZ";
            $this->aCountrySynonyms["pakistan"]                                     = "PK";
            $this->aCountrySynonyms["palaos"]                                       = "PW";
            $this->aCountrySynonyms["palau"]                                        = "PW";
            $this->aCountrySynonyms["palestine"]                                    = "PS";
            $this->aCountrySynonyms["panama"]                                       = "PA";
            $this->aCountrySynonyms["papouasie-nouvelle guinée"]                    = "PG";
            $this->aCountrySynonyms["papua new guinea"]                             = "PG";
            $this->aCountrySynonyms["paraguay"]                                     = "PY";
            $this->aCountrySynonyms["pays-bas"]                                     = "NL";
            $this->aCountrySynonyms["peru"]                                         = "PE";
            $this->aCountrySynonyms["philippines"]                                  = "PH";
            $this->aCountrySynonyms["pitcairn islands"]                             = "PN";
            $this->aCountrySynonyms["pitcairn"]                                     = "PN";
            $this->aCountrySynonyms["poland"]                                       = "PL";
            $this->aCountrySynonyms["pologne"]                                      = "PL";
            $this->aCountrySynonyms["polynésie française"]                          = "PF";
            $this->aCountrySynonyms["porto rico"]                                   = "PR";
            $this->aCountrySynonyms["portugal"]                                     = "PT";
            $this->aCountrySynonyms["puerto rico"]                                  = "PR";
            $this->aCountrySynonyms["pérou"]                                        = "PE";
            $this->aCountrySynonyms["qatar"]                                        = "QA";
            $this->aCountrySynonyms["rdc"]                                          = "CD";
            $this->aCountrySynonyms["romania"]                                      = "RO";
            $this->aCountrySynonyms["roumanie"]                                     = "RO";
            $this->aCountrySynonyms["royaume-uni"]                                  = "GB";
            $this->aCountrySynonyms["russia"]                                       = "RU";
            $this->aCountrySynonyms["russie"]                                       = "RU";
            $this->aCountrySynonyms["rwanda"]                                       = "RW";
            $this->aCountrySynonyms["république dominicaine"]                       = "DO";
            $this->aCountrySynonyms["république tchèque"]                           = "CZ";
            $this->aCountrySynonyms["réunion"]                                      = "RE";
            $this->aCountrySynonyms["sahara occidental"]                            = "EH";
            $this->aCountrySynonyms["saint barthélemy"]                             = "BL";
            $this->aCountrySynonyms["saint helena"]                                 = "SH";
            $this->aCountrySynonyms["saint lucia"]                                  = "LC";
            $this->aCountrySynonyms["saint martin"]                                 = "SX";
            $this->aCountrySynonyms["saint pierre and miquelon"]                    = "PM";
            $this->aCountrySynonyms["saint-barthélemy"]                             = "BL";
            $this->aCountrySynonyms["saint-christophe-et-niévès"]                   = "KN";
            $this->aCountrySynonyms["saint-marin"]                                  = "SM";
            $this->aCountrySynonyms["saint-martin"]                                 = "MF";
            $this->aCountrySynonyms["saint-pierre et miquelon"]                     = "PM";
            $this->aCountrySynonyms["saint-vincent-et-les-grenadines"]              = "VC";
            $this->aCountrySynonyms["sainte-hélène"]                                = "SH";
            $this->aCountrySynonyms["sainte-lucie"]                                 = "LC";
            $this->aCountrySynonyms["salvador"]                                     = "SV";
            $this->aCountrySynonyms["samoa américaines"]                            = "AS";
            $this->aCountrySynonyms["samoa"]                                        = "WS";
            $this->aCountrySynonyms["san marino"]                                   = "SM";
            $this->aCountrySynonyms["saudi arabia"]                                 = "SA";
            $this->aCountrySynonyms["senegal"]                                      = "SN";
            $this->aCountrySynonyms["serbia"]                                       = "RS";
            $this->aCountrySynonyms["serbie"]                                       = "RS";
            $this->aCountrySynonyms["seychelles"]                                   = "SC";
            $this->aCountrySynonyms["sierra leone"]                                 = "SL";
            $this->aCountrySynonyms["singapore"]                                    = "SG";
            $this->aCountrySynonyms["singapour"]                                    = "SG";
            $this->aCountrySynonyms["sint maarten"]                                 = "SX";
            $this->aCountrySynonyms["slovakia"]                                     = "SK";
            $this->aCountrySynonyms["slovaquie"]                                    = "SK";
            $this->aCountrySynonyms["slovenia"]                                     = "SI";
            $this->aCountrySynonyms["slovénie"]                                     = "SI";
            $this->aCountrySynonyms["solomon islands"]                              = "SB";
            $this->aCountrySynonyms["somalia"]                                      = "SO";
            $this->aCountrySynonyms["somalie"]                                      = "SO";
            $this->aCountrySynonyms["soudan"]                                       = "SD";
            $this->aCountrySynonyms["south africa"]                                 = "ZA";
            $this->aCountrySynonyms["south georgia and south sandwich islands"]     = "GS";
            $this->aCountrySynonyms["south korea"]                                  = "KR";
            $this->aCountrySynonyms["south sudan"]                                  = "SS";
            $this->aCountrySynonyms["spain"]                                        = "ES";
            $this->aCountrySynonyms["sri lanka"]                                    = "LK";
            $this->aCountrySynonyms["st kitts and nevis"]                           = "KN";
            $this->aCountrySynonyms["st vincent and grenadines"]                    = "VC";
            $this->aCountrySynonyms["sud-soudan"]                                   = "SS";
            $this->aCountrySynonyms["sudan"]                                        = "SD";
            $this->aCountrySynonyms["suisse"]                                       = "CH";
            $this->aCountrySynonyms["surinam"]                                      = "SR";
            $this->aCountrySynonyms["suriname"]                                     = "SR";
            $this->aCountrySynonyms["suède"]                                        = "SE";
            $this->aCountrySynonyms["svalbard and jan mayen"]                       = "SJ";
            $this->aCountrySynonyms["svalbard et jan mayen"]                        = "SJ";
            $this->aCountrySynonyms["swaziland"]                                    = "SZ";
            $this->aCountrySynonyms["sweden"]                                       = "SE";
            $this->aCountrySynonyms["switzerland"]                                  = "CH";
            $this->aCountrySynonyms["syria"]                                        = "SY";
            $this->aCountrySynonyms["syrie"]                                        = "SY";
            $this->aCountrySynonyms["são tomé and príncipe"]                        = "ST";
            $this->aCountrySynonyms["são tomé-et-príncipe"]                         = "ST";
            $this->aCountrySynonyms["sénégal"]                                      = "SN";
            $this->aCountrySynonyms["tadjikistan"]                                  = "TJ";
            $this->aCountrySynonyms["taiwan"]                                       = "TW";
            $this->aCountrySynonyms["tajikistan"]                                   = "TJ";
            $this->aCountrySynonyms["tanzania"]                                     = "TZ";
            $this->aCountrySynonyms["tanzanie"]                                     = "TZ";
            $this->aCountrySynonyms["taïwan"]                                       = "TW";
            $this->aCountrySynonyms["tchad"]                                        = "TD";
            $this->aCountrySynonyms["terres australes françaises"]                  = "TF";
            $this->aCountrySynonyms["territoire britannique de l'océan indien"]     = "IO";
            $this->aCountrySynonyms["territoire palestinien"]                       = "PS";
            $this->aCountrySynonyms["thailand"]                                     = "TH";
            $this->aCountrySynonyms["thaïlande"]                                    = "TH";
            $this->aCountrySynonyms["timor oriental"]                               = "TL";
            $this->aCountrySynonyms["timor-leste"]                                  = "TL";
            $this->aCountrySynonyms["togo"]                                         = "TG";
            $this->aCountrySynonyms["tokelau"]                                      = "TK";
            $this->aCountrySynonyms["tonga"]                                        = "TO";
            $this->aCountrySynonyms["trinidad and tobago"]                          = "TT";
            $this->aCountrySynonyms["trinidad et tobago"]                           = "TT";
            $this->aCountrySynonyms["tunisia"]                                      = "TN";
            $this->aCountrySynonyms["tunisie"]                                      = "TN";
            $this->aCountrySynonyms["turkey"]                                       = "TR";
            $this->aCountrySynonyms["turkmenistan"]                                 = "TM";
            $this->aCountrySynonyms["turkménistan"]                                 = "TM";
            $this->aCountrySynonyms["turks and caicos islands"]                     = "TC";
            $this->aCountrySynonyms["turquie"]                                      = "TR";
            $this->aCountrySynonyms["tuvalu"]                                       = "TV";
            $this->aCountrySynonyms["u.s. minor outlying islands"]                  = "UM";
            $this->aCountrySynonyms["u.s. virgin islands"]                          = "VI";
            $this->aCountrySynonyms["uganda"]                                       = "UG";
            $this->aCountrySynonyms["ukraine"]                                      = "UA";
            $this->aCountrySynonyms["united arab emirates"]                         = "AE";
            $this->aCountrySynonyms["united kingdom"]                               = "GB";
            $this->aCountrySynonyms["united states"]                                = "US";
            $this->aCountrySynonyms["uruguay"]                                      = "UY";
            $this->aCountrySynonyms["uzbekistan"]                                   = "UZ";
            $this->aCountrySynonyms["vanuatu"]                                      = "VU";
            $this->aCountrySynonyms["vatican city"]                                 = "VA";
            $this->aCountrySynonyms["vatican"]                                      = "VA";
            $this->aCountrySynonyms["venezuela"]                                    = "VE";
            $this->aCountrySynonyms["vietnam"]                                      = "VN";
            $this->aCountrySynonyms["vénézuéla"]                                    = "VE";
            $this->aCountrySynonyms["wallis and futuna"]                            = "WF";
            $this->aCountrySynonyms["wallis-et-futuna"]                             = "WF";
            $this->aCountrySynonyms["western sahara"]                               = "EH";
            $this->aCountrySynonyms["yemen"]                                        = "YE";
            $this->aCountrySynonyms["yémen"]                                        = "YE";
            $this->aCountrySynonyms["zambia"]                                       = "ZM";
            $this->aCountrySynonyms["zambie"]                                       = "ZM";
            $this->aCountrySynonyms["zimbabwe"]                                     = "ZW";
            $this->aCountrySynonyms["åland"]                                        = "AX";
            $this->aCountrySynonyms["égypte"]                                       = "EG";
            $this->aCountrySynonyms["émirats arabes unis"]                          = "AE";
            $this->aCountrySynonyms["équateur"]                                     = "EC";
            $this->aCountrySynonyms["érythrée"]                                     = "ER";
            $this->aCountrySynonyms["états-unis"]                                   = "US";
            $this->aCountrySynonyms["éthiopie"]                                     = "ET";
            $this->aCountrySynonyms["île bouvet"]                                   = "BV";
            $this->aCountrySynonyms["île christmas"]                                = "CX";
            $this->aCountrySynonyms["île de man"]                                   = "IM";
            $this->aCountrySynonyms["île heard et îles mcdonald"]                   = "HM";
            $this->aCountrySynonyms["île norfolk"]                                  = "NF";
            $this->aCountrySynonyms["îles caïmans"]                                 = "KY";
            $this->aCountrySynonyms["îles cocos"]                                   = "CC";
            $this->aCountrySynonyms["îles cook"]                                    = "CK";
            $this->aCountrySynonyms["îles féroé"]                                   = "FO";
            $this->aCountrySynonyms["îles malouines"]                               = "FK";
            $this->aCountrySynonyms["îles mariannes du nord"]                       = "MP";
            $this->aCountrySynonyms["îles marshall"]                                = "MH";
            $this->aCountrySynonyms["îles mineures éloignées des états-unis"]       = "UM";
            $this->aCountrySynonyms["îles salomon"]                                 = "SB";
            $this->aCountrySynonyms["îles turques-et-caïques"]                      = "TC";
            $this->aCountrySynonyms["îles vierges des états-unis"]                  = "VI";
            $this->aCountrySynonyms["îles vierges"]                                 = "VG";
            $this->aCountrySynonyms["îles åland"]                                   = "AX";

            if ( $this->storing )
                $this->memorize( 'country synonyms','countries',$this->aCountrySynonyms );
        }   /* Set the country synonyms */

        end:
    }   /* End of Mercator.countrySynonyms() ========================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Mercator.speak() ==================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Mercator.sing() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Mercator.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class Mercator ========================================================== */
/* ==================================================================================== */
?>