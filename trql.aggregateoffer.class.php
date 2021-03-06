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
    {*file                  trql.aggregateoffer.class.php *}
    {*purpose               When a single product is associated with multiple offers 
                            (for example, the same pair of shoes is offered by different 
                            merchants), then AggregateOffer can be used. 
                            Note: AggregateOffers are normally expected to associate 
                            multiple offers that all share the same defined 
                            businessFunction value, or default to 
                            http://purl.org/goodrelations/v1#Sell if businessFunction 
                            is not explicitly defined. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 09:44 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 09:44 *}
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
namespace trql\aggregateoffer;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\offer\Offer           as Offer;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'OFFER_CLASS_VERSION' ) )
    require_once( 'trql.offer.class.php' );



defined( 'AGGREGATEOFFER_CLASS_VERSION' ) or define( 'AGGREGATEOFFER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AggregateOffer=

    {*desc

        When a single product is associated with multiple offers (for example, the same 
        pair of shoes is offered by different merchants), then AggregateOffer can be 
        used. Note: AggregateOffers are normally expected to associate multiple offers 
        that all share the same defined businessFunction value, or default to 
        http://purl.org/goodrelations/v1#Sell if businessFunction is not explicitly 
        defined.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AggregateOffer[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 09:44.
    *}

 */
/* ==================================================================================== */
class AggregateOffer extends Offer
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $highPrice                      = null;             /* {*property   $highPrice                      (float|string)                  The highest price of all offers available.Usage guidelines:Use values
                                                                                                                                                    from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE'
                                                                                                                                                    (U+0039)) rather than superficially similiar Unicode symbols.Use '.'
                                                                                                                                                    (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal
                                                                                                                                                    point. Avoid using these symbols as a readability separator. *} */
    public      $lowPrice                       = null;             /* {*property   $lowPrice                       (float|string)                  The lowest price of all offers available.Usage guidelines:Use values
                                                                                                                                                    from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE'
                                                                                                                                                    (U+0039)) rather than superficially similiar Unicode symbols.Use '.'
                                                                                                                                                    (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal
                                                                                                                                                    point. Avoid using these symbols as a readability separator. *} */
    public      $offerCount                     = null;             /* {*property   $offerCount                     (int)                           The number of offers for the product. *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1193004';       /* {*property   $wikidataId                 (string)                            Wikidata ID. No equivalent. *} */


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
    }   /* End of AggregateOffer.__construct() ======================================== */
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
    }
    /* End of AggregateOffer.__destruct() ========================================= */
    /* ================================================================================ */

}   /* End of class AggregateOffer ==================================================== */
/* ==================================================================================== */

?>