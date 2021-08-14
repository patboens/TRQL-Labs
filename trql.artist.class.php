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
    {*file                  trql.artist.class.php *}
    {*purpose               A person who is an artist. Depends on [c]Person[/c] *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 17-08-20 12:51 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 17-08-20 12:51 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    {*chist
        {*mdate 12-08-21 09:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Completing the class with what we call an "artist" file
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\artist;

use \trql\quitus\Mother     as Mother;
use \trql\quitus\iContext   as iContext;
use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\utility\Utility   as Utility;
use \trql\schema\Person     as Person;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERSON_CLASS_VERSION' ) )
    require_once( 'trql.person.class.php' );

defined( 'ARTIST_CLASS_VERSION' ) or define( 'ARTIST_CLASS_VERSION','0.1' );

defined( "EXCEPTION_INVALID_PROPERTY" )                         or define( "EXCEPTION_INVALID_PROPERTY"                             ,EXCEPTION_CODE_INVALID_PROPERTY );  /*Defined in trql.mother.class.php */

/* ==================================================================================== */
/** {{*class Artist=

    {*desc

        A person who is an artist

    *}

    *}}
 */
/* ==================================================================================== */
class Artist extends Person implements iContext
/*-------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q483501';        /* {*property   $wikidataId                 (string)                                    Wikidata ID: person who engages in any form 
                                                                                                                                                            of artistic creation or practice *} */
    public      $storage                        = null;             /* {*property   $storage                    (string)                                    The file in which all information about an artist is maintained.
                                                                                                                                                            @var.szStorage = alias *} */
    public      $structure                      = null;             /* {*property   $structure                  (array)                                     An internal structure in which we maintain ALL the information
                                                                                                                                                            gathered about an artist *} */
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
        static $defaultSlotStructure = null;

        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        if ( is_null( $defaultSlotStructure ) )
        {
          $defaultSlotStructure = array( 'genres'             => null,
                                         'popularity'         => null,
                                         'similar-artists'    => null,
                                         'albums'             => null,
                                         'top-tracks-lupdate' => null,
                                         'top-tracks'         => null,
                                         'top-tracks-url'     => null,
                                         'fans'               => null,
                                         'picture'            => null,
                                         'url'                => null,
                                         'id'                 => null,
                                         'lupdate'            => null,
                                         'lupdate-string'     => null,
                                       );
        }   /* if ( is_null( $defaultSlotStructure ) ) */

        $this->structure = array( 'name'        => null,
                                  'compiled'    => null,
                                  'final'       => array( 'allmusic'    => $defaultSlotStructure,
                                                          'deezer'      => $defaultSlotStructure,
                                                          'spotify'     => $defaultSlotStructure,
                                                          'itunes'      => $defaultSlotStructure,
                                                          'tidal'       => $defaultSlotStructure,
                                                          'qobuz'       => $defaultSlotStructure,
                                                          'discogs'     => $defaultSlotStructure,
                                                          'lastfm'      => $defaultSlotStructure,

                                                          /* Very much special/specifics structures */
                                                          'wikipedia'   => $defaultSlotStructure,
                                                          'trql'        => $defaultSlotStructure,
                                                        ),
                                );

        return ( $this );
    }   /* End of Artist.__construct() ================================================ */
    /* ================================================================================ */


    /* Fonction qui va rechercher de l'info concernant l'artiste sur ...
       Deezer, Spotify, Tidal, Qobuz, Discogs, itunes, wikidata, ... */
    public function getInfoFromProvider( $szProvider )
    /*----------------------------------------------*/
    {
        // Cela va encore prendre un peu de temps CAR je voudrais que les classes de 
        // streamprovider soient implémentées dans TRQL Labs. Or, ces classes ne sont
        // PAS prêtes pour l'instant et sont LOIN de l'être!!!
        $this->die( __METHOD__ . "(): NOT implemented yet" );
    }   /* End of Artist.__getInfoFromProvider() ====================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Artist.speak() ====================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Artist.sing() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $property )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $property   (string)        The name of the property to access
        *}

        {*return
            (mixed)     The value of [c]@param.property[/c] or throwing an exception if
                        [c]@param.property[/c] NOT found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $property )
    /*------------------------------*/
    {
        //var_dump( "IN " . __METHOD__ . "() WITH '{$property}'" );
        switch ( $property )
        {
            case 'szStorage':   return ( $this->storage );
            default         :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
        }   /* switch ( $property ) */
    }   /* End of Artist.__get() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__set( $property,$value )=

        Run when writing data to inaccessible (protected or private) or non-existing
        properties.

        {*params
            $property   (string)        The name of the property to access
            $value      (mixed)         The value to assign to the property
        *}

        {*return
            (mixed)     What the internal method that's called returns
        *}

        *}}
    */
    /* ================================================================================ */
    public function __set( $property,$value )
    /*-------------------------------------*/
    {
        switch ( $property )
        {
            case 'szStorage':   $this->storage = $value;
            default         :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
        }   /* switch ( $property ) */
    }   /* End of Artist.__set() ====================================================== */
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
    }   /* End of Artist.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Artist ============================================================ */
/* ==================================================================================== */
