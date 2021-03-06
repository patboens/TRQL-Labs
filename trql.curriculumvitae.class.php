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
    {*file                  trql.curriculumvitae.class.php *}
    {*purpose               Summary of career *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-03-21 12:25 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              Job, Work *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 06-03-21 12:25 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\curriculumvitae;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\personaldata\PersonalData     as PersonalData;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERSONALDATA_CLASS_VERSION' ) )
    require_once( 'trql.personaldata.class.php' );

defined( 'CURRICULUMVITAE_CLASS_VERSION' ) or define( 'CURRICULUMVITAE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CurriculumVitae=

    {*desc

        Summary of career

    *}

 */
/* ==================================================================================== */
class CurriculumVitae extends PersonalData
/*--------------------------------------*/
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
    public      $wikidataId                     = 'Q186649';        /* {*property   $wikidataId         (string)        Wikidata ID. Summary of career. *} */

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

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();

        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of CurriculumVitae.__construct() ======================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType] )=

        Renders the %class% in XML or in HTML (default)

        {*params
            $szType         (string)        Output type. Optional. [c]'HTML'[/c] by 
                                            default.
        *}

        {*return
            (string)        HTML or XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function render( $szType = 'html' ): string
    /*----------------------------------------------*/
    {
        $szRetVal = '';

        switch( strtolower( trim( $szType ) ) )
        {
            case 'xml'  :   $szRetVal = $this->__toXML();
                            break;
            case 'html' :
            default     :   $szRetVal = $this->__toHTML();
        }   /* switch( strtolower( trim( $szType ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of CurriculumVitae.render() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( $szFile )=

        Saves the %class% object to $szFile

        {*params
            $szFile         (string)        The file the %class% must be saved to.
        *}

        {*return
            (boolean)       [c]true[/c] if the form was successfully saved; [c]false[/c]
                            if not.
        *}

        {*warning

            EXPERIMENTAL. The neutral XML structure is fake for now (06-03-21 12:29:57)

        *}

        *}}
    */
    /* ================================================================================ */
    function save( $szFile )
    /*--------------------*/
    {
        $bRetVal = false;

        $szXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $szXML .= "<CurriculumVitae id=\"{$this->identifier}\" version=\"1.0\">\n\n";
        $szXML .= "</CurriculumVitae>\n";

        if ( $fp = fopen( $szFile,"w+" ) )
        {
            $bRetVal = is_int( fwrite( $fp,$szXML ) );
            fclose( $fp );
        }   /* if ( $fp = fopen( $szFile,"w+" ) ) */

        return ( $bRetVal );
    }   /* End of CurriculumVitae.save() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Renders %class% in HTML

        {*params
        *}

        {*return
            (string)        HTML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toHTML(): string
    /*------------------------------*/
    {
        return ( parent::__toHTML() );
    }   /* End of CurriculumVitae.__toHTML() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders %class% in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        {*warning

            This is a preview version. It does not work as expected yet.

        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        $szRetVal = '';
        return ( $szRetVal );
    }   /* End of CurriculumVitae.__toXML() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toArray()=

        Turns %class% into an array

        {*params
        *}

        {*return
            (array)     The array corresponding to the object
        *}

        {*remark
            Protected properties are formatted as: [c]'&#0;*&#0;<property>'[/c] (e.g. [c]'&#0;*&#0;self'[/c])[br]
            Private   properties are formatted as: [c]'&#0;trql\form\Form&#0;<property>'[/c] (e.g. [c]'&#0;trql\form\Form&#0;test'[/c])[br]
        *}

        {*example

        $o = new CurriculumVitae();
        var_dump( [b]$o->__toArray()[/b] );

        |** This produces the following output:

            STILL TO BE DOCUMENTED

        **|
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toArray(): array
    /*------------------------------*/
    {
        return ( (array) $this );
    }   /* End of CurriculumVitae.__toArray() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Renders %class% as a string

        {*params
        *}

        {*return
            (string)        HTML Code (same as calling [c]__toHTML()[/c])
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString(): string
    /*--------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of CurriculumVitae.__toString() ======================================== */
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
    }   /* End of CurriculumVitae.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class CurriculumVitae =================================================== */
/* ==================================================================================== */
