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
    {*file                  trql.website.class.php *}
    {*purpose               A WebSite is a set of related web pages and other
                            items typically served from a single web domain and
                            accessible via URLs. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 15:59 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 15:59 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    {*chist
        {*mdate 26-02-21 08:42 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  First steps of the generate() method
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\creativework\CreativeWork                 as CreativeWork;
use \trql\websitegenerator\WebsiteGenerator         as WebsiteGenerator;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'WEBSITE_CLASS_VERSION' ) or define( 'WEBSITE_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class WebSite=

    {*desc

        A WebSite is a set of related web pages and other items typically served
        from a single web domain and accessible via URLs.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/WebSite[/url] *}

    {*todo
        [ol]
            [li]Implement a [c]generate()[/c] method that should take a paradeigma
                and generate a full website[/li]
            [li]Must create a [c]trql.exception.class.php[/c][/li]
            [li]Je dois aussi créer un fichier de type [file]companies.xml[/file] qui
                devra être un objet dérivant d'une classe [c]trql.configurationfile.class[/c],
                elle-même devant au moins répondre au fichiers de type [c]manifest[/c]
                dans uen radio (ce qui devrait aussi être une classe spécifique et qui
                doit répondre également à ce qu'est un manifest pour un site web) et
                au fichier des shows et au fichiers de config radio. Brrrr ... y'a du
                boulot ![/li]
            [li]Je ne trouve pas de propriétés comme [c]pages[/c] dans la classe
                [c]WebSite[/c] et pourtant ... j'ai vraiment besoin de cela pour
                commencer la génération d'un site web[/li]
        [/ol]
    *}

    *}}
 */
/* ================================================================================== */
class WebSite extends CreativeWork implements iContext
/*--------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $issn                   = null;                     /* {*property   $issn                       (string)                            The International Standard Serial Number (ISSN) that
                                                                                                                                                    identifies this serial publication. You can repeat
                                                                                                                                                    this property to identify different formats of, or
                                                                                                                                                    the linking ISSN (ISSN-L) for, this serial publication. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q35127';         /* {*property   $wikidataId                 (string)                            Wikidata ID. set of related web pages served from a single
                                                                                                                                                    web domain *} */
    public      $destinationDir                 = null;             /* {*property   $destinationDir             (string)                            Name where the website is supposed to be generated
                                                                                                                                                    (e.g. "d:/websites/trql.io/") *} */

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
    }   /* End of WebSite.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*generate()=

        Generate a website

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        *}}
    */
    /* ================================================================================ */
    public function generate()
    /*----------------------*/
    {
        if ( empty( $this->url ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": EXCEPTION_CODE_NO_DOMAIN_NAME_FOUND (ErrCode: " . EXCEPTION_CODE_NO_DOMAIN_NAME_FOUND . ")",EXCEPTION_CODE_NO_DOMAIN_NAME_FOUND );
        else
        {
            //throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": EXCEPTION_CODE_UNAVAILABLE (ErrCode: " . EXCEPTION_CODE_UNAVAILABLE . ")",EXCEPTION_CODE_UNAVAILABLE );

            if ( ! defined( 'WEBSITEGENERATOR_CLASS_CLASS' ) )
                require_once( 'trql.websitegenerator.class.php' );

            $oGenerator = new WebsiteGenerator( $this );
            $oGenerator->generate();
        }

        return ( $this );
    }   /* End of WebSite.generate() ================================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of WebSite.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of WebSite.sing() ====================================================== */
    /* ================================================================================ */


    public function __toString() : string
    /*--------------------------------*/
    {
        return( ( $this->url ?? '' ) . ':' . $this->wikidataId );
    }   /* End of WebSite.__toString() ================================================ */
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
    }   /* End of WebSite.__destruct() ================================================ */
    /* ================================================================================ */

    /*  Properties of a website
        =======================

        Depuis cette base, il faut que je compare avec ce qui est sauvé dans le companies.xml

        L'idée c'est de pouvoir créer une photo du site pour m'en servir lors de la génération
        du site.


        public 'about' => null
        public 'accessMode' => null
        public 'accessModeSufficient' => null
        public 'accessibilityAPI' => null
        public 'accessibilityControl' => null
        public 'accessibilityFeature' => null
        public 'accessibilityHazard' => null
        public 'accessibilitySummary' => null
        public 'accountablePerson' => null
        public 'additionalType' => null
        public 'aggregateRating' => null
        public 'alternateName' => null
        public 'alternativeHeadline' => null
        public 'associatedMedia' => null
        public 'audience' => null
        public 'audio' => null
        public 'author' => null
        public 'autodocRequired' => boolean true
        public 'award' => null
        public 'backupRequired' => boolean true
        public 'character' => null
        public 'citation' => null
        public 'classIcon' => string 'D:\websites\snippet-center\q\common\resources\icons\mother.png' (length=62)
        public 'comment' => null
        public 'commentCount' => null
        public 'conditionsOfAccess' => null
        public 'contentLocation' => null
        public 'contentRating' => null
        public 'contentReferenceTime' => null
        public 'contributor' => null
        public 'copyrightHolder' => null
        public 'copyrightYear' => null
        public 'correction' => null
        public 'creativeWorkStatus' => null
        public 'creator' => null
        public 'dateCreated' => null
        public 'dateModified' => null
        public 'datePublished' => null
        public 'description' => null
        public 'destinationDir' => string 'd:/websites/%host%' (length=18)
        public 'disambiguatingDescription' => null
        public 'discussionUrl' => null
        public 'editor' => null
        public 'educationalAlignment' => null
        public 'educationalUse' => null
        public 'encoding' => null
        public 'encodingFormat' => null
        public 'exampleOfWork' => null
        public 'expires' => null
        public 'funder' => null
        public 'genre' => null
        public 'hasPart' => null
        public 'headline' => null
        public 'identifier' => null
        public 'image' => null
        public 'inLanguage' => null
        public 'interactionStatistic' => null
        public 'interactivityType' => null
        public 'isAccessibleForFree' => null
        public 'isBasedOn' => null
        public 'isFamilyFriendly' => null
        public 'isPartOf' => null
        public 'issn' => null
        public 'keywords' => null
        public 'lastInfo' =>
        public 'learning' => boolean true
        public 'learningResourceType' => null
        public 'license' => null
        public 'locationCreated' => null
        public 'mainEntity' => null
        public 'mainEntityOfPage' => null
        public 'material' => null
        public 'materialExtent' => null
        public 'mentions' => null
        public 'name' => null
        public 'offers' => null
        public 'position' => null
        public 'potentialAction' => null
        public 'producer' => null
        public 'provider' => null
        public 'publication' => null
        public 'publisher' => null
        public 'publisherImprint' => null
        public 'publishingPrinciples' => null
        public 'recordedAt' => null
        public 'releasedEvent' => null
        public 'remembering' => boolean true
        public 'review' => null
        public 'sameAs' => null
        public 'schemaVersion' => null
        public 'sdDatePublished' => null
        public 'sdLicense' => null
        public 'sdPublisher' => null
        public 'sourceOrganization' => null
        public 'spatial' => null
        public 'spatialCoverage' => null
        public 'sponsor' => null
        public 'storing' => boolean true
        public 'subjectOf' => null
        public 'temporal' => null
        public 'temporalCoverage' => null
        public 'text' => null
        public 'thumbnailUrl' => null
        public 'timeRequired' => null
        public 'translationOfWork' => null
        public 'translator' => null
        public 'typicalAgeRange' => null
        public 'url' => string 'http://www.trql.io' (length=18)
        public 'version' => null
        public 'video' => null
        public 'wikidataId' => string 'Q35127' (length=6)
        public 'workExample' => null
        public 'workTranslation' => null

    */
}   /* End of class WebSite =========================================================== */
/* ==================================================================================== */
