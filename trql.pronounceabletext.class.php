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
    {*file                  trql.pronounceabletext.class.php *}
    {*purpose               Data type: PronounceableText. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\pronounceabletext;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\text\Text    as Text;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TEXT_CLASS_VERSION' ) )
    require_once( 'trql.text.class.php' );



defined( 'PRONOUNCEABLETEXT_CLASS_VERSION' ) or define( 'PRONOUNCEABLETEXT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PronounceableText=

    {*desc

        Data type: PronounceableText.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PronounceableText[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class PronounceableText extends Text
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $inLanguage                     = null;             /* {*property   $inLanguage                     (string|Language)               The language of the content or performance or used in an action.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also availableLanguage. *} */
    public      $phoneticText                   = null;             /* {*property   $phoneticText                   (string)                        Representation of a text textValue using the specified
                                                                                                                                                    speechToTextMarkup. For example the city name of Houston in IPA:
                                                                                                                                                    /ˈhjuːstən/. *} */
    public      $speechToTextMarkup             = null;             /* {*property   $speechToTextMarkup             (string)                        Form of markup used. eg. SSML or IPA. *} */
    public      $textValue                      = null;             /* {*property   $textValue                      (string)                        Text value being annotated. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;


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
    }   /* End of PronounceableText.__construct() ========================================== */
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
    }   /* End of PronounceableText.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class PronounceableText ====================================================== */
/* ==================================================================================== */

?>