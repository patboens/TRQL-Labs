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
    {*file                  trql.APIHandler.class.php *}

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
namespace trql\apigateway;

use \trql\vaesoli\Vaesoli       as v;
use \trql\schema\Thing           as Thing;

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
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                        WikidataId. No equivalent. *} */
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


    /* ================================================================================ */
    /** {{*process( $aCall )=

        Processes the API call by invoking a handler function ([c]handlerFnc[/c])

        {*params
            $aCall      (array)     Associative array that sketches the API call.
                                    Received by reference; possibly updated upon
                                    return
        *}

        {*return
            (array)     API response (if any), or [c]null[/c] if no handler defined
                        for the service.
        *}

        {*abstract
            An [c]APIHandler[/c] is invoked by the [c]SmallAPIGW[/c] object upon service
            call.[br][br]

            You start defining as many handlers as you need and state which services
            it is supposed to handle.[br][br]

            Then you create a [c]SmallAPIGW[/c] object to which you pass all handlers
            it may invoke to handke the calls.[br][br]

            Then you ask the [c]SmallAPIGW[/c] to process the call, which really
            means to dispatch the call to the proper [c]APIHandler[/c]. The API
            Handler that has in charge the service is then called via its
            [c]process()[/c] method.[br][br]

            It does its job and returns the answer to the [c]SmallAPIGW[/c] which
            is then responsible to pack the response in a proper structure that will
            eventually be returned to the client.[br][br]

            API return codes are all maintained in trql.APIHandler.defines.php. Please
            refer to the list of HTTP status codes for an exhaustive list of
            possible values [url]https://en.wikipedia.org/wiki/List_of_HTTP_status_codes[/url].[br][br]

        *}

        {*example
        use \trql\vaesoli\Vaesoli           as v;
        use \trql\apigateway\APIHandler     as APIHandler;
        use \trql\apigateway\SmallAPIGW     as SmallAPIGW;

        $szSelf = null;

        {   |** Setting $szSelf **|
            if     ( isset( $_SERVER['PHP_SELF'] ) )
            {
                $szSelf = $_SERVER['PHP_SELF'];
            }
            elseif ( isset( $_SERVER['REQUEST_URI'] ) )
            {
                $szSelf = $_SERVER['REQUEST_URI'];
            }
            elseif ( isset( $_SERVER['SCRIPT_NAME'] ) )
            {
                $szSelf = $_SERVER['SCRIPT_NAME'];
            }
        }   |** Setting $szSelf **|


        |** Specialized handler: Quitus/TRQL Labs **|
        [b]$oQuitusHandler             = new APIHandler( 'accounts,customers,customer,invoices,invoice,offers,offer' );
        $oQuitusHandler->handlerFnc = 'quitusHandlerFnc';           |** Function to execute **|[/b]

        $oGW                        = new SmallAPIGW( [b]array( $oQuitusHandler )[/b] );
        $oGW->verbSlot              = 2;                            |** Slot in 'parts' where the verb (service name) is supposed to be **|

        // The Gateway will handle it and dispatch it to the proper handler
        $aResponse                  = $oGW->processCall( $szSelf ); |** Process the call **|

        // The Gateway will send the response to the client
        // Here, it will either send it in XML or in JSON
        // depending on the query string
        $oGW->send( $aResponse,array( 'type' => ( isset( $_GET['xml'] ) ? 'xml' : 'json' ) ) );

        [b]function quitusHandlerFnc( &$aCall,&$oHandler )
        {
            $tStart     = microtime( true );
            $szVerb     = $aCall['verb'];

            // Prepare a default response
            $aResponse  = array( 'request'  => $aCall['parts']          ,
                                 'verb'     => $szVerb                  ,
                                 'matchAt'  => -1                       ,
                                 'retcode'  => API_ERROR_FORBIDDEN      ,
                                 'response' => null                     ,
                                 'perf'     => -1                       ,
                               );

            switch ( strtolower( $szVerb ) )
            {
                // Fictitious API service
                case 'accounts' :
                    {
                        // Start by saying at which line you actually matched the
                        // service request (ideal for debugging situations)
                        $aResponse['matchAt'] = __LINE__;

                        // Then overwrite the [c]API_ERROR_FORBIDDEN[/c] error code
                        // by [c]API_ERROR_BAD_REQUEST[/c] : you will now need to
                        // check the parameters to determine whether the call was
                        // well-formed.
                        $aResponse['retcode'] = API_ERROR_BAD_REQUEST;
                        
                        // HERE YOU CHECK THE PARAMETERS (see how $aCall) is formed

                        // If all OK, you send the response with a code similar to:
                        $aResponse['retcode' ] = API_ERROR_SUCCESS;
                        $aResponse['response'] = "All OK";

                        // If NOT OK, you send the response with a code similar to:
                        $aResponse['retcode' ] = API_ERROR_PRECONDITION_FAILED;
                        $aResponse['response'] = "Error description";
                    }
                    break;
                default         :
                    {
                    }
                    break;
            }
        }[/b]
        *}

        *}}
    */
    /* ================================================================================ */
    public function process( &$aCall )
    /*------------------------------*/
    {
        $aResponse  = null;

        $szVerb     = strtolower( $aCall['verb'] );
        $szXML      = '';

        if ( ! empty( $this->handlerFnc ) && function_exists( $this->handlerFnc ) )
        {
            $szFnc = $this->handlerFnc;
            $aResponse = $szFnc( $aCall,$this );
        }   /* if ( ! empty( $this->handlerFnc ) && function_exists( $this->handlerFnc ) ) */

        return ( $aResponse );
    }   /* End of APIHandler.process() ================================================ */
    /* ================================================================================ */


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
