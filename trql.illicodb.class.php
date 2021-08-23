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

    {*chist
        {*mdate 22-08-21 10:44:07 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  First implementation of views
        *}
    *}

    {*todo

        1) Pouvoir créer le schéma d'une table sur base des propriétés d'une classe (on donne le nom de la classe
           et la structure de la table est automatiquement déterminée par la classe; utilisation des méthodes
           magiques __sleep() et __wakeup())
        2) Pouvoir sauver tout un record ou une array de records (en commençant au recno
           courant)
        3) VIEWS: il faudrait être capable de créer des "champs" qui sont des expressions (field1 + field2)
            - le difficulté sera de calculer des offsets dans ce cas là
        4) Index on dates, datetimes, ints and floats
        5) Implémenter les champs "guid" qui sont des champs "id" en fait
        6) Pouvoir mettre un commentaire sur chaque champ de la structure d'une table
        7) Pouvoir modifier la structure "on-the-fly" (les données sont recopiées sans aucune perte dans la nouvelle structure)
        9) Création d'une documentation des tables faisant partie d'une DB
        9) Disposer de Stored Procedures (c'est VRAIMENT pas urgent !)
        10) Pouvoir mettre des champs en relation (1 .. 1, 1 .. n, n .. 1)
        11) Le create() doit permettre de placer les descriptions des champs
        12) Pouvoir faire une modification de structure de la DB à chaud (readStructure() doit pouvoir
            être ré-appelé; un modifyStructure dot voir le jour)
        13) Les noms des champs doivent être case-sensitive
        14) Implémenter un champ "othermemo" : c'est un fichier mémo mais il a un nom
            positionnable par l'utilisateur (une référence à un autre fichier mémo dans
            lequel les données sont vraiment disponibles)
        15) If duplicate id (on ne peut avoir QU'UN SEUL type 'id) => EXCEPTION
        16) Permettre une mise à jour des index en temps réel : on voit quels sont les index
            positionnés sur la table, et ils sont mis à jour automatiquement sur base
            des write, append, delete et pack.
        17) __toString devrait faire la même chose que __toXML MAIS ... devrait faire l'export
            dans un fichier texte ! Par contre, le nom estmisleading car on s'attend à avoir
            un retour de string. Peut-être trouver autre nom : __toText() ?
        18) Vérifier la méthode de backup
        19) Implémenter un __toZip()
        20) Transformer le read() and write() pour lire et écrire dans un raw record
        21) Faire précéder toutes les méthodes "protected" par le mot-clef "protected" dans
            les déclarations de fonctions pour la doc
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \DOMDocument;
use \DOMXPath;

use \trql\vaesoli\Vaesoli   as v;
use \trql\schema\Thing      as Thing;
use \trql\html\Form         as Form;
use \trql\html\Fieldset     as Fieldset;
use \trql\html\Formset      as Formset;
use \trql\html\Input        as Input;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );


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
defined( "EXCEPTION_MEMO_FILE_NOT_FOUND" )                      or define( "EXCEPTION_MEMO_FILE_NOT_FOUND"                          ,EXCEPTION_BASIS + 1019 );
defined( "EXCEPTION_CANNOT_OPEN_TABLE" )                        or define( "EXCEPTION_CANNOT_OPEN_TABLE"                            ,EXCEPTION_BASIS + 1020 );
defined( "EXCEPTION_CANNOT_LOAD_XML_FILE" )                     or define( "EXCEPTION_CANNOT_LOAD_XML_FILE"                         ,EXCEPTION_BASIS + 1021 );
defined( "EXCEPTION_INVALID_VALUE" )                            or define( "EXCEPTION_INVALID_VALUE"                                ,EXCEPTION_BASIS + 1022 );
defined( "EXCEPTION_OUT_OF_RANGE" )                             or define( "EXCEPTION_OUT_OF_RANGE"                                 ,EXCEPTION_BASIS + 1023 );


