<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.label.class.php *}
    {*purpose               Label service (OpenLabels wrapper) *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 16/08/2020 - 13:07 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 16/08/2020 - 13:07 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\label;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\creativework\creativework                 as Creativework;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'LABEL_CLASS_VERSION' ) or define( 'LABEL_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Label=

    {*desc

    *}

    {*warning

        15-08-20 14:37:42 : UNFINISHED WORK

    *}

    *}}
 */
/* ================================================================================== */
class Label extends Mother
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* je devrais savoir comment Morphalou est créé */

    /* Tout ceci sont des notes prélimianires qui vont devoir se retrouver dans la doc */

    /* Par "label" on entend un mot ou ensemble de mots. Par exemple, "Code Postal" est un "label" */

    /* On accède à un label par une clef, par exemple "address" */
    /* Une clef peut avoir plusieurs utilisations (ou contextes). Une clef, utilisée dans le cadre d'un contexte donné paut avoir une traduction différente que la même clef utilisée dans un autre contexte */
    /* On peut aussi avoir des utilisations dans une sorte de taxonomie */
    /* Un label peut être composé de ... labels "ZIPCode" peut donner lieu à "$postal $code" où chaque mot est en fait une clef de label */

    /* On peut avoir BEAUCOUP, BEAUCOUP de clefs ... si on se dit par exemple qu'on gère beaucoup de langues ! */


    /* JUSTE POUR SAVOIR COMMENT FORMATER LES AUTRES PROPRIETES */
    public      $spokenByCharacter      = null;                     /* {*property   $spokenByCharacter          (Organization|Person)       The (e.g. fictional) character, Person or Organization to whom
                                                                                                                                            the quotation is attributed within the containing CreativeWork. *} */

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
    }   /* End of Label.__construct() ================================================= */
    /* ================================================================================ */


    public function gotoFile( $aMap )
    /*-----------------------------*/
    {
        return ( vaesoli::FIL_RealPath( vaesoli::FIL_AddBS( $this->szHome ) . 'data/labels/' . 
                 $aMap['level1'] . '/' . 
                 $aMap['level2'] . '/' . 
                 $aMap['level3'] . '/' . 
                 $aMap['level4'] . '.xml' ) );
    }   /* End of Label.gotoFile() ==================================================== */
    /* ================================================================================ */


    public function createEntry( $szFile,$aParams )
    /*-------------------------------------------*/
    {
        if ( ! empty( $szXML = $this->__toXML( $aParams ) ) )
        {
            if ( ! is_dir( $szDir = dirname( $szFile ) ) )
            {
                if ( vaesoli::FIL_MkDir( $szDir ) )
                    $this->addInfo( __METHOD__ . "(): '{$szDir}' created" );
                else
                    $this->addInfo( __METHOD__ . "(): '{$szDir}' could NOT be created" );
            }

            if ( is_dir( $szDir ) )
            {
                //$this->die( "STOP HERE BEFORE CREATING THE ENTRY!!!" );
                if ( vaesoli::FIL_StrToFile( $szXML,$szFile ) )
                    $this->addInfo( __METHOD__ . "(): '{$szFile}' created" );
                else
                    $this->addInfo( __METHOD__ . "(): '{$szFile}' could NOT be created" );

            }   /* If directory (all intermediate levels created ) */
        }   /* if ( ! empty( $szXML = $this->__toXML( $aParams ) ) ) */

        return ( $this );
    }   /* End of Label.createEntry() ================================================= */
    /* ================================================================================ */


    public function readEntry( $szFile,$aParams )
    /*-----------------------------------------*/
    {
        static $oDom = null;

        $aRetVal = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        //var_dump( $aParams );
        //var_dump( $szFile );
        //die();


        if ( $oDom->load( $szFile ) )
        {
            $oXPath = new DOMXPath( $oDom );

            $szQuery = "//Label[@key='{$aParams['key']}']";

            $oColl = $oXPath->query( $szQuery );

            foreach( $oColl as $oNode )
            {
                if ( ! empty( $szAlias = $oNode->getAttribute( 'alias' ) ) )
                {
                    $this->addInfo( __METHOD__ . "(): '{$szAlias}' is the alias of '{$szKey}'" );
                    //var_dump( "ALIAS FOUND: {$szAlias}" );
                    $szFile = $this->gotoFile( $aMap = $this->map( $szAlias ) );
                    $aParams['key'] = $szAlias;
                    $aParams['map'] = $aMap;
                    //var_dump( $aParams );
                    return ( $this->readEntry( $szFile,$aParams ) );
                }
                elseif ( ! is_null( $oValueList = $this->subTags( $oXPath,$oNode,"Value[contains(@lang,'{$aParams['lang']}')]|Value[string-length(@lang)=0]" ) ) )
                {
                    //var_dump("FOUND ENTRIES");
                    //die();
                    // La langue, dans la ligne de code suivante, est la valeur trouvée dans le fichier XML
                    // Cependant, on peut avoir des trucs comme "en,nl,fr" ... et cela peut causer des 
                    // problèmes. Alors j'ai mis cette ligne en commentaire et j'ai pris la valeur 'lang'
                    // des paramètres !!!
                    //$aRetVal[$oValueList->item(0)->getAttribute('lang')] = $oValueList->item(0)->nodeValue;
                    $aRetVal[$aParams['lang']] = $oValueList->item(0)->nodeValue;
                    break;
                }
            }
        }
        else
        {
            $this->addInfo( __METHOD__ . "(): " . basename( $szFile ) . " CANNOT be loaded" );
        }

        end:
        return ( $aRetVal );
    }   /* End of Label.readEntry() =================================================== */
    /* ================================================================================ */


    /* $xDefault pourrait être une array ... mais je ne vais pas m'occuper de cela maintenant */
    /* ?string ... nullable !!! MAIS en PHP 7.1.0 !!! */
    //public function seek( $szKey,$szLang = 'en',$xDefault = null ) : ?string
    public function seek( $szKey,$szLang = 'en',$xDefault = '' ) : string
    /*-----------------------------------------------------------------*/
    {
        $szRetVal   = $xDefault;      /* ATTENTION, JE POURRAIS AUSSI AVOIR UNE ARRAY OU MEME UN OBJET */

        $tStart     = microtime( true );

        $szFile     = $this->gotoFile( $aMap = $this->map( $szKey ) );

        $this->addInfo( __METHOD__ . "(): Looking for '{$szKey}'" );

        if ( true && $this->remembering && is_file( $szFile ) )
        {
            $this->addInfo( __METHOD__ . "(): " . basename( $szFile ) . " file FOUND" );
            $aRetVal = $this->readEntry( $szFile,array( 'key' => $szKey,'lang' => $szLang,'default' => $xDefault,'map' => $aMap ) );
            //var_dump( $aRetVal );

            if ( ! is_null( $aRetVal ) )
                $this->addInfo( __METHOD__ . "(): '{$szKey}' in '{$szLang}' FOUND" );
            else
                $this->addInfo( __METHOD__ . "(): '{$szKey}' in '{$szLang}' NOT FOUND" );


            //$this->die("FILE FOUND ! BUT ... MAYBE WE HAVEN'T FOUND THE KEY!!! THIS MUST STILL BE CHECKED. DYING BEFORE RETURN!!!");

            // je dois encore voir si j'ai la langue car j'ai des entrées/valeurs dans les fichiers qui n'ont pas de
            // de langue; de telles entrées matchent TOUTES les langues !!!

            $szRetVal = $aRetVal[$szLang] ?? $xDefault;
            //var_dump( $szRetVal );
            goto end;
        }
        else    /* La clef n'existe pas (CAR LE FICHIER N'EXISTE PAS OU QU'ON SOUHAITE LA RECRÉER) => le fichier est créé */
        {
            $this->addInfo( __METHOD__ . "(): '{$szKey}' NOT found" );

            if ( false && $this->storing )
            {
                $this->createEntry( $szFile,array( 'key' => $szKey,'lang' => $szLang,'default' => $xDefault,'map' => $aMap ) );
            }
        }

        //var_dump( $szFile );


        end:
        $tEnd = microtime( true );

        var_dump( $tEnd - $tStart );

        return ( $szRetVal );

    }   /* End of Label.seek() ======================================================== */
    /* ================================================================================ */



    public function __toXML( $aParams ) : string
    /*----------------------------------------*/
    {
        //var_dump( $aParams );

        $bWithHeader = isset( $aParams['header'] );
        $szKey       = $aParams['key'] ?? ( $aParams['@key'] ?? null );

        $szXML = '';

        if ( ! empty( $szKey ) )
        {
            if ( $bWithHeader )
            {
                $szXML .= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n";
                $szXML .= "<Dictionary active=\"yes\">\n";
            }

            $szActive       = $aParams['@active'    ] ?? 'yes'  ;
            $szEditable     = $aParams['@editable'  ] ?? 'yes'  ;
            $szChecked      = $aParams['@checked'   ] ?? ''     ;
            $szApproved     = $aParams['@approved'  ] ?? ''     ;
            $szDiscourse    = $aParams['@discourse' ] ?? ''     ;
            $szTagonomy     = $aParams['@tagonomy'  ] ?? ''     ;
            $szID           = $aParams['@id'        ] ?? ''     ;
            $szAlias        = $aParams['@alias'     ] ?? ''     ;

            $szXML .= "    <Label key=\"{$szKey}\" active=\"{$szActive}\" editable=\"{$szEditable}\" checked=\"{$szChecked}\" approved=\"{$szApproved}\" discourse=\"{$szDiscourse}\" id=\"{$szID}\" alias=\"{$szAlias}\">\n";

            if ( ! empty( $aParams['lang'] ) )
            {
                $szXML .= "        <Value lang=\"{$aParams['lang']}\"><![CDATA[{$aParams['default']}]]></Value>\n";
            }
            elseif ( ! empty( $aParams['values'] ) )
            {
                //var_dump( "AVEC MULTIPLES VALEURS" );
                foreach( $aParams['values'] as $aValue )
                {
                    $szLang = empty( $aValue['lang'] ) ? '' : " lang=\"{$aValue['lang']}\"";
                    $szXML .= "        <Value{$szLang}><![CDATA[{$aValue['value']}]]></Value>\n";
                }
            }

            $szXML .= "    </Label>\n";

            if ( $bWithHeader )
            {
                $szXML .= "</Dictionary>";
            }

            echo "<pre>\n",htmlentities( $szXML,ENT_QUOTES ),"</pre>\n";

        }   /* if ( ! empty( $szKey ) ) */

        end:
        return ( $szXML );
    }   /* End of Label.__toXML() ===================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Label.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class Label ============================================================= */
/* ==================================================================================== */
?>