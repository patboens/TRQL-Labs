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
    {*file                  trql.anatomicalsystem.class.php *}
    {*purpose               An anatomical system is a group of anatomical structures
                            that work together to perform a certain task. Anatomical
                            systems, such as organ systems, are one organizing principle
                            of anatomy, and can includes circulatory, digestive,
                            endocrine, integumentary, immune, lymphatic, muscular,
                            nervous, reproductive, respiratory, skeletal, urinary,
                            vestibular, and other systems. *}
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


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\anatomicalsystem;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\medicalentity\MedicalEntity   as MedicalEntity;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALENTITY_CLASS_VERSION' ) )
    require_once( 'trql.medicalentity.class.php' );

defined( 'ANATOMICALSYSTEM_CLASS_VERSION' ) or define( 'ANATOMICALSYSTEM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AnatomicalSystem=

    {*desc

        An anatomical system is a group of anatomical structures that work together
        to perform a certain task. Anatomical systems, such as organ systems, are
        one organizing principle of anatomy, and can includes circulatory,
        digestive, endocrine, integumentary, immune, lymphatic, muscular, nervous,
        reproductive, respiratory, skeletal, urinary, vestibular, and other
        systems.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AnatomicalSystem[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.
    *}

 */
/* ==================================================================================== */
class AnatomicalSystem extends MedicalEntity
/*----------------------------------------*/
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
    public      $comprisedOf                    = null;             /* {*property   $comprisedOf                    (AnatomicalStructure|AnatomicalSystem)Specifying something physically contained by something else. Typically
                                                                                                                                                    used here for the underlying anatomical structures, such as organs,
                                                                                                                                                    that comprise the anatomical system. *} */
    public      $relatedCondition               = null;             /* {*property   $relatedCondition               (MedicalCondition)              A medical condition associated with this anatomy. *} */
    public      $relatedStructure               = null;             /* {*property   $relatedStructure               (AnatomicalStructure)           Related anatomical structure(s) that are not part of the system but
                                                                                                                                                    relate or connect to it, such as vascular bundles associated with an
                                                                                                                                                    organ system. *} */
    public      $relatedTherapy                 = null;             /* {*property   $relatedTherapy                 (MedicalTherapy)                A medical therapy related to this anatomy. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q188193';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Sistema endocri: group of organs that work together to 
                                                                                                                                                    perform one or more functions; collection of organs joined in 
                                                                                                                                                    structural unit to serve a common function *} */


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
    }   /* End of AnatomicalSystem.__construct() ====================================== */
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
    }   /* End of AnatomicalSystem.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class AnatomicalSystem ================================================== */
/* ==================================================================================== */

?>