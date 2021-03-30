<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.process.class.php *}
    {*purpose               Planned path to reaching an objective. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 07-01-21 11:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 07-01-21 11:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\process;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\schema\Thing           as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'PROCESS_CLASS_VERSION' ) or define( 'PROCESS_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Process=

    {*desc

        Series of events which occur over an extended period of time.

    *}

    *}}
 */
/* ================================================================================== */
class Process extends Thing
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q3249551';       /* {*property   $wikidataId         (string)        Wikidata ID. Series of events which occur over an extended 
                                                                                                                        period of time. *} */


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
    }   /* End of Process.__construct() =============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Process.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Process.sing() ====================================================== */
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

    }   /* End of Process.__destruct() ================================================ */
    /* ================================================================================ */

  /* End of class Process ============================================================= */
/* ==================================================================================== */
}
?>