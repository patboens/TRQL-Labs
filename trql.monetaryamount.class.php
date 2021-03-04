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
    {*file                  trql.monetaryamount.class.php *}
    {*purpose               A monetary value or range. This type can be used to describe
                            an amount of money such as $50 USD, or a range as in
                            describing a bank account being suitable for a balance
                            between £1,000 and £1,000,000 GBP, or the value of a
                            salary, etc. It is recommended to use PriceSpecification
                            Types to describe the price of an Offer, Invoice, etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\monetaryamount;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\structuredvalue\StructuredValue    as StructuredValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );

defined( 'MONETARYAMOUNT_CLASS_VERSION' ) or define( 'MONETARYAMOUNT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MonetaryAmount=

    {*desc

        A monetary value or range. This type can be used to describe an amount of
        money such as $50 USD, or a range as in describing a bank account being
        suitable for a balance between £1,000 and £1,000,000 GBP, or the value of
        a salary, etc. It is recommended to use PriceSpecification Types to
        describe the price of an Offer, Invoice, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MonetaryAmount[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class MonetaryAmount extends StructuredValue
/*----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $currency                       = null;             /* {*property   $currency           (string)                                    The currency in which the monetary amount is expressed.Use standard
                                                                                                                                                    formats: ISO 4217 currency format e.g. "USD"; Ticker symbol for
                                                                                                                                                    cryptocurrencies e.g. "BTC"; well known names for Local Exchange
                                                                                                                                                    Tradings Systems (LETS) and other currency types e.g. "Ithaca HOUR". *} */
    public      $maxValue                       = null;             /* {*property   $maxValue           (float)                                     The upper value of some characteristic or property. *} */
    public      $minValue                       = null;             /* {*property   $minValue           (float)                                     The lower value of some characteristic or property. *} */
    public      $validFrom                      = null;             /* {*property   $validFrom          (DateTime|Date)                             The date when the item becomes valid. *} */
    public      $validThrough                   = null;             /* {*property   $validThrough       (DateTime|Date)                             The date after when the item is not valid. For example the end of an
                                                                                                                                                    offer, salary period, or a period of opening hours. *} */
    public      $value                          = null;             /* {*property   $value              (float|string|boolean|StructuredValue)      The value of the quantitative value or property value node.For
                                                                                                                                                    QuantitativeValue and MonetaryAmount, the recommended type for values
                                                                                                                                                    is 'Number'.For PropertyValue, it can be 'Text;', 'Number', 'Boolean',
                                                                                                                                                    or 'StructuredValue'.Use values from 0123456789 (Unicode 'DIGIT ZERO'
                                                                                                                                                    (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similiar
                                                                                                                                                    Unicode symbols.Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ','
                                                                                                                                                    to indicate a decimal point. Avoid using these symbols as a
                                                                                                                                                    readability separator. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'P2769';          /* {*property   $wikidataId                     (string)                        Assigned monetary amount for a project (for the estimated
                                                                                                                                                    cost of a film, also commonly referred to as budget,
                                                                                                                                                    use P2130) *} */


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
    }   /* End of MonetaryAmount.__construct() ======================================== */
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
    }   /* End of MonetaryAmount.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class MonetaryAmount ==================================================== */
/* ==================================================================================== */
?>