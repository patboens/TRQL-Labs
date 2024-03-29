<?php
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
    {*file                  trql.localbusiness.class.php *}
    {*purpose               A particular physical business or branch of an organization.
                            Examples of [c]LocalBusiness[/c] include a restaurant, a 
                            particular branch of a restaurant chain, a branch of a bank,
                            a medical practice, a club, a bowling alley, etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:09 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel �t� sous le h�tre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16/08/2020 - 13:07 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schema\business;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\quitus\iContext                   as iContext;
use \trql\context\Context                   as Context;
use \trql\schema\organization\Organization  as Organization;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'LOCALBUSINESS_CLASS_VERSION' ) or define( 'LOCALBUSINESS_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class LocalBusiness=

    {*desc

        A particular physical business or branch of an organization. Examples of
        LocalBusiness include a restaurant, a particular branch of a restaurant
        chain, a branch of a bank, a medical practice, a club, a bowling alley,
        etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/LocalBusiness[/url] *}

    *}}
 */
/* ================================================================================== */
class LocalBusiness extends Organization implements iContext
/*--------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    public      $currenciesAccepted     = null;                     /* {*property   $currenciesAccepted             (string)                The currency accepted.
                                                                                                                    
                                                                                                                                            Use standard formats: ISO 4217 currency format
                                                                                                                                            e.g. "USD"; Ticker symbol for
                                                                                                                                            cryptocurrencies e.g. "BTC"; well known names for Local Exchange Tradings
                                                                                                                                            Systems (LETS) and other currency types e.g. "Ithaca HOUR". *} */
                                                                                                                    
    public      $openingHours           = null;                     /* {*property   $openingHours                   (string)                The general opening hours for a business. Opening hours can be specified
                                                                                                                                            as a weekly time range, starting with days, then times per day.
                                                                                                                                            Multiple days can be listed with commas ',' separating each day.
                                                                                                                                            Day or time ranges are specified using a hyphen '-'.
                                                                                                                    
                                                                                                                                            Days are specified using the following two-letter combinations:
                                                                                                                                            Mo, Tu, We, Th, Fr, Sa, Su.
                                                                                                                    
                                                                                                                                            Times are specified using 24:00 time. For example, 3pm is specified as 15:00.
                                                                                                                    
                                                                                                                                            Here is an example: <time itemprop="openingHours"
                                                                                                                                            datetime="Tu,Th 16:00-20:00">Tuesdays and Thursdays 4-8pm</time>.
                                                                                                                    
                                                                                                                                            If a business is open 7 days a week, then it can be specified as <time
                                                                                                                                            itemprop="openingHours" datetime="Mo-Su">Monday through Sunday, all day</time>. *} */
                                                                                                                    
    public      $paymentAccepted        = null;                     /* {*property   $paymentAccepted                (string)                Cash, Credit Card, Cryptocurrency, Local Exchange Tradings System, etc. *} */
    public      $priceRange             = null;                     /* {*property   $priceRange                     (string)                The price range of the business, for example $$$. *} */
                
    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q62849941';             /* {*property    $wikidataId                     (string)                Wikidata ID (https://www.wikidata.org/wiki/Wikidata:Main_Page) : Particular 
                                                                                                                                            physical business or branch of an organization *} */


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

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of LocalBusiness.__construct() ========================================= */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        echo __LINE__," ... " . __METHOD__ . "() : SHOULD RETURN TEMPLATES\n";
        die();

        return ( $aRetVal );
    }   /* End of LocalBusiness.templates() =========================================== */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        echo __LINE__," ... " . __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n";
        die();

        return ( $aRetVal );
    }   /* End of LocalBusiness.substitutions() ======================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of LocalBusiness.speak() =============================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of LocalBusiness.sing() ================================================ */
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
    }   /* End of LocalBusiness.__destruct() ========================================== */
    /* ================================================================================ */
}   /* End of class LocalBusiness ===================================================== */
/* ==================================================================================== */
