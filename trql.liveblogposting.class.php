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
    {*file                  trql.liveblogposting.class.php *}
    {*purpose               A blog post intended to provide a rolling textual coverage
                            of an ongoing event through continuous updates. *}
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
namespace trql\schema\creativework;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\BlogPosting   as BlogPosting;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'BLOGPOSTING_CLASS_VERSION' ) )
    require_once( 'trql.blogposting.class.php' );

defined( 'LIVEBLOGPOSTING_CLASS_VERSION' ) or define( 'LIVEBLOGPOSTING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LiveBlogPosting=

    {*desc

        A blog post intended to provide a rolling textual coverage of an ongoing
        event through continuous updates.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/LiveBlogPosting[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class LiveBlogPosting extends BlogPosting
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

    public      $coverageEndTime                = null;             /* {*property   $coverageEndTime                (DateTime)                      The time when the live blog will stop covering the Event. Note that
                                                                                                                                                    coverage may continue after the Event concludes. *} */
    public      $coverageStartTime              = null;             /* {*property   $coverageStartTime              (DateTime)                      The time when the live blog will begin covering the Event. Note that
                                                                                                                                                    coverage may begin before the Event's start time. The LiveBlogPosting
                                                                                                                                                    may also be created before coverage begins. *} */
    public      $liveBlogUpdate                 = null;             /* {*property   $liveBlogUpdate                 (BlogPosting)                   An update to the LiveBlog. *} */


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
    }   /* End of LiveBlogPosting.__construct() ======================================= */
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
    }   /* End of LiveBlogPosting.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class LiveBlogPosting =================================================== */
/* ==================================================================================== */
?>