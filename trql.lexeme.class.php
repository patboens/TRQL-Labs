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
    {*file                  trql.lexeme.class.php *}
    {*purpose               Unit of lexical meaning *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08-11-20 14:00:55 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 08-11-20 08-11-20 14:00:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\lexeme;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\quitus\Mother                 as Mother;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MOTHER_CLASS_VERSION' ) )
    require_once( 'trql.mother.class.php' );



defined( 'LEXEME_CLASS_VERSION' ) or define( 'LEXEME_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Lexeme=

    {*desc

        Unit of lexical meaning

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q111352[/url] *}


 */
/* ==================================================================================== */
class Lexeme extends Mother
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasDefinedTerm                 = null;             /* {*property   $hasDefinedTerm                 (DefinedTerm)                   A Defined Term contained in this term set. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q111352';        /* {*property   $wikidataId                     (string)                        Wikidata ID ... unit of lexical meaning *} */




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

        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of Lexeme.__construct()================================================= */
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
    }   /* End of Lexeme.__destruct() ================================================= */
    /* ================================================================================ */

}   /* End of class Lexeme ============================================================ */
/* ==================================================================================== */

?>