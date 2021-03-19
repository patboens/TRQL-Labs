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
    {*file                  trql.governmentorganization.class.php *}
    {*purpose               An organization such as a school, NGO, corporation, club,
                            etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 19-03-21 14:34 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 19-03-21 14:34 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation.
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\organization;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\organization\Organization     as Organization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'GOVERNMENTORGANIZATION_CLASS_VERSION' ) or define( 'GOVERNMENTORGANIZATION_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class GovernmentOrganization=

    {*desc

        A governmental organization or agency.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/GovernmentOrganization[/url] *}

    *}}
 */
/* ================================================================================== */
class GovernmentOrganization extends Organization
/*---------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q2659904';           /* {*property   $wikidataId                 (string)                                    Wikidata ID. Organization administrated by a government 
                                                                                                                                                            authority or agency *} */

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
    }   /* End of GovernmentOrganization.__construct() ================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of GovernmentOrganization.speak() ====================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of GovernmentOrganization.sing() ======================================= */
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
    }   /* End of GovernmentOrganization.__destruct() ================================= */
    /* ================================================================================ */
}   /* End of class GovernmentOrganization ============================================ */
/* ==================================================================================== */
