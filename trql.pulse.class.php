<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.pulse.class.php *}
    {*purpose               Multi-purpose notifications for TRQL promises *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 auto *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate auto *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 22-08-20 10:17 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adding Documentor-oriented comments
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\pulse;

use \trql\vaesoli\vaesoli                           as vaesoli;
use \trql\utility\Utility                           as Utility;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'PULSE_CLASS_VERSION' ) or define( 'PULSE_CLASS_VERSION','0.1' );


// ATTENTION, IL FAUT AUSSI CREER UN trql.pulse.trait.php ET METTRE
// CE TRAIT DANS MOTHER POUR QUE TOUTES LES CLASSES PUISSENT UTILISER
// LES QUELQUES FONCTIONS/METHODES GENERALISTES PREVUES DANS LE TRAIT

// EGALEMENT, DANS LE __destruct() de CHAQUE CLASSE, ON S'ASSURERA QUE
// LES PULSES LES PLUS AGES SOIENT DETRUITS MÊME S'ILS N'ONT PAS ÉTÉ
// PRIS EN COMPTE

// LE TRAITEMENT DES PULSES SE FERA AUSSI DANS CHAQUE CLASSE. ON VEILLERA
// A TRAITER LE JUSTE NOMBRE DE PULSES POUR NE PAS ETRE PÉNALISÉS POINT
// DE VUE PERFORMANCE !!! AUSSI S'INSPIRER DE CE QUI AVAIT ETE FAIT DANS
// LE CARDIO !!!

/* ================================================================================== */
/** {{*class Pulse=

    {*desc

        Multi-purpose notifications for TRQL promises

    *}

    *}}
 */
/* ================================================================================== */
class Pulse extends Utility
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public  $szHome         = __DIR__;

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
    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->die( "THIS CLASS IS NOT FUNCTIONAL AT ALL" );

        return ( $this );
    }   /* End of Pulse.__construct() ================================================= */
    /* ================================================================================ */


    public function home()
    /*------------------*/
    {
        return ( $this->szHome );
    }   /* End of Pulse.home() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
    }   /* End of Pulse.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class Pulse ============================================================= */
/* ==================================================================================== */
?>