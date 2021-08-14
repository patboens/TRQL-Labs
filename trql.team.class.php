<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.team.class.php *}
    {*purpose               Group linked in a common purpose. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 07-01-21 17:55 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    --------------------------------------------------------------------------------------
    Changes History:
    --------------------------------------------------------------------------------------

    {*chist
        {*mdate 07-01-21 17:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\team;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\organization\Organization         as Organization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'TEAM_CLASS_VERSION' ) or define( 'TEAM_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Team=

    {*desc

        Group linked in a common purpose.

    *}

    *}}
 */
/* ================================================================================== */
class Team extends Organization
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'icon'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q327245';        /* {*property   $wikidataId         (string)        Wikidata ID. Group linked in a common purpose. *} */

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
        $this->classIcon = $this->self['icon'];

        return ( $this );
    }   /* End of Team.__construct() ================================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Team.speak() ======================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Team.sing() ========================================================= */
    /* ================================================================================ */


    public function __toHTML() : string
    /*---------------------------------*/
    {
        var_dump( $this );
        return ( '' );
    }   /* End of Team.__toHTML() ===================================================== */
    /* ================================================================================ */


    public function __toString() : string
    /*---------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of Team.__toString() =================================================== */
    /* ================================================================================ */


    public function __get( $szProperty )
    /*--------------------------------*/
    {
        switch( $szProperty )
        {
            case 'icon'         :   return ( '/snippet-center/icons/' . basename( $this->classIcon ) );
            case 'szID'         :   return ( $this->identifier );
            default             :   throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": {$szProperty} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . " - EXCEPTION_CODE_INVALID_PROPERTY)",EXCEPTION_CODE_INVALID_PROPERTY );

        }   /* switch( $szProperty ) */

    }   /* End of Team.__get() ======================================================== */
    /* ================================================================================ */


    public function __set( $szProperty,$szValue )
    /*-----------------------------------------*/
    {
        switch( $szProperty )
        {
            case 'szID'         :   $this->identifier       = $szValue; goto end;
            default             :   throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": {$szProperty} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . " - EXCEPTION_CODE_INVALID_PROPERTY)",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch( $szProperty ) */

        end:

        return ( $this );
    }   /* End of Team.__set() ======================================================== */
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

    }   /* End of Team.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Team ============================================================== */
/* ==================================================================================== */
?>