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
    {*file                  trql.checkinaction.class.php *}
    {*purpose               The act of an agent communicating (service provider, social
                            media, etc) their arrival by registering/confirming for a
                            previously reserved service (e.g. flight check in) or at a
                            place (e.g. hotel), possibly resulting in a result (boarding
                            pass, etc).Related actions:CheckOutAction: The antonym of
                            CheckInAction.ArriveAction: Unlike ArriveAction,
                            CheckInAction implies that the agent is informing/confirming
                            the start of a previously reserved service.ConfirmAction:
                            Unlike ConfirmAction, CheckInAction implies that the agent
                            is informing/confirming the start of a previously reserved
                            service rather than its validity/existence. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              action *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:40 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\checkinaction;

use \trql\vaesoli\Vaesoli                       as Vaesoli;
use \trql\communicateaction\CommunicateAction   as CommunicateAction;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'COMMUNICATEACTION_CLASS_VERSION' ) )
    require_once( 'trql.communicateaction.class.php' );

defined( 'CHECKINACTION_CLASS_VERSION' ) or define( 'CHECKINACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CheckInAction=

    {*desc

        The act of an agent communicating (service provider, social media, etc)
        their arrival by registering/confirming for a previously reserved service
        (e.g. flight check in) or at a place (e.g. hotel), possibly resulting in a
        result (boarding pass, etc).Related actions:CheckOutAction: The antonym of
        CheckInAction.ArriveAction: Unlike ArriveAction, CheckInAction implies that
        the agent is informing/confirming the start of a previously reserved
        service.ConfirmAction: Unlike ConfirmAction, CheckInAction implies that the
        agent is informing/confirming the start of a previously reserved service
        rather than its validity/existence.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CheckInAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:40.
    *}

    *}}

 */
/* ==================================================================================== */
class CheckInAction extends CommunicateAction
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,                                                                                           
                               'name'   => null         ,                                                                                           
                               'birth'  => null         ,                                                                                           
                               'home'   => null         ,                                                                                           
                               'family' => null         ,                                                                                           
                               'UIKey'  => null         ,                                                                                           
                             );                                                                                                                     
                                                                                                                                                    
    public      $about                          = null;             /* {*property   $about          (Thing)                                         The subject matter of the content. *} */
    public      $inLanguage                     = null;             /* {*property   $inLanguage     (string|Language)                               The language of the content or performance or used in an action.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also availableLanguage. *} */
    public      $recipient                      = null;             /* {*property   $recipient      (ContactPoint|Organization|Audience|Person)     A sub property of participant. The participant who is at the receiving
                                                                                                                                                    end of the action. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId     (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of CheckInAction.__construct() ========================================= */
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
    }   /* End of CheckInAction.__destruct() ========================================== */
    /* ================================================================================ */
}   /* End of class CheckInAction ===================================================== */
/* ==================================================================================== */
