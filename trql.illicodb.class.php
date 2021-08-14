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
    {*file                  trql.illicodb.class.php *}
    {*purpose               TRQL Labs Database *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 19:19 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    {*abstract              IllicoDB is THE proprietary database of TRQL Labs/Lato
                            Sensu Management.[br]

                            An IllicoDB database is composed of:

                                - a DB Container (XML file)
                                - tables
                                - memo files
                                - indexes

                            All tables are defined in the DB Container.

                            Field names are not limited in size. It is recommended to
                            name all field names with a starting "f_" so that field
                            names can be easily recognized in the code.
    *}

    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-07-21 13:51:11 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 29-07-21 00:33:02 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Champs mémo
                            2)  Champs array
                            3)  Champs objet
        *}
    *}

    {*chist
        {*mdate 03-08-21 11:00:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  All variable length fields have been implemented
                                as "memo" fields, which now can store any sort of
                                value (objects, arrays, files, ...)
        *}
    *}

    {*todo

        1) Pouvoir créer le schéma d'une table sur base des propriétés d'une classe (on donne le nom de la classe
           et la structure de la table est automatiquement déterminée par la classe; utilisation des méthodes
           magiques __sleep() et __wakeup())
        2) Pouvoir sauver tout un record ou une array de records (en commençant au recno
           courant)
        3) Documenter toute la classe IllicoDB
        4) Implémenter les champs "guid"
        7) Pouvoir mettre un commentaire sur chaque champ de la structure d'une table
        8) Pouvoir modifier la structure "on-the-fly" (les données sont recopiées sans aucune perte dans la nouvelle structure)
        9) Création d'une documentation des tables faisant partie d'une DB
        10) Disposer de Stored Procedures
        11) Pouvoir mettre des champs en relation (1 .. 1, 1 .. n, n .. 1)
        12) Extraire le commentaire de la structure d'une table (modifier en description)
        13) Le create() doit permettre de placer les descriptions des champs
        14) __toXML() d'une table
        15) Pouvoir faire une modification de structure de la DB à chaud (readStructure() doit pouvoir
            être ré-appelé; un modifyStructure dot voir le jour)
        16) Les noms des champs doivent être case-sensitive
        17) Implémenter un PACK
        18) Implémenter un champ "othermemo" : c'est un fichier mémo mais il a un nom
            positionnable par l'utilisateur (une référence à un autre fichier mémo dans
            lequel les données sont vraiment disponibles)
        19) If duplicate id => EXCEPTION
        20) Quand on indexe (c'est le sort en fait) on devrait faire les manipulations dans
            un fichier (ce sera peut-être plus lent mais au moins on pourra indexer beaucoup
            plus de données). Il est même possible d'avoir une double stratégie:
                - en mémoire pour des quantités limitées
                - en fichier pour des quantités plus importantes
        21) Permettre une mise à jour des index en temps réel : on voit quels sont les index
            positionnés sur la table, et ils sont mis à jour automatiquement sur base
            des write, append, delete et pack.
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \DOMDocument;
use \DOMXPath;

use \trql\vaesoli\Vaesoli   as v;
use \trql\schema\Thing      as Thing;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'ILLICODB_CLASS_VERSION' ) or define( 'ILLICODB_CLASS_VERSION','0.1' );

defined( "EXCEPTION_BASIS" )                                    or define( "EXCEPTION_BASIS"                                        ,1000000 );

defined( "EXCEPTION_UNKNOWN_METHOD" )                           or define( "EXCEPTION_UNKNOWN_METHOD"                               ,EXCEPTION_BASIS + 1000 );
defined( "EXCEPTION_DB_CONTAINER_NOT_FOUND" )                   or define( "EXCEPTION_DB_CONTAINER_NOT_FOUND"                       ,EXCEPTION_BASIS + 1001 );
defined( "EXCEPTION_TABLE_NOT_FOUND" )                          or define( "EXCEPTION_TABLE_NOT_FOUND"                              ,EXCEPTION_BASIS + 1002 );
defined( "EXCEPTION_INVALID_PROPERTY" )                         or define( "EXCEPTION_INVALID_PROPERTY"                             ,EXCEPTION_CODE_INVALID_PROPERTY );  /*Defined in trql.mother.class.php */
defined( "EXCEPTION_INVALID_DB_CONTAINER" )                     or define( "EXCEPTION_INVALID_DB_CONTAINER"                         ,EXCEPTION_BASIS + 1003 );
defined( "EXCEPTION_TABLE_NOT_FOUND" )                          or define( "EXCEPTION_TABLE_NOT_FOUND"                              ,EXCEPTION_BASIS + 1004 );
defined( "EXCEPTION_INVALID_FIELD" )                            or define( "EXCEPTION_INVALID_FIELD"                                ,EXCEPTION_BASIS + 1005 );
defined( "EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_BOF" )              or define( "EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_EOF"                  ,EXCEPTION_BASIS + 1006 );
defined( "EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF" )               or define( "EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF"                   ,EXCEPTION_BASIS + 1007 );
defined( "EXCEPTION_INVALID_HOMEDATA" )                         or define( "EXCEPTION_INVALID_HOMEDATA"                             ,EXCEPTION_BASIS + 1008 );
defined( "EXCEPTION_HOMEDATA_NOT_FOUND" )                       or define( "EXCEPTION_HOMEDATA_NOT_FOUND"                           ,EXCEPTION_BASIS + 1009 );
defined( "EXCEPTION_INVALID_FIELD_TYPE" )                       or define( "EXCEPTION_INVALID_FIELD_TYPE"                           ,EXCEPTION_BASIS + 1010 );
defined( "EXCEPTION_NOT_AN_OBJECT" )                            or define( "EXCEPTION_NOT_AN_OBJECT"                                ,EXCEPTION_BASIS + 1011 );
defined( "EXCEPTION_NOT_AN_ARRAY" )                             or define( "EXCEPTION_NOT_AN_ARRAY"                                 ,EXCEPTION_BASIS + 1012 );
defined( "EXCEPTION_NOT_A_STRING" )                             or define( "EXCEPTION_NOT_A_STRING"                                 ,EXCEPTION_BASIS + 1013 );
defined( "EXCEPTION_NO_ID_FIELD_FOUND" )                        or define( "EXCEPTION_NO_ID_FIELD_FOUND"                            ,EXCEPTION_BASIS + 1014 );
defined( "EXCEPTION_FILE_NOT_FOUND" )                           or define( "EXCEPTION_FILE_NOT_FOUND"                               ,EXCEPTION_BASIS + 1015 );
defined( "EXCEPTION_DB_ALREADY_OPEN" )                          or define( "EXCEPTION_DB_ALREADY_OPEN"                              ,EXCEPTION_BASIS + 1016 );
defined( "EXCEPTION_DB_NOT_OPEN" )                              or define( "EXCEPTION_DB_NOT_OPEN"                                  ,EXCEPTION_BASIS + 1017 );
defined( "EXCEPTION_DUPLICATE_FIELD" )                          or define( "EXCEPTION_DUPLICATE_FIELD"                              ,EXCEPTION_BASIS + 1018 );


trait commonTrait
/*-------------*/
{
    public function hash( $szValue )
    {
        return ( hash( 'sha1',(string) $szValue ) );
    }

    /* OBSOLETE */
    public function fieldTypesOLD()
    {
        static $aTypes = null;

        if ( is_null( $aTypes) )
        {
            $aTypes['boolean'   ] =
            $aTypes['bool'      ] =
            $aTypes['logical'   ] = 1;
            $aTypes['date'      ] = 8;
            $aTypes['datetime'  ] = 14;
            $aTypes['float'     ] = 16;
            $aTypes['gender'    ] = 1;
            $aTypes['id'        ] = 40;
            $aTypes['int'       ] = 8;
            $aTypes['lang'      ] = 5;
            $aTypes['string'    ] = -1;
            $aTypes['time'      ] = 6;

            $aTypes['array'     ] = 0;
            $aTypes['memo'      ] = 0;
            $aTypes['object'    ] = 0;
            $aTypes['guid'      ] = 0;
            $aTypes['email'     ] = 0;
            $aTypes['color'     ] = 0;
        }

        return ( $aTypes );
    }

    /* OBSOLETE */
    public function isTypeOLD( $type )
    {
        static $aTypes = null;

        if ( is_null( $aTypes) )
            $aTypes = $this->fieldTypes();

        //var_dump( $type,isset( $aTypes[$type] ),$aTypes );

        return ( isset( $aTypes[$type] ) );
    }

    /* OBSOLETE */
    public function fieldLengthOLD( $type )
    {
        static $aLengths = null;

        // Devrait se baser sur les longueurs définies dans fieldTypes() */
        if ( is_null( $aLengths ) )
        {
            $aLengths['boolean' ] =
            $aLengths['bool'    ] =
            $aLengths['logical' ] = 1;
            $aLengths['date'    ] = 8;
            $aLengths['datetime'] = 14;
            //$aLengths['float'   ] = ( PHP_FLOAT_SIZE * 2 )+ 1;
            $aLengths['float'   ] = 16;
            $aLengths['gender'  ] = 1;
            $aLengths['id'      ] = 40;
            //$aLengths['int'     ] = PHP_INT_SIZE + 1;
            $aLengths['int'     ] = 8;
            $aLengths['time'    ] = 6;
            $aLengths['lang'    ] = 5;
            $aLengths['memo'    ] = 0;
        }

        return ( $aLengths[$type] ?? -1 );
    }
    /* ================================================================================ */
    /** {{*fieldLength( $type )=

        Determine the length of a field based on its type

        {*params
            $type       (string)        Field type
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function fieldLength( $type )
    /*--------------------------------*/
    {
        static $aTypes = null;

        if ( is_null( $aTypes ) )
        {
            $aTypes['boolean' ] =
            $aTypes['bool'    ] =
            $aTypes['logical' ] = 1;
            $aTypes['city'    ] = 50;
            $aTypes['country' ] = 2;
            $aTypes['date'    ] = 8;
            $aTypes['datetime'] =
            $aTypes['lupdate' ] = 14;
            //$aTypes['float'     ] = ( PHP_FLOAT_SIZE * 2 )+ 1;
            $aTypes['float'   ] = 16;
            $aTypes['gender'  ] = 1;
            $aTypes['guid'    ] =
            $aTypes['id'      ] = 40;
            //$aLengths['int'     ] = PHP_INT_SIZE + 1;
            $aTypes['int'     ] = 8;
            $aTypes['time'    ] = 6;
            $aTypes['lang'    ] = 5;

            /* Indicates that length is manual */
            $aTypes['string'  ] = -1;

            /* Variable length fields */
            $aTypes['memo'    ] = 0;
        }   /* if ( is_null( $aTypes ) ) */

        return ( $aTypes[$type] ?? -EXCEPTION_INVALID_FIELD /* Indicate an error */ );
    }   /* End of commonTrait.fieldLength() =========================================== */
    /* ================================================================================ */
}   /* End of trait commonTrait ======================================================= */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class IllicoDB=

    {*desc

        TRQL Labs proprietary database

    *}

    {*warning
        This class should NOT be used in a production environment as it has NOT been
        sufficiently tested. On top of that, many methods are not final: in the future
        some of them may no longer exist.
    *}


    *}}
 */
