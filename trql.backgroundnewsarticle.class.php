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
    {*file                  trql.backgroundnewsarticle.class.php *}
    {*purpose               A NewsArticle providing historical context, definition and
                            detail on a specific topic (aka "explainer" or
                            "backgrounder"). For example, an in-depth article or
                            frequently-asked-questions (FAQ) document on topics such as
                            Climate Change or the European Union. Other kinds of
                            background material from a non-news setting are often
                            described using Book or Article, in particular
                            ScholarlyArticle. See also NewsArticle for related
                            vocabulary from a learning/education perspective. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:36 *}
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
namespace trql\backgroundnewsarticle;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\newsarticle\NewsArticle       as NewsArticle;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'NEWSARTICLE_CLASS_VERSION' ) )
    require_once( 'trql.newsarticle.class.php' );

defined( 'BACKGROUNDNEWSARTICLE_CLASS_VERSION' ) or define( 'BACKGROUNDNEWSARTICLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BackgroundNewsArticle=

    {*desc

        A NewsArticle providing historical context, definition and detail on a
        specific topic (aka "explainer" or "backgrounder"). For example, an
        in-depth article or frequently-asked-questions (FAQ) document on topics
        such as Climate Change or the European Union. Other kinds of background
        material from a non-news setting are often described using Book or Article,
        in particular ScholarlyArticle. See also NewsArticle for related vocabulary
        from a learning/education perspective.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BackgroundNewsArticle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.
    *}

 */
/* ==================================================================================== */
class BackgroundNewsArticle extends NewsArticle
/*-------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $dateline                       = null;             /* {*property   $dateline                       (string)                        A dateline is a brief piece of text included in news articles that
                                                                                                                                                    describes where and when the story was written or filed though the
                                                                                                                                                    date is often omitted. Sometimes only a placename is
                                                                                                                                                    provided.Structured representations of dateline-related information
                                                                                                                                                    can also be expressed more explicitly using locationCreated (which
                                                                                                                                                    represents where a work was created e.g. where a news report was
                                                                                                                                                    written). For location depicted or described in the content, use
                                                                                                                                                    contentLocation.Dateline summaries are oriented more towards human
                                                                                                                                                    readers than towards automated processing, and can vary substantially.
                                                                                                                                                    Some examples: "BEIRUT, Lebanon, June 2.", "Paris, France", "December
                                                                                                                                                    19, 2017 11:43AM Reporting from Washington", "Beijing/Moscow", "QUEZON
                                                                                                                                                    CITY, Philippines". *} */
    public      $printColumn                    = null;             /* {*property   $printColumn                    (string)                        The number of the column in which the NewsArticle appears in the print
                                                                                                                                                    edition. *} */
    public      $printEdition                   = null;             /* {*property   $printEdition                   (string)                        The edition of the print product in which the NewsArticle appears. *} */
    public      $printPage                      = null;             /* {*property   $printPage                      (string)                        If this NewsArticle appears in print, this field indicates the name of
                                                                                                                                                    the page on which the article is found. Please note that this field is
                                                                                                                                                    intended for the exact page name (e.g. A5, B18). *} */
    public      $printSection                   = null;             /* {*property   $printSection                   (string)                        If this NewsArticle appears in print, this field indicates the print
                                                                                                                                                    section in which the article appeared. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */


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
    }   /* End of BackgroundNewsArticle.__construct() ================================= */
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
    }   /* End of BackgroundNewsArticle.__destruct() ================================== */
    /* ================================================================================ */
}   /* End of class BackgroundNewsArticle ============================================= */
/* ==================================================================================== */
?>