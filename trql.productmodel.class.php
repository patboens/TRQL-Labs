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
    {*file                  trql.productmodel.class.php *}
    {*purpose               A datasheet or vendor specification of a product (in the
                            sense of a prototypical description). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\productmodel;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\product\Product    as Product;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.product.class.php' );



defined( 'PRODUCTMODEL_CLASS_VERSION' ) or define( 'PRODUCTMODEL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ProductModel=

    {*desc

        A datasheet or vendor specification of a product (in the sense of a
        prototypical description).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ProductModel[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

    *}}

 */
/* ==================================================================================== */
class ProductModel extends Product
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
    public      $predecessorOf                  = null;             /* {*property   $predecessorOf                  (ProductModel)                  A pointer from a previous, often discontinued variant of the product
                                                                                                                                                    to its newer variant. *} */
    public      $successorOf                    = null;             /* {*property   $successorOf                    (ProductModel)                  A pointer from a newer variant of a product to its previous, often
                                                                                                                                                    discontinued predecessor. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT LOOKED AT IT YET. *} */


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
    }   /* End of ProductModel.__construct() ========================================== */
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
    }   /* End of ProductModel.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class ProductModel ====================================================== */
/* ==================================================================================== */
?>