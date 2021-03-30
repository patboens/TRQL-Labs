<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.definedterm.class.php *}
    {*purpose               A word, name, acronym, phrase, etc. with a formal definition. 
                            Often used in the context of category or subject 
                            classification, glossaries or dictionaries, product or 
                            creative work types, etc. Use the name property for the term
                            being defined, use termCode if the term has an alpha-numeric
                            code allocated, use description to provide the definition of the term. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 10:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 10:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\definedterm;

use \trql\schema\Thing                       as Thing;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\intangible\Intangible             as Intangible;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );


defined( 'DEFINEDTERM_CLASS_VERSION' ) or define( 'DEFINEDTERM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DefinedTerm=

    {*desc

        A word, name, acronym, phrase, etc. with a formal definition. Often used in 
        the context of category or subject classification, glossaries or dictionaries, 
        product or creative work types, etc. Use the name property for the term being 
        defined, use termCode if the term has an alpha-numeric code allocated, 
        use description to provide the definition of the term.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DefinedTerm[/url] *}

 */
/* ==================================================================================== */
class DefinedTerm extends Intangible
/*--------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public $inDefinedTermSet            = null;                 /* {*property       $inDefinedTermSet           (DefinedTermSet|URL)    A DefinedTermSet that contains this term. *} */
    public $termCode                    = null;                 /* {*property       $termCode                   (TYPE)                  A code that identifies this DefinedTerm within a 
                                                                                                                                        [c]DefinedTermSet[/c] *} */


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
    }   /* End of DefinedTerm.__construct() ========================================== */
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
    }   /* End of DefinedTerm.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class DefinedTerm ====================================================== */
/* ==================================================================================== */

?>