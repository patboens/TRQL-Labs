<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.webpage.class.php *}
    {*purpose               A web page. Every web page is implicitly assumed to be 
                            declared to be of type WebPage, so the various properties
                            about that webpage, such as breadcrumb may be used. We 
                            recommend explicit declaration if these properties are 
                            specified, but if they are found outside of an itemscope,
                            they will be assumed to be about the page. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 16-08-20 16:14 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

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
namespace trql\webpage;

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

defined( 'WEBPAGE_CLASS_VERSION' ) or define( 'WEBPAGE_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

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
    public      $wikidataId                     = 'Q36774';         /* {*property   $wikidataId                 (string)                            https://www.wikidata.org/wiki/Q36774 *} */
    public      $szShelter                      = null;             /* {*property   $szShelter                  (string)                            The name of the file where the XML definition of the page is stored *} */
    public      $szAuthor                       = null;             /* {*property   $szAuthor                   (string)                            Name of the author of the page *} */
    public      $szComment                      = null;             /* {*property   $szComment                  (string)                            Comments set for that page (not published) *} */
    public      $szBody                         = null;             /* {*property   $szBody                     (string)                            Main body of a page *} */
	public      $Obsolete                       = false;            /* {*property   $obsolete                   (boolean)                           Is this page obsolete or not? [c]false[/c] by default. *} */
    public      $WithSocialNetworks             = true;             /* {*property   $WithSocialNetworks         (boolean)                           Should social networks be displayed on that page? *} */
	public      $UnderConstruction              = false;            /* {*property   $UnderConstruction          (boolean)                           Is this page still under construction ? [c]false[/c] by default *} */
	public      $WithLupdate                    = true;             /* {*property   $WithLupdate                (boolean)                           Must we display a lupdate tage on the page or not ? [c]true[/c] by default *} */
    public      $szCanonical                    = null;             /* {*property   $szCanonical                (string)                            Canonical URL of the page. *} */

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of WebPage.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*readDescription( $szFile )=

        The page meta data is maintained in a XML file. This method permits to read the
        XML file and to populate internal properties based on what is in the XML file.

        {*params
            $szFile     (string)        XML file that holds the description of the page
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function readDescription( $szFile )
    /*--------------------------------------*/
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

                    {   /* Assign properties */
        				$this->Obsolete             = vaesoli::MISC_CastBool( $oPage->getAttribute( 'obsolete'            ),false   );
                        $this->WithSocialNetworks   = vaesoli::MISC_CastBool( $oPage->getAttribute( 'social-networks'     ),true    );
        				$this->UnderConstruction    = vaesoli::MISC_CastBool( $oPage->getAttribute( 'under-construction'  ),false   );
        				$this->WithLupdate          = vaesoli::MISC_CastBool( $oPage->getAttribute( 'with-lupdate'        ),true    );
        				// commented out because NOT used yet (20201009) $this->BreakingNews         = vaesoli::MISC_CastBool(   $oPage->getAttribute( 'breaking-news'       ),false );
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

        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'GUID',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szGUID           = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
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
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Title',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	//$this->szTitle              = $this->curlyBracesToEntities( utf8_decode( $o->item(0)->nodeValue ) );
        				// commented out because NOT used yet (20201009) 	$this->szTitle              = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'H1',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	//$this->szH1                 = $this->curlyBracesToEntities( utf8_decode( $o->item(0)->nodeValue ) );
        				// commented out because NOT used yet (20201009) 	$this->szH1                 = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Author',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szAuthor             = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Folder',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szFolder             = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Desc',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szDesc               = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Comment',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szComment            = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
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
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'SeeAlso',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	$this->szSeealso            = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
        				// commented out because NOT used yet (20201009) if ( ( $o = $oXPath->query( 'Keywords',$oPage ) ) && ( $o->length > 0 ) )
        				// commented out because NOT used yet (20201009) {
        				// commented out because NOT used yet (20201009) 	//$this->szKeywords = $this->curlyBracesToEntities( utf8_decode( $o->item(0)->nodeValue ) );
        				// commented out because NOT used yet (20201009) 	$this->szKeywords = $this->curlyBracesToEntities( $o->item(0)->nodeValue );
        				// commented out because NOT used yet (20201009) }
                        // commented out because NOT used yet (20201009) 
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
    }   /* End of WebPage.readDescription() =========================================== */
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
    }   /* End of WebPage.renderComments() =============================================== */
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
?>