trait commonTrait
/*-------------*/
{
    /* À documenter */
    public function hash( $szValue )
    /*----------------------------*/
    {
        return ( hash( 'sha1',(string) $szValue ) );
    }

    /* ================================================================================ */
    /** {{*msToMins( $milliseconds )=

        From milliseconds to minutes and seconds

        {*params
            $milliseconds   (int)       Milliseconds
        *}

        {*return
            (string)    @param.milliseconds turned into a string of minutes and seconds
        *}

        {*example
        $oDB = new IllicoDB();
        var_dump( $oDB->msToMins( 2400000 ) );  // Will print [c]40'00"[/c]
        var_dump( $oDB->msToMins( 1876235 ) );  // Will print [c]31'16"[/c]
        var_dump( $oDB->msToMins( 271960  ) );  // Will print [c]4'32"[/c]
        *}

        *}}
    */
    /* ================================================================================ */
    public function msToMins( $ms )
    /*---------------------------*/
    {
        $fMins = (int) ( $ms / 1000 / 60 );
        $fMs   = $ms - ( $fMins * 60 * 1000 );
        $fSecs = round( $fMs / 1000,0 );

        return ( (string) $fMins . "'" . v::STR_padl( $fSecs,2,'0' ) . '"' );
    }   /* End of commonTrait.msToMins() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*fieldLength( $type )=

        Determine the length of a field based on its type

        {*params
            $type       (string)        Field type
        *}

        {*return
            (int)       The length of a type of field
        *}

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
    use commonTrait;                                                /* Common set of methods used in (many) classes */

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
    public      $views                      = null;                 /* {*property   $views                      (array)                 Set of views set on the DB *} */
    public      $storedProcedures           = null;                 /* {*property   $storedProcedures           (array)                 Set of stored procedures (NOT USED : 29-07-21 14:40:19) *} */
    public      $name                       = null;                 /* {*property   $name                       (string)                DB Name *} */
    protected   $isOpen                     = false;
    public      $table                      = null;
    public      $view                       = null;

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


    // EST-CE QUE CETTE METHOD EST BIEN UTILE???
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
    public function useOLD( $table )
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
                    $this->$table->Goto(1);
                }
                catch( Exception $e )
                {
                    var_dump( $e );
                }
            }
            elseif ( isset( $this->views[ $table ] ) )
            {
                //var_dump("ON EST DANS LE USE");
                $this->view = $table;

                try
                {
                    $this->$table->Goto(1);
                }
                catch( Exception $e )
                {
                    var_dump( $e );
                }
            }
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: EXCEPTION_TABLE_NOT_FOUND = " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: EXCEPTION_DB_NOT_OPEN = " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );

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
            THE NAME OF THE METHOD WILL BE CHANGED. DO NOT USE FOR PRODUCTION
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
        }   /* foreach( $this->tables as $name => $table ) */

        return ( $szRetVal );
    }   /* End of Database.structure() ================================================ */
    /* ================================================================================ */


    /* THIS METHOD IS OBSOLETE */
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


    /* THIS METHOD IS OBSOLETE */
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

        {*warning
            THIS METHOD IS OBSOLETE. Direct access to write() of a table is what should
            be used.
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
    /* ================================================================================ */
    /** {{*read( $table,)=

        Reads a field of a table.

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*warning
            This method is obsolete. Direct access to read() of a tabe is what should be
            used.
        *}

        {*seealso @fnc.write *}

        *}}
    */
    /* ================================================================================ */
    /* OBSOLETE */
    public function OLDread( $table,$field )
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
    /* ATTENTION ... C'EST VRAIMENT MAUVAIS !!! */
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
        /* !!!THIS IS ALL WRONG */
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
                        foreach( $tableCollection as $table )
                        {
                            $name = strtolower( trim( $table->getAttribute( 'name' ) ) );
                            $this->tables[$name] = new Table( $this,$name );
                        }
                    }

                    if ( ( $viewCollection = $oXPath->query( 'views/view' ) ) && ( $tableCollection->length > 0 ) )
                    {
                        foreach( $viewCollection as $view )
                        {
                            if ( isset( $this->tables[$table = $view->getAttribute('table')] ) )
                            {
                                $name = strtolower( trim( $view->getAttribute( 'name' ) ) );
                                $this->views[$name] = new View( $this->tables[$table],$name );
                            }
                            else
                                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: EXCEPTION_TABLE_NOT_FOUND = " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
                        }   /* foreach( $viewCollection as $view ) */
                    }   /* if ( ( $viewCollection = $oXPath->query( 'views/view' ) ) && ( $tableCollection->length > 0 ) ) */
                }
                else
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": 'INVALID DB CONTAINER (cannot be loaded) (ErrCode: EXCEPTION_INVALID_DB_CONTAINER = " . EXCEPTION_INVALID_DB_CONTAINER . ")",EXCEPTION_INVALID_DB_CONTAINER );
            }
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szDBFile}' NOT FOUND (ErrCode: EXCEPTION_DB_CONTAINER_NOT_FOUND = " . EXCEPTION_DB_CONTAINER_NOT_FOUND . ")",EXCEPTION_DB_CONTAINER_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: EXCEPTION_DB_NOT_OPEN = " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );


    }   /* End of Database.readStructure() ============================================ */
    /* ================================================================================ */


    /* OBSOLETE */
    public function OLDappend( $table,$x = 1 )
    /*-----------------------------------*/
    {
        if ( $this->isOpen )
        {
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->append( $x ) );
            elseif ( isset( $this->views[$table] ) )
                return ( $this->views[$table]->append( $x ) );

            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$table}' NOT FOUND (ErrCode: " . EXCEPTION_TABLE_NOT_FOUND . ")",EXCEPTION_TABLE_NOT_FOUND );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": database NOT open (ErrCode: " . EXCEPTION_DB_NOT_OPEN . ")",EXCEPTION_DB_NOT_OPEN );
    }   /* End of Database.append() =================================================== */
    /* ================================================================================ */


    /* OBSOLETE */
    public function reccountOLD( $table )
    /*------------------------------*/
    {
        if ( $this->isOpen )
        {
            var_dump( $this );
            if ( isset( $this->tables[$table] ) )
                return ( $this->tables[$table]->reccount() );
            elseif ( isset( $this->views[$table] ) )
                return ( $this->views[$table]->reccount() );

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


    /* OBSOLETE */
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


    /* OBSOLETE */
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


    /* OBSOLETE */
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


    /* OBSOLETE */
    public function OLDrecall( $table )
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


    /* OBSOLETE */
    public function OLDrecord( $table )
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


    /* OBSOLETE */
    public function OLDrecords( $table,$n = 1)
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
    /*-------------------*/
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
            default     :   if     ( isset( $this->tables[$property] ) )
                                return ( $this->tables[$property] );
                            elseif ( isset( $this->views[$property] ) )
                                return ( $this->views[$property] );
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
                            elseif ( isset( $this->views[$property] ) )
                                return ( $this->views[$property]->write( $value ) );
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
    protected   $recno                      = 0;                    /* {*property   $recno                      (int)                   Current record position. From [c]0[/c] (invalid position) to @var.reccount *} */
    protected   $reccount                   = 0;                    /* {*property   $recno                      (int)                   Number of records stored in the table (including all 'deleted' records) *} */
    public      $offsets                    = null;         /* THIS SHOULD BE PROTECTED */
    public      $container                  = null;     /* Le nom de la DB dans laquelle est stockée la table */
    public      $recordSize                 = -1;
    public      $fileSize                   = -1;
    public      $storage                    = null;
    public      $autoSort                   = true;     /* Si true, alors si l'index est out-of-sync avec la DB, alors il est reconstruit; si false, l'index n'est PAS reconstuit et on pourrait se trouver avec un vieil index (mais probablement utilisable en partie) */
    public      $softseek                   = false;                    /* {*property   $softseek               (bool)              [c]true[/c] to perform a soft seek when using [c]@class.seek()[/c]; [c]false[/c] to perform an exact seek *} */
    public      $szClass                    = null;                     /* {*property   $szClass                (string)            CSS class of the task when it needs to be rendered *} */
    public      $szOnSubmit                 = null;                     /* {*property   $szOnSubmit             (string)            Submit clause of the form ([c]__toForm()[/c]) *} */
    protected   $readHandle                 = null;
    protected   $readMemoHandle             = null;
    protected   $writeHandle                = null;
    protected   $writeMemoHandle            = null;
    protected   $writeRawMemoHandle         = null;
    protected   $indexHandles               = null;
    protected   $reccountHandle             = null;
    protected   $isEOF                      = true;
    protected   $isBOF                      = true;
    protected   $idField                    = null;


    /* ================================================================================ */
    /** {{*__construct( $container,$name )=

        Class constructor

        {*params
            $container      (IllicoDB)      DB Container
            $name           (string)        Table name
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $container,$name )
    /*-------------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        $this->container    = $container;
        $this->name         = $name;

        $szDBFile = strtolower( v::FIL_addBS( $this->container->homeOfData ) . $this->container->name . '.illicoDB' );
        //var_dump( $szDBFile );

        if ( is_file( $szDBFile ) )                                 /* If DB file found */
        {
            $oDom = new \DOMDocument();

            if ( $oDom->load( $szDBFile ) )                         /* If we could load the DB file */
            {
                //var_dump( "DOM loaded" );
                $oXPath = new \DOMXPath( $oDom );
                //var_dump( "XPath created" );

                if ( ( $tableCollection = $oXPath->query( "tables/table[@name='{$name}']" ) ) && ( $tableCollection->length > 0 ) )
                {
                    //var_dump( "TABLE {$name} FOUND",$tableCollection->item(0) );
                    $this->readStructure( $oDom,$oXPath,$tableCollection->item(0) );
                }
            }

            $this->determineLengthOfDataFile(); /* $this->fileSize est mis à jour */
            // The recordSize can only be known when we have read the table structure!!!
            $this->reccount = (int) ( $this->fileSize / $this->recordSize );

            //var_dump( $this->name,$this->fileSize,$this->recordSize,$this->reccount );
        }
        else
            // EXCEPTION

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
        {
            //var_dump( $this->container );
            //var_dump( $this->container->homeOfData );

            $this->storage = v::FIL_addBS( $this->container->homeOfData ) . strtolower( trim( $this->container->name ) ) . '.' .
                                                                            strtolower( trim( $this->name            ) ) . '.illicoDB';
        }

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


    /* OBSOLETE: __get(), __set() and __call() instead!! */
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

        //var_dump( $this->fileSize,$this->recordSize );

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

        {*remark
            This method should use the writeHandle instead of opening the file
            and closing it
        *}

        {*seealso @fnc.deleted, @fnc.pack, @fnc.recall *}

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
    /** {{*deleted()=

        Determines whether a record is logically deleted or not

        {*params
        *}

        {*return
            (bool)      [c]true[/c] if record deleted; [c]false[/c] if not
        *}

        {*remark
            This method should use the readHandle instead of opening the file
            and closing it
        *}

        {*seealso @fnc.pack, @fnc.delete, @fnc.recall *}

        *}}
    */
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


    /* ================================================================================ */
    /** {{*recall()=

        Recalls a record from the current table (opposite operation of [c]@fnc.delete[c])

        {*params
        *}

        {*return
            (bool)      [c]true[/c] if record successfully recalled; [c]false[/c] if not
        *}

        {*remark
            This method should use the writeHandle instead of opening the file
            and closing it
        *}

        {*seealso @fnc.deleted, @fnc.delete, @fnc.pack *}

        *}}
    */
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


    /* ================================================================================ */
    /** {{*pack()=

        Removes all records that have been marked as deleted.

        {*params
        *}

        {*return
            ($iCount)       The number of records that were deleted
        *}

        {*warning
            Index may need to be rebuilt; Memo files are out of sync (WHICH IS A PROBLEM)
        *}

        {*seealso @fnc.deleted, @fnc.delete, @fnc.recall *}

        *}}
    */
    /* ================================================================================ */
    public function pack()
    /*------------------*/
    {
        $iDeleted = 0;

        if ( $this->reccount() > 0 )                                  /* If we have records */
        {
            $szFile = $this->determineDataFile();                   /* Determine the name of the physical file */
            $szRoot = v::FIL_RealPath( dirname( v::FIL_ResolveRoot( $szFile ) ) );
            $tmpName = tempnam( $szRoot,'' );                       /* Create a temp file */

            //var_dump( "FICHIER TEMPORAIRE: " . $tmpName );

            if ( $tmp = fopen( $tmpName ,'w+b' ) )                  /* Open the temp file and set it 0 length */
            {
                if ( is_null( $this->readHandle ) )
                    $this->readHandle = fopen( $szFile,'r+b' );

                if ( $this->readHandle )                            /* If we could open the table file */
                {
                    fseek( $this->readHandle,0,SEEK_SET );          /* Go to first byte */

                    while ( ! feof( $this->readHandle ) )           /* While NOT End of File */
                    {
                        if ( ! empty( $record = fread( $this->readHandle,$this->recordSize ) ) )
                        {
                            //var_dump( $record );
                            if ( $record[0] !== '*' )               /* If record NOT deleted */
                                fwrite( $tmp,$record );             /* Write the record to the tmp file */
                            else
                                $iDeleted++;                            /* Increment Count */
                        }   /* if ( ! empty( $record ... ) ) ) */
                    }   /* while ( ! feof( $this->readHandle ) ) */

                    fclose( $tmp );                                 /* Close the temp file */

                    {   /* Make sure some handles get closed before we overwrite the table file */
                        $this->closeHandles();
                    }   /* Make sure some handles get closed before we overwrite the table file */

                    rename( $tmpName,$szFile );                     /* Rename the tmp file to the table filename */
                }   /* if ( $this->readHandle ) */
                else
                {
                    // EXCEPTION: CANNOT READ (FOPEN FAILED)
                }
            }   /* if ( $tmp = fopen( $tmpName ,'w+b' ) ) */

            // MAINTENANT, IL FAUT ENCORE S'OCCUPER DES INDEX ET DES CHAMPS MEMO !!!!!!!!!

            $this->recno = 1;
            $this->closeHandles();
            var_dump( $this->reccount() );
        }
        else
        {
            //var_dump( "NO RECORDS FOUND" );
        }

        end:
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


    // THIS METHOD SHOULD GO !
    // USE __call() INSTEAD !!!
    // MAKE IT SUCH THAT IT USES GO() OR GOTO()
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


    // THIS METHOD SHOULD GO !
    // USE __call() INSTEAD !!!
    public function eof()
    /*-----------------*/
    {
        return ( $this->isEOF );
    }   /* End of Table.eof() ========================================================= */
    /* ================================================================================ */


    // THIS METHOD SHOULD GO !
    // USE __call() INSTEAD !!!
    public function bof()
    /*-----------------*/
    {
        return ( $this->isBOF );
    }   /* End of Table.eof() ========================================================= */
    /* ================================================================================ */


    // THIS METHOD SHOULD GO !
    // USE __call() INSTEAD !!!
    public function OLDrecno()
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

        {*remark
            @fnc.go() differs from @fnc.goto() in the sense that it returns the current
            record pointer ([c]recno[/c]) whereas @fnc.goto() returns the current instance
            of the class while doing exactly the same thing.
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


    /* ================================================================================ */
    /** {{*id()=

        Returns the value of the "id" field ("id" type)

        {*params
        *}

        {*return
            (mixed)     The value of the "id" type field or [c]null[/c] if none found
        *}

        *}}
    */
    /* ================================================================================ */
    public function id()
    /*----------------*/
    {
        if ( ! is_null( $this->idField ) )
            return ( $this->read( $this->idField->name ) );

        return ( null );
    }   /* End of Table.id() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*idField()=

        Returns the "id" type field

        {*params
        *}

        {*return
            (mixed)     A Field or null if no field of "id" type
        *}

        *}}
    */
    /* ================================================================================ */
    protected function idField()
    /*------------------------*/
    {
        return ( $this->idField );
    }   /* End of Table.idField() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*append( [$n] )=

        Move the record pointer to @param.n

        {*params
            $n          (int)       The number of records to add. Optional. [c]1[/c] by
                                    default
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*remark
            The record pointer (@var.recno) is advanced accordingly (always = to
            @var.reccount)
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        |** Adds 100 blank records **|
        [b]$oDB->artists->append(100)[/b];
        *}

        *}}
    */
    /* ================================================================================ */
    public function append( $x = 1 )
    /*----------------------------*/
    {
        $szFile = $this->determineDataFile();

        /* Je ne devrais PAS ouvrir le fichier ! Le writeHandle devrait être utilisé */
        if ( $fh = fopen( $szFile,'a+b' ) )
        {
            // Hmmm ... si j'ai un field de type "id" alors, je dois le remplir automatiquement !
            if ( flock( $fh,LOCK_EX ) )
            {
                fwrite( $fh,str_repeat( ' ',$x * $this->recordSize ) );
                flock( $fh,LOCK_UN );
            }   /* if ( flock( $fh,LOCK_EX ) ) */

            if ( $this->fileSize < 1 )
                $this->determineLengthOfDataFile();         /* $this->fileSize est mis à jour */

            fclose( $fh );

            $this->recno = $this->reccount;
        }
        else
        {
            // EXCEPTION: CANNOT APPEND (FOPEN FAILED)
        }

        return ( $this );
    }   /* End of Table.append() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected readRawRecord()=

        Reads the whole current record

        {*params
        *}

        {*return
            (mixed)     The value of the field
        *}

        *}}
    */
    /* ================================================================================ */
    protected function readRawRecord()
    /*------------------------------*/
    {
        if ( is_null( $this->readHandle ) )
            $this->readHandle = fopen( $szFile = $this->determineDataFile(),'rb' );

        if ( $this->readHandle )
        {
            $offset = ( $this->recordSize * ( $this->recno - 1 ) )  + 1; /* +1 => because of the 1st byte which is the "deleted" mark */

            fseek( $this->readHandle,$offset,SEEK_SET );
            return ( fread( $this->readHandle,$this->recordSize ) );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": Attempt to write after EOF (ErrCode: EXCEPTION_CANNOT_OPEN_TABLE = " . EXCEPTION_CANNOT_OPEN_TABLE . ")",EXCEPTION_CANNOT_OPEN_TABLE );

        return ( null );
    }   /* End of Table.readRawRecord() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*read( $field )=

        Reads a field of the current record

        {*params
            $field      (string)    Field to read
        *}

        {*return
            (mixed)     The value of the field
        *}

        {*example
        $oDB = new IllicoDB();

        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'artists' );

        |** Read the '[c]id[/c]' field **|
        var_dump( [b]$oDB->artists->Goto(15000)->read( 'id' )[/b] );
        *}

        *}}
    */
    /* ================================================================================ */
    public function read( $field )
    /*--------------------------*/
    {
        if ( ! isset( $this->fields[$field] ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: EXCEPTION_INVALID_FIELD = " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );
        else
        {
            if ( $this->fields[$field]->type === 'memo' )
                return ( $this->readMemo( $field ) );
        }

        if ( ! is_null( $rawRecord = $this->readRawRecord() ) )
            return ( substr( $rawRecord,$this->offsets[$field]['offset'],$this->offsets[$field]['length'] ) );
        else
            return ( null );
    }   /* End of Table.read() ======================================================== */
    /* ================================================================================ */


    // THIS METHOD SHOULD WORK DIFFERENTLY!!!
    // WE SHOULD READ and WRITE raw records OR AT LEAST
    // POSITION THE FILE POINTER EXACTLY WHERE THE CURRENT
    // RECORD STARTS AND NEVER MOVE IT INSIDE THE RECORD.
    // WE SHOULD READ THE RECORD (WHOLE STRING) AND EXTRACT
    // FIELDS BASED ON THEIR OFFSET (offset IN THE STRING) OR
    // WRITE VALUES INSIDE THE STRING (AT PROPER OFFSET) AND
    // WRITE THE RECORD BACK TO THE FILE.
    // THE READ AND WRITE HANDLES SHOULD BE THE SAME: THE FILE
    // POINTER SHOULD BE UNIQUE !!!
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
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$field}' ... FIELD NOT FOUND (ErrCode: EXCEPTION_INVALID_FIELD = " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );

        if ( $this->recno < 1 )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ATTEMPT TO WRITE BEFORE BOF (ErrCode: EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_EOF = " . EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_EOF . ")",EXCEPTION_ATTEMPT_TO_WRITE_BEFORE_EOF );

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
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": Attempt to write after EOF (ErrCode: EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF = " . EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF . ")",EXCEPTION_ATTEMPT_TO_WRITE_AFTER_EOF );
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


    // Écrit un champ mémo dans le fichier mémo
    protected function writeMemo( &$field,&$value )
    /*-------------------------------------------*/
    {
        $iRetVal = 0;

        $this->writeMemoHandle = fopen( $szFile = $this->determineDataFile() . '.memo','c+b' );

        if ( $this->writeMemoHandle )
        {
            $t1         = microtime( true );
            $offset     = 0;
            $size       = 5000 * 8;                                 /* Ici, ajustement possible pour performances */
            $szRoot     = v::FIL_RealPath( dirname( v::FIL_ResolveRoot( $szFile ) ) );
            //var_dump( $szRoot );

            if ( ! is_null( $szID = $this->id() ) )                 /* If we have an ID (no ID => cannot write to a memo file) */
            {
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

                /* If the record was found */
                if ( $recordFound = ( $startOffset !== -1 && $endOffset !== -1 ) )
                {
                    fseek( $this->writeMemoHandle,$startOffset,SEEK_SET );
                    $len = ( $endOffset - $startOffset ) + strlen( $szID ) + 3;
                    $record = fread( $this->writeMemoHandle,$len );

                    if ( preg_match( "%<{$field}>.*</{$field}>%s",$record ) )
                        $record = preg_replace( "%<{$field}>.*</{$field}>%s","<{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}>",$record );
                    else
                        $record = str_replace( "</{$szID}>","<{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}></{$szID}>",$record );

                    // Je vais commencer par fermer le handle
                    if ( $this->writeMemoHandle )
                    {
                        fflush( $this->writeMemoHandle );
                        fclose( $this->writeMemoHandle );
                        $this->writeMemoHandle = null;
                    }   /* if ( $this->writeMemoHandle ) */

                    // Je coupe le bloc de l'ancien record
                    v::FIL_deleteInFile( $szFile,$startOffset,$len );
                    // J'écris le nouveau record
                    v::FIL_insertInFile( $szFile,$startOffset,$record );

                    // ON AURAIT UNE BELLE OPTIMISATION A FAIRE LES DEUX OPERATIONS DANS UNE
                    // SEULE ROUTINE CAR ON NE VA PAS OUVRIR ET FERMER LE FICHIER PLUSIEURS
                    // FOIS

                }   /* if ( $recordFound = ( $startOffset !== -1 && $endOffset !== -1 ) ) */
                else    /* Record NOT found */
                {
                    //var_dump( "RECORD NOT FOUND" );
                    $record = "<$szID><{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}></$szID>";
                    fseek( $this->writeMemoHandle,0,SEEK_END );
                    $iRetVal = fwrite( $this->writeMemoHandle,$record );
                    //var_dump( "RECORD WRITTEN" );
                }
            }   /* if ( ! is_null( $szID = $this->id() ) ) */
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": 'id' field required (ErrCode: " . EXCEPTION_NO_ID_FIELD_FOUND . ")",EXCEPTION_NO_ID_FIELD_FOUND );
        }   /* if ( $this->writeMemoHandle ) */

        end:

        if ( $this->writeMemoHandle )
        {
            fflush( $this->writeMemoHandle );
            fclose( $this->writeMemoHandle );
            $this->writeMemoHandle = null;
        }   /* if ( $this->writeMemoHandle ) */

        return ( $iRetVal );
    }   /* End of Table.writeMemo() =================================================== */
    /* ================================================================================ */


    // TO BE DOCUMENTED
    protected function readMemo( &$field )
    /*----------------------------------*/
    {
        $RetVal = null;

        //var_dump( "AVANT PROBLEME" );
        $szFile = $this->determineDataFile() . '.memo';
        if ( ! is_null( $szID = $this->id() ) )
        {
             if ( ! $this->readMemoHandle )
                 $this->readMemoHandle = @fopen( $szFile,'rb' );

             if ( $this->readMemoHandle )
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

                 //fclose( $this->readMemoHandle );
             }   /* if ( $this->readMemoHandle = fopen( $szFile = $this->determineDataFile() . '.memo','rb' ) ) */
             else
                 throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szFile}' NOT found (ErrCode: EXCEPTION_MEMO_FILE_NOT_FOUND = " . EXCEPTION_MEMO_FILE_NOT_FOUND . ")",EXCEPTION_MEMO_FILE_NOT_FOUND );
        }
        // .. else
        // ..     throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": ID required (ErrCode: EXCEPTION_NO_ID_FIELD_FOUND = " . EXCEPTION_NO_ID_FIELD_FOUND . ")",EXCEPTION_NO_ID_FIELD_FOUND );

        //var_dump( $RetVal );
        return ( $RetVal );
    }   /* End of Table.readMemo() ==================================================== */
    /* ================================================================================ */


    // THIS METHOD SHOULD BE TESTED EXTENSIVELY
    // AND ... IT BANGS INTO THE DINITION OF backup() OF MOTHER !
    // WE SHOULD CHANGE THE NAME OTHERWISE IT WILL GENERATE MULTIPLE PROBLEMS
    /* ================================================================================ */
    /** {{*backup( $szTarget )=

        Creates a backup of the table

        {*params
            $szTarget       (string)        The name of the backup file. Optional.
                                            If not passed, @param.szTarget will be
                                            equal to the name of the physical file of
                                            the table augmented by the current date and
                                            time.
        *}

        {*return
            (bool)      [c]true[/c] if backup successful; [c]false[/c] if not.
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
    public function backupGRRRRRRRR( $szTarget = null )
    /*--------------------------------------*/
    {
        $szFile = $this->determineDataFile();

        //if ( is_null( $szTarget ) )
        //    $szTarget = $szFile . '.' . date( 'YmdHis' ) . '.backup';
        //
        //var_dump ( "Writing {$szFile} to {$szTarget}" );
        //return ( v::FIL_Copy( $szFile,$szTarget ) );
    }   /* End of Table.backup() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*indexes()=

        Returns the name of all indexes set on the current table

        {*params
        *}

        {*return
            (array)     Array of filenames
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
    public function indexes()
    /*---------------------*/
    {
        return ( $aFiles = v::FIL_aFilesEx( $this->determineDataFile() . "*.idx" ) );
    }   /* End of Table.indexes() ===================================================== */
    /* ================================================================================ */


    // Écrit une array qui représente TOUS les champs "memo" à écrire
    // dans le fichier mémo
    public function writeRawMemoOLD( &$aMemo )
    /*-----------------------------------*/
    {
        $this->die( __METHOD__ . "(): obsolete!" );

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
            }   /* if ( is_array( $aMemo ) && isset( $aMemo['id'] ) ) */
            else
            {
                // EXCEPTION
                fflush( $this->writeRawMemoHandle );
                fclose( $this->writeRawMemoHandle );
            }
        }   /* if ( $this->writeRawMemoHandle ) */
    }   /* End of Table.writeRawMemoOLD() ================================================ */
    /* ================================================================================ */


    public function writeRawMemo( &$aMemo )
    /*-----------------------------------*/
    {
        $szFile = $this->determineDataFile() . '.memo';

        if ( ! $this->writeRawMemoHandle )
           $this->writeRawMemoHandle = fopen( $szFile,'c+b' );

        if ( $this->writeRawMemoHandle )
        {
            if ( is_array( $aMemo ) && isset( $aMemo['id'] ) )
            {
                $szID           = $aMemo['id'];
                $patternStart   = '<' . $szID . '>';
                $patternEnd     = '</' . $szID . '>';

                {   /* Compose the raw memo */
                    $record         = "<{$szID}>";
                    foreach( $aMemo as $field => $value )
                    {
                        if ( $field !== 'id' )
                            $record .= "<{$field}>" . base64_encode( serialize( $value ) ) . "</{$field}>";
                    }
                    $record .= "</{$szID}>";
                }   /* Compose the raw memo */

                $startOffset = $endOffset = -1;                     /* starting and ending offsets of the record */
                $recordFound = false;

                $t1 = microtime( true );
                //var_dump( "LOOKING FOR '{$patternStart}'" );
                $startOffset = v::FIL_searchInFile( $patternStart,$szFile,0 /* start position */,60000 /* block size */ );
                $t2 = microtime( true );
                //var_dump( "FINISHED STARTOFFSET IN " . number_format( $t2 - $t1,6,',','.' ) . " secs: " . $startOffset );

                if ( $startOffset !== -1 )
                {
                    $t1 = microtime( true );
                    //var_dump( "LOOKING FOR '{$patternEnd}'" );
                    $endOffset = v::FIL_searchInFile( $patternEnd,$szFile,$startOffset /* start position */,60000 /* block size */ );
                    $t2 = microtime( true );
                    //var_dump( "FINISHED ENDOFFSET IN " . number_format( $t2 - $t1,6,',','.' ) . " secs: " . $endOffset );
                }   /* if ( $startOffset !== -1 ) */

                /* If the record found */
                if ( $recordFound = ( $startOffset !== -1 && $endOffset !== -1 ) )
                {
                    //var_dump( "MEMO RECORD FOUND: more complicated!" );

                    $len = ( $endOffset - $startOffset ) + strlen( $szID ) + 3;
                    v::FIL_deleteInFile( $szFile,$startOffset,$len );
                    v::FIL_insertInFile( $szFile,$startOffset,$record );
                }   /* if ( $recordFound = ... ) */
                else    /* Else of ... if ( $recordFound = ... ) */
                {
                    /* The record was NOT found => go to the end of the memo file and
                       write the damn record */
                    //var_dump( "MEMO RECORD NOT FOUND: simple case = write at the end of the memo file!" );
                    fseek( $this->writeRawMemoHandle,0,SEEK_END );
                    fwrite( $this->writeRawMemoHandle,$record );
                }    /* End of ... Else of ... if ( $recordFound = ... ) */
                //fwrite( $this->writeRawMemoHandle,$record );
            }   /* if ( is_array( $aMemo ) && isset( $aMemo['id'] ) ) */
        }   /* if ( $this->writeRawMemoHandle ) */
    }   /* End of Table.writeRawMemo() ================================================ */
    /* ================================================================================ */


    // Écrit une chaîne de caractères qui représente TOUT un record
    // dans la table
    // THIS IS THE METHOD WRITE() SHOULD WORK WITH
    public function writeRawRecord( $record )
    /*-------------------------------------*/
    {
        if ( is_null( $this->writeHandle ) )
            $this->writeHandle = fopen( $szFile = $this->determineDataFile(),'c+b' );

        if ( $this->writeHandle )
        {
            // JE DOIS METTRE UN LOCK!!!

            $offset = ( $this->recordSize * ( $this->recno - 1 ) )  +
                      1; /* +1 => because of the 1st byte which is the "deleted" mark */

            fseek( $this->writeHandle,$offset,SEEK_SET );
            fwrite( $this->writeHandle,$record,$this->recordSize );
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": Attempt to write after EOF (ErrCode: EXCEPTION_CANNOT_OPEN_TABLE = " . EXCEPTION_CANNOT_OPEN_TABLE . ")",EXCEPTION_CANNOT_OPEN_TABLE );

        return ( $this );
    }   /* End of Table.writeRawRecord() ============================================== */
    /* ================================================================================ */


    /* Obtain data from table directly going to the offset */
    /* CHECK IF THIS METHOD IS NOT A DUPLICATE OF readRawRecord() */
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
                    /* We check the existence of the field because in a View ... we don't have all the fields */
                    if ( isset( $this->fields[$field] ) )
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
                    }
                }   /* foreach( $this->offsets as $field => $positions ) */
            }   /* if ( ! empty( $szRetVal = fread( $fh,$this->recordSize ) ) ) */

            fclose( $fh );
        }
        else
        {
            // EXCEPTION: CANNOT WRITE (FOPEN FAILED)
        }

        return ( $aRetVal );
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
    /** {{*protected sort( $field[,$iStart[,$iEnd]] )=

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


    /* ================================================================================ */
    /** {{*index( $field[,$forced] )=

        Index on the @param.field field if necessary unless @param.forced is set to
        [c]true[/c]

        {*params
            $field      (string)    The name of the field to index on
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*example
        *}

        *}}
    */
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
        return ( $this );        /* There is nothing to return */
    }   /* End of Table.index() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*seek( $needle,$field,$recno[,$select] )=

        Seek @param.needle in the @param.field field of the table

        {*params
            $needle     (string)    The value to look for
            $field      (string)    The name of the field where the search will take place
            $recno      (int|null)  The record number of the first match
            $select     (array)     Optional array. If passed, then ALL matches will be
                                    returned (record nuumbers)
        *}

        {*return
            (bool)      [c]true[/c] if @param.needle found; [c]false[/c] otherwise
        *}

        {*example
        $oDB = new IllicoDB();
        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'catalog' );

        $recno   = null;
        $records = array();
        $needle  = 'What a fool believes';
        $field   = 'f_title';

        [b]if ( $oDB->catalog->seek( $needle,$field,$recno,$records ) )
        {
            var_dump( $needle . ' FOUND' );

            if ( count( $records ) != 0 )
            {
                foreach( $records as $recno )
                {
                    var_dump( trim( $oDB->catalog->Goto($recno)->f_title ) . ' by ' . trim( $oDB->catalog->f_creator ) );
                }
            }
        }[/b]
        else
        {
            var_dump( $needle . ' NOT FOUND' );
        }
        *}

        *}}
    */
    /* ================================================================================ */
    public function seek( $needle,$field,&$recno,&$select = null,&$index = 0 )
    /*----------------------------------------------------------------------*/
    {
        //tamarind.artists.illicoDB.f_name.idx

        $bFound         = false;
        $szFile         = $this->determineDataFile();
        $szIndexFile    = $szFile . ".{$field}.idx";

        if ( isset( $this->indexHandles[ $szIndexFile ] ) )
        {
            $fh = $this->indexHandles[ $szIndexFile ];
            //var_dump( "Re-use handle" );
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
            //var_dump( $this->softseek );

            // LE SOFTSEEK NE FONCTIONNE PAS ENCORE !!!
            while ( true )
            {
                $oldIndex   = $index;
                $offset     = $recordSize * ( $index - 1 );

                fseek( $fh,$offset,SEEK_SET );

                $recno  = (int) fread( $fh,$recordSize );
                $FValue = trim( $this->GoTo( $recno )->$field );    /* value in the field */
                //var_dump( "COMPARING '{$needle}' AND '{$FValue}'" );
                //if ( ( $n = strcasecmp( $needle,$FValue ) ) === 0 || $this->softseek ? v::str_istarts_with( $FValue,$needle ) : false)

                // ATTENTION, IL FAUDRAIT QUE JE REMONTE AU PREMIER RECORD QUI MATCHE
                // CAR SI ON EST DANS TOUTE UNE SERIE QUI MATCHE, ALORS IL SE POURRAIT
                // BIEN QUE JE MATCHE EN PLEIN MILIEU DELA SERIE ET PAS AU PREMIER DE
                // LA SERIE !!!!
                // QUI PLUS EST ...
                // IL EST ENVISAGEABLE QUE JE VEUILLE MATCHER UN RECORD COMME
                // "Counting Crows/Vanessa Carlton" en recherchant "Vanessa Carlton"
                // ET AVEC UN INDEX ... JENE VAIS PAS LE TROUVER !!!

                if ( ( $n = strcasecmp( $needle,$FValue ) ) === 0 )
                {
                    $bFound = true;

                    //var_dump( "BEFORE FINDFIRST. RECNO={$recno}; INDEX={$index}; VALEUR={$FValue}" );
                    $recno = $this->findFirst( $fh,$needle,$field,$index,$recno );
                    //var_dump( "AFTER FINDFIRST. RECNO={$recno}; INDEX={$index}; VALEUR={$FValue}" );

                    //var_dump( "FOUND IN " . __METHOD__ . "()" );

                    // If we must return all successive matches
                    if ( is_array( $select ) )
                    {
                        //var_dump( "ON ME DEMANDE TOUS LES RESULTATS QUI MATCHENT" );
                        //var_dump( $this->$field );

                        $select[] = $recno;

                        while ( ! $this->eof() )
                        {
                            fseek( $fh,$recordSize,SEEK_CUR );
                            $recordNumber = (int) fread( $fh,$recordSize );
                            if ( v::STR_iPos( $this->GoTo( $recordNumber )->$field,$needle ) !== -1 )
                                $select[] = $recordNumber;
                            else
                                break;
                        }   /* while ( ! $this->eof() ) */

                        $this->GoTo( $recno );   /* Get back where we found the 1st match */
                    }
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
                    if ( $this->softseek )
                    {

                        if ( v::str_istarts_with( $FValue,$needle ) )
                        {
                            $bFound = true;
                            //var_dump( "'{$needle}' FOUND with softseek" );

                            if ( is_array( $select ) )
                            {
                                //var_dump( "ON ME DEMANDE TOUS LES RESULTATS QUI MATCHENT" );
                                //var_dump( $this->$field );

                                $select[] = $recno;

                                while ( ! $this->eof() )
                                {
                                    fseek( $fh,$recordSize,SEEK_CUR );
                                    $recordNumber = (int) fread( $fh,$recordSize );
                                    if ( v::STR_iPos( $this->GoTo( $recordNumber )->$field,$needle ) !== -1 )
                                        $select[] = $recordNumber;
                                    else
                                        break;
                                }   /* while ( ! $this->eof() ) */

                                $this->GoTo( $recno );   /* Get back where we found the 1st match */
                            }

                            break;
                        }
                    }

                    --$index;       /* Going 1 record backward - due to rounding when setting the new offset */
                    $offset = $recordSize * ( $index - 1 );
                    fseek( $fh,$offset,SEEK_SET );
                    $recno  = (int) fread( $fh,$recordSize );
                    $FValue = trim( $this->GoTo( $recno )->$field );    /* value in the field */

                    //var_dump( "PREVIOUS VALUE: " . $FValue . "; COMPARING '{$needle}' AND '{$FValue}'" );

                    if ( strcasecmp( $needle,$FValue ) === 0 )
                    {
                        // ICI, IL FAUT PEUT-ÊTRE REMONTER
                        $bFound = true;
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
            $this->die("INDEX FILE NOT OPEN");
        }

        //var_dump( $bFound );
        return ( $bFound );
    }   /* End of Table.seek() ======================================================== */
    /* ================================================================================ */


    // Méthode qui permet de remonter au premier match dans seek()
    protected function findFirst( $fh,$needle,$field,&$index,&$recno )
    /*--------------------------------------------------------------*/
    {
        if ( $fh )
        {
            $recordSize = 9;                /* 9 car chq record est écrit sur 9 bytes */

            //$offset     = $recordSize * ( $index - 1 );
            //fseek( $fh,$offset,SEEK_SET );

            $recNum     = $recno;
            $indexNum   = $index;

            $offset     = $recordSize * ( $indexNum - 1 );
            fseek( $fh,$offset,SEEK_SET );    /* Point to 1st match (already on there)*/

            $FValue = trim( $this->GoTo( $recNum )->$field );    /* value in the field */

            //var_dump( "START DU FINDFIRST. RECNO = {$recno}; INDEX = {$index}; RECNUM = {$recNum}; INDEXNUM = {$indexNum}" );

            // Je recule de 1 record
            fseek( $fh,-$recordSize,SEEK_CUR );

            // On y va record par record ... mais ce serait mieux d'y aller avec $low et $high
            while ( true )
            {
                $recNumber = (int) fread( $fh,$recordSize );
                $indexNum--;
                $FValue = trim( $this->GoTo( $recNumber )->$field );    /* value in the field */

                if ( ( $n = strcasecmp( $needle,$FValue ) ) !== 0 || ftell( $fh ) <= 0 )
                    break;
                else
                {
                    $recno = $recNumber;
                    $index = $indexNum;
                    fseek( $fh,-($recordSize * 2 ),SEEK_CUR );

                    //var_dump( "ITERATION FINDFIRST. RECNO = {$recno}; INDEX = {$index}; POS = " . ftell( $fh ) );
                }
            }

            //var_dump( "OUT" );
            //var_dump( $recno,$index,$FValue );

            $FValue     = trim( $this->GoTo( $recno )->$field );    /* value in the field */
        }

        return ( $recno );
    }   /* End of Table.findFirst() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*fromIndex( $field,$index,$howMany )=

        Get @param.howMany records from an index starting at @param.index position

        {*params
            $field      (string)    The name of the field (determine the name of the
                                    index to reach)
            $index      (int)       Index number (typically from a previous call to
                                    [c]@class.seek()[/c])
            $howMany    (int)       Optional count of records to return. [c]10[/c]
                                    by default
        *}

        {*return
            (array)     Array of [c]@param.howMany[/c] record numbers
        *}

        {*warning
            The Syntax as reported by the documentation is incorrect due to a
            bug in the Documentor.
        *}

        {*example
        $oDB = new IllicoDB();
        $oDB->open( 'Tamarind','d:/websites/trql.fm/www/httpdocs/playlists/Tamarind/' );
        $oDB->use( 'catalog' );

        $recno   = null;
        $index   = 0;
        $records = array();
        $needle  = 'What a fool believes';
        $field   = 'f_title';

        |** Perform a seek and get the index position where the record has been found **|
        if ( $oDB->catalog->seek( $needle,$field,$recno,$records[b],$index[/b] ) )
        {
            [b]if ( ( $aAdditional = $oDB->catalog->fromIndex( $field,$index,5 ) ) > 0 )
            {
                foreach( $Additional as $recNumber )
                {
                    var_dump( trim( $oDB->catalog->Goto( $recNumber )->f_title ) . ' by ' . trim( $oDB->catalog->f_creator ) );
                }
            }   |** if ( ( $aAdditional = $oDB->catalog->fromIndex( $field,$index,5 ) ) > 0 ) **|[/b]
        }
        *}

        *}}
    */
    /* ================================================================================ */
    public function fromIndex( $field,$index,$howMany = 10 )
    /*----------------------------------------------------*/
    {
        $aRetVal        = null;
        $szFile         = $this->determineDataFile();
        $szIndexFile    = $szFile . ".{$field}.idx";

        if ( isset( $this->indexHandles[ $szIndexFile ] ) )
        {
            $fh = $this->indexHandles[ $szIndexFile ];
            //var_dump( "Re-use handle" );
        }
        else
        {
            if ( $fh = fopen( $szIndexFile,'rb' ) )
                $this->indexHandles[ $szIndexFile ] = $fh;
        }

        if ( $fh )
        {
            $recordSize = 9;                /* 9 car chq record est écrit sur 9 bytes */
            $offset     = $recordSize * ( $index - 1 );
            fseek( $fh,$offset,SEEK_SET );

            for ( $i=0;$i < $howMany;$i++ )
            {
                $aRetVal[] = (int) fread( $fh,$recordSize );

                if ( $this->eof() )
                    break;
            }   /* for( $i=0;$i<$howMany,$i++ ) */
        }   /* if ( $fh ) */

        return ( $aRetVal );
    }   /* End of Table.seek() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*readStructure( $oDom,$oXPath,$oNode )=

        Read the structure of the table

        {*params
            $oDom           (DOMDocument)       The DOM Document that was used to read
                                                the DB structure
            $oXPath         (DOMXPath)          The XPath that was used when reading the
                                                DB structure
            $oNode          (DOMNode)           The node where the structure of the
                                                table gets defined
        *}

        {*return
            (self)      Current instance
        *}

        {*warning
            This method would be better if declared protected
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
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

                $oField->name           =              trim( $field->getAttribute( 'name'       ) );
                $oField->length         =              (int) $field->getAttribute( 'length'     );
                $oField->type           =  strtolower( trim( $field->getAttribute( 'type'       ) ) );
                $oField->description    =              trim( $field->getAttribute( 'desc'       ) );
                $oField->caption        =              trim( $field->getAttribute( 'caption'    ) );
                $oField->xmltag         =              trim( $field->getAttribute( 'xmltag'     ) );

                if ( $field->hasAttribute( 'offset' ) )
                    $oField->offset    =               (int) $field->getAttribute( 'offset'     );

                //var_dump( $oField->offset );

                if ( isset( $aFieldNames[$oField->name] ) )
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$oField->name}' duplicate field (ErrCode: EXCEPTION_DUPLICATE_FIELD = " . EXCEPTION_DUPLICATE_FIELD . ")",EXCEPTION_DUPLICATE_FIELD );
                else
                    $aFieldNames[$oField->name] = true;

                if ( ( $len = $this->fieldLength( $oField->type ) ) !== -EXCEPTION_INVALID_FIELD )
                {
                    if ( $oField->type === 'id' )
                    {
                        $this->idField = $oField; 

                        /* If length of 'id' field given */
                        if ( $oField->length !== 0 )
                            $len = -1;
                    }

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

        return ( $this );
    }   /* End of Table.readStructure() =============================================== */
    /* ================================================================================ */


    protected function closeHandles()
    /*-----------------------------*/
    {
        if ( ! is_null( $h = $this->readHandle     ) && is_resource( $h ) )
            fclose( $h );

        if ( ! is_null( $h = $this->writeHandle    ) && is_resource( $h ) )
            fclose( $h );

        if ( ! is_null( $h= $this->reccountHandle  ) && is_resource( $h ) )
            fclose( $h );

        if ( ! is_null( $h = $this->readMemoHandle ) && is_resource( $h ) )
            fclose( $h );

        if ( is_array( $this->indexHandles ) )
        {
            foreach( $this->indexHandles as $h )
                fclose( $h );
        }
    }   /* End of Table.closehandles() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*import( $szFile )=

        Import an XML file to create records. Existing records are updated, non-existing
        records are appended

        {*params
            $szFile     (string)        The name of the XML file to import
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*remark
            This methoid must be completely revisited in order to make sure it does
            not work only for tracks !!! Hihihi.
        *}

        *}}
    */
    /* ================================================================================ */
    public function import( $szFile,$indexField )
    /*-----------------------------------------*/
    {
        if ( ! isset( $this->fields[$indexField] ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$indexField}' is INVALID for a seek() operation (ErrCode: EXCEPTION_INVALID_FIELD = " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );

        if ( ! is_file( $szIndexFile = $this->determineDataFile() . ".{$indexField}.idx" ) )
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szIndexFile}' NOT found (ErrCode: EXCEPTION_FILE_NOT_FOUND = " . EXCEPTION_FILE_NOT_FOUND . ")",EXCEPTION_FILE_NOT_FOUND );

        if ( is_file( $szFile ) )                                   /* If the file to import can be found */
        {
            $oDom = new \DOMDocument();

            //var_dump( "ON VA TENTER D'IMPORTER {$szFile}" );

            if ( $oDom->load( $szFile ) )
            {
                $oXPath = new DOMXPath( $oDom );

                /* Let's find the parent tagname (e.g. "track/extension/compiled" -> "track") */
                foreach ( $this->fields as $fieldname => $field )
                {
                    if ( ! empty( $field->xmltag ) )
                    {
                        $szParentTag = explode( '/',$field->xmltag )[0];
                        break;
                    }   /* if ( ! empty( $field->xmltag ) ) */
                }   /* foreach ( $this->fields as $fieldname => $field ) */

                /* Extract all "records" from the XML file */
                if ( ( $oColl = $oXPath->query( "//{$szParentTag}" ) ) && $oColl->length > 0 )
                {
                    //var_dump( "FOUND TRACKS" );

                    foreach( $oColl as $node )
                    {
                        $record = null;
                        foreach ( $this->fields as $fieldname => $field )
                        {
                            //var_dump( $field );
                            //die();
                            if ( ! empty( $field->xmltag ) )
                            {
                                $tagName = str_replace( $szParentTag . '/','',$field->xmltag );
                                //if ( ( $x = $oXPath->query( $field->xmltag,$oNode ) ) && $x->length > 0 )
                                if ( ( $x = $oXPath->query( $tagName,$node ) ) && $x->length > 0 )
                                {
                                    //$record[$fieldname] = v::STR_padr( (string) $x->item(0)->nodeValue,$field->length,' ' );
                                    $record[$fieldname] = $x->item(0)->nodeValue;
                                }
                            }   /* if ( ! empty( $field->xmltag ) ) */
                        }   /* foreach ( $this->fields as $fieldname => $field ) */

                        {   /* $record est qlq chose comme ...
                            'f_compiled' => string '524547522d52475220-504f4b4f2d504b2020' (length=37)
                            'f_location' => string 'http://s3-eu-west-1.amazonaws.com/quitus-pat/quitus/pat/mp3-0bf37b0c03fedec25308a17584069e86' (length=92)
                            'f_title' => string 'Regret' (length=6)
                            'f_creator' => string 'Poco' (length=4)
                            'f_lang' => string 'en' (length=2)
                            'f_duration' => string '376722' (length=6)
                            'f_image' => string '' (length=0)
                            'f_preview' => string '' (length=0)
                            'f_href' => string '' (length=0)
                            'f_intro' => string '' (length=0)
                            'f_outro' => string '' (length=0)
                            'f_startAt' => string '' (length=0)
                            'f_endAt' => string 'DEFAULT_MIX_END_AT' (length=18)
                            'f_rating' => string '7' (length=1)
                            'f_plain' => string 'false' (length=5)
                            'f_volumeAdjustment' => string '' (length=0)
                            'f_fadeOut' => string '' (length=0)
                            'f_genre' => string 'pop/rock' (length=8)
                            'f_subgenre' => string '' (length=0)
                            'f_quarantine' => string '' (length=0)
                            'f_musicKey' => string '10B' (length=3)
                            'f_energy' => string '6' (length=1)
                            'f_bpm' => string '103' (length=3)
                            'f_instrumental' => string '' (length=0)
                            'f_prodYear' => string '2013' (length=4)
                            'f_dateAdded' => string '20210809111637' (length=14)
                            'f_role' => string '' (length=0)
                            'f_lyrics' => string '' (length=0)
                            'f_comment' => string '10B - Energy 6' (length=14)
                            'f_keywords' => string '' (length=0)
                            'f_style' => string '' (length=0)
                            'f_mood' => string '' (length=0)
                            'f_timing' => string '' (length=0)
                            'f_copyright' => string '' (length=0)
                            'f_rhythm' => string '' (length=0)
                            'f_file' => string 'Poco - All Fired Up - Regret___trql_9.mp3' (length=41)
                            */
                        }   /* $record est qlq chose comme ... */

                        $recno      = $select = $index = null;
                        $trackFound = $this->seek( trim( $record[$indexField] ),$indexField,$recno,$select,$index );

                        var_dump( "Here, there is a serious doubt about the use of idField(). Does it return a string (field name) or a Field object?" );

                        if ( ! is_null( $this->idField() ) )
                            $id = $this->idField()->name;           /* Name of the "id" field (if any) */

                        if ( ! $trackFound )
                        {
                            //var_dump( trim( $record[$indexField] ) . " NOT FOUND; SHOULD ADD A NEW RECORD" );
                            $this->append();
                            if ( ! is_null( $id ) )                 /* If there's an ID ... then we need to update it automatically */
                                $this->$id = null;                  /* Assign a new automatic ID */
                        }   /* if ( ! $trackFound ) */
                        else
                        {
                            //var_dump( trim( $record[$indexField] ) . " FOUND; SHOULD MODIFY AN EXISTING RECORD" );
                        }

                        /****************************************************************************/
                        /*  Instead of writing each field separately in the table, we shall compose */
                        /*  a long string representing the whole record and save it all at once.    */
                        /*  We do this for performance as it avoids multiple offsets calculation    */
                        /*  and moves of the internal file pointer.                                 */
                        /*                                                                          */
                        /*  Once done, we do basically the same thing with all the memo fields:     */
                        /*  we compose 1 record for all memo fields at once and write them all      */
                        /*  in one go instead of doing that for each field separately.              */
                        /****************************************************************************/

                        /* Prepare the buffer that will be written to the table (allocate memory) */
                        $haystack = str_repeat( ' ',$this->recordSize );

                        foreach( $this->offsets as $fieldname => $aField )
                        {
                            // Write a value of a given length at a given offset in a string
                            // The characters already present in the string are overwritten
                            // The length of the string is unchanged
                            if ( $aField['type'] !== 'memo' )
                                v::STR_insert2( $haystack,$record[$fieldname] ?? $this->$fieldname,$aField['offset'],$aField['length'] );
                        }   /* foreach( $this->offsets as $fieldname => $aField ) */

                        // Le seek() a positionné le recno au bon endroit
                        // Si le record n'a pas été trouvé, alors le append()
                        // a fait la même chose !
                        //var_dump( $haystack );

                        // Ici on prend une petite mesure de sécurité TEMPORAIRE
                        // On va tester qu'on a déjà trouvé le record sinon on risque
                        // d'écraser un autre !!! C'est TEMPORAIRE!

                        //if ( $trackFound )
                        {
                            $oldRecord = $this->readRawRecord();
                            //var_dump( $oldRecord,$haystack );
                            if ( $haystack != $oldRecord )
                            {
                                $this->writeRawRecord( $haystack );
                                //var_dump( "RECORD WRITTEN!" );
                            }
                            else
                            {
                                //var_dump( "No need to write the record: THEY ARE EQUAL" );
                            }
                        }   /* if ( $trackFound ) */


                        {   /* To write the memo ... We should build an array like ...
                            $aMemo = array( 'id'        => $szID                                ,
                                            'lyrics'    => $aData['lyrics'             ] ?? ''  ,
                                            'compiled'  => $aData['compiled'           ] ?? ''  ,
                                            'cover'     => $aData['cover'              ] ?? ''  ,
                                            'comment'   => $aData['comment'            ] ?? ''  ,
                                            'keywords'  => $aData['keywords'           ] ?? ''  ,
                                            'style'     => $aData['style'              ] ?? ''  ,
                                            'mood'      => $aData['mood'               ] ?? ''  ,
                                            'timing'    => $aData['timing'             ] ?? ''  ,
                                            'copyright' => $aData['copyright'          ] ?? ''  ,
                                            'role'      => $aData['role'               ] ?? ''  ,
                                            'lang'      => $aData['lang'               ] ?? ''  ,
                                            'rhythm'    => $aData['rhythm'             ] ?? ''  ,
                                            'preview'   => $aData['preview'            ] ?? ''  ,
                                            'file'      => $aData['file'               ] ?? ''  ,
                                          ); */
                        }   /* We should build an array like ... */


                        var_dump( "Here also, there is a serious doubt about the use of idField(). Does it return a string (field name) or a Field object?" );
                        $aMemo['id'] = $this->$id;

                        foreach ( $this->offsets as $fieldname => $aField )
                        {
                            if ( $aField['type'] === 'memo' )
                            {
                                if ( isset( $record[$fieldname] ) )
                                    $aMemo[$fieldname] = $record[$fieldname];
                                else
                                    $aMemo[$fieldname] = $this->$fieldname;
                            }   /* if ( $aField['type'] === 'memo' ) */
                        }   /* foreach ( $this->offsets as $fieldname => $aField ) */

                        //var_dump( "ENSEMBLE DU MEMO",$aMemo );

                        // MAIS ... PUTAIN ... CECI VA SIMPLEMENT S'ECIRE A LA FIN DU MEMO
                        // ET C'EST PAS CE QUE JE VEUX. IL FAUT REMPLACER LE RECORD S'IL
                        // EST TROUVÉ ET NON PAS SIMPLEMENT ÉCRIRE A LA FIN !!!

                        $this->writeRawMemo( $aMemo );
                        //var_dump( "========================" );
                    }   /* foreach( $oColl as $node ) */

                }   /* if ( ( $oColl = $oXPath->query( '//track' ) ) && $oColl->length > 0 ) */
            }   /* if ( $oDom->load( $szFile ) ) */
            else
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szFile}' CANNOT be loaded (ErrCode: EXCEPTION_CANNOT_LOAD_XML_FILE = " . EXCEPTION_CANNOT_LOAD_XML_FILE . ")",EXCEPTION_CANNOT_LOAD_XML_FILE );
        }   /* if ( is_file( $szFile ) ) */
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$szFile}' NOT found (ErrCode: EXCEPTION_FILE_NOT_FOUND = " . EXCEPTION_FILE_NOT_FOUND . ")",EXCEPTION_FILE_NOT_FOUND );

        return ( $this );
    }   /* End of Table.import() ====================================================== */
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
            case 'reccount'     :   $this->determineLengthOfDataFile(); /* $this->fileSize est mis à jour */
                                    return ( $this->reccount = (int) ( $this->fileSize / $this->recordSize ) );
            case 'record'       :   return ( $this->record() );
            case 'recno'        :   return ( $this->recno );
            case 'storage'      :   return ( $this->determineDataFile() );
            default             :   if ( isset( $this->offsets[$property] ) )
                                        return ( $this->read( $property ) );
                                    else
                                        //var_dump( $property,$this->offsets );
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
            case 'recno'    :
                {
                    if ( is_integer( $value ) )
                    {
                        if ( $value > 0 && $value <= $this->reccount )
                            $this->recno = $value;
                        else
                            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$value}' OUTSIDE permitted range (ErrCode: EXCEPTION_OUT_OF_RANGE = " .  EXCEPTION_OUT_OF_RANGE . ")",EXCEPTION_OUT_OF_RANGE );
                    }
                    else
                        throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$value}' is an INVALID value (ErrCode: EXCEPTION_INVALID_VALUE = " .  EXCEPTION_INVALID_VALUE . ")",EXCEPTION_INVALID_VALUE );
                }
                break;
            default         :
                {
                    if ( isset( $this->fields[$property] ) )
                    {
                        return ( $this->write( $property,$value ) );
                    }
                    else
                        throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: EXCEPTION_INVALID_PROPERTY = " . EXCEPTION_INVALID_PROPERTY . ")",EXCEPTION_INVALID_PROPERTY );
                }
                break;
        }
    }   /* End of Table.__set() ======================================================= */
    /* ================================================================================ */


    public function __toForm( $szType = 'track' ) : string
    /*---------------------------------------------------*/
    {
        $szHTML = '';

        // CECI N'A RIEN A VOIR AVEC ILLICODB !!!
        // CELA DOIT ETRE COMPLETEMENT GENERIQUE !!!


        switch( $szType )
        {
            case 'track'   :
                {
                    $oForm                      = new Form();
                    $oForm->szClass             = $this->szClass;
                    $oForm->szOnSubmit          = $this->szOnSubmit;


                    $oForm->settings['withBR']  = false;

                    {   /* Create a fieldset and add the field set to the form */
                        $oFieldset              = new Fieldset();
                        $oFieldset->szCaption   = 'Track';
                    }

                    //$record = $this->record();

                    //var_dump( $this->fields );

                    foreach ( $this->fields as $name => $field )
                    {
                        //var_dump( $field->name . ' ... ' . $field->type . ':' . $field->length );

                        $szInputType = 'txt';
                        $szCaption  = $name;

                        //if ( $field->type !== 'memo')
                        {
                            switch( $field->type )
                            {
                                case 'int'      :   $szInputType = 'num';
                                                    break;
                                case 'bool'     :   $szInputType = 'chk';
                                                    break;
                                case 'date'     :   $szInputType = 'dat';
                                                    break;
                                case 'datetime' :   $szInputType = 'datlocal';
                                                    break;
                                case 'memo'     :   $szInputType = 'edt';
                                                    break;
                                default         :   $szInputType = 'txt';
                            }

                            // Le dateAdded ne fonctionne pas bien !!!
                            //var_dump( $field );
                            if ( ! empty( $field->caption ) )
                                $szCaption = $field->caption;

                            //var_dump( $szCaption,$this->$name );

                            $oFieldset->add( new Input( array( 'name'           =>  $name                   ,
                                                               'type'           =>  $szInputType            ,
                                                               'label'          =>  " {$szCaption} "        ,
                                                               'lang'           =>  'en'                    ,
                                                               'tooltip'        =>  $field->description     ,
                                                               'required'       =>  false                   ,
                                                               'delete'         =>  true                    ,
                                                               'help'           =>  false                   ,
                                                               'value'          =>  trim( $this->$name )    ,
                                                             ) ) );
                        }
                    }

                    $oFieldset->add( new Input( array( 'name'           =>  'Submit'                        ,
                                                       'type'           =>  'cmd'                           ,
                                                       'class'          =>  'shadow'                        ,
                                                       'lang'           =>  'en'                            ,
                                                       'tooltip'        =>  'Click to submit the values'    ,
                                                       'value'          =>  ' Update '                      ,
                                                     ) ) );

                    $oForm->add( $oFieldset );
                    $szHTML = (string) $oForm;
                    goto end;
                }
                break;
        }

        end:
        return ( $szHTML );
    }   /* End of Table.__toForm() ==================================================== */
    /* ================================================================================ */


    public function __toHTML( $szType = 'record' ) : string
    /*---------------------------------------------------*/
    {
        $szHTML = '';

        end:
        return ( $szHTML );
    }   /* End of Table.__toHTML() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML( $szFile[,$type] )=

        Exports the data to an XML file

        {*params
            $szFile         (string)            Name of the target file
            $type           (string)            type of extract: [c]table[/c] or
                                                [c]reccord[/c] (default).
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*alias
            [c]export()[/c]
        *}

        {*seealso @fnc.import *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML( $szFile,$type = 'record' )
    /*-----------------------------------------------*/
    {
        $xml = '';

        switch( $type )
        {
            /* We need to export the entire table */
            case 'table'    :
                {
                    /* If we sucessfully created the output file */
                    if ( $fh = fopen( $szFile,"w+b" ) )
                    {
                        $szXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                        $szXML .= "<IllicoDB>\n";
                        $szXML .= "<table name=\"{$this->name}\" reccount=\"" . ( $reccount = $this->reccount() ) . "\" time=\"" . time(). "\" datetime=\"" . date( 'YmdHis' ) . "\">\n";

                        fwrite( $fh,$szXML );

                        /* Get the internal handle we use for reading */
                        if ( is_null( $this->readHandle ) )
                            $this->readHandle = fopen( $this->determineDataFile(),'r+b' );


                        // Attention ... le readHandle peut être celui d'une table antérieure
                        // et non celui de la table courante ni celui d'une view donnéee
                        // En tout cas ... la lecture des champs d'une view ne se passe pas
                        // correctement !

                        if ( $this->readHandle )                    /* If we have a valid handle */
                        {
                            $fpos = ftell( $this->readHandle ); /* Save file pointer */
                            fseek( $this->readHandle,0,SEEK_END );
                            $filesize = ftell( $this->readHandle );
                            //var_dump( "FILE SIZE: {$filesize}" );

                            fseek( $this->readHandle,0,SEEK_SET );  /* Go to BOF */

                            //var_dump( $this->offsets );
                            //$this->die();
                            $i = 1;
                            //var_dump( $this->offsets );

                            // ICI, IL Y A UNE ERREUR SI LA TABLE EST VIDE !!!
                            /* While NOT end of table (or view) */
                            while ( ! feof( $this->readHandle ) && $i <= $reccount )
                            {
                                $rawRecord = fread( $this->readHandle,$this->recordSize );
                                //var_dump( $rawRecord );

                                fwrite( $fh,"<record recno=\"" . $i++ . "\">\n" );

                                foreach( $this->fields as $fieldname => $wtf )
                                {
                                    //var_dump( $fieldname . ' ... ' . $this->offsets[$fieldname]['type'] . ':' . $this->offsets[$fieldname]['offset'] . ' on ' . $this->offsets[$fieldname]['length'] );
                                    if ( $this->offsets[$fieldname]['type'] !== 'memo' )
                                        $value = trim( substr( $rawRecord,$this->offsets[$fieldname]['offset']+1,$this->offsets[$fieldname]['length'] ) );
                                    else
                                        $value = $this->readMemo( $fieldname );
                                    fwrite( $fh,"<{$fieldname} type=\"{$this->offsets[$fieldname]['type']}\">" . htmlentities( $value,ENT_NOQUOTES | ENT_XML1 ) . "</{$fieldname}>\n" );
                                    //fwrite( $fh,"<{$fieldname} type=\"{$data['type']}\">" . $value . "</{$fieldname}>\n" );
                                }   /* foreach( $this->offsets as $fieldname => $data ) */
                                fwrite( $fh,"</record>\n\n" );
                                //if ( ftell( $this->readHandle ) >= $filesize )
                                //     break;
                            }   /* while( ! feof( $this->readHandle ) ) */
                            fwrite( $fh,"</table>\n" );
                            fwrite( $fh,"</IllicoDB>" );
                            fseek( $this->readHandle,$fpos,SEEK_SET );
                        }   /* if ( $this->readHandle ) */

                        fclose( $fh );
                        //var_dump( "End of table");
                    }   /* if ( $fh = fopen( $szFile,"w+b" ) ) */
                }
                break;
            /* This case should be treated as the general case:
                - table is goto record #1, extract #reccount records
                - record is goto current record, extract 1 record
                - records is goto current record, extract n records
            */
            case 'records'  :
                {
                    // THIS MUST BE PROGRAMMED!
                }
                break;
            /* We need to export a single record */
            case 'record'   :
            default         :
                {
                    /* If we sucessfully created the output file */
                    if ( $fh = fopen( $szFile,"w+b" ) )
                    {
                        $szXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                        $szXML .= "<IllicoDB>\n";
                        {   /* Table */

                            $szXML .= "<table name=\"{$this->name}\" reccount=\"" . $this->reccount() . "\" time=\"" . time(). "\" datetime=\"" . date( 'YmdHis' ) . "\">\n";

                            fwrite( $fh,$szXML );

                            /* Get the internal handle we use for reading */
                            if ( is_null( $this->readHandle ) )
                                $this->readHandle = fopen( $this->determineDataFile(),'r+b' );

                            if ( $this->readHandle )                    /* If we have a valid handle */
                            {
                                $fpos   = ftell( $this->readHandle );     /* Save file pointer */
                                $offset = ( $this->recordSize * ( $this->recno - 1 ) )  +
                                          1; /* +1 => because the 1st byte is the "deleted" mark */
                                fseek( $this->readHandle,$offset,SEEK_SET );
                                $rawRecord = fread( $this->readHandle,$this->recordSize );

                                fwrite( $fh,"<record recno=\"" . $this->recno() . "\">\n" );
                                    foreach( $this->offsets as $fieldname => $data )
                                    {
                                        $value = trim( substr( $rawRecord,$data['offset'],$data['length'] ) );
                                        fwrite( $fh,"<{$fieldname} type=\"{$data['type']}\">" . htmlentities( $value,ENT_NOQUOTES | ENT_XML1 ) . "</{$fieldname}>\n" );
                                    }   /* foreach( $this->offsets as $fieldname => $data ) */
                                fwrite( $fh,"</record>\n\n" );
                            }   /* if ( $this->readHandle ) */
                            fwrite( $fh,"</table>\n" );
                        }   /* Table */
                        fwrite( $fh,"</IllicoDB>" );
                        fseek( $this->readHandle,$fpos,SEEK_SET );

                        fclose( $fh );
                    }   /* if ( $fh = fopen( $szFile,"w+b" ) ) */
                }
        }   /* switch( $type ) */

        end:
        return ( $this );
    }   /* End of Table.__toXML() ===================================================== */
    public function export( $szFile ) { return ( $this->__toXML( $szFile ) ); }
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
        $this->closeHandles();
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of Table.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Table ============================================================= */
/* ==================================================================================== */


