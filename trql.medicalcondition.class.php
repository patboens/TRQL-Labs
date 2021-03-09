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
    {*file                  trql.medicalcondition.class.php *}
    {*purpose               Any condition of the human body that affects the normal
                            functioning of a person, whether physically or mentally.
                            Includes diseases, injuries, disabilities, disorders,
                            syndromes, etc. *}
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
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct()[/c] method
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\medicalcondition;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\medicalentity\MedicalEntity   as MedicalEntity;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALENTITY_CLASS_VERSION' ) )
    require_once( 'trql.medicalentity.class.php' );

defined( 'MEDICALCONDITION_CLASS_VERSION' ) or define( 'MEDICALCONDITION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalCondition=

    {*desc

        Any condition of the human body that affects the normal functioning of a
        person, whether physically or mentally. Includes diseases, injuries,
        disabilities, disorders, syndromes, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalCondition[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}

 */
/* ==================================================================================== */
class MedicalCondition extends MedicalEntity
/*----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $associatedAnatomy              = null;             /* {*property   $associatedAnatomy              (SuperficialAnatomy|AnatomicalStructure|AnatomicalSystem)The anatomy of the underlying organ system or structures associated
                                                                                                                                                    with this entity. *} */
    public      $differentialDiagnosis          = null;             /* {*property   $differentialDiagnosis          (DDxElement)                    One of a set of differential diagnoses for the condition.
                                                                                                                                                    Specifically, a closely-related or competing diagnosis typically
                                                                                                                                                    considered later in the cognitive process whereby this medical
                                                                                                                                                    condition is distinguished from others most likely responsible for a
                                                                                                                                                    similar collection of signs and symptoms to reach the most
                                                                                                                                                    parsimonious diagnosis or diagnoses in a patient. *} */
    public      $drug                           = null;             /* {*property   $drug                           (Drug)                          Specifying a drug or medicine used in a medication procedure *} */
    public      $epidemiology                   = null;             /* {*property   $epidemiology                   (string)                        The characteristics of associated patients, such as age, gender, race
                                                                                                                                                    etc. *} */
    public      $expectedPrognosis              = null;             /* {*property   $expectedPrognosis              (string)                        The likely outcome in either the short term or long term of the
                                                                                                                                                    medical condition. *} */
    public      $naturalProgression             = null;             /* {*property   $naturalProgression             (string)                        The expected progression of the condition if it is not treated and
                                                                                                                                                    allowed to progress naturally. *} */
    public      $pathophysiology                = null;             /* {*property   $pathophysiology                (string)                        Changes in the normal mechanical, physical, and biochemical functions
                                                                                                                                                    that are associated with this activity or condition. *} */
    public      $possibleComplication           = null;             /* {*property   $possibleComplication           (string)                        A possible unexpected and unfavorable evolution of a medical
                                                                                                                                                    condition. Complications may include worsening of the signs or
                                                                                                                                                    symptoms of the disease, extension of the condition to other organ
                                                                                                                                                    systems, etc. *} */
    public      $possibleTreatment              = null;             /* {*property   $possibleTreatment              (MedicalTherapy)                A possible treatment to address this condition, sign or symptom. *} */
    public      $primaryPrevention              = null;             /* {*property   $primaryPrevention              (MedicalTherapy)                A preventative therapy used to prevent an initial occurrence of the
                                                                                                                                                    medical condition, such as vaccination. *} */
    public      $riskFactor                     = null;             /* {*property   $riskFactor                     (MedicalRiskFactor)             A modifiable or non-modifiable factor that increases the risk of a
                                                                                                                                                    patient contracting this condition, e.g. age, coexisting condition. *} */
    public      $secondaryPrevention            = null;             /* {*property   $secondaryPrevention            (MedicalTherapy)                A preventative therapy used to prevent reoccurrence of the medical
                                                                                                                                                    condition after an initial episode of the condition. *} */
    public      $signOrSymptom                  = null;             /* {*property   $signOrSymptom                  (MedicalSignOrSymptom)          A sign or symptom of this condition. Signs are objective or physically
                                                                                                                                                    observable manifestations of the medical condition while symptoms are
                                                                                                                                                    the subjective experience of the medical condition. *} */
    public      $stage                          = null;             /* {*property   $stage                          (MedicalConditionStage)         The stage of the condition, if applicable. *} */
    public      $status                         = null;             /* {*property   $status                         (string|EventStatusType|MedicalStudyStatus)The status of the study (enumerated). *} */
    public      $typicalTest                    = null;             /* {*property   $typicalTest                    (MedicalTest)                   A medical test typically performed given this condition. *} */


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
    }   /* End of MedicalCondition.__construct() ====================================== */
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
    }   /* End of MedicalCondition.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class MedicalCondition ================================================== */
/* ==================================================================================== */
