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
    {*file                  trql.depositaccount.class.php *}
    {*purpose               A type of Bank Account with a main purpose of depositing
                            funds to gain interest or other benefits. *}
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
namespace trql\schema;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\schema\BankAccount    as BankAccount;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'BANKACCOUNT_CLASS_VERSION' ) )
    require_once( 'trql.bankaccount.class.php' );

defined( 'DEPOSITACCOUNT_CLASS_VERSION' ) or define( 'DEPOSITACCOUNT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DepositAccount=

    {*desc

        A type of Bank Account with a main purpose of depositing funds to gain
        interest or other benefits.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DepositAccount[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class DepositAccount extends BankAccount
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $accountMinimumInflow           = null;             /* {*property   $accountMinimumInflow           (MonetaryAmount)                A minimum amount that has to be paid in every month. *} */
    public      $accountOverdraftLimit          = null;             /* {*property   $accountOverdraftLimit          (MonetaryAmount)                An overdraft is an extension of credit from a lending institution when
                                                                                                                                                    an account reaches zero. An overdraft allows the individual to
                                                                                                                                                    continue withdrawing money even if the account has no funds in it.
                                                                                                                                                    Basically the bank allows people to borrow a set amount of money. *} */
    public      $amount                         = null;             /* {*property   $amount                         (MonetaryAmount|float)          The amount of money. *} */
    public      $bankAccountType                = null;             /* {*property   $bankAccountType                (string|URL)                    The type of a bank account. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q10948641';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Savings account, current account, or other type of 
                                                                                                                                                    bank account. *} */

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of DepositAccount.__construct() ======================================== */
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
    }   /* End of DepositAccount.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class DepositAccount ==================================================== */
/* ==================================================================================== */
?>