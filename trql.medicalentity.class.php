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
    {*file                  trql.medicalentity.class.php *}
    {*purpose               The most generic type of entity related to health and the
                            practice of medicine. *}
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
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\medicalentity;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\schema\Thing       as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'MEDICALENTITY_CLASS_VERSION' ) or define( 'MEDICALENTITY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalEntity=

    {*desc

        The most generic type of entity related to health and the practice of
        medicine.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalEntity[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class MedicalEntity extends Thing
/*-----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $code                           = null;             /* {*property   $code                       (MedicalCode)                                   A medical code for the entity, taken from a controlled vocabulary or
                                                                                                                                                                ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc. *} */
    public      $guideline                      = null;             /* {*property   $guideline                  (MedicalGuideline)                              A medical guideline related to this entity. *} */
    public      $legalStatus                    = null;             /* {*property   $legalStatus                (string|DrugLegalStatus|MedicalEnumeration)     The drug or supplement's legal status, including any controlled
                                                                                                                                                                substance schedules that apply. *} */
    public      $medicineSystem                 = null;             /* {*property   $medicineSystem             (MedicineSystem)                                The system of medicine that includes this MedicalEntity, for example
                                                                                                                                                                'evidence-based', 'homeopathic', 'chiropractic', etc. *} */
    public      $recognizingAuthority           = null;             /* {*property   $recognizingAuthority       (Organization)                                  If applicable, the organization that officially recognizes this entity
                                                                                                                                                                as part of its endorsed system of medicine. *} */
    public      $relevantSpecialty              = null;             /* {*property   $relevantSpecialty          (MedicalSpecialty)                              If applicable, a medical specialty in which this entity is relevant. *} */
    public      $study                          = null;             /* {*property   $study                      (MedicalStudy)                                  A medical study or trial related to this entity. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                                        Wikidata ID. No equivalent *} */


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
    }   /* End of MedicalEntity.__construct() ========================================= */
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
    }   /* End of MedicalEntity.__destruct() ========================================== */
    /* ================================================================================ */
}   /* End of class MedicalEntity ===================================================== */
/* ==================================================================================== */
?>