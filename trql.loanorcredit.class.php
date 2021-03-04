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
    {*file                  trql.loanorcredit.class.php *}
    {*purpose               A financial product for the loaning of an amount of money
                            under agreed terms and charges. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\loanorcredit;

use \trql\vaesoli\Vaesoli                       as Vaesoli;
use \trql\financialproduct\FinancialProduct     as FinancialProduct;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'FINANCIALPRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.financialproduct.class.php' );

defined( 'LOANORCREDIT_CLASS_VERSION' ) or define( 'LOANORCREDIT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LoanOrCredit=

    {*desc

        A financial product for the loaning of an amount of money under agreed
        terms and charges.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/LoanOrCredit[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}

 */
/* ==================================================================================== */
class LoanOrCredit extends FinancialProduct
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

    public      $amount                         = null;             /* {*property   $amount                         (MonetaryAmount|float)          The amount of money. *} */
    public      $currency                       = null;             /* {*property   $currency                       (string)                        The currency in which the monetary amount is expressed.Use standard
                                                                                                                                                    formats: ISO 4217 currency format e.g. "USD"; Ticker symbol for
                                                                                                                                                    cryptocurrencies e.g. "BTC"; well known names for Local Exchange
                                                                                                                                                    Tradings Systems (LETS) and other currency types e.g. "Ithaca HOUR". *} */
    public      $gracePeriod                    = null;             /* {*property   $gracePeriod                    (Duration)                      The period of time after any due date that the borrower has to fulfil
                                                                                                                                                    its obligations before a default (failure to pay) is deemed to have
                                                                                                                                                    occurred. *} */
    public      $loanRepaymentForm              = null;             /* {*property   $loanRepaymentForm              (RepaymentSpecification)        A form of paying back money previously borrowed from a lender.
                                                                                                                                                    Repayment usually takes the form of periodic payments that normally
                                                                                                                                                    include part principal plus interest in each payment. *} */
    public      $loanTerm                       = null;             /* {*property   $loanTerm                       (QuantitativeValue)             The duration of the loan or credit agreement. *} */
    public      $loanType                       = null;             /* {*property   $loanType                       (string|URL)                    The type of a loan or credit. *} */
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $recourseLoan                   = null;             /* {*property   $recourseLoan                   (boolean)                       The only way you get the money back in the event of default is the
                                                                                                                                                    security. Recourse is where you still have the opportunity to go back
                                                                                                                                                    to the borrower for the rest of the money. *} */
    public      $renegotiableLoan               = null;             /* {*property   $renegotiableLoan               (boolean)                       Whether the terms for payment of interest can be renegotiated during
                                                                                                                                                    the life of the loan. *} */
    public      $requiredCollateral             = null;             /* {*property   $requiredCollateral             (string|Thing)                  Assets required to secure loan or credit repayments. It may take form
                                                                                                                                                    of third party pledge, goods, financial instruments (cash, securities,
                                                                                                                                                    etc.) *} */
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
    }   /* End of LoanOrCredit.__construct() ========================================== */
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
    }   /* End of LoanOrCredit.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class LoanOrCredit ====================================================== */
/* ==================================================================================== */
?>