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
    {*file                  trql.paymentcard.class.php *}
    {*purpose               A payment method using a credit, debit, store or other card
                            to associate the payment with an account. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:06 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 14:06 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\paymentcard;

use \trql\vaesoli\Vaesoli                       as Vaesoli;
use \trql\schema\FinancialProduct     as FinancialProduct;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'FINANCIALPRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.financialproduct.class.php' );

defined( 'PAYMENTCARD_CLASS_VERSION' ) or define( 'PAYMENTCARD_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PaymentCard=

    {*desc

        A payment method using a credit, debit, store or other card to associate
        the payment with an account.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PaymentCard[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 28-08-2020 14:06. 
    *}

 */
/* ==================================================================================== */
class PaymentCard extends FinancialProduct
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $cashBack                       = null;             /* {*property   $cashBack                       (boolean|float)                 A cardholder benefit that pays the cardholder a small percentage of
                                                                                                                                                    their net expenditures. *} */
    public      $contactlessPayment             = null;             /* {*property   $contactlessPayment             (boolean)                       A secure method for consumers to purchase products or services via
                                                                                                                                                    debit, credit or smartcards by using RFID or NFC technology. *} */
    public      $floorLimit                     = null;             /* {*property   $floorLimit                     (MonetaryAmount)                A floor limit is the amount of money above which credit card
                                                                                                                                                    transactions must be authorized. *} */
    public      $monthlyMinimumRepaymentAmount  = null;             /* {*property   $monthlyMinimumRepaymentAmount  (float|MonetaryAmount)          The minimum payment is the lowest amount of money that one is required
                                                                                                                                                    to pay on a credit card statement each month. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1436963';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Card that can be used to make a payment. *} */


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
    }   /* End of PaymentCard.__construct() =========================================== */
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
    }   /* End of PaymentCard.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class PaymentCard ======================================================= */
/* ==================================================================================== */
?>