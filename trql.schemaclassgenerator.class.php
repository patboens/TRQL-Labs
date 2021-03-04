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
    {*file                  trql.schemaclassgenerator.class.php *}
    {*purpose               Class Generator (schema.org based)  *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-20 08:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    {*abstract              schema.org features a whole set of useful classes.[br][br]

                            Such classes, but not all, are interesting to TRQL Labs.[br][br]

                            Up to 24-08-20 08:45, such interesting classes were created
                            manually, one by one, prioritized by our only interest.[br][br]

                            The present class is a helper: it generates the file of a class
                            as defined in schema.org BUT the file will still have to be
                            edited manually after.
    *}

    {*todo                  [ol]
                                [li]Read the schema.org types[/c][/li]
                                [li]Read the schema.org properties[/c][/li]
                            [/ol]
    *}

    {*remark

        Such declarations should be made available in the php.ini file.

        Unfortunately, I don't know why, PHP overwrites these settings
        each time it gets restarted. That's the reason why I have documented
        them in here.

        [code]
            [Date]
            ; Defines the default timezone used by the date functions
            ; http://php.net/date.timezone
            date.timezone ="Europe/Brussels"

            ; http://php.net/date.default-latitude
            date.default_latitude = 50.3852051

            ; http://php.net/date.default-longitude
            date.default_longitude = 4.6582953
        [/code]

        geonames can be invoked with these values:
            [url]http://api.geonames.org/timezone?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]

        geonameId de Lato Sensu Management:
            [url]http://api.geonames.org/findNearby?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]
            [url]http://api.geonames.org/get?geonameId=8520400&username=demo&style=full[/url]

    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-20 08:50 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schemaclassgenerator;

use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\csv\CSV                                   as CSV;
use \trql\xml\XML                                   as XML;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'THING_ABSTRACT_CLASS' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CSV_CLASS_VERSION' ) )
    require_once( 'trql.csv.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

defined( 'SCHEMACLASSGENERATOR_CLASS_VERSION' ) or define( 'SCHEMACLASSGENERATOR_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SchemaClassGenerator=

    {*desc

        Automatic Class generation from schema.org definition

    *}

    *}}
 */
/* ==================================================================================== */
class SchemaClassGenerator extends Utility
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $aProperties    = null;
    public      $aClasses       = null;

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent *} */

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
    }   /* End of SchemaClassGenerator.__construct() ================================== */
    /* ================================================================================ */


    public function generate( $szClass )
    /*--------------------------------*/
    {
        static $oCSV = null;

        if ( is_null( $oCSV ) )
        {
            $oCSV = new CSV();
        }

        if ( is_null( $this->aProperties ) )
        {
            //$aRetVal = $oCSV->read( "c:/Users/patri/Downloads/schemaorg-current-http-properties.csv" );
            //$aRetVal = $oCSV->read( "c:/Users/patri/Downloads/schemaorg-properties.trql.csv" );
            //var_dump( $aRetVal );

            $oDom = new DOMDocument();


            /* Pour constituer le nouveau XML :

                Charger schemaorg-properties.xml
                Extraire toutes les <Property>
                Pour chaque property, lire le label et lire les rangeIncludes
                Faire une string des rangeIncludes (il peut y en avoir plus d'1 par Property (séparateur = |)
                Faire une array : key = le label, value = la string des rangeIncludes

                Quand j'ai cela, je parcours l'ancien XML et pour chaque entrée (label),
                si son TRQLType est "string", alors ... prendre celui dans l'array qui vient
                du RDF

                Quand c'est fini ... XML->__toXML()

                Puis ... modification manuelle du XML ET ... je suis prêt pour lancer la
                création de TOUTES les classes AUTOMATIQUEMENT

            */

            // code to create updated XML ... if ( $oDom->load( vaesoli::FIL_RealPath( __DIR__ . "/schemaorg-properties.xml" ) ) )
            // code to create updated XML ... {
            // code to create updated XML ...     $oXPath = new DOMXPath( $oDom );
            // code to create updated XML ...     var_dump( "LOADED");
            // code to create updated XML ...
            // code to create updated XML ...     if ( ( $oColl = $oXPath->query( "//Property" ) ) && $oColl->length > 0 )
            // code to create updated XML ...     {
            // code to create updated XML ...         //var_dump( $oColl->length . " properties found" );
            // code to create updated XML ...         foreach( $oColl as $oNode )
            // code to create updated XML ...         {
            // code to create updated XML ...             if ( ( $oTypesColl = $oXPath->query( 'rangeIncludes',$oNode ) ) && ( $oTypesColl->length > 0 ) )
            // code to create updated XML ...             {
            // code to create updated XML ...                 //var_dump( 'PROPERTY: ' . $oNode->getAttribute( 'about' ) );
            // code to create updated XML ...                 $szTypes = '';
            // code to create updated XML ...
            // code to create updated XML ...                 foreach ( $oTypesColl as $oTypeNode )
            // code to create updated XML ...                 {
            // code to create updated XML ...                     //var_dump( $oTypeNode->getAttribute( 'resource' ) );
            // code to create updated XML ...                     $szType = str_ireplace( 'http://schema.org/','',$oTypeNode->getAttribute( 'resource' ) );
            // code to create updated XML ...                     if     ( $szType === 'Text' )
            // code to create updated XML ...                         $szType = 'string';
            // code to create updated XML ...                     elseif ( $szType === 'Number' )
            // code to create updated XML ...                         $szType = 'float';
            // code to create updated XML ...                     elseif ( $szType === 'Boolean' )
            // code to create updated XML ...                         $szType = 'boolean';
            // code to create updated XML ...                     elseif ( $szType === 'Integer' )
            // code to create updated XML ...                         $szType = 'int';
            // code to create updated XML ...
            // code to create updated XML ...                     $szTypes .= $szType . '|';
            // code to create updated XML ...                 }
            // code to create updated XML ...                 $aNewProperties[str_ireplace( 'http://schema.org/','',$oNode->getAttribute( 'about' ) )] = vaesoli::STR_strin( $szTypes );
            // code to create updated XML ...             }
            // code to create updated XML ...         }
            // code to create updated XML ...     }
            // code to create updated XML ... }
            // code to create updated XML ...
            // code to create updated XML ... ksort( $aNewProperties );
            // code to create updated XML ... //var_dump( $aNewProperties );
            // code to create updated XML ...
            // code to create updated XML ... require_once( vaesoli::FIL_ResolveRoot( "/vaesoli/include/LSCursor.class.php" ) );
            // code to create updated XML ... $oCursor = new \LSCursor( "OldData",vaesoli::FIL_RealPath( __DIR__ . "/schemaorg-properties.trql.xml" ) );
            // code to create updated XML ... if ( $oCursor->Open() )
            // code to create updated XML ... {
            // code to create updated XML ...     var_dump( $oCursor );
            // code to create updated XML ...     foreach( $aNewProperties as $szProperty => $szTypes )
            // code to create updated XML ...     {
            // code to create updated XML ...         if ( $bFound = $oCursor->Seek( 'label',$szProperty ) )
            // code to create updated XML ...         {
            // code to create updated XML ...             var_dump( "PROPERTY: " . $oCursor->Field('label') );
            // code to create updated XML ...             var_dump( "OLD TYPE: " . $oCursor->Field('TRQLType') );
            // code to create updated XML ...             var_dump( "NEW TYPE: " . $szTypes );
            // code to create updated XML ...             $oCursor->Replace( 'TRQLType',$szTypes,$bCDATA = true );
            // code to create updated XML ...             var_dump( "CHANGED TO: " . $oCursor->Field('TRQLType') );
            // code to create updated XML ...         }
            // code to create updated XML ...     }
            // code to create updated XML ...
            // code to create updated XML ...     if ( $oCursor->Dirty() )
            // code to create updated XML ...     {
            // code to create updated XML ...         $oCursor->save( $oCursor->szDataSource . '.new.xml' );
            // code to create updated XML ...     }
            // code to create updated XML ...
            // code to create updated XML ...     $oCursor->Close();
            // code to create updated XML ... }
            // code to create updated XML ...
            // code to create updated XML ...
            // code to create updated XML ... $this->die( "STOP HERE" );


            if ( $oDom->load( vaesoli::FIL_RealPath( __DIR__ . "/schemaorg-properties.trql.xml" ) ) )
            {
                //var_dump( "XML Loaded" );
                $oXPath = new DOMXPath( $oDom );

                if ( ( $oColl = $oXPath->query( "//Property" ) ) && $oColl->length > 0 )
                {
                    //var_dump( $oColl->length . " properties found" );
                    foreach( $oColl as $oNode )
                    {
                        $szID               = $this->subTag( $oXPath,$oNode,'id'                    );
                        $szLabel            = $this->subTag( $oXPath,$oNode,'label'                 );
                        $szComment          = $this->subTag( $oXPath,$oNode,'comment'               );
                        $szTypes            = $this->subTag( $oXPath,$oNode,'TRQLType'              );

                        //$subPropertyOf      = $this->subTag( $oXPath,$oNode,'subPropertyOf'         );
                        //$equivalentProperty = $this->subTag( $oXPath,$oNode,'equivalentProperty'    );
                        //$subproperties      = $this->subTag( $oXPath,$oNode,'subproperties'         );
                        //$domainIncludes     = $this->subTag( $oXPath,$oNode,'domainIncludes'        );
                        //$rangeIncludes      = $this->subTag( $oXPath,$oNode,'rangeIncludes'         );
                        //$inverseOf          = $this->subTag( $oXPath,$oNode,'inverseOf'             );
                        //$supersedes         = $this->subTag( $oXPath,$oNode,'supersedes'            );
                        //$supersededBy       = $this->subTag( $oXPath,$oNode,'supersededBy'          );
                        //$isPartOf           = $this->subTag( $oXPath,$oNode,'isPartOf'              );

                        $this->aProperties[$szLabel] = array( 'id'       => $szID                                               ,
                                                              'label'    => $szLabel                                            ,
                                                              'comment'  => vaesoli::STR_Reduce( strip_tags( $szComment ),' ' ) ,
                                                              'types'    => $szTypes                                            ,
                                                            );
                    }   /* foreach( $oColl as $oNode ) */
                }   /* if ( ( $oColl = $oXPath->query( "//Property" ) ) && $oColl->length > 0 ) */
            }   /* if ( $oDom->load( "c:/Users/patri/Downloads/schemaorg-properties.trql.xml" ) ) */

            //var_dump( $this->aProperties );
            //$szXML = $oXML->__toXML( $aRetVal['records'],"SchemaProperties" );
            //    vaesoli::FIL_StrToFile( $szXML,"c:/Users/patri/Downloads/schemaorg-properties.trql.xml" );

            //die();

            //if ( $h = fopen( "c:/Users/patri/Downloads/schemaorg-current-http-properties.csv",'r ') )
            //{
            //    if ( $h2 = fopen( "c:/Users/patri/Downloads/schemaorg-properties.trql.csv","w+" ) )
            //    {
            //        var_dump( "OK" );
            //        while ( ! feof( $h ) )
            //        {
            //            $szLine = str_replace( array("\r","\n"),'',fgets( $h,4096 ) );
            //            //var_dump( $szLine );
            //            fwrite( $h2,$szLine . ",\"string\"\n" );
            //        }
            //        fclose( $h2 );
            //    }
            //    fclose( $h );
            //}
            //
            //die('DIE HERE');
        }

        if ( is_null( $this->aClasses ) )
        {
            //$aRetVal = $oCSV->read( "c:/Users/patri/Downloads/schemaorg-current-http-types.csv" );
            ////var_dump( $aRetVal );
            //
            //$oXML = new XML();
            //$szXML = $oXML->__toXML( $aRetVal['records'],"SchemaClasses" );
            //    vaesoli::FIL_StrToFile( $szXML,"c:/Users/patri/Downloads/schemaorg-classes.trql.xml" );

            if ( $oDom->load( vaesoli::FIL_RealPath( __DIR__ . "/schemaorg-classes.trql.xml" ) ) )
            {
                //var_dump( "XML Loaded" );
                $oXPath = new DOMXPath( $oDom );

                if ( ( $oColl = $oXPath->query( "//Class" ) ) && $oColl->length > 0 )
                {
                    //var_dump( $oColl->length . " classes found" );
                    foreach( $oColl as $oNode )
                    {
                        $szID           = $this->subTag( $oXPath,$oNode,'id' );
                        $szLabel        = $this->subTag( $oXPath,$oNode,'label' );
                        $szComment      = $this->subTag( $oXPath,$oNode,'comment' );
                        $szExtends      = $this->subTag( $oXPath,$oNode,'subTypeOf' );
                        $szProperties   = $this->subTag( $oXPath,$oNode,'properties' );

                        $this->aClasses[$szLabel] = array( 'id'         => $szID                                               ,
                                                           'label'      => $szLabel                                            ,
                                                           'comment'    => vaesoli::STR_Reduce( strip_tags( $szComment ),' '   ),
                                                           'extends'    => str_ireplace( 'http://schema.org/','',$szExtends    ),
                                                           'properties' => str_ireplace( 'http://schema.org/','',$szProperties ),
                                                         );
                    }   /* foreach( $oColl as $oNode ) */
                }   /* if ( ( $oColl = $oXPath->query( "//Property" ) ) && $oColl->length > 0 ) */
            }   /* if ( $oDom->load( "c:/Users/patri/Downloads/schemaorg-properties.trql.xml" ) ) */
        }

        /* Si j'ai trouvé la classe que je cherche */
        if ( isset( $this->aClasses[$szClass] ) )
        {
            $aClassDef = $this->aClasses[$szClass];
            //var_dump( $aClassDef );
            $szClassSrcCode     = vaesoli::FIL_FileToStr( __DIR__ . '/trql.schemaclassgenerator.template.txt' );

            $szFilename         = vaesoli::FIL_RealPath( __DIR__ . '/trql.' . strtolower( $szClass ) . '.class.php' );
            $szPurpose          = $aClassDef['comment'];
            $szCDate            = date( 'd-m-Y H:i' );
            $szProperties       = '';
            $szExtends          = $aClassDef['extends'] ?? 'Thing';

            if ( empty( $szExtends ) )
            {
                var_dump( "'{$szClass}' n'a pas d'EXTENDS ... ce qui est curieux, donc on arrête la génération de cette classe" );
                goto end;
            }

            $szDefineExtends    = "if ( ! defined( '" . strtoupper( $szExtends ) . "_CLASS_VERSION' ) )\n" .
                                  "    require_once( 'trql." . strtolower( $szExtends ) . ".class.php' );\n\n";

            $aProperties    = explode( ',',$aClassDef['properties'] );

            foreach( $aProperties as $szProperty )
            {
                $szProperty = trim( $szProperty );
                $szPropDesc = null;

                if ( isset( $this->aProperties[$szProperty] ) )
                {
                    $szPropDesc = $this->aProperties[$szProperty]['comment'];
                    $szPropType = $this->aProperties[$szProperty]['types'];
                }

                $szFullDesc = trim( preg_replace('/^/sim',str_repeat( ' ',148 ),wordwrap( strip_tags( $szPropDesc ),70 ) ) );

                $szProperties .= '    public      $' . vaesoli::STR_padr( $szProperty,30 ) . ' = null;             /* {*property   $' . vaesoli::STR_padr( $szProperty,31 ) . vaesoli::STR_padr( '(' . $szPropType . ')',32 ) . $szFullDesc . ' *} */' . "\n";
            }

            // CODE EXPERIMENTAL ======================================================
            // On va tenter de créer un code standard de WebForm - Ce code devra
            //  vraisemblablement TOUJOURS être modifié manuellement après génération
            $szWebForm = '';
            //var_dump( $aProperties );

            if ( is_array( $aProperties ) && count( $aProperties ) > 0 )
            {
                $szWebForm = "\n<form action='' id='frm{$szClass}'>\n";
                foreach( $aProperties as $szProperty )
                {
                    $szProperty = trim( $szProperty );

                    // Il faut qu'on puisse être plus intelligent pour
                    //      - le 'type'
                    //      - le 'required'
                    //      - le 'placeholder'
                    //      - le 'readonly'
                    //      - le 'name' (précéder le nom de 3 lettres en fonction du type - e.g. 'edt' ou 'txt' ou 'num' ...)
                    $szWebForm .= "    <input type='text' name='{$szProperty}' id='{$szProperty}' value='' />\n";
                }
                $szWebForm .= "</form> <!-- End of #frm{$szClass} -->\n";
            }

            //echo $szWebForm;

            // FIN CODE EXPERIMENTAL ==================================================
            //$this->die( "STOP APRES CODE EXPERIMENTAL DE CREATION DE WEBFORM");

            //var_dump( $szFilename );

            //
            //trim( preg_replace('/^/sim',str_repeat( ' ',8  ),wordwrap( strip_tags( $szPurpose ),75 ) ) ),

            $aSubsts = array( '{FILENAME}'              ,   /* 01 */
                              '{PURPOSE}'               ,   /* 02 */
                              '{PURPOSE_60}'            ,   /* 02b */
                              '{PURPOSE_75}'            ,   /* 02c */
                              '{CDATE}'                 ,   /* 03 */
                              '{CLASS_PROPERTIES}'      ,   /* 04 */
                              '{CLASS_EXTENDS}'         ,   /* 05 */
                              '{CLASS_EXTENDS_L}'       ,   /* 06 */
                              '{DEFINE_EXTENDS}'        ,   /* 07 */
                              '{CLASS_ID}'              ,   /* 08 */
                              '{CLASS_NAME}'            ,   /* 09 */
                              '{CLASS_NAME_U}'          ,   /* 10 */
                              '{CLASS_NAME_L}'          ,   /* 11 */
                            );
            $aReplas = array( basename( $szFilename )   ,   /* 01 */
                              $szPurpose                ,   /* 02 */
                              trim( preg_replace('/^/sim',str_repeat( ' ',28 ),wordwrap( $szPurpose,60 ) ) ),   /* 02b */
                              trim( preg_replace('/^/sim',str_repeat( ' ',8  ),wordwrap( $szPurpose,75 ) ) ),   /* 02c */
                              $szCDate                  ,   /* 03 */
                              $szProperties             ,   /* 04 */
                              $szExtends                ,   /* 05 */
                              strtolower( $szExtends )  ,   /* 06 */
                              $szDefineExtends          ,   /* 07 */
                              $aClassDef['id']          ,   /* 08 */
                              $szClass                  ,   /* 09 */
                              strtoupper( $szClass )    ,   /* 10 */
                              strtolower( $szClass )    ,   /* 11 */
                            );

            $szClassSrcCode = str_replace( $aSubsts,$aReplas,$szClassSrcCode );


            /*
                On peut travailler avec des lignes variables de fin de méthode
                ou de classe du style:

                START_COMMENT End of COMMENT_UNTIL_END_OF_LINE({CLASS_NAME}.__destruct()) STOP_COMMENT

            */

            //if ( preg_match_all( '/COMMENT_UNTIL_END_OF_LINE\((?P<variable>.*)/i',$szClassSrcCode,$aMatches,PREG_PATTERN_ORDER ) )
            //{
            //    var_dump( $aMatches );
            //}

            //if ( preg_match( '/COMMENT_UNTIL_END_OF_LINE\((?P<var>.*)\)/i',$szClassSrcCode,$aMatches ) )
            //{
            //    var_dump( $aMatches );
            //    $szPart = $aMatches['var'];
            //    $szClassSrcCode = str_replace( $aMatches[0],vaesoli::STR_padr( $szPart,69,'=' ),$szClassSrcCode ) . '*/';
            //    echo htmlentities( $szClassSrcCode,ENT_QUOTES );
            //}

            //die();

            if ( ! is_file( $szFilename ) )
            {
                if ( vaesoli::FIL_StrToFile( $szClassSrcCode,$szFilename ) )
                    echo __LINE__,'... ',$szFilename,' CREATED' . $this->nl();
            }
            else
            {
                echo __LINE__,'... <code>',$szFilename,'</code> ALREADY EXIST' . $this->nl();
            }

            end:
            //echo "<pre>",$szClassSrcCode,"</pre>";
        }
    }   /* End of SchemaClassGenerator.generate() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of SchemaClassGenerator.__destruct() =================================== */
    /* ================================================================================ */
}   /* End of class SchemaClassGenerator ============================================== */
/* ==================================================================================== */
?>