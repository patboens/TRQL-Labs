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
    {*file                  trql.imagegallery.class.php *}
    {*purpose               Web page type: Image gallery page. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keyword               web *}

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
namespace trql\web;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\web\MediaGallery     as MediaGallery;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDIAGALLERY_CLASS_VERSION' ) )
    require_once( 'trql.mediagallery.class.php' );

defined( 'IMAGEGALLERY_CLASS_VERSION' ) or define( 'IMAGEGALLERY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ImageGallery=

    {*desc

        Web page type: Image gallery page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ImageGallery[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}
 */
/* ==================================================================================== */
class ImageGallery extends MediaGallery
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $breadcrumb                     = null;             /* {*property   $breadcrumb                     (BreadcrumbList|string)         A set of links that can help a user understand and navigate a website
                                                                                                                                                    hierarchy. *} */
    public      $lastReviewed                   = null;             /* {*property   $lastReviewed                   (Date)                          Date on which the content on this web page was last reviewed for
                                                                                                                                                    accuracy and/or completeness. *} */
    public      $mainContentOfPage              = null;             /* {*property   $mainContentOfPage              (WebPageElement)                Indicates if this web page element is the main subject of the page. *} */
    public      $primaryImageOfPage             = null;             /* {*property   $primaryImageOfPage             (ImageObject)                   Indicates the main image on the page. *} */
    public      $relatedLink                    = null;             /* {*property   $relatedLink                    (URL)                           A link related to this web page, for example to other related web
                                                                                                                                                    pages. *} */
    public      $reviewedBy                     = null;             /* {*property   $reviewedBy                     (Person|Organization)           People or organizations that have reviewed the content on this web
                                                                                                                                                    page for accuracy and/or completeness. *} */
    public      $significantLink                = null;             /* {*property   $significantLink                (URL)                           One of the more significant URLs on the page. Typically, these are the
                                                                                                                                                    non-navigation links that are clicked on the most. *} */
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
                                                                                                                                                    define a supporting type, SpeakableSpecification which is defined to
                                                                                                                                                    be a possible value of the speakable property. *} */
    public      $specialty                      = null;             /* {*property   $specialty                      (Specialty)                     One of the domain specialities to which this web page's content
                                                                                                                                                    applies. *} */

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of ImageGallery.__construct() ========================================== */
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
    }   /* End of ImageGallery.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class ImageGallery ====================================================== */
/* ==================================================================================== */
