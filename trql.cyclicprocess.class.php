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
    {*file                  trql.cyclicprocess.class.php *}
    {*purpose               Process that repeats itself. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 07-01-21 11:27 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    --------------------------------------------------------------------------------------
    Changes History:
    --------------------------------------------------------------------------------------

    {*chist
        {*mdate 07-01-21 11:27 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\process\Process       as Process;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PROCESS_CLASS_VERSION' ) )
    require_once( 'trql.process.class.php' );

defined( 'CYCLICPROCESS_CLASS_VERSION' ) or define( 'CYCLICPROCESS_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class CyclicProcess=

    {*desc

        Process that repeats itself.

    *}

    *}}
 */
/* ================================================================================== */
class CyclicProcess extends Process
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q2692606';       /* {*property   $wikidataId         (string)        Wikidata ID. Process that repeats itself. *} */


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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of CyclicProcess.__construct() ========================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of CyclicProcess.speak() =============================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of CyclicProcess.sing() ================================================ */
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
    }   /* End of CyclicProcess.__destruct() ========================================== */
    /* ================================================================================ */
}   /* End of class CyclicProcess ===================================================== */
/* ==================================================================================== */
