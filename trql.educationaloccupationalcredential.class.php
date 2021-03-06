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
    {*file                  trql.educationaloccupationalcredential.class.php *}
    {*purpose               An educational or occupational credential. A diploma,
                            academic degree, certification, qualification, badge, etc.,
                            that may be awarded to a person or other entity that meets
                            the requirements defined by the credentialer. *}
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
namespace trql\educationaloccupationalcredential;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'EDUCATIONALOCCUPATIONALCREDENTIAL_CLASS_VERSION' ) or define( 'EDUCATIONALOCCUPATIONALCREDENTIAL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class EducationalOccupationalCredential=

    {*desc

        An educational or occupational credential. A diploma, academic degree,
        certification, qualification, badge, etc., that may be awarded to a person
        or other entity that meets the requirements defined by the credentialer.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/EducationalOccupationalCredential[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class EducationalOccupationalCredential extends CreativeWork
/*--------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $competencyRequired             = null;             /* {*property   $competencyRequired             (DefinedTerm|URL|string)        Knowledge, skill, ability or personal attribute that must be
                                                                                                                                                    demonstrated by a person or other entity. *} */
    public      $credentialCategory             = null;             /* {*property   $credentialCategory             (DefinedTerm|URL|string)        The category or type of credential being described, for example
                                                                                                                                                    "degree”, “certificate”, “badge”, or more specific term. *} */
    public      $educationalLevel               = null;             /* {*property   $educationalLevel               (DefinedTerm|URL|string)        The level in terms of progression through an educational or training
                                                                                                                                                    context. Examples of educational levels include 'beginner',
                                                                                                                                                    'intermediate' or 'advanced', and formal sets of level indicators. *} */
    public      $recognizedBy                   = null;             /* {*property   $recognizedBy                   (Organization)                  An organization that acknowledges the validity, value or utility of a
                                                                                                                                                    credential. Note: recognition may include a process of quality
                                                                                                                                                    assurance or accreditation. *} */
    public      $validFor                       = null;             /* {*property   $validFor                       (Duration)                      The duration of validity of a permit or similar thing. *} */
    public      $validIn                        = null;             /* {*property   $validIn                        (AdministrativeArea)            The geographic area where a permit or similar thing is valid. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */


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
    }   /* End of EducationalOccupationalCredential.__construct() ===================== */
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
    }   /* End of EducationalOccupationalCredential.__destruct() ====================== */
    /* ================================================================================ */
}   /* End of class EducationalOccupationalCredential ================================= */
/* ==================================================================================== */
?>