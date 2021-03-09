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
    {*file                  trql.event.class.php *}
    {*purpose               An event happening at a certain time and location, such as a
                            concert, lecture, or festival. Ticketing information may be
                            added via the offers property. Repeated events may be
                            structured as separate Event objects. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\event;

use \trql\mother\Mother         as Mother;
use \trql\mother\iContext       as iContext;
use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\thing\Thing           as Thing;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'EVENT_CLASS_VERSION' ) or define( 'EVENT_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Event=

    {*desc

        An event happening at a certain time and location, such as a concert,
        lecture, or festival. Ticketing information may be added via the offers
        property. Repeated events may be structured as separate Event objects.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Event[/url] *}

    *}}
 */
/* ================================================================================== */
class Event extends Thing implements iContext
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                               (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $about                              = null;         /* {*property   $about                              (Thing)                             The subject matter of the content.
                                                                                                                                                            Inverse property: subjectOf. *} */

    public      $actor                              = null;         /* {*property   $actor                              (Person)                            An actor, e.g. in tv, radio, movie, video games etc., or in an
                                                                                                                                                            event. Actors can be associated with individual items or with a
                                                                                                                                                            series, episode, clip. Supersedes actors. *} */
    public      $aggregateRating                    = null;         /* {*property   $aggregateRating                    (AggregateRating)                   The overall rating, based on a collection of reviews or ratings,
                                                                                                                                                            of the item. *} */
    public      $attendee                           = null;         /* {*property   $attendee                           (Organization|Person)               A person or organization attending the event. Supersedes attendees. *} */
    public      $audience                           = null;         /* {*property   $audience                           (Audience)                          An intended audience, i.e. a group for whom something was created.
                                                                                                                                                            Supersedes serviceAudience. *} */
    public      $composer                           = null;         /* {*property   $composer                           (Organization|Person)               The person or organization who wrote a composition, or who is the
                                                                                                                                                            composer of a work performed at some event. *} */
    public      $contributor                        = null;         /* {*property   $contributor                        (Organization|Person)               A secondary contributor to the CreativeWork or Event. *} */
    public      $director                           = null;         /* {*property   $director                           (Person)                            A director of e.g. tv, radio, movie, video gaming etc. content,
                                                                                                                                                            or of an event. Directors can be associated with individual items or
                                                                                                                                                            with a series, episode, clip. Supersedes directors. *} */
    public      $doorTime                           = null;         /* {*property   $doorTime                           (DateTime|Time)                     The time admission will commence. *} */
    public      $duration                           = null;         /* {*property   $duration                           (Duration)                          The duration of the item (movie, audio recording, event, etc.)
                                                                                                                                                            in ISO 8601 date format. *} */
    public      $endDate                            = null;         /* {*property   $endDate                            (Date|DateTime)                     The end date and time of the item (in ISO 8601 date format). *} */
    public      $eventAttendanceMode                = null;         /* {*property   $eventAttendanceMode                (EventAttendanceModeEnumeration)    The eventAttendanceMode of an event indicates whether it occurs
                                                                                                                                                            online, offline, or a mix. *} */
    public      $eventSchedule                      = null;         /* {*property   $eventSchedule                      (Schedule)                          Associates an Event with a Schedule. There are circumstances where it
                                                                                                                                                            is preferable to share a schedule for a series of repeating events
                                                                                                                                                            rather than data on the individual events themselves. For example,
                                                                                                                                                            a website or application might prefer to publish a schedule for a
                                                                                                                                                            weekly gym class rather than provide data on every event. A schedule
                                                                                                                                                            could be processed by applications to add forthcoming events to a
                                                                                                                                                            calendar. An Event that is associated with a Schedule using this
                                                                                                                                                            property should not have startDate or endDate properties. These are
                                                                                                                                                            instead defined within the associated Schedule, this avoids any
                                                                                                                                                            ambiguity for clients using the data. The property might have
                                                                                                                                                            repeated values to specify different schedules, e.g. for different
                                                                                                                                                            months or seasons. *} */
    public      $eventStatus                        = null;         /* {*property   $eventStatus                        (EventStatusType)                   An eventStatus of an event represents its status; particularly useful
                                                                                                                                                            when an event is cancelled or rescheduled. *} */
    public      $funder                             = null;         /* {*property   $funder                             (Organization|Person)               A person or organization that supports (sponsors) something through
                                                                                                                                                            some kind of financial contribution. *} */
    public      $inLanguage                         = null;         /* {*property   $inLanguage                         (Language|string)                   The language of the content or performance or used in an action.
                                                                                                                                                            Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                            See also availableLanguage. Supersedes language. *} */
    public      $isAccessibleForFree                = null;         /* {*property   $isAccessibleForFree                (Boolean)                           A flag to signal that the item, event, or place is accessible for
                                                                                                                                                            free. Supersedes free. *} */
    public      $location                           = null;         /* {*property   $location                           (Place|PostalAddress|string)        The location of for example where the event is happening, an organization
                                                                                                                                                            is located, or where an action takes place. *} */
    public      $maximumAttendeeCapacity            = null;         /* {*property   $maximumAttendeeCapacity            (Integer)                           The total number of individuals that may attend an event or venue. *} */
    public      $maximumPhysicalAttendeeCapacity    = null;         /* {*property   $maximumPhysicalAttendeeCapacity    (Integer)                           The maximum physical attendee capacity of an Event whose
                                                                                                                                                            eventAttendanceMode is OfflineEventAttendanceMode (or the offline
                                                                                                                                                            aspects, in the case of a MixedEventAttendanceMode). *} */
    public      $maximumVirtualAttendeeCapacity     = null;         /* {*property   $maximumVirtualAttendeeCapacity     (Integer)                           The maximum physical attendee capacity of an Event whose
                                                                                                                                                            eventAttendanceMode is OnlineEventAttendanceMode (or the online
                                                                                                                                                            aspects, in the case of a MixedEventAttendanceMode). *} */
    public      $offers                             = null;         /* {*property   $offers                             (Offer)                             An offer to provide this item—for example, an offer to sell a product,
                                                                                                                                                            rent the DVD of a movie, perform a service, or give away tickets to an
                                                                                                                                                            event. *} */
    public      $organizer                          = null;         /* {*property   $organizer                          (Organization|Person)               An organizer of an Event. *} */
    public      $performer                          = null;         /* {*property   $performer                          (Organization|Person)               A performer at the event—for example, a presenter, musician, musical
                                                                                                                                                            group or actor. Supersedes performers. *} */
    public      $previousStartDate                  = null;         /* {*property   $previousStartDate                  (Date)                              Used in conjunction with eventStatus for rescheduled or cancelled events.
                                                                                                                                                            This property contains the previously scheduled start date. For
                                                                                                                                                            rescheduled events, the startDate property should be used for the newly
                                                                                                                                                            scheduled start date. In the (rare) case of an event that has been
                                                                                                                                                            postponed and rescheduled multiple times, this field may be repeated. *} */
    public      $recordedIn                         = null;         /* {*property   $recordedIn                         (CreativeWork)                      The CreativeWork that captured all or part of this Event. Inverse
                                                                                                                                                            property: recordedAt. *} */
    public      $remainingAttendeeCapacity          = null;         /* {*property   $remainingAttendeeCapacity          (Integer)                           The number of attendee places for an event that remain unallocated. *} */
    public      $review                             = null;         /* {*property   $review                             (Review)                            A review of the item. Supersedes reviews. *} */
    public      $sponsor                            = null;         /* {*property   $sponsor                            (Organization|Person)               A person or organization that supports a thing through a pledge, promise,
                                                                                                                                                            or financial contribution. e.g. a sponsor of a Medical Study or a corporate
                                                                                                                                                            sponsor of an event. *} */
    public      $startDate                          = null;         /* {*property   $startDate                          (Date|DateTime)                     The start date and time of the item (in ISO 8601 date format). *} */
    public      $subEvent                           = null;         /* {*property   $subEvent                           (Event)                             An Event that is part of this event. For example, a conference event
                                                                                                                                                            includes many presentations, each of which is a subEvent of the
                                                                                                                                                            conference. Supersedes subEvents. Inverse property: superEvent. *} */
    public      $superEvent                         = null;         /* {*property   $superEvent                         (Event)                             An event that this event is a part of. For example, a collection of
                                                                                                                                                            individual music performances might each have a music festival as their
                                                                                                                                                            superEvent. Inverse property: subEvent. *} */
    public      $translator                         = null;         /* {*property   $translator                         (Organization|Person)               Organization or person who adapts a creative work to different languages,
                                                                                                                                                            regional differences and technical requirements of a target market,
                                                                                                                                                            or that translates during some event. *} */
    public      $typicalAgeRange                    = null;         /* {*property   $typicalAgeRange                    (string)                            The typical expected age range, e.g. '7-9', '11-'. *} */
    public      $workFeatured                       = null;         /* {*property   $workFeatured                       (CreativeWork)                      A work featured in some event, e.g. exhibited in an ExhibitionEvent.
                                                                                                                                                            Specific subproperties are available for workPerformed (e.g. a play),
                                                                                                                                                            or a workPresented (a Movie at a ScreeningEvent). *} */
    public      $workPerformed                      = null;         /* {*property   $workPerformed                      (CreativeWork)                      A work performed in some event, for example a play performed in a
                                                                                                                                                            TheaterEvent. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                         = null;         /* {*property   $wikidataId                         (string)                            Wikidata ID. NO SEARCH YET. *} */

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
    }   /* End of Event.__construct() ================================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Event.speak() ======================================================= */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Event.sing() ======================================================== */
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
    }   /* End of Event.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Event ============================================================= */
/* ==================================================================================== */
