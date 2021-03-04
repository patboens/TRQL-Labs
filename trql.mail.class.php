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
    {*file                  trql.mail.class.php *}
    {*purpose               Mail Service *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08-09-20 10:55 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 08-09-20 10:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\mail;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\message\Message           as Message;
use \trql\mother\iAPI               as iAPI;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MESSAGE_CLASS_VERSION' ) )
    require_once( 'trql.message.class.php' );


defined( 'MAIL_CLASS_VERSION' ) or define( 'MAIL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Mail=

    {*desc

        Sned Mail Service; data structure

    *}

    {*warning
        This class is NOT WORKING YET
    *}

    {*todo
        [ol]
            [li]Copy/Paste of LSQMail[/li]
            [li]Work with attachments[/li]
            [li]Read email[/li]
        [/ol]
    *}

 */
/* ==================================================================================== */
//class SMS extends Message implements iAPI
class Mail extends Message
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q9158';          /* Notion of email: method of exchanging digital messages between people over a network */


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

        $this->die( __CLASS__ . ' DOES NOT WORK yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of Mail.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*send( $szMsg[,$szTo[,$szCC[,$szBCC[,$iPriority]]]] )=

        Sends an email

        {*params
            $szMsg      (string)            Message to send
            $szTo       (string|Person)     Recipient email address or Person (with email
                                            address property filled). Optional.
            $szCC       (string|Person)     The email address of the recipient copied 
                                            on a message or Person (with email
                                            address property filled). Optional.
            $szBCC      (string|Person)     The email address of the recipient blind 
                                            copied on a message or Person (with email
                                            address property filled). Optional.
            $iPriority  (integer)           The priority of the email to send.

        *}

        {*return
            (boolean)       [c]true[/c] if message sent successfully; [c]false[/c]
                            otherwise.
        *}

        {*warning
        
            This method does NOT DO ANYTHING yet

        *}

        *}}
    */
    /* ================================================================================ */
    public function send( $szMsg,$szTo = null,$szCC = null,$szBCC = null,$iPriority = 1 )
    /*---------------------------------------------------------------------------------*/
    {
        $bRetVal = false;
        return ( $bRetVal );
    }   /* End of Mail.send() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAPIKey()=

        Class constructor

        {*params
        *}

        {*return
            (self)      The current instance of the class
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
    }   /* End of Mail.getAPIKey() ==================================================== */
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
    }   /* End of Mail.__destruct() =================================================== */
    /* ================================================================================ */

}   /* End of class Mail ============================================================== */
/* ==================================================================================== */
?>