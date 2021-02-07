<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.educationalorganization.class.php *}
    {*purpose               An educational organization, based on [c]CivicStructure[/c] *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 29-07-20 12:12 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 12:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\educationalorganization;

use \trql\mother\Mother                 as Mother;
use \trql\mother\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\civicstructure\CivicStructure as CivicStructure;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CIVICSTRUCTURE_CLASS_VERSION' ) )
    require_once( 'trql.civicstructure.class.php' );


defined( 'EDUCATIONALORGANIZATION_CLASS_VERSION' ) or define( 'EDUCATIONALORGANIZATION_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class EducationalOrganization=

    {*desc

         An educational organization.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/EducationalOrganization[/url] *}

    *}}
 */
/* ================================================================================== */
class EducationalOrganization extends CivicStructure implements iContext
/*--------------------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $alumni                             = null;         /* {*property   $alumni                             (Person)            Alumni of an organization. Inverse property: alumniOf. *} */

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
    }   /* End of EducationalOrganization.__construct() =============================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of EducationalOrganization.speak() ===================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of EducationalOrganization.sing() ====================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        $this->backup();
    }   /* End of EducationalOrganization.__destruct() ================================ */
    /* ================================================================================ */

}   /* End of class EducationalOrganization =========================================== */
/* ==================================================================================== */
?>