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
    {*file                  trql.communicateaction.class.php *}
    {*purpose               The act of conveying information to another person via a 
                            communication medium (instrument) such as speech, email, 
                            or telephone conversation. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-08-2020 13:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-08-2020 13:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schema\action;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\action\InteractAction     as InteractAction;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTERACTACTION_CLASS_VERSION' ) )
    require_once( 'trql.interactaction.class.php' );

defined( 'COMMUNICATEACTION_CLASS_VERSION' ) or define( 'COMMUNICATEACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CommunicateAction=

    {*desc

        The act of conveying information to another person via a communication medium 
        (instrument) such as speech, email, or telephone conversation.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CommunicateAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 25-08-2020 13:41.
    *}

 */
/* ==================================================================================== */
class CommunicateAction extends InteractAction
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $about                          = null;             /* {*property   $about                          (Thing)                                         The subject matter of the content. *} */
    public      $inLanguage                     = null;             /* {*property   $inLanguage                     (Language|string)                               The language of the content or performance or used in an action.
                                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                                    See also availableLanguage. *} */
    public      $recipient                      = null;             /* {*property   $recipient                      (Audience|ContactPoint|Organization|Person)     A sub property of participant. The participant who is at the receiving
                                                                                                                                                                    end of the action. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                                        Wikidata ID: No equivalent. *} */


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
    }   /* End of CommunicateAction.__construct() ===================================== */
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
    }   /* End of CommunicateAction.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class CommunicateAction ================================================= */
/* ==================================================================================== */
