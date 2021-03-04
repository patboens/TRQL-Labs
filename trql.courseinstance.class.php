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
    {*file                  trql.courseinstance.class.php *}
    {*purpose               An instance of a Course which is distinct from other
                            instances because it is offered at a different time or
                            location or through different media or modes of study or to
                            a specific section of students. *}
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
namespace trql\courseinstance;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\event\Event           as Event;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'EVENT_CLASS_VERSION' ) )
    require_once( 'trql.event.class.php' );

defined( 'COURSEINSTANCE_CLASS_VERSION' ) or define( 'COURSEINSTANCE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CourseInstance=

    {*desc

        An instance of a Course which is distinct from other instances because it
        is offered at a different time or location or through different media or
        modes of study or to a specific section of students.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CourseInstance[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

    *}}

 */
/* ==================================================================================== */
class CourseInstance extends Event
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $courseMode                     = null;             /* {*property   $courseMode                     (URL|string)                    The medium or means of delivery of the course instance or the mode of
                                                                                                                                                    study, either as a text label (e.g. "online", "onsite" or "blended";
                                                                                                                                                    "synchronous" or "asynchronous"; "full-time" or "part-time") or as a
                                                                                                                                                    URL reference to a term from a controlled vocabulary (e.g.
                                                                                                                                                    https://ceds.ed.gov/element/001311#Asynchronous ). *} */
    public      $courseWorkload                 = null;             /* {*property   $courseWorkload                 (string)                        The amount of work expected of students taking the course, often
                                                                                                                                                    provided as a figure per week or per month, and may be broken down by
                                                                                                                                                    type. For example, "2 hours of lectures, 1 hour of lab work and 3
                                                                                                                                                    hours of independent study per week". *} */
    public      $instructor                     = null;             /* {*property   $instructor                     (Person)                        A person assigned to instruct or provide instructional assistance for
                                                                                                                                                    the CourseInstance. *} */

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
    }   /* End of CourseInstance.__construct() ======================================== */
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
    }   /* End of CourseInstance.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class CourseInstance ==================================================== */
/* ==================================================================================== */
?>