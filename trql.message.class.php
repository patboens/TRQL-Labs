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
    {*file                  trql.message.class.php *}
    {*purpose               A single message from a sender to one or more organizations
                            or people. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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


    *}}} */
/****************************************************************************************/
namespace trql\message;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\CreativeWork    as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'MESSAGE_CLASS_VERSION' ) or define( 'MESSAGE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Message=

    {*desc

        A single message from a sender to one or more organizations or people.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Message[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class Message extends CreativeWork
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $bccRecipient                   = null;             /* {*property   $bccRecipient                   (ContactPoint|Organization|Person)              A sub property of recipient. The recipient blind copied on a message. *} */
    public      $ccRecipient                    = null;             /* {*property   $ccRecipient                    (Person|ContactPoint|Organization)              A sub property of recipient. The recipient copied on a message. *} */
    public      $dateRead                       = null;             /* {*property   $dateRead                       (DateTime|Date)                                 The date/time at which the message has been read by the recipient if a
                                                                                                                                                                    single recipient exists. *} */
    public      $dateReceived                   = null;             /* {*property   $dateReceived                   (DateTime)                                      The date/time the message was received if a single recipient exists. *} */
    public      $dateSent                       = null;             /* {*property   $dateSent                       (DateTime)                                      The date/time at which the message was sent. *} */
    public      $messageAttachment              = null;             /* {*property   $messageAttachment              (CreativeWork)                                  A CreativeWork attached to the message. *} */
    public      $recipient                      = null;             /* {*property   $recipient                      (ContactPoint|Organization|Audience|Person)     A sub property of participant. The participant who is at the receiving
                                                                                                                                                                    end of the action. *} */
    public      $sender                         = null;             /* {*property   $sender                         (Person|Organization|Audience)                  A sub property of participant. The participant who is at the sending
                                                                                                                                                                    end of the action. *} */
    public      $toRecipient                    = null;             /* {*property   $toRecipient                    (Person|Audience|Organization|ContactPoint)     A sub property of recipient. The recipient who was directly sent the
                                                                                                                                                                    message. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q628523';


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
    }   /* End of Message.__construct() =============================================== */
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
    }   /* End of Message.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class Message =========================================================== */
/* ==================================================================================== */

?>