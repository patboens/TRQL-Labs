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
    {*file                  trql.pricespecification.class.php *}
    {*purpose               A structured value representing a price or price range.
                            Typically, only the subclasses of this type are used for
                            markup. It is recommended to use MonetaryAmount to describe
                            independent amounts of money such as a salary, credit card
                            limits, etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 06:22 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 06:22 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\pricespecification;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\StructuredValue   as StructuredValue;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );

defined( 'PRICESPECIFICATION_CLASS_VERSION' ) or define( 'PRICESPECIFICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PriceSpecification=

    {*desc

        A structured value representing a price or price range. Typically, only the
        subclasses of this type are used for markup. It is recommended to use
        MonetaryAmount to describe independent amounts of money such as a salary,
        credit card limits, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PriceSpecification[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]

    *}

 */
/* ==================================================================================== */
class PriceSpecification extends StructuredValue
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $eligibleQuantity               = null;            /* {*property   $eligibleQuantity            (QuantitativeValue)             The interval and unit of measurement of ordering quantities for which the
                                                                                                                                                offer or price specification is valid. This allows e.g. specifying that a
                                                                                                                                                certain freight charge is valid only for a certain quantity. *} */
    public      $eligibleTransactionVolume      = null;            /* {*property   $eligibleTransactionVolume   (PriceSpecification)            The transaction volume, in a monetary unit, for which the offer or price
                                                                                                                                                specification is valid, e.g. for indicating a minimal purchasing volume,
                                                                                                                                                to express free shipping above a certain order volume, or to limit the
                                                                                                                                                acceptance of credit cards to purchases to a certain minimal amount. *} */
    public      $maxPrice                       = null;            /* {*property   $maxPrice                    (float)                         The highest price if the price is a range. *} */
    public      $minPrice                       = null;            /* {*property   $minPrice                    (float)                         The lowest price if the price is a range. *} */
    public      $price                          = null;            /* {*property   $price                       (float|string)                  The offer price of a product, or of a price component when attached to
                                                                                                                                                PriceSpecification and its subtypes.Usage guidelines:Use the priceCurrency
                                                                                                                                                property (with standard formats: ISO 4217 currency format e.g. "USD";
                                                                                                                                                Ticker symbol for cryptocurrencies e.g. "BTC"; well known names for Local
                                                                                                                                                Exchange Tradings Systems (LETS) and other currency types
                                                                                                                                                e.g. "Ithaca HOUR") instead of including ambiguous symbols such as '$'
                                                                                                                                                in the value.Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to
                                                                                                                                                indicate a decimal point. Avoid using these symbols as a readability
                                                                                                                                                separator.Note that both RDFa and Microdata syntax allow the use of a
                                                                                                                                                "content=" attribute for publishing simple machine-readable values
                                                                                                                                                alongside more human-friendly formatting.Use values from 0123456789
                                                                                                                                                (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than
                                                                                                                                                superficially similiar Unicode symbols. *} */
    public      $priceCurrency                  = null;            /* {*property   $priceCurrency               (string)                        The currency of the price, or a price component when attached to
                                                                                                                                                PriceSpecification and its subtypes.Use standard formats: ISO 4217 currency
                                                                                                                                                format e.g. "USD"; Ticker symbol for cryptocurrencies e.g. "BTC"; well
                                                                                                                                                known names for Local Exchange Tradings Systems (LETS) and other currency
                                                                                                                                                types e.g. "Ithaca HOUR". *} */
    public      $validFrom                      = null;            /* {*property   $validFrom                   (Date|DateTime)                 The date when the item becomes valid. *} */
    public      $validThrough                   = null;            /* {*property   $validThrough                (Date|DateTime)                 The date after when the item is not valid. For example the end of an offer,
                                                                                                                                                salary period, or a period of opening hours. *} */
    public      $valueAddedTaxIncluded          = null;            /* {*property   $valueAddedTaxIncluded       (boolean)                       Specifies whether the applicable value-added tax (VAT) is included in the
                                                                                                                                                price specification or not. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                    Wikidata ID. No equivalent. *} */


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
    }   /* End of PriceSpecification.__construct() ==================================== */
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
    }   /* End of PriceSpecification.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class PriceSpecification ================================================ */
/* ==================================================================================== */
?>