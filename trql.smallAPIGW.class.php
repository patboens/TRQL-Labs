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
    {*remark                A source of inspiration may come from the following Wikipedia
                            page [url]https://en.wikipedia.org/wiki/API_management[/url] *}

    {*seealso               @class.APIHandler *}

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

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    if ( ! defined( 'XML_CLASS_VERSION' ) )
        require_once( 'd:/websites/snippet-center/trql.xml.class.php' );


    *}}} */
/****************************************************************************************/
namespace trql\apigateway;

use \trql\vaesoli\Vaesoli           as v;
use \trql\gateway\Gateway           as Gateway;
use \trql\apigateway\APIHandler     as APIHandler;
use \trql\quitus\BankAccount   as BankAccount;
use \trql\xml\XML                   as XML;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'GATEWAY_CLASS_VERSION' ) )
    require_once( 'trql.gateway.class.php' );

if ( ! defined( 'APIHANDLER_CLASS_VERSION' ) )
    require_once( 'trql.apihandler.class.php' );

if ( ! defined( 'BANKACCOUNT_CLASS_VERSION' ) )
    require_once( 'trql.bankaccount.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.xml.class.php' );

defined( 'SMALLAPIGW_CLASS_VERSION' ) or define( 'SMALLAPIGW_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SmallAPIGW=

    {*desc

        A server that acts as an API front-end, receives API requests, enforces
        throttling and security policies, passes requests to the back-end
        service and then passes the response back to the requester. A gateway
        often includes a transformation engine to orchestrate and modify the
        requests and responses on the fly. A gateway can also provide
        functionality such as collecting analytics data and providing caching.
        The gateway can provide functionality to support authentication,
        authorization, security, audit and regulatory compliance.

    *}

    *}}

 */
