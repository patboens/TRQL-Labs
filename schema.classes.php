<?php
/**************************************************************************/
/** {{{*fheader
    {*file                  schema.classes.php *}
    {*purpose               Base classes as defined in schema.org *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            http://www.latosensu.be[br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 23/08/2019 - 19:13 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 26/08/2019 *}
        {*v 2.0.0001 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/**************************************************************************************/
namespace schemaorg;

use \trqlradio\vaesoliwrapper\vaesoli as vaesoli;

use DOMDocument;
use DOMXPath;

require_once( 'schema.datatypes.php' );

defined( 'SCHEMA_CLASSES_VERSION' ) or define( 'SCHEMA_CLASSES_VERSION','0.1' );

trait Feed
/*-------*/
{
    protected function subTag( $oXPath,$oNode,$szTag )
    /*----------------------------------------------*/
    {
        $szRetVal = null;

        if ( ( $o = @$oXPath->query( $szTag,$oNode ) ) && $o->length > 0 )
            $szRetVal = $o->item(0)->nodeValue;

        return ( $szRetVal );
    }

    protected function subTags( $oXPath,$oNode,$szTag )
    /*-----------------------------------------------*/
    {
        $list = null;

        if ( ( $o = $oXPath->query( $szTag,$oNode ) ) && $o->length > 0 )
            $list = $o;

        return ( $list );
    }

    /* ================================================================================ */
    /** {{*STR_iPos( $szStr,$szSubStr,$iStart )=

        Finds the position of first occurrence of a string ([b]case insensitive[/b])

        {*params
            $szStr      (string)    String to be searched
            $szSubStr   (string)    Substring to look for
            $iStart     (int)       Optional offset parameter to specify where
                                    searching must start. [c]0[/c] by default.
        *}

        {*return
            (int)       -1 if $szSubStr not found in $szStr; otherwise it
                        indicates the 1st position where $szSubStr is found
                        in $szStr
        *}

        {*assert
            STR_iPos( 'Hello','l' ) === 2
        *}

        {*assert
            STR_iPos( 'HeLlo','l' ) === 2
        *}

        {*assert
            STR_iPos( 'HeLlo','l',3 ) === 3
        *}

        {*assert
            STR_iPos( 'HeLlo','pa' ) === -1
        *}

        {*assert
             STR_iPos( 'C:/websites/latosensu.be/www/httpdocs/georama','C:/websites/latosensu.be/www/httpdocs' ) !== -1
        *}

        {*example
            echo STR_iPos( '/index.php;/Index.php','/' ); // Prints 0
        *}

        {*seealso
            STR_Pos()
        *}

        *}}
     */
    /* ================================================================================ */
    public function STR_iPos( $szStr,$szSubStr,$iStart = 0 )
    /*----------------------------------------------------*/
    {
        $iPos = stripos( $szStr,$szSubStr,$iStart );
        return ( $iPos === false ? -1 : $iPos );
    }   /* End of Feed.STR_iPos() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_Strin( $szStr,$iRid )=

        Returns $szStr amputated from the last character

        {*params
            $szStr      (string)    Input string
            $iRid       (int)       Number of characters to amputate $szStr from.
                                    Optional. 1 by default
        *}

        {*return
            (string)    The resulting string (length - $iRid characters).
        *}

        {*assert
            STR_Strin( 'Hello' ) === 'Hell'
        *}

        {*assert
            STR_Strin( 'Hello',2 ) === 'Hel'
        *}

        {*example
            $szFields =
            $szValues = '';

            foreach( $aFields as $szField => $szValue )  // For each field
            {
                $szFields   .= trim( $szField ) . ',';
                $szValues   .= trim( $szValue ) . ',';
            }

            $szFields = STR_Strin( $szFields );
            $szValues = STR_Strin( $szValues );
        *}
        *}}
     */
    /* ================================================================================ */
    function STR_Strin( $szStr,$iRid = 1 )
    /*----------------------------------*/
    {
        if ( ! empty( $szStr ) && $iRid > 0 )                       /* If string NOT empty and valid $iRid */
        {
            return ( substr( $szStr,0,-$iRid ) );                   /* Return string -iRid chars */
        }
        else
        {
            return ( $szStr );                                      /* Return result to caller (original string) */
        }
    }   /* End of function STR_Strin() ============================================== */
}


/* ================================================================================== */
/** {{*class Thing=

    {*desc
        The most generic type of item
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Thing[/url] *}

    *}}
 */
