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
    {*file                  trql.uikey.class.php *}
    {*purpose                Universal Key Identifier Services *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 23-08-20 22:18 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    {*warning
        The UIKey class is coming. Stay tuned!
    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 23-08-20 22:18 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\quitus\Mother                             as Mother;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'UIKEY_CLASS_VERSION' ) or define( 'UIKEY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class UIKey=

    {*desc

        Universal Key Identifier

    *}

    {*warning
        Very partial implementation
    *}

    *}}
 */
/* ==================================================================================== */
class UIKey extends Utility
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        //$this->die( "The UIKey class does not do anything interesting yet" );

        return ( $this );
    }   /* End of UIKey.__construct() ================================================= */
    /* ================================================================================ */


    // gotoFile devrait s'appeler cacheName !!!
    protected function gotoFile( $aMap )
    /*--------------------------------*/
    {
        return ( vaesoli::FIL_RealPath( vaesoli::FIL_AddBS( $this->szHome ) . 'data/labels/' .
                 $aMap['level1'] . '/' .
                 $aMap['level2'] . '/' .
                 $aMap['level3'] . '/' .
                 $aMap['level4'] . '.xml' ) );
    }   /* End of UIKey.gotoFile() ==================================================== */
    /* ================================================================================ */


    public function create( $szKey,$xValue )
    /*------------------------------------*/
    {
        $bRetVal    = true;
        $szFile     = $this->gotoFile( $aMap = $this->map( $szKey ) );

        end:
        return ( $bRetVal );
    }   /* End of UIKey.create() ====================================================== */
    /* ================================================================================ */


    public function delete( $szKey )
    /*----------------------------*/
    {
        $bRetVal    = true;
        $szFile     = $this->gotoFile( $aMap = $this->map( $szKey ) );

        end:
        return ( $bRetVal );
    }   /* End of UIKey.delete() ====================================================== */
    /* ================================================================================ */


    public function seek( $szKey )
    /*--------------------------*/
    {
        $xRetVal    = null;
        $szFile     = $this->gotoFile( $aMap = $this->map( $szKey ) );

        end:
        return ( $xRetVal );
    }   /* End of UIKey.seek() ======================================================== */
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

    }   /* End of UIKey.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class UIKey ============================================================= */
/* ==================================================================================== */
?>