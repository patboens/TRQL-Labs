<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.offer.class.php *}
    {*purpose               An offer to transfer some rights to an item or to provide a 
                            service — for example, an offer to sell tickets to an event, 
                            to rent the DVD of a movie, to stream a TV show over the 
                            internet, to repair a motorcycle, or to loan a book. 
                            Note: As the businessFunction property, which identifies 
                            the form of offer (e.g. sell, lease, repair, dispose), 
                            defaults to http://purl.org/goodrelations/v1#Sell; an Offer 
                            without a defined businessFunction value can be assumed to 
                            be an offer to sell.For GTIN-related fields, see Check Digit
                            calculator and validation guide from GS1. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 06:02 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 06:02 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\offer;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'OFFER_CLASS_VERSION' ) or define( 'OFFER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Offer=

    {*desc

        An offer to transfer some rights to an item or to provide a service — for example, 
        an offer to sell tickets to an event, to rent the DVD of a movie, to stream a TV 
        show over the internet, to repair a motorcycle, or to loan a book.Note: As the 
        businessFunction property, which identifies the form of offer (e.g. sell, lease, 
        repair, dispose), defaults to http://purl.org/goodrelations/v1#Sell; an Offer 
        without a defined businessFunction value can be assumed to be an offer to sell. 
        For GTIN-related fields, see Check Digit calculator and validation guide from 
        GS1.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Offer[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
    *}

    *}}
 */