class View extends Table
/*--------------------*/
{
    // Fatal error: Uncaught Exception: trql\quitus\Table::readStructure() at line 3483: '' is NOT a valid field type (ErrCode: EXCEPTION_INVALID_FIELD_TYPE = 1010) in D:\websites\snippet-center\trql.illicodb.class.php on line 3483
    // Ce qui est normal PUISQUE je dois inférer le type d'un champ sur base de sa définition dans table (une vue dépend d'une table ... et c'est dans la table que le type de champ est défini)

    public $parentTable = null;
    public $filesize    = -1;

    /* ================================================================================ */
    /** {{*__construct( $parentTable,$name )=

        Class constructor

        {*params
            $parentTable    (Table)         The table this view is based on
            $name           (string)        The name of the view
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $parentTable,$name )
    /*---------------------------------------------*/
    {
        //parent::__construct( $parentTable->container,$parentTable->name );
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        $this->name         = $name;                    /* View name */
        $this->parentTable  = $parentTable;             /* the table the view is based on */

        $this->container    = $this->parentTable->container;

        $szDBFile = strtolower( v::FIL_addBS( $this->container->homeOfData ) . $this->container->name . '.illicoDB' );
        //var_dump( __METHOD__,$szDBFile );

        if ( is_file( $szDBFile ) )                                 /* If DB file found */
        {
            //var_dump( "Dans le __construct d'une VIEW" );
            $oDom = new \DOMDocument();

            if ( $oDom->load( $szDBFile ) )                         /* If we could load the DB file */
            {
                //var_dump( "DOM loaded" );
                $oXPath = new \DOMXPath( $oDom );
                //var_dump( "XPath created","views/view[@name='{$name}']" );

                if ( ( $tableCollection = $oXPath->query( "views/view[@name='{$name}']" ) ) && ( $tableCollection->length > 0 ) )
                {
                    $this->readStructure( $oDom,$oXPath,$tableCollection->item(0) );
                }

                $this->recno        = 0;
                $this->fileSize     = $this->parentTable->fileSize;
                $this->recordSize   = $this->parentTable->recordSize;
                $this->reccount     = $this->parentTable->reccount;
                $this->offsets      = $this->parentTable->offsets;

            }
            else
                // EXCEPTION

            var_dump( $this->name,$this->fileSize,$this->recordSize,$this->reccount );
        }
        else
            // EXCEPTION


        return ( $this );
    }   /* End of View.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*readStructure( $oDom,$oXPath,$oNode )=

        Read the structure of the view

        {*params
            $oDom           (DOMDocument)       The DOM Document that was used to read
                                                the DB structure
            $oXPath         (DOMXPath)          The XPath that was used when reading the
                                                DB structure
            $oNode          (DOMNode)           The node where the structure of the
                                                table gets defined
        *}

        {*return
            (self)      Current instance
        *}

        {*warning
            This method would be better if declared protected
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
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
                $oField->name           = trim( $field->getAttribute( 'name'       ) );

                if ( isset( $this->parentTable->fields[$oField->name] ) )
                {
                    $theParentField         = $this->parentTable->fields[$oField->name];

                    $oField->length         = $theParentField->length;
                    $oField->type           = $theParentField->type;
                    $oField->description    = $theParentField->description;
                    $oField->caption        = $theParentField->caption;
                    $oField->xmltag         = $theParentField->xmltag;
                    $oField->offset         = $theParentField->offset;

                    $this->fields[$oField->name]  = $oField;
                }
                else
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$oField->name}' ... FIELD NOT FOUND (ErrCode: EXCEPTION_INVALID_FIELD = " . EXCEPTION_INVALID_FIELD . ")",EXCEPTION_INVALID_FIELD );
            }   /* foreach ( $fieldCollection as $field ) */

            $this->idField          = $this->parentTable->idField;
            $this->offsets          = $this->parentTable->offsets;
            $this->recordSize       = $this->parentTable->recordSize;
        }   /* if ( ( $fieldCollection = $oXPath->query( 'field',$oNode ) ) && ( $fieldCollection->length > 0 ) ) */

        return ( $this );
    }   /* End of View.readStructure() ================================================ */
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
            $this->storage = v::FIL_addBS( $this->container->homeOfData ) . strtolower( trim( $this->container->name    ) ) . '.' .
                                                                            strtolower( trim( $this->parentTable->name  ) ) . '.illicoDB';

        return ( $this->storage );
    }   /* End of View.determineDataFile() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor.

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
    }   /* End of Table.__destruct() ================================================== */
}

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
    public      $caption                    = null;                 /* {*property   $caption                    (string)                Caption of the field (typically used in the [c]__toForm()[/c] method) *} */
    public      $xmltag                     = null;                 /* {*property   $xmltag                     (string)                XML node name to support import/export from and to XML *} */

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