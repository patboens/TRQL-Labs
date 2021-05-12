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
    {*file                  trql.account.class.php *}
    {*purpose               Central data structure in the practice of accounting *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08-03-21 07:06 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 08-03-21 07:06 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli                       as v;
use \trql\financialproduct\FinancialProduct     as FinancialProduct;
use \trql\ledger\Ledger                         as Ledger;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'FINANCIALPRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.financialproduct.class.php' );

if ( ! defined( 'LEDGER_CLASS_VERSION' ) )
    require_once( 'trql.ledger.class.php' );

defined( 'ACCOUNT_CLASS_VERSION' ) or define( 'ACCOUNT_CLASS_VERSION','0.1' );


defined( "EXCEPTION_CLASS_ACCOUNT_NOT_FOUND" )                  or define( "EXCEPTION_CLASS_ACCOUNT_NOT_FOUND"                      ,EXCEPTION_CLASS_BASIS + 1 );
/* ==================================================================================== */
/** {{*class Account=

    {*desc

        Central data structure in the practice of accounting

    *}

    {*warning

        [c]Account[/c] is supposed to be a lighter class than [c]BankAccount[/c]. On Wikidata,
        an [c]Account[/c] (Q508295) is a subclass of a lightweight notion: a
        [c]Structure[/c] (Q6671777), which is a subclass of an [c]Entity[/c], which is
        said to be equivalent (https://www.wikidata.org/wiki/Property:P1709) to
        [url]https://schema.org/Thing[/url].[br][br]

        This will require additional developments using a [c]Factory[/c].

    *}

    *}}
 */
