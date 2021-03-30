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
    {*file                  trql.playaction.class.php *}
    {*purpose               The act of playing/exercising/training/performing for
                            enjoyment, leisure, recreation, Competition or
                            exercise.Related actions:ListenAction: Unlike ListenAction
                            (which is under ConsumeAction), PlayAction refers to
                            performing for an audience or at an event, rather than
                            consuming music.WatchAction: Unlike WatchAction (which is
                            under ConsumeAction), PlayAction refers to
                            showing/displaying for an audience or at an event, rather
                            than consuming visual content. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keywords              action *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\schema\action;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\action\Action    as Action;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACTION_CLASS_VERSION' ) )
    require_once( 'trql.action.class.php' );



defined( 'PLAYACTION_CLASS_VERSION' ) or define( 'PLAYACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PlayAction=

    {*desc

        The act of playing/exercising/training/performing for enjoyment, leisure,
        recreation, Competition or exercise.Related actions:ListenAction: Unlike
        ListenAction (which is under ConsumeAction), PlayAction refers to
        performing for an audience or at an event, rather than consuming
        music.WatchAction: Unlike WatchAction (which is under ConsumeAction),
        PlayAction refers to showing/displaying for an audience or at an event,
        rather than consuming visual content.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PlayAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

    *}}

 */
/* ==================================================================================== */
class PlayAction extends Action
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $audience                       = null;             /* {*property   $audience                       (Audience)                      An intended audience, i.e. a group for whom something was created. *} */
    public      $event                          = null;             /* {*property   $event                          (Event)                         Upcoming or past event associated with this place, organization, or
                                                                                                                                                    action. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId     (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of PlayAction.__construct() ============================================ */
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
    }   /* End of PlayAction.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class PlayAction ======================================================== */
/* ==================================================================================== */