/* ================================================================================== */
class Thing
/*-------*/
{
    public $additionalType              = null;                     /* {*property   $additionalType             (string)                An additional type for the item,
                                                                                                                                        typically used for adding more
                                                                                                                                        specific types from external
                                                                                                                                        vocabularies in microdata syntax.
                                                                                                                                        This is a relationship between
                                                                                                                                        something and a class that the
                                                                                                                                        thing is in. In RDFa syntax, it is
                                                                                                                                        better to use the native RDFa
                                                                                                                                        syntax - the 'typeof' attribute
                                                                                                                                        - for multiple types. *} */

    public $alternateName               = null;                     /* {*property   $alternateName              (string)                An alias for the item. *} */

    public $description                 = null;                     /* {*property   $Description                (string)                A short description of the item. *} */

    public $disambiguatingDescription   = null;                     /* {*property   $disambiguatingDescription  (string)                A sub property of description. A
                                                                                                                                        short description of the item used
                                                                                                                                        to disambiguate from other, similar
                                                                                                                                        items. Information from other
                                                                                                                                        properties (in particular, name)
                                                                                                                                        may be necessary for the description
                                                                                                                                        to be useful for disambiguation. *} */

    public $image                       = null;                     /* {*property   $image                      (string)                URL of an image of the item. *} */

    public $identifier                  = null;                     /* {*property   $identifier                 (string)                The identifier property represents any
                                                                                                                                        kind of identifier for any kind of Thing,
                                                                                                                                        such as ISBNs, GTIN codes, UUIDs etc.
                                                                                                                                        http://schema.org provides dedicated
                                                                                                                                        properties for representing many of these,
                                                                                                                                        either as textual strings or as URL (URI)
                                                                                                                                        links. See <a
                                                                                                                                        href="https://schema.org/docs/datamodel.html#identifierBg">
                                                                                                                                        background notes</a>
                                                                                                                                        for more details. *} */

    public $mainEntityOfPage            = null;                     /* {*property   $mainEntityOfPage           (string)                Indicates a page (or other CreativeWork)
                                                                                                                                        for which this thing is the main entity
                                                                                                                                        being described. See <a
                                                                                                                                        href="https://schema.org/docs/datamodel.html#mainEntityBackground">
                                                                                                                                        background notes</a> for details.
                                                                                                                                        Inverse property: mainEntity. *} */
    public $name                        = null;                     /* {*property   $name                       (string)                The name of the item. *} */

    public $potentialAction             = null;                     /* {*property   $potentialAction            (Action)                Indicates a potential Action, which
                                                                                                                                        describes an idealized action in which
                                                                                                                                        this thing would play an 'object' role. *} */

    public $sameAs                      = null;                     /* {*property   $sameAs                     (string)                URL of a reference Web page that
                                                                                                                                        unambiguously indicates the item's
                                                                                                                                        identity. E.g. the URL of the
                                                                                                                                        item's Wikipedia page, Freebase
                                                                                                                                        page, or official website. *} */

    public $subjectOf                    = null;                     /* {*property   $sameAs                     (CreativeWork|Event)    A CreativeWork or Event about this Thing. Inverse property: about. *} */

    public $url                         = null;                     /* {*property   $url                        (string)                URL of the item. *} */


    public function __construct()
    /*-------------------------*/
    {
    }


}   /* End of class Thing =========================================================== */
/* ================================================================================== */


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
class Event extends Thing
/*---------------------*/
{
    public $about                       = null;                     /* {*property   $about                          (Thing)                                         The subject matter of the content.
                                                                                                                                                                    Inverse property: subjectOf. *} */

    public $actor                       = null;                     /* {*property   $actor                          (Person)                                        An actor, e.g. in tv, radio, movie, video games etc., or in an
                                                                                                                                                                    event. Actors can be associated with individual items or with a
                                                                                                                                                                    series, episode, clip. Supersedes actors. *} */
    public $aggregateRating             = null;                     /* {*property   $aggregateRating                (AggregateRating)                               The overall rating, based on a collection of reviews or ratings,
                                                                                                                                                                    of the item. *} */
    public $attendee                    = null;                     /* {*property   $attendee                       (Organization|Person)                           A person or organization attending the event. Supersedes attendees. *} */
    public $audience                    = null;                     /* {*property   $audience                       (Audience)                                      An intended audience, i.e. a group for whom something was created.
                                                                                                                                                                    Supersedes serviceAudience. *} */
    public $composer                    = null;                     /* {*property   $composer                       (Organization|Person)                           The person or organization who wrote a composition, or who is the
                                                                                                                                                                    composer of a work performed at some event. *} */
    public $contributor                 = null;                     /* {*property   $contributor                    (Organization|Person)                           A secondary contributor to the CreativeWork or Event. *} */
    public $director                    = null;                     /* {*property   $director                       (Person)                                        A director of e.g. tv, radio, movie, video gaming etc. content,
                                                                                                                                                                    or of an event. Directors can be associated with individual items or
                                                                                                                                                                    with a series, episode, clip. Supersedes directors. *} */
    public $doorTime                    = null;                     /* {*property   $doorTime                       (DateTime|Time)                                 The time admission will commence. *} */
    public $duration                    = null;                     /* {*property   $duration                       (Duration)                                      The duration of the item (movie, audio recording, event, etc.)
                                                                                                                                                                    in ISO 8601 date format. *} */
    public $endDate                     = null;                     /* {*property   $endDate                        (Date|DateTime)                                 The end date and time of the item (in ISO 8601 date format). *} */
    public $eventStatus                 = null;                     /* {*property   $eventStatus                    (EventStatusType)                               An eventStatus of an event represents its status; particularly useful
                                                                                                                                                                    when an event is cancelled or rescheduled. *} */
    public $funder                      = null;                     /* {*property   $funder                         (Organization|Person)                           A person or organization that supports (sponsors) something through
                                                                                                                                                                    some kind of financial contribution. *} */
    public $inLanguage                  = null;                     /* {*property   $inLanguage                     (Language|string)                               The language of the content or performance or used in an action.
                                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                                    See also availableLanguage. Supersedes language. *} */
    public $isAccessibleForFree         = null;                     /* {*property   $isAccessibleForFree            (Boolean)                                       A flag to signal that the item, event, or place is accessible for
                                                                                                                                                                    free. Supersedes free. *} */
    public $location                    = null;                     /* {*property   $location                       (Place|PostalAddress|string)                    The location of for example where the event is happening, an organization
                                                                                                                                                                    is located, or where an action takes place. *} */
    public $maximumAttendeeCapacity     = null;                     /* {*property   $maximumAttendeeCapacity        (Integer)                                       The total number of individuals that may attend an event or venue. *} */
    public $offers                      = null;                     /* {*property   $offers                         (Offer)                                         An offer to provide this item—for example, an offer to sell a product,
                                                                                                                                                                    rent the DVD of a movie, perform a service, or give away tickets to an
                                                                                                                                                                    event. *} */
    public $organizer                   = null;                     /* {*property   $organizer                      (Organization|Person)                           An organizer of an Event. *} */
    public $performer                   = null;                     /* {*property   $performer                      (Organization|Person)                           A performer at the event—for example, a presenter, musician, musical
                                                                                                                                                                    group or actor. Supersedes performers. *} */
    public $previousStartDate           = null;                     /* {*property   $previousStartDate              (Date)                                          Used in conjunction with eventStatus for rescheduled or cancelled events.
                                                                                                                                                                    This property contains the previously scheduled start date. For
                                                                                                                                                                    rescheduled events, the startDate property should be used for the newly
                                                                                                                                                                    scheduled start date. In the (rare) case of an event that has been
                                                                                                                                                                    postponed and rescheduled multiple times, this field may be repeated. *} */
    public $recordedIn                  = null;                     /* {*property   $recordedIn                     (CreativeWork)                                  The CreativeWork that captured all or part of this Event. Inverse
                                                                                                                                                                    property: recordedAt. *} */
    public $remainingAttendeeCapacity   = null;                     /* {*property   $remainingAttendeeCapacity      (Integer)                                       The number of attendee places for an event that remain unallocated. *} */
    public $review                      = null;                     /* {*property   $review                         (Review)                                        A review of the item. Supersedes reviews. *} */
    public $sponsor                     = null;                     /* {*property   $sponsor                        (Organization|Person)                           A person or organization that supports a thing through a pledge, promise,
                                                                                                                                                                    or financial contribution. e.g. a sponsor of a Medical Study or a corporate
                                                                                                                                                                    sponsor of an event. *} */
    public $startDate                   = null;                     /* {*property   $startDate                      (Date|DateTime)                                 The start date and time of the item (in ISO 8601 date format). *} */
    public $subEvent                    = null;                     /* {*property   $subEvent                       (Event)                                         An Event that is part of this event. For example, a conference event
                                                                                                                                                                    includes many presentations, each of which is a subEvent of the
                                                                                                                                                                    conference. Supersedes subEvents. Inverse property: superEvent. *} */
    public $superEvent                  = null;                     /* {*property   $superEvent                     (Event)                                         An event that this event is a part of. For example, a collection of
                                                                                                                                                                    individual music performances might each have a music festival as their
                                                                                                                                                                    superEvent. Inverse property: subEvent. *} */
    public $translator                  = null;                     /* {*property   $translator                     (Organization|Person)                           Organization or person who adapts a creative work to different languages,
                                                                                                                                                                    regional differences and technical requirements of a target market,
                                                                                                                                                                    or that translates during some event. *} */
    public $typicalAgeRange             = null;                     /* {*property   $typicalAgeRange                (string)                                        The typical expected age range, e.g. '7-9', '11-'. *} */
    public $workFeatured                = null;                     /* {*property   $workFeatured                   (CreativeWork)                                  A work featured in some event, e.g. exhibited in an ExhibitionEvent.
                                                                                                                                                                    Specific subproperties are available for workPerformed (e.g. a play),
                                                                                                                                                                    or a workPresented (a Movie at a ScreeningEvent). *} */
    public $workPerformed               = null;                     /* {*property   $workPerformed                  (CreativeWork)                                  A work performed in some event, for example a play performed in a
                                                                                                                                                                    TheaterEvent. *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }
}   /* End of class Event =========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Offer=

    {*desc

        An offer to transfer some rights to an item or to provide a service —
        for example, an offer to sell tickets to an event, to rent the DVD of a
        movie, to stream a TV show over the internet, to repair a motorcycle, or
        to loan a book.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Offer[/url] *}

    *}}
 */
/* ================================================================================== */
class Offer extends Intangible
/*--------------------------*/
{
    public      $about                      = null;                 /* {*property   $about                          (Thing)                                         The subject matter of the content.
                                                                                                                                                                    Inverse property: subjectOf. *} */
    public      $acceptedPaymentMethod      = null;                 /* {*property   $acceptedPaymentMethod          (LoanOrCredit|PaymentMethod)                    The payment method(s) accepted by seller for this offer. *} */
    public      $addOn                      = null;                 /* {*property   $addOn                          (Offer                                          An additional offer that can only be obtained in combination with the first
                                                                                                                                                                    base offer (e.g. supplements and extensions that are available for a surcharge). *} */
    public      $advanceBookingRequirement  = null;                 /* {*property   $advanceBookingRequirement      (QuantitativeValue)                             The amount of time that is required between accepting the offer and the actual
                                                                                                                                                                    usage of the resource or service. *} */
    public      $aggregateRating            = null;                 /* {*property   $aggregateRating                (AggregateRating)                               The overall rating, based on a collection of reviews or ratings, of the item. *} */
    public      $areaServed                 = null;                 /* {*property   $areaServed                     (AdministrativeArea|GeoShape|Place|Text)        The geographic area where a service or offered item is provided.
                                                                                                                                                                    Supersedes serviceArea. *} */
    public      $availability               = null;                 /* {*property   $availability                   (ItemAvailability)                              The availability of this item—for example In stock, Out of stock, Pre-order, etc. *} */
    public      $availabilityEnds           = null;                 /* {*property   $availabilityEnds               (Date|DateTime|Time)                            The end of the availability of the product or service included in the offer. *} */
    public      $availabilityStarts         = null;                 /* {*property   $availabilityStarts             (Date|DateTime|Time)                            The beginning of the availability of the product or service included in the offer. *} */
    public      $availableAtOrFrom          = null;                 /* {*property   $availableAtOrFrom              (Place)                                         The place(s) from which the offer can be obtained (e.g. store locations). *} */
    public      $availableDeliveryMethod    = null;                 /* {*property   $availableDeliveryMethod        (DeliveryMethod)                                The delivery method(s) available for this offer. *} */
    public      $businessFunction           = null;                 /* {*property   $businessFunction               (BusinessFunction)                              The business function (e.g. sell, lease, repair, dispose) of the offer
                                                                                                                                                                    or component of a bundle (TypeAndQuantityNode). The default is
                                                                                                                                                                    http://purl.org/goodrelations/v1#Sell. *} */
    public      $category                   = null;                 /* {*property   $category                       (PhysicalActivityCategory|Text|Thing)           A category for the item. Greater signs or slashes can be used to
                                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $deliveryLeadTime           = null;                 /* {*property   $deliveryLeadTime               (QuantitativeValue)                             The typical delay between the receipt of the order and the goods either
                                                                                                                                                                    leaving the warehouse or being prepared for pickup, in case the delivery
                                                                                                                                                                    method is on site pickup. *} */
    public      $eligibleCustomerType       = null;                 /* {*property   $eligibleCustomerType           (BusinessEntityType)                            The type(s) of customers for which the given offer is valid. *} */
    public      $eligibleDuration           = null;                 /* {*property   $eligibleDuration               (QuantitativeValue)                             The duration for which the given offer is valid. *} */
    public      $eligibleQuantity           = null;                 /* {*property   $eligibleQuantity               (QuantitativeValue)                             The interval and unit of measurement of ordering quantities for which the
                                                                                                                                                                    offer or price specification is valid. This allows e.g. specifying that a
                                                                                                                                                                    certain freight charge is valid only for a certain quantity. *} */
    public      $eligibleRegion             = null;                 /* {*property   $eligibleRegion                 (GeoShape|Place|Text)                           The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the
                                                                                                                                                                    GeoShape for the geo-political region(s) for which the offer or delivery
                                                                                                                                                                    charge specification is valid.

                                                                                                                                                                    See also ineligibleRegion. *} */

    public      $eligibleTransactionVolume  = null;                 /* {*property   $eligibleTransactionVolume      (PriceSpecification)                            The transaction volume, in a monetary unit, for which the offer or
                                                                                                                                                                    price specification is valid, e.g. for indicating a minimal purchasing
                                                                                                                                                                    volume, to express free shipping above a certain order volume, or to
                                                                                                                                                                    limit the acceptance of credit cards to purchases to a certain minimal
                                                                                                                                                                    amount. *} */
    public      $gtin                       = null;                 /* {*property   $gtin                           (Text)                                          A Global Trade Item Number (GTIN). GTINs identify trade items, including
                                                                                                                                                                    products and services, using numeric identification codes. The gtin
                                                                                                                                                                    property generalizes the earlier gtin8, gtin12, gtin13, and gtin14
                                                                                                                                                                    properties. The GS1 digital link specifications express GTINs as URLs.
                                                                                                                                                                    A correct gtin value should be a valid GTIN, which means that it should
                                                                                                                                                                    be an all-numeric string of either 8, 12, 13 or 14 digits, or a
                                                                                                                                                                    "GS1 Digital Link" URL based on such a string. The numeric component
                                                                                                                                                                    should also have a valid GS1 check digit and meet the other rules for
                                                                                                                                                                    valid GTINs. See also GS1's GTIN Summary and Wikipedia for more details.
                                                                                                                                                                    Left-padding of the gtin values is not required or encouraged. *} */
    public      $gtin12                     = null;                 /* {*property   $gtin12                         (Text)                                          The GTIN-12 code of the product, or the product to which the offer
                                                                                                                                                                    refers. The GTIN-12 is the 12-digit GS1 Identification Key composed
                                                                                                                                                                    of a U.P.C. Company Prefix, Item Reference, and Check Digit used to
                                                                                                                                                                    identify trade items. See GS1 GTIN Summary for more details. *} */
    public      $gtin13                     = null;                 /* {*property   $gtin13                         (Text)                                          The GTIN-13 code of the product, or the product to which the offer
                                                                                                                                                                    refers. This is equivalent to 13-digit ISBN codes and EAN UCC-13.
                                                                                                                                                                    Former 12-digit UPC codes can be converted into a GTIN-13 code by simply
                                                                                                                                                                    adding a preceeding zero. See GS1 GTIN Summary for more details. *} */
    public      $gtin14                     = null;                 /* {*property   $gtin14                         (Text)                                          The GTIN-14 code of the product, or the product to which the offer
                                                                                                                                                                    refers. See GS1 GTIN Summary for more details. *} */
    public      $gtin8                      = null;                 /* {*property   $gtin8                          (Text)                                          The GTIN-8 code of the product, or the product to which the offer
                                                                                                                                                                    refers. This code is also known as EAN/UCC-8 or 8-digit EAN. See
                                                                                                                                                                    GS1 GTIN Summary for more details. *} */
    public      $includesObject             = null;                 /* {*property   $includesObject                 (TypeAndQuantityNode)                           This links to a node or nodes indicating the exact quantity of the
                                                                                                                                                                    products included in the offer. *} */
    public      $ineligibleRegion           = null;                 /* {*property   $ineligibleRegion               (GeoShape|Place|Text)                           The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or
                                                                                                                                                                    the GeoShape for the geo-political region(s) for which the offer or
                                                                                                                                                                    delivery charge specification is not valid, e.g. a region where the
                                                                                                                                                                    transaction is not allowed. See also eligibleRegion. *}*/
    public      $inventoryLevel             = null;                 /* {*property   $inventoryLevel                 (QuantitativeValue)                             The current approximate inventory level for the item or items. *} */
    public      $itemCondition              = null;                 /* {*property   $itemCondition                  (OfferItemCondition)                            A predefined value from OfferItemCondition or a textual description of
                                                                                                                                                                    the condition of the product or service, or the products or services
                                                                                                                                                                    included in the offer. *} */
    public      $itemOffered                = null;                 /* {*property   $itemOffered                    (Product|Service)                               The item being offered. *} */
    public      $mpn                        = null;                 /* {*property   $mpn                            (Text)                                          The Manufacturer Part Number (MPN) of the product, or the product to
                                                                                                                                                                    which the offer refers. *} */
    public      $offeredBy                  = null;                 /* {*property   $offeredBy                      (Organization|Person)                           A pointer to the organization or person making the offer. Inverse
                                                                                                                                                                    property: makesOffer. *} */
    public      $price                      = null;                 /* {*property   $price                          (Number|Text)                                   The offer price of a product, or of a price component when attached
                                                                                                                                                                    to PriceSpecification and its subtypes.

                                                                                                                                                                    Usage guidelines:

                                                                                                                                                                    - Use the priceCurrency property (with standard formats: ISO 4217
                                                                                                                                                                      currency format e.g. "USD"; Ticker symbol for cryptocurrencies
                                                                                                                                                                      e.g. "BTC"; well known names for Local Exchange Tradings Systems
                                                                                                                                                                      (LETS) and other currency types e.g. "Ithaca HOUR") instead of
                                                                                                                                                                      including ambiguous symbols such as '$' in the value.[br]
                                                                                                                                                                    - Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate
                                                                                                                                                                      a decimal point. Avoid using these symbols as a readability separator.[br]
                                                                                                                                                                    - Note that both RDFa and Microdata syntax allow the use of a
                                                                                                                                                                      "content=" attribute for publishing simple machine-readable values
                                                                                                                                                                      alongside more human-friendly formatting.[br]
                                                                                                                                                                    - Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to
                                                                                                                                                                      'DIGIT NINE' (U+0039)) rather than superficially similiar Unicode
                                                                                                                                                                      symbols. [br] *} */

    public      $priceCurrency              = null;                 /* {*property   $priceCurrency                  (Text)                                          The currency of the price, or a price component when attached to
                                                                                                                                                                    PriceSpecification and its subtypes.

                                                                                                                                                                    Use standard formats: ISO 4217 currency format e.g. "USD"; Ticker
                                                                                                                                                                    symbol for cryptocurrencies e.g. "BTC"; well known names for Local
                                                                                                                                                                    Exchange Tradings Systems (LETS) and other currency types
                                                                                                                                                                    e.g. "Ithaca HOUR". *} */

    public      $priceSpecification         = null;                 /* {*property   $priceSpecification             (PriceSpecification)                            One or more detailed price specifications, indicating the unit price
                                                                                                                                                                    and delivery or payment charges.  *} */
    public      $priceValidUntil            = null;                 /* {*property   $priceValidUntil                (Date)                                          The date after which the price is no longer available. *} */
    public      $review                     = null;                 /* {*property   $review                         (Review)                                        A review of the item. Supersedes reviews. *} */
    public      $seller                     = null;                 /* {*property   $seller                         (Organization|Person)                           An entity which offers (sells / leases / lends / loans) the
                                                                                                                                                                    services / goods. A seller may also be a provider.
                                                                                                                                                                    Supersedes merchant, vendor. *} */
    public      $serialNumber               = null;                 /* {*property   $serialNumber                   (Text)                                          The serial number or any alphanumeric identifier of a particular
                                                                                                                                                                    product. When attached to an offer, it is a shortcut for the serial
                                                                                                                                                                    number of the product included in the offer. *} */
    public      $sku                        = null;                 /* {*property   $sku                            (Text)                                          The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier
                                                                                                                                                                    for a product or service, or the product to which the offer refers. *} */
    public      $validFrom                  = null;                 /* {*property   $validFrom                      (Date|DateTime)                                 The date when the item becomes valid. *} */
    public      $validThrough               = null;                 /* {*property   $validThrough                   (Date|DateTime)                                 The date after when the item is not valid. For example the end of
                                                                                                                                                                    an offer, salary period, or a period of opening hours. *} */
    public      $warranty                   = null;                 /* {*property   $warranty                       (WarrantyPromise)                               The warranty promise(s) included in the offer.
                                                                                                                                                                    Supersedes warrantyPromise. *} */

    /* Not in schema.org */
    public      $cargo                      = null;                 /* {*property   $cargo                          (mixed)                                         Any sort of additional information a developer would need *} */
}   /* End of class Offer =========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class CreativeWork=

    {*desc

        The most generic kind of creative work, including books, movies,
        photographs, software programs, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWork[/url] *}

    *}}
 */
/* ================================================================================== */
class CreativeWork extends Thing
/*----------------------------*/
{
    public $about                       = null;                     /* {*property   $about                      (Thing)                         The subject matter of the content. Inverse property: subjectOf *} */
    public $accessMode                  = null;                     /* {*property   $accessMode                 (string)                        The human sensory perceptual system or cognitive faculty
                                                                                                                                                through which a person may process or perceive information.
                                                                                                                                                Expected values include: auditory, tactile, textual, visual,
                                                                                                                                                colorDependent, chartOnVisual, chemOnVisual, diagramOnVisual,
                                                                                                                                                mathOnVisual, musicOnVisual, textOnVisual. *} */
    public $accessModeSufficient        = null;                     /* {*property   $accessModeSufficient       (ItemList)                      A list of single or combined accessModes that are sufficient
                                                                                                                                                to understand all the intellectual content of a resource.
                                                                                                                                                Expected values include: auditory, tactile, textual, visual. *} */
    public $accessibilityAPI            = null;                     /* {*property   $accessibilityAPI           (string)                        Indicates that the resource is compatible with the referenced
                                                                                                                                                accessibility API (WebSchemas wiki lists possible values). *} */
    public $accessibilityControl        = null;                     /* {*property   $accessibilityControl       (string)                        Identifies input methods that are sufficient to fully
                                                                                                                                                control the described resource (WebSchemas wiki lists
                                                                                                                                                possible values). *} */
    public $accessibilityFeature        = null;                     /* {*property   $accessibilityFeature       (string)                        Content features of the resource, such as accessible media,
                                                                                                                                                alternatives and supported enhancements for accessibility
                                                                                                                                                (WebSchemas wiki lists possible values). *} */
    public $accessibilityHazard         = null;                     /* {*property   $accessibilityHazard        (string)                        A characteristic of the described resource that is
                                                                                                                                                physiologically dangerous to some users. Related to WCAG 2.0
                                                                                                                                                guideline 2.3 (WebSchemas wiki lists possible values). *} */
    public $accessibilitySummary        = null;                     /* {*property   $accessibilitySummary       (string)                        A human-readable summary of specific accessibility features
                                                                                                                                                or deficiencies, consistent with the other accessibility
                                                                                                                                                metadata but expressing subtleties such as "short
                                                                                                                                                descriptions are present but long descriptions will be needed
                                                                                                                                                for non-visual users" or "short descriptions are present and
                                                                                                                                                no long descriptions are needed." *} */
    public $accountablePerson           = null;                     /* {*property   $accountablePerson          (Person)                        Specifies the Person that is legally accountable for the
                                                                                                                                                CreativeWork. *} */
    public $aggregateRating             = null;                     /* {*property   $aggregateRating            (AggregateRating)               The overall rating, based on a collection of reviews or ratings,
                                                                                                                                                of the item. *} */
    public $alternativeHeadline         = null;                     /* {*property   $alternativeHeadline        (string)                        A secondary title of the CreativeWork. *} */
    public $associatedMedia             = null;                     /* {*property   $associatedMedia            (MediaObject)                   A media object that encodes this CreativeWork. This property
                                                                                                                                                is a synonym for encoding. *} */
    public $audience                    = null;                     /* {*property   $audience                   (Audience)                      An intended audience, i.e. a group for whom something was
                                                                                                                                                created. *} */
    public $audio                       = null;                     /* {*property   $audio                      (AudioObject|Clip)              An embedded audio object. *} */
    public $author                      = null;                     /* {*property   $author                     (Organization|Person)           The author of this content or rating. Please note that author
                                                                                                                                                is special in that HTML 5 provides a special mechanism for
                                                                                                                                                indicating authorship via the rel tag. That is equivalent to
                                                                                                                                                this and may be used interchangeably. *} */
    public $award                       = null;                     /* {*property   $award                      (string)                        An award won by or for this item. Supersedes awards. *} */
    public $character                   = null;                     /* {*property   $character                  (Person                         Fictional person connected with a creative work. *} */
    public  $citation                   = null;                     /* {*property   $citation                   (CreativeWork|string)           A citation or reference to another creative work, such
                                                                                                                                                as another publication, web page, scholarly article, etc. *} */
    public  $comment                    = null;                     /* {*property   $comment                    (Comment)                       Comments, typically from users. *} */
    public  $commentCount               = null;                     /* {*property   $commentCount               (int)                           The number of comments this CreativeWork (e.g. Article,
                                                                                                                                                Question or Answer) has received. This is most applicable to
                                                                                                                                                works published in Web sites with commenting system;
                                                                                                                                                additional comments may exist elsewhere. *} */
    public  $conditionsOfAccess         = null;                     /* {*property   $conditionsOfAccess         (string)                        Conditions that affect the availability of, or method(s) of
                                                                                                                                                access to, an item. Typically used for real world items such
                                                                                                                                                as an ArchiveComponent held by an ArchiveOrganization.
                                                                                                                                                This property is not suitable for use as a general Web access
                                                                                                                                                control mechanism. It is expressed only in natural language. *} */
    public  $contentLocation            = null;                     /* {*property   $contentLocation            (Place)                         The location depicted or described in the content. For example,
                                                                                                                                                the location in a photograph or painting. *} */
    public  $contentRating              = null;                     /* {*property   $contentRating              (Rating|string)                 Official rating of a piece of content—for example,'MPAA PG-13'. *} */
    public  $contentReferenceTime       = null;                     /* {*property   $contentReferenceTime       (DateTime)                      The specific time described by a creative work, for works
                                                                                                                                                (e.g. articles, video objects etc.) that emphasise a
                                                                                                                                                particular moment within an Event. *} */
    public  $contributor                = null;                     /* {*property   $contributor                (Organization|Person)           A secondary contributor to the CreativeWork or Event. *} */
    public  $copyrightHolder            = null;                     /* {*property   $copyrightHolder            (Organization|Person)           The party holding the legal copyright to the CreativeWork. *} */
    public  $copyrightYear              = null;                     /* {*property   $copyrightYear              (Number)                        The year during which the claimed copyright for the
                                                                                                                                                CreativeWork was first asserted. *} */
    public  $correction                 = null;                     /* {*property   $correction                 (CorrectionComment|string|URL)  Indicates a correction to a CreativeWork, either via a
                                                                                                                                                CorrectionComment, textually or in another document. *} */
    public  $creativeWorkStatus         = null;                     /* {*property   $creativeWorkStatus         (DefinedTerm|string)            The status of a creative work in terms of its stage in a lifecycle.
                                                                                                                                                Example terms include Incomplete, Draft, Published, Obsolete.
                                                                                                                                                Some organizations define a set of terms for the stages of their
                                                                                                                                                publication lifecycle. *} */
    public  $creator                    = null;                     /* {*property   $creator                    (Organization|Person)           The creator/author of this CreativeWork. This is the same as
                                                                                                                                                the Author property for CreativeWork. *} */
    public  $dateCreated                = null;                     /* {*property   $dateCreated                (Date|DateTime)                 The date on which the CreativeWork was created or the item was
                                                                                                                                                added to a DataFeed. *} */
    public  $dateModified               = null;                     /* {*property   $dateModified               (Date|DateTime)                 The date on which the CreativeWork was most recently modified or
                                                                                                                                                when the item's entry was modified within a DataFeed. *} */
    public  $datePublished              = null;                     /* {*property   $datePublished              (Date)                          Date of first broadcast/publication. *} */
    public  $discussionUrl              = null;                     /* {*property   $discussionUrl              (URL)                           A link to the page containing the comments of the CreativeWork. *} */
    public  $editor                     = null;                     /* {*property   $editor                     (Person)                        Specifies the Person who edited the CreativeWork. *} */
    public  $educationalAlignment       = null;                     /* {*property   $educationalAlignment       (AlignmentObject)               An alignment to an established educational framework. *} */
    public  $educationalUse             = null;                     /* {*property   $educationalUse             (string)                        The purpose of a work in the context of education;
                                                                                                                                                for example, 'assignment', 'group work'. *} */
    public  $encoding                   = null;                     /* {*property   $encoding                   (MediaObject)                   A media object that encodes this CreativeWork. This property is
                                                                                                                                                a synonym for associatedMedia. Supersedes encodings.
                                                                                                                                                Inverse property: encodesCreativeWork. *} */
    public  $encodingFormat             = null;                     /* {*property   $encodingFormat             (string|URL)                    Media type typically expressed using a MIME format
                                                                                                                                                (see IANA site and MDN reference) e.g. application/zip for
                                                                                                                                                a SoftwareApplication binary, audio/mpeg for .mp3 etc.). *} */
    public  $exampleOfWork              = null;                     /* {*property   $exampleOfWork              (CreativeWork)                  A creative work that this work is an
                                                                                                                                                example/instance/realization/derivation of.
                                                                                                                                                Inverse property: workExample. *} */
    public  $expires                    = null;                     /* {*property   $expires                    (Date)                          Date the content expires and is no longer useful or available.
                                                                                                                                                For example a VideoObject or NewsArticle whose availability or
                                                                                                                                                relevance is time-limited, or a ClaimReview fact check whose
                                                                                                                                                publisher wants to indicate that it may no longer be relevant
                                                                                                                                                (or helpful to highlight) after some date. *} */
    public  $funder                     = null;                     /* {*property   $funder                     (Organization|Person)           A person or organization that supports (sponsors) something
                                                                                                                                                through some kind of financial contribution. *} */
    public  $genre                      = null;                     /* {*property   $genre                      (string|URL)                    Genre of the creative work, broadcast channel or group. *} */
    public  $hasPart                    = null;                     /* {*property   $hasPart                    (CreativeWork)                  Indicates an item or CreativeWork that is part of this item,
                                                                                                                                                or CreativeWork (in some sense). Inverse property: isPartOf. *} */
    public  $headline                   = null;                     /* {*property   $headline                   (string)                        Headline of the article. *} */
    public  $inLanguage                 = null;                     /* {*property   $inLanguage                 (Language|string)               The language of the content or performance or used in an
                                                                                                                                                action. Please use one of the language codes from the
                                                                                                                                                IETF BCP 47 standard. See also availableLanguage.
                                                                                                                                                Supersedes language. *} */
    public  $interactionStatistic       = null;                     /* {*property   $interactionStatistic       (InteractionCounter)            The number of interactions for the CreativeWork using the
                                                                                                                                                WebSite or SoftwareApplication. The most specific child
                                                                                                                                                type of InteractionCounter should be used.
                                                                                                                                                Supersedes interactionCount. *} */
    public  $interactivityType          = null;                     /* {*property   $interactivityType          (string)                        The predominant mode of learning supported by the learning
                                                                                                                                                resource. Acceptable values are 'active',
                                                                                                                                                'expositive', or 'mixed'. *} */
    public  $isAccessibleForFree        = null;                     /* {*property   $isAccessibleForFree        (Boolean)                       A flag to signal that the item, event, or place is accessible
                                                                                                                                                for free. Supersedes free. *} */
    public  $isBasedOn                  = null;                     /* {*property   $isBasedOn                  (CreativeWork|Product|URL)      A resource from which this work is derived or from which it
                                                                                                                                                is a modification or adaption. Supersedes isBasedOnUrl. *} */
    public  $isFamilyFriendly           = null;                     /* {*property   $isFamilyFriendly           (Boolean)                       Indicates whether this content is family friendly. *} */
    public  $isPartOf                   = null;                     /* {*property   $isPartOf                   (CreativeWork)                  Indicates an item or CreativeWork that this item, or
                                                                                                                                                CreativeWork (in some sense), is part of.
                                                                                                                                                Inverse property: hasPart. *} */
    public  $keywords                   = null;                     /* {*property   $keywords                   (string)                        Keywords or tags used to describe this content. Multiple
                                                                                                                                                entries in a keywords list are typically delimited by commas. *} */
    public  $learningResourceType       = null;                     /* {*property   $learningResourceType       (string)                        The predominant type or kind characterizing the learning
                                                                                                                                                resource. For example, 'presentation', 'handout'. *} */
    public  $license                    = null;                     /* {*property   $license                    (CreativeWork|URL)              A license document that applies to this content, typically
                                                                                                                                                indicated by URL. *} */
    public  $locationCreated            = null;                     /* {*property   $locationCreated            (Place)                         The location where the CreativeWork was created, which may
                                                                                                                                                not be the same as the location depicted in the CreativeWork. *} */
    public  $mainEntity                 = null;                     /* {*property   $mainEntity                 (Thing)                         Indicates the primary entity described in some page or
                                                                                                                                                other CreativeWork. Inverse property: mainEntityOfPage. *} */
    public  $material                   = null;                     /* {*property   $material                   (Product|string|URL)            A material that something is made from,
                                                                                                                                                e.g. leather, wool, cotton, paper. *} */
    public  $materialExtent             = null;                     /* {*property   $materialExtent             (QuantitativeValue|string)      The quantity of the materials being described or an expression
                                                                                                                                                of the physical space they occupy. *} */
    public  $mentions                   = null;                     /* {*property   $mentions                   (Thing)                         Indicates that the CreativeWork contains a reference to, but
                                                                                                                                                is not necessarily about a concept. *} */
    public  $offers                     = null;                     /* {*property   $offers                     (Offer)                         An offer to provide this item—for example, an offer to sell
                                                                                                                                                a product, rent the DVD of a movie, perform a service, or
                                                                                                                                                give away tickets to an event. *} */
    public  $position                   = null;                     /* {*property   $position                   (int|string)                    The position of an item in a series or sequence of items. *} */
    public  $producer                   = null;                     /* {*property   $producer                   (Organization|Person)           The person or organization who produced the work
                                                                                                                                                (e.g. music album, movie, tv/radio series etc.). *} */
    public  $provider                   = null;                     /* {*property   $provider                   (Organization|Person)           The service provider, service operator, or service performer;
                                                                                                                                                the goods producer. Another party (a seller) may offer those
                                                                                                                                                services or goods on behalf of the provider. A provider may
                                                                                                                                                also serve as the seller. Supersedes carrier. *} */
    public  $publication                = null;                     /* {*property   $publication                (PublicationEvent)              A publication event associated with the item. *} */
    public  $publisher                  = null;                     /* {*property   $publisher                  (Organization|Person)           The publisher of the creative work. *} */
    public  $publisherImprint           = null;                     /* {*property   $publisherImprint           (Organization)                  The publishing division which published the comic. *} */
    public  $publishingPrinciples       = null;                     /* {*property   $publishingPrinciples       (CreativeWork|URL)              The publishingPrinciples property indicates (typically via URL)
                                                                                                                                                a document describing the editorial principles of an Organization
                                                                                                                                                (or individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                activities as a publisher, e.g. ethics or diversity policies.
                                                                                                                                                When applied to a CreativeWork (e.g. NewsArticle) the principles
                                                                                                                                                are those of the party primarily responsible for the creation of
                                                                                                                                                the CreativeWork.

                                                                                                                                                While such policies are most typically expressed in natural
                                                                                                                                                language, sometimes related information (e.g. indicating a funder)
                                                                                                                                                can be expressed using schema.org terminology. *} */

    public $recordedAt                  = null;                     /* {*property   $recordedAt                 (Event)                         The Event where the CreativeWork was recorded. The CreativeWork may capture
                                                                                                                                                all or part of the event. Inverse property: recordedIn. *} */
    public $releasedEvent               = null;                     /* {*property   $releasedEvent              (PublicationEvent)              The place and time the release was issued, expressed as a PublicationEvent. *} */
    public $review                      = null;                     /* {*property   $review                     (Review)                        A review of the item. Supersedes reviews. *} */
    public $schemaVersion               = null;                     /* {*property   $schemaVersion              (string|URL)                    Indicates (by URL or string) a particular version of a schema used
                                                                                                                                                in some CreativeWork. For example, a document could declare a
                                                                                                                                                schemaVersion using an URL such as http://schema.org/version/2.0/ if
                                                                                                                                                precise indication of schema version was required by some application. *} */
    public $sdDatePublished             = null;                     /* {*property   $sdDatePublished            (Date)                          Indicates the date on which the current structured data was
                                                                                                                                                generated / published. Typically used alongside sdPublisher *} */
    public $sdLicense                   = null;                     /* {*property   $sdLicense                  (CreativeWork|URL)              A license document that applies to this structured data, typically
                                                                                                                                                indicated by URL. *} */
    public $sdPublisher                 = null;                     /* {*property   $sdPublisher                (Organization|Person)           Indicates the party responsible for generating and publishing the current
                                                                                                                                                structured data markup, typically in cases where the structured data is
                                                                                                                                                derived automatically from existing published content but published on a
                                                                                                                                                different site. For example, student projects and open data initiatives
                                                                                                                                                often re-publish existing content with more explicitly structured metadata.
                                                                                                                                                The sdPublisher property helps make such practices more explicit. *} */
    public $sourceOrganization          = null;                     /* {*property   $sourceOrganization         (Organization)                  The Organization on whose behalf the creator was working. *} */
    public $spatial                     = null;                     /* {*property   $spatial                    (Place)                         The "spatial" property can be used in cases when more specific properties
                                                                                                                                                (e.g. locationCreated, spatialCoverage, contentLocation) are not known
                                                                                                                                                to be appropriate. *} */
    public $spatialCoverage             = null;                     /* {*property   $spatialCoverage            (Place)                         The spatialCoverage of a CreativeWork indicates the place(s) which are
                                                                                                                                                the focus of the content. It is a subproperty of contentLocation intended
                                                                                                                                                primarily for more technical and detailed materials. For example with a
                                                                                                                                                Dataset, it indicates areas that the dataset describes: a dataset of
                                                                                                                                                New York weather would have spatialCoverage which was the place:
                                                                                                                                                the state of New York. *} */
    public $sponsor                     = null;                     /* {*property   $sponsor                    (Organization|Person)           A person or organization that supports a thing through a pledge, promise,
                                                                                                                                                or financial contribution. e.g. a sponsor of a Medical Study or a corporate
                                                                                                                                                sponsor of an event. *} */
    public $temporal                    = null;                     /* {*property   $temporal                   (DateTime|string)               The "temporal" property can be used in cases where more specific
                                                                                                                                                properties (e.g. temporalCoverage, dateCreated, dateModified, datePublished)
                                                                                                                                                are not known to be appropriate. *} */
    public $temporalCoverage            = null;                     /* {*property   $temporalCoverage           (DateTime|string|URL)           The temporalCoverage of a CreativeWork indicates the period that the
                                                                                                                                                content applies to, i.e. that it describes, either as a DateTime or as a
                                                                                                                                                textual string indicating a time period in ISO 8601 time interval format.
                                                                                                                                                In the case of a Dataset it will typically indicate the relevant time
                                                                                                                                                period in a precise notation (e.g. for a 2011 census dataset, the year 2011
                                                                                                                                                would be written "2011/2012"). Other forms of content e.g. ScholarlyArticle,
                                                                                                                                                Book, TVSeries or TVEpisode may indicate their temporalCoverage in broader
                                                                                                                                                terms - textually or via well-known URL. Written works such as books may
                                                                                                                                                sometimes have precise temporal coverage too, e.g. a work set in
                                                                                                                                                1939 - 1945 can be indicated in ISO 8601 interval format format via
                                                                                                                                                "1939/1945".

                                                                                                                                                Open-ended date ranges can be written with ".." in place of the end date.
                                                                                                                                                For example, "2015-11/.." indicates a range beginning in November 2015 and
                                                                                                                                                with no specified final date. This is tentative and might be updated in
                                                                                                                                                future when ISO 8601 is officially updated. Supersedes datasetTimeInterval. *} */

    public $text                        = null;                     /* {*property   $text                       (string)                        The textual content of this CreativeWork. *} */
    public $thumbnailUrl                = null;                     /* {*property   $thumbnailUrl               (URL)                           A thumbnail image relevant to the Thing. *} */
    public $timeRequired                = null;                     /* {*property   $timeRequired               (Duration)                      Approximate or typical time it takes to work with or through this learning
                                                                                                                                                resource for the typical intended target audience, e.g. 'PT30M', 'PT1H25M'. *} */
    public $translationOfWork           = null;                     /* {*property   $translationOfWork          (CreativeWork)                  The work that this work has been translated from. e.g. 物种起源 is a
                                                                                                                                                translationOf “On the Origin of Species” Inverse property: workTranslation. *} */
    public $translator                  = null;                     /* {*property   $translator                 (Organization|Person)           Organization |Person) who adapts a creative work to different languages,
                                                                                                                                                regional differences and technical requirements of a target market, or that
                                                                                                                                                translates during some event. *} */
    public $typicalAgeRange             = null;                     /* {*property   $typicalAgeRange            (string)                        The typical expected age range, e.g. '7-9', '11-'. *} */
    public $version                     = null;                     /* {*property   $version                    (Number|string)                 The version of the CreativeWork embodied by a specified resource. *} */
    public $video                       = null;                     /* {*property   $video                      (Clip|VideoObject)              An embedded video object. *} */
    public $workExample                 = null;                     /* {*property   $workExample                (CreativeWork)                  Example/instance/realization/derivation of the concept of this creative
                                                                                                                                                work. eg. The paperback edition, first edition, or eBook.
                                                                                                                                                Inverse property: exampleOfWork. *} */
    public $workTranslation             = null;                     /* {*property   $workTranslation            (CreativeWork)                  A work that is a translation of the content of this work. e.g. 西遊記 has
                                                                                                                                                an English workTranslation “Journey to the West”,a German workTranslation
                                                                                                                                                “Monkeys Pilgerfahrt” and a Vietnamese translation Tây du ký bình khảo.
                                                                                                                                                Inverse property: translationOfWork. *} */
/*


A REPLACER OÙ DE DROIT

For example "Available by appointment from the Reading Room" or "Accessible only from logged-in accounts ".



In cases where a CreativeWork has several media type representations, encoding can be used to indicate each MediaObject alongside particular encodingFormat information.

Unregistered or niche encoding and file formats can be indicated instead via the most appropriate URL, e.g. defining Web page or a Wikipedia/Wikidata entry. Supersedes fileFormat.


FIN DE A REPLACER OU DE DROIT

*/

}   /* End of class CreativeWork ==================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Course=

    {*desc

        A description of an educational course which may be offered as distinct
        instances at which take place at different times or take place at
        different locations, or be offered through different media or modes of
        study. An educational course is a sequence of one or more educational
        events and/or creative works which aims to build knowledge, competence
        or ability of learners.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Course[/url] *}

    *}}
 */
/* ================================================================================== */
class Course extends CreativeWork
/*-----------------------------*/
{
    public $courseCode                      = null;                 /* {*property   $courseCode                     (string)                                        The identifier for the Course used by the course provider
                                                                                                                                                                    (e.g. CS101 or 6.001) *} */
    public $coursePrerequisites             = null;                 /* {*property   $coursePrerequisites            (AlignmentObject|Course|string)                 Requirements for taking the Course. May be completion of
                                                                                                                                                                    another Course or a textual description like "permission
                                                                                                                                                                    of instructor". Requirements may be a pre-requisite
                                                                                                                                                                    competency, referenced using AlignmentObject. *} */
    public $educationalCredentialAwarded    = null;                 /* {*property   $educationalCredentialAwarded   (EducationalOccupationalCredential|string|URL)  A description of the qualification, award, certificate,
                                                                                                                                                                    diploma or other educational credential awarded as a
                                                                                                                                                                    consequence of successful completion of this course or
                                                                                                                                                                    program. *} */
    public $hasCourseInstance                = null;                /* {*property   $hasCourseInstance              (CourseInstance)                                An offering of the course at a specific time and place
                                                                                                                                                                    or through specific media or mode of study or to a
                                                                                                                                                                    specific section of students. *} */
    public $occupationalCredentialAwarded    = null;                /* {*property   $occupationalCredentialAwarded  (EducationalOccupationalCredential|string|URL)  A description of the qualification, award, certificate,
                                                                                                                                                                    diploma or other occupational credential awarded as a
                                                                                                                                                                    consequence of successful completion of this course or
                                                                                                                                                                    program. *} */
}   /* End of class Course ========================================================== */
/* ================================================================================== */


class DataType
/*-----------*/
{
    public $measuredValue	                = null;                 /* {*property   $measuredValue                  (Observation)                                   The measuredValue of an Observation. *} */
}

class Date extends DataType
/*------------------------*/
{
    public function __construct( $x )
    /*-----------------------------*/
    {
        $this->measuredValue = $x;
    }

    public function render( $szFormat = 'd-m-Y' )
    /*-----------------------------------------*/
    {
        //var_dump( $this->measuredValue );
        return ( date( $szFormat,strtotime( (string) $this->measuredValue ) ) );
    }
}


/* Ne provient PAS de schema.org */
class internShip extends Event
/*---------------------------*/
{
    public  $active                         = null;                 /* {*property   $active                         (bool)                                          [c]true[/c]: internShip is active; [c]false[/c] if not. *} */

    /* NOT FOUND in schema.org */
    public  $storage                        = null;                 /* {*property   $storage                        (string)                                        The name of the file where the internShip is saved *} */
    public  $checkInventory                 = true;                 /* {*property   $checkInventory                 (bool)                                          Should the inventory been checked? *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }

    public function render( $szOnBooking = null )
    /*-----------------------------------------*/
    {
        $szRetVal = '';

        $szRetVal .= "<table class=\"internShip\" id=\"{$this->identifier}\">\n";
            $oStartDate     = new Date( $this->startDate );
            $szStartDate    = date( 'Ymd',strtotime( $this->startDate ) );
            $oEndDate       = new Date( $this->endDate );
            $szEndDate      = date( 'Ymd',strtotime( $this->endDate ) );

            $szRetVal .= "<caption>"                                                                                    .
                             "Stage: <b>" . $oStartDate->render() . "</b> &#8212; <b>" . $oEndDate->render() . "</b>"   .
                             ( empty( $this->description ) ? '' : "<br />{$this->description}" )                        .
                         "</caption>\n";

            //var_dump( "IN " . __METHOD__ . "()" );
            //die();

            if ( is_array( $this->offers ) && count( $this->offers ) )
            {
                // Hmmm les headers sont dépendants de projet à projet
                $szRetVal .= "<thead>\n";
                    $szRetVal .= "<tr>\n";
                        $szRetVal .= "<th>Âges</th>\n";
                        //$szRetVal .= "<th>Kraainem</th>\n";
                        $szRetVal .= "<th>Places</th>\n";
                        $szRetVal .= "<th>Disponibles</th>\n";
                        $szRetVal .= "<th>Réservation</th>\n";
                        $szRetVal .= "<th>Prix</th>\n";
                    $szRetVal .= "</tr>";
                $szRetVal .= "</thead>\n";
                $i = 0;
                foreach( $this->offers as $oOffer )
                {
                    //var_dump( $oOffer->cargo['prices'] );
                    //die();

                    $szAdditionalData   = '';
                    $j                  = 0;

                    foreach( $oOffer->cargo['prices'] as $oPrice )
                    {
                        $szAdditionalData .= "data-{$j}-startDate=\"{$szStartDate}\" "                          .
                                             "data-{$j}-endDate=\"{$szEndDate}\" "                              .
                                             "data-{$j}-itemCondition=\"{$oPrice->itemCondition}\" "            .
                                             "data-{$j}-price=\"{$oPrice->price}\" "                            .
                                             "data-{$j}-priceCurrency=\"{$oPrice->priceCurrency}\" "            .
                                             "data-{$j}-priceValidUntil=\"{$oPrice->priceValidUntil}\" "        .
                                             "data-{$j}-eligibleQuantity=\"{$oPrice->eligibleQuantity}\" ";
                        $j++;
                    }   /* foreach( $oOffer->cargo['prices'] as $oPrice ) */

                    $szAvailablePlacesFile  = dirname( $this->storage ) . '/' . $oStartDate->render() . '-' . $oEndDate->render() . '-' . $oOffer->category . '.available.places.txt';
                    $inventoryLevel         = $oOffer->inventoryLevel;

                    if ( is_file( $szAvailablePlacesFile ) )
                        $inventoryLevel = (int) FIL_FileToStr( $szAvailablePlacesFile );

                    //var_dump( $this->checkInventory );

                    // For testing rapidly
                    //$inventoryLevel = -1;

                    if ( $inventoryLevel > 0 || ! $this->checkInventory )
                    {
                        //var_dump( $szAvailablePlacesFile );

                        $szRetVal .= "<tr id=\"{$oOffer->identifier}\" {$szAdditionalData}>\n";
                            $szRetVal .= "<td class=\"category\"><input type=\"hidden\" name=\"{$this->name}_category[{$i}]\" value=\"{$oOffer->category}\"/>{$oOffer->category}</td>\n";
                            //$szRetVal .= "<td class=\"checkbox\"><input type=\"checkbox\" name=\"{$this->name}_chkKraainem[{$i}]\"/></td>\n";
                            $szRetVal .= "<td class=\"places\"  >{$oOffer->cargo['places']}</td>\n";
                            $szRetVal .= "<td class=\"stock\"   >{$inventoryLevel}</td>\n";
                            $szRetVal .= "<td class=\"checkbox\"><input type=\"checkbox\" name=\"{$this->name}_chkBook[{$i}]\" {$szOnBooking}/></td>\n";
                            //$szRetVal .= "<td class=\"checkbox\"><input type=\"checkbox\" name=\"{$this->name}_chkBook_{$this}\" {$szOnBooking}/></td>\n";
                            $szRetVal .= "<td class=\"price\"   ><input type=\"number\"   name=\"{$this->name}_numPrice[{$i}]\" readonly class=\"priceNumber\" /></td>\n";
                        $szRetVal .= "</tr>";
                    }
                    else
                    {
                        $szRetVal .= "<tr id=\"{$oOffer->identifier}\" {$szAdditionalData}>\n";

                            $szRetVal .= "<td class=\"category\"><input type=\"hidden\" name=\"{$this->name}_category[{$i}]\" value=\"{$oOffer->category}\"/>{$oOffer->category}</td>\n";
                            //$szRetVal .= "<td class=\"checkbox\"><input type=\"checkbox\" name=\"{$this->name}_chkKraainem[{$i}]\"/></td>\n";
                            $szRetVal .= "<td class=\"places\"  >{$oOffer->cargo['places']}</td>\n";
                            $szRetVal .= "<td class=\"stock\"   >{$inventoryLevel}</td>\n";
                            $szRetVal .= "<td class=\"checkbox\">&#160;</td>\n";
                            $szRetVal .= "<td class=\"price\"   >&#160;</td>\n";
                        $szRetVal .= "</tr>";
                    }
                    ++$i;
                }

                if ( $inventoryLevel <= 0 )
                {
                    $szRetVal .= "<tr id=\"WAITING-LIST-{$oOffer->identifier}\" class=\"waiting-list\">\n";
                        $szRetVal .= "<td colspan=\"5\"><input type=\"checkbox\" name=\"{$this->name}_waitingList\" class=\"waitingList\" /> Inscription en liste d'attente ?</td>\n";
                    $szRetVal .= "</tr>";
                }
                else
                {
                    $szRetVal .= "<tr id=\"WAITING-LIST-{$oOffer->identifier}\" class=\"waiting-list\">\n";
                        $szRetVal .= "<td colspan=\"5\">&#160;</td>\n";
                    $szRetVal .= "</tr>";
                }
            }

        $szRetVal .= "</table>\n";

        //var_dump( $this );
        //die();
        return ( $szRetVal );
    }
}   /* End of class internShip ====================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Dataset=

    {*desc

        A body of structured information describing some topic(s) of interest.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Dataset[/url] *}

    *}}
 */
/* ================================================================================== */
class Dataset extends CreativeWork
/*------------------------------*/
{
    public  $distribution               = null;                     /* {*property   $distribution                   (DataDownload)                                  A downloadable form of this dataset, at a specific location, in a
                                                                                                                                                                    specific format. *} */
    public  $includedInDataCatalog      = null;                     /* {*property   $includedInDataCatalog          (DataCatalog)                                   A data catalog which contains this dataset. Supersedes catalog,
                                                                                                                                                                    includedDataCatalog. Inverse property: dataset. *} */
    public  $issn                       = null;                     /* {*property   $issn                           (string)                                        The International Standard Serial Number (ISSN) that identifies this serial
                                                                                                                                                                    publication. You can repeat this property to identify different formats of,
                                                                                                                                                                    or the linking ISSN (ISSN-L) for, this serial publication. *} */
    public  $measurementTechnique       = null;                     /* {*property   $measurementTechnique           (string|URL)                                    A technique or technology used in a Dataset (or DataDownload, DataCatalog),
                                                                                                                                                                    corresponding to the method used for measuring the corresponding variable(s)
                                                                                                                                                                    (described using variableMeasured). This is oriented towards scientific and
                                                                                                                                                                    scholarly dataset publication but may have broader applicability; it is not
                                                                                                                                                                    intended as a full representation of measurement, but rather as a high level
                                                                                                                                                                    summary for dataset discovery.

                                                                                                                                                                    For example, if variableMeasured is: molecule concentration, measurementTechnique
                                                                                                                                                                    could be: "mass spectrometry" or "nmr spectroscopy" or "colorimetry" or
                                                                                                                                                                    "immunofluorescence".

                                                                                                                                                                    If the variableMeasured is "depression rating", the measurementTechnique could
                                                                                                                                                                    be "Zung Scale" or "HAM-D" or "Beck Depression Inventory".

                                                                                                                                                                    If there are several variableMeasured properties recorded for some given data
                                                                                                                                                                    object, use a PropertyValue for each variableMeasured and attach the corresponding
                                                                                                                                                                    measurementTechnique. *} */
    public $variableMeasured            = null;                     /* {*property   $variableMeasured               (PropertyValue|string)                          The variableMeasured property can indicate (repeated as necessary) the variables
                                                                                                                                                                    that are measured in some dataset, either described as text or as pairs of
                                                                                                                                                                    identifier and description using PropertyValue. *} */
}   /* End of class Dataset ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class DataFeed=

    {*desc

        A single feed providing structured information about one or more entities or
        topics.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DataFeed[/url] *}

    *}}
 */
/* ================================================================================== */
class DataFeed extends Dataset
/*--------------------------*/
{
    public  $dataFeedElement            = null;                     /* {*property   $dataFeedElement            (DataFeedItem|string|Thing)     An item within in a data feed. Data feeds may have many elements. *} */
}   /* End of class DataFeed ======================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MusicPlaylist=

    {*desc


    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicPlaylist[/url] *}

    *}}
 */
/* ================================================================================== */
class MusicPlaylist extends CreativeWork
/*------------------------------------*/
{
    public $numTracks                   = null;                     /* {*property   $numTracks                  (int)                           The number of tracks in this album or playlist. *} */
    public $track                       = null;                     /* {*property   $track                      (ItemList|MusicRecording)       A music recording (track)--usually a single song.
                                                                                                                                                If an ItemList is given, the list should contain
                                                                                                                                                items of type MusicRecording. Supersedes [c]tracks[/c] *} */
    /* Pas dans schema.org */
    public $tracks                      = null;
    public $title                       = null;

    public function render()
    /*--------------------*/
    {
        $szRetVal = '';

        // Ici, il faut mettre une section Playlist. C'est ici que ça doit être fait
        if ( is_array( $this->tracks ) && count( $this->tracks ) > 0 )
        {
            $szRetVal .= "<ol>";
                foreach( $this->tracks as $oTrack )
                {
                    $szRetVal .= '<li>' . $oTrack->render() . '</li>';
                }   /* foreach( $this->tracks as $oTrack ) */
            $szRetVal .= "<ol>";
        }   /* if ( is_array( $this->tracks ) && count( $this->tracks ) > 0 ) */

        return ( $szRetVal );
    }   /* End of MusicPlaylist.render() ============================================ */

}   /* End of class MusicPlaylist =================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class CreativeWorkSeries=

    {*desc

        A CreativeWorkSeries in schema.org is a group of related items,
        typically but not necessarily of the same kind. CreativeWorkSeries are
        usually organized into some order, often chronological. Unlike ItemList
        which is a general purpose data structure for lists of things, the
        emphasis with CreativeWorkSeries is on published materials (written e.g.
        books and periodicals, or media such as tv, radio and games).

        Specific subtypes are available for describing TVSeries, RadioSeries,
        MovieSeries, BookSeries, Periodical and VideoGameSeries. In each case,
        the hasPart / isPartOf properties can be used to relate the
        CreativeWorkSeries to its parts. The general CreativeWorkSeries type
        serves largely just to organize these more specific and practical
        subtypes.

        It is common for properties applicable to an item from the series to be
        usefully applied to the containing group. Schema.org attempts to
        anticipate some of these cases, but publishers should be free to apply
        properties of the series parts to the series as a whole wherever they
        seem appropriate.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWorkSeries[/url] *}

    *}}
 */
/* ================================================================================== */
class CreativeWorkSeries extends CreativeWork
/*------------------------------------------*/
{
    public $endDate                        = null;                     /* {*property   $endDate                    (Date|DateTime)             The end date and time of the item (in ISO 8601
                                                                                                                                            date format). *} */
    public $issn                        = null;                     /* {*property   $issn                       (string)                    The International Standard Serial Number (ISSN)
                                                                                                                                            that identifies this serial publication. You can
                                                                                                                                            repeat this property to identify different formats
                                                                                                                                            of, or the linking ISSN (ISSN-L) for, this serial
                                                                                                                                            publication. *} */
    public $startDate                   = null;                     /* {*property   $startDate                  (Date|DateTime)             The start date and time of the item (in ISO 8601
                                                                                                                                            date format). *} */
}   /* End of class CreativeWorkSeries ============================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MediaObject=

    {*desc

        A media object, such as an image, video, or audio object embedded in a
        web page or a downloadable dataset i.e. DataDownload. Note that a
        creative work may have many media objects associated with it on the same
        web page. For example, a page about a single song (MusicRecording) may
        have a music video (VideoObject), and a high and low bandwidth audio
        stream (2 AudioObject's).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MediaObject[/url] *}

    *}}
 */
/* ================================================================================== */
class MediaObject extends CreativeWork
/*----------------------------------*/
{
    public $associatedArticle           = null;                     /* {*property   $associatedArticle          (NewsArticle)                    A NewsArticle associated wth the Media Object. *} */
    public $bitrate                     = null;                     /* {*property   $bitrate                    (string)                        The bitrate of the media object. *} */
    public $contentSize                 = null;                     /* {*property   $contentSize                (string)                        File size in (mega/kilo) bytes. *} */
    public $contentUrl                  = null;                     /* {*property   $contentUrl                 (URL)                           Actual bytes of the media object, for example the
                                                                                                                                                image file or video file. *} */
    public $duration                    = null;                     /* {*property   $duration                   (Duration)                      The duration of the item (movie, audio recording,
                                                                                                                                                event, etc.) in ISO 8601 date format. *} */
    public $embedUrl                    = null;                     /* {*property   $embedUrl                   (URL)                           A URL pointing to a player for a specific video.
                                                                                                                                                In general, this is the information in the src
                                                                                                                                                element of an embed tag and should not be the
                                                                                                                                                same as the content of the loc tag. *} */
    public $encodesCreativeWork         = null;                     /* {*property   $encodesCreativeWork        (CreativeWork)                  The CreativeWork encoded by this media object.
                                                                                                                                                Inverse property: encoding. *} */
    public $encodingFormat              = null;                     /* {*property   $encodingFormat             (string|URL)                    Media type typically expressed using a MIME
                                                                                                                                                format (see IANA site and MDN reference)
                                                                                                                                                e.g. application/zip for a
                                                                                                                                                SoftwareApplication binary, audio/mpeg for
                                                                                                                                                .mp3 etc.).

                                                                                                                                                In cases where a CreativeWork has several media type
                                                                                                                                                representations, encoding can be used to indicate each
                                                                                                                                                MediaObject alongside particular encodingFormat
                                                                                                                                                information.

                                                                                                                                                Unregistered or niche encoding and file formats can be
                                                                                                                                                indicated instead via the most appropriate URL,
                                                                                                                                                e.g. defining Web page or a
                                                                                                                                                Wikipedia/Wikidata entry. Supersedes fileFormat. *} */

    public $endTime                     = null;                     /* {*property   $endTime                    (DateTime|Time)                 The endTime of something. For a reserved event or
                                                                                                                                                service (e.g. FoodEstablishmentReservation), the time
                                                                                                                                                that it is expected to end. For actions that span a
                                                                                                                                                period of time, when the action was performed.
                                                                                                                                                e.g. John wrote a book from January to December.
                                                                                                                                                For media, including audio and video, it's the time
                                                                                                                                                offset of the end of a clip within a larger file.

                                                                                                                                                Note that Event uses startDate/endDate instead of
                                                                                                                                                startTime/endTime, even when describing dates with
                                                                                                                                                times. This situation may be clarified in future revisions. *} */

    public $height                      = null;                     /* {*property   $height                     (Distance|QuantitativeValue)    The height of the item. *} */
    public $playerType                  = null;                     /* {*property   $playerType                 (string)                        Player type required—for example, Flash or Silverlight. *} */
    public $productionCompany           = null;                     /* {*property   $productionCompany          (Organization)                  The production company or studio responsible for the item
                                                                                                                                                e.g. series, video game, episode etc. *} */
    public $regionsAllowed              = null;                     /* {*property   $regionsAllowed             (Place)                         The regions where the media is allowed. If not specified,
                                                                                                                                                then it's assumed to be allowed everywhere. Specify the
                                                                                                                                                countries in ISO 3166 format. *} */
    public $requiresSubscription        = null;                     /* {*property   $requiresSubscription       (Boolean|MediaSubscription)     Indicates if use of the media require a subscription
                                                                                                                                                (either paid or free). Allowed values are true or false
                                                                                                                                                (note that an earlier version had 'yes', 'no'). *} */
    public $startTime                   = null;                     /* {*property   $startTime                  (DateTime|Time)                 The startTime of something. For a reserved event or
                                                                                                                                                service (e.g. FoodEstablishmentReservation), the time
                                                                                                                                                that it is expected to start. For actions that span a
                                                                                                                                                period of time, when the action was performed.
                                                                                                                                                e.g. John wrote a book from January to December.
                                                                                                                                                For media, including audio and video, it's the time
                                                                                                                                                offset of the start of a clip within a larger file.

                                                                                                                                                Note that Event uses startDate/endDate instead of
                                                                                                                                                startTime/endTime, even when describing dates with
                                                                                                                                                times. This situation may be clarified in future revisions. *} */
    public $uploadDate                  = null;                     /* {*property   $uploadDateDate             (Date)                          When this media object was uploaded to this site. *} */
    public $width                       = null;                     /* {*property   $width                      (Distance|QuantitativeValue)    The width of the item. *} */

}   /* End of class MediaObject ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class DataDownload=

    {*desc

        A dataset in downloadable form.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DataDownload[/url] *}

    *}}
 */
/* ================================================================================== */
class DataDownload extends MediaObject
/*----------------------------------*/
{
}   /* End of class DataDownload ==================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class ImageObject=

    {*desc

        An image file

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ImageObject[/url] *}

    *}}
 */
/* ================================================================================== */
class ImageObject extends MediaObject
/*---------------------------------*/
{
    public $caption                     = null;                     /* {*property   $caption                    (MediaObject|string)            The caption for this object. For downloadable machine
                                                                                                                                                formats (closed caption, subtitles etc.) use
                                                                                                                                                MediaObject and indicate the encodingFormat. *} */

    public $exifData                    = null;                     /* {*property   $exifData                   (PropertyValue|string)          exif data for this object. *} */

    public $representativeOfPage        = null;                     /* {*property   $representativeOfPage       (boolean)                       indicates whether this image is representative of the content of the page *} */

    public $thumbnail                   = null;                     /* {*property   $thumbnail                  (ImageObject)                   Thumbnail image for an image or video *} */

}   /* End of class ImageObject ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class AudioObject=

    {*desc

        An audio file.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AudioObject[/url] *}

    *}}
 */
/* ================================================================================== */
class AudioObject extends MediaObject
/*----------------------------------*/
{
    public $caption                     = null;                     /* {*property   $caption                    (MediaObject|string)            The caption for this object. For downloadable machine
                                                                                                                                                formats (closed caption, subtitles etc.) use
                                                                                                                                                MediaObject and indicate the encodingFormat. *} */

    public $transcript                  = null;                     /* {*property   $transcript                 (string)                        If this MediaObject is an AudioObject or VideoObject,
                                                                                                                                                the transcript of that object. *} */

}   /* End of class AudioObject ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Comment=

    {*desc

        A comment on an item - for example, a comment on a blog post. The
        comment's content is expressed via the text property, and its topic via
        about, properties shared with all CreativeWorks.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Comment[/url] *}

    *}}
 */
/* ================================================================================== */
class Comment extends CreativeWork
/*------------------------------*/
{
    public $actor                       = null;                     /* {*property   $actor                      (Person)                        An actor, e.g. in tv, radio, movie, video games etc.,
                                                                                                                                                or in an event. Actors can be associated with
                                                                                                                                                individual items or with a series, episode, clip.
                                                                                                                                                Supersedes actors. *} */
    public $downvoteCount               = null;                     /* {*property   $downvoteCount              (int)                           The number of downvotes this question, answer or comment has received from the community. *} */
    public $parentItem                  = null;                     /* {*property   $parentItem                 (Question)                      The parent of a question, answer or item in general. *} */
    public $upvoteCount                 = null;                     /* {*property   $upvoteCount                (int)                           The number of upvotes this question, answer or comment has received from the community. *} */

}   /* End of class Comment ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Answer=

    {*desc
        An answer offered to a question; perhaps correct, perhaps opinionated or wrong.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Answer[/url] *}

    *}}
 */
/* ================================================================================== */
class Answer extends Comment
/*-------------------------*/
{
}   /* End of class Answer ========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Response=

    {*desc

        ??????????????

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Response[/url] *}

    *}}
 */
/* ================================================================================== */
class Response extends Answer
/*-------------------------*/
{
    /* Cette classe permettra de créer une réponse de type de celles dont j'ai besoin
       pour renvoyer une réponse par JSON ou XML */
}   /* End of class Response ======================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class RadioSeries=

    {*desc

        CreativeWorkSeries dedicated to radio broadcast and associated online
        delivery.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/RadioSeries[/url] *}

    *}}
 */
/* ================================================================================== */
class RadioSeries extends CreativeWorkSeries
/*----------------------------------------*/
{
    public $actor                       = null;                     /* {*property   $actor                      (Person)                        An actor, e.g. in tv, radio, movie, video games etc.,
                                                                                                                                                or in an event. Actors can be associated with
                                                                                                                                                individual items or with a series, episode, clip.
                                                                                                                                                Supersedes actors. *} */
    public $containsSeason              = null;                     /* {*property   $containsSeason             (CreativeWorkSeason)            A season that is part of the media series.
                                                                                                                                                Supersedes season. *} */
    public $director                    = null;                     /* {*property   $director                   (Person)                        A director of e.g. tv, radio, movie, video gaming
                                                                                                                                                etc. content, or of an event. Directors can be
                                                                                                                                                associated with individual items or with a series,
                                                                                                                                                episode, clip. Supersedes directors.*} */
    public $episode                     = null;                     /* {*property   $episode                    (Episode)                       An episode of a tv, radio or game media within a
                                                                                                                                                series or season. Supersedes episodes. *} */
    public $musicBy                        = null;                     /* {*property   $musicBy                    (MusicGroup|Person)             The composer of the soundtrack.*} */
    public $numberOfEpisodes            = null;                     /* {*property   $numberOfEpisodes           (int)                           The number of episodes in this season or series.*} */
    public $numberOfSeasons             = null;                     /* {*property   $numberOfSeasons            (int)                           The number of seasons in this series.*} */
    public $productionCompany            = null;                     /* {*property   $productionCompany          (Organization)                  The production company or studio responsible for
                                                                                                                                                the item e.g. series, video game, episode etc.*} */
    public $trailer                     = null;                     /* {*property   $trailer                    (VideoObject)                   The trailer of a movie or tv/radio series, season,
                                                                                                                                                episode, etc. *} */
    public function render()
    /*--------------------*/
    {
        $szRetVal = '';

        $szRetVal .= "<div vocab=\"http://schema.org/\" typeof=\"RadioSeries\" id=\"{$this->identifier}\" class=\"RadioSeries\" >\n";
            $szImage = null;

            if ( ! empty( $this->image ) )
            {
                $szImage = "<p><img src=\"{$this->image}\" class=\"constrained shadow\" /></p>\n";
            }

            $szRetVal .= "<div class=\"RadioSeries_Header\">\n";
                $szRetVal .= "<div class=\"cover\">{$szImage}</div><!-- .cover -->\n";
                $szRetVal .= "<div class=\"description\">{$this->description}</div><!-- .description -->\n";
            $szRetVal .= "</div> <!-- RadioSeries_Header -->\n";

            $aEpisodes = $this->episode;

            usort( $aEpisodes,  function( $a,$b )
                                {
                                    if ( $a->partOfSeason . $a->episodeNumber === $b->partOfSeason . $b->episodeNumber )
                                        return 0;
                                    else
                                        return ( ( $a->partOfSeason . $a->episodeNumber > $b->partOfSeason . $b->episodeNumber ) ? -1 : +1 );
                                }
                 );
            //var_dump( $aEpisodes );
            //return ( '' );
            //var_dump( $szRetVal );

            //var_dump( $aEpisodes[0] );
            $szFirstEpisode = 'CSR-S' . $aEpisodes[0]->partOfSeason . 'E' . $aEpisodes[0]->episodeNumber;
            //var_dump( $szFirstEpisode );
            //return ( '' );

            $szRetVal .= "<section class=\"Episodes\">\n";
            foreach( $aEpisodes as $oEpisode )
            {
                $szRetVal .= $oEpisode->render();
            }   /* foreach( $this->episode as $oEpisode ) */
            $szRetVal .= "</section> <!-- .Episodes -->\n";
            $szRetVal .= "<script>var o = document.getElementById('{$szFirstEpisode}'); o.scrollIntoView( true );</script>";

        $szRetVal .= "</div> <!-- #{$this->identifier}.RadioSeries -->\n";

        return ( $szRetVal );
    }   /* End of RadioSeries.render() ============================================== */


    public function load( $szFile = null )
    /*----------------------------------*/
    {
        $bRetVal = false;

        if ( ! is_null( $szFile ) )
        {
            $oDom = new DOMDocument();

            if ( $oDom->load( $szFile ) )
            {
                $oXPath = new DOMXPath( $oDom );

                $this->identifier = $oDom->documentElement->getAttribute('id');

                $o = $oXPath->query( 'image' );

                $szImage = null;

                if ( $o->length > 0 )
                {
                    $this->image = $o->item(0)->nodeValue;
                }

                $o = $oXPath->query( 'description' );

                if ( $o->length > 0 )
                {
                    $this->description = $o->item(0)->nodeValue;
                }

                $aEpisodes  = null;

                //die("BEFORE READING EPISODES");
                if ( ( $oList = $oXPath->query( '//Episode' ) ) && $oList->length > 0 )
                {
                    // var_dump( "Found episodes" );

                    // Enumerating all episodes of THIS RadioSeries
                    foreach( $oList as $oNode )
                    {
                        $szActive  = strtolower( trim( $oNode->getAttribute('active') ) );

                        if ( ! empty( $szActive ) && $szActive !== 'true' )
                            continue;

                        $oEpisode                       = new Episode( 'playEpisode','buyEpisode' );

                        //var_dump( $oEpisode );
                        //die();

                        $oEpisode->identifier           =                   $oNode->getAttribute('id');
                        $oEpisode->partOfSeason         =                   $oNode->getAttribute( 'partOfSeason' );
                        $oEpisode->episodeNumber        =                   $oNode->getAttribute( 'episodeNumber' );
                        $oEpisode->name                 =                   $oNode->getAttribute( 'name' );
                        $oEpisode->alternatename        =                   $oNode->getAttribute( 'alternateName' );
                        $oEpisode->timeRequired         =                   $oNode->getAttribute( 'timeRequired' );
                        $oEpisode->audio                = new AudioObject();
                        $oEpisode->audio->contentUrl    =                   $oNode->getAttribute( 'href' );

                        $oEpisode->image                =                   $oNode->getAttribute( 'cover' );
                        $oEpisode->billable             =                   $oNode->getAttribute( 'billable' );
                        $oEpisode->creativeWorkStatus   = strtolower( trim( $oNode->getAttribute( 'creativeWorkStatus' ) ) );

                        // The status of a creative work in terms of its stage
                        // in a lifecycle. Example terms include Incomplete, Draft,
                        // Published, Obsolete. Some organizations define a set of
                        // terms for the stages of their publication lifecycle.

                        if ( ( $o = $oXPath->query( 'description',$oNode ) ) && ( $o->length > 0 ) )
                        {
                            $oEpisode->description = $oEpisode->text = $o->item(0)->nodeValue;
                        }   /* if ( ( $o = $oXPath->query( 'description',$oNode ) ) && ( $o->length > 0 ) ) */

                        /* Chercher playlist */
                        if ( ( $oPL = $oXPath->query( 'MusicPlaylist',$oNode ) ) &&  $oPL->length > 0 )
                        {
                            //var_dump( "Found playlist!!!" );

                            $oMusicPlaylistNode         = $oPL->item(0);

                            $oMusicPlaylist             = new MusicPlaylist();
                            $oMusicPlaylist->numTracks  = (int) $oMusicPlaylistNode->getAttribute( 'numTracks' );

                            if ( ( $oListTracks = $oXPath->query( 'MusicRecording',$oMusicPlaylistNode ) ) && $oListTracks->length > 0 )
                            {
                                //var_dump( "Found tracks" );

                                foreach ( $oListTracks as $oTrackNode )
                                {
                                    //var_dump( "NEW TRACK" );
                                    $oTrack = new MusicRecording();

                                    if ( ( $o = $oXPath->query( 'byArtist',$oTrackNode ) ) && ( $o->length > 0 ) )
                                    {
                                        $oArtistNode    = $o->item(0);
                                        $szLongDesc     = $oArtistNode->getAttribute('longdesc');

                                        //var_dump( "YES ARTIST FOUND" );
                                        //var_dump( $szLongDesc );

                                        if ( vaesoli::STR_iPos( $szLongDesc,'musicgroup' ) !== -1 )
                                        {
                                            //var_dump( "GROUPE DE MUSIQUE" );
                                            $oTrack->byArtist       = new MusicGroup();
                                            $oTrack->byArtist->name = "Un groupe de musique";
                                        }
                                        else
                                        {
                                            //var_dump( "ARTISTE" );
                                            $oTrack->byArtist = new Person();
                                        }

                                        if ( ( $o = $oXPath->query( 'name',$oArtistNode ) ) && ( $o->length > 0 ) )
                                        {
                                            $oTrack->byArtist->name = $o->item(0)->nodeValue;
                                        }
                                    }   /*  if ( ( $o = $oXPath->query( 'byArtist',$oTrackNode ) ) && ( $o->length > 0 ) ) */

                                    if ( ( $o = $oXPath->query( 'title',$oTrackNode ) ) && ( $o->length > 0 ) )
                                    {
                                        $oTrack->title = trim( $o->item(0)->nodeValue );
                                    }

                                    $oMusicPlaylist->tracks[] = $oTrack;
                                }   /* foreach ( $oListTracks as $oMusicRecordingNode ) */
                            }   /* if ( ( $oListTracks = $oXPath->query( 'MusicRecording',$oMusicPlaylistNode ) ) && $oListTracks->length > 0 ) */

                            $oEpisode->playlist = $oMusicPlaylist;
                        }   /* if ( ( $oPL = $oXPath->query( 'MusicPlaylist',$oNode ) ) &&  $oPL->length > 0 ) */

                        $aEpisodes[] = $oEpisode;

                    }   /* foreach( $oList as $oNode ) */
                }   /* if ( $oList->length > 0 ) */

                if ( is_array( $aEpisodes ) && count( $aEpisodes ) > 0 )
                {
                    $this->episode = $aEpisodes;
                }   /* if ( is_array( $aEpisodes ) && count( $aEpisodes ) > 0 ) */

                $bRetVal = true;
            }   /* if ( $oDom->load( $szFile ) ) */
        }   /* if ( ! is_null( $szFile ) ) */

        return ( $bRetVal );
    }   /* End of RadioSeries.load() ================================================ */


    public function lookEpisode( $szID = null )
    /*---------------------------------------*/
    {
        $oRetVal = null;

        if ( ! is_null( $szID ) && is_array( $this->episode ) && count( $this->episode ) > 0  )
        {
            //var_dump( "ON PEUT TROUVER LE LIEN!!!" );
            foreach( $this->episode as $oEpisode )
            {
                if ( $oEpisode->identifier === $szID )
                {
                    $oRetVal = $oEpisode;
                    break;
                }   /* if ( $oEpisode->identifier === $szID ) */
            }   /* foreach( $this->episode as $oEpisode ) */
        }    /* if ( ! is_null( $szFile ) ) */

        return ( $oRetVal );
    }   /* End of RadioSeries.lookEpisode() ========================================= */

}   /* End of class RadioSeries ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class CreativeWorkSeason=

    {*desc

        CreativeWorkSeries dedicated to radio broadcast and associated online
        delivery.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWorkSeason[/url] *}

    *}}
 */
/* ================================================================================== */
class CreativeWorkSeason extends CreativeWork
/*-----------------------------------------*/
{
    public $actor                       = null;                     /* {*property   $actor                      (Person)                    An actor, e.g. in tv, radio, movie, video games
                                                                                                                                            etc., or in an event. Actors can be associated
                                                                                                                                            with individual items or with a series, episode,
                                                                                                                                            clip. Supersedes actors. *} */
    public $director                    = null;                     /* {*property   $director                   (Person)                    A director of e.g. tv, radio, movie, video gaming
                                                                                                                                            etc. content, or of an event. Directors can be
                                                                                                                                            associated with individual items or with a series,
                                                                                                                                            episode, clip. Supersedes directors. *} */
    public $endDate                     = null;                     /* {*property   $endDate                    (Date|DateTime)             The end date and time of the item (in ISO 8601
                                                                                                                                            date format). *} */
    public $episode                     = null;                     /* {*property   $episode                    (Episode)                   An episode of a tv, radio or game media within
                                                                                                                                            a series or season. Supersedes episodes. *} */
    public $numberOfEpisodes            = null;                     /* {*property   $numberOfEpisodes           (Integer)                   The number of episodes in this season or series. *} */
    public $partOfSeries                = null;                     /* {*property   $partOfSeries               (CreativeWorkSeries)        The series to which this episode or season belongs.
                                                                                                                                            Supersedes partOfTVSeries. *} */
    public $productionCompany           = null;                     /* {*property   $productionCompany          (Organization)              The production company or studio responsible for
                                                                                                                                            the item e.g. series, video game, episode etc. *} */
    public $seasonNumber                = null;                     /* {*property   $seasonNumber               (int|string)                Position of the season within an ordered group
                                                                                                                                            of seasons. *} */
    public $startDate                   = null;                     /* {*property   $startDate                  (Date|DateTime)             The start date and time of the item (in ISO
                                                                                                                                            8601 date format). *} */
    public $trailer                     = null;                     /* {*property   $trailer                    (VideoObject)               The trailer of a movie or tv/radio series,
                                                                                                                                            season, episode, etc. *} */
}   /* End of class CreativeWorkSeason ============================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Episode=

    {*desc

        CreativeWorkSeries dedicated to radio broadcast and associated online
        delivery.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWorkSeason[/url] *}

    *}}

 */
/* ================================================================================== */
class Episode extends CreativeWork
/*------------------------------*/
{
    public $actor                       = null;                     /* {*property   $actor                      (Person)                    Person     An actor, e.g. in tv, radio, movie,
                                                                                                                                            video games etc., or in an event. Actors can be
                                                                                                                                            associated with individual items or with a series,
                                                                                                                                            episode, clip. Supersedes actors. *} */
    public $director                    = null;                     /* {*property   $director                   (Person)                    A director of e.g. tv, radio, movie, video gaming
                                                                                                                                            etc. content, or of an event. Directors can be
                                                                                                                                            associated with individual items or with a series,
                                                                                                                                            episode, clip. Supersedes directors. *} */
    public $episodeNumber               = null;                     /* {*property   $episodeNumber              (int|string)                Position of the episode within an ordered group of
                                                                                                                                            episodes. *} */
    public $musicBy                     = null;                     /* {*property   $musicBy                    (MusicGroup|Person)         The composer of the soundtrack. *} */
    public $partOfSeason                = null;                     /* {*property   $partOfSeason               (CreativeWorkSeason)        The season to which this episode belongs. *} */
    public $partOfSeries                = null;                     /* {*property   $partOfSeries               (CreativeWorkSeries)        The series to which this episode or season belongs. Supersedes partOfTVSeries. *} */
    public $productionCompany           = null;                     /* {*property   $productionCompany          (Organization)              The production company or studio responsible for the item e.g. series, video game, episode etc. *} */
    public $trailer                     = null;                     /* {*property   $trailer                    (VideoObject)               The trailer of a movie or tv/radio series, season,
                                                                                                                                            episode, etc. *} */

    /* Propriété ajoutée par Pat Boens et qui n'est pas dans la version schema.org */
    public  $playlist                   = null;                     /* {*property   $playlist                   (CreativeWorkSeason)        The season to which this episode belongs. *} */
    public  $billable                   = true;                     /* {*property   $billable                   (Boolean)                   Can this episode be purchased? *} */
    public  $playFnc                    = 'playOrStop';             /* {*property   $playFnc                    (string)                    The JS function that must be invoked for play or pause *} */
    public  $buyFnc                     = 'buy';                    /* {*property   $buyFnc                     (string)                    The JS function that must be invoked for buying *} */

    public function __construct( $szPlayFnc = null,$szBuyFnc = null )
    /*-------------------------------------------------------------*/
    {
        if ( ! is_null( $szPlayFnc ) )
        {
            $this->playFnc = $szPlayFnc;
        }   /* if ( ! is_null( $szPlayFnc ) ) */

        if ( ! is_null( $szBuyFnc ) )
        {
            $this->buyFnc = $szBuyFnc;
        }   /* if ( ! is_null( $szBuyFnc ) ) */


        $this->playlist = new MusicPlaylist();
    }   /* End of Episode.__construct() ============================================= */
    /* ============================================================================== */


    public function getRef()
    /*--------------------*/
    {
        return ( "CSR-S{$this->partOfSeason}E{$this->episodeNumber}" );
    }   /* End of Episode.getRef() ================================================== */
    /* ============================================================================== */


    public function render()
    /*--------------------*/
    {
        $szRetVal = '';
        $szRef    = '';

        /*
        +-----------------------------------------------+
        | EPISODE TITLE                                 |
        +-----------------------------------------------+
        |          | LONGUEUR                           |
        |          | SEASON #                           |
        |  COVER   | EPISODE #                          |
        |          | DESCRIPTION                        |
        |          | PLAYLIST                           |
        +----------+                                    |
        |     >    |                                    |
        +----------+                                    |
        | DOWNLOAD |                                    |
        +----------+                                    |
        |                                               |
        |                                               |
        |                                               |
        |                                               |
        |                                               |
        |                                               |
        +-----------------------------------------------+

        ...

        */

        $szRetVal   = "<section id=\"CSR-S{$this->partOfSeason}E{$this->episodeNumber}\">\n";
            $szRetVal  .= "<article vocab=\"http://schema.org/\" typeof=\"Episode\" id=\"{$this->identifier}\" class=\"Episode\" version=\"" . SCHEMA_CLASSES_VERSION . "\">\n";
                $szRetVal  .= "<div class=\"cover-controls-download\">\n";
                    $szRetVal  .= "<div class=\"cover\" property=\"image\">\n";
                        if ( ! empty( $this->image ) )
                        {
                            $szRetVal  .= "<img src=\"{$this->image}\" />";
                        }
                    $szRetVal  .= "</div> <!-- .cover -->\n";

                    if ( ! empty( $this->audio->contentUrl ) )
                    {
                        $szRetVal  .= "<div class=\"controls\">\n";
                            $szRetVal  .= "<p><span class=\"playButton\" title=\"Play or Pause Episode\" data-state=\"paused\" onclick=\"{$this->playFnc}(this,'{$this->audio->contentUrl}');\">&#160;</span></p>";
                        $szRetVal  .= "</div> <!-- .controls -->\n";

                        if ( $this->billable )
                        {
                            //var_dump( $this->partOfSeason . $this->episodeNumber . ':' . $this->creativeWorkStatus );
                            if ( $this->creativeWorkStatus === 'published' )
                            {
                                $szRetVal  .= "<div class=\"download\">\n";
                                    $szRetVal  .= "<p><span class=\"buyButton\" title=\"Buy and download Episode\" onclick=\"{$this->buyFnc}(this,'{$this->identifier}');\">&#160;</span></p>";
                                $szRetVal  .= "</div> <!-- .download -->\n";
                            }   /* if ( $this->creativeWorkStatus === 'published' ) */
                        }   /* if ( $this->billable ) */
                    }   /* if ( ! empty( $this->audio->contentUrl ) ) */
                $szRetVal  .= "</div> <!-- .cover-controls-download -->\n";


                $szRetVal  .= "<div class=\"Episode-details\">\n";
                    $szRetVal .= "<div class=\"description\">\n";
                        $szRetVal .= "<p>DURATION: <span property=\"timeRequired\">{$this->timeRequired}</span></p>\n";
                        $szRetVal .= "<p>Season: <span property=\"partOfSeason\">{$this->partOfSeason}</span></p>\n";
                        $szRetVal .= "<p>Episode: <span property=\"episodeNumber\">{$this->episodeNumber}</span></p>\n";
                        $szRetVal .= "<div property=\"text\">{$this->text}</div>\n";
                    $szRetVal  .= "</div> <!-- .description -->\n";

                    $szRetVal .= "<div vocab=\"http://schema.org/\" typeof=\"MusicPlaylist\" class=\"Playlist\">\n";
                        $szRetVal .= $this->playlist->render();
                    $szRetVal  .= "</div> <!-- .Playlist -->\n";

                $szRetVal  .= "</div> <!-- .Episode-details -->\n";

            $szRetVal  .= "</article> <!-- #{$this->identifier}.Episode -->\n";
        $szRetVal  .= "</section> <!-- #.Episode -->\n";

        return ( $szRetVal );
    }   /* End of Episode.render() ================================================== */
    /* ============================================================================== */

}   /* End of class Episode ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MusicRecording=

    {*desc

        A music recording (track), usually a single song.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicRecording[/url] *}

    *}}
 */
/* ================================================================================== */
class MusicRecording extends CreativeWork
/*-------------------------------------*/
{
    public $byArtist                    = null;                     /* {*property   $byArtist                   (MusicGroup|Person)                         The artist that performed this album or recording. *} */
    public $duration                    = null;                     /* {*property   $duration                   (Duration)                                  The duration of the item (movie, audio recording, event, etc.)
                                                                                                                                                            in ISO 8601 date format. *} */
    public $inAlbum                     = null;                     /* {*property   $inAlbum                    (MusicAlbum)                                The album to which this recording belongs. *} */
    public $inPlaylist                  = null;                     /* {*property   $inPlaylist                 (MusicPlaylist)                             The playlist to which this recording belongs. *} */
    public $isrcCode                    = null;                     /* {*property   $isrcCode                   (string)                                    The International Standard Recording Code for the recording. *} */
    public $recordingOf                 = null;                     /* {*property   $recordingOf                (MusicComposition)                          The composition this track is a recording of.
                                                                                                                                                            Inverse property: recordedAs. *} */

    /* Pas dans schema.org */
    public $title                       = null;

    public function render()
    /*--------------------*/
    {
        $szRetVal = '';

        $szClass = 'track';

        //There is a light (New) by Gg
        //Ten Man (PP) by Doug Brons
        if ( preg_match( '/\((?P<reservedWord>New|AP|PP)\)/si',$this->title,$aParts ) )
        {
            $szClass .= ' ' . strtolower( $aParts['reservedWord'] );
        }

        $szRetVal .= "<article vocab=\"http://schema.org/\" typeof=\"MusicRecording\" class=\"{$szClass}\">\n";
            $szRetVal .= "<span property=\"title\">{$this->title}</span> by <span typeof=\"byArtist\" property=\"name\">{$this->byArtist->name}</span>";
        $szRetVal .= "</article>\n";

        return ( $szRetVal );
    }   /* End of MusicRecording.render() =========================================== */
    /* ============================================================================== */

}   /* End of class MusicRecording ================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class WebPage=

    {*desc

        A web page. Every web page is implicitly assumed to be declared to be of
        type WebPage, so the various properties about that webpage, such as
        breadcrumb may be used. We recommend explicit declaration if these
        properties are specified, but if they are found outside of an itemscope,
        they will be assumed to be about the page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/WebPage[/url] *}

    *}}
 */
/* ================================================================================== */
class WebPage extends CreativeWork
/*------------------------------*/
{
    public $breadcrumb                  = null;                     /* {*property   $breadcrumb                 (BreadcrumbList|string)                     A set of links that can help a user understand and
                                                                                                                                                            navigate a website hierarchy. *} */
    public $lastReviewed                = null;                     /* {*property   $lastReviewed               (Date)                                      Date on which the content on this web page was last
                                                                                                                                                            reviewed for accuracy and/or completeness. *} */
    public $mainContentOfPage           = null;                     /* {*property   $mainContentOfPage          (WebPageElement)                            Indicates if this web page element is the main subject
                                                                                                                                                            of the page. Supersedes aspect. *} */
    public $primaryImageOfPage          = null;                     /* {*property   $primaryImageOfPage         (ImageObject)                               Indicates the main image on the page. *} */
    public $relatedLink                 = null;                     /* {*property   $relatedLink                (URL)                                       A link related to this web page, for example to
                                                                                                                                                            other related web pages. *} */
    public $reviewedBy                  = null;                     /* {*property   $reviewedBy                 (Organization|Person)                       People or organizations that have reviewed the content
                                                                                                                                                            on this web page for accuracy and/or completeness. *} */
    public $significantLink             = null;                     /* {*property   $significantLink            (URL)                                       One of the more significant URLs on the page. Typically,
                                                                                                                                                            these are the non-navigation links that are clicked
                                                                                                                                                            on the most. Supersedes significantLinks. *} */
    public $speakable                   = null;                     /* {*property   $speakable                  (SpeakableSpecification|URL)                Indicates sections of a Web page that are particularly
                                                                                                                                                            'speakable' in the sense of being highlighted as being
                                                                                                                                                            especially appropriate for text-to-speech conversion.
                                                                                                                                                            Other sections of a page may also be usefully spoken
                                                                                                                                                            in particular circumstances; the 'speakable' property
                                                                                                                                                            serves to indicate the parts most likely to be
                                                                                                                                                            generally useful for speech.

                                                                                                                                                            The speakable property can be repeated an arbitrary
                                                                                                                                                            number of times, with three kinds of possible
                                                                                                                                                            'content-locator' values:

                                                                                                                                                            1.) id-value URL references - uses id-value of an
                                                                                                                                                            element in the page being annotated. The simplest
                                                                                                                                                            use of speakable has (potentially relative) URL
                                                                                                                                                            values, referencing identified sections of the
                                                                                                                                                            document concerned.

                                                                                                                                                            2.) CSS Selectors - addresses content in the
                                                                                                                                                            annotated page, eg. via class attribute. Use the
                                                                                                                                                            cssSelector property.

                                                                                                                                                            3.) XPaths - addresses content via XPaths (assuming
                                                                                                                                                            an XML view of the content). Use the xpath property.

                                                                                                                                                            For more sophisticated markup of speakable sections
                                                                                                                                                            beyond simple ID references, either CSS selectors or
                                                                                                                                                            XPath expressions to pick out document section(s) as
                                                                                                                                                            speakable. For this we define a supporting type,
                                                                                                                                                            SpeakableSpecification which is defined to be a
                                                                                                                                                            possible value of the speakable property. *} */

    public $specialty                    = null;                     /* {*property   $specialty                  (Specialty)                                 One of the domain specialities to which this web
                                                                                                                                                            page's content applies. *} */
}   /* End of class WebPage ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class CheckoutPage=

    {*desc

        Web page type: Checkout page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CheckoutPage[/url] *}

    *}}
 */
/* ================================================================================== */
class CheckoutPage extends WebPage
/*------------------------------*/
{
}   /* End of class CheckoutPage ==================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class ContactPage=

    {*desc

        Web page type: Contact page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*remark

        A [c]ContactPage[/c] is no different than a WebPage (for schema.org)

    *}

    {*doc [url]http://schema.org/ContactPage[/url] *}

    *}}
 */
/* ================================================================================== */
class ContactPage extends WebPage
/*------------------------------*/
{
}   /* End of class ContactPage ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Article=

    {*desc

        An article, such as a news article or piece of investigative report.
        Newspapers and magazines have articles of many different types and this
        is intended to cover them all.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Article[/url] *}

    *}}
 */
/* ================================================================================== */
class Article extends CreativeWork
/*------------------------------*/
{
    public  $additionalName             = null;                     /* {*property   $additionalName                (string)                                    An additional name for a Person, can be used for
                                                                                                                                                            a middle name. *} */

    public  $articleBody                = null;                     /* {*property   $articleBody                (string)                                    The actual body of the article. *} */
    public  $articleSection             = null;                     /* {*property   $articleSection             (string)                                    Articles may belong to one or more 'sections' in a magazine or newspaper, such
                                                                                                                                                            as Sports, Lifestyle, etc. *} */
    public  $backstory                  = null;                     /* {*property   $backstory                  (CreativeWork|string)                       For an Article, typically a NewsArticle, the backstory property provides a
                                                                                                                                                            textual summary giving a brief explanation of why and how an article was
                                                                                                                                                            created. In a journalistic setting this could include information about
                                                                                                                                                            reporting process, methods, interviews, data sources, etc. *} */
    public  $pageEnd                    = null;                     /* {*property   $pageEnd                    (integer|string)                             The page on which the work ends; for example "138" or "xvi". *} */
    public  $pageStart                  = null;                     /* {*property   $pageStart                  (integer|string)                            The page on which the work starts; for example "135" or "xiii". *} */
    public  $pagination                 = null;                     /* {*property   $pagination                 (string)                                     Any description of pages that is not separated into pageStart and pageEnd;
                                                                                                                                                            for example, "1-6, 9, 55" or "10-12, 46-49". *} */
    public  $speakable                  = null;                     /* {*property   $speakable                  (SpeakableSpecification|URL)                Indicates sections of a Web page that are particularly 'speakable' in the
                                                                                                                                                            sense of being highlighted as being especially appropriate for text-to-speech
                                                                                                                                                            conversion. Other sections of a page may also be usefully spoken in particular
                                                                                                                                                            circumstances; the 'speakable' property serves to indicate the parts most
                                                                                                                                                            likely to be generally useful for speech.

                                                                                                                                                            The speakable property can be repeated an arbitrary number of times,
                                                                                                                                                            with three kinds of possible 'content-locator' values:

                                                                                                                                                            1.) id-value URL references - uses id-value of an element in the page being annotated.
                                                                                                                                                                The simplest use of speakable has (potentially relative) URL values, referencing
                                                                                                                                                                identified sections of the document concerned.

                                                                                                                                                            2.) CSS Selectors - addresses content in the annotated page, eg. via class attribute.
                                                                                                                                                                Use the cssSelector property.

                                                                                                                                                            3.) XPaths - addresses content via XPaths (assuming an XML view of the content).
                                                                                                                                                                Use the xpath property.

                                                                                                                                                            For more sophiNewssticated markup of speakable sections beyond simple ID references,
                                                                                                                                                            either CSS selectors or XPath expressions to pick out document section(s) as
                                                                                                                                                            speakable. For this we define a supporting type, SpeakableSpecification which is
                                                                                                                                                            defined to be a possible value of the speakable property. *} */
    public  $wordCount                  = null;                     /* {*property   $wordCount                  (integer)                                   The number of words in the text of the Article. *} */

}   /* End of class Article ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class NewsArticle=

    {*desc

        A NewsArticle is an article whose content reports news, or provides
        background context and supporting materials for understanding the news.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/NewsArticle[/url] *}

    *}}
 */
/* ================================================================================== */
class NewsArticle extends Article
/*------------------------------*/
{

    public  $dateline                   = null;                     /* {*property   $dateline                   (string)                                    A dateline is a brief piece of text included in news articles that describes where
                                                                                                                                                            and when the story was written or filed though the date is often omitted.
                                                                                                                                                            Sometimes only a placename is provided.

                                                                                                                                                            Structured representations of dateline-related information can also be expressed
                                                                                                                                                            more explicitly using locationCreated (which represents where a work was created
                                                                                                                                                            e.g. where a news report was written). For location depicted or described in the
                                                                                                                                                            content, use contentLocation.

                                                                                                                                                            Dateline summaries are oriented more towards human readers than towards automated
                                                                                                                                                            processing, and can vary substantially. Some examples: "BEIRUT, Lebanon,
                                                                                                                                                            June 2.", "Paris, France", "December 19, 2017 11:43AM Reporting from Washington",
                                                                                                                                                            "Beijing/Moscow", "QUEZON CITY, Philippines". *} */
    public  $printColumn                = null;                     /* {*property   $printColumn                (string)                                    The number of the column in which the NewsArticle appears in the print edition. *} */
    public  $printEdition               = null;                     /* {*property   $printEdition               (string)                                    The edition of the print product in which the NewsArticle appears. *} */
    public  $printPage                  = null;                     /* {*property   $printPage                  (string)                                    If this NewsArticle appears in print, this field indicates the name of the page on
                                                                                                                                                            which the article is found. Please note that this field is intended for the exact
                                                                                                                                                            page name (e.g. A5, B18). *} */
    public  $printSection               = null;                     /* {*property   $printSection               (string)                                    If this NewsArticle appears in print, this field indicates the print section in
                                                                                                                                                            which the article appeared. *} */
}   /* End of class NewsArticle ===================================================== */
/* ================================================================================== */


class Person extends Thing
/*----------------------*/
{
    public  $additionalName             = null;                     /* {*property   $additionalName                (string)                                    An additional name for a Person, can be used for
                                                                                                                                                            a middle name. *} */
    public  $address                    = null;                     /* {*property   $address                    (PostalAddress|string)                      Physical address of the item. *} */
    public  $affiliation                = null;                     /* {*property   $affiliation                (Organization)                              An organization that this person is affiliated
                                                                                                                                                            with. For example, a school/university, a club,
                                                                                                                                                            or a team. *} */
    public  $alumniOf                   = null;                     /* {*property   $alumniOf                   (EducationalOrganization|Organization)      An organization that the person is an alumni of.
                                                                                                                                                            Inverse property: alumni. *} */
    public  $award                      = null;                     /* {*property   $award                      (string)                                    An award won by or for this item. Supersedes awards. *} */
    public  $birthDate                  = null;                     /* {*property   $birthDate                  (Date)                                      Date of birth. *} */
    public  $birthPlace                 = null;                     /* {*property   $birthPlace                 (Place)                                     The place where the person was born. *} */
    public  $brand                      = null;                     /* {*property   $brand                      (Brand|Organization)                        The brand(s) associated with a product or service,
                                                                                                                                                            or the brand(s) maintained by an organization
                                                                                                                                                            or business person. *} */
    public  $children                   = null;                     /* {*property   $children                   (Person)                                    A child of the person. *} */
    public  $colleague                  = null;                     /* {*property   $colleague                  (Person|URL)                                A colleague of the person. Supersedes colleagues. *} */
    public  $contactPoint               = null;                     /* {*property   $contactPoint               (ContactPoint)                              A contact point for a person or organization.
                                                                                                                                                            Supersedes contactPoints. *} */
    public  $deathDate                    = null;                     /* {*property   $deathDate                    (Date)                                      Date of death. *} */
    public  $deathPlace                    = null;                     /* {*property   $deathPlace                    (Place)                                     The place where the person died. *} */
    public  $duns                       = null;                     /* {*property   $duns                       (string)                                    The Dun & Bradstreet DUNS number for identifying an
                                                                                                                                                            organization or business person. *} */
    public  $email                      = null;                     /* {*property   $email                      (string)                                    Email address. *} */
    public  $familyName                 = null;                     /* {*property   $familyName                 (string)                                    Family name. In the U.S., the last name of an Person. This can
                                                                                                                                                            be used along with givenName instead of the name property. *} */
    public  $faxNumber                  = null;                     /* {*property   $faxNumber                  (string)                                    The fax number. *} */
    public  $follows                    = null;                     /* {*property   $follows                    (Person                                     The most generic uni-directional social relation. *} */
    public  $funder                     = null;                     /* {*property   $funder                     (Organization|Person)                       A person or organization that supports (sponsors) something
                                                                                                                                                            through some kind of financial contribution. *} */
    public  $gender                     = null;                     /* {*property   $gender                     (GenderType|string)                         Gender of the person. While http://schema.org/Male and
                                                                                                                                                            http://schema.org/Female may be used, text strings are
                                                                                                                                                            also acceptable for people who do not identify as a
                                                                                                                                                            binary gender. *} */
    public  $givenName                  = null;                     /* {*property   $givenName                  (string)                                     Given name. In the U.S., the first name of a Person. This can
                                                                                                                                                            be used along with familyName instead of the name property. *} */
    public  $globalLocationNumber       = null;                     /* {*property   $globalLocationNumber       (string)                                     The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                            International Location Number or ILN) of the respective
                                                                                                                                                            organization, person, or place. The GLN is a 13-digit number
                                                                                                                                                            used to identify parties and physical locations. *} */
    public  $hasCredential              = null;                     /* {*property   $hasCredential              (EducationalOccupationalCredential)         A credential awarded to the Person or Organization. *} */
    public  $hasOccupation              = null;                     /* {*property   $hasOccupation              (Occupation)                                The Person's occupation. For past professions, use Role for expressing dates. *} */
    public  $hasOfferCatalog            = null;                     /* {*property   $hasOfferCatalog            (OfferCatalog)                              Indicates an OfferCatalog listing for this Organization, Person, or Service. *} */
    public  $hasPOS                     = null;                     /* {*property   $hasPOS                     (Place)                                     Points-of-Sales operated by the organization or person. *} */
    public  $height                     = null;                     /* {*property   $height                     (Distance|QuantitativeValue)                The height of the item. *} */
    public  $homeLocation               = null;                     /* {*property   $homeLocation               (ContactPoint|Place)                        A contact location for a person's residence. *} */
    public  $honorificPrefix            = null;                     /* {*property   $honorificPrefix            (string)                                    An honorific prefix preceding a Person's name such as Dr/Mrs/Mr. *} */
    public  $honorificSuffix            = null;                     /* {*property   $honorificSuffix            (string)                                    An honorific suffix preceding a Person's name such as M.D. /PhD/MSCSW. *} */
    public  $isicV4                     = null;                     /* {*property   $isicV4                     (string)                                    The International Standard of Industrial Classification of All Economic
                                                                                                                                                            Activities (ISIC), Revision 4 code for a particular organization,
                                                                                                                                                            business person, or place. *} */
    public  $jobTitle                   = null;                     /* {*property   $jobTitle                   (DefinedTerm|string)                        The job title of the person (for example, Financial Manager). *} */
    public  $knows                      = null;                     /* {*property   $knows                      (Person)                                    The most generic bi-directional social/work relation. *} */
    public  $knowsAbout                 = null;                     /* {*property   $knowsAbout                 (string|Thing|URL)                          Of a Person, and less typically of an Organization, to indicate a topic
                                                                                                                                                            that is known about - suggesting possible expertise but not implying it.
                                                                                                                                                            We do not distinguish skill levels here, or relate this to educational
                                                                                                                                                            content, events, objectives or JobPosting descriptions. *} */
    public  $knowsLanguage              = null;                     /* {*property   $knowsLanguage              (Language|string)                           Of a Person, and less typically of an Organization, to indicate a known
                                                                                                                                                            language. We do not distinguish skill levels or
                                                                                                                                                            reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                            IETF BCP 47 standard. *} */
    public  $makesOffer                 = null;                     /* {*property   $makesOffer                 (Offer)                                     A pointer to products or services offered by the organization or person.
                                                                                                                                                            Inverse property: offeredBy *} */
    public  $memberOf                   = null;                     /* {*property   $memberOf                   (Organization|ProgramMembership)            An Organization (or ProgramMembership) to which this Person or
                                                                                                                                                            Organization belongs. Inverse property: member. *} */
    public  $naics                      = null;                     /* {*property   $naics                      (string)                                    The North American Industry Classification System (NAICS) code for a
                                                                                                                                                            particular organization or business person. *} */
    public  $nationality                = null;                     /* {*property   $nationality                (Country)                                   Nationality of the person. *} */
    public  $netWorth                   = null;                     /* {*property   $netWorth                   (MonetaryAmount|PriceSpecification)         The total financial value of the person as calculated by subtracting
                                                                                                                                                            assets from liabilities. *} */
    public  $owns                       = null;                     /* {*property   $owns                       (OwnershipInfo|Product)                     Products owned by the organization or person. *} */
    public  $parent                     = null;                     /* {*property   $parent                     (Person)                                    A parent of this person. Supersedes parents. *} */
    public  $performerIn                = null;                     /* {*property   $performerIn                (Event)                                     Event that this person is a performer or participant in. *} */
    public  $publishingPrinciples       = null;                     /* {*property   $publishingPrinciples       (CreativeWork|URL)                          The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                            document describing the editorial principles of an Organization
                                                                                                                                                            (or individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                            activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                            applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                            of the party primarily responsible for the creation of the CreativeWork.

                                                                                                                                                            While such policies are most typically expressed in natural
                                                                                                                                                            language, sometimes related information (e.g. indicating a
                                                                                                                                                            funder) can be expressed using schema.org terminology. *} */

    public  $relatedTo                  = null;                     /* {*property   $relatedTo                  (Person)                                    The most generic familial relation. *} */
    public  $seeks                      = null;                     /* {*property   $seeks                      (Demand)                                    A pointer to products or services sought by the organization or person (demand). *} */
    public  $sibling                    = null;                     /* {*property   $sibling                    (Person)                                    A sibling of the person. Supersedes siblings. *} */
    public  $sponsor                    = null;                     /* {*property   $sponsor                    (Organization|Person)                       A person or organization that supports a thing through a pledge, promise,
                                                                                                                                                            or financial contribution. e.g. a sponsor of a Medical Study or a
                                                                                                                                                            corporate sponsor of an event. *} */
    public  $spouse                     = null;                     /* {*property   $spouse                     (Person)                                    The person's spouse. *} */
    public  $taxID                      = null;                     /* {*property   $taxID                      (string)                                    The Tax / Fiscal ID of the organization or person, e.g. the TIN
                                                                                                                                                            in the US or the CIF/NIF in Spain. *} */
    public  $telephone                  = null;                     /* {*property   $telephone                  (string)                                    The telephone number. *} */
    public  $vatID                      = null;                     /* {*property   $vatID                      (string)                                    The Value-added Tax ID of the organization or person. *} */
    public  $weight                     = null;                     /* {*property   $weight                     (QuantitativeValue)                         The weight of the product or person. *} */
    public  $workLocation               = null;                     /* {*property   $workLocation               (ContactPoint|Place)                        A contact location for a person's place of work. *} */
    public  $worksFor                   = null;                     /* {*property   $worksFor                   (Organization)                              Organizations that the person works for. *} */

}   /* End of class Person ========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Organization=

    {*desc

        An organization such as a school, NGO, corporation, club, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Organization[/url] *}

    *}}
 */
/* ================================================================================== */
class Organization extends Thing
/*----------------------------*/
{
    public $actionableFeedbackPolicy    = null;                     /* {*property   $actionableFeedbackPolicy   (CreativeWork|URL)                          For a NewsMediaOrganization or other news-related Organization, a
                                                                                                                                                            statement about public engagement activities (for news media, the
                                                                                                                                                            newsroom’s), including involving the public - digitally or
                                                                                                                                                            otherwise -- in coverage decisions, reporting and activities
                                                                                                                                                            after publication. *} */
    public $address                     = null;                     /* {*property   $address                    (PostalAddress|string)                      Physical address of the item. *} */
    public $aggregateRating             = null;                     /* {*property   $aggregateRating            (AggregateRating)                           The overall rating, based on a collection of reviews or ratings, of the item. *} */
    public $alumni                      = null;                     /* {*property   $alumni                     (Person)                                    Alumni of an organization. Inverse property: alumniOf. *} */
    public $areaServed                  = null;                     /* {*property   $areaServed                 (AdministrativeArea|GeoShape|Place|string)  The geographic area where a service or offered item is provided.
                                                                                                                                                            Supersedes serviceArea. *} */
    public $award                       = null;                     /* {*property   $award                      (string)                                    An award won by or for this item. Supersedes awards. *} */
    public $brand                       = null;                     /* {*property   $brand                      (Brand|Organization)                        The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                            maintained by an organization or business person. *} */
    public $contactPoint                = null;                     /* {*property   $contactPoint               (ContactPoint)                              A contact point for a person or organization. Supersedes contactPoints. *} */
    public $correctionsPolicy           = null;                     /* {*property   $correctionsPolicy          (CreativeWork|URL)                          For an Organization (e.g. NewsMediaOrganization), a statement describing
                                                                                                                                                            (in news media, the newsroom’s) disclosure and correction policy for errors. *} */
    public $department                  = null;                     /* {*property   $department                 (Organization)                              A relationship between an organization and a department of that
                                                                                                                                                            organization, also described as an organization (allowing different
                                                                                                                                                            urls, logos, opening hours). For example: a store with a pharmacy, or
                                                                                                                                                            a bakery with a cafe. *} */
    public $dissolutionDate             = null;                     /* {*property   $dissolutionDate            (Date)                                      The date that this organization was dissolved. *} */
    public $diversityPolicy             = null;                     /* {*property   $diversityPolicy            (CreativeWork|URL)                          Statement on diversity policy by an Organization
                                                                                                                                                            e.g. a NewsMediaOrganization. For a NewsMediaOrganization, a statement
                                                                                                                                                            describing the newsroom’s diversity policy on both staffing and sources,
                                                                                                                                                            typically providing staffing data. *} */
    public $diversityStaffingReport     = null;                     /* {*property   $diversityStaffingReport    (Article|URL)                               For an Organization (often but not necessarily a NewsMediaOrganization),
                                                                                                                                                            a report on staffing diversity issues. In a news context this might be
                                                                                                                                                            for example ASNE or RTDNA (US) reports, or self-reported. *} */
    public $duns                        = null;                     /* {*property   $duns                       (string)                                    The Dun & Bradstreet DUNS number for identifying an organization or
                                                                                                                                                            business person. *} */
    public $email                       = null;                     /* {*property   $email                      (string)                                    Email address. *} */
    public $employee                    = null;                     /* {*property   $employee                   (Person)                                    Someone working for this organization. Supersedes employees. *} */
    public $ethicsPolicy                = null;                     /* {*property   $ethicsPolicy               (CreativeWork|URL)                          Statement about ethics policy, e.g. of a NewsMediaOrganization regarding
                                                                                                                                                            journalistic and publishing practices, or of a Restaurant, a page describing
                                                                                                                                                            food source policies. In the case of a NewsMediaOrganization, an ethicsPolicy
                                                                                                                                                            is typically a statement describing the personal, organizational, and
                                                                                                                                                            corporate standards of behavior expected by the organization. *} */
    public $event                       = null;                     /* {*property   $event                      (Event)                                     Upcoming or past event associated with this place, organization, or action.
                                                                                                                                                            Supersedes events. *} */
    public $faxNumber                   = null;                     /* {*property   $faxNumber                  (string)                                    The fax number. *} */
    public $founder                     = null;                     /* {*property   $founder                    (Person)                                    A person who founded this organization. Supersedes founders. *} */
    public $foundingDate                = null;                     /* {*property   $foundingDate               (Date)                                      The date that this organization was founded. *} */
    public $foundingLocation            = null;                     /* {*property   $foundingLocation           (Place)                                     The place where the Organization was founded. *} */
    public $funder                      = null;                     /* {*property   $funder                     (Organization|Person)                       A person or organization that supports (sponsors) something through some kind
                                                                                                                                                            of financial contribution. *} */
    public $globalLocationNumber        = null;                     /* {*property   $globalLocationNumber       (string)                                    The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                            International Location Number or ILN) of the respective organization,
                                                                                                                                                            person, or place. The GLN is a 13-digit number used to identify
                                                                                                                                                            parties and physical locations. *} */
    public $hasCredential               = null;                     /* {*property   $hasCredential              (EducationalOccupationalCredential)         A credential awarded to the Person or Organization. *} */
    public $hasOfferCatalog             = null;                     /* {*property   $hasOfferCatalog            (OfferCatalog)                              Indicates an OfferCatalog listing for this Organization, Person, or Service. *} */
    public $hasPOS                      = null;                     /* {*property   $hasPOS                     (Place)                                     Points-of-Sales operated by the organization or person. *} */
    public $hasProductReturnPolicy      = null;                     /* {*property   $hasProductReturnPolicy     (ProductReturnPolicy)                       Indicates a ProductReturnPolicy that may be applicable. *} */
    public $isicV4                      = null;                     /* {*property   $isicV4                     (string)                                    The International Standard of Industrial Classification of All Economic
                                                                                                                                                            Activities (ISIC), Revision 4 code for a particular organization, business
                                                                                                                                                            person, or place. *} */
    public $knowsAbout                  = null;                     /* {*property   $knowsAbout                 (string|Thing|URL)                          Of a Person, and less typically of an Organization, to indicate a topic
                                                                                                                                                            that is known about - suggesting possible expertise but not implying it.
                                                                                                                                                            We do not distinguish skill levels here, or relate this to educational
                                                                                                                                                            content, events, objectives or JobPosting descriptions. *} */
    public $knowsLanguage               = null;                     /* {*property   $knowsLanguage              (Language|string)                           Of a Person, and less typically of an Organization, to indicate a known
                                                                                                                                                            language. We do not distinguish skill levels or
                                                                                                                                                            reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                            IETF BCP 47 standard. *} */
    public $legalName                   = null;                     /* {*property   $legalName                  (string)                                    The official name of the organization, e.g. the registered company name. *} */
    public $leiCode                     = null;                     /* {*property   $leiCode                    (string)                                    An organization identifier that uniquely identifies a legal entity as
                                                                                                                                                            defined in ISO 17442. *} */
    public $location                    = null;                     /* {*property   $location                   (Place|PostalAddress|string)                The location of for example where the event is happening, an organization
                                                                                                                                                            is located, or where an action takes place. *} */
    public $logo                        = null;                     /* {*property   $logo                       (ImageObject|URL)                           An associated logo. *} */
    public $makesOffer                  = null;                     /* {*property   $makesOffer                 (Offer)                                     A pointer to products or services offered by the organization or person.
                                                                                                                                                            Inverse property: offeredBy. *} */
    public $member                      = null;                     /* {*property   $member                     (Organization|Person)                       A member of an Organization or a ProgramMembership. Organizations can be
                                                                                                                                                            members of organizations; ProgramMembership is typically for individuals.
                                                                                                                                                            Supersedes members, musicGroupMember. Inverse property: memberOf. *} */
    public $memberOf                    = null;                     /* {*property   $memberOf                   (Organization|ProgramMembership)            An Organization (or ProgramMembership) to which this Person or Organization
                                                                                                                                                            belongs. Inverse property: member. *} */
    public $naics                       = null;                     /* {*property   $naics                      (string)                                    The North American Industry Classification System (NAICS) code for a
                                                                                                                                                            particular organization or business person. *} */
    public $numberOfEmployees           = null;                     /* {*property   $numberOfEmployees          (QuantitativeValue)                         The number of employees in an organization e.g. business. *} */
    public $ownershipFundingInfo        = null;                     /* {*property   $ownershipFundingInfo       (AboutPage|CreativeWork|string|URL)         For an Organization (often but not necessarily a NewsMediaOrganization),
                                                                                                                                                            a description of organizational ownership structure; funding and grants.
                                                                                                                                                            In a news/media setting, this is with particular reference to editorial
                                                                                                                                                            independence. Note that the funder is also available and can be used to
                                                                                                                                                            make basic funder information machine-readable. *} */
    public $owns                        = null;                     /* {*property   $owns                       (OwnershipInfo|Product)                     Products owned by the organization or person. *} */
    public $parentOrganization          = null;                     /* {*property   $parentOrganization         (Organization)                              The larger organization that this organization is a subOrganization of,
                                                                                                                                                            if any. Supersedes branchOf. Inverse property: subOrganization. *} */
    public $publishingPrinciples        = null;                     /* {*property   $publishingPrinciples       (CreativeWork|URL)                          The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                            document describing the editorial principles of an Organization
                                                                                                                                                            (or individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                            activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                            applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                            of the party primarily responsible for the creation of the CreativeWork.

                                                                                                                                                            While such policies are most typically expressed in natural language,
                                                                                                                                                            sometimes related information (e.g. indicating a funder) can be
                                                                                                                                                            expressed using schema.org terminology. *} */

    public $review                      = null;                     /* {*propert    $review                     (Review)                                    A review of the item. Supersedes reviews. *} */
    public $seeks                       = null;                     /* {*propert    $seeks                      (Demand)                                    A pointer to products or services sought by the organization or person (demand). *} */
    public $slogan                      = null;                     /* {*propert    $slogan                     (string)                                    A slogan or motto associated with the item. *} */
    public $sponsor                     = null;                     /* {*propert    $sponsor                    (Organization|Person)                       A person or organization that supports a thing through a pledge,
                                                                                                                                                            promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                            or a corporate sponsor of an event. *} */
    public $subOrganization             = null;                     /* {*propert    $subOrganization            (Organization)                              A relationship between two organizations where the first includes the second,
                                                                                                                                                            e.g., as a subsidiary. See also: the more specific 'department'
                                                                                                                                                            property. Inverse property: parentOrganization. *} */
    public $taxID                       = null;                     /* {*propert    $taxID                      (string)                                    The Tax / Fiscal ID of the organization or person, e.g. the TIN in the
                                                                                                                                                            US or the CIF/NIF in Spain. *} */
    public $telephone                   = null;                     /* {*propert    $telephone                  (string)                                    The telephone number. *} */
    public $unnamedSourcesPolicy        = null;                     /* {*propert    $unnamedSourcesPolicy       (CreativeWork|URL)                          For an Organization (typically a NewsMediaOrganization), a statement
                                                                                                                                                            about policy on use of unnamed sources and the decision process required. *} */
    public $vatID                       = null;                     /* {*propert    $vatID                      (string)                                    The Value-added Tax ID of the organization or person. *} */

}   /* End of class Organization ==================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class LocalBusiness=

    {*desc

        A particular physical business or branch of an organization. Examples of
        LocalBusiness include a restaurant, a particular branch of a restaurant
        chain, a branch of a bank, a medical practice, a club, a bowling alley,
        etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/LocalBusiness[/url] *}

    *}}
 */
/* ================================================================================== */
class LocalBusiness extends Organization
/*------------------------------------*/
{

    public  $currenciesAccepted         = null;                     /* {*property $currenciesAccepted           (string)                                    The currency accepted.

                                                                                                                                                            Use standard formats: ISO 4217 currency format
                                                                                                                                                            e.g. "USD"; Ticker symbol for
                                                                                                                                                            cryptocurrencies e.g. "BTC"; well known names for Local Exchange Tradings
                                                                                                                                                            Systems (LETS) and other currency types e.g. "Ithaca HOUR". *} */

    public  $openingHours               = null;                     /* {*property $openingHours                 (string)                                    The general opening hours for a business. Opening hours can be specified
                                                                                                                                                            as a weekly time range, starting with days, then times per day.
                                                                                                                                                            Multiple days can be listed with commas ',' separating each day.
                                                                                                                                                            Day or time ranges are specified using a hyphen '-'.

                                                                                                                                                            Days are specified using the following two-letter combinations:
                                                                                                                                                            Mo, Tu, We, Th, Fr, Sa, Su.

                                                                                                                                                            Times are specified using 24:00 time. For example, 3pm is specified as 15:00.

                                                                                                                                                            Here is an example: <time itemprop="openingHours"
                                                                                                                                                            datetime="Tu,Th 16:00-20:00">Tuesdays and Thursdays 4-8pm</time>.

                                                                                                                                                            If a business is open 7 days a week, then it can be specified as <time
                                                                                                                                                            itemprop="openingHours" datetime="Mo-Su">Monday through Sunday, all day</time>. *} */

    public  $paymentAccepted            = null;                     /* {*property $paymentAccepted              (string)                                    Cash, Credit Card, Cryptocurrency, Local Exchange Tradings System, etc. *} */
    public  $priceRange                 = null;                     /* {*property $priceRange                   (string)                                    The price range of the business, for example $$$. *} */
}   /* End of class LocalBusiness =================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Store=

    {*desc

        A retail good store.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Store[/url] *}

    *}}
 */
/* ================================================================================== */
class Store extends LocalBusiness
/*------------------------------*/
{
}   /* End of class Store =========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class ClothingStore=

    {*desc

        A clothing store.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/ClothingStore[/url] *}

    *}}
 */
/* ================================================================================== */
class ClothingStore extends Store
/*------------------------------*/
{
}   /* End of class ClothingStore =================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class PerformingGroup=

    {*desc
        A performance group, such as a band, an orchestra, or a circus.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/PerformingGroup[/url] *}

    *}}
 */
/* ================================================================================== */
class PerformingGroup extends Organization
/*--------------------------------------*/
{

}   /* End of class PerformingGroup ================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MusicGroup=

    {*desc
        A musical group, such as a band, an orchestra, or a choir. Can also be a solo
        musician.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/MusicGroup[/url] *}

    *}}
 */
/* ================================================================================== */
class MusicGroup extends PerformingGroup
/*------------------------------------*/
{
    public $album                       = null;                     /* {*property $album                        (MusicAlbum)                                   A music album. Supersedes albums. *} */
    public $genre                       = null;                     /* {*property $genre                        (string|URL)                                   Genre of the creative work, broadcast channel or group. *} */
    public $track                       = null;                     /* {*property $track                        (ItemList|MusicRecording)                      A music recording (track)—usually a
                                                                                                                                                               single song. If an ItemList is given,
                                                                                                                                                               the list should contain items of type
                                                                                                                                                               MusicRecording. Supersedes tracks. *} */
}   /* End of class MusicGroupMusicGroup ============================================ */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Action=

    {*desc
        An action performed by a direct agent and indirect participants upon a
        direct object. Optionally happens at a location with the help of an
        inanimate instrument. The execution of the action may produce a result.
        Specific action sub-type documentation specifies the exact expectation
        of each argument/role.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Action[/url] *}

    *}}
 */
