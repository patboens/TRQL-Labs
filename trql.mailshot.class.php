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

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ADVERTIZING_CLASS_VERSION' ) )
    require_once( 'trql.advertizing.class.php' );

if ( ! defined( 'EMAIL_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.email.class.php' );

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of Mailshot.__construct() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /* ================================================================================ */
    /** {{*send( $aRecipients,$aSlots,$szTemplate,$aSubstitutions,$szMailshotType = 'M' )=

        Send mass mailing OR Short Text Messages

        {*params
            $aRecipients    (array)     Associative array. For emails all email
                                        addresses must be provided in the
                                        @param.aRecipients['email'] slot; For SMS all
                                        phone numbers MUST be provided in the
                                        @param.aRecipients['phone'] slot and MUST be
                                        capable of receiving SMS.
            $aSlots         (array)     [c]array( 'mail'   => 'email'  ,[br]
                                                  'sms'    => 'phone'  ,[br]
                                             )[/c][br]
            $szTemplate     (string)    The template to use for the mass sending.
            $aSubstitutions (array)     TO BE DEFINED
            $szMailshotType (string)    '[c]M[/c]' for mass mailing (default)[br]
                                        '[c]S[/c]' for mass ShortText Messages;[br]
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
    public function send( $aRecipients,$aSlots,$szTemplate,$aSubstitutions,$szMailshotType = 'M' )
    /*------------------------------------------------------------------------------------------*/
    {
        $iCount = 0;
        $aProblems = null;

        $szMailshotType = strtoupper( trim( substr( $szMailshotType,0,1 ) ) );

        // If invalid type ... consider this to be Mass Mailing (emails)
        if ( $szMailshotType !== 'M' && $szMailshotType !== 'S' )
            $szMailshotType = 'M';

        $szTheSlot = ( $szMailshotType === 'S' ? 'sms' : 'mail' );
        var_dump( $szTheSlot );

        //if ( $szMailshotType === 'M' )
        //{
        //    $oEmail = new Email();
        //
        //    $oEmail->szMailType     = 'text/html';
        //    $oEmail->szCharset      = 'UTF-8';
        //    $oEmail->szHost         = 'localhost';
        //    $oEmail->szHost         = 'relay.skynet.be';
        //    $oEmail->szHost         = 'localhost';
        //    $oEmail->iPort          = 25;
        //    $oEmail->szFromName     = 'Divin Caprice';
        //    $oEmail->szDomain       = 'divincaprice.be';
        //    $oEmail->szFromEmail    = 'noreply@divincaprice.be';
        //    $oEmail->szFromName     = 'TRQL Quitus';
        //    $oEmail->szTo           = 'info@divincaprice.be';
        //    $oEmail->szTo           = 'pb@trql.fm,info@divincaprice.be';
        //    $oEmail->szTo           = 'pb@trql.fm';
        //    $oEmail->szTo           = 'jessica.hendrickx@hotmail.fr,pb@trql.fm,info@divincaprice.be';
        //    $oEmail->szTo           = 'pb@trql.fm';
        //    $oEmail->szTo           = 'pb@trql.fm,info@divincaprice.be';
        //    $oEmail->szCC           = 'pb@trql.fm';
        //    //$oEmail->szTo           = 'pb@trql.fm';
        //    $oEmail->szSubject      = utf8_decode( 'Take-Away Pâques' );
        //    $oEmail->szSubject      = 'Menu Take-Away de Pâques';
        //}

        $i = 0;

        foreach( $aRecipients as $key => $aRecipient )
        {
            // If the "field" we're looking for (either 'mail' or 
            // 'sms') does not exist in the $aSlots array, there
            // is no way for us to determine which field in 
            // $aRecipients we're looking for ... continue
            // looping
            if ( is_null( $aSlots[ $szTheSlot ] ?? null ) )
                continue;

            //if ( ++$i <= 480 )
            //    continue;

            //if ( $i > 480 )
            //    break;

            //$szBody = $szTemplate;
            //$szBody = str_replace( '%key%',$key,$szBody );

            //foreach( $aSubstitutions as $aSubst )
            //{
            //    $szPattern  = $aSubst['pattern'];
            //    $szValue    = '';
            //
            //    if     ( ! empty( $aSubst['field'] ) )
            //    {   $szField = $aSubst['field'];
            //        $szValue = $aRecipient[$szField];
            //    }
            //    elseif ( ! empty( $aSubst['value'] ) )
            //        $szValue = $aSubst['value'];
            //    elseif ( ! empty( $aSubst['func'] ) )
            //        $szValue = ($aSubst['func'])( $szPattern,$aRecipient );
            //
            //    $szBody = str_replace( $szPattern,$szValue,$szBody );
            //}

            $szMail     = $aRecipient[ $aSlots['mail'] ];
            $szPhone    = $aRecipient[ $aSlots['sms'] ];

            var_dump( $key,$szMail,$szPhone );
            //echo htmlentities( $szBody );

            //$oEmail->szTo = $szMail;

            if ( $szMailshotType === 'M' && $szMail !== 'bresson.72@gmail.com' && $i > 97 )
            {
                $oEmail->szBody = $szBody;

                //try 
                //{
                //    // Parfois j'obtiens ... Warning: mail(): SMTP server response: 452 Too many recipients received this hour in D:\websites\snippet-center\trql.email.class.php on line 569
                //    if ( $oEmail->send() !== EMAIL_RET_CODE_OK )
                //    {
                //        $aProblems[] = $aRecipient;
                //        echo "<p>PROBLEM with {$aRecipient['email']}</p>\n";
                //    }
                //    else
                //    {
                //        $iCount++;
                //    }
                //}
                //catch ( exception $e)
                //{
                //    $aProblems[] = $aRecipient;
                //    echo "<p>PROBLEM with {$aRecipient['email']}</p>\n";
                //    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                //}
            }

            var_dump( "Mail #" . $i );
            echo "<hr />";
            ob_flush();
            flush();

            //usleep( mt_rand( 30000,3000000 ) );

            //break;
        }

        //if ( ! is_null( $aProblems ) )
        //{
        //    var_dump( count( $aProblems ) . ' problems found sending the mails',$aProblems );
        //
        //    if ( @V::saveHashFile( $szOutput = v::FIL_RealPath( $szDir . '/mail.problems.hash' ),$aProblems ) )
        //        var_dump( "PROBLEMS SAVED TO {$szOutput}" );
        //    else
        //        var_dump( "PROBLEMS CANNOT BE SAVED TO {$szOutput}" );
        //}

        return ( $iCount );
    }   /* End of Mailshot.send() ===================================================== */
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
