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
    {*file                  trql.jobposting.class.php *}
    {*purpose               A listing that describes a job opening in a certain
                            organization. *}
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
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\jobposting;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'JOBPOSTING_CLASS_VERSION' ) or define( 'JOBPOSTING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class JobPosting=

    {*desc

        A listing that describes a job opening in a certain organization.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/JobPosting[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}

 */
/* ==================================================================================== */
class JobPosting extends Intangible
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $applicantLocationRequirements  = null;             /* {*property   $applicantLocationRequirements  (AdministrativeArea)            The location(s) applicants can apply from. This is usually used for
                                                                                                                                                    telecommuting jobs where the applicant does not need to be in a
                                                                                                                                                    physical office. Note: This should not be used for citizenship or work
                                                                                                                                                    visa requirements. *} */
    public      $applicationContact             = null;             /* {*property   $applicationContact             (ContactPoint)                  Contact details for further information relevant to this job posting. *} */
    public      $baseSalary                     = null;             /* {*property   $baseSalary                     (float|PriceSpecification|MonetaryAmount)The base salary of the job or of an employee in an EmployeeRole. *} */
    public      $datePosted                     = null;             /* {*property   $datePosted                     (Date|DateTime)                 Publication date of an online listing. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $educationRequirements          = null;             /* {*property   $educationRequirements          (EducationalOccupationalCredential|string)Educational background needed for the position or Occupation. *} */
    public      $eligibilityToWorkRequirement   = null;             /* {*property   $eligibilityToWorkRequirement   (string)                        The legal requirements such as citizenship, visa and other
                                                                                                                                                    documentation required for an applicant to this job. *} */
    public      $employerOverview               = null;             /* {*property   $employerOverview               (string)                        A description of the employer, career opportunities and work
                                                                                                                                                    environment for this position. *} */
    public      $employmentType                 = null;             /* {*property   $employmentType                 (string)                        Type of employment (e.g. full-time, part-time, contract, temporary,
                                                                                                                                                    seasonal, internship). *} */
    public      $employmentUnit                 = null;             /* {*property   $employmentUnit                 (Organization)                  Indicates the department, unit and/or facility where the employee
                                                                                                                                                    reports and/or in which the job is to be performed. *} */
    public      $estimatedSalary                = null;             /* {*property   $estimatedSalary                (float|MonetaryAmountDistribution|MonetaryAmount)An estimated salary for a job posting or occupation, based on a
                                                                                                                                                    variety of variables including, but not limited to industry, job
                                                                                                                                                    title, and location. Estimated salaries are often computed by outside
                                                                                                                                                    organizations rather than the hiring organization, who may not have
                                                                                                                                                    committed to the estimated value. *} */
    public      $experienceRequirements         = null;             /* {*property   $experienceRequirements         (string)                        Description of skills and experience needed for the position or
                                                                                                                                                    Occupation. *} */
    public      $hiringOrganization             = null;             /* {*property   $hiringOrganization             (Organization)                  Organization offering the job position. *} */
    public      $incentiveCompensation          = null;             /* {*property   $incentiveCompensation          (string)                        Description of bonus and commission compensation aspects of the job. *} */
    public      $industry                       = null;             /* {*property   $industry                       (DefinedTerm|string)            The industry associated with the job position. *} */
    public      $jobBenefits                    = null;             /* {*property   $jobBenefits                    (string)                        Description of benefits associated with the job. *} */
    public      $jobImmediateStart              = null;             /* {*property   $jobImmediateStart              (boolean)                       An indicator as to whether a position is available for an immediate
                                                                                                                                                    start. *} */
    public      $jobLocation                    = null;             /* {*property   $jobLocation                    (Place)                         A (typically single) geographic location associated with the job
                                                                                                                                                    position. *} */
    public      $jobLocationType                = null;             /* {*property   $jobLocationType                (string)                        A description of the job location (e.g TELECOMMUTE for telecommute
                                                                                                                                                    jobs). *} */
    public      $jobStartDate                   = null;             /* {*property   $jobStartDate                   (Date|string)                   The date on which a successful applicant for this job would be
                                                                                                                                                    expected to start work. Choose a specific date in the future or use
                                                                                                                                                    the jobImmediateStart property to indicate the position is to be
                                                                                                                                                    filled as soon as possible. *} */
    public      $occupationalCategory           = null;             /* {*property   $occupationalCategory           (CategoryCode|string)           A category describing the job, preferably using a term from a taxonomy
                                                                                                                                                    such as BLS O*NET-SOC, ISCO-08 or similar, with the property repeated
                                                                                                                                                    for each applicable value. Ideally the taxonomy should be identified,
                                                                                                                                                    and both the textual label and formal code for the category should be
                                                                                                                                                    provided.Note: for historical reasons, any textual label and formal
                                                                                                                                                    code provided as a literal may be assumed to be from O*NET-SOC. *} */
    public      $physicalRequirement            = null;             /* {*property   $physicalRequirement            (URL|string|DefinedTerm)        A description of the types of physical activity associated with the
                                                                                                                                                    job. Defined terms such as those in O*net may be used, but note that
                                                                                                                                                    there is no way to specify the level of ability as well as its nature
                                                                                                                                                    when using a defined term. *} */
    public      $qualifications                 = null;             /* {*property   $qualifications                 (EducationalOccupationalCredential|string)Specific qualifications required for this role or Occupation. *} */
    public      $relevantOccupation             = null;             /* {*property   $relevantOccupation             (Occupation)                    The Occupation for the JobPosting. *} */
    public      $responsibilities               = null;             /* {*property   $responsibilities               (string)                        Responsibilities associated with this role or Occupation. *} */
    public      $salaryCurrency                 = null;             /* {*property   $salaryCurrency                 (string)                        The currency (coded using ISO 4217 ) used for the main salary
                                                                                                                                                    information in this job posting or for this employee. *} */
    public      $securityClearanceRequirement   = null;             /* {*property   $securityClearanceRequirement   (string|URL)                    A description of any security clearance requirements of the job. *} */
    public      $sensoryRequirement             = null;             /* {*property   $sensoryRequirement             (string|URL|DefinedTerm)        A description of any sensory requirements and levels necessary to
                                                                                                                                                    function on the job, including hearing and vision. Defined terms such
                                                                                                                                                    as those in O*net may be used, but note that there is no way to
                                                                                                                                                    specify the level of ability as well as its nature when using a
                                                                                                                                                    defined term. *} */
    public      $skills                         = null;             /* {*property   $skills                         (DefinedTerm|string)            A statement of knowledge, skill, ability, task or any other assertion
                                                                                                                                                    expressing a competency that is desired or required to fulfill this
                                                                                                                                                    role or to work in this occupation. *} */
    public      $specialCommitments             = null;             /* {*property   $specialCommitments             (string)                        Any special commitments associated with this job posting. Valid
                                                                                                                                                    entries include VeteranCommit, MilitarySpouseCommit, etc. *} */
    public      $title                          = null;             /* {*property   $title                          (string)                        The title of the job. *} */
    public      $totalJobOpenings               = null;             /* {*property   $totalJobOpenings               (int)                           The number of positions open for this job posting. Use a positive
                                                                                                                                                    integer. Do not use if the number of positions is unclear or not
                                                                                                                                                    known. *} */
    public      $validThrough                   = null;             /* {*property   $validThrough                   (DateTime|Date)                 The date after when the item is not valid. For example the end of an
                                                                                                                                                    offer, salary period, or a period of opening hours. *} */
    public      $workHours                      = null;             /* {*property   $workHours                      (string)                        The typical working hours for this job (e.g. 1st shift, night shift,
                                                                                                                                                    8am-5pm). *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT LOOKED AT IT YET. *} */


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
    }   /* End of JobPosting.__construct() ============================================ */
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
    }   /* End of JobPosting.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class JobPosting ======================================================== */
/* ==================================================================================== */