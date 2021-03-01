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
    {*file                  trql.publicationissue.class.php *}
    {*purpose               A part of a successively published publication such as a
                            periodical or publication volume, often numbered, usually
                            containing a grouping of works such as articles.See also
                            blog post. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\publicationissue;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'PUBLICATIONISSUE_CLASS_VERSION' ) or define( 'PUBLICATIONISSUE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PublicationIssue=

    {*desc

        A part of a successively published publication such as a periodical or
        publication volume, often numbered, usually containing a grouping of works
        such as articles.See also blog post.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PublicationIssue[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class PublicationIssue extends CreativeWork
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

    public      $issueNumber                    = null;             /* {*property   $issueNumber                    (int|string)                    Identifies the issue of publication; for example, "iii" or "2". *} */
    public      $pageEnd                        = null;             /* {*property   $pageEnd                        (string|int)                    The page on which the work ends; for example "138" or "xvi". *} */
    public      $pageStart                      = null;             /* {*property   $pageStart                      (int|string)                    The page on which the work starts; for example "135" or "xiii". *} */
    public      $pagination                     = null;             /* {*property   $pagination                     (string)                        Any description of pages that is not separated into pageStart and
                                                                                                                                                    pageEnd; for example, "1-6, 9, 55" or "10-12, 46-49". *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */



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
    }   /* End of PublicationIssue.__construct() ====================================== */
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
    }   /* End of PublicationIssue.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class PublicationIssue ================================================== */
/* ==================================================================================== */
?>