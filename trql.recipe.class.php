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
    {*file                  trql.recipe.class.php *}
    {*purpose               A recipe. For dietary restrictions covered by the recipe, a
                            few common restrictions are enumerated via suitableForDiet.
                            The keywords property can also be used to add more detail. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\recipe;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\howto\HowTo       as HowTo;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'HOWTO_CLASS_VERSION' ) )
    require_once( 'trql.howto.class.php' );

defined( 'RECIPE_CLASS_VERSION' ) or define( 'RECIPE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Recipe=

    {*desc

        A recipe. For dietary restrictions covered by the recipe, a few common
        restrictions are enumerated via suitableForDiet. The keywords property can
        also be used to add more detail.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Recipe[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class Recipe extends HowTo
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $cookTime                       = null;             /* {*property   $cookTime                       (Duration)                      The time it takes to actually cook the dish, in ISO 8601 duration
                                                                                                                                                    format. *} */
    public      $cookingMethod                  = null;             /* {*property   $cookingMethod                  (string)                        The method of cooking, such as Frying, Steaming, ... *} */
    public      $nutrition                      = null;             /* {*property   $nutrition                      (NutritionInformation)          Nutrition information about the recipe or menu item. *} */
    public      $recipeCategory                 = null;             /* {*property   $recipeCategory                 (string)                        The category of the recipe—for example, appetizer, entree, etc. *} */
    public      $recipeCuisine                  = null;             /* {*property   $recipeCuisine                  (string)                        The cuisine of the recipe (for example, French or Ethiopian). *} */
    public      $recipeIngredient               = null;             /* {*property   $recipeIngredient               (string)                        A single ingredient used in the recipe, e.g. sugar, flour or garlic. *} */
    public      $recipeInstructions             = null;             /* {*property   $recipeInstructions             (CreativeWork|string|ItemList)  A step in making the recipe, in the form of a single item (document,
                                                                                                                                                    video, etc.) or an ordered list with HowToStep and/or HowToSection
                                                                                                                                                    items. *} */
    public      $recipeYield                    = null;             /* {*property   $recipeYield                    (string|QuantitativeValue)      The quantity produced by the recipe (for example, number of people
                                                                                                                                                    served, number of servings, etc). *} */
    public      $suitableForDiet                = null;             /* {*property   $suitableForDiet                (RestrictedDiet)                Indicates a dietary restriction or guideline for which this recipe or
                                                                                                                                                    menu item is suitable, e.g. diabetic, halal etc. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of Recipe.__construct() ================================================ */
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
    }   /* End of Recipe.__destruct() ================================================= */
    /* ================================================================================ */

}   /* End of class Recipe ============================================================ */
/* ==================================================================================== */

?>