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
    {*file                  trql.vein.class.php *}
    {*purpose               A type of blood vessel that specifically carries blood to
                            the heart. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\vein;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\vessel\Vessel     as Vessel;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'VESSEL_CLASS_VERSION' ) )
    require_once( 'trql.vessel.class.php' );

defined( 'VEIN_CLASS_VERSION' ) or define( 'VEIN_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Vein=

    {*desc

        A type of blood vessel that specifically carries blood to the heart.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Vein[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class Vein extends Vessel
/*---------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $drainsTo                       = null;             /* {*property   $drainsTo                       (Vessel)                        The vasculature that the vein drains into. *} */
    public      $regionDrained                  = null;             /* {*property   $regionDrained                  (AnatomicalStructure|AnatomicalSystem)The anatomical or organ system drained by this vessel; generally
                                                                                                                                                    refers to a specific part of an organ. *} */
    public      $tributary                      = null;             /* {*property   $tributary                      (AnatomicalStructure)           The anatomical or organ system that the vein flows into; a larger
                                                                                                                                                    structure that the vein connects to. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q9609';          /* {*property   $wikidataId                     (string)                        Wikidata ID. Blood vessel that carry deoxygenated blood towards 
                                                                                                                                                    the heart, with the exception of the pulmonary vein. *} */


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
    }   /* End of Vein.__construct() ================================================== */
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
    }   /* End of Vein.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Vein ============================================================== */
/* ==================================================================================== */
?>