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
    {*file                  trql.agent.class.php *}
    {*purpose               An individual and identifiable entity capable of 
                            performing actions. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 07-03-21 20:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 07-03-21 20:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli               as v;
use \trql\quitus\PersonOrOrganization   as PersonOrOrganization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERSONORORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.personororganization.class.php' );

defined( 'AGENT_CLASS_VERSION' ) or define( 'AGENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Agent=

    {*desc

        An individual and identifiable entity capable of performing actions

    *}

    *}}
 */
/* ==================================================================================== */
class Agent extends PersonOrOrganization
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q24229398';      /* {*property   $wikidataId                     (string)                        Wikidata ID. An individual and identifiable 
                                                                                                                                                    entity capable of performing actions *} */

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
    }   /* End of Agent.__construct() ================================================= */
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
    }   /* End of Agent.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Agent ============================================================= */
/* ==================================================================================== */
