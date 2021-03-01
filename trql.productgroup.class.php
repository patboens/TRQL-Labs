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
    {*file                  trql.productgroup.class.php *}
    {*purpose               A ProductGroup represents a group of Products that vary only 
                            in certain well-described ways, such as by size, color, 
                            material etc.While a ProductGroup itself is not directly 
                            offered for sale, the various varying products that it 
                            represents can be. The ProductGroup serves as a prototype or 
                            template, standing in for all of the products who have an 
                            isVariantOf relationship to it. As such, properties 
                            (including additional types) can be applied to the 
                            ProductGroup to represent characteristics shared by each of 
                            the (possibly very many) variants. Properties that reference 
                            a ProductGroup are not included in this mechanism; neither 
                            are the following specific properties variesBy, hasVariant, url. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-08-2020 11:16 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-08-2020 11:16 *}
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
namespace trql\productgroup;

use \trql\thing\Thing                       as Thing;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\product\Product    as Product;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.product.class.php' );



defined( 'PRODUCTGROUP_CLASS_VERSION' ) or define( 'PRODUCTGROUP_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ProductGroup=

    {*desc

        A ProductGroup represents a group of Products that vary only in certain 
        well-described ways, such as by size, color, material etc.While a ProductGroup 
        itself is not directly offered for sale, the various varying products that it 
        represents can be. The ProductGroup serves as a prototype or template, standing 
        in for all of the products who have an isVariantOf relationship to it. As such, 
        properties (including additional types) can be applied to the ProductGroup 
        to represent characteristics shared by each of the (possibly very many) 
        variants. Properties that reference a ProductGroup are not included in this 
        mechanism; neither are the following specific properties variesBy, 
        hasVariant, url.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ProductGroup[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 25-08-2020 11:16. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class ProductGroup extends Product
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $hasVariant                     = null;             /* {*property   $hasVariant                    (Product)                    Indicates a Product that is a member of this ProductGroup 
                                                                                                                                                (or ProductModel). *} */
    public      $productGroupID                 = null;             /* {*property   $productGroupID                (string)                     Indicates a textual identifier for a ProductGroup. *} */
    public      $variesBy                       = null;             /* {*property   $variesBy                      (DefinedTerm|string)         Indicates the property or properties by which the variants in 
                                                                                                                                                a ProductGroup vary, e.g. their size, color etc. Schema.org 
                                                                                                                                                properties can be referenced by their short name e.g. "color"; 
                                                                                                                                                terms defined elsewhere can be referenced with their URIs. *} */


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

        $this->die( __CLASS__ . ' has NOT been tested yet!' );

        return ( $this );
    }   /* End of ProductGroup.__construct() ========================================== */
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
    }   /* End of ProductGroup.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class ProductGroup ====================================================== */
/* ==================================================================================== */

?>