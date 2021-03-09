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
namespace trql\compoundpricespecification;

use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\pricespecification\PriceSpecification     as PriceSpecification;

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

    *}}
 */
/* ==================================================================================== */
class CompoundPriceSpecification extends PriceSpecification
/*-------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $priceComponent                 = null;             /* {*property   $priceComponent                 (UnitPriceSpecification)        This property links to all UnitPriceSpecification nodes that apply in
                                                                                                                                                    parallel for the CompoundPriceSpecification node. *} */
    public      $priceType                      = null;             /* {*property   $priceType                      (PriceTypeEnumeration|string)   Defines the type of a price specified for an offered product, for 
                                                                                                                                                    example a list price, a (temporary) sale price or a manufacturer 
                                                                                                                                                    suggested retail price. If multiple prices are specified for an 
                                                                                                                                                    offer the priceType property can be used to identify the type of 
                                                                                                                                                    each such specified price. The value of priceType can be specified 
                                                                                                                                                    as a value from enumeration PriceTypeEnumeration or as a free form 
                                                                                                                                                    text string for price types that are not already predefined in 
                                                                                                                                                    PriceTypeEnumeration. *} */
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
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH YET. *} */


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
    }   /* End of CompoundPriceSpecification.__construct() ============================ */
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
    }   /* End of CompoundPriceSpecification.__destruct() ============================= */
    /* ================================================================================ */
}   /* End of class CompoundPriceSpecification ======================================== */
/* ==================================================================================== */
