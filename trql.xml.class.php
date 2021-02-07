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
    {*file                  trql.xml.class.php *}
    {*purpose               XML-centered utility. Addresses most-wanted conversions
                                - XML to array[br]
                                - Array to XML[br]
                                - Array to object[br]
                                - Object to array[br]
                                - Object to XML[br]
                                - XML to object
                            *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 15-08-20 14:10 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 15-08-20 14:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\XML;

use \trql\mother\Mother                             as Mother;
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

defined( 'XML_CLASS_VERSION' ) or define( 'XML_CLASS_VERSION','0.1' );


/* ==================================================================================== */
/** {{*class XML=

    {*desc

        Utility class to deal with XML-related intricacies

            - objToXML
            - toJSON
            - ...

    *}

    {*warning
        This class must still be tested extensively
    *}


    *}}
 */
/* ==================================================================================== */
class XML extends Utility
/*---------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    protected   $oDom                   = null;                     /* {*property   $oDom                       (DOMDocument)           Internal DOMDocument *} */
    protected   $oXPath                 = null;                     /* {*property   $oXPath                     (DOMXPath)              Internal DOMXPath: supports XPath 1.0 *} */


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

        $this->oDom = new DOMDocument();

        return ( $this );
    }   /* End of XML.__construct() =================================================== */
    /* ================================================================================ */



    public function load()
    /*------------------*/
    {
    }   /* End of XML.load() ========================================================== */
    /* ================================================================================ */


    public function loadXML( $szXML )
    /*-----------------------------*/
    {
        return ( $this->oDom->loadXML( $szXML ) );
    }   /* End of XML.loadXML() ======================================================= */
    /* ================================================================================ */


    public function serialize()
    /*-----------------------*/
    {

    }   /* End of XML.serialize() ===================================================== */
    /* ================================================================================ */


    public function __toXML( $xObj          ,
                             $szWrapper     = null      ,
                             $aReplacements = array()   ,
                             $bWithHeader   = true      ,
                             $header_params = array()   ,
                             $node_name     = 'node' ) : string
    /* -------------------------------------------------------*/
    {
        $szRetVal = '';

        if ( $bWithHeader )
            $szRetVal .= $this->header( $header_params );

        if ( $szWrapper != null )
            $szRetVal .= '<' . $this->tagName( $szWrapper ) . '>';

        if ( is_object ( $xObj ) )
        {
            $szClassName = get_class( $xObj );
            //var_dump( $szClassName );

            /* In the case of multilevels namespaces we need to take the root name of the class (e.g. trql\mercator\Mercator) */
            $aParts = explode( '\\',$szClassName );
            $node_block = strtolower( end( $aParts ) );

            //var_dump( "NODE BLOCK",$node_block );
            //$this->die();

            $node_block = $aReplacements[$node_block] ?? $node_block;

            $szRetVal .= '<' . $this->tagName( $node_block ) . '>';

            $aProperties = get_object_vars( $xObj );

            if ( ! empty( $aProperties ) )
            {
                foreach( $aProperties as $szPropertyName => $xValue )
                {
                    $szPropertyName = $aReplacements[$szPropertyName] ?? $szPropertyName;

                    $szRetVal .= '<' . $this->tagName( $szPropertyName ) . '>';

                    $szValueType = getType( $xValue );

                    if ( $szValueType === 'string' )
                        $szRetVal .= "<![CDATA[{$xValue}]]>";
                    else
                        $szRetVal .= $this->__toXML( $xValue,null,$aReplacements,false,null,$node_name );

                    $szRetVal .= '</' . str_replace( ' ','_',vaesoli::STR_stripAccents( $szPropertyName ) ) . '>' . "\n";
                }   /* foreach( $aProperties as $szPropertyName => $xValue ) */
            }   /* if ( ! empty( $aProperties ) ) */

            $szRetVal .= '</' . $this->tagName( $node_block ) . '>';
        }
        elseif ( is_array( $xObj ) )
        {
            foreach( $xObj as $szKey => $xValue )
            {
                $szValueType = getType( $xValue );

                if ( ! is_object( $xValue ) )
                {
                    if ( is_numeric( $szKey ) )
                    {
                        $szKey = $node_name;
                    }

                    /* If the name of the tag is empty ... sorry ... we skip it */
                    if ( empty( $szKey = $this->tagName( $aReplacements[$szKey] ?? $szKey ) ) )
                        continue;

                    $szRetVal .= '<' . $szKey . '>';
                }

                if ( $szValueType === 'string' )
                    $szRetVal .= "<![CDATA[{$xValue}]]>";
                else
                    $szRetVal .= $this->__toXML( $xValue,null,$aReplacements,false,null,$node_name );

                if ( ! is_object( $xValue ) )
                {
                    $szRetVal .= '</' . $this->tagName( $szKey ) . '>';
                }
            }
        }
        else
        {
            $szRetVal .= htmlspecialchars( $xObj,ENT_QUOTES );
        }

        if ( $szWrapper != null )
            $szRetVal .= '</' . $this->tagName( $szWrapper ) . '>';

        end:
        return ( $szRetVal );
    }   /* End of XML.objToXML() ====================================================== */
    /* ================================================================================ */


    protected function tagName( $szName )
    /*---------------------------------*/
    {
        //preg_replace('/[’\s\x0-\x2F\x3A-\x40\x5B-\x5E\x60\x7B-\xff]/i'
        return ( vaesoli::STR_Reduce( str_replace( array( '\'',' ',':','.',',',';','&','@','(',')','{','}','[',']' ),'_',preg_replace( '/[’\s\x0-\x2F\x3A-\x40\x5B-\x5E\x60\x7B-\xff]/si','_',vaesoli::STR_stripAccents( $szName ) ) ),'_' ) );
        //return ( vaesoli::STR_Reduce( str_replace( array( '\'',' ',':','.',',',';','&','@','(',')','{','}','[',']' ),'_',preg_replace( '/&#\d{1,4}(;|_)/si','_',vaesoli::STR_stripAccents( $szName ) ) ),'_' ) );
    }   /* End of XML.tagName() ======================================================= */
    /* ================================================================================ */


    protected function header( $aParams = array() )
    /*-------------------------------------------*/
    {
        $szRetVal = '<?xml';

        /* <?xml version="1.0" encoding="UTF-8" standalone="yes"?> */

        $aParams = array_merge( array( 'version'    => '1.0'    ,
                                       'encoding'   => 'UTF-8'  ,
                                       'standalone' => 'yes'    ,
                                     )                          ,
                                $aParams
                              );

        //var_dump( $aParams );
        //die();

        foreach( $aParams as $k => $v)
        {
            $szRetVal .= ' ' . $k . '="' . $v . '"';
        }

        $szRetVal .= ' ?>';

        //var_dump( $szRetVal );

        return ( $szRetVal );
    }   /* End of XML.header() ======================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of XML.__destruct() ==================================================== */
    /* ================================================================================ */

}   /* End of class XML =============================================================== */
/* ==================================================================================== */
?>