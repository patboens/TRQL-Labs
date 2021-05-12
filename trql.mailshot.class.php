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
    {*file                  trql.mailshot.class.php *}
    {*purpose               sending mass mailings *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 20-03-21 15:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 20-03-21 15:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\quitus\Advertizing    as Advertizing;
use \trql\quitus\Email          as Email;
use \trql\quitus\SMS            as SMS;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ADVERTIZING_CLASS_VERSION' ) )
    require_once( 'trql.advertizing.class.php' );

if ( ! defined( 'EMAIL_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.email.class.php' );

if ( ! defined( 'SMS_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.sms.class.php' );

defined( 'MAILSHOT_CLASS_VERSION' ) or define( 'MAILSHOT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Mailshot=

    {*desc

        Sending mass mailings.

    *}

    {*todo
        Each class of TRQL Labs should bear a unique ID that should be

        1) published on UIKey
        2) mentioned on wikidata

    *}}
 */
/* ==================================================================================== */
class Mailshot extends Advertizing
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

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q10392175';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Sending mass mailings *} */
    protected   $type                           = 'mail';           /* {*property   $type                           (string)                        Can be 'mail' and 'sms' *} */
    protected   $mode                           = 'test';           /* {*property   $mode                           (string)                        Either 'test' or 'live'.  *} */
    protected   $redirectTo                     = null;             /* {*property   $redirectTo                     (string)                        The email address that must be used when operating in 'test' mode *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__destruct
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
    }   /* End of Mailshot.__construct() ============================================== */
    /* ================================================================================ */


    protected function createEmailAndSettings( $szSubject )
    /*---------------------------------------------------*/
    {
        $oEmail                 = new Email();

        $oEmail->szMailType     = 'text/html';
        $oEmail->szCharset      = 'UTF-8';

        /* THIS SHOULD NOT BE HERE : IT'S CONFIGURATION */
        if ( gethostname() === 'WIN-K5BC2JA5270' )
            $oEmail->szHost     = 'localhost';
        else
            $oEmail->szHost     = 'relay.skynet.be';

        $oEmail->iPort          = 25;

        /* THIS SHOULD NOT BE IN HERE : IT SHOULD COME FROM PARAMETERS OF THE MAILSHOT OBJECT */
        $oEmail->szDomain       = 'divincaprice.be';
        $oEmail->szFromEmail    = 'noreply@divincaprice.be';
        $oEmail->szFromName     = 'Divin Caprice';
        $oEmail->szSubject      = $szSubject;

        return ( $oEmail );
    }   /* End of Mailshot.__construct() ============================================== */
    /* ================================================================================ */


    protected function applySubstitutions( $szTemplate,$aSubstitutions,$aRecipient )
    /*----------------------------------------------------------------------------*/
    {
        $szRetVal = $szTemplate;

        foreach( $aSubstitutions as $aSubst )
        {
            $szPattern  = $aSubst['pattern'];
            $szValue    = '';

            if     ( ! empty( $aSubst['field'] ) )
            {   $szField = $aSubst['field'];
                $szValue = $aRecipient[$szField];
            }
            elseif ( ! empty( $aSubst['value'] ) )
                $szValue = $aSubst['value'];
            elseif ( ! empty( $aSubst['func'] ) )
                $szValue = ($aSubst['func'])( $szPattern,$aRecipient );

            $szRetVal = str_replace( $szPattern,$szValue,$szRetVal );
        }

        return ( $szRetVal );
    }   /* End of Mailshot.applySubstitutions() ======================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /* ================================================================================ */
    /** {{*send( $aRecipients,$szSubject,$szTemplate,$aSubstitutions,$szMailshotType = 'M' )=

        Send mass mailing OR Short Text Messages

        {*params
            $aRecipients    (array)     Associative array. For emails all email
                                        addresses must be provided in the
                                        @param.aRecipients['email'] slot; For SMS all
                                        phone numbers MUST be provided in the
                                        @param.aRecipients['phone'] slot and MUST be
                                        capable of receiving SMS.
            $szSubject      (string)    The subject of the mail to be sent.
            $szTemplate     (string)    The template to use for the mass sending.
            $aSubstitutions (array)     An array of substitutions that must be applied
                                        on the template (mail merge)
        *}

        {*warning
            Cannot send attachments for the time being (22-03-21 07:42:20).[br][br]

            Also understand that mass mailing or SMS sending can be a lenghtly process.
            Consider setting a useful time limit for execution (e.g. [c]set_time_limit(0)[/c])
        *}

        {*return
            (int)       TO BE DEFINED
        *}

        // JE DEVRAIS PRENDRE UN SEUL PARAMETRE : $aParams
        // ... CAR, IL FAUT ENCORE TENIR COMPTE DES PARAMETRES DU MAIL
        // OU DE LA CLEF D'API AVEC ESENDEX
        // JE DEVRAIS FOURNIR UN EXEMPLE AVEC MASS-MAILING DE FACTURES ENVOYEES EN HTML !!!

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
    public function send( $aRecipients,$szSubject,$szTemplate,$aSubstitutions )
    /*-----------------------------------------------------------------------*/
    {
        $iCount     = 0;
        $aProblems  = null;

        // $oMedium is either a 'mail' or an 'sms'
        if ( $this->type === 'mail' )
            $oMedium = $this->createEmailAndSettings( $szSubject = 'Menu Fête des Mères' );
        else
            $oMedium = new SMS();

        $i = 0;

        //var_dump( $oMedium );

        if ( $this->type === 'mail' )
            $szFnc = 'send';
        else
            $szFnc = 'sendEx';

        /* All messages go to the same recipient (redirectTo) if we're in test mode */
        if ( $this->mode === 'test' )
        {
            if ( is_null( $this->redirectTo ) )
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": invalid 'redirectTo' in test mode (ErrCode: 12345)",12345 );

            $oMedium->szTo = $this->redirectTo;
        }   /* if ( $this->mode === 'test' ) */

        //var_dump( $oMedium );
        //$this->die();

        foreach ( $aRecipients as $key => $aRecipient )
        {
            $oMedium->szBody = $this->applySubstitutions( $szTemplate,$aSubstitutions,$aRecipient );
            //var_dump( $oMedium );

            if ( $this->mode === 'live' )
                $oMedium->szTo = $aRecipient['destination'];

            if ( $this->type === 'mail' )
                $this->die( "IL FAUT REVOIR LE FONCTIONNEMENT DE MAILSHOT AVEC LE MAIL" );

            // Envoyé à +32477230721
            try
            {
                //$this->die( "STOP 1 LINE BEFORE SEND(). THE BEST THING TO DO WOULD BE THAT THE SEND() METHOD WORKS THE SAME FOR AN EMAIL AND AN SMS!!! {$oMedium->szTo}" );

                //if ( $oMedim->send() !== EMAIL_RET_CODE_OK )
                if ( $oMedium->$szFnc() !== EMAIL_RET_CODE_OK )
                {
                    $aProblems[] = $aRecipient;
                    /* NO MESSAGE SHOULD APPEAR IN HERE. THE CLASS MUST BE SILENT */
                    echo "<p>PROBLEM with {$aRecipient['email']}</p>\n";
                }
                else
                {
                    /* NO MESSAGE SHOULD APPEAR IN HERE. THE CLASS MUST BE SILENT */
                    var_dump( "Message #" . $i . ' sent to ' . $aRecipient[ 'destination'] . " ({$aRecipient['lastname']})" );
                    $iCount++;
                }
            }
            catch ( exception $e)
            {
                $aProblems[] = $aRecipient;
                /* NO MESSAGE SHOULD APPEAR IN HERE. THE CLASS MUST BE SILENT */
                echo "<p>PROBLEM with {$aRecipient['email']}</p>\n";
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }

            /* NO MESSAGE SHOULD APPEAR IN HERE. THE CLASS MUST BE SILENT */
            echo "<hr />";
            ob_flush();
            flush();
            $i++;

            //if ( $i > 1 )
            //    break;
        }   /* foreach ( $aRecipients ... ) */

        return ( $iCount );
    }   /* End of Mailshot.send() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szVar )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
        *}

        {*return
            (mixed)     The value of [c]$szVar[/c] or throwing an exception if
                        [c]$szVar[/c] NOT found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szVar )
    /*---------------------------*/
    {
        switch ( $szVar )
        {
            case 'mode'         :   return ( $this->mode        );
            case 'redirectTo'   :   return ( $this->redirectTo  );
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */
    }   /* End of Mailshot.__get() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__set( $szVar,$x )=

        Used for setting data of inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
            $x          (mixed)         The value to assign to @param.szVar
        *}

        {*return
            (self)      Returns the current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __set( $szVar,$x )
    /*------------------------------*/
    {
        switch ( $szVar )
        {
            case 'mode'         :   $szMode = strtolower( trim( $x ) );

                                    if ( $szMode === 'test' || $szMode === 'live' )
                                        $this->mode = $szMode;

                                    break;
            case 'type'         :   $szType = strtolower( trim( $x ) );

                                    if ( $szType === 'mail' || $szType === 'sms' )
                                        $this->type = $szType;

                                    break;
            case 'redirectTo'   :   $this->redirectTo = $x;
                                    break;
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */

        return ( $this );
    }   /* End of Mailshot.__set() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__construct
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
    }   /* End of Mailshot.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Mailshot ========================================================== */
/* ==================================================================================== */
