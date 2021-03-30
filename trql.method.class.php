<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.method.class.php *}
    {*purpose               Planned path to reaching an objective. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 07-01-21 11:22 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 07-01-21 11:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\method;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\schema\Thing           as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_ABSTRACT_CLASS' ) )
    require_once( 'trql.thing.class.php' );

defined( 'METHOD_CLASS_VERSION' ) or define( 'METHOD_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Method=

    {*desc

        Planned path to reaching an objective.

    *}

    *}}
 */
/* ================================================================================== */
class Method extends Thing
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1799072';       /* {*property   $wikidataId         (string)        Wikidata ID. Planned path to reaching an objective. *} */


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
    }   /* End of Method.__construct() ================================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Method.speak() ====================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Method.sing() ======================================================= */
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

    }   /* End of Method.__destruct() ================================================= */
    /* ================================================================================ */

  /* End of class Method ============================================================== */
/* ==================================================================================== */
}
?>