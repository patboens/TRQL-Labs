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
    {*file                  trql.threedmodel.class.php *}
    {*purpose               A 3D model represents some kind of 3D content, which may have 
                            encodings in one or more MediaObjects. Many 3D formats are 
                            available (e.g. see Wikipedia); specific encoding formats 
                            can be represented using the encodingFormat property applied 
                            to the relevant MediaObject. For thecase of a single file 
                            published after Zip compression, the convention of 
                            appending '+zip' to the encodingFormat can be used. 
                            Geospatial, AR/VR, artistic/animation, gaming, engineering 
                            and scientific content can all be represented using 3DModel. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 08:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 08:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 02-03-21 16:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  3DModel renamed ThreeDModel
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\threedmodel;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\mediaobject\MediaObject   as MediaObject;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDIAOBJECT_CLASS_VERSION' ) )
    require_once( 'trql.mediaobject.class.php' );

defined( 'THREEDMODEL_CLASS_VERSION' ) or define( 'THREEDMODEL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ThreeDModel=

    {*desc

        A 3D model represents some kind of 3D content, which may have encodings in one 
        or more MediaObjects. Many 3D formats are available (e.g. see Wikipedia); 
        specific encoding formats can be represented using the encodingFormat property 
        applied to the relevant MediaObject. For thecase of a single file published 
        after Zip compression, the convention of appending '+zip' to the encodingFormat 
        can be used. Geospatial, AR/VR, artistic/animation, gaming, engineering and 
        scientific content can all be represented using 3DModel.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/3DModel[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 08:24.
    *}

 */
/* ==================================================================================== */
class ThreeDModel extends MediaObject
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $isResizable                    = null;             /* {*property   $isResizable                    (boolean)                       Whether the 3DModel allows resizing. For example, room layout
                                                                                                                                                    applications often do not allow 3DModel elements to be resized to
                                                                                                                                                    reflect reality. *} */

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
    }   /* End of ThreeDModel.__construct() =========================================== */
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
    }   /* End of ThreeDModel.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class ThreeDModel ======================================================= */
/* ==================================================================================== */
?>