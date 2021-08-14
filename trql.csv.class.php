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
    {*file                  trql.csv.class.php *}
    {*purpose               CSV set of services *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-20 07:34 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    {*warning

    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-20 07:34 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\csv;


use \trql\quitus\Mother                             as Mother;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'CSV_CLASS_VERSION' ) or define( 'CSV_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CSV=

    {*desc

        CSV-oriented services

    *}


    *}}
 */
/* ==================================================================================== */
class CSV extends Utility
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of CSV.__construct() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*read( $szFile )=

        Reads a CSV file

        {*params
            $szFile     (string)        Filename
        *}

        {*return
            (array)     An associative array:[br]

                        array( "fields"  => an array of field names ,
                               "records" => an array of records     ,
                             );
        *}

        {*example
            use \trql\csv\CSV as CSV;

            if ( ! defined( 'CSV_CLASS_VERSION' ) )
                require_once( 'trql.csv.class.php' );

            $o = new CSV();

            var_dump( $o->read( "c:/Users/patri/Downloads/schemaorg-current-http-types.csv" ) );
        *}

        *}}
    */
    /* ================================================================================ */
    public function read( $szFile )
    /*---------------------------*/
    {
        $aRetVal = null;

        if ( ( $handle = fopen( $szFile,"r" ) ) !== false )         // Open the file in read-only mode
        {
            //var_dump( "FILE OPEN" );
            $iLine      = 1;                                        // Ligne courante du fichier de données
            $aFields    = null;                                     // Ensemble de champs du fichier .CSV

            $aData      = null;                                     // Tous les records
            $aHeaders   = null;                                     // Les noms des champs
            $aTheData   = null;                                     // Les champs d'1 record

            while ( ( $aFields = fgetcsv( $handle,1000,',') ) !== false )   // Lisons tous les champs
            {
                $iFields = count( $aFields );                    // Comptons le nombre de champs (avec le temps, la structure du fichier .CSV a évolué ... et donc le nb de champs n'est pas toujours le même)

                if ( $iFields > 0 && $iLine === 1 )                 // Si on est sur la première ligne (c'est la ligne du nom des champs)
                {
                    $aHeaders = $aFields;
                    //var_dump( $aHeaders );
                    //die();
                }
                else                                                // Si on est après la ligne 1
                {
                    //if ( $iFields != 12 )
                    //    var_dump( "NOT 12 FIELDS IN",$aFields );

                    foreach ( $aHeaders as $szField )
                    {
                        $aTheData[$szField] = null;
                    }

                    for ( $i = 0;$i < $iFields;$i++ )               // Remplissons les données 1 à 1
                    {
                        $aTheData[$aHeaders[$i]] = $aFields[$i];
                    }

                    $aData[] = $aTheData;                           // OK ... sauvons ce qu'on a capturé sur cette ligne de données
                }

                ++$iLine;
            }   /* while ( ( $aFields = fgetcsv( $handle,1000,',') ) !== false ) */

            fclose( $handle );                                      // Close the file

            //var_dump( "FILE READ" );

            $aRetVal = array( "fields"  => $aHeaders,
                              "records" => $aData   ,
                            );

        }   /* if ( ( $handle = fopen( $szFile,"r" ) ) !== false ) */

        return ( $aRetVal );
    }   /* End of CSV.read() ========================================================== */
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
    }   /* End of CSV.__destruct() ==================================================== */
    /* ================================================================================ */

}   /* End of class CSV =============================================================== */
/* ==================================================================================== */
?>