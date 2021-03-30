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
    {*file                  trql.softwaresourcecode.class.php *}
    {*purpose               Computer programming source code. Example: Full (compile
                            ready) solutions, code snippet samples, scripts, templates. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre*}
    {*keyword               creativework *}

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
namespace trql\softwaresourcecode;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'SOFTWARESOURCECODE_CLASS_VERSION' ) or define( 'SOFTWARESOURCECODE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SoftwareSourceCode=

    {*desc

        Computer programming source code. Example: Full (compile ready) solutions,
        code snippet samples, scripts, templates.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SoftwareSourceCode[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

 */
/* ==================================================================================== */
class SoftwareSourceCode extends CreativeWork
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $codeRepository                 = null;             /* {*property   $codeRepository                 (URL)                           Link to the repository where the un-compiled, human readable code and
                                                                                                                                                    related code is located (SVN, github, CodePlex). *} */
    public      $codeSampleType                 = null;             /* {*property   $codeSampleType                 (string)                        What type of code sample: full (compile ready) solution, code snippet,
                                                                                                                                                    inline code, scripts, template. *} */
    public      $programmingLanguage            = null;             /* {*property   $programmingLanguage            (ComputerLanguage|string)       The computer programming language. *} */
    public      $runtimePlatform                = null;             /* {*property   $runtimePlatform                (string)                        Runtime platform or script interpreter dependencies (Example - Java
                                                                                                                                                    v1, Python2.3, .Net Framework 3.0). *} */
    public      $targetProduct                  = null;             /* {*property   $targetProduct                  (SoftwareApplication)           Target Operating System / Product to which the code applies. If
                                                                                                                                                    applies to several versions, just the product name can be used. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q128751';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Source Code: collection of computer instructions 
                                                                                                                                                    written using some human-readable computer language *} */


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
    }   /* End of SoftwareSourceCode.__construct() ==================================== */
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
    }   /* End of SoftwareSourceCode.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class SoftwareSourceCode ================================================ */
/* ==================================================================================== */