/* ==================================================================================== */
class IllicoDB extends Thing
/*------------------------*/
{
    use commonTrait;

    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q8513';              /* {*property   $wikidataId                 (string)                WikidataId ... organized collection of data in computing *} */
    public      $homeOfData                 = null;
    public      $tables                     = null;                 /* {*property   $tables                     (array)                 Set of tables composing the DB *} */
    public      $storedProcedures           = null;                 /* {*property   $storedProcedures           (array)                 Set of stored procedures (NOT USED : 29-07-21 14:40:19) *} */
    public      $name                       = null;                 /* {*property   $name                       (string)                DB Name *} */
    protected   $isOpen                     = false;
    public      $table                      = null;

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

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of Database.__construct() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*open( $name,$folder )=

        Open the DB Container

        {*params
            $name       (string)        Name of the DB Container
            $folder     (string)        Directory where the DB Container is located
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*seealso @fnc.close *}

        *}}
    */
    /* ================================================================================ */
    public function open( $name,$folder )
    /*---------------------------------*/
    {
        if ( is_string( $folder ) )
        {
            if ( ! is_dir( $this->homeOfData = v::FIL_RealPath( v::FIL_ResolveRoot( $folder ) ) ) )
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$folder}' is NOT a valid directory (ErrCode: " . EXCEPTION_HOMEDATA_NOT_FOUND . ")",EXCEPTION_HOMEDATA_NOT_FOUND );
        }
        else
        {
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": INVALID HOMEDATA (ErrCode: " . EXCEPTION_INVALID_HOMEDATA . ")",EXCEPTION_INVALID_HOMEDATA );
        }

        $this->isOpen = true;

        //if ( preg_match( '/(?P<database>.*)\.(?P<table>.*)/',$name,$aMatches ) )
        {
            //$this->name = trim( $aMatches['database'] );
            $this->name = $name;
            //$this->table    = trim( $aMatches['table'   ] );

            $this->readStructure();
        }
        //else
        //{
        //    // EXCEPTION CAR PAS <database>.<table>
        //}

        return ( $this );
    }   /* End of Database.open() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*close()=

        Close the DB Container

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*seealso @fnc.close *}

        *}}
    */
    /* ================================================================================ */
    public function close()
    /*-------------------*/
    {
        if ( $this->isOpen )
        {
            $this->name             = null;
            $this->isOpen           = false;
            $this->tables           = null;
            $this->storedProcedures = null;
            $this->homeOfData       = null;
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$this->name}' already OPEN (ErrCode: " . EXCEPTION_DB_ALREADY_OPEN . ")",EXCEPTION_DB_ALREADY_OPEN );

        return ( $this );
    }   /* End of Database.close() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*use( $table )=

        Use a table

        {*params
            $table      (string)        Name of the table to use. If @param.table cannot
                                        be found in the DB Container a
                                        [c]EXCEPTION_TABLE_NOT_FOUND[/c] exception is
                                        thrown.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*remark
            The DB Container must be open BEFORE using this method. If not open
            a [c]EXCEPTION_DB_NOT_OPEN[/c] exception is thrown.[br]
            The record pointer of the table is positioned at 1 if records can be found
            in the table; otherwise, it is [c]0[/c].
        *}

        {*example
        Imagine you have a DB called 'Tamarind'. This DB stores tracks and
        artists for the "Tamarin Radio". The physical file of the DB Container is
        '[c]tamarind.illicoDB[/c]'[br]

        Tracks are stored in the 'catalog' table ('[c]tamarind.catalog.illicoDB[/c]')[br]
        Artists are stored in the 'artists' table ('[c]tamarind.artists.illicoDB[/c])'[br][br]

        $oDB = new IllicoDB();
        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        [b]$oDB->use( 'artists' );[/b]
        *}

        *}}
    */
    /* ================================================================================ */
    public function use( $table )
    /*-------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[ $table ] ) )
            {
                //var_dump("ON EST DANS LE USE");
                $this->table = $table;

                try
                {
                    //var_dump( "BEFORE EXCEPTION");
                    $this->Go( $table,$this->reccount( $table ) > 0 ? 1 : 0 );
                }
                catch( Exception $e )
                {
                    var_dump( $e );
                }
            }
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

        return ( $this );
    }   /* End of Database.use() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*structure()=

        Reports the DB structure

        {*params
        *}

        {*return
            (string)    The HTML code that reports the structure
        *}

        {*warning
            The name of the method will be changed. Do not use for production
        *}

        *}}
    */
    /* ================================================================================ */
    public function structure()
    /*-----------------------*/
    {
        $szRetVal = '';

        //var_dump( $this->tables );
        foreach( $this->tables as $name => $table )
        {
            $szRetVal .= "<p>{$name} (records: " . $table->reccount . " &#8213; record size: {$table->recordSize} bytes)</p>";
            $szRetVal .= "<ul>\n";
            //var_dump( $table->offsets );
            foreach( $table->fields as $fname => $field )
            {
                $szRetVal .= "<li><code>{$fname}</code> (type = {$field->type}) (length = {$field->length}): {$field->description}</li>\n";
            }
            $szRetVal .= "</ul>\n";
        }

        return ( $szRetVal );
    }   /* End of Database.structure() ================================================ */
    /* ================================================================================ */


    /* Do no use it yet */
    public function writeRawMemo( $table,$aMemo )
    /*-----------------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[ $table ] ) )
                return ( $this->tables[$table]->writeRawMemo( $aMemo ) );
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.writeRawMemo() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*write( $table,$field[,$value] )=

        Writes @param.value in the @param.field field of the current record of the
        @param.table table

        {*params
            $table      (string)    The name of the table concerned by the write operation
            $field      (string)    The name of the field concerned by the write operation
            $value      (mixed)     The value that must be written in the @param.field field
                                    of the @param.table table.
        *}

        {*return
            (int)       Returns the number of bytes written or [c]0[/c] in case of error
        *}

        {*example
        $oDB = new IllicoDB();
        try
        {
            $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        }
        catch ( Exception $e )
        {
            switch ( $e->getCode() )
            {
                case EXCEPTION_DB_CONTAINER_NOT_FOUND:
                    {
                        var_dump( $e->getMessage() );
                        var_dump( "STACK:",$e->getTrace() );
                        $oDB->die();
                    }
                    break;
                default:
                    {
                        var_dump( $e );
                        $oDB->die();
                    }
            }   |** switch ( $e->getCode ) **|

        }

        $oDB->use( 'artists' );
        $oDB->clearData( 'artists' );

        var_dump( "RECNO: "     . $oDB->recno(    'artists' ) );
        var_dump( "RECCOUNT: "  . $oDB->reccount( 'artists' ) );

        $oDB->append( 'artists' );

        $oDB->write( 'artists','id'         ,v::guid( true ) );
        $oDB->write( 'artists','firstname'  ,'Stevie' );
        $oDB->write( 'artists','lastname'   ,'Nicks' );
        $oDB->write( 'artists','birthdate'  ,date( 'Ymd',strtotime( '26 May 1948' ) ) );
        $oDB->write( 'artists','birthplace' ,'Q16556' );    |** See Wikidata https://www.wikidata.org/wiki/Q16556 **|

        $t1 = microtime( true );
        var_dump( trim( trim( $oDB->read( 'artists','firstname' ) ) . ' ' . trim( $oDB->read( 'artists','lastname' ) ) ) . ' born on ' . date('d-m-Y',strtotime( trim( $oDB->read( 'artists','birthdate' ) ) ) ) );
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function write( $table,$field,$value = null )
    /*------------------------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->write( $field,$value ) );
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

        return ( 0 );
    }   /* End of Database.write() ==================================================== */
    /* ================================================================================ */




    // Example: $oDB->read( 'artists','creator' );                  /* Doit retourner 'Any value' du record courant */
    public function read( $table,$field )
    /*---------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->read( $field ) );
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

    }   /* End of Database.read() ===================================================== */
    /* ================================================================================ */


    /* Pas définitif : arguments */
    /* Un find() opère en cherchant par sous-chaîne case sensitive */
    /* Seul le premier record est renvoyé */
    public function find( $table,$field,$value,$sensitive = true,&$collection = null )
    /*------------------------------------------------------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( $this->isOpen && isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->find( $field,$value,$sensitive,$collection ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

    }   /* End of Database.find() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*seek( $table,$szValue,&$aValues,&$index,&$recno ) )=

        Seek the @param.szValue in the @param.table table using the @param.aValues

        {*params
            $table      (string)    The name of the table concerned by the seek operation
            $szValue    (string)    The value to look for
            $aValues    (array)     The array of indexed values (typically resulting from
                                    a call to the [c]index()[/c] method.
        *}

        {*return
            (bool)      [c]true[/c] if @param.szValue found in @param.aValues.
        *}

        {*warning
            The algorithm is not well suited for very large databases that retain million
            of records. IT MUST BE REBUILT. On top of that, there should be a mechanism
            to build the index in a case-insensitive manner.
        *}

        {*remark
            Seeks are always case sensitive
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        $aValues = $oDB->index( 'artists','name' );
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        //var_dump( $aValues );


        $t1 = microtime( true );
        [b]$index = $recno = 0;
        if ( $oDB->seek( 'artists','Stevie',$aValues,$index,$recno ) )
        {
            //var_dump( $index,$recno );
            $oDB->Go( 'artists',$recno );
            //var_dump( $oDB->read( 'artists','name' ) );
        }[/b]
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function seek( $table,$szValue,&$aValues,&$index,&$recno )
    /*-------------------------------------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( $this->isOpen && isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->seek( $szValue,$aValues,$index,$recno ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.seek() ===================================================== */
    /* ================================================================================ */




    /* ================================================================================ */
    /** {{*index( $table,$field )=

        Index the @param.field field of the @param.table table

        {*params
            $table      (string)    The name of the table concerned by the index operation
            $field      (string)    The name of the field to index on
        *}

        {*return
            (array)     Array of values
        *}

        {*warning
            The algorithm is not well suited for very large databases that retain million
            of records. IT MUST BE REBUILT. On top of that, there should be a mechanism
            to build the index in a case-insensitive manner. The case of other types than
            strings has not been taken into account so far.
        *}

        {*remark
            If the index appears up-to-date it is not rebuilt
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        [b]$aValues = $oDB->index( 'artists','f_name' );[/b]
        // Alternate code: [b]$aValues = $oDB->artists->index( 'f_name' );[/b]
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        //var_dump( $aValues );


        $t1 = microtime( true );
        $index = $recno = 0;
        if ( $oDB->seek( 'artists','Stevie',$aValues,$index,$recno ) )
        {
            $oDB->Go( 'artists',$recno );
            //var_dump( $oDB->read( 'artists','name' ) );
        }
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function index( $table,$field,$forced = false )
    /*--------------------------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( $this->isOpen && isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->index( $field,$forced ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

    }   /* End of Database.index() ==================================================== */
    /* ================================================================================ */


    /* Lit la structure de la DB */
    protected function readStructure()
    /*------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( is_file( $szDBFile = strtolower( v::FIL_addBS( $this->homeOfData ) . $this->name . '.illicoDB' ) ) )
            {
                //var_dump( "ON PEUT TRAVAILLER" );
                $oDom = new \DOMDocument();

                if ( $oDom->load( $szDBFile ) )
                {
                    //var_dump( "DOM loaded" );
                    $oXPath = new \DOMXPath( $oDom );
                    //var_dump( "XPath created" );

                    if ( ( $tableCollection = $oXPath->query( 'tables/table' ) ) && ( $tableCollection->length > 0 ) )
                    {
                        //var_dump( "ON A TROUVÉ LES TABLES" );

                        foreach( $tableCollection as $table )
                        {
                            $oTable             = new Table();

                            $oTable->container  = $this;
                            $oTable->name       = strtolower( trim( $table->getAttribute( 'name' ) ) );

                            $oTable->readStructure( $oDom,$oXPath,$table );

                            $this->tables[$oTable->name] = $oTable;
                        }
                    }
                }
                else
                {
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": 'INVALID DB CONTAINER (cannot be loaded) (ErrCode: " . EXCEPTION_INVALID_DB_CONTAINER . ")",EXCEPTION_INVALID_DB_CONTAINER );
                }
            }
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szDBFile}' NOT FOUND (ErrCode: EXCEPTION_DB_CONTAINER_NOT_FOUND = " . EXCEPTION_DB_CONTAINER_NOT_FOUND . ")",EXCEPTION_DB_CONTAINER_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

    }   /* End of Database.readStructure() ============================================ */
    /* ================================================================================ */


    public function append( $table,$x = 1 )
    /*-----------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->append( $x ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.append() =================================================== */
    /* ================================================================================ */


    public function reccount( $table )
    /*------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->reccount() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.reccount() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*skip( $table[,$n] )=

        Skip forward or backward (the internal record pointer is updated)

        {*params
            $table      (string)    The name of the table concerned by the index operation
            $n          (int)       The number of records that must be skipped. Moving 1
                                    record forward: [c]@param.n = 1[/c]
        *}

        {*return
            (array)     Array of values
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        {
            $oDB->artists->Go( 1 );
            while( ! $oDB->artists->eof() )
            {
                $oDB->artists->skip();
            }
        }
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function skip( $table,$n = 1 )
    /*---------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->skip( $n ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.skip() ===================================================== */
    /* ================================================================================ */


    public function go( $table,$n )
    /*---------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->go( $n ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.go() ======================================================= */
    /* ================================================================================ */


    public function recno( $table )
    /*---------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->recno );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.recno() ==================================================== */
    /* ================================================================================ */


    public function deleted( $table )
    /*-----------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->deleted() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.deleted() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*delete( $table )=

        Logical deletion of the current record of @param.table

        {*params
            $table      (string)        Logical deletion of the current record
        *}

        {*return
            (bool)      [c]true[/c] if record deleted; [c]false[/c] if not
        *}

        {*seealso @fnc.deleted, @fnc.pack *}

        *}}
    */
    /* ================================================================================ */
    public function delete( $table )
    /*-----------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->delete() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.delete() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*pack( $table )=

        Removes all records from a table that have been marked as deleted.

        {*params
            $table      (string)        Table to consider
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*seealso @fnc.deleted, @fnc.pack *}

        *}}
    */
    /* ================================================================================ */
    public function pack( $table )
    /*--------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->pack() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.pack() ===================================================== */
    /* ================================================================================ */


    public function recall( $table )
    /*-----------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->recall() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.recall() =================================================== */
    /* ================================================================================ */


    public function record( $table )
    /*----------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->record() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.record() =================================================== */
    /* ================================================================================ */


    public function records( $table,$n = 1)
    /*-----------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->records( $n ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.records() ================================================== */
    /* ================================================================================ */


    public function getAll( $table,$field )
    /*-----------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->getAll( $field ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.getAll() =================================================== */
    /* ================================================================================ */


    public function readRaw( $table,$offset,$length )
    /*---------------------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->readRaw( $offset,$length ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.getAll() =================================================== */
    /* ================================================================================ */


    public function clearData( $table )
    /*-------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->clearData() );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.clearData() ================================================ */
    /* ================================================================================ */


    public function create( $DBName,$aTables,$folder )
    /*----------------------------------------------*/
    {
        if ( ! is_null( $folder ) )
            $this->homeOfData = $folder;

        $szDBFile = strtolower( v::FIL_addBS( $this->homeOfData ) . $DBName . '.db' );

        $szXML  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

        $szXML .= "<database>\n";
        $szXML .= "    <tables>\n";

        foreach ( $aTables as $name => $aData )
        {
            $szXML .= "        <table name=\"{$name}\">\n";

            foreach( $aData['fields'] as $aField )
            {
                //var_dump( $aField );
                if ( ( $iLength = $this->fieldLength( $aField['type'] ) ) === -1 )
                    $iLength = $aField['length'];

                $szXML .= "            <field name=\"{$aField['fieldname']}\" length=\"{$iLength}\" type=\"{$aField['type']}\" />\n";
            }   /* foreach( $aData['fields'] as $aField ) */

            $szXML .= "        </table>\n";
        }   /* foreach ( $aTables as $name => $aData ) */


        $szXML .= "    </tables>\n";
        $szXML .= "</database>\n";

        v::FIL_StrToFile( $szXML,$szDBFile );

    }   /* End of Database.create() =================================================== */
    /* ================================================================================ */


    public function speak()
    {

    }   /* End of Database.speak() ==================================================== */
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
            case 'name' :   return ( $this->name );
            default     :   if ( isset( $this->tables[$property] ) )
                            {
                            //    var_dump( $this->tables[$property] );
                                return ( $this->tables[$property] );
                            }
                            else
                                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
        }   /* switch ( $property ) */
    }   /* End of Database.__get() ==================================================== */
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
            default     :   if ( isset( $this->tables[$property] ) )
                                return ( $this->tables[$property]->write( $value ) );
                            else
                                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
        }   /* switch ( $property ) */
    }   /* End of Database.__set() ==================================================== */
    /* ================================================================================ */


    public function __call( $name,$arguments )
    /*--------------------------------------*/
    {
        throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$name}()' ... UNKNOWN method (ErrCode: " . EXCEPTION_UNKNOWN_METHOD . ")",EXCEPTION_UNKNOWN_METHOD );
    }   /* End of Database.__call() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of Database.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class IllicoDB ========================================================== */
