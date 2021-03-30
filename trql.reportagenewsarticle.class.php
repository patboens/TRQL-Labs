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
    {*file                  trql.reportagenewsarticle.class.php *}
    {*purpose               The ReportageNewsArticle type is a subtype of NewsArticle
                            representing news articles which are the result of
                            journalistic news reporting conventions.In practice many
                            news publishers produce a wide variety of article types,
                            many of which might be considered a NewsArticle but not a
                            ReportageNewsArticle. For example, opinion pieces, reviews,
                            analysis, sponsored or satirical articles, or articles that
                            combine several of these elements.The ReportageNewsArticle
                            type is based on a stricter ideal for "news" as a work of
                            journalism, with articles based on factual information
                            either observed or verified by the author, or reported and
                            verified from knowledgeable sources. This often includes
                            perspectives from multiple viewpoints on a particular issue
                            (distinguishing news reports from public relations or
                            propaganda). News reports in the ReportageNewsArticle sense
                            de-emphasize the opinion of the author, with commentary and
                            value judgements typically expressed elsewhere.A
                            ReportageNewsArticle which goes deeper into analysis can
                            also be marked with an additional type of
                            AnalysisNewsArticle. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keyword               creativework *}

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
namespace trql\schema\creativework;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\NewsArticle   as NewsArticle;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'NEWSARTICLE_CLASS_VERSION' ) )
    require_once( 'trql.newsarticle.class.php' );

defined( 'REPORTAGENEWSARTICLE_CLASS_VERSION' ) or define( 'REPORTAGENEWSARTICLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ReportageNewsArticle=

    {*desc

        The ReportageNewsArticle type is a subtype of NewsArticle representing news
        articles which are the result of journalistic news reporting conventions.In
        practice many news publishers produce a wide variety of article types, many
        of which might be considered a NewsArticle but not a ReportageNewsArticle.
        For example, opinion pieces, reviews, analysis, sponsored or satirical
        articles, or articles that combine several of these elements.The
        ReportageNewsArticle type is based on a stricter ideal for "news" as a work
        of journalism, with articles based on factual information either observed
        or verified by the author, or reported and verified from knowledgeable
        sources. This often includes perspectives from multiple viewpoints on a
        particular issue (distinguishing news reports from public relations or
        propaganda). News reports in the ReportageNewsArticle sense de-emphasize
        the opinion of the author, with commentary and value judgements typically
        expressed elsewhere.A ReportageNewsArticle which goes deeper into analysis
        can also be marked with an additional type of AnalysisNewsArticle.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ReportageNewsArticle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class ReportageNewsArticle extends NewsArticle
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
    public      $wikidataId             = null;                     /* {*property   $wikidataId                 (string)                Wikidata ID. No equivalent. *} */


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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of ReportageNewsArticle.__construct() ================================== */
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
    }   /* End of ReportageNewsArticle.__destruct() =================================== */
    /* ================================================================================ */
}   /* End of class ReportageNewsArticle ============================================== */
/* ==================================================================================== */
