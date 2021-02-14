<?php
/************************************************************************************** */
/** {{{*fheader
    {*file                  trql.context.class.php *}
    {*purpose               The circumstances that form the setting for an event, 
                            statement, or idea, and in terms of which it must be 
                            understood. This is what is called a "context" *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 17-08-20 19:53 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 17-08-20 19:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/************************************************************************************** */
namespace trql\context;


use \trql\mother\Mother             as Mother;
use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\thing\Thing               as Thing;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'CONTEXT_CLASS_VERSION' ) or define( 'CONTEXT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Context=

    {*desc

        The circumstances that form the setting for an event, statement, or
        idea, and in terms of which it must be understood.

    *}

    {*remark

        The "iContext" interface is defined in trql.mother.class.php.

    *}

    *}}
 */
/* ==================================================================================== */

// Ne faudrait-il pas que la classe Context implémente un iContext et qu'elle soit basée sur mother ?

class Context extends Thing
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );
    public      $originator   = null;                               /* {*property   $originator                 (mixed)                 The originator of the context *} */
    public      $verb         = null;                               /* {*property   $verb                       (string)                The verb set by the originator *} */
    public      $data         = null;                               /* {*property   $data                       (mixed)                 The data set by the originator *} */

    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of Context.__construct() =============================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of Context.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class Context =========================================================== */
/* ==================================================================================== */
?>