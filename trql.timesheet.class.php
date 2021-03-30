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
    {*file                  trql.timesheet.class.php *}
    {*purpose               Record of the amount of time a person has spent on a 
                            particular job *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 09-01-21 09:53 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 09-01-21 09:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\timesheet;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\schema\Thing           as Thing;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'TIMESHEET_CLASS_VERSION' ) or define( 'TIMESHEET_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Timesheet=

    {*desc
        Record of the amount of time a person has spent on a particular job
    *}

    {*doc [url]https://www.wikidata.org/wiki/Q629411[/url] *}

    {*warning
        This class is still experimental (09-01-21 09:53:50). It inheritence model
        is still doubtful.
    *}

    *}}
 */
/* ================================================================================== */
class Timesheet extends Thing
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
    public      $wikidataId                 = 'Q629411';            /* {*property   $wikidataId                 (string)                WikidataId ... Record of the amount of time a 
                                                                                                                                        person has spent on a particular job *} */



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

    }   /* End of Timesheet.__construct() ============================================= */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Timesheet.__destruct() ============================================== */
    /* ================================================================================ */

}   /* End of class Timesheet ========================================================= */
/* ==================================================================================== */
?>