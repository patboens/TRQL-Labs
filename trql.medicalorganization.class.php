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
    {*file                  trql.medicalorganization.class.php *}
    {*purpose               A medical organization (physical or not), such as hospital,
                            institution or clinic. *}
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
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\medicalorganization;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\organization\Organization     as Organization;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'MEDICALORGANIZATION_CLASS_VERSION' ) or define( 'MEDICALORGANIZATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalOrganization=

    {*desc

        A medical organization (physical or not), such as hospital, institution or
        clinic.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalOrganization[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class MedicalOrganization extends Organization
/*------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $healthPlanNetworkId            = null;             /* {*property   $healthPlanNetworkId            (string)                        Name or unique ID of network. (Networks are often reused across
                                                                                                                                                    different insurance plans). *} */
    public      $isAcceptingNewPatients         = null;             /* {*property   $isAcceptingNewPatients         (boolean)                       Whether the provider is accepting new patients. *} */
    public      $medicalSpecialty	            = null;             /* {*property   $medicalSpecialty               (MedicalSpecialty)              A medical specialty of the provider (Enumeration Type: Anesthesia,
                                                                                                                                                    Cardiovascular, CommunityHealth, Dentistry, Dermatology, DietNutrition,
                                                                                                                                                    Emergency, Endocrine, Gastroenterologic, Genetic, Geriatric, Gynecologic, 
                                                                                                                                                    Hematologic, Infectious, LaboratoryScience, Midwifery, Musculoskeletal, 
                                                                                                                                                    Neurologic, Nursing, Obstetric, Oncologic, Optometric, Otolaryngologic, 
                                                                                                                                                    Pathology, Pediatric, PharmacySpecialty, Physiotherapy, PlasticSurgery, 
                                                                                                                                                    Podiatric, PrimaryCare, Psychiatric, PublicHealth, Pulmonary, 
                                                                                                                                                    Radiography, Renal, RespiratoryTherapy, Rheumatologic, SpeechPathology, 
                                                                                                                                                    Surgical, Toxicologic, Urologic.  *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q13107184';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Health facility where medicines are 
                                                                                                                                                    sold and medical advices are given *} */

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
    }   /* End of MedicalOrganization.__construct() =================================== */
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
    }   /* End of MedicalOrganization.__destruct() ==================================== */
    /* ================================================================================ */
}   /* End of class MedicalOrganization =============================================== */
/* ==================================================================================== */
?>