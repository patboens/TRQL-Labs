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
    {*file                  trql.qualitativevalue.class.php *}
    {*purpose               A predefined value for a product characteristic, e.g. the
                            power cord plug type 'US' or the garment sizes 'S', 'M',
                            'L', and 'XL'. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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
namespace trql\qualitativevalue;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\enumeration\Enumeration   as Enumeration;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ENUMERATION_CLASS_VERSION' ) )
    require_once( 'trql.enumeration.class.php' );

defined( 'QUALITATIVEVALUE_CLASS_VERSION' ) or define( 'QUALITATIVEVALUE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class QualitativeValue=

    {*desc

        A predefined value for a product characteristic, e.g. the power cord plug
        type 'US' or the garment sizes 'S', 'M', 'L', and 'XL'.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/QualitativeValue[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class QualitativeValue extends Enumeration
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

    public      $additionalProperty             = null;             /* {*property   $additionalProperty     (PropertyValue)                 A property-value pair representing an additional characteristics of
                                                                                                                                            the entitity, e.g. a product feature or another characteristic for
                                                                                                                                            which there is no matching property in schema.org.Note: Publishers
                                                                                                                                            should be aware that applications designed to use specific schema.org
                                                                                                                                            properties (e.g. http://schema.org/width, http://schema.org/color,
                                                                                                                                            http://schema.org/gtin13, ...) will typically expect such data to be
                                                                                                                                            provided using those properties, rather than using the generic
                                                                                                                                            property/value mechanism. *} */
    public      $equal                          = null;             /* {*property   $equal                  (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                            subject is equal to the object. *} */
    public      $greater                        = null;             /* {*property   $greater                (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                            subject is greater than the object. *} */
    public      $greaterOrEqual                 = null;             /* {*property   $greaterOrEqual         (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                            subject is greater than or equal to the object. *} */
    public      $lesser                         = null;             /* {*property   $lesser                 (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                            subject is lesser than the object. *} */
    public      $lesserOrEqual                  = null;             /* {*property   $lesserOrEqual          (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                            subject is lesser than or equal to the object. *} */
    public      $nonEqual                       = null;             /* {*property   $nonEqual               (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                            subject is not equal to the object. *} */
    public      $valueReference                 = null;             /* {*property   $valueReference         (Enumeration|StructuredValue|QuantitativeValue|QualitativeValue|PropertyValue)      A pointer to a 
                                                                                                                                            secondary value that provides additional information on the 
                                                                                                                                            original value, e.g. a reference temperature. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                    Wikidata ID: No equivalent *} */


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
    }   /* End of QualitativeValue.__construct() ====================================== */
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
    }   /* End of QualitativeValue.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class QualitativeValue ================================================== */
/* ==================================================================================== */
?>