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
    {*file                  trql.schedule.class.php *}
    {*purpose               A schedule defines a repeating time period used to describe
                            a regularly occurring Event. At a minimum a schedule will
                            specify repeatFrequency which describes the interval between
                            occurences of the event. Additional information can be
                            provided to specify the schedule more precisely. This
                            includes identifying the day(s) of the week or month when
                            the recurring event will take place, in addition to its
                            start and end time. Schedules may also have start and end
                            dates to indicate when they are active, e.g. to define a
                            limited calendar of events. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\schedule;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'SCHEDULE_CLASS_VERSION' ) or define( 'SCHEDULE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Schedule=

    {*desc

        A schedule defines a repeating time period used to describe a regularly
        occurring Event. At a minimum a schedule will specify repeatFrequency which
        describes the interval between occurences of the event. Additional
        information can be provided to specify the schedule more precisely. This
        includes identifying the day(s) of the week or month when the recurring
        event will take place, in addition to its start and end time. Schedules may
        also have start and end dates to indicate when they are active, e.g. to
        define a limited calendar of events.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Schedule[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

    *}}

 */
/* ==================================================================================== */
class Schedule extends Intangible
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

    public      $byDay                          = null;             /* {*property   $byDay                          (DayOfWeek|string)              Defines the day(s) of the week on which a recurring Event takes place.
                                                                                                                                                    May be specified using either DayOfWeek, or alternatively Text
                                                                                                                                                    conforming to iCal's syntax for byDay recurrence rules *} */
    public      $byMonth                        = null;             /* {*property   $byMonth                        (int)                           Defines the month(s) of the year on which a recurring Event takes
                                                                                                                                                    place. Specified as an Integer between 1-12. January is 1. *} */
    public      $byMonthDay                     = null;             /* {*property   $byMonthDay                     (int)                           Defines the day(s) of the month on which a recurring Event takes
                                                                                                                                                    place. Specified as an Integer between 1-31. *} */
    public      $byMonthWeek                    = null;             /* {*property   $byMonthWeek                    (int)                           Defines the week(s) of the month on which a recurring Event takes
                                                                                                                                                    place. Specified as an Integer between 1-5. For clarity, byMonthWeek
                                                                                                                                                    is best used in conjunction with byDay to indicate concepts like the
                                                                                                                                                    first and third Mondays of a month. *} */
    public      $duration                       = null;             /* {*property   $duration                       (Duration)                      The duration of the item (movie, audio recording, event, etc.) in ISO
                                                                                                                                                    8601 date format. *} */
    public      $endDate                        = null;             /* {*property   $endDate                        (Date|DateTime)                 The end date and time of the item (in ISO 8601 date format). *} */
    public      $endTime                        = null;             /* {*property   $endTime                        (DateTime|Time)                 The endTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to end.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the end of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */
    public      $exceptDate                     = null;             /* {*property   $exceptDate                     (DateTime|Date)                 Defines a Date or DateTime during which a scheduled Event will not
                                                                                                                                                    take place. The property allows exceptions to a Schedule to be
                                                                                                                                                    specified. If an exception is specified as a DateTime then only the
                                                                                                                                                    event that would have started at that specific date and time should be
                                                                                                                                                    excluded from the schedule. If an exception is specified as a Date
                                                                                                                                                    then any event that is scheduled for that 24 hour period should be
                                                                                                                                                    excluded from the schedule. This allows a whole day to be excluded
                                                                                                                                                    from the schedule without having to itemise every scheduled event. *} */
    public      $repeatCount                    = null;             /* {*property   $repeatCount                    (int)                           Defines the number of times a recurring Event will take place *} */
    public      $repeatFrequency                = null;             /* {*property   $repeatFrequency                (string|Duration)               Defines the frequency at which Events will occur according to a
                                                                                                                                                    schedule Schedule. The intervals between events should be defined as a
                                                                                                                                                    Duration of time. *} */
    public      $scheduleTimezone               = null;             /* {*property   $scheduleTimezone               (string)                        Indicates the timezone for which the time(s) indicated in the Schedule
                                                                                                                                                    are given. The value provided should be among those listed in the IANA
                                                                                                                                                    Time Zone Database. *} */
    public      $startDate                      = null;             /* {*property   $startDate                      (DateTime|Date)                 The start date and time of the item (in ISO 8601 date format). *} */
    public      $startTime                      = null;             /* {*property   $startTime                      (DateTime|Time)                 The startTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to start.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the start of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */

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
    }   /* End of Schedule.__construct() ============================================== */
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
    }   /* End of Schedule.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Schedule ========================================================== */
/* ==================================================================================== */
