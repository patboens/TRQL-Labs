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
    {*file                  trql.email.class.php *}
    {*purpose               A set of services to create and send an email message. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 19-01-21 07:14 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel �t� *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 19-01-21 07:14 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\email;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\utility\Utility               as Utility;
use \trql\form\Form                     as Form;
use \trql\fieldset\Fieldset             as Fieldset;
use \trql\formset\Formset               as Formset;
use \trql\input\Input                   as Input;
use \trql\emailmessage\EmailMessage     as EmailMessage;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

if ( ! defined( 'MESSAGE_CLASS_VERSION' ) )
    require_once( 'trql.message.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'EMAILMESSAGE_CLASS_VERSION' ) )
    require_once( 'trql.emailmessage.class.php' );


if ( ! defined( 'EMAIL_RET_CODES' ) )                               /* If email return codes NOT defined */
{
    define( 'EMAIL_RET_CODES'               ,0  );

    define( 'EMAIL_RET_CODE_OK'             ,EMAIL_RET_CODES +   0 );
    define( 'EMAIL_RET_CODE_NO_RECIPIENT'   ,EMAIL_RET_CODES - 100 );
    define( 'EMAIL_RET_CODE_MAIL_NOT_SENT'  ,EMAIL_RET_CODES - 200 );
}

defined( 'EMAIL_CLASS_VERSION' ) or define( 'EMAIL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Email=

    {*desc

        A set of services to create and send an email message.

    *}

    *}}
 
 */
/* ==================================================================================== */
class Email extends Utility
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId         = 'Q30070439';                  /* {*property   $wikidataId                     (string)                Wikidata ID. A single message, sent by email *} */
    public      $szHost             = null;                         /* {*property   $szHost                         (string)                Host to connect to *} */
    public      $iPort              = 25;                           /* {*property   $iPort                          (int)                   Connection port *} */
    public      $szMailType         = 'text/plain';                 /* {*property   $szMailType                     (string)                Mail format (can also be text/html) *} */
    public      $szCharset          = 'UTF-8';                      /* {*property   $szCharset                      (string)                Character set *} */
    public      $szDomain           = null;                         /* {*property   $szDomain                       (string)                Domaine internet *} */
    public      $iPriority          = 3;                            /* {*property   $iPriority                      (string)                Mail priority (1 = highest ... 5 = lowest) *} */
    public      $szFromName         = null;                         /* {*property   $szFromName                     (string)                Sender name */
    public      $szFromEmail        = null;                         /* {*property   $szFromEmail                    (string)                Sender Email address *} */
    public      $szTo               = null;                         /* {*property   $szTo                           (string)                Recipient's email address (can be multiple with a ',' separated string *} */
    public      $szCC               = null;                         /* {*property   $szCC                           (string)                Email address of copy *} */
    public      $szBCC              = null;                         /* {*property   $szBCC                          (string)                Blind copy email address *} */
    public      $szSubject          = null;                         /* {*property   $szSubject                      (string)                Subject of the email *} */
    public      $szBody             = null;                         /* {*property   $szBody                         (string)                Body of the mail *} */
    public      $aFiles             = null;                         /* {*property   $aFiles                         (string)                List of attachments *} */
    public      $szLogFile          = null;                         /* {*property   $szLogFile                      (string)                Possible log file *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of Email.__construct() ================================================= */
    /* ================================================================================ */


    public function send() : int
    /*------------------------*/
    {
        $iRetVal = EMAIL_RET_CODE_OK;                               /* Return value of the method */

        $this->szHost         = strtolower( trim( gethostname() ) ) === 'predator2' ? 'relay.skynet.be' : 'localhost';
        $this->szFromName     = 'OpenPMO';
        //$this->szFromEmail    = 'info@ecolediabolo.be';
        $this->szDomain       = 'openpmo.site';


        if ( empty( $this->szTo ) )                                 /* If no recipient */
        {
            return ( EMAIL_RET_CODE_NO_RECIPIENT );                 /* Return error */
        }

        {   /* Set miscellaneous variables to defaults */
            if ( is_null( $this->szMailType ) )
                $szMailType = 'text/html';
            else
                $szMailType = $this->szMailType;

            if ( is_null( $this->szCharset ) )
                $szCharset = 'iso-8859-1';
            else
                $szCharset = $this->szCharset;
        }   /* Set miscellaneous variables to defaults */


        {   /* Interactions with PHP settings in php.ini : sendmail_from, SMTP and port */
            $szOldFromEmail = ini_get( 'sendmail_from' );
            $szOldHost      = ini_get( 'SMTP'          );
            $szOldPort      = ini_get( 'smtp_port'     );

            if ( is_null( $this->szFromEmail ) )
                $szFromEmail = $szOldFromEmail;
            else
                $szFromEmail = $this->szFromEmail;

            if ( is_null( $this->szFromName ) )
                $szFromName = 'Quitus robot';
            else
                $szFromName = $this->szFromName;

            if ( is_null( $this->szHost ) )
                $szHost = $szOldHost;
            else
                $szHost = $this->szHost;

            if ( is_null( $this->iPort ) )
                $iPort = (int) $szOldPort;
            else
                $iPort = $this->iPort;

            ini_set( 'sendmail_from',$szFromEmail   );
            ini_set( 'SMTP'         ,$szHost        );
            ini_set( 'smtp_port'    ,$iPort         );

            //var_dump( $szHost,$iPort );

            //echo "HOST: ",$szHost,"\n";
            //echo "PORT: ",$iPort,"\n";
        }

        //$szHeaders  = "From: OpenPMO"                   . "\r\n" .
        //              "Reply-To: {$this->szFromEmail}"  . "\r\n" .
        //              "X-Mailer: TRQL Labs/" . str_replace( '\\','-',$this->self['class'] ) . "/" . phpversion();

        $szHeaders  = $this->buildHeaders( 'no-reply@openpmo.site' );
        //var_dump( $szHeaders );
        //var_dump( $this->szTo );

        if ( mail( $this->szTo,$this->szSubject,$this->szBody,$szHeaders ) )
        {
            $iRetVal = EMAIL_RET_CODE_OK;
        }


        return ( $iRetVal );

        return ( @mail( $this->szTo,$this->szSubject,$this->szBody,$szHeaders ) );
    }   /* End of Email.send() ======================================================== */
    /* ================================================================================ */


    protected function buildHeaders( $szFromEmail )
    /*-------------------------------------------*/
    {
        $szRetVal = null;                                               /* Return value of the method */

        switch ( $this->iPriority )                                     /* Which priority ? */
        {
            case    1   :   $szPriority     = 'X-Priority: 1 (highest)';
                            $szImportance   = 'Importance: High';
                            break;
            case    2   :   $szPriority     = 'X-Priority: 2 (high)';
                            $szImportance   = 'Importance: High';
                            break;
            case    4   :   $szPriority     = 'X-Priority: 4 (low)';
                            $szImportance   = 'Importance: Low';
                            break;
            case    5   :   $szPriority     = 'X-Priority: 5 (lowest)';
                            $szImportance   = 'Importance: Low';
                            break;
            default     :   $szPriority     = 'X-Priority: 3 (normal)';
                            $szImportance   = 'Importance: Normal';
                            break;
        }   /* switch ( $iPriority ) */

        /* Let's make sure we can reset these values after */
        //$szFromEmail = ini_get( 'sendmail_from' );
        //$szHost      = ini_get( 'SMTP'          );
        //$szPort      = ini_get( 'smtp_port'     );

        $szRetVal   = "Content-type: {$this->szMailType}; charset={$this->szCharset}"                     . PHP_EOL .
                      "From: {$this->szFromName} <" . str_replace( array('<','>'),'',$szFromEmail ) . ">" . PHP_EOL .
                      "Reply-To: {$this->szFromEmail}"                                                    . PHP_EOL .
                      "Return-Path: {$this->szFromName}"                                                  . PHP_EOL .
                      "MIME-Version: 1.0"                                                                 . PHP_EOL .
                      "Date: " . date("r")                                                                . PHP_EOL .
                      "{$szPriority}"                                                                     . PHP_EOL .
                      "{$szImportance}"                                                                   . PHP_EOL .
                      "X-Mailer: TRQL Labs - trql.email.class"                                            . PHP_EOL;

        if ( ! is_null( $this->szCC ) )
        {
            if  ( is_string( $this->szCC ) )
            {
                $this->szCC = trim( $this->szCC );

                if ( strlen( $this->szCC ) > 0 )
                {
                    $this->szCC = trim( str_replace( ';',',',$this->szCC ) );

                    if ( strlen( $this->szCC ) > 0 )
                    {
                        $szRetVal .= "CC: {$this->szCC}" . PHP_EOL;
                    }
                }
            }
        }

        if ( ! is_null( $this->szBCC ) )
        {
            if  ( is_string( $this->szBCC ) )
            {
                $this->szBCC = trim( $this->szBCC );
        
                if ( strlen( $this->szBCC ) > 0 )
                {
                    $this->szBCC = trim( str_replace( ';',',',$this->szBCC ) );
        
                    if ( strlen( $this->szBCC ) > 0 )
                    {
                        $szRetVal .= "BCC: {$this->szBCC}" . PHP_EOL;
                    }
                }
            }
        }

        $this->szHeaders = $szRetVal;                               /* Save headers */
        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Email.buildHeaders() ================================================ */
    /* ================================================================================ */


    public function __toForm(): string
    /*------------------------------*/
    {
        $oForm                  = new Form();
        $oForm->szClass         = $this->szClass;

        $oForm->settings['withBR'] = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'Message';

            $oForm->add( $oFieldset );

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'From'                          ,
                                                   'type'           =>  'ema'                           ,
                                                   'label'          =>  'From'                          ,
                                                   'lang'           =>  'en'                            ,
                                                   'tooltip'        =>  'Mention your email address'    ,
                                                   'required'       =>  true                            ,
                                                   'delete'         =>  true                            ,
                                                   'help'           =>  false                           ,
                                                   'value'          =>  $this->szFromEmail              ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'To'                            ,
                                                   'type'           =>  'ema'                           ,
                                                   'label'          =>  'To'                            ,
                                                   'lang'           =>  'en'                            ,
                                                   'tooltip'        =>  'Recipient email address'       ,
                                                   'required'       =>  true                            ,
                                                   'delete'         =>  true                            ,
                                                   'help'           =>  false                           ,
                                                   'value'          =>  $this->szTo                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Subject'                       ,
                                                   'type'           =>  'txt'                           ,
                                                   'label'          =>  'Subject'                       ,
                                                   'lang'           =>  'en'                            ,
                                                   'tooltip'        =>  'Email subject'                 ,
                                                   'required'       =>  true                            ,
                                                   'delete'         =>  true                            ,
                                                   'help'           =>  false                           ,
                                                   'value'          =>  $this->szSubject                ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Message'                       ,
                                                   'type'           =>  'edt'                           ,
                                                   'label'          =>  'Message'                       ,
                                                   'class'          =>  'shadow'                        ,
                                                   'style'          =>  'vertical-align:top;'           ,
                                                   'lang'           =>  'en'                            ,
                                                   'tooltip'        =>  'Email main body'               ,
                                                   'required'       =>  true                            ,
                                                   'delete'         =>  true                            ,
                                                   'style'          =>  'resize:vertical;'              ,
                                                   'rows'           =>  8                               ,
                                                   'help'           =>  false                           ,
                                                   'value'          =>  $this->szBody                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                        ,
                                                   'type'           =>  'cmd'                           ,
                                                   'class'          =>  'shadow'                        ,
                                                   'lang'           =>  'en'                            ,
                                                   'value'          =>  'Send'                          ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

        }   /* Create a fieldset and add the field set to the form */

        return ( (string) $oForm );
    }   /* End of Email.__toForm() ==================================================== */
    /* ================================================================================ */


    public function __toHTML(): string
    /*------------------------------*/
    {
        return ( '' );
    }   /* End of Email.__toHTML() ==================================================== */
    /* ================================================================================ */

    public function __toString()
    /*------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of Email.__toString() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*isEmail( $szEmail[,$szRecord] )=

        Checks whether an email address exists

        {*params
            $szEmail            (string)        The email address to check
        *}

        {*return
            (array)     Associative array if method is successful; [c]null[/c]
                        otherwise.
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function isEmail( $szEmail, $szRecord = 'MX' )
    /*-----------------------------------------------*/
    {
        if ( is_array( $aParts = explode( '@',$szEmail ) ) && count( $aParts ) > 1 )
        {
            $szUser     = $aParts[0];
            $szDomain   = $aParts[1];

            return ( checkdnsrr( $szDomain,$szRecord ) );
        }   /*if ( is_array( $aParts = explode( '@',$szEmail ) ) && count( $aParts ) > 1 ) */

        return ( false );
    }   /* End of Email.isEmail() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*DNSRecord( $szDomain )=

        Return the DNS record of a domain

        {*params
            $szDomain       (string)        The domain to get the DNS Record of
        *}

        {*return
            (array)     Associative array if method is successful; [c]null[/c]
                        otherwise.
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function DNSRecord( $szDomain )
    /*---------------------------------*/
    {
        $aRetVal = dns_get_record( $szDomain,DNS_ANY );

        return (  is_array( $aRetVal ) ? $aRetVal : null );
    }   /* End of Email.DNSRecord() =================================================== */
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
    }   /* End of Email.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Email ============================================================= */
/* ==================================================================================== */
