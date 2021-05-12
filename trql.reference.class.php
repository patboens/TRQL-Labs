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
    {*file                  trql.reference.class.php *}
    {*purpose               Reference to be displayed in a web page *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 21-11-20 14:18:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 31/08/2013 *}
        {*v 5.4.0013 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 07/09/2013 *}
        {*v 5.4.0015 *}
        {*desc              1)  Possibility to start auto references at
                                a given index.
        *}
    *}

    {*chist
        {*mdate 06/09/2016 *}
        {*v 7.0.0008 *}
        {*desc              1)  Adding prefiex
                            2)  Adding format
        *}
    *}

    {*chist
        {*mdate 11/11/2016 *}
        {*v 7.0.0008 *}
        {*desc              1)  New method: lastIndex()
                            2)  Adding format
        *}
    *}

    {*chist
        {*mdate 21-11-20 14:18:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation but all code based on 
                                [c]LSAutoReference[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\web\WebPageElement    as WebPageElement;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGEELEMENT_CLASS_VERSION' ) )
    require_once( 'trql.webpageelement.class.php' );

defined( 'REFERENCE_CLASS_VERSION' ) or define( 'REFERENCE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Reference=

    {*desc

        A [c]reference[/c] object gathers automatic references and assigns notes
        to each reference. It is a relation between objects.

    *}

    *}}
 */
/* ==================================================================================== */
class Reference extends WebPageElement
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
    public      $aNotes             = array();                      /* {*property   $aNotes                     (array)                         An array of notes that must be rendered at some point *} */
    public      $iIndex             = 1;                            /* {*property   $iIndex                     (int)                           Index start. [c]1[/c] by default. *} */
    public      $bEnclose           = true;                         /* {*property   $bEnclose                   (bool)                          Must the reference be enclosed in the left and right markers
                                                                                                                                                ([c]$szLeftMarker[/c] and [c]$szRightMarker[/c]).
                                                                                                                                                [c]true[/c] by default. *} */
    public      $szLeftMarker       = '(';                          /* {*property   $szLeftMarker               (string)                        Left marker used to enclose the reference. [c]'('[/c] by default.*} */
    public      $szRightMarker      = ')';                          /* {*property   $szRightMarker              (string)                        Right marker used to enclose the reference. [c]')'[/c] by default. *} */
    public      $szPrefix           = '';                           /* {*property   $szPrefix                   (string)                        Prefix of the reference. [c]''[/c] by default. *} */
    public      $szFormat           = '';                           /* {*property   $sz>Format                  (string)                        Format of the output. [c]''[/c] by default. *} */

    public      $wikidataId         = 'Q121769';                    /* {*property   $wikidataId                 (string)                        WikidataID. Relation between objects in which one object 
                                                                                                                                                designates, or acts as a means by which to connect to or 
                                                                                                                                                link to, another object *} */

    /* ================================================================================ */
    /** {{*__construct()=

        Constructs an automatic reference object

        {*params
        *}

        {*return
            (void)
        *}

        {*exec
            $oRef = new Reference();
            echo $oRef->Add( 'pourquoi vous souhaitez vous lancer dans un projet' );
            echo $oRef->Render();

            echo LSUnitTesting::assert( $oRef instanceof Reference                  ,
                                        'ASSERTION SUCCESS: proper class created'   ,
                                        'ASSERTION FAILURE: invalid class'          ,
                                        'GuideAssert' );
        *}

        *}}
     */
    /* ================================================================================ */
    public function __construct( $iIndex = null )
    /*-----------------------------------------*/
    {
        if ( ! is_null( $iIndex ) && is_integer( $iIndex ) && $iIndex >= 1 )
        {
            $this->iIndex = $iIndex;
        }   /* if ( ! is_null( $iIndex ) && is_integer( $iIndex ) && $iIndex >= 1 ) */
    }   /* End of method Reference.__construct() ====================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Add( [$x[,$id]] )=

        Adds a new reference to the internal array of references.

        {*params
            $x      (string)    The note associated to the reference. Optional.
            $id     (mixed)     The ID associated to the reference. Optional.
        *}

        {*return
            (string)        HTML code that represents the superscript reference
        *}

        {*example {new:1}
            $oRef = new Reference();
            echo $oRef->Add( 'pourquoi vous souhaitez vous lancer dans un projet' );
            echo $oRef->Render();
        *}

        *}}
     */
    /* ================================================================================ */
    public function Add( $x = null,$id = null )
    /*---------------------------------------*/
    {
        $szRetVal = '';

        if ( is_string( $x ) && ! STR_Empty( $x ) )
        {
            /* Get the current index */
            $i = (int) $this->iIndex;

            if ( empty( $this->szFormat ) )
            {
                /* If must be enclosed in left and right marks */
                if ( $this->bEnclose )
                    $szRetVal = $this->szPrefix . $this->szLeftMarker . $i . $this->szRightMarker . ' ' . $x;
                else
                    $szRetVal = $this->szPrefix . $i . ' ' . $x;
            }
            else
            {
                $szRetVal = str_replace( array( '%p'                ,   /* Prefix */
                                                '%l'                ,   /* Left mark */
                                                '%r'                ,   /* Right mark */
                                                '%i'                ,   /* Reference */
                                                '%t'                    /* Note associated */
                                              )                     ,
                                         array( $this->szPrefix     ,
                                                $this->szLeftMarker ,
                                                $this->szRightMarker,
                                                (string) $i         ,
                                                $x
                                              ),
                                         $this->szFormat );
            }
        }
        else
        {
            $i = (int) $this->iIndex;
            if ( empty( $this->szFormat ) )
            {
                if ( $this->bEnclose )
                    $szRetVal = $this->szPrefix . $this->szLeftMarker . $i . $this->szRightMarker;
                else
                    $szRetVal = $this->szPrefix . $i;
            }
            else
            {
                $szRetVal = str_replace( array( '%p'                ,
                                                '%l'                ,
                                                '%r'                ,
                                                '%i'                ,
                                                '%t'
                                              )                     ,
                                         array( $this->szPrefix     ,
                                                $this->szLeftMarker ,
                                                $this->szRightMarker,
                                                (string) $i         ,
                                                $x
                                              ),
                                         $this->szFormat );
            }
        }

        $this->aNotes[$i] = $x;                                     /* Save the new reference */
        $this->iIndex++;                                            /* Increment next reference */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of method Reference.Add() ============================================== */
    /* ================================================================================ */


    public function lastIndex()
    /*-----------------------*/
    {
        return ( $this->iIndex - 1 );
    }   /* End of method Reference.lastIndex() ======================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Reset()=

        Reset the internal array of notes and index

        {*params
        *}

        {*return
            (void)
        *}

        *}}
     */
    /* ================================================================================ */
    public function Reset( $oLSAutoReference = null )
    /*---------------------------------------------*/
    {
        $this->iIndex = 1;
        $this->Clear();
    }   /* End of method Reference.Reset() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */

    /** {{*Clear()=

        Clears all internal references

        {*params
        *}

        {*return
            (void)
        *}

        *}}
     */
    /* ================================================================================ */
    public function Clear()
    /*-------------------*/
    {
        $this->aNotes = array();
    }   /* End of method Reference.Clear() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Render( [$x] )=

        Renders all references by default, or a single reference

        {*params
            $x  (mixed) The reference to render. Optional. If not passed, all
                        references are rendered.
        *}

        {*return
            (string)    HTML code that represents all the references, or only
                        one reference if $x was mentioned.
        *}

        {*example{1}
        *}

        *}}
     */
    /* ================================================================================ */
    public function Render( $x = null )
    /*-------------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */

        if ( empty( $x ) )
        {
            foreach ( $this->aNotes as $xKey => $szNote )
            {
                $szRetVal .= ' (' . $xKey . ')' . ( STR_Empty( $szNote ) ? '' : ' ' . $szNote );
            }   /* foreach ( $this->aNotes as $xKey => $szNote ) */
        }
        else
        {
            // MUST STILL BE CODED!
        }

        return ( trim( $szRetVal ) );                               /* Return result to caller */
    }   /* End of method Reference.Render() =========================================== */
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
    }   /* End of Reference.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class Reference ========================================================= */
/* ==================================================================================== */
