<?php
namespace trql\Utils;

use \trql\vaesoli\Vaesoli               as Vaesoli;         // 28-12-20 10:39:02
//use \trqlradio\vaesoliwrapper\vaesoli   as vaesoli;         // 28-12-20 10:39:02 ... mis en commentaire
use \trql\polylogos\PolyLogos           as Polylogos;
use \trql\openlabel\OpenLabel           as OpenLabel;


//require_once( 'trql-radio.defines.inc' );

trait Utils
/*-------*/
{
    public function isURL( $szURL )
    /*---------------------------*/
    {
        if ( preg_match( '/^
        	             (# Scheme
        	              [a-z][a-z0-9+\-.]*:
        	              (# Authority & path
        	               \/\/
        	               ([a-z0-9\-._~%!$&\'()*+,;=]+@)?                                      # User
        	               ([a-z0-9\-._~%]+                                                     # Named host
        	               |\[[a-f0-9:.]+\]                                                     # IPv6 host
        	               |\[v[a-f0-9][a-z0-9\-._~%!$&\'()*+,;=:]+\])                          # IPvFuture host
        	               (:[0-9]+)?                                                           # Port
        	               (\/[a-z0-9\-._~%!$&\'()*+,;=:@]+)*\/?                                # Path
        	              |# Path without authority
        	               (\/?[a-z0-9\-._~%!$&\'()*+,;=:@]+(\/[a-z0-9\-._~%!$&\'()*+,;=:@]+)*\/?)?
        	              )
        	             |# Relative URL (no scheme or authority)
        	              ([a-z0-9\-._~%!$&\'()*+,;=@]+(\/[a-z0-9\-._~%!$&\'()*+,;=:@]+)*\/?    # Relative path
        	              |(\/[a-z0-9\-._~%!$&\'()*+,;=:@]+)+\/?)                               # Absolute path
        	             )
        	             # Query
        	             (\?[a-z0-9\-._~%!$&\'()*+,;=:@\/?]*)?
        	             # Fragment
        	             (\#[a-z0-9\-._~%!$&\'()*+,;=:@\/?]*)?
        	             $/ix',
        	$szURL ) )
        {
            return ( true );
        }
        else
        {
            return ( false );
        }

    }   /* End of Utils.isURL() ======================================================= */
    /* ================================================================================ */

    public function XMLtoJSON( $szXML )
    /*-------------------------------*/
    {
        $xmlNode = @simplexml_load_string( $szXML );
        return ( json_encode( $this->XMLToArray( $xmlNode,array( "attributePrefix" => "__" ) ) ) );
    }   /* End of Utils.XMLtoJSON() =================================================== */
    /* ================================================================================ */


    /* Cette fonction pourrait mériter d'être comparée à celle que j'avais
       modifiée pour le PMO de SiA (avec la toute dernière version de PHP)
    */
    public function XMLToArray( $xml,$options = array() )
    /*-------------------------------------------------*/
    {
        $defaults = array(
            'namespaceSeparator'    => ':',                             /* you may want this to be something other than a colon */
            'attributePrefix'       => '@',                             /* to distinguish between attributes and nodes with the same name */
            'alwaysArray'           => array(),                         /* array of xml tag names which should always become arrays */
            'autoArray'             => true,                            /* only create arrays for tags which appear more than once */
            'textContent'           => '$',                             /* key used for the text content of elements */
            'autoText'              => true,                            /* skip textContent key if node has no attributes or child nodes */
            'keySearch'             => false,                           /* optional search and replace on tag and attribute names */
            'keyReplace'            => false                            /* replace values for above search values (as passed to str_replace()) */
        );

        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null; //add base (empty) namespace

        //get attributes from all namespaces
        $attributesArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch']) $attributeName =
                        str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                $attributeKey = $options['attributePrefix']
                        . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                        . $attributeName;
                $attributesArray[$attributeKey] = (string)$attribute;
            }
        }

        //get child nodes from all namespaces
        $tagsArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = $this->XMLToArray($childXml, $options);

                // Ce code a été mis en commentaire car la fonction each() est DEPRECATED en PHP 7.2.6
                // 28-09-18 16:30:46
                //list($childTagName, $childProperties) = each($childArray);

                // Ce code a été remplacé par les 3 lignes suivantes le 28-09-18 16:31:04
                $a__Keys = array_keys( $childArray);
                $childTagName = $a__Keys[0];
                $childProperties = $childArray[ $childTagName ];

                //var_dump( $childTagName );
                //var_dump( $childProperties );

                //replace characters in tag name
                if ($options['keySearch']) $childTagName =
                        str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                //add namespace prefix, if any
                if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] =
                            in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                            ? array($childProperties) : $childProperties;
                } elseif (
                    is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                    === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                }
            }
        }

        //get text content of node
        $textContentArray = array();
        $plainText = trim((string)$xml);
        if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
                ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

        //return node as array
        return array( $xml->getName() => $propertiesArray );
    }   /* End of Utils.XMLtoArray() ================================================== */
    /* ================================================================================ */


    public function loadSentences( $szFile )
    /*------------------------------------*/
    {
        if ( is_file( $szFile ) )
        {
            return ( file( $szFile,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) );
        }
        else
        {
            throw new \Exception( __METHOD__ . '() at line ' . __LINE__ . ' of ' . basename( __FILE__ ) . ': ' . basename( $szFile ) . ' NOT found (Error #' . EXCEPTION_CODE_FILE_NOT_FOUND . ')',EXCEPTION_CODE_FILE_NOT_FOUND );
            return ( null );
        }
    }   /* End of Utils.loadSentences() =============================================== */
    /* ================================================================================ */


    public function subTag( $oXPath,$oNode,$szTag )
    /*-------------------------------------------*/
    {
        $szRetVal = null;

        if ( ( $o = @$oXPath->query( $szTag,$oNode ) ) && $o->length > 0 )
            $szRetVal = $o->item(0)->nodeValue;

        return ( $szRetVal );
    }   /* End of Utils.subTag() ====================================================== */
    /* ================================================================================ */


    public function tagAttribute( $oXPath,$oNode,$szTag,$szAttr )
    /*---------------------------------------------------------*/
    {
        $szRetVal = null;

        if ( ( $o = @$oXPath->query( $szTag,$oNode ) ) && $o->length > 0 )
            $szRetVal = $o->item(0)->getAttribute( $szAttr );

        return ( $szRetVal );
    }   /* End of Utils.tagAttribute() ================================================ */
    /* ================================================================================ */


    public function subTags( $oXPath,$oNode,$szTag )
    /*--------------------------------------------*/
    {
        $list = null;

        if ( ( $o = $oXPath->query( $szTag,$oNode ) ) && $o->length > 0 )
            $list = $o;

        return ( $list );
    }   /* End of Utils.subTags() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*season( $xDate )=

        Gets the season at a given date.

        {*params
            $xDate      (string|int)    The date to consider. Optional.
        *}

        {*return
            (string)                    'spring', 'summer', 'fall' or 'winter'
        *}

        {*abstract

            Spring will take place from Saturday, March 20 to Sunday, June 20, 2021.
            The current summer will end on Monday, September 21, 2020.
            Fall will take place from Tuesday, September 22 to Sunday, December 20, 2020.
            Winter will take place from Monday, December 21 to Friday, March 19, 2021.

        *}

        *}}
     */
    /* ================================================================================ */
    public function season( $xDate = null )
    /*-----------------------------------*/
    {
        return ( Vaesoli::TIM_Season( $xDate ) );
    }   /* End of Utils.season() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_iPos( $szStr,$szSubStr,$iStart )=

        Finds the position of first occurrence of a string ([b]case insensitive[/b])

        {*params
            $szStr      (string)    String to be searched
            $szSubStr   (string)    Substring to look for
            $iStart     (int)       Optional offset parameter to specify where
                                    searching must start. [c]0[/c] by default.
        *}

        {*return
            (int)       -1 if $szSubStr not found in $szStr; otherwise it
                        indicates the 1st position where $szSubStr is found
                        in $szStr
        *}

        {*assert
            STR_iPos( 'Hello','l' ) === 2
        *}

        {*assert
            STR_iPos( 'HeLlo','l' ) === 2
        *}

        {*assert
            STR_iPos( 'HeLlo','l',3 ) === 3
        *}

        {*assert
            STR_iPos( 'HeLlo','pa' ) === -1
        *}

        {*assert
             STR_iPos( 'C:/websites/latosensu.be/www/httpdocs/georama','C:/websites/latosensu.be/www/httpdocs' ) !== -1
        *}

        {*example
            echo STR_iPos( '/index.php;/Index.php','/' ); // Prints 0
        *}

        {*seealso
            STR_Pos()
        *}

        *}}
     */
    /* ================================================================================ */
    public function STR_iPos( $szStr,$szSubStr,$iStart = 0 )
    /*----------------------------------------------------*/
    {
        $iPos = stripos( $szStr,$szSubStr,$iStart );
        return ( $iPos === false ? -1 : $iPos );
    }   /* End of Utils.STR_iPos() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_Strin( $szStr,$iRid )=

        Returns $szStr amputated from the last character

        {*params
            $szStr      (string)    Input string
            $iRid       (int)       Number of characters to amputate $szStr from.
                                    Optional. 1 by default
        *}

        {*return
            (string)    The resulting string (length - $iRid characters).
        *}

        {*assert
            STR_Strin( 'Hello' ) === 'Hell'
        *}

        {*assert
            STR_Strin( 'Hello',2 ) === 'Hel'
        *}

        {*example
            $szFields =
            $szValues = '';

            foreach( $aFields as $szField => $szValue )  // For each field
            {
                $szFields   .= trim( $szField ) . ',';
                $szValues   .= trim( $szValue ) . ',';
            }

            $szFields = STR_Strin( $szFields );
            $szValues = STR_Strin( $szValues );
        *}
        *}}
     */
    /* ================================================================================ */
    public function STR_Strin( $szStr,$iRid = 1 )
    /*-----------------------------------------*/
    {
        if ( ! empty( $szStr ) && $iRid > 0 )                       /* If string NOT empty and valid $iRid */
        {
            return ( substr( $szStr,0,-$iRid ) );                   /* Return string -iRid chars */
        }
        else
        {
            return ( $szStr );                                      /* Return result to caller (original string) */
        }
    }   /* End of Utils.STR_Strin() =================================================== */


    /* ================================================================================ */
    /** {{*nl()=

        Newline

        {*params
        *}

        {*return
            (string)    [c]\n[/c] if script run in command line mode;
                        [c]<br />[/c] otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function nl()
    /*----------------*/
    {
        return ( $this->isCommandLine() ? "\n" : "<br />" );
    }   /* End of Utils.nl() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*objectToObject( $o,$szClass )=

        Transforms the $o object to the $szClass class

        {*params
            $o          (object)    The object to turn to an object of the $szClass class
            $szClass    (string)    The casting class
        *}

        {*return
            (string)    [c]\n[/c] if script run in command line mode;
                        [c]<br />[/c] otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function objectToObject( $o,$szClass )
    /*------------------------------------------*/
    {
        return ( unserialize( sprintf( 'O:%d:"%s"%s'        ,
                                       strlen( $szClass )   ,
                                       $szClass             ,
                                       strstr( strstr( serialize( $o ), '"' ), ':' )
                                     ) ) );
    }   /* End of Utils.objectToObject() ============================================== */
    /* ================================================================================ */


    public function importProperties( $o )
    /*----------------------------------*/
    {
        foreach ( get_object_vars( $o ) as $key => $value )
        {
            $this->$key = $value;
        }
    }

    /* ================================================================================ */
    /** {{*__( $szKey,$szLanguage,$xDefault )=

        Say/echo a sentence identified by the $szKey key in the $szLanguage langage.
        If the key is NOT found, $xDefault gets displayed

        {*params
            TO BE DOCUMENTED
        *}

        {*return
            (void)
        *}

        {*abstract

            1) Look for the label in OpenLabels
            2) If found ... return the value from OpenLabels
            3) Else ... ask the translation using PolyGlot
            4)    If PolyGlot returns an answer
            5)        store the label in PolyGlot AND in
                      OpenLabels
            6)    Elseif ... default NOT null
            7)        Store the label in PolyGlot AND in
                      OpenLabels
        *}

        {*exec
        *}

        *}}
    */
    /* ================================================================================ */
    public function __( $szKey,$szLanguage,$xDefault )
    /*-----------------------------------------------*/
    {
        // On 27-12-20 14:29:47, I have NO time to deal with the intricacies
        // of the whole translation concept. Therefore, I always return the
        // default

        static $oTranslator = null;                                 /* The translator that we'll use should we need it */
        static $oLabel      = null;                                 /* The OpenLabel object that will be used to get the label identified by $szKey */

        $szRetVal           = $xDefault;                            /* The return value of the method */

        //var_dump( $szKey );

        if ( is_null( $oLabel ) )                                   /* If there is no object defined */
        {
            if ( ! defined( 'OPENLABEL_CLASS_VERSION' ) )           /* Check if we need to load the OpenLabel class */
                require_once( 'trql.openlabel.class.php' );

            //var_dump( "CREATE OpenLabel()" );
            $oLabel = new OpenLabel();
        }   /* if ( is_null( $oLabel ) ) */


        /*
            1) Look for the label in OpenLabels
            2) If found ... return the value from OpenLabels
            3) Else ... ask the translation using PolyGlot
            4)    If PolyGlot returns an answer
            5)        store the label in PolyGlot AND in
                      OpenLabels
            6)    Elseif ... default NOT null
            7)        Store the label in PolyGlot AND in
                      OpenLabels
        */

        if ( is_null( $szRetVal = $oLabel->seek( $szKey,$szLanguage,null ) ) )
        {
            //var_dump( "Nous n'avons pas trouvé {$szKey} dans OpenLabels" );

            if ( is_null( $oTranslator ) )
            {
                if ( ! defined( 'POLYLOGOS_CLASS_VERSION' ) )
                    require_once( 'trql.polylogos.class.php' );

                //foreach( get_declared_classes() as $szClass ) var_dump( $szClass );
                $oTranslator = new PolyLogos();
            }   /* if ( is_null( $oTranslator ) ) */

            //var_dump( "Tentons de traduire '{$xDefault}' en '{$szLanguage}' grâce à PolyGlot" );
            $aRetVal = $oTranslator->translate( $xDefault,null,$szLanguage );
            //var_dump( $aRetVal );
            $szRetVal = $aRetVal['translation'];

            // Bon, ici ... la traduction a été stockée dans PolyGlot
            // Il reste à stocker la traduction dans OpenLabels
            //var_dump( "Il reste à stocker le résultat dans OpenLabels: '{$szKey}' en '{$szLanguage}' = '{$szRetVal}'" );
            $oLabel->add( $szKey,$szLanguage,$szRetVal );
        }   /* if ( is_null( $szRetVal = $oLabel->seek( $szKey,$szLanguage,null ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of Utils.__() ========================================================== */
    /* ================================================================================ */


    public function makeBool( $x,$bDefault = true ) : bool
    /*--------------------------------------------------*/
    {
        if ( is_bool( $x ) )
            return ( $x );
        elseif ( is_object( $x ) )
            return true;
        elseif ( is_array( $x ) )
            return true;
        else
        {
            $x = strtolower( trim( (string) $x ) );

            //return ( "DEFAULT=" . ( $bDefault ? 'true' : 'false' ) );

            if ( $x === 'true' || $x === 'yes' || $x === 'on' || $x === '1' || $x === 'vrai' )
                $bRetVal = true;
            else
                $bRetVal = $bDefault;
        }

        return ( $bRetVal );
    }   /* End of Utils.makeBool() ==================================================== */
    /* ================================================================================ */

}   /* End of Utils =================================================================== */
/* ==================================================================================== */
?>