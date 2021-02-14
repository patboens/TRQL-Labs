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
    {*file                  trql.merchantreturnpolicy.class.php *}
    {*purpose               A MerchantReturnPolicy provides information about product 
                            return policies associated with an Organization or Product. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-08-2020 09:11 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-08-2020 09:11 *}
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
namespace trql\merchantreturnpolicy;

use \trql\thing\Thing                       as Thing;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\intangible\Intangible    as Intangible;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );



defined( 'MERCHANTRETURNPOLICY_CLASS_VERSION' ) or define( 'MERCHANTRETURNPOLICY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MerchantReturnPolicy=

    {*desc

        A MerchantReturnPolicy provides information about product return policies 
        associated with an Organization or Product.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MerchantReturnPolicy[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        and as such HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class MerchantReturnPolicy extends Intangible
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $inStoreReturnsOffered          = null;             /* {*property   $inStoreReturnsOffered          (boolean)                       Are in-store returns offered? *} */
    public      $merchantReturnDays             = null;             /* {*property   $merchantReturnDays             (int)                           The merchantReturnDays property indicates the number of days (from purchase) 
                                                                                                                                                    within which relevant merchant return policy is applicable. *} */
    public      $merchantReturnLink             = null;             /* {*property   $merchantReturnLink             (URL)                           Indicates a Web page or service by URL, for product return. *} */
    public      $refundType                     = null;             /* {*property   $refundType                     (RefundTypeEnumeration)         A refundType, from an enumerated list. *} */
    public      $returnFees                     = null;             /* {*property   $returnFees                     (RefundFeesEnumeration )        Indicates (via enumerated options) the return fees policy 
                                                                                                                                                    for a MerchantReturnPolicy *} */
    public      $returnPolicyCategory           = null;             /* {*property   $returnPolicyCategory           (MerchantReturnEnumeration)     A returnPolicyCategory expresses at most one of several enumerated 
                                                                                                                                                    kinds of return. *} */


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
    }   /* End of MerchantReturnPolicy.__construct() ================================== */
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
    }   /* End of MerchantReturnPolicy.__destruct() =================================== */
    /* ================================================================================ */

}   /* End of class MerchantReturnPolicy ============================================== */
/* ==================================================================================== */
?>