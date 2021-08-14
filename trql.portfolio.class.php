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
    {*file                  trql.portfolio.class.php *}
    {*purpose               Work comprising a list of items. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 05-01-21 10:10 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keywords              Agility *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 05-01-21 10:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\quitus\Catalog        as Catalog;
use \trql\XML\XML               as XML;
use \trql\schema\Aspiration     as Aspiration;
use \trql\quitus\Mission        as Mission;
use \trql\quitus\RoadMap        as RoadMap;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CATALOG_CLASS_VERSION' ) )
    require_once( 'trql.catalog.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

if ( ! defined( 'ASPIRATION_CLASS_VERSION' ) )
    require_once( 'trql.project.class.php' );

if ( ! defined( 'MISSION_CLASS_VERSION' ) )
    require_once( 'trql.mission.class.php' );

defined( 'PORTFOLIO_CLASS_VERSION' ) or define( 'PORTFOLIO_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Portfolio=

    {*desc

        A catalog of aspirations (projects and programmes)

    *}

    *}}
 */
/* ==================================================================================== */
class Portfolio extends Catalog
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId         = 'Q95975598';                  /* {*property   $wikidataId                     (string)                        wikidataId. Container for documents.
                                                                                                                                                    There is also another notion that comes close
                                                                                                                                                    to what TRQL Labs calls a portfolio: unbound
                                                                                                                                                    collection of visual artworks housed in a
                                                                                                                                                    binder, folder or other container ('Q79509036') *} */
    public      $aAspirations       = null;                         /* {*property   $aAspirations                   (array)                         An array of Aspirations belonging to the Portfolio *} */
    public      $shelter            = '/../databases/PMO';          /* {*property   $shelter                        (string)                        A relative path where all Aspirations get stored.
                                                                                                                                                    Supersedes szStorageFolder *} */
    protected   $aStorageMap        = null;                         /* {*property   $aStorageMap                    (array)                         Set of values that depicts where the portfolio gets stored. *} */
    protected   $modulo             = 977;                          /* {*property   $modulo                         (int)                           Prime number used to determine the exact storage location
                                                                                                                                                    of the portfolio (see trql.storage.trait.php). *} */
    public      $aDomains           = null;                         /* {*property   $aDomains                       (array)                         Array of domains pertaining to the Portfolio (e.g.
                                                                                                                                                    "payments", "cards", ...) *} */
    public      $oMission           = null;                         /* {*property   $oMission                       (Mission)                       The Portfolio mission (if any). *} */
    public      $szCodeName         = null;                         /* {*property   $szCodeName                     (string)                        Code name of the Portfolio. *} */

    /* ================================================================================ */
    /** {{*__construct( [$szIdentifier] )=

        Class constructor

        {*params
            $szIdentifier       (string)       Portfolio identifier. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
            use \trql\vaesoli\VaeSoli           as VaeSoli;
            use \trql\kanbanboard\KanbanBoard   as KanbanBoard;
            [b]use \trql\portfolio\Portfolio       as Portfolio;[/b]
            use \trql\project\Aspiration        as Aspiration;

            if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
                require_once( 'trql.vaesoli.class.php' );

            if ( ! defined( 'KANBANBOARD_CLASS_VERSION' ) )
                require_once( 'trql.kanbanboard.class.php' );

            [b]if ( ! defined( 'PORTFOLIO_CLASS_VERSION' ) )
                require_once( 'trql.portfolio.class.php' );[/b]

            if ( ! defined( 'ASPIRATION_CLASS_VERSION' ) )
                require_once( 'trql.project.class.php' );

            [b]$oPortfolio = new Portfolio();          // Create a portfolio
            $oPortfolio->szCodeName = 'openpmo';    // Give the code name of this portfolio
            $oPortfolio->load();                    // Now load the portfolio
            $oPortfolio->findAspirations();         // Find all Aspirations (projects, initiatives, ...) belonging to this portfolio

            if ( is_array( $oPortfolio->aAspirations ) && count( $oPortfolio->aAspirations ) > 0 )
            {
                foreach( $oPortfolio->aAspirations as $oAspiration )
                {
                    // Do something
                }
            }[/b]

        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        //// Eliminate anything that is NOT a letter, a digit, an underscore or an hyphen
        //if ( ! empty( $szIdentifier ) )
        //    $this->aStorageMap = $this->map( $this->identifier = preg_replace( '/[^[a-zA-Z0-9_\-]/si','',$szIdentifier ),
        //                                     $this->modulo );
        //else
        //    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": MISSING PARAMETER : Portfolio identifier (ErrCode: " . EXCEPTION_CODE_MISSING_PARAMETER . " - MISSING PARAMETER)",EXCEPTION_CODE_MISSING_PARAMETER );

        $this->oMission = new Mission();

        return ( $this );
    }   /* End of Portfolio.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getFolder()=

        Get the exact tree structure from which THIS portfolio is supposed to be retrieved
        and saved to

        {*params
        *}

        {*return
            (string)    The tree structure where the Portfolio is stored
        *}

        *}}
    */
    /* ================================================================================ */
    public function getFolder():string
    /*------------------------------*/
    {
        static $szFolder = null;


        // Old code that got rid of some characters
        // $this->aStorageMap = $this->map( $this->identifier = preg_replace( '/[^[a-zA-Z0-9_\-]/si','',$szIdentifier ),

        if ( is_null( $szFolder ) )
        {
            $this->aStorageMap = $this->map( $this->szCodeName,$this->modulo );

            $szFolder = vaesoli::FIL_RealPath( vaesoli::FIL_ResolveRoot( $this->shelter         . '/' .
                                                                         $this->aStorageMap['level1']   . '/' .
                                                                         $this->aStorageMap['level2']   . '/' .
                                                                         $this->aStorageMap['level3']   . '/' .
                                                                         $this->aStorageMap['level4'] ) );
        }   /* if ( is_null( $szFolder ) ) */

        return ( $szFolder );
    }   /* End of Portfolio.getFolder() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*findAspirations()=

        Find all aspirations (a generic term for a project, an initiative, an idea, an
        ambition, ...) belonging to this portfolio.

        {*params
        *}

        {*return
            (array)     Array of aspirations objects or [c]null[/c] if none found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function findAspirations()
    /*-----------------------------*/
    {
        $szMask = $this->getFolder() . '/' . $this->szCodeName . '.*.aspiration.xml';
        //var_dump( $szMask );

        $tStart = microtime( true );
        /* Look for Aspirations in the Portfolio folder */
        if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( vaesoli::FIL_RealPath( $szMask ) ) ) && count( $aFiles ) > 0 )
        {
            $tEnd = microtime( true );
            //var_dump( "FIL_aFilesEx() en " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );
            //var_dump( $aFiles );
            foreach ( $aFiles as $szFile )
            {
                // NOTE DE PERFORMANCE:
                // La création d'une Aspiration est lente : 0.29 sec
                // Le chargement d'une Aspiration est également lente : 0.6 sec

                $tStart = microtime( true );
                $oAspiration = new Aspiration();
                //var_dump( "Nouvelle aspiration créée en " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );
                //var_dump( $oAspiration );

                $tStart = microtime( true );
                if ( $oAspiration->load( $szFile ) )
                {
                    //var_dump( $oAspiration );
                    //$this->die();
                    //var_dump( "Nouvelle aspiration chargée en " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );
                    $oAspiration->oParentPortfolio  = $this;

                    // Overwrite what the Aspiration has concluded
                    $oAspiration->szStorage = $this->shelter       . '/' .
                                              $this->aStorageMap['level1'] . '/' .
                                              $this->aStorageMap['level2'] . '/' .
                                              $this->aStorageMap['level3'] . '/' .
                                              $this->aStorageMap['level4'] . '/' . basename( $szFile );

                    $this->aAspirations[] = $oAspiration;
                }
                else
                    $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : {$szFile} could NOT be loaded" );
            }   /* foreach( $aFiles as $szFile ) */
        }
        else
        {
            $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : no aspiration found in " . $this->getFolder() );
        }

        return ( $this->aAspirations );
    }   /* End of Portfolio.findAspirations() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*load( [$szFile] )=

        Loads a Portfolio file

        {*params
            $szFile         (string)        The file the portfolio must be loaded from.
                                            Optional. If not passed, the name of the file
                                            is determined from the codeName of the
                                            portfolio.
        *}

        {*return
            (bool)      [c]true[/c] if $szFile successfully loaded; [c]false[/c] otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function load( $szFile = null ): bool
    /*----------------------------------------*/
    {
        $bRetVal = false;

        if ( is_null( $szFile ) )
            $szFile = vaesoli::FIL_RealPath( $this->getFolder() . '/' . $this->szCodeName . '.portfolio.xml' );

        //var_dump( "Looking for {$szFile}" );

        if ( is_file( $szFile ) )
        {
            //var_dump( "I can load the file" );

            $oDom = new \DOMDocument();

            if ( $oDom->load( $szFile) )
            {
                /* $szID is not to be confused with $identifier:

                     $identifier can be assigned by the user
                     $szID is assigned by the system

                */
                $this->identifier = $oDom->documentElement->getAttribute( 'id' );
                //var_dump( $this->identifier );

                //if ( $szIdentifier !== $this->identifier )
                //    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Portfolio identifier error (ErrCode: " . EXCEPTION_CODE_PORTFOLIO_IDENTIFIER_MISMATCH . " - IDENTIFIER MISMATCH)",EXCEPTION_CODE_PORTFOLIO_IDENTIFIER_MISMATCH );

                //var_dump( $szFile . " loaded" );
                $oXPath = new \DOMXPath( $oDom );

                // Je prends TOUS les tags de premier niveau
                $oTags = $oXPath->query( "/*/node()" );

                // All tags found in the XML will be handled as properties of the Portfolio object
                if ( $oTags->length > 0 )
                {
                    foreach( $oTags as $oNode )
                    {
                        if ( ( substr( $oNode->nodeName,0,5 ) !== '#text'    ) &&
                             ( substr( $oNode->nodeName,0,8 ) !== '#comment' )
                           )
                        {
                            $szProperty = strtolower( substr( $oNode->nodeName,0,1 ) ) . substr( $oNode->nodeName,1 );
                            //var_dump( $szProperty );
                            if ( $szProperty !== 'domains' )
                                $this->$szProperty = $oNode->nodeValue;
                            //var_dump( $oNode->nodeName,$szProperty,$oNode->nodeValue );
                        }   /* if ( ( substr( $oNode->nodeName,0,5 ) !== '#text' ) && ... */
                    }   /* foreach( $oTags as $oNode ) */
                }   /* if ( $oTags->length > 0 ) */

                if ( $oTags->length > 0 )
                {
                    $oTags = $oXPath->query( "//Domain" );

                    foreach( $oTags as $oNode )
                    {
                        $this->aDomains[] = $oNode->nodeValue;
                    }   /* foreach( $oTags as $oNode ) */
                }   /* if ( $oTags->length > 0 ) */
                //var_dump( $this->aDomains );
            }   /* if ( $oDom->load( $szFile) ) */
        }   /* if ( is_file( $szFile ) ) */
        else
        {
            //var_dump( $szFile . " COULD NOT BE LOADED" );
            $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : {$szFile} could NOT be loaded" );
        }

        end:
        return ( $bRetVal );
    }   /* End of Portfolio.load() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( [$szFile] )=

        Saves Portfolio to a file

        {*params
            $szFile         (string)        The file the portfolio must be saved to.
                                            Optional. When NOT passed, the Portfolio
                                            is saved in its natural folder (see
                                            this->getFolder()) using its identifier.
                                            (e.g. D:\websites\openpmo.site\www\databases\PMO\00256\00406\00006\00054\delhaize.portfolio.xml')
        *}

        {*return
            (bool)      [c]true[/c] if $szFile successfully saved; [c]false[/c] otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function save( $szFile = null ): bool
    /*----------------------------------------*/
    {
        $this->dieGracefully( __METHOD__ . 'must be reworked. Dying here.' );

        $bRetVal = false;

        if ( is_null( $szFile ) )
            $szFile = vaesoli::FIL_RealPath( $this->getFolder() . '/' . $this->identifier . '.portfolio.xml' );

        if ( ! empty( $szXML = $this->__toXML() ) )
        {
            //echo $szXML;
            //var_dump( $szXML );
            //die();
            if ( ! is_dir( $this->getFolder() ) )
                vaesoli::FIL_MkDir( $this->getFolder() );

            if ( is_dir( $this->getFolder() ) )
            {
                if ( ! $bRetVal = vaesoli::FIL_StrToFile( $szXML,$szFile ) )
                    $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : {$szFile} could NOT be saved" );
            }
            else
            {
                $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : " . $this->getFolder() . " does NOT exist" );
            }
        }   /* if ( ! empty( $szXML = $this->__toXML() ) ) */

        end:
        return ( $bRetVal );
    }   /* End of Portfolio.save() ==================================================== */
    /* ================================================================================ */


    public function renderRoadmap():string
    /*----------------------------------*/
    {
        $oRoadmap = new Roadmap();
        // 1) Donner à la roadmap toutes les aspirations

        if ( ! is_array( $this->aAspirations ) )
            $this->findAspirations();

        $oRoadmap->aAspirations = $this->aAspirations;

        return ( $oRoadmap->render() );
        // 2) Demander à la roadmap de se dessiner
    }   /* End of Portfolio.renderRoadmap() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the Portfolio in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        $szRetVal    = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";

        $szRetVal   .= "<Portfolio id=\"{$this->identifier}\">\n";
        {
            $szRetVal   .= "  <About><![CDATA[{$this->about}]]></About>\n";
            $szRetVal   .= "  <AdditionalType><![CDATA[{$this->additionalType}]]></AdditionalType>\n";
            $szRetVal   .= "  <AlternateName><![CDATA[{$this->alternateName}]]></AlternateName>\n";
            $szRetVal   .= "  <Audience><![CDATA[{$this->audience}]]></Audience>\n";
            $szRetVal   .= "  <Author><![CDATA[{$this->author}]]></Author>\n";
            $szRetVal   .= "  <ContentLocation><![CDATA[{$this->contentLocation}]]></ContentLocation>\n";
            $szRetVal   .= "  <Contributor><![CDATA[{$this->contributor}]]></Contributor>\n";
            $szRetVal   .= "  <CopyrightHolder><![CDATA[{$this->copyrightHolder}]]></CopyrightHolder>\n";
            $szRetVal   .= "  <CopyrightYear><![CDATA[{$this->copyrightYear}]]></CopyrightYear>\n";
            $szRetVal   .= "  <Correction><![CDATA[{$this->correction}]]></Correction>\n";
            $szRetVal   .= "  <CreativeWorkStatus><![CDATA[{$this->creativeWorkStatus}]]></CreativeWorkStatus>\n";
            $szRetVal   .= "  <Creator><![CDATA[{$this->creator}]]></Creator>\n";
            $szRetVal   .= "  <DateCreated><![CDATA[{$this->dateCreated}]]></DateCreated>\n";
            $szRetVal   .= "  <DateModified><![CDATA[{$this->dateModified}]]></DateModified>\n";
            $szRetVal   .= "  <DatePublished><![CDATA[{$this->datePublished}]]></DatePublished>\n";
            $szRetVal   .= "  <Description><![CDATA[{$this->description}]]></Description>\n";
            $szRetVal   .= "  <DiscussionUrl><![CDATA[{$this->discussionUrl}]]></DiscussionUrl>\n";

            if ( is_array( $this->aDomains ) && count( $this->aDomains ) > 0 )
            {
                $szRetVal   .= "  <Domains>\n";
                foreach( $this->aDomains as $szDomain )
                {
                    $szRetVal   .= "    <Domain><![CDATA[{$szDomain}]]></Domain>\n";
                }
                $szRetVal   .= "  </Domains>\n";
            }

            $szRetVal   .= "  <Editor><![CDATA[{$this->editor}]]></Editor>\n";
            $szRetVal   .= "  <Expires><![CDATA[{$this->expires}]]></Expires>\n";
            $szRetVal   .= "  <Funder><![CDATA[{$this->funder}]]></Funder>\n";
            $szRetVal   .= "  <Genre><![CDATA[{$this->genre}]]></Genre>\n";
            $szRetVal   .= "  <Image><![CDATA[{$this->image}]]></Image>\n";
            $szRetVal   .= "  <Keywords><![CDATA[{$this->keywords}]]></Keywords>\n";
            $szRetVal   .= "  <Name><![CDATA[{$this->name}]]></Name>\n";
            $szRetVal   .= "  <Producer><![CDATA[{$this->producer}]]></Producer>\n";
            $szRetVal   .= "  <Provider><![CDATA[{$this->provider}]]></Provider>\n";
            $szRetVal   .= "  <Publication><![CDATA[{$this->publication}]]></Publication>\n";
            $szRetVal   .= "  <Publisher><![CDATA[{$this->publisher}]]></Publisher>\n";
            $szRetVal   .= "  <SameAs><![CDATA[{$this->sameAs}]]></SameAs>\n";
            $szRetVal   .= "  <SourceOrganization><![CDATA[{$this->sourceOrganization}]]></SourceOrganization>\n";
            $szRetVal   .= "  <Sponsor><![CDATA[{$this->sponsor}]]></Sponsor>\n";
            $szRetVal   .= "  <SubjectOf><![CDATA[{$this->subjectOf}]]></SubjectOf>\n";
            $szRetVal   .= "  <Text><![CDATA[{$this->text}]]></Text>\n";
            $szRetVal   .= "  <ThumbnailUrl><![CDATA[{$this->thumbnailUrl}]]></ThumbnailUrl>\n";
            $szRetVal   .= "  <Url><![CDATA[{$this->url}]]></Url>\n";
            $szRetVal   .= "  <Version><![CDATA[{$this->version}]]></Version>\n";
        }
        $szRetVal   .= "</Portfolio>\n";

        end:
        return ( $szRetVal );
    }   /* End of Portfolio.__toXML() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Renders the Portfolio in HTML (very limited set of properties are rendered)

        {*params
        *}

        {*return
            (string)        HTML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toHTML():string
    /*-----------------------------*/
    {
        $szDomains  = '';

        if ( is_array( $this->aDomains ) && count( $this->aDomains ) > 0 )
            $szDomains = implode( ', ',$this->aDomains );

        $szRetVal   = "<section>";
        $szRetVal  .= "<p><b>Name</b>: {$this->name} (<em>ID: <b>{$this->identifier}</b>; codeName: <b>{$this->szCodeName}</b></em>)</p>\n";
        $szRetVal  .= "<p><b>Description</b>: {$this->description}</p>\n";
        $szRetVal  .= "<p><b>Domains</b>: {$szDomains}</p>\n";
        $szRetVal  .= "<p><b>Aspirations</b>: " . count( $this->aAspirations ) . "</p>\n";
        $szRetVal  .= "<section>";

        return ( $szRetVal );
    }   /* End of Portfolio.__toHTML() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Allows a class to decide how it will react when it is treated like a
        string.

        {*params
        *}

        {*return
            (string)        Returns the HTML rendering
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString():string
    /*-------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of Portfolio.__toString() ============================================== */
    /* ================================================================================ */


    public function __get( $szProperty )
    /*--------------------------------*/
    {
        switch ( $szProperty )
        {
            case 'modulo'           :   return ( $this->modulo );
            case 'szID'             :   return ( $this->szID );
            case 'storage'          :
            case 'szStorage'        :
            case 'szShelter'        :
            case 'szStorageFolder'  :   return ( $this->shelter );
            default                 :   return ( parent::__get( $szProperty ) );
        }
    }   /* End of Portfolio.__get() =================================================== */
    /* ================================================================================ */


    public function __set( $property,$xValue )
    /*--------------------------------------*/
    {
        switch ( $property )
        {
            case 'storage'          :
            case 'szStorage'        :
            case 'szShelter'        :
            case 'szStorageFolder'  :   return ( $this->shelter = $xValue );
                                        break;
            default                 :   return ( parent::__set( $property,$xValue ) );
                                        break;
        }
    }   /* End of Portfolio.__set() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of Portfolio.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class Portfolio ========================================================= */
/* ==================================================================================== */
