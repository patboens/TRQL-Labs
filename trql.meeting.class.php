<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.meeting.class.php *}
    {*purpose               Event in which two or more people assemble, planned in 
                            advance to facilitate discussion. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:46 *}
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
namespace trql\meeting;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\event\Event           as Event;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'EVENT_ABSTRACT_CLASS' ) )
    require_once( 'trql.event.class.php' );

defined( 'MEETING_CLASS_VERSION' ) or define( 'MEETING_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Meeting=

    {*desc

        Event in which two or more people assemble, planned in advance to
        facilitate discussion.

    *}

    *}}
 */
/* ================================================================================== */
class Meeting extends Event implements iContext
/*-------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q2761147';       /* {*property   $wikidataId         (string)        Wikidata ID. Event in which two or more people assemble,
                                                                                                                        planned in advance to facilitate discussion meeting. *} */


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
    }   /* End of Meeting.__construct() =============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Meeting.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Meeting.sing() ====================================================== */
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

    }   /* End of Meeting.__destruct() ================================================ */
    /* ================================================================================ */

  /* End of class Meeting ============================================================= */
/* ==================================================================================== */
}
?>