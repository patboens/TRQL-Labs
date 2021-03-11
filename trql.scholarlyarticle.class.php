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
    {*file                  trql.scholarlyarticle.class.php *}
    {*purpose               A scholarly article. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\scholarlyarticle;

use \trql\vaesoli\Vaesoli    as Vaesoli;
use \trql\article\Article    as Article;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ARTICLE_CLASS_VERSION' ) )
    require_once( 'trql.article.class.php' );

defined( 'SCHOLARLYARTICLE_CLASS_VERSION' ) or define( 'SCHOLARLYARTICLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ScholarlyArticle=

    {*desc

        A scholarly article.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ScholarlyArticle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

    *}}

 */
/* ==================================================================================== */
class ScholarlyArticle extends Article
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $articleBody                    = null;             /* {*property   $articleBody                    (string)                        The actual body of the article. *} */
    public      $articleSection                 = null;             /* {*property   $articleSection                 (string)                        Articles may belong to one or more 'sections' in a magazine or
                                                                                                                                                    newspaper, such as Sports, Lifestyle, etc. *} */
    public      $backstory                      = null;             /* {*property   $backstory                      (string|CreativeWork)           For an @class.Article, typically a @class.NewsArticle, the backstory property
                                                                                                                                                    provides a textual summary giving a brief explanation of why and how
                                                                                                                                                    an article was created. In a journalistic setting this could include
                                                                                                                                                    information about reporting process, methods, interviews, data
                                                                                                                                                    sources, etc. *} */
    public      $pageEnd                        = null;             /* {*property   $pageEnd                        (string|int)                    The page on which the work ends; for example "138" or "xvi". *} */
    public      $pageStart                      = null;             /* {*property   $pageStart                      (int|string)                    The page on which the work starts; for example "135" or "xiii". *} */
    public      $pagination                     = null;             /* {*property   $pagination                     (string)                        Any description of pages that is not separated into pageStart and
                                                                                                                                                    pageEnd; for example, "1-6, 9, 55" or "10-12, 46-49". *} */
    public      $speakable                      = null;             /* {*property   $speakable                      (URL|SpeakableSpecification)    Indicates sections of a Web page that are particularly 'speakable' in
                                                                                                                                                    the sense of being highlighted as being especially appropriate for
                                                                                                                                                    text-to-speech conversion. Other sections of a page may also be
                                                                                                                                                    usefully spoken in particular circumstances; the 'speakable' property
                                                                                                                                                    serves to indicate the parts most likely to be generally useful for
                                                                                                                                                    speech.The speakable property can be repeated an arbitrary number of
                                                                                                                                                    times, with three kinds of possible 'content-locator' values:1.)
                                                                                                                                                    id-value URL references - uses id-value of an element in the page
                                                                                                                                                    being annotated. The simplest use of speakable has (potentially
                                                                                                                                                    relative) URL values, referencing identified sections of the document
                                                                                                                                                    concerned.2.) CSS Selectors - addresses content in the annotated page,
                                                                                                                                                    eg. via class attribute. Use the cssSelector property.3.) XPaths -
                                                                                                                                                    addresses content via XPaths (assuming an XML view of the content).
                                                                                                                                                    Use the xpath property.For more sophisticated markup of speakable
                                                                                                                                                    sections beyond simple ID references, either CSS selectors or XPath
                                                                                                                                                    expressions to pick out document section(s) as speakable. For thiswe
                                                                                                                                                    define a supporting type, @class.SpeakableSpecification which is defined to
                                                                                                                                                    be a possible value of the speakable property. *} */
    public      $wordCount                      = null;             /* {*property   $wordCount                      (int)                           The number of words in the text of the @class.Article. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q13442814';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Scholarly article ... Article in an academic publication, 
                                                                                                                                                    usually peer reviewed *} */



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
    }   /* End of ScholarlyArticle.__construct() ====================================== */
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
    }   /* End of ScholarlyArticle.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class ScholarlyArticle ================================================== */
/* ==================================================================================== */
