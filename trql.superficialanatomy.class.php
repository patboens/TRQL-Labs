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
    {*file                  trql.superficialanatomy.class.php *}
    {*purpose               Anatomical features that can be observed by sight (without
                            dissection), including the form and proportions of the human
                            body as well as surface landmarks that correspond to deeper
                            subcutaneous structures. Superficial anatomy plays an
                            important role in sports medicine, phlebotomy, and other
                            medical specialties as underlying anatomical structures can
                            be identified through surface palpation. For example, during
                            back surgery, superficial anatomy can be used to palpate and
                            count vertebrae to find the site of incision. Or in
                            phlebotomy, superficial anatomy can be used to locate an
                            underlying vein; for example, the median cubital vein can be
                            located by palpating the borders of the cubital fossa (such
                            as the epicondyles of the humerus) and then looking for the
                            superficial signs of the vein, such as size, prominence,
                            ability to refill after depression, and feel of surrounding
                            tissue support. As another example, in a subluxation
                            (dislocation) of the glenohumeral joint, the bony structure
                            becomes pronounced with the deltoid muscle failing to cover
                            the glenohumeral joint allowing the edges of the scapula to
                            be superficially visible. Here, the superficial anatomy is
                            the visible edges of the scapula, implying the underlying
                            dislocation of the joint (the related anatomical structure). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\superficialanatomy;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\medicalentity\MedicalEntity    as MedicalEntity;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALENTITY_CLASS_VERSION' ) )
    require_once( 'trql.medicalentity.class.php' );



defined( 'SUPERFICIALANATOMY_CLASS_VERSION' ) or define( 'SUPERFICIALANATOMY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SuperficialAnatomy=

    {*desc

        Anatomical features that can be observed by sight (without dissection),
        including the form and proportions of the human body as well as surface
        landmarks that correspond to deeper subcutaneous structures. Superficial
        anatomy plays an important role in sports medicine, phlebotomy, and other
        medical specialties as underlying anatomical structures can be identified
        through surface palpation. For example, during back surgery, superficial
        anatomy can be used to palpate and count vertebrae to find the site of
        incision. Or in phlebotomy, superficial anatomy can be used to locate an
        underlying vein; for example, the median cubital vein can be located by
        palpating the borders of the cubital fossa (such as the epicondyles of the
        humerus) and then looking for the superficial signs of the vein, such as
        size, prominence, ability to refill after depression, and feel of
        surrounding tissue support. As another example, in a subluxation
        (dislocation) of the glenohumeral joint, the bony structure becomes
        pronounced with the deltoid muscle failing to cover the glenohumeral joint
        allowing the edges of the scapula to be superficially visible. Here, the
        superficial anatomy is the visible edges of the scapula, implying the
        underlying dislocation of the joint (the related anatomical structure).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SuperficialAnatomy[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class SuperficialAnatomy extends MedicalEntity
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
    public      $associatedPathophysiology      = null;             /* {*property   $associatedPathophysiology      (string)                        If applicable, a description of the pathophysiology associated with
                                                                                                                                                    the anatomical system, including potential abnormal changes in the
                                                                                                                                                    mechanical, physical, and biochemical functions of the system. *} */
    public      $code                           = null;             /* {*property   $code                           (MedicalCode)                   A medical code for the entity, taken from a controlled vocabulary or
                                                                                                                                                    ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
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
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $recognizingAuthority           = null;             /* {*property   $recognizingAuthority           (Organization)                  If applicable, the organization that officially recognizes this entity
                                                                                                                                                    as part of its endorsed system of medicine. *} */
    public      $relatedAnatomy                 = null;             /* {*property   $relatedAnatomy                 (AnatomicalStructure|AnatomicalSystem)Anatomical systems or structures that relate to the superficial
                                                                                                                                                    anatomy. *} */
    public      $relatedCondition               = null;             /* {*property   $relatedCondition               (MedicalCondition)              A medical condition associated with this anatomy. *} */
    public      $relatedTherapy                 = null;             /* {*property   $relatedTherapy                 (MedicalTherapy)                A medical therapy related to this anatomy. *} */
    public      $relevantSpecialty              = null;             /* {*property   $relevantSpecialty              (MedicalSpecialty)              If applicable, a medical specialty in which this entity is relevant. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $significance                   = null;             /* {*property   $significance                   (string)                        The significance associated with the superficial anatomy; as an
                                                                                                                                                    example, how characteristics of the superficial anatomy can suggest
                                                                                                                                                    underlying medical conditions or courses of treatment. *} */
    public      $study                          = null;             /* {*property   $study                          (MedicalStudy)                  A medical study or trial related to this entity. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;


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
    }   /* End of SuperficialAnatomy.__construct() ========================================== */
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
    }   /* End of SuperficialAnatomy.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class SuperficialAnatomy ====================================================== */
/* ==================================================================================== */

?>