/* ================================================================================== */
class Action extends Thing
/*----------------------*/
{
}   /* End of class Action ========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Intangible=

    {*desc
        A utility class that serves as the umbrella for a number of 'intangible'
        things such as quantities, structured values, etc.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Intangible[/url] *}

    *}}
 */
/* ================================================================================== */
class Intangible extends Thing
/*--------------------------*/
{
    // Il n'y a rien à mettre ici: pas de propriété additionnelle par rapport à Thing

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }
}   /* End of class Intangible ====================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class DataFeedItem=

    {*desc

        A single item within a larger data feed.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DataFeedItem[/url] *}

    *}}
 */
/* ================================================================================== */
class DataFeedItem extends Intangible
/*---------------------------------*/
{
    public  $dateCreated                = null;                     /* {*property   $dateCreated                (Date|DateTime)                             The date on which the CreativeWork was created or the item was
                                                                                                                                                            added to a DataFeed. *} */
    public  $dateDeleted                = null;                     /* {*property   $dateDeleted                (Date|DateTime)                             The datetime the item was removed from the DataFeed. *} */
    public  $dateModified               = null;                     /* {*property   $dateModified               (Date|DateTime)                             The date on which the CreativeWork was most recently modified or
                                                                                                                                                            when the item's entry was modified within a DataFeed. *} */
    public  $item                       = null;                     /* {*property   $item                       (Thing)                                     An entity represented by an entry in a list or data feed
                                                                                                                                                            (e.g. an 'artist' in a list of 'artists'). *} */

    /* -- [ Properties NOT found in schema.org ] ---------------- */
    public  $datePublication            = null;                     /* {*property   $datePublication            (Date|DateTime)                             The date the feed can be published *} */
    public  $identifier                 = null;                     /* {*property   $identifier                 (PropertyValue|string|URL)                  The identifier property represents any kind of identifier for any
                                                                                                                                                            kind of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org
                                                                                                                                                            provides dedicated properties for representing many of these,
                                                                                                                                                            either as textual strings or as URL (URI) links. See background
                                                                                                                                                            notes for more details. *} */

    public  $comment                    = null;                     /* {*property   $comment                    (Comment)                                   A comment on an item *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }

}   /* End of class DataFeedItem ==================================================== */
/* ================================================================================== */

class RSSChannel
/*------------*/
{
    use     Feed;

    public  $szTitle                    = '';
    public  $szDesc                     = '';
    public  $szPubDate                  = '';
    public  $szLastBuild                = '';
    public  $szLink                     = '';
    public  $szLanguage                 = '';
    public  $szCopyright                = '';
    public  $szManagingEditor           = '';
    public  $szRating                   = '';
    public  $szWebMaster                = '';
    public  $szSkipDays                 = '';
    public  $szSkipHours                = '';
    public  $szCategory                 = '';
    public  $szGenerator                = '';
    public  $szTTL                      = '';
    public  $szCloud                    = '';
    public  $szDocs                     = '';
    public  $szImageTitle               = '';
    public  $szImageURL                 = '';
    public  $szImageLink                = '';
    public  $iImageWidth                = -1;
    public  $iImageHeight               = -1;

    public  $bMustPublish               = true;
    public  $bMustDisplayChannelImage   = true;
    public  $szHeading                  = 'h2';

    public  $aItems                     = null;

    public function populate( $oXPath,$oNode,$szType = 'rss2' )
    /*--------------------------------------------------------*/
    {
        // subTag() is defined as a method of the "feed" trait (use feed)

        switch( $szType )
        {
            case 'atom' :
                {
                    // In the case of an Atom feed, there is NO channel node and therefore
                    // $oNode is null
                    //echo __LINE__," of ",__FILE__," ... CANNOT POPULATE ATOM FEED YET\n";

                    $itemList = $oXPath->query( $szQuery = '/a:feed/a:entry' );

                    if ( ! is_null( $itemList ) && $itemList->length > 0 )
                    {
                        //echo __LINE__," of ",__FILE__," ... {$itemList->length} items found\n";

                        foreach ( $itemList as $oItemNode )                     /* For each item found in this channel */
                        {
                            $oItem = new RSSItem();                             /* Create an item */
                            $oItem->populate( $oXPath,$oItemNode,$szType );
                            $this->aItems[] = $oItem;
                            //var_dump( $oItem->aCategories );
                        }   /* foreach ( $itemList as $oItemNode ) */
                    }
                }
                break;
            case 'rss2' :
                {

                    $this->szTitle          =       $this->subTag( $oXPath,$oNode,'title'           );
                    $this->szDesc           =       $this->subTag( $oXPath,$oNode,'description'     );
                    $this->szLastBuild      =       $this->subTag( $oXPath,$oNode,'lastBuildDate'   );
                    $this->szLink           =       $this->subTag( $oXPath,$oNode,'link'            );
                    $this->szLanguage       =       $this->subTag( $oXPath,$oNode,'language'        );
                    $this->szCopyright      =       $this->subTag( $oXPath,$oNode,'copyright'       );
                    $this->szPubDate        =       $this->subTag( $oXPath,$oNode,'pubDate'         );
                    $this->szLink           =       $this->subTag( $oXPath,$oNode,'link'            );
                    $this->szManagingEditor =       $this->subTag( $oXPath,$oNode,'managingEditor'  );
                    $this->szRating         =       $this->subTag( $oXPath,$oNode,'rating'          );
                    $this->szWebMaster      =       $this->subTag( $oXPath,$oNode,'webMaster'       );
                    $this->szSkipDays       =       $this->subTag( $oXPath,$oNode,'skipDays'        );
                    $this->szSkipHours      =       $this->subTag( $oXPath,$oNode,'skipHours'       );
                    $this->szCategory       =       $this->subTag( $oXPath,$oNode,'category'        );
                    // Ici ... je devrais aussi extraire l'attribut 'domain' de category
                    $this->szGenerator      =       $this->subTag( $oXPath,$oNode,'generator'       );
                    $this->szTTL            =       $this->subTag( $oXPath,$oNode,'ttl'             );
                    $this->szCloud          =       $this->subTag( $oXPath,$oNode,'cloud'           );
                    // Ici ... je devrais aussi extraire d'autres attributs de cloud
                    $this->szDocs           =       $this->subTag( $oXPath,$oNode,'docs'            );
                    $this->szImageTitle     =       $this->subTag( $oXPath,$oNode,'image/title'     );
                    $this->szImageURL       =       $this->subTag( $oXPath,$oNode,'image/url'       );
                    $this->szImageLink      =       $this->subTag( $oXPath,$oNode,'image/link'      );
                    $this->iImageWidth      = (int) $this->subTag( $oXPath,$oNode,'image/width'     );
                    $this->iImageHeight     = (int) $this->subTag( $oXPath,$oNode,'image/height'    );

                    // Voir à quoi ceci correspond dans LSContentsRSS.class.php
                    //$oChannel->szHeading                =                $this->GetParameter( 'channel-heading'      ,$oChannel->szHeading,true );
                    //$oChannel->bMustDisplayChannelImage = MISC_CastBool( $this->GetParameter( 'display-channel-image',false               ,true ) );

                    if ( ! is_null( $itemList =  $this->subTags( $oXPath,$oNode,'item' ) ) )
                    {
                        foreach ( $itemList as $oItemNode )                     /* For each item found in this channel */
                        {
                            $oItem = new RSSItem();                             /* Create an item */
                            $oItem->populate( $oXPath,$oItemNode );
                            $this->aItems[] = $oItem;
                            //var_dump( $oItem->aCategories );
                        }   /* foreach ( $itemList as $oItemNode ) */
                    }   /* if ( ! is_null( $itemList =  $this->subTags( $oXPath,$oNode,'item' ) ) ) */

                }

                break;
        }   /* switch( $szType ) */

    }   /* End of RSSChannel.populate() ============================================= */

}   /* End of class RSSChannel ====================================================== */
/* ================================================================================== */


class RSSItem extends DataFeedItem
/*-------------------------------*/
{
    use Feed;

    public  $aCategories                = null;
    public  $item                       = null;
    public  $source                     = null;                     /* {*property   $source                     (string)                                    The RSS channel that the item came from
                                                                                                                                                            (e.g. <source url="http://www.quotationspage.com/data/qotd.rss">Quotes
                                                                                                                                                            of the Day</source>) *} */
    public  $author                     = null;

    public  $tDate                      = null;
    public  $summary                    = null;                     /* {*property   $summary                    (string)                                    Summary of the item *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->author = new Person();
    }

    protected function chopName( $szStr )
    /*---------------------------------*/
    {
        $szFirstName    =
        $szLastName     =
        $szFullName     = null;


        // Attention, avec des prénoms/noms qui contiennent des caractères accentués on a un problème
        // 'firstname' => string 'St' (length=2)
        // 'lastname' => string 'phanie Schmidt' (length=14)
        // 'fullname' => string 'St phanie Schmidt' (length=17)

        if ( preg_match_all( '/(?:[[:word:]])+/i',$szStr,$aMatches,PREG_PATTERN_ORDER ) )
        {
            //$aMatches = $aMatches[0];
            //var_dump( $aMatches[0] );
            // 0 ... Ben
            // 1 ... Hammersley
            if ( is_array( $aMatches[0] ) && count( $aMatches[0] ) >= 2 )
            {
                $szFirstName    = trim( (string) $aMatches[0][0] );
                $szLastName     = trim( str_replace( $szFirstName . ' ','',(string) implode( ' ',$aMatches[0] ) ) );
                $szFullName     = $szFirstName . ' ' . $szLastName;
                //var_dump( $this->author->givenName );
                //var_dump( $this->author->familyName );
            }   /* if ( is_array( $aMatches[0] ) && count( $aMatches[0] ) >= 2 ) */
        }   /* if ( preg_match_all( '/(?:[[:word:]])+/i',$szName,$aMatches,PREG_PATTERN_ORDER ) ) */

        return ( array( 'firstname' => $szFirstName ,
                        'lastname'  => $szLastName  ,
                        'fullname'  => $szFullName
                      )
               );
    }

    protected function chopAuthor( $szStr )
    /*-----------------------------------*/
    {
        $szFirstName    =
        $szLastName     =
        $szFullName     =
        $szEmail        = null;

        $szEmailPattern = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i';

        // For testing purposes
        //$szStr = 'ben@benhammersley.com (Ben Hammersley)';

        if ( preg_match( $szEmailPattern,$szStr,$aMatch ) )
        {
            //var_dump('dc:creator WITH mail ... ' . $szCreator );
            //var_dump( $aMatch );
            $szEmail = $aMatch[0];

            /* Let's look for '(Ben Hammersley)' in 'ben@benhammersley.com (Ben Hammersley)' */
            if ( preg_match('/\((?P<name>.+)\)/i',$szStr,$aPart ) )
            {
                $aNameParts  = $this->chopName( $aPart['name'] );
                $szFirstName = $aNameParts['firstname'];
                $szLastName  = $aNameParts['lastname'];
                $szFullName  = $aNameParts['fullname'];
            }   /* if ( preg_match('/\((?P<name>.+)\)/i',$szCreator,$aPart ) ) */
        }
        else
        {
            // Quelques exemples de noms mentionnés dans des RSS réels
            // Mathilde Sallé de Chou
            // Chris Steffen
            // AllMusic Staff
            //
            // Ces quelques cas prouvent que la routine n'est pas encore au point

            $aNameParts  = $this->chopName( $szStr );
            $szFirstName = $aNameParts['firstname'];
            $szLastName  = $aNameParts['lastname'];
            $szFullName  = $aNameParts['fullname'];
        }

        return ( array( 'firstname' => $szFirstName ,
                        'lastname'  => $szLastName  ,
                        'fullname'  => $szFullName  ,
                        'email'     => $szEmail
                      )
               );
    }

    public function populate( $oXPath,$oNode,$szType = 'rss2' )
    /*-------------------------------------------------------*/
    {
        switch( $szType )
        {
            case 'atom' :
                {
                    // If we are using Atom, then there is a registered namespace called "a"
                    // We use this namespace in all subsequent calls
                    $this->name             =            $this->subTag( $oXPath,$oNode,'a:title'          );
                    $this->url              =            $this->subTag( $oXPath,$oNode,'a:link'           );
                    $this->description      =            $this->subTag( $oXPath,$oNode,'a:content'        );
                    $this->summary          =            $this->subTag( $oXPath,$oNode,'a:summary'        );
                    $this->identifier       =            $this->subTag( $oXPath,$oNode,'a:id'             );
                    $this->datePublication  = strtotime( $this->subTag( $oXPath,$oNode,'a:published'      ) );
                    $this->dateModified     = strtotime( $this->subTag( $oXPath,$oNode,'a:updated'        ) );


                    // Lire specification ... https://tools.ietf.org/html/rfc4287
                    if ( ! empty( $szCategory = $this->subTag( $oXPath,$oNode,'a:category' ) ) )
                        $this->aCategories[] = $szCategory;
                    else
                        $this->aCategories[] = 'unknown';

                    if ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'a:author/a:name' ) ) )
                    {
                        // Dans le cas de Atom, on peut avoir qqch comme:
                        // <author>
                        //     <name>Dr. Sougueh Cheik, PhD, Docteur en sciences de l’environnement (écologie des sols), iEES-Sorbonne Université UPMC PARIS VI, Institut de recherche pour le développement (IRD)</name>
                        //     <foaf:homepage rdf:resource="https://theconversation.com/profiles/dr-sougueh-cheik-phd-1005537"/>
                        // </author>

                        //var_dump( "AUTHOR: {$szCreator}" );
                    }
                    //var_dump( $this );
                    //echo __LINE__," of ",__METHOD__," ... on va mourir : {$szType}\n";
                    //die();
                }   /* Case atom */
                break;
            case 'rss2' :
                {
                    $this->name             =            $this->subTag( $oXPath,$oNode,'title'          );
                    $this->url              =            $this->subTag( $oXPath,$oNode,'link'           );
                    $this->description      =            $this->subTag( $oXPath,$oNode,'description'    );
                    $this->summary          =            $this->subTag( $oXPath,$oNode,'summary'        );
                    $this->source           =            $this->subTag( $oXPath,$oNode,'source'         );
                    $this->identifier       =            $this->subTag( $oXPath,$oNode,'guid'           );
                    $this->datePublication  = strtotime( $this->subTag( $oXPath,$oNode,'pubDate'        ) );

                    if ( ! is_null( $szBody = $this->subTag( $oXPath,$oNode,'body' ) ) )
                    {
                        //var_dump( $szBody );
                        $this->description  = $szBody . $this->description;
                        //var_dump( $this->description );
                        //die( "DIE in " . __METHOD__ . "() at line " . __LINE__ );
                    }

                    // Je ne suis pas parvenu à obtenir la date de publication. Je vais essayer avec Dublin Core
                    if ( is_bool( $this->datePublication ) && ! $this->datePublication )
                    {
                        $this->datePublication  = strtotime( $this->subTag( $oXPath,$oNode,'dc:date' ) );
                    }

                    if ( ! empty( $szComments = $this->subTag( $oXPath,$oNode,'comments' ) ) )
                    {
                        $this->comment          = new Comment();                /* Create a comment */
                        $this->comment->text    = $szComments;                  /* Comment's content expressed in the $text property */

                        //var_dump( $this );
                        //die();

                    }   /* if ( ! empty( $szComments = $this->subTag( $oXPath,$oNode,'coments' ) ) ) */

                    /* Voilà un ensemble de valeurs que je ne lis pas encore (voir aussi https://validator.w3.org/feed/docs/rss2.html)
                       ===============================================================================================================

                        <content:encoded><![CDATA[<p>You’ve probably played a 15 puzzle. ... et blablabla ]]></content:encoded>
                        <wfw:commentRss>https://www.quantamagazine.org/mathematicians-calculate-how-randomness-creeps-in-20191112/feed/</wfw:commentRss>
                        <slash:comments>0</slash:comments>
                        <media:content url="https://d2r55xnwy6nx47.cloudfront.net/uploads/2019/11/15PuzzleProblem_520x292.jpg" type="image/jpg"></media:content>
                        <media:content url="https://positivr.fr/wp-content/uploads/2019/11/haute-savoie-achat-foret-pour-interdire-chasse-une-560x293.jpg" type="image/jpeg" />
                        <image> ....... SUR LE CHANNEL (Specifies a GIF, JPEG or PNG image that can be displayed with the channel)
                            <url>
                                http://cdn-s3.allmusic.com/cms/14554/blog_federale__large.jpg
                            </url>
                            <width>640</width>
                            <height>360</height>
                        </image>
                        <dc:date>2019-11-05T16:25+00:00</dc:date>
                        <dc:creator>Chris Steffen</dc:creator>
                        <dc:subject>Stream & Download, AllMusic Streams</dc:subject>          POURRAIT ETRE UNE FORME DE CATEGORIE ?
                        <enclosure url="https://www.sciencesetavenir.fr/assets/img/2019/11/12/cover-r4x3w1000-5dca97a4516d5-5g.jpg" type="image/jpeg" length="132352"/> (Describes a media object that is attached to the item -- It has three required attributes. url says where the enclosure is located, length says how big it is in bytes, and type says what its type is, a standard MIME type.)
                        <copyright>  ......... SUR LE CHANNEL!!!
                            <![CDATA[ Copyright 2019, Sciences et Avenir ]]>
                        </copyright>
                        <lastBuildDate>Wed, 13 Nov 2019 10:24:00 +0100</lastBuildDate> ........ SUR LE CHANNEL
                        managingEditor    Email address for person responsible for editorial content.    geo@herald.com (George Matesky) ........ SUR LE CHANNEL
                        webMaster    Email address for person responsible for technical issues relating to channel.                  ........ SUR LE CHANNEL
                    */


                    if ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'category' ) ) )
                    {
                        foreach ( $categoriesList as $oCatNode )
                        {
                            $this->aCategories[] = $oCatNode->nodeValue;
                        }
                    }   /* if ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'category' ) ) ) */
                    elseif ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'dc:subject' ) ) )
                    {
                        foreach ( $categoriesList as $oCatNode )
                        {
                            $this->aCategories[] = $oCatNode->nodeValue;
                        }
                    }   /* if ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'category' ) ) ) */
                    else
                    {
                        //var_dump( "Pas de catégorie");
                        $this->aCategories[] = 'unknown';
                    }

                    //var_dump( $this->aCategories );
                    //die();

                    if ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'dc:creator' ) ) )
                    {
                        /*  Spec of RSS say that the author should be mentioned as an email address!
                            (e.g. <author>ben@benhammersley.com (Ben Hammersley)</author>)

                            Spec of Dublin Core for creator are available @
                            https://www.dublincore.org/specifications/dublin-core/usageguide/elements/#4-8-creator
                        */

                    }   /* if ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'dc:creator' ) ) ) */
                    elseif ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'author' ) ) )
                    {

                    }

                    $aNameParts                 = $this->chopAuthor( $szCreator );

                    $this->author->givenName    = $aNameParts['firstname'];
                    $this->author->familyName   = $aNameParts['lastname'];
                    $this->author->name         = $aNameParts['fullname'];
                }   /* Case rss2 */
        }   /* switch( $szType ) */

    }   /* End of RSSItem.populate() ================================================ */

    public function categories()
    /*------------------------*/
    {
        $szRetVal = '';

        if ( $this->STR_iPos( "salut",'musicgroup' ) != -1 )
        {

        }


        if ( is_array( $this->aCategories ) && count( $this->aCategories ) > 0 )
        {
            foreach( $this->aCategories as $szCategory )
            {
                $szRetVal .= mb_strtolower ( trim( $szCategory ) ) . ',';
            }   /* foreach( $this->aCategories as $szCategory ) */
        }   /* if ( is_array( $this->aCategories ) && count( $this->aCategories ) > 0 ) */

        return ( substr( $szRetVal,0,-1 ) );                        /* Return all categories of the item but the terminating ',' */
    }   /* End of RSSItem.categories() ============================================== */

}   /* End of class RSSItem ========================================================= */
/* ================================================================================== */


