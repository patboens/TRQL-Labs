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

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ADVERTIZING_CLASS_VERSION' ) )
    require_once( 'trql.advertizing.class.php' );

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

    public function send( $aRecipients )
    /*--------------------------------*/
    {
        // Il faut que je sache QUOI envoyer et à QUI
        foreach( $aRecipients as $aRecipient )
        {
            
        }
        
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
