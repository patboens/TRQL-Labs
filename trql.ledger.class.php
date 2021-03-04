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
    {*file                  trql.ledger.class.php *}
    {*purpose               A ledger is the principal book or computer file for recording
                            and totaling economic transactions measured in terms of a
                            monetary unit of account by account type, with debits and
                            credits in separate columns and a beginning monetary balance
                            and ending monetary balance for each account. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 18-02-21 11:06 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 18-02-21 11:06 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\ledger;

use \trql\vaesoli\Vaesoli                       as v;
use \trql\accountingregister\AccountingRegister as AccountingRegister;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACCOUNTINGREGISTER_CLASS_VERSION' ) )
    require_once( 'trql.accountingregister.class.php' );

defined( 'LEDGER_CLASS_VERSION' ) or define( 'LEDGER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Ledger=

    {*desc

        Principal book or computer file for recording and totaling economic transactions

    *}

 */
/* ==================================================================================== */
class Ledger extends AccountingRegister
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q2732056';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Principal book or computer file
                                                                                                                                                    for recording and totaling economic transactions *} */
    public      $szStorage                      = null;             /* {*property   $szStorage                      (string)                        Physical storage (persitence layer) *} */

    /* ================================================================================ */
    /** {{*__construct( $szID )=

        Class constructor

        {*params
            $szID       (string)            The ID of the ledger (often, the ID of an
                                            account).
            $szFolder   (string)            Persistence folder of the ledger.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szID,$szFolder )
    /*------------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        if ( isset( $szID ) )
        {
            $this->identifier = (string) $szID ?? '';

            // We may need to reflect on the need to create a ledger PER year
            // as to make sure performace remains optimal
            $this->szStorage = $this->ledgerFile( $szFolder );
        }

        return ( $this );
    }   /* End of Ledger.__construct() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*ledgerFile( $szFolder )=

        Get the normalized "ledger" filename (persistence layer)

        {*params
            $szFolder       (string)            The folder where the ledger file is
                                                located.
        *}

        {*return
            (string)        The name of the "ledger" file
        *}

        *}}
    */
    /* ================================================================================ */
    protected function ledgerFile( $szFolder )
    /*--------------------------------------*/
    {
        return ( v::FIL_RealPath( $szFolder . '/' . v::STR_StripAccents( v::FIL_KeepValidCharacters( $this->identifier . '.ledger.txt' ) ) ) );
    }   /* End of Ledger.ledgerFile() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*log( $szOperation,$fAmount )=

        Class destructor

        {*params
            $szOperation    (string)        The operation that must be logged
                                            (non-structured)
            $fAmount        (float)         The amount involved in [c]$szOperation[/c]
        *}

        {*return
            (self)      The ledger object
        *}

        *}}
    */
    /* ================================================================================ */
    public function log( $szOperation,$fAmount,$szCurrency )
    /*----------------------------------------------------*/
    {
        $this->append( v::STR_padr( '{' . date( 'YmdHis' ) . '/' . (string) number_format( microtime( true ),8,'.','' ) . '}',36,' ' ) . ':::{' . $szOperation . '}:::{' . number_format( $fAmount,4,'.','' ) .'}:::{' . $szCurrency . '}' );

        return ( $this );
    }   /* End of Ledger.log() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*append( $szText )=

        Class destructor

        {*params
            $szText         (string)        The text that must be appended to the ledger
        *}

        {*return
            (bool)      [c]true[/c] if [c]$szText[/c] was succesfully appended to the
                        ledger persistence.
        *}

        *}}
    */
    /* ================================================================================ */
    protected function append( $szText )
    /*--------------------------------*/
    {
        $bRetVal = false;

        if ( ! empty( $this->szStorage ) )
        {
            if ( $fp = fopen( $this->szStorage,'a+' ) )
            {
                if ( flock( $fp,LOCK_EX ) )                             /* Lock the file EXCLUSIVELY */
                {
                    $bRetval = is_int( fwrite( $fp,$szText . "\n" ) );
                    flock( $fp,LOCK_UN );                               /* Eliminate the lock */
                }
                fclose( $fp );
            }   /* if ( $fp = fopen( $this->szStorage,'a+' ) ) */
        }   /* if ( ! empty( $this->szStorage ) ) */

        return ( $bRetVal );
    }   /* End of Ledger.append() ===================================================== */
    /* ================================================================================ */

    // ***********************************************************************************
    // ***********************************************************************************
    // ***********************************************************************************
    // Should create a "Read" ledger method that should return an array of operations
    // ***********************************************************************************
    // ***********************************************************************************
    // ***********************************************************************************


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
    }   /* End of Ledger.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Ledger ============================================================ */
/* ==================================================================================== */
?>