class Invoice extends Intangible
/*----------------------------*/
{
    public  $accountId                  = null;                     /* {*property   $accountId                  (Text)                                      The identifier for the account the payment will be applied to. *} */
    public  $billingPeriod              = null;                     /* {*property   $billingPeriod              (Duration)                                  The time interval used to compute the invoice. *} */
    public  $broker                     = null;                     /* {*property   $broker                     (Organization|Person)                       An entity that arranges for an exchange between a buyer and a
                                                                                                                                                            seller. In most cases a broker never acquires or releases ownership
                                                                                                                                                            of a product or service involved in an exchange. If it is not clear
                                                                                                                                                            whether an entity is a broker, seller, or buyer, the latter two
                                                                                                                                                            terms are preferred. Supersedes bookingAgent. *} */
    public  $category                   = null;                     /* {*property   $category                   (PhysicalActivityCategory|string|Thing)     A category for the item. Greater signs or slashes can be used to
                                                                                                                                                            informally indicate a category hierarchy. *} */
    public  $confirmationNumber         = null;                     /* {*property   $confirmationNumber         (Text)                                      A number that confirms the given order or payment has been received. *} */
    public  $customer                   = null;                     /* {*property   $customer                   (Organization|Person)                       Party placing the order or paying the invoice. *} */
    public  $minimumPaymentDue          = null;                     /* {*property   $minimumPaymentDue          (MonetaryAmount|PriceSpecification)         The minimum payment required at this time. *} */
    public  $paymentDueDate             = null;                     /* {*property   $paymentDueDate             (Date|DateTime)                             The date that payment is due. Supersedes paymentDue. *} */
    public  $paymentMethod              = null;                     /* {*property   $paymentMethod              (PaymentMethod)                             The name of the credit card or other method of payment for the order. *} */
    public  $paymentMethodId            = null;                     /* {*property   $paymentMethodId            (Text)                                      An identifier for the method of payment used (e.g. the
                                                                                                                                                            last 4 digits of the credit card). *} */
    public  $paymentStatus              = null;                     /* {*property   $paymentStatus              (PaymentStatusType|Text)                    The status of payment; whether the invoice has been paid or not. *} */
    public  $provider                   = null;                     /* {*property   $provider                   (Organization|Person)                       The service provider, service operator, or service performer;
                                                                                                                                                            the goods producer. Another party (a seller) may offer those services
                                                                                                                                                            or goods on behalf of the provider. A provider may also serve as
                                                                                                                                                            the seller. Supersedes carrier. *} */
    public  $referencesOrder            = null;                     /* {*property   $referencesOrder            (Order)                                     The Order(s) related to this Invoice. One or more Orders may be
                                                                                                                                                            combined into a single Invoice. *} */
    public  $scheduledPaymentDate       = null;                     /* {*property   $scheduledPaymentDate       (Date)                                      The date the invoice is scheduled to be paid. *} */
    public  $totalPaymentDue            = null;                     /* {*property   $totalPaymentDue            (MonetaryAmount|PriceSpecification)         The total amount due. *} */

}   /* End of class Invoice ========================================================= */
/* ================================================================================== */


