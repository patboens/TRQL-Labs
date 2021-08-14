<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.definedterm.class.php *}
    {*purpose               A word, name, acronym, phrase, etc. with a formal definition.
                            Often used in the context of category or subject
                            classification, glossaries or dictionaries, product or
                            creative work types, etc. Use the name property for the term
                            being defined, use termCode if the term has an alpha-numeric
                            code allocated, use description to provide the definition of
                            the term. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 10:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

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

    {*chist
        {*mdate 08-06-21 10:26 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__construct() method[/c]
                            2)  [c]__toForm[/c]
                            3)  Adding [c]__get()[/c] and [c]__set()[/c] methods to be
                                able to handle a term in very musch the same ways as a
                                citation/quote
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schema;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\schema\Intangible     as Intangible;

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
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property       $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $inDefinedTermSet       = null;                     /* {*property       $inDefinedTermSet           (DefinedTermSet|URL)    A DefinedTermSet that contains this term. *} */
    public      $termCode               = null;                     /* {*property       $termCode                   (TYPE)                  A code that identifies this DefinedTerm within a
                                                                                                                                            [c]DefinedTermSet[/c] *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q1969448';               /* {*property       $wikidataId                 (string)                Wikidata ID. Term: word or phrase from a specialized area of knowledge. *} */
    public      $szClass                = null;                     /* {*property       $szClass                    (string)                CSS class of the citation when it needs to be rendered *} */
    public      $szOnSubmit             = null;                     /* {*property       $szOnSubmit                 (string)                Submit clause of the form ([c]__toForm()[/c]) *} */
    public      $class                  = null;                     /* {*property       $class                      (string)                A category for the item. Greater signs or slashes can be used to
                                                                                                                                            informally indicate a category hierarchy. *} */

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

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of DefinedTerm.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm()=

        Returns the object as a form

        {*params
        *}

        {*return
            (string)        HTML Code corresponding to a form of the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm() : string
    /*-------------------------------*/
    {
        $oForm                      = new Form();
        $oForm->szClass             = $this->szClass;
        $oForm->szOnSubmit          = $this->szOnSubmit;

        $oForm->settings['withBR']  = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = ' [ Term ] ';

            /*
                <Term key="FSC" class="IT" keywords="ITIL" date="20061229" id="be6bb193-139d-49ef-9091-ee8227288e3a">
                    <Value lang="en"><![CDATA[Forward Schedule of Changes]]></Value>
                </Term>
            */

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'ID'                                                            ,
                                                   'type'           =>  'txt'                                                           ,
                                                   'label'          =>  'GUID'                                                          ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'GUID of the term.'                                             ,
                                                   'required'       =>  false                                                           ,
                                                   'delete'         =>  true                                                            ,
                                                   'help'           =>  false                                                           ,
                                                   'value'          =>  $this->identifier                                               ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Key'                                                           ,
                                                   'type'           =>  'txt'                                                           ,
                                                   'label'          =>  'GUID'                                                          ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'GUID of the term.'                                             ,
                                                   'required'       =>  false                                                           ,
                                                   'delete'         =>  true                                                            ,
                                                   'help'           =>  false                                                           ,
                                                   'value'          =>  $this->ref                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Active'                                                        ,
                                                   'type'           =>  'chk'                                                           ,
                                                   'label'          =>  'Active'                                                        ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Is this term active?'                                          ,
                                                   'required'       =>  false                                                           ,
                                                   'delete'         =>  false                                                           ,
                                                   'help'           =>  false                                                           ,
                                                   'value'          =>  $this->active                                                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Lang'                                                          ,
                                                   'type'           =>  'cbo'                                                           ,
                                                   'label'          =>  'Language'                                                      ,
                                                   'options'        =>  '<option value="en">En</option><option value="fr">Fr</option>'  ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Enter the language in which the term is defined'               ,
                                                   'maxlength'      =>  3                                                               ,
                                                   'required'       =>  false                                                           ,
                                                   'delete'         =>  true                                                            ,
                                                   'help'           =>  false                                                           ,
                                                   'step'           =>  1                                                               ,
                                                   'value'          =>  $this->lang                                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Date'                                                          ,
                                                   'type'           =>  'dat'                                                           ,
                                                   'label'          =>  'Date'                                                          ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Date of the term was entered'                                  ,
                                                   'required'       =>  false                                                           ,
                                                   'help'           =>  false                                                           ,
                                                   'style'          =>  'max-width:11em;width:11em;min-width:11em;'                     ,
                                                   'value'          =>  $this->date                                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Keywords'                                                      ,
                                                   'type'           =>  'txt'                                                           ,
                                                   'label'          =>  'Keywords'                                                      ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Comma-separated list of keywords applied to the term'          ,
                                                   'required'       =>  false                                                           ,
                                                   'delete'         =>  true                                                            ,
                                                   'help'           =>  false                                                           ,
                                                   'value'          =>  $this->keywords                                                 ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Text'                                                          ,
                                                   'type'           =>  'edt'                                                           ,
                                                   'label'          =>  'Text'                                                          ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Definition of the term'                                        ,
                                                   'required'       =>  true                                                            ,
                                                   'delete'         =>  true                                                            ,
                                                   'help'           =>  false                                                           ,
                                                   'rows'           =>  8                                                               ,
                                                   'style'          =>  'resize:vertical;'                                              ,
                                                   'value'          =>  $this->text                                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Class'                                                         ,
                                                   'type'           =>  'txt'                                                           ,
                                                   'label'          =>  'Source'                                                        ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Class of the term (category; e.g. "IT")'                       ,
                                                   'required'       =>  false                                                           ,
                                                   'delete'         =>  true                                                            ,
                                                   'help'           =>  false                                                           ,
                                                   'value'          =>  $this->class                                                    ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                                        ,
                                                   'type'           =>  'cmd'                                                           ,
                                                   'class'          =>  'shadow'                                                        ,
                                                   'lang'           =>  'en'                                                            ,
                                                   'tooltip'        =>  'Click to submit the values of the new term'                    ,
                                                   'value'          =>  'Create'                                                        ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        //var_dump( $oForm );

        return ( (string) $oForm );
    }   /* End of DefinedTerm.__toForm() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szVar )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
        *}

        {*return
            (mixed)     The value of [c]$szVar[/c] or throwing an exception if
                        [c]$szVar[/c] NOT found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szVar )
    /*---------------------------*/
    {
        switch ( $szVar )
        {
            case 'text'         :   return ( $this->description );
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */
    }   /* End of DefinedTerm.__get() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__set( $szVar,$x )=

        Used for setting data of inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
            $x          (mixed)         The value to assign to @param.szVar
        *}

        {*return
            (self)      Returns the current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __set( $szVar,$x )
    /*------------------------------*/
    {
        switch ( $szVar )
        {
            case 'text'         :   $this->description = $x;
                                    break;
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */

        return ( $this );
    }   /* End of DefinedTerm.__set() ==================================================== */
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
    }   /* End of DefinedTerm.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class DefinedTerm ======================================================= */
/* ==================================================================================== */