/* ==================================================================================== */


class Table extends Thing
/*---------------------*/
{
    use commonTrait;

    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q496946';            /* {*property   $wikidataId                 (string)                WikidataId ... arrangement of data in rows and columns *} */
    public      $name                       = null;
    public      $fields                     = null;
    public      $recno                      = 0;
    public      $reccount                   = 0;
    public      $offsets                    = null;
    public      $container                  = null;     /* Le nom de la DB dans laquelle est stockée la table */
    public      $recordSize                 = -1;
    public      $fileSize                   = -1;
    public      $storage                    = null;
    public      $autoSort                   = true;     /* Si true, alors si l'index est out-of-sync avec la DB, alors il est reconstruit; si false, l'index n'est PAS reconstuit et on pourrait se trouver avec un vieil index (mais probablement utilisable en partie) */
    protected   $readHandle                 = null;
    protected   $readMemoHandle             = null;
    protected   $writeHandle                = null;
    protected   $writeMemoHandle            = null;
    protected   $writeRawMemoHandle         = null;
    protected   $indexHandles               = null;
    protected   $reccountHandle             = null;
    protected   $isEOF                      = true;
    protected   $isBOF                      = true;



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

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of Table.__construct() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*determineDataFile()=

        Determine the name of the data file (table) we're busy with

        {*params
        *}

        {*return
            (string)      The name of the physical file
        *}

        *}}
    */
    /* ================================================================================ */
    public function determineDataFile() : string
    /*----------------------------------------*/
    {
        if ( is_null( $this->storage ) )
            $this->storage = v::FIL_addBS( $this->container->homeOfData ) . strtolower( trim( $this->container->name ) ) . '.' .
                                                                            strtolower( trim( $this->name            ) ) . '.illicoDB';

        return ( $this->storage );
    }   /* End of Table.determineDataFile() =========================================== */
    /* ================================================================================ */


    public function determineLengthOfDataFile()
    /*---------------------------------------*/
    {
        if ( is_null( $this->reccountHandle ) )
        {
            if ( is_file( $szFile = $this->determineDataFile() ) )
            {
                $this->reccountHandle = fopen( $szFile,'rb' );
            }
            else
            {
                /* Create an empty file */
                v::FIL_StrToFile( '',$szFile );

                if ( ! is_file( $szFile ) )
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szFile}' TABLE NOT FOUND (ErrCode: EXCEPTION_TABLE_NOT_FOUND = " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
                else
                    $this->reccountHandle = fopen( $szFile,'rb' );
            }
        }

        if ( $this->reccountHandle )
        {
            fseek( $this->reccountHandle,0,SEEK_END );
            $this->fileSize = ftell( $this->reccountHandle );
            //fclose( $fh );
        }   /* if ( $fh = fopen( $szFile,'rb' ) ) */
        else
        {
            $this->reccountHandle = fopen( $szFile,'rb' );
            $this->fileSize = ftell( $this->reccountHandle );
        }

        return ( $this->fileSize );
    }   /* End of Table.determineLengthOfDataFile() =================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*reccount()=

        Determine the number of records in the table

        {*params
        *}

        {*return
            (int)       Record count
        *}

        *}}
    */
    /* ================================================================================ */
    public function reccount() : int
    /*----------------------------*/
    {
        $this->determineLengthOfDataFile();         /* $this->fileSize est mis à jour */

        return ( (int) ( $this->fileSize / $this->recordSize ) );
    }   /* End of Table.reccount() ==================================================== */
    /* ================================================================================ */


    public function flush()
    /*-------------------*/
    {
        if ( $this->writeHandle )
        {
            fflush( $this->writeHandle );
            fclose( $this->writeHandle );
            $this->writeHandle = null;
        }
    }   /* End of Table.flush() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*delete()=

        Deletes the record from the current table.

        {*params
        *}

        {*return
            (bool)      [c]true[/c] if record deleted; [c]false[/c] if not
        *}

        *}}
    */
    /* ================================================================================ */
    public function delete()
    /*--------------------*/
    {
        $bRetVal = false;

        $szFile = $this->determineDataFile();

        if ( $fh = fopen( $szFile,'c+b' ) )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) );

            fseek( $fh,$offset,SEEK_SET );

            $bRetVal = ( fwrite( $fh,'*' ) === 1 );

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $bRetVal );

    }   /* End of Table.delete() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*pack()=

        Removes all records that have been marked as deleted.

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*seealso @fnc.deleted, @fnc.pack *}

        *}}
    */
    /* ================================================================================ */
    public function pack( $table )
    /*--------------------------*/
    {
        $iDeleted = 0;
        $iRecno = $this->recno();                                   /* Save record pointer */

        $szFile = $this->determineDataFile();

        $this->Go( 1 );

        while( ! $this->eof() )                                     /* While NOT EndOfFile */
        {
            if ( $this->deleted() )                                 /* If deleted */
            {
                // Bon, ici ... il faut VRAIMENT faire le travail !!!
                $iDeleted++;                                        /* Count */
            }   /* if ( $this->deleted() ) */

            $this->skip();                                          /* Next record */
        }   /* while( ! $this->eof() ) */

        $this->Go( $iRecno );                                       /* Restore record pointer */

        return ( $iDeleted );                                       /* Return the nuber of records that were deleted */
    }   /* End of Table.pack() ======================================================== */
    /* ================================================================================ */


    public function clearData()
    /*-----------------------*/
    {
        $bRetVal = false;

        $szFile = $this->determineDataFile();

        if ( $fh = fopen( $szFile,'wb' ) )
        {
            fseek( $fh,0,SEEK_END );
            $bRetVal = ( ftell( $fh ) === 0 );
            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        $this->recno = 0;

        return ( $bRetVal );

    }   /* End of Table.clearData() =================================================== */
    /* ================================================================================ */


    public function deleted()
    /*---------------------*/
    {
        $bRetVal = false;

        $szFile = $this->determineDataFile();

        if ( $fh = fopen( $szFile,'r+b' ) )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) );

            fseek( $fh,$offset,SEEK_SET );

            $bRetVal = ( fread( $fh,1 ) === '*' );

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $bRetVal );

    }   /* End of Table.deleted() ===================================================== */
    /* ================================================================================ */


    public function recall()
    /*--------------------*/
    {
        $bRetVal = false;

        $szFile = $this->determineDataFile();

        if ( $fh = fopen( $szFile,'c+b' ) )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) );

            fseek( $fh,$offset,SEEK_SET );

            $bRetVal = ( fwrite( $fh,' ' ) === 1 );

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $bRetVal );
    }   /* End of Table.recall() ====================================================== */
    /* ================================================================================ */


    public function append( $x = 1 )
    /*----------------------------*/
    {
        $szFile = $this->determineDataFile();

        $iRetVal = -1;

        if ( $fh = fopen( $szFile,'a+b' ) )
        {
            // JE DOIS METTRE UN LOCK!!!
            $iRetVal = fwrite( $fh,str_repeat( ' ',$x * $this->recordSize ) );

            if ( $this->fileSize < 1 )
                $this->determineLengthOfDataFile();         /* $this->fileSize est mis à jour */

            fclose( $fh );

            // ICI, JE DOIS TESTER ! QUAND ON AJOUTE UN NOUVEAU RECORD,
            // LE RECORD COURANT EST LE DERNIER !!!
            $this->recno = $this->reccount();
        }
        else
        {
            // EXCEPTION: CANNOT APPEND (FOPEN FAILED)
        }

        return ( $iRetVal );
    }   /* End of Table.append() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*skip( [$n] )=

        Skip forward or backward (internal record pointer updated)

        {*params
            $table      (string)    The name of the table concerned by the index operation
            $n          (int)       The number of records that must be skipped. Moving 1
                                    record forward: [c]@param.n = 1[/c]
        *}

        {*return
            (array)     Array of values
        *}

        {*remark
            When attempting to move past the EOF (number of records in the table), the
            internal marker of EOF is set; When attempting to move before the BOF (<1),
            the internal marker of BOF is set.
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        {
            $oDB->artists->Go( 1 );
            while( ! $oDB->artists->eof() )
            {
                $oDB->artists->skip();
            }
        }
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function skip( $n = 1 )
    /*--------------------------*/
    {
        if ( $this->recno + $n > $this->reccount() )
        {
            $this->isEOF = true;
            $this->recno = PHP_INT_MAX;
        }
        elseif ( $this->recno + $n < 1 )
        {
            $this->isBOF = true;
            $this->recno = PHP_INT_MIN;
        }

        return ( $this->recno = $this->recno + $n );

    }   /* End of Table.skip() ======================================================== */
    /* ================================================================================ */


    public function eof()
    /*-----------------*/
    {
        return ( $this->isEOF );
    }   /* End of Table.eof() ========================================================= */
    /* ================================================================================ */


    public function bof()
    /*-----------------*/
    {
        return ( $this->isBOF );
    }   /* End of Table.eof() ========================================================= */
    /* ================================================================================ */


    public function recno()
    {
        return ( $this->recno );
    }


    /* ================================================================================ */
    /** {{*go( $n )=

        Move the record pointer to @param.n

        {*params
            $n          (int)       The record to go to.
        *}

        {*return
            (int)       The current record number
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        {
            [b]$oDB->artists->Go( 1 );[/b]
            while( ! $oDB->artists->eof() )
            {
                $oDB->artists->skip();
            }
        }
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function go( $n )
    /*--------------------*/
    {
        if ( $n > 0 && $n <= $this->reccount() )
        {
            $this->recno = $n;
            $this->isBOF = $this->isEOF = false;
        }
        else
        {
            if ( $n < 1 )
            {
                $this->isBOF = true;
                $this->isEOF = false;
            }
            else
            {
                $this->isBOF = false;
                $this->isEOF = true;
            }
        }

        //var_dump( $n,$this->recno,$this->reccount() );

        return ( $this->recno );
    }   /* End of Table.go() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*goto( $n] )=

        Move the record pointer to @param.n

        {*params
            $n          (int)       The record to go to.
        *}

        {*return
            (int)       The current record number
        *}

        {*remark
            The [c]goto[/c] method differs from the [c]go[/c] method in that sense that
            it returns the table it operates on
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        [b]var_dump( $oDB->artists->goto( 20 )->f_name );[/b]
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );
        *}

        *}}
    */
    /* ================================================================================ */
    public function goto( $n )
    /*----------------------*/
    {
        $this->Go( $n );
        return ( $this );
    }   /* End of Table.goto() ======================================================== */
    /* ================================================================================ */


    /* Return the 'id field if any */
    protected function id()
    /*-------------------*/
    {
        // WHY NOT $this->read( 'id' ) DIRECTEMENT ET TRAPPER UNE EXCEPTION ????
        foreach( $this->fields as $field => $oField )
        {
            if ( $oField->type === 'id' )
                return ( $this->read( $field ) );
        }   /* foreach( $this->fields as $field => $oField ) */

        return ( null );
    }   /* End of Table.id() ========================================================== */
    /* ================================================================================ */


    public function write( $field,$value = null )
    /*-----------------------------------------*/
    {
        $iRetVal = -1;

        // Ici, vérification des data en fonction du type de champ

        //var_dump( $this->fields );
        //$this->die();

        //var_dump( "IN " . __METHOD__ );

        if ( isset( $this->fields[$field] ) )
        {
            switch( $this->fields[$field]->type )
            {
                case 'gender'   :   if ( ! preg_match( "/(M|F|U)/i",$value ) )
                                    {
                                        // EXCEPTION TYPE MISMATCH
                                        $this->die( "TYPE MISMATCH. GOT '{$value}' WHILE EXPECTING 'M|F|U'" );
                                    }
                                    break;
                case 'id'       :   if ( is_null( $value ) )
                                        $value = $this->hash( v::guid( true ) );
                                    break;
                case 'lupdate'  :   if ( is_null( $value ) )
                                        $value = date( 'YmdHis' );
                                    break;
                case 'array'    :
                case 'memo'     :
                case 'object'   :   $iRetVal = $this->writeMemo( $field,$value );
                                    goto end;
                                    break;
                default         : //var_dump( $this->fields[$field],$this->fields[$field]->type );
            }   /* switch( $this->fields[$field]->type ) */
        }
        else
        {
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );
        }

        if ( $this->recno < 1 )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ATTEMPT TO WRITE BEFORE BOF (ErrCode: " . EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_EOF . ")",EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_EOF );

        if ( is_null( $this->writeHandle ) )
            $this->writeHandle = fopen( $szFile = $this->determineDataFile(),'c+b' );

        if ( $this->writeHandle )
        {
            // JE DOIS METTRE UN LOCK!!!
            // ATTENTION QUAND ON ÉCRIT DES CRLF !!!
            // ATTENTION QUAND ON ÉCRIT DES MULTIBYTES !!!

            $offset = ( $this->recordSize * ( $this->recno - 1 ) )  +
                      $this->offsets[$field]['offset']              +
                      1; /* +1 => because of the 1st byte which is the "deleted" mark */

            $this->determineLengthOfDataFile();                     /* $this->fileSize est mis à jour */

            //var_dump( $this->recno,$offset,$this->fileSize );
            //$this->die();

            /* Si on reste dans la limite du fichier */
            if ( $offset > 0 && $offset + $this->offsets[$field]['length'] <= $this->fileSize )
            {
                //var_dump( "ON PEUT ECRIRE A OFFSET {$offset}" );
                fseek( $this->writeHandle,$offset,SEEK_SET );
                //var_dump( $field,$this->offsets[$field] );
                $x = fwrite( $this->writeHandle,$value . str_repeat( ' ',$this->offsets[$field]['length'] ),$this->offsets[$field]['length'] );
                //var_dump( "WRITTEN {$x} in {$szFile}" );
                fflush(  $this->writeHandle );
                fseek( $this->writeHandle,0,SEEK_END );
                $this->fileSize = ftell( $this->writeHandle );

                //fclose( $fh );
            }
            else
            {
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ATTEMPT TO WRITE AFTER EOF (ErrCode: " . EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF . ")",EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF );
            }
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        end:

        return ( $iRetVal );
    }   /* End of Table.write() ======================================================= */
    /* ================================================================================ */


    /* Attention: changer l'ID d'un record dans le fichier data peut
       désynchroniser tous les fichiers *.xml liés */
    // protected function writeMemoOld( &$field,&$x )
    // /*---------------------------------------*/
    // {
    //     if ( ! is_string( $x ) && ! is_null( $x ) )
    //     {
    //         var_dump( $x );
    //         throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": value to write is NOT nullable string (ErrCode: " . EXCEPTION_NOT_A_STRING . ")",EXCEPTION_NOT_A_STRING );
    //     }
    //
    //     if ( ! is_null( $szID = $this->id() ) )
    //     {
    //         $szHash = (string) ( crc32( $szID ) % 999983 );
    //         $szFile = $this->determineDataFile() . ".extra.data.{$szHash}.xml";
    //
    //         // Écrire
    //         // <record id=\"{$szID}\">\n
    //         //  <field name=\"{$field}\">\n"><[CDATA[" . serialize( $a ) . "]]></field>\n;
    //         // </record>
    //
    //         $szXML = "<record id=\"{$szID}\">\n";
    //         $szXML .= " <field name=\"{$field}\" type=\"array\"><[CDATA[" . serialize( $x ) . "]]></field>\n";
    //         $szXML .= "</record>\n";
    //
    //         //var_dump( $szXML );
    //
    //         //$this->die( __METHOD__ . "() Not yet ready" );
    //
    //         $oDom = new \DOMDocument();
    //
    //         // Create XML file if it does not exist
    //         if ( ! is_file( $szFile ) )
    //         {
    //             //var_dump( "Create {$szFile}" );
    //             $oDom->formatOutput = true;
    //             $root = $oDom->createElement( 'records' );
    //             $root = $oDom->appendChild( $root );
    //             $oDom->save( $szFile );
    //         }
    //
    //         if ( is_file( $szFile ) )
    //         {
    //             if ( $oDom->load( $szFile ) )
    //             {
    //                 //var_dump( $szFile . " loaded" );
    //
    //                 $root = $oDom->documentElement;
    //                 $oXPath = new \DOMXPath( $oDom );
    //
    //                 $oFieldNode     =
    //                 $oRecordNode    = null;
    //
    //                 if ( ( $oCollection = $oXPath->query( "record[@id='{$szID}']" ) ) && $oCollection->length > 0 )
    //                 {
    //                     // J'ai trouvé le record
    //                     //var_dump( "Record found in XML file" );
    //                     $oRecordNode = $oCollection->item(0);
    //                 }
    //                 else
    //                 {
    //                     //var_dump( $szID . " NOT found in {$szFile}" );
    //
    //                     // Écrire <record id=\"{$szID}\">
    //                     $oRecordNode = $oDom->createElement( 'record' );
    //                     $oRecordNode->setAttribute( 'id',$szID );
    //                     $root->appendChild( $oRecordNode );
    //                     $oDom->save( $szFile );
    //                 }
    //
    //                 if ( ( $oCollection = $oXPath->query( "field[@name='{$field}']",$oRecordNode ) ) && $oCollection->length > 0 )
    //                 {
    //                     //var_dump( "Trouvé le field" );
    //                     $oFieldNode = $oCollection->item(0);
    //                 }
    //                 else
    //                 {
    //                     //var_dump( "Création du field" );
    //
    //                     $oFieldNode = $oDom->createElement( 'field' );
    //                     $oFieldNode->setAttribute( 'name',$field );
    //                 }
    //
    //                 if ( $oRecordNode && $oFieldNode )
    //                 {
    //                     $oFieldNode->setAttribute( 'type','memo' );
    //                     $szData     = base64_encode( serialize( $x ) );
    //                     $oCDATA     = $oDom->createCDATASection( $szData );
    //                     $oFieldNode->nodeValue = '';
    //                     $oFieldNode->appendChild( $oCDATA );
    //                     $oRecordNode->appendChild( $oFieldNode );
    //
    //                     $oDom->save( $szFile );
    //                 }
    //             }
    //         }
    //         else
    //         {
    //             // EXCEPTION: FILE NOT FOUND
    //         }
    //
    //
    //         //$this->die("Tentative d'écrire un objet dans {$szFile}; hash = {$szHash}" );
    //     }
    //     else
    //         throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ID required (ErrCode: " . EXCEPTION_NO_ID_FIELD_FOUND . ")",EXCEPTION_NO_ID_FIELD_FOUND );
    //
    //     return ( 1 );   /* On devrait retourner le nombre de bytes écrits */
    // }   /* End of Table.writeMemo() =================================================== */
    /* ================================================================================ */


    public function writeRawMemo( &$aMemo )
    /*-----------------------------------*/
    {

        if ( ! $this->writeRawMemoHandle )
           $this->writeRawMemoHandle = fopen( $szFile = $this->determineDataFile() . '.memo','c+b' );

        if ( $this->writeRawMemoHandle )
        {
            if ( is_array( $aMemo ) && isset( $aMemo['id'] ) )
            {
                $szID   = $aMemo['id'];
                $record = "<{$szID}>";

                foreach( $aMemo as $field => $value )
                {
                    if ( $field !== 'id' )
                        $record .= "<{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}>";
                }

                $record .= "</{$szID}>";

                fwrite( $this->writeRawMemoHandle,$record );
            }
            else
            {
                fflush( $this->writeRawMemoHandle );
                fclose( $this->writeRawMemoHandle );
            }
        }
    }   /* End of Table.writeRawMemo() ================================================ */
    /* ================================================================================ */


    protected function writeMemo( &$field,&$value )
    /*-------------------------------------------*/
    {
        $iRetVal = 0;

        $this->writeMemoHandle = fopen( $szFile = $this->determineDataFile() . '.memo','c+b' );

        if ( $this->writeMemoHandle )
        {
            //var_dump( "-------------------------- {$field}/{$value}" );
            // Bon ... ici, je dois chercher le début du record
            // <l'id>........</l'id>
            // J'ai deux offsets (le début du record et la fin du record)
            // Une fois que j'ai ces 2 offsets, je peux extraire l'ensemble
            // du record (avec tous les champs, array, object, ...) et je
            // peux rechercher $field là-dedans.

            // Si $field ne s'y trouve pas, je l'ajoute; si $field s'y trouve,
            // je le remplace ... et j'ai un nouveau record
            // Avec mes 2 offsets, je sais aussi jusqu'où je dois lire (la partie
            // AVANT) et aussi à partir de quel endroit je dois reprendre (la
            // partie APRÈS)

            // Ce code écrit le record EXACTEMENT où il faut qu'il s'insère !!!
            $t1         = microtime( true );
            $offset     = 0;
            $size       = 5000 * 8;                                 /* Ici, ajustement possible pour performances */
            $szRoot     = v::FIL_RealPath( dirname( v::FIL_ResolveRoot( $szFile ) ) );
            //var_dump( $szRoot );

            if ( ! is_null( $szID = $this->id() ) )                 /* If we have an ID (no ID => cannot write to a memo file) */
            {
                //var_dump( "ID: " . $szID );

                $startOffset = $endOffset = -1;                     /* starting and ending offsets of the record */
                $recordFound = false;
                $record      = null;

                $t1 = microtime( true );
                $pattern = '<' . $szID . '>';
                //var_dump( "LOOKING FOR '{$pattern}'" );
                $startOffset = v::FIL_searchInFile( $pattern,$szFile,0 /* start position */,60000 /* block size */ );
                $t2 = microtime( true );
                //var_dump( "FINISHED STARTOFFSET IN " . number_format( $t2 - $t1,6,',','.' ) . " secs: " . $startOffset );

                if ( $startOffset !== -1 )
                {
                    $t1 = microtime( true );
                    $pattern = '</' . $szID . '>';
                    //var_dump( "LOOKING FOR '{$pattern}'" );
                    $endOffset = v::FIL_searchInFile( $pattern,$szFile,$startOffset /* start position */,60000 /* block size */ );
                    $t2 = microtime( true );
                    //var_dump( "FINISHED ENDOFFSET IN " . number_format( $t2 - $t1,6,',','.' ) . " secs: " . $endOffset );
                }

                if ( $recordFound = ( $startOffset !== -1 && $endOffset !== -1 ) )
                {
                    fseek( $this->writeMemoHandle,$startOffset,SEEK_SET );
                    // ATTENTION: ICI, JE DOIS AJUSTER LES OFFSETS CAR $startOffset EST LE DEBUT DU <id>
                    //            ET $endOffset est le début du </id>
                    $len = ( $endOffset - $startOffset ) + strlen( $szID ) + 3;
                    $record = fread( $this->writeMemoHandle,$len );
                    //var_dump( "RECORD FOUND" );
                    //var_dump( "RECORD='{$record}'" );
                }   /* if ( $recordFound = ( $startOffset !== -1 && $endOffset !== -1 ) ) */
                else
                {
                    //var_dump( "ON N'A PAS TROUVÉ LE RECORD" );
                    $record = "<$szID><{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}></$szID>";
                }

                if ( ! is_null( $record ) )
                {
                    //var_dump( "LE RECORD N'EST PAS NULL" );

                    // Ici, je dois modifier le record
                    //var_dump( "RECORD TROUVÉ = ",$record );
                    // En fait, ici ... 2 cas de figure:
                    //  1) Le field est trouvé et il doit être remplacé
                    //  2) Le field n'est PAS trouvé et il doit être ajouté au record!
                    if ( preg_match( "%<{$field}>.*</{$field}>%s",$record ) )
                    {
                        //var_dump( "ON A TROUVÉ LE FIELD '{$field}'" );
                        $record = preg_replace( "%<{$field}>.*</{$field}>%s","<{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}>",$record );
                    }
                    else
                    {
                        //var_dump( "!!!!!!!!!!!!!!!!!!!ON N'A PAS TROUVÉ LE FIELD '{$field}'" );
                        $record = str_replace( "</{$szID}>","<{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}></{$szID}>",$record );
                    }

                    //var_dump( "RECORD='{$record}'" );

                    if ( ! $recordFound )
                    {
                        // Le cas est simple: on écrit le record à la fin du fichier et c'est tout!
                        //var_dump( "CAS SIMPLE! ON N'A PAS TROUVÉ LE RECORD ET DONC ON VA ÉCRIRE LE NOUVEAU RECORD À LA FIN DU FICHIER ET BASTA!" );
                        fseek( $this->writeMemoHandle,0,SEEK_END );
                        $iRetVal = fwrite( $this->writeMemoHandle,$record );
                        goto end;
                    }   /* if ( ! $recordFound ) */
                    else    /* Else of ... if ( ! $recordFound ) */
                    {
                        //var_dump( "CAS COMPLIQUÉ! ON A TROUVÉ LE RECORD ET DONC ON VA DEVOIR L'ÉCRIRE DANS LE FICHIER À L'ENDROIT OÙ IL SE TROUVAIT! VOICI LES OFFSETS:" );
                        //var_dump( "startOffset: {$startOffset}; endOffset: {$endOffset}" );
                        $tmpName = tempnam( $szRoot,'' );
                        //var_dump( "ON VA ÉCRIRE DANS LE FICHIER TEMPORAIRE: " . $tmpName );

                        if ( $tmp = fopen( $tmpName ,'w+b' ) )
                        {
                            if ( $startOffset === 0 )
                            {
                                //var_dump( "LE CAS SE SIMPLIFIE CAR ON N'A PAS DE PARTIE 'AVANT'" );
                                fwrite( $tmp,$record );
                                fseek( $this->writeMemoHandle,$endOffset + strlen( $szID ) + 3 );
                                while ( ! feof( $this->writeMemoHandle ) )
                                    fwrite( $tmp,fread( $this->writeMemoHandle,$size ) );

                                //var_dump( "ON FERME LE FICHIER TEMPORAIRE..." );
                                fflush( $tmp );
                                fclose( $tmp );
                                $tmp = null;
                                //var_dump( "ON FLUSHE ET FERME LE HANDLE DU FICHIER DE MEMO" );
                                fflush( $this->writeMemoHandle );
                                fclose( $this->writeMemoHandle );
                                $this->writeMemoHandle = null;

                                if ( rename( $tmpName,$szFile ) )
                                {
                                    //var_dump( "RENAME OF '{$tmpName}' TO '{$szFile}' OK!" );
                                }
                                else
                                {
                                    //var_dump( "RENAME OF '{$tmpName}' TO '{$szFile}' KO!" );
                                }
                                goto end;
                            }   /* if ( $startOffset === 0 ) */
                            else    /* Else of ... if ( $startOffset === 0 ) */
                            {
                                //var_dump( "LE CAS EST CELUI D'UNE PARTIE 'AVANT', LE RECORD, ET UNE PARTIE 'APRÈS'" );
                                //var_dump( "COMMENÇONS PAR LA PARTIE 'AVANT' (STARTOFFSET = {$startOffset})" );

                                $offset = 0;
                                fseek( $this->writeMemoHandle,$offset,SEEK_SET );
                                fseek( $tmp                  ,$offset,SEEK_SET );
                                while ( ( $offset + $size ) <= $startOffset )
                                {
                                    //var_dump( "LECTURE DE {$size} BYTES..." );
                                    $buffer = fread( $this->writeMemoHandle,$size );
                                    $offset += $size;
                                    //var_dump( "ÉCRITURE DE {$size} BYTES..." );
                                    fwrite( $tmp,$buffer,$size );
                                }

                                /* S'il reste des choses à écrire */
                                if ( ( $offset + $size ) > $startOffset )
                                {
                                    $remainingLength = $startOffset - $offset;
                                    //var_dump( "=======IL RESTE {$remainingLength} BYTES A ECRIRE QUI SONT LE DERNIER BLOC DE LA PARTIE 'AVANT'" );
                                    //var_dump( "LECTURE DE {$remainingLength} BYTES" );
                                    $buffer = fread( $this->writeMemoHandle,$remainingLength );
                                    //var_dump( "ÉCRITURE DE '{$buffer}' POUR LE DERNIER BLOC DE LA PARTIE 'AVANT'" );
                                    $q = fwrite( $tmp,$buffer );
                                    //var_dump( "{$q} BYTES WRITTEN" );
                                    //var_dump( substr( $szBuffer2,-16 ) );
                                }

                                /* Write record now */
                                //var_dump( "***************ÉCRIRE LE RECORD {$record}" );
                                $iRetVal = fwrite( $tmp,$record );
                                //var_dump( "{$iRetVal} BYTES WRITTEN" );

                                /* Write the rest of the memo file now : la partie "APRÈS" */
                                //var_dump( "ÉCRIRE LA PARTIE 'APRÈS' ..." );
                                fseek( $this->writeMemoHandle,$endOffset + strlen( $szID ) + 3 );
                                //var_dump( "POSITION DANS LE MEMO: " . $x = ftell( $this->writeMemoHandle ) );
                                //fseek( $this->writeMemoHandle,0,SEEK_END );
                                //var_dump( "**********LONGUEUR DU MEMO: " . ftell( $this->writeMemoHandle ) );
                                //fseek( $this->writeMemoHandle,$x,SEEK_SET );

                                while ( ! feof( $this->writeMemoHandle ) )
                                {
                                    $buffer = fread( $this->writeMemoHandle,$size );
                                    //var_dump( "ÉCRIRE {$buffer}..." );

                                    $q = fwrite( $tmp,$buffer );
                                    //var_dump( "{$q} BYTES WRITTEN" );
                                }

                                //var_dump( "ON FLUSHE ET FERME LE HANDLE DU FICHIER DE MEMO" );
                                fflush( $this->writeMemoHandle );
                                fclose( $this->writeMemoHandle );
                                $this->writeMemoHandle = null;

                                //var_dump( "ON FERME LE FICHIER TEMPORAIRE..." );
                                fflush( $tmp );
                                fclose( $tmp );
                                $tmp = null;

                                if ( rename( $tmpName,$szFile ) )
                                {
                                    //var_dump( "RENAME OF '{$tmpName}' TO '{$szFile}' OK!" );
                                }
                                else
                                {
                                    //var_dump( "RENAME OF '{$tmpName}' TO '{$szFile}' KO!" );
                                }

                                goto end;
                            }   /* End of ... Else of ... if ( $startOffset === 0 ) */
                        }   /* if ( $tmp = fopen( $tmpName ,'w+b' ) ) */
                    }    /* End of ... Else of ... if ( ! $recordFound ) */
                }   /* if ( ! is_null( $record ) ) */
                //else
                //{
                //    $record = "<{$szID}><{$field}>" . serialize( $value ) . "</{$field}></{$szID}>";
                //}
                //
                //var_dump( "RECORD APRÈS TRANSFORMATION:",$record );
                //
                //if ( ! $recordFound )
                //{
                //    // Le cas est simple: on écrit le record à la fin du fichier et c'est tout!
                //    fseek( $this->writeMemoHandle,0,SEEK_END );
                //    $iRetVal = fwrite( $this->writeMemoHandle,$record );
                //    goto end;
                //}
                //else
                //{
                //    // Le cas est plus compliqué car il faut recopier les parties AVANT et APRÈS le record
                //    var_dump( "ATTENTION: CAS D'UN RECORD TROUVÉ!" );
                //    var_dump( "startOffset: {$startOffset}; endOffset: {$endOffset}" );
                //
                //    $tmpName = tempnam( $szRoot,'' );
                //    var_dump( "FICHIER TEMPORAIRE: " . $tmpName );
                //
                //    if ( $tmp = fopen( $tmpName ,'w+b' ) )
                //    {
                //        if ( $startOffset === 0 )
                //        {
                //            // Ceci est encore un cas simple car il n'y a pas de AVANT et APRÈS
                //            // Il n'y a que le record à écrire et écrire tout ce qui se trouve
                //            // derrière (endOffset + longueur de l'ID + les caractères </>
                //
                //            fseek( $tmp,0,SEEK_SET );
                //            $iRetVal = fwrite( $tmp,$record );
                //
                //            fseek( $tmp,0,SEEK_SET );
                //            fseek( $this->writeMemoHandle,$endOffset + strlen( $szID ) + 3 );
                //            while ( ! feof( $this->writeMemoHandle ) )
                //                fwrite( $tmp,fread( $this->writeMemoHandle,$size ) );
                //        }
                //        else
                //        {
                //            // Ceci est le cas où il faut écrire le AVANT + le record + le APRÈS
                //            // C'est le cas le plus compliqué
                //            /*  Écrire la partie "AVANT" */
                //            $offset = 0;
                //            while ( ( $offset + $size ) <= $startOffset )
                //            {
                //                $buffer = fread( $this->writeMemoHandle,$size );
                //                var_dump( "LECTURE DE {$size} BYTES..." );
                //                $offset += $size;
                //                fwrite( $tmp,$buffer,$size );
                //            }
                //
                //            /* S'il reste des choses à écrire */
                //            if ( ( $offset + $size ) > $startOffset )
                //            {
                //                $remainingLength = $startOffset - $offset;
                //                var_dump( "IL RESTE A LIRE " . ( $remainingLength ) . " BYTES" );
                //                $buffer = fread( $this->writeMemoHandle,$remainingLength );
                //                fwrite( $tmp,$buffer,$remainingLength );
                //                //var_dump( substr( $szBuffer2,-16 ) );
                //            }
                //
                //            /* Write record now */
                //            $iRetVal = fwrite( $tmp,$record );
                //
                //            /* Write the rest of the memo file now */
                //            fseek( $this->writeMemoHandle,$endOffset + strlen( $szID ) + 3 );
                //
                //            while ( ! feof( $this->writeMemoHandle ) )
                //                fwrite( $tmp,fread( $this->writeMemoHandle,$size ) );
                //
                //            var_dump( "TEMP FILE ENTIRELY WRITTEN" );
                //        }
                //
                //        fclose( $tmp );
                //        fclose( $this->writeMemoHandle );
                //        $this->writeMemoHandle = null;
                //        var_dump( rename( $tmpName,$szFile ) );
                //    }
                //    else
                //    {
                //        // EXCEPTION: ON NE PEUT PAS OUVRIR LE FICHIER TEMPORAIRE
                //    }
                //}

                //$this->die( "BEFORE ANY HARM" );

                if ( false )
                {
                    if ( $tmp = fopen( $tmpName ,'w+b' ) )
                    {
                        var_dump( "FICHIER TEMPORAIRE CRÉÉ" );

                        while ( ( $offset + $size ) <= $startOffset )
                        {
                            $buffer = fread( $this->writeMemoHandle,$size );
                            var_dump( "LECTURE DE {$size} BYTES..." );
                            $offset += $size;
                            fwrite( $tmp,$buffer,$size );
                        }

                        var_dump( $offset,$startOffset );

                        /* S'il reste des choses à écrire */
                        if ( ( $offset + $size ) > $startOffset )
                        {
                            $remainingLength = $startOffset - $offset;
                            var_dump( "IL RESTE A LIRE " . ( $remainingLength ) . " BYTES" );
                            $buffer = fread( $this->writeMemoHandle,$remainingLength );
                            fwrite( $tmp,$buffer,$remainingLength );
                            //var_dump( substr( $szBuffer2,-16 ) );
                        }

                        /* Write new record */
                        fwrite( $tmp,serialize( $value ) );

                        // Aller à l'offset 179354 du fichier source
                        //$endOffset = 179354;
                        fseek( $this->writeMemoHandle,$endOffset,SEEK_SET );

                        while ( ! feof( $this->writeMemoHandle ) )
                            fwrite( $tmp,fread( $this->writeMemoHandle,$size ) );

                        fclose( $tmp );
                    }   /* if ( $tmp = fopen( $tmpName ,'w+b' ) ) */

                    // Ici, il faut que je renomme le fichier temporaire en nom du fichier
                    // de data => il faut probablement que je teste si les readHandle et writeHandle
                    // sont encore corrects !!!

                    //fflush( $this->writeMemoHandle );
                    //fclose( $this->writeMemoHandle );
                }
            }   /* if ( ! is_null( $szID = $this->id() ) ) */
            else
            {
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": 'id' field required (ErrCode: " . EXCEPTION_NO_ID_FIELD_FOUND . ")",EXCEPTION_NO_ID_FIELD_FOUND );
            }

            $t2 = microtime( true );
            var_dump( "ÉCRITURE DANS FICHIER TEMPORAIRE EN " . number_format( $t2 - $t1,6,',','.' ) . " secs" );
            // Ce code écrit le record EXACTEMENT où il faut qu'il s'insère !!!
        }   /* if ( $this->writeMemoHandle ) */

        end:
        //var_dump( "FIN DE " . __METHOD__ . "()" );
        if ( $this->writeMemoHandle )
        {
            //var_dump( "ON FLUSHE ET FERME LE HANDLE DU FICHIER DE MEMO" );

            fflush( $this->writeMemoHandle );
            fclose( $this->writeMemoHandle );
            $this->writeMemoHandle = null;
        }
        return ( $iRetVal );
    }   /* End of Table.writeMemo() =================================================== */
    /* ================================================================================ */


    /* Attention: changer l'ID d'un record dans le fichier data peut
       désynchroniser tous les fichiers *.xml liés */
    protected function writeObject( &$field,&$o )
    /*-----------------------------------------*/
    {
        if ( ! is_object( $o ) )
        {
            var_dump( $o );
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": value to write is NOT an object (ErrCode: " . EXCEPTION_NOT_AN_OBJECT . ")",EXCEPTION_NOT_AN_OBJECT );
        }

        if ( ! is_null( $szID = $this->id() ) )
        {
            $szHash = (string) ( crc32( $szID ) % 999983 );
            $szFile = $this->determineDataFile() . ".extra.data.{$szHash}.xml";

            // Écrire
            // <record id=\"{$szID}\">\n
            //  <field name=\"{$field}\">\n"><[CDATA[" . serialize( $o ) . "]]></field>\n;
            // </record>

            $szXML = "<record id=\"{$szID}\">\n";
            $szXML .= " <field name=\"{$field}\">><[CDATA[" . serialize( $o ) . "]]></field>\n";
            $szXML .= "</record>\n";

            //var_dump( $szXML );

            $oDom = new \DOMDocument();

            // Create XML file if it does not exist
            if ( ! is_file( $szFile ) )
            {
                //var_dump( "Create {$szFile}" );
                $oDom->formatOutput = true;
                $root = $oDom->createElement( 'records' );
                $root = $oDom->appendChild( $root );
                $oDom->save( $szFile );
            }

            if ( is_file( $szFile ) )
            {
                if ( $oDom->load( $szFile ) )
                {
                    //var_dump( $szFile . " loaded" );

                    $root = $oDom->documentElement;
                    $oXPath = new \DOMXPath( $oDom );

                    $oFieldNode     =
                    $oRecordNode    = null;

                    if ( ( $oCollection = $oXPath->query( "record[@id='{$szID}']" ) ) && $oCollection->length > 0 )
                    {
                        // J'ai trouvé le record
                        //var_dump( "Record found in XML file" );
                        $oRecordNode = $oCollection->item(0);
                    }
                    else
                    {
                        //var_dump( $szID . " NOT found in {$szFile}" );

                        // Écrire <record id=\"{$szID}\">
                        $oRecordNode = $oDom->createElement( 'record' );
                        $oRecordNode->setAttribute( 'id',$szID );
                        $root->appendChild( $oRecordNode );
                        $oDom->save( $szFile );
                    }

                    if ( ( $oCollection = $oXPath->query( "field[@name='{$field}']",$oRecordNode ) ) && $oCollection->length > 0 )
                    {
                        //var_dump( "Trouvé le field" );
                        $oFieldNode = $oCollection->item(0);
                    }
                    else
                    {
                        //var_dump( "Création du field" );

                        $oFieldNode = $oDom->createElement( 'field' );
                        $oFieldNode->setAttribute( 'name',$field );
                    }

                    if ( $oRecordNode && $oFieldNode )
                    {
                        $oFieldNode->setAttribute( 'type','object' );
                        $oFieldNode->setAttribute( 'class',get_class( $o ) );
                        $szData     = base64_encode( serialize( $o ) );
                        //var_dump( $szData );
                        $oCDATA     = $oDom->createCDATASection( $szData );
                        $oFieldNode->nodeValue = '';
                        $oFieldNode->appendChild( $oCDATA );
                        $oRecordNode->appendChild( $oFieldNode );

                        //var_dump( "FIELD UPDATED" );
                        $oDom->save( $szFile );
                    }
                }
            }
            else
            {
                // EXCEPTION: FILE NOT FOUND
            }


            //$this->die("Tentative d'écrire un objet dans {$szFile}; hash = {$szHash}" );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ID required (ErrCode: " . EXCEPTION_NO_ID_FIELD_FOUND . ")",EXCEPTION_NO_ID_FIELD_FOUND );

        return ( 1 );   /* On devrait retourner le nombre de bytes écrits */

    }   /* End of Table.writeObject() ================================================= */
    /* ================================================================================ */


    /* Retourne la totalité du record en une fois, y compris la marque 'deleted' */
    /* Attention ... les data additionnelles (objets, mémos, ...) ne sont PAS retournées */
    public function record()
    /*--------------------*/
    {
        $aRetVal = null;

        if ( $fh = fopen( $szFile = $this->determineDataFile(),'r+b' ) )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) );

            fseek( $fh,$offset,SEEK_SET );

            if ( ! empty( $szRetVal = fread( $fh,$this->recordSize ) ) )
            {
                //var_dump( $this->offsets );

                $aRetVal['deleted'] = array( 'field' => 'deleted'                            ,
                                             'value' => ( substr( $szRetVal,0,1 ) === '*' )  ,
                                             'type'  => 'boolean'                            ,
                                           );

                /* ATTENTION, CE CODE DOIT ETRE VERIFIE AVEC DES ENREGISTREMENTS QUI SE TROUVENT DANS
                   DES FICHIERS MEMO ! PAR EXEMPLE, AVEC DES CHAMPS MEMO, LA VALEUR NE SE TROUVE PAS
                   DANS LE $value !!! */

                foreach( $this->offsets as $field => $positions )
                {
                    $value = substr( $szRetVal,$positions['offset'] + 1,$positions['length'] );

                    switch( $positions['type'] )
                    {
                        case 'bool'     :
                        case 'boolean'  :
                        case 'logical'  : $value = ( trim( $value ) === 'true' ); break;
                        case 'int'      : $value = (int) trim( $value ); break;
                    }

                    $aRetVal[$field] = array( 'field' => $field               ,
                                              'value' => $value               ,
                                              'type'  => $positions['type']   ,
                                            );
                }   /* foreach( $this->offsets as $field => $positions ) */
            }   /* if ( ! empty( $szRetVal = fread( $fh,$this->recordSize ) ) ) */

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $aRetVal );

        // CODE A FAIRE (SE BASER SUR LE DELETED ET RAMENER TOUT TE RECORDSIZE)
    }   /* End of Table.record() ====================================================== */
    /* ================================================================================ */


    /* Retourne plusieurs record en une fois, y compris la marque 'deleted' */
    /* Attention ... les data additionnelles (objets, mémos, ...) ne sont PAS retournées */
    public function records( $n = 1)
    /*----------------------------*/
    {
        $aRetVal = null;

        if ( $fh = fopen( $szFile = $this->determineDataFile(),'r+b' ) )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) );

            fseek( $fh,$offset,SEEK_SET );

            /* Read $n records */
            //var_dump( "Record length " . $this->recordSize . " bytes" );
            //var_dump( "Reading " . ( $this->recordSize * $n ) . " bytes" );
            if ( ! empty( $szRetVal = fread( $fh,$this->recordSize * $n ) ) )
            {
                //var_dump( $this->offsets );
                /* Il se pourrait qu'on demande plus de record que ce qu'on peut lire (EOF) */
                $iMaxLen = strlen( $szRetVal );
                //var_dump( $iMaxLen );

                for ( $i = 0;$i < $n;$i++ )
                {
                    $offset = $i * $this->recordSize;
                    //var_dump( "Offset in buffer: " . $offset );

                    /* Sil n'y a plus de record à lire (on a moins de record que ce qu'on a demandé) */
                    if ( $offset >= $iMaxLen )
                        break;

                    $szRecord = substr( $szRetVal,$offset,$this->recordSize );
                    //var_dump( substr( $szRecord,1,40 ) );

                    $aRecord['deleted'] = ( substr( $szRecord,0,1 ) === '*' );
                    $aRecord['fields']  = null;


                    /* ATTENTION, CE CODE DOIT ETRE VERIFIE AVEC DES ENREGISTREMENTS QUI SE TROUVENT DANS
                       DES FICHIERS MEMO ! PAR EXEMPLE, AVEC DES CHAMPS MEMO, LA VALEUR NE SE TROUVE PAS
                       DANS LE $value !!! */
                    $aFields = null;
                    foreach( $this->offsets as $field => $positions )
                    {
                        $value = substr( $szRecord,$positions['offset'] + 1,$positions['length'] );

                        switch( $positions['type'] )
                        {
                            case 'bool'     :
                            case 'boolean'  :
                            case 'logical'  : $value = ( trim( $value ) === 'true' ); break;
                            case 'int'      : $value = (int) trim( $value ); break;
                        }

                        $aFields[$field] = array( 'field' => $field               ,
                                                  'value' => $value               ,
                                                  'type'  => $positions['type']   ,
                                                );
                    }   /* foreach( $this->offsets as $field => $positions ) */
                    $aRecord['fields'] = $aFields;
                    $aRetVal[] = $aRecord;

                }   /* for ( $i = 0;$i < $n;$i++ ) */
            }   /* if ( ! empty( $szRetVal = fread( $fh,$this->recordSize ) ) ) */

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $aRetVal );

    }   /* End of Table.records() ===================================================== */
    /* ================================================================================ */


    /* Retourne plusieurs record en une fois, y compris la marque 'deleted' */
    /* Attention ... les data additionnelles (objets, mémos, ...) ne sont PAS retournées */
    public function getAll( $field )
    /*----------------------------*/
    {
        $aRetVal = null;
        $oldRecno = $this->recno;               /* Save record pointer */
        $this->recno = 1;                       /* Go to 1st record */

        if ( is_null( $this->readHandle ) )
            $this->readHandle = fopen( $szFile = $this->determineDataFile(),'r+b' );

        $oldPointer = ftell( $this->readHandle );

        if ( ! isset( $this->offsets[$field] ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );
        else
        {
            switch( $this->fields[$field]->type )
            {
                case 'array'    :
                case 'memo'     :
                case 'object'   :
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT SUPPORTED (ErrCode: " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );
            }
        }

        if ( $this->readHandle )
        {
            $iReccount    = $this->reccount();
            $iFieldLen    = $this->offsets[$field]['length'];
            $iFieldOffset = $this->offsets[$field]['offset'];

            //var_dump( $this->offsets[$field] );

            $offset = ( $this->recordSize * ( $this->recno - 1 ) )  +
                      $iFieldOffset                                    +
                      1; /* +1 => because the 1st byte is the "deleted" mark */

            //var_dump( $offset );

            fseek( $this->readHandle,$offset,SEEK_SET );
            $pos1 = ftell( $this->readHandle );
            //var_dump( $pos1 );

            while ( $this->recno <= $iReccount )
            {
                $aRetVal[] = array( 'recno'     => $this->recno                             ,
                                    'offset'    => ftell( $this->readHandle )               ,
                                    'value'     => fread( $this->readHandle,$iFieldLen )    ,
                                  );

                //var_dump( $szField );
                $this->recno++;
                //$pos1 = ftell( $this->readHandle );
                fseek( $this->readHandle,$this->recordSize - $iFieldLen,SEEK_CUR );
                //$pos2 = ftell( $this->readHandle );
                //var_dump( $pos1,$pos2,'-----------' );
            }

            fseek( $this->readHandle,$oldPointer,SEEK_SET );        /* Restore file pointer */
        }
        else
        {
            // EXCEPTION: CANNOT READ (FOPEN FAILED)
        }

        $this->recno = $oldRecno;                                   /* Restore record pointer */

        end:
        return ( $aRetVal );

    }   /* End of Table.records() ===================================================== */
    /* ================================================================================ */


    /* Obtain data from table directly going to the offset */
    public function readRaw( $offset,$length )
    /*--------------------------------------*/
    {
        $szRetVal = null;

        if ( is_null( $this->readHandle ) )
            $this->readHandle = fopen( $szFile = $this->determineDataFile(),'r+b' );

        $oldPointer = ftell( $this->readHandle );                   /* Save file pointer */

        if ( $this->readHandle )
        {
            fseek( $this->readHandle,$offset,SEEK_SET );
            $szRetVal = fread( $this->readHandle,$length );
            fseek( $this->readHandle,$oldPointer,SEEK_SET );        /* Restore file pointer (VRAIMENT?) */
        }
        else
        {
            // EXCEPTION: CANNOT READ (FOPEN FAILED)
        }

        end:
        return ( $szRetVal );

    }   /* End of Table.readRaw() ===================================================== */
    /* ================================================================================ */


    protected function readMemo( &$field )
    /*----------------------------------*/
    {
        $RetVal = null;

        if ( ! is_null( $szID = $this->id() ) )
        {
            if ( $this->readMemoHandle = fopen( $szFile = $this->determineDataFile() . '.memo','rb' ) )
            {
                //var_dump( "LE FICHIER MEMO EST OUVERT" );
                $pattern = '<' . $szID . '>';
                //var_dump( "PATTERN: {$pattern}" );

                if ( ( $startOffset = v::FIL_searchInFile( $pattern,$szFile,0 /* start position */,60000 /* block size */ ) ) !== -1 )
                {
                    //var_dump( "ON A TROUVÉ LE STARTOFFSET: {$startOffset}" );
                    $pattern = '</' . $szID . '>';
                    //var_dump( "PATTERN: {$pattern}" );
                    if ( ( $endOffset = v::FIL_searchInFile( $pattern,$szFile,$startOffset /* start position */,60000 /* block size */ ) ) !== -1 )
                    {
                        //var_dump( "ON A TROUVÉ LE ENDOFFSET: {$endOffset}" );
                        fseek( $this->readMemoHandle,$startOffset ,SEEK_SET );
                        $len = ( $endOffset - $startOffset ) + strlen( $szID ) + 3;
                        $record = fread( $this->readMemoHandle,$len );
                        //var_dump( "RECORD='{$record}'" );
                        if ( preg_match( "%<{$field}>(?P<field>.*)</{$field}>%s",$record,$aMatches ) )
                        {
                            $RetVal = unserialize( base64_decode( $aMatches['field'] ) );
                            //var_dump( "ON A TROUVÉ LE CHAMP: {$value}" );
                        }
                    }   /* if ( ( $endOffset = v::FIL_searchInFile( $pattern,... */
                }   /* if ( ( $startOffset = v::FIL_searchInFile( $pattern,... */
            }   /* if ( $this->readMemoHandle = fopen( $szFile = $this->determineDataFile() . '.memo','rb' ) ) */
            fclose( $this->readMemoHandle );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ID required (ErrCode: " . EXCEPTION_NO_ID_FIELD_FOUND . ")",EXCEPTION_NO_ID_FIELD_FOUND );

        //var_dump( $RetVal );
        return ( $RetVal );
    }   /* End of Table.readMemo() ================================================== */


    public function read( $field )
    /*--------------------------*/
    {
        $xRetVal = null;

        if ( is_null( $this->readHandle ) )
        {
            //var_dump( "OUVERTURE EN READ BINAIRE" );
            $this->readHandle = fopen( $szFile = $this->determineDataFile(),'r+b' );
        }

        //var_dump( $szFile = $this->determineDataFile() );
        //var_dump( v::FIL_Size( $szFile ) . " bytes" );

        if ( ! isset( $this->offsets[$field] ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );
        else
        {
            //var_dump( "TENTATIVE DE READ" );
            switch( $this->fields[$field]->type )
            {
                /* Je peux simplifie en faisant appel directement à readObject() pour tous les types */
                case 'array'    :
                case 'memo'     :
                case 'object'   :   $xRetVal = $this->readMemo( $field );
                                    goto end;
            }
        }

        if ( $this->readHandle )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) )  +
                      $this->offsets[$field]['offset']              +
                      1; /* +1 => because the 1st byte is the "deleted" mark */

            //var_dump( "POSITIONNEMENT A L'OFFSET " . $offset );
            //$x = ftell( $this->readHandle );
            //fseek( $this->readHandle,0,SEEK_END );
            //var_dump( "SIZE: " . ftell( $this->readHandle ) );
            fseek( $this->readHandle,$offset,SEEK_SET );
            //var_dump( "POSITIONNEMENT: " . ftell( $this->readHandle ) );
            //var_dump( "LECTURE DE " . $this->offsets[$field]['length'] . " BYTES" );

            //var_dump( $this->offsets[$field] );
            $xRetVal = fread( $this->readHandle,$this->offsets[$field]['length'] );
            //var_dump( "RETOUR: " . $xRetVal );
            //fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT READ (FOPEN FAILED)
        }

        end:
        return ( $xRetVal );

    }   /* End of Table.read() ======================================================== */
    /* ================================================================================ */


    /* Attention: SANS index !!! */
    /* Si $collection non null, alors on cherche TOUS les records qui matchent =>
       nous avons une collection de matches possibles
    */
    public function find( $field,$value,$sensitive = true,&$collection = null )
    /*-----------------------------------------------------------------------*/
    {
        $szFile = $this->determineDataFile();

        $bRetVal = false;

        if ( $sensitive )
            $fnFnc = 'strstr';
        else
            $fnFnc = 'stristr';

        $iRecno = 1;

        if ( $fh = fopen( $szFile,'r+b' ) )
        {
            $offset = ( $this->recordSize * ( $iRecno - 1 ) )  +
                      $this->offsets[$field]['offset']              +
                      1; /* +1 => because the 1st byte is the "deleted" mark */

            $this->determineLengthOfDataFile(); /* $this->fileSize updated */

            while ( $offset <= $this->fileSize )
            {
                fseek( $fh,$offset,SEEK_SET );

                $szValueInFile = fread( $fh,$this->offsets[$field]['length'] );
                //var_dump( $szValueInFile );

                // ICI, JE DEVRAIS AVOIR UNE OPTION POUR CASE-INSENSITIVE

                if ( $fnFnc( $szValueInFile,$value ) )
                {
                    $bRetVal = true;
                    $this->recno = $iRecno;

                    if ( is_null( $collection ) )
                        break;
                    else
                        $collection[] = $iRecno;
                }   /* if ( strstr( $szValueInFile,$value ) ) */

                $offset += $this->recordSize;
                $iRecno++;
            }   /* while ( $offset <= $this->fileSize ) */

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $bRetVal );

    }   /* End of Table.find() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*index( $field )=

        Index on the @param.field field

        {*params
            $field      (string)    The name of the field to index on
        *}

        {*return
            (array)     Values that were indexed or [c]null[/c] if no index
                        could be created.
        *}

        {*warning
            L'algorithme est en construction : RIEN N'EST DÉFINITIF. L'algorithme
            ne fonctionne QUE sur des strings !!!
        *}

        {*example
            Imagine you have a DB called 'Tamarind'. This DB stores tracks and
            artists for the "Tamarin Radio". The physical file of the DB Container is
            [c]tamarind.illicoDB[/c][br]

            Tracks are stored in the 'catalog' table ([c]tamarind.catalog.illicoDB[/c][br]
            Artists are stored in the 'artists' table ([c]tamarind.artists.illicoDB[/c])[br][br]

            Imagine you want to index the the 'artists' table on the the '[c]f_name[/c]' field.
            Ultimately, the physical index file will be named
            '[c]tamarind.artists.illicoDB.[b]f_name.idx[/b][/c]' a name in which you find the name
            of the DB Container, the name of the table, and the name of the field.
            This eases recognize all physical data files pertaining to a DB container.

        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        $t1 = microtime( true );
        $aValues = $oDB->artists->index( 'f_name' );
        $t2 = microtime( true );
        var_dump( "INDEX PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );


        $t1 = microtime( true );
        $index = $recno = 0;
        if ( $oDB->artists->seek( 'Stevie',$aValues,$index,$recno ) )
        {
            $oDB->artists->Go( $recno );
            var_dump( $oDB->artists->read( 'f_name' ) );

            |** __get() **|
            var_dump( "FIRSTNAME: "     . $oDB->artists->f_firstname    );
            var_dump( "LASTNAME: "      . $oDB->artists->f_lastname     );
            var_dump( "BIRTHPLACE: "    . $oDB->artists->f_birthplace   );

            |** __set() **|
            $oDB->artists->f_firstname = 'Stevie';
            $oDB->artists->f_lastname = 'Nicks';
            var_dump( "FIRSTNAME: "     . $oDB->artists->f_firstname    );
            var_dump( "LASTNAME: "      . $oDB->artists->f_lastname     );
        }
        $t2 = microtime( true );
        var_dump( "PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );

        *}

        *}}
    */
    /* ================================================================================ */
    public function indexOLD( $field,$forced = false )
    /*-------------------------------------------*/
    {
        $this->die( __METHOD__ . "() is obsolete" );
        $iRecno         = 1;

        if ( isset( $this->fields[$field] ) )
        {
            $tStart         = microtime( true );
            $szFile         = $this->determineDataFile();
            $szIndexFile    = $szFile . ".{$field}.idx";

            $aValues        = null;

            ///var_dump( "Index file: " . $szIndexFile );
            //$this->die();

            if ( ! $forced && v::FIL_File1OlderThanFile2( $szIndexFile,$szFile ) )
            {
                $aValues = unserialize( v::FIL_FileToStr( $szIndexFile ) );
                //var_dump( "CACHE FOUND" );
                goto end;
            }

            if ( $fh = fopen( $szFile,'r+b' ) )
            {
                $offset = ( $this->recordSize * ( $iRecno - 1 ) )       +
                          $this->offsets[$field]['offset']              +
                          1; /* +1 => because the 1st byte is the "deleted" mark */

                $this->determineLengthOfDataFile(); /* $this->fileSize updated */

                $aHash = null;

                while ( $offset <= $this->fileSize )
                {
                    fseek( $fh,$offset,SEEK_SET );

                    // NE PAS JETER CETTE LIGNE: ELLE POURRAIT ÊTRE UTILE POUR UN HASHING RAPIDE
                    //$aHash['KEY-' . ( crc32( trim( fread( $fh,$this->offsets[$field]['length'] ) ) ) % 3067 )][] = $iRecno;

                    $aValues[] = array( 'v' => trim( fread( $fh,$this->offsets[$field]['length'] ) ),
                                        'r' => $iRecno                                              ,
                                      );

                    $offset += $this->recordSize;
                    $iRecno++;
                }   /* while ( $offset <= $this->fileSize ) */

                fclose( $fh );

                usort( $aValues,function( $a,$b )
                                {
                                    $a = strtoupper( trim( $a['v'] ) );
                                    $b = strtoupper( trim( $b['v'] ) );
                                    if ( $a  === $b )
                                        return ( 0 );
                                    elseif ( $a < $b )
                                        return ( -1 );
                                    else
                                        return ( 1 );
                                }
                     );

                 v::FIL_StrToFile( serialize( $aValues ),$szIndexFile );
            }
            else
            {
                // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
            }
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: EXCEPTION_INVALID_FIELD - " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );

        end:
        $tEnd = microtime( true );
        //var_dump( "It took " . round( $tEnd - $tStart,5 ) . " secs to index" );

        return ( $aValues );
    }   /* End of Table.indexOLD() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*sort( $field[,$iStart[,$iEnd]] )=

        Index on the @param.field field betwwen record @param.iStart and @param.iEnd

        {*params
            $field      (string)    The name of the field to sort on
            $iStart     (int)       Starting record number. Optional. [c]1[/c] by default
            $iEnd       (int)       Endinf record number. Optional. [c]@fnc.reccount[/c]
                                    by default
        *}

        {*return
            (array)     Record numbers sorted
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
    //public function sort( &$field,$iStart = null,$iEnd = null )
    protected function sort( $field,$a )
    /*--------------------------------*/
    {
        static $level = 0;

        ++$level;
    	$low = $high = array();

    	if ( ( $iCount = count( $a ) ) < 2 )
    		return ( $a );
        elseif ( $iCount < 2500 )
        {
            usort( $a       ,   function( $a,$b ) use ( $field )
                                {
                                    $n = strcasecmp( $this->goto( $a )->$field,
                                                     $this->goto( $b )->$field );

                                    if ( $n === 0 )
                                        return ( 0 );
                                    elseif ( $n > 0 )
                                        return ( 1 );
                                    else
                                        return ( -1 );
                                }
                 );
            return ( $a );
        }

    	$pivotIndex = key( $a );
    	$pivotRecno = array_shift( $a );
    	$pivotValue = $this->goto( $pivotRecno )->$field;

        //var_dump( "Current record: " . $this->recno(). ";" . $pivotRecno . "=" . $pivotValue );
        //var_dump( $this->read( $field ) );

        foreach ( $a as $recno )
        {
            if ( ( $n = strcasecmp( $this->goto( $recno )->$field,$pivotValue ) ) <= 0 )
                $low[]  = $recno;
            else
                $high[] = $recno;
        }   /* foreach ( $a as $recno ) */

        //echo "LEVEL: {$level}; COUNT LOW: ",$y = count( $low ),"; COUNT HIGH: ",$z = count( $high ),"<br />";
        //ob_flush();
        //flush();

        //var_dump( "LOW:" ,$low );
        //var_dump( "HIGH:",$high );

        // ici, je souhaite ne pas faire de sort sur une array vide
        //if ( ! empty( $low ) )
        //{
        //    $a
        //}

        // This is ±4% faster than using count()
        return ( array_merge( empty( $low  ) ? array() : $this->sort( $field,$low  ),
                              array( $pivotIndex => $pivotRecno )                           ,
                              empty( $high ) ? array() : $this->sort( $field,$high )
                            )
               );

        // This is ±20% faster than the same thing without checks
        return ( array_merge( count( $low  ) > 1 ? $this->sort( $field,$low  ) : array()    ,
                              array( $pivotIndex => $pivotRecno )                           ,
                              count( $high ) > 1 ? $this->sort( $field,$high ) : array()
                            )
               );

        // Original return
        return ( array_merge( $this->sort( $field,$low ),
                              array( $pivotIndex => $pivotRecno ),
                              $this->sort( $field,$high ) ) );

        $t1 = microtime( true );
        //usort( $a,   function( $a,$b ) use ( $this )
        usort( $a       ,   function( $a,$b ) use ( $field )
                            {
                                //return ( strcmp( $oDB->artists->goto( $a )->f_name,
                                //                 $oDB->artists->goto( $b )->f_name ) );
                                $fValueA = $this->goto( $a )->$field;
                                $fValueB = $this->goto( $b )->$field;

                                if ( $fValueA === $fValueB )
                                    return ( 0 );
                                if ( $fValueA > $fValueB )
                                    return ( 1 );
                                else
                                    return ( -1 );
                            }
             );
        $t2 = microtime( true );
        var_dump( "SORT() PERF: " . number_format( $t2 - $t1,5,',','.' ) . " secs" );

        return ( $a );

    }   /* End of Table.sort() ======================================================== */
    /* ================================================================================ */


    public function index( $field,$forced = false )
    /*-------------------------------------------*/
    {
        $iRecno = 1;

        //var_dump( "IN " . __METHOD__ . "() AT LINE " . __LINE__ );

        if ( isset( $this->fields[$field] ) )
        {
            $szFile         = $this->determineDataFile();
            $szIndexFile    = $szFile . ".{$field}.idx";

            if ( ! $forced && v::FIL_File1OlderThanFile2( $szIndexFile,$szFile ) )
            {
                //$aValues = unserialize( v::FIL_FileToStr( $szIndexFile ) );
                //var_dump( "CACHE FOUND: {$szIndexFile}" );
                //var_dump( "IN " . __METHOD__ . "() AT LINE " . __LINE__ );
                goto end;
            }
            else
            {
                //var_dump( "WILL USE sort()",$this->reccount() );
                if ( $this->autoSort )
                {
                    $range = range( 1,$this->reccount() );
                    //shuffle( $range );
                    $aValues = $this->sort( $field,$range );
                    //var_dump( $szIndexFile,$aValues );
                    if ( $fh = fopen( $szIndexFile,'w+b' ) )
                    {
                        //var_dump( $aValues );
                        foreach( $aValues as $value )
                        {
                            fwrite( $fh,sprintf( "%09d",$value ) );
                        }
                        fclose( $fh );
                        //var_dump( "{$szIndexFile} written" );
                        ob_flush();
                        flush();
                    }
                }
                //$this->die();
                //v::FIL_StrToFile( serialize( $aValues ),$szIndexFile );
            }
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: EXCEPTION_INVALID_FIELD - " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );

        end:
        return ( null );        /* There is nothing to return */
        return ( $aValues );
    }   /* End of Table.index() ======================================================= */


    public function seek( $needle,$field,&$recno )
    /*------------------------------------------*/
    {
        //tamarind.artists.illicoDB.f_name.idx

        $bFound         = false;
        $szFile         = $this->determineDataFile();
        $szIndexFile    = $szFile . ".{$field}.idx";

        //var_dump( $szFile,$szIndexFile );

        // Il faudrait que je me réserve des handles d'index (10, 20, 50, 100?)
        // et que je puisse me passer des ouvertures/fermetures de fichiers
        // en récupérant toujours le bon handle.µ
        // Cela ne va pas me donner le moindre avantage sur 1! exécution mais
        // quand on enchaîne les recherches je pense que le gain sera immense

        $t1 = microtime( true );

        if ( isset( $this->indexHandles[ $szIndexFile ] ) )
        {
            $fh = $this->indexHandles[ $szIndexFile ];
            var_dump( "Re-use handle" );
        }
        else
        {
            if ( $fh = fopen( $szIndexFile,'rb' ) )
                $this->indexHandles[ $szIndexFile ] = $fh;
        }

        if ( $fh )
        {
            //var_dump( $szIndexFile . ' OPEN' );

            $recordSize = 9;                /* 9 car chq record est écrit sur 9 bytes */
            fseek( $fh,0,SEEK_END );
            $reccount   = (int) ( ftell( $fh ) / $recordSize );
            fseek( $fh,0,SEEK_SET );

            $iLow   = 1;
            $iHigh  = $reccount;
            //$index  = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
            $index = $iLow + (int) round( ( $iHigh - $iLow ) / 2,0 );

            //Juste pour voir combien de temps je gagne à réduire le range de valeurs
            //$iLow   = 14210;
            //$iHigh  = 14214;
            ////$index  = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
            //$index = $iLow + (int) round( ( $iHigh - $iLow ) / 2,0 );

            while ( true )
            {
                $oldIndex   = $index;
                $offset     = $recordSize * ( $index - 1 );

                fseek( $fh,$offset,SEEK_SET );

                $recno  = (int) fread( $fh,$recordSize );
                $FValue = trim( $this->GoTo( $recno )->$field );    /* value in the field */
                //var_dump( "COMPARING '{$needle}' AND '{$FValue}'" );

                if ( ( $n = strcasecmp( $needle,$FValue ) ) === 0 )
                {
                    $bFound = true;
                    //var_dump( "FOUND IN " . __METHOD__ . "()" );
                    break;
                }
                elseif ( $n > 0 )   /* pattern > value */
                {
                    $iLow  = $index;
                    //var_dump( "---Going forward","********" );
                    //ob_flush();
                    //flush();
                }
                else
                {
                    $iHigh = $index;
                    //var_dump( "===Going backward","********" );
                    //ob_flush();
                    //flush();
                }

                $index = $iLow + (int) round( ( $iHigh - $iLow ) / 2,0 );

                if ( $oldIndex === $index )
                {
                    --$index;       /* Going 1 record backward - due to rounding when setting the new offset */
                    $offset = $recordSize * ( $index - 1 );
                    fseek( $fh,$offset,SEEK_SET );
                    $recno  = (int) fread( $fh,$recordSize );
                    $FValue = trim( $this->GoTo( $recno )->$field );    /* value in the field */

                    if ( strcasecmp( $needle,$FValue ) === 0 )
                    {
                        //var_dump( "'{$needle}' FOUND" );
                        break;
                    }
                    else
                    {
                        //var_dump( "NOT FOUND: SAME INDEX" );
                        break;
                    }
                }
                elseif ( $iLow >= $iHigh )
                {
                    //var_dump( "NOT FOUND: LOW and HIGH" );
                    break;
                }
                elseif ( $iHigh < $iLow )
                {
                    //var_dump( "NOT FOUND: HIGH < LOW" );
                    break;
                }
            }   /* while ( true ) */

            //fclose( $fh );
        }
        else
        {
            // EXCEPTION
        }

        $t2 = microtime( true );
        //var_dump( "METHODE INDEXEE " . number_format( $t2 -$t1,8,',', '.' ) . " secs" );

        return ( $bFound );
    }   /* End of Table.seek() ======================================================== */
    /* ================================================================================ */


    /* Attention: AVEC index !!! */
    //public function seekOld( $szValue,&$aValues,&$index,&$recno,$sensitive = true )
    ///*------------------------------------------------------------------------*/
    //{
    //    $tStart = microtime( true );
    //
    //    $bRetVal = false;
    //
    //    //var_dump( "Looking for '{$szValue}'" );
    //
    //    $iLow   = 0;
    //    $iHigh  = count( $aValues ) - 1;
    //    $index  = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
    //
    //    if ( $sensitive )
    //    {
    //        while ( true )
    //        {
    //            $oldIndex = $index;
    //
    //            if ( v::str_starts_with( $aValues[$index]['value'],$szValue ) )
    //            {
    //                $bRetVal = true;
    //                $recno   = $aValues[$index]['recno'];
    //                //var_dump( "FOUND IN " . __FUNCTION__ . "()" );
    //                break;
    //            }
    //            elseif ( $szValue > $aValues[$index]['value'] )
    //                $iLow = $index;
    //            else
    //                $iHigh = $index;
    //
    //            $index = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
    //
    //            //var_dump( "Low= " . $iLow . "; High= " . $iHigh . "; Index= " . $index . "; VALUE= '{$aValues[$index]['value']}'" );
    //
    //            if ( $oldIndex === $index || $iLow >= $iHigh || $iHigh < $iLow )
    //            {
    //                //var_dump( "NO NEED TO GO FURTHER" );
    //                $recno   = $aValues[$index]['recno'];
    //                break;
    //            }
    //        }   /* while ( true ) */
    //    }
    //    else
    //    {
    //        $szUValue = strtoupper( $szValue );
    //        while ( true )
    //        {
    //            $oldIndex = $index;
    //
    //            if ( v::str_istarts_with( $aValues[$index]['value'],$szValue ) )
    //            {
    //                $bRetVal = true;
    //                $recno   = $aValues[$index]['recno'];
    //                //var_dump( "FOUND IN " . __FUNCTION__ . "()" );
    //                break;
    //            }
    //            elseif ( $szUValue > strtoupper( $aValues[$index]['value'] ) )
    //                $iLow = $index;
    //            else
    //                $iHigh = $index;
    //
    //            $index = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
    //
    //            //var_dump( "Low= " . $iLow . "; High= " . $iHigh . "; Index= " . $index . "; VALUE= '{$aValues[$index]['value']}'" );
    //
    //            if ( $oldIndex === $index || $iLow >= $iHigh || $iHigh < $iLow )
    //            {
    //                //var_dump( "NO NEED TO GO FURTHER" );
    //                $recno   = $aValues[$index]['recno'];
    //                break;
    //            }
    //        }   /* while ( true ) */
    //    }
    //
    //    $tEnd = microtime( true );
    //
    //    //var_dump( __FUNCTION__ . "() found a result in " . number_format( $tEnd - $tStart,9,'.','' ) . " secs" );
    //
    //    return ( $bRetVal );
    //}   /* End of Table.seek() ======================================================== */
    ///* ================================================================================ */


    //public function seekOLD2( $value,$field,$records,$forced = false )
    ///*----------------------------------------------------------*/
    //{
    //    $this->die( __METHOD__ . "() should be using what the sort() method yields! CODE IS TO BE REVISITED" );
    //
    //    $bFound         = false;
    //    $szFile         = $this->determineDataFile();
    //    $szCacheFile    = $szFile . ".{$this->name}.{$field}.idx";
    //    var_dump( $szFile,$szCacheFile );
    //
    //    if ( is_null( $records ) )
    //        return ( false );
    //
    //    $bFound         = false;
    //    $szFile         = $this->determineDataFile();
    //    $szCacheFile    = $szFile . ".{$this->name}.{$field}.idx";
    //
    //    $this->die();
    //
    //
    //    $t1 = microtime( true );
    //    if ( is_file( $szCacheFile ) && ! $forced && v::FIL_File1OlderThanFile2( $szIndexFile,$szFile ) )
    //        $aRecords = v::FIL_getHashFile( $szCacheFile );
    //    $t2 = microtime( true );
    //    var_dump( "Recupération des data de {$szCacheFile} : " . number_format( $t2 - $t1,8,',','.' ) . " secs" );
    //
    //
    //
    //    var_dump( $oDB->artists->GoTo( $aRecords[180000] )->f_name );
    //
    //    $iLow       = 1;
    //    $iHigh      = $oDB->artists->reccount();
    //    $index      = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
    //    $szPattern  = "Wayne Kelly";
    //
    //    //var_dump( $iLow,$iHigh,$index,$szPattern,$oDB->artists->GoTo( $aRecords[$index] )->f_name,'-----------' );
    //
    //
    //    $t1 = microtime( true );
    //    while ( true )
    //    {
    //        $oldIndex = $index;
    //
    //        /* Value in the field */
    //        $szFValue = trim( $oDB->artists->GoTo( $aRecords[$index] )->f_name );
    //        $n = strcasecmp( $szPattern,$szFValue );
    //        //var_dump( "At index {$index}: '" . $szFValue . "' compared to '" . $szPattern . "' (n = {$n})" );
    //
    //
    //        //if ( v::str_starts_with( $szFValue,$szPattern ) )
    //        if ( $n === 0 )
    //        {
    //            $bFound = true;
    //            $recno   = $aRecords[$index];
    //            //var_dump( "FOUND IN " . __FUNCTION__ . "()" );
    //            break;
    //        }
    //        elseif ( $n > 0 )
    //        {
    //            $iLow  = $index;
    //            //var_dump( "---Going forward","********" );
    //        }
    //        else
    //        {
    //            $iHigh = $index;
    //            //var_dump( "===Going backward","********" );
    //        }
    //
    //        $index = $iLow + (int) ( ( $iHigh - $iLow ) / 2 );
    //
    //        //var_dump( "Low= " . $iLow . "; High= " . $iHigh . "; Index= " . $index . "; VALUE= '{$aValues[$index]['value']}'" );
    //
    //        if ( $oldIndex === $index || $iLow >= $iHigh || $iHigh < $iLow )
    //        {
    //            //var_dump( "NO NEED TO GO FURTHER" );
    //            $recno = $aRecords[$index];
    //            break;
    //        }
    //    }   /* while ( true ) */
    //    $t2 = microtime( true );
    //
    //    if ( $bFound )
    //        var_dump( "Seek - FOUND: " . number_format( $t2 - $t1,8,',','.' ) . " secs" );
    //    else
    //        var_dump( "Seek - NOT FOUND: " . number_format( $t2 - $t1,8,',','.' ) . " secs" );
    //
    //    $oDB->die();
    //}



    public function readStructure( $oDom,$oXPath,$oNode )
    /*-------------------------------------------------*/
    {
        if ( ( $fieldCollection = $oXPath->query( 'field',$oNode ) ) && ( $fieldCollection->length > 0 ) )
        {
            $offset = $this->recordSize = 0;

            $aFieldNames = null;
            $typeIDGiven = false;

            foreach ( $fieldCollection as $field )
            {
                $oField                 = new Field();

                $oField->name           =              trim( $field->getAttribute( 'name'   ) );
                $oField->length         =              (int) $field->getAttribute( 'length' );
                $oField->type           =  strtolower( trim( $field->getAttribute( 'type'   ) ) );
                $oField->description    =              trim( $field->getAttribute( 'desc'   ) );
                if ( $field->hasAttribute( 'offset' ) )
                    $oField->offset    =               (int) $field->getAttribute( 'offset' );

                //var_dump( $oField->offset );

                if ( isset( $aFieldNames[$oField->name] ) )
                {
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$oField->name}' duplicate field (ErrCode: EXCEPTION_DUPLICATE_FIELD = " . EXCEPTION_DUPLICATE_FIELD . ")",EXCEPTION_DUPLICATE_FIELD );
                }
                else
                {
                    $aFieldNames[$oField->name] = true;
                }

                if ( ( $len = $this->fieldLength( $oField->type ) ) !== -EXCEPTION_INVALID_FIELD )
                {
                    /* If length of 'id' field given */
                    if ( $oField->type === 'id' && $oField->length !== 0 )
                        $len = -1;

                    if ( $len !== -1 )
                        $oField->length = $len;
                }   /* if ( $this->isType( $oField->type ) ) */
                else
                {
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$oField->type}' is NOT a valid field type (ErrCode: EXCEPTION_INVALID_FIELD_TYPE = " . EXCEPTION_INVALID_FIELD_TYPE . ")",EXCEPTION_INVALID_FIELD_TYPE );
                }

                //var_dump( $oField->offset );
                //var_dump( $oField->length );

                $this->fields[$oField->name]  = $oField;

                if ( is_int( $oField->offset ) )
                    $offset = $oField->offset;

                //var_dump( $oField->type,"FIELD LENGTH: " . $oField->length );

                $this->offsets[$oField->name] = array( 'offset' => $offset,'length' => $oField->length,'type' => $oField->type );
                $offset             += $oField->length;
                $this->recordSize   = $offset;

            }   /* foreach ( $fieldCollection as $field ) */

            $this->recordSize++;    /* On ajoute 1 byte qui est le premier byte du record qui indique si le record est deleted ou pas (*) */
        }   /* if ( ( $fieldCollection = $oXPath->query( 'field',$oNode ) ) && ( $fieldCollection->length > 0 ) ) */
    }   /* End of Table.readStructure() =============================================== */
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
        switch ( $property )
        {
            case 'storage'      :   return ( $this->determineDataFile() );
            default             :   if ( isset( $this->offsets[$property] ) )
                                    {
                                        return ( $this->read( $property ) );
                                    }
                                    else
                                        throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
                                        //throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $property ) */
    }   /* End of Table.__get() ======================================================= */
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
            (mixed)     What the internal function returns
        *}

        *}}
    */
    /* ================================================================================ */
    public function __set( $property,$value )
    /*-------------------------------------*/
    {
        //var_dump( "IN " . __METHOD__ . "() WITH {$property} and {$value}" );
        switch( $property )
        {
            default :   if ( isset( $this->fields[$property] ) )
                        {
                            return ( $this->write( $property,$value ) );
                        }
                        else
                            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
        }
    }   /* End of Table.__set() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor. All files which were not closed before are closed. All internal
        handles are invalidated.

        {*params
        *}

        {*return
            (void)      No return.
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        if ( ! is_null( $this->readHandle ) && is_resource( $this->readHandle ) )
            fclose( $this->readHandle  );

        if ( ! is_null( $this->writeHandle ) && is_resource( $this->writeHandle ) )
            fclose( $this->writeHandle  );

        if ( ! is_null( $this->reccountHandle ) && is_resource( $this->reccountHandle ) )
            fclose( $this->reccountHandle  );

        if ( is_array( $this->indexHandles ) )
        {
            foreach( $this->indexHandles as $handle )
                fclose( $handle );
        }

        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of Table.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Table ============================================================= */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class Field=

    {*desc

        Field of a table of an IllicoDB database

    *}

    *}}
 */
/* ==================================================================================== */
class Field extends Thing
/*---------------------*/
{
    public      $length                     = 0;                    /* {*property   $length                     (int)                   Length of the field. *} */
    public      $type                       = '';                   /* {*property   $type                       (string)                Field type (string, int, float, object, array, ...);
                                                                                                                                        WikidataId Q190087 : classification of data in computer science; *} */
    public      $offset                     = null;
    public      $wikidataId                 = 'Q1172412';           /* {*property   $wikidataId                 (string)                WikidataId ... part of a database record *} */

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

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of Field.__construct() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of Field.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Field ============================================================= */
/* ==================================================================================== */
?>