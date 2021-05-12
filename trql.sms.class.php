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
    {*file                  trql.sms.class.php *}
    {*purpose               Short Message Service *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-09-20 00:15 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 06-09-20 00:15 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\schema\Message    as Message;
use \trql\mother\iAPI       as APIInterface;
use \trql\html\Form         as Form;
use \trql\html\Fieldset     as Fieldset;
use \trql\html\Input        as Input;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MESSAGE_CLASS_VERSION' ) )
    require_once( 'trql.message.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'EMAIL_RET_CODES' ) )                               /* If email return codes NOT defined */
{
    define( 'EMAIL_RET_CODES'               ,0  );

    define( 'EMAIL_RET_CODE_OK'             ,EMAIL_RET_CODES +   0          );
    define( 'EMAIL_RET_CODE_NO_RECIPIENT'   ,EMAIL_RET_CODES - 100          );
    define( 'EMAIL_RET_CODE_MAIL_NOT_SENT'  ,EMAIL_RET_CODES - 200          );

    define( 'SMS_RET_CODE_OK'               ,EMAIL_RET_CODE_OK              );
    define( 'SMS_RET_CODE_NO_RECIPIENT'     ,EMAIL_RET_CODE_NO_RECIPIENT    );
    define( 'SMS_RET_CODE_MAIL_NOT_SENT'    ,EMAIL_RET_CODE_MAIL_NOT_SENT   );
    define( 'SMS_RET_CODE_NO_MESSAGE'       ,SMS_RET_CODE_MAIL_NOT_SENT - 1 );
}

defined( 'SMS_CLASS_VERSION' ) or define( 'SMS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SMS=

    {*desc

        Short Message Service

    *}

    {*remark
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
//class SMS extends Message implements APIInterface
class SMS extends Message
/*---------------------*/
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
    public      $wikidataId             = 'Q43024';                 /* {*property   $wikidataId                     (string)            Wikidata ID. Short Message Service ... Text messaging
                                                                                                                                        service component *} */
    public      $szClass                = 'sms';                    /* {*property   $szClass                        (string)            CSS class of the task when it needs to be rendered *} */

    public      $message                = null;                     /* {*property   $message                        (string)            [doc]https://www.wikidata.org/wiki/Q628523[/doc][br]
                                                                                                                                        Discrete unit of communication intended by the source for
                                                                                                                                        consumption by some recipient or group of recipients *} */
    public      $phoneNumber            = null;                     /* {*property   $phoneNumber                    (string)            [doc]https://www.wikidata.org/wiki/Property:P1329[/doc][br]
                                                                                                                                        telephone number in standard format (RFC3966), without
                                                                                                                                        'tel:' prefix *} */


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
    }   /* End of SMS.__construct() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*send( $szMsg,$xPhone[,$szFrom] )=

        Sends an SMS via Esendex

        {*params
            $szMsg      (string)            Message to send
            $xPhone     (string|array)      Phone number or array of phone numbers
            $szFrom     (string)            Phone number sending the message. Optional.
        *}

        {*return
            (boolean)       [c]true[/c] if message sent successfully; [c]false[/c]
                            otherwise.
        *}

        {*doc
            Official documentation of Esendex

            [url]https://developers.esendex.com/api-reference#inbox[/url]
        *}

        {*example
            use \trql\vaesoli\Vaesoli   as Vaesoli;
            use trql\quitus\SMS         as SMS;

            if ( ! defined( 'SMS_CLASS_VERSION' ) )
                require_once( vaesoli::FIL_ResolveRoot( '/snippet-center/trql.sms.class.php' ) );

            $oSMS = new SMS();

            if ( $oSMS->send( 'Test SMS','+32495526020' ) )
                var_dump( "TRUE: ALL OK" );

            var_dump( $oSMS );
            die( 'I STOP HERE' );
        *}

        *}}
    */
    /* ================================================================================ */
    public function send( $szMsg,$xPhone,$szFrom = '32495526020' ) : bool
    /*-----------------------------------------------------------------*/
    {
        $bRetVal = false;

        /*  Examples
            ========

            FROM: http://developers.esendex.com/APIs/REST-API/messagedispatcher

            <?xml version='1.0' encoding='UTF-8'?>
            <messages>
             <accountreference>EX0000000</accountreference>
             <message>
              <to>447700900123</to>
              <body>Every message matters!</body>
             </message>
            </messages>



            <?xml version='1.0' encoding='UTF-8'?>
            <messages>
             <accountreference>EX0000000</accountreference>
             <message>
              <from>07700900654</from>
              <to>07700900123</to>
              <type>SMS</type>
              <body>This is an SMS message</body>
             </message>
            </messages>



            <?xml version='1.0' encoding='UTF-8'?>
            <messages>
             <accountreference>EX0000000</accountreference>
             <sendat>2012-01-01T14:31:00</sendat>
             <message>
              <to>07700900123</to>
              <type>SMS</type>
              <body>This is an SMS message </body>
             </message>
            </messages>


            <?xml version='1.0' encoding='UTF-8'?>
            <messages>
             <accountreference>EX0000000</accountreference>
             <from>07700900654</from>
             <message>
              <to>07700900123</to>
              <type>SMS</type>
              <body>Hello Mr Sands.</body>
             </message>
             <message>
              <to>07700900124</to>
              <type>SMS</type>
              <body>Hello Mr Mayo.</body>
             </message>
            </messages>


            <?xml version='1.0' encoding='UTF-8'?>
            <messages>
             <accountreference>EX0000000</accountreference>
             <message>
              <to>0123456789</to>
              <type>Voice</type>
              <body>This is a Voice message</body>
              <lang>en-GB</lang>
              <retries>3</retries>
             </message>
            </messages>


            <?xml version='1.0' encoding='UTF-8'?>
            <messages>
             <accountreference>EX0000000</accountreference>
             <characterset>Auto</characterset>
             <message>
              <type>SMS</type>
              <body>This is an SMS message</body>
              <characterset>GSM</characterset>
             </message>
             <message>
              <type>SMS</type>
              <body>This is an SMS message</body>
              <characterset>Unicode</characterset>
             </message>
             <message>
              <type>SMS</type>
              <body>This is an SMS message</body>
             </message>
            </messages>

        */

        $szMsg = substr( $szMsg,0,160 );

        if ( is_string( $xPhone ) )
        {
            $szMessages = '<message>'                       .
                              "<to>{$xPhone}</to>"          .
                              '<type>SMS</type>'            .
                              "<body>{$szMsg}</body>"       .
                          '</message>';
        }
        elseif ( is_array( $xPhone ) )
        {
            $szMessages = '';
            foreach( $xPhone as $szPhone )
            {
                $szMessages .= '<message>'                      .
                                   "<to>{$szPhone}</to>"        .
                                   '<type>SMS</type>'           .
                                   "<body>{$szMsg}</body>"      .
                               "</message>\n";
            }
        }
        else
        {
            // Throw exception
        }

        $szData = '<?xml version="1.0" encoding="UTF-8"?>'                  .
                  '<messages>'                                              .
                      '<accountreference>EX0155310</accountreference>'      .
                      '<from>' . $szFrom . '</from>'                        .
                      $szMessages                                           .
                  '</messages>';

        if ( true )
        {
            //echo "<p>TRY TO SEND SMS</p>";
            try
            {
                $ch = curl_init();

                curl_setopt( $ch,CURLOPT_URL,$szURL = "https://api.esendex.com/v1.0/messagedispatcher" );

                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false );
                curl_setopt( $ch,CURLOPT_POST,true );


                /*  How passwords are formed : trql.sms.passwords.txt 
                    Pat ... read it when you need to change your authentication
                    mechanism
                */

                $szAPIKey = $this->getAPIKey();
                //var_dump( $szAPIKey );

                curl_setopt( $ch,CURLOPT_HTTPHEADER,array( "Authorization: Basic {$szAPIKey}" ) );
                curl_setopt( $ch,CURLOPT_POSTFIELDS,$szData );

                curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true );

                if ( ( $xResult = curl_exec( $ch ) ) === false )
                {
                    echo curl_error( $ch );
                }
                else
                {
                    //echo "<p>SMS successful</p>";
                    var_dump( $xResult );
                    $bRetVal = ! vaesoli::STR_StartWith( $xResult,'4' );
                    // Ici ... j'obtiens un 403 !!!
                    // Uncomment pour voir le résultat qu'on reçoit (par exemple, j'avais
                    // trouvé que je recevais qqch comme "403" ... ce qui indique une erreur!!!
                    // echo htmlentities( $xResult );
                }
            }
            catch ( Exception $e )
            {
                echo $e->getMessage();
            }

            if ( $ch )
            {
                curl_close( $ch );
            }
        }

        return ( $bRetVal );
    }   /* End of SMS.send() ========================================================== */
    /* ================================================================================ */


    public function sendEx(...$params ) : int
    /*-------------------------------------*/
    {
        $iRetVal = EMAIL_RET_CODE_OK;                               /* Return value of the method */

        if ( empty( $this->phoneNumber ) )                          /* If no recipient */
            return ( SMS_RET_CODE_NO_RECIPIENT );                   /* Return error */

        if ( empty( $this->message ) )                              /* If no body */
            return ( SMS_RET_CODE_MAIL_NOT_SENT );                  /* Return error */

        if ( $this->send( $this->message,$this->phoneNumber ) )
            $iRetVal = EMAIL_RET_CODE_OK;

        return ( $iRetVal );
    }   /* End of SMS.send() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAPIKey()=

        Get the API Key to send SMS

        {*params
        *}

        {*return
            (string)        The API Key or [c]null[/c] if not found
        *}

        *}}
    */
    /* ================================================================================ */
    private function getAPIKey()
    /*------------------------*/
    {
        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->szHome . '/api.key.txt' ) ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of SMS.getAPIKey() ===================================================== */
    /* ================================================================================ */


    public function __toForm(): string
    /*------------------------------*/
    {
        $szRetVal = '';

        $oForm                      = new Form();
        $oForm->szClass             = $this->szClass;

        $oForm->settings['withBR']  = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'Short Message';

            $oForm->add( $oFieldset );

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'To'                                            ,
                                                   'type'           =>  'phone'                                         ,
                                                   'label'          =>  'Phone'                                         ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter the recipient phone number'              ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->phoneNumber                              ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Message'                                       ,
                                                   'type'           =>  'edt'                                           ,
                                                   'label'          =>  'Message'                                       ,
                                                   'lang'           =>  'en'                                            ,
                                                   'style'          =>  'resize:vertical;'                              ,
                                                   'tooltip'        =>  'Body of the message to send (160 char max)'    ,
                                                   'maxlength'      =>  160                                             ,
                                                   'rows'           =>  4                                               ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'style'          =>  'resize:vertical;'                              ,
                                                   'value'          =>  $this->description                              ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                        ,
                                                   'type'           =>  'cmd'                                           ,
                                                   'class'          =>  'shadow'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Click to send the SMS'                         ,
                                                   'value'          =>  'Send'                                          ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

        }   /* Create a fieldset and add the field set to the form */

        return ( (string) $oForm );
    }   /* End of Task.__toForm() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szVar )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
        *}

        {*return
            (mixed)     The value of [c]@param.szVar[/c] or throwing an exception if
                        [c]@param.szVar[/c] NOT found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szVar )
    /*---------------------------*/
    {
        switch ( $szVar )
        {
            case 'szTo'         :
            case 'To'           :
            case 'to'           :   return ( $this->phoneNumber );
            case 'szBody'       :   return ( $this->message );
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": {$szVar} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */
    }   /* End of SMS.__get() ========================================================= */
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
            case 'szTo'         :
            case 'To'           :
            case 'to'           :   $this->phoneNumber  = $x;
                                    break;
            case 'szBody'       :   $this->message      = $x;
                                    break;
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */

        return ( $this );
    }   /* End of SMS.__set() ========================================================= */
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
    }   /* End of SMS.__destruct() ==================================================== */
    /* ================================================================================ */
}   /* End of class SMS =============================================================== */
/* ==================================================================================== */
