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
    {*file                  trql.dataset.class.php *}
    {*purpose               A body of structured information describing some topic(s) of
                            interest. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel �t� sous le h�tre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\dataset;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\CreativeWork    as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'DATASET_CLASS_VERSION' ) or define( 'DATASET_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Dataset=

    {*desc

        A body of structured information describing some topic(s) of interest.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Dataset[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

    *}}
 */
/* ==================================================================================== */
class Dataset extends CreativeWork
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $distribution                   = null;             /* {*property   $distribution                   (DataDownload)                  A downloadable form of this dataset, at a specific location, in a
                                                                                                                                                    specific format. *} */
    public      $includedInDataCatalog          = null;             /* {*property   $includedInDataCatalog          (DataCatalog)                   A data catalog which contains this dataset. *} */
    public      $issn                           = null;             /* {*property   $issn                           (string)                        The International Standard Serial Number (ISSN) that identifies this
                                                                                                                                                    serial publication. You can repeat this property to identify different
                                                                                                                                                    formats of, or the linking ISSN (ISSN-L) for, this serial publication. *} */
    public      $measurementTechnique           = null;             /* {*property   $measurementTechnique           (URL|string)                    A technique or technology used in a Dataset (or DataDownload,
                                                                                                                                                    DataCatalog),corresponding to the method used for measuring the
                                                                                                                                                    corresponding variable(s) (described using variableMeasured). This is
                                                                                                                                                    oriented towards scientific and scholarly dataset publication but may
                                                                                                                                                    have broader applicability; it is not intended as a full
                                                                                                                                                    representation of measurement, but rather as a high level summary for
                                                                                                                                                    dataset discovery.For example, if variableMeasured is: molecule
                                                                                                                                                    concentration, measurementTechnique could be: "mass spectrometry" or
                                                                                                                                                    "nmr spectroscopy" or "colorimetry" or "immunofluorescence".If the
                                                                                                                                                    variableMeasured is "depression rating", the measurementTechnique
                                                                                                                                                    could be "Zung Scale" or "HAM-D" or "Beck Depression Inventory".If
                                                                                                                                                    there are several variableMeasured properties recorded for some given
                                                                                                                                                    data object, use a PropertyValue for each variableMeasured and attach
                                                                                                                                                    the corresponding measurementTechnique. *} */
    public      $variableMeasured               = null;             /* {*property   $variableMeasured               (PropertyValue|string)          The variableMeasured property can indicate (repeated as necessary) the
                                                                                                                                                    variables that are measured in some dataset, either described as text
                                                                                                                                                    or as pairs of identifier and description using PropertyValue. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1172284';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Collection of data: dataset, database, db, data stock,
                                                                                                                                                    data pool, data corpus *} */
    public      $aItems                         = null;             /* {*property   $aItems                         (array)                         Set of items composing the dataset *} */


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
    }   /* End of Dataset.__construct() =============================================== */
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
    }   /* End of Dataset.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Dataset =========================================================== */
/* ==================================================================================== */