/* ==================================================================================== */
class Offer extends Intangible
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $acceptedPaymentMethod      = null;                 /* {*property   $acceptedPaymentMethod      (LoanOrCredit|PaymentMethod)                    The payment method(s) accepted by seller for this offer. *} */
    public      $addon                      = null;                 /* {*property   $addon                      (Offer)                                         An additional type for the item, typically used for adding more specific types from external vocabularies in microdata syntax. This is a relationship between something and a class that the thing is in. In RDFa syntax, it is better to use the native RDFa syntax - the 'typeof' attribute - for multiple types. Schema.org tools may have only weaker understanding of extra types, in particular those defined externally. *} */
    public      $advanceBookingRequirement  = null;                 /* {*property   $advanceBookingRequirement  (QuantitativeValue )                            The amount of time that is required between accepting the offer
                                                                                                                                                                and the actual usage of the resource or service. *} */
    public      $aggregateRating            = null;                 /* {*property   $aggregateRating            (AggregateRating)                               The overall rating, based on a collection of reviews or ratings, of the item. *} */
    public      $areaServed                 = null;                 /* {*property   $areaServed                 (AdministrativeArea|GeoShape|Place|string)      The geographic area where a service or offered item is provided. *} */
    public      $availability               = null;                 /* {*property   $availability               (ItemAvailability)                              The availability of this item-for example In stock, Out of stock,
                                                                                                                                                                Pre-order, etc. *} */
    public      $availabilityEnds           = null;                 /* {*property   $availabilityEnds           (Date|DateTime|Time)                            The end of the availability of the product or service included
                                                                                                                                                                in the offer. *} */
    public      $availabilityStarts         = null;                 /* {*property   $availabilityStarts         (Date|DateTime|Time)                            The beginning of the availability of the product or service
                                                                                                                                                                included in the offer. *} */
    public      $availableAtOrFrom          = null;                 /* {*property   $availableAtOrFrom          (Place)                                         The place(s) from which the offer can be obtained
                                                                                                                                                                (e.g. store locations). *} */
    public      $availableDeliveryMethod    = null;                 /* {*property   $availableDeliveryMethod    (DeliveryMethod)                                The delivery method(s) available for this offer. *} */
    public      $businessFunction           = null;                 /* {*property   $businessFunction           (BusinessFunction)                              The business function (e.g. sell, lease, repair, dispose) of the
                                                                                                                                                                offer or component of a bundle (TypeAndQuantityNode). The default
                                                                                                                                                                is http://purl.org/goodrelations/v1#Sell. *} */
    public      $category                   = null;                 /* {*property   $deliveryLeadTime           (PhysicalActivityCategory|string|Thing|URL)     A category for the item. Greater signs or slashes can be used to
                                                                                                                                                                informally indicate a category hierarchy. *} */
    public      $deliveryLeadTime           = null;                 /* {*property   $deliveryLeadTime           (QuantitativeValue)                             The typical delay between the receipt of the order and the goods
                                                                                                                                                                either leaving the warehouse or being prepared for pickup, in case
                                                                                                                                                                the delivery method is on site pickup. *} */
    public      $eligibleCustomerType       = null;                 /* {*property   $eligibleCustomerType       (BusinessEntityType)                            The type(s) of customers for which the given offer is valid. *} */
    public      $eligibleDuration           = null;                 /* {*property   $eligibleDuration           (QuantitativeValue)                             The duration for which the given offer is valid. *} */
    public      $eligibleQuantity           = null;                 /* {*property   $eligibleQuantity           (QuantitativeValue)                             The interval and unit of measurement of ordering quantities for which
                                                                                                                                                                the offer or price specification is valid. This allows e.g. specifying
                                                                                                                                                                that a certain freight charge is valid only for a certain quantity. *} */
    public      $eligibleRegion             = null;                 /* {*property   $eligibleRegion             (GeoShape|Place|string)                         The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place,
                                                                                                                                                                or the GeoShape for the geo-political region(s) for which the offer
                                                                                                                                                                or delivery charge specification is valid.See also ineligibleRegion. *} */
    public      $eligibleTransactionVolume  = null;                 /* {*property   $eligibleTransactionVolume  (PriceSpecification)                            The transaction volume, in a monetary unit, for which the offer or
                                                                                                                                                                price specification is valid, e.g. for indicating a minimal purchasing
                                                                                                                                                                volume, to express free shipping above a certain order volume, or to
                                                                                                                                                                limit the acceptance of credit cards to purchases to a certain
                                                                                                                                                                minimal amount. *} */
    public      $gtin                       = null;                 /* {*property   $gtin                       (string)                                        A Global Trade Item Number (GTIN). GTINs identify trade items, including
                                                                                                                                                                products and services, using numeric identification codes. The gtin
                                                                                                                                                                property generalizes the earlier gtin8, gtin12, gtin13, and gtin14
                                                                                                                                                                properties. The GS1 digital link specifications express GTINs as URLs.
                                                                                                                                                                A correct gtin value should be a valid GTIN, which means that it should
                                                                                                                                                                be an all-numeric string of either 8, 12, 13 or 14 digits, or a
                                                                                                                                                                "GS1 Digital Link" URL based on such a string. The numeric component
                                                                                                                                                                should also have a valid GS1 check digit and meet the other rules for
                                                                                                                                                                valid GTINs. See also GS1's GTIN Summary and Wikipedia for more details.
                                                                                                                                                                Left-padding of the gtin values is not required or encouraged. *} */
    public      $gtin12                     = null;                 /* {*property   $gtin12                     (string)                                        The GTIN-12 code of the product, or the product to which the offer refers.
                                                                                                                                                                The GTIN-12 is the 12-digit GS1 Identification Key composed of a U.P.C.
                                                                                                                                                                Company Prefix, Item Reference, and Check Digit used to identify trade
                                                                                                                                                                items. See GS1 GTIN Summary for more details. *} */
    public      $gtin13                     = null;                 /* {*property   $gtin13                     (string)                                        The GTIN-13 code of the product, or the product to which the offer refers.
                                                                                                                                                                This is equivalent to 13-digit ISBN codes and EAN UCC-13. Former
                                                                                                                                                                12-digit UPC codes can be converted into a GTIN-13 code by simply
                                                                                                                                                                adding a preceeding zero. See GS1 GTIN Summary for more details. *} */
    public      $gtin14                     = null;                 /* {*property   $gtin14                     (string)                                        The GTIN-14 code of the product, or the product to which the offer
                                                                                                                                                                refers. See GS1 GTIN Summary for more details. *} */
    public      $gtin8                      = null;                 /* {*property   $gtin8                      (string)                                        The GTIN-8 code of the product, or the product to which the offer
                                                                                                                                                                refers. This code is also known as EAN/UCC-8 or 8-digit EAN. See GS1
                                                                                                                                                                GTIN Summary for more details. *} */
    public      $includesObject             = null;                 /* {*property   $includesObject             (TypeAndQuantityNode)                           This links to a node or nodes indicating the exact quantity of the
                                                                                                                                                                products included in an Offer or ProductCollection. *} */
    public      $ineligibleRegion           = null;                 /* {*property   $ineligibleRegion           (GeoShape|Place|string)                         The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place,
                                                                                                                                                                or the GeoShape for the geo-political region(s) for which the offer
                                                                                                                                                                or delivery charge specification is not valid, e.g. a region where
                                                                                                                                                                the transaction is not allowed.See also eligibleRegion. *} */
    public      $inventoryLevel             = null;                 /* {*property   $inventoryLevel             (QuantitativeValue)                             The current approximate inventory level for the item or items. *} */
    public      $itemCondition              = null;                 /* {*property   $itemCondition              (OfferItemCondition)                            A predefined value from OfferItemCondition or a textual description of
                                                                                                                                                                the condition of the product or service, or the products or services
                                                                                                                                                                included in the offer. *} */
    public      $itemOffered                = null;                 /* {*property   $itemOffered                (AggregateOffer|CreativeWork|Event|MenuItem|Product|Service|Trip)       An item being offered (or demanded). The
                                                                                                                                                                transactional nature of the offer or demand is documented using
                                                                                                                                                                businessFunction, e.g. sell, lease etc. While several common
                                                                                                                                                                expected types are listed explicitly in this definition, others can
                                                                                                                                                                be used. Using a second type, such as Product or a subtype of Product,
                                                                                                                                                                can clarify the nature of the offer. *} */
    public      $leaseLength                = null;                 /* {*property   $leaseLength                (Duration|QuantitativeValue)                    Length of the lease for some Accommodation, either particular to some
                                                                                                                                                                Offer or in some cases intrinsic to the property. *} */
    public      $mpn                        = null;                 /* {*property   $mpn                        (string)                                        The Manufacturer Part Number (MPN) of the product, or the product to
                                                                                                                                                                which the offer refers. *} */
    public      $offeredBy                  = null;                 /* {*property   $offeredBy                  (Organization|Person)                           A pointer to the organization or person making the offer. Inverse
                                                                                                                                                                property: makesOffer. *} */
    public      $price                      = null;                 /* {*property   $price                      (float|string)                                  The offer price of a product, or of a price component when attached 
                                                                                                                                                                to PriceSpecification and its subtypes.[br][br]
                                                                                                                                                                Usage guidelines:[br]
                                                                                                                                                                [ul]
                                                                                                                                                                    [li]Use the priceCurrency property (with standard formats: ISO 
                                                                                                                                                                        4217 currency format e.g. "USD"; Ticker symbol for 
                                                                                                                                                                        cryptocurrencies e.g. "BTC"; well known names for Local 
                                                                                                                                                                        Exchange Tradings Systems (LETS) and other currency types 
                                                                                                                                                                        e.g. "Ithaca HOUR") instead of including ambiguous symbols 
                                                                                                                                                                        such as '$' in the value.[/li]
                                                                                                                                                                    [li]Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to 
                                                                                                                                                                        indicate a decimal point. Avoid using these symbols as a 
                                                                                                                                                                        readability separator.[/li]
                                                                                                                                                                    [li]Note that both RDFa and Microdata syntax allow the use of 
                                                                                                                                                                        a "content=" attribute for publishing simple machine-readable 
                                                                                                                                                                        values alongside more human-friendly formatting.[/li]
                                                                                                                                                                    [li]Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 
                                                                                                                                                                        'DIGIT NINE' (U+0039)) rather than superficially similiar 
                                                                                                                                                                        Unicode symbols.[/li]
                                                                                                                                                                [/ul] *} */
    public      $priceCurrency              = null;                 /* {*property   $priceCurrency              (string)                                        The currency of the price, or a price component when attached to 
                                                                                                                                                                PriceSpecification and its subtypes.[br][br]

                                                                                                                                                                Use standard formats: ISO 4217 currency format e.g. "USD"; Ticker 
                                                                                                                                                                symbol for cryptocurrencies e.g. "BTC"; well known names for Local 
                                                                                                                                                                Exchange Tradings Systems (LETS) and other currency types e.g. 
                                                                                                                                                                "Ithaca HOUR". *} */
    public      $priceSpecification         = null;                 /* {*property   $priceSpecification         (PriceSpecification)                            One or more detailed price specifications, indicating the unit price 
                                                                                                                                                                and delivery or payment charges. *} */
    public      $priceValidUntil            = null;                 /* {*property   $priceValidUntil            (Date)                                          The date after which the price is no longer available. *} */
    public      $review                     = null;                 /* {*property   $review                     (Review)                                        A review of the item. Supersedes reviews. *} */
    public      $seller                     = null;                 /* {*property   $seller                     (Organization|Person)                           An entity which offers (sells / leases / lends / loans) the 
                                                                                                                                                                services/goods. A seller may also be a provider. *} */
    public      $serialNumber               = null;                 /* {*property   $serialNumber               (string)                                        The serial number or any alphanumeric identifier of a particular 
                                                                                                                                                                product. When attached to an offer, it is a shortcut for the 
                                                                                                                                                                serial number of the product included in the offer. *} */
    public      $shippingDetails            = null;                 /* {*property   $shippingDetails            (OfferShippingDetails )                         Indicates information about the shipping policies and options 
                                                                                                                                                                associated with an Offer. *} */
    public      $sku                        = null;                 /* {*property   $sku                        (string)                                        The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier for 
                                                                                                                                                                a product or service, or the product to which the offer refers. *} */
    public      $validFrom                  = null;                 /* {*property   $validFrom                  (Date|DateTime)                                 The date when the item becomes valid. *} */
    public      $validThrough               = null;                 /* {*property   $validThrough               (Date|DateTime)                                 The date after when the item is not valid. For example the end of an 
                                                                                                                                                                offer, salary period, or a period of opening hours. *} */
    public      $warranty                   = null;                 /* {*property   $warranty                   (WarrantyPromise)                               The warranty promise(s) included in the offer. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1193004';       /* {*property   $wikidataId                 (string)                                        Wikidata ID. Offer and acceptance. Two components of agreement *} */


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
    }   /* End of Offer.__construct() ================================================= */
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
    }   /* End of Offer.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Offer ============================================================= */
/* ==================================================================================== */
?>