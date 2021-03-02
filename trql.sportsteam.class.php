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
    {*file                  trql.sportsteam.class.php *}
    {*purpose               Organization: Sports team. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\sportsteam;

use \trql\vaesoli\Vaesoli                       as Vaesoli;
use \trql\sportsorganization\SportsOrganization as SportsOrganization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'SPORTSORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.sportsorganization.class.php' );

defined( 'SPORTSTEAM_CLASS_VERSION' ) or define( 'SPORTSTEAM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SportsTeam=

    {*desc

        Organization: Sports team.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SportsTeam[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class SportsTeam extends SportsOrganization
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $athlete                        = null;             /* {*property   $athlete                        (Person)                        A person that acts as performing member of a sports team; a player as
                                                                                                                                                    opposed to a coach. *} */
    public      $coach                          = null;             /* {*property   $coach                          (Person)                        A person that acts in a coaching role for a sports team. *} */
    public      $gender                         = null;             /* {*property   $gender                         (string|GenderType)             Gender of something, typically a Person, but possibly also fictional
                                                                                                                                                    characters, animals, etc. While http://schema.org/Male and
                                                                                                                                                    http://schema.org/Female may be used, text strings are also acceptable
                                                                                                                                                    for people who do not identify as a binary gender. The gender property
                                                                                                                                                    can also be used in an extended sense to cover e.g. the gender of
                                                                                                                                                    sports teams. As with the gender of individuals, we do not try to
                                                                                                                                                    enumerate all possibilities. A mixed-gender SportsTeam can be
                                                                                                                                                    indicated with a text value of "Mixed". *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                    Wikidata ID. No equivalent. *} */


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
    }   /* End of SportsTeam.__construct() ============================================ */
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
    }   /* End of SportsTeam.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class SportsTeam ======================================================== */
/* ==================================================================================== */
?>