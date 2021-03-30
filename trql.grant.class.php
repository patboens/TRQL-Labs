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
    {*file                  trql.grant.class.php *}
    {*purpose               A grant, typically financial or otherwise 
                            quantifiable, of resources. Typically a funder 
                            sponsors some MonetaryAmount to an Organization 
                            or Person, sometimes not necessarily via a 
                            dedicated or long-lived Project, resulting in 
                            one or more outputs, or fundedItems. For 
                            financial sponsorship, indicate the funder 
                            of a MonetaryGrant. For non-financial support,
                            indicate sponsor of Grants of resources
                            (e.g. office space).

                            Grants support activities directed towards some agreed 
                            collective goals, often but not always organized as 
                            Projects. Long-lived projects are sometimes sponsored 
                            by a variety of grants over time, but it is also common
                            for a project to be associated with a single grant.

                            The amount of a Grant is represented using amount as a 
                            MonetaryAmount. *}

    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 02-03-21 12:53 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 02-03-21 12:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\grant;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\schema\Thing       as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'MONETARYGRANT_CLASS_VERSION' ) or define( 'MONETARYGRANT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MonetaryGrant=

    {*desc

        A grant, typically financial or otherwise quantifiable, of resources.
        Typically a funder sponsors some MonetaryAmount to an Organization or
        Person, sometimes not necessarily via a dedicated or long-lived Project,
        resulting in one or more outputs, or fundedItems. For financial
        sponsorship, indicate the funder of a MonetaryGrant. For non-financial
        support, indicate sponsor of Grants of resources (e.g. office space).

        Grants support activities directed towards some agreed collective goals,
        often but not always organized as Projects. Long-lived projects are
        sometimes sponsored by a variety of grants over time, but it is also
        common for a project to be associated with a single grant.

      The amount of a Grant is represented using amount as a MonetaryAmount.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Grant[/url] *}

 */
/* ==================================================================================== */
class Grant extends Thing
/*---------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $fundedItem                     = null;             /* {*property   $fundedItem                     (Thing)                         Indicates an item funded or sponsored through a Grant. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q230788';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Non-repayable funds disbursed by one party 
                                                                                                                                                    to a recipient *} */


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
    }   /* End of Grant.__construct() ================================================= */
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
    }   /* End of Grant.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Grant ============================================================= */
/* ==================================================================================== */
?>