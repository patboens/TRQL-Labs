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

    *}}} */
/****************************************************************************************/
namespace trql\website;

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
    require_once( 'trql.thing.class.php' );

defined( 'WEBSITE_CLASS_VERSION' ) or define( 'WEBSITE_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

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

    public      $issn                   = null                      /* {*property   $issn                       (string)                            The International Standard Serial Number (ISSN) that 
                                                                                                                                                    identifies this serial publication. You can repeat 
                                                                                                                                                    this property to identify different formats of, or 
                                                                                                                                                    the linking ISSN (ISSN-L) for, this serial publication. *} */


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
    /*------------------------*/
    {
        if ( empty( $this->url ) )
        {
            $this->die( "The class cannot generate a full website yet" );
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
    }   /* End of WebSite.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class WebSite =========================================================== */
/* ==================================================================================== */
?>