/* ==================================================================================== */
class Account extends FinancialProduct
/*----------------------------------*/
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
    public      $accountType                    = null;             /* {*property   $accountType                    (string)                        The type of account. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q508295';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Central data structure in the practice of accounting *} */

    public      $balance                        = 0.0;              /* {*property   $balance                        (float)                         Amount of money present in the account (Wikidata (Q1365641): amount of
                                                                                                                                                    money that remains in a deposit account). *} */
    public      $currency                       = 'EUR';            /* {*property   $currency                       (string)                        The 3-letter currency code as defined in ISO_4217
                                                                                                                                                    ([url]https://fr.wikipedia.org/wiki/ISO_4217[/url]). 'EUR' by default.
                                                                                                                                                    The list of currencies can be obtained by RESTFul service on trql.io:
                                                                                                                                                    "https://www.trql.io/v1/currencies/" which links to
                                                                                                                                                    /vaesoli/resources/XML/currencies.xml *} */
    public      $szPersistenceFolder            = null;             /* {*property   $szPersistenceFolder            (string)                        Folder in which the files pertaining to the account will be saved/located *} */
    public      $oLedger                        = null;             /* {*property   $oLedger                        (Ledger)                        Ledger of the account *} */
    protected   $szFolder                       = null;             /* {*property   $szFolder                       (string)                        A global folder where accounts are stored *} */


    /* ================================================================================ */
    /** {{*__construct( [$szID[,$szFolder]] )=

        Class constructor

        {*params
            $szID       (string)        Account ID.
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
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        $this->identifier   = $szID     ?? null;
        $this->szFolder     = $szFolder ?? null;

        if ( ! empty( $this->identifier ) )
        {
            $this->szPersistenceFolder  = $this->persistenceFolder( $szID,$szFolder );

            //var_dump( $this->szPersistenceFolder );

            if ( $this->exists( $this->identifier,$this->szFolder ) )
            {
                $this->balance = $this->readBalance();
                //var_dump( "POSITION",$this->szPersistenceFolder,$this->balance );

                $this->oLedger = new Ledger( $this->identifier,$this->szPersistenceFolder );
            }   /* if ( $this->exists() ) */
        }
        else
        {
            // SHOULD THROW AN EXCEPTION
        }

        return ( $this );
    }   /* End of Account.__construct() =============================================== */
    /* ================================================================================ */


    protected static function storageMap( $szKey,$modulo = TRAIT_MODULO,$sz2ndLevelPrefix = null )
    /*------------------------------------------------------------------------------------------*/
    {
        $szMD5      = md5( (string) $szKey );
        $szMD52nd   = md5( strtoupper( (string) $szKey . (string) $szKey ) );
        $t1         = microtime( true );

        // La valeur la plus haute retournée dans un MD5 est un 'f', ascii 102 =>
        // la somme la plus haute serait 11016
        // Donc, le modulo ne peut pas être supérieur à 11016!!!
        // Le meilleur choix se portant sur 11003, prime number le plus proche de
        // 11016
        //var_dump( ( 102 * 3  ) +
        //          ( 102 * 6  ) +
        //          ( 102 * 9  ) +
        //          ( 102 * 12 ) +
        //          ( 102 * 15 ) +
        //          ( 102 * 18 ) +
        //          ( 102 * 21 ) +
        //          ( 102 * 24 ) );
        //die();

        $modulo = min( $modulo ?? TRAIT_MODULO,TRAIT_MODULO );

        return ( array( 'key'           => $szKey                                                                                    ,
                        'md5'           => $szMD5                                                                                    ,
                        'md52nd'        => $szMD52nd                                                                                 ,
                        'modulo'        => $modulo                                                                                   ,
                        'level1'        => sprintf(                     '%05d',self::ascii( substr( $szMD5      ,0 ,8 ) ) % $modulo ),
                        'level2'        => sprintf(                     '%05d',self::ascii( substr( $szMD5      ,8 ,8 ) ) % $modulo ),
                        'level3'        => sprintf(                     '%05d',self::ascii( substr( $szMD5      ,16,8 ) ) % $modulo ),
                        'level4'        => sprintf(                     '%05d',self::ascii( substr( $szMD5      ,24,8 ) ) % $modulo ),
                        'levelA'        => sprintf( $sz2ndLevelPrefix . '%05d',self::ascii( substr( $szMD52nd   ,0 ,8 ) ) % $modulo ),
                        'levelB'        => sprintf( $sz2ndLevelPrefix . '%05d',self::ascii( substr( $szMD52nd   ,8 ,8 ) ) % $modulo ),
                        'levelC'        => sprintf( $sz2ndLevelPrefix . '%05d',self::ascii( substr( $szMD52nd   ,16,8 ) ) % $modulo ),
                        'levelD'        => sprintf( $sz2ndLevelPrefix . '%05d',self::ascii( substr( $szMD52nd   ,24,8 ) ) % $modulo ),
                        'possibilities' => pow( $modulo,8 )                                                                          ,
                        'perf'          => microtime( true ) - $t1                                                                   ,
                      ) );

    }   /* End of Account.storageMap() ================================================ */
    /* ================================================================================ */


    protected static function ascii( $szStr )
    /*-------------------------------------*/
    {
        $a = str_split( $szStr );
        $sum = 0;

        $i = 0;
        foreach ( $a as $c )
        {
            $sum += ord( $c ) * ( ++$i * 3 );
        }   /* foreach ( $a as $c ) */

        return ( $sum );
    }   /* End of Account.ascii() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*persistenceFolder( $szID,$szFolder )=

        Determines the persistence layer folder pertaining to this account

        {*params
            $szID       (string)        Account ID.
            $szFolder   (string)        Folder in which the persistence files of the
                                        account will be saved. Optional. [c]null[/c]
                                        by default.
        *}

        {*return
            (string)    The folder in which accounts are stored
        *}

        *}}
    */
    /* ================================================================================ */
    public static function persistenceFolder( $szID,$szFolder ) : string
    /*----------------------------------------------------------------*/
    {
        //$szID       = ( $szID     ?? $this->identifier ) ?? '';
        //$szFolder   = ( $szFolder ?? $this->szFolder   ) ?? '';

        $a = self::storageMap( $szID );

        return ( v::FIL_RealPath( $szFolder . '/' . $a['level1'] . '/' .
                                                    $a['level2'] . '/' .
                                                    $a['level3'] . '/' .
                                                    $a['level4'] ) );

    }   /* End of Account.persistenceFolder() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*create( $szID,$szFolder )=

        Persist the creation of an account in a given folder

        {*params
            $szID       (string)        Account ID.
            $szFolder   (string)        Folder in which the persistence files of the
                                        account will be saved.
        *}

        {*return
            (bool)      [c]true[/c] if the account was created successfully; [c]false[/c]
                        otherwise.
        *}

        {*example
        use \trql\vaesoli\Vaesoli       as v;
        use \trql\account\Account       as Account;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'ACCOUNT_CLASS_VERSION' ) )
            require_once( 'trql.account.class.php' );

        $szAccountNumber = 'CLIENT1';
        $szStoreInFolder = __DIR__ . '/accountsV2';

        if ( ! Account::exists( $szAccountNumber,$szStoreInFolder ) )
        {
            var_dump( "Should create the account: {$szAccountNumber}" );

            if ( [b]Account::create( $szAccountNumber,$szStoreInFolder )[/b] )
                var_dump( "Account '{$szAccountNumber}' created" );

        }

        if ( Account::exists( $szAccountNumber,$szStoreInFolder ) )
        {
            var_dump( "Can start using the account" );
            $o = new Account( $szAccountNumber,$szStoreInFolder );

            // Let's put some money on it
            try
            {
                $o->deposit( 100 );
                echo $o->balance . $o->currency;
            }
            catch ( Exception $e)
            {
                var_dump( $e->getMessage() );
            }
        }

        *}

        *}}
    */
    /* ================================================================================ */
    public static function create( $szID,$szFolder ) : bool
    /*---------------------------------------------------*/
    {
        $bRetVal = false;

        if ( self::exists( $szID,$szFolder ) )
        {
            if ( ! is_dir( $szPersistenceFolder = self::persistenceFolder( $szID,$szFolder ) ) )
                $bRetVal = v::FIL_MkDir( $szPersistenceFolder );
        }   /* if ( self::exists( $szID,$szFolder ) ) */

        return ( $bRetVal );
    }   /* End of Account.create() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*exists( $szID,$szFolder )=

        Determines whether the account exists or not

        {*params
        *}

        {*return
            (bool)      [c]true[/c] if the account exists; [c]false[/c] if not
        *}

        {*example
        use \trql\vaesoli\Vaesoli       as v;
        use \trql\account\Account       as Account;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'ACCOUNT_CLASS_VERSION' ) )
            require_once( 'trql.account.class.php' );

        $szAccountNumber = 'CLIENT1';
        $szStoreInFolder = __DIR__ . '/accountsV2';

        if ( ! [b]Account::exists( $szAccountNumber,$szStoreInFolder )[/b] )
        {
            var_dump( "Should create the account: {$szAccountNumber}" );

            if ( Account::create( $szAccountNumber,$szStoreInFolder ) )
                var_dump( "Account '{$szAccountNumber}' created" );

        }

        if ( [b]Account::exists( $szAccountNumber,$szStoreInFolder )[/b] )
        {
            var_dump( "Can start using the account" );
            $o = new Account( $szAccountNumber,$szStoreInFolder );

            // Let's put some money on it
            try
            {
                $o->deposit( 100 );
                echo $o->balance . $o->currency;
            }
            catch ( Exception $e)
            {
                var_dump( $e->getMessage() );
            }
        }
        *}

        *}}
    */
    /* ================================================================================ */
    public static function exists( $szID,$szFolder ) : bool
    /*---------------------------------------------------*/
    {
        $bRetVal = false;

        if ( ! empty( $szPersistenceFolder = self::persistenceFolder( $szID,$szFolder ) ) )
            $bRetVal = is_dir( $szPersistenceFolder );

        return ( $bRetVal );
    }   /* End of Account.exists() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*balanceFile()=

        Get the normalized balance filename (persistence layer)

        {*params
        *}

        {*return
            (string)        The name of the "balance" file
        *}

        {*seealso @fnc.saveBalance,@fnc.readBalance *}

        *}}
    */
    /* ================================================================================ */
    protected function balanceFile()
    /*----------------------------*/
    {
        if ( ! empty( $this->szPersistenceFolder ) )
            return ( v::FIL_RealPath( $this->szPersistenceFolder . '/' . v::STR_StripAccents( v::FIL_KeepValidCharacters( $this->identifier . '.balance.txt' ) ) ) );
        else
            return ( '' );
    }   /* End of Account.balanceFile() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*readBalance()=

        Reads the account balance from its persistence layer

        {*params
        *}

        {*return
            (float)         The current account balance
        *}

        {*seealso @fnc.saveBalance *}

        *}}
    */
    /* ================================================================================ */
    protected function readBalance()
    /*----------------------------*/
    {
        $fRetVal    = 0.0;

        //var_dump( __METHOD__ . ' ' . $this->szPersistenceFolder );

        if ( ! empty( $this->szPersistenceFolder ) )
        {
            $szFile = $this->balanceFile();

            //var_dump( "Will read from",$szFile );

            if ( is_file( $szFile ) )
            {
                $szAmount = v::FIL_FileToStr( $szFile );
                $fRetVal = (float) $szAmount;
            }
            else
            {
                v::FIL_StrToFile( '0.0',$szFile );
            }
        }

        return ( round( $fRetVal,4 ) );
    }   /* End of Account.readBalance() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*saveBalance()=

        Saves the account balance to its persistence layer

        {*params
        *}

        {*return
            (bool)      [c]true[/c] if the balance was saved successfully; [c]false[/c]
                        if not.
        *}

        {*seealso @fnc.readBalance *}

        *}}
    */
    /* ================================================================================ */
    protected function saveBalance()
    /*----------------------------*/
    {
        //var_dump( __METHOD__ . ' ' . $this->szPersistenceFolder );

        if ( ! empty( $this->szPersistenceFolder ) )
            return ( v::FIL_StrToFile( (string) $this->balance,$this->balanceFile() ) );
        else
            return ( false );
    }   /* End of Account.saveBalance() =========================================== */
    /* ================================================================================ */


    // ***********************************************************************************
    // ***********************************************************************************
    // ***********************************************************************************
    // Il faut s'inspirer de ce que fait Mollie en ayant un mode de travail
    // "test" et un mode "live"
    //
    // Chaque deposit ou chaque withdrawal sur le compte devrait aussi pouvoir s'accompagner
    //  1) d'un commentaire
    //  2) d'un ID unique d'opération (aussi à sauver dans le ledger ?)
    //  3) et chaque opération doit faire l'objet d'un log (le ledger n'est pas un log!)
    // ***********************************************************************************
    // ***********************************************************************************
    // ***********************************************************************************

    /* ================================================================================ */
    /** {{*deposit( $x )=

        Put a sum of money into the account

        {*params
            $x      (float)     The amount of money to put on the account
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*seealso @fnc.withdraw, @fnc.transfer *}

        {*example
        use \trql\vaesoli\Vaesoli       as v;
        use \trql\account\Account       as Account;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'ACCOUNT_CLASS_VERSION' ) )
            require_once( 'trql.account.class.php' );

        $szAccountNumber = 'CLIENT1';
        $szStoreInFolder = __DIR__ . '/accountsV2';

        if ( ! Account::exists( $szAccountNumber,$szStoreInFolder ) )
        {
            var_dump( "Should create the account: {$szAccountNumber}" );

            if ( Account::create( $szAccountNumber,$szStoreInFolder ) )
                var_dump( "Account '{$szAccountNumber}' created" );

        }

        if ( Account::exists( $szAccountNumber,$szStoreInFolder ) )
        {
            var_dump( "Can start using the account" );
            $o = new Account( $szAccountNumber,$szStoreInFolder );

            // Let's put some money on it
            try
            {
                [b]$o->deposit( 100 )[/b];
                echo $o->balance . $o->currency;
            }
            catch ( Exception $e)
            {
                var_dump( $e->getMessage() );
            }
        }

        *}

        *}}
    */
    /* ================================================================================ */
    public function deposit( $x )
    /*-------------------------*/
    {
        if ( $this->exists( $this->identifier,$this->szFolder ) )
        {
            $fAmount = ( is_numeric( $x ) ? abs( $x ) : 0 );

            $this->balance += $fAmount;
            $this->saveBalance();
            $this->oLedger->log( '+',$fAmount,$this->currency );
        }
        else
        {
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": (ErrCode: EXCEPTION_CLASS_ACCOUNT_NOT_FOUND - #" . EXCEPTION_CLASS_ACCOUNT_NOT_FOUND . ")",EXCEPTION_CLASS_ACCOUNT_NOT_FOUND );
        }

        return ( $this );
    }   /* End of Account.deposit() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*withdraw( $x )=

        Withdraw a sum of money from the bank account

        {*params
            $x      (float)     The amount of money to withdraw from the account
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*seealso @fnc.deposit, @fnc.transfer *}

        {*example
        use \trql\vaesoli\Vaesoli       as v;
        use \trql\account\Account       as Account;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'ACCOUNT_CLASS_VERSION' ) )
            require_once( 'trql.account.class.php' );

        $szAccountNumber = 'CLIENT1';
        $szStoreInFolder = __DIR__ . '/accountsV2';

        if ( ! Account::exists( $szAccountNumber,$szStoreInFolder ) )
        {
            var_dump( "Should create the account: {$szAccountNumber}" );

            if ( Account::create( $szAccountNumber,$szStoreInFolder ) )
                var_dump( "Account '{$szAccountNumber}' created" );

        }

        if ( Account::exists( $szAccountNumber,$szStoreInFolder ) )
        {
            var_dump( "Can start using the account" );
            $o = new Account( $szAccountNumber,$szStoreInFolder );

            // Let's put some money on it
            try
            {
                [b]$o->withdraw( 100 )[/b];
                echo $o->balance . $o->currency;
            }
            catch ( Exception $e)
            {
                var_dump( $e->getMessage() );
            }
        }

        *}

        *}}
    */
    /* ================================================================================ */
    public function withdraw( $x )
    /*-------------------------*/
    {
        if ( $this->exists( $this->identifier,$this->szFolder ) )
        {
            $fAmount = ( is_numeric( $x ) ? abs( $x ) : 0 );

            $this->balance -= $fAmount;
            $this->saveBalance();
            $this->oLedger->log( '-',$fAmount,$this->currency );
        }
        else
        {
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": (ErrCode: EXCEPTION_CLASS_ACCOUNT_NOT_FOUND - #" . EXCEPTION_CLASS_ACCOUNT_NOT_FOUND . ")",EXCEPTION_CLASS_ACCOUNT_NOT_FOUND );
        }

        return ( $this );
    }   /* End of Account.withdraw() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*transfer( $x,$szID )=

        Transfer a amount of money to another Bank Account

        {*params
            $x      (float)     The amount of money to transfer
            $szID   (string)    The ID of the account to transfer the money to
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*warning
            Incomplete implementation. DO NOT USE IN PRODUCTION
        *}

        {*seealso @fnc.deposit, @fnc.withdraw *}

        *}}
    */
    /* ================================================================================ */
    public function transfer( $x,$szID )
    /*--------------------------------*/
    {
        var_dump( __METHOD__ . '(): INCOMPLETE IMPLEMENTATION' );

        if ( $this->exists( $this->identifier,$this->szFolder ) )
        {
            var_dump( "DEVFRAIT ETRE POSSIBLE",$this->exists( $szID,$this->szFolder ) );

            $fAmount = ( is_numeric( $x ) ? abs( $x ) : 0 );

            /* Here starts a 2-phase commit operation :

                1) Withdraw from source account
                2) Deposit on target account

                Operation is complete when 2 phases are OK together;
                if not, rollback BOTH phases
            */

            //$this->balance -= $fAmount;
            //$this->saveBalance();
            //$this->oLedger->log( '-',$fAmount,$this->currency );
        }
        else
        {
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN (ErrCode: EXCEPTION_CLASS_ACCOUNT_NOT_FOUND)",EXCEPTION_CLASS_ACCOUNT_NOT_FOUND );
        }

        return ( $this );
    }   /* End of Account.transfer() ================================================== */
    /* ================================================================================ */


    // Il faut implémenter la méthode Transfer
    // Il faut que le Account puisse fonctionner en mode test et live
    // Il faut que le ledger puisse fonctionner en mode test et live
    // Il faut implémenter la méthode Statement
    // Il faut que toutes les opérations enregistrées sur 1 journée soient stockées à part
    //   pour que nous puissions faire des extraits/statements séparés

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
    }   /* End of Account.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Account =========================================================== */
/* ==================================================================================== */
