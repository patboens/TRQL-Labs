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
    {*file                  trql.userplays.class.php *}
    {*purpose               UserInteraction and its subtypes is an old way of talking
                            about users interacting with pages. It is generally better
                            to use Action-based vocabulary, alongside types such as
                            Comment. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\userplays;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\userinteraction\UserInteraction    as UserInteraction;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'USERINTERACTION_CLASS_VERSION' ) )
    require_once( 'trql.userinteraction.class.php' );



defined( 'USERPLAYS_CLASS_VERSION' ) or define( 'USERPLAYS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class UserPlays=

    {*desc

        UserInteraction and its subtypes is an old way of talking about users
        interacting with pages. It is generally better to use Action-based
        vocabulary, alongside types such as Comment.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/UserPlays[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class UserPlays extends UserInteraction
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

    public      $about                          = null;             /* {*property   $about                          (Thing)                         The subject matter of the content. *} */
    public      $actor                          = null;             /* {*property   $actor                          (Person)                        An actor, e.g. in tv, radio, movie, video games etc., or in an event.
                                                                                                                                                    Actors can be associated with individual items or with a series,
                                                                                                                                                    episode, clip. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $aggregateRating                = null;             /* {*property   $aggregateRating                (AggregateRating)               The overall rating, based on a collection of reviews or ratings, of
                                                                                                                                                    the item. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $attendee                       = null;             /* {*property   $attendee                       (Person|Organization)           A person or organization attending the event. *} */
    public      $attendees                      = null;             /* {*property   $attendees                      (Person|Organization)           A person attending the event. *} */
    public      $audience                       = null;             /* {*property   $audience                       (Audience)                      An intended audience, i.e. a group for whom something was created. *} */
    public      $composer                       = null;             /* {*property   $composer                       (Person|Organization)           The person or organization who wrote a composition, or who is the
                                                                                                                                                    composer of a work performed at some event. *} */
    public      $contributor                    = null;             /* {*property   $contributor                    (Person|Organization)           A secondary contributor to the CreativeWork or Event. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $director                       = null;             /* {*property   $director                       (Person)                        A director of e.g. tv, radio, movie, video gaming etc. content, or of
                                                                                                                                                    an event. Directors can be associated with individual items or with a
                                                                                                                                                    series, episode, clip. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $doorTime                       = null;             /* {*property   $doorTime                       (DateTime|Time)                 The time admission will commence. *} */
    public      $duration                       = null;             /* {*property   $duration                       (Duration)                      The duration of the item (movie, audio recording, event, etc.) in ISO
                                                                                                                                                    8601 date format. *} */
    public      $endDate                        = null;             /* {*property   $endDate                        (Date|DateTime)                 The end date and time of the item (in ISO 8601 date format). *} */
    public      $eventAttendanceMode            = null;             /* {*property   $eventAttendanceMode            (EventAttendanceModeEnumeration)The eventAttendanceMode of an event indicates whether it occurs
                                                                                                                                                    online, offline, or a mix. *} */
    public      $eventSchedule                  = null;             /* {*property   $eventSchedule                  (Schedule)                      Associates an Event with a Schedule. There are circumstances where it
                                                                                                                                                    is preferable to share a schedule for a series of repeating events
                                                                                                                                                    rather than data on the individual events themselves. For example, a
                                                                                                                                                    website or application might prefer to publish a schedule for a weekly
                                                                                                                                                    gym class rather than provide data on every event. A schedule could be
                                                                                                                                                    processed by applications to add forthcoming events to a calendar. An
                                                                                                                                                    Event that is associated with a Schedule using this property should
                                                                                                                                                    not have startDate or endDate properties. These are instead defined
                                                                                                                                                    within the associated Schedule, this avoids any ambiguity for clients
                                                                                                                                                    using the data. The property might have repeated values to specify
                                                                                                                                                    different schedules, e.g. for different months or seasons. *} */
    public      $eventStatus                    = null;             /* {*property   $eventStatus                    (EventStatusType)               An eventStatus of an event represents its status; particularly useful
                                                                                                                                                    when an event is cancelled or rescheduled. *} */
    public      $funder                         = null;             /* {*property   $funder                         (Person|Organization)           A person or organization that supports (sponsors) something through
                                                                                                                                                    some kind of financial contribution. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $inLanguage                     = null;             /* {*property   $inLanguage                     (string|Language)               The language of the content or performance or used in an action.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also availableLanguage. *} */
    public      $isAccessibleForFree            = null;             /* {*property   $isAccessibleForFree            (boolean)                       A flag to signal that the item, event, or place is accessible for
                                                                                                                                                    free. *} */
    public      $location                       = null;             /* {*property   $location                       (string|PostalAddress|VirtualLocation|Place)The location of for example where the event is happening, an
                                                                                                                                                    organization is located, or where an action takes place. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $maximumAttendeeCapacity        = null;             /* {*property   $maximumAttendeeCapacity        (int)                           The total number of individuals that may attend an event or venue. *} */
    public      $maximumPhysicalAttendeeCapacity = null;             /* {*property   $maximumPhysicalAttendeeCapacity(int)                           The maximum physical attendee capacity of an Event whose
                                                                                                                                                    eventAttendanceMode is OfflineEventAttendanceMode (or the offline
                                                                                                                                                    aspects, in the case of a MixedEventAttendanceMode). *} */
    public      $maximumVirtualAttendeeCapacity = null;             /* {*property   $maximumVirtualAttendeeCapacity (int)                           The maximum physical attendee capacity of an Event whose
                                                                                                                                                    eventAttendanceMode is OnlineEventAttendanceMode (or the online
                                                                                                                                                    aspects, in the case of a MixedEventAttendanceMode). *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */
    public      $organizer                      = null;             /* {*property   $organizer                      (Person|Organization)           An organizer of an Event. *} */
    public      $performer                      = null;             /* {*property   $performer                      (Person|Organization)           A performer at the event&#x2014;for example, a presenter, musician,
                                                                                                                                                    musical group or actor. *} */
    public      $performers                     = null;             /* {*property   $performers                     (Organization|Person)           The main performer or performers of the event&#x2014;for example, a
                                                                                                                                                    presenter, musician, or actor. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $previousStartDate              = null;             /* {*property   $previousStartDate              (Date)                          Used in conjunction with eventStatus for rescheduled or cancelled
                                                                                                                                                    events. This property contains the previously scheduled start date.
                                                                                                                                                    For rescheduled events, the startDate property should be used for the
                                                                                                                                                    newly scheduled start date. In the (rare) case of an event that has
                                                                                                                                                    been postponed and rescheduled multiple times, this field may be
                                                                                                                                                    repeated. *} */
    public      $recordedIn                     = null;             /* {*property   $recordedIn                     (CreativeWork)                  The CreativeWork that captured all or part of this Event. *} */
    public      $remainingAttendeeCapacity      = null;             /* {*property   $remainingAttendeeCapacity      (int)                           The number of attendee places for an event that remain unallocated. *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */
    public      $startDate                      = null;             /* {*property   $startDate                      (DateTime|Date)                 The start date and time of the item (in ISO 8601 date format). *} */
    public      $subEvent                       = null;             /* {*property   $subEvent                       (Event)                         An Event that is part of this event. For example, a conference event
                                                                                                                                                    includes many presentations, each of which is a subEvent of the
                                                                                                                                                    conference. *} */
    public      $subEvents                      = null;             /* {*property   $subEvents                      (Event)                         Events that are a part of this event. For example, a conference event
                                                                                                                                                    includes many presentations, each subEvents of the conference. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $superEvent                     = null;             /* {*property   $superEvent                     (Event)                         An event that this event is a part of. For example, a collection of
                                                                                                                                                    individual music performances might each have a music festival as
                                                                                                                                                    their superEvent. *} */
    public      $translator                     = null;             /* {*property   $translator                     (Person|Organization)           Organization or person who adapts a creative work to different
                                                                                                                                                    languages, regional differences and technical requirements of a target
                                                                                                                                                    market, or that translates during some event. *} */
    public      $typicalAgeRange                = null;             /* {*property   $typicalAgeRange                (string)                        The typical expected age range, e.g. '7-9', '11-'. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $workFeatured                   = null;             /* {*property   $workFeatured                   (CreativeWork)                  A work featured in some event, e.g. exhibited in an ExhibitionEvent.
                                                                                                                                                    Specific subproperties are available for workPerformed (e.g. a play),
                                                                                                                                                    or a workPresented (a Movie at a ScreeningEvent). *} */
    public      $workPerformed                  = null;             /* {*property   $workPerformed                  (CreativeWork)                  A work performed in some event, for example a play performed in a
                                                                                                                                                    TheaterEvent. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;


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
    }   /* End of UserPlays.__construct() ========================================== */
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
    }   /* End of UserPlays.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class UserPlays ====================================================== */
/* ==================================================================================== */

?>