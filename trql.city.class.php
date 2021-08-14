<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.city.class.php *}
    {*purpose               A city or town derived from [c]AdministrativeArea[/c] *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:45 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:45 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\city;

use \trql\quitus\Mother                 as Mother;
use \trql\quitus\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\AdministrativeArea     as AdministrativeArea;
use \trql\mercator\Mercator             as Mercator;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ADMINISTRATIVEAREA_CLASS_VERSION' ) )
    require_once( 'trql.administrativearea.class.php' );

if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
    require_once( 'trql.mercator.class.php' );

defined( 'CITY_CLASS_VERSION' ) or define( 'CITY_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class City=

    {*desc

        A city or town.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/City[/url] *}

    *}}
 */
/* ================================================================================== */
class City extends AdministrativeArea implements iContext
/*-----------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $name                   = null;                     /* {*property   $name                       (string)                The name of the city. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q515';                   /* {*property   $wikidataId                 (string)                Wikidata ID. large permanent human settlement. *} */


    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of City.__construct() ================================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of City.speak() ======================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of City.sing() ========================================================= */
    /* ================================================================================ */


    /* NOT FINAL */
    public function geoCoordinates()
    /*----------------------------*/
    {
        $oMercator = new Mercator();
        $szRetVal = $oMercator->info( $this->name );
        // Il faudrait demander à Mercator de "parser" l'info et la retourner de manière structurée
        return ( $aInfos );
    }

    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
    }   /* End of City.__destruct() =================================================== */
    /* ================================================================================ */

}   /* End of class City ============================================================== */
/* ==================================================================================== */
?>