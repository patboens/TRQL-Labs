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
    {*file                  trql.someproducts.class.php *}
    {*purpose               A placeholder for multiple similar products of the same
                            kind. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\someproducts;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\product\Product    as Product;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.product.class.php' );



defined( 'SOMEPRODUCTS_CLASS_VERSION' ) or define( 'SOMEPRODUCTS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SomeProducts=

    {*desc

        A placeholder for multiple similar products of the same kind.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SomeProducts[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

 */
/* ==================================================================================== */
class SomeProducts extends Product
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
    public      $brand                          = null;             /* {*property   $brand                          (Brand|Organization)            The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                    maintained by an organization or business person. *} */
    public      $category                       = null;             /* {*property   $category                       (Thing|PhysicalActivityCategory|URL|string)A category for the item. Greater signs or slashes can be used to
                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $color                          = null;             /* {*property   $color                          (string)                        The color of the product. *} */
    public      $depth                          = null;             /* {*property   $depth                          (QuantitativeValue|Distance)    The depth of the item. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
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
    public      $inventoryLevel                 = null;             /* {*property   $inventoryLevel                 (QuantitativeValue)             The current approximate inventory level for the item or items. *} */
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
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $manufacturer                   = null;             /* {*property   $manufacturer                   (Organization)                  The manufacturer of the product. *} */
    public      $material                       = null;             /* {*property   $material                       (string|URL|Product)            A material that something is made from, e.g. leather, wool, cotton,
                                                                                                                                                    paper. *} */
    public      $model                          = null;             /* {*property   $model                          (ProductModel|string)           The model of the product. Use with the URL of a ProductModel or a
                                                                                                                                                    textual representation of the model identifier. The URL of the
                                                                                                                                                    ProductModel can be from an external source. It is recommended to
                                                                                                                                                    additionally provide strong product identifiers via the
                                                                                                                                                    gtin8/gtin13/gtin14 and mpn properties. *} */
    public      $mpn                            = null;             /* {*property   $mpn                            (string)                        The Manufacturer Part Number (MPN) of the product, or the product to
                                                                                                                                                    which the offer refers. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nsn                            = null;             /* {*property   $nsn                            (string)                        Indicates the NATO stock number (nsn) of a Product. *} */
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
    public      $size                           = null;             /* {*property   $size                           (DefinedTerm|QuantitativeValue|string)A standardized size of a product or creative work, often simplifying
                                                                                                                                                    richer information into a simple textual string, either through
                                                                                                                                                    referring to named sizes or (in the case of product markup), by
                                                                                                                                                    adopting conventional simplifications. Use of QuantitativeValue with a
                                                                                                                                                    unitCode or unitText can add more structure; in other cases, the
                                                                                                                                                    /width, /height, /depth and /weight properties may be more applicable. *} */
    public      $sku                            = null;             /* {*property   $sku                            (string)                        The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier for
                                                                                                                                                    a product or service, or the product to which the offer refers. *} */
    public      $slogan                         = null;             /* {*property   $slogan                         (string)                        A slogan or motto associated with the item. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $weight                         = null;             /* {*property   $weight                         (QuantitativeValue)             The weight of the product or person. *} */
    public      $width                          = null;             /* {*property   $width                          (QuantitativeValue|Distance)    The width of the item. *} */


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
    }   /* End of SomeProducts.__construct() ========================================== */
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
    }   /* End of SomeProducts.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class SomeProducts ====================================================== */
/* ==================================================================================== */

?>