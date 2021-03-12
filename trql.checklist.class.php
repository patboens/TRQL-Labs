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
    {*file                  trql.checklist.class.php *}
    {*purpose               Type of informational job aid. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 12:35 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 12:35 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\checklist;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\itemlist\ItemList         as ItemList;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ITEMLIST_CLASS_VERSION' ) )
    require_once( 'trql.itemlist.class.php' );

defined( 'CHECKLIST_CLASS_VERSION' ) or define( 'CHECKLIST_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CheckList=

    {*desc

        Type of informational job aid.

    *}

    *}}

 */
/* ==================================================================================== */
class CheckList extends ItemList
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId     = 'Q922625';                        /* {*property   $wikidataId         (string)                Wikidata ID. Type of informational job aid. *} */


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
    }   /* End of CheckList.__construct() ============================================= */
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
    }   /* End of CheckList.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class CheckList ========================================================= */
/* ==================================================================================== */
?>