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
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keywords              Agility *}

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
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\quitus\TaskBoard      as TaskBoard;

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

    *}}

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

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();

        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of KanbanBoard.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType][,$szID] )=

        Renders the kanbanboard in XML or in HTML (default)

        {*params
            $szType         (string)        Output type. Optional. [c]'HTML'[/c] by 
                                            default.
        *}

        {*return
            (string)        HTML Code

            [br][br][br] Can produce the following rendering:[br][br]
            [img]https://raw.githubusercontent.com/patboens/TRQL-Labs/63c894e349e2b41753ce4027c47fcd28f3210b89/images/kanban-board-b26ece14-fbc7-4586-a049-84a6878d1e92.jpg[/img]
            [br][br]

        *}

        *}}
    */
    /* ================================================================================ */
    public function render( $szType = 'html',$szID = null ): string
    /*-----------------------------------------------------------*/
    {
        $szRetVal = '';

        switch( strtolower( trim( $szType ) ) )
        {
            case 'xml'  :   $szRetVal = $this->__toXML();
                            break;
            case 'html' :
            default     :   $szRetVal = $this->__toHTML( $szID );
        }   /* switch( strtolower( trim( $szType ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of KanbanBoard.render() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( $szFile )=

        Saves the %class% object to $szFile

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
    /** {{*__toHTML( $szID )=

        Renders %class% in HTML

        {*params
            $szID       (string)        Optional ID of the whole HTML section
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
    public function __toHTML( $szID = null ): string
    /*---------------------------------------------*/
    {
        // Calls TaskBoard.__toHTML();
        return ( parent::__toHTML( $szID ) );
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

        {*example

        $o = new KanbanBoard();
        var_dump( [b]$o->__toArray()[/b] );

        |** This produces the following output:

          array (size=29)
            '�*�self' => 
              array (size=10)
                'file' => string 'D:\websites\snippet-center\trql.kanbanboard.class.php' (length=53)
                'class' => string 'trql\kanbanboard\KanbanBoard' (length=28)
                'name' => string 'kanbanboard' (length=11)
                'birth' => float 1615017947.7907
                'home' => string 'D:\websites\snippet-center\q\common\trql.classes.home\trql.kanbanboard.class' (length=76)
                'family' => 
                  array (size=934)
                    0 => string 'D:\websites\snippet-center\trql.APIHandler.class.php' (length=52)
                    1 => string 'D:\websites\snippet-center\trql.aboutpage.class.php' (length=51)
                    2 => string 'D:\websites\snippet-center\trql.academicdiscipline.class.php' (length=60)
                    3 => string 'D:\websites\snippet-center\trql.acceptaction.class.php' (length=54)
                    4 => string 'D:\websites\snippet-center\trql.accommodation.class.php' (length=55)
                    5 => string 'D:\websites\snippet-center\trql.accountingregister.class.php' (length=60)
                    6 => string 'D:\websites\snippet-center\trql.accountingservice.class.php' (length=59)
                    7 => string 'D:\websites\snippet-center\trql.achieveaction.class.php' (length=55)
                    8 => string 'D:\websites\snippet-center\trql.action.class.php' (length=48)
                    9 => string 'D:\websites\snippet-center\trql.actionaccessspecification.class.php' (length=67)
                    10 => string 'D:\websites\snippet-center\trql.actionstatustype.class.php' (length=58)
                    more elements...
                'UIKey' => string 'trql\kanbanboard\KanbanBoard' (length=28)
                'common' => string 'D:\websites\snippet-center\q\common' (length=35)
                'resources' => string 'D:\websites\snippet-center\q\common\resources' (length=45)
                'icon' => string 'D:\websites\snippet-center\q\common\resources\icons\kanbanboard.png' (length=67)
            'wikidataId' => string 'Q6360939' (length=8)
            '�*�aColumns' => null
            'itemHyperlink' => null
            'szECMAScript' => null
            'additionalType' => null
            'alternateName' => null
            'description' => null
            'disambiguatingDescription' => null
            'image' => null
            'identifier' => null
            'mainEntityOfPage' => null
            'name' => null
            'potentialAction' => null
            'sameAs' => null
            'subjectOf' => null
            'url' => null
            'lastInfo' => 
              array (size=4)
                0 => 
                  array (size=2)
                    'time' => int 1615017947
                    'info' => string 'trql\mother\Mother::updateSelf(): 'D:\websites\snippet-center\q\common\trql.classes.home\trql.mother.class' FOUND' (length=113)
                1 => 
                  array (size=2)
                    'time' => int 1615017947
                    'info' => string 'trql\mother\Mother::updateSelf(): 'D:\websites\snippet-center\q\common\trql.classes.home\trql.thing.class' FOUND' (length=112)
                2 => 
                  array (size=2)
                    'time' => int 1615017947
                    'info' => string 'trql\mother\Mother::updateSelf(): 'D:\websites\snippet-center\q\common\trql.classes.home\trql.taskboard.class' FOUND' (length=116)
                3 => 
                  array (size=2)
                    'time' => int 1615017947
                    'info' => string 'trql\mother\Mother::updateSelf(): 'D:\websites\snippet-center\q\common\trql.classes.home\trql.kanbanboard.class' FOUND' (length=118)
            'learning' => boolean true
            'remembering' => boolean true
            'storing' => boolean true
            '�*�szHome' => string 'D:\websites\snippet-center\q\common\trql.classes.home\trql.kanbanboard.class' (length=76)
            '�*�memory' => null
            '�*�pain' => int 0
            '�*�feelPain' => boolean true
            '�*�family' => 
              array (size=934)
                0 => string 'D:\websites\snippet-center\trql.APIHandler.class.php' (length=52)
                1 => string 'D:\websites\snippet-center\trql.aboutpage.class.php' (length=51)
                2 => string 'D:\websites\snippet-center\trql.academicdiscipline.class.php' (length=60)
                3 => string 'D:\websites\snippet-center\trql.acceptaction.class.php' (length=54)
                4 => string 'D:\websites\snippet-center\trql.accommodation.class.php' (length=55)
                5 => string 'D:\websites\snippet-center\trql.accountingregister.class.php' (length=60)
                6 => string 'D:\websites\snippet-center\trql.accountingservice.class.php' (length=59)
                7 => string 'D:\websites\snippet-center\trql.achieveaction.class.php' (length=55)
                8 => string 'D:\websites\snippet-center\trql.action.class.php' (length=48)
                9 => string 'D:\websites\snippet-center\trql.actionaccessspecification.class.php' (length=67)
                10 => string 'D:\websites\snippet-center\trql.actionstatustype.class.php' (length=58)
                more elements...
            'backupRequired' => boolean true
            'autodocRequired' => boolean true
            'classIcon' => string 'D:\websites\snippet-center\q\common\resources\icons\mother.png' (length=62)
          **|
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
    }   /* End of KanbanBoard.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class KanbanBoard ======================================================= */
/* ==================================================================================== */
