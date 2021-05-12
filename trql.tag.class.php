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

/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.tag.class.php *}
    {*purpose               Provides a generic way to create a (X)HTML tag *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 12/04/2006 - 11:23 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:

    [include]C:\websites\vaesoli.org\www\httpdocs\vaesoli\include\Tag.class.journal[/include]

    {*chist
        {*mdate 22-11-20 11:09:38 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation but all code based on
                                [c]LSTag[/c]
        *}
    *}


*}}} */
/**************************************************************************/
namespace trql\html;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\web\WebPageElement    as WebPageElement;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGEELEMENT_CLASS_VERSION' ) )
    require_once( 'trql.webpageelement.class.php' );

defined( 'TAG_CLASS_VERSION' ) or define( 'TAG_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Tag=

    {*desc
        Generic services to create (X)HTML tags, controls and containers
    *}

    *}}
 */
/* ==================================================================================== */
class Tag extends WebPageElement
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    static          $iInstances     =   0;                          /* {*property   $iInstances     (int)       Number of active instances of this class *} */
    public          $iInstance      =   0;                          /* {*property   $iInstance      (int)       Current instance number *} */
    public          $szID           =   null;                       /* {*property   $szID           (string)    ID of the tag *} */
    public          $szClass        =   null;                       /* {*property   $szClass        (string)    CSS class of the tag *} */
    public          $szName         =   null;                       /* {*property   $szName         (string)    Name of the tag (if appropriate) *} */
    public          $szType         =   'p';                        /* {*property   $szType         (string)    Tag type (eg. [c]'p'[/c],[c]'div'[/c],[c]'section'[/c],...) *} */
    public          $szTooltip      =   null;                       /* {*property   $szTooltip      (string)    Tooltip associated to the tag (has precedence over [c]$szTitle[/c]) *} */
    public          $szTitle        =   null;                       /* {*property   $szTitle        (string)    [c]title="..."[/c] *} */
    public          $iTop           =   null;                       /* {*property   $iTop           (int)       Top position of the tag (used in [c]style="...")[/c] *} */
    public          $iLeft          =   null;                       /* {*property   $iLeft          (int)       Left position of the tag (used in [c]style="...")[/c] *} */
    public          $iWidth         =   null;                       /* {*property   $iWidth         (int)       Width of the tag (used in [c]style="..."[/c]) *} */
    public          $iHeight        =   null;                       /* {*property   $iHeight        (int)       Height of the tag (used in [c]style="..."[/c]) *} */
    public          $szStyle        =   null;                       /* {*property   $szStyle        (string)    Style of the tag ([c]style="..."[/c]) *} */

    public          $szLang         =   null;                       /* {*property   $szLang         (string)    Language of the tag *} */

    public          $szDesc         =   null;                       /* {*property   $szDesc         (string)    Description of the tag *} */
    public          $szValue        =   null;                       /* {*property   $szValue        (string)    Value of the tag *} */
    public          $szComment      =   null;                       /* {*property   $szName         (string)    Comment associated to the tag *} */
    public          $szPixels       =   'px';                       /* {*property   $szPixels       (string)    The unit that is used to mention a positioning (can be 'px', 'em', ...) *} */
    public          $szLeader       =   null;                       /* {*property   $szLeader       (string)    Tag leading part (leader<tag>innerLeader...innerTrailer</tag>trailer ) *} */
    public          $szTrailer      =   null;                       /* {*property   $szTrailer      (string)    Tag trailing part  (leader<tag>innerLeader...innerTrailer</tag>trailer ) *} */
    public          $szInnerLeader  =   null;                       /* {*property   $szInnerLeader  (string)    Tag inner leader part (leader<tag>innerLeader...innerTrailer</tag>trailer ) *} */
    public          $szInnerTrailer =   null;                       /* {*property   $szInnerTrailer (string)    Tag inner trailer part (leader<tag>innerLeader...innerTrailer</tag>trailer ) *} */
    public          $szText         =   null;                       /* {*property   $szText         (string)    Inner text associated with the control (eg. <div>text</div>) *} */
    public          $iLevel         =   0;                          /* {*property   $iLevel         (int)       Level of a heading (e.g. h1 .. h6) *} */
    public          $iIndentSpaces  =   0;                          /* {*property   $iIndentSpaces  (int)       If a tag requires some indentation, you can specify it here (number of spaces BY indentation level) *} */
    public          $iIndentLevel   =   0;                          /* {*property   $iIndentLevel   (int)       If a tag requires some indentation, you can specify it here (indentation level) *} */
    public          $szGUID         =   null;                       /* {*property   $szGUID         (string)    Tag GUID *} */

    public          $IsVisible      =   true;                       /* {*property   $IsVisible      (bool)      Indicates whether the tag must be kept visible or not ([c]true[/c] by default) *} */
    protected       $aObjects       =   array();                    /* {*property   $aObjects       (array)     Array of inner objects *} */
    public          $oContainer     =   null;                       /* {*property   $oContainer     (object)    Parent container (if any) *} */

    public          $szOnSubmit     =   null;                       /* {*property   $szOnSubmit     (string)    onsubmit    clause *} */
    public          $szOnKeyPress   =   null;                       /* {*property   $szOnKeyPress   (string)    onkeypress  clause *} */
    public          $szOnKeyUp      =   null;                       /* {*property   $szOnKeyUp      (string)    onkeyup     clause *} */
    public          $szOnKeyDown    =   null;                       /* {*property   $szOnKeyDown    (string)    onkeydown   clause *} */
    public          $szOnClick      =   null;                       /* {*property   $szOnClick      (string)    onclick     clause *} */
    public          $szOnBlur       =   null;                       /* {*property   $szOnBlur       (string)    onblur      clause *} */
    public          $szOnSelect     =   null;                       /* {*property   $szOnSelect     (string)    onselect    clause *} */
    public          $szOnFocus      =   null;                       /* {*property   $szOnFocus      (string)    onfocus     clause *} */
    public          $szOnChange     =   null;                       /* {*property   $szOnChange     (string)    onchange    clause *} */
    public          $szOnMouseOver  =   null;                       /* {*property   $szOnMouseOver  (string)    onmouseover clause *} */
    public          $szOnLoad       =   null;                       /* {*property   $szOnLoad       (string)    onload      clause *} */
    public          $szOnUnLoad     =   null;                       /* {*property   $szOnUnLoad     (string)    onunload    clause *} */

    public static   $szBrowser      =   null;                       /* {*property   $szBrowser      (string)    The browser of the user *} */
    public static   $szPlatform     =   null;                       /* {*property   $szPlatform     (string)    The platform of the user (Mac, Windows, Linux, iOS, ...) *} */

    public          $aGenes         =   null;                       /* {*property   $aGenes         (array)     Gene of the object. [c]null[/c] by default. When a container
                                                                                                                ([c]LSContainer[/c]) implements a genome ([c]$szGenome[/c]),
                                                                                                                one of the current object's genes must match the genome of the
                                                                                                                container as to be included; otherwise it is simply disregarded
                                                                                                                at the time of the rendering (gene expression) of the container *} */
    public          $aCustomData    =   array();                    /* {*property   $aCustomData    (array)     Array of HTML5 "data-..." attributes *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public          $wikidataId     = null;                         /* {*property   $wikidataId     (string)    Wikidata ID. No equivalent *} */


    /* ====================================================================== */
    /** {{*__construct( $szType,$szID,$szClass,$szStyle,$szText )=

        Creates a tag

        {*params
            $szType     (string)        Tag type ( 'p', 'div', 'ol', ... ). Optional. 'p' by default
            $szID       (string)        Tag ID (id="..."). Optional. null by default
            $szClass    (string)        Tag ID (class="..."). Optional. null by default
            $szStyle    (string)        Tag style (style="..."). Optional. null by default
            $szText     (string)        Tag text (<p>...</p>). Optional. null by default
        *}

        {*example
            $oTag                   = new Tag('video');
            $oTag->InIFrame         = true;
            $oTag->iWidth           = 560;
            $oTag->iHeight          = 315;
            $oTag->szCaption        = 'Startup Lab workshop: How Google sets goals: OKRs';
            $oTag->szClass          = 'video shadow constrained';
            $oTag->AllowFullScreen  = true;
            $oTag->aSrc[]           = '//www.youtube.com/embed/mJB83EZtAjc';

            echo $oTag->Render();
        *}

        {*exec
            $oImg = new LSTag('img');
            echo htmlentities( $szHTML = $oImg->Render() );
            echo LSUnitTesting::assert( strstr( $szHTML,'<img' )                            ,
                                        'ASSERTION SUCCESS: image tag successfully created' ,
                                        'ASSERTION FAILURE: image tag COULD NOT be created' ,
                                        'GuideAssert' );
            $oImg->szSrcset = 'image1.jpg 1x,image2.jpg 2x';
            echo htmlentities( $szHTML = $oImg->Render() );
            echo LSUnitTesting::assert( strstr( $szHTML,'srcset=' )                         ,
                                        'ASSERTION SUCCESS: srcset detection OK' ,
                                        'ASSERTION FAILURE: no srcset detection' ,
                                        'GuideAssert' );

            $oP = new LSTag('p');
            $oP->szText = 'Hello World';
            echo htmlentities( $szHTML = $oP->Render() );

            echo LSUnitTesting::assert( strstr( $szHTML,'<p' ) && strstr( $szHTML,'Hello' )     ,
                                        'ASSERTION SUCCESS: paragraph tag successfully created' ,
                                        'ASSERTION FAILURE: paragraph tag COULD NOT be created' ,
                                        'GuideAssert' );
        *}

        *}}
     */
    /* ====================================================================== */
    public function __construct( $szType = 'p',$szID = null,$szClass = null,$szStyle = null,$szText = null )
    /*----------------------------------------------------------------------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$bWithFamily = false );

        $this->szID         = $szID;
        $this->szClass      = $szClass;
        $this->szStyle      = $szStyle;
        $this->iInstance    = ++self::$iInstances;
        $this->szGUID       = 'ls-' . $this->guid() . '-' . $this->iInstance;

        //echo "<p>Line ",__LINE__," of ",__METHOD__," ... STYLE = {$this->szStyle}</p>";

        $this->WhatBrowser();

        if ( ! is_null( $szType ) && is_string( $szType ) )         /* If internal type set */
        {
            $szTheType  = strtolower( trim( $szType ) );            /* Turning the internal type to lowercase */

            //$this->DebugMsg( "On devrait créer un {$szTheType}",__METHOD__,__LINE__);

            /* In function of the internal type, we'll create a set
               of public properties */
            switch ( $szTheType )                                   /* In function of the type */
            {
                case    'acronym'   :
                case    'abbr'      :   $this->szType           =   'abbr';
                                        break;
                case    'h1'        :   $this->szType           =   'h';
                                        $this->iLevel           =   1;
                                        break;
                case    'h2'        :   $this->szType           =   'h';
                                        $this->iLevel           =   2;
                                        break;
                case    'h3'        :   $this->szType           =   'h';
                                        $this->iLevel           =   3;
                                        break;
                case    'h4'        :   $this->szType           =   'h';
                                        $this->iLevel           =   4;
                                        break;
                case    'h5'        :   $this->szType           =   'h';
                                        $this->iLevel           =   5;
                                        break;
                case    'h6'        :   $this->szType           =   'h';
                                        $this->iLevel           =   6;
                                        break;
                case    'picture'   :
                case    'pict'      :
                case    'image'     :
                case    'img'       :   $this->szSrc            =   null;
                                        $this->szCaption        =   null;
                                        $this->szAlt            =   null;
                                        $this->iWidth           =   null;
                                        $this->iHeight          =   null;
                                        $this->szSrcset         =   null;
                                        $this->szType           =   'img';
                                        $this->AtRandom         =
                                        $this->IsTransition     =   false;
                                        $this->aPictures        =   array();    /* An array of images - random pick */
                                        break;
                case    'gras'      :
                case    'strong'    :
                case    'b'         :   $this->szType           =   'strong';
                                        break;
                case    'paragraph' :
                case    'p'         :   $this->szType           =   'p';
                                        break;
                case    'span'      :   $this->szType           =   'span';
                                        break;
                case    'hr'        :   $this->szType           =   'hr';
                                        break;
                case    'div'       :
                case    'division'  :   $this->szType           =   'div';
                                        break;
                case    'figure'    :
                case    'figcaption':
                case    'header'    :
                case    'footer'    :
                case    'article'   :
                case    'section'   :   $this->szType           =   $szTheType;
                                        break;
                case    'item'      :
                case    'listitem'  :
                case    'list-item' :
                case    'li'        :   $this->szType           =   'li';
                                        break;
                case    'pre'       :   $this->szType           =   'pre';
                                        break;
                case    'citation'   :
                case    'blockquote' :  $this->szAuthor         =   null;
                                        $this->szDate           =   null;
                                        $this->szType           =   'blockquote';
                                        $this->szCite           =   null;
                                        break;
                case    'shortquote':
                case    'quote'     :
                case    'q'         :   $this->szType           =   'q';
                                        $this->szCite           =   null;
                                        break;
                case    'a'         :   $this->szType           =   'a';
                                        $this->szProtocol       =   null;
                                        $this->szHref           =   null;
                                        break;
                case    'time'      :   $this->oDate            =   null;
                case    'big'       :
                case    'small'     :
                case    'text'      :   $this->szType           =   $szTheType;
                                        break;

                case    'script'    :
                case    'style'     :   $this->szType           =   $szTheType;
                                        break;

                case    'datalist'  :
                case    'ol'        :
                case    'ul'        :
                case    'dl'        :   $this->aItems           =   array(); /* Array of items */
                                        $this->szSeparator      =   ';';     /* Separator to determine tokens (ROW_SOURCE_TYPE_VALUES) */
                                        $this->szRecordSource   =   null;    /* Storage where values are found */
                                        $this->iRowSourceType   =   0;       /* Indicates the type for the row source value in the control */
                                        $this->szRowSource      =   null;    /* Specifies the source of the values in a ComboBox or ListBox control */
                                        $this->szControlSource  =   null;
                case    'dd'        :
                case    'dt'        :   $this->szType           =   $szTheType;
                                        break;
                case    'rem'       :
                case    'comment'   :   $this->szType       =   'comment';
                                        //$this->DebugMsg( "REM",__METHOD__,__LINE__ );
                                        break;
                case    'video'     :   $this->InIFrame         =   false;
                                        $this->szCaption        =   null;
                                        $this->AllowFullScreen  =   true;
                case    'audio'     :   $this->szType           =   $szTheType;
                                        $this->aSrc             =   array();/* Has precedence over $aSrc */
                                        $this->szSrc            =   '';     /* Fallback if $aSrc empty */
                                        $this->szPreload        =   '';     /* Preload clause (can be 'none', 'auto', 'metadata') */
                                        $this->Autoplay         =
                                        $this->Controls         =
                                        $this->Loop             =   false;
                                        break;
            }   /* switch ( $szTheType ) */

            if ( $szTheType == 'text' )
            {
                $this->szValue = $szText;
            }
            elseif ( $szTheType === 'datalist' )
            {
                $this->iRowSourceType === ROW_SOURCE_TYPE_VALUES;
            }
            else
            {
                $this->szText = $szText;
            }
        }   /* if ( ! is_null( $szType ) && is_string( $szType ) ) */

        return ( $this );
    }   /* End of Tag.__construct() =================================================== */
    /* ================================================================================ */


    /* ====================================================================== */
    /** {{*Render( [$oContainer] )=

        Generates the HTML code of the tag

        {*params
            $oContainer (LSControl)     The container of the current control.
                                        Optional. [c]null[/c] by default.
        *}

        {*return    (void) *}

        {*author    {PYB} *}
        {*mdate     21/04/2014 08:23 *}

        {*noassert *}

        *}}
     */
    /* ====================================================================== */
    public function Render( $oContainer = null )
    /*----------------------------------------*/
    {
        $szRetVal       = '';                                       /* Return value of the method */

        //echo "<p>Line ",__LINE__," of ",__METHOD__," ... STYLE = {$this->szStyle}</p>";

        if ( $this->szType && is_string( $this->szType ) && $this->IsVisible ) /* If internal type set */
        {
            //$this->DebugMsg( "On devrait afficher le bazar pour {$this->szType}",__METHOD__,__LINE__);
            $szClass   = $this->BuildClass();                       /* Class ... if any */
            $szStyle   = $this->BuildStyle();                       /* Style ... if any */
            //echo "<p>Line ",__LINE__," of ",__METHOD__," ... style=",$szStyle,"</p>";

            $szID      = $this->BuildID();                          /* id ... if any */
            $szTitle   = $this->BuildTitle();                       /* title ... if any */

            $szLang    = $this->BuildLang();                        /* Lang ... if any */
            $szIndent  = $this->BuildIndent();                      /* Indentation ... if any */

            $szAttrs   = "{$szID}{$szClass}{$szStyle}{$szTitle}{$szLang}";

            foreach ( $this->aCustomData as $szKey => $xValue )
            {
                if ( ! empty( $xValue ) )
                {
                    $szValue  = MISC_CastString( $xValue );
                    $szAttrs .= " data-{$szKey}=\"{$szValue}\"";
                }
            }   /* foreach ( $this->aCustomData as ... ) */

            $szTheType = strtolower( trim( $this->szType ) );       /* Turning the internal type to lowercase */

            switch ( $szTheType )                                   /* In function of the type */
            {
                /* Il faut pouvoir gérer les OnClauses() */
                case    'figure'    :
                case    'figcaption':
                case    'section'   :
                case    'header'    :
                case    'footer'    :
                case    'article'   :
                case    'div'       :
                    {
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szAttrs}>{$this->szInnerLeader}";
                        /* Check genome or not */
                        if ( isset( $this->szGenome ) )
                        {
                            $bCheckGenome   = ! empty( $this->szGenome );
                        }
                        else
                        {
                            $bCheckGenome   = false;
                        }

                        if ( ! is_null( $this->szText ) )
                        {
                            $szRetVal .= $this->szText;
                        }   /* if ( ! is_null( $this->szText ) ) */

                        foreach( $this->aObjects as $oObj )
                        {
                            $bExpress = true;       /* Let the control express itself by default */

                            if ( $bCheckGenome )    /* If we need to check the genome */
                            {
                                $bExpress = false;  /* Do not let the control express itself by default (since there is a genome) */

                                if ( property_exists( $oOj,'aGenes' ) && is_array( $oObj->aGenes ) )
                                {
                                    foreach ( $oObj->aGenes as $szGene )
                                    {
                                        if ( STR_Pos( $this->szGenome,$szGene ) != -1 )
                                        {
                                            $bExpress = true;
                                            break;
                                        }   /* if ( STR_Pos( $this->szGenome,$szGene ) != -1 ) */
                                    }   /* foreach ( $oObj->aGenes as $szGene ) */
                                }   /* if ( property_exists( $oObj,'aGenes' ) && ... */
                                else   /* Else of ... if ( property_exists( $oObj,'aGenes' ) && ... ) */
                                {
                                    //echo "<p>NO aGenes in",$oControl->szName,"</p>";
                                    //var_dump( $oControl );
                                }   /* End of ... Else of ... if ( property_exists( $oControl,'aGenes' ) && is_array( $oControl->aGenes ) ) */
                            }   /* if ( $bCheckGenome ) */

                            /* If Render() method exists */
                            if ( $bExpress && method_exists( $oObj,'Render' ) )
                            {
                                $szRetVal .= $oObj->Render();
                            }   /* if ( $bExpress && method_exists( ... ) ) */
                        }   /* foreach( $this->aObjects as $oObj ) */

                        $szRetVal   .= "{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                    }
                    break;
                case    'hr'        :
                    {
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<hr{$szAttrs} />{$this->szInnerLeader}";
                    }
                    break;
                case    'img'       :
                    {
                        // Ici, je devrais loader l'image si je n'ai pas d'indication
                        // de width et de height afin de les calculer moi-même si je le
                        // peux. Attention, je dois aussi vérifier que je n'ai pas
                        // d'indication de width et de height dans le style.
                        $szAttrs    .= $this->BuildAlt();
                        $szAttrs    .= $this->BuildSrcset();

                        /* If we have at least 1 image ... and if transition required */
                        if ( ( $iImgCount = count( $this->aPictures ) ) > 0 && $this->IsTransition )
                        {
                            /* Create an Image Transition object and render that one */
                            $aPics = array();
                            foreach( $this->aPictures as $szPicture )
                            {
                                $aPics[] = FIL_Normalize( FIL_ResolveRoot( $szPicture ) );
                            }
                            $oImg = new LSImageTrans( $aPics,
                                                      70    ,
                                                      0.03  ,
                                                      $szStyle );
                            $szRetVal .= $oImg->Render();
                        }
                        else
                        {
                            if ( $this->AtRandom && empty( $this->szSrc ) && $iImgCount > 0 )
                            {
                                $iRandom    = mt_rand( 0,$iImgCount - 1);
                                $szImg      = $this->aPictures[$iRandom];
                                $szRetVal  .= "{$this->szLeader}{$szIndent}<img{$szAttrs} src=\"{$szImg}\" />{$this->szTrailer}";
                            }
                            else
                            {
                                $szRetVal   .= "{$this->szLeader}{$szIndent}<img{$szAttrs} src=\"{$this->szSrc}\" />{$this->szTrailer}";
                            }
                        }
                    }
                    break;
                case    'figure'    :
                case    'p'         :
                    {
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<p{$szAttrs}>{$this->szInnerLeader}";
                        foreach( $this->aObjects as $oObj )
                            $szRetVal .= $oObj;
                        $szRetVal   .= "{$this->szText}{$this->szInnerTrailer}</p>{$this->szTrailer}";
                    }
                    break;
                case    'abbr'      :
                case    'pre'       :
                case    'small'     :
                case    'big'       :
                case    'span'      :
                case    'strong'    :
                case    'time'      :
                    {
                        if ( property_exists( $this,'oDate' ) && $this->oDate instanceof LSDate)
                        {
                            $szValue = $this->oDate->Render('Y-m-d');
                        }
                        else
                        {
                            $szValue = $this->szText;
                        }
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szAttrs}>{$this->szInnerLeader}{$szValue}{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                    }
                    break;
                case    'h'         :   $szRetVal   .= "{$this->szLeader}{$szIndent}<h{$this->iLevel}{$szAttrs}>{$this->szInnerLeader}{$this->szText}{$this->szInnerTrailer}</h{$this->iLevel}>{$this->szTrailer}";
                                        break;
                case    'a'         :   $szRetVal   .= "{$this->szLeader}{$szIndent}<a{$szAttrs} href=\"{$this->szProtocol}{$this->szHref}\">{$this->szInnerLeader}{$this->szText}{$this->szInnerTrailer}</a>{$this->szTrailer}";
                                        break;
                case    'object'    :   $szRetVal   .= 'objects are NOT supported yet';
                                        break;
                case    'video'     :
                case    'audio'     :
                    {
                        /* Here we handle the case where videos are requested 
                           in iframes. Ex: youtube video that is embedded in a page
                        */
                        if ( $szTheType === 'video' && $this->InIFrame )
                        {
                            if ( $this->AllowFullScreen )
                            {
                                $szAllowFullScreen = 'allowfullscreen ';
                            }
                            else
                            {
                                $szAllowFullScreen = '';
                            }

                            if ( count( $this->aSrc ) > 0 )
                            {
                                $szSrc = $this->aSrc[0];
                            }
                            elseif ( ! empty( $this->szSrc ) )
                            {
                                $szSrc = $this->szSrc;
                            }
                            else
                            {
                                $szSrc = null;
                            }

                            if ( ! is_null( $szSrc ) )
                            {
                                if ( ! empty( $this->szCaption ) )
                                {
                                    $szRetVal = '<figure>';
                                }

                                $szRetVal .= "{$this->szLeader}{$szIndent}<iframe width=\"{$this->iWidth}\" height=\"{$this->iHeight}\" src=\"{$szSrc}\" frameborder=\"0\" {$szClass} {$szAllowFullScreen}></iframe>";

                                if ( ! empty( $this->szCaption ) )
                                {
                                    $szRetVal .= "<figcaption><a href=\"{$szSrc}\">{$this->szCaption}</a></figcaption></figure>";
                                }
                                $szRetVal .= $this->szTrailer;
                            }
                            else
                            {
                                $szRetVal = 'VIDEO IN IFRAME HAS NO SOURCE';
                            }
                        }
                        else
                        {
                            //echo "<p style=\"font-size:2em;color:blue;\">" . __METHOD__ . "() at line " . __LINE__ . ": {$szTheType}</p>\n";
                            $szPreloadClause = '';
                            if ( ! empty( $this->szPreload ) && STR_iInList( array('none','auto','metadata'),$this->szPreload ) )
                            {
                                $szPreloadClause = " preload=\"{$this->szPreload}\"";
                            }   /* if ( ! empty( $this->szPreload ) && STR_iInList( array('none','auto','metadata'),$this->szPreload) ) */

                            $szAutoplayClause = '';
                            if ( $this->Autoplay )      /* If autoplay required */
                            {
                                $szAutoplayClause = " autoplay";
                            }   /* if ( $this->Autoplay ) */

                            $szLoopClause = '';
                            if ( $this->Loop )          /* If loop required */
                            {
                                $szLoopClause = " loop";
                            }   /* if ( $this->Loop ) */

                            $szControlClause = '';
                            if ( $this->Controls )      /* If controls required */
                            {
                                $szControlClause = " controls";
                            }   /* if ( $this->Controls ) */

                            $szSrcClause  =
                            $szSrcClause2 =
                            '';

                            if ( count( $this->aSrc ) < 1 )
                            {
                                if ( ! empty( $this->szSrc ) )
                                {
                                    $szSrcClause2 = " src=\"$this->szSrc\"";
                                }
                            }
                            else
                            {
                                foreach ( $this->aSrc as $szSrc )
                                {
                                    $szSrcClause .= "<source src=\"{$szSrc}\" />\n";
                                }
                            }

                            $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szControlClause}{$szSrcClause2}{$szAutoplayClause}{$szLoopClause}{$szAttrs}{$szPreloadClause}>{$this->szInnerLeader}\n";
                            $szRetVal   .= $szSrcClause;

                            foreach( $this->aObjects as $oObj )
                                $szRetVal .= $oObj;
                            $szRetVal   .= "{$this->szText}{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                        }
                    }
                    break;
                //case    'video'     :   $szRetVal   .= "{$this->szLeader}{$szIndent}<video{$szAttrs}>{$this->szInnerLeader}";
                //                        foreach( $this->aObjects as $oObj )
                //                            $szRetVal .= $oObj;
                //                        $szRetVal   .= "{$this->szText}{$this->szInnerTrailer}</video>{$this->szTrailer}";
                //                        break;
                case    'citation'  :
                case    'blockquote':   $szCite      = $this->BuildCite();
                                        $szRetVal   .= "{$this->szLeader}{$szIndent}<blockquote{$szAttrs}{$szCite}>{$this->szInnerLeader}{$this->szText}{$this->szInnerTrailer}</blockquote>{$this->szTrailer}";
                                        break;
                // Doit encore être testé (ne peut s'ajouter que sur une div ou un p)
                case    'q'         :   $szCite      = $this->BuildCite();
                                        $szRetVal   .= "{$this->szLeader}{$szIndent}<q{$szAttrs}{$szCite}>{$this->szInnerLeader}{$this->szText}{$this->szInnerTrailer}</q>{$this->szTrailer}";
                                        break;
                case    'text'      :   //$this->DebugMsg( "Je devrais rendre du texte",__METHOD__,__LINE__ );
                                        $szRetVal   .= "{$this->szLeader}{$szIndent}{$this->szValue}{$this->szTrailer}";
                                        break;
                case    'script'    :   {
                                            $szRetVal   .= "{$this->szLeader}" . MISC_Script( $this->szText ) . "{$this->szTrailer}";
                                        }
                                        break;
                case    'dd'        :
                case    'dt'        :
                case    'li'        :
                    {
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szAttrs}>{$this->szInnerLeader}{$this->szText}";
                        foreach( $this->aObjects as $oObj )
                            $szRetVal .= $oObj;
                        $szRetVal   .= "{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                    }
                    break;
                // Dans le cas de ol, ul et dl ... on devrait être capable d'importer
                // les données depuis un XML pour remplir la liste de manière
                // automatique!!!
                case    'datalist'  :
                    {
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szAttrs}>{$this->szInnerLeader}";
                        $szRetVal   .= $this->RenderItems();
                        $szRetVal   .= "{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                    }
                    break;
                case    'dl'        :
                case    'ul'        :
                case    'ol'        :
                    {
                        // Il faut encore que je puisse gérer une donnée de type
                        // XML string au lieu de XML file. C'est un autre type
                        // de RowSourceType!!!
                        // Aussi gérer une colonne de grid
                        // Aussi gérer un curseur
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szAttrs}>{$this->szInnerLeader}";
                        // Either we will populate from an XML file and therefore the
                        // <li>...</li> will be generated automatically by the
                        // RenderItems() method ...
                        if     ( $this->iRowSourceType === ROW_SOURCE_TYPE_XML )
                        {
                            $this->PopulateFromXML();
                            $szRetVal .= $this->RenderItems();
                        }   /* if ( $this->iRowSourceType === ROW_SOURCE_TYPE_XML ) */
                        elseif ( $this->iRowSourceType === ROW_SOURCE_TYPE_ARRAY )
                        {
                            $this->PopulateFromArray();
                            $szRetVal .= $this->RenderItems();
                        }   /* elseif ( $this->iRowSourceType === ROW_SOURCE_TYPE_ARRAY ) */
                        elseif ( $this->iRowSourceType === ROW_SOURCE_TYPE_VALUES )
                        {
                            $this->PopulateFromValues();
                            $szRetVal .= $this->RenderItems();
                        }   /* elseif ( $this->iRowSourceType === ROW_SOURCE_TYPE_ARRAY ) */
                        elseif ( count( $this->aItems ) > 0 )
                        {
                            $szRetVal .= $this->RenderItems();
                        }
                        else
                        {   // ... or we should enumerate the inner objects so that we can
                            // render them accordingly.
                            //echo "<p style=\"font-size:2em;color:red;\">PAS DE ROW_SOURCE_TYPE pour {$this->szID}</p>\n";
                            foreach( $this->aObjects as $oObj )
                                $szRetVal .= $oObj;
                        }
                        $szRetVal   .= "{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                    }
                    break;
                case    'comment'   :
                    {
                        //$this->DebugMsg( "Render d'un commentaire",__METHOD__,__LINE__ );
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<!-- {$this->szInnerLeader}{$this->szText}{$this->szInnerTrailer} -->{$this->szTrailer}";
                    }
                    break;
                case    'style'     :
                    {
                        $szRetVal   .= "{$this->szLeader}{$szIndent}<{$szTheType}{$szAttrs}>{$this->szInnerLeader}";
                        foreach( $this->aObjects as $oObj )
                            $szRetVal .= $oObj;
                        $szRetVal   .= "{$this->szText}{$this->szInnerTrailer}</{$szTheType}>{$this->szTrailer}";
                    }
                    break;
                default             :   //$this->DebugMsg( "Unknown type: '$szTheType'",__METHOD__,__LINE__ );
            }   /* switch ( $this->szType ) */
        }   /* if ( $this->szType ) */

        return ( $szRetVal );                                       /* Return result to the caller */
    }   /* End of Tag.Render() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /**
     *  Builds a specific attribute of a tag
     *  @return     string          The complete 'style' attribute
     */
    /* ================================================================================ */
    public function build( $szAttr = null )
    /*-----------------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        //echo "<p>Line ",__LINE__," of ",__METHOD__,"</p>";

        switch( $szAttr )
        {
            case 'style':
                {
                    $szRetVal = $this->szStyle;
                    //echo "<p>Line ",__LINE__," of ",__METHOD__,"Le style positionné est ",$this->szStyle,"</p>";

                    if ( $this->iTop    ||
                         $this->iLeft   ||
                         $this->iWidth  ||
                         $this->iHeight )
                    {
                        if ( $this->iTop )
                        {
                            if ( ! strstr( $szRetVal,'top:' ) )
                            {
                                $szRetVal .= "top:{$this->iTop}{$this->szPixels};";
                            }
                        }

                        if ( $this->iLeft )
                        {
                            if ( ! strstr( $szRetVal,'left:' ) )
                            {
                                $szRetVal .= "left:{$this->iLeft}{$this->szPixels};";
                            }
                        }

                        if ( $this->iWidth )
                        {
                            if ( ! strstr( $szRetVal,'width:' ) )
                            {
                                $szRetVal .= "width:{$this->iWidth}{$this->szPixels};";
                            }
                        }

                        if ( $this->iHeight )
                        {
                            if ( ! strstr( $szRetVal,'height:' ) )
                            {
                                $szRetVal .= "height:{$this->iHeight}{$this->szPixels};";
                            }
                        }

                    }

                    //echo "<p>Line ",__LINE__," of ",__METHOD__,"</p>";

                    if ( ! empty( $szRetVal ) )
                    {
                        //echo "<p>Line ",__LINE__," of ",__METHOD__,"</p>";
                        $szRetVal = " style=\"{$szRetVal}\"";
                    }
                }
                break;
            case 'onclauses'    :
                {
                    if ( ! empty( $this->szOnSubmit ) )
                    {
                        $szRetVal .= " onsubmit=\"{$this->szOnSubmit}\"";
                    }   /* if ( ! empty( $this->szOnSubmit ) ) */

                    if ( ! empty( $this->szOnClick ) )
                    {
                        $szRetVal .= " onclick=\"{$this->szOnClick}\"";
                    }   /* if ( ! empty( $this->szOnClick ) ) */

                    if ( ! empty( $this->szOnKeyPress ) )
                    {
                        $szRetVal .= " onkeypress=\"{$this->szOnKeyPress}\"";
                    }   /* if ( ! empty( $this->szOnKeyPress ) ) */

                    if ( ! empty( $this->szOnKeyUp ) )
                    {
                        $szRetVal .= " onkeyup=\"{$this->szOnKeyUp}\"";
                    }   /* if ( ! empty( $this->szOnKeyUp ) ) */

                    if ( ! empty( $this->szOnKeyDown ) )
                    {
                        $szRetVal .= " onkeydown=\"{$this->szOnKeyDown}\"";
                    }   /* if ( ! empty( $this->szOnKeyDown ) ) */

                    if ( ! empty( $this->szOnChange ) )
                    {
                        $szRetVal .= " onchange=\"{$this->szOnChange}\"";
                    }   /* if ( ! empty( $this->szOnChange ) ) */
                }
                break;
        }   /* switch( $szAttr ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Tag.build() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected BuildTitle( $szTitle )=

        Generates the title of the tag (if any)

        {*params
            $szTitle    (string)        Optional title (tooltip)
        *}

        {*return
            (string)        Title clause of the tag (title="...")
        *}

        *}}
     */
    /* ================================================================================ */
    protected function buildTitle( $szTitle = null )
    /*--------------------------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        if     ( is_null( $szTitle ) && isset( $this->szTooltip ) && ! STR_Empty( $this->szTooltip ) )
        {
            $szTitle = $this->szTooltip;
        }   /* if ( is_null( $szTitle ) && isset( $this->szTooltip ) ... */
        elseif ( is_null( $szTitle ) && isset( $this->szTitle ) && ! STR_Empty( $this->szTitle ) )
        {
            $szTitle = $this->szTitle;
        }   /* Elseif ... ( is_null( $szTitle ) && isset( $this->szTitle ) ... ) */

        if ( ! empty( $szTitle ) )                                  /* If title set */
        {
            $szRetVal = " title=\"{$szTitle}\"";                    /* Build the title string */
        }   /* if ( $this->szID ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Tag.BuildTitle() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected BuildLang()=

        Generates the language of the tag (if any)

        {*params
        *}

        {*return
            (string)        Language clause of the tag (lang="...")
        *}

        {*author {PYB} *}
        {*noassert *}

        *}}
     */
    /* ================================================================================ */
    protected function buildLang()
    /*--------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        if ( $this->szLang )                                        /* If language set */
        {
            // Attention ... il pourrait y avoir une différence
            // avec du XHTML (xml:lang="...")
            $szRetVal = " lang=\"{$this->szLang}\"";                /* Form the lang string */
        }   /* if ( $this->szLang ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Tag.buildLang() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*buildIndent()=

        Generates necessary indentation spaces

        {*params
        *}

        {*return
            (string)    A number of spaces depending on the indentation level
        *}
        *}}
     */
    /* ================================================================================ */
    public function buildIndent()
    /*-------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        if ( $this->iIndentSpaces > 0 && $this->iIndentLevel > 0 )
        {
            $szRetVal .= str_repeat( ' ',$this->iIndentSpaces * $this->iIndentLevel );
        }   /* if ( $this->iIndentSpaces > 0 && $this->iIndentLevel > 0 ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Tag.buildIndent() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected buildAlt()=

        Generates the 'alt' of the tag (if any)

        {*params
        *}

        {*return
            (string)    The alt attribute [c]' alt="..."'[/c];
        *}

        {*exec
            $oP   = new LSTag();
            $oImg = new LSTag( 'img' );
            $oImg->szSrc = '/vaesoli/resources/images/continent-saturate-loss.jpg';
            $oImg->szAlt = 'A saturate loss image as an example of Vae Soli! image functions';
            $oP->AddObject( $oImg );

            echo ( $szHTML = $oP );

            echo LSUnitTesting::assert( strstr( $szHTML,'<p><img' )                             ,
                                        'ASSERTION SUCCESS: p and img tags created successfully',
                                        'ASSERTION FAILURE: p and img tags COULD NOT be created',
                                        'GuideAssert' );
            echo LSUnitTesting::assert( strstr( $szHTML,'alt="A saturate' )                         ,
                                        'ASSERTION SUCCESS: img alt attribute created successfully' ,
                                        'ASSERTION FAILURE: img alt attribute COULD NOT be created' ,
                                        'GuideAssert' );
        *}

        *}}
     */
    /* ====================================================================== */
    protected function BuildAlt()
    /*-------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        if ( $this->szAlt )                                         /* If Alternate set */
        {
            $szRetVal = " alt=\"{$this->szAlt}\"";                  /* Form the alt string */
        }   /* if ( $this->szAlt ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of LSTag.BuildAlt() ========================================== */


    /* ================================================================================ */
    /**
     *  Generates the 'style' attribute
     *  @return     string          The complete 'style' attribute
     */
    /* ================================================================================ */
    public function buildStyle()
    /*------------------------*/
    {
        //echo "<p>Line ",__LINE__," of ",__METHOD__,"</p>";
        return ( $this->Build( 'style' ) );
    }   /* End of LSTag.BuildStyle() */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected buildID()=

        Generates the ID of the tag (if any)

        {*params
        *}

        {*return
            (void)      No return
        *}

        *}}
    */
    /* ================================================================================ */
    protected function buildID()
    /*------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        $szID = null;                                               /* Set a null by default */

        if     ( ! empty( $this->identifier ) )                     /* If we have an identifier */
            $szID = $this->identifier;                              /* ... use the identifier */
        elseif ( ! empty( $this->szGUID     ) )                     /* If we have a GUID */
            $szID = $this->szGUID;                                  /* ... use the GUID */
        else
            $szID = $this->szID;                                    /* Use the ID */

        if ( ! empty( $szID ) )                                     /* If ID set */
        {
            $szRetVal = " id=\"{$szID}\"";                          /* Form the ID string */
        }   /* if ( $this->szID ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Tag.BuildID() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected buildClass()=

        Builds the class attribute of the tag

        {*params
        *}

        {*return
            (string)    The [c]' class="..."'[/c] attribute
        *}

        *}}
     */
    /* ================================================================================ */
    protected function buildClass()
    /*---------------------------*/
    {
        // from LSTag.class.php $szClass  = '';
        // from LSTag.class.php $szClass2 = '';

        // from LSTag.class.php if ( property_exists( $this,"IsMandatory" ) && $this->IsMandatory )
        // from LSTag.class.php {
        // from LSTag.class.php     $szClass2 = ' LSInputRequired';
        // from LSTag.class.php }
        // from LSTag.class.php elseif ( $this instanceof LSLabel )
        // from LSTag.class.php {
        // from LSTag.class.php     if ( $this->szFor && is_object( $this->szFor ) )
        // from LSTag.class.php     {
        // from LSTag.class.php         $oObj = $this->szFor;
        // from LSTag.class.php
        // from LSTag.class.php         if ( property_exists( $oObj,"IsMandatory" ) && $oObj->IsMandatory )   /* If the IsMandatory property exists in this object and this object is mandatory */
        // from LSTag.class.php         {
        // from LSTag.class.php             $szClass2 = ' LSInputRequired';
        // from LSTag.class.php         }
        // from LSTag.class.php     }
        // from LSTag.class.php }
        // from LSTag.class.php
        // from LSTag.class.php if ( $this->szClass || strlen( $szClass2 ) > 0 )
        // from LSTag.class.php {
        // from LSTag.class.php     $szClass = trim( "{$this->szClass}{$szClass2}" );
        // from LSTag.class.php }
        // from LSTag.class.php
        // from LSTag.class.php if ( strlen( $szClass ) )
        // from LSTag.class.php {
        // from LSTag.class.php     $szClass = " class=\"{$szClass}\"";
        // from LSTag.class.php }

        if ( ! empty( $this->szClass ) )
            $szClass = " class=\"{$this->szClass}\"";
        else
            $szClass = '';

        return ( $szClass );
    }   /* End of Tag.buildClass() ==================================================== */
    /* ================================================================================ */


    /* ====================================================================== */
    /**
     *  Determines the BROWSER that is used to render the tag|control
     *  @return     string          The Browser of the user (opera, chrome, iPad, iPhone, internet explorer, ...)
     */
    /* ====================================================================== */
    public function whatBrowser()
    /*-------------------------*/
    {
        if ( ! is_null( self::$szBrowser ) )
        {
            //echo "<p style=\"font-size:4em;color:blue;\">QUICK: Mon browser est " . self::$szBrowser . "</p>\n";
            //echo "<p style=\"font-size:4em;color:blue;\">QUICK: Ma plateforme est " . self::$szPlatform . "</p>\n";
            return ( self::$szBrowser );
        }

        //echo "<p style=\"font-size:2em;color:red;\">JE VAIS DETECTER LE BROWSER ET LA PLATEFORME</p>\n";

        if ( ! array_key_exists( 'HTTP_USER_AGENT',$_SERVER ) )
        {
            self::$szBrowser = 'Illegal tentative';
            return ( self::$szBrowser );
        }   /* if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) ) */

        $szBrowser = $_SERVER['HTTP_USER_AGENT'];                   /* Web browser */
        //echo $_SERVER['HTTP_USER_AGENT'];

        /* Browser first ======================================================== */
        if     ( preg_match( '/.*Mozilla\/5.*MSIE.*/si',$szBrowser ) )
        {
            $szRetVal = 'ie';
        }
        //elseif ( preg_match( '/Mozilla.*Chrome\/(12.0)|(13.0)|(14.0)|(15.0)|(16.0)|(17.0)|(18.0)|(19.0)|(20.0)|(21.0).*/si',$szBrowser) )
        //elseif ( preg_match( '%Mozilla.*chrome/(12\.0|13\.0|14\.0|15\.0|16\.0|17\.0|18\.0|19\.0|20\.0|21\.0|22\.0|23\.0|24\.0|25\.0|26\.0|27\.0|28\.0|29\.0|35\.0)%si',$szBrowser) )
        elseif ( preg_match( '%Mozilla.*chrome/(\d{1,2}\.\d{1,2})%si',$szBrowser ) )
        {
            $szRetVal = 'chrome';
        }
        //elseif ( preg_match( '/.*Mozilla\/5.*Firefox\/(7.0.1)|(11.0).*/si',$szBrowser ) )
        elseif ( preg_match( '%mozilla.*firefox/(7\.0\.1|11\.0|14\.0|15\.0|16\.0|17\.0|18\.0|19\.0)%si',$szBrowser ) )
        {
            //echo "<p style=\"font-size:2em;color:red;\">Je matche Firefox</p>\n";
            $szRetVal = 'firefox';
        }
        elseif ( preg_match( '%mozilla.*version\/(4\.0|5\.0|5\.1|6\.0).*Safari%si',$szBrowser ) )
        {
            //echo "<p style=\"font-size:2em;color:red;\">Je matche Safari</p>\n";
            $szRetVal = 'safari';
        }
        elseif ( preg_match( '/.*opera\/9\.80.*(iPhone|iPad).*opera mini/si',$szBrowser) )
        {
            $szRetVal = 'opera-mini';
        }
        elseif ( preg_match( '/opera\/9\.80.*version\/(10\.6|11\.0|11\.1|11\.51|11\.5|11\.61|11\.62|12\.0|12\.1).*/si',$szBrowser ) )
        {
            $szRetVal = 'opera';
        }
        elseif ( preg_match( '/Mozilla\/5.*iPhone.*Version\/.*Safari.*/si',$szBrowser ) )
        {
            $szRetVal = 'iphone';
        }
        elseif ( preg_match( '/Mozilla\/5.*iPad.*Version\/.*Safari.*/si',$szBrowser ) )
        {
            $szRetVal = 'ipad';
        }
        elseif ( preg_match( '/Mozilla\/5.*Android.*Mobile*/si',$szBrowser ) )
        {
            $szRetVal = 'android';
        }
        else
        {
            //echo __CLASS__,"(UA=$szBrowser)";
            $szRetVal = 'unknown';
        }

        /* Platform next ========================================================= */
        if     ( preg_match( '/.*Windows.*/si',$szBrowser ) )
        {
            self::$szPlatform = 'windows';
        }
        elseif     ( preg_match( '/.*iPhone OS.*/si',$szBrowser ) )
        {
            self::$szPlatform  = 'ios';
        }
        elseif     ( preg_match( '/.*Linux.*/si',$szBrowser ) )
        {
            self::$szPlatform  = 'linux';
        }
        else
        {
            self::$szPlatform  = 'unknown';
        }

        self::$szBrowser = $szRetVal;
        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Tag.whatBrowser() =================================================== */
    /* ================================================================================ */


    public function getBrowser()
    /*------------------------*/
    {
        return ( self::$szBrowser );
    }   /* End of Tag.getPlatform() =================================================== */
    /* ================================================================================ */


    public function getPlatform()
    /*-------------------------*/
    {
        return ( self::$szPlatform );
    }   /* End of Tag.getPlatform() =================================================== */
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
    }   /* End of Tag.__destruct() ==================================================== */
    /* ================================================================================ */
}   /* End of class Tag */
