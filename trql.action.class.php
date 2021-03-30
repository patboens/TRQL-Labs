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
    {*file                  trql.action.class.php *}
    {*purpose               An action performed by a direct agent and indirect
                            participants upon a direct object. Optionally happens at a
                            location with the help of an inanimate instrument. The
                            execution of the action may produce a result. Specific
                            action sub-type documentation specifies the exact expectation
                            of each argument/role.See also blog post and Actions overview
                            document. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-08-2020 13:33 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              action *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-08-2020 13:33 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\schema\action;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\schema\Thing      as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'ACTION_CLASS_VERSION' ) or define( 'ACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Action=

    {*desc

        An action performed by a direct agent and indirect participants upon a direct 
        object. Optionally happens at a location with the help of an inanimate 
        instrument. The execution of the action may produce a result. Specific action 
        sub-type documentation specifies the exact expectation of each 
        argument/role. See also blog post and Actions overview document.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Action[/url] *}

    *}}

 */
/* ==================================================================================== */
class Action extends Thing
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $actionStatus                   = null;             /* {*property   $actionStatus                   (ActionStatusType)                              Indicates the current disposition of the @class.Action. *} */
    public      $agent                          = null;             /* {*property   $agent                          (Organization|Person)                           The direct performer or driver of the action (animate or inanimate).
                                                                                                                                                                    e.g. John wrote a book. *} */
    public      $endTime                        = null;             /* {*property   $endTime                        (DateTime|Time)                                 The @var.endTime of something. For a reserved event or service (e.g.
                                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to end.
                                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                                    audio and video, it's the time offset of the end of a clip within a
                                                                                                                                                                    larger file. Note that Event uses @var.startDate / @var.endDate instead of
                                                                                                                                                                    @var.startTime / @var.endTime, even when describing dates with times. This
                                                                                                                                                                    situation may be clarified in future revisions (12-03-21 07:05:31). *} */
    public      $error                          = null;             /* {*property   $error                          (Thing)                                         For failed actions, more information on the cause of the failure. *} */
    public      $instrument                     = null;             /* {*property   $instrument                     (Thing)                                         The object that helped the agent perform the action. e.g. John wrote a
                                                                                                                                                                    book with a pen. *} */
    public      $location                       = null;             /* {*property   $location                       (Place|PostalAddress|string|VirtualLocation)    The location of for example where the event is happening, an
                                                                                                                                                                    organization is located, or where an action takes place. *} */
    public      $object                         = null;             /* {*property   $object                         (Thing)                                         The object upon which the action is carried out, whose state is kept
                                                                                                                                                                    intact or changed. Also known as the semantic roles patient, affected
                                                                                                                                                                    or undergoer (which change their state) or theme (which doesn't). e.g.
                                                                                                                                                                    John read a book. *} */
    public      $participant                    = null;             /* {*property   $participant                    (Organization|Person)                           Other co-agents that participated in the action indirectly. e.g. John
                                                                                                                                                                    wrote a book with Steve. *} */
    public      $result                         = null;             /* {*property   $result                         (Thing)                                         The result produced in the action. e.g. John wrote a book. *} */
    public      $startTime                      = null;             /* {*property   $startTime                      (DateTime|Time)                                 The startTime of something. For a reserved event or service (e.g.
                                                                                                                                                                    @class.FoodEstablishmentReservation), the time that it is expected to start.
                                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                                    audio and video, it's the time offset of the start of a clip within a
                                                                                                                                                                    larger file. Note that @class.Event uses @var.startDate / @var.endDate 
                                                                                                                                                                    instead of @var.startTime /@var. endTime, even when describing dates 
                                                                                                                                                                    with times. This situation may be clarified in future revisions. *} */
    public      $target                         = null;             /* {*property   $target                         (EntryPoint)                                    Indicates a target @class.EntryPoint for an [c]Action[/c]. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q4026292';       /* {*property   $wikidataId                     (string)                                        Something an agent can do or perform. *} */

    public      $priority                       = null;             /* {*property   $priority                       (string)                                        Free enumeration (e.g. "P1", "P2", ...). Information can be found
                                                                                                                                                                    on Wikidata (Activity that arranges items or activities in order of 
                                                                                                                                                                    importance or time-sensitivity relative to each other): priority is
                                                                                                                                                                    an alias of prioritization (Q11888847) also known as prioritizing
                                                                                                                                                                    prioritisation, prioritising *} */

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
    }   /* End of Action.__construct() ================================================ */
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
    }   /* End of Action.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Action ============================================================ */
/* ==================================================================================== */
