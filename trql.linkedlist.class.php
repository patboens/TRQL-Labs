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
    {*file                  trql.linkedlist.class.php *}
    {*purpose               A class that handles linked lists *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 10-05-21 04:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 10-05-21 04:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\structures;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\structures\LinkedDataStructure    as LinkedDataStructure;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LINKEDDATASTRUCTURE_CLASS_VERSION' ) )
    require_once( 'trql.linkeddatastructure.class.php' );

defined( 'LINKEDLIST_CLASS_VERSION' ) or define( 'LINKEDLIST_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LinkedList=

    {*desc

        Linked list (Liste chaînée). A linked list is a
        data structure representing an ordered collection of elements of
        arbitrary size of the same type, whose representation in computer memory
        is a succession of cells with a content and a pointer to another cell.

    *}

    *}}
 */
/* ==================================================================================== */
class LinkedList extends LinkedDataStructure
/*----------------------------------------*/
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
    public      $wikidataId                     = 'Q7003418';        /* {*property   $wikidataId                     (string)                       Data structure which is a linear collection of data 
                                                                                                                                                    elements, called nodes, each pointing to the next 
                                                                                                                                                    node by means of a pointer *} */

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
    }   /* End of LinkedList.__construct() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*add( $x )=

        Add an element to the list

        {*params
            $x      (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
    public function add( $x )
    /*---------------------*/
    {
        if ( $x instanceof LinkedListElement )
            $this->list[] = $x;

        return ( $this );
    }   /* End of LinkedList.__construct() ============================================ */
    /* ================================================================================ */


    public function sort()
    /*------------------*/
    {
        usort( $this->list,function( &$a,&$b )
                           {
                               if     ( $a->value === $b->value )
                               {
                                   $a->next = &$b;
                                   $b->prev = &$a;
                                   return ( 0 );
                               }
                               elseif ( $a->value > $b->value )
                               {
                                   $b->next = &$a;
                                   $a->prev = &$b;
                                   return ( 1 );
                               }
                               else
                               {
                                   $a->next = &$b;
                                   $b->prev = &$a;
                                   return ( -1 );
                               }
                           }
            );
    }   /* End of LinkedList.sort() =================================================== */
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
    }   /* End of LinkedList.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class LinkedList ======================================================== */
/* ==================================================================================== */


// Il serait utile de créer une structure Doubly Linked List (voir Knuth page 
// 280, Vol 1) et Circular List (voir Knuth page 273, Vol 1)

// En fait ... ce que j'ai ici, c'est un élément d'une liste doublement chaînée !!!
class LinkedListElement
/*-------------------*/
{
    public $value = null;
    public $prev  = null;
    public $next  = null;

    // ╔═══════╦═══════════════════╦═══════╗
    // ║       ║                   ║       ║
    // ║   •   ║                   ║   •   ║
    // ║       ║                   ║       ║
    // ╚═══════╩═══════════════════╩═══════╝
    //   prev          value         next

    /* ================================================================================ */
    /** {{*__construct()=

        Class constructor

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $x = null )
    /*------------------------------------*/
    {
        $this->value = $x;
        return ( $this );
    }   /* End of LinkedListElement.__construct() ===================================== */
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
    }   /* End of LinkedListElement.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class LinkedListElement ================================================= */
/* ==================================================================================== */

