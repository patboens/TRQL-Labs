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
    {*file                  trql.medicaltest.class.php *}
    {*purpose               Any medical test, typically performed for diagnostic
                            purposes. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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

    {*chist
        {*mdate 14-02-21 09:52 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\medicaltest;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\medicalentity\MedicalEntity   as MedicalEntity;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALENTITY_CLASS_VERSION' ) )
    require_once( 'trql.medicalentity.class.php' );

defined( 'MEDICALTEST_CLASS_VERSION' ) or define( 'MEDICALTEST_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalTest=

    {*desc

        Any medical test, typically performed for diagnostic purposes.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalTest[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class MedicalTest extends MedicalEntity
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $affectedBy                     = null;             /* {*property   $affectedBy                     (Drug)                          Drugs that affect the test's results. *} */
    public      $normalRange                    = null;             /* {*property   $normalRange                    (MedicalEnumeration|string)     Range of acceptable values for a typical patient, when applicable. *} */
    public      $signDetected                   = null;             /* {*property   $signDetected                   (MedicalSign)                   A sign detected by the test. *} */
    public      $usedToDiagnose                 = null;             /* {*property   $usedToDiagnose                 (MedicalCondition)              A condition the test is used to diagnose. *} */
    public      $usesDevice                     = null;             /* {*property   $usesDevice                     (MedicalDevice)                 Device used to perform the test. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q2671652';       /* {*property   $wikidataId                     (string)                        Wikidata ID. medical procedure performed to detect, diagnose, or 
                                                                                                                                                    monitor diseases, disease processes, susceptibility, or to 
                                                                                                                                                    determine a course of treatment *} */

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
    }   /* End of MedicalTest.__construct() =========================================== */
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
    }   /* End of MedicalTest.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class MedicalTest ======================================================= */
/* ==================================================================================== */
?>