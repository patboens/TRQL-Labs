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
    {*file                  trql.book.class.php *}
    {*purpose               A book. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 12:58 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 12:58 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\book;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'BOOK_CLASS_VERSION' ) or define( 'BOOK_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Book=

    {*desc

        A book.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Book[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c]
    *}

    *}}
 */
/* ==================================================================================== */
class Book extends CreativeWork
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $abridged                       = null;             /* {*property   $abridged                   (boolean)                   Indicates whether the book is an abridged edition. *} */
    public      $bookEdition                    = null;             /* {*property   $bookEdition                (string)                    The edition of the book. *} */
    public      $bookFormat                     = null;             /* {*property   $bookFormat                 (BookFormatType )           The format of the book. *} */
    public      $illustrator                    = null;             /* {*property   $illustrator                (Person)                    The illustrator of the book. *} */
    public      $isbn                           = null;             /* {*property   $isbn                       (string)                    The ISBN of the book. *} */
    public      $numberOfPages                  = null;             /* {*property   $numberOfPages              (int)                       The number of pages in the book. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q571';           /* {*property   $wikidataId                 (string)                    Wikidata ID: a written text that can be published in 
                                                                                                                                            printed or electronic form *} */


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
    }   /* End of Book.__construct() ================================================== */
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
    }   /* End of Book.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Book ============================================================== */
/* ==================================================================================== */
?>