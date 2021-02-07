<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.sprint.class.php *}
    {*purpose               In agile software development, a sprint is a set period of
                            time during which specific tasks need to be completed and
                            made ready for review. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 07-01-21 11:38 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    --------------------------------------------------------------------------------------
    Changes History:
    --------------------------------------------------------------------------------------

    {*chist
        {*mdate 07-01-21 11:38 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\Sprint;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\cyclicprocess\CyclicProcess       as CyclicProcess;
use \trql\task\Task                         as Task;
use \trql\digitaldocument\DigitalDocument   as DigitalDocument;
use \ReflectionClass                        as RF;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CYCLICPROCESS_CLASS_VERSION' ) )
    require_once( 'trql.cyclicprocess.class.php' );

if ( ! defined( 'TASK_CLASS_VERSION' ) )
    require_once( 'trql.task.class.php' );

if ( ! defined( 'DIGITALDOCUMENT_CLASS_VERSION' ) )
    require_once( 'trql.digitaldocument.class.php' );

defined( 'SPRINT_CLASS_VERSION' ) or define( 'SPRINT_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Sprint=

    {*desc

        Process that repeats itself.

    *}

    *}}
 */
/* ================================================================================== */
class Sprint extends CyclicProcess
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'icon'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId         = 'Q3494253';                   /* {*property   $wikidataId         (string)            Wikidata ID. In agile software development, a
                                                                                                                            sprint is a set period of time during which
                                                                                                                            specific tasks need to be completed and made
                                                                                                                            ready for review. *} */


    /* Propriétés qui viennent de trql.event.class.php */
    public      $duration           = null;                         /* {*property   $duration           (Duration)          The duration of the item (movie, audio recording, event, etc.)
                                                                                                                            in ISO 8601 date format. *} */
    public      $endDate            = null;                         /* {*property   $endDate            (Date|DateTime)     The end date and time of the item (in ISO 8601 date format). *} */
    public      $eventStatus        = null;                         /* {*property   $eventStatus        (EventStatusType)   An eventStatus of an event represents its status; particularly useful
                                                                                                                            when an event is cancelled or rescheduled. *} */

    /* Toutes ces propriétés doivent être revues */
    public      $szSprintNo         = null;
    public      $aData              = null;
    public      $oAspiration        = null;                         /* {*property   $oAspiration        (Aspiration)        Parent Aspiration this Sprint is attached to *} */
    public      $iWeeksPerSprint    = 2;
    public      $helpNeeded         = false;
    public      $aObjectives        = null;                         /* {*property   $aObjectives        (array)             A set of objectives this sprint must meet *} */
    public      $aKeyMessages       = null;                         /* {*property   $aKeyMessages       (array)             A set of key messages pertaining to this sprint (achievements, failures, points of attention, ...) *} */
    public      $aRemarks           = null;                         /* {*property   $aRemarks           (array)             A set of general-purpose remarks pertaining to this sprint *} */
    public      $aTasks             = null;                         /* {*property   $aTasks             (array)             A set of tasks pertaining to this sprint *} */
    public      $aDocuments         = null;                         /* {*property   $aDocuments         (array)             Array of documents ([c]trq.document.class.php[/c]). *} */
    public      $szStorage          = null;                         /* {*property   $szStorage          (string)            File in which the Sprint maintains its state
                                                                                                                            (all properties) *} */
    public      $previousStartDate  = null;                         /* {*property   $previousStartDate  (Date)              Used in conjunction with eventStatus for rescheduled or cancelled events.
                                                                                                                            This property contains the previously scheduled start date. For
                                                                                                                            rescheduled events, the startDate property should be used for the newly
                                                                                                                            scheduled start date. In the (rare) case of an event that has been
                                                                                                                            postponed and rescheduled multiple times, this field may be repeated. *} */
    public      $startDate                   = null;                /* {*property   $startDate          (Date|DateTime)     The start date and time of the item (in ISO 8601 date format). *} */


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
        $this->classIcon = $this->self['icon'];

        return ( $this );
    }   /* End of Sprint.__construct() ================================================ */
    /* ================================================================================ */


    /* EXPERIMENTAL */
    public function save( $szFile = null )
    /*----------------------------------*/
    {
        $bRetVal = false;

        $this->dieGracefully( __METHOD__ . "() is experimental at this stage" );

        if ( is_null( $szFile ) )
        {
            $szFile = $this->szStorage;
        }   /* if ( is_null( $szFile ) ) */

        if ( ! is_null( $szFile ) && FIL_Exists( $szFile ) )
        {
            $oDom = new LSDom();

            /* We load the sprint file */
            if ( $oDom->load( $szFile ) )
            {
                $oDom->xinclude();  /* Include XML */

                $oXPath = new LSXPath( $oDom );

                if ( ( $o = $oXPath->query( '/sprint' ) ) && $o->length > 0 )
                {
                    $oSprintNode = $o->item(0);

                    /*
                        <sprintno>19</sprintno>
                        <name><![CDATA[SiA PMO - BAU]]></name>
                        <type>S</type> <!-- Can be 0, S or HIP -->
                        <sprintStartDate>20190225</sprintStartDate>
                        <sprintEndDate>20190308</sprintEndDate>
                    */


                    if ( ( $o = $oXPath->query( 'sprintno',$oSprintNode ) ) && $o->length > 0 )
                    {
                        $o->item(0)->nodeValue = (string) $this->iSprintNo;
                    }

                    if ( ( $o = $oXPath->query( 'sprintStartDate',$oSprintNode ) ) && $o->length > 0 )
                    {
                        if      ( is_string( $this->aData['sprintStartDate'] ) )
                        {
                            $szDate = STR_dionly( $this->aData['sprintStartDate'] );

                            /* If YYYYMMDD format */
                            if ( preg_match('/(19|20)[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/',$szDate ) )
                            {
                                $o->item(0)->nodeValue = $szDate;
                            }
                            else
                            {
                                $o->item(0)->nodeValue = DAT_dtos( $this->aData['sprintStartDate'] );
                            }

                        }
                        elseif  ( is_numeric( $this->aData['sprintStartDate'] ) )
                        {
                            //var_dump( "NUMERIC" );
                            $o->item(0)->nodeValue = DAT_dtos( $this->aData['sprintStartDate'] );
                        }

                        // die( "START DATE: " . $o->item(0)->nodeValue );
                    }

                    if ( ( $o = $oXPath->query( 'sprintEndDate',$oSprintNode ) ) && $o->length > 0 )
                    {
                        if      ( is_string( $this->aData['sprintEndDate'] ) )
                        {
                            $szDate = STR_dionly( $this->aData['sprintEndDate'] );

                            /* If YYYYMMDD format */
                            if ( preg_match('/(19|20)[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/',$szDate ) )
                            {
                                $o->item(0)->nodeValue = $szDate;
                            }
                            else
                            {
                                $o->item(0)->nodeValue = DAT_dtos( $this->aData['sprintEndDate'] );
                            }
                        }
                        elseif  ( is_numeric( $this->aData['sprintEndDate'] ) )
                        {
                            //var_dump( "NUMERIC" );
                            $o->item(0)->nodeValue = DAT_dtos( $this->aData['sprintEndDate'] );
                        }
                    }

                    if ( ( $o = $oXPath->query( 'name',$oSprintNode ) ) && $o->length > 0 )
                    {
                        $oCDATA   = $oDom->createCDATASection( $this->szName );
                        $o->item(0)->nodeValue = '';
                        $o->item(0)->appendChild( $oCDATA );
                        //die( $o->item(0)->nodeValue );
                    }

                    // Il y a encore plein de choses à sauver!!!


                    /* Let's take a backup */
                    FIL_Copy( $szFile,$szFile . '.backup.' . date( 'YmdHis' ) . '.xml' );
                    /* Save now */
                    $bRetVal = @$oDom->save( $szFile );
                }
                else
                {
                    //die("PAS SPRINT");
                }
            }   /* if ( $oDom->load( $szFile ) ) */
            else
            {
            }
        }   /* if ( ! is_null( $szFile ) && FIL_Exists( $szFile ) ) */

        return ( $bRetVal );
    }   /* End of Sprint.save() ======================================================= */
    /* ================================================================================ */


    /* EXPERIMENTAL */
    public function loadData()
    /*----------------------*/
    {
        static $oDom = null;
        $this->aData = null;

        $this->dieGracefully( __METHOD__ . "() is experimental at this stage" );

        if ( ! is_null( $this->szStorage ) && file_exists( $this->szStorage ) )
        {
            //var_dump( "STORAGE NOT NULL: " . $this->szStorage );
            $aInfo      = pathinfo( $this->szStorage );

            if ( isset( $aInfo['filename'] ) )
            {
                $this->szID = $aInfo['filename'];
            }   /* if ( isset( $aInfo['filename'] ) ) */
            else    /* Else of ... if ( isset( $aInfo['filename'] ) ) */
            {
                $this->szID = basename( $this->szStorage );
            }    /* End of ... Else of ... if ( isset( $aInfo['filename'] ) ) */

            /* Create a new Dom if none available */
            if ( is_null( $oDom ) )
            {
                $oDom = new LSDom();
            }   /* if ( is_null( $oDom ) ) */

            if ( ! is_null( $oDom ) )
            {
                if ( $oDom->load( $this->szStorage ) )
                {
                    //var_dump( "STORAGE LOADED" );

                    $oDom->xinclude();  /* Include XML */

                    //echo htmlentities( $oDom->saveXML() );
                    //die();

                    $oXPath                             = new LSXPath( $oDom );

                    $this->aData['sprint-no']           =
                    $this->aData['sprint-name']         =
                    $this->aData['sprint-type']         =
                    $this->aData['sprint-title']        =
                    $this->aData['sprintStartDate']     =
                    $this->aData['sprintEndDate']       =
                    $this->aData['facts']               =
                    $this->aData['exec']                =
                    $this->aData['next']                =
                    $this->aData['niko-niko']           =
                    $this->aData['sprint-planning-img'] =
                    $this->aData['plannings']           =           /* Supposed to replace $this->aData['planning'] */
                    $this->aData['planning']            = null;
                    $this->aData['us-todo']             =
                    $this->aData['us-doing']            =
                    $this->aData['us-done']             =
                    $this->aData['us-bubble']           = 0;

                    if ( ( $o = $oXPath->query( 'type' ) ) && $o->length > 0 )
                    {
                        $this->aData['sprint-type'] = $this->szType = $o->item(0)->nodeValue;
                    }

                    if ( ( $o = $oXPath->query( 'sprintno' ) ) && $o->length > 0 )
                    {
                        $this->aData['sprint-no'] = $this->iSprintNo = (int) $o->item(0)->nodeValue;
                    }

                    if ( ( $o = $oXPath->query( 'name' ) ) && $o->length > 0 )
                    {
                        $this->aData['sprint-name'] = $this->szName = $o->item(0)->nodeValue;
                    }

                    if ( ( $o = $oXPath->query( '//image' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {

                            $this->aData['images'][$oNode->getAttribute('id')] = $oNode->nodeValue;
                        }
                    }

                    // ANCIENNE FACON DE FAIRE
                    //if ( ( $o = $oXPath->query( '//title' ) ) && $o->length > 0 )
                    //{
                    //    $this->aData['sprint-title'] = $o->item(0)->nodeValue ;
                    //}

                    if ( ( $o = $oXPath->query( 'objectives/title' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            if ( $bActive = getBoolAttribute( $oNode,'active',true /* default */ ) )
                            {
                                $this->aData['sprint-title'][] = array( 'title'       => $oNode->nodeValue,
                                                                  'attributes'  => $oNode->getAttribute( 'class' ) );
                            }
                        }
                    }

                    {   /* Planning */
                        if ( ( $o = $oXPath->query( '//planningImg' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $this->aData['sprint-planning-img'][] = $oNode->nodeValue;
                            }
                        }

                        if ( ( $oColl = $oXPath->query( '//planning' ) ) && $oColl->length > 0 )
                        {
                            $szAspirationID = ( $this->oAspiration instanceof Aspiration )  ?
                                              $this->oAspiration->szID                      :
                                              null;
                            $szSprintID     = $this->szID;

                            //var_dump( "Found " . $oColl->length );
                            foreach( $oColl as $oNode )
                            {
                                $oPlanning = new Planning( null,$szAspirationID,$szSprintID );
                                $oPlanning->loadItems( $oDom,$oXPath,$oNode );
                                $this->aData['plannings'][] = $oPlanning;
                                //var_dump( $oPlanning );
                            }
                            //$oPlanning = new Planning( $this->aData['planning'] );
                            //$szRetVal .= $oPlanning->render( "Aspiration Planning",time(),$this );
                        }

                        if ( true && ( $o = $oXPath->query( 'planning/period | planning/milestone | planning/image' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $szStart        = getAttribute( $oNode,'start'      ,null );
                                $szEnd          = getAttribute( $oNode,'end'        ,null );
                                $szLink         = getAttribute( $oNode,'link'       ,null );
                                $szID           = getAttribute( $oNode,'id'         ,null );
                                $szColor        = getAttribute( $oNode,'color'      ,null );
                                $szBackColor    = getAttribute( $oNode,'backcolor'  ,null );
                                $szImage        = getAttribute( $oNode,'src'        ,null );

                                if ( ! empty( $szImage ) )
                                {
                                }

                                if ( preg_match( '/(?P<sign>\+|-)(?P<days>\d+)/im',$szStart,$aMatch ) )
                                {
                                    $szSign = $aMatch['sign'];
                                    $iDays  = (int) $aMatch['days'];


                                    if ( ! is_null( $szLink ) )
                                    {
                                        //var_dump( "LINK TO: " + $szLink );

                                        if ( ! is_null( $oLinkedObject = findPlanningObject( $this->aData['planning'],$szLink ) ) )
                                        {
                                            //var_dump( "FOUND LINKED OBJECT" );
                                            //var_dump( $oLinkedObject );
                                            //var_dump( $szSign );
                                            //var_dump( $iDays );

                                            if ( $oLinkedObject['type'] === 'milestone' )
                                            {
                                                $szStartOrStop = 'start';
                                            }
                                            else
                                            {
                                                $szStartOrStop = 'end';
                                            }

                                            if ( $szSign === '+' )
                                            {
                                                $szStart = date( 'Ymd',DAT_stod( $oLinkedObject[$szStartOrStop] ) + ( 86400 * $iDays ) );
                                            }
                                            else
                                            {
                                                $szStart = date( 'Ymd',DAT_stod( $oLinkedObject[$szStartOrStop] ) - ( 86400 * $iDays ) );
                                            }

                                            //var_dump( "CALCULATED DATE: " . $szStart );
                                        }
                                        //die();
                                    }
                                }

                                if ( preg_match( '/(?P<sign>\+)(?P<days>\d+)/im',$szEnd,$aMatch ) )
                                {
                                    $iDays  = (int) $aMatch['days'];
                                    $szEnd  = date( 'Ymd',DAT_stod( $szStart ) + ( 86400 * $iDays ) );
                                    //var_dump( "START DATE: " . $szStart );
                                    //var_dump( "CALCULATED END DATE: " . $szEnd );
                                    //die();
                                }

                                $this->aData['planning'][] = array( 'type'      => $oNode->tagName  ,
                                                                    'start'     => $szStart         ,
                                                                    'end'       => $szEnd           ,
                                                                    'id'        => $szID            ,
                                                                    'link'      => $szLink          ,
                                                                    'image'     => $szImage         ,
                                                                    'color'     => $szColor         ,
                                                                    'backcolor' => $szBackColor     ,
                                                                    'caption'   => $oNode->nodeValue );
                            }   /* foreach( $o as $oNode ) */
                            //var_dump( $this->aData['planning'] );
                            //die();
                        }
                    }   /* Planning */


                    if ( ( $o = $oXPath->query( '//sprintStartDate' ) ) && $o->length > 0 )
                    {
                        $this->aData['sprintStartDate'] = TIM_MakeInt( $o->item(0)->nodeValue ) + ( 8 * 3600 );   /* Start at 8am */
                    }

                    if ( ( $o = $oXPath->query( '//sprintEndDate' ) ) && $o->length > 0 )
                    {
                        $this->aData['sprintEndDate'] = TIM_MakeInt( $o->item(0)->nodeValue ) + ( 17 * 3600 );    /* End at 5pm */
                    }

                    if ( ( $o = $oXPath->query( '//fact' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            $this->aData['facts'][] = $oNode->nodeValue;
                            if ( $oNode->getAttribute( 'class' ) === 'exec' )
                            {
                                $this->aData['exec'][] = $oNode->nodeValue;
                            }
                        }
                    }

                    if ( ( $o = $oXPath->query( '//keyMessage' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            $this->aData['key-message'][] = $oNode->nodeValue;
                        }
                    }

                    if ( ( $o = $oXPath->query( '//attention' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            $this->aData['attention'][] = $oNode->nodeValue;
                            if ( $oNode->getAttribute( 'class' ) === 'exec' )
                            {
                                $this->aData['exec'][] = $oNode->nodeValue;
                            }
                        }
                    }

                    $this->aData['sprint-rag-style'] = 'horizontal';

                    if ( ( $o = $oXPath->query( 'rags' ) ) && $o->length > 0 )
                    {
                        $this->aData['sprint-rag-style'] = $o->item(0)->getAttribute('style');
                    }

                    if ( ( $o = $oXPath->query( '//rag' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            $this->aData['rag'][$oNode->getAttribute( 'class' )] = '{' . $oNode->getAttribute( 'rag' ) . '}:{' . $oNode->nodeValue . '}';
                        }
                    }

                    if ( ( $o = $oXPath->query( '//next' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            $this->aData['next'][] = $oNode->nodeValue;
                        }
                    }

                    {   /* Niko-Niko */
                        $this->aData['niko-warning'] = null;

                        if ( ( $o = $oXPath->query( '//nikoWarning' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $this->aData['niko-warning'][] = $oNode->nodeValue;
                            }
                        }

                        if ( ( $o = $oXPath->query( '//niko-niko' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $this->aData['niko-niko'][$oNode->getAttribute('id')] = (int) round( (float) $oNode->nodeValue,0 );
                            }
                        }
                    }   /* Niko-Niko */

                    $this->aData['exception'] = null;

                    /* Elements of an Exception Report */
                    if ( ( $o = $oXPath->query( '//exception' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oNode )
                        {
                            $this->aData['exception'][] = array( 'qty'        => (float) $oNode->getAttribute( 'qty'          ),
                                                                 'unit-cost'  => (float) $oNode->getAttribute( 'unit-cost'    ),
                                                                 'total'      => (float) $oNode->getAttribute( 'total'        ),
                                                                 'currency'   =>         $oNode->getAttribute( 'currency'     ),
                                                                 'label'      =>         $oNode->nodeValue );
                        }
                    }

                    if ( ( $o = $oXPath->query( 'ExceptionReport' ) ) && $o->length > 0 )
                    {
                        $oNode = $o->item(0);

                        $this->aData['exception-id']      = $oNode->getAttribute('id');
                        $this->aData['exception-date']    = $oNode->getAttribute('date');

                        if ( ( $o = $oXPath->query( 'rationale',$oNode ) ) && $o->length > 0 )
                        {
                            $this->aData['exception-rationale']   = $o->item(0)->nodeValue;
                        }
                    }

                    //var_dump( $this->aData );
                    //die( );

                    {   /* Risks */
                        $this->aData['risks']           =
                        $this->aData['risk-warning']    = null;

                        /* Elements of an Exception Report */
                        if ( ( $o = $oXPath->query( '//riskWarning' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                // <riskWarning active="true"><![CDATA[ALl risks NOT identified yet. Early publication!]]></riskWarning>

                                $bActive = getBoolAttribute( $oNode,'active',true /* default */ );

                                $this->aData['risk-warning'][] = $oNode->nodeValue;
                            }
                        }   /* if ( ( $o = $oXPath->query( '//riskWarning' ) ) && $o->length > 0 ) */

                        /* Collection of risk items */
                        if ( ( $o = $oXPath->query( '//risk' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $szTitle    = $oXPath->query( 'title',$oNode )->item(0)->nodeValue;
                                $szDesc     = $oXPath->query( 'desc',$oNode )->item(0)->nodeValue;

                                $this->aData['risks'][] = array( 'impact'         => (int)     $oNode->getAttribute( 'impact'     )   ,
                                                                 'likelihood'     => (int)     $oNode->getAttribute( 'likelihood' )   ,
                                                                 'closed'         => getBoolAttribute( $oNode,'closed',false )        ,
                                                                 'title'          => $szTitle                                         ,
                                                                 'desc'           => $szDesc                                          ,
                                                                 'impactdate'=> DAT_stod( $oNode->getAttribute( 'impactdate'  ) ) );
                            }   /* foreach( $o as $oNode ) */
                        }   /* if ( ( $o = $oXPath->query( '//risk' ) ) && $o->length > 0 ) */
                    }   /* Risks */

                    {   /* Issues */
                        $this->aData['issues']          =
                        $this->aData['issue-warning']   = null;

                        /* Elements of an Exception Report */
                        if ( ( $o = $oXPath->query( '//issueWarning' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                // <issueWarning active="true"><![CDATA[ALl issues NOT identified yet. Early publication!]]></issueWarning>

                                $bActive = getBoolAttribute( $oNode,'active',true /* default */ );

                                $this->aData['issue-warning'][] = $oNode->nodeValue;
                            }
                        }

                        /* Collection of issue items */
                        if ( ( $o = $oXPath->query( '//issue' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $szTitle    = $oXPath->query( 'title',$oNode )->item(0)->nodeValue;
                                $szDesc     = $oXPath->query( 'desc',$oNode )->item(0)->nodeValue;

                                $this->aData['issues'][] = array( 'impact'        => (int)     $oNode->getAttribute( 'impact'     )   ,
                                                                  'likelihood'    => (int)     $oNode->getAttribute( 'likelihood' )   ,
                                                                  'closed'        => getBoolAttribute( $oNode,'closed',false )        ,
                                                                  'title'         => $szTitle                                         ,
                                                                  'desc'          => $szDesc                                          ,
                                                                  'impactdate'    => DAT_stod( $oNode->getAttribute( 'impactdate'  ) ) );
                            }
                        }
                    }   /* Issues */

                    if ( ( $o = $oXPath->query( 'budget' ) ) && $o->length > 0 )
                    {
                        $this->aData['budget-md']                 = (float) $o->item(0)->getAttribute( 'md' );
                        $this->aData['budget-deviation-md']       = (float) $o->item(0)->getAttribute( 'deviation-md' );
                        $this->aData['budget-money']              = (float) $o->item(0)->getAttribute( 'money' );
                        $this->aData['budget-currency']           =         $o->item(0)->getAttribute( 'currency' );
                        $this->aData['budget-deviation-money']    = (float) $o->item(0)->getAttribute( 'deviation-money' );

                        if ( ( $o = $oXPath->query( '//actuals' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $this->aData['budget']['actuals'][$oNode->getAttribute('date')] = (float) $oNode->nodeValue;
                            }
                        }   /* if ( ( $o = $oXPath->query( '//actuals' ) ) && $o->length > 0 ) */

                        if ( ( $o = $oXPath->query( '//expense' ) ) && $o->length > 0 )
                        {
                            foreach( $o as $oNode )
                            {
                                $this->aData['budget']['expense'][] = array( 'date'       => $oNode->getAttribute( 'date'     ),
                                                                             'amount'     => $oNode->getAttribute( 'amount'   ),
                                                                             'currency'   => $oNode->getAttribute( 'currency' ),
                                                                             'label'      => $oNode->nodeValue );
                            }
                            //var_dump( $this->aData['budget'] );
                            //die();
                        }   /* if ( ( $o = $oXPath->query( '//expense' ) ) && $o->length > 0 ) */
                    }

                    if ( ( $o = $oXPath->query( 'help' ) ) && $o->length > 0 )
                    {
                        $this->helpNeeded = (strtolower( trim( $o->item(0)->getAttribute( 'required' ) ) ) === 'true' );
                    }

                    $this->aData['us-items']    =
                    $this->aData['us-todo']     =
                    $this->aData['us-doing']    =
                    $this->aData['us-done']     =
                    $this->aData['us-bubble']   = 0;

                    //if ( ( $o = $oXPath->query( '//backlog/counters' ) ) && $o->length > 0 )
                    //{
                    //    $this->aData['us-todo']   = (int) $o->item(0)->getAttribute( 'todo'   );
                    //    $this->aData['us-doing']  = (int) $o->item(0)->getAttribute( 'doing'  );
                    //    $this->aData['us-done']   = (int) $o->item(0)->getAttribute( 'done'   );
                    //
                    //    $this->aData['us-items']  = $this->aData['us-todo']     +
                    //                          $this->aData['us-doing']    +
                    //                          $this->aData['us-done'];
                    //}

                    if ( ( $o = $oXPath->query( 'backlog/item' ) ) && $o->length > 0 )
                    {
                        foreach( $o as $oItem )
                        {
                            $bUrgent    = strtolower( trim( $oItem->getAttribute( 'urgent' ) ) ) === 'true';
                            $szUSType   = strtolower( trim( $oItem->getAttribute('type'    ) ) );

                            $this->aData['backlog'][] = array( 'title'      =>                    $oItem->nodeValue                         ,
                                                               'class'      => strtolower(  trim( $oItem->getAttribute( 'class'     ) ) )   ,
                                                               'urgent'     =>                    $bUrgent                                  ,
                                                               'duedate'    =>              trim( $oItem->getAttribute( 'duedate'   ) )     ,
                                                               'label'      =>              trim( $oItem->getAttribute( 'label'     ) )     ,
                                                               'report'     =>              trim( $oItem->getAttribute( 'report'    ) )     ,
                                                               'owner'      =>              trim( $oItem->getAttribute( 'owner'     ) )     ,
                                                               'credits'    => (int)              $oItem->getAttribute( 'credits'   )       ,
                                                               'type'       => STR_Empty( $szUSType ) ? 'change' : $szUSType );
                        }   /* foreach( $o as $oItem ) */
                    }   /* if ( ( $o = $oXPath->query( 'backlog/item' ) ) && $o->length > 0 ) */

                    $aTodos     =
                    $aDoing     =
                    $aDone      =
                    $aBubble    = null;

                    foreach( $this->aData['backlog'] as $aItem )
                    {
                        $szClass = strtolower( trim( $aItem['class'] ) );

                        switch( $szClass )
                        {
                            case 'todo' :   $aTodos[]   = $aItem;
                                            break;
                            case 'doing':   $aDoing[]   = $aItem;
                                            break;
                            case 'done':    $aDone[]    = $aItem;
                                            break;
                            case 'bubble':  $aBubble[]  = $aItem;
                                            break;
                        }
                    }   /* foreach( $this->aData['backlog'] as $aItem ) */


                    $this->aData['us-todo']     = is_array( $aTodos  ) ? (int) count( $aTodos  ) : 0;
                    $this->aData['us-doing']    = is_array( $aTodos  ) ? (int) count( $aDoing  ) : 0;
                    $this->aData['us-done']     = is_array( $aDone   ) ? (int) count( $aDone   ) : 0;
                    $this->aData['us-bubble']   = is_array( $aBubble ) ? (int) count( $aBubble ) : 0;

                    $this->aData['us-items']    = $this->aData['us-todo'    ] +
                                                  $this->aData['us-doing'   ] +
                                                  $this->aData['us-done'    ];
                }   /* if ( $oDom->load( $this->szStorage ) ) */
            }   /* if ( ! is_null( $oDom ) ) */
        }   /* if ( ! is_null( $this->szStorage ) && FIL_Exists( $this->szStorage ) ) */
    }   /* End of Sprint.loadData() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*load( $szFile )=

        Load a Sprint

        {*params
            $szFile         (string)            File to load
        *}

        {*return
            (bool)      [c]true[/c] if $szFile loaded successfully; [c]false[/c] if not
        *}

        *}}
    */
    /* ================================================================================ */
    public function load( $szFile ): bool
    /*---------------------------------*/
    {
        $bRetVal        = false;
        $szCacheFile    = $szFile . '.hash';

        //var_dump( vaesoli::FIL_File1OlderThanFile2( $szCacheFile,$szFile ) );
        //var_dump( $szFile . '.hash' );
        //die();

        if ( false && $this->remembering && vaesoli::FIL_File1OlderThanFile2( $szCacheFile,$szFile ) )
        {
            $tStart = microtime( true );
            $o      = vaesoli::FIL_getHashFile( $szCacheFile );

            $reflect    = new RF( $this );
            $aProps     = $reflect->getProperties( \ReflectionProperty::IS_PUBLIC      |
                                                   \ReflectionProperty::IS_PROTECTED   |
                                                   \ReflectionProperty::IS_PRIVATE );

            foreach ( $aProps as $oProperty )
            {
                $szName = $oProperty->name;
                $this->$szName = $o->$szName;
            }   /* foreach ( $aProps as $oProperty ) */

            //var_dump( "Sprint loaded in " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );
            $bRetVal = true;
            goto end;
        }
        elseif ( is_file( $szFile ) )
        {
            $tStart = microtime( true );

            $oDom = new \DOMDocument( '1.0' );

            if ( $oDom->load( $szFile ) )
            {

                $bRetVal            = true;

                //$this->szStorage    = $szFile;
                //
                //var_dump( $this->szStorage );
                //var_dump( vaesoli::FIL_RevertRoot( $this->szStorage ) );
                //var_dump( $this->oAspiration );
                //var_dump( dirname( $_SERVER['DOCUMENT_ROOT'] ),$_SERVER['DOCUMENT_ROOT'] );

                /* Storage manipulation
                   ====================

                   Very well, here $szFile is a fully qualified path similar to
                   D:\websites\openpmo.site\www\databases\PMO\00532\00061\00851\00165\delhaize-retail.openpmo.aspiration.sprint.00001.xml

                   When applying the FIL_RevertRoot() method on it we obtain:

                   D:/websites/openpmo.site/www/databases/PMO/00532/00061/00851/00165/delhaize-retail.openpmo.aspiration.sprint.00001.xml

                   ... backslashes, if any, have been turned to forward slashes

                   The document root being "D:/websites/openpmo.site/www/httpdocs"
                   (as an example), the dirname() function on it will result in
                   "D:/websites/openpmo.site/www"

                   If we now turn "D:/websites/openpmo.site/www" to "/.." in
                   "D:/websites/openpmo.site/www/databases/PMO/00532/00061/00851/00165/delhaize-retail.openpmo.aspiration.sprint.00001.xml"

                   ... we end up with "/../databases/PMO/00532/00061/00851/00165/delhaize-retail.openpmo.aspiration.sprint.00001.xml"

                   which is what we want.

                */

                $this->szStorage = str_replace( dirname( $_SERVER['DOCUMENT_ROOT'] ),'/..',vaesoli::FIL_RevertRoot( $szFile ) );
                //var_dump( "STORAGE:" . $this->szStorage );
                //die();

                $this->identifier   =            trim( $oDom->documentElement->getAttribute( 'identifier'   ) );
                $this->startDate    = strtotime( trim( $oDom->documentElement->getAttribute( 'startDate'    ) ) );
                $this->endDate      = strtotime( trim( $oDom->documentElement->getAttribute( 'endDate'      ) ) );
                $this->szSprintNo   =            trim( $oDom->documentElement->getAttribute( 'sprintNo'     ) );
                $this->szType       =            trim( $oDom->documentElement->getAttribute( 'type'         ) );

                $oXPath             = new \DOMXPath( $oDom );

                if ( ( $o = $oXPath->query( 'Name' ) ) && ( $o->length > 0 ) )
                    $this->name = $o->item(0)->nodeValue;

                {   /* Objectives ======================================== */
                    if ( ( $o = $oXPath->query( 'Objectives' ) ) && ( $o->length > 0 ) )
                    {
                        $oObjectivesNode = $o->item(0);

                        if ( ( $oTitles = $oXPath->query( 'Title',$oObjectivesNode ) ) && ( $oTitles->length > 0 ) )
                        {
                            // Faudrait faire une classe Objective / Goal (https://www.wikidata.org/wiki/Q4503831)
                            foreach( $oTitles as $oNode )
                                $this->aObjectives[] = $oNode->nodeValue;
                        }   /* if ( ( $oTitles = $oXPath->query( 'Title',$oObjectivesNode ) ) && ( $oTitles->length > 0 ) ) */
                    }   /* if ( ( $o = $oXPath->query( 'Objectives' ) ) && ( $o->length > 0 ) ) */
                }   /* Objectives ======================================== */

                {   /* Key Messages ====================================== */
                    if ( ( $o = $oXPath->query( 'KeyMessages' ) ) && ( $o->length > 0 ) )
                    {
                        $oKeyMessagesNode = $o->item(0);

                        if ( ( $oMessages = $oXPath->query( 'Message',$oKeyMessagesNode ) ) && ( $oMessages->length > 0 ) )
                        {
                            // Faudrait faire une classe Objective / Goal (https://www.wikidata.org/wiki/Q4503831)
                            foreach( $oMessages as $oNode )
                                $this->aKeyMessages[] = $oNode->nodeValue;
                        }
                    }   /* if ( ( $o = $oXPath->query( 'KeyMessages' ) ) && ( $o->length > 0 ) ) */
                }   /* Key Messages ====================================== */

                {   /* Remarks =========================================== */
                    if ( ( $o = $oXPath->query( 'Remarks' ) ) && ( $o->length > 0 ) )
                    {
                        $oRemarksNode = $o->item(0);

                        if ( ( $oMessages = $oXPath->query( 'Message',$oRemarksNode ) ) && ( $oMessages->length > 0 ) )
                        {
                            foreach( $oMessages as $oNode )
                                $this->aRemarks[] = $oNode->nodeValue;
                        }
                    }   /* if ( ( $o = $oXPath->query( 'Remarks' ) ) && ( $o->length > 0 ) ) */
                }   /* Remarks =========================================== */

                //var_dump( $this->szStorage );
                //die();

                {   /* Backlog =========================================== */
                    if ( ( $o = $oXPath->query( 'Backlog' ) ) && ( $o->length > 0 ) )
                    {
                        $oBacklogNode = $o->item(0);

                        // <Item progress="bubble" owner="Conway" credits="1" type="change" priority="P1"><![CDATA[

                        if ( ( $oItems = $oXPath->query( 'Item',$oBacklogNode ) ) && ( $oItems->length > 0 ) )
                        {
                            foreach( $oItems as $oNode )
                            {
                                $oTask                  = new Task();

                                $oTask->identifier      =                  $oNode->getAttribute( 'id'          );
                                $oTask->name            =                  $oNode->getAttribute( 'name'        );  /* https://schema.org/Action */
                                $oTask->szProgress      =                  $oNode->getAttribute( 'progress'    );
                                $oTask->credits         =          (float) $oNode->getAttribute( 'credits'     );
                                //var_dump("Lecture progress:",$oTask->szProgress );
                                $oTask->agent           =                  $oNode->getAttribute( 'agent'        );  /* https://schema.org/Action */
                                $oTask->additionalType  =                  $oNode->getAttribute( 'type'         );  /* https://schema.org/Thing */
                                $oTask->priority        =                  $oNode->getAttribute( 'priority'     );  /* Added as found in Wikidata (https://www.wikidata.org/wiki/Q11888847) */
                                $oTask->active          =                  $oNode->getAttribute( 'active'       ) !== 'no';
                                $oTask->dateCreated     =       strtotime( $oNode->getAttribute( 'creation'     ) );
                                $oTask->endTime         =       strtotime( $oNode->getAttribute( 'due'          ) );
                                $oTask->attention       = $this->makeBool( $oNode->getAttribute( 'attention'    ),false );
                                $oTask->late            = $this->makeBool( $oNode->getAttribute( 'late'         ),false );
                                $oTask->description     =                  $oNode->nodeValue;

                                $oTask->szStorage       = $this->szStorage;

                                //var_dump( $oNode->getAttribute( 'credits' ),$oTask->credits );
                                //die();
                                $this->aTasks[]         = $oTask;
                            }   /* foreach( $oItems as $oNode ) */
                        }   /* if ( ( $oItems = $oXPath->query( 'Item',$oBacklogNode ) ) && ( $oItems->length > 0 ) ) */
                    }   /* if ( ( $o = $oXPath->query( 'Backlog' ) ) && ( $o->length > 0 ) ) */
                }   /* Backlog =========================================== */

                {   /* Documents ========================================================== */
                    if ( ( $o = $oXPath->query( 'Documents' ) ) && ( $o->length > 0 ) )
                    {
                        var_dump( "Il y a des docs" );
                        $oDocumentsNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'Item',$oDocumentsNode ) ) && ( $o->length > 0 ) )
                        {
                            // ICI, ON DEVRAIT CRÉER DES OBJETS DIGITALDOCUMENT
                            foreach( $o as $oNode )
                                $this->aDocuments[] = $oNode->nodeValue;
                        }   /* if ( ( $o = $oXPath->query( 'Item',$oDocumentsNode ) ) && ( $o->length > 0 ) ) */
                    }   /* if ( ( $o = $oXPath->query( 'Documents' ) ) && ( $o->length > 0 ) ) */
                }   /* Documents ========================================================== */

                vaesoli::FIL_saveHashFile( $szCacheFile,$this );

                //var_dump( $this->name );
                //die();

                // Ancien code de load d'une aspiration
                // 20210112 ... if ( ( $o = $oXPath->query( 'CodeName' ) ) && ( $o->length > 0 ) )
                // 20210112 ...     $this->szCodeName = $o->item(0)->nodeValue;
                // 20210112 ...
                // 20210112 ... if ( ( $o = $oXPath->query( 'Leader' ) ) && ( $o->length > 0 ) )
                // 20210112 ... {
                // 20210112 ...     $oLeaderNode = $o->item(0);
                // 20210112 ...
                // 20210112 ...     if ( ( $o = $oXPath->query( 'FirstName',$oLeaderNode ) ) && ( $o->length > 0 ) )
                // 20210112 ...         $this->oLeader->givenName = $o->item(0)->nodeValue;
                // 20210112 ...
                // 20210112 ...     if ( ( $o = $oXPath->query( 'LastName',$oLeaderNode ) ) && ( $o->length > 0 ) )
                // 20210112 ...         $this->oLeader->familyName = $o->item(0)->nodeValue;
                // 20210112 ... }   /* if ( ( $o = $oXPath->query( 'Leader' ) ) && ( $o->length > 0 ) ) */
                // 20210112 ...
                // 20210112 ... if ( ( $o = $oXPath->query( 'Team' ) ) && ( $o->length > 0 ) )
                // 20210112 ... {
                // 20210112 ...     $oTeamNode = $o->item(0);
                // 20210112 ...
                // 20210112 ...     if ( ( $oMembers = $oXPath->query( 'Member',$oTeamNode ) ) && ( $oMembers->length > 0 ) )
                // 20210112 ...     {
                // 20210112 ...         foreach( $oMembers as $oPersonNode )
                // 20210112 ...         {
                // 20210112 ...             $oPerson            = new Person();
                // 20210112 ...
                // 20210112 ...             $szName             = $oPersonNode->nodeValue;
                // 20210112 ...             $aNameParts         = $oPerson->splitName( $szName );
                // 20210112 ...
                // 20210112 ...             if ( count( $aNameParts ) >= 2 )
                // 20210112 ...             {
                // 20210112 ...                 $oPerson->givenName     = $aNameParts['firstname'];
                // 20210112 ...                 $oPerson->familyName    = $aNameParts['lastname'];
                // 20210112 ...             }
                // 20210112 ...
                // 20210112 ...             $oPerson->email     = $oPersonNode->getAttribute( 'email' );
                // 20210112 ...             $oPerson->jobTitle  = $oPersonNode->getAttribute( 'role'  );
                // 20210112 ...             $oPerson->telephone = $oPersonNode->getAttribute( 'phone' );
                // 20210112 ...
                // 20210112 ...             $this->member[]     = $oPerson;
                // 20210112 ...             //var_dump( $oPerson );
                // 20210112 ...         }   /* foreach( $oMembers as $oPersonNode ) */
                // 20210112 ...     }   /* if ( ( $oMembers = $oXPath->query( 'Member',$oTeamNode ) ) && ( $oMembers->length > 0 ) ) */
                // 20210112 ... }   /* if ( ( $o = $oXPath->query( 'Team' ) ) && ( $o->length > 0 ) ) */
                // 20210112 ...
                // 20210112 ... if ( ( $o = $oXPath->query( 'Stakeholders' ) ) && ( $o->length > 0 ) )
                // 20210112 ... {
                // 20210112 ...     //var_dump( $o );
                // 20210112 ...
                // 20210112 ...     $oStakeholderNode = $o->item(0);
                // 20210112 ...
                // 20210112 ...     if ( ( $oPersons = $oXPath->query( 'Person',$oStakeholderNode ) ) && ( $oPersons->length > 0 ) )
                // 20210112 ...     {
                // 20210112 ...         //var_dump( $oPersons );
                // 20210112 ...
                // 20210112 ...         foreach( $oPersons as $oPersonNode )
                // 20210112 ...         {
                // 20210112 ...             $oPerson = new Person();
                // 20210112 ...
                // 20210112 ...             $oPerson->email = $oPersonNode->getAttribute( 'email' );
                // 20210112 ...
                // 20210112 ...             if ( ( $o = $oXPath->query( 'FirstName',$oPersonNode ) ) && ( $o->length > 0 ) )
                // 20210112 ...                 $oPerson->givenName     = $o->item(0)->nodeValue;
                // 20210112 ...
                // 20210112 ...             if ( ( $o = $oXPath->query( 'LastName' ,$oPersonNode ) ) && ( $o->length > 0 ) )
                // 20210112 ...                 $oPerson->familyName    = $o->item(0)->nodeValue;
                // 20210112 ...
                // 20210112 ...
                // 20210112 ...             $this->aStakeholders[] = $oPerson;
                // 20210112 ...             //var_dump( $oPersonNode );
                // 20210112 ...         }
                // 20210112 ...     }
                // 20210112 ... }   /* if ( ( $o = $oXPath->query( 'Stakeholders' ) ) && ( $o->length > 0 ) ) */
                // 20210112 ...
                // 20210112 ... if ( ( $o = $oXPath->query( 'Deliverables' ) ) && ( $o->length > 0 ) )
                // 20210112 ... {
                // 20210112 ...     $oDeliverablesNode = $o->item(0);
                // 20210112 ...
                // 20210112 ...     if ( ( $o = $oXPath->query( 'Item',$oDeliverablesNode ) ) && ( $o->length > 0 ) )
                // 20210112 ...     {
                // 20210112 ...         foreach( $o as $oNode )
                // 20210112 ...             $this->aDeliverables[] = $oNode->nodeValue;
                // 20210112 ...     }
                // 20210112 ... }   /* if ( ( $o = $oXPath->query( 'Deliverables' ) ) && ( $o->length > 0 ) ) */
                // 20210112 ...
                // 20210112 ... if ( ( $o = $oXPath->query( 'Scope' ) ) && ( $o->length > 0 ) )
                // 20210112 ... {
                // 20210112 ...     $oScopeNode = $o->item(0);
                // 20210112 ...
                // 20210112 ...     if ( ( $o = $oXPath->query( 'In',$oScopeNode ) ) && ( $o->length > 0 ) )
                // 20210112 ...     {
                // 20210112 ...         foreach( $o as $oNode )
                // 20210112 ...             $this->aScope[] = $oNode->nodeValue;
                // 20210112 ...     }
                // 20210112 ... }   /* if ( ( $o = $oXPath->query( 'Deliverables' ) ) && ( $o->length > 0 ) ) */
            }   /* if ( $oDom->load( $szFile ) ) */
            else    /* Else of ... if ( $oDom->load( $szFile ) ) */
            {
                die( "CANNOT LOAD" );
            }   /* End of ... Else of ... if ( $oDom->load( $szFile ) ) */

            //var_dump( "Sprint loaded in " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );

        }   /* if ( is_file( $szFile ) ) */

        end:
        return ( $bRetVal );
    }   /* End of Sprint.load() ======================================================= */
    /* ================================================================================ */






    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Sprint.speak() ====================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Sprint.sing() ======================================================= */
    /* ================================================================================ */


    public function __toHTML() : string
    /*---------------------------------*/
    {
        //var_dump( $this );
        return ( '' );
    }   /* End of Sprint.__toHTML() =================================================== */
    /* ================================================================================ */


    public function __toString() : string
    /*---------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of Sprint.__toString() ================================================= */
    /* ================================================================================ */


    public function __get( $szProperty )
    /*--------------------------------*/
    {
        switch( $szProperty )
        {
            case 'icon'         :   return ( '/snippet-center/icons/' . basename( $this->classIcon ) );
            case 'szType'       :   return ( $this->additionalType );
            case 'szName'       :   return ( $this->name );
            case 'szID'         :   return ( $this->identifier );
            default             :   throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": {$szProperty} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . " - EXCEPTION_CODE_INVALID_PROPERTY)",EXCEPTION_CODE_INVALID_PROPERTY );

        }   /* switch( $szProperty ) */

    }   /* End of Sprint.__get() ====================================================== */
    /* ================================================================================ */


    public function __set( $szProperty,$szValue )
    /*-----------------------------------------*/
    {
        switch( $szProperty )
        {
            case 'szType'       :   $this->additionalType   = $szValue; goto end;
            case 'szName'       :   $this->name             = $szValue; goto end;
            case 'szID'         :   $this->identifier       = $szValue; goto end;
            default             :   throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": {$szProperty} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . " - EXCEPTION_CODE_INVALID_PROPERTY)",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch( $szProperty ) */

        end:

        return ( $this );
    }   /* End of Sprint.__set() ====================================================== */
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

    }   /* End of Sprint.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Sprint ============================================================ */
/* ==================================================================================== */
?>