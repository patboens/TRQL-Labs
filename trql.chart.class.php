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
    {*file                  trql.chart.class.php *}
    {*purpose               Graphical representation of data *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 20-01-21 22:32 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 20-01-21 22:32 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\chart;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\infographic\Infographic   as Infographic;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INFOGRAPHIC_CLASS_VERSION' ) )
    require_once( 'trql.infographic.class.php' );

defined( 'CHART_CLASS_VERSION' ) or define( 'CHART_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Chart=

    {*desc

        Graphical representation of data

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q28923[/url] *}

    *}}
 */
/* ================================================================================== */
class Chart extends Infographic
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q28923';             /* {*property   $wikidataId                 (string)                WikidataId ... Graphical representation of data *} */



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

    }   /* End of Chart.__construct() ================================================= */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Chart.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class Chart ============================================================= */
/* ==================================================================================== */
?>