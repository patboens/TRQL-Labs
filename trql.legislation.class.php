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
    {*file                  trql.legislation.class.php *}
    {*purpose               A legal document such as an act, decree, bill, etc.
                            (enforceable or not) or a component of a legal act (like an
                            article). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\legislation;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork    as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'LEGISLATION_CLASS_VERSION' ) or define( 'LEGISLATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Legislation=

    {*desc

        A legal document such as an act, decree, bill, etc. (enforceable or not) or
        a component of a legal act (like an article).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Legislation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class Legislation extends CreativeWork
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

    public      $jurisdiction                   = null;             /* {*property   $jurisdiction                   (string|AdministrativeArea)     Indicates a legal jurisdiction, e.g. of some legislation, or where
                                                                                                                                                    some government service is based. *} */
    public      $legislationApplies             = null;             /* {*property   $legislationApplies             (Legislation)                   Indicates that this legislation (or part of a legislation) somehow
                                                                                                                                                    transfers another legislation in a different legislative context. This
                                                                                                                                                    is an informative link, and it has no legal value. For legally-binding
                                                                                                                                                    links of transposition, use the legislationTransposes property. For
                                                                                                                                                    example an informative consolidated law of a European Union's member
                                                                                                                                                    state "applies" the consolidated version of the European Directive
                                                                                                                                                    implemented in it. *} */
    public      $legislationChanges             = null;             /* {*property   $legislationChanges             (Legislation)                   Another legislation that this legislation changes. This encompasses
                                                                                                                                                    the notions of amendment, replacement, correction, repeal, or other
                                                                                                                                                    types of change. This may be a direct change (textual or non-textual
                                                                                                                                                    amendment) or a consequential or indirect change. The property is to
                                                                                                                                                    be used to express the existence of a change relationship between two
                                                                                                                                                    acts rather than the existence of a consolidated version of the text
                                                                                                                                                    that shows the result of the change. For consolidation relationships,
                                                                                                                                                    use the legislationConsolidates property. *} */
    public      $legislationConsolidates        = null;             /* {*property   $legislationConsolidates        (Legislation)                   Indicates another legislation taken into account in this consolidated
                                                                                                                                                    legislation (which is usually the product of an editorial process that
                                                                                                                                                    revises the legislation). This property should be used multiple times
                                                                                                                                                    to refer to both the original version or the previous consolidated
                                                                                                                                                    version, and to the legislations making the change. *} */
    public      $legislationDate                = null;             /* {*property   $legislationDate                (Date)                          The date of adoption or signature of the legislation. This is the date
                                                                                                                                                    at which the text is officially aknowledged to be a legislation, even
                                                                                                                                                    though it might not even be published or in force. *} */
    public      $legislationDateVersion         = null;             /* {*property   $legislationDateVersion         (Date)                          The point-in-time at which the provided description of the legislation
                                                                                                                                                    is valid (e.g. : when looking at the law on the 2016-04-07 (=
                                                                                                                                                    dateVersion), I get the consolidation of 2015-04-12 of the "National
                                                                                                                                                    Insurance Contributions Act 2015") *} */
    public      $legislationIdentifier          = null;             /* {*property   $legislationIdentifier          (string|URL)                    An identifier for the legislation. This can be either a string-based
                                                                                                                                                    identifier, like the CELEX at EU level or the NOR in France, or a
                                                                                                                                                    web-based, URL/URI identifier, like an ELI (European Legislation
                                                                                                                                                    Identifier) or an URN-Lex. *} */
    public      $legislationJurisdiction        = null;             /* {*property   $legislationJurisdiction        (string|AdministrativeArea)     The jurisdiction from which the legislation originates. *} */
    public      $legislationLegalForce          = null;             /* {*property   $legislationLegalForce          (LegalForceStatus)              Whether the legislation is currently in force, not in force, or
                                                                                                                                                    partially in force. *} */
    public      $legislationPassedBy            = null;             /* {*property   $legislationPassedBy            (Person|Organization)           The person or organization that originally passed or made the law :
                                                                                                                                                    typically parliament (for primary legislation) or government (for
                                                                                                                                                    secondary legislation). This indicates the "legal author" of the law,
                                                                                                                                                    as opposed to its physical author. *} */
    public      $legislationResponsible         = null;             /* {*property   $legislationResponsible         (Person|Organization)           An individual or organization that has some kind of responsibility for
                                                                                                                                                    the legislation. Typically the ministry who is/was in charge of
                                                                                                                                                    elaborating the legislation, or the adressee for potential questions
                                                                                                                                                    about the legislation once it is published. *} */
    public      $legislationTransposes          = null;             /* {*property   $legislationTransposes          (Legislation)                   Indicates that this legislation (or part of legislation) fulfills the
                                                                                                                                                    objectives set by another legislation, by passing appropriate
                                                                                                                                                    implementation measures. Typically, some legislations of European
                                                                                                                                                    Union's member states or regions transpose European Directives. This
                                                                                                                                                    indicates a legally binding link between the 2 legislations. *} */
    public      $legislationType                = null;             /* {*property   $legislationType                (CategoryCode|string)           The type of the legislation. Examples of values are "law", "act",
                                                                                                                                                    "directive", "decree", "regulation", "statutory instrument", "loi
                                                                                                                                                    organique", "règlement grand-ducal", etc., depending on the country. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId                 (string)                Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of Legislation.__construct() ========================================== */
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
    }   /* End of Legislation.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class Legislation ====================================================== */
/* ==================================================================================== */

?>