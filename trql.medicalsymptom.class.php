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
    {*file                  trql.medicalsymptom.class.php *}
    {*purpose               Any complaint sensed and expressed by the patient (therefore
                            defined as subjective) like stomachache, lower-back pain, or
                            fatigue. *}
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

    {*chist
        {*mdate 14-02-21 09:52 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\medicalsymptom;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\medicalsignorsymptom\MedicalSignOrSymptom    as MedicalSignOrSymptom;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALSIGNORSYMPTOM_CLASS_VERSION' ) )
    require_once( 'trql.medicalsignorsymptom.class.php' );



defined( 'MEDICALSYMPTOM_CLASS_VERSION' ) or define( 'MEDICALSYMPTOM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalSymptom=

    {*desc

        Any complaint sensed and expressed by the patient (therefore defined as
        subjective) like stomachache, lower-back pain, or fatigue.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalSymptom[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class MedicalSymptom extends MedicalSignOrSymptom
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $associatedAnatomy              = null;             /* {*property   $associatedAnatomy              (SuperficialAnatomy|AnatomicalStructure|AnatomicalSystem)The anatomy of the underlying organ system or structures associated
                                                                                                                                                    with this entity. *} */
    public      $code                           = null;             /* {*property   $code                           (MedicalCode)                   A medical code for the entity, taken from a controlled vocabulary or
                                                                                                                                                    ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $differentialDiagnosis          = null;             /* {*property   $differentialDiagnosis          (DDxElement)                    One of a set of differential diagnoses for the condition.
                                                                                                                                                    Specifically, a closely-related or competing diagnosis typically
                                                                                                                                                    considered later in the cognitive process whereby this medical
                                                                                                                                                    condition is distinguished from others most likely responsible for a
                                                                                                                                                    similar collection of signs and symptoms to reach the most
                                                                                                                                                    parsimonious diagnosis or diagnoses in a patient. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $drug                           = null;             /* {*property   $drug                           (Drug)                          Specifying a drug or medicine used in a medication procedure *} */
    public      $epidemiology                   = null;             /* {*property   $epidemiology                   (string)                        The characteristics of associated patients, such as age, gender, race
                                                                                                                                                    etc. *} */
    public      $expectedPrognosis              = null;             /* {*property   $expectedPrognosis              (string)                        The likely outcome in either the short term or long term of the
                                                                                                                                                    medical condition. *} */
    public      $guideline                      = null;             /* {*property   $guideline                      (MedicalGuideline)              A medical guideline related to this entity. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $legalStatus                    = null;             /* {*property   $legalStatus                    (string|DrugLegalStatus|MedicalEnumeration)The drug or supplement's legal status, including any controlled
                                                                                                                                                    substance schedules that apply. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $medicineSystem                 = null;             /* {*property   $medicineSystem                 (MedicineSystem)                The system of medicine that includes this MedicalEntity, for example
                                                                                                                                                    'evidence-based', 'homeopathic', 'chiropractic', etc. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $naturalProgression             = null;             /* {*property   $naturalProgression             (string)                        The expected progression of the condition if it is not treated and
                                                                                                                                                    allowed to progress naturally. *} */
    public      $pathophysiology                = null;             /* {*property   $pathophysiology                (string)                        Changes in the normal mechanical, physical, and biochemical functions
                                                                                                                                                    that are associated with this activity or condition. *} */
    public      $possibleComplication           = null;             /* {*property   $possibleComplication           (string)                        A possible unexpected and unfavorable evolution of a medical
                                                                                                                                                    condition. Complications may include worsening of the signs or
                                                                                                                                                    symptoms of the disease, extension of the condition to other organ
                                                                                                                                                    systems, etc. *} */
    public      $possibleTreatment              = null;             /* {*property   $possibleTreatment              (MedicalTherapy)                A possible treatment to address this condition, sign or symptom. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $primaryPrevention              = null;             /* {*property   $primaryPrevention              (MedicalTherapy)                A preventative therapy used to prevent an initial occurrence of the
                                                                                                                                                    medical condition, such as vaccination. *} */
    public      $recognizingAuthority           = null;             /* {*property   $recognizingAuthority           (Organization)                  If applicable, the organization that officially recognizes this entity
                                                                                                                                                    as part of its endorsed system of medicine. *} */
    public      $relevantSpecialty              = null;             /* {*property   $relevantSpecialty              (MedicalSpecialty)              If applicable, a medical specialty in which this entity is relevant. *} */
    public      $riskFactor                     = null;             /* {*property   $riskFactor                     (MedicalRiskFactor)             A modifiable or non-modifiable factor that increases the risk of a
                                                                                                                                                    patient contracting this condition, e.g. age, coexisting condition. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $secondaryPrevention            = null;             /* {*property   $secondaryPrevention            (MedicalTherapy)                A preventative therapy used to prevent reoccurrence of the medical
                                                                                                                                                    condition after an initial episode of the condition. *} */
    public      $signOrSymptom                  = null;             /* {*property   $signOrSymptom                  (MedicalSignOrSymptom)          A sign or symptom of this condition. Signs are objective or physically
                                                                                                                                                    observable manifestations of the medical condition while symptoms are
                                                                                                                                                    the subjective experience of the medical condition. *} */
    public      $stage                          = null;             /* {*property   $stage                          (MedicalConditionStage)         The stage of the condition, if applicable. *} */
    public      $status                         = null;             /* {*property   $status                         (string|EventStatusType|MedicalStudyStatus)The status of the study (enumerated). *} */
    public      $study                          = null;             /* {*property   $study                          (MedicalStudy)                  A medical study or trial related to this entity. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $typicalTest                    = null;             /* {*property   $typicalTest                    (MedicalTest)                   A medical test typically performed given this condition. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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
    }   /* End of MedicalSymptom.__construct() ======================================== */
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
    }   /* End of MedicalSymptom.__destruct() ========================================= */
    /* ================================================================================ */

}   /* End of class MedicalSymptom ==================================================== */
/* ==================================================================================== */

?>