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
    {*file                  trql.kanbanboard.class.php *}
    {*purpose               Main tool used to implement the Kanban project management 
                            methodology. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-01-21 19:23 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 06-01-21 19:23 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\kanbanboard;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\taskboard\TaskBoard       as TaskBoard;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TASKBOARD_CLASS_VERSION' ) )
    require_once( 'trql.taskboard.class.php' );

defined( 'KANBANBOARD_CLASS_VERSION' ) or define( 'KANBANBOARD_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class KanbanBoard=

    {*desc

        Main tool used to implement the Kanban project management methodology.

    *}


 */
/* ==================================================================================== */
class KanbanBoard extends TaskBoard
/*-------------------------------*/
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
    public      $wikidataId                     = 'Q6360939';       /* {*property   $wikidataId         (string)        Wikidata ID. Main tool used to implement the 
                                                                                                                        Kanban project management methodology. *} */


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
    }   /* End of KanbanBoard.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType] )=

        Renders the form

        {*params
            $szType         (string)        Output type. Optional. 'HTML' by default.
        *}

        {*return
            (string)        HTML Code
        *}

        {*warning

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
    }   /* End of KanbanBoard.render() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( $szFile )=

        Saves the form to $szFile

        {*params
            $szFile         (string)        The file the form must be saved to.
        *}

        {*return
            (boolean)       [c]true[/c] if the form was successfully saved; [c]false[/c]
                            if not.
        *}

        {*warning

            Totalement expérimental ! Bien que la modification manuelle soit possible
            directement dans le fichier sauvé, je trouve qu'il y a trop de propriétés
            qui sont dépendantes de mes classes. Le format de sortie n'est donc pas
            suffisamment neutre. Il ne faudrait sauver que quelques propriétés du
            formulaire dont aItems. Par la suite, nous récupérons juste les données
            dont nous avons besoin et on reconstitue le formulaire.

        *}

        *}}
    */
    /* ================================================================================ */
    function save( $szFile )
    /*--------------------*/
    {
        $bRetVal = false;

        $szXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $szXML .= "<Kanbanboard id=\"{$this->identifier}\" version=\"1.0\">\n\n";
        $szXML .= "</Kanbanboard>\n";

        if ( $fp = fopen( $szFile,"w+" ) )
        {
            $bRetVal = is_int( fwrite( $fp,$szXML ) );
            fclose( $fp );
        }   /* if ( $fp = fopen( $szFile,"w+" ) ) */

        return ( $bRetVal );
    }   /* End of KanbanBoard.save() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Renders the form in HTML

        {*params
        *}

        {*return
            (string)        HTML Code
        *}

        {*warning
            So far (25-12-20 13:29:10), the form is NOT rendered
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toHTML(): string
    /*------------------------------*/
    {
        $szRetVal = parent::__toHTML();

        end:
        return ( $szRetVal );
    }   /* End of KanbanBoard.__toHTML() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the form in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        {*warning
            So far (25-12-20 13:29:10), the form is NOT rendered
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        static $oXML = null;
        $szRetVal = null;


        if ( is_null( $oXML ) )
            $oXML = new XML();

        $oDom                       = new \DOMDocument( '1.0' );

        $oDom->preserveWhiteSpace   = true;
        $oDom->formatOutput         = true;

        if ( $oDom->loadXML( $oXML->__toXML( $this ) ) )
            $szRetVal = $oDom->saveXML();

        end:
        return ( $szRetVal );
    }   /* End of KanbanBoard.__toXML() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toArray()=

        Turns the object into an array

        {*params
        *}

        {*return
            (array)     The array corresponding to the object
        *}

        {*remark
            Protected properties are formatted as: [c]'&#0;*&#0;<property>'[/c] (e.g. [c]'&#0;*&#0;self'[/c])[br]
            Private   properties are formatted as: [c]'&#0;trql\form\Form&#0;<property>'[/c] (e.g. [c]'&#0;trql\form\Form&#0;test'[/c])[br]
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toArray(): array
    /*------------------------------*/
    {
        return ( (array) $this );
    }   /* End of KanbanBoard.__toArray() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Renders the form in HTML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString(): string
    /*--------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of KanbanBoard.__toString() ============================================ */
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

    }   /* End of KanbanBoard.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class KanbanBoard ======================================================= */
/* ==================================================================================== */

?>