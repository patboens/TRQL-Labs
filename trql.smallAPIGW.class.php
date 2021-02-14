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

    The code of this class has been generated by

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
    {*remark                A source of inspiration may come from the following Wikipedia
                            page [url]https://en.wikipedia.org/wiki/API_management[/url] *}

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

    *}}} */
/****************************************************************************************/
namespace trql\smallAPIGW;

use \trql\vaesoli\Vaesoli           as v;
use \trql\gateway\Gateway           as Gateway;
use \trql\apihandler\APIHandler     as APIHandler;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'GATEWAY_CLASS_VERSION' ) )
    require_once( 'trql.gateway.class.php' );

if ( ! defined( 'APIHANDLER_CLASS_VERSION' ) )
    require_once( 'trql.apihandler.class.php' );

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

    public      $oHandler                       = null;         /* OLD WAY */
    public      $aHandlers                      = null;




    /* ================================================================================ */
    /** {{*__construct( $xHandler )=

        Class constructor

        {*params
            $xHandler           (APIHandler|array)  The API Handler (the one thing that
                                                    really does the job) or an array of
                                                    handlers
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $xHandler = null )
    /*-------------------------------------------*/
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

    protected function assembleArgs( $aArgs,$aValues )
    /*--*/
    {
        $aRetVal = null;        

        if ( ( $iCount = count( $aArgs ) ) === count( $aValues ) )
        {
            for ( $i=0;$i<$iCount;$i++ )
                $aRetVal[$aArgs[$i]] = $aValues[$i];
        }

        return ( $aRetVal );
    }

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

            //var_dump( $aParts );
            //var_dump( $_GET );
            //die();

            $aCall = array( 'verb'      => $aParts[1] ?? 'UNKNOWN'              ,
                            'parts'     => $aParts                              ,
                            'cookies'   => $_COOKIE                             ,
                            'get'       => $_GET                                ,
                            'post'      => $_POST                               ,
                            'server'    => $_SERVER
                          );
        }   /* if ( ! is_null( $szSelf ) ) */

        return ( $aCall );
    }

    /* Code qui devrait disparaître (note du 11-02-21 10:15:16) */
    public function cashierOld( &$szSelf )
    /*----------------------------------*/
    {
        $aCall = null;

        if ( ! empty( $szSelf ) )
        {
            $a = explode( '/',$szSelf );

            //var_dump( 'self=' . $szSelf );
            //var_dump( '$a exploded=' );
            //var_dump( $a );
            //die();

            $aParts = null;

            foreach ( $a as $szStr )
            {
                if ( ! empty( $szStr ) )
                {
                    $szThePart = trim( $szStr );
                    // ICI, IL FAUT VERIFIER SI CETTE PARTIE AGIT COMME DES PARAMETRES (? et &)
                    $aParts[] = $szThePart;
                }   /* if ( ! empty( $szStr ) ) */
            }   /* foreach ( $a as $szStr ) */

            //var_dump( $aParts );
            //var_dump( $_GET );
            //die();

            $aCall = array( 'verb'      => $aParts[1] ?? 'UNKNOWN'              ,
                            'parts'     => $aParts                              ,
                            'cookies'   => $_COOKIE                             ,
                            'get'       => $_GET                                ,
                            'post'      => $_POST                               ,
                            'server'    => $_SERVER
                          );
        }   /* if ( ! is_null( $szSelf ) ) */

        $this->storeStats( $szSelf,$aCall );

        return ( $aCall );
    }   /* End of SmallAPIGW.cashierOld() ============================================= */
    /* ================================================================================ */


    public function cashier( &$szSelf )
    /*-------------------------------*/
    {
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


    public function dispatch( &$szSelf )
    /*--------------------------------*/
    {
        $bRetVal = false;

        return ( $bRetVal );
    }   /* End of SmallAPIGW.dispatch() =============================================== */
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

        $this->checkVulnerability();
        $this->checkVolume();

        $this->cashier( $szSelf );                                  /* $aCall has split the request */

        $this->storeStats( $aCall,$szSelf );


        //var_dump( $aCall,$this->aHandlers );
        //var_dump( $aCall );
        //die();

        if ( ! $this->dispatch( $szSelf ) )                         /* If no re-dispatch happened */
        {
            if ( ! is_null( $szSelf ) )
            {
                if ( ! is_null( $oHandler = $this->getHandler( $aCall['parts'][1] ?? 'UNKNOWN' ) ) )
                {
                    //var_dump( "FOUND HANDLER: ",$oHandler );
                    //die();

                    $aResponse = $oHandler->process( $aCall );
                    //var_dump( $aResponse );
                }
            }   /* if ( ! is_null( $szSelf ) ) */
            else    /* Else of ... if ( ! is_null( $szSelf ) ) */
            {
                reportError();
            }    /* End of ... Else of ... if ( ! is_null( $szSelf ) ) */
        }   /* if ( ! $this->dispatch( $szSelf ) ) */
    }   /* End of SmallAPIGW.processCall() ============================================ */
    /* ================================================================================ */


    public function getHandler( $szClass )
    /*----------------------------------*/
    {
        if ( is_array( $this->aHandlers ) && count( $this->aHandlers ) > 0 )
        {
            /* Let's check if we have a specialized handler */
            foreach ( $this->aHandlers as $oHandler )
            {
                $aSupportedClasses = explode( ';',str_replace( ',',';',$oHandler->class ) );
                //var_dump( $aSupportedClasses );
                //var_dump( in_array( $szClass,$aSupportedClasses ) );
                //die();

                //if ( $oHandler->class === $szClass )
                if ( in_array( $szClass,$aSupportedClasses ) )
                {
                    //var_dump( $oHandler->class . " MATCHES " . $szClass );
                    //die();
                    return ( $oHandler );
                }
            }

            /* If we're here, then we haven't found any proper handler.
               Let's try to find a generic one */
            foreach ( $this->aHandlers as $oHandler )
            {
                if ( empty( $oHandler->class ) )
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