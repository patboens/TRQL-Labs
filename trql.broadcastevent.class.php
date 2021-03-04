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
    {*file                  trql.broadcastevent.class.php *}
    {*purpose               An over the air or online broadcast event. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:40 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\broadcastevent;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\publicationevent\PublicationEvent    as PublicationEvent;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PUBLICATIONEVENT_CLASS_VERSION' ) )
    require_once( 'trql.publicationevent.class.php' );



defined( 'BROADCASTEVENT_CLASS_VERSION' ) or define( 'BROADCASTEVENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BroadcastEvent=

    {*desc

        An over the air or online broadcast event.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BroadcastEvent[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:40.
    *}

    *}}

 */
/* ==================================================================================== */
class BroadcastEvent extends PublicationEvent
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $broadcastOfEvent               = null;             /* {*property   $broadcastOfEvent               (Event)                         The event being broadcast such as a sporting event or awards ceremony. *} */
    public      $isLiveBroadcast                = null;             /* {*property   $isLiveBroadcast                (boolean)                       True is the broadcast is of a live event. *} */
    public      $location                       = null;             /* {*property   $location                       (string|PostalAddress|VirtualLocation|Place)The location of for example where the event is happening, an
                                                                                                                                                    organization is located, or where an action takes place. *} */
    public      $subtitleLanguage               = null;             /* {*property   $subtitleLanguage               (string|Language)               Languages in which subtitles/captions are available, in IETF BCP 47
                                                                                                                                                    standard format. *} */
    public      $videoFormat                    = null;             /* {*property   $videoFormat                    (string)                        The type of screening or video broadcast used (e.g. IMAX, 3D, SD, HD,
                                                                                                                                                    etc.). *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT LOOKED AT IT YET. *} */


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
    }   /* End of BroadcastEvent.__construct() ======================================== */
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
    }   /* End of BroadcastEvent.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class BroadcastEvent ====================================================== */
/* ==================================================================================== */

?>