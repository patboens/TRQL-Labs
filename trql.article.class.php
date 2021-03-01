<?php
/****************************************************************************************/

/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.article.class.php *}
    {*purpose               An article, such as a news article or piece of investigative
                            report. Newspapers and magazines have articles of many 
                            different types and this is intended to cover them all. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 19:19 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 22:23 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\article;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\creativework\CreativeWork                 as CreativeWork;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'ARTICLE_CLASS_VERSION' ) or define( 'ARTICLE_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class Article=

    {*desc

        An article, such as a news article or piece of investigative report.
        Newspapers and magazines have articles of many different types and this
        is intended to cover them all.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Article[/url] *}

    *}}
 */
/* ================================================================================== */
class Article extends CreativeWork implements iContext
/*--------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $articleBody                = null;                 /* {*property   $articleBody                (string)                            The actual body of the article. *} */
    public      $articleSection             = null;                 /* {*property   $articleSection             (string)                            Articles may belong to one or more 'sections' in a magazine or newspaper, such
                                                                                                                                                    as Sports, Lifestyle, etc. *} */
    public      $backstory                  = null;                 /* {*property   $backstory                  (CreativeWork|string)               For an Article, typically a NewsArticle, the backstory property provides a
                                                                                                                                                    textual summary giving a brief explanation of why and how an article was
                                                                                                                                                    created. In a journalistic setting this could include information about
                                                                                                                                                    reporting process, methods, interviews, data sources, etc. *} */
    public      $pageEnd                    = null;                 /* {*property   $pageEnd                    (integer|string)                    The page on which the work ends; for example "138" or "xvi". *} */
    public      $pageStart                  = null;                 /* {*property   $pageStart                  (integer|string)                    The page on which the work starts; for example "135" or "xiii". *} */
    public      $pagination                 = null;                 /* {*property   $pagination                 (string)                            Any description of pages that is not separated into pageStart and pageEnd;
                                                                                                                                                    for example, "1-6, 9, 55" or "10-12, 46-49". *} */
    public      $speakable                  = null;                 /* {*property   $speakable                  (SpeakableSpecification|URL)        Indicates sections of a Web page that are particularly 'speakable' in the
                                                                                                                                                    sense of being highlighted as being especially appropriate for text-to-speech
                                                                                                                                                    conversion. Other sections of a page may also be usefully spoken in particular
                                                                                                                                                    circumstances; the 'speakable' property serves to indicate the parts most
                                                                                                                                                    likely to be generally useful for speech.
                
                                                                                                                                                    The speakable property can be repeated an arbitrary number of times,
                                                                                                                                                    with three kinds of possible 'content-locator' values:
                
                                                                                                                                                    1.) id-value URL references - uses id-value of an element in the page being annotated.
                                                                                                                                                        The simplest use of speakable has (potentially relative) URL values, referencing
                                                                                                                                                        identified sections of the document concerned.
                
                                                                                                                                                    2.) CSS Selectors - addresses content in the annotated page, eg. via class attribute.
                                                                                                                                                        Use the cssSelector property.
                
                                                                                                                                                    3.) XPaths - addresses content via XPaths (assuming an XML view of the content).
                                                                                                                                                        Use the xpath property.
                
                                                                                                                                                    For more sophiNewssticated markup of speakable sections beyond simple ID references,
                                                                                                                                                    either CSS selectors or XPath expressions to pick out document section(s) as
                                                                                                                                                    speakable. For this we define a supporting type, SpeakableSpecification which is
                                                                                                                                                    defined to be a possible value of the speakable property. *} */
    public      $wordCount                  = null;                 /* {*property   $wordCount                  (integer)                           The number of words in the text of the Article. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q191067';            /* {*property   $wikidataId                 (string)                            Wikidata ID: Text that forms an independent part of a publication *} */

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
    }   /* End of Article.__construct() =============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Article.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Article.sing() ====================================================== */
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
    }   /* End of Article.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class Article =========================================================== */
/* ==================================================================================== */
?>