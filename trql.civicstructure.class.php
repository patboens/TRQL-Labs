<?php
/****************************************************************************************/

/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.civicstructure.class.php *}
    {*purpose               A public structure, such as a town hall or concert hall. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 29-07-20 12:11 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 12:11 *}
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
namespace trql\civicstructure;

use \trql\quitus\Mother                 as Mother;
use \trql\quitus\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\Place                   as Place;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );


defined( 'CIVICSTRUCTURE_CLASS_VERSION' ) or define( 'CIVICSTRUCTURE_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class CivicStructure=

    {*desc

         A public structure, such as a town hall or concert hall.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/CivicStructure[/url] *}

    *}}
 */
/* ================================================================================== */
class CivicStructure extends Place implements iContext
/*--------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $openingHours                       = null;         /* {*property   $openingHours               (string)                The general opening hours for a business. Opening hours 
                                                                                                                                        can be specified as a weekly time range, starting with 
                                                                                                                                        days, then times per day. Multiple days can be listed 
                                                                                                                                        with commas ',' separating each day. Day or time ranges 
                                                                                                                                        are specified using a hyphen '-'.

                                                                                                                                            - Days are specified using the following two-letter 
                                                                                                                                              combinations: Mo, Tu, We, Th, Fr, Sa, Su.
                                                                                                                                            - Times are specified using 24:00 time. For example, 
                                                                                                                                              3pm is specified as 15:00.
                                                                                                                                              Here is an example: 
                                                                                                                                              <time itemprop="openingHours" 
                                                                                                                                                    datetime="Tu,Th 16:00-20:00">Tuesdays and Thursdays 4-8pm
                                                                                                                                              </time>.

                                                                                                                                        If a business is open 7 days a week, then it can be specified as 
                                                                                                                                        <time itemprop="openingHours" 
                                                                                                                                              datetime="Mo-Su">Monday through Sunday, all day
                                                                                                                                        </time>. *} */

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
    }   /* End of CivicStructure.__construct() ======================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of CivicStructure.speak() ============================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of CivicStructure.sing() =============================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of CivicStructure.__destruct() ========================================= */
    /* ================================================================================ */

}   /* End of class CivicStructure ==================================================== */
/* ==================================================================================== */
?>