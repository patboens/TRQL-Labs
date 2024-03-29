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
    {*file                  trql.alignmentobject.class.php *}
    {*purpose               An intangible item that describes an alignment between a 
                            learning resource and a node in an educational framework.
                            Should not be used where the nature of the alignment can be 
                            described using a simple property, for example to express 
                            that a resource teaches or assesses a competency. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 14:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 14:41 *}
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
namespace trql\alignmentobject;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\schema\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'ALIGNMENTOBJECT_CLASS_VERSION' ) or define( 'ALIGNMENTOBJECT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AlignmentObject=

    {*desc

        An intangible item that describes an alignment between a learning resource and 
        a node in an educational framework.Should not be used where the nature of the 
        alignment can be described using a simple property, for example to express 
        that a resource teaches or assesses a competency.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AlignmentObject[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 14:41.
    *}

 */
/* ==================================================================================== */
class AlignmentObject extends Intangible
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $alignmentType                  = null;             /* {*property   $alignmentType                  (string)                        A category of alignment between the learning resource and the
                                                                                                                                                    framework node. Recommended values include: 'requires',
                                                                                                                                                    'textComplexity', 'readingLevel', and 'educationalSubject'. *} */
    public      $educationalFramework           = null;             /* {*property   $educationalFramework           (string)                        The framework to which the resource being described is aligned. *} */
    public      $targetDescription              = null;             /* {*property   $targetDescription              (string)                        The description of a node in an established educational framework. *} */
    public      $targetName                     = null;             /* {*property   $targetName                     (string)                        The name of a node in an established educational framework. *} */
    public      $targetUrl                      = null;             /* {*property   $targetUrl                      (URL)                           The URL of a node in an established educational framework. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */


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
    }   /* End of AlignmentObject.__construct() ======================================= */
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
    }   /* End of AlignmentObject.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class AlignmentObject =================================================== */
/* ==================================================================================== */
?>