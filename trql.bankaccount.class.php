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
    {*file                  trql.bankaccount.class.php *}
    {*purpose               A product or service offered by a bank whereby one may
                            deposit, withdraw or transfer money and in some cases be
                            paid interest. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:36 *}
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

    {*chist
        {*mdate 18-02-21 09:09 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Normalizing the class so that it can be used as-is or
                                extended in the Small API Gateway class (SmallAPIGW)
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\schema;

use \trql\vaesoli\Vaesoli                               as v;
use \trql\quitus\Account                                as Account;
use \trql\schema\FinancialProduct                       as FinancialProduct;
use \trql\ledger\Ledger                                 as Ledger;
use \trql\personororganization\PersonOrOrganization     as PersonOrOrganization;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACCOUNT_CLASS_VERSION' ) )
    require_once( 'trql.account.class.php' );

if ( ! defined( 'FINANCIALPRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.financialproduct.class.php' );

if ( ! defined( 'LEDGER_CLASS_VERSION' ) )
    require_once( 'trql.ledger.class.php' );

if ( ! defined( 'PERSONORORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.personororganization.class.php' );

defined( 'BANKACCOUNT_CLASS_VERSION' ) or define( 'BANKACCOUNT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BankAccount=

    {*desc

        A product or service offered by a bank whereby one may deposit, withdraw or
        transfer money and in some cases be paid interest.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BankAccount[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.

        The %class% class is EXPERIMENTAL.
    *}

    *}}
 */
/* ==================================================================================== */
class BankAccount extends Account
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

    protected   $schemaOrg  = 'http://schema.org/BankAccount';      /* {*property   $schemaOrg                      (string)                        Where the official documentation is maintained *} */
    public      $accountMinimumInflow           = null;             /* {*property   $accountMinimumInflow           (MonetaryAmount)                A minimum amount that has to be paid in every month. *} */
    public      $accountOverdraftLimit          = null;             /* {*property   $accountOverdraftLimit          (MonetaryAmount)                An overdraft is an extension of credit from a lending institution when
                                                                                                                                                    an account reaches zero. An overdraft allows the individual to
                                                                                                                                                    continue withdrawing money even if the account has no funds in it.
                                                                                                                                                    Basically the bank allows people to borrow a set amount of money. *} */
    public      $bankAccountType                = null;             /* {*property   $bankAccountType                (string|URL)                    The type of a bank account. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q676459';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Collective name for all account types, credit
                                                                                                                                                    institutions  operates for their clients bank accounts *} */

    public      $balance                        = 0.0;              /* {*property   $balance                        (float)                         Amount of money present in the acoount (Wikidata (Q1365641): amount of
                                                                                                                                                    money that remains in a deposit account. *} */
    public      $currency                       = 'EUR';            /* {*property   $currency                       (string)                        The 3-letter currency code as defined in ISO_4217
                                                                                                                                                    ([url]https://fr.wikipedia.org/wiki/ISO_4217[/url]). 'EUR' by default.
                                                                                                                                                    The list of currencies can be obtained by RESTFul service on trql.io:
                                                                                                                                                    "https://www.trql.io/v1/currencies/" which links to
                                                                                                                                                    /vaesoli/resources/XML/currencies.xml *} */
    public      $szPersistenceFolder            = null;             /* {*property   $szPersistenceFolder            (string)                        Folder in which the files pertaining to the account will be saved/located *} */
    public      $oLedger                        = null;             /* {*property   $oLedger                        (Ledger)                        Ledger of the account *} */
    protected   $szFolder                       = null;             /* {*property   $szFolder                       (string)                        A global folder where accounts are stored *} */
    public      $oOwner                         = null;             /* {*property   $oOwner                         (Agent)                         A Person or Organization (@class.Agent) that owns the account. NOT USED SO FAR! *} */
    public      $bank                           = null;             /* {*property   $bank                           (string)                        The name of the Bank (e.g. "Nagelmackers") *} */
    public      $BICCode                        = null;             /* {*property   $BICCode                        (string)                        The BIC code of the BankAccount of the organization (if applicable) *} */


    /* ================================================================================ */
    /** {{*__construct( [$szID[,$szFolder]] )=

        Class constructor

        {*params
            $szID       (string)        Bank Account ID.
            $szFolder   (string)        Folder in which the persistence files of the
                                        account will be saved
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szID = null,$szFolder = null )
    /*--------------------------------------------------------*/
    {
        parent::__construct( $szID,$szFolder );
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of BankAccount.__construct() =========================================== */
    /* ================================================================================ */

    // Il faut implémenter la méthode Statement
    // Il faut que toutes les opérations enregistrées sur 1 journée soient stockées à part
    //   pour que nous puissions faire des extraits/statements séparés

    /* ================================================================================ */
    /** {{*__toString()=

        Renders a simplified view of the balance of the account

        {*params
        *}

        {*return
            (string)        HTML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString() : string
    /*---------------------------------*/
    {
        return ( "<p>ID: {$this->identifier}; Balance: " . round( $this->balance,4 ) . "{$this->currency}</p>" );
    }   /* End of BankAccount.__toString() ============================================ */
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
    }   /* End of BankAccount.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class BankAccount ======================================================= */
/* ==================================================================================== */
