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
    {*file                  trql.course.class.php *}
    {*purpose               A description of an educational course which may be offered
                            as distinct instances at which take place at different times
                            or take place at different locations, or be offered through
                            different media or modes of study. An educational course is
                            a sequence of one or more educational events and/or creative
                            works which aims to build knowledge, competence or ability
                            of learners. *}
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
namespace trql\course;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'COURSE_CLASS_VERSION' ) or define( 'COURSE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Course=

    {*desc

        A description of an educational course which may be offered as distinct
        instances at which take place at different times or take place at different
        locations, or be offered through different media or modes of study. An
        educational course is a sequence of one or more educational events and/or
        creative works which aims to build knowledge, competence or ability of
        learners.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Course[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class Course extends CreativeWork
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

    public      $assesses                       = null;             /* {*property   $assesses                       (string|DefinedTerm)                            The item being described is intended to assess the competency or
                                                                                                                                                                    learning outcome defined by the referenced term. *} */
    public      $competencyRequired             = null;             /* {*property   $competencyRequired             (string|URL)                                    Knowledge, skill, ability or personal attribute that must be 
                                                                                                                                                                    demonstrated by a person or other entity in order to do something 
                                                                                                                                                                    such as earn an Educational Occupational Credential or understand 
                                                                                                                                                                    a LearningResource. *} */
    public      $courseCode                     = null;             /* {*property   $courseCode                     (string)                                        The identifier for the Course used by the course provider (e.g. CS101
                                                                                                                                                                    or 6.001). *} */
    public      $coursePrerequisites            = null;             /* {*property   $coursePrerequisites            (string|Course|AlignmentObject)                 Requirements for taking the Course. May be completion of another
                                                                                                                                                                    Course or a textual description like "permission of instructor".
                                                                                                                                                                    Requirements may be a pre-requisite competency, referenced using
                                                                                                                                                                    AlignmentObject. *} */
    public      $educationalAlignment           = null;             /* {*property   $educationalAlignment           (AlignmentObject)                               An alignment to an established educational framework.This property
                                                                                                                                                                    should not be used where the nature of the alignment can be described
                                                                                                                                                                    using a simple property, for example to express that a resource
                                                                                                                                                                    teaches or assesses a competency. *} */
    public      $educationalCredentialAwarded   = null;             /* {*property   $educationalCredentialAwarded   (EducationalOccupationalCredential|URL|string)  A description of the qualification, award, certificate, diploma or
                                                                                                                                                                    other educational credential awarded as a consequence of successful
                                                                                                                                                                    completion of this course or program. *} */
    public      $educationalLevel               = null;             /* {*property   $educationalLevel               (DefinedTerm|URL|string)                        The level in terms of progression through an educational or training
                                                                                                                                                                    context. Examples of educational levels include 'beginner',
                                                                                                                                                                    'intermediate' or 'advanced', and formal sets of level indicators. *} */
    public      $educationalUse                 = null;             /* {*property   $educationalUse                 (string)                                        The purpose of a work in the context of education; for example,
                                                                                                                                                                    'assignment', 'group work'. *} */
    public      $hasCourseInstance              = null;             /* {*property   $hasCourseInstance              (CourseInstance)                                An offering of the course at a specific time and place or through
                                                                                                                                                                    specific media or mode of study or to a specific section of students. *} */
    public      $learningResourceType           = null;             /* {*property   $learningResourceType           (string)                                        The predominant type or kind characterizing the learning resource. For
                                                                                                                                                                    example, 'presentation', 'handout'. *} */
    public      $numberOfCredits                = null;             /* {*property   $numberOfCredits                (StructuredValue|int)                           The number of credits or units awarded by a Course or required to
                                                                                                                                                                    complete an EducationalOccupationalProgram. *} */
    public      $occupationalCredentialAwarded  = null;             /* {*property   $occupationalCredentialAwarded  (string|EducationalOccupationalCredential|URL)  A description of the qualification, award, certificate, diploma or
                                                                                                                                                                    other occupational credential awarded as a consequence of successful
                                                                                                                                                                    completion of this course or program. *} */
    public      $teaches                        = null;             /* {*property   $teaches                        (DefinedTerm|string)                            The item being described is intended to help a person learn the
                                                                                                                                                                    competency or learning outcome defined by the referenced term. *} */
                                                                                                                                                                    
    /* === [Properties NOT defined in schema.org] ===================================== */                                                                          
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of Course.__construct() ================================================ */
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
    }   /* End of Course.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Course ============================================================ */
/* ==================================================================================== */
?>