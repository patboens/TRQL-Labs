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
    {*file                  trql.reservation.class.php *}
    {*purpose               Describes a reservation for travel, dining or an event. Some
                            reservations require tickets. Note: This type is for
                            information about actual reservations, e.g. in confirmation
                            emails or HTML pages with individual confirmations of
                            reservations. For offers of tickets, restaurant
                            reservations, flights, or rental cars, use Offer. *}
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
namespace trql\reservation;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'RESERVATION_CLASS_VERSION' ) or define( 'RESERVATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Reservation=

    {*desc

        Describes a reservation for travel, dining or an event. Some reservations
        require tickets. Note: This type is for information about actual
        reservations, e.g. in confirmation emails or HTML pages with individual
        confirmations of reservations. For offers of tickets, restaurant
        reservations, flights, or rental cars, use Offer.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Reservation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class Reservation extends Intangible
/*--------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $bookingTime                    = null;             /* {*property   $bookingTime                    (DateTime)                      The date and time the reservation was booked. *} */
    public      $broker                         = null;             /* {*property   $broker                         (Person|Organization)           An entity that arranges for an exchange between a buyer and a seller.
                                                                                                                                                    In most cases a broker never acquires or releases ownership of a
                                                                                                                                                    product or service involved in an exchange. If it is not clear whether
                                                                                                                                                    an entity is a broker, seller, or buyer, the latter two terms are
                                                                                                                                                    preferred. *} */
    public      $modifiedTime                   = null;             /* {*property   $modifiedTime                   (DateTime)                      The date and time the reservation was modified. *} */
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
    public      $totalPrice                     = null;             /* {*property   $totalPrice                     (PriceSpecification|float|string)The total price for the reservation or ticket, including applicable
                                                                                                                                                    taxes, shipping, etc.Usage guidelines:Use values from 0123456789
                                                                                                                                                    (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than
                                                                                                                                                    superficially similiar Unicode symbols.Use '.' (Unicode 'FULL STOP'
                                                                                                                                                    (U+002E)) rather than ',' to indicate a decimal point. Avoid using
                                                                                                                                                    these symbols as a readability separator. *} */
    public      $underName                      = null;             /* {*property   $underName                      (Person|Organization)           The person or organization the reservation or ticket is for. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q64883416';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Booking  ... scheduling of a service, such as accommodation
                                                                                                                                                    in an hotel *} */

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
    }   /* End of Reservation.__construct() =========================================== */
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
    }   /* End of Reservation.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class Reservation ======================================================= */
/* ==================================================================================== */
?>