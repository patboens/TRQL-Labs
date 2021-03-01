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
    {*file                  trql.rentalcarreservation.class.php *}
    {*purpose               A reservation for a rental car.Note: This type is for
                            information about actual reservations, e.g. in confirmation
                            emails or HTML pages with individual confirmations of
                            reservations. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\rentalcarreservation;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\reservation\Reservation    as Reservation;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RESERVATION_CLASS_VERSION' ) )
    require_once( 'trql.reservation.class.php' );



defined( 'RENTALCARRESERVATION_CLASS_VERSION' ) or define( 'RENTALCARRESERVATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class RentalCarReservation=

    {*desc

        A reservation for a rental car.Note: This type is for information about
        actual reservations, e.g. in confirmation emails or HTML pages with
        individual confirmations of reservations.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/RentalCarReservation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class RentalCarReservation extends Reservation
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
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $bookingAgent                   = null;             /* {*property   $bookingAgent                   (Organization|Person)           'bookingAgent' is an out-dated term indicating a 'broker' that serves
                                                                                                                                                    as a booking agent. *} */
    public      $bookingTime                    = null;             /* {*property   $bookingTime                    (DateTime)                      The date and time the reservation was booked. *} */
    public      $broker                         = null;             /* {*property   $broker                         (Person|Organization)           An entity that arranges for an exchange between a buyer and a seller.
                                                                                                                                                    In most cases a broker never acquires or releases ownership of a
                                                                                                                                                    product or service involved in an exchange. If it is not clear whether
                                                                                                                                                    an entity is a broker, seller, or buyer, the latter two terms are
                                                                                                                                                    preferred. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $dropoffLocation                = null;             /* {*property   $dropoffLocation                (Place)                         Where a rental car can be dropped off. *} */
    public      $dropoffTime                    = null;             /* {*property   $dropoffTime                    (DateTime)                      When a rental car can be dropped off. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $modifiedTime                   = null;             /* {*property   $modifiedTime                   (DateTime)                      The date and time the reservation was modified. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $pickupLocation                 = null;             /* {*property   $pickupLocation                 (Place)                         Where a taxi will pick up a passenger or a rental car can be picked
                                                                                                                                                    up. *} */
    public      $pickupTime                     = null;             /* {*property   $pickupTime                     (DateTime)                      When a taxi will pickup a passenger or a rental car can be picked up. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $priceCurrency                  = null;             /* {*property   $priceCurrency                  (string)                        The currency of the price, or a price component when attached to
                                                                                                                                                    PriceSpecification and its subtypes.Use standard formats: ISO 4217
                                                                                                                                                    currency format e.g. "USD"; Ticker symbol for cryptocurrencies e.g.
                                                                                                                                                    "BTC"; well known names for Local Exchange Tradings Systems (LETS) and
                                                                                                                                                    other currency types e.g. "Ithaca HOUR". *} */
    public      $programMembershipUsed          = null;             /* {*property   $programMembershipUsed          (ProgramMembership)             Any membership in a frequent flyer, hotel loyalty program, etc. being
                                                                                                                                                    applied to the reservation. *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)           The service provider, service operator, or service performer; the
                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                    seller. *} */
    public      $reservationFor                 = null;             /* {*property   $reservationFor                 (Thing)                         The thing -- flight, event, restaurant,etc. being reserved. *} */
    public      $reservationId                  = null;             /* {*property   $reservationId                  (string)                        A unique identifier for the reservation. *} */
    public      $reservationStatus              = null;             /* {*property   $reservationStatus              (ReservationStatusType)         The current status of the reservation. *} */
    public      $reservedTicket                 = null;             /* {*property   $reservedTicket                 (Ticket)                        A ticket associated with the reservation. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $totalPrice                     = null;             /* {*property   $totalPrice                     (PriceSpecification|float|string)The total price for the reservation or ticket, including applicable
                                                                                                                                                    taxes, shipping, etc.Usage guidelines:Use values from 0123456789
                                                                                                                                                    (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than
                                                                                                                                                    superficially similiar Unicode symbols.Use '.' (Unicode 'FULL STOP'
                                                                                                                                                    (U+002E)) rather than ',' to indicate a decimal point. Avoid using
                                                                                                                                                    these symbols as a readability separator. *} */
    public      $underName                      = null;             /* {*property   $underName                      (Person|Organization)           The person or organization the reservation or ticket is for. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


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
    }   /* End of RentalCarReservation.__construct() ========================================== */
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
    }   /* End of RentalCarReservation.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class RentalCarReservation ====================================================== */
/* ==================================================================================== */

?>