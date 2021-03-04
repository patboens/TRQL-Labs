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
    {*file                  trql.howto.class.php *}
    {*purpose               Instructions that explain how to achieve a result by
                            performing a sequence of steps. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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


    *}}} */
/****************************************************************************************/
namespace trql\howto;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork    as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'HOWTO_CLASS_VERSION' ) or define( 'HOWTO_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class HowTo=

    {*desc

        Instructions that explain how to achieve a result by performing a sequence
        of steps.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/HowTo[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class HowTo extends CreativeWork
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $estimatedCost                  = null;             /* {*property   $estimatedCost                  (string|MonetaryAmount)                         The estimated cost of the supply or supplies consumed when performing
                                                                                                                                                                    instructions. *} */
    public      $performTime                    = null;             /* {*property   $performTime                    (Duration)                                      The length of time it takes to perform instructions or a direction
                                                                                                                                                                    (not including time to prepare the supplies), in ISO 8601 duration
                                                                                                                                                                    format. *} */
    public      $prepTime                       = null;             /* {*property   $prepTime                       (Duration)                                      The length of time it takes to prepare the items to be used in
                                                                                                                                                                    instructions or a direction, in ISO 8601 duration format. *} */
    public      $step                           = null;             /* {*property   $step                           (HowToStep|string|HowToSection|CreativeWork)    A single step item (as HowToStep, text, document, video, etc.) or a
                                                                                                                                                                    HowToSection. *} */
    public      $supply                         = null;             /* {*property   $supply                         (string|HowToSupply)                            A sub-property of instrument. A supply consumed when performing
                                                                                                                                                                    instructions or a direction. *} */
    public      $tool                           = null;             /* {*property   $tool                           (string|HowToTool)                              A sub property of instrument. An object used (but not consumed) when
                                                                                                                                                                    performing instructions or a direction. *} */
    public      $totalTime                      = null;             /* {*property   $totalTime                      (Duration)                                      The total time required to perform instructions or a direction
                                                                                                                                                                    (including time to prepare the supplies), in ISO 8601 duration format. *} */
    public      $yield                          = null;             /* {*property   $yield                          (QuantitativeValue|string)                      The quantity that results by performing instructions. For example, a
                                                                                                                                                                    paper airplane, 10 personalized candles. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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
    }   /* End of HowTo.__construct() ================================================= */
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
    }   /* End of HowTo.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class HowTo ============================================================= */
/* ==================================================================================== */

?>