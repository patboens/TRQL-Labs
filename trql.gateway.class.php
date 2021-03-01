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
    {*file                  trql.gateway.class.php *}
    
    {*purpose               Hardware or software components that connect between two 
                            network systems. *}
    
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
        {*mdate 06-02-21 22:13 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\gateway;

use \trql\vaesoli\Vaesoli       as v;
use \trql\thing\Thing           as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'GATEWAY_CLASS_VERSION' ) or define( 'GATEWAY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Gateway=

    {*desc

        Hardware or software components that connect between two network systems.

    *}

 */
/* ==================================================================================== */
class Gateway extends Thing 
/*------------------------*/
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
    public      $wikidataId                     = 'Q487365';        /* {*property   $wikidataId                 (string)                        Hardware or software components that connect between 
                                                                                                                                                two network systems *} */

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
    /*-------------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of Gateway.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parseConfig( $szFile )=

        Loads and parses a configuration file (XML)

        {*params
            $szFile         (string)        An XML configuration file that contains the
                                            configuration that must be taken into account
        *}

        {*return
            (self)      Returns the current instance of the class.
        *}

        *}}
    */
    /* ================================================================================ */
    public function parseConfig( $szFile )
    /*----------------------------------*/
    {
        $aConfig = null;

        if ( is_file( $szFile ) )
        {
            //var_dump( $szFile );
            $aConfig = $this->XMLToArray( v::FIL_FileToStr( $szFile ) );
            //var_dump("BACK",$aConfig['Routes']);
            //$this->die();
        }

        //die();
        return( $aConfig );
    }   /* End of Gateway.parseConfig() =============================================== */
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

    }   /* End of Gateway.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Gateway =========================================================== */
/* ==================================================================================== */
?>