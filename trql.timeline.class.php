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
    {*file                  trql.timeline.class.php *}
    {*purpose               Way of displaying a list of events in chronological order *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 20-01-21 22:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 20-01-21 22:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\timeline;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\chart\Chart           as Chart;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CHART_CLASS_VERSION' ) )
    require_once( 'trql.chart.class.php' );

defined( 'TIMELINE_CLASS_VERSION' ) or define( 'TIMELINE_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Timeline=

    {*desc

        Way of displaying a list of events in chronological order

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q186117[/url] *}

    *}}
 */
/* ================================================================================== */
class Timeline extends Chart
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q186117';            /* {*property   $wikidataId                 (string)                WikidataId ... way of displaying a list of events 
                                                                                                                                        in chronological order *} */



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

    }   /* End of Timeline.__construct() ============================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Timeline.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class Timeline ========================================================== */
/* ==================================================================================== */
?>