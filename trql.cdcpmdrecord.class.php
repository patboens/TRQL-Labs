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
    {*UTF-8                 Quel bel été *}

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
use \trql\structuredvalue\StructuredValue   as StructuredValue;

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
        on 26-08-2020 18:40.
    *}

    *}}

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
    }   /* End of CDCPMDRecord.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class CDCPMDRecord ====================================================== */
/* ==================================================================================== */
