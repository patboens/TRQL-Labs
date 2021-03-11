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
    {*file                  trql.userstory.class.php *}
    {*purpose               An informal, natural language description of one or more 
                            features of a software system, often written from the 
                            perspective of either an end user or system user *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 11-03-21 08:10 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 11-03-21 08:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\userstory;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\task\Task         as Task;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TASK_CLASS_VERSION' ) )
    require_once( 'trql.task.class.php' );

defined( 'USERSTORY_CLASS_VERSION' ) or define( 'USERSTORY_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class UserStory=

    {*desc

        An informal, natural language description of one or more features of a
        software system, often written from the perspective of either an end
        user or system user

    *}

    *}}
 */
/* ==================================================================================== */
class UserStory extends Task
/*------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q218152';                /* {*property   $wikidataId                     (string)            Wikidata ID. An informal, natural language description of 
                                                                                                                                        one or more features of a software system, often written 
                                                                                                                                        from the perspective of either an end user or system user. *} */

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

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of UserStory.__construct() ============================================= */
    /* ================================================================================ */


    public function WhoAmI()
    /*--------------------*/
    {
        return ( $this->self['name'] );
    }   /* End of UserStory.WhoAmI() ================================================== */
    /* ================================================================================ */


    public function identity() : string
    /*------------------------------*/
    {
        $szRetVal = '';

        /* {*todo Redefine the identitity method in terms of as (who) I need (what) because
                  (*why*) *} */ 

        $szRetVal = "<span class=\"identity\"><b class=\"name\">{$this->name}</b>: "                                .
            ( ! empty( $this->priority ) ? ( ' (<span class="priority">' . $this->priority . '</span>)' ) : '' )    .
            ( ! empty( $this->agent    ) ? ( ' (<span class="agent">'    . $this->agent    . '</span>)' ) : '' )    .
            " <span class=\"description\">{$this->description}</span>"                                              .
            ( $this->attention ? '<span class="attention" title="Attention!"></span>' : '' )                        .
            ( $this->late      ? '<span class="late" title="Late!"></span>'           : '' )                        .
            " <span class=\"credits\" title=\"Requires {$this->credits} credits\">{$this->credits}</span></span>";

        return ( $szRetVal );
    }   /* End of UserStory.identity() ================================================ */
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
    }   /* End of UserStory.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class UserStory ========================================================= */
/* ==================================================================================== */
