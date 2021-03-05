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
    {*file                  trql.taskboard.class.php *}
    {*purpose               A board where tasks are noted *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-01-21 19:23 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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
namespace trql\taskboard;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\thing\Thing               as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'TASKBOARD_CLASS_VERSION' ) or define( 'TASKBOARD_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class TaskBoard=

    {*desc

        A board where tasks are noted.

    *}

    *}}

 */
/* ==================================================================================== */
class TaskBoard extends Thing
/*-------------------------*/
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
    public      $wikidataId                     = null;             /* {*property   $wikidataId         (string)        Wikidata ID. No equivalent. *} */

    protected   $aColumns                       = null;             /* {*property   $aColumns           (array)         The columns of the taskboard. *} */
    public      $itemHyperlink                  = null;             /* {*property   $itemHyperlink      (string)        The link that must be followed when the user clicks on an item of the taskboard. *} */
    public      $szECMAScript                   = null;             /* {*property   $szECMAScript       (string)        The name of an ECMA Script that must be included when rendering the Taskboard *} */


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
    }   /* End of TaskBoard.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType] )=

        Renders the taskboard in HTML or in XML

        {*params
            $szType         (string)        Output type ('[c]XML[/c]' or '[c]HTML[/c]').
                                            Optional. '[c]HTML[/c]' by default.
        *}

        {*return
            (string)        HTML Code
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
    }   /* End of TaskBoard.render() ================================================== */
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
        $szXML .= "<Taskboard id=\"{$this->identifier}\" version=\"1.0\">\n\n";
        $szXML .= "</Taskboard>\n";

        if ( $fp = fopen( $szFile,"w+" ) )
        {
            $bRetVal = is_int( fwrite( $fp,$szXML ) );
            fclose( $fp );
        }   /* if ( $fp = fopen( $szFile,"w+" ) ) */

        return ( $bRetVal );
    }   /* End of TaskBoard.save() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*addColumn( $aColumn )=

        Add a column to the set of columns of the taskboard

        {*params
            $aColumn        (array)     Associative array representing a column
        *}

        {*return
            (self)      The current instance of the class is returned
        *}

        *}}
    */
    /* ================================================================================ */
    public function addColumn( $aColumn )
    /*---------------------------------*/
    {
        $this->aColumns[] = $aColumn;

        return ( $this );
    }   /* End of TaskBoard.addColumn() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Renders the taskboard in HTML

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
        $szRetVal  = '';

        if ( is_array( $this->aColumns ) && count( $this->aColumns ) > 0 )
        {
            if ( ! is_null( $this->szECMAScript ) )
            {
                // Parse 
                $aSrc = explode( ';',str_replace( ',',';',$this->szECMAScript ) );

                foreach ( $aSrc as $szJS )
                    $szRetVal .= "<script src=\"" . trim( $szJS ) . "\"></script>\n";
            }

            //$szRetVal .= "<script>\n";
            //    $szRetVal .= "function dropHandler( ev )\n";
            //    $szRetVal .= "{\n";
            //        $szRetVal .= "ev.stopPropagation();\n";
            //
            //        $szRetVal .= "let oSource = document.getElementById( ev.dataTransfer.getData('text') );\n";
            //        $szRetVal .= "let oTarget = ev.target;\n";
            //
            //        //$szRetVal .= "console.log( 'DROP' );\n";
            //        //$szRetVal .= "console.log( 'ID source: ' + szID );\n";
            //        //$szRetVal .= "console.log( 'EVENT: ',ev );\n";
            //        $szRetVal .= "console.log( oSource );\n";
            //        $szRetVal .= "console.log( oTarget );\n";
            //        $szRetVal .= "console.log( oTarget.nodeName );\n";
            //
            //        $szRetVal .= "if ( oSource && oTarget.nodeName === 'TD' )\n";
            //        //$szRetVal .= "if ( oSource )\n";
            //        $szRetVal .= "{\n";
            //        //$szRetVal .= "    console.log( 'PHASE DE LA SOURCE SOURCE: ' + o.getAttribute('data-phase') );\n";
            //        //$szRetVal .= "    console.log( 'PHASE DU TARGET: ' + ev.target.getAttribute('data-phase') );\n";
            //
            //        // Mettre la phase à la valeur de la phase de la colonne TARGET
            //        $szRetVal .= "    oSource.setAttribute( 'data-phase',ev.target.getAttribute('data-phase') );\n";
            //
            //        $szRetVal .= "    console.log( 'NOUVELLE PHASE DU TARGET: ' + oTarget.getAttribute('data-phase') );\n";
            //
            //        // Ajouter la source dans la zone target
            //        $szRetVal .= "    oTarget.innerHTML += oSource.outerHTML;\n";
            //        // Supprimer la source (puisqu'elle vient d'être déplacée dans la zone target)
            //        $szRetVal .= "    oSource.outerHTML = '';\n";
            //        $szRetVal .= "}\n";
            //    $szRetVal .= "}\n";
            //
            //    $szRetVal .= "function allowDrop( ev )\n";
            //    $szRetVal .= "{\n";
            //        $szRetVal .= "ev.preventDefault();\n";
            //    $szRetVal .= "}\n";
            //
            //    $szRetVal .= "function drag( ev,szID )\n";
            //    $szRetVal .= "{\n";
            //        $szRetVal .= "console.log('IN drag()');\n";
            //        $szRetVal .= "console.log(' IN drag()');\n";
            //        $szRetVal .= "ev.dataTransfer.setData( 'text',szID );\n";
            //    $szRetVal .= "}\n";
            //
            //$szRetVal .= "</script>\n";

            $szRetVal .= "<section class=\"taskboard\" id=\"{$this->identifier}\">\n";
                {   /* Table ================================================== */
                    $szRetVal .= "<table class=\"taskboard shadow {$this->szClass}\" id=\"{$this->identifier}_table\">\n";
                        {   /* thead ========================================= */
                            $szRetVal .= "<thead>\n";
                                $szRetVal .= "<tr>";
                                    foreach( $this->aColumns as $aColumn )
                                    {
                                        $szRetVal .= "<th id=\"{$aColumn['identifier']}\">{$aColumn['title']}</th>\n";
                                    }
                                    //$szRetVal .= "<th>Bubble <a href=\"/help/?q=help-portfolio-kanban#bubble\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
                                    //$szRetVal .= "<th>To Start <a href=\"/help/?q=help-portfolio-kanban#to-start\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
                                    //$szRetVal .= "<th>Started <a href=\"/help/?q=help-portfolio-kanban#started\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
                                    //$szRetVal .= "<th>Closed <a href=\"/help/?q=help-portfolio-kanban#closed\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
                                $szRetVal .= "</tr>";
                            $szRetVal .= "</thead>\n";
                        }   /* thead ========================================= */

                        {   /* tbody ========================================= */
                            $szRetVal .= "<tbody>\n";
                                $szRetVal .= "<tr>";
                                    foreach( $this->aColumns as $aColumn )
                                    {
                                        //var_dump( $aColumn );
                                        $szRetVal .= "<td data-phase=\"{$aColumn['identifier']}\" ondrop=\"dropHandler(event);\" ondragover=\"allowDrop(event);\">";
                                            if ( is_array( $aColumn['items'] ) && count( $aColumn['items'] ) > 0 )
                                                foreach( $aColumn['items'] as $oItem )
                                                {
                                                    //var_dump( $oItem->szStorage );
                                                    //die();

                                                    $szWhoAmI       = $oItem->whoAmI();
                                                    $szTaskIdentity = trim( $oItem->identity() );
                                                    $szPhase        = strtolower( trim( isset( $oItem->szPhase )    ?   /* Defined in an Aspiration */
                                                                                  $oItem->szPhase                   :   /* Defined in an Aspiration */
                                                                                  $oItem->szProgress ) );               /* Defined in a Task */
                                                    $szStorage      = $oItem->szStorage;

                                                    if ( ! empty( $this->itemHyperlink ) )
                                                    {
                                                        $szResolvedLink = $oItem->resolveVars( $this->itemHyperlink );
                                                        //var_dump( $szResolvedLink );
                                                        $szRetVal .= "<span id=\"{$oItem->identifier}\" data-phase=\"{$szPhase}\" data-storage=\"{$szStorage}\" data-item-type=\"{$szWhoAmI}\" class=\"{$szWhoAmI}\" draggable=\"true\" ondragstart=\"drag(event,this.id );\"><a href=\"{$szResolvedLink}&storage=" . $oItem->szStorage . "\">{$szTaskIdentity}</a></span>";
                                                    }
                                                    else
                                                    {
                                                        //var_dump( $oItem );
                                                        //die();
                                                        //$szRetVal .= "<span id=\"{$oItem->identifier}\" data-storage=\"{$oItem->szStorage}\" class=\"" . $oItem->whoAmI() . "\" draggable=\"true\" ondragstart=\"drag(event,this.id )>" . trim( $oItem->identity() ) . "</span>";
                                                        $szRetVal .= "<span id=\"{$oItem->identifier}\" data-phase=\"{$szPhase}\" data-storage=\"{$szStorage}\" data-item-type=\"{$szWhoAmI}\" class=\"{$szWhoAmI}\" draggable=\"true\" ondragstart=\"drag(event,this.id );\">{$szTaskIdentity}</span>";
                                                    }
                                                }   /* foreach( $aColumn['items'] as $oItem ) */
                                        $szRetVal .= "</td>\n";
                                    }   /* foreach( $this->aColumns as $aColumn ) */

                                    //$szRetVal .= $this->renderKanbanColumn( $this->aBubble  ,$WithRAG = false,$szColumnName = "bubble"      );
                                    //$szRetVal .= $this->renderKanbanColumn( $this->aToStart ,$WithRAG = false,$szColumnName = "to-start"    );
                                    //$szRetVal .= $this->renderKanbanColumn( $this->aStarted ,$WithRAG = true ,$szColumnName = "started"     );
                                    //$szRetVal .= $this->renderKanbanColumn( $this->aClosed  ,$WithRAG = true ,$szColumnName = "closed"      );
                                $szRetVal .= "</tr>";
                            $szRetVal .= "</tbody>\n";
                        }   /* tbody ========================================= */
                    $szRetVal .= "</table>\n";
                }   /* Table ================================================== */
            $szRetVal .= "</section><!-- #{$this->identifier} -->\n";
        }

        // 08-01-2020 ... $szGUIDRendering    = "KANBAN_" . q_guid();
        // 08-01-2020 ...
        // 08-01-2020 ... //$oPerf              = new Perf( true );
        // 08-01-2020 ... if ( ! is_array( $this->aAspirations ) || count( $this->aAspirations ) < 1 )
        // 08-01-2020 ... {
        // 08-01-2020 ...     //$tStart = microtime( true );
        // 08-01-2020 ...     $this->findAspirations();
        // 08-01-2020 ...     //$tEnd = microtime( true );
        // 08-01-2020 ...     //var_dump( round( $tEnd - $tStart,2 ) . ' sec to find aspirations' );
        // 08-01-2020 ... }   /* if ( ! is_array( $this->aAspirations ) || count( $this->aAspirations ) < 1 ) */
        // 08-01-2020 ...
        // 08-01-2020 ... //$tStart = microtime( true );
        // 08-01-2020 ... $szKanbanMD5 = $this->aspirationFilesMD5( $this->getAllAspirationFiles() );
        // 08-01-2020 ... //$tEnd = microtime( true );
        // 08-01-2020 ... //var_dump( round( $tEnd - $tStart,2 ) . ' sec for getAllAspirationFiles' );
        // 08-01-2020 ...
        // 08-01-2020 ... //$tStart = microtime( true );
        // 08-01-2020 ... $szRetVal .= "<section id=\"{$szGUIDRendering}\">\n";
        // 08-01-2020 ... {
        // 08-01-2020 ...     if ( is_array( $this->aAspirations ) && count( $this->aAspirations ) > 0 )
        // 08-01-2020 ...     {
        // 08-01-2020 ...         //var_dump( "ON A LES ASPIRATIONS SUIVANTES:" );
        // 08-01-2020 ...         //var_dump( $this->aAspirations );
        // 08-01-2020 ...
        // 08-01-2020 ...         if ( is_null( $this->aBubble ) && is_null( $this->aToStart ) && is_null( $this->aStarted ) && is_null( $this->aClosed ) )
        // 08-01-2020 ...         {
        // 08-01-2020 ...             //var_dump( "ON N'A PAS DE BUBBLE, TO-START, STARTED, OU CLOSED" );
        // 08-01-2020 ...             foreach( $this->aAspirations as $oAspiration )
        // 08-01-2020 ...             {
        // 08-01-2020 ...                 switch ( $oAspiration->aData['kanban-phase'] )
        // 08-01-2020 ...                 {
        // 08-01-2020 ...                     case 'to-start' :   $this->aToStart[]   = $oAspiration;
        // 08-01-2020 ...                                         break;
        // 08-01-2020 ...                     case 'started'  :   $this->aStarted[]   = $oAspiration;
        // 08-01-2020 ...                                         break;
        // 08-01-2020 ...                     case 'closed'   :   $this->aClosed[]    = $oAspiration;
        // 08-01-2020 ...                                         break;
        // 08-01-2020 ...                     default         :   $this->aBubble[]    = $oAspiration;
        // 08-01-2020 ...                 }   /* switch ( $oAspiration->aData['kanban-phase'] ) */
        // 08-01-2020 ...             }   /* foreach( $this->aAspirations as $oAspiration ) */
        // 08-01-2020 ...         }   /* if ( is_null( $this->aBubble ) && is_null( $this->aToStart ) && is_null( $this->aStarted ) && is_null( $this->aClosed ) ) */
        // 08-01-2020 ...
        // 08-01-2020 ...         $szRetVal .= "<table id=\"portfolio-kanban\" class=\"shadow\">\n";
        // 08-01-2020 ...             $szRetVal .= "<thead>\n";
        // 08-01-2020 ...                 $szRetVal .= "<tr>";
        // 08-01-2020 ...                     $szRetVal .= "<th>Bubble <a href=\"/help/?q=help-portfolio-kanban#bubble\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
        // 08-01-2020 ...                     $szRetVal .= "<th>To Start <a href=\"/help/?q=help-portfolio-kanban#to-start\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
        // 08-01-2020 ...                     $szRetVal .= "<th>Started <a href=\"/help/?q=help-portfolio-kanban#started\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
        // 08-01-2020 ...                     $szRetVal .= "<th>Closed <a href=\"/help/?q=help-portfolio-kanban#closed\" target=\"_blank\"><img class=\"shadow\" src=\"/images/L(i)VID - Question.png\" width=\"38\" height=\"38\" style=\"display:block;position:absolute;top:-20px;right:-10px;z-index:2;\" /></a></th>\n";
        // 08-01-2020 ...                 $szRetVal .= "</tr>";
        // 08-01-2020 ...             $szRetVal .= "</thead>\n";
        // 08-01-2020 ...                 $szRetVal .= "<tr>";
        // 08-01-2020 ...                     $szRetVal .= $this->renderKanbanColumn( $this->aBubble  ,$WithRAG = false,$szColumnName = "bubble"      );
        // 08-01-2020 ...                     $szRetVal .= $this->renderKanbanColumn( $this->aToStart ,$WithRAG = false,$szColumnName = "to-start"    );
        // 08-01-2020 ...                     $szRetVal .= $this->renderKanbanColumn( $this->aStarted ,$WithRAG = true ,$szColumnName = "started"     );
        // 08-01-2020 ...                     $szRetVal .= $this->renderKanbanColumn( $this->aClosed  ,$WithRAG = true ,$szColumnName = "closed"      );
        // 08-01-2020 ...                 $szRetVal .= "</tr>";
        // 08-01-2020 ...             $szRetVal .= "<tbody>\n";
        // 08-01-2020 ...             $szRetVal .= "</tbody>\n";
        // 08-01-2020 ...         $szRetVal .= "</table>\n";
        // 08-01-2020 ...
        // 08-01-2020 ...     }   /* if ( is_array( $this->aAspirations ) && count( $this->aAspirations ) > 0 ) */
        // 08-01-2020 ...     else    /* Else of ... if ( is_array( $this->aAspirations ) && count( $this->aAspirations ) > 0 ) */
        // 08-01-2020 ...     {
        // 08-01-2020 ...         $szRetVal = "<p>No aspiration found</p>\n";
        // 08-01-2020 ...     }
        // 08-01-2020 ... }
        // 08-01-2020 ... $szRetVal .= "</section><!-- #{$szGUIDRendering} -->\n";
        // 08-01-2020 ... //$tEnd = microtime( true );
        // 08-01-2020 ... //var_dump( round( $tEnd - $tStart,2 ) . ' sec to render columns' );
        // 08-01-2020 ...
        // 08-01-2020 ...
        // 08-01-2020 ... //if ( isset( $GLOBALS['goApp']->oUser ) && ! is_null( $GLOBALS['goApp']->oUser ) && $GLOBALS['goApp']->oUser->isMemberOf('pmo') )
        // 08-01-2020 ... if ( Utils::isUserOfPMO() )
        // 08-01-2020 ... {
        // 08-01-2020 ...     $szRetVal .= "<p><input type=\"button\" class=\"print-no-show shadow aspiration-edit\" value=\" Add New Aspiration \" onclick=\"window.location = '/aspiration-edit.php?aid=new';\" /></p>";
        // 08-01-2020 ...     //$szRetVal .= "<p><input type=\"button\" class=\"print-no-show shadow aspiration-edit\" value=\" Add New Aspiration \" onclick=\"window.location = '/aspiration/?aid=new';\" /></p>";
        // 08-01-2020 ...     $szRetVal .= "<button class=\"button shadow no-print\" onclick=\"sendMail( 'report','itpmo@siabms.be','patrick.boens@11.skynet.be','Report',document.getElementById('{$szGUIDRendering}').innerHTML ); return false; ;\">Send report to PB</button>\n";
        // 08-01-2020 ... }   /* if ( Utils::isUserOfPMO() ) */
        // 08-01-2020 ...
        // 08-01-2020 ... //Utils::saveHashFile( $szCacheFile,$szRetVal );

        return ( $szRetVal );
    }   /* End of TaskBoard.__toHTML() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the taskboard in XML

        {*params
        *}

        {*return
            (string)        XML Code
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
    }   /* End of TaskBoard.__toXML() ================================================= */
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
    }   /* End of TaskBoard.__toArray() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Renders the taskboard in HTML (calls [c]__toHTML()[/c]

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
    }   /* End of TaskBoard.__toString() ============================================== */
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
    }   /* End of TaskBoard.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class TaskBoard ========================================================= */
/* ==================================================================================== */
?>