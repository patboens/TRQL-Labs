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
    {*file                  trql.infographic.class.php *}
    {*purpose               Graphic visual representations of information, data or 
                            knowledge intended to present information quickly and 
                            clearly *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 20-01-21 22:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 20-01-21 22:36 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\quitus\DataVisualization      as DataVisualization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DATAVISUALIZATION_CLASS_VERSION' ) )
    require_once( 'trql.datavisualization.class.php' );

defined( 'INFOGRAPHIC_CLASS_VERSION' ) or define( 'INFOGRAPHIC_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class infographic=

    {*desc

        Graphic visual representations of information, data or knowledge intended to 
        present information quickly and clearly

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q845734[/url] *}

    *}}
 */
/* ================================================================================== */
class infographic extends DataVisualization
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q845734';            /* {*property   $wikidataId                 (string)                WikidataId ... Graphic visual representations 
                                                                                                                                        of information, data or knowledge intended to 
                                                                                                                                        present information quickly and clearly*} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of infographic.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of infographic.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class infographic ======================================================= */
/* ==================================================================================== */
?>