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
    {*file                  trql.medicaltrial.class.php *}
    {*purpose               A medical trial is a type of medical study that uses
                            scientific process used to compare the safety and efficacy
                            of medical therapies or medical procedures. In general,
                            medical trials are controlled and subjects are allocated at
                            random to the different treatment and/or control groups. *}
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
namespace trql\medicaltrial;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\medicalstudy\MedicalStudy    as MedicalStudy;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALSTUDY_CLASS_VERSION' ) )
    require_once( 'trql.medicalstudy.class.php' );



defined( 'MEDICALTRIAL_CLASS_VERSION' ) or define( 'MEDICALTRIAL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalTrial=

    {*desc

        A medical trial is a type of medical study that uses scientific process
        used to compare the safety and efficacy of medical therapies or medical
        procedures. In general, medical trials are controlled and subjects are
        allocated at random to the different treatment and/or control groups.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalTrial[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class MedicalTrial extends MedicalStudy
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
    public      $code                           = null;             /* {*property   $code                           (MedicalCode)                   A medical code for the entity, taken from a controlled vocabulary or
                                                                                                                                                    ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $guideline                      = null;             /* {*property   $guideline                      (MedicalGuideline)              A medical guideline related to this entity. *} */
    public      $healthCondition                = null;             /* {*property   $healthCondition                (MedicalCondition)              Specifying the health condition(s) of a patient, medical study, or
                                                                                                                                                    other target audience. *} */
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
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $recognizingAuthority           = null;             /* {*property   $recognizingAuthority           (Organization)                  If applicable, the organization that officially recognizes this entity
                                                                                                                                                    as part of its endorsed system of medicine. *} */
    public      $relevantSpecialty              = null;             /* {*property   $relevantSpecialty              (MedicalSpecialty)              If applicable, a medical specialty in which this entity is relevant. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */
    public      $status                         = null;             /* {*property   $status                         (string|EventStatusType|MedicalStudyStatus)The status of the study (enumerated). *} */
    public      $study                          = null;             /* {*property   $study                          (MedicalStudy)                  A medical study or trial related to this entity. *} */
    public      $studyLocation                  = null;             /* {*property   $studyLocation                  (AdministrativeArea)            The location in which the study is taking/took place. *} */
    public      $studySubject                   = null;             /* {*property   $studySubject                   (MedicalEntity)                 A subject of the study, i.e. one of the medical conditions, therapies,
                                                                                                                                                    devices, drugs, etc. investigated by the study. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $trialDesign                    = null;             /* {*property   $trialDesign                    (MedicalTrialDesign)            Specifics about the trial design (enumerated). *} */
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
    }   /* End of MedicalTrial.__construct() ========================================== */
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
    }   /* End of MedicalTrial.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class MedicalTrial ====================================================== */
/* ==================================================================================== */

?>