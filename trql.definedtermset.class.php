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
    {*file                  trql.definedtermset.class.php *}
    {*purpose               A set of defined terms for example a set of categories or a
                            classification scheme, a glossary, dictionary or
                            enumeration. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

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
namespace trql\definedtermset;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'DEFINEDTERMSET_CLASS_VERSION' ) or define( 'DEFINEDTERMSET_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DefinedTermSet=

    {*desc

        A set of defined terms for example a set of categories or a classification
        scheme, a glossary, dictionary or enumeration.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DefinedTermSet[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

    *}}
 */
/* ==================================================================================== */
class DefinedTermSet extends CreativeWork
/*-------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasDefinedTerm                 = null;             /* {*property   $hasDefinedTerm                 (DefinedTerm)                   A Defined Term contained in this term set. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q859161';        /* {*property   $wikidataId                     (string)                        Alphabetical list of terms used in a given discipline;
                                                                                                                                                    specialized dictionary used to explain the vocabulary
                                                                                                                                                    of a technical field *} */
    public      $szStorage                      = null;             /* {*property   $szStorage                      (string)                        The file in which all items of this glossary (DefinedTermSet)
                                                                                                                                                    are stored *} */
    protected   $oDom                           = null;             /* {*property   $oDom                           (DOMDocument)                   DOMDocument *} */
    protected   $oXPath                         = null;             /* {*property   $oXPath                         (DOMXPath)                      DOMXPath *} */

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

        {*example

        |** The [c]Glossary[/c] class is defined below. It exposes a static 
           method: [c]speak()[/c] which is then used to display a result
        **|
        
        echo glossary::speak('API','$t &#8211; $v' );

        class Glossary
        {
            public static function speak( $szTerm,$szFormat = '<span class="term">$t</span> &#8212; <span class="definition">$v</span>' )
            {
                $szRetVal           = null;
                static $aTerms      = null;
                static $oGlossary   = null;

                if ( is_null( $oGlossary ) )
                {
                    if ( ! defined( 'DEFINEDTERMSET_CLASS_VERSION' ) )
                        require_once( $_SERVER[ 'SNIPPET_CENTER_DIR' ] . 'trql.definedtermset.class.php' );

                    [b]$oGlossary = new DefinedTermSet();
                    $oGlossary->load();[/b]
                }

                |** Format the result **|
                if ( ! is_null( $aRetVal = [b]$oGlossary->search( $szTerm )[/b] ) )
                {
                    $szRetVal = str_replace( array( '$t'                            ,   |** Term **|
                                                    '$v'                            ,   |** Value **|
                                                    '$d'                            ,   |** Date **|
                                                    '$i'                            ,   |** ID **|
                                                    '$k'                            ,   |** Keyword **|
                                                    '$c'                            ,   |** Class **|
                                                  ),
                                             array( $szTerm                         ,   |** Term **|
                                                    $aRetVal[0]['value'     ] ?? '' ,   |** Value **|
                                                    $aRetVal[0]['date'      ] ?? '' ,   |** Date **|
                                                    $aRetVal[0]['id'        ] ?? '' ,   |** Date **|
                                                    $aRetVal[0]['keywords'  ] ?? '' ,   |** Keywords **|
                                                    $aRetVal[0]['class'     ] ?? '' ,   |** Class **|
                                                  ),
                                             $szFormat );

                }

                end:
                return ( $szRetVal );
            }
        }

        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of DefinedTermSet.__construct() ======================================== */
    /* ================================================================================ */


    public function __get( $property )
    /*------------------------------*/
    {
        switch( $property )
        {
            case 'storage'  :   return ( $this->szStorage );
                                break;
            default         :   return ( parent::__get( $property ) );
                                break;
        }
    }

    /* ================================================================================ */
    /** {{*load( [$szFile] )=

        Loads a file in which individual items are stored

        {*params
            $szFile     (string)            Optional. File name.
        *}

        {*return
            (void)      No return
        *}

        {*example
        use \trql\vaesoli\Vaesoli                   as Vaesoli;
        use \trql\definedtermset\DefinedTermSet     as DefinedTermSet;
        
        $oGlossary = new DefinedTermSet();
        [b]$oGlossary->load();[/b]

        *}

        *}}
    */
    /* ================================================================================ */
    public function load( $szFile = null )
    /*----------------------------------*/
    {
        $this->szStorage = vaesoli::FIL_RealPath( $szFile ?? $this->home() . '/data/glossary.xml' );

        if ( ! is_file( $this->szStorage ) )
        {
            $this->addInfo( basename( $this->szStorage ) . ' NOT found' );
            goto end;
        }   /* if ( ! is_file( $this->szStorage ) ) */
        else   /* Else of ... if ( ! is_file( $this->szStorage ) ) */
        {
            $this->addInfo( basename( $this->szStorage ) . ' found' );

            if ( is_null( $this->oDom ) )
                $this->oDom = new \DOMDocument();

            if ( $this->oDom->load( $this->szStorage ) )
            {
                $this->oXPath = new \DOMXPath( $this->oDom );
                $this->addInfo( basename( $this->szStorage ) . ' loaded' );
            }   /* if ( $this->oDom->load( $this->szStorage ) ) */
        }   /* End of ... Else of ... if ( ! is_file( $this->szStorage ) ) */

        end:
        return ( $this );
    }   /* End of DefinedTermSet.__construct() ======================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*search( $szKey )=

        Search the glossary for a term

        {*params
            $szKey          (string)            Key to look for (e.g. '[c]API[/c]')
        *}

        {*return
            (array)         An array of associative arrays which are possible returns
                            (the same Key can have multiple meanings)
        *}

        {*example
        use \trql\vaesoli\Vaesoli                   as Vaesoli;
        use \trql\definedtermset\DefinedTermSet     as DefinedTermSet;

        $oGlossary = new DefinedTermSet();
        $oGlossary->load();

        [b]if ( ! is_null( $aRetVal = $oGlossary->search( 'RPC' ) ) )
        {
            foreach( $aRetVal as $aReturn )
                var_dump( $aReturn );
        }[/b]
        *}

        *}}
    */
    /* ================================================================================ */
    public function search( $szKey )
    /*----------------------------*/
    {
        $aRetVal = null;

        if ( ! is_null( $this->oXPath ) )
        {
            //$this->addInfo( 'Looking for ' . $szKey );

            //if ( ( $oColl = $this->oXPath->query( $szQuery = "Term[@key={$szKey}]" ) ) && ( $oColl->length > 0 ) )
            if ( ( $oColl = $this->oXPath->query( $szQuery = "Term[@key='{$szKey}']" ) ) && ( $oColl->length > 0 ) )
            {
                $this->addInfo( $szKey . " FOUND (query='{$szQuery}')" );

                foreach( $oColl as $oNode )
                {
                    /*  A node looks like this:
                        <Term key="ACID" class="IT" keywords="" date="20140102" id="fea22613-8187-4e3e-87ea-21585ff38f7e">
                          <Value lang="en"><![CDATA[Atomicity, Consistency, Isolation, Durability]]></Value>
                          <Value lang="fr"><![CDATA[Atomicité, Consistance, Isolation, Durabilité]]></Value>
                          <Comment><![CDATA[Some comments about the term]]></Comment>
                        </Term>
                    */

                    /* Ceci est une simplification abusive : il pourrait bien y avoir plusieurs valeurs */
                    $szValue = $this->oXPath->query( 'Value',$oNode )->item(0)->nodeValue;

                    $aRetVal[] = array( 'term'      => $szKey                               ,
                                        'date'      => $oNode->getAttribute( 'date'     )   ,
                                        'id'        => $oNode->getAttribute( 'id'       )   ,
                                        'keywords'  => $oNode->getAttribute( 'keywords' )   ,
                                        'class'     => $oNode->getAttribute( 'class'    )   ,
                                        'value'     => $szValue                             ,
                                      );
                }   /* foreach( $oColl as $oNode ) */
            }   /* if ( ( $oColl = $this->oXPath->query( "//Term[@key='{$szKey}']" ) ) && ( $oColl->length > 0 ) ) */
            else
            {
                $this->addInfo( $szKey . " NOT found (query='{$szQuery}')" );
                //var_dump( $oColl );
            }

        }   /* if ( ! is_null( $this->oXPath ) ) */

        end:
        return ( $aRetVal );
    }   /* End of DefinedTermSet.search() ============================================= */
    /* ================================================================================ */


    public function add( $szKey,$szValue,$aParams = null )
    /*--------------------------------------------------*/
    {
        $bRetVal    = true;

        $szClass    =
        $szKeywords = null;

        if ( is_array( $aParams ) )
        {
            $szClass    = $aParams['class'      ] ?? null;
            $szKeywords = $aParams['keywords'   ] ?? null;
        }   /* if ( is_array( $aParams ) ) */

        try
        {
            $szGUID = strtolower( str_replace( array('{','}'),'',$this->guid() ) );
            $term   = $this->oDom->createElement( 'Term' );

            {
                $term->setAttribute( 'key'      ,$szKey             );
                $term->setAttribute( 'id'       ,$szGUID            );
                $term->setAttribute( 'class'    ,$szClass           );
                $term->setAttribute( 'date'     ,date( 'YmdHis' )   );
                $term->setAttribute( 'keywords' ,$szKeywords        );

                // En fait, il faut que je crée une section DATA!!!

                $term->appendChild( $this->oDom->createElement( 'Value',$szValue ) );
            }

            $this->oDom->documentElement->appendChild( $term );

            vaesoli::FIL_Copy( $this->szStorage,$this->szStorage . '.' . date( 'YmdHis' ) . 'backup.xml' );

            if ( $bRetVal = is_int( $this->oDom->save( $this->szStorage ) ) )
                $this->addInfo( $szKey . ' ADDED to ' . basename( $this->szStorage ) );
            else
                $this->addInfo( 'Cannot save ' . basename( $this->szStorage ) );
        }
        catch ( exception $e )
        {
            $this->addInfo( $szKey . ' CANNOT be added to ' . basename( $this->szStorage ) );
            //var_dump( $e->getMessage() );
            $bRetVal = false;
        }

        return ( $bRetVal );
    }   /* End of DefinedTermSet.add() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
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
    }   /* End of DefinedTermSet.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class DefinedTermSet ==================================================== */
/* ==================================================================================== */
