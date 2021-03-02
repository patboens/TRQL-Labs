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
    {*file                  trql.howtodirection.class.php *}
    {*purpose               A direction indicating a single action to do in the
                            instructions for how to achieve a result. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
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
namespace trql\howtodirection;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'HOWTODIRECTION_CLASS_VERSION' ) or define( 'HOWTODIRECTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class HowToDirection=

    {*desc

        A direction indicating a single action to do in the instructions for how to
        achieve a result.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/HowToDirection[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class HowToDirection extends CreativeWork
/*-------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $afterMedia                     = null;             /* {*property   $afterMedia                     (URL|MediaObject)               A media object representing the circumstances after performing this
                                                                                                                                                    direction. *} */
    public      $beforeMedia                    = null;             /* {*property   $beforeMedia                    (URL|MediaObject)               A media object representing the circumstances before performing this
                                                                                                                                                    direction. *} */
    public      $duringMedia                    = null;             /* {*property   $duringMedia                    (MediaObject|URL)               A media object representing the circumstances while performing this
                                                                                                                                                    direction. *} */
    public      $performTime                    = null;             /* {*property   $performTime                    (Duration)                      The length of time it takes to perform instructions or a direction
                                                                                                                                                    (not including time to prepare the supplies), in ISO 8601 duration
                                                                                                                                                    format. *} */
    public      $prepTime                       = null;             /* {*property   $prepTime                       (Duration)                      The length of time it takes to prepare the items to be used in
                                                                                                                                                    instructions or a direction, in ISO 8601 duration format. *} */
    public      $supply                         = null;             /* {*property   $supply                         (string|HowToSupply)            A sub-property of instrument. A supply consumed when performing
                                                                                                                                                    instructions or a direction. *} */
    public      $tool                           = null;             /* {*property   $tool                           (string|HowToTool)              A sub property of instrument. An object used (but not consumed) when
                                                                                                                                                    performing instructions or a direction. *} */
    public      $totalTime                      = null;             /* {*property   $totalTime                      (Duration)                      The total time required to perform instructions or a direction
                                                                                                                                                    (including time to prepare the supplies), in ISO 8601 duration format. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId         = null;                         /* {*property   $wikidataId                     (string)                        Wikidata ID: no equivalent *} */


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
    }   /* End of HowToDirection.__construct() ======================================== */
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
    }   /* End of HowToDirection.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class HowToDirection ==================================================== */
/* ==================================================================================== */
?>