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
    {*file                  trql.anatomicalstructure.class.php *}
    {*purpose               Any part of the human body, typically a component of an
                            anatomical system. Organs, tissues, and cells are all
                            anatomical structures. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:36 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\anatomicalstructure;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\medicalentity\MedicalEntity   as MedicalEntity;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALENTITY_CLASS_VERSION' ) )
    require_once( 'trql.medicalentity.class.php' );

defined( 'ANATOMICALSTRUCTURE_CLASS_VERSION' ) or define( 'ANATOMICALSTRUCTURE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AnatomicalStructure=

    {*desc

        Any part of the human body, typically a component of an anatomical system.
        Organs, tissues, and cells are all anatomical structures.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AnatomicalStructure[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.
    *}

 */
/* ==================================================================================== */
class AnatomicalStructure extends MedicalEntity
/*-------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $associatedPathophysiology      = null;             /* {*property   $associatedPathophysiology      (string)                        If applicable, a description of the pathophysiology associated with
                                                                                                                                                    the anatomical system, including potential abnormal changes in the
                                                                                                                                                    mechanical, physical, and biochemical functions of the system. *} */
    public      $bodyLocation                   = null;             /* {*property   $bodyLocation                   (string)                        Location in the body of the anatomical structure. *} */
    public      $connectedTo                    = null;             /* {*property   $connectedTo                    (AnatomicalStructure)           Other anatomical structures to which this structure is connected. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $diagram                        = null;             /* {*property   $diagram                        (ImageObject)                   An image containing a diagram that illustrates the structure and/or
                                                                                                                                                    its component substructures and/or connections with other structures. *} */
    public      $partOfSystem                   = null;             /* {*property   $partOfSystem                   (AnatomicalSystem)              The anatomical or organ system that this structure is part of. *} */
    public      $relatedCondition               = null;             /* {*property   $relatedCondition               (MedicalCondition)              A medical condition associated with this anatomy. *} */
    public      $relatedTherapy                 = null;             /* {*property   $relatedTherapy                 (MedicalTherapy)                A medical therapy related to this anatomy. *} */
    public      $subStructure                   = null;             /* {*property   $subStructure                   (AnatomicalStructure)           Component (sub-)structure(s) that comprise this anatomical structure. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q4936952';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Entity with a single connected inherent 3D shape that's 
                                                                                                                                                    created by coordinated expression of the organism's own DNA *} */


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
    }   /* End of AnatomicalStructure.__construct() =================================== */
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
    }   /* End of AnatomicalStructure.__destruct() ==================================== */
    /* ================================================================================ */
}   /* End of class AnatomicalStructure =============================================== */
/* ==================================================================================== */
?>