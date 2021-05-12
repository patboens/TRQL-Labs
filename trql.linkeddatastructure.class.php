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
    {*file                  trql.linkeddatastructure.class.php *}
    {*purpose               A class that handles linked data structures *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 10-05-21 04:53 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 10-05-21 04:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\structures;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\structures\DataStructure      as DataStructure;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DATASTRUCTURE_CLASS_VERSION' ) )
    require_once( 'trql.datastructure.class.php' );

defined( 'LINKEDDATASTRUCTURE_CLASS_VERSION' ) or define( 'LINKEDDATASTRUCTURE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LinkedDataStructure=

    {*desc

        Data structure which consists of a set of data records (nodes) linked
        together and organized by references (links or pointers)

    *}

    *}}
 */
/* ==================================================================================== */
class LinkedDataStructure extends DataStructure
/*-------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q6554356';       /* {*property   $wikidataId                     (string)                        Data structure which consists of a set of data records
                                                                                                                                                    (nodes) linked together and organized by references 
                                                                                                                                                    (links or pointers) *} */
    public      $list                           = null;             /* {*property   $list                           (array)                         Internal list of structured data *} */

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

        {*example


        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of LinkedDataStructure.__construct() =================================== */
    /* ================================================================================ */


    public function reset()
    /*-------------------*/
    {
        return ( reset( $this->list ) );
    }   /* End of LinkedList.reset() ================================================== */
    /* ================================================================================ */


    public function prev()
    /*------------------*/
    {
        return ( prev( $this->list ) );
    }   /* End of LinkedList.prev() =================================================== */
    /* ================================================================================ */


    public function next()
    /*------------------*/
    {
        return ( next( $this->list ) );
    }   /* End of LinkedList.next() =================================================== */
    /* ================================================================================ */


    public function value()
    /*-------------------*/
    {
        return ( current( $this->list )->value );
    }   /* End of LinkedList.value() ================================================== */
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
    }   /* End of LinkedDataStructure.__destruct() ==================================== */
    /* ================================================================================ */
}   /* End of class LinkedDataStructure =============================================== */
/* ==================================================================================== */

