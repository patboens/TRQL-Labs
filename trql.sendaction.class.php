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
    {*file                  trql.sendaction.class.php *}
    {*purpose               The act of physically/electronically dispatching an object
                            for transfer from an origin to a destination.Related
                            actions:ReceiveAction: The reciprocal of
                            SendAction.GiveAction: Unlike GiveAction, SendAction does
                            not imply the transfer of ownership (e.g. I can send you my
                            laptop, but I'm not necessarily giving it to you). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              action *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\sendaction;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\transferaction\TransferAction    as TransferAction;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TRANSFERACTION_CLASS_VERSION' ) )
    require_once( 'trql.transferaction.class.php' );



defined( 'SENDACTION_CLASS_VERSION' ) or define( 'SENDACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SendAction=

    {*desc

        The act of physically/electronically dispatching an object for transfer
        from an origin to a destination.Related actions:ReceiveAction: The
        reciprocal of SendAction.GiveAction: Unlike GiveAction, SendAction does not
        imply the transfer of ownership (e.g. I can send you my laptop, but I'm not
        necessarily giving it to you).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SendAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

    *}}

 */
/* ==================================================================================== */
class SendAction extends TransferAction
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $deliveryMethod                 = null;             /* {*property   $deliveryMethod     (DeliveryMethod)                                A sub property of instrument. The method of delivery. *} */
    public      $recipient                      = null;             /* {*property   $recipient          (ContactPoint|Organization|Audience|Person)     A sub property of participant. The participant who is at the receiving
                                                                                                                                                        end of the action. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId         (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of SendAction.__construct() ============================================ */
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
    }   /* End of SendAction.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class SendAction ======================================================== */
/* ==================================================================================== */
