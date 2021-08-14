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
    {*file                  trql.timeline.class.php *}
    {*purpose               Way of displaying a list of events in chronological order *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 20-01-21 22:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 20-01-21 22:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\quitus\Chart      as Chart;
use \trql\schema\Thing      as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CHART_CLASS_VERSION' ) )
    require_once( 'trql.chart.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'TIMELINE_CLASS_VERSION' ) or define( 'TIMELINE_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Timeline=

    {*desc

        Way of displaying a list of events in chronological order

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q186117[/url] *}

    *}}
 */
/* ================================================================================== */
class Timeline extends Chart
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q186117';            /* {*property   $wikidataId                 (string)                WikidataId ... way of displaying a list of events
                                                                                                                                        in chronological order *} */

    public      $endDate                    = null;                 /* {*property   $endDate                    (Date|DateTime)         The end date and time of the item (in ISO 8601 date format). *} */
    public      $startDate                  = null;                 /* {*property   $startDate                  (Date|DateTime)         The start date and time of the item (in ISO 8601 date format). *} */
    public      $title                      = null;                 /* {*property   $title                      (string)                The title of the timeline. *} */
    protected   $objects                    = array();              /* {*property   $objects                    (array)                 An array of objects to represent on the timeline *} */
    public      $duration                   = null;                 /* {*property   $duration                   (int)                   duration (P2047) - length of time of an event or process or
                                                                                                                                        time interval (Q186081) temporal extent having a beginning, an end
                                                                                                                                        and a duration. The duration is expressed in seconds *} */


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
    }   /* End of Timeline.__construct() ============================================== */
    /* ================================================================================ */


    public function add( $oObj,$startDate = null,$endDate = null)
    /*---------------------------------------------------------*/
    {
        $this->objects[] = array( 'object'      => $oObj        ,
                                  'startDate'   => $startDate   ,
                                  'endDate'     => $endDate     ,
                                );
    }   /* End of Timeline.add() ====================================================== */
    /* ================================================================================ */


    /* Load an XML file that contains a list of intervals and milestones */
    public function load( $szFile )
    /*---------------------------*/
    {
        /* STILL TO BE DEVELOPED */
    }   /* End of Timeline.load() ===================================================== */
    /* ================================================================================ */

    public function hasObjects()
    /*------------------------*/
    {
        return ( is_array( $this->objects ) && count( $this->objects ) > 0 );
    }   /* End of Timeline.hasObjects() =============================================== */
    /* ================================================================================ */


    protected function determineStartAndEndDate()
    /*-----------------------------------------*/
    {
        if ( $this->hasObjects() )
        {
            $this->startDate = '99999999';
            $this->endDate   = '00000000';

            foreach( $this->objects as $a )
            {
                if ( property_exists( $a['object'],'startDate' ) )
                    if ( $a['object']->startDate < $this->startDate )
                        $this->startDate = $a['object']->startDate;

                if ( property_exists( $a['object'],'endDate' ) )
                    if ( $a['object']->endDate > $this->endDate )
                        $this->endDate = $a['object']->endDate;
            }   /* foreach( $this->objects as $a ) */
        }   /* if ( $this->hasObjects() ) */
    }   /* End of Timeline.determineStartAndEndDate() ================================= */
    /* ================================================================================ */


    public function determineDuration()
    /*-------------------------------*/
    {
        $iRetVal = -1;

        if ( ! empty( $this->startDate ) && ! empty( $this->endDate ) &&
              $this->startDate != '99999999' && $this->endDate != '00000000'
           )
        {
            $iRetVal = abs( strtotime( $this->endDate ) - strtotime( $this->startDate ) );
        }   /* if ( ! empty( $this->startDate ) && ... ) */

        return ( $iRetVal );
    }   /* End of Timeline.determineDuration() ======================================== */
    /* ================================================================================ */


    /* Afficher des lignes verticales qui déterminent des colonnes de 1 mois ET
       les entêtes nécessaires (le nom du mois) */
    public function drawPeriods()
    /*-------------------------*/
    {
        $szRetVal = '';

        $iDaysPerMonth      = ( 365 / 12 ) + 1;
        $iSecondsPerMonth   = $iDaysPerMonth * 86400;
        $timelineDuration   = $this->determineDuration();
        $iPeriodsCount      = ceil( $timelineDuration / $iSecondsPerMonth );

        //var_dump( "Nb de périodes: " . $iPeriodsCount );

        $width              = 100 / $iPeriodsCount;
        $szRetVal          .= "<section class=\"periods\">\n";

        $iTime              = strtotime( $this->startDate );

        for ( $i=0;$i < $iPeriodsCount;$i++ )
        {
            $szRetVal .= "<div class=\"period\" style=\"width:{$width}%;\"><span class=\"caption\">" . date( 'M',$iTime ) . ' ' . date( 'Y',$iTime ) . "</span></div>\n";
            $iTime += $iSecondsPerMonth;
        }

        $szRetVal          .= "</section>";

        //var_dump( $iMinutesPerMonth,$timelineDuration,$iPeriodsCount );

        return ( $szRetVal );
    }   /* End of Timeline.drawPeriods() ============================================== */
    /* ================================================================================ */


    // Je me demande comment je pourrais afficher une image
    // Par exemple, je veux un smiley vert si le statut est G

    public function __toHTML() : string
    /*-------------------------------*/
    {
        $szRetVal = '';

        if ( empty( $this->startDate ) || empty( $this->endDate ) )
            $this->determineStartAndEndDate();

        if ( $this->hasObjects() )
        {
            //var_dump( $this->objects );
            $this->duration = $this->determineDuration();
            $iDurationInDays = (int) round( $this->duration / 86400,0 );

            /* Pour afficher les intervalles dans la timeline, il faut positionner
               les objets en mode "ABSOLU". Ce calcul n'appartient pas aux intervalles
               à afficher: c'est le travail de la timeline */
            $szRetVal .= "<style>\n";
                foreach( $this->objects as $a )
                {
                    //var_dump( $a['object'] );
                    if   ( $a['object'] instanceof Interval )
                    {
                        $iDuration = $a['object']->determineDuration();
                        $width     = ( ( $iDuration / $this->duration ) * 100 );
                    }
                    elseif ( $a['object'] instanceof Milestone )
                    {
                        $width      = 10;
                    }
                    // duration between start of timeline and start of interval
                    $x         = abs( strtotime( $a['object']->startDate ) - strtotime( $this->startDate ) );
                    //var_dump( $x . ' pour ' . date( 'd-m-Y',strtotime( $a['object']->startDate ) ) . ' vs. ' . date( 'd-m-Y',strtotime( $this->startDate ) ) );
                    $left      = ( ( $x / $this->duration ) * 100 );

                    // ATTENTION: le $left n'est pas calculé de manière exacte SI la timeline ne s'étend pas jusqu'à la fin de l'année!!
                    // Par exemple, si timeline s'arrête en octobre 2021, le calcul de $left est incorrect

                    $szRetVal .= "div#{$a['object']->identifier} { left: {$left}%; width: {$width}%; }\n";
                }
            $szRetVal .= "</style>\n";

            $szFromTo = date( 'd-m-Y',strtotime( $this->startDate ) ) . ' &#8211; ' . date( 'd-m-Y',strtotime( $this->endDate ) );

            $szRetVal .= "<section id=\"{$this->identifier}\" title=\"{$szFromTo}\" "                           .
                                  "data-start-date=\"{$this->startDate}\" data-end-date=\"{$this->endDate}\" "  .
                                  "data-duration-sec=\"{$this->duration}\" "                                    .
                                  "data-duration-days=\"{$iDurationInDays}\" "                                  .
                                  "class=\"Timeline\">\n";

            if ( !empty( $this->description ) )
                $szRetVal .= "<h2>{$this->description}</h2>";

            $szRetVal .= $this->drawPeriods();

            foreach( $this->objects as $a )
            {
                $szRetVal .= $a['object']->__toHTML() . "\n";
            }

            $szRetVal .= "</section> <!-- #id={$this->identifier} -->\n";

        }

        return ( $szRetVal );
    }   /* End of Timeline.__toHTML() ================================================= */
    /* ================================================================================ */


    public function __toString() : string
    /*---------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of Timeline.__toString() =============================================== */
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
    }   /* End of Timeline.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Timeline ========================================================== */


