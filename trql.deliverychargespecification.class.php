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
    {*file                  trql.deliverychargespecification.class.php *}
    {*purpose               The price for the delivery of an offer using a particular
                            delivery method. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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
namespace trql\deliverychargespecification;

use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\pricespecification\PriceSpecification     as PriceSpecification;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRICESPECIFICATION_CLASS_VERSION' ) )
    require_once( 'trql.pricespecification.class.php' );

defined( 'DELIVERYCHARGESPECIFICATION_CLASS_VERSION' ) or define( 'DELIVERYCHARGESPECIFICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DeliveryChargeSpecification=

    {*desc

        The price for the delivery of an offer using a particular delivery method.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DeliveryChargeSpecification[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

    *}}

 */
/* ==================================================================================== */
class DeliveryChargeSpecification extends PriceSpecification
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

    public      $appliesToDeliveryMethod        = null;             /* {*property   $appliesToDeliveryMethod        (DeliveryMethod)                The delivery method(s) to which the delivery charge or payment charge
                                                                                                                                                    specification applies. *} */
    public      $areaServed                     = null;             /* {*property   $areaServed                     (Place|GeoShape|string|AdministrativeArea)The geographic area where a service or offered item is provided. *} */
    public      $eligibleRegion                 = null;             /* {*property   $eligibleRegion                 (Place|string|GeoShape)         The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or
                                                                                                                                                    the GeoShape for the geo-political region(s) for which the offer or
                                                                                                                                                    delivery charge specification is valid.See also ineligibleRegion. *} */
    public      $ineligibleRegion               = null;             /* {*property   $ineligibleRegion               (Place|string|GeoShape)         The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or
                                                                                                                                                    the GeoShape for the geo-political region(s) for which the offer or
                                                                                                                                                    delivery charge specification is not valid, e.g. a region where the
                                                                                                                                                    transaction is not allowed.See also eligibleRegion. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId     (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */

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
    }   /* End of DeliveryChargeSpecification.__construct() =========================== */
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
    }   /* End of DeliveryChargeSpecification.__destruct() ============================ */
    /* ================================================================================ */
}   /* End of class DeliveryChargeSpecification ======================================= */
/* ==================================================================================== */
