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
    {*file                  trql.audiobook.class.php *}
    {*purpose               An audiobook. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:36 *}
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
namespace trql\audiobook;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\audioobject\AudioObject       as AudioObject;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'AUDIOOBJECT, BOOK_CLASS_VERSION' ) )
    require_once( 'trql.audioobject.class.php' );

defined( 'AUDIOBOOK_CLASS_VERSION' ) or define( 'AUDIOBOOK_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Audiobook=

    {*desc

        An audiobook.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Audiobook[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.
    *}

 */
/* ==================================================================================== */
class Audiobook extends AudioObject
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $abridged                       = null;             /* {*property   $abridged                   (boolean)               Indicates whether the book is an abridged edition. *} */
    public      $bookEdition                    = null;             /* {*property   $bookEdition                (string)                The edition of the book. *} */
    public      $bookFormat                     = null;             /* {*property   $bookFormat                 (BookFormatType)        The format of the book. *} */
    public      $duration                       = null;             /* {*property   $duration                   (Duration)              The duration of the item (movie, audio recording, event, etc.) in ISO
                                                                                                                                            8601 date format. *} */
    public      $illustrator                    = null;             /* {*property   $illustrator                (Person)                The illustrator of the book. *} */
    public      $isbn                           = null;             /* {*property   $isbn                       (string)                The ISBN of the book. *} */
    public      $readBy                         = null;             /* {*property   $readBy                     (Person)                A person who reads (performs) the audiobook. *} */
    public      $numberOfPages                  = null;             /* {*property   $numberOfPages              (int)                   The number of pages in the book. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q106833';        /* {*property   $wikidataId                 (string)                Wikidata ID: Recording of a text being read *} */


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
    }   /* End of Audiobook.__construct() ============================================= */
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
    }   /* End of Audiobook.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class Audiobook ========================================================= */
/* ==================================================================================== */
?>