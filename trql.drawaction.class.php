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
    {*file                  trql.drawaction.class.php *}
    {*purpose               The act of producing a visual/graphical representation of an
                            object, typically with a pen/pencil and paper as
                            instruments. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
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
namespace trql\drawaction;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\createaction\CreateAction    as CreateAction;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATEACTION_CLASS_VERSION' ) )
    require_once( 'trql.createaction.class.php' );



defined( 'DRAWACTION_CLASS_VERSION' ) or define( 'DRAWACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DrawAction=

    {*desc

        The act of producing a visual/graphical representation of an object,
        typically with a pen/pencil and paper as instruments.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DrawAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class DrawAction extends CreateAction
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

    public      $actionStatus                   = null;             /* {*property   $actionStatus                   (ActionStatusType)              Indicates the current disposition of the Action. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $agent                          = null;             /* {*property   $agent                          (Organization|Person)           The direct performer or driver of the action (animate or inanimate).
                                                                                                                                                    e.g. John wrote a book. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $endTime                        = null;             /* {*property   $endTime                        (DateTime|Time)                 The endTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to end.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the end of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */
    public      $error                          = null;             /* {*property   $error                          (Thing)                         For failed actions, more information on the cause of the failure. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $instrument                     = null;             /* {*property   $instrument                     (Thing)                         The object that helped the agent perform the action. e.g. John wrote a
                                                                                                                                                    book with a pen. *} */
    public      $location                       = null;             /* {*property   $location                       (string|PostalAddress|VirtualLocation|Place)The location of for example where the event is happening, an
                                                                                                                                                    organization is located, or where an action takes place. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $object                         = null;             /* {*property   $object                         (Thing)                         The object upon which the action is carried out, whose state is kept
                                                                                                                                                    intact or changed. Also known as the semantic roles patient, affected
                                                                                                                                                    or undergoer (which change their state) or theme (which doesn't). e.g.
                                                                                                                                                    John read a book. *} */
    public      $participant                    = null;             /* {*property   $participant                    (Organization|Person)           Other co-agents that participated in the action indirectly. e.g. John
                                                                                                                                                    wrote a book with Steve. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $result                         = null;             /* {*property   $result                         (Thing)                         The result produced in the action. e.g. John wrote a book. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $startTime                      = null;             /* {*property   $startTime                      (DateTime|Time)                 The startTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to start.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the start of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $target                         = null;             /* {*property   $target                         (EntryPoint)                    Indicates a target EntryPoint for an Action. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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
    }   /* End of DrawAction.__construct() ========================================== */
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
    }   /* End of DrawAction.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class DrawAction ====================================================== */
/* ==================================================================================== */

?>