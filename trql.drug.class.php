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
    {*file                  trql.drug.class.php *}
    {*purpose               A chemical or biologic substance, used as a medical therapy,
                            that has a physiological effect on an organism. Here the
                            term drug is used interchangeably with the term medicine
                            although clinical knowledge make a clear difference between
                            them. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
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
namespace trql\drug;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\substance\Substance    as Substance;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'SUBSTANCE_CLASS_VERSION' ) )
    require_once( 'trql.substance.class.php' );



defined( 'DRUG_CLASS_VERSION' ) or define( 'DRUG_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Drug=

    {*desc

        A chemical or biologic substance, used as a medical therapy, that has a
        physiological effect on an organism. Here the term drug is used
        interchangeably with the term medicine although clinical knowledge make a
        clear difference between them.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Drug[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class Drug extends Substance
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

    public      $activeIngredient               = null;             /* {*property   $activeIngredient               (string)                        An active ingredient, typically chemical compounds and/or biologic
                                                                                                                                                    substances. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $administrationRoute            = null;             /* {*property   $administrationRoute            (string)                        A route by which this drug may be administered, e.g. 'oral'. *} */
    public      $alcoholWarning                 = null;             /* {*property   $alcoholWarning                 (string)                        Any precaution, guidance, contraindication, etc. related to
                                                                                                                                                    consumption of alcohol while taking this drug. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $availableStrength              = null;             /* {*property   $availableStrength              (DrugStrength)                  An available dosage strength for the drug. *} */
    public      $breastfeedingWarning           = null;             /* {*property   $breastfeedingWarning           (string)                        Any precaution, guidance, contraindication, etc. related to this
                                                                                                                                                    drug's use by breastfeeding mothers. *} */
    public      $clincalPharmacology            = null;             /* {*property   $clincalPharmacology            (string)                        Description of the absorption and elimination of drugs, including
                                                                                                                                                    their concentration (pharmacokinetics, pK) and biological effects
                                                                                                                                                    (pharmacodynamics, pD). *} */
    public      $clinicalPharmacology           = null;             /* {*property   $clinicalPharmacology           (string)                        Description of the absorption and elimination of drugs, including
                                                                                                                                                    their concentration (pharmacokinetics, pK) and biological effects
                                                                                                                                                    (pharmacodynamics, pD). *} */
    public      $code                           = null;             /* {*property   $code                           (MedicalCode)                   A medical code for the entity, taken from a controlled vocabulary or
                                                                                                                                                    ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $dosageForm                     = null;             /* {*property   $dosageForm                     (string)                        A dosage form in which this drug/supplement is available, e.g.
                                                                                                                                                    'tablet', 'suspension', 'injection'. *} */
    public      $doseSchedule                   = null;             /* {*property   $doseSchedule                   (DoseSchedule)                  A dosing schedule for the drug for a given population, either
                                                                                                                                                    observed, recommended, or maximum dose based on the type used. *} */
    public      $drugClass                      = null;             /* {*property   $drugClass                      (DrugClass)                     The class of drug this belongs to (e.g., statins). *} */
    public      $drugUnit                       = null;             /* {*property   $drugUnit                       (string)                        The unit in which the drug is measured, e.g. '5 mg tablet'. *} */
    public      $foodWarning                    = null;             /* {*property   $foodWarning                    (string)                        Any precaution, guidance, contraindication, etc. related to
                                                                                                                                                    consumption of specific foods while taking this drug. *} */
    public      $guideline                      = null;             /* {*property   $guideline                      (MedicalGuideline)              A medical guideline related to this entity. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $includedInHealthInsurancePlan  = null;             /* {*property   $includedInHealthInsurancePlan  (HealthInsurancePlan)           The insurance plans that cover this drug. *} */
    public      $interactingDrug                = null;             /* {*property   $interactingDrug                (Drug)                          Another drug that is known to interact with this drug in a way that
                                                                                                                                                    impacts the effect of this drug or causes a risk to the patient. Note:
                                                                                                                                                    disease interactions are typically captured as contraindications. *} */
    public      $isAvailableGenerically         = null;             /* {*property   $isAvailableGenerically         (boolean)                       True if the drug is available in a generic form (regardless of name). *} */
    public      $isProprietary                  = null;             /* {*property   $isProprietary                  (boolean)                       True if this item's name is a proprietary/brand name (vs. generic
                                                                                                                                                    name). *} */
    public      $labelDetails                   = null;             /* {*property   $labelDetails                   (URL)                           Link to the drug's label details. *} */
    public      $legalStatus                    = null;             /* {*property   $legalStatus                    (string|DrugLegalStatus|MedicalEnumeration)The drug or supplement's legal status, including any controlled
                                                                                                                                                    substance schedules that apply. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $manufacturer                   = null;             /* {*property   $manufacturer                   (Organization)                  The manufacturer of the product. *} */
    public      $maximumIntake                  = null;             /* {*property   $maximumIntake                  (MaximumDoseSchedule)           Recommended intake of this supplement for a given population as
                                                                                                                                                    defined by a specific recommending authority. *} */
    public      $mechanismOfAction              = null;             /* {*property   $mechanismOfAction              (string)                        The specific biochemical interaction through which this drug or
                                                                                                                                                    supplement produces its pharmacological effect. *} */
    public      $medicineSystem                 = null;             /* {*property   $medicineSystem                 (MedicineSystem)                The system of medicine that includes this MedicalEntity, for example
                                                                                                                                                    'evidence-based', 'homeopathic', 'chiropractic', etc. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nonProprietaryName             = null;             /* {*property   $nonProprietaryName             (string)                        The generic name of this drug or supplement. *} */
    public      $overdosage                     = null;             /* {*property   $overdosage                     (string)                        Any information related to overdose on a drug, including signs or
                                                                                                                                                    symptoms, treatments, contact information for emergency response. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $pregnancyCategory              = null;             /* {*property   $pregnancyCategory              (DrugPregnancyCategory)         Pregnancy category of this drug. *} */
    public      $pregnancyWarning               = null;             /* {*property   $pregnancyWarning               (string)                        Any precaution, guidance, contraindication, etc. related to this
                                                                                                                                                    drug's use during pregnancy. *} */
    public      $prescribingInfo                = null;             /* {*property   $prescribingInfo                (URL)                           Link to prescribing information for the drug. *} */
    public      $prescriptionStatus             = null;             /* {*property   $prescriptionStatus             (string|DrugPrescriptionStatus) Indicates the status of drug prescription eg. local catalogs
                                                                                                                                                    classifications or whether the drug is available by prescription or
                                                                                                                                                    over-the-counter, etc. *} */
    public      $proprietaryName                = null;             /* {*property   $proprietaryName                (string)                        Proprietary name given to the diet plan, typically by its originator
                                                                                                                                                    or creator. *} */
    public      $recognizingAuthority           = null;             /* {*property   $recognizingAuthority           (Organization)                  If applicable, the organization that officially recognizes this entity
                                                                                                                                                    as part of its endorsed system of medicine. *} */
    public      $relatedDrug                    = null;             /* {*property   $relatedDrug                    (Drug)                          Any other drug related to this one, for example commonly-prescribed
                                                                                                                                                    alternatives. *} */
    public      $relevantSpecialty              = null;             /* {*property   $relevantSpecialty              (MedicalSpecialty)              If applicable, a medical specialty in which this entity is relevant. *} */
    public      $rxcui                          = null;             /* {*property   $rxcui                          (string)                        The RxCUI drug identifier from RXNORM. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $study                          = null;             /* {*property   $study                          (MedicalStudy)                  A medical study or trial related to this entity. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $warning                        = null;             /* {*property   $warning                        (string|URL)                    Any FDA or other warnings about the drug (text or URL). *} */


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
    }   /* End of Drug.__construct() ========================================== */
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
    }   /* End of Drug.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class Drug ====================================================== */
/* ==================================================================================== */

?>