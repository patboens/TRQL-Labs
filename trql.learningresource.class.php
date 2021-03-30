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
    {*file                  trql.learningresource.class.php *}
    {*purpose               The LearningResource type can be used to indicate
                            CreativeWorks (whether physical or digital) that have a
                            particular and explicit orientation towards learning,
                            education, skill acquisition, and other educational
                            purposes.LearningResource is expected to be used as an
                            addition to a primary type such as Book, Video, Product
                            etc.EducationEvent serves a similar purpose for event-like
                            things (e.g. a Trip). A LearningResource may be created as a
                            result of an EducationEvent, for example by recording one. *}
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
namespace trql\learningresource;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'LEARNINGRESOURCE_CLASS_VERSION' ) or define( 'LEARNINGRESOURCE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LearningResource=

    {*desc

        The LearningResource type can be used to indicate CreativeWorks (whether
        physical or digital) that have a particular and explicit orientation
        towards learning, education, skill acquisition, and other educational
        purposes.LearningResource is expected to be used as an addition to a
        primary type such as Book, Video, Product etc.EducationEvent serves a
        similar purpose for event-like things (e.g. a Trip). A LearningResource
        may be created as a result of an EducationEvent, for example by
        recording one.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/LearningResource[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class LearningResource extends CreativeWork
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $assesses                       = null;             /* {*property   $assesses                       (string|DefinedTerm)            The item being described is intended to assess the competency or
                                                                                                                                                    learning outcome defined by the referenced term. *} */
    public      $competencyRequired             = null;             /* {*property   $competencyRequired             (string|URL)                    Knowledge, skill, ability or personal attribute that must be 
                                                                                                                                                    demonstrated by a person or other entity in order to do something 
                                                                                                                                                    such as earn an Educational Occupational Credential or understand 
                                                                                                                                                    a LearningResource. *} */
    public      $educationalAlignment           = null;             /* {*property   $educationalAlignment           (AlignmentObject)               An alignment to an established educational framework.This property
                                                                                                                                                    should not be used where the nature of the alignment can be described
                                                                                                                                                    using a simple property, for example to express that a resource
                                                                                                                                                    teaches or assesses a competency. *} */
    public      $educationalLevel               = null;             /* {*property   $educationalLevel               (DefinedTerm|URL|string)        The level in terms of progression through an educational or training
                                                                                                                                                    context. Examples of educational levels include 'beginner',
                                                                                                                                                    'intermediate' or 'advanced', and formal sets of level indicators. *} */
    public      $educationalUse                 = null;             /* {*property   $educationalUse                 (string)                        The purpose of a work in the context of education; for example,
                                                                                                                                                    'assignment', 'group work'. *} */
    public      $learningResourceType           = null;             /* {*property   $learningResourceType           (string)                        The predominant type or kind characterizing the learning resource. For
                                                                                                                                                    example, 'presentation', 'handout'. *} */
    public      $teaches                        = null;             /* {*property   $teaches                        (DefinedTerm|string)            The item being described is intended to help a person learn the
                                                                                                                                                    competency or learning outcome defined by the referenced term. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of LearningResource.__construct() ====================================== */
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
    }   /* End of LearningResource.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class LearningResource ================================================== */
/* ==================================================================================== */
?>