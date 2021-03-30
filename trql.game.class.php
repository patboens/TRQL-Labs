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
    {*file                  trql.game.class.php *}
    {*purpose               The Game type represents things which are games. 
                            These are typically rule-governed recreational activities, 
                            e.g. role-playing games in which players assume the 
                            role of characters in a fictional setting. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 02-03-21 07:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 02-03-21 07:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\game;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'GAME_CLASS_VERSION' ) or define( 'GAME_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Game=

    {*desc

        The Game type represents things which are games. These are typically
        rule-governed recreational activities, e.g. role-playing games in which
        players assume the role of characters in a fictional setting.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Game[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c]
    *}

 */
/* ==================================================================================== */
class Game extends CreativeWork 
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $characterAttribute             = null;             /* {*property   $characterAttribute         (Thing)                         A piece of data that represents a particular aspect of a fictional 
                                                                                                                                                character (skill, power, character points, advantage, disadvantage). *} */
    public      $gameItem                       = null;             /* {*property   $gameItem                   (Thing)                         An item is an object within the game world that can be collected by 
                                                                                                                                                a player or, occasionally, a non-player character. *} */
    public      $gameLocation                   = null;             /* {*property   $gameLocation               (Place|PostalAddress|URL)       Real or fictional location of the game (or part of game). *} */
    public      $numberOfPlayers                = null;             /* {*property   $numberOfPlayers            (QuantitativeValue)             Indicate how many people can play this game (minimum, maximum, or range). *} */
    public      $quest                          = null;             /* {*property   $quest                      (Thing)                         The task that a player-controlled character, or group of characters may 
                                                                                                                                                complete in order to gain a reward. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q11410';         /* {*property   $wikidataId                 (string)                        Wikidata ID. Structured form of play, usually for entertainment *} */

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
    }   /* End of Game.__construct() ================================================== */
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
    }   /* End of Game.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Game ============================================================== */
/* ==================================================================================== */
?>