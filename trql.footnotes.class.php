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
    {*file                  trql.footnotes.class.php *}
    {*purpose               Footnotes to be displayed in a web page *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 12:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 12:50 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\footnotes;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\webpageelement\webpageelement     as WebPageElement;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGEELEMENT_CLASS_VERSION' ) )
    require_once( 'trql.webpageelement.class.php' );

defined( 'FOOTNOTES_CLASS_VERSION' ) or define( 'FOOTNOTES_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Footnotes=

    {*desc

        A [c]Footnotes[/c] object gathers notes in an array. The full
        array of notes can then be rendered later at some point. Notes
        can be added in the flow of a text. Each note is replaced by a
        superscript reference that points to the actual note. When notes
        are all rendered, it is easy to go back to the original text where
        the note was added in the first place.
    *}

 */
/* ==================================================================================== */
class Footnotes extends WebPageElement
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $aNotes             = array();                      /* {*property   $aNotes                      (array)                         An array of notes that must be rendered at some point *} */
    public      $szPrefix           = '';                           /* {*property   $szPrefix                    (string)                        A prefix that will be added to the note counter when it is rendered *} */
    public      $iTeaserLength      = 100;                          /* {*property   $iTeaserLength               (int)                           The length of the teaser *} */
    public      $iStart             = 0;                            /* {*property   $iStart                      (int)                           Counter start. [c]0[/c] by default. DO NOT USE NEGATIVE NUMBERS. *} */

    public      $wikidataId         = null;

    /* ================================================================================ */
    /** {{*__construct( [$x] )=

        Class constructor

        {*params
            $x      (mixed)     Either an integer or a [c]Footnotes[/c] object that is
                                used to initialize the [c]$iStart[/c] reference of the
                                new footnotes object to be created. Optional.
                                [c]null[/c] by default.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}

        {*example {new:1}
            $oNotes = new Footnotes();

            <!-- Here you have HTML code where footnotes will be added in
                 a similar way :

            <p>Our slogan is OSF <?php echo $oNotes->Add( 'Open, simple, fast' ); ?>

            -->

            echo $oNotes->Render();
        *}

        {*exec
            $oNotes1 = new Footnotes( 3 );
            $oNotes1->Add( "Third note" );
            $oNotes1->Add( "Fourth note" );

            $oNotes2 = new Footnotes( $oNotes1 );
            $oNotes2->Add( "Fifth note" );
            $oNotes2->Add( "Sixth note" );

            echo $oNotes1->Render();
            echo $oNotes2->Render();
        *}
    */
    /* ================================================================================ */
    public function __construct(  $x = null )
    /*-------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        if ( ! is_null( $x ) )
        {
            if ( is_integer( $x ) )
            {
                $this->iStart = $x;
            }   /* if ( is_integer( $x ) ) */
            elseif ( $x instanceof Footnotes )
            {
                $this->iStart = count( $x->aNotes ) + ( $x->iStart === 0 ? 1 : $x->iStart );
            }   /* End of ... elseif ( $x instanceof Footnotes ) */
        }   /* if ( ! is_null( $x ) ) */

        return ( $this );
    }   /* End of Footnotes.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Add( $x,$szRef,$bAdd )=

        Adds a new note to the internal array of notes.

        {*params
            $x              (mixed)             Can be either a string or a tag ([c]LSTag[/c]).
                                                Later on, this parameter might be something
                                                different such as a reference, a citation, ...
            $szRef          (string)            Reference that will be assigned to the note that
                                                must be added. Optional. [c]null[/c] by default in
                                                which case the class will create an internal reference
                                                that might change at each generation ([c]md5(guid())[/c]).
            $bAdd           (bool)              Should the note be added or not. Optional.
                                                [c]true[/c] by default. If [c]false[/c], then
                                                $szRef must be passed for the note to be added as it
                                                is supposed to replace the existing reference.
        *}

        {*return
            (string)        HTML code that represents the superscript reference
        *}

        {*example{1}
        *}

        {*exec
            $oNotes                 = new Footnotes();
            $oNotes->szPrefix       = 'Ex-';
            $oNotes->iTeaserLength  = 30;

            echo "<p>Slogan is OSF " . $oNotes->Add( 'Open, simple, fast ... this has been our motto for 25 years' ) . "</p>";
            echo "<p>What's yours?"  . $oNotes->Add( 'Mine is to be true' ) . "</p>";

            LSUnitTesting::assert( strlen( $oNotes->aNotes[0][1] ) === 32                              ,
                                   'ASSERTION SUCCESSFUL: footnote has received a plausible reference' ,
                                   'ASSERTION FAILURE: incorrect reference'                            ,
                                   'GuideAssert' );

            LSUnitTesting::assert( count( $oNotes->aNotes ) === 2                      ,
                                   'ASSERTION SUCCESSFUL: right number of footnotes'   ,
                                   'ASSERTION FAILURE: incorrect count of footnotes'   ,
                                   'GuideAssert' );

            echo "<p>Footnotes</p>";
            echo $oNotes->Render();

        *}

        {*seealso Ref() *}

        *}}
     */
    /* ====================================================================== */
    function Add( $x,$szRef = null,$bAdd = true )
    /*-----------------------------------------*/
    {
        $szRetVal = '';

        /* J'ai mis $x car je prÚvois aussi qu'on puisse ajouter des
           rÚfÚrences, des citations, etc. ce qui demandera des traitements
           particuliers */

        if ( is_string( $x ) )                                      /* If string */
        {
            if ( $bAdd )                                            /* If footnote needs to be added */
            {
                if ( ! $szRef )                                     /* If no reference passed */
                {
                    $szRef = md5( $this->guid() );                  /* Create a reference ourselves */
                }   /* if ( ! $szRef ) */

                $this->aNotes[] = array( $x,$szRef );               /* Add text and reference to the array of notes */
                $i = count( $this->aNotes ) + ( $this->iStart > 0 ? $this->iStart - 1 : 0 );        /* Note count */
                $szTeaser = nl2br( trim( vaesoli::STR_Left( vaesoli::STR_Reduce( strip_tags( $x ),' ' ),$this->iTeaserLength ) ),'' );/* Little teaser */

                if ( vaesoli::STR_right( $szTeaser,3 ) != '...' &&           /* If text not terminated by "..." or by "à" */
                     vaesoli::STR_right( $szTeaser,1 ) != '&hellip;'
                   )
                {
                    $szTeaser .= "&hellip;";                        /* Add ellipses */
                }

                $szRetVal = "<a class=\"TRQLLABS_FOOTNOTE_SRC\" href=\"#dest-{$szRef}\" id=\"src-{$szRef}\" title=\"{$szTeaser}\"><sup>[{$this->szPrefix}{$i}]</sup></a> ";
            }   /* if ( $bAdd ) */
            else   /* Else of ... if ( $bAdd ) */
            {
                if ( $szRef )                                       /* If reference passed */
                {
                    $bFound = false;                                /* Reference NOT found by default */
                    $iCount = count( $this->aNotes );               /* Reference count */

                    for ( $i=0;$i < $iCount;$i++ )                  /* For each reference */
                    {
                        $aNote = $this->aNotes[$i];                 /* This is the note (an array) */

                        if ( $aNote[1] == $szRef )                  /* If reference found */
                        {
                            $bFound = true;                         /* Remember that we have found it */
                            break;                                  /* Stop looking for this reference */
                        }   /* if ( $aNote[1] == $szRef ) */
                    }   /* for ( $i=0;$i < $iCount;$i++ ) */

                    if ( $bFound )                                  /* If we found the reference */
                    {
                        $szTeaser = trim( STR_Left( strip_tags( $this->aNotes[$i++][1] ),100 ) ); /* Little teaser */
                        $i +=  ( $this->iStart > 0 ? $this->iStart - 1 : 0 );
                        $szRetVal = "<a class=\"TRQLLABS_FOOTNOTE_SRC\" href=\"#dest-{$szRef}\" id=\"src-{$szRef}\" title=\"{$szTeaser}\"><sup>[{$this->szPrefix}{$i}]</sup></a> ";
                    }   /* if ( $bFound ) */
                }   /* if ( $szRef ) */
            }   /* End of ... Else of ... if ( $bAdd ) */
        }   /* if ( is_string( $x ) */
        elseif ( $x instanceof LSTag )                              /* If LSTag */
        {
            if ( ! $szRef )                                     /* If no reference passed */
            {
                $szRef = md5( guid() );                         /* Create a reference ourselves */
            }   /* if ( ! $szRef ) */

            $this->aNotes[] = array( $x,$szRef );
            $i = count( $this->aNotes );

            $szRetVal = "<abbr title=\"{$x->szTitle}\">{$x->szText}</abbr>" .
                        "<a class=\"TRQLLABS_FOOTNOTE_SRC\" href=\"#dest-{$szRef}\" id=\"src-{$szRef}\"><sup>[{$this->szPrefix}{$i}]</sup></a> ";
        }   /* End of ... elseif ( $x instanceof LSTag ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of method Footnotes.Add() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Ref( $szRef )=

        Refers to an existing footnote

        {*params
            $szRef  (string)    Reference of the existing footnote
        *}

        {*remark
            A call to Ref() is identical to a call to [c]Add( '',$szRef,false )[/c];
        *}

        {*return
            (string)    HTML code that represents the reference.
        *}

        {*exec
            $oNotes                 = new Footnotes();
            $oNotes->iTeaserLength  = 30;
            $oNotes->iStart         = 4;

            echo "<p>Slogan is OSF " . $oNotes->Add( 'Open, simple, fast ... this has been our motto for 25 years','OSF' ) . "</p>";
            echo "<p>A lot of blahblablah</p>";
            echo "<p>Remember our slogan " . $oNotes->Ref( 'OSF' ) . "</p>";

            echo "<p>Footnotes</p>";
            echo $oNotes->Render();
        *}

        {*seealso Add() *}

        *}}
     */
    /* ================================================================================ */
    function Ref( $szRef )
    /*------------------*/
    {
       return ( $this->Add( '',$szRef,false ) );
    }   /* End of method Footnotes.Ref() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Clear()=

        Clears all footnotes

        {*params
        *}

        {*return
            (void)
        *}

        {*exec
            $oNotes                 = new Footnotes();
            $oNotes->iTeaserLength  = 30;

            echo "<p>Slogan is OSF " . $oNotes->Add( 'Open, simple, fast ... this has been our motto for 25 years' ) . "</p>";
            echo "<p>Our next slogan is WSWWTWDWWSWAWWD " . $oNotes->Add( 'We Say What We Think; We Do What We Say; We Are What We Do!' ) . "</p>";

            $oNotes->Clear();

            if ( count( $oNotes->aNotes ) > 0 )
            {
                echo "<p>Footnotes</p>";
                echo $oNotes->Render();
            }
            else
            {
                echo "<p>No footnote found!</p>";
            }
        *}

        *}}
     */
    /* ================================================================================ */
    function Clear()
    /*------------*/
    {
        $this->aNotes = array();
    }   /* End of method Footnotes.Clear() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Render()=

        Renders all footnotes

        {*params
        *}

        {*return
            (string)    HTML code that represents all the footnotes
        *}

        {*remark
            Notes are rendered in paragraphs:[br]
            [c]<p><a class="TRQLLABS_FOOTNOTE_DEST" href="..." id="..."><sup>...</sup></a> ...</p>[/c]
        *}

        {*example{1}
        *}

        *}}
     */
    /* ================================================================================ */
    function Render()
    /*-------------*/
    {
        $szRetVal = '';

        $i = 1 + ( $this->iStart > 0 ? $this->iStart - 1 : 0 );

        foreach ( $this->aNotes as $aNote )
        {
            if ( is_string( $aNote[0] ) )
            {
                $szRetVal .= "<p><a class=\"TRQLLABS_FOOTNOTE_DEST\" href=\"#src-{$aNote[1]}\" id=\"dest-{$aNote[1]}\"><sup>[{$this->szPrefix}{$i}]</sup></a> &hellip; {$aNote[0]}</p>";
            }
            elseif ( $aNote[0] instanceof LSTag )
            {
                $szRetVal .= "<p><a class=\"TRQLLABS_FOOTNOTE_DEST\" href=\"#src-{$aNote[1]}\" id=\"dest-{$aNote[1]}\"><sup>[{$this->szPrefix}{$i}]</sup></a> &hellip; {$aNote[0]->szTitle}</p>";
            }
            $i++;
        }

        return ( $szRetVal );
    }   /* End of method Footnotes.Render() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Count()=

        Count the number of footnotes

        {*params
        *}

        {*return
            (int)   Count of footnotes
        *}

        *}}
     */
    /* ================================================================================ */
    function Count()
    /*-------------*/
    {
        return ( count( $this->aNotes ) );
    }   /* End of method Footnotes.Count() ============================================ */
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
    }   /* End of Footnotes.__destruct() ============================================== */
    /* ================================================================================ */




}   /* End of class Footnotes ========================================================= */
/* ==================================================================================== */

?>