<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php. In general the material
    presented here is available under the conditions of 
    https://creativecommons.org/licenses/by-sa/4.0/

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.beach.class.php *}
    {*purpose               Beach. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:37 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:37 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\beach;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\civicstructure\CivicStructure     as CivicStructure;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CIVICSTRUCTURE_CLASS_VERSION' ) )
    require_once( 'trql.civicstructure.class.php' );

defined( 'BEACH_CLASS_VERSION' ) or define( 'BEACH_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Beach=

    {*desc

        Beach.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Beach[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 26-08-2020 18:37.
    *}

 */
/* ==================================================================================== */
class Beach extends CivicStructure
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $openingHours                   = null;             /* {*property   $openingHours                   (string)                        The general opening hours for a business. Opening hours can be
                                                                                                                                                    specified as a weekly time range, starting with days, then times per
                                                                                                                                                    day. Multiple days can be listed with commas ',' separating each day.
                                                                                                                                                    Day or time ranges are specified using a hyphen '-'.Days are specified
                                                                                                                                                    using the following two-letter combinations: Mo, Tu, We, Th, Fr, Sa,
                                                                                                                                                    Su.Times are specified using 24:00 time. For example, 3pm is specified
                                                                                                                                                    as 15:00. Here is an example: &lt;time itemprop="openingHours"
                                                                                                                                                    datetime=&quot;Tu,Th 16:00-20:00&quot;&gt;Tuesdays and Thursdays
                                                                                                                                                    4-8pm&lt;/time&gt;.If a business is open 7 days a week, then it can be
                                                                                                                                                    specified as &lt;time itemprop=&quot;openingHours&quot;
                                                                                                                                                    datetime=&quot;Mo-Su&quot;&gt;Monday through Sunday, all
                                                                                                                                                    day&lt;/time&gt;. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q40080';         /* {*property   $wikidataId                 (string)                            Wikidata ID: area of sand or small stones near the sea or another 
                                                                                                                                                    area of water such as a lake *} */



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
    }   /* End of Beach.__construct() ================================================= */
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
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Beach.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Beach ============================================================= */
/* ==================================================================================== */
?>