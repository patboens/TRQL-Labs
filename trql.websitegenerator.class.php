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
    {*file                  trql.WebSiteGenerator.class.php *}
    {*purpose               A utility that helps creating a standard structure to
                            generate a WebSite (trql.website.class.php), a set of related
                            web pages and other items typically served from a
                            single web domain and accessible via URLs. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-02-21 09:05 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-02-21 09:05 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\vaesoli\Vaesoli               as v;
use \trql\utility\Utility               as Utility;
use \trql\website\WebSite               as WebSite;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

if ( ! defined( 'WEBSITE_CLASS_VERSION' ) )
    require_once( 'trql.website.class.php' );

defined( 'WEBSITEGENERATOR_CLASS_VERSION' ) or define( 'WEBSITEGENERATOR_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class WebSiteGenerator=

    {*desc

        A utility that helps creating a standard structure to generate a WebSite
        (trql.WebSiteGenerator.class.php), a set of related web pages and other items
        typically served from a single web domain and accessible via URLs.

    *}

    *}}
 */
/* ================================================================================== */
class WebSiteGenerator extends Utility
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                            Wikidata ID. No equivalent. *} */
    public      $webSite                        = null;             /* {*property   $webSite                    (WebSite)                           WebSite that contains all data used for structure generation. *} */
    public      $host                           = null;             /* {*property   $host                       (string)                            Host of $webSite->url *} */
    protected   $generationHomeDir              = null;             /* {*property   $generationHomeDir          (string)                            The directory in which ALL website structures will be created. *} */
    protected   $generationTemplatesHomeDir     = null;             /* {*property   $generationTemplatesHomeDir (string)                            The directory in which ALL website generation templates are stored. *} */
    protected   $generationStructureHomeDir     = null;             /* {*property   $generationTemplatesHomeDir (string)                            A directory that contains a standard set of dirs and files that must be copied to website generationDir *} */
    protected   $generationDir                  = null;             /* {*property   $generationDir              (string)                            The directory in which the website structure will be created. *} */
    protected   $aTemplates                     = null;             /* {*property   $aTemplates                 (array)                             An array of generation templates *} */
    protected   $aSubstitutions                 = null;             /* {*property   $aSubstitutions             (array)                             An array of template subsitutions (e.g. %host% turned to its real value) *} */

    /* ================================================================================ */
    /** {{*__construct( $oWebSite )=

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
    public function __construct( $oWebSite )
    /*------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        if ( ! $oWebSite instanceof WebSite )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": EXCEPTION_CODE_INVALID_PARAMETER (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );

        if ( empty( $oWebSite->url ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": EXCEPTION_CODE_NO_DOMAIN_NAME_FOUND (ErrCode: " . EXCEPTION_CODE_NO_DOMAIN_NAME_FOUND . ")",EXCEPTION_CODE_NO_DOMAIN_NAME_FOUND );

        $this->webSite                      = $oWebSite;
        $this->generationHomeDir            = v::FIL_RealPath( $this->szHome . '/generate'  );
        $this->generationTemplatesHomeDir   = v::FIL_RealPath( $this->szHome . '/generate/templates' );
        $this->generationStructureHomeDir   = v::FIL_RealPath( $this->szHome . '/generate/structure' );
        $this->scheme                       = parse_url( $this->webSite->url,PHP_URL_SCHEME );

        $aURL = v::URL_parseDomain( v::URL_parse( $this->webSite->url )['domain'] );
        $this->host                         = $aURL['domain'] . '.' . $aURL['tld'];

        $this->addSubstitution( '%destination-dir%' ,$this->webSite->destinationDir  );
        $this->addSubstitution( '%scheme%'          ,$this->scheme );
        $this->addSubstitution( '%host%'            ,$this->host  );
        $this->addSubstitution( '%d-m-Y H:i:s%'     ,date( 'd-m-Y H:i:s' ) );

        $this->getTemplates();

        return ( $this );
    }   /* End of WebSiteGenerator.__construct() ====================================== */
    /* ================================================================================ */


    protected function Say( $szMsg )
    /*----------------------------*/
    {
        $x = debug_backtrace();
        echo "<p>Line <code>" . $x[0]['line']  . "</code> in <code>{$x[1]['function']}()</code> of <code>" . basename( $x[0]['file'] ) . "</code>: {$szMsg}</p>\n";
        //var_dump( $x );
    }

    protected function addSubstitution( $szPattern,$szValue )
    /*-----------------------------------------------------*/
    {
        //var_dump( $szPattern,$szValue );

        $this->aSubstitutions['patterns'][] = $szPattern;
        $this->aSubstitutions['values'][]   = $szValue;

        return ( $this );
    }

    protected function applySubstitutions( $szStr )
    /*-------------------------------------------*/
    {
        return ( str_replace( $this->aSubstitutions['patterns'],$this->aSubstitutions['values'],$szStr ) );
    }

    protected function getTemplates()
    /*-----------------------------*/
    {
        if ( is_array( $aFiles = v::FIL_aFilesEx( $this->generationTemplatesHomeDir . '/*.tem' ) ) && count( $aFiles ) > 0 )
        {
            foreach( $aFiles as $szFile )
            {
                $this->aTemplates[ basename( strtolower( $szFile ),'.tem') ] = v::FIL_RealPath( $szFile );
            }   /* foreach( $aFiles as $szFile ) */
        }   /* if ( is_array( $aFiles = v::FIL_aFilesEx( $this->generationTemplatesHomeDir ... ) */

        //var_dump( $this->aTemplates );
    }

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
        $tStart = microtime( true );

        {
            $aMap                   = $this->Map( $this->webSite->url );

            $this->generationDir    = v::FIL_RealPath( $this->generationHomeDir . '/sites/' .
                                                             $aMap['level1']    . '/' .
                                                             $aMap['level2']    . '/' .
                                                             $aMap['level3']    . '/' .
                                                             $aMap['level4'] );

            //var_dump( $this->generationHomeDir,$this->generationDir );

            if ( ! is_dir( $this->generationDir ) )
                if ( v::FIL_MkDir( $this->generationDir ) )
                    $this->addInfo( __METHOD__ . "(): '{$this->generationDir}' created" );
                else
                    $this->addInfo( __METHOD__ . "(): '{$this->generationDir}' CANNOT be created" );

            $this->Say( 'Requested to generate the structure of ' . $this->webSite->url );

            $this->generateVHOST();             /* Generate a small snippet to be integrated in Apache */
            $this->copyStructure();             /* Copy all STANDARD directories AND files (from ...\trql.classes.home\trql.websitegenerator.class\generate\structure\ )*/
        }

        $tEnd = microtime( true );

        $this->Say( 'Generation of <code>' . $this->webSite->url . '</code> completed in ' . round( $tEnd - $tStart,5 ) . 'sec' );

        return ( $this );
    }   /* End of WebSiteGenerator.generate() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*generateVHOST()=

        Generate a small VHOST data for Apache

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        *}}
    */
    /* ================================================================================ */
    public function generateVHOST()
    /*---------------------------*/
    {
        if ( isset( $this->aTemplates['vhost'] ) )
        {
            $this->Say( 'VHOST Template found' );
            $szTemplate = v::FIL_FileToStr( $this->aTemplates['vhost'] );
            if ( v::FIL_StrToFile( $this->applySubstitutions( $szTemplate ),
                                   $szOutputFile = v::FIL_RealPath( $this->generationDir . '/vhost.txt' )
                                 ) )
            {
                $this->Say( "VHOST saved in {$szOutputFile}" );
            }
        }
    }   /* End of WebSiteGenerator.generateVHOST() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*copyStructure()=

        Copy the whole STANDARD structure

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        *}}
    */
    /* ================================================================================ */
    public function copyStructure()
    /*---------------------------*/
    {
        $this->Say( "Copying ALL dirs and files of " . $this->generationStructureHomeDir . ' to ' . $this->generationDir );
        v::FIL_recurseCopy( $this->generationStructureHomeDir,$this->generationDir );
        $this->Say( "Copying ALL dirs and files: FINISHED" );

    }   /* End of WebSiteGenerator.copyStructure() ==================================== */
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
    }   /* End of WebSiteGenerator.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class WebSiteGenerator ================================================== */
/* ==================================================================================== */
