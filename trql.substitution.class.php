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
    {*file                  trql.substitution.class.php *}
    {*purpose               Handles sophisticated substitutions *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 27-07-20 10:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 27-07-20 10:36 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\substitution;


use \trql\quitus\Mother                             as Mother;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'SUBSTITUTION_CLASS_VERSION' ) or define( 'SUBSTITUTION_CLASS_VERSION','0.1' );


/* ==================================================================================== */
/** {{*class Substitution=

    {*desc

        General-purpose handling of string substitutions

    *}

    {*warning
        NOTHING tested
    *}

    *}}
 */
/* ==================================================================================== */
class Substitution extends Utility
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q23009439';      /* {*property   $wikidataId                 (string)                Replacement. Process of removing one thing and 
                                                                                                                                        adding another appropriate one in its place 
                                                                                                                                        (also known as replace, substitution, substitute) *} */


    protected   $aPatterns      = null;
    protected   $aReplacements  = null;


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
    }   /* End of Substitution.__construct() ========================================== */
    /* ================================================================================ */

    /*
        $oSubst->add( '%city%'                  ,'VILLE'                                              );
        $oSubst->add( '%country%'               ,'PAYS'                                               );
        $oSubst->add( '%temperature%'           ,round( $this->aWeather['temperature'],0 )            );
        $oSubst->add( '%temperature-min%'       ,round( $this->aWeather['temperature-min'],0 )        );
        $oSubst->add( '%temperature-max%'       ,round( $this->aWeather['temperature-max'],0 )        );
        $oSubst->add( '%temperature-feels-like%',round( $this->aWeather['temperature-feels-like'],0 ) );
        $oSubst->add( '%humidity%'              ,round( $this->aWeather['humidity'],0 )               );
        $oSubst->add( '%pressure%'              ,round( $this->aWeather['pressure'],0 )               );
        $oSubst->add( '%wind-speed%'            ,round( $this->aWeather['wind-speed'],0 )             );
        $oSubst->add( '%wind-speed-unit%'       ,$this->aWeather['wind-speed-unit']                   );
        $oSubst->add( '%wind-speed-name%'       ,$this->aWeather['wind-speed-name']                   );
        $oSubst->add( '%weather%'               ,$this->aWeather['weather']                           );
        $oSubst->add( '%date%'                  ,date( 'd/m/Y',$this->aWeather['lupdate'] )           );
        $oSubst->add( '%time%'                  ,date( 'H:i',$this->aWeather['lupdate'] )             );
    */

    public function add( $szPattern,$szReplacement )
    /*--------------------------------------------*/
    {
        $this->aPatterns[]      = $szPattern;
        $this->aReplacements[]  = $szReplacement;

        // Je devrais me poser la question de savoir si je ne peux pas mettre au
        // point des substitutions avec appel de code comme:
        // $oSubst->add( '%dire%','%code:synonym("dire")%' );

        return ( $this );
    }   /* End of Substitution.add() ================================================== */
    /* ================================================================================ */


    /* Une array de substitutions est une collection de :

       array ( 'pattern'        => $szPattern       ,
               'replacement'    => $szReplacement   ,
             );

    */
    public function load( $aSubsts,$bAppend = false )
    /*---------------------------------------------*/
    {
        if ( is_array( $aSubsts ) )
        {
            if ( ! $bAppend )
            {
                $this->aPatterns     = null;
                $this->aReplacements = null;
            }   /* if ( ! $bAppend ) */

            foreach( $aSubsts as $aSubst )
            {
                $this->aPatterns[]      = $aSubst['pattern'];
                $this->aReplacements[]  = $aSubst['replacement'];
            }

            //var_dump( $this->aReplacements );
        }   /* if ( $aSubst = $this->getHashFile( $szFile ) ) */

        return ( $this );
    }   /* End of Substitution.load() ================================================= */
    /* ================================================================================ */


    /* Un fichier de substitutions est organisé en

       array ( 'pattern'        => $szPattern       ,
               'replacement'    => $szReplacement   ,
             );

    */
    public function loadFile( $szFile,$bAppend = false )
    /*------------------------------------------------*/
    {
        if ( $aSubsts = $this->getHashFile( $szFile ) )
        {
            $this->load( $aSubsts );
        }   /* if ( $aSubst = $this->getHashFile( $szFile ) ) */

        return ( $this );
    }   /* End of Substitution.loadFile() ============================================= */
    /* ================================================================================ */


    /* Un fichier de substitutions est organisé en

       array ( 'pattern'        => $szPattern       ,
               'replacement'    => $szReplacement   ,
             );

    */
    public function save( $szFile )
    /*---------------------------*/
    {
        $bRetVal = false;

        if ( ( $iCount = count( $this->aPatterns ) ) === count( $this->aReplacements ) )
        {
            echo __LINE__," ... " . __METHOD__ . "() : SHOULD SAVE SUBSTITUTIONS!!!\n";

            $aSubsts = null;

            for ( $i=0; $i < $iCount;$i++ )
            {
               $aSubsts[] = array ( 'pattern'        => $this->aPatterns[$i],
                                    'replacement'    => $this->aReplacements[$i],
                                  );
            }   /* for ( $i=0; $i < $iCount;$i++ ) */

            $bRetVal = $this->saveHashFile( $szFile,$aSubsts );
        }   /* if ( ( $iCount = count( this->aPatterns ) ) === count( $this->aReplacements ) ) */

        end:
        return ( $bRetVal );
    }   /* End of Substitution.save() ================================================= */
    /* ================================================================================ */


    public function run( $szSubject )
    /*-----------------------------*/
    {
        return ( preg_replace( $this->aPatterns,$this->aReplacements,$szSubject ) );
    }   /* End of Substitution.run() ================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Substitution.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class Substitution ====================================================== */
/* ==================================================================================== */
?>