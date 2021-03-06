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
    {*UTF-8                 Quel bel été *}

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

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\substance\Substance   as Substance;

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

    *}}

 */
/* ==================================================================================== */
class Drug extends Substance
/*------------------------*/
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
    public      $administrationRoute            = null;             /* {*property   $administrationRoute            (string)                        A route by which this drug may be administered, e.g. 'oral'. *} */
    public      $alcoholWarning                 = null;             /* {*property   $alcoholWarning                 (string)                        Any precaution, guidance, contraindication, etc. related to
                                                                                                                                                    consumption of alcohol while taking this drug. *} */
    public      $availableStrength              = null;             /* {*property   $availableStrength              (DrugStrength)                  An available dosage strength for the drug. *} */
    public      $breastfeedingWarning           = null;             /* {*property   $breastfeedingWarning           (string)                        Any precaution, guidance, contraindication, etc. related to this
                                                                                                                                                    drug's use by breastfeeding mothers. *} */
    public      $clinicalPharmacology           = null;             /* {*property   $clinicalPharmacology           (string)                        Description of the absorption and elimination of drugs, including
                                                                                                                                                    their concentration (pharmacokinetics, pK) and biological effects
                                                                                                                                                    (pharmacodynamics, pD). *} */
    public      $dosageForm                     = null;             /* {*property   $dosageForm                     (string)                        A dosage form in which this drug/supplement is available, e.g.
                                                                                                                                                    'tablet', 'suspension', 'injection'. *} */
    public      $doseSchedule                   = null;             /* {*property   $doseSchedule                   (DoseSchedule)                  A dosing schedule for the drug for a given population, either
                                                                                                                                                    observed, recommended, or maximum dose based on the type used. *} */
    public      $drugClass                      = null;             /* {*property   $drugClass                      (DrugClass)                     The class of drug this belongs to (e.g., statins). *} */
    public      $drugUnit                       = null;             /* {*property   $drugUnit                       (string)                        The unit in which the drug is measured, e.g. '5 mg tablet'. *} */
    public      $foodWarning                    = null;             /* {*property   $foodWarning                    (string)                        Any precaution, guidance, contraindication, etc. related to
                                                                                                                                                    consumption of specific foods while taking this drug. *} */
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
    public      $nonProprietaryName             = null;             /* {*property   $nonProprietaryName             (string)                        The generic name of this drug or supplement. *} */
    public      $overdosage                     = null;             /* {*property   $overdosage                     (string)                        Any information related to overdose on a drug, including signs or
                                                                                                                                                    symptoms, treatments, contact information for emergency response. *} */
    public      $pregnancyCategory              = null;             /* {*property   $pregnancyCategory              (DrugPregnancyCategory)         Pregnancy category of this drug. *} */
    public      $pregnancyWarning               = null;             /* {*property   $pregnancyWarning               (string)                        Any precaution, guidance, contraindication, etc. related to this
                                                                                                                                                    drug's use during pregnancy. *} */
    public      $prescribingInfo                = null;             /* {*property   $prescribingInfo                (URL)                           Link to prescribing information for the drug. *} */
    public      $prescriptionStatus             = null;             /* {*property   $prescriptionStatus             (string|DrugPrescriptionStatus) Indicates the status of drug prescription eg. local catalogs
                                                                                                                                                    classifications or whether the drug is available by prescription or
                                                                                                                                                    over-the-counter, etc. *} */
    public      $proprietaryName                = null;             /* {*property   $proprietaryName                (string)                        Proprietary name given to the diet plan, typically by its originator
                                                                                                                                                    or creator. *} */
    public      $relatedDrug                    = null;             /* {*property   $relatedDrug                    (Drug)                          Any other drug related to this one, for example commonly-prescribed
                                                                                                                                                    alternatives. *} */
    public      $rxcui                          = null;             /* {*property   $rxcui                          (string)                        The RxCUI drug identifier from RXNORM. *} */
    public      $warning                        = null;             /* {*property   $warning                        (string|URL)                    Any FDA or other warnings about the drug (text or URL). *} */


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
    }   /* End of Drug.__construct() ================================================== */
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
    }   /* End of Drug.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Drug ============================================================== */
/* ==================================================================================== */
