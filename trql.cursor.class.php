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
    {*file                  trql.cursor.class.php *}
    {*purpose               Database/Dataset abstraction (XML files, SQLite3) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24/10/2010 - 11:59 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 14-01-21 11:42 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\cursor;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\dataset\Dataset           as Dataset;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DATASET_CLASS_VERSION' ) )
    require_once( 'trql.dataset.class.php' );

defined( 'CURSOR_CLASS_VERSION' ) or define( 'CURSOR_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Cursor=

    {*desc

        A board where tasks are noted.

    *}


 */
/* ==================================================================================== */
class Cursor extends Dataset
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId         (string)        Wikidata ID. No equivalent. *} */


    protected static  $aWorkareas       =   array();                /* {*property   $aWorkareas         (array)         An array of possible work areas *} */
    public      $szName                 =   null;                   /* {*property   $szName             (string)        Name of the database/table *} */
    public      $szFilter               =   '';                     /* {*property   $szFilter           (string)        Active filter on database/table *} */
    public      $szComment              =   null;                   /* {*property   $szComment          (string)        Database/table comment *} */
    public      $szDataSource           =   null;                   /* {*property   $szDataSource       (string)        Physical database/table file *} */
    public      $szDataSourceType       =   DATA_SOURCE_TYPE_XML;   /* {*property   $szDataSourceType   (int)           Database type (XML type by default); types defined in LSInput.class.inc *} */
    public      $NoDataOnLoad           =   false;                  /* {*property   $NoDataOnLoad       (bool)          Indicates whether data must be fetched or not ([c]true]/c] by default) *} */
    public      $NoInclusionOnLoad      =   false;                  /* {*property   $NoInclusionOnLoad  (bool)          Indicates that xinclude() should NOT be treated (valid for DATA_SOURCE_TYPE_XML cursors) *} */
    public      $IsReadonly             =   false;                  /* {*property   $IsReadOnly         (bool)          Indicates that the cursor is a readonly cursir or not ([c]false[/c] by default) *} */
    public      $xCargo                 =   null;                   /* {*property   $xCargo             (mixed)         Feel free to put whatever you like in there: this member if for you *} */
    public      $iFrom                  =   -1;                     /* {*property   $iFrom              (int)           Starting record (not thoroughly tested though) *} */
    public      $iTo                    =   -1;                     /* {*property   $iTo                (int)           Ending record (not thoroughly tested though) *} */
    public      $szOrder                =   null;                   /* {*property   $szOrder            (string)        Active order on database/table *} */
    public      $szOrderBy              =   null;                   /* {*property   $szOrderBy          (string)        Active order on database/table *} */
    public      $szOrderDir             =   'ascending';            /* {*property   $szOrderDir         (string)        Order direction (ascending or descending). [c]ascending[/c] by default *} */

    public      $iMaxReccount           =   -1;                     /* {*property   $iMaxReccount       (int)           Maximum number of records ([c]-1[/c] by default, which indicates no max record) *} */

    protected   $iRecno                 =   -1;                     /* {*property   $iRecno             (int)           Current record number *} */
    protected   $iReccount              =   -1;                     /* {*property   $iReccount          (int)           Current record count *} */
    protected   $iDetailCount           =   -1;                     /* {*property   $iDetailCount       (int)           Current subrecords count (e.g. Tel[1], Tel[2], ...) *} */
    protected   $IsOpened               =   false;                  /* {*property   $IsOpened           (bool)          Determines if cursor is opened or not *} */
    protected   $IsLoaded               =   false;                  /* {*property   $IsLoaded           (bool)          Determines if cursor is loaded not *} */

    protected   $oDom                   =   null;                   /* {*property   $oDom               (LSDom)         Internal DOM (valid for DATA_SOURCE_TYPE_XML cursors) *} */
    protected   $oXPath                 =   null;                   /* {*property   $oXPath             (LSXPath)       Internal XPath (valid for DATA_SOURCE_TYPE_XML cursors) *} */
    protected   $xHandle                =   -1;                     /* {*property   $xHandle            (mixed)         DB handle (valid for DATA_SOURCE_TYPE_SQLITE3 cursors ) *} */
    protected   $szTable                =   null;                   /* {*property   $szTable            (string)        Table we're working on (valid for DATA_SOURCE_TYPE_SQLITE3 cursors ) *} */

    protected   $oList                  =   null;                   /* {*property   $oList              (DOMNodeList)   If records found : the list resulting from the query (valid for DATA_SOURCE_TYPE_XML cursors) *} */
    protected   $oNode                  =   null;                   /* {*property   $oNode              (DOMNode)       The current node in [c]oList[/c] (valid for DATA_SOURCE_TYPE_XML cursors) *} */
    protected   $IsDirty                =   false;                  /* {*property   $IsDirty            (bool)          Indicates whether the cursor contains uncommited changes ([c]false[/c] by default) *} */

    protected   $aEvents                =   array();                /* {*property   $aEvents            (array)         An array of events internally treated by the [c]LSCursor[/c] class *} */

    public      $IsDebug                =   false;                  /* {*property   $IsDebug            (bool)          Indicates whether debugging information must be displayed when accessing the cursor ([c]false[/c] by default) *} */
    public      $WithCDATA              =   true;                   /* {*property   $WithCDATA          (bool)          Indicates whether the filed must be saved in a CDATA structure ([c]true[/c] by default (see __set)) *} */

    protected   $aMappings              =   array();                /* {*property   $aMappings          (array)         An array of field mappings *} */
    public      $aErrors                =   array();                /* {*property   $aErrors            (array)         An array of cursor errors (Experimental error messages stack (should make it protected later) *} */

    protected   $szRootElement          =   null;                   /* {*property   $szRootElement      (string)        The root element of the XML file *} */


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

        die( "This class has NOT been tested yet. We must rework the code of LSCursor" );

        return ( $this );
    }   /* End of Cursor.__construct() ================================================ */
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

    }   /* End of Cursor.__destruct() ================================================= */
    /* ================================================================================ */

}   /* End of class Cursor ============================================================ */
/* ==================================================================================== */
?>