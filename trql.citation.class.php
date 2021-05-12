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
    {*file                  trql.citation.class.php *}
    {*purpose               A quotation. Often but not necessarily from some written work,
                            attributable to a real world author and - if associated with
                            a fictional character - to any fictional [c]Person[/c]. Use
                            [c]isBasedOn[/c] to link to source/origin. The [c]recordedIn[/c]
                            property can be used to reference a Quotation from an Event. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 15-08-20 10:14 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 15-08-20 10:14 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schema;

use \trql\quitus\Mother                     as Mother;
use \trql\quitus\iContext                   as iContext;
use \trql\vaesoli\Vaesoli                   as V;
use \trql\schema\creativework\CreativeWork  as Creativework;
use \trql\html\Form                         as Form;
use \trql\html\Fieldset                     as Fieldset;
use \trql\html\Formset                      as Formset;
use \trql\html\Input                        as Input;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

defined( 'CITATION_CLASS_VERSION' ) or define( 'CITATION_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Citation=

    {*desc

        A quotation. Often but not necessarily from some written work,
        attributable to a real world author and - if associated with a fictional
        character - to any fictional Person. Use isBasedOn to link to
        source/origin. The recordedIn property can be used to reference a
        Quotation from an Event.

    *}

    {*remark

        The class is called "Quotation" in schema.org but I have preferred calling
        it "Citation" in the context of TRQL as it was called this way long before
        starting this homogenous work.

        The class is very incomplete at this stage (15-08-20 10:11:21) and I need
        to import a whole lot of code from the LSCitation class of Vaesoli that,
        over other things, takes advantage of the "citations.xml" resource.

    *}


    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}


    {*warning

        15-08-20 10:07:30 : This term is proposed for full integration into
        Schema.org, pending implementation feedback and adoption from
        applications and websites.

    *}

    {*doc [url]https://schema.org/Quotation[/url] *}

    *}}
 */
