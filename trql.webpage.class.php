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
    {*file                  trql.webpage.class.php *}
    {*purpose               A web page. Every web page is implicitly assumed to be
                            declared to be of type WebPage, so the various properties
                            about that webpage, such as breadcrumb may be used. We
                            recommend explicit declaration if these properties are
                            specified, but if they are found outside of an itemscope,
                            they will be assumed to be about the page. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 16:14 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 16:14 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\quitus\iContext                   as iContext;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\CreativeWork  as CreativeWork;
use \trql\quitus\Agent                      as Agent;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

if ( ! defined( 'AGENT_CLASS_VERSION' ) )
    require_once( 'trql.agent.class.php' );

defined( 'WEBPAGE_CLASS_VERSION' ) or define( 'WEBPAGE_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class WebPage=

    {*desc

        A web page. Every web page is implicitly assumed to be declared to be of
        type WebPage, so the various properties about that webpage, such as
        breadcrumb may be used. We recommend explicit declaration if these
        properties are specified, but if they are found outside of an itemscope,
        they will be assumed to be about the page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/WebPage[/url] *}

    *}}
 */
/* ================================================================================== */
class WebPage extends CreativeWork implements iContext
/*--------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $breadcrumb                  = null;                /* {*property   $breadcrumb                 (BreadcrumbList|string)             A set of links that can help a user understand and
                                                                                                                                                    navigate a website hierarchy. *} */
    public      $lastReviewed                = null;                /* {*property   $lastReviewed               (Date)                              Date on which the content on this web page was last
                                                                                                                                                    reviewed for accuracy and/or completeness. *} */
    public      $mainContentOfPage           = null;                /* {*property   $mainContentOfPage          (WebPageElement)                    Indicates if this web page element is the main subject
                                                                                                                                                    of the page. Supersedes aspect. *} */
    public      $primaryImageOfPage          = null;                /* {*property   $primaryImageOfPage         (ImageObject)                       Indicates the main image on the page. *} */
    public      $relatedLink                 = null;                /* {*property   $relatedLink                (URL)                               A link related to this web page, for example to
                                                                                                                                                    other related web pages. *} */
    public      $reviewedBy                  = null;                /* {*property   $reviewedBy                 (Organization|Person)               People or organizations that have reviewed the content
                                                                                                                                                    on this web page for accuracy and/or completeness. *} */
    public      $significantLink             = null;                /* {*property   $significantLink            (URL)                               One of the more significant URLs on the page. Typically,
                                                                                                                                                    these are the non-navigation links that are clicked
                                                                                                                                                    on the most. Supersedes significantLinks. *} */
    public      $speakable                   = null;                /* {*property   $speakable                  (SpeakableSpecification|URL)        Indicates sections of a Web page that are particularly
                                                                                                                                                    'speakable' in the sense of being highlighted as being
                                                                                                                                                    especially appropriate for text-to-speech conversion.
                                                                                                                                                    Other sections of a page may also be usefully spoken
                                                                                                                                                    in particular circumstances; the 'speakable' property
                                                                                                                                                    serves to indicate the parts most likely to be
                                                                                                                                                    generally useful for speech.

                                                                                                                                                    The speakable property can be repeated an arbitrary
                                                                                                                                                    number of times, with three kinds of possible
                                                                                                                                                    'content-locator' values:

                                                                                                                                                    1.) id-value URL references - uses id-value of an
                                                                                                                                                    element in the page being annotated. The simplest
                                                                                                                                                    use of speakable has (potentially relative) URL
                                                                                                                                                    values, referencing identified sections of the
                                                                                                                                                    document concerned.

                                                                                                                                                    2.) CSS Selectors - addresses content in the
                                                                                                                                                    annotated page, eg. via class attribute. Use the
                                                                                                                                                    cssSelector property.

                                                                                                                                                    3.) XPaths - addresses content via XPaths (assuming
                                                                                                                                                    an XML view of the content). Use the xpath property.

                                                                                                                                                    For more sophisticated markup of speakable sections
                                                                                                                                                    beyond simple ID references, either CSS selectors or
                                                                                                                                                    XPath expressions to pick out document section(s) as
                                                                                                                                                    speakable. For this we define a supporting type,
                                                                                                                                                    SpeakableSpecification which is defined to be a
                                                                                                                                                    possible value of the speakable property. *} */

    public      $specialty                    = null;               /* {*property   $specialty                  (Specialty)                         One of the domain specialities to which this web
                                                                                                                                                    page's content applies. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q36774';         /* {*property   $wikidataId                 (string)                            Wikidata ID: Single document that is directly viewable
                                                                                                                                                    via the World Wide Web and web browsers *} */
    public      $title                          = null;             /* {*property   $title                      (string)                            Title of the page (like in <head><title>...</title></head> *} */
    public      $szShelter                      = null;             /* {*property   $szShelter                  (string)                            The name of the file where the XML definition of the page is stored *} */
    public      $author                         = null;             /* {*property   $author                     (Agent)                             Author of the page *} */
    public      $szBody                         = null;             /* {*property   $szBody                     (string)                            Main body of a page *} */
	public      $obsolete                       = false;            /* {*property   $obsolete                   (boolean)                           Is this page obsolete or not? [c]false[/c] by default. *} */
    public      $withSocialNetworks             = true;             /* {*property   $withSocialNetworks         (boolean)                           Should social networks be displayed on that page? *} */
	public      $underConstruction              = false;            /* {*property   $underConstruction          (boolean)                           Is this page still under construction ? [c]false[/c] by default *} */
	public      $withLupdate                    = true;             /* {*property   $withLupdate                (boolean)                           Must we display a lupdate tage on the page or not ? [c]true[/c] by default *} */
    public      $szCanonical                    = null;             /* {*property   $szCanonical                (string)                            Canonical URL of the page. *} */
    public      $breakingNews                   = null;             /* {*property   $breakingNews               (boolean)                           Should the Breaking news be displayed on this page: [c]true[/c] if
                                                                                                                                                    yes; [c]false[/c] otherwise. *} */
    public      $guid                           = null;             /* {*property   $guid                       (string)                            Globally unique Identifier of the page. *} */
    public      $H1                             = null;             /* {*property   $H1                         (string)                            H1 of the page. *} */
    public      $seeAlso                        = null;             /* {*property   $seeAlso                    (string)                            Pages interesting to visit from the current page (semi-colon separated list). *} */
    public      $helpPage                       = null;             /* {*property   $helpPage                   (string|URL)                        Help page that provides additional explanations about the current page. *} */
    public      $cargo                          = null;             /* {*property   $cargo                      (string)                            Whatever information seems interesting to load and keep in the page *} */
    public      $analysis                       = null;             /* {*property   $analysis                   (array)                             Result of the analysis of the page (call to [c]analyze()[/c]) *} */
    public      $contentFiles                   = null;             /* {*property   $contentFiles               (array)                             A list of files that are suitable candidates to contain the real payload of the page, its content *} */
    public      $contentFile                    = null;             /* {*property   $contentFile                (string)                            THE file that has been used to extract the real payload of the page, its content *} */
    public      $content                        = null;             /* {*property   $content                    (string)                            The content of the page (the whole HTML) (filled after a call to [c]getURL()[/c]) *} */

    // $szPageImage is now replaced by $primaryImageOfPage
    //public      $szPageImage                    = null;             /* {*property   $szPageImage                (string)                            Image that represents the page (EXCELLENT for SEO)
    //                                                                                                                                                <meta itemscope itemtype="https://schema.org/WebPage"
    //                                                                                                                                                      itemprop="image" content="http://www.example.com/image.jpg">
    //                                                                                                                                                <meta name="twitter:card" content="summary_large_image">
    //                                                                                                                                                <meta name="twitter:image:src" content="http://www.example.com/image.jpg">
    //                                                                                                                                                <meta property="og:image" content="http://example.com/image.jpg" />
    //                                                                                                                                                *} */

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
        $this->updateSelf( __CLASS__,
                           '/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),
                           $withFamily = false );

        $this->author = new Agent();

        return ( $this );
    }   /* End of WebPage.__construct() =============================================== */
    /* ================================================================================ */


    private function curlyBracesToEntities( $szStr )
    /*--------------------------------------------*/
    {
        return ( str_replace( array( '{'     ,'}'      ),
                              array( '&#123;','&#125;' ),
                              $szStr ) );
    }   /* End of WebPage.curlyBracesToEntities() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*readManifest( $szFile )=

        The page meta data is maintained in a XML file. This method permits to read the
        XML file and to populate internal properties based on what is in the XML file.

        {*params
            $szFile     (string)        XML file that holds the description of the page
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
            |** **************************************|
            |** EXAMPLE #1 : CREATE A PAGE TEMPLATE **|
            |** **************************************|

            &lt;?php
            use \trql\vaesoli\Vaesoli   as V;
            use \trql\web\Browser       as Browser;
            use \trql\web\WebPage       as WebPage;

            if ( ! defined( "VAESOLI_CLASS_VERSION" ) )
                require_once( 'trql.vaesoli.class.php' );

            if ( ! defined( "BROWSER_CLASS_VERSION" ) )
                require_once( 'trql.browser.class.php' );

            if ( ! defined( "WEBPAGE_CLASS_VERSION" ) )
                require_once( 'trql.webpage.class.php' );

            [b]$oPage    = new WebPage();[/b]
            $oBrowser = new Browser();
            $oBrowser->parseUA();

            $szBrowserMobility  = strtolower( trim( $oBrowser->szMobility ) );
            $szBrowserName      = $oBrowser->szName;
            $szBrowserType      = $oBrowser->szType;
            $szBrowserPlatform  = $oBrowser->szPlatform;
            $szSeason           = V::TIM_Season();
            $szTimeOfTheDay     = V::TIM_timeOfTheDay( time() );
            $szContentDir       = V::FIL_RealPath( V::FIL_ResolveRoot( '/content' ) );
            $x                  = explode( '.',$_SERVER['HTTP_HOST'] );
            $szSubDomain        = 'www';
            if ( count( $x ) > 2 )
                $szSubDomain = current( $x );

            $szPage = preg_replace( '/(\A-|\.html\z|\.htm\z|\.php\z)/si','',str_replace( '/','-',$_SERVER['SCRIPT_NAME'] ) );

            $aPossibleContentFiles[]    = V::FIL_RealPath( $szContentDir . '/' . $szSubDomain . '-' . $szPage . '-' . $szBrowserMobility . '.html'      );
            $aPossibleContentFiles[]    = V::FIL_RealPath( $szContentDir . '/' . $szSubDomain . '-' . $szPage                            . '.html'      );
            $aPossibleContentFiles[]    = V::FIL_RealPath( $szContentDir . '/' .                      $szPage . '-' . $szBrowserMobility . '.html'      );
            $aPossibleContentFiles[]    = V::FIL_RealPath( $szContentDir . '/' .                      $szPage                            . '.html'      );

            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' . $szSubDomain . '-' . $szPage . '-' . $szBrowserMobility . '.meta.xml'  );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' . $szSubDomain . '-' . $szPage . '-' . $szBrowserMobility . '.xml'       );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' . $szSubDomain . '-' . $szPage                            . '.meta.xml'  );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' . $szSubDomain . '-' . $szPage                            . '.xml'       );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' .                      $szPage . '-' . $szBrowserMobility . '.meta.xml'  );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' .                      $szPage . '-' . $szBrowserMobility . '.xml'       );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' .                      $szPage                            . '.meta.xml'  );
            $aPossiblePageDescription[] = V::FIL_RealPath( $szContentDir . '/' .                      $szPage                            . '.xml'       );

            |** Read the Meta definitions of the page (if any). We have
               multiple possible files, starting from the most specific
               to the less specific. The first one that matches is the
               one we load **|
            foreach( $aPossiblePageDescription as $szXMLFile )
            {
                if ( is_file( $szXMLFile ) )
                {
                    [b]$oPage->readManifest( $szXMLFile );[/b]
                    break;
                }
            }   |** foreach( $aPossiblePageDescription as $szXMLFile ) **|

            ?&gt;
            &lt;!doctype html&gt;
            &lt;html&gt;
                &lt;head&gt;
                    &lt;meta charset=&quot;UTF-8&quot;&gt;
                    &lt;title&gt;[b]&lt;?php echo $oPage-&gt;title; ?&gt;[/b]&lt;/title&gt;
                    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
                    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://fonts.googleapis.com/css?family=Roboto&quot;&gt;
                    &lt;link rel=&quot;stylesheet&quot; href=&quot;/css/mathieu.css&quot;&gt;
                    &lt;meta name=&quot;author&quot; content=&quot;[b]&lt;?php echo $oPage-&gt;author-&gt;name; ?&gt;[/b]&quot;&gt;
                    &lt;meta name=&quot;description&quot; content=&quot;[b]&lt;?php echo $oPage-&gt;description; ?&gt;[/b]&quot;&gt;
                    &lt;meta name=&quot;keywords&quot; content=&quot;[b]&lt;?php echo $oPage-&gt;keywords; ?&gt;[/b]&quot;&gt;
                &lt;/head&gt;

                &lt;body vocab=&quot;https://schema.org/&quot; typeof=&quot;WebPage&quot; class=&quot;&lt;?php echo $szBrowserMobility,' ',$szBrowserName,' ',$szBrowserType,' ',$szBrowserPlatform,' ',$szSeason,' ',$szTimeOfTheDay; ?&gt;&quot;&gt;
                    &lt;div class=&quot;wrapper&quot;&gt;
                    &lt;?php
                        |** We have multiple possible files for the content, starting from
                           the most specific name to the less specific. The first one that
                           matches is the one we load **|
                        foreach( $aPossibleContentFiles as $szFile )
                        {
                            if ( is_file( $szFile ) )
                            {
                                include_once( $szFile );
                                break;
                            }
                        }   |** foreach( $aPossibleContentFiles as $szFile ) **|
                    ?&gt;
                    &lt;/div&gt;
                &lt;/body&gt;
            &lt;/html&gt;
        *}

        *}}
    */
    /* ================================================================================ */
    public function readManifest( $szFile )
    /*-----------------------------------*/
    {
        if ( is_file( $szFile ) )
        {
            //var_dump( "On pourrait lire " . $szFile );

            // Most of the following code comes from quickpage2.class.php (populateFromXML())
		    $oDom = new DOMDocument();

            $this->szShelter = $szFile;

    		if ( @$oDom->Load( $szFile ) )
    		{
    			$oXPath = new DOMXPath( $oDom );

    			if ( $oXPath && ( $oPage = $oXPath->query( '//LSPage' ) ) )
    			{
    				$oPage = $oPage->item(0);

                    //var_dump("ALL OK");
                    //$this->die();

                    {   /* Assign properties */
        				$this->obsolete             = vaesoli::MISC_CastBool( $oPage->getAttribute( 'obsolete'            ),false   );
                        $this->withSocialNetworks   = vaesoli::MISC_CastBool( $oPage->getAttribute( 'social-networks'     ),true    );
        				$this->underConstruction    = vaesoli::MISC_CastBool( $oPage->getAttribute( 'under-construction'  ),false   );
        				$this->withLupdate          = vaesoli::MISC_CastBool( $oPage->getAttribute( 'with-lupdate'        ),true    );
        				$this->breakingNews         = vaesoli::MISC_CastBool( $oPage->getAttribute( 'breaking-news'       ),false   );

        				if ( ( $o = $oXPath->query( 'Title',$oPage      ) ) && ( $o->length > 0 ) )
        					$this->title            = $this->curlyBracesToEntities( $o->item(0)->nodeValue );

        				if ( ( $o = $oXPath->query( 'H1',$oPage         ) ) && ( $o->length > 0 ) )
        					$this->H1               = $o->item(0)->nodeValue;

        				if ( ( $o = $oXPath->query( 'Author',$oPage     ) ) && ( $o->length > 0 ) )
        					$this->author->name     = trim( $o->item(0)->nodeValue );

        				if ( ( $o = $oXPath->query( 'Desc',$oPage       ) ) && ( $o->length > 0 ) )
        					$this->description      = $this->curlyBracesToEntities( $o->item(0)->nodeValue );

        				if ( ( $o = $oXPath->query( 'UsageInfo',$oPage  ) ) && ( $o->length > 0 ) )
        					$this->usageInfo        = $o->item(0)->nodeValue;

        				if ( ( $o = $oXPath->query( 'Keywords',$oPage  ) ) && ( $o->length > 0 ) )
        					$this->keywords         = $o->item(0)->nodeValue;

        				if ( ( $o = $oXPath->query( 'GUID',$oPage ) ) && ( $o->length > 0 ) )
        					$this->szGUID           = $this->curlyBracesToEntities( $o->item(0)->nodeValue );

        				if ( ( $o = $oXPath->query( 'SeeAlso',$oPage ) ) && ( $o->length > 0 ) )
        					$this->seeAlso          = $this->curlyBracesToEntities( $o->item(0)->nodeValue );

        				if ( ( $o = $oXPath->query( 'Cargo',$oPage ) ) && ( $o->length > 0 ) )
        					$this->cargo            = $o->item(0)->nodeValue;

        				if ( ( $o = $oXPath->query( 'HelpPage',$oPage ) ) && ( $o->length > 0 ) )
        					$this->helpPage = $o->item(0)->nodeValue;


        				// commented out because NOT used yet (20201009) $this->Sitemap              = vaesoli::MISC_CastBool(   $oPage->getAttribute( 'sitemap'             ),true  );
        				// commented out because NOT used yet (20201009) $this->Approved             = vaesoli::MISC_CastBool(   $oPage->getAttribute( 'approved'            ),false );
        				// commented out because NOT used yet (20201009) $this->HasWarning           = vaesoli::MISC_CastBool(   $oPage->getAttribute( 'has-warnings'        ),false );
        				// commented out because NOT used yet (20201009) $this->Adult                = vaesoli::MISC_CastBool(   $oPage->getAttribute( 'adult'               ),false );
        				// commented out because NOT used yet (20201009) $this->fPriority            = (float)                   $oPage->getAttribute( 'priority'            );
        				// commented out because NOT used yet (20201009) $this->szFrequency          =                           $oPage->getAttribute( 'frequency'           );
        				// commented out because NOT used yet (20201009) $this->szRating             =                           $oPage->getAttribute( 'rating'              );
        				// commented out because NOT used yet (20201009) $this->iTime                = (int)                     $oPage->getAttribute( 'time'                );
        				// commented out because NOT used yet (20201009) $this->szGroup              =                           $oPage->getAttribute( 'group'               );
        				// commented out because NOT used yet (20201009) $this->szEditors            =                           $oPage->getAttribute( 'editors'             );
        				// commented out because NOT used yet (20201009) $this->szMemberOf           =                           $oPage->getAttribute( 'memberof'            );
        				// commented out because NOT used yet (20201009) $this->IsPublishable        = vaesoli::MISC_CastBool(   $oPage->getAttribute( 'publishable'         ),true );
        				// commented out because NOT used yet (20201009) $this->szReadTime           =                           $oPage->getAttribute( 'read-time'           );
        				// commented out because NOT used yet (20201009) $this->szAgeRating          =                           $oPage->getAttribute( 'age-rating'          );
                        // commented out because NOT used yet (20201009) $this->szUnlockCode         =                           $oPage->getAttribute( 'unlock-code'         );

                        // commented out because NOT used yet (20201009) $this->szPublication        =                           $oPage->getAttribute( 'pubdate'             );
                        // commented out because NOT used yet (20201009) $this->szExpiry             =                           $oPage->getAttribute( 'expiry'              );

                        // commented out because NOT used yet (20201009) $this->szPubDate            =                           substr( $this->szPublication,0,4 ) . '-' .
                        // commented out because NOT used yet (20201009)                                                         substr( $this->szPublication,4,2 ) . '-' .
                        // commented out because NOT used yet (20201009)                                                         substr( $this->szPublication,6,2 );
                        // commented out because NOT used yet (20201009) $this->szPubTime            =                           substr( $this->szPublication,8,2 ) . ':' .
                        // commented out because NOT used yet (20201009)                                                         substr( $this->szPublication,10,2 );

                        // commented out because NOT used yet (20201009) $this->szExpiryDate         =                           substr( $this->szExpiry     ,0,4 ) . '-' .
                        // commented out because NOT used yet (20201009)                                                         substr( $this->szExpiry     ,4,2 ) . '-' .
                        // commented out because NOT used yet (20201009)                                                         substr( $this->szExpiry     ,6,2 );
                        // commented out because NOT used yet (20201009) $this->szExpiryTime         =                           substr( $this->szExpiry     ,8,2 ) . ':' .
                        // commented out because NOT used yet (20201009)                                                         substr( $this->szExpiry     ,10,2 );

                        // commented out because NOT used yet (20201009) $this->szMail               =                           $oPage->getAttribute( 'mail'                );
                        // commented out because NOT used yet (20201009) $this->szUserID             =                           $oPage->getAttribute( 'userid'              );

        				// commented out because NOT used yet (20201009) if ( ! empty( $x = $oPage->getAttribute( 'lang' ) ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szLanguage = $x;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Redirect',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szRedirect           = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'License',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szLicense            = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'FirstPage',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szFirstPage          = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'PreviousPage',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szPrevious           = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'NextPage',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szNext               = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }

        				if ( ( $o = $oXPath->query( 'PageImage',$oPage ) ) && ( $o->length > 0 ) )
        				{
        				    // szPageImage in quickpage2.class.php
        					$this->primaryImageOfPage = $o->item(0)->nodeValue;
        				}

        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Alias',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szAlias              = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Folder',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szFolder             = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Citation',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	//$this->szCitation           = $this->curlyBracesToEntities( utf8_decode( $o->item(0)->nodeValue ) );
        				// commented out because NOT used yet (20201009) 	$this->szCitation           = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'LearnMore',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szLearnMore          = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( empty( $this->szLearnMore ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	if ( ( $o = $oXPath->query( 'OtherPages',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) 	{
        				// commented out because NOT used yet (20201009) 		$this->szLearnMore      = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) 	}
        				// commented out because NOT used yet (20201009) }
        				if ( ( $o = $oXPath->query( 'Canonical',$oPage ) ) && ( $o->length > 0 ) )
        				{
        					$this->szCanonical          = vaesoli::STR_Reduce( $o->item(0)->nodeValue,'/' );
        				}
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'ExpirationHeader',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szExpirationHeader   = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Header',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szHeader             = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009)
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Footer',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szFooter             = $o->item(0)->nodeValue;
        				// commented out because NOT used yet (20201009) }
                    }   /* Assign properties */
    			}   /* if ( $oXPath && ( $oPage = $oXPath->query( '//LSPage' ) ) ) */
    			else
    			{
    			    //var_dump( "PAGE CANNOT BE READ" );
    			    //die();
    			}
    		}   /* if ( $oDom->Load( $szXMLFile ) ) */
    		else
    		{

    		}
        }   /* if ( is_file( $szFile ) ) */

        //var_dump( $this );

        return ( $this );
    }   /* End of WebPage.readManifest() =========================================== */
    public function readDescription( $szFile ) { return ( $this->readManifest( $szFile ) ); }
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getURL()=

        Get the content of the page (the whole HTML)

        {*params
        *}

        {*return
            (self)      The current instance of the class. The result is
                        put in the %var.content% property
        *}

        {*warning
            This method is in development
        *}

        *}}
    */
    /* ================================================================================ */
    public function getURL( $szURL = null,$aParams = null )
    /*---------------------------------------------------*/
    {
        $this->content = null;

        $szURL = $szURL ?? $this->url;

        if ( ! empty( $szURL ) )
        {
            $this->content = parent::getURL( $szURL,$aParams );
        }   /* if ( ! empty( $szURL ) ) */

        return ( $this );
    }   /* End of WebPage.getURL() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*analyze()=

        Ananlyze the content of a web page

        {*params
        *}

        {*return
            (self)      The current instance of the class. The result of the analysis is
                        put in the %var.analysis% property
        *}

        {*warning
            This method is in development
        *}

            $analysis['tags']['html']
                             ['head']
                             ['head']['raw']
                                     ['metas']
                                     ['links']
            $analysis['tags']['body']
                             ['body']['navs']
            $analysis['scripts']
            $analysis['styles']
            $analysis['headings']
        *}}
    */
    /* ================================================================================ */
    public function analyze()
    /*----------------------*/
    {
        $this->analysis = null;

        if ( ! empty( $this->content ) )
        {
            $aStruct = array();

            if ( preg_match( '%<html\b[^>]*>%si',$this->content,$aMatches ) )
                $aStruct['tags']['html'] = $aMatches[0];

            if ( preg_match( '%<head\b[^>]*>(.*?)</head>%si',$this->content,$aMatches ) )
            {
                $aStruct['tags']['head'] = array( 'raw' => $aMatches[0] );

                if ( preg_match_all( '%<meta(\b[^>]*)/>%si',$aStruct['tags']['head']['raw'],$aMatches, PREG_PATTERN_ORDER ) )
                    $aStruct['tags']['head']['metas'] = $aMatches[0];

                if ( preg_match_all( '%<link(\b[^>]*)/>%si',$aStruct['tags']['head']['raw'],$aMatches, PREG_PATTERN_ORDER ) )
                    $aStruct['tags']['head']['links'] = $aMatches[0];
            }

            if ( preg_match( '%<body\b[^>]*>(.*?)</body>%si',$this->content,$aMatches ) )
            {
                $szPure = vaesoli::STR_Reduce( vaesoli::STR_commonSpaces( preg_replace( '/<[^>]*>/si',' ',$aMatches[0] ) ),' ' );
                $aTmp   = vaesoli::STR_sentences( $aMatches[0] );

                foreach( $aTmp as $szSentence )
                    $aSentences[] = vaesoli::STR_commonSpaces( $szSentence );

                $aStruct['tags']['body'] = array( 'raw'         => $aMatches[0] ,
                                                  'pure'        => $szPure      ,
                                                  'sentences'   => $aSentences  ,
                                                );

                if ( preg_match_all( '%<nav\b[^>]*>(.*?)</nav>%si',$aStruct['tags']['body']['raw'],$aMatches, PREG_PATTERN_ORDER ) )
                    $aStruct['tags']['body']['navs'] = $aMatches[0];
            }

            if ( preg_match_all( '%<script\b[^>]*>(.*?)</script>%si'    ,$this->content,$aMatches,PREG_PATTERN_ORDER ) )
                $aStruct['scripts'] = $aMatches[0];

            if ( preg_match_all( '%<style\b[^>]*>(.*?)</style>%si'      ,$this->content,$aMatches,PREG_PATTERN_ORDER ) )
                $aStruct['styles'] = $aMatches[0];

            if ( preg_match_all( '%<h([1-6])\b[^>]*>(.*?)</h\g{1}>%si'  ,$this->content,$aMatches,PREG_PATTERN_ORDER ) )
                $aStruct['headings'] = $aMatches[0];

            $this->analysis = $aStruct;
        }

        return ( $this );
    }   /* End of WebPage.analyze() =================================================== */
    /* ================================================================================ */



    /* ================================================================================ */
    /** {{*renderComments()=

        Renders all comments of the page

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*warning
            This method is experimental
        *}

        *}}
    */
    /* ================================================================================ */
    public function renderComments()
    /*----------------------------*/
    {
        $szRetVal = '';

        return ( $szRetVal );
    }   /* End of WebPage.renderComments() ============================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of WebPage.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of WebPage.sing() ====================================================== */
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
    }   /* End of WebPage.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class WebPage =========================================================== */
/* ==================================================================================== */
