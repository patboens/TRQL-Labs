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
    {*file                  trql.motorizedbicycle.class.php *}
    {*purpose               A motorized bicycle is a bicycle with an attached motor used
                            to power the vehicle, or to assist with pedaling. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:50 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 09:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\motorizedbicycle;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\vehicle\Vehicle    as Vehicle;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'VEHICLE_CLASS_VERSION' ) )
    require_once( 'trql.vehicle.class.php' );



defined( 'MOTORIZEDBICYCLE_CLASS_VERSION' ) or define( 'MOTORIZEDBICYCLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MotorizedBicycle=

    {*desc

        A motorized bicycle is a bicycle with an attached motor used to power the
        vehicle, or to assist with pedaling.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MotorizedBicycle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:50.
    *}

 */
/* ==================================================================================== */
class MotorizedBicycle extends Vehicle
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

    public      $accelerationTime               = null;             /* {*property   $accelerationTime               (QuantitativeValue)             The time needed to accelerate the vehicle from a given start velocity
                                                                                                                                                    to a given target velocity.Typical unit code(s): SEC for secondsNote:
                                                                                                                                                    There are unfortunately no standard unit codes for seconds/0..100 km/h
                                                                                                                                                    or seconds/0..60 mph. Simply use "SEC" for seconds and indicate the
                                                                                                                                                    velocities in the name of the QuantitativeValue, or use valueReference
                                                                                                                                                    with a QuantitativeValue of 0..60 mph or 0..100 km/h to specify the
                                                                                                                                                    reference speeds. *} */
    public      $additionalProperty             = null;             /* {*property   $additionalProperty             (PropertyValue)                 A property-value pair representing an additional characteristics of
                                                                                                                                                    the entitity, e.g. a product feature or another characteristic for
                                                                                                                                                    which there is no matching property in schema.org.Note: Publishers
                                                                                                                                                    should be aware that applications designed to use specific schema.org
                                                                                                                                                    properties (e.g. http://schema.org/width, http://schema.org/color,
                                                                                                                                                    http://schema.org/gtin13, ...) will typically expect such data to be
                                                                                                                                                    provided using those properties, rather than using the generic
                                                                                                                                                    property/value mechanism. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $aggregateRating                = null;             /* {*property   $aggregateRating                (AggregateRating)               The overall rating, based on a collection of reviews or ratings, of
                                                                                                                                                    the item. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $audience                       = null;             /* {*property   $audience                       (Audience)                      An intended audience, i.e. a group for whom something was created. *} */
    public      $award                          = null;             /* {*property   $award                          (string)                        An award won by or for this item. *} */
    public      $awards                         = null;             /* {*property   $awards                         (string)                        Awards won by or for this item. *} */
    public      $bodyType                       = null;             /* {*property   $bodyType                       (string|URL|QualitativeValue)   Indicates the design and body style of the vehicle (e.g. station
                                                                                                                                                    wagon, hatchback, etc.). *} */
    public      $brand                          = null;             /* {*property   $brand                          (Brand|Organization)            The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                    maintained by an organization or business person. *} */
    public      $callSign                       = null;             /* {*property   $callSign                       (string)                        A callsign, as used in broadcasting and radio communications to
                                                                                                                                                    identify people, radio and TV stations, or vehicles. *} */
    public      $cargoVolume                    = null;             /* {*property   $cargoVolume                    (QuantitativeValue)             The available volume for cargo or luggage. For automobiles, this is
                                                                                                                                                    usually the trunk volume.Typical unit code(s): LTR for liters, FTQ for
                                                                                                                                                    cubic foot/feetNote: You can use minValue and maxValue to indicate
                                                                                                                                                    ranges. *} */
    public      $category                       = null;             /* {*property   $category                       (Thing|PhysicalActivityCategory|URL|string)A category for the item. Greater signs or slashes can be used to
                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $color                          = null;             /* {*property   $color                          (string)                        The color of the product. *} */
    public      $dateVehicleFirstRegistered     = null;             /* {*property   $dateVehicleFirstRegistered     (Date)                          The date of the first registration of the vehicle with the respective
                                                                                                                                                    public authorities. *} */
    public      $depth                          = null;             /* {*property   $depth                          (QuantitativeValue|Distance)    The depth of the item. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $driveWheelConfiguration        = null;             /* {*property   $driveWheelConfiguration        (string|DriveWheelConfigurationValue)The drive wheel configuration, i.e. which roadwheels will receive
                                                                                                                                                    torque from the vehicle's engine via the drivetrain. *} */
    public      $emissionsCO2                   = null;             /* {*property   $emissionsCO2                   (float)                         The CO2 emissions in g/km. When used in combination with a
                                                                                                                                                    QuantitativeValue, put "g/km" into the unitText property of that
                                                                                                                                                    value, since there is no UN/CEFACT Common Code for "g/km". *} */
    public      $fuelCapacity                   = null;             /* {*property   $fuelCapacity                   (QuantitativeValue)             The capacity of the fuel tank or in the case of electric cars, the
                                                                                                                                                    battery. If there are multiple components for storage, this should
                                                                                                                                                    indicate the total of all storage of the same type.Typical unit
                                                                                                                                                    code(s): LTR for liters, GLL of US gallons, GLI for UK / imperial
                                                                                                                                                    gallons, AMH for ampere-hours (for electrical vehicles). *} */
    public      $fuelConsumption                = null;             /* {*property   $fuelConsumption                (QuantitativeValue)             The amount of fuel consumed for traveling a particular distance or
                                                                                                                                                    temporal duration with the given vehicle (e.g. liters per 100 km).Note
                                                                                                                                                    1: There are unfortunately no standard unit codes for liters per 100
                                                                                                                                                    km. Use unitText to indicate the unit of measurement, e.g. L/100
                                                                                                                                                    km.Note 2: There are two ways of indicating the fuel consumption,
                                                                                                                                                    fuelConsumption (e.g. 8 liters per 100 km) and fuelEfficiency (e.g. 30
                                                                                                                                                    miles per gallon). They are reciprocal.Note 3: Often, the absolute
                                                                                                                                                    value is useful only when related to driving speed ("at 80 km/h") or
                                                                                                                                                    usage pattern ("city traffic"). You can use valueReference to link the
                                                                                                                                                    value for the fuel consumption to another value. *} */
    public      $fuelEfficiency                 = null;             /* {*property   $fuelEfficiency                 (QuantitativeValue)             The distance traveled per unit of fuel used; most commonly miles per
                                                                                                                                                    gallon (mpg) or kilometers per liter (km/L).Note 1: There are
                                                                                                                                                    unfortunately no standard unit codes for miles per gallon or
                                                                                                                                                    kilometers per liter. Use unitText to indicate the unit of
                                                                                                                                                    measurement, e.g. mpg or km/L.Note 2: There are two ways of indicating
                                                                                                                                                    the fuel consumption, fuelConsumption (e.g. 8 liters per 100 km) and
                                                                                                                                                    fuelEfficiency (e.g. 30 miles per gallon). They are reciprocal.Note 3:
                                                                                                                                                    Often, the absolute value is useful only when related to driving speed
                                                                                                                                                    ("at 80 km/h") or usage pattern ("city traffic"). You can use
                                                                                                                                                    valueReference to link the value for the fuel economy to another
                                                                                                                                                    value. *} */
    public      $fuelType                       = null;             /* {*property   $fuelType                       (URL|QualitativeValue|string)   The type of fuel suitable for the engine or engines of the vehicle. If
                                                                                                                                                    the vehicle has only one engine, this property can be attached
                                                                                                                                                    directly to the vehicle. *} */
    public      $gtin                           = null;             /* {*property   $gtin                           (string)                        A Global Trade Item Number (GTIN). GTINs identify trade items,
                                                                                                                                                    including products and services, using numeric identification codes.
                                                                                                                                                    The gtin property generalizes the earlier gtin8, gtin12, gtin13, and
                                                                                                                                                    gtin14 properties. The GS1 digital link specifications express GTINs
                                                                                                                                                    as URLs. A correct gtin value should be a valid GTIN, which means that
                                                                                                                                                    it should be an all-numeric string of either 8, 12, 13 or 14 digits,
                                                                                                                                                    or a "GS1 Digital Link" URL based on such a string. The numeric
                                                                                                                                                    component should also have a valid GS1 check digit and meet the other
                                                                                                                                                    rules for valid GTINs. See also GS1's GTIN Summary and Wikipedia for
                                                                                                                                                    more details. Left-padding of the gtin values is not required or
                                                                                                                                                    encouraged. *} */
    public      $gtin12                         = null;             /* {*property   $gtin12                         (string)                        The GTIN-12 code of the product, or the product to which the offer
                                                                                                                                                    refers. The GTIN-12 is the 12-digit GS1 Identification Key composed of
                                                                                                                                                    a U.P.C. Company Prefix, Item Reference, and Check Digit used to
                                                                                                                                                    identify trade items. See GS1 GTIN Summary for more details. *} */
    public      $gtin13                         = null;             /* {*property   $gtin13                         (string)                        The GTIN-13 code of the product, or the product to which the offer
                                                                                                                                                    refers. This is equivalent to 13-digit ISBN codes and EAN UCC-13.
                                                                                                                                                    Former 12-digit UPC codes can be converted into a GTIN-13 code by
                                                                                                                                                    simply adding a preceeding zero. See GS1 GTIN Summary for more
                                                                                                                                                    details. *} */
    public      $gtin14                         = null;             /* {*property   $gtin14                         (string)                        The GTIN-14 code of the product, or the product to which the offer
                                                                                                                                                    refers. See GS1 GTIN Summary for more details. *} */
    public      $gtin8                          = null;             /* {*property   $gtin8                          (string)                        The GTIN-8 code of the product, or the product to which the offer
                                                                                                                                                    refers. This code is also known as EAN/UCC-8 or 8-digit EAN. See GS1
                                                                                                                                                    GTIN Summary for more details. *} */
    public      $hasMerchantReturnPolicy        = null;             /* {*property   $hasMerchantReturnPolicy        (MerchantReturnPolicy)          Indicates a MerchantReturnPolicy that may be applicable. *} */
    public      $height                         = null;             /* {*property   $height                         (Distance|QuantitativeValue)    The height of the item. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $inProductGroupWithID           = null;             /* {*property   $inProductGroupWithID           (string)                        Indicates the productGroupID for a ProductGroup that this product
                                                                                                                                                    isVariantOf. *} */
    public      $isAccessoryOrSparePartFor      = null;             /* {*property   $isAccessoryOrSparePartFor      (Product)                       A pointer to another product (or multiple products) for which this
                                                                                                                                                    product is an accessory or spare part. *} */
    public      $isConsumableFor                = null;             /* {*property   $isConsumableFor                (Product)                       A pointer to another product (or multiple products) for which this
                                                                                                                                                    product is a consumable. *} */
    public      $isRelatedTo                    = null;             /* {*property   $isRelatedTo                    (Product|Service)               A pointer to another, somehow related product (or multiple products). *} */
    public      $isSimilarTo                    = null;             /* {*property   $isSimilarTo                    (Product|Service)               A pointer to another, functionally similar product (or multiple
                                                                                                                                                    products). *} */
    public      $isVariantOf                    = null;             /* {*property   $isVariantOf                    (ProductGroup|ProductModel)     Indicates the kind of product that this is a variant of. In the case
                                                                                                                                                    of ProductModel, this is a pointer (from a ProductModel) to a base
                                                                                                                                                    product from which this product is a variant. It is safe to infer that
                                                                                                                                                    the variant inherits all product features from the base model, unless
                                                                                                                                                    defined locally. This is not transitive. In the case of a
                                                                                                                                                    ProductGroup, the group description also serves as a template,
                                                                                                                                                    representing a set of Products that vary on explicitly defined,
                                                                                                                                                    specific dimensions only (so it defines both a set of variants, as
                                                                                                                                                    well as which values distinguish amongst those variants). When used
                                                                                                                                                    with ProductGroup, this property can apply to any Product included in
                                                                                                                                                    the group. *} */
    public      $itemCondition                  = null;             /* {*property   $itemCondition                  (OfferItemCondition)            A predefined value from OfferItemCondition or a textual description of
                                                                                                                                                    the condition of the product or service, or the products or services
                                                                                                                                                    included in the offer. *} */
    public      $knownVehicleDamages            = null;             /* {*property   $knownVehicleDamages            (string)                        A textual description of known damages, both repaired and unrepaired. *} */
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $manufacturer                   = null;             /* {*property   $manufacturer                   (Organization)                  The manufacturer of the product. *} */
    public      $material                       = null;             /* {*property   $material                       (string|URL|Product)            A material that something is made from, e.g. leather, wool, cotton,
                                                                                                                                                    paper. *} */
    public      $meetsEmissionStandard          = null;             /* {*property   $meetsEmissionStandard          (URL|string|QualitativeValue)   Indicates that the vehicle meets the respective emission standard. *} */
    public      $mileageFromOdometer            = null;             /* {*property   $mileageFromOdometer            (QuantitativeValue)             The total distance travelled by the particular vehicle since its
                                                                                                                                                    initial production, as read from its odometer.Typical unit code(s):
                                                                                                                                                    KMT for kilometers, SMI for statute miles *} */
    public      $model                          = null;             /* {*property   $model                          (ProductModel|string)           The model of the product. Use with the URL of a ProductModel or a
                                                                                                                                                    textual representation of the model identifier. The URL of the
                                                                                                                                                    ProductModel can be from an external source. It is recommended to
                                                                                                                                                    additionally provide strong product identifiers via the
                                                                                                                                                    gtin8/gtin13/gtin14 and mpn properties. *} */
    public      $modelDate                      = null;             /* {*property   $modelDate                      (Date)                          The release date of a vehicle model (often used to differentiate
                                                                                                                                                    versions of the same make and model). *} */
    public      $mpn                            = null;             /* {*property   $mpn                            (string)                        The Manufacturer Part Number (MPN) of the product, or the product to
                                                                                                                                                    which the offer refers. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nsn                            = null;             /* {*property   $nsn                            (string)                        Indicates the NATO stock number (nsn) of a Product. *} */
    public      $numberOfAirbags                = null;             /* {*property   $numberOfAirbags                (float|string)                  The number or type of airbags in the vehicle. *} */
    public      $numberOfAxles                  = null;             /* {*property   $numberOfAxles                  (float|QuantitativeValue)       The number of axles.Typical unit code(s): C62 *} */
    public      $numberOfDoors                  = null;             /* {*property   $numberOfDoors                  (QuantitativeValue|float)       The number of doors.Typical unit code(s): C62 *} */
    public      $numberOfForwardGears           = null;             /* {*property   $numberOfForwardGears           (float|QuantitativeValue)       The total number of forward gears available for the transmission
                                                                                                                                                    system of the vehicle.Typical unit code(s): C62 *} */
    public      $numberOfPreviousOwners         = null;             /* {*property   $numberOfPreviousOwners         (QuantitativeValue|float)       The number of owners of the vehicle, including the current one.Typical
                                                                                                                                                    unit code(s): C62 *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */
    public      $pattern                        = null;             /* {*property   $pattern                        (string|DefinedTerm)            A pattern that something has, for example 'polka dot', 'striped',
                                                                                                                                                    'Canadian flag'. Values are typically expressed as text, although
                                                                                                                                                    links to controlled value schemes are also supported. *} */
    public      $payload                        = null;             /* {*property   $payload                        (QuantitativeValue)             The permitted weight of passengers and cargo, EXCLUDING the weight of
                                                                                                                                                    the empty vehicle.Typical unit code(s): KGM for kilogram, LBR for
                                                                                                                                                    poundNote 1: Many databases specify the permitted TOTAL weight
                                                                                                                                                    instead, which is the sum of weight and payloadNote 2: You can
                                                                                                                                                    indicate additional information in the name of the QuantitativeValue
                                                                                                                                                    node.Note 3: You may also link to a QualitativeValue node that
                                                                                                                                                    provides additional information using valueReference.Note 4: Note that
                                                                                                                                                    you can use minValue and maxValue to indicate ranges. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $productID                      = null;             /* {*property   $productID                      (string)                        The product identifier, such as ISBN. For example: meta
                                                                                                                                                    itemprop="productID" content="isbn:123-456-789". *} */
    public      $productionDate                 = null;             /* {*property   $productionDate                 (Date)                          The date of production of the item, e.g. vehicle. *} */
    public      $purchaseDate                   = null;             /* {*property   $purchaseDate                   (Date)                          The date the item e.g. vehicle was purchased by the current owner. *} */
    public      $releaseDate                    = null;             /* {*property   $releaseDate                    (Date)                          The release date of a product or product model. This can be used to
                                                                                                                                                    distinguish the exact variant of a product. *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $reviews                        = null;             /* {*property   $reviews                        (Review)                        Review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $seatingCapacity                = null;             /* {*property   $seatingCapacity                (float|QuantitativeValue)       The number of persons that can be seated (e.g. in a vehicle), both in
                                                                                                                                                    terms of the physical space available, and in terms of limitations set
                                                                                                                                                    by law.Typical unit code(s): C62 for persons *} */
    public      $size                           = null;             /* {*property   $size                           (DefinedTerm|QuantitativeValue|string)A standardized size of a product or creative work, often simplifying
                                                                                                                                                    richer information into a simple textual string, either through
                                                                                                                                                    referring to named sizes or (in the case of product markup), by
                                                                                                                                                    adopting conventional simplifications. Use of QuantitativeValue with a
                                                                                                                                                    unitCode or unitText can add more structure; in other cases, the
                                                                                                                                                    /width, /height, /depth and /weight properties may be more applicable. *} */
    public      $sku                            = null;             /* {*property   $sku                            (string)                        The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier for
                                                                                                                                                    a product or service, or the product to which the offer refers. *} */
    public      $slogan                         = null;             /* {*property   $slogan                         (string)                        A slogan or motto associated with the item. *} */
    public      $speed                          = null;             /* {*property   $speed                          (QuantitativeValue)             The speed range of the vehicle. If the vehicle is powered by an
                                                                                                                                                    engine, the upper limit of the speed range (indicated by maxValue
                                                                                                                                                    should be the maximum speed achievable under regular
                                                                                                                                                    conditions.Typical unit code(s): KMH for km/h, HM for mile per hour
                                                                                                                                                    (0.447 04 m/s), KNT for knot*Note 1: Use minValue and maxValue to
                                                                                                                                                    indicate the range. Typically, the minimal value is zero.* Note 2:
                                                                                                                                                    There are many different ways of measuring the speed range. You can
                                                                                                                                                    link to information about how the given value has been determined
                                                                                                                                                    using the valueReference property. *} */
    public      $steeringPosition               = null;             /* {*property   $steeringPosition               (SteeringPositionValue)         The position of the steering wheel or similar device (mostly for
                                                                                                                                                    cars). *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $tongueWeight                   = null;             /* {*property   $tongueWeight                   (QuantitativeValue)             The permitted vertical load (TWR) of a trailer attached to the
                                                                                                                                                    vehicle. Also referred to as Tongue Load Rating (TLR) or Vertical Load
                                                                                                                                                    Rating (VLR)Typical unit code(s): KGM for kilogram, LBR for poundNote
                                                                                                                                                    1: You can indicate additional information in the name of the
                                                                                                                                                    QuantitativeValue node.Note 2: You may also link to a QualitativeValue
                                                                                                                                                    node that provides additional information using valueReference.Note 3:
                                                                                                                                                    Note that you can use minValue and maxValue to indicate ranges. *} */
    public      $trailerWeight                  = null;             /* {*property   $trailerWeight                  (QuantitativeValue)             The permitted weight of a trailer attached to the vehicle.Typical unit
                                                                                                                                                    code(s): KGM for kilogram, LBR for pound* Note 1: You can indicate
                                                                                                                                                    additional information in the name of the QuantitativeValue node.*
                                                                                                                                                    Note 2: You may also link to a QualitativeValue node that provides
                                                                                                                                                    additional information using valueReference.* Note 3: Note that you
                                                                                                                                                    can use minValue and maxValue to indicate ranges. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $vehicleConfiguration           = null;             /* {*property   $vehicleConfiguration           (string)                        A short text indicating the configuration of the vehicle, e.g. '5dr
                                                                                                                                                    hatchback ST 2.5 MT 225 hp' or 'limited edition'. *} */
    public      $vehicleEngine                  = null;             /* {*property   $vehicleEngine                  (EngineSpecification)           Information about the engine or engines of the vehicle. *} */
    public      $vehicleIdentificationNumber    = null;             /* {*property   $vehicleIdentificationNumber    (string)                        The Vehicle Identification Number (VIN) is a unique serial number used
                                                                                                                                                    by the automotive industry to identify individual motor vehicles. *} */
    public      $vehicleInteriorColor           = null;             /* {*property   $vehicleInteriorColor           (string)                        The color or color combination of the interior of the vehicle. *} */
    public      $vehicleInteriorType            = null;             /* {*property   $vehicleInteriorType            (string)                        The type or material of the interior of the vehicle (e.g. synthetic
                                                                                                                                                    fabric, leather, wood, etc.). While most interior types are
                                                                                                                                                    characterized by the material used, an interior type can also be based
                                                                                                                                                    on vehicle usage or target audience. *} */
    public      $vehicleModelDate               = null;             /* {*property   $vehicleModelDate               (Date)                          The release date of a vehicle model (often used to differentiate
                                                                                                                                                    versions of the same make and model). *} */
    public      $vehicleSeatingCapacity         = null;             /* {*property   $vehicleSeatingCapacity         (QuantitativeValue|float)       The number of passengers that can be seated in the vehicle, both in
                                                                                                                                                    terms of the physical space available, and in terms of limitations set
                                                                                                                                                    by law.Typical unit code(s): C62 for persons. *} */
    public      $vehicleSpecialUsage            = null;             /* {*property   $vehicleSpecialUsage            (string|CarUsageType)           Indicates whether the vehicle has been used for special purposes, like
                                                                                                                                                    commercial rental, driving school, or as a taxi. The legislation in
                                                                                                                                                    many countries requires this information to be revealed when offering
                                                                                                                                                    a car for sale. *} */
    public      $vehicleTransmission            = null;             /* {*property   $vehicleTransmission            (QualitativeValue|URL|string)   The type of component used for transmitting the power from a rotating
                                                                                                                                                    power source to the wheels or other relevant component(s) ("gearbox"
                                                                                                                                                    for cars). *} */
    public      $weight                         = null;             /* {*property   $weight                         (QuantitativeValue)             The weight of the product or person. *} */
    public      $weightTotal                    = null;             /* {*property   $weightTotal                    (QuantitativeValue)             The permitted total weight of the loaded vehicle, including passengers
                                                                                                                                                    and cargo and the weight of the empty vehicle.Typical unit code(s):
                                                                                                                                                    KGM for kilogram, LBR for poundNote 1: You can indicate additional
                                                                                                                                                    information in the name of the QuantitativeValue node.Note 2: You may
                                                                                                                                                    also link to a QualitativeValue node that provides additional
                                                                                                                                                    information using valueReference.Note 3: Note that you can use
                                                                                                                                                    minValue and maxValue to indicate ranges. *} */
    public      $wheelbase                      = null;             /* {*property   $wheelbase                      (QuantitativeValue)             The distance between the centers of the front and rear wheels.Typical
                                                                                                                                                    unit code(s): CMT for centimeters, MTR for meters, INH for inches, FOT
                                                                                                                                                    for foot/feet *} */
    public      $width                          = null;             /* {*property   $width                          (QuantitativeValue|Distance)    The width of the item. *} */


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
    }   /* End of MotorizedBicycle.__construct() ====================================== */
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
    }   /* End of MotorizedBicycle.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class MotorizedBicycle ================================================== */
/* ==================================================================================== */
?>