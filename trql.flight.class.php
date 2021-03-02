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
    {*file                  trql.flight.class.php *}
    {*purpose               An airline flight. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:48 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:48 *}
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
namespace trql\flight;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\trip\Trip    as Trip;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TRIP_CLASS_VERSION' ) )
    require_once( 'trql.trip.class.php' );



defined( 'FLIGHT_CLASS_VERSION' ) or define( 'FLIGHT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Flight=

    {*desc

        An airline flight.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Flight[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:48.
    *}

 */
/* ==================================================================================== */
class Flight extends Trip
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

    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $aircraft                       = null;             /* {*property   $aircraft                       (string|Vehicle)                The kind of aircraft (e.g., "Boeing 747"). *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $arrivalAirport                 = null;             /* {*property   $arrivalAirport                 (Airport)                       The airport where the flight terminates. *} */
    public      $arrivalGate                    = null;             /* {*property   $arrivalGate                    (string)                        Identifier of the flight's arrival gate. *} */
    public      $arrivalTerminal                = null;             /* {*property   $arrivalTerminal                (string)                        Identifier of the flight's arrival terminal. *} */
    public      $arrivalTime                    = null;             /* {*property   $arrivalTime                    (Time|DateTime)                 The expected arrival time. *} */
    public      $boardingPolicy                 = null;             /* {*property   $boardingPolicy                 (BoardingPolicyType)            The type of boarding policy used by the airline (e.g. zone-based or
                                                                                                                                                    group-based). *} */
    public      $carrier                        = null;             /* {*property   $carrier                        (Organization)                  'carrier' is an out-dated term indicating the 'provider' for parcel
                                                                                                                                                    delivery and flights. *} */
    public      $departureAirport               = null;             /* {*property   $departureAirport               (Airport)                       The airport where the flight originates. *} */
    public      $departureGate                  = null;             /* {*property   $departureGate                  (string)                        Identifier of the flight's departure gate. *} */
    public      $departureTerminal              = null;             /* {*property   $departureTerminal              (string)                        Identifier of the flight's departure terminal. *} */
    public      $departureTime                  = null;             /* {*property   $departureTime                  (DateTime|Time)                 The expected departure time. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $estimatedFlightDuration        = null;             /* {*property   $estimatedFlightDuration        (Duration|string)               The estimated time the flight will take. *} */
    public      $flightDistance                 = null;             /* {*property   $flightDistance                 (string|Distance)               The distance of the flight. *} */
    public      $flightNumber                   = null;             /* {*property   $flightNumber                   (string)                        The unique identifier for a flight including the airline IATA code.
                                                                                                                                                    For example, if describing United flight 110, where the IATA code for
                                                                                                                                                    United is 'UA', the flightNumber is 'UA110'. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $itinerary                      = null;             /* {*property   $itinerary                      (Place|ItemList)                Destination(s) ( Place ) that make up a trip. For a trip where
                                                                                                                                                    destination order is important use ItemList to specify that order (see
                                                                                                                                                    examples). *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $mealService                    = null;             /* {*property   $mealService                    (string)                        Description of the meals that will be provided or available for
                                                                                                                                                    purchase. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */
    public      $partOfTrip                     = null;             /* {*property   $partOfTrip                     (Trip)                          Identifies that this Trip is a subTrip of another Trip. For example
                                                                                                                                                    Day 1, Day 2, etc. of a multi-day trip. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)           The service provider, service operator, or service performer; the
                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                    seller. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $seller                         = null;             /* {*property   $seller                         (Person|Organization)           An entity which offers (sells / leases / lends / loans) the services /
                                                                                                                                                    goods. A seller may also be a provider. *} */
    public      $subTrip                        = null;             /* {*property   $subTrip                        (Trip)                          Identifies a Trip that is a subTrip of this Trip. For example Day 1,
                                                                                                                                                    Day 2, etc. of a multi-day trip. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $webCheckinTime                 = null;             /* {*property   $webCheckinTime                 (DateTime)                      The time when a passenger can check into the flight online. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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
    }   /* End of Flight.__construct() ========================================== */
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
    }   /* End of Flight.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class Flight ====================================================== */
/* ==================================================================================== */

?>