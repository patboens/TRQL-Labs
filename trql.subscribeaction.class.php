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
    {*file                  trql.subscribeaction.class.php *}
    {*purpose               The act of forming a personal connection with
                            someone/something (object) unidirectionally/asymmetrically
                            to get updates pushed to.Related actions:FollowAction:
                            Unlike FollowAction, SubscribeAction implies that the
                            subscriber acts as a passive agent being constantly/actively
                            pushed for updates.RegisterAction: Unlike RegisterAction,
                            SubscribeAction implies that the agent is interested in
                            continuing receiving updates from the object.JoinAction:
                            Unlike JoinAction, SubscribeAction implies that the agent is
                            interested in continuing receiving updates from the object. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keywords              action *}

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
namespace trql\schema\action;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\action\InteractAction    as InteractAction;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTERACTACTION_CLASS_VERSION' ) )
    require_once( 'trql.interactaction.class.php' );



defined( 'SUBSCRIBEACTION_CLASS_VERSION' ) or define( 'SUBSCRIBEACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SubscribeAction=

    {*desc

        The act of forming a personal connection with someone/something (object)
        unidirectionally/asymmetrically to get updates pushed to.Related
        actions:FollowAction: Unlike FollowAction, SubscribeAction implies that the
        subscriber acts as a passive agent being constantly/actively pushed for
        updates.RegisterAction: Unlike RegisterAction, SubscribeAction implies that
        the agent is interested in continuing receiving updates from the
        object.JoinAction: Unlike JoinAction, SubscribeAction implies that the
        agent is interested in continuing receiving updates from the object.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SubscribeAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

    *}}

 */
/* ==================================================================================== */
class SubscribeAction extends InteractAction
/*----------------------------------------*/
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
    }   /* End of SubscribeAction.__construct() ======================================= */
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
    }   /* End of SubscribeAction.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class SubscribeAction =================================================== */
/* ==================================================================================== */
