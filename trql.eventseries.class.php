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
    {*file                  trql.eventseries.class.php *}
    {*purpose               A series of Events. Included events can relate with the
                            series using the superEvent property.An EventSeries is a
                            collection of events that share some unifying
                            characteristic. For example, "The Olympic Games" is a
                            series, whichis repeated regularly. The "2012 London
                            Olympics" can be presented both as an Event in the series
                            "Olympic Games", and as anEventSeries that included a number
                            of sporting competitions as Events.The nature of the
                            association between the events in an EventSeries can vary,
                            but typical examples couldinclude a thematic event series
                            (e.g. topical meetups or classes), or a series of regular
                            events that share a location, attendee group and/or
                            organizers.EventSeries has been defined as a kind of Event
                            to make it easy for publishers to use it in an Event context
                            withoutworrying about which kinds of series are really
                            event-like enough to call an Event. In general an
                            EventSeriesmay seem more Event-like when the period of time
                            is compact and when aspects such as location are fixed,
                            butit may also sometimes prove useful to describe a
                            longer-term series as an Event. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
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
namespace trql\eventseries;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\event\Event       as Event;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'EVENT_CLASS_VERSION' ) )
    require_once( 'trql.event.class.php' );

defined( 'EVENTSERIES_CLASS_VERSION' ) or define( 'EVENTSERIES_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class EventSeries=

    {*desc

        A series of Events. Included events can relate with the series using the
        superEvent property.An EventSeries is a collection of events that share
        some unifying characteristic. For example, "The Olympic Games" is a series,
        whichis repeated regularly. The "2012 London Olympics" can be presented
        both as an Event in the series "Olympic Games", and as anEventSeries that
        included a number of sporting competitions as Events.The nature of the
        association between the events in an EventSeries can vary, but typical
        examples couldinclude a thematic event series (e.g. topical meetups or
        classes), or a series of regular events that share a location, attendee
        group and/or organizers.EventSeries has been defined as a kind of Event to
        make it easy for publishers to use it in an Event context withoutworrying
        about which kinds of series are really event-like enough to call an Event.
        In general an EventSeriesmay seem more Event-like when the period of time
        is compact and when aspects such as location are fixed, butit may also
        sometimes prove useful to describe a longer-term series as an Event.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/EventSeries[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class EventSeries extends Event
/*---------------------------*/
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
    }   /* End of EventSeries.__construct() =========================================== */
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
    }   /* End of EventSeries.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class EventSeries ======================================================= */
/* ==================================================================================== */
?>