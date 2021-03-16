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
    {*file                  trql.healthtopiccontent.class.php *}
    {*purpose               HealthTopicContent is WebContent that is about some aspect
                            of a health topic, e.g. a condition, its symptoms or
                            treatments. Such content may be comprised of several parts
                            or sections and use different types of media. Multiple
                            instances of WebContent (and hence HealthTopicContent) can
                            be related using hasPart / isPartOf where there is some kind
                            of content hierarchy, and their content described with about
                            and mentions e.g. building upon the existing
                            MedicalCondition vocabulary. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

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

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\web\WebContent    as WebContent;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBCONTENT_CLASS_VERSION' ) )
    require_once( 'trql.webcontent.class.php' );

defined( 'HEALTHTOPICCONTENT_CLASS_VERSION' ) or define( 'HEALTHTOPICCONTENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class HealthTopicContent=

    {*desc

        HealthTopicContent is WebContent that is about some aspect of a health
        topic, e.g. a condition, its symptoms or treatments. Such content may be
        comprised of several parts or sections and use different types of media.
        Multiple instances of WebContent (and hence HealthTopicContent) can be
        related using hasPart / isPartOf where there is some kind of content
        hierarchy, and their content described with about and mentions e.g.
        building upon the existing MedicalCondition vocabulary.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/HealthTopicContent[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}
 */
/* ==================================================================================== */
class HealthTopicContent extends WebContent
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasHealthAspect                = null;             /* {*property   $hasHealthAspect                (HealthAspectEnumeration)       Indicates the aspect or aspects specifically addressed in some
                                                                                                                                                    HealthTopicContent. For example, that the content is an overview, or
                                                                                                                                                    that it talks about treatment, self-care, treatments or their
                                                                                                                                                    side-effects. *} */

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
    }   /* End of HealthTopicContent.__construct() ==================================== */
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
    }   /* End of HealthTopicContent.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class HealthTopicContent ================================================ */
/* ==================================================================================== */
