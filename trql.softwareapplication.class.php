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
    {*file                  trql.softwareapplication.class.php *}
    {*purpose               A software application. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 07:08 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 07:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\softwareapplication;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\CreativeWork         as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'SOFTWAREAPPLICATION_CLASS_VERSION' ) or define( 'SOFTWAREAPPLICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SoftwareApplication=

    {*desc

        A software application.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SoftwareApplication[/url] *}

    {*warning
        This class has been generated automatically by
        [c]trql.schemaclassgenerator.class.php[/c]
    *}

 */
/* ==================================================================================== */
class SoftwareApplication extends CreativeWork
/*------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $applicationCategory            = null;            /* {*property   $applicationCategory            (string|URL)                 Type of software application, e.g. 'Game, Multimedia'. *} */
    public      $applicationSubCategory         = null;            /* {*property   $applicationSubCategory         (string|URL)                 Subcategory of the application, e.g. 'Arcade Game'. *} */
    public      $applicationSuite               = null;            /* {*property   $applicationSuite               (string)                     The name of the application suite to which the application
                                                                                                                                                belongs (e.g. Excel belongs to Office). *} */
    public      $availableOnDevice              = null;            /* {*property   $availableOnDevice              (string)                     Device required to run the application. Used in cases where a
                                                                                                                                                specific make/model is required to run the application. *} */
    public      $countriesNotSupported          = null;            /* {*property   $countriesNotSupported          (string)                     Countries for which the application is not supported. You can
                                                                                                                                                also provide the two-letter ISO 3166-1 alpha-2 country code. *} */
    public      $countriesSupported             = null;            /* {*property   $countriesSupported             (string)                     Countries for which the application is supported. You can also
                                                                                                                                                provide the two-letter ISO 3166-1 alpha-2 country code. *} */
    public      $downloadUrl                    = null;            /* {*property   $downloadUrl                    (URL)                        If the file can be downloaded, URL to download the binary. *} */
    public      $featureList                    = null;            /* {*property   $featureList                    (string|URL)                 Features or modules provided by this application (and possibly
                                                                                                                                                required by other applications). *} */
    public      $fileSize                       = null;            /* {*property   $fileSize                       (string)                     Size of the application / package (e.g. 18MB). In the absence
                                                                                                                                                of a unit (MB, KB etc.), KB will be assumed. *} */
    public      $installUrl                     = null;            /* {*property   $installUrl                     (URL)                        URL at which the app may be installed, if different from the
                                                                                                                                                URL of the item. *} */
    public      $memoryRequirements             = null;            /* {*property   $memoryRequirements             (string|URL)                 Minimum memory requirements. *} */
    public      $operatingSystem                = null;            /* {*property   $operatingSystem                (string)                     Operating systems supported (Windows 7, OSX 10.6, Android 1.6). *} */
    public      $permissions                    = null;            /* {*property   $permissions                    (string)                     Permission(s) required to run the app (for example, a mobile
                                                                                                                                                app may require full internet access or may run only on wifi). *} */
    public      $processorRequirements          = null;            /* {*property   $processorRequirements          (string)                     Processor architecture required to run the application (e.g. IA64). *} */
    public      $releaseNotes                   = null;            /* {*property   $releaseNotes                   (string|URL)                 Description of what changed in this version. *} */
    public      $screenshot                     = null;            /* {*property   $screenshot                     (ImageObject|URL)            A link to a screenshot image of the app. *} */
    public      $softwareAddOn                  = null;            /* {*property   $softwareAddOn                  (SoftwareApplication)        Additional content for a software application. *} */
    public      $softwareHelp                   = null;            /* {*property   $softwareHelp                   (creativeWork)               Software application help. *} */
    public      $softwareRequirements           = null;            /* {*property   $softwareRequirements           (string|URL)                 Component dependency requirements for application. This includes
                                                                                                                                                runtime environments and shared libraries that are not included
                                                                                                                                                in the application distribution package, but required to run the
                                                                                                                                                application (Examples: DirectX, Java or .NET runtime). *} */
    public      $softwareVersion                = null;            /* {*property   $softwareVersion                (string)                     Version of the software instance. *} */
    public      $storageRequirements            = null;            /* {*property   $storageRequirements            (string|URL)                 Storage requirements (free space required). *} */
    public      $supportingData                 = null;            /* {*property   $supportingData                 (DataFeed)                   Supporting data for a SoftwareApplication. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                    Wikidata ID. No equivalent. *} */


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
    }   /* End of SoftwareApplication.__construct() =================================== */
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
    }   /* End of SoftwareApplication.__destruct() ==================================== */
    /* ================================================================================ */
}   /* End of class SoftwareApplication =============================================== */
/* ==================================================================================== */
?>