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
    {*file                  trql.unitpricespecification.class.php *}
    {*purpose               The price asked for a given offer by the respective
                            organization or person. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été cous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\unitpricespecification;

use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\pricespecification\PriceSpecification     as PriceSpecification;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRICESPECIFICATION_CLASS_VERSION' ) )
    require_once( 'trql.pricespecification.class.php' );

defined( 'UNITPRICESPECIFICATION_CLASS_VERSION' ) or define( 'UNITPRICESPECIFICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class UnitPriceSpecification=

    {*desc

        The price asked for a given offer by the respective organization or person.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/UnitPriceSpecification[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 28-08-2020 16:41.
    *}

    *}}

*/
/* ==================================================================================== */
class UnitPriceSpecification extends PriceSpecification
/*---------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $billingDuration                = null;             /* {*property   $billingDuration                (Duration|Number|QuantitativeValue)     Specifies for how long this price (or price component)
                                                                                                                                                            will be billed. Can be used, for example, to model the
                                                                                                                                                            contractual duration of a subscription or payment plan.
                                                                                                                                                            Type can be either a Duration or a Number (in which
                                                                                                                                                            case the unit of measurement, for example month, is
                                                                                                                                                            specified by the unitCode property). *} */
    public      $billingIncrement               = null;             /* {*property   $billingIncrement               (float)                                 This property specifies the minimal quantity and rounding increment
                                                                                                                                                            that will be the basis for the billing. The unit of measurement is
                                                                                                                                                            specified by the unitCode property. *} */
    public      $billingStart                   = null;             /* {*property   $billingStart                   (number)                                Specifies after how much time this price (or price component)
                                                                                                                                                            becomes valid and billing starts. Can be used, for example, to
                                                                                                                                                            model a price increase after the first year of a subscription.
                                                                                                                                                            The unit of measurement is specified by the @var.unitCode property. *} */
    public      $priceComponentType             = null;             /* {*property   $priceComponentType             (PriceComponentTypeEnumeration)         Identifies a price component (for example, a line item on an
                                                                                                                                                            invoice), part of the total price for an offer. *} */
    public      $priceType                      = null;             /* {*property   $priceType                      (string)                                A short text or acronym indicating multiple price specifications for
                                                                                                                                                            the same offer, e.g. SRP for the suggested retail price or INVOICE for
                                                                                                                                                            the invoice price, mostly used in the car industry. *} */
    public      $referenceQuantity              = null;             /* {*property   $referenceQuantity              (QuantitativeValue)                     The reference quantity for which a certain price applies, e.g. 1 EUR
                                                                                                                                                            per 4 kWh of electricity. This property is a replacement for
                                                                                                                                                            unitOfMeasurement for the advanced cases where the price does not
                                                                                                                                                            relate to a standard unit. *} */
    public      $unitCode                       = null;             /* {*property   $unitCode                       (string|URL)                            The unit of measurement given using the UN/CEFACT Common Code (3
                                                                                                                                                            characters) or a URL. Other codes than the UN/CEFACT Common Code may
                                                                                                                                                            be used with a prefix followed by a colon. *} */
    public      $unitText                       = null;             /* {*property   $unitText                       (string)                                A string or text indicating the unit of measurement. Useful if you
                                                                                                                                                            cannot provide a standard unit code forunitCode. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                                Wikidata ID. No equivalent. *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of UnitPriceSpecification.__construct() ================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of UnitPriceSpecification.__destruct() ================================= */
    /* ================================================================================ */
}   /* End of class UnitPriceSpecification ============================================ */
/* ==================================================================================== */
