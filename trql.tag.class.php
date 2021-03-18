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
    }   /* End of Tag.__construct() =================================================== */
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
