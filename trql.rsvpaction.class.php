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
    {*file                  trql.rsvpaction.class.php *}
    {*purpose               The act of notifying an event organizer as to whether you 
                            expect to attend the event. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-08-2020 14:00 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-08-2020 14:00 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schema\action;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\action\InformAction    as InformAction;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INFORMACTION_CLASS_VERSION' ) )
    require_once( 'trql.informaction.class.php' );

defined( 'RSVPACTION_CLASS_VERSION' ) or define( 'RSVPACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class RsvpAction=

    {*desc

        The act of notifying an event organizer as to whether you expect to attend 
        the event.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/RsvpAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 25-08-2020 14:00.
    *}

 */
/* ==================================================================================== */
class RsvpAction extends InformAction
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $additionalNumberOfGuests       = null;             /* {*property   $additionalNumberOfGuests       (float)                         If responding yes, the number of guests who will attend in addition to
                                                                                                                                                    the invitee. *} */
    public      $comment                        = null;             /* {*property   $comment                        (Comment)                       Comments, typically from users. *} */
    public      $rsvpResponse                   = null;             /* {*property   $rsvpResponse                   (RsvpResponseType)              The response (yes, no, maybe) to the RSVP. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q311679';        /* {*property   $wikidataId                     (string)                        Wikidata ID. RSVP ... process by which people are asked to respond 
                                                                                                                                                    to an invitation (the closes we can get). *} */

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
    }   /* End of RsvpAction.__construct() ============================================ */
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
    }   /* End of RsvpAction.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class RsvpAction ======================================================== */
/* ==================================================================================== */
