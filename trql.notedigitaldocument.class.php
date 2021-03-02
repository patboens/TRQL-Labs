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
    {*file                  trql.notedigitaldocument.class.php *}
    {*purpose               A file containing a note, primarily for the author. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 21:42 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 21:42 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\notedigitaldocument;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\digitaldocument\DigitalDocument    as DigitalDocument;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DIGITALDOCUMENT_CLASS_VERSION' ) )
    require_once( 'trql.digitaldocument.class.php' );



defined( 'NOTEDIGITALDOCUMENT_CLASS_VERSION' ) or define( 'NOTEDIGITALDOCUMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class NoteDigitalDocument=

    {*desc

        A file containing a note, primarily for the author.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/NoteDigitalDocument[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:42.
    *}

 */
/* ==================================================================================== */
class NoteDigitalDocument extends DigitalDocument
/*---------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasDigitalDocumentPermission   = null;             /* {*property   $hasDigitalDocumentPermission   (DigitalDocumentPermission)     A permission related to the access to this document (e.g. permission
                                                                                                                                                    to read or write an electronic document). For a public document,
                                                                                                                                                    specify a grantee with an Audience with audienceType equal to
                                                                                                                                                    "public". *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;

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
    }   /* End of NoteDigitalDocument.__construct() =================================== */
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
    }   /* End of NoteDigitalDocument.__destruct() ==================================== */
    /* ================================================================================ */

}   /* End of class NoteDigitalDocument =============================================== */
/* ==================================================================================== */

?>