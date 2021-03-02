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
    {*file                  trql.compoundpricespecification.class.php *}
    {*purpose               A compound price specification is one that bundles multiple
                            prices that all apply in combination for different
                            dimensions of consumption. Use the name property of the
                            attached unit price specification for indicating the
                            dimension of a price component (e.g. "electricity" or "final
                            cleaning"). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
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
namespace trql\compoundpricespecification;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\pricespecification\PriceSpecification    as PriceSpecification;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRICESPECIFICATION_CLASS_VERSION' ) )
    require_once( 'trql.pricespecification.class.php' );



defined( 'COMPOUNDPRICESPECIFICATION_CLASS_VERSION' ) or define( 'COMPOUNDPRICESPECIFICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CompoundPriceSpecification=

    {*desc

        A compound price specification is one that bundles multiple prices that all
        apply in combination for different dimensions of consumption. Use the name
        property of the attached unit price specification for indicating the
        dimension of a price component (e.g. "electricity" or "final cleaning").

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CompoundPriceSpecification[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class CompoundPriceSpecification extends PriceSpecification
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
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $eligibleQuantity               = null;             /* {*property   $eligibleQuantity               (QuantitativeValue)             The interval and unit of measurement of ordering quantities for which
                                                                                                                                                    the offer or price specification is valid. This allows e.g. specifying
                                                                                                                                                    that a certain freight charge is valid only for a certain quantity. *} */
    public      $eligibleTransactionVolume      = null;             /* {*property   $eligibleTransactionVolume      (PriceSpecification)            The transaction volume, in a monetary unit, for which the offer or
                                                                                                                                                    price specification is valid, e.g. for indicating a minimal purchasing
                                                                                                                                                    volume, to express free shipping above a certain order volume, or to
                                                                                                                                                    limit the acceptance of credit cards to purchases to a certain minimal
                                                                                                                                                    amount. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $maxPrice                       = null;             /* {*property   $maxPrice                       (float)                         The highest price if the price is a range. *} */
    public      $minPrice                       = null;             /* {*property   $minPrice                       (float)                         The lowest price if the price is a range. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $price                          = null;             /* {*property   $price                          (float|string)                  The offer price of a product, or of a price component when attached to
                                                                                                                                                    PriceSpecification and its subtypes.Usage guidelines:Use the
                                                                                                                                                    priceCurrency property (with standard formats: ISO 4217 currency
                                                                                                                                                    format e.g. "USD"; Ticker symbol for cryptocurrencies e.g. "BTC"; well
                                                                                                                                                    known names for Local Exchange Tradings Systems (LETS) and other
                                                                                                                                                    currency types e.g. "Ithaca HOUR") instead of including ambiguous
                                                                                                                                                    symbols such as '$' in the value.Use '.' (Unicode 'FULL STOP'
                                                                                                                                                    (U+002E)) rather than ',' to indicate a decimal point. Avoid using
                                                                                                                                                    these symbols as a readability separator.Note that both RDFa and
                                                                                                                                                    Microdata syntax allow the use of a "content=" attribute for
                                                                                                                                                    publishing simple machine-readable values alongside more
                                                                                                                                                    human-friendly formatting.Use values from 0123456789 (Unicode 'DIGIT
                                                                                                                                                    ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially
                                                                                                                                                    similiar Unicode symbols. *} */
    public      $priceComponent                 = null;             /* {*property   $priceComponent                 (UnitPriceSpecification)        This property links to all UnitPriceSpecification nodes that apply in
                                                                                                                                                    parallel for the CompoundPriceSpecification node. *} */
    public      $priceCurrency                  = null;             /* {*property   $priceCurrency                  (string)                        The currency of the price, or a price component when attached to
                                                                                                                                                    PriceSpecification and its subtypes.Use standard formats: ISO 4217
                                                                                                                                                    currency format e.g. "USD"; Ticker symbol for cryptocurrencies e.g.
                                                                                                                                                    "BTC"; well known names for Local Exchange Tradings Systems (LETS) and
                                                                                                                                                    other currency types e.g. "Ithaca HOUR". *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $validFrom                      = null;             /* {*property   $validFrom                      (DateTime|Date)                 The date when the item becomes valid. *} */
    public      $validThrough                   = null;             /* {*property   $validThrough                   (DateTime|Date)                 The date after when the item is not valid. For example the end of an
                                                                                                                                                    offer, salary period, or a period of opening hours. *} */
    public      $valueAddedTaxIncluded          = null;             /* {*property   $valueAddedTaxIncluded          (boolean)                       Specifies whether the applicable value-added tax (VAT) is included in
                                                                                                                                                    the price specification or not. *} */


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
    }   /* End of CompoundPriceSpecification.__construct() ========================================== */
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
    }   /* End of CompoundPriceSpecification.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class CompoundPriceSpecification ====================================================== */
/* ==================================================================================== */

?>