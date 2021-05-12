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
    {*file                  trql.performinggroup.class.php *}
    {*purpose               A performance group, such as a band, an orchestra, or a
                            circus. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 30-07-20 16:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre*}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 30-07-20 16:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation.
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
namespace trql\schema\organization;

use \trql\quitus\iContext                   as iContext;
use \trql\context\Context                   as Context;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\organization\Organization  as Organization;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'PERFORMINGGROUP_CLASS_VERSION' ) or define( 'PERFORMINGGROUP_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PerformingGroup=

    {*desc

        A performance group, such as a band, an orchestra, or a circus.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/PerformingGroup[/url] *}

    *}}
 */
/* ==================================================================================== */
class PerformingGroup extends Organization implements iContext
/*----------------------------------------------------------*/
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
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of PerformingGroup.__construct() ======================================= */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN TEMPLATES\n" );

        return ( $aRetVal );
    }   /* End of PerformingGroup.templates() ========================================= */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n" );

        return ( $aRetVal );
    }   /* End of PerformingGroup.substitutions() ===================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of PerformingGroup.speak() ============================================= */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of PerformingGroup.sing() ============================================== */
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

    }   /* End of PerformingGroup.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class PerformingGroup =================================================== */
/* ==================================================================================== */
