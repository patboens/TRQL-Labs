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
    {*file                  trql.httprequestheaders.class.php *}
    {*purpose               HTTP request headers *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 10-03-21 06:47 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 10-03-21 06:47 *}
        {*author {PYB} *}
        {*v 9.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\http;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\schema\Thing       as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'HTTPREQUESTHEADERS_CLASS_VERSION' ) or define( 'HTTPREQUESTHEADERS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class HTTPRequestHeaders=

    {*desc

        HTTP request headers.

    *}

    *}}
 */
/* ==================================================================================== */
class HTTPRequestHeaders extends Thing
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH YET. *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

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
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of HTTPRequestHeaders.__construct() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getHeaders()=

        Fetch HTTP request headers

        {*params
        *}

        {*return
            (array)     Associative array of headers
        *}

        *}}
    */
    /* ================================================================================ */
    public function getHeaders()
    /*------------------------*/
    {
        //if ( function_exists('getallheaders') )
        //{
        //    return ( getallheaders() );
        //}
        //else
        {
            $aRetVal = [];
            //var_dump( $_SERVER );

            foreach ( $_SERVER as $szName => $szValue )
            {
                if ( substr( $szName,0,5 ) === 'HTTP_' )
                {
                    $aRetVal[ str_replace( ' ','-',ucwords( strtolower( str_replace( '_',' ',substr( $szName,5 ) ) ) ) )] = $szValue;
                }   /* if ( substr( $szName,0,5 ) === 'HTTP_' ) */
            }   /* foreach ( $_SERVER as $szName => $szValue ) */

            return ( $aRetVal );
        }

    }   /* End of HTTPRequestHeaders.getheaders() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of HTTPRequestHeaders.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class HTTPRequestHeaders ================================================ */
/* ==================================================================================== */