/* ==================================================================================== */
class SmallAPIGW extends Gateway
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $downvoteCount                  = null;             /* {*property   $downvoteCount              (int)                           The number of downvotes this question, answer or comment has received
                                                                                                                                                from the community. *} */
    public      $parentItem                     = null;             /* {*property   $parentItem                 (Question)                      The parent of a question, answer or item in general. *} */
    public      $upvoteCount                    = null;             /* {*property   $upvoteCount                (int)                           The number of upvotes this question, answer or comment has received
                                                                                                                                                from the community. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                        Not found in Wikidata (yet: 06-02-21 10:56:29) *} */

    public      $bankAccount                    = null;             /* {*property   $bankAccount                (BankAccount)                   The bankAccount is EXPERIMENTAL. It may evolve in the future to a very
                                                                                                                                                different model. *} */

    public      $verbSlot                       = 1;                /* {*property   $verbSlot                   (integer)                       The slot that contains the API service verb. [c]1[/c] by default. *} */
    public      $szConfigFile                   = null;
    public      $aConfig                        = null;
    protected   $aRoutes                        = null;

    /* Deprecated code */
    public      $oHandler                       = null;         /* OLD WAY - Deprecated */
    public      $aHandlers                      = null;
    /* Deprecated code */


    /* ================================================================================ */
    /** {{*__construct( [$xHandler[,$szConfigFile]] )=

        Class constructor

        {*params
            $xHandler           (APIHandler|array)  The API Handler (the one thing that
                                                    really does the job) or an array of
                                                    handlers. Optional. [c]null[/c] by
                                                    default.
            $szConfigFile       (string)            A Small API Gateway configuration
                                                    file. Optional. [c]null[/c] by
                                                    default.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $xHandler = null,$szConfigFile = null )
    /*----------------------------------------------------------------*/
    {
        parent::__construct();

        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        if     ( is_array( $xHandler ) && count( $xHandler ) > 0 )
        {
            foreach( $xHandler as $xTheHandler )
            {
                $this->addHandler( $xTheHandler );
            }

            $this->addHandler( $xHandler );

        }
        elseif ( $xHandler instanceof APIHandler )
        {
            $this->addHandler( $xHandler );
        }

        if ( ! is_null( $szConfigFile ) && is_file( $szConfigFile ) )
        {
            $this->addInfo( __METHOD__ . "(): '{$szConfigFile}' FOUND" );

            $this->aConfig = $this->parseConfig( $this->szConfigFile = $szConfigFile );

            if ( isset( $this->aConfig['Routes'] ) )
            {
                $this->aRoutes = $this->aConfig['Routes']['Route'];
                $this->addInfo( __METHOD__ . "(): Routes found" );
            }
        }
        else
        {
            $this->addInfo( __METHOD__ . "(): '{$szConfigFile}' NOT FOUND" );
        }

        return ( $this );
    }   /* End of SmallAPIGW.__construct() ============================================ */
    /* ================================================================================ */


    protected function storeStats( &$szSelf,&$aCall )
    /*---------------------------------------------*/
    {
        //var_dump( $szSelf );
        //die();
        //var_dump( $aCall );
        //die();

    }   /* End of SmallAPIGW.storeStats() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*assembleArgs( $aArgs,$aValues )=

        Assemble arguments and values

        {*params
            $aArgs          (array)     The arguments
            $aValues        (array)     The values of the arguments
        *}

        {*return
            (array)     The assembled arguments along with their values
        *}

        {*example
            $aArgs      = array( 'param1','param2','param3' );
            $aValues    = array( 'value1','value2','value3' );

            $aParams    = assembleArgs( $aArgs,$aValues );
            var_dump( $aParams );

            // Result is
            // array (size=3)
            //   'param1' => string 'value1' (length=6)
            //   'param2' => string 'value2' (length=6)
            //   'param3' => string 'value3' (length=6)
        *}

        *}}
    */
    /* ================================================================================ */
    protected function assembleArgs( $aArgs,$aValues )
    /*----------------------------------------------*/
    {
        $aRetVal = null;

        if ( ( $iCount = count( $aArgs ) ) === count( $aValues ) )
        {
            for ( $i=0;$i<$iCount;$i++ )
                $aRetVal[$aArgs[$i]] = $aValues[$i];
        }   /* if ( ( $iCount = count( $aArgs ) ) === count( $aValues ) ) */

        return ( $aRetVal );
    }   /* End of SmallAPIGW.assembleArgs() =========================================== */
    /* ================================================================================ */


    protected function parse( &$szSelf )
    /*--------------------------------*/
    {
        $aCall = null;

        if ( ! empty( $szSelf ) )
        {
            $a = explode( '/',$szSelf );

            //var_dump( $_REQUEST );
            //var_dump( 'self=' . $szSelf,'$a exploded=',$a );
            //die();

            $aParts = null;

            foreach ( $a as $szStr )
            {
                if ( ! empty( $szStr ) )
                {
                    $szThePart = trim( $szStr );

                    if ( preg_match_all('/(\?|&)(?P<arg>[[:word:]]+)(=(?P<value>[[:word:]]+))?/',$szThePart,$aMatches,PREG_PATTERN_ORDER ) )
                    {
                        $aParams = $this->assembleArgs( $aMatches['arg']     ,
                                                        $aMatches['value']
                                                      );
                        foreach( $aParams as $szKey => $szValue )
                        {
                            $_GET[$szKey] = $szValue;
                        }
                    }   /* if ( preg_match_all('/(\?|&)(?P<arg>[[:word:]]+)(=(?P<value>[[:word:]]+))?/',$szThePart,$aMatches,PREG_PATTERN_ORDER ) ) */
                    else
                    {
                        $aParts[] = $szThePart;
                    }
                }   /* if ( ! empty( $szStr ) ) */
            }   /* foreach ( $a as $szStr ) */

            $szURL = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            //var_dump( $szURL );
            //var_dump( $aParts );
            //var_dump( $_GET );
            //die();

            $aCall = array( 'verb'      => $aParts[$this->verbSlot] ?? 'UNKNOWN',
                            'url'       => $szURL                               ,
                            'parts'     => $aParts                              ,
                            'cookies'   => $_COOKIE                             ,
                            'method'    => $_SERVER['REQUEST_METHOD']           ,
                            'get'       => $_GET                                ,
                            'post'      => $_POST                               ,
                            'server'    => $_SERVER
                          );
        }   /* if ( ! is_null( $szSelf ) ) */

        return ( $aCall );
    }   /* End of SmallAPIGW.parse() ================================================== */
    /* ================================================================================ */


    public function cashier( &$szSelf )
    /*-------------------------------*/
    {
        if ( ! $this->bankAccount instanceof BankAccount )
        {
            // Do something
        }
        // No cashier service YET (billing, ...)
    }   /* End of SmallAPIGW.cashier() ================================================ */
    /* ================================================================================ */


    public function checkVulnerability()
    /*--------------------------------*/
    {
    }   /* End of SmallAPIGW.checkVulnerability() ===================================== */
    /* ================================================================================ */


    public function checkVolume()
    /*--------------------------*/
    {

    }   /* End of SmallAPIGW.checkVolume() ============================================ */
    /* ================================================================================ */


    /* A URL leads to another URL */
    public function route( &$szSelf,&$aCall )
    /*-------------------------------------*/
    {
        $bRetVal = false;

        if ( is_array( $this->aRoutes ) && count( $this->aRoutes ) > 0 )
        {
            //var_dump( $aCall['url'] );
            //var_dump( $this->aRoutes );
            //$this->die();

            foreach( $this->aRoutes as $aRoute )
            {
                //var_dump( $this->aRoutes,$aRoute );
                //$this->die();

                if ( preg_match( $aRoute['Pattern'],$aCall['url'],$aMatches ) )
                {
                    //var_dump( 'MATCH: SHOULD GO TO ' . $aRoute['URL'],$aMatches );
                    //$this->die();

                    $this->addInfo( __METHOD__ . "(): 'rerouting match to {$aRoute['URL']}" );

                    if ( preg_match_all( '/%.*?%/',$aRoute['URL'],$aParts ) )
                    {
                        $aParts = $aParts[0];
                        //var_dump( $aParts );

                        /* Replace each instance of %<something>% with its
                           value in $aMatches */
                        foreach( $aParts as $szPart )
                        {
                            $szSlot = v::STR_Eliminate( $szPart,'%' );
                            //var_dump( $szPart,$szSlot );
                            $aRoute['URL'] = str_replace( $szPart,$aMatches[$szSlot] ?? 'NOT FOUND',$aRoute['URL'] );
                        }
                        //var_dump( $aRoute['URL'] );
                    }   /* if ( preg_match_all( '/%.*?%/',$aRoute['url'],$aParts ) ) */

                    $aCall['route'] = $aRoute['URL'];
                    //var_dump( "WILL RE-ROUTE TO {$aCall['route']}" );
                    //$this->die();
                    $this->addInfo( __METHOD__ . "(): 'rerouting to {$aCall['route']}" );
                    $bRetVal = true;
                }   /* if ( preg_match( $aRoute['pattern'],$aCall['url'] ) ) */
            }   /* foreach( $this->aRoutes as $aRoute ) */
        }   /* if ( is_array( $this->aRoutes ) && count( $this->aRoutes ) > 0 ) */

        //var_dump( $bRetVal );
        //die();

        return ( $bRetVal );
    }   /* End of SmallAPIGW.route() ================================================== */
    /* ================================================================================ */


    public function addHandler( $oHandler )
    /*-----------------------------------*/
    {
        if ( $oHandler instanceof APIHandler )
            $this->aHandlers[] = $oHandler;
    }   /* End of SmallAPIGW.addHandler() ============================================= */
    /* ================================================================================ */


    public function processCall( &$szSelf )
    /*-----------------------------------*/
    {
        $aCall = $this->parse( $szSelf );

        $aResponse = null;

        $this->checkVulnerability();
        $this->checkVolume();

        $this->cashier( $szSelf );                                  /* $aCall has split the request */

        $this->storeStats( $aCall,$szSelf );


        //var_dump( $aCall,$this->aHandlers );
        //var_dump( $aCall );
        //die();

        if ( ! $this->route( $szSelf,$aCall ) )                     /* If no routing happened */
        {
            if ( ! is_null( $szSelf ) )
            {
                //var_dump( $aCall );
                if ( ! is_null( $oHandler = $this->getHandler( $aCall['parts'][$this->verbSlot] ?? 'UNKNOWN' ) ) )
                {
                    //var_dump( "FOUND HANDLER: ",$oHandler );
                    //die();

                    $aResponse = $oHandler->process( $aCall );
                    //var_dump( $aResponse );
                    //die();
                }   /* if ( ! is_null( $oHandler = $this->getHandler( $aCall['parts'][$this->verbSlot] ?? 'UNKNOWN' ) ) ) */
            }   /* if ( ! is_null( $szSelf ) ) */
            else    /* Else of ... if ( ! is_null( $szSelf ) ) */
            {
                // ICI ON DOIT TRAVAILLER AU RETOUR DE CETTE METHODE MAIS AUSSI DU POINT DE VUE DE SES PARAMÈTRES
                $aResponse = $this->reportError();
            }    /* End of ... Else of ... if ( ! is_null( $szSelf ) ) */
        }   /* if ( ! $this->dispatch( $szSelf ) ) */
        else
        {
            header( 'Location: ' . $aCall['route'] );
            //var_dump( "ICI" );
            exit();
        }

        //var_dump( $aResponse );
        //die();

        return ( $aResponse );
    }   /* End of SmallAPIGW.processCall() ============================================ */
    /* ================================================================================ */


    //function send( $szService,&$szXML,$aParams = null )
    function send( $aResponse,$aParams = null )
    /*---------------------------------------*/
    {
        $szRetVal = '';

        $bSend  = $aParams['send'] ?? true;
        $szType = $aParams['type'] ?? 'json';

        if ( $bSend )
            ob_clean();

        $WithCDATA = true;

        if   ( is_string( $aResponse['response'] ) )
        {
            $szResponse = $aResponse['response'];
        }
        elseif ( is_array( $aResponse['response'] ) && count( $aResponse['response'] > 0 ) )
        {
            $szResponse = '';
            $WithCDATA  = false;

            //foreach( $aResponse['response'] as $xValue )
            //{
            //    $szResponse .= "<Item><![CDATA[" . (string) $xValue . "]]></Item>\n";
            //}
            $szResponse = $this->ArrayToXML( $aResponse['response'] );
        }
        elseif ( is_null( $aResponse['response'] ) )
            $szResponse = '';
        else
            $szResponse = serialize( $aResponse['response'] );

        $szRequest = isset( $aResponse['request'] )         ?
                     implode( ' ',$aResponse['request'] )   :
                     null;

        //die( htmlentities( ob_get_contents() ) );
        $szRetVal = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"                                         .
                      "<TRQLLabs rel=\"author\" authors=\"Pat Boens, Mathieu Goffin\" "                     .
                               "href=\"https://www.trql.fm/about-us/#patrick-boens\">\n"                    .
                         "<Copyright><![CDATA[Copyright Lato Sensu Management. All "                        .
                            "rights reserved. All intellectual property rights belong "                     .
                           "to Pat Boens. This service is delivered without any warranty "                  .
                           "of any kind. We do not accept liability for our websites "                      .
                           "being accurate, complete or up-to-date or for their "                           .
                           "contents. This statement is valid for all of the links "                        .
                           "on the websites and for all contents of the pages to "                          .
                           "which the links lead. We are not responsible for direct, "                      .
                           "indirect, incidental or consequential damages resulting "                       .
                           "from any defect, error or failure to perform.]]>"                               .
                         "</Copyright>\n"                                                                   .
                         "<Service name=\"{$aResponse['verb']}\">\n"                                        .
                           "<Request><![CDATA[{$szRequest}]]></Request>\n"  .
                         ( $WithCDATA
                            ?
                               "<Response "                                                                 .
                                  "match=\"{$aResponse['matchAt']}\" "                                      .
                                  "perf=\"{$aResponse['perf']}\" unit=\"sec\" "                             .
                                  "retcode=\"{$aResponse['retcode']}\">"                                    .
                                  "<![CDATA[{$szResponse}]]>"                                               .
                               "</Response>\n"
                            :
                               "<Response "                                                                 .
                                  "match=\"{$aResponse['matchAt']}\" "                                      .
                                  "perf=\"{$aResponse['perf']}\" unit=\"sec\" "                             .
                                  "retcode=\"{$aResponse['retcode']}\">"                                    .
                                  "{$szResponse}"                                                           .
                               "</Response>\n"
                         )                                                                                  .
                         "</Service>\n"                                                                                                                                 .
                      "</TRQLLabs>";

        //echo htmlentities( $szRetVal,ENT_QUOTES );
        //$this->die();

        if ( $bSend )
        {
            $szType = strtolower( trim( $szType ) );

            if ( $aResponse['retcode'] !== API_ERROR_SUCCESS )
                http_response_code( $aResponse['retcode'] - API_BASIS );

            //var_dump( $aResponse,$szType );
            //echo htmlentities( $szRetVal,ENT_QUOTES);
            //$this->die();

            switch( $szType )
            {
                case 'xml'  :   //var_dump( "RETOUR XML");
                                //$this->die();
                                header( "Content-type: text/xml" );
                                echo $szRetVal;
                                exit();
                                break;
                case 'json' :
                default     :   //var_dump( "RETOUR JSON");
                                //$this->die();
                                header( "Content-type: application/json" );
                                //echo htmlentities( $szRetVal,ENT_QUOTES);
                                echo $this->XMLtoJSON( $szRetVal );
                                //$this->die();
                                exit();
                                break;
            }
        }   /* if ( $bSend ) */

        return ( $szRetVal );
    }   /* End of SmallAPIGW.send() =================================================== */
    /* ================================================================================ */


    public function XMLtoJSON( $szXML )
    /*-------------------------------*/
    {
        $a = $this->XMLToArray( $szXML );
        return ( json_encode( $a ) );
    }   /* End of SmallAPIGW.XMLtoJSON() ============================================== */
    /* ================================================================================ */


    public function XMLtoJSONOLD( $szXML )
    /*-------------------------------*/
    {
        $xmlNode = @simplexml_load_string( $szXML );
        return ( json_encode( $this->XMLToArray( $xmlNode,array( "attributePrefix" => "__" ) ) ) );
    }   /* End of SmallAPIGW.XMLtoJSON() ============================================== */
    /* ================================================================================ */


    /* THIS method is already present in trql.utils.trait.php */
    public function XMLToArrayOLD( $xml,$options = array() )
    /*-------------------------------------------------*/
    {
        // 2021-02-25 $defaults = array(
        // 2021-02-25     'namespaceSeparator'    => ':',                             /* you may want this to be something other than a colon */
        // 2021-02-25     'attributePrefix'       => '@',                             /* to distinguish between attributes and nodes with the same name */
        // 2021-02-25     'alwaysArray'           => array(),                         /* array of xml tag names which should always become arrays */
        // 2021-02-25     'autoArray'             => true,                            /* only create arrays for tags which appear more than once */
        // 2021-02-25     'textContent'           => '$',                             /* key used for the text content of elements */
        // 2021-02-25     'autoText'              => true,                            /* skip textContent key if node has no attributes or child nodes */
        // 2021-02-25     'keySearch'             => false,                           /* optional search and replace on tag and attribute names */
        // 2021-02-25     'keyReplace'            => false                            /* replace values for above search values (as passed to str_replace()) */
        // 2021-02-25 );
        // 2021-02-25
        // 2021-02-25 $options = array_merge($defaults, $options);
        // 2021-02-25 $namespaces = $xml->getDocNamespaces();
        // 2021-02-25 $namespaces[''] = null; //add base (empty) namespace
        // 2021-02-25
        // 2021-02-25 //get attributes from all namespaces
        // 2021-02-25 $attributesArray = array();
        // 2021-02-25 foreach ($namespaces as $prefix => $namespace) {
        // 2021-02-25     foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
        // 2021-02-25         //replace characters in attribute name
        // 2021-02-25         if ($options['keySearch']) $attributeName =
        // 2021-02-25                 str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
        // 2021-02-25         $attributeKey = $options['attributePrefix']
        // 2021-02-25                 . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
        // 2021-02-25                 . $attributeName;
        // 2021-02-25         $attributesArray[$attributeKey] = (string)$attribute;
        // 2021-02-25     }
        // 2021-02-25 }
        // 2021-02-25
        // 2021-02-25 //get child nodes from all namespaces
        // 2021-02-25 $tagsArray = array();
        // 2021-02-25 foreach ($namespaces as $prefix => $namespace) {
        // 2021-02-25     foreach ($xml->children($namespace) as $childXml) {
        // 2021-02-25         //recurse into child nodes
        // 2021-02-25         $childArray = $this->XMLToArray($childXml, $options);
        // 2021-02-25
        // 2021-02-25         // Ce code a été mis en commentaire car la fonction each() est DEPRECATED en PHP 7.2.6
        // 2021-02-25         // 28-09-18 16:30:46
        // 2021-02-25         //list($childTagName, $childProperties) = each($childArray);
        // 2021-02-25
        // 2021-02-25         // Ce code a été remplacé par les 3 lignes suivantes le 28-09-18 16:31:04
        // 2021-02-25         $a__Keys = array_keys( $childArray);
        // 2021-02-25         $childTagName = $a__Keys[0];
        // 2021-02-25         $childProperties = $childArray[ $childTagName ];
        // 2021-02-25
        // 2021-02-25         //var_dump( $childTagName );
        // 2021-02-25         //var_dump( $childProperties );
        // 2021-02-25
        // 2021-02-25         //replace characters in tag name
        // 2021-02-25         if ($options['keySearch']) $childTagName =
        // 2021-02-25                 str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
        // 2021-02-25         //add namespace prefix, if any
        // 2021-02-25         if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;
        // 2021-02-25
        // 2021-02-25         if (!isset($tagsArray[$childTagName])) {
        // 2021-02-25             //only entry with this key
        // 2021-02-25             //test if tags of this type should always be arrays, no matter the element count
        // 2021-02-25             $tagsArray[$childTagName] =
        // 2021-02-25                     in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
        // 2021-02-25                     ? array($childProperties) : $childProperties;
        // 2021-02-25         } elseif (
        // 2021-02-25             is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
        // 2021-02-25             === range(0, count($tagsArray[$childTagName]) - 1)
        // 2021-02-25         ) {
        // 2021-02-25             //key already exists and is integer indexed array
        // 2021-02-25             $tagsArray[$childTagName][] = $childProperties;
        // 2021-02-25         } else {
        // 2021-02-25             //key exists so convert to integer indexed array with previous value in position 0
        // 2021-02-25             $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
        // 2021-02-25         }
        // 2021-02-25     }
        // 2021-02-25 }
        // 2021-02-25
        // 2021-02-25 //get text content of node
        // 2021-02-25 $textContentArray = array();
        // 2021-02-25 $plainText = trim((string)$xml);
        // 2021-02-25 if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;
        // 2021-02-25
        // 2021-02-25 //stick it all together
        // 2021-02-25 $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
        // 2021-02-25         ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;
        // 2021-02-25
        // 2021-02-25 //return node as array
        // 2021-02-25 return array(
        // 2021-02-25     $xml->getName() => $propertiesArray
        // 2021-02-25 );
    }   /* End of SmallAPIGW.XMLtoArray() ============================================= */
    /* ================================================================================ */


    protected function isAssoc( array $arr )
    /*------------------------------------*/
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }   /* End of SmallAPIGW.isAssoc() ================================================ */
    /* ================================================================================ */


    public function arrayToXML( $a )
    /*----------------------------*/
    {
        $oXML = new XML();

        return ( $oXML->arrayToXML( $a ) );
    }   /* End of SmallAPIGW.ArrayToXML() ============================================= */
    /* ================================================================================ */


    protected function reportError()
    /*----------------------------*/
    {
        die( __METHOD__ . " DOES NOT WORK YET");
    }   /* End of SmallAPIGW.reportError() ============================================ */
    /* ================================================================================ */


    protected function getHandler( $szClass )
    /*-------------------------------------*/
    {
        if ( is_array( $this->aHandlers ) && count( $this->aHandlers ) > 0 )
        {
            //var_dump("HERE");
            //die();
            /* Let's check if we have a specialized handler */
            foreach ( $this->aHandlers as $oHandler )
            {
                $aSupportedClasses = explode( ';',str_replace( ',',';',$oHandler->class ) );
                //var_dump( $szClass,$aSupportedClasses );
                //var_dump( in_array( $szClass,$aSupportedClasses ) );
                //die();

                //if ( $oHandler->class === $szClass )
                if ( in_array( $szClass,$aSupportedClasses ) )
                {
                    //var_dump( $oHandler->class . " MATCHES " . $szClass );
                    //die();
                    return ( $oHandler );
                }
            }   /* foreach ( $this->aHandlers as $oHandler ) */

            /* If we're here, then we haven't found any proper handler.
               Let's try to find a generic one */
            foreach ( $this->aHandlers as $oHandler )
            {
                if ( v::empty( $oHandler->class ) )
                    return ( $oHandler );
            }
        }

        return ( null );
    }   /* End of SmallAPIGW.getHandler() ============================================= */
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
    }   /* End of SmallAPIGW.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class SmallAPIGW ======================================================== */
/* ==================================================================================== */
?>