class Interval extends Thing
/*------------------------*/
{
    public      $endDate                    = null;                 /* {*property   $endDate                    (Date|DateTime)         The end date and time of the item (in ISO 8601 date format). *} */
    public      $startDate                  = null;                 /* {*property   $startDate                  (Date|DateTime)         The start date and time of the item (in ISO 8601 date format). *} */
    public      $caption                    = null;                 /* {*property   $legend                     (string)                Wikidata: inscription (Q1640824) (inscribed on works or objects) or
                                                                                                                                        caption (Q18585177): lines of text used to explain or elaborate an
                                                                                                                                        illustration, figure, table, or photograph *} */

    public function __toHTML()
    /*----------------------*/
    {
        $szFromTo = date( 'd-m-Y',strtotime( $this->startDate ) ) . ' &#8211; ' . date( 'd-m-Y',strtotime( $this->endDate ) );

        $szCaption = $this->interpretCaption();

        $szRetVal   = "<div id=\"{$this->identifier}\" title=\"{$szFromTo}\" data-start-date=\"{$this->startDate}\" data-end-date=\"{$this->endDate}\" data-name=\"{$this->name}\" class=\"Interval\">\n";
        $szRetVal  .= "<span class=\"caption\">{$szCaption}</span>\n";
        $szRetVal  .= "</div> <!-- #id={$this->identifier} -->\n";

        return ( $szRetVal );
    }

    public function interpretCaption()
    /*------------------------------*/
    {
        $szCaption = $this->caption;

        if ( preg_match_all('/%[[:alpha:]]+/i',$szCaption,$aMatches, PREG_PATTERN_ORDER ) )
        {
            $aMatches = $aMatches[0];

            //var_dump( $aMatches );

            foreach( $aMatches as $szMatch )
            {
                $szProperty = substr( $szMatch,1 );
                if ( property_exists( $this,$szProperty ) )
                    $szCaption = str_replace( $szMatch,$this->$szProperty,$szCaption );
            }
        }

        return ( $szCaption );
    }


    public function determineDuration()
    /*-------------------------------*/
    {
        $iRetVal = -1;

        if ( ! empty( $this->startDate ) && ! empty( $this->endDate ) &&
              $this->startDate != '99999999' && $this->endDate != '00000000'
           )
        {
            $iRetVal = abs( strtotime( $this->endDate ) - strtotime( $this->startDate ) );
        }   /* if ( ! empty( $this->startDate ) && ... ) */

        return ( $iRetVal );
    }   /* End of Interval.determineDuration() ======================================== */
    /* ================================================================================ */
}   /* End of class Interval ========================================================== */
/* ==================================================================================== */


