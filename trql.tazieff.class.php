<?php
/****************************************************************************************/

/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.tazieff.class.php *}
    {*purpose               Tazieff services (earthquakes) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-07-20 23:53 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    {*remark

        Such declarations should be made available in the php.ini file.

        Unfortunately, I don't know why, PHP overwrites these settings
        each time it gets restarted. That's the reason why I have documented
        them in here.

        [code]
            [Date]
            ; Defines the default timezone used by the date functions
            ; http://php.net/date.timezone
            date.timezone ="Europe/Brussels"

            ; http://php.net/date.default-latitude
            date.default_latitude = 50.3852051

            ; http://php.net/date.default-longitude
            date.default_longitude = 4.6582953
        [/code]

        geonames can be invoked with these values:
            [url]http://api.geonames.org/timezone?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]

        geonameId de Lato Sensu Management:
            [url]http://api.geonames.org/findNearby?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]
            [url]http://api.geonames.org/get?geonameId=8520400&username=demo&style=full[/url]

    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-07-20 23:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\tazieff;

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

defined( 'TAZIEFF_CLASS_VERSION' ) or define( 'TAZIEFF_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Tazieff=

    {*desc

        Access to earthquake information.

        The class has been named "Tazieff" in honor of Haroun Tazieff, Warsaw,
        11 May 1914 – Paris, 2 February 1998, who was a Polish, Belgian and
        French volcanologist and geologist. He was a famous cinematographer of
        volcanic eruptions and lava flows, and the author of several books on
        volcanoes. He was also a government adviser and Cabinet minister.

    *}

    {*doc

        [url]https://earthquake.usgs.gov/[/url]
        [url]https://earthquake.usgs.gov/fdsnws/event/1/#methods[/url]

    *}

    *}}
 */
/* ==================================================================================== */
class Tazieff extends Utility implements iContext
/*---------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                Wikidata ID. No equivalent. *} */


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

        return ( $this );
    }   /* End of Tazieff.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parse( $szXML )=

        Parses an XML return from [url]https://earthquake.usgs.gov/[/url]

        {*params
            $szXML      (string)        The XML to parse
        *}

        {*return
            (array)     An array of results
        *}

        *}}
    */
    /* ================================================================================ */
    public function parse( &$szXML )
    /*----------------------------*/
    {
        $aRetVal = null;

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        //if ( preg_match( '%<eventParameters\b[^>]*>(?P<xml>.*?)</eventParameters>%si',$szXML,$aMatches ) )
        //{
        //    $szXML = str_ireplace( array( 'catalog:' ),'',$aMatches['xml'] );
        //}
        //else
        {
            $iStartPos = vaesoli::STR_iPos( $szXML,'<event ' );
            $iEndPos   = vaesoli::STR_iPos( $szXML,'</eventParameters>' );
            //var_dump( $iStartPos );
            //var_dump( $iEndPos );
            $szXML = '<quakes>' . str_ireplace( array( 'catalog:' ),'',substr( $szXML,$iStartPos,$iEndPos-$iStartPos ) ) . '</quakes>';
            //echo $szXML;
           // $this->__die( "XML NOT found" );
        }

        if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                $oXPath->registerNamespace( 'anss'      ,'http://anss.org/xmlns/event/0.1' );
                $oXPath->registerNamespace( 'catalog'   ,'http://anss.org/xmlns/catalog/0.1' );
                $oXPath->registerNamespace( 'q'         ,'http://quakeml.org/xmlns/quakeml/1.2' );

                //var_dump( "Namespaces registered" );

                if ( ( $oColl = $oXPath->query( "//event" ) ) && $oColl->length > 0 )
                {
                    $aRetVal['resultsCount']    = $oColl->length;
                    $aResults                   = array();

                    foreach( $oColl as $oNode )
                    {
                        $aDescription   =
                        $szDescType     =
                        $szDescText     = null;

                        $aOrigin        =
                        $iTime          =
                        $fLatitude      =
                        $fLongitude     = null;

                        $iDepth         = null;

                        $aMagnitude     =
                        $fForce         =
                        $fUncertainty   = null;

                        $szType         = null;

                        if ( ( $o = $oXPath->query( "description/type",$oNode ) ) && $o->length > 0 )
                            $szDescType = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( "description/text",$oNode ) ) && $o->length > 0 )
                            $szDescText = $o->item(0)->nodeValue;

                        $aDescription = array( 'type' => $szDescType,
                                               'text' => $szDescText,
                                             );

                        if ( ( $o = $oXPath->query( "origin/time/value",$oNode ) ) && $o->length > 0 )
                            $iTime = strtotime( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( "origin/latitude/value",$oNode ) ) && $o->length > 0 )
                            $fLatitude = (float) ( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( "origin/longitude/value",$oNode ) ) && $o->length > 0 )
                            $fLongitude = (float) ( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( "origin/depth/value",$oNode ) ) && $o->length > 0 )
                            $iDepth = (int) ( $o->item(0)->nodeValue );

                        $aOrigin    = array( 'time'         => $iTime       ,
                                             'latitude'     => $fLatitude   ,
                                             'longitude'    => $fLongitude  ,
                                             'depth'        => $iDepth      ,
                                           );


                        if ( ( $o = $oXPath->query( "magnitude/mag/value",$oNode ) ) && $o->length > 0 )
                            $fForce = (float) $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( "magnitude/mag/uncertainty",$oNode ) ) && $o->length > 0 )
                            $fUncertainty = (float) $o->item(0)->nodeValue;

                        $aMagnitude = array( 'force'        => $fForce      ,
                                             'uncertainty'  => $fUncertainty,
                                           );


                        if ( ( $o = $oXPath->query( "type",$oNode ) ) && $o->length > 0 )
                            $szType = $o->item(0)->nodeValue;



                        $aResults[] = array( 'description'  => $aDescription,
                                             'origin'       => $aOrigin     ,
                                             'magnitude'    => $aMagnitude  ,
                                             'type'         => $szType      ,
                                           );
                    }   /* foreach( $o as $oNode ) */

                    $aRetVal['results'] = $aResults;
                }   /* if ( ( $o = $oXPath->query( "//item" ) ) && $o->length > 0 ) */
                else
                {
                    //var_dump( $szXML );
                }

                //var_dump( $aRetVal );
                //$this->__die( "STOP FOR NOW" );

            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( $oDom->LoadXML( $szXML ) ) */
        else
        {
            $this->__die( "Cannot load XML" );
        }

        end:

        return ( $aRetVal );
    }   /* End of Tazieff.parse() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*call( $szService,$aParams )=

        Call https://earthquake.usgs.gov/fdsnws/event/1/query?format=xml

        {*params
            $szService      (string)        The service to call
            $aParams        (array)         Parameters to be sent for @param.szService
        *}

        {*return
            (string)        The result of the @fnc.getURL call, which then will need
                            to be parsed
        *}

        *}}
    */
    /* ================================================================================ */
    public function call( $szService,$aParams )
    /*---------------------------------------*/
    {
        $szParams = '';

        foreach ( $aParams as $szKey => $xValue )
        {
            $szTParams .= "&{$szKey}={$xValue}";
            //$szParams .= '&' . $szKey . '=' . $xValue;
        }

        $szURL = "https://earthquake.usgs.gov/fdsnws/event/1/query?format=xml{$szParams}";
        //var_dump( $szURL );
        //var_dump( 'https://earthquake.usgs.gov/fdsnws/event/1/query?format=xml&starttime=2020-07-20&endtime=2020-07-26');
        //$this->__die( "EARLY STOP : CHECK URL");

        return ( $this->getURL( $szURL ) );
    }   /* End of Tazieff.call() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*search( $aParams )=

        Search all earthquakes

        {*params
            $aParams        (array)         Parameters to be sent

                                            sdate
                                            edate
                                            minmagnitude
                                            maxmagnitude

                                            Après ... je dois aussi permettre des latitudes et longitudes
        *}

        {*return
            (array)         An associative array of results
        *}

        *}}
    */
    /* ================================================================================ */
    public function search( $aParams )
    /*------------------------------*/
    {
        $aRetVal        = null;

        $szCacheFile    = $this->cacheName( __METHOD__,$aParams );

        if ( ! empty ( $aParams['sdate'] ) )
            $aParams['starttime']   = date( 'Y-m-d',$iTime = strtotime( $aParams['sdate'] ) );

        if ( ! empty ( $aParams['edate'] ) )
            $aParams['endtime']     = date( 'Y-m-d',$iTime = strtotime( $aParams['edate'] ) );
        else
            $aParams['endtime']     = $aParams['starttime'];

        if ( isset( $aParams['sdate'] ) )
            unset( $aParams['sdate'] );

        if ( isset( $aParams['edate'] ) )
            unset( $aParams['edate'] );


        /*
           Retrieve du cache intelligent ...

           En effet, tous les tremblements de terre du passé c'est OK : on peut
           se baser sur le cache. Par contre, si la date de fin est correspond à
           aujourd'hui ou dans le futur, alors le cache ne doit être valable que
           pour une durée TRES limitée.

           Dès lors, on calcule un TTL !

        */

        $iTTL = date( 'Ymd',strtotime( $aParams['endtime'] ) ) >= date( 'Ymd' ) ? 300 : PHP_INT_MAX;

        if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) )
        {
            //$this->__die( "ON A LE CACHE" );
            $aRetVal = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . '(): data obtained from ' . $szCacheFile );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            if ( ! empty( $szXML = $this->call( $szService = 'search',$aParams ) ) )
            {
                if ( is_array( $aTmp = $this->parse( $szXML ) ) )
                {
                    if ( is_array( $aTmp = $this->parse( $szXML ) ) )
                        $aRetVal = array_merge( array( 'service' => $szService ),$aTmp );
                    else
                        goto end;

                    if ( $this->storing )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                    }   /* if ( $this->storing ) */
                }   /* if ( is_array( $aTmp = $this->parse( $szXML ) ) ) */
            }   /* if ( ! empty( $szXML = $this->call( $szService = 'search',$aParams ) ) ) */

        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Tazieff.search() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected cacheName( $szMethod,$xParams[,$xAdditional] )=

        Computes the name of a .cache file based on parameters

        {*params
            $szMethod               (string)    Method associated to the cache
            $xParams                (mixed)     Any set of parameters that determine
                                                the name of the cache
            $xAdditional            (mixed)     Any set of additional parameters that
                                                may determine the name of the cache.
                                                Optional. [c]null[/c] by default
        *}

        {*return
            (string)        Name of a .cache file
        *}

        {*warning           12-11-20 12:14:42 : cannot process any other language
                            than French!
        *}

        *}}
    */
    /* ================================================================================ */
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
    }   /* End of Tazieff.cacheName() ================================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Tazieff.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Tazieff.sing() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of Tazieff.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Tazieff =========================================================== */
/* ==================================================================================== */
