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
    {*file                  trql.cdcpmdrecord.class.php *}
    {*purpose               A CDCPMDRecord is a data structure representing a record in
                            a CDC tabular data format used for hospital data reporting.
                            See documentation for details, and the linked CDC materials
                            for authoritative definitions used as the source here. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:40 *}
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
namespace trql\cdcpmdrecord;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\structuredvalue\StructuredValue    as StructuredValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );



defined( 'CDCPMDRECORD_CLASS_VERSION' ) or define( 'CDCPMDRECORD_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CDCPMDRecord=

    {*desc

        A CDCPMDRecord is a data structure representing a record in a CDC tabular
        data format used for hospital data reporting. See documentation for
        details, and the linked CDC materials for authoritative definitions used as
        the source here.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CDCPMDRecord[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:40. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class CDCPMDRecord extends StructuredValue
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
    public      $cvdCollectionDate              = null;             /* {*property   $cvdCollectionDate              (DateTime|string)               collectiondate - Date for which patient counts are reported. *} */
    public      $cvdFacilityCounty              = null;             /* {*property   $cvdFacilityCounty              (string)                        Name of the County of the NHSN facility that this data record applies
                                                                                                                                                    to. Use cvdFacilityId to identify the facility. To provide other
                                                                                                                                                    details, healthcareReportingData can be used on a Hospital entry. *} */
    public      $cvdFacilityId                  = null;             /* {*property   $cvdFacilityId                  (string)                        Identifier of the NHSN facility that this data record applies to. Use
                                                                                                                                                    cvdFacilityCounty to indicate the county. To provide other details,
                                                                                                                                                    healthcareReportingData can be used on a Hospital entry. *} */
    public      $cvdNumBeds                     = null;             /* {*property   $cvdNumBeds                     (float)                         numbeds - HOSPITAL INPATIENT BEDS: Inpatient beds, including all
                                                                                                                                                    staffed, licensed, and overflow (surge) beds used for inpatients. *} */
    public      $cvdNumBedsOcc                  = null;             /* {*property   $cvdNumBedsOcc                  (float)                         numbedsocc - HOSPITAL INPATIENT BED OCCUPANCY: Total number of staffed
                                                                                                                                                    inpatient beds that are occupied. *} */
    public      $cvdNumC19Died                  = null;             /* {*property   $cvdNumC19Died                  (float)                         numc19died - DEATHS: Patients with suspected or confirmed COVID-19 who
                                                                                                                                                    died in the hospital, ED, or any overflow location. *} */
    public      $cvdNumC19HOPats                = null;             /* {*property   $cvdNumC19HOPats                (float)                         numc19hopats - HOSPITAL ONSET: Patients hospitalized in an NHSN
                                                                                                                                                    inpatient care location with onset of suspected or confirmed COVID-19
                                                                                                                                                    14 or more days after hospitalization. *} */
    public      $cvdNumC19HospPats              = null;             /* {*property   $cvdNumC19HospPats              (float)                         numc19hosppats - HOSPITALIZED: Patients currently hospitalized in an
                                                                                                                                                    inpatient care location who have suspected or confirmed COVID-19. *} */
    public      $cvdNumC19MechVentPats          = null;             /* {*property   $cvdNumC19MechVentPats          (float)                         numc19mechventpats - HOSPITALIZED and VENTILATED: Patients
                                                                                                                                                    hospitalized in an NHSN inpatient care location who have suspected or
                                                                                                                                                    confirmed COVID-19 and are on a mechanical ventilator. *} */
    public      $cvdNumC19OFMechVentPats        = null;             /* {*property   $cvdNumC19OFMechVentPats        (float)                         numc19ofmechventpats - ED/OVERFLOW and VENTILATED: Patients with
                                                                                                                                                    suspected or confirmed COVID-19 who are in the ED or any overflow
                                                                                                                                                    location awaiting an inpatient bed and on a mechanical ventilator. *} */
    public      $cvdNumC19OverflowPats          = null;             /* {*property   $cvdNumC19OverflowPats          (float)                         numc19overflowpats - ED/OVERFLOW: Patients with suspected or confirmed
                                                                                                                                                    COVID-19 who are in the ED or any overflow location awaiting an
                                                                                                                                                    inpatient bed. *} */
    public      $cvdNumICUBeds                  = null;             /* {*property   $cvdNumICUBeds                  (float)                         numicubeds - ICU BEDS: Total number of staffed inpatient intensive
                                                                                                                                                    care unit (ICU) beds. *} */
    public      $cvdNumICUBedsOcc               = null;             /* {*property   $cvdNumICUBedsOcc               (float)                         numicubedsocc - ICU BED OCCUPANCY: Total number of staffed inpatient
                                                                                                                                                    ICU beds that are occupied. *} */
    public      $cvdNumTotBeds                  = null;             /* {*property   $cvdNumTotBeds                  (float)                         numtotbeds - ALL HOSPITAL BEDS: Total number of all Inpatient and
                                                                                                                                                    outpatient beds, including all staffed,ICU, licensed, and overflow
                                                                                                                                                    (surge) beds used for inpatients or outpatients. *} */
    public      $cvdNumVent                     = null;             /* {*property   $cvdNumVent                     (float)                         numvent - MECHANICAL VENTILATORS: Total number of ventilators
                                                                                                                                                    available. *} */
    public      $cvdNumVentUse                  = null;             /* {*property   $cvdNumVentUse                  (float)                         numventuse - MECHANICAL VENTILATORS IN USE: Total number of
                                                                                                                                                    ventilators in use. *} */
    public      $datePosted                     = null;             /* {*property   $datePosted                     (Date|DateTime)                 Publication date of an online listing. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
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
    }   /* End of CDCPMDRecord.__construct() ========================================== */
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
    }   /* End of CDCPMDRecord.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class CDCPMDRecord ====================================================== */
/* ==================================================================================== */

?>