class Order extends Intangible
/*----------------------------*/
{
    public  $acceptedOffer              = null;                     /* {*property   $acceptedOffer              (Offer)                                     The offer(s) -- e.g., product, quantity and price combinations --
                                                                                                                                                            included in the order. *} */
    public  $billingAddress             = null;                     /* {*property   $billingAddress             (PostalAddress)                             The billing address for the order. *} */
    public  $broker                     = null;                     /* {*property   $broker                     (Organization|Person)                       An entity that arranges for an exchange between a buyer and a seller.
                                                                                                                                                            In most cases a broker never acquires or releases ownership of a product
                                                                                                                                                            or service involved in an exchange. If it is not clear whether an entity
                                                                                                                                                            is a broker, seller, or buyer, the latter two terms are preferred.
                                                                                                                                                            Supersedes bookingAgent. *} */
    public  $confirmationNumber         = null;                     /* {*property   $confirmationNumber         (string)                                    A number that confirms the given order or payment has been received. *} */
    public  $customer                   = null;                     /* {*property   $customer                   (Organization|Person)                       Party placing the order or paying the invoice. *} */
    public  $discount                   = null;                     /* {*property   $discount                   (Number|string)                             Any discount applied (to an Order). *} */
    public  $discountCode               = null;                     /* {*property   $discountCode               (string)                                    Code used to redeem a discount. *} */
    public  $discountCurrency           = null;                     /* {*property   $discountCurrency           (string)                                    The currency of the discount.

                                                                                                                                                            Use standard formats: ISO 4217 currency format e.g. "USD";
                                                                                                                                                            Ticker symbol for cryptocurrencies e.g. "BTC";
                                                                                                                                                            well known names for Local Exchange Tradings Systems (LETS)
                                                                                                                                                            and other currency types e.g. "Ithaca HOUR". *} */

    public  $isGift                     = null;                     /* {*property   $isGift                     (Boolean)                                   Was the offer accepted as a gift for someone other than the buyer. *} */
    public  $orderDate                  = null;                     /* {*property   $orderDate                  (Date|DateTime)                             Date order was placed. *} */
    public  $orderDelivery              = null;                     /* {*property   $orderDelivery              (ParcelDelivery)                            The delivery of the parcel related to this order or order item. *} */
    public  $orderNumber                = null;                     /* {*property   $orderNumber                (Text)                                      The identifier of the transaction. *} */
    public  $orderStatus                = null;                     /* {*property   $orderStatus                (OrderStatus)                               The current status of the order. *} */
    public  $orderedItem                = null;                     /* {*property   $orderedItem                (OrderItem|Product|Service)                 The item ordered. *} */
    public  $partOfInvoice              = null;                     /* {*property   $partOfInvoice              (Invoice)                                   The order is being paid as part of the referenced Invoice. *} */
    public  $paymentDueDate             = null;                     /* {*property   $paymentDueDate             (Date|DateTime)                             The date that payment is due. Supersedes paymentDue. *} */
    public  $paymentMethod              = null;                     /* {*property   $paymentMethod              (PaymentMethod)                             The name of the credit card or other method of payment for the order. *} */
    public  $paymentMethodId            = null;                     /* {*property   $paymentMethodId            (Text)                                      An identifier for the method of payment used (e.g. the last 4
                                                                                                                                                            digits of the credit card). *} */
    public  $paymentUrl                 = null;                     /* {*property   $paymentUrl                 (URL)                                       The URL for sending a payment. *} */
    public  $seller                     = null;                     /* {*property   $seller                     (Organization|Person)                       An entity which offers (sells / leases / lends / loans) the
                                                                                                                                                            services / goods. A seller may also be a provider. Supersedes
                                                                                                                                                            merchant, vendor. *} */

}   /* End of class Order =========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Quantity=

    {*desc
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Quantity[/url] *}

    *}}
 */