/* ================================================================================== */
class Citation extends CreativeWork implements iContext
/*---------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $spokenByCharacter      = null;                     /* {*property   $spokenByCharacter          (Organization|Person)       The (e.g. fictional) character, Person or Organization to whom
                                                                                                                                            the quotation is attributed within the containing CreativeWork. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q1713';                  /* {*property   $wikidataId                 (string)                    Wikidata ID. Reference to a source. *} */

    public      $szLang                 = null;                     /* {*property   $szLang                     (string)                    Language that must be taken into account *} */
    public      $szCallbackPre          = null;                     /* {*property   $szCallbackPre              (string)                    Pre-block callback - played back BEFORE citation rendering. NOT USED FOR NOW. *} */
    public      $szCallbackPost         = null;                     /* {*property   $szCallbackPost             (string)                    Post-block callback - played back AFTER citation rendering. NOT USED FOR NOW. *} */
    public      $szGUID                 = null;                     /* {*property   $szGUID                     (string)                    GUID of the citation *} */
    public      $szClass                = null;                     /* {*property   $szClass                    (string)                    CSS class of the citation when it needs to be rendered *} */
    public      $szOnSubmit             = null;                     /* {*property   $szOnSubmit                 (string)                    Submit clause of the form ([c]__toForm()[/c]) *} */
    public      $aQuotations            = null;                     /* {*property   $aQuotations                (array)                     Array of quotations (filled after a call to [c]load()[/c] *} */
    public      $szStorage              = null;                     /* {*property   $szStorage                  (string)                    The file in which all items are saved *} */
    public      $active                 = true;                     /* {*property   $active                     (bool)                      [c]true[/c] if the quote is active; [c]false[/c] otherwise *} */
    public      $editable               = true;                     /* {*property   $editable                   (bool)                      [c]true[/c] if the quote can be edited; [c]false[/c] otherwise *} */
    public      $source                 = null;                     /* {*property   $source                     (string)                    The CreativeWork or general source where the quote was found (e.g. title of a book) *} */
    public      $date                   = null;                     /* {*property   $date                       (string)                    The date the quote was formulated the 1st time *} */

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
    }   /* End of Citation.__construct() ============================================== */
    /* ================================================================================ */


    public function hasCitations() : bool
    /*---------------------------------*/
    {
        return ( is_array( $this->aQuotations ) && count( $this->aQuotations ) > 0 );
    }   /* End of Citation.hasCitations() ============================================= */
    /* ================================================================================ */


    public function load( $szFile ) : bool
    /*----------------------------------*/
    {
        $bRetVal = false;

        $this->aQuotations = null;

        if ( ( $oDom = new \DOMDocument() ) )                       /* Create a new dom */
        {
            if ( @$oDom->load( $szFile ) )                          /* Load the file if we can */
            {
                $this->szStorage = $szFile;
                $oDom->XInclude();                                  /* Handles all inclusions (if any) */

                if ( $oXPath = new \DOMXPath( $oDom ) )             /* Creates a new XPath object */
                {
                    $oColl = $oXPath->query( '//Citation' );

                    if ( $oColl && $oColl->length > 0 )
                    {
                        foreach( $oColl as $oNode )
                        {
                            if ( ( $o = $oXPath->query( 'Value',$oNode ) ) && ( $o->length > 0 ) )
                                $szValue = $o->item(0)->nodeValue;
                            else
                                $szValue = '';

                            if ( ( $o = $oXPath->query( 'Source',$oNode ) ) && ( $o->length > 0 ) )
                                $szSource = $o->item(0)->nodeValue;
                            else
                                $szSource = '';

                            $this->aQuotations[] = array( 'guid'      =>                   $oNode->getAttribute( 'guid'       )       ,
                                                          'active'    => V::MISC_CastBool( $oNode->getAttribute( 'active'     ),true ),
                                                          'editable'  => V::MISC_CastBool( $oNode->getAttribute( 'editable'   ),true ),
                                                          'lang'      =>                   $oNode->getAttribute( 'lang'       )       ,
                                                          'author'    =>                   $oNode->getAttribute( 'author'     )       ,
                                                          'date'      =>                   $oNode->getAttribute( 'date'       )       ,
                                                          'keywords'  =>                   $oNode->getAttribute( 'keywords'   )       ,
                                                          'value'     =>                   $szValue                                   ,
                                                          'source'    =>                   $szSource                                  ,
                                                        );
                        }   /* foreach( $oColl as $oNode ) */

                        $bRetVal = true;
                    }
                }
            }   /* if ( $oDom->load( $szFile ) ) */
        }   /* if ( ( $oDom = DOMDocument ) ) */

        end:
        return ( $bRetVal );
    }   /* End of Citation.load() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*fromPost2Array( $aData )=

        Returns the object as a form

        {*params
            $aData      (array)     Typically _POST
        *}

        {*return
            (array)     The array
        *}

        {*warning
            Temporary implementation. Do not use it in a production environment as it
            may disappear at any moment.
        *}

        *}}
    */
    /* ================================================================================ */
    public function fromPost2Array( $aData )
    /*------------------------------------*/
    {
        return ( array( 'guid'     => $aData['txtID'      ] ?? ( ! empty( $aData['txtID'] ) ? $aData['txtID'] : V::guid( true ) ),
                        'active'   => $aData['chkActive'  ] ?? null,
                        'editable' => $aData['chkEditable'] ?? null,
                        'lang'     => $aData['cboLang'    ] ?? null,
                        'author'   => $aData['txtAuthor'  ] ?? null,
                        'date'     => $aData['datDate'    ] ?? null,
                        'keywords' => $aData['txtKeywords'] ?? null,
                        'value'    => $aData['edtText'    ] ?? null,
                        'source'   => $aData['txtSource'  ] ?? null,
                      ) );
    }   /* End of Citation.fromPost2Array() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*fromArray2XML( $aData )=

        Returns the object as a form

        {*params
            $aData      (array)     Typically an associative array that's the result of
                                    [c]fromPost2Array()[/c]
        *}

        {*return
            (array)     The array
        *}

        {*warning
            Temporary implementation. Do not use it in a production environment as it
            may disappear at any moment.
        *}

        *}}
    */
    /* ================================================================================ */
    public function fromArray2XML( $aData )
    /*------------------------------------*/
    {
        $szXML = '';

        $szGUID = empty( $aData['guid'] ) ? V::guid( true ) : $aData['guid'];
        $szText = preg_replace( '/\R\z/sim','',$aData['value'] );

        $szXML .= "<Citation guid=\"{$szGUID}\" active=\"" . ( $aData['active'] ? 'yes': 'no' ) . "\" editable=\"" . ( $aData['editable'] ? 'yes': 'no' ) . "\" lang=\"{$aData['lang']}\" author=\"{$aData['author']}\" date=\"{$aData['date']}\" keywords=\"{$aData['keywords']}\">\n";
        $szXML .= "    <Value><![CDATA[{$szText}]]></Value>\n";
        $szXML .= "    <Source><![CDATA[{$aData['source']}]]></Source>\n";
        $szXML .= "</Citation>\n\n";

        return ( $szXML );
    }   /* End of Citation.fromArray2XML() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*search( $szPattern )=

        Returns all citations that match the term (case insensitive)

        {*params
            $szPattern  (string)    The pattern that must be satisfied. All
                                    quotes matching the pattern are returned
                                    (e.g. "/einstein/sim" )
        *}

        {*return
            (array)     The array
        *}

        {*warning
            Temporary implementation. Do not use it in a production environment as it
            may disappear at any moment.
        *}

        *}}
    */
    /* ================================================================================ */
    public function search( $szPattern )
    /*--------------------------------*/
    {
        $aRetVal = null;

        if ( $this->hasCitations() )
        {
            foreach( $this->aQuotations as $aCitation )
            {
                $szOneString = trim( (string) $aCitation['guid'      ] . ' ' ) .
                               trim( (string) $aCitation['active'    ] . ' ' ) .
                               trim( (string) $aCitation['editable'  ] . ' ' ) .
                               trim( (string) $aCitation['lang'      ] . ' ' ) .
                               trim( (string) $aCitation['author'    ] . ' ' ) .
                               trim( (string) $aCitation['date'      ] . ' ' ) .
                               trim( (string) $aCitation['keywords'  ] . ' ' ) .
                               trim( (string) $aCitation['value'     ] . ' ' ) .
                               trim( (string) $aCitation['source'    ] );

                if ( preg_match( $szPattern,$szOneString ) )
                    $aRetVal[] = $aCitation;
            }
        }   /* if ( $this->hasCitations() ) */

        return ( $aRetVal );
    }   /* End of Citation.search() =================================================== */
    /* ================================================================================ */


    /* TEMPORARY: WHAT IS TO BE SAVED ARE THE PROPERTIES OF THE OBJECT AND NOT AN ARRAY */
    public function save( $aCitation,$szFile = null )
    /*---------------------------------------------*/
    {
        $bRetVal = false;

        $szFile = $szFile ?? $this->szStorage;

        if ( ! is_null( $szFile ) && is_file( $szFile ) )
        {
            $szCitation = $this->fromArray2XML( $aCitation );
            $szXML = V::FIL_FileToStr( $szFile );
            $szXML = preg_replace( '%</Citations>(\R|\z)?%sim',"{$szCitation}</Citations>",$szXML );
            V::FIL_Copy( $szFile,$szFile . '.' . date( 'YmdHis' ) . '.backup' );
            $bRetVal = V::FIL_StrToFile( $szXML,$szFile );
        }

        return ( $bRetVal );
    }


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Citation.speak() ==================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Citation.sing() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Returns the object in HTML

        {*params
        *}

        {*return
            (string)        HTML Code corresponding to the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toHTML( $aCitation = null ) : string
    /*--------------------------------------------------*/
    {
        $szRetVal = '';

        //  'guid' => string 'a527f15c-b179-4f82-b9c0-e7e4e91b4cf6' (length=36)
        //  'active' => boolean true
        //  'editable' => boolean true
        //  'lang' => string 'fr' (length=2)
        //  'author' => string 'Dona Maurice ZANNOU' (length=19)
        //  'date' => string '' (length=0)
        //  'keywords' => string 'covid-19,coronavirus,pandémie' (length=30)
        //  'value' => string 'Le coronavirus est l'intrus qui est venu faire prendre conscience à l'humanité de sa fragilité.' (length=98)
        //  'source' => string '' (length=0)

        // @todo: Je dois m'inspirer de ce que j'avais fait dans Apocryphe
        // pour l'utilisation du cite

        $szRetVal .= "<blockquote id=\"{$aCitation['guid']}\" data-active=\"{$aCitation['active']}\" data-editable=\"{$aCitation['editable']}\" data-lang=\"{$aCitation['lang']}\" data-author=\"{$aCitation['author']}\" data-date=\"{$aCitation['date']}\" data-keywords=\"{$aCitation['keywords']}\" class=\"trql-{$this->self['name']}\">\n";
            $szRetVal .= "  <div>\n";
                $szRetVal .= V::STR_Reduce( $aCitation['value'] ) . " &#8211; {$aCitation['author']}\n";
                if ( ! empty( $aCitation['source'] ) )
                    $szRetVal .= "<cite>{$aCitation['source']}</cite>\n";
            $szRetVal .= "  </div>\n";
        $szRetVal .= "</blockquote> <!-- trql-{$this->self['name']} -->\n";

        return ( $szRetVal  );
    }   /* End of Citation.__toHTML() ================================================= */
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
            $oFieldset->szCaption   = ' [ Citation ] ';

            //  'guid' => string 'a527f15c-b179-4f82-b9c0-e7e4e91b4cf6' (length=36)
            //  'active' => boolean true
            //  'editable' => boolean true
            //  'lang' => string 'fr' (length=2)
            //  'author' => string 'Dona Maurice ZANNOU' (length=19)
            //  'date' => string '' (length=0)
            //  'keywords' => string 'covid-19,coronavirus,pandémie' (length=30)
            //  'value' => string 'Le coronavirus est l'intrus qui est venu faire prendre conscience à l'humanité de sa fragilité.' (length=98)
            //  'source' => string '' (length=0)

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'ID'                                            ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'GUID'                                          ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'GUID of the quote.'                            ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->identifier                               ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Active'                                        ,
                                                   'type'           =>  'chk'                                           ,
                                                   'label'          =>  'Active'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Is this quote active?'                         ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  false                                           ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->active                                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Editable'                                      ,
                                                   'type'           =>  'chk'                                           ,
                                                   'label'          =>  'Editable'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Is this quote editable?'                       ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  false                                           ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->editable                                 ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Lang'                                          ,
                                                   'type'           =>  'cbo'                                           ,
                                                   'label'          =>  'Language'                                      ,
                                                   'options'        =>  '<option value="en">En</option><option value="fr">Fr</option>',
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter the language of the quote'               ,
                                                   'maxlength'      =>  3                                               ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'value'          =>  $this->lang                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Author'                                        ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Author'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Author of the quote'                           ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->author                                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Date'                                          ,
                                                   'type'           =>  'dat'                                           ,
                                                   'label'          =>  'Date'                                          ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Date of the quote'                             ,
                                                   'required'       =>  false                                           ,
                                                   'help'           =>  false                                           ,
                                                   'style'          =>  'max-width:11em;width:11em;min-width:11em;'     ,
                                                   'value'          =>  $this->date                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Keywords'                                      ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Keywords'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Comma-separated list of keywords'              ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->keywords                                 ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Text'                                          ,
                                                   'type'           =>  'edt'                                           ,
                                                   'label'          =>  'Text'                                          ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Text of the quote'                             ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'rows'           =>  8                                               ,
                                                   'style'          =>  'resize:vertical;'                              ,
                                                   'value'          =>  $this->text                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Source'                                        ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Source'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Comma-separated list of keywords'              ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->source                                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                        ,
                                                   'type'           =>  'cmd'                                           ,
                                                   'class'          =>  'shadow'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Click to submit the values of a new quote'     ,
                                                   'value'          =>  'Create'                                        ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        //var_dump( $oForm );

        return ( (string) $oForm );
    }   /* End of Citation.__toForm() ================================================= */
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
            case 'lang'         :   return ( $this->szLang );
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */
    }   /* End of Citation.__get() ==================================================== */
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
            case 'lang'         :   $this->szLang = $x;
                                    break;
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": UNKNOWN PROPERTY '{$szVar}' (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }   /* switch ( $szVar ) */

        return ( $this );
    }   /* End of Citation.__set() ==================================================== */
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
    }   /* End of Citation.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Citation ========================================================== */
/* ==================================================================================== */
