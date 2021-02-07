<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.paradeigma.class.php *}
    {*purpose               Handles paradeigmas *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 08/02/2017 - 12:10 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 16:51:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\paradeigma;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\webpage\WebPage                           as WebPage;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGE_CLASS_VERSION' ) )
    require_once( 'trql.webpage.class.php' );

defined( 'PARADEIGMA_CLASS_VERSION' ) or define( 'PARADEIGMA_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class Paradeigma=

    {*desc

        A paradeigma is a web page template.

    *}

    *}}
 */
/* ================================================================================== */
class Paradeigma extends WebPage implements iContext
/*------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $gallery                    = null;                 /* {*property   $gallery                    (array)                 An array of possible paradeigmas (collection of templates) *} */

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

        $this->die( __CLASS__ . ' NOT YET FUNCTIONAL' );

        return ( $this );
    }   /* End of Paradeigma.__construct() ============================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Paradeigma.speak() ================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Paradeigma.sing() =================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        $this->backup();
    }   /* End of Paradeigma.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class Paradeigma ======================================================== */
/* ==================================================================================== */
?>