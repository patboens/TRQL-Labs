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
    {*file                  trql.educationaloccupationalprogram.class.php *}
    {*purpose               A program offered by an institution which determines the
                            learning progress to achieve an outcome, usually a
                            credential like a degree or certificate. This would define a
                            discrete set of opportunities (e.g., job, courses) that
                            together constitute a program with a clear start, end, set
                            of requirements, and transition to a new occupational
                            opportunity (e.g., a job), or sometimes a higher educational
                            opportunity (e.g., an advanced degree). *}
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
namespace trql\educationaloccupationalprogram;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'EDUCATIONALOCCUPATIONALPROGRAM_CLASS_VERSION' ) or define( 'EDUCATIONALOCCUPATIONALPROGRAM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class EducationalOccupationalProgram=

    {*desc

        A program offered by an institution which determines the learning progress
        to achieve an outcome, usually a credential like a degree or certificate.
        This would define a discrete set of opportunities (e.g., job, courses) that
        together constitute a program with a clear start, end, set of requirements,
        and transition to a new occupational opportunity (e.g., a job), or
        sometimes a higher educational opportunity (e.g., an advanced degree).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/EducationalOccupationalProgram[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

    *}}
 */
/* ==================================================================================== */
class EducationalOccupationalProgram extends Intangible
/*---------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $applicationDeadline            = null;             /* {*property   $applicationDeadline            (Date)                          The date at which the program stops collecting applications for the
                                                                                                                                                    next enrollment cycle. *} */
    public      $applicationStartDate           = null;             /* {*property   $applicationStartDate           (Date)                          The date at which the program begins collecting applications for the
                                                                                                                                                    next enrollment cycle. *} */
    public      $dayOfWeek                      = null;             /* {*property   $dayOfWeek                      (DayOfWeek)                     The day of the week for which these opening hours are valid. *} */
    public      $educationalCredentialAwarded   = null;             /* {*property   $educationalCredentialAwarded   (EducationalOccupationalCredential|URL|string)      A description of the qualification, award, certificate, diploma or
                                                                                                                                                    other educational credential awarded as a consequence of successful
                                                                                                                                                    completion of this course or program. *} */
    public      $educationalProgramMode         = null;             /* {*property   $educationalProgramMode         (URL|string)                    Similar to courseMode, The medium or means of delivery of the program
                                                                                                                                                    as a whole. The value may either be a text label (e.g. "online",
                                                                                                                                                    "onsite" or "blended"; "synchronous" or "asynchronous"; "full-time" or
                                                                                                                                                    "part-time") or a URL reference to a term from a controlled vocabulary
                                                                                                                                                    (e.g. https://ceds.ed.gov/element/001311#Asynchronous ). *} */
    public      $endDate                        = null;             /* {*property   $endDate                        (Date|DateTime)                 The end date and time of the item (in ISO 8601 date format). *} */
    public      $financialAidEligible           = null;             /* {*property   $financialAidEligible           (DefinedTerm|string)            A financial aid type or program which students may use to pay for
                                                                                                                                                    tuition or fees associated with the program. *} */
    public      $hasCourse                      = null;             /* {*property   $hasCourse                      (Course)                        A course or class that is one of the learning opportunities that 
                                                                                                                                                    constitute an educational / occupational program. No information is 
                                                                                                                                                    implied about whether the course is mandatory or optional; no guarantee 
                                                                                                                                                    is implied about whether the course will be available to everyone 
                                                                                                                                                    on the program. *} */
    public      $maximumEnrollment              = null;             /* {*property   $maximumEnrollment              (int)                           The maximum number of students who may be enrolled in the program. *} */
    public      $numberOfCredits                = null;             /* {*property   $numberOfCredits                (StructuredValue|int)           The number of credits or units awarded by a Course or required to
                                                                                                                                                    complete an EducationalOccupationalProgram. *} */
    public      $occupationalCategory           = null;             /* {*property   $occupationalCategory           (CategoryCode|string)           A category describing the job, preferably using a term from a taxonomy
                                                                                                                                                    such as BLS O*NET-SOC, ISCO-08 or similar, with the property repeated
                                                                                                                                                    for each applicable value. Ideally the taxonomy should be identified,
                                                                                                                                                    and both the textual label and formal code for the category should be
                                                                                                                                                    provided.Note: for historical reasons, any textual label and formal
                                                                                                                                                    code provided as a literal may be assumed to be from O*NET-SOC. *} */
    public      $occupationalCredentialAwarded  = null;             /* {*property   $occupationalCredentialAwarded  (string|EducationalOccupationalCredential|URL)  A description of the qualification, award, certificate, diploma or
                                                                                                                                                    other occupational credential awarded as a consequence of successful
                                                                                                                                                    completion of this course or program. *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */
    public      $programPrerequisites           = null;             /* {*property   $programPrerequisites           (Course|AlignmentObject|string|EducationalOccupationalCredential)   Prerequisites for enrolling in the program. *} */
    public      $programType                    = null;             /* {*property   $programType                    (string|DefinedTerm)            The type of educational or occupational program. For example,
                                                                                                                                                    classroom, internship, alternance, etc.. *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)           The service provider, service operator, or service performer; the
                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                    seller. *} */
    public      $salaryUponCompletion           = null;             /* {*property   $salaryUponCompletion           (MonetaryAmountDistribution)    The expected salary upon completing the training. *} */
    public      $startDate                      = null;             /* {*property   $startDate                      (DateTime|Date)                 The start date and time of the item (in ISO 8601 date format). *} */
    public      $termDuration                   = null;             /* {*property   $termDuration                   (Duration)                      The amount of time in a term as defined by the institution. A term is
                                                                                                                                                    a length of time where students take one or more classes. Semesters
                                                                                                                                                    and quarters are common units for term. *} */
    public      $termsPerYear                   = null;             /* {*property   $termsPerYear                   (float)                         The number of times terms of study are offered per year. Semesters and
                                                                                                                                                    quarters are common units for term. For example, if the student can
                                                                                                                                                    only take 2 semesters for the program in one year, then termsPerYear
                                                                                                                                                    should be 2. *} */
    public      $timeOfDay                      = null;             /* {*property   $timeOfDay                      (string)                        The time of day the program normally runs. For example, "evenings". *} */
    public      $timeToComplete                 = null;             /* {*property   $timeToComplete                 (Duration)                      The expected length of time to complete the program if attending
                                                                                                                                                    full-time. *} */
    public      $trainingSalary                 = null;             /* {*property   $trainingSalary                 (MonetaryAmountDistribution)    The estimated salary earned while in the program. *} */
    public      $typicalCreditsPerTerm          = null;             /* {*property   $typicalCreditsPerTerm          (StructuredValue|int)           The number of credits or units a full-time student would be expected
                                                                                                                                                    to take in 1 term however 'term' is defined by the institution. *} */


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
    }   /* End of EducationalOccupationalProgram.__construct() ======================== */
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
    }   /* End of EducationalOccupationalProgram.__destruct() ========================= */
    /* ================================================================================ */
}   /* End of class EducationalOccupationalProgram ==================================== */
/* ==================================================================================== */