/* ================================================================================== */
class Quantity extends Intangible
/*-----------------------------*/
{
    // Il n'y a rien à mettre ici: pas de propriété additionnelle par rapport à Intangible
}   /* End of class Quantity ======================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Duration=

    {*desc

        Quantity: Duration (use ISO 8601 duration format)

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Duration[/url]
          [url]https://en.Wikipedia.org/wiki/ISO_8601[/url]
    *}

    *}}
 */
/* ================================================================================== */
class Duration extends Quantity
/*----------------------------*/
{
    // Il n'y a rien à mettre ici: pas de propriété additionnelle par rapport à Quantity
}   /* End of class Duration ======================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Enumeration=

    {*desc

        Lists or enumerations—for example, a list of cuisines or music genres, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Enumeration[/url] *}

    *}}
 */
/* ================================================================================== */
class Enumeration extends Intangible
/*---------------------------------*/
{
}   /* End of class Enumeration ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Specialty=

    {*desc

        Any branch of a field in which people typically develop specific
        expertise, usually after significant study, time, and effort.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*remark

        This class is a sort of alias of Enumeration: there is NO additional
        property so far.

    *}

    {*doc [url]https://schema.org/Specialty[/url] *}

    *}}
 */
/* ================================================================================== */
class Specialty extends Enumeration
/*-------------------------------*/
{
}   /* End of class Specialty ======================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class GenderType=

    {*desc

        An enumeration of genders.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/GenderType[/url] *}

    *}}
 */
