<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php. In general the material
    presented here is available under the conditions of 
    https://creativecommons.org/licenses/by-sa/4.0/

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.smallAPIGW.class.php *}
    
    {*purpose               A server that acts as an API front-end, receives API
                            requests, enforces throttling and security policies, passes 
                            requests to the back-end service and then passes the
                            response back to the requester. A gateway often includes a 
                            transformation engine to orchestrate and modify the 
                            requests and responses on the fly. A gateway can also
                            provide functionality such as collecting analytics data 
                            and providing caching. The gateway can provide functionality
                            to support authentication, authorization, security, audit 
                            and regulatory compliance. *}
    
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-02-21 10:54 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              APIGateway *}

    {*remark                A source of inspiration may come from the following Wikipedia
                            page [url]https://en.wikipedia.org/wiki/API_management[/url] *}

    {*seealso               @class.smallAPIGW *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 06-02-21 10:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\apihandler;

use \trql\vaesoli\Vaesoli       as v;
use \trql\thing\Thing           as Thing;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'API_ERROR_SUCCESS' ) )
    require_once( 'trql.APIHandler.defines.php' );


defined( 'APIHANDLER_CLASS_VERSION' ) or define( 'APIHANDLER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class APIHandler=

    {*desc

        Handles API call(s)

    *}

 */
/* ==================================================================================== */
class APIHandler extends Thing
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                        Not found in Wikidata (yet: 06-02-21 10:56:29) *} */
    public      $class                          = '';               /* {*property   $class                      (string)                        Handler's class (e.g. 'portfolio' for handling 'portfolio' type of services *} */
    public      $handlerFnc                     = null;

    /* ================================================================================ */
    /** {{*__construct( [$szClass] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szClass = '' )
    /*----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->class = $szClass;

        return ( $this );
    }   /* End of APIHandler.__construct() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected defaultResponse( $iLine[,$szMessage] )=

        Creates a standard default response for a service

        {*params
            $iLine      (int)           Source code line where the service did match our
                                        code. This line number makes it easy to determine
                                        where one must search the code in case of an
                                        exception.
            $szMessage  (string)        Optional message. '[c]No results found[/c]' by
                                        default.
        *}

        {*return
            (string)        Default response in XML
        *}

        *}}
    */
    /* ================================================================================ */
    protected function defaultResponse( $iLine,$szMessage = 'No results found' )
    /*------------------------------------------------------------------------*/
    {
        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
        $szXML .= "<Response matchAt=\"{$iLine}\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
        $szXML .=     "<Message><![CDATA[{$szMessage}]]></Message>\n";
        $szXML .= "</Response>\n";

        return ( $szXML );
    }   /* End of APIHandler.defaultResponse() ======================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected errorResponse( $e,$iLine )=

        Creates a standard default response for a service

        {*params
            $e          (Exception)     Exception as recieved by the catcher
            $iLine      (int)           Source code line where the service did match our
                                        code. This line number makes it easy to determine
                                        where one must search the code in case of an
                                        exception.
        *}

        {*return
            (string)        Error response in XML
        *}

        *}}
    */
    /* ================================================================================ */
    protected function errorResponse( $e,$iLine )
    /*----------------------------------------*/
    {
        $iErrCode   = $e->getCode();
        $szMessage  = $e->getMessage();

        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
        $szXML .= "<Response matchAt=\"{$iLine}\" retcode=\"{$iErrCode}\">\n";
        $szXML .=     "<Message><![CDATA[{$szMessage}]]></Message>\n";
        $szXML .= "</Response>\n";

        return ( $szXML );
    }   /* End of APIHandler.errorResponse() ========================================== */
    /* ================================================================================ */


    /* SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS */
    public function process( &$aCall )
    /*------------------------------*/
    {
        $aResponse = null;

        $szVerb = strtolower( $aCall['verb'] );
        $szXML  = '';

        if ( ! empty( $this->handlerFnc ) && function_exists( $this->handlerFnc ) )
        {
            $szFnc = $this->handlerFnc;
            $aResponse = $szFnc( $aCall,$this );
        }   /* if ( ! empty( $this->handlerFnc ) && function_exists( $this->handlerFnc ) ) */


        /* 07-02-21 10:08:52 : j'ai mis tout le traitement en commentaires
           car ce code ne devrait pas se trouver ici mais plutôt dans une
           fonction générique, voire dans une classe étendue de APIHandler
           qui aurait une méthode "process" générale. Il faut encore réfléchir
           à cette question. */
        if ( false )        
        {
            /* ============================================================================ */
            /* All API verbs that are supported                                             */
            /* ============================================================================ */
            switch( $szVerb )
            {
                /* GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL */
                /* GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL */
                /* GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL - GENERAL */

                /* Final : checked on 13-12-20 23:28:26 */
                case 'guid'         :
                    {
                        $szXML      = $this->defaultResponse( __LINE__ );

                        $szGUID     = substr( md5( vaesoli::guid() ),0,random_int( 3,7 ) ) . '-' .
                                      substr( md5( vaesoli::guid() ),0,random_int( 2,5 ) ) . '-' .
                                      substr( md5( vaesoli::guid() ),0,random_int( 4,6 ) ) . '-' .
                                      substr( md5( vaesoli::guid() ),0,random_int( 2,6 ) ) . '-' .
                                      substr( md5( vaesoli::guid() ),0,random_int( 3,8 ) );

                        if ( ( $iLength = strlen( $szGUID ) ) < 40 )
                            $szGUID = substr( $szGUID . '-' . bin2hex( random_bytes( 40 - $iLength ) ),0,40 );
                        else
                            $szGUID = substr( $szGUID                                                 ,0,40 );

                        $szXML  = '';
                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                            $szXML .= "<Value><![CDATA[{$szGUID}]]></Value>\n";
                        $szXML .= "</Response>\n";

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 13-11-20 10:07:31 */
                case 'definitions'  :
                case 'definition'   :
                case 'define'       :
                    {
                        $szXML  = $this->defaultResponse( __LINE__ );

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) &&
                             ! empty( $szLang = $aCall['parts'][3] ?? null )
                           )
                        {
                            //var_dump( $szTerm,$szLang );

                            if ( ! defined( 'WORD_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.word.class.php' );

                            $szCategory = $aCall['parts'][4] ?? '';

                            $oWord = new Word();

                            if ( is_array( $aRetVal = $oWord->search( $szTerm,$szLang,$szCategory ) ) )
                            {

                                $szXML  = '';
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";

                                foreach(  $aRetVal as $szDefinition )
                                {
                                    $szXML .= "<Definition><![CDATA[{$szDefinition}]]></Definition>\n";
                                }   /* foreach(  $aRetVal as $szWord) */

                                $szXML .= "</Response>\n";

                            }   /* if ( is_array( $aRetVal = $oSynonym->search( $szTerm,$szLang,'' ) ) ) */
                        }   /* if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) && ... */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 13-11-20 10:07:31 */
                case 'synonyms'             :
                case 'synonym'              :
                    {
                        $szXML  = $this->defaultResponse( __LINE__ );

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) &&
                             ! empty( $szLang = $aCall['parts'][3] ?? null )
                           )
                        {
                            //var_dump( $szTerm,$szLang );

                            if ( ! defined( 'SYNONYM_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.synonym.class.php' );

                            $szCategory = $aCall['parts'][4] ?? '';

                            $oSynonym = new Synonym();

                            if ( is_array( $aRetVal = $oSynonym->search( $szTerm,$szLang,$szCategory ) ) )
                            {
                                $szXML  = '';
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";

                                foreach(  $aRetVal as $szSynonym )
                                {
                                    $szXML .= "<Synonym><![CDATA[{$szSynonym}]]></Synonym>\n";
                                }   /* foreach(  $aRetVal as $szSynonym ) */

                                $szXML .= "</Response>\n";

                            }   /* if ( is_array( $aRetVal = $oSynonym->search( $szTerm,$szLang,'' ) ) ) */
                        }   /* if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) && ... */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 08-11-20 20:16:45 */
                case 'glossary'             :
                    {
                        $szXML  = $this->defaultResponse( __LINE__ );

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) )
                        {
                            if ( ! defined( 'DEFINEDTERMSET_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.definedtermset.class.php' );

                            $oGlossary  = new DefinedTermSet();
                            $oGlossary->load();

                            if ( ! is_null( $aRetVal = $oGlossary->search( trim( $szTerm ) ) ) )
                            {
                                $szXML  = '';
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";

                                foreach( $aRetVal as $aReturn )
                                {
                                    //var_dump( $aReturn );
                                    $szXML .=    "<Term date=\"{$aReturn['date']}\" id=\"{$aReturn['id']}\"><![CDATA[{$aReturn['value']}]]></Term>\n";
                                }   /* foreach( $aRetVal as $aReturn ) */
                                $szXML .= "</Response>\n";
                            }   /* if ( ! is_null( $aRetVal = $oGlossary->search( trim( $szTerm ) ) ) ) */

                            //var_dump( $aCall );
                            //var_dump( $szTerm );
                            //die();
                        }
                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 16:38:13 */
                case 'myip'                 :
                    {
                        /* Default response */
                        $szXML  = $this->defaultResponse( __LINE__ );
                        $szIP   = null;

                        if ( ! empty( $szJSON = vaesoli::HTTP_GetURL( 'https://api.ipify.org/?format=json' ) ) )
                        {
                            $oJSON = json_decode( $szJSON );
                            $szIP = $oJSON->ip ?? null;
                        }   /* if ( ! empty( $szJSON = vaesoli::HTTP_GetURL( 'https://api.ipify.org/?format=json' ) ) ) */

                        if ( ! is_null( $szIP ) )
                        {
                            $szXML  = '';
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                            $szXML .=    "<IP type=\"extern\"><![CDATA[{$szIP}]]></IP>\n";
                            $szXML .=    "<IP type=\"remote-address\"><![CDATA[{$_SERVER['REMOTE_ADDR']}]]></IP>\n";
                            $szXML .= "</Response>\n";
                        }   /* if ( ! is_null( $szIP ) ) */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 16:38:13 */
                case 'geoip'                :
                    {
                        /* Default response */
                        $szXML  = $this->defaultResponse( __LINE__ );

                        // Tout le reste du code est foireux pour ce service !!!


                        if ( ! empty( $szIP = $aCall['parts'][2] ?? null ) )
                        {
                            if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                            $oMercator  = new Mercator();

                            try
                            {
                                if ( is_array( $aRetVal = $oMercator->geoIP( $szIP ) ) )
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .=     "<Message><![CDATA[geo info found]]></Message>\n";

                                    foreach( $aRetVal as $szKey => $xValue )
                                    {
                                        //var_dump( $szKey,$xValue );
                                        $szTag  = ucfirst( $szKey );
                                        $szXML .= "<{$szTag}><![CDATA[{$xValue}]]></{$szTag}>\n";
                                    }   /* foreach( $aRetVal as $szKey => $xValue ) */

                                    $szXML .= "</Response>\n";
                                }   /* if ( is_array( $aRetVal = $oMercator->geoIP( $szIP ) ) ) */
                            }
                            catch ( Exception $e )
                            {
                                $szXML = $this->errorResponse( $e,__LINE__ );
                            }

                            //var_dump( $szIP,$aRetVal );
                            //die();
                        }   /* if ( ! empty( $szID = $aCall['parts'][2] ?? null ) ) */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 16:38:13 */
                case 'geoname'              :
                    {
                        /* Default response */
                        $szXML  = $this->defaultResponse( __LINE__ );
                        $szID   = null;

                        if ( ! empty( $szID = $aCall['parts'][2] ?? null ) )
                        {
                            //var_dump( $szVerb . ' recognized' );
                            //var_dump( $szID );
                            //die();

                            if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                            $oMercator = new Mercator();

                            $aParams = array( 'geonameId' => $szID );

                            $aRetVal = null;

                            try
                            {
                                if ( is_array( $aRetVal = $oMercator->get( $aParams ) ) )
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .=     "<Message><![CDATA[geonameId found]]></Message>\n";

                                    if ( is_array( $aRetVal['results'] ) && count( $aRetVal['results'] ) > 0 )
                                    {
                                        foreach( $aRetVal['results'][0] as $szKey => $xValue )
                                        {
                                            $szTag = ucfirst( $szKey );
                                            $szXML .= "<{$szTag}><![CDATA[{$xValue}]]></{$szTag}>\n";
                                        }
                                        //var_dump( $aResult );
                                    }   /* if ( is_array( $aRetVal['results'] ) && count( $aRetVal['results'] ) > 0 ) */

                                    $szXML .= "</Response>\n";
                                }   /* if ( is_array( $aRetVal = $oMercator->get( $aParams ) ) ) */
                            }
                            catch ( Exception $e )
                            {
                                $szXML = $this->errorResponse( $e,__LINE__ );
                            }

                            //var_dump( $aRetVal );
                        }   /* if ( ! empty( $szID = $aCall['parts'][2] ?? null ) ) */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 16:38:13 */
                /* https://www.trql.fm/api/geo/<latitude>/<longitude> */
                case 'geo'                  :
                    {
                        /* Default response */
                        $szXML  = $this->defaultResponse( __LINE__ );

                        //var_dump( $aCall['parts'] );

                        /* Check if lat,long given (the regex checks whether we have floats */
                        if ( ( isset( $aCall['parts'][2] ) && preg_match( '/[-+]?[0-9]+(\.[0-9]+)?\z/',$aCall['parts'][2] ) ) &&
                             ( isset( $aCall['parts'][3] ) && preg_match( '/[-+]?[0-9]+(\.[0-9]+)?\z/',$aCall['parts'][3] ) )
                           )
                        {
                            $fLatitude  = (float) $aCall['parts'][2];
                            $fLongitude = (float) $aCall['parts'][3];

                            if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                            $oMercator  = new Mercator();
                            //$oMercator->remembering = false;
                            try
                            {
                                if ( is_array( $aRetVal = $oMercator->infoAt( $fLatitude,$fLongitude,1 /* 1 result */ ) ) )
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .=     "<Message><![CDATA[latitude,longitude found]]></Message>\n";

                                    if ( count( $aRetVal ) > 0 )
                                    {
                                        foreach( $aRetVal as $szKey => $xValue )
                                        {
                                            $szTag = ucfirst( $szKey );
                                            $szXML .= "<{$szTag}><![CDATA[{$xValue}]]></{$szTag}>\n";
                                        }   /* foreach( $aRetVal as $szKey => $xValue ) */
                                        //var_dump( $aResult );
                                    }   /* if ( count( $aRetVal ) > 0 ) */

                                    $szXML .= "</Response>\n";
                                }   /* if ( is_array( $aRetVal = $oMercator->infoAt( $fLatitude,$fLongitude,1 ) ) ) */
                            }
                            catch ( Exception $e )
                            {
                                $szXML = $this->errorResponse( $e,__LINE__ );
                            }

                            //var_dump( $fLatitude,$fLongitude,$aRetVal );
                        }   /* if ( ( isset( $aCall['parts'][2] ) && preg_match( '/[-+]?[0-9]+(\.[0-9]+)?\z/',$aCall['parts'][2] ) ) && ... */

                        //die();

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 16:38:13 */
                case 'reversegeo'           :
                case 'georeverse'           :
                    {
                        if ( ! defined( 'POSTALADDRESS_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.postaladdress.class.php' );

                        $oAddress = new postalAddress();
                        $oAddress->remembering = true;

                        /* Default response */
                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                        $szXML .=     "<Message><![CDATA[No results found]]></Message>\n";
                        $szXML .= "</Response>\n";

                        if ( ! empty( $szAddress = $aCall['parts'][2] ?? null ) )
                        {
                            try
                            {
                                if ( is_array( $aRetVal = $oAddress->reverseGeo( $szAddress ) ) )
                                {
                                    //var_dump( $oAddress->lastInfo );
                                    //die();
                                    $szXML  = "    <Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "    <Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .= "        <Message><![CDATA[{$szAddress} georeversed]]></Message>\n";
                                    $szXML .= "        <Latitude>{$aRetVal['latitude']}</Latitude>\n";
                                    $szXML .= "        <Longitude>{$aRetVal['longitude']}</Longitude>\n";
                                    $szXML .= "    </Response>\n";
                                }   /* if ( is_array( $aRetVal = $oAddress->reverseGeo( $szAddress ) ) ) */
                                //var_dump( $aRetVal );
                            }
                            catch ( Exception $e )
                            {
                                $szXML = $this->errorResponse( $e,__LINE__ );
                            }
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 17:06:45 */
                case 'translate'            :
                    {
                        /* Default response */
                        $szXML  = $this->defaultResponse( __LINE__,'Hey ... This verb is not programmed yet. Stay tuned!' );

                        if ( ! defined( 'POLYLOGOS_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.polylogos.class.php' );

                        $oTranslator = new PolyLogos();
                        $oTranslator->remembering = true;

                        if ( ! empty( $szText = $aCall['parts'][2] ?? null ) )
                        {
                            $szSrcLang      = null;
                            $szTargetLang   = $_GET['lang'] ?? 'en';

                            try
                            {
                                if ( is_array( $aRetVal = $oTranslator->translate( $szText,$szSrcLang,$szTargetLang ) ) )
                                {
                                    //var_dump( $aRetVal );
                                    //die();

                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .=     "<Message><![CDATA[polylogos translation]]></Message>\n";
                                    $szXML .=     "<Text><![CDATA[{$aRetVal['text']}]]></Text>\n";
                                    $szXML .=     "<Languages>\n";
                                        $szXML .=     "<Language type=\"source\"><![CDATA[{$szSrcLang}]]></Language>\n";
                                        $szXML .=     "<Language type=\"detected\"><![CDATA[{$aRetVal['detected_lang']}]]></Language>\n";
                                        $szXML .=     "<Language type=\"target\"><![CDATA[{$szTargetLang}]]></Language>\n";
                                    $szXML .=     "</Languages>\n";
                                    $szXML .=     "<Translation><![CDATA[{$aRetVal['translation']}]]></Translation>\n";
                                    $szXML .= "</Response>\n";

                                    //echo $szXML;
                                    //die();
                                }   /* if ( is_array( $aRetVal = $oTranslator->translate( $szText,$szSrcLang,$szTargetLang ) ) ) */
                                else
                                {
                                    $szXML  = $this->defaultResponse( __LINE__,'Unknown error' );
                                    //var_dump( $aRetVal );
                                    //die();
                                }
                            }
                            catch ( Exception $e )
                            {
                                $szXML = $this->errorResponse( $e,__LINE__ );
                            }
                        }
                        else
                        {
                            $szXML  = $this->defaultResponse( __LINE__,'No text to translate' );
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                /* Final : checked on 04-11-20 16:38:13 */
                case 'sms'                  :
                    {
                        var_dump( $aCall['parts'] );

                        if ( ! empty( $szPoneNumber = $aCall['parts'][2] ?? null ) &&
                             ! empty( $szText       = $aCall['parts'][3] ?? null ) )
                        {
                            var_dump( 'OK' );

                            if ( ! defined( 'SMS_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.sms.class.php' );

                            $oSMS = new SMS();
                            //var_dump( $oSMS );

                            if ( $bOK = $oSMS->send( $szText,$szPoneNumber ) )
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML .=     "<Message><![CDATA[SMS has been sent]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_UNAUTHORIZED. "\">\n";
                                $szXML .=     "<Message><![CDATA[SMS could not be sent]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }

                            echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                            exit();
                        }
                    }
                    break;
                case 'wikipedia'            :
                case 'wikipedia-search'     :
                case 'wikidata-entity'      :
                case 'wikidata-search'      :
                    {
                        /* Default response */
                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                        $szXML .=     "<Message><![CDATA[No results found]]></Message>\n";
                        $szXML .= "</Response>\n";

                        //var_dump( $szVerb . ' recognized' );
                        //var_dump( $aCall['parts'] );

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) )
                        {
                            if ( ! defined( 'WIKIPEDIA_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.wikipedia.class.php' );

                            $oWiki = new Wikipedia();

                            if     ( $szVerb === 'wikidata-entity' )
                            {
                                $oWiki->remembering = false;
                                $aRetVal    = $oWiki->getEntity( $szTerm );
                                //var_dump( $aRetVal );
                                //die();

                                $szXML  = "    <Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "    <Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML .= "        <Id><![CDATA[{$aRetVal['id']}]]></Id>\n";
                                $szXML .= "        <Url><![CDATA[{$aRetVal['url']}]]></Url>\n";
                                $szXML .= "        <Label><![CDATA[{$aRetVal['label']}]]></Label>\n";
                                $szXML .= "        <Description><![CDATA[{$aRetVal['description']}]]></Description>\n";

                                if ( is_array( $aRetVal['aliases'] ) && count( $aRetVal['aliases'] ) > 0 )
                                {
                                    $szXML .= "        <Aliases>\n";
                                    foreach( $aRetVal['aliases'] as $szAlias )
                                    {
                                        $szXML .= "             <Alias><![CDATA[{$szAlias}]]></Alias>\n";
                                    }
                                    $szXML .= "        </Aliases>\n";
                                }   /* if ( is_array( $aRetVal['aliases'] ) && count( $aRetVal['aliases'] ) > 0 ) */

                                if ( is_array( $aRetVal['properties'] ) && count( $aRetVal['properties'] ) > 0 )
                                {
                                    $szXML .= "        <Properties>\n";
                                    foreach( $aRetVal['properties'] as $szProperty => $aSetOfValues )
                                    {
                                        $aValues = $aSetOfValues['values'];
                                        //var_dump( "Values of property {$szProperty}",$aValues );
                                        //die();
                                        $szXML .= "             <Property id=\"{$szProperty}\">\n";
                                        if ( is_array( $aValues ) && count( $aValues ) > 0 )
                                        {
                                            //var_dump( $aValues );
                                            //die();
                                            $szXML .= "                 <Values>\n";
                                            foreach( $aValues as $xKey => $aValue )
                                            {
                                                //var_dump( $xKey,$aValue );
                                                if ( isset( $aValue['value'] ) )
                                                {
                                                    $szXML .= "                     <Value type=\"{$aValue['type']}\"><![CDATA[{$aValue['value']}]]></Value>\n";
                                                }
                                                else
                                                {
                                                    $szXML .= "                     <Value type=\"{$aValue['type']}\">\n";
                                                    var_dump( $aValue );
                                                    foreach( $aValue as $szKey => $szValue )
                                                    {
                                                        $szXML .= "                         <{$szKey}><![CDATA[{$szValue}]]></{$szKey}>\n";
                                                        //var_dump( $szKey,$szValue );
                                                    }
                                                    $szXML .= "                     </Value>\n";
                                                    //die();
                                                }
                                            }
                                            $szXML .= "                 </Values>\n";
                                        }
                                        $szXML .= "             </Property>\n";
                                    }
                                    $szXML .= "        </Properties>\n";
                                }   /* if ( is_array( $aRetVal['properties'] ) && count( $aRetVal['properties'] ) > 0 ) */

                                $szXML .= "    </Response>\n";
                            }   /* if     ( $szVerb === 'wikidata-entity' ) */
                            elseif ( $szVerb === 'wikidata-search' )
                            {
                                //$oWiki->remembering = false;
                                $aRetVal    = $oWiki->searchEntities( $szTerm,100 );

                                if ( is_array( $aRetVal ) && is_array( $aRetVal['results'] ) && count( $aRetVal['results'] ) > 0 )
                                {
                                    $szXML  = "    <Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "    <Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";

                                    foreach( $aRetVal['results'] as $aEntry )
                                    {
                                        $szXML .= "        <Entry id=\"{$aEntry['id']}\" conceptURI=\"{$aEntry['conceptURI']}\">\n";
                                            $szXML .= "        <Label><![CDATA[{$aEntry['label']}]]></Label>\n";
                                            $szXML .= "        <Description><![CDATA[{$aEntry['description']}]]></Description>\n";
                                        $szXML .= "        </Entry>\n";
                                    }

                                    $szXML .= "    </Response>\n";
                                }
                            }   /* End of elseif ( $szVerb === 'wikidata-search' ) */
                            elseif ( $szVerb === 'wikipedia' || $szVerb === 'wikipedia-search' )
                            {
                                /****************************************************************************/
                                /* Example: https://www.trql.fm/api/wikipedia/artificial intelligence?xml   */
                                /****************************************************************************/

                                $aRetVal = $oWiki->search( $szTerm );

                                if ( isset( $aRetVal['results'] ) )
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"1\" retcode=\"ERROR_SUCCESS\">\n";
                                        $szXML .=     "<Message><![CDATA[The service only works on the basis of English terms]]></Message>\n";
                                        $szXML .= "<Topic>\n";

                                            // Attention : on ne retourne PAS le texte de la page !!!
                                            //$aTags[] = 'text';

                                            if ( is_array( $aColl = $aRetVal['results'][$szTag = 'langlinks'] ) && count( $aColl ) > 0 )
                                            {
                                                $szXML .= "<{$szTag}>\n";
                                                foreach( $aColl as $aStruct )
                                                {
                                                    $szXML .= "<ll lang=\"{$aStruct['lang']}\" url=\"{$aStruct['url']}\"><![CDATA[{$aStruct['title']}]]></ll>\n";
                                                    //var_dump( $aStruct);
                                                }   /* foreach( $aColl as $aStruct ) */
                                                $szXML .= "</{$szTag}>\n";
                                            }

                                            /*------------------------------------------------------------------*/

                                            if ( is_array( $aColl = $aRetVal['results'][$szTag = 'categories'] ) && count( $aColl ) > 0 )
                                            {
                                                //var_dump( $aColl );
                                                //die();
                                                $szXML .= "<{$szTag}>\n";
                                                foreach( $aColl as $aStruct )
                                                {
                                                    $szXML .= "<cl sortkey=\"{$aStruct['sortkey']}\" hidden=\"{$aStruct['hidden']}\"><![CDATA[{$aStruct['title']}]]></cl>\n";
                                                }   /* foreach( $aColl as $aStruct ) */
                                                $szXML .= "</{$szTag}>\n";
                                            }

                                            /*------------------------------------------------------------------*/

                                            if ( is_array( $aColl = $aRetVal['results'][$szTag = 'links'] ) && count( $aColl ) > 0 )
                                            {
                                                //var_dump( $aColl );
                                                //die();
                                                $szXML .= "<{$szTag}>\n";
                                                foreach( $aColl as $aStruct )
                                                {
                                                    $szXML .= "<pl ns=\"{$aStruct['ns']}\" exists=\"{$aStruct['exists']}\"><![CDATA[{$aStruct['title']}]]></pl>\n";
                                                }   /* foreach( $aColl as $aStruct ) */
                                                $szXML .= "</{$szTag}>\n";
                                            }

                                            /*------------------------------------------------------------------*/

                                            $aColl = $aRetVal['results'][$szTag = 'templates'];
                                            //var_dump( $aColl );
                                            //die();
                                            $szXML .= "<{$szTag}>\n";
                                            foreach( $aColl as $aStruct )
                                            {
                                                $szXML .= "<tl ns=\"{$aStruct['ns']}\" exists=\"{$aStruct['exists']}\"><![CDATA[{$aStruct['title']}]]></tl>\n";
                                            }   /* foreach( $aColl as $aStruct ) */
                                            $szXML .= "</{$szTag}>\n";

                                            /*------------------------------------------------------------------*/

                                            $aColl = $aRetVal['results'][$szTag = 'images'];
                                            //var_dump( $aColl );
                                            //die();
                                            $szXML .= "<{$szTag}>\n";
                                            foreach( $aColl as $aStruct )
                                            {
                                                $szXML .= "<img>{$aStruct['file']}</img>\n";
                                            }   /* foreach( $aColl as $aStruct ) */
                                            $szXML .= "</{$szTag}>\n";

                                            /*------------------------------------------------------------------*/

                                            $aColl = $aRetVal['results'][$szTag = 'externallinks'];
                                            //var_dump( $aColl );
                                            //die();
                                            $szXML .= "<{$szTag}>\n";
                                            foreach( $aColl as $aStruct )
                                            {
                                                $szXML .= "<el><![CDATA[{$aStruct['url']}]]></el>\n";
                                            }   /* foreach( $aColl as $aStruct ) */
                                            $szXML .= "</{$szTag}>\n";

                                            /*------------------------------------------------------------------*/

                                            $aColl = $aRetVal['results'][$szTag = 'sections'];
                                            //var_dump( $aColl );
                                            //die();
                                            $szXML .= "<{$szTag}>\n";
                                            foreach( $aColl as $aStruct )
                                            {
                                                $szLine     = str_replace( '&_','&amp;_',strip_tags( $aStruct['line'] ) );
                                                $szTitle    = str_replace( '&_','&amp;_',strip_tags( $aStruct['title'] ) );
                                                $szXML .= "<s toclevel=\"{$aStruct['toclevel']}\" level=\"{$aStruct['level']}\" line=\"{$szLine}\" number=\"{$aStruct['number']}\" index=\"{$aStruct['index']}\" title=\"{$szTitle}\" offset=\"{$aStruct['offset']}\" anchor=\"{$aStruct['anchor']}\" />\n";
                                            }   /* foreach( $aColl as $aStruct ) */
                                            $szXML .= "</{$szTag}>\n";

                                            /*------------------------------------------------------------------*/

                                            $aColl = $aRetVal['results'][$szTag = 'iwlinks'];
                                            //var_dump( $aColl );
                                            //die();
                                            $szXML .= "<{$szTag}>\n";
                                            foreach( $aColl as $aStruct )
                                            {
                                                $szXML .= "<iw prefix=\"{$aStruct['prefix']}\" url=\"{$aStruct['url']}\"><![CDATA[{$aStruct['title']}]]></iw>\n";
                                            }   /* foreach( $aColl as $aStruct ) */
                                            $szXML .= "</{$szTag}>\n";

                                            /*------------------------------------------------------------------*/

                                            $aColl = $aRetVal['results'][$szTag = 'properties'];
                                            //var_dump( $aColl );
                                            //die();
                                            $szXML .= "<{$szTag}>\n";
                                            foreach( $aColl as $aStruct )
                                            {
                                                $szXML .= "<pp name=\"{$aStruct['name']}\"><![CDATA[{$aStruct['title']}]]></pp>\n";
                                            }   /* foreach( $aColl as $aStruct ) */
                                            $szXML .= "</{$szTag}>\n";

                                            /*------------------------------------------------------------------*/

                                        $szXML .= "</Topic>\n";
                                    $szXML .= "</Response>\n";

                                    //echo ( $szXML );
                                    //echo ( htmlentities( $szXML,ENT_QUOTES ) );
                                    //die();
                                }   /* if ( isset( $aRetVal['results'] ) ) */
                            }   /* elseif ( $szVerb === 'wikipedia' ) */
                        }   /* if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) ) */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'label'                :
                    {
                        /* Default response */
                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                        $szXML .=     "<Message><![CDATA[No results found]]></Message>\n";
                        $szXML .= "</Response>\n";

                        $szKey  =
                        $szLang = null;

                        //var_dump( $aCall );


                        if ( STR_StartWith( $aCall['parts'][2],'$' ) )
                        {
                            $szKey  = $aCall['parts'][2];
                            $szLang = $_GET['lang'] ?? 'en';
                        }
                        elseif ( STR_StartWith( $aCall['parts'][3],'$' ) )
                        {
                            $szKey  = $aCall['parts'][3];
                            $szLang = $aCall['parts'][2] ?? 'en';
                        }

                        if ( ! is_null( $szKey ) && ( ! is_null( $szLang ) ) )
                        {
                            if ( ! defined( 'LABEL_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.label.class.php' );

                            //var_dump( "LABEL HERE" );
                            //die();
                            $oLabel = new Label();

                            if ( ! empty( $szRetVal = $oLabel->seek( $szKey,$szLang ) ) )
                            {
                                //var_dump( "FOUND SOMETHING" );
                                //die();

                                $szXML  = "    <Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "    <Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML .= "        <Label lang=\"{$szLang}\"><![CDATA[{$szRetVal}]]></Label>\n";
                                $szXML .= "    </Response>\n";
                            }
                            else
                            {
                                //var_dump( "CANNOT FIND ANYTHING" );
                                //die();
                            }
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'parseaddress'         :
                    {
                        /* Default response */
                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                        $szXML .=     "<Message><![CDATA[No results found]]></Message>\n";
                        $szXML .= "</Response>\n";

                        if ( ! empty( $szAddress = $aCall['parts'][2] ?? null ) )
                        {
                            if ( ! defined( 'VOLTAIRE_CLASS_VERSION' ) )
                                require_once( 'd:/websites/snippet-center/trql.voltaire.class.php' );

                            $oV = new Voltaire();

                            if ( is_array( $aRetVal = $oV->parseAddress( $szAddress ) ) )
                            {
                                if ( array_key_exists( 'street' ,$aRetVal ) &&
                                     array_key_exists( 'box'    ,$aRetVal ) &&
                                     array_key_exists( 'city'   ,$aRetVal ) &&
                                     array_key_exists( 'country',$aRetVal )
                                   )
                                {
                                    $szGroups = implode( ',',array_keys( $aRetVal ) );
                                    $szXML  = "    <Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "    <Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .= "        <Address groups=\"{$szGroups}\">\n";

                                    $szXML .= "            <Group type=\"street\">\n";

                                        foreach( $aRetVal['street']['values'] as $aValue )
                                            $szXML .= "                <Value type=\"{$aValue['type']}\"><![CDATA[{$aValue['value']}]]></Value>\n";

                                    $szXML .= "            </Group>\n";

                                    $szXML .= "            <Group type=\"box\">\n";
                                    /* 07-08-20 10:33:21 : ce groupe est NULL pour l'instant */
                                    $szXML .= "            </Group>\n";

                                    $szXML .= "            <Group type=\"city\">\n";
                                        foreach( $aRetVal['city']['values'] as $aValue )
                                            $szXML .= "                <Value type=\"{$aValue['type']}\"><![CDATA[{$aValue['value']}]]></Value>\n";
                                    $szXML .= "            </Group>\n";

                                    $szXML .= "            <Group type=\"country\">\n";
                                        foreach( $aRetVal['country']['values'] as $aValue )
                                            $szXML .= "                <Value type=\"{$aValue['type']}\"><![CDATA[{$aValue['value']}]]></Value>\n";
                                    $szXML .= "            </Group>\n";

                                    //var_dump( "City:",$aRetVal['city'] );
                                    //var_dump( "Country:",$aRetVal['country'] );

                                    $szXML .= "        </Address>\n";
                                    $szXML .= "    </Response>\n";
                                }   /* if ( isset( $aRetVal['street' ] ) && ... */
                            }   /* if ( is_array( $aRetVal = $oV->parseAddress( $szAddress ) ) ) */
                        }   /* if ( ! empty( $szAddress = $aCall['parts'][2] ?? null ) ) */

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                case 'news'                 :
                    {
                        /****************************************************************************/
                        /* Example: http://www.trql.poc/api/news/intelligence%20artificielle?xml    */
                        /****************************************************************************/

                        if ( ! defined( 'NEWS_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.news.class.php' );

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) )
                        {
                            $oNews  = new News();
                            //$oNews->remembering = false;

                            //var_dump( $szTerm );

                            if ( is_array( $aRetVal = $oNews->search( $szTerm ) ) && isset( $aRetVal['results'] ) )
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"" . count( $aRetVal['results'] ) . "\" retcode=\"ERROR_SUCCESS\">\n";

                                foreach( $aRetVal['results'] as $aResult )
                                {
                                    $szID = $aResult['id'] ?? $oNews->guid();
                                    $szXML .= "<Item id=\"{$szID}\" utc=\"{$aResult['pubDate']}\" datetime=\"{$aResult['date']}\">\n";
                                        $szXML .= "<Author><![CDATA[{$aResult['author']}]]></Author>\n";
                                        $szXML .= "<Title><![CDATA[{$aResult['title']}]]></Title>\n";
                                        $szXML .= "<Summary><![CDATA[{$aResult['summary']}]]></Summary>\n";
                                        $szXML .= "<Content><![CDATA[{$aResult['body']}]]></Content>\n";
                                        $szXML .= "<Source><![CDATA[{$aResult['source']}]]></Source>\n";
                                        $szXML .= "<Url><![CDATA[{$aResult['url']}]]></Url>\n";
                                        $szXML .= "<Image><![CDATA[{$aResult['image']}]]></Image>\n";

                                        $szXML .= "<Categories>\n";

                                        foreach( $aResult['categories'] as $szCategory )
                                        {
                                            $szXML .= "<Category><![CDATA[{$szCategory}]]></Category>\n";
                                        }

                                        $szXML .= "</Categories>\n";

                                    $szXML .= "</Item>\n";
                                }

                                /*
                                    'categories' =>
                                    array (size=2)
                                */

                                $szXML .= "</Response>\n";
                            }
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                $szXML .=     "<Message><![CDATA[No results found]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }
                        }
                        else
                        {
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                            $szXML .=     "<Message><![CDATA[Term(s) undefined]]></Message>\n";
                            $szXML .= "</Response>\n";
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();

                        //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "()" );
                    }
                    break;
                case 'tazieff'              :
                case 'earthquakes'          :
                    {
                        /************************************************************************************************/
                        /* Example: http://www.trql.poc/api/earthquakes/?sdate=20200728&edate=20200729&magnitude=5&xml  */
                        /************************************************************************************************/

                        if ( isset( $_GET['sdate'] ) )
                            $szStartDate = STR_dionly( $_GET['sdate'] );
                        else
                            $szStartDate = date( 'Ymd',time() - 86400 );

                        if ( date( 'Ymd',strtotime( $szStartDate ) ) === '19700101' )
                            $szStartDate = date( 'Ymd',time() - 86400 );

                        /*----------------*/

                        if ( isset( $_GET['edate'] ) )
                            $szEndDate = STR_dionly( $_GET['edate'] );
                        else
                            $szEndDate = date( 'Ymd',time() );

                        if ( date( 'Ymd',strtotime( $szEndDate ) ) === '19700101' )
                            $szEndDate = date( 'Ymd',strtotime( $szStartDate ) + 86400 );

                        /*----------------*/

                        if ( $szStartDate > $szEndDate )
                        {
                            $szTmp          = $szStartDate;
                            $szStartDate    = $szEndDate;
                            $szEndDate      = $szTmp;
                        }

                        $iMagnitude     = null;
                        $szMagnitude    = $_GET['magnitude'] ?? null;

                        if ( ! is_null( $szMagnitude ) )
                            $iMagnitude = (int) $szMagnitude;

                        //var_dump( $szStartDate );
                        //var_dump( $szEndDate );
                        //var_dump( $iMagnitude );

                        if ( ! defined( 'TAZIEFF_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.tazieff.class.php' );


                        $oTazieff = new Tazieff();
                        //$oTazieff->remembering = false;

                        $aParams  = array( 'sdate'  => $szStartDate ,
                                           'edate'  => $szEndDate   ,
                                         );

                        if ( ! is_null( $iMagnitude ) )
                            $aParams['minmagnitude'] = $iMagnitude;

                        //var_dump( $aParams );

                        //$oTazieff->remembering = false;
                        if ( is_array( $aRetVal = $oTazieff->search( $aParams ) ) && count( $aRetVal ) > 0 )
                        {
                            //var_dump( $aRetVal );
                            //die();
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"" . count( $aRetVal['results'] ) . "\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML .= "<Earthquakes>\n";
                                /*
                                    array (size=4)
                                      'description' =>
                                        array (size=2)
                                          'type' => string 'earthquake name' (length=15)
                                          'text' => string '191 km NW of Hihifo, Tonga' (length=26)
                                      'origin' =>
                                        array (size=4)
                                          'time' => int 1595289521
                                          'latitude' => float -14.7994
                                          'longitude' => float -175.1298
                                          'depth' => int 44160
                                      'magnitude' =>
                                        array (size=2)
                                          'force' => float 4.8
                                          'uncertainty' => float 0.116
                                      'type' => string 'earthquake' (length=10)
                                */
                                foreach( $aRetVal['results'] as $aEarthquake )
                                {
                                    //var_dump( $aEarthquake );
                                    //die();

                                    $szDate = date( 'd-m-Y H:i:s',$aEarthquake['origin']['time'] );

                                    $szXML .= "<Quake type=\"{$aEarthquake['type']}\">\n";
                                        $szXML .=     "<Description type=\"{$aEarthquake['description']['type']}\"><![CDATA[{$aEarthquake['description']['text']}]]></Description>\n";
                                        $szXML .=     "<Origin utc=\"{$aEarthquake['origin']['time']}\" datetime=\"{$szDate}\" dateformat=\"DD-MM-YYYY hh:mm:ss\" depth=\"{$aEarthquake['origin']['depth']}\" depth-unit=\"m\" latitude=\"{$aEarthquake['origin']['latitude']}\" longitude=\"{$aEarthquake['origin']['longitude']}\" />\n";
                                        $szXML .=     "<Magnitude force=\"{$aEarthquake['magnitude']['force']}\" uncertainty=\"{$aEarthquake['magnitude']['uncertainty']}\" />\n";
                                    $szXML .= "</Quake>\n";
                                }
                                $szXML .= "</Earthquakes>\n";
                            $szXML .= "</Response>\n";
                        }
                        else
                        {

                        }
                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'mercator'            :
                    {
                        /************************************************************************************************/
                        /* Example: http://www.trql.poc/api/mercator/BE?xml                                   */
                        /************************************************************************************************/

                        if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                        $oMercator = new Mercator();

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) )
                        {
                            $aRetVal = $oMercator->search( $szTerm );

                            if ( isset( $aRetVal['results'] ) )
                            {
                                // Bon ... ici ... le formatage du résultat peut être challenging
                                // car le résultat est différent en fonction de la recherche
                                // Par exemple, si le résultat est une liste de pays, on a une
                                // array qui a une gueule à elle, si c'est sur une adresse, on a
                                // une autre gueule (aussi pour pays en clair (pas BE mais Belgique).
                                // Cela veut donc dire que c'est au coup par coup.


                                $aResponse = null;
                                foreach( $aRetVal['results'] as $szKey => $aResult )
                                {
                                    $aResponse[] = array( 'toponymName'         => $aResult['toponymName'           ] ?? null   ,
                                                          'name'                => $aResult['name'                  ] ?? null   ,
                                                          'geonameId'           => $aResult['geonameId'             ] ?? null   ,
                                                          'continent'           => $aResult['continent'             ] ?? null   ,
                                                          'capital'             => $aResult['capital'               ] ?? null   ,
                                                          'currency'            => $aResult['currency'              ] ?? null   ,
                                                          'languages'           => $aResult['languages'             ] ?? null   ,
                                                          'ISO-3166-1-alpha-3'  => $aResult['ISO-3166-1-alpha-3'    ] ?? null   ,
                                                          'ISO-3166-1-num'      => $aResult['ISO-3166-1-num'        ] ?? null   ,
                                                          'fr'                  => $aResult['fr'                    ] ?? null   ,
                                                          'en'                  => $aResult['en'                    ] ?? null   ,
                                                          'nl'                  => $aResult['nl'                    ] ?? null   ,
                                                          'de'                  => $aResult['de'                    ] ?? null   ,
                                                          'es'                  => $aResult['es'                    ] ?? null   ,
                                                          'it'                  => $aResult['it'                    ] ?? null   ,
                                                          'pt'                  => $aResult['pt'                    ] ?? null   ,
                                                          'flag'                => $aResult['flag'                  ] ?? null   ,
                                                          'group'               => $aResult['group'                 ] ?? null   ,
                                                          'areaInSqKm'          => $aResult['areaInSqKm'            ] ?? null   ,
                                                          'population'          => $aResult['population'            ] ?? null   ,
                                                          'box-lat-lng'         => $aResult['box-lat-lng'           ] ?? null   ,
                                                          'latitude'            => $aResult['latitude'              ] ?? null   ,
                                                          'longitude'           => $aResult['longitude'             ] ?? null   ,
                                                          'lat'                 => $aResult['latitude'              ] ?? null   ,
                                                          'lng'                 => $aResult['longitude'             ] ?? null   ,
                                                          'countryCode'         => $aResult['countryCode'           ] ?? null   ,       // ICI, JE DEVRAIS PRENDRE LE RESULTAT D'UN PAYS, et si j'ai pas, alors me baser sur CountryCode
                                                          'countryName'         => $aResult['countryName'           ] ?? null   ,
                                                          'fcl'                 => $aResult['fcl'                   ] ?? null   ,
                                                          'fcode'               => $aResult['fcode'                 ] ?? null   ,
                                                          'fclName'             => $aResult['fclName'               ] ?? null   ,
                                                          'fcodeName'           => $aResult['fcodeName'             ] ?? null   ,
                                                          'population'          => $aResult['population'            ] ?? null   ,
                                                          'adminCode1'          => $aResult['adminCode1'            ] ?? null   ,
                                                          'adminName1'          => $aResult['adminName1'            ] ?? null   ,
                                                          'asciiName'           => $aResult['asciiName'             ] ?? null   ,
                                                          'alternateNames'      => $aResult['alternateNames'        ] ?? null   ,
                                                          'elevation'           => $aResult['elevation'             ] ?? null   ,
                                                          'srtm3'               => $aResult['srtm3'                 ] ?? null   ,
                                                          'astergdem'           => $aResult['astergdem'             ] ?? null   ,
                                                          'continentCode'       => $aResult['continentCode'         ] ?? null   ,
                                                          'adminTypeName'       => $aResult['adminTypeName'         ] ?? null   ,
                                                          'adminCode2'          => $aResult['adminCode2'            ] ?? null   ,
                                                          'adminName2'          => $aResult['adminName2'            ] ?? null   ,
                                                          'adminCode3'          => $aResult['adminCode3'            ] ?? null   ,
                                                          'adminName3'          => $aResult['adminName3'            ] ?? null   ,
                                                          'adminCode4'          => $aResult['adminCode4'            ] ?? null   ,
                                                          'adminName4'          => $aResult['adminName4'            ] ?? null   ,
                                                          'timezone'            => $aResult['timezone'              ] ?? null   ,
                                                          'score'               => $aResult['score'                 ] ?? null   ,
                                                        );
                                    //var_dump( $aResult );
                                }
                            }
                        }

                        var_dump( $aResponse );

                        $oMercator->die("VERB recognized");
                    }
                    break;
                case 'interests'            :
                case 'mercator-interests'   :
                    {
                        /************************************************************************************************/
                        /* Example: http://www.trql.poc/api/interests/montpellier?xml                                   */
                        /************************************************************************************************/

                        if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                        if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) )
                        {
                            $oMercator = new Mercator();

                            $aRetVal = $oMercator->wikipedia( $szTerm );

                            if ( isset( $aRetVal['results'] ) )
                            {
                                $aTags[] = 'lang';
                                $aTags[] = 'title';
                                $aTags[] = 'summary';
                                $aTags[] = 'feature';
                                $aTags[] = 'countryCode';
                                $aTags[] = 'elevation';
                                $aTags[] = 'wikipediaUrl';
                                $aTags[] = 'thumbnailImg';
                                $aTags[] = 'rank';
                                $aTags[] = 'latitude';
                                $aTags[] = 'longitude';

                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"" . count( $aRetVal['results'] ) . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .= "<Interests>\n";

                                    $i = 0;
                                    foreach( $aRetVal['results'] as $aInterest )
                                    {
                                        $szXML .= "<Interest>\n";
                                            foreach ( $aTags as $szTag )
                                                $szXML .=     "<{$szTag}><![CDATA[" . $aRetVal['results'][$i][$szTag] . "]]></{$szTag}>\n";
                                        $szXML .= "</Interest>\n";
                                        $i++;
                                    }   /* foreach( $aRetVal['results'] as $aInterest ) */

                                    $szXML .= "</Interests>\n";
                                $szXML .= "</Response>\n";
                            }   /* if ( isset( $aRetVal['results'] ) ) */
                            else    /* Else of ... if ( isset( $aRetVal['results'] ) ) */
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                $szXML .=     "<Message><![CDATA[Term NOT found]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }    /* End of ... Else of ... if ( isset( $aRetVal['results'] ) ) */
                        }
                        else
                        {
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                            $szXML .=     "<Message><![CDATA[Term undefined]]></Message>\n";
                            $szXML .= "</Response>\n";
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'countryinfo'          :
                case 'country'              :
                    {
                        /************************************************************************************************/
                        /* Example: http://www.trql.poc/api/countryInfo/Belgium?xml                                     */
                        /************************************************************************************************/

                        if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                        $szCountry = $aCall['parts'][2] ?? null;
                        //var_dump( $szCountry );
                        //die();

                        {   /* Calling Mercator */
                            $oMercator = new Mercator();

                            $oMercator->remembering = false;
                            $aRetVal = $oMercator->country( $szCountry );
                            //var_dump( $aRetVal );
                            //$aRetVal = $oMercator->country();
                            //var_dump( $aRetVal );
                            //die();

                            if ( is_array( $aRetVal ) && count( $aRetVal ) > 0 )
                            {
                                $aTags[]        = 'id';
                                $aTags[]        = 'geonameId';
                                $aTags[]        = 'continent';
                                $aTags[]        = 'capital';
                                $aTags[]        = 'currency';
                                $aTags[]        = 'languages';
                                $aTags[]        = 'ISO-3166-1-alpha-3';
                                $aTags[]        = 'ISO-3166-1-num';
                                $aTags[]        = 'areaInSqKm';
                                $aTags[]        = 'population';
                                $aTags[]        = 'box-lat-lng';
                                $aTags[]        = 'postalCodesCount';
                                $aTags[]        = 'postalCodeMin';
                                $aTags[]        = 'postalCodeMax';
                                $aTags[]        = 'postalCodeFormat';
                                $aTags[]        = 'flag';
                                $aTags[]        = 'group';

                                $aLanguages     = null;

                                $aLanguages[]   = 'fr';
                                $aLanguages[]   = 'en';
                                $aLanguages[]   = 'nl';
                                $aLanguages[]   = 'de';
                                $aLanguages[]   = 'es';
                                $aLanguages[]   = 'it';
                                $aLanguages[]   = 'pt';
                                $aLanguages[]   = 'da';
                                $aLanguages[]   = 'sv';
                                $aLanguages[]   = 'no';
                                $aLanguages[]   = 'li';
                                $aLanguages[]   = 'pl';
                                $aLanguages[]   = 'cs';
                                $aLanguages[]   = 'sk';
                                $aLanguages[]   = 'hu';

                                $iResultsCount  = count( $aRetVal );
                                //var_dump( $iResultsCount );
                                //var_dump( $aRetVal );
                                //die();

                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"{$iResultsCount}\" retcode=\"ERROR_SUCCESS\">\n";

                                    foreach( $aRetVal as $szCode => $aCountry )
                                    {
                                        $szXML .= "<Country id=\"{$szCode}\">\n";

                                        //var_dump( $aCountry );
                                        //die();

                                        /*
                                          'names' =>
                                            array (size=15)
                                              'fr' =>
                                                array (size=2)
                                                  'value' => string 'Luxembourg' (length=10)
                                                  'cleaned' => string 'luxembourg' (length=10)
                                        */

                                        foreach ( $aTags as $szTag )
                                            $szXML .=     "<{$szTag}><![CDATA[" . $aCountry[$szTag] . "]]></{$szTag}>\n";

                                        foreach ( $aLanguages as $szLang )
                                        {
                                            $szXML .=     "<Name lang=\"{$szLang}\" cleaned=\"{$aCountry['names'][$szLang]['cleaned']}\"><![CDATA[{$aCountry['names'][$szLang]['value']}]]></Name>\n";
                                        }

                                        $szXML .= "</Country>\n\n";
                                    }

                                $szXML .= "</Response>\n";
                                //echo htmlentities( $szXML,ENT_QUOTES );
                                //die();
                            }
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                $szXML .=     "<Message><![CDATA[Country NOT found]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'time'                 :
                case 'timezone'             :
                    {
                        /************************************************************************************************/
                        /* Example: http://www.trql.poc/api/timezone/bruxelles?xml                                      */
                        /************************************************************************************************/

                        if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
                            require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

                        if ( ! is_null( $szLocation = $aCall['parts'][2] ?? null ) )
                        {
                            $oMercator = new Mercator();

                            if ( $aCall['verb'] === 'time' )
                                $aRetVal = $oMercator->time( $szLocation );
                            else
                                $aRetVal = $oMercator->timezone( $szLocation );

                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"1\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML .= "<Timezone id=\"{$aRetVal['results']['timezoneId']}\">\n";
                                $szXML .=     "<countryCode><![CDATA[{$aRetVal['results']['countryCode']}]]></countryCode>\n";
                                $szXML .=     "<countryName><![CDATA[{$aRetVal['results']['countryName']}]]></countryName>\n";
                                $szXML .=     "<latitude><![CDATA[{$aRetVal['results']['lat']}]]></latitude>\n";
                                $szXML .=     "<longitude><![CDATA[{$aRetVal['results']['lng']}]]></longitude>\n";
                                $szXML .=     "<dstOffset><![CDATA[{$aRetVal['results']['dstOffset']}]]></dstOffset>\n";
                                $szXML .=     "<gmtOffset><![CDATA[{$aRetVal['results']['gmtOffset']}]]></gmtOffset>\n";
                                $szXML .=     "<time><![CDATA[{$aRetVal['results']['time']}]]></time>\n";
                                $szXML .=     "<sunrise><![CDATA[{$aRetVal['results']['sunrise']}]]></sunrise>\n";
                                $szXML .=     "<sunset><![CDATA[{$aRetVal['results']['sunset']}]]></sunset>\n";
                                $szXML .= "</Timezone>\n";
                            $szXML .= "</Response>\n";
                        }
                        else
                        {
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                            $szXML .=     "<Message><![CDATA[Timezone undefined]]></Message>\n";
                            $szXML .= "</Response>\n";
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;


                /* Candidate to deletion */
                // 20200903 - 10:13 ... case 'wikipedia'            :
                // 20200903 - 10:13 ...     {
                // 20200903 - 10:13 ...         /****************************************************************************/
                // 20200903 - 10:13 ...         /* Example: http://www.trql.poc/api/wikipedia/artificial_intelligence?xml   */
                // 20200903 - 10:13 ...         /****************************************************************************/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...         if ( ! defined( 'WIKIPEDIA_CLASS_VERSION' ) )
                // 20200903 - 10:13 ...             require_once( 'd:/websites/snippet-center/trql.wikipedia.class.php' );
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...         if ( ! empty( $szTerm = $aCall['parts'][2] ?? null ) )
                // 20200903 - 10:13 ...         {
                // 20200903 - 10:13 ...             $oWiki      = new Wikipedia();
                // 20200903 - 10:13 ...             $aRetVal    = $oWiki->search( $szTerm );
                // 20200903 - 10:13 ...             //var_dump( $aRetVal );
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...             if ( isset( $aRetVal['results'] ) )
                // 20200903 - 10:13 ...             {
                // 20200903 - 10:13 ...                 $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                // 20200903 - 10:13 ...                 $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"1\" retcode=\"ERROR_SUCCESS\">\n";
                // 20200903 - 10:13 ...                     $szXML .=     "<Message><![CDATA[The service only works on the basis of English terms]]></Message>\n";
                // 20200903 - 10:13 ...                     $szXML .= "<Topic>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         // Attention : on ne retourne PAS le texte de la page !!!
                // 20200903 - 10:13 ...                         //$aTags[] = 'text';
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'langlinks'];
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<ll lang=\"{$aStruct['lang']}\" url=\"{$aStruct['url']}\"><![CDATA[{$aStruct['title']}]]></ll>\n";
                // 20200903 - 10:13 ...                             //var_dump( $aStruct);
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'categories'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<cl sortkey=\"{$aStruct['sortkey']}\" hidden=\"{$aStruct['hidden']}\"><![CDATA[{$aStruct['title']}]]></cl>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'links'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<pl ns=\"{$aStruct['ns']}\" exists=\"{$aStruct['exists']}\"><![CDATA[{$aStruct['title']}]]></pl>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'templates'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<tl ns=\"{$aStruct['ns']}\" exists=\"{$aStruct['exists']}\"><![CDATA[{$aStruct['title']}]]></tl>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'images'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<img>{$aStruct['file']}</img>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'externallinks'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<el><![CDATA[{$aStruct['url']}]]></el>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'sections'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szLine     = str_replace( '&_','&amp;_',strip_tags( $aStruct['line'] ) );
                // 20200903 - 10:13 ...                             $szTitle    = str_replace( '&_','&amp;_',strip_tags( $aStruct['title'] ) );
                // 20200903 - 10:13 ...                             $szXML .= "<s toclevel=\"{$aStruct['toclevel']}\" level=\"{$aStruct['level']}\" line=\"{$szLine}\" number=\"{$aStruct['number']}\" index=\"{$aStruct['index']}\" title=\"{$szTitle}\" offset=\"{$aStruct['offset']}\" anchor=\"{$aStruct['anchor']}\" />\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'iwlinks'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<iw prefix=\"{$aStruct['prefix']}\" url=\"{$aStruct['url']}\"><![CDATA[{$aStruct['title']}]]></iw>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         $aColl = $aRetVal['results'][$szTag = 'properties'];
                // 20200903 - 10:13 ...                         //var_dump( $aColl );
                // 20200903 - 10:13 ...                         //die();
                // 20200903 - 10:13 ...                         $szXML .= "<{$szTag}>\n";
                // 20200903 - 10:13 ...                         foreach( $aColl as $aStruct )
                // 20200903 - 10:13 ...                         {
                // 20200903 - 10:13 ...                             $szXML .= "<pp name=\"{$aStruct['name']}\"><![CDATA[{$aStruct['title']}]]></pp>\n";
                // 20200903 - 10:13 ...                         }   /* foreach( $aColl as $aStruct ) */
                // 20200903 - 10:13 ...                         $szXML .= "</{$szTag}>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                         /*------------------------------------------------------------------*/
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                     $szXML .= "</Topic>\n";
                // 20200903 - 10:13 ...                 $szXML .= "</Response>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                 //echo ( $szXML );
                // 20200903 - 10:13 ...                 //echo ( htmlentities( $szXML,ENT_QUOTES ) );
                // 20200903 - 10:13 ...                 //die();
                // 20200903 - 10:13 ...             }
                // 20200903 - 10:13 ...             else
                // 20200903 - 10:13 ...             {
                // 20200903 - 10:13 ...                 $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                // 20200903 - 10:13 ...                 $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                // 20200903 - 10:13 ...                 $szXML .=     "<Message><![CDATA[No results found]]></Message>\n";
                // 20200903 - 10:13 ...                 $szXML .=     "<Message><![CDATA[The service only works on the basis of English terms]]></Message>\n";
                // 20200903 - 10:13 ...                 $szXML .= "</Response>\n";
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...                 //var_dump( $aRetVal );
                // 20200903 - 10:13 ...                 //die( "Dying at line " . __LINE__ . " of " . __METHOD__ . "()" );
                // 20200903 - 10:13 ...             }
                // 20200903 - 10:13 ...         }
                // 20200903 - 10:13 ...         else
                // 20200903 - 10:13 ...         {
                // 20200903 - 10:13 ...             $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                // 20200903 - 10:13 ...             $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                // 20200903 - 10:13 ...             $szXML .=     "<Message><![CDATA[Term undefined]]></Message>\n";
                // 20200903 - 10:13 ...             $szXML .=     "<Message><![CDATA[The service only works on the basis of English terms]]></Message>\n";
                // 20200903 - 10:13 ...             $szXML .= "</Response>\n";
                // 20200903 - 10:13 ...         }
                // 20200903 - 10:13 ...
                // 20200903 - 10:13 ...         echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                // 20200903 - 10:13 ...         exit();
                // 20200903 - 10:13 ...     }
                // 20200903 - 10:13 ...     break;


















                /* MUSIC - MUSIC - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC */
                /* MUSIC - MUSIC - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC */
                /* MUSIC - MUSIC - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC  - MUSIC */
                case 'playlist'             :
                    {
                        /*  Examples :

                            https://www.trql.fm/api/playlist/?selection=soul
                            https://www.trql.fm/api/playlist/?selection=pop/rock&duration=3600
                            http://www.trql.poc/api/playlist/?selection=pop/rock&duration=3600&xml

                        */
                        if ( isset( $aCall['get']['selection'] ) )
                        {
                            $szSelection = $aCall['get']['selection'];

                            //var_dump( $aCall );
                            //var_dump( $szSelection );
                            //die();

                            //if ( preg_match('/(?P<field>(?:[[:alpha:]])+ ?) *(?P<bl1> *?)(?P<oper>\>|\<|\<=|\>=|=)(?P<bl2> *)(?P<value>[[:word:]]+)/i',$szSelection,$aMatches ) )
                            if ( preg_match('/(?P<field>(?:[[:alpha:]])+ ?) *(?P<bl1> *?)(?P<oper>\>=|\<=|\>|\<|=|\$)(?P<bl2> *)(?P<value>.*?(\z|&))/i',$szSelection,$aMatches ) )
                            {
                                //var_dump( $aMatches );
                                //die();
                                $szField    = trim( $aMatches['field'] );
                                $szOper     = trim( $aMatches['oper' ] );
                                $szValue    = trim( $aMatches['value'] );
                            }   /* if ( preg_match('/(?P<field>(?:[[:alpha:]])+ ?) *(?P<bl1> *?)(?P<oper>\>|\<|\<=|\>=|=)(?P<bl2> *)(?P<value>.*?(\z|&))/i',$szSelection,$aMatches ) ) */
                            else    /* Else of ...    /* if ( preg_match('/(?P<field>(?:[[:alpha:]])+ ?) .../i',$szSelection,$aMatches ) ) */
                            {
                            	$szField    = 'genre';
                            	$szOper     = '=';
                            	$szValue    = $szSelection;
                            }

                            $iDuration = 3600;

                            if ( isset( $aCall['get']['duration'] ) )
                                $iDuration = abs( (int) $aCall['get']['duration'] );

                            $iDuration = min( $iDuration,7200 );

                            //var_dump( $szOper );
                            //die();
                            $szCacheFile    = vaesoli::FIL_ResolveRoot( "/playlists/{$aCall['radioID']}/" . date( "YmdH" ) ) . ".selection." . md5( $szExpr = "{$szField}{$szOper}{$szValue}" ) . ".cache";

                            $aMatchingTracks = null;
                            $szMsg           = '';

                            /* If cache exists ... use cache */
                            if ( vaesoli::FIL_Exists( $szCacheFile ) )
                            {
                                $aMatchingTracks    = trql_radio_getHashFile( $szCacheFile );
                                //var_dump( 'Tracks come from cache: ' . $szExpr );
                                //die();
                                $szMsg .= 'Data from cache';
                            }   /* if ( vaesoli::FIL_Exists( $szCacheFile ) ) */

                            if ( ! is_array( $aMatchingTracks ) || count( $aMatchingTracks ) < 1 )
                            {
                                //var_dump( $szField );
                                //var_dump( $szValue );
                                //die();
                                $aMatchingTracks    = trql_radio_loadMatchingTracks( $szField,$szValue,$aCall['radioID'],$szOper );
                                trql_radio_saveHashFile( $szCacheFile,$aMatchingTracks );
                                $szMsg .= 'Data computed on ' . date( 'YmdHis' );
                                //var_dump( 'tracks have been computed' );
                            }   /* if ( ! is_array( $aMatchingTracks ) || count( $aMatchingTracks ) < 1 ) */

                            //die();

                            $iCount             = count( $aMatchingTracks );
                            $iAverageDuration   = trql_radio_averageDuration( $aMatchingTracks ) / 1000;
                            $iTracksNeeded      = ceil( $iDuration / $iAverageDuration );

                            $szID               = vaesoli::STR_dionly( uniqid( (string) ( microtime( true ) * 30029 ),true ) );

                            /* ===================================================================================== */
                            if ( is_array( $aMatchingTracks ) && count( $aMatchingTracks ) > 0 )
                            {   /* Prepare a subset of all the tracks we have: the subset will be stored in $aTracks */
                                // https://simple.wikipedia.org/wiki/List_of_prime_numbers#List_of_Mersenne_primes

                                {   /* Prepare a subset of all the tracks we have: the subset will be stored in $aTracks */
                                    /* ===================================================================================== */
                                    shuffle( $aMatchingTracks );        /* Put chaos in the whole reservoir of matching tracks */

                                    /* --------------------------------------------------------------------------------- */
                                    {   /* Select a random slice of all the tracks we can use */
                                        mt_srand( ( rand( 1,131071 ) * rand( 1,524287 ) ) % 30029 );

                                        $iIndex = mt_rand( 0,$iCount - 1 - ( ( $iTracksNeeded + 5 ) * 2 ));

                                        $aTracks = array_slice( $aMatchingTracks,$iIndex,( $iTracksNeeded + 5 ) * 2 );
                                    }   /* Select a random slice of all the tracks we can use */
                                    /* --------------------------------------------------------------------------------- */

                                    /* --------------------------------------------------------------------------------- */
                                    {   /* Order the tracks by Music Key (for good sequencing/mixing */
                                        $aFncRetVal = null;
                                        $aTracks    = trql_radio_sortTracksByMusicKey( $aTracks,$aFncRetVal );
                                    }   /* Order the tracks by Music Key (for good sequencing/mixing */
                                    /* --------------------------------------------------------------------------------- */
                                }   /* Prepare a subset of all the tracks we have: the subset will be stored in $aTracks */
                                /* ===================================================================================== */

                                $iTotalMS   = 0;
                                $aSelection = null;

                                foreach( $aTracks as $szKey => $aTrack )
                                {
                                    $aSelection[] = $aTrack;

                                    if ( ( $iTotalMS += (int) trql_radio_realDuration( $aTrack ) ) > $iDuration * 1000 )
                                        break;
                                }   /* foreach( $aTracks as $szKey => $aTrack ) */

                                //var_dump( $aSelection );
                                //die();

                                /* Now ... let's save this playlist on our common webvault (e:\webvault\) */
                                $szPlaylistFile = 'e:/webvault/playlist.' . vaesoli::FIL_KeepValidCharacters( "genre={$szSelection}" ) . ".{$iDuration}.{$szID}.hash";
                                trql_radio_saveHashFile( $szPlaylistFile,$aSelection );
                                //var_dump( $szPlaylistFile );
                                //die();

                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']} ... {$szSelection} for {$iDuration} sec]]></Request>\n";
                                $szXML .= "<Response id=\"{$szID}\" matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_SUCCESS . "\" duration=\"{$iTotalMS}\" unit=\"ms\" count=\"" . count( $aSelection ) . "\">\n";
                                $szXML .=     "<Reservoir count=\"{$iCount}\" average=\"{$iAverageDuration } sec\" needed=\"{$iTracksNeeded}\"><![CDATA[" . $szSelection . "]]></Reservoir>\n";

                                foreach ( $aSelection as $aTrack )
                                {
                                     $szXML .= "    <Track id=\"{$aTrack['compiled']}\">\n";
                                     $szXML .= "        <Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                     $szXML .= "        <Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                     $szXML .= "    </Track>\n";
                                }   /* foreach ( $aSelection as $aTrack ) */

                                $szXML .=     "<Message><![CDATA[All OK]]></Message>\n";
                                $szXML .= "</Response>\n";

                                echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                                exit();
                            }   /* if ( is_array( $aMatchingTracks ) && count( $aMatchingTracks ) > 0 ) */
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\" count=\"0\">\n";
                                $szXML .=     "<Message><![CDATA[No track found matching the selection. {$szMsg}]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }
                        }   /* if ( isset( $aCall['selection'] ) ) */
                        else
                        {
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\" count=\"0\">\n";
                            $szXML .=     "<Message><![CDATA[No track found]]></Message>\n";
                            $szXML .= "</Response>\n";
                        }

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();

                    }
                    break;
                case 'airpowers'            :
                    {
                        /************************************************************************************************/
                        /* Example: http://www.trql.poc/api/airpowers/20200701?xml                                      */
                        /************************************************************************************************/

                        $szDate = isset( $aCall['parts'][2] ) ? $aCall['parts'][2] : null;

                        if ( ! is_null( $szDate ) )
                            $tTime = DAT_stod( STR_dionly( trim( $szDate ) ) );
                        else
                            $tTime = time();

                        //var_dump( $tTime );
                        //var_dump( date( 'd-m-Y',$tTime ) );
                        //die();

                        if ( FIL_Exists( $szAirPowerFile = trql_radio_getAirPowerFile( $aCall['radioID'],$tTime ) ) )
                        {
                            if ( ! is_null( $aAirPowers = trql_radio_getHashFile( $szAirPowerFile ) ) )
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" count=\"" . count( $aAirPowers ) . "\" retcode=\"ERROR_SUCCESS\">\n";

                                foreach( $aAirPowers as $aTrack )
                                {
                                    $szXML .= "<Track id=\"{$aTrack['compiled']}\">\n";
                                    $szXML .=     "<Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                    $szXML .=     "<Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                    $szXML .=     "<Rating><![CDATA[{$aTrack['rating']}]]></Rating>\n";
                                    $szXML .= "</Track>\n";
                                }   /* foreach( $aAirPowers as $aTrack ) */
                            }   /* if ( ! is_null( $aAirPowers = trql_radio_getHashFile( $szAirPowerFile ) ) ) */
                            $szXML .= "</Response>\n";
                        }
                        else
                        {
                            var_dump( "" );
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                            $szXML .=     "<Message><![CDATA[No Air Power found]]></Message>\n";
                            $szXML .= "</Response>\n";
                        }
                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'artist'               :
                case 'tribute'              :
                    {
                        $szArtist = isset( $aCall['parts'][2] ) ? $aCall['parts'][2] : null;
                        if ( ! is_null( $szArtist ) )
                        {
                            if      ( $aCall['verb'] === 'artist' )
                            {
                                if ( ! is_null( $aTracks = trql_radio_searchTitleOrArtistInGeneralCatalogue( $aCall['radioID'],'artist',$szArtist,true /* EXACT match */ ) ) )
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    foreach( $aTracks as $aTrack )
                                    {
                                        $szXML .= "<Track id=\"{$aTrack['compiled']}\">\n";
                                        $szXML .=     "<Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                        $szXML .=     "<Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                        $szXML .= "</Track>\n";
                                    }
                                    $szXML .= "</Response>\n";

                                    echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                                    exit();
                                }
                                else
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                    $szXML .=     "<Message><![CDATA[No artist found]]></Message>\n";
                                    $szXML .= "</Response>\n";
                                    echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                                    exit();
                                }
                            }
                            elseif ( $aCall['verb'] === 'tribute' )
                            {
                                $iDurationInSec = 1200;

                                //die("LOOKING FOR A TRIBUTE?");

                                if ( isset( $_GET['duration'] ) )
                                    $iDurationInSec = (int) trim( $_GET['duration'] );

                                if ( $iDurationInSec < 150 )
                                    $iDurationInSec = 1200;

                                if ( ! is_null( $aTracks = trql_radio_tribute( $szArtist,$iDurationInSec,$aCall['radioID'] ) ) )
                                {
                                    //$o = trql_radio_getFileOfFunction( 'trql_radio_tribute' );
                                    //var_dump( $o );
                                    //die();
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    foreach( $aTracks as $aTrack )
                                    {
                                        $szXML .= "<Track id=\"{$aTrack['compiled']}\">\n";
                                        $szXML .=     "<Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                        $szXML .=     "<Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                        $szXML .= "</Track>\n";
                                    }
                                    $szXML .= "</Response>\n";
                                }
                                else
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                    $szXML .=     "<Message><![CDATA[Tribute cannot be built for '{$szArtist}']]></Message>\n";
                                    $szXML .= "</Response>\n";
                                }

                                echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                                exit();
                            }
                        }
        				else
        				{
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                            $szXML .=     "<Message><![CDATA[Missing artist]]></Message>\n";
                            $szXML .= "</Response>\n";
                            echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                            exit();
        				}
                        break;
        	        }
                case 'catalog'              :
                    {
                        $aTracks    = trql_radio_loadGeneralCatalog( $aCall['radioID'] );
                        $aGenres    = trql_radio_genres( $aCall['radioID'],$aTracks );
                        $iIPI       = trql_radio_ipi( count( $aTracks ) );

                        if ( isset( $aCall['parts'][2] ) && ! STR_Empty( $aCall['parts'][2] ) && $aCall['parts'][2] === 'backup' )
                        {
                            $szCatalogueFile = trql_radio_getCatalogueFilename( $aCall['radioID'] );

                            $aRetVal = trql_radio_createBackup( $szCatalogueFile );

                            if ( $aRetVal['success'] )
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML .=     "<Backup><![CDATA[" . basename( $aRetVal['file'] ) . "]]></Backup>\n";
                                $szXML .= "</Response>\n";
                            }
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_INTERNAL_SERVER_ERROR\">\n";
                                $szXML .=     "<Message><![CDATA[Backup could not be performed]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }
                        }
                        else
                        {
                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                $szXML  .= "<Catalog count=\"{$aGenres['catalog']}\" radio=\"{$aCall['radioID']}\" ipi=\"{$iIPI}\">\n";
                                foreach( $aGenres as $szGenre => $aData )
                                {
                                    if ( $szGenre !== 'catalog' )
                                        $szXML .= "<Genre name=\"{$szGenre}\" count=\"{$aData['count']}\" percent1=\"{$aData['%1']}\" percent2=\"{$aData['%2']}\" />\n";
                                }   /* foreach( $aGenres as $szGenre => $aData ) */
                                $szXML .= "</Catalog>\n";
                            $szXML .= "</Response>\n";
                        }
                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'ipi'                  :
                    {
                        $iIPI       = trql_radio_ipi( count( $aTracks = trql_radio_loadGeneralCatalog( $aCall['radioID'] ) ) );
                        $szXML      = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML     .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                        $szXML     .= "   <IPI>{$iIPI}</IPI\n";
                        $szXML     .= "</Response>\n";

                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                    }
                    break;
                case 'radio'                :
                    {
                        $szKey = isset( $aCall['parts'][2] ) ? $aCall['parts'][2] : null;
                        if ( ! is_null( $szKey ) )
                        {
                            // Ici, l'idée est de savoir si l'utilisateur est bien autorisé
                            // à faire cette opération MAIS 2 problèmes se présentent
                            // 1) api.php ... ne fait pas appel à QUICKApp et donc ... on n'a pas
                            //    d'objet $GLOBALS['goApp']
                            // 2) On n'a même pas de session à récupérer en allant directement à la
                            //    variable $_SESSION


                            //if ( $GLOBALS['goApp']->isMemberOf( 'trql' ) || $GLOBALS['goApp']->isMemberOf( 'quitus' ) )
                            //{
                            //
                            //}
                            if ( isset( $aCall['parts'][3] ) && ! STR_Empty( $aCall['parts'][3] ) && $aCall['parts'][3] === 'create' )
                            {
                                $szRadioDir = null;
                                if ( ! trql_radio_radioExists( $szKey,$szRadioDir ) )
                                {
                                    if ( trql_radio_createRadio( $aCall['radioID'],$szRadioDir ) )
                                    {
                                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                        $szXML .=     "<Message><![CDATA['{$szKey}' has been successfully created]]></Message>\n";
                                        $szXML .= "</Response>\n";
                                    }
                                    else
                                    {
                                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_INTERNAL_SERVER_ERROR\">\n";
                                        $szXML .=     "<Message><![CDATA['{$szKey}' could NOT be created]]></Message>\n";
                                        $szXML .= "</Response>\n";
                                    }
                                }
                                else
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_CONFLICT\">\n";
                                    $szXML .=     "<Message><![CDATA[The '{$szKey}' radio already exists]]></Message>\n";
                                    $szXML .= "</Response>\n";
                                }
                            }
                            elseif ( isset( $aCall['parts'][3] ) && ! STR_Empty( $aCall['parts'][3] ) && $aCall['parts'][3] === 'set' )
                            {
                                //var_dump( $aCall['parts'] );
                                //var_dump( $_GET );
                                //die();
                                if ( isset( $_GET['param'] ) && isset( $_GET['value'] ) )
                                {
                                    $szParam    = $_GET['param'];
                                    $szValue    = $_GET['value'];

                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    $szXML .=     "<Message><![CDATA[SET: we have understood what you requested but the code is not finished yet]]></Message>\n";
                                    $szXML .= "</Response>\n";

                                    //var_dump( $aCall['parts'] );
                                    //var_dump( $_GET );
                                    //echo htmlentities( $szXML );
                                    //die();
                                }
                                else
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_BAD_REQUEST\">\n";
                                    $szXML .=     "<Message><![CDATA[Missing parameters]]></Message>\n";
                                    $szXML .= "</Response>\n";
                                }
                            }
                            elseif ( ! STR_Empty( $aCall['parts'][3] ) && $aCall['parts'][3] === 'delete' )
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_NOT_IMPLEMENTED\">\n";
                                $szXML .=     "<Message><![CDATA[Not supported yet]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }
                        }
        				else
        				{
                            echo "<p>No key mentioned!</p>\n";
        				}
                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
        			}
        			break;
                case 'title'                :
                    {
                        $szTitle = isset( $aCall['parts'][2] ) ? $aCall['parts'][2] : null;
                        if ( ! is_null( $szTitle ) )
                        {
                            if ( ! is_null( $aTracks = trql_radio_searchTitleOrArtistInGeneralCatalogue( $aCall['radioID'],'title',$szTitle) ) )
                            {
                                $szXML  = "<Request><![CDATA[{$aCall['verb']}]]></Request>\n";
                                $szXML .= "<Response retcode=\"ERROR_SUCCESS\">\n";
                                foreach( $aTracks as $aTrack )
                                {
                                    $szXML .= "<Track id=\"{$aTrack['compiled']}\">\n";
                                    $szXML .=     "<Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                    $szXML .=     "<Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                    $szXML .= "</Track>\n";
                                }
                                $szXML .= "</Response>\n";
                            }
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$aCall['verb']}]]></Request>\n";
                                $szXML .= "<Response retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                $szXML .=     "<Message><![CDATA[No title found]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }

                            echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                            exit();
                        }
        				else
        				{
                            echo "<p>No title mentioned!</p>\n";
                            echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                            exit();
        				}

                    }
                    break;
                case 'track'                :
                    {
                        $szKey = isset( $aCall['parts'][2] ) ? $aCall['parts'][2] : null;
                        if ( ! is_null( $szKey ) )
                        {
                            //var_dump( $aCall['parts'] );
                            //die();

                            if ( ! is_null( $aTracks = trql_radio_searchTitleOrArtistInGeneralCatalogue( $aCall['radioID'],'compiled',$szKey ) ) )
                            {
                                $aTheTrack  = $aTracks[$szKey];
                                $szXML      = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";

                                if ( isset( $aCall['parts'][3] ) && ! STR_Empty( $aCall['parts'][3] ) && $aCall['parts'][3] === 'compatible' )
                                {
                                    $aLocalParams = array( 'title'      => $aTheTrack['title'    ],
                                                           'artist'     => $aTheTrack['artist'   ],
                                                           'radioID'    => $aCall['radioID']      ,
                                                           'algorithm'  => ALGO_ARTIST_KEY_ENERGY ,
                                                           'quarantine' => 0
                                                         );

                                    if ( ! is_null( $aCompatibleTracks = trql_radio_getSimilarTracks( $aLocalParams ) ) && count( $aCompatibleTracks ) > 0 )
                                    {
                                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                            $szXML .= "<Tracks>\n";
                                                foreach( $aCompatibleTracks as $aTrack )
                                                {
                                                    $szXML .= "<Track id=\"{$aTrack['compiled']}\">\n";
                                                        $szXML .= "<Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                                        $szXML .= "<Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                                    $szXML .= "</Track>\n";
                                                }
                                            $szXML .= "</Tracks>\n";
                                        $szXML .= "</Response>\n";
                                    }
                                    else
                                    {
                                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_NOT_FOUND\">\n";
                                        $szXML .=     "<Message><![CDATA[No track found]]></Message>\n";
                                        $szXML .= "</Response>\n";
                                    }
                                }
                                elseif ( isset( $aCall['parts'][3] ) && ! STR_Empty( $aCall['parts'][3] ) && $aCall['parts'][3] === 'set' )
                                {
                                    if ( isset( $_GET['param'] ) && isset( $_GET['value'] ) )
                                    {
                                        $szParam    = $_GET['param'];
                                        $szValue    = $_GET['value'];

                                        if ( isset( $aTheTrack[$szParam] ) )
                                        {
                                            $aTheTrack[$szParam] = $szValue;
                                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                            $szXML .=     "<Message><![CDATA[{$szParam} = '" . $szValue . "']]></Message>\n";
                                            $szXML .= "</Response>\n";
                                        }
                                        else
                                        {
                                            $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                            $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_BAD_REQUEST\">\n";
                                            $szXML .=     "<Message><![CDATA[Invalid parameter: {$szParam}]]></Message>\n";
                                            $szXML .= "</Response>\n";
                                        }

                                        // Et ici ... il faut sauver le catalogue !!!
                                        // Mais c'est EXTRÊMEMENT dangereux de permettre cela à tout le monde
                                        //var_dump( $aTrack );

                                    }
                                    else
                                    {
                                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                        $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_BAD_REQUEST\">\n";
                                        $szXML .=     "<Message><![CDATA[Missing parameters]]></Message>\n";
                                        $szXML .= "</Response>\n";
                                    }
                                }
                                elseif ( isset( $aCall['parts'][3] ) && ! STR_Empty( $aCall['parts'][3] ) && $aCall['parts'][3] === 'delete' )
                                {
                                    $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"API_ERROR_NOT_IMPLEMENTED\">\n";
                                    $szXML .=     "<Message><![CDATA[Not supported yet]]></Message>\n";
                                    $szXML .= "</Response>\n";
                                }
                                else
                                {
                                    $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"ERROR_SUCCESS\">\n";
                                    foreach( $aTracks as $aTrack )
                                    {
                                        //var_dump( $aTrack );
                                        //die();
                                        $szXML .= "<Track id=\"{$aTrack['compiled']}\">\n";
                                        $szXML .=     "<Title><![CDATA[{$aTrack['title']}]]></Title>\n";
                                        $szXML .=     "<Artist><![CDATA[{$aTrack['artist']}]]></Artist>\n";
                                        $szXML .=     "<Duration><![CDATA[{$aTrack['duration']}]]></Duration>\n";
                                        $szXML .=     "<Timing><![CDATA[{$aTrack['timing']}]]></Timing>\n";
                                        $szXML .=     "<Cover><![CDATA[{$aTrack['cover']}]]></Cover>\n";
                                        $szXML .=     "<Genre><![CDATA[{$aTrack['genre']}]]></Genre>\n";
                                        $szXML .=     "<Style><![CDATA[{$aTrack['style']}]]></Style>\n";
                                        $szXML .=     "<Mood><![CDATA[{$aTrack['mood']}]]></Mood>\n";
                                        $szXML .=     "<Instrumental><![CDATA[{$aTrack['instrumental']}]]></Instrumental>\n";
                                        $szXML .=     "<Energy><![CDATA[{$aTrack['energy']}]]></Energy>\n";
                                        $szXML .=     "<BPM><![CDATA[{$aTrack['bpm']}]]></BPM>\n";
                                        $szXML .=     "<Rhythm><![CDATA[{$aTrack['rhythm']}]]></Rhythm>\n";
                                        $szXML .=     "<MusicKey><![CDATA[{$aTrack['musickey']}]]></MusicKey>\n";
                                        $szXML .=     "<Comment><![CDATA[{$aTrack['comment']}]]></Comment>\n";
                                        $szXML .=     "<Keywords><![CDATA[{$aTrack['keywords']}]]></Keywords>\n";
                                        $szXML .=     "<Intro><![CDATA[{$aTrack['intro']}]]></Intro>\n";
                                        $szXML .=     "<Outro><![CDATA[{$aTrack['outro']}]]></Outro>\n";
                                        $szXML .=     "<StartAt><![CDATA[{$aTrack['startAt']}]]></StartAt>\n";
                                        $szXML .=     "<EndAt><![CDATA[{$aTrack['endAt']}]]></EndAt>\n";
                                        $szXML .=     "<Rating><![CDATA[{$aTrack['rating']}]]></Rating>\n";
                                        $szXML .=     "<DateAdded><![CDATA[{$aTrack['dateAdded']}]]></DateAdded>\n";
                                        $szXML .=     "<Lyrics><![CDATA[{$aTrack['lyrics']}]]></Lyrics>\n";
                                        $szXML .=     "<FadeOut><![CDATA[{$aTrack['fadeOut']}]]></FadeOut>\n";
                                        $szXML .=     "<CloudLocation><![CDATA[{$aTrack['cloudLocation']}]]></CloudLocation>\n";
                                        $szXML .=     "<Copyright><![CDATA[{$aTrack['copyright']}]]></Copyright>\n";
                                        $szXML .=     "<Role><![CDATA[{$aTrack['role']}]]></Role>\n";
                                        $szXML .=     "<Language><![CDATA[{$aTrack['lang']}]]></Language>\n";
                                        $szXML .=     "<Year><![CDATA[{$aTrack['prodYear']}]]></Year>\n";
                                        $szXML .=     "<VolumeAdjustment><![CDATA[{$aTrack['volumeAdjustment']}]]></VolumeAdjustment>\n";
                                        $szXML .=     "<File><![CDATA[{$aTrack['file']}]]></File>\n";
                                        $szXML .= "</Track>\n";
                                    }   /* foreach( $aTracks as $aTrack ) */
                                    $szXML .= "</Response>\n";
                                }
                            }
                            else
                            {
                                $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                                $szXML .= "<Response matchAt=\"" . __LINE__ . "\" retcode=\"" . API_ERROR_NOT_FOUND . "\">\n";
                                $szXML .=     "<Message><![CDATA[No track found]]></Message>\n";
                                $szXML .= "</Response>\n";
                            }

                            echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                            exit();
                        }
        				else
        				{
                            echo "<p>No key mentioned!</p>\n";
                            echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                            exit();
        				}
        			}
        			break;
                default                     :
                    {
                        /* In a case like this one: http://www.trql.poc/api/v2/pmo/
                           It simply means that we are testing the OpenPMO API
                        */
                        if ( count( $aCall['parts'] ) > 2 )
                        {
                            switch( $aCall['parts'][2] )
                            {
                                case 'pmo' :
                                    {
                                        /* Bon ... on ne fait rien de bien sérieux ...
                                           Pour commencer cette intégration d'API, on fait
                                           juste une réponse bidon qui, au fond, dit ...
                                           "Ouais ... j'ai compris que tu appelais un service
                                           lié à un PMO" */
                                        /* Ce serait encore mieux si je pouvais envoyer la réponse
                                           sous forme d'array associative qui serait transformer
                                           en XML automatiquement */
                                        echo $this->send( $aCall['verb']                                                                                ,
                                                         createResponse( $aCall['verb'] = $aCall['parts'][2],$szRetCode = ERROR_SUCCESS,$szBody = "blablabla" ),
                                                         array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                                        exit();
                                    }
                            }
                        }

                        $szXML  = "<Request><![CDATA[{$_SERVER['REQUEST_URI']}]]></Request>\n";
                        $szXML .= "<Response retcode=\"ERROR_CODE\">\n";
                        $szXML .=     "<Message><![CDATA[Unrecognized API verb: {$aCall['verb']}]]></Message>\n";
                        $szXML .= "</Response>\n";



                        echo $this->send( $aCall['verb'],$szXML,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );
                        exit();
                        break;
                    }
        			break;
            }   /* switch( $aCall['verb'] ) */
            /* ============================================================================ */
            /* All API verbs that are supported                                             */
            /* ============================================================================ */
        }

        return ( $aResponse );
    }   /* End of APIHandler.process() =============================================== */
    /* ================================================================================ */
    /* SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS */


    /* La question a se poser est de savoir si c'est le Gateway ou le Handler qui
       doit envoyer la réponse. Je pense que c'est plutôt le GW comme fin de processus
       de type (vérification de sortie - analogie du magasin. A voir ! */
    public function send( $szService,&$szXML,$aParams = null )
    /*------------------------------------------------------*/
    {
        if ( isset( $aParams['send'] ) )
            $bSend = $aParams['send'];
        else
            $bSend = true;

        if ( isset( $aParams['type'] ) )
            $szType = $aParams['type'];
        else
            $szType = 'json';

        if ( $bSend )
            ob_clean();

        // TOUT LE TEXTE ICI, SI ON FAIT UNE CLASSE GENERIQUE, DOIT ETRE PERSONNALISABLE

        //die( htmlentities( ob_get_contents() ) );
        $szXML  =   "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"                     .
                    "<LSTRQLRadio rel=\"author\" author=\"Pat Boens\" "                 .
                               "href=\"https://www.trql.fm/about-us/#patrick-boens\">\n".
                        "<Copyright><![CDATA[Copyright Lato Sensu Management. All "     .
                        "rights reserved. All intellectual property rights belong "     .
                        "to Pat Boens. This service is delivered without any warranty " .
                        "of any kind. We do not accept liability for our websites "     .
                        "being accurate, complete or up-to-date or for their "          .
                        "contents. This statement is valid for all of the links "       .
                        "on the websites and for all contents of the pages to "         .
                        "which the links lead. We are not responsible for direct, "     .
                        "indirect, incidental or consequential damages resulting "      .
                        "from any defect, error or failure to perform.]]>"              .
                        "</Copyright>\n"                                                .
                        "<Service name=\"{$szService}\">\n"                             .
                            $szXML                                                      .
                        "</Service>\n"                                                  .
                    "</LSTRQLRadio>";

        $szRetVal   = null;

        if ( $bSend )
        {
            $szType     = strtolower( trim( $szType ) );

            switch( $szType )
            {
                case 'xml'  :   header( "Content-type: text/xml" );
                                $szRetVal = $szXML;
                                break;
                case 'json' :
                default     :   header( "Content-type: application/json" );
                                $szRetVal = $this->XMLtoJSON( $szXML );
                                break;
            }
        }

        return ( $szRetVal );
    }   /* End of APIHandler.send() =================================================== */
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

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of APIHandler.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class APIHandler ======================================================== */
/* ==================================================================================== */