class Milestone extends Thing
/*-------------------------*/
{
    public      $endDate                    = null;                 /* {*property   $endDate                    (Date|DateTime)         The end date and time of the item (in ISO 8601 date format). *} */
    public      $startDate                  = null;                 /* {*property   $startDate                  (Date|DateTime)         The start date and time of the item (in ISO 8601 date format). *} */
    public      $caption                    = null;                 /* {*property   $legend                     (string)                Wikidata: inscription (Q1640824) (inscribed on works or objects) or
                                                                                                                                        caption (Q18585177): lines of text used to explain or elaborate an
                                                                                                                                        illustration, figure, table, or photograph *} */

    public function __toHTML()
    /*----------------------*/
    {
        $szRetVal   = "<div id=\"{$this->identifier}\" data-start-date=\"{$this->startDate}\" data-end-date=\"{$this->endDate}\" data-name=\"{$this->name}\" class=\"Milestone\">\n";
        $szRetVal  .= "<span class=\"caption\">$this->caption</span>\n";
        $szRetVal  .= "</div> <!-- #id={$this->identifier} -->\n";

        return ( $szRetVal );
    }

    public function determineDuration()
    /*-------------------------------*/
    {
        $iRetVal = -1;

        if ( ! empty( $this->startDate ) && ! empty( $this->endDate ) &&
              $this->startDate != '99999999' && $this->endDate != '00000000'
           )
        {
            $iRetVal = abs( strtotime( $this->endDate ) - strtotime( $this->startDate ) );
        }   /* if ( ! empty( $this->startDate ) && ... ) */

        return ( $iRetVal );
    }   /* End of Milestone.determineDuration() ======================================= */
    /* ================================================================================ */
}   /* End of class Milestone ========================================================= */
/* ==================================================================================== */
