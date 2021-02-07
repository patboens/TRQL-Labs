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
    {*file                  trql.administrativearea.class.php *}
    {*purpose               Administrative Area class *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 19:19 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 19:19 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 23-08-20 13:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adapting the Documentor comments
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\administrativearea;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\place\Place                               as Place;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

defined( 'ADMINISTRATIVEAREA_CLASS_VERSION' ) or define( 'ADMINISTRATIVEAREA_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ==================================================================================== */
/** {{*class AdministrativeArea=

    {*desc

        A geographical region, typically under the jurisdiction of a particular government.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/AdministrativeArea[/url] *}

    *}}
 */
/* ==================================================================================== */
class AdministrativeArea extends Place implements iContext
/*------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    }   /* End of AdministrativeArea.__construct() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*speak()=

        Generate a text in line with the Administrative Area

        {*params
        *}

        {*return
            (string)    A text representing the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of AdministrativeArea.speak() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*sing()=

        Generate a text-to-speech file corresponding to a string

        {*params
        *}

        {*return
            (string)    A URL where the text-to-speech file (.mp3) is available
        *}

        *}}
    */
    /* ================================================================================ */
    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of AdministrativeArea.sing() =========================================== */
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
    }   /* End of AdministrativeArea.__destruct() ===================================== */
    /* ================================================================================ */

}   /* End of class AdministrativeArea ================================================ */
/* ==================================================================================== */
?>