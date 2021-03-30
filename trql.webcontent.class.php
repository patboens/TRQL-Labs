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
    {*file                  trql.webcontent.class.php *}
    {*purpose               WebContent is a type representing all WebPage, WebSite
                            and WebPageElement content. It is sometimes the case that
                            detailed distinctions between Web pages, sites and their
                            parts is not always important or obvious. The WebContent
                            type makes it easier to describe Web-addressable content
                            without requiring such distinctions to always be stated.
                            (The intent is that the existing types WebPage, WebSite
                            and WebPageElement will eventually be declared as
                            subtypes of WebContent.) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 03:29 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keyword               web *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 03:29 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\CreativeWork         as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'WEBCONTENT_CLASS_VERSION' ) or define( 'WEBCONTENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class WebContent=

    {*desc

        WebContent is a type representing all WebPage, WebSite and WebPageElement
        content. It is sometimes the case that detailed distinctions between Web
        pages, sites and their parts is not always important or obvious. The WebContent
        type makes it easier to describe Web-addressable content without requiring such
        distinctions to always be stated. (The intent is that the existing types
        WebPage, WebSite and WebPageElement will eventually be declared as subtypes
        of WebContent.)

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/WebContent[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
    *}

    *}}
 */
/* ==================================================================================== */
class WebContent extends CreativeWork
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q3948731';       /* {*property   $wikidataId                 (string)                        Wikidata ID. content encountered as part of 
                                                                                                                                                the user experience on websites *} */

    public      $content                        = null;             /* {*property   $content                    (string)                        Payload. *} */


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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of WebContent.__construct() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*toc()=

        Creates a Table of Content from the h1 .. h6 headers

        {*params
        *}

        {*return
            (string)        HTML that represents the TOC or [c]null[/c] if no header
                            found
        *}

        {*remark            Many additional features need to be developed such as
                            links to content, ...
        *}}
    */
    /* ================================================================================ */
    public function toc( &$szContent = null )
    /*-------------------------------------*/
    {
        $szRetVal = null;

        if ( is_null( $szContent ) )
            $szContent = $this->content;

        //if ( preg_match_all( '%<h(?P<level>[1-6])\b[^>]*>(?P<title>.*?)</h\k<level>\g{1}>%si',$oSourceFile->content,$aMatches,PREG_PATTERN_ORDER ) )
        //if ( preg_match_all( '%<h[1-6]\b[^>]*>(?P<title>.*?)</h\g>%si',$oSourceFile->content,$aMatches,PREG_PATTERN_ORDER ) )
        //if ( preg_match_all( '<h1\b[^>]*>(?P<title>.*?)</h\g{1}>%si',$oSourceFile->content,$aMatches,PREG_PATTERN_ORDER ) )
        if ( preg_match_all( '%<h([1-6])\b[^>]*>(.*?)</h\g{1}>%si',$szContent,$aMatches,PREG_PATTERN_ORDER ) )
        {
            $aAllHeaders = $aMatches[0];
            //var_dump( $aAllHeaders );

            $szRetVal       = '';
            $iStructCount   = 
            $iPreviousLevel = 0;

            foreach( $aAllHeaders as $szHeader )
            {
                if ( preg_match( '%<h(?P<level>[1-6])\b(?P<rest>[^>]*)>(?P<title>.*?)</h\g{1}>%si',$szHeader,$aParts ) )
                {
                    $iLevel     = (int) $aParts['level'];
                    $szTitle    =       $aParts['title'];
                    $szID       = null;

                    /* Let's look for an ID (id="...") */
                    if ( ! empty( $aParts['rest'] ?? '' ) )
                    {
                        //var_dump( $aParts );
                        if ( preg_match( '/id=("|\')(?P<id>.*?)("|\')/si',$szHeader,$aParts ) )
                            $szID = $aParts['id'];
                    }   /* if ( ! empty( $aParts['rest'] ?? '' ) ) */
                    
                    if     ( $iLevel > $iPreviousLevel )
                    {
                        //echo "<p>OL: {$iLevel} - {$szTitle}</p>\n";
                        $szRetVal .= "<ol> <!-- New (h{$iLevel}) -->\n";
                        if ( ! is_null( $szID ) )
                            $szRetVal .= "<li><a href=\"#{$szID}\">{$szTitle}</a></li>\n";
                        else
                            $szRetVal .= "<li>{$szTitle}</li>\n";

                        $iStructCount++;
                    }
                    elseif ( $iLevel === $iPreviousLevel )
                    {
                        //$szRetVal .= "<p>LI: {$iLevel} - {$szTitle}</p>\n";
                        if ( ! is_null( $szID ) )
                            $szRetVal .= "<li><a href=\"#{$szID}\">{$szTitle}</a></li>\n";
                        else
                            $szRetVal .= "<li>{$szTitle}</li>\n";
                    }
                    elseif ( $iLevel < $iPreviousLevel )
                    {
                        $iDiff = abs( $iLevel - $iPreviousLevel );
                        //$szRetVal .= "<li>GO BACK FROM {$iPreviousLevel} TO {$iLevel} = {$iDiff} DIFF</li>";
                        //if ( $iDiff > 1 )
                        //    $szRetVal .= "<li>PLUSIEURS NIVEAUX</li>";
                        //$szRetVal .= "<p>/OL: {$iLevel} - {$szTitle}</p>\n";
                        $szRetVal .= str_repeat( "</ol>\n",$iDiff ) . " <!-- End (h{$iLevel}) -->\n";

                        if ( ! is_null( $szID ) )
                            $szRetVal .= "<li><a href=\"#{$szID}\">{$szTitle}</a></li>\n";
                        else
                            $szRetVal .= "<li>{$szTitle}</li>\n";

                        $iStructCount -= $iDiff;
                    }

                    $iPreviousLevel = $iLevel;
                }
                else
                {
                    //$szRetVal .= "<p>STRANGE</p>\n";
                }
            }

            if ( $iStructCount != 0 )
            {
                //echo( "structures qui restent ouvertes: " . $iStructCount );
                $szRetVal .= str_repeat( "</ol>\n",$iStructCount );
            }
        }   /* if ( preg_match_all( '%<h([1-6])\b[^>]*>(.*?)</h\g{1}>%si',... ) ) */

        return ( $szRetVal );
    }   /* End of WebContent.toc() ==================================================== */
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

    }   /* End of WebContent.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class WebContent ======================================================== */
/* ==================================================================================== */
