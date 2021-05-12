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
    {*UTF-8                 Quel bel été *}

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
namespace trql\quitus;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\utility\Utility               as Utility;
use \trql\html\Form                     as Form;
use \trql\html\Fieldset                 as Fieldset;
use \trql\html\Formset                  as Formset;
use \trql\html\Input                    as Input;
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
    public      $iPort              = 25;                           /* {*property   $iPort                          (int)                   Connection port. [c]25[/c] by default. *} */
    public      $szMailType         = 'text/plain';                 /* {*property   $szMailType                     (string)                Mail format. '[c]text/plain[/c]' by default (can also be'[c]text/html)[/c]'.  *} */
    public      $szCharset          = 'UTF-8';                      /* {*property   $szCharset                      (string)                Character set. '[c]UTF-8[/c]' by default; *} */
    public      $szDomain           = null;                         /* {*property   $szDomain                       (string)                Domaine internet *} */
    public      $iPriority          = 3;                            /* {*property   $iPriority                      (int)                   Mail priority (1 = highest ... 5 = lowest). [c]3[/c] by default. *} */
    public      $szFromName         = null;                         /* {*property   $szFromName                     (string)                Sender name *} */
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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of Email.__construct() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*send()=

        Sends a mail

        {*params
        *}

        {*warning
            Cannot send attachments for the time being (22-03-21 07:42:20)
        *}

        {*return
            (int)       Returns an int corresponding to one of the return codes:[br][br]

                        [c]define( 'EMAIL_RET_CODES'               ,0  );[/c][br][br]

                        [c]define( 'EMAIL_RET_CODE_OK'             ,EMAIL_RET_CODES +   0 )[/c][br]
                        [c]define( 'EMAIL_RET_CODE_NO_RECIPIENT'   ,EMAIL_RET_CODES - 100 )[/c][br]
                        [c]define( 'EMAIL_RET_CODE_MAIL_NOT_SENT'  ,EMAIL_RET_CODES - 200 )[/c][br][br]
        *}

        {*example
            |** ============================= **|
            |** [b]EXAMPLE #1 : SIMPLE MAIL[/b]      **|
            |** ============================= **|
            use \trql\vaesoli\Vaesoli   as V;
            use \trql\quitus\Email      as Email;

            if ( ! defined( "VAESOLI_CLASS_VERSION ") )
                require_once( 'trql.vaesoli.class.php' );

            if ( ! defined( 'EMAIL_CLASS_VERSION' ) )
                require_once( 'trql.email.class.php' );

            if ( ! defined( 'EMAIL_RET_CODES' ) )
            {
                define( 'EMAIL_RET_CODES'               ,0  );

                define( 'EMAIL_RET_CODE_OK'             ,EMAIL_RET_CODES +   0 );
                define( 'EMAIL_RET_CODE_NO_RECIPIENT'   ,EMAIL_RET_CODES - 100 );
                define( 'EMAIL_RET_CODE_MAIL_NOT_SENT'  ,EMAIL_RET_CODES - 200 );
            }

            [b]$oEmail = new Email();

            $oEmail->szMailType     = 'text/html';
            $oEmail->szCharset      = 'UTF-8';
            $oEmail->szHost         = 'localhost';
            $oEmail->iPort          = 25;
            $oEmail->szFromName     = 'Beautiful Company';
            $oEmail->szDomain       = 'beautifulcompany.com';
            $oEmail->szFromEmail    = 'noreply@beautifulcompany.com';
            $oEmail->szFromName     = 'Email Robot';
            $oEmail->szTo           = 'friend@beautifulcompany.com';
            $oEmail->szSubject      = 'Hello';
            $oEmail->szBody         = '&lt;p&gt;Dear Fiend,&lt;/p&gt; &lt;p&gt;I just wanted to say 'Hello' to you.&lt;/p&gt; &lt;p&gt;Kind regards.&lt;/p&gt;';[/b]

            try
            {
                if ( [b]$oEmail->send() !== EMAIL_RET_CODE_OK[/b] )
                {
                    echo "&lt;p&gt;PROBLEM with {$oEmail-&gt;szTo}&lt;/p&gt;\n";
                }
            }
            catch ( exception $e)
            {
                echo 'Exception: ',  $e->getMessage(), "\n";
            }


            |** ============================= **|
            |** [b]EXAMPLE #2 : MAILSHOT EXAMPLE[/b] **|
            |** ============================= **|
            use \trql\vaesoli\Vaesoli   as V;
            use \trql\quitus\Email      as Email;

            if ( ! defined( "VAESOLI_CLASS_VERSION ") )
                require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

            if ( ! defined( 'EMAIL_CLASS_VERSION' ) )
                require_once( 'd:/websites/snippet-center/trql.email.class.php' );

            if ( ! defined( 'EMAIL_RET_CODES' ) )
            {
                define( 'EMAIL_RET_CODES'               ,0  );

                define( 'EMAIL_RET_CODE_OK'             ,EMAIL_RET_CODES +   0 );
                define( 'EMAIL_RET_CODE_NO_RECIPIENT'   ,EMAIL_RET_CODES - 100 );
                define( 'EMAIL_RET_CODE_MAIL_NOT_SENT'  ,EMAIL_RET_CODES - 200 );
            }

            |** The example depicted in here is working as follows

                1) We have a .hash file where all contacts are stored in the
                   /../databases/clean-up folder
                2) All contacts are maintained in the mailshot-easter.hash.normalized.hash
                   file and will be loaded in the aRecipients array which looks like this:

                   aRecipients is an array of elements such as:
                   '625b57c1437620d016b6612121e86b19' =>
                     array (size=10)
                       'lastname' => string 'Doe'
                       'firstname' => string 'John'
                       'address' => string 'Rue de Londres, 45'
                       'postalcode' => string '1000'
                       'city' => string 'Brussels'
                       'country' => string 'Belgiium'
                       'phone' => string '+32475112233'
                       'isMobilePhone' => boolean true
                       'phone_normalized' => string '+32475112233'
                       'email' => string 'john.doe@gmail.com' (length=20)

                3) We will send an email to each contact. The text of the email
                   is stored in a template : mailshot-easter-mail.txt

                4) For each contact, we will adapt the text of the template by
                   applying some substitutions

                5) We send the email

            **|

            |** mailshot-easter-mail.txt template content : SAMPLE

                [i]&lt;!DOCTYPE html&gt;
                &lt;html lang=&quot;en&quot;&gt;
                    &lt;head&gt;
                        &lt;meta http-equiv=&quot;content-type&quot; content=&quot;text/html; charset=utf-8&quot; /&gt;
                        &lt;title&gt;Easter Menu Take-away&lt;/title&gt;
                        &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1&quot; /&gt;
                        &lt;style type=&quot;text/css&quot;&gt;
                           body { background-color: rgba(119,73,50,.1);
                                  color: #6c4b45;
                                  width: 100%;
                                  margin: 0;
                                  padding: 0;
                                  font: 1em/1.5em verdana,arial,sans-serif; }
                           footer,#wrapper { width: 90%;
                                   margin: 0 auto;
                                   padding: 1em;
                                   background: #fff;
                                   font-size: .8em
                           }
                           footer { background-color: rgba(119,73,50,.1);
                                    color: #fff;
                                    font-size: .7em;
                           }
                           h1 { font: 1em/1.5em verdana,arial,sans-serif; }
                           blockquote { background-color: rgba(119,73,50,.2);
                               border: 1px solid #774932;
                               padding: 1.5em; }
                        &lt;/style&gt;
                    &lt;/head&gt;

                    &lt;body&gt;
                        &lt;div id=&quot;wrapper&quot;&gt;
                            &lt;p&gt;Dear %name()%,&lt;/p&gt;

                            &lt;p&gt;The &lt;strong&gt;Beautiful Restaurant's Easter Menu&lt;/strong&gt; is
                            available to order while waiting for the long
                            awaited official reopening of our restaurant&lt;/p&gt;

                            &lt;p&gt;Here is our &lt;a href=&quot;%url%&quot;&gt;Easter Menu&lt;/a&gt; so
                            that you can stay cheerful even during this
                            particularly difficult time&lt;/p&gt;

                            &lt;p&gt;Closing date for orders is 02/04/2021, 18:00 at +32 111 22 33 44. Pick up on
                            03/04/2021, from 14h to 18h.&lt;/p&gt;

                            &lt;p&gt;Thank you and see you soon. The Beautiful Restaurant team.&lt;/p&gt;

                            &lt;p class=&quot;center&quot;&gt;&lt;img
                            src=&quot;http://www.beautifulrestaurant.com/images/chef-very-small.jpg&quot;
                            width=&quot;123&quot; height=&quot;250&quot;
                            title=&quot;Here is The Chef!&quot; alt=&quot;The say of The Chef trumps anything else&quot; /&gt;&lt;/p&gt;

                            &lt;p&gt;NB: Please note that this email was sent to you
                            from an address that cannot receive a reply. Please
                            do not reply to this message.&lt;/p&gt;

                            &lt;p&gt;&lt;strong&gt;WARNING&lt;/strong&gt; : We respect your
                            privacy. We are particularly careful not to &quot;spam&quot;
                            you and we are very sorry if this was the case.
                            Therefore, if you do not wish to receive any more
                            emails from us, simply click on the following link
                            to let us know&amp;#160;: &lt;a
                            href=&quot;http://www.beautifulrestaurant.com/unregister.html?key
                            =%key%&quot;&gt;NO SPAM&lt;/a&gt;! Hope to see you soon.&lt;/p&gt;

                        &lt;/div&gt; &lt;!-- wrapper --&gt;

                        &lt;div id=&quot;tripadvisor&quot;&gt;
                            &lt;p&gt;Don't forget to leave us a comment on &lt;a
                            href=&quot;http://www.beautifulrestaurant.com/tripadvisor&quot;&gt;TripAdvisor&lt;/a&gt;. Thanks in advance.&lt;/p&gt;
                        &lt;/div&gt; &lt;!-- tripadvisor --&gt;

                        &lt;footer&gt;
                            &lt;a href=&quot;http://www.beautifulrestaurant.com/legal/&quot;
                               title=&quot;Terms of service&quot;&gt;&amp;copy; 2001 - %year()%
                               Beautiful Restaurant, all rights reserved&lt;/a&gt; &amp;#8212; Avenue Houba de Strooper 96,
                               1020 Bruxelles &amp;#8212 Phone : &lt;a href=&quot;tel:+32111223344&quot;&gt;+32 111 22 33 44&lt;/a&gt;
                               &amp;#8212; Fax : +32 2 123 45 67 &amp;#8212; Design by &lt;a href=&quot;tel:+32495526020&quot;&gt;Pat
                               Boens &amp;#8211 +32 495 52 60 20&lt;/a&gt; &amp;#8212;
                               Powered by  &lt;a href=&quot;http://www.quitus.be&quot;&gt;Quitus&lt;/a&gt;
                        &lt;/footer&gt;
                    &lt;/body&gt;
                &lt;/html&gt;[/i]

            **|


            [b]// Where data are located
            $szDir      = V::FIL_RealPath( V::FIL_ResolveRoot( '/../databases/clean-up' ) );
            // Where all email addresses are stored
            $szInput    = v::FIL_RealPath( $szDir  . '/mailshot-easter.hash.normalized.hash' );
            // The mail template
            $szTemplate = v::FIL_FileToStr( $szDir . '/mailshot-easter-mail.txt'  );
            // The Email object that will do the dirty work
            $oEmail     = new Email();
            // The list of Mails for which we experienced some problems
            $aProblems  = null;
            // An index
            $i          = 0;
            // Good emails
            $iGood      = 0;

            set_time_limit(0);

            // A var for the substitutions to perform
            $szURL      = 'http://www.beautifulrestaurant.com/special-menus/';

            // A set of substitutions to perform
            // Very suboptimal but it does the job
            $aSubstitutions = array( array( 'pattern'   => '%firstname%'    ,
                                            'field'     => 'firstname'      ,
                                          )                                 ,
                                     array( 'pattern'   => '%lastname%'     ,
                                            'field'     => 'lastname'       ,
                                          )                                 ,
                                     array( 'pattern'   => '%url%'          ,
                                            'value'     => $szURL           ,
                                          )                                 ,
                                     array( 'pattern'   => '%name()%'       ,
                                            'func'      => "name"           ,
                                          )                                 ,
                                     array( 'pattern'   => '%year()%'       ,
                                            'func'      => "year"           ,
                                          )                                 ,
                                   );

            // Get all people that ever registered with the Beautiful Restaurant
            if ( is_array( $aRecipients = @V::getHashFile( $szInput ) ) )
            {
                foreach( $aRecipients as $key => $aRecipient )
                {
                    $szBody = $szTemplate;
                    $szBody = str_replace( '%key%',$key,$szBody );

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
                            $szValue = ($aSubst['func'])($aRecipient);

                        $szBody = str_replace( $szPattern,$szValue,$szBody );
                    }

                    $oEmail->szMailType     = 'text/html';
                    $oEmail->szCharset      = 'UTF-8';
                    $oEmail->szHost         = 'localhost';
                    $oEmail->iPort          = 25;
                    $oEmail->szFromName     = 'Beautiful Restaurant';
                    $oEmail->szDomain       = 'beautifulrestaurant.com';
                    $oEmail->szFromEmail    = 'noreply@beautifulrestaurant.com';
                    $oEmail->szFromName     = 'Email Robot';
                    $oEmail->szTo           = 'friend@beautifulrestaurant.com';
                    $oEmail->szSubject      = 'Hello';
                    $oEmail->szBody         = $szBody;

                    echo htmlentities( $szBody ),"&lt;hr /&gt;";
                    ob_flush();
                    flush();

                    try
                    {
                        if ( $oEmail->send() === EMAIL_RET_CODE_OK )
                        {
                            ++$iGood;
                        }
                        else
                        {
                            $aProblems[] = $aRecipient;
                            echo "&lt;p&gt;PROBLEM with {$aRecipient['email']}&lt;/p&gt;\n";
                        }
                    }
                    catch ( exception $e)
                    {
                        $aProblems[] = $aRecipient;
                        echo "&lt;p&gt;PROBLEM with {$aRecipient['email']}&lt;/p&gt;\n";
                        echo 'Exception reçue : ', $e->getMessage(),"\n";
                    }
                }   |** foreach( $aRecipients as $key => $aRecipient ) **|
            }   |** if ( is_array( $aRecipients = @V::getHashFile( $szInput ) ) ) **|

            if ( ! is_null( $aProblems ) )
            {
                var_dump( count( $aProblems ) . ' problems found sending the mails',$aProblems );

                if ( @V::saveHashFile( $szOutput = v::FIL_RealPath( $szDir . '/mails.problems.hash' ),$aProblems ) )
                    var_dump( "PROBLEMS SAVED TO {$szOutput}" );
                else
                    var_dump( "PROBLEMS CANNOT BE SAVED TO {$szOutput}" );
            }

            echo "&lt;p&gt;End of the script&lt;/p&gt;";

            function name( $aRecipient )
            |** ---------------------- **|
            {
                return ( trim( trim( $aRecipient['firstname'] ) . ' ' . trim( $aRecipient['lastname'] ) ) );
            }

            function year( $aRecipient )
            |** ---------------------- **|
            {
                return ( date('Y') );
            }[/b]
        *}

        *}}
    */
    /* ================================================================================ */
    public function send() : int
    /*------------------------*/
    {
        $iRetVal = EMAIL_RET_CODE_OK;                               /* Return value of the method */

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
                $szCharset = 'UTF-8';
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

        $szHeaders  = $this->buildHeaders( $szFromEmail );
        //var_dump( $szHeaders );
        //var_dump( $this->szTo,$this->szCC,$this->szBCC );

        if ( mail( $this->szTo,$this->szSubject,$this->szBody,$szHeaders ) )
        {
            $iRetVal = EMAIL_RET_CODE_OK;
        }

        return ( $iRetVal );
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

        Checks whether an email address can supposedly exist (DNS check)

        {*params
            $szEmail            (string)        The email address to check
        *}

        {*warning
            Only the domain is checked for existence. If the email address is 
            valid on an existing domain, the method will return a [c]true[/c]
            even though the email address does not really exist.
        *}

        {*return
            (bool)      [c]true[/c] if email address exists (supposedly);
                        [c]false[/c] otherwise.
        *}

        {*example
        use \trql\quitus\Email as Email;

        if ( ! defined( 'EMAIL_CLASS_VERSION' ) )
            require_once( 'd:/websites/snippet-center/trql.email.class.php' );

        // The Email object that will do the dirty work
        $oEmail = new Email();

        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'john.doe@latosensu.be'        )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'john.doe@gmail.com'           )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'john.doe@microsoft.com'       )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'john.doe@latosensu.co.uk'     )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'completely wrong'             )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'pb@thisdomaindoesnotexist.be' )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'pb@trql.fm'                   )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        var_dump( ( [b]$oEmail->isEmail( $szEmail = 'pb@ls.co'                     )[/b] ? '"true"' : '"false"' ) . ' for "' . $szEmail . '"' );
        *}

        *}}
    */
    /* ================================================================================ */
    public function isEmail( $szEmail, $szRecord = 'MX' )
    /*-------------------------------------------------*/
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
