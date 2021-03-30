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
    {*file                  trql.tradeaction.class.php *}
    {*purpose               The act of participating in an exchange of goods and
                            services for monetary compensation. An agent trades an
                            object, product or service with a participant in exchange
                            for a one time or periodic payment. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keywords              action *}

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
namespace trql\schema\action;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\action\Action    as Action;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACTION_CLASS_VERSION' ) )
    require_once( 'trql.action.class.php' );



defined( 'TRADEACTION_CLASS_VERSION' ) or define( 'TRADEACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class TradeAction=

    {*desc

        The act of participating in an exchange of goods and services for monetary
        compensation. An agent trades an object, product or service with a
        participant in exchange for a one time or periodic payment.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/TradeAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class TradeAction extends Action
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
    public      $priceCurrency                  = null;             /* {*property   $priceCurrency                  (string)                        The currency of the price, or a price component when attached to
                                                                                                                                                    PriceSpecification and its subtypes.Use standard formats: ISO 4217
                                                                                                                                                    currency format e.g. "USD"; Ticker symbol for cryptocurrencies e.g.
                                                                                                                                                    "BTC"; well known names for Local Exchange Tradings Systems (LETS) and
                                                                                                                                                    other currency types e.g. "Ithaca HOUR". *} */
    public      $priceSpecification             = null;             /* {*property   $priceSpecification             (PriceSpecification)            One or more detailed price specifications, indicating the unit price
                                                                                                                                                    and delivery or payment charges. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of TradeAction.__construct() =========================================== */
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
    }   /* End of TradeAction.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class TradeAction ======================================================= */
/* ==================================================================================== */