/* ================================================================================== */
class GenderType extends Enumeration
/*---------------------------------*/
{
    const enum = array( 'Female','Male','Unknown' );

}   /* End of class GenderType ====================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class PaymentMethod=

    {*desc

        A payment method is a standardized procedure for transferring the
        monetary amount for a purchase. Payment methods are characterized by the
        legal and technical structures used, and by the organization or group
        carrying out the transaction.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/PaymentMethod[/url] *}

    *}}
 */
/* ================================================================================== */
class PaymentMethod extends Enumeration
/*-----------------------------------*/
{
    /* All methods can be prefixed by http://purl.org/goodrelations/v1#
       Example: Paypal -> http://purl.org/goodrelations/v1#PayPal */
    const enum = array( 'ByBankTransferInAdvance'   ,
                        'ByInvoice'                 ,
                        'Cash'                      ,
                        'CheckInAdvance'            ,
                        'COD'                       ,
                        'DirectDebit'               ,
                        'GoogleCheckout'            ,
                        'PayPal'                    ,
                        'PaySwarm' );

}   /* End of class PaymentMethod =================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class ItemAvailability=

    {*desc

        A list of possible product availability options.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/ItemAvailability[/url] *}

    *}}
 */
/* ================================================================================== */
class ItemAvailability extends Enumeration
/*---------------------------------*/
{
    const enum = array( 'Discontinued'          ,
                        'InStock'               ,
                        'InStoreOnly'           ,
                        'LimitedAvailability'   ,
                        'OnlineOnly'            ,
                        'OutOfStock'            ,
                        'PreOrder'              ,
                        'PreSale'               ,
                        'SoldOut' );

    public $szValue = null;
}   /* End of class ItemAvailability ================================================ */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class PaymentCard=

    {*desc

        A payment method using a credit, debit, store or other card to associate
        the payment with an account.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/PaymentCard[/url] *}

    *}}
 */
