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
    {*file                  trql.rag.class.php *}
    {*purpose               Red-Amber-Green status made of sub-statuses *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-21 08:46:00 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-21 08:46:07 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\quitus\Concept        as Concept;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CONCEPT_CLASS_VERSION' ) )
    require_once( 'trql.concept.class.php' );

defined( 'RAG_CLASS_VERSION' ) or define( 'RAG_CLASS_VERSION','0.1' );

/* EXCEPTION_CODE Uncategorized class of errors (error codes are supposed to be defined in the source of each class */
defined( "EXCEPTION_RAG_EXCEPTIONS_BASIS" )                     or define( "EXCEPTION_RAG_EXCEPTIONS_BASIS"                         ,EXCEPTION_CLASS_BASIS + 1000000 );

defined( "EXCEPTION_INVALID_STATUS" )                           or define( "EXCEPTION_INVALID_STATUS"                               ,EXCEPTION_RAG_EXCEPTIONS_BASIS + 0 );
defined( "EXCEPTION_CODE_INVALID_SCORE" )                       or define( "EXCEPTION_CODE_INVALID_SCORE"                           ,EXCEPTION_RAG_EXCEPTIONS_BASIS + 1 );
defined( "EXCEPTION_CODE_INVALID_TREND" )                       or define( "EXCEPTION_CODE_INVALID_TREND"                           ,EXCEPTION_RAG_EXCEPTIONS_BASIS + 2 );


/* ==================================================================================== */
/** {{*class RAG=

    {*desc

        Red-Amber-Green status made of sub-statuses

    *}

    *}}
 */
/* ==================================================================================== */
class RAG extends Concept
/*---------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $reportNumber                   = null;             /* {*property   $reportNumber           (string)            The number or other unique designator assigned to a Report by the
                                                                                                                                publishing organization. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q813912';        /* {*property   $wikidataId             (string)            Wikidata ID. condition ... state or circumstances of some object or event
                                                                                                                                (closest I can get) *} */
    public      $statuses                       = array( 'overall'      => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'time'         => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'cost'         => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'scope'        => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'quality'      => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'resources'    => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'risks'        => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'issues'       => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'dependencies' => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                         'assumptions'  => array( 'score'    => ''   ,
                                                                                  'trend'    => '='  ,
                                                                                )                    ,
                                                       );
    public $date                                = null;             /* {*property   $date                   (string)            The date of the RAG *} */

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
        $this->classIcon = $this->self['icon'];

        return ( $this );
    }   /* End of RAG.__construct() =================================================== */
    /* ================================================================================ */


    public function set( $status,$value )
    /*---------------------------------*/
    {
        if ( isset( $this->statuses[$status] ) )
        {
            if ( is_array( $value ) ) /* Alors, je m'attends à un score ET une tendance */
            {
                if ( $value['score'] !== 'R' && $value['score'] !== 'A' && $value['score'] !== 'G' )
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$value['score']}' INVALID score (ErrCode: " . EXCEPTION_CODE_INVALID_SCORE . ")",EXCEPTION_CODE_INVALID_SCORE );

                if ( $value['trend'] !== '+' && $value['trend'] !== '=' && $value['trend'] !== '-' )
                    throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$value['trend']}' INVALID trend (ErrCode: " . EXCEPTION_CODE_INVALID_TREND . ")",EXCEPTION_CODE_INVALID_TREND );

                $this->statuses[$status]['score'] = $value['score'];
                $this->statuses[$status]['trend'] = $value['trend'];
            }
            elseif ( is_string( $value ) )
            {
                $this->statuses[$status]['score'] = $value;
            }
        }
        else
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$status}' UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );

    }   /* End of RAG.set() =========================================================== */
    /* ================================================================================ */


    /* Compare this RAG with another RAG */
    public function compare( $RAG )
    /*---------------------------*/
    {
        $this->die( __METHOD__ . "() not yet available" );
    }   /* End of RAG.compare() ======================================================= */
    /* ================================================================================ */


    public function __toHTML( $szID = null )
    /*------------------------------------*/
    {
        $szHTML = '';

        if ( is_null( $szID ) )
            $szHTML .= "<table>\n";
        else
            $szHTML .= "<table id=\"{$szID}\">\n";

        $szCaption = "Status of " . ( empty( $this->date ) ? date( 'd-m-Y' ) : date( 'd-m-Y',strtotime( $this->date ) ) );

        $szHTML .= "    <caption>{$szCaption}</caption>\n";
        $szHTML .= "    <thead>\n";
        $szHTML .= "        <tr>\n";
        $szHTML .= "            <th>Overall</th>\n";
        $szHTML .= "            <th>Time</th>\n";
        $szHTML .= "            <th>Cost</th>\n";
        $szHTML .= "            <th>Scope</th>\n";
        $szHTML .= "            <th>Quality</th>\n";
        $szHTML .= "            <th>Resources</th>\n";
        $szHTML .= "            <th>Risks</th>\n";
        $szHTML .= "            <th>Issues</th>\n";
        $szHTML .= "            <th>Dependencies</th>\n";
        $szHTML .= "            <th>Assumptions</th>\n";
        $szHTML .= "        </tr>\n";
        $szHTML .= "    </thead>\n";
        $szHTML .= "    <tbody>\n";

        {   /* Les scores */
            $szHTML .= "        <tr>\n";
            foreach( $this->statuses as $name => $status )
            {
                if ( $name === 'overall' )
                    $szStatus = $this->value;
                else
                    $szStatus = strtoupper( $status['score'] );

                $szHTML .= "            <td class\"score {$szStatus}\">{$szStatus}</td>\n";
            }
            $szHTML .= "        </tr>\n";
        }   /* Les scores */

        {   /* Les tendances */
            $szHTML .= "        <tr>\n";
            foreach( $this->statuses as $name => $status )
            {
                if ( $name === 'overall' )
                    $status['trend'] = $this->trend;

                /* Voir signes https://unicode-table.com/fr/sets/mathematical-signs/#equal et https://unicode-table.com/fr/sets/arrow-symbols/ */
                if ( trim( $status['trend'] ) === '=' )
                {
                    $szTrend = '&#8801;';
                    $szClass = 'equal';
                }
                elseif ( trim( $status['trend'] === '+' ) )
                {
                    $szTrend = '&#129045;';
                    $szClass = 'plus';
                }
                elseif ( trim( $status['trend'] === '-' ) )
                {
                    $szTrend = '&#129047;';
                    $szClass = 'minus';
                }
                else
                {
                    $szTrend = '&#160;';
                    $szClass = 'empty';
                }

                $szHTML .= "            <td class=\"trend {$szClass}\">{$szTrend}</td>\n";
            }
            $szHTML .= "        </tr>\n";
        }   /* Les tendances */

        $szHTML .= "    </tbody>\n";
        $szHTML .= "</table>\n";

        return ( $szHTML );
    }   /* End of RAG.__toHTML() ====================================================== */
    /* ================================================================================ */


    public function __get( $property )
    /*------------------------------*/
    {
        switch( $property )
        {
            case 'value'    :   $iScore = 0;
                                $iCount = count( $this->statuses ) -1;
                                foreach( $this->statuses as $name => $status )
                                {
                                    if ( $name === 'overall' )
                                        continue;

                                    if ( $status['score'] === 'G' )
                                        $iScore += 1;
                                    elseif ( $status['score'] === 'A' )
                                        $iScore += 0;
                                    elseif ( $status['score'] === 'A' )
                                        $iScore -= 1;
                                }
                                $fAverage = (float) ( $iScore / $iCount );
                                //var_dump( $iScore,$fAverage );

                                if ( $fAverage >= 0.75 )
                                    return ( 'G' );
                                elseif ( $fAverage >= 0.6 )
                                    return ( 'A' );
                                else
                                    return ( 'R' );
                                break;
            case 'trend'    :   $iScore = 0;
                                $iCount = count( $this->statuses ) -1;
                                foreach( $this->statuses as $name => $status )
                                {
                                    if ( $name === 'overall' )
                                        continue;

                                    if ( $status['trend'] === '+' )
                                        $iScore += 1;
                                    elseif ( $status['trend'] === '=' )
                                        $iScore += 0.15;
                                    elseif ( $status['trend'] === '-' )
                                        $iScore -= 1;
                                }
                                $fAverage = (float) ( $iScore / $iCount );
                                //var_dump( $iScore,$fAverage );

                                if ( $fAverage > 0.5 )
                                    return ( '+' );
                                elseif ( $fAverage >= 0.45 )
                                    return ( '=' );
                                else
                                    return ( '-' );
                                break;
            default         :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": '{$property}' UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }

    }   /* End of RAG.__get() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of RAG.__destruct() ==================================================== */
    /* ================================================================================ */
}   /* End of class RAG =============================================================== */
/* ==================================================================================== */