/* ================================================================================== */
class PaymentCard extends PaymentMethod
/*-----------------------------------*/
{
    public  $cashBack                   = null;                     /* {*property   $cashBack                   (Boolean|Number)                            A cardholder benefit that pays the cardholder a small percentage
                                                                                                                                                            of their net expenditures. *} */
    public  $contactlessPayment         = null;                     /* {*property   $contactlessPayment         (Boolean)                                   A secure method for consumers to purchase products or services
                                                                                                                                                            via debit, credit or smartcards by using RFID or NFC technology. *} */
    public  $floorLimit                 = null;                     /* {*property   $floorLimit                 (MonetaryAmount)                            A floor limit is the amount of money above which credit card
                                                                                                                                                            transactions must be authorized. *} */

}   /* End of class PaymentCard ===================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MusicAlbumProductionType=

    {*desc

        Classification of the album by its type of content: soundtrack, live album,
        studio album, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*remark    The work of schema.org, for music related vocabularies and
                ontologies, is also based on a collaboration with MusicBrainz
                (https://musicbrainz.org) and The Music Ontology (http://musicontology.com/)
    *}

    {*doc [url]https://schema.org/MusicAlbumProductionType[/url] *}

    *}}
 */
/* ================================================================================== */
class MusicAlbumProductionType extends Enumeration
/*----------------------------------------------*/
{
    const enum = array( 'CompilationAlbum', 'DJMixAlbum', 'DemoAlbum',
                        'LiveAlbum', 'MixtapeAlbum', 'RemixAlbum',
                        'SoundtrackAlbum', 'SpokenWordAlbum', 'StudioAlbum' );

}   /* End of class MusicAlbumProductionType ======================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MusicAlbumReleaseType=

    {*desc

        The kind of release which this album is: single, EP or album.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*remark    The work of schema.org, for music related vocabularies and
                ontologies, is also based on a collaboration with MusicBrainz
                (https://musicbrainz.org) and The Music Ontology (http://musicontology.com/)
    *}

    {*doc [url]https://schema.org/MusicAlbumReleaseType[/url] *}

    *}}
 */
/* ================================================================================== */
class MusicAlbumReleaseType extends Enumeration
/*-------------------------------------------*/
{
    const enum = array( 'AlbumRelease', 'BroadcastRelease', 'EPRelease','SingleRelease' );

}   /* End of class MusicAlbumReleaseType =========================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class MusicReleaseFormatType=

    {*desc

        Format of this release (the type of recording media used, ie. compact
        disc, digital media, LP, etc.).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*remark    The work of schema.org, for music related vocabularies and
                ontologies, is also based on a collaboration with MusicBrainz
                (https://musicbrainz.org) and The Music Ontology (http://musicontology.com/)
    *}

    {*doc [url]https://schema.org/MusicReleaseFormatType[/url] *}

    *}}
 */
/* ================================================================================== */
class MusicReleaseFormatType extends Enumeration
/*--------------------------------------------*/
{
    const enum = array( 'CDFormat', 'CassetteFormat', 'DVDFormat',
                                'DigitalAudioTapeFormat', 'DigitalFormat',
                                'LaserDiscFormat', 'VinylFormat' );

}   /* End of class MusicReleaseFormatType ========================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class ItemList=

    {*desc
        A list of items of any sort—for example, Top 10 Movies About Weathermen,
        or Top 100 Party Songs. Not to be confused with HTML lists, which are
        often used only for formatting.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/ItemList[/url] *}

    *}}
 */
/* ================================================================================== */
class ItemList extends Intangible
/*-----------------------------*/
{
    public $numberOfItems               = null;                     /* {*property   $numberOfItems              (int)                                       The number of items ICI CONTINUER *} */

    /* ------------ Property added by TRQL Labs (not originally found in schema.org) */
    public $items                       = array();                  /* {*property   $items                      (array)                                     Items contained in the list *} */

    public function add( $x )
    /*---------------------*/
    {
        $this->items[] = $x;
    }
}   /* End of class ItemList ======================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class StructuredValue=

    {*desc

        Structured values are used when the value of a property has a more
        complex structure than simply being a textual value or a reference to
        another thing.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/StructuredValue[/url] *}

    *}}
 */
/* ================================================================================== */
class StructuredValue extends Intangible
/*------------------------------------*/
{
    /* No additional property compared to Thing */
}   /* End of class StructuredValue ================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class PropertyValue=

    {*desc

        A property-value pair, e.g. representing a feature of a product or
        place. Use the 'name' property for the name of the property. If there is
        an additional human-readable version of the value, put that into the
        'description' property.

        Always use specific schema.org properties when a) they exist and b) you
        can populate them. Using PropertyValue as a substitute will typically
        not trigger the same effect as using the original, specific property.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/PropertyValue[/url] *}

    *}}
 */
/* ================================================================================== */
class PropertyValue extends StructuredValue
/*---------------------------------------*/
{
    public  $maxValue                   = null;                     /* {*property   $maxValue                   (number)                                    The upper value of some characteristic or property. *} */

    public  $measurementTechnique       = null;                     /* {*property   $measurementTechnique       (string|URL)                                A technique or technology used in a Dataset (or DataDownload,
                                                                                                                                                            DataCatalog), corresponding to the method used for measuring
                                                                                                                                                            the corresponding variable(s) (described using variableMeasured).
                                                                                                                                                            This is oriented towards scientific and scholarly dataset
                                                                                                                                                            publication but may have broader applicability; it is not
                                                                                                                                                            intended as a full representation of measurement, but rather as
                                                                                                                                                            a high level summary for dataset discovery.

                                                                                                                                                            For example, if variableMeasured is: molecule concentration,
                                                                                                                                                            measurementTechnique could be: "mass spectrometry" or
                                                                                                                                                            "nmr spectroscopy" or "colorimetry" or "immunofluorescence".

                                                                                                                                                            If the variableMeasured is "depression rating", the
                                                                                                                                                            measurementTechnique could be "Zung Scale" or "HAM-D" or
                                                                                                                                                            "Beck Depression Inventory".

                                                                                                                                                            If there are several variableMeasured properties recorded for
                                                                                                                                                            some given data object, use a PropertyValue for each
                                                                                                                                                            variableMeasured and attach the corresponding
                                                                                                                                                            measurementTechnique. *} */

    public  $minValue                   = null;                     /* {*property   $maxValue                   (number)                                    The lower value of some characteristic or property. *} */

    public  $propertyID                 = null;                     /* {*property   $propertyID                 (string|URL)                                A commonly used identifier for the characteristic represented by
                                                                                                                                                            the property, e.g. a manufacturer or a standard code for a property.
                                                                                                                                                            $propertyID can be (1) a prefixed string, mainly meant to be used
                                                                                                                                                            with standards for product properties; (2) a site-specific,
                                                                                                                                                            non-prefixed string (e.g. the primary key of the property or the
                                                                                                                                                            vendor-specific id of the property), or (3) a URL indicating the
                                                                                                                                                            type of the property, either pointing to an external vocabulary, or
                                                                                                                                                            a Web resource that describes the property (e.g. a glossary entry).
                                                                                                                                                            Standards bodies should promote a standard prefix for the
                                                                                                                                                            identifiers of properties from their standards. *} */

    public  $unitCode                   = null;                     /* {*property   $unitCode                   (string|URL)                                The unit of measurement given using the UN/CEFACT Common Code
                                                                                                                                                            (3 characters) or a URL. Other codes than the UN/CEFACT Common Code
                                                                                                                                                            may be used with a prefix followed by a colon. *} */
    public  $unitText                   = null;                     /* {*property   $unitText                   (string)                                    A string or text indicating the unit of measurement. Useful if you
                                                                                                                                                            cannot provide a standard unit code for unitCode. *} */

    public  $value                      = null;                     /* {*property   $value                      (boolean|number|StructuredValue|string)     The value of the quantitative value or property value node.

                                                                                                                                                            For QuantitativeValue and MonetaryAmount, the recommended type for
                                                                                                                                                            values is 'Number'.

                                                                                                                                                            For PropertyValue, it can be 'Text;', 'Number', 'Boolean', or
                                                                                                                                                            'StructuredValue'.

                                                                                                                                                            Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to
                                                                                                                                                            'DIGIT NINE' (U+0039)) rather than superficially similiar Unicode
                                                                                                                                                            symbols.

                                                                                                                                                            Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate
                                                                                                                                                            a decimal point. Avoid using these symbols as a readability separator. *} */

    public  $valueReference             = null;                     /* {*property   $valueReference             (Enumeration|PropertyValue|QualitativeValue|QuantitativeValue|StructuredValue)  A pointer to a secondary value
                                                                                                                                                            that provides additional information on the original value, e.g.
                                                                                                                                                            a reference temperature. *} */

}   /* End of class PropertyValue =================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Project=

    {*desc

        ??????????????

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/????[/url] *}

    *}}
 */
/* ================================================================================== */
class Project extends Organization
/*------------------------------*/
{
}   /* End of class Project ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class ContactPoint=

    {*desc

        A contact point—for example, a Customer Complaints department.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/ContactPoint[/url] *}

    *}}
 */
/* ================================================================================== */
class ContactPoint extends StructuredValue
/*--------------------------------------*/
{
}   /* End of class ContactPoint ==================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Place=

    {*desc

        Entities that have a somewhat fixed, physical extension.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Place[/url] *}

    *}}
 */
/* ================================================================================== */
class Place extends Thing
/*---------------------*/
{
    public $additionalProperty                  = null;                     /* {*property   $additionalProperty                 (PropertyValue)                             A property-value pair representing an additional characteristics of the entitity,
                                                                                                                                                                            e.g. a product feature or another characteristic for which there is no matching
                                                                                                                                                                            property in schema.org.

                                                                                                                                                                            Note: Publishers should be aware that applications designed to use specific
                                                                                                                                                                            schema.org properties (e.g. http://schema.org/width, http://schema.org/color,
                                                                                                                                                                            http://schema.org/gtin13, ...) will typically expect such data to be provided
                                                                                                                                                                            using those properties, rather than using the generic property/value mechanism.  *} */

    public $address                             = null;                     /* {*property   $address                            (PostalAddress|string)                      Physical address of the item. *} */
    public $aggregateRating                     = null;                     /* {*property   $aggregateRating                    (AggregateRating)                           The overall rating, based on a collection of reviews or ratings, of the item. *} */
    public $amenityFeature                      = null;                     /* {*property   $amenityFeature                     (LocationFeatureSpecification)              An amenity feature (e.g. a characteristic or service) of the Accommodation.
                                                                                                                                                                            This generic property does not make a statement about whether the feature is
                                                                                                                                                                            included in an offer for the main accommodation or available at extra costs.  *} */
    public $branchCode                          = null;                     /* {*property   $branchCode                         (string)                                    A short textual code (also called "store code") that uniquely identifies a place of
                                                                                                                                                                            business. The code is typically assigned by the parentOrganization and used in
                                                                                                                                                                            structured URLs.

                                                                                                                                                                            For example, in the URL http://www.starbucks.co.uk/store-locator/etc/detail/3047
                                                                                                                                                                            the code "3047" is a branchCode for a particular branch. *} */

    public $containedInPlace                    = null;                     /* {*property   $containedInPlace                   (Place)                                     The basic containment relation between a place and one that contains it.
                                                                                                                                                                            Supersedes containedIn. Inverse property: containsPlace. *} */
    public $containsPlace                       = null;                     /* {*property   $containsPlace                      (Place)                                     The basic containment relation between a place and another that it contains.
                                                                                                                                                                            Inverse property: containedInPlace. *} */
    public $event                               = null;                     /* {*property   $event                              (Event)                                     Upcoming or past event associated with this place, organization, or action.
                                                                                                                                                                            Supersedes events. *} */
    public $faxNumber                           = null;                     /* {*property   $faxNumber                          (string)                                    The fax number. *} */
    public $geo                                 = null;                     /* {*property   $geo                                (GeoCoordinates|GeoShape)                   The geo coordinates of the place. *} */
    public $geoContains                         = null;                     /* {*property   $geoContains                        (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent),
                                                                                                                                                                            relating a containing geometry to a contained geometry. "a contains b iff no points of b
                                                                                                                                                                            lie in the exterior of a, and at least one point of the interior of b lies in the
                                                                                                                                                                            interior of a". As defined in DE-9IM. *} */
    public $geoCoveredBy                        = null;                     /* {*property   $geoCoveredBy                       (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent),
                                                                                                                                                                            relating a geometry to another that covers it. As defined in DE-9IM. *} */
    public $geoCovers                           = null;                     /* {*property   $geoCovers                          (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent),
                                                                                                                                                                            relating a covering geometry to a covered geometry. "Every point of b is a point of
                                                                                                                                                                            (the interior or boundary of) a". As defined in DE-9IM. *} */
    public $geoCrosses                          = null;                     /* {*property   $geoCrosses                         (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent),
                                                                                                                                                                            relating a geometry to another that crosses it: "a crosses b: they have some but not
                                                                                                                                                                            all interior points in common, and the dimension of the intersection is less than that
                                                                                                                                                                            of at least one of them". As defined in DE-9IM. *} */
    public $geoDisjoint                         = null;                     /* {*property   $geoDisjoint                        (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent)
                                                                                                                                                                            are topologically disjoint: they have no point in common. They form a set of disconnected
                                                                                                                                                                            geometries." (a symmetric relationship, as defined in DE-9IM) *} */
    public $geoEquals                           = null;                     /* {*property   $geoEquals                          (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent)
                                                                                                                                                                            are topologically equal, as defined in DE-9IM. "Two geometries are topologically equal
                                                                                                                                                                            if their interiors intersect and no part of the interior or boundary of one geometry
                                                                                                                                                                            intersects the exterior of the other" (a symmetric relationship) *} */
    public $geoIntersects                       = null;                     /* {*property   $geoIntersects                      (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent) have
                                                                                                                                                                            at least one point in common. As defined in DE-9IM. *} */
    public $geoOverlaps                         = null;                     /* {*property   $geoOverlaps                        (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), relating
                                                                                                                                                                            a geometry to another that geospatially overlaps it, i.e. they have some but not all points
                                                                                                                                                                            in common. As defined in DE-9IM. *} */
    public $geoTouches                          = null;                     /* {*property   $geoTouches                         (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent) touch:
                                                                                                                                                                            they have at least one boundary point in common, but no interior points." (a symmetric
                                                                                                                                                                            relationship, as defined in DE-9IM ) *} */
    public $geoWithin                           = null;                     /* {*property   $geoWithin                          (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), relating a
                                                                                                                                                                            geometry to one that contains it, i.e. it is inside (i.e. within) its interior.
                                                                                                                                                                            As defined in DE-9IM. *} */
    public $globalLocationNumber                = null;                     /* {*property   $globalLocationNumber               (string)                                    The Global Location Number (GLN, sometimes also referred to as International Location Number or
                                                                                                                                                                            ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify
                                                                                                                                                                            parties and physical locations. *} */
    public $hasDriveThroughService              = null;                     /* {*property   $hasDriveThroughService             (Boolean)                                   Indicates whether some facility (e.g. FoodEstablishment, CovidTestingFacility) offers a service that
                                                                                                                                                                            can be used by driving through in a car. In the case of CovidTestingFacility such facilities could
                                                                                                                                                                            potentially help with social distancing from other potentially-infected users. *} */
    public $hasMap                              = null;                     /* {*property   $hasMap                             (Map|URL)                                   A URL to a map of the place. Supersedes map, maps. *} */
    public $isAccessibleForFree                 = null;                     /* {*property   $isAccessibleForFree                (Boolean)                                   A flag to signal that the item, event, or place is accessible for free. Supersedes free. *} */
    public $isicV4                              = null;                     /* {*property   $isicV4                             (string)                                    The International Standard of Industrial Classification of All Economic Activities (ISIC), Revision
                                                                                                                                                                            4 code for a particular organization, business person, or place. *} */
    public $latitude                            = null;                     /* {*property   $latitude                           (Number|string)                             The latitude of a location. For example 37.42242 (WGS 84). *} */
    public $logo                                = null;                     /* {*property   $logo                               (ImageObject|URL)                           An associated logo. *} */
    public $longitude                           = null;                     /* {*property   $longitude                          (Number|string)                             The longitude of a location. For example -122.08585 (WGS 84). *} */
    public $maximumAttendeeCapacity             = null;                     /* {*property   $maximumAttendeeCapacity            (Integer)                                   The total number of individuals that may attend an event or venue. *} */
    public $openingHoursSpecification           = null;                     /* {*property   $openingHoursSpecification          (OpeningHoursSpecification)                 The opening hours of a certain place. *} */
    public $photo                               = null;                     /* {*property   $photo                              (ImageObject|Photograph)                    A photograph of this place. Supersedes photos. *} */
    public $publicAccess                        = null;                     /* {*property   $publicAccess                       (Boolean)                                   A flag to signal that the Place is open to public visitors. If this property is omitted there is no
                                                                                                                                                                            assumed default boolean value *} */
    public $review                              = null;                     /* {*property   $review                             (Review)                                    A review of the item. Supersedes reviews. *} */
    public $slogan                              = null;                     /* {*property   $slogan                             (string)                                    A slogan or motto associated with the item. *} */
    public $smokingAllowed                      = null;                     /* {*property   $smokingAllowed                     (Boolean)                                   Indicates whether it is allowed to smoke in the place, e.g. in the restaurant, hotel or hotel room. *} */
    public $specialOpeningHoursSpecification    = null;                     /* {*property   $specialOpeningHoursSpecification   (OpeningHoursSpecification)                 The special opening hours of a certain place.

                                                                                                                                                                            Use this to explicitly override general opening hours brought in scope by openingHoursSpecification
                                                                                                                                                                            or openingHours. *} */
    public $telephone                           = null;                     /* {*property   $telephone                          (string)                                    The telephone number. *} */
    public $tourBookingPage                     = null;                     /* {*property   $tourBookingPage                    (URL)                                       A page providing information on how to book a tour of some Place, such as an Accommodation or
                                                                                                                                                                            ApartmentComplex in a real estate setting, as well as other kinds of tours as appropriate. *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->geo  = new GeoCoordinates();
    }

}   /* End of class Place =========================================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class AdministrativeArea=

    {*desc

        A geographical region, typically under the jurisdiction of a particular government.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/AdministrativeArea[/url] *}

    *}}
 */
/* ================================================================================== */
class AdministrativeArea extends Place
/*-----------------------------------*/
{
    public $name                        = null;                     /* {*property   $name                       (string)                The name of the item. *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }
}   /* End of class AdministrativeArea ============================================== */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class City=

    {*desc

        A city or town.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/City[/url] *}

    *}}
 */
/* ================================================================================== */
class City extends AdministrativeArea
/*---------------------------------*/
{
    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }
}   /* End of class City ============================================================ */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class Country=

    {*desc

        A country.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Country[/url] *}

    *}}
 */
/* ================================================================================== */
class Country extends AdministrativeArea
/*------------------------------------*/
{
    public $name                        = null;                     /* {*property   $name                       (string)                The name of the item. *} */

    /* Properties NOT found in Schema.org */


    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }


}   /* End of class Country ========================================================= */
/* ================================================================================== */


/* ================================================================================== */
/** {{*class GeoCoordinates=

    {*desc

        The geographic coordinates of a place or event.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/GeoCoordinates[/url] *}

    *}}
 */
/* ================================================================================== */
class GeoCoordinates extends StructuredValue
/*----------------------------------------*/
{
    public $address                     = null;                     /* {*property   $address                    (PostalAddress|string)                      Physical address of the item. *} */
    public $addressCountry              = null;                     /* {*property   $addressCountry             (Country|string)                            The country. For example, USA. You can also
                                                                                                                                                            provide the two-letter ISO 3166-1 alpha-2
                                                                                                                                                            country code. *} */
    public $elevation                   = null;                     /* {*property   $elevation                  (Number|string)                             The elevation of a location (WGS 84). Values
                                                                                                                                                            may be of the form 'NUMBER UNITOFMEASUREMENT'
                                                                                                                                                            (e.g., '1,000 m', '3,200 ft') while numbers
                                                                                                                                                            alone should be assumed to be a value in meters. *} */
    public $latitude                    = null;                     /* {*property   $latitude                   (Number|string)                             The latitude of a location. For example
                                                                                                                                                            37.42242 (WGS 84). *} */
    public $longitude                   = null;                     /* {*property   $longitude                  (Number|string)                             The longitude of a location. For example
                                                                                                                                                            -122.08585 (WGS 84). *} */
    public $postalCode                  = null;                     /* {*property   $postalCode                 (string)                                    The postal code. For example, 94043. *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
    }

}   /* End of class GeoCoordinates ================================================== */
/* ================================================================================== */


class Aspiration extends Project
/*----------------------------*/
{
}   /* End of class Aspiration ====================================================== */
/* ================================================================================== */


class Sprint extends Project
/*-------------------------*/
{
    /* Considérons qu'un sprint est un petit projet */
}   /* End of class Project ========================================================= */
/* ================================================================================== */


class Corporation extends Organization
/*----------------------------------*/
{
}   /* End of class Corporation ===================================================== */
/* ================================================================================== */
?>
