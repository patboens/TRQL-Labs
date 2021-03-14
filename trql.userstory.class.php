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
    {*file                  trql.userstory.class.php *}
    {*purpose               An informal, natural language description of one or more
                            features of a software system, often written from the
                            perspective of either an end user or system user *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 11-03-21 08:10 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 11-03-21 08:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\userstory;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\task\Task         as Task;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TASK_CLASS_VERSION' ) )
    require_once( 'trql.task.class.php' );

defined( 'USERSTORY_CLASS_VERSION' ) or define( 'USERSTORY_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class UserStory=

    {*desc

        An informal, natural language description of one or more features of a
        software system, often written from the perspective of either an end
        user or system user

    *}

    *}}
 */
/* ==================================================================================== */
class UserStory extends Task
/*------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q218152';                /* {*property   $wikidataId                     (string)            Wikidata ID. An informal, natural language description of
                                                                                                                                        one or more features of a software system, often written
                                                                                                                                        from the perspective of either an end user or system user. *} */
    public      $dueDate                = null;                     /* {*property   $dueDate                        (Date|DateTime)     The end date and time of the item (in ISO 8601 date format):
                                                                                                                                        the date that it is expected to end, date the item is due. *} */
    public      $urgent                 = false;                    /* {*property   $urgent                         (bool)              [c]true[/c] if user story/task is urgent ("expedite" class in
                                                                                                                                        Kanban); [c]false[/c] if not *} */
    public      $timeSpan               = false;                    /* {*property   $timeSpan                       (int)               Number of days the item remained in a column of a taskboard
                                                                                                                                        or kanbanboard. *} */
    public      $tags                   = array();                  /* {*property   $tags                           (array)             An array of tags (name + color) associated with the User Story *} */
    public      $cover                  = null;                     /* {*property   $cover                          (ImageObject|URL)   An image of the item *} */
    public      $attachments            = null;                     /* {*property   $attachments                    (DigitalDocument)   An array of electronic files or documents. *} */
    public      $checklist              = null;                     /* {*property   $checklist                      (Checklist)         A list of items of any sort. *} */
    public      $comments               = null;                     /* {*property   $comments                       (ItemList)          A list of comments. *} */
    public      $whowhatwhy             = array( 'who'  => null,
                                                 'what' => null,
                                                 'why'  => null );  /* {*property   $whowhatwhy                     (array)             A triplet (Who, What, Why). Associative array. *} */

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

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );
        $this->classIcon = $this->self['icon'];

        return ( $this );
    }   /* End of UserStory.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*addTag( $szTitle,$szColor )=

        Add a tag to the collection of tags

        {*params
            $szTitle    (string)        Title of the tag
            $szColor    (string)        An HTML Color (e.g. [br]
                                        [c]"antiquewhite"   &#8211; rgb(250,235,215); Hex:faebd7[/c],[br]
                                        [c]"chartreuse"     &#8211; rgb(127,255,0);   Hex:7fff00[/c],[br]
                                        [c]"cyan"           &#8211; rgb(0,255,255);   Hex:00ffff[/c],[br]
                                        [c]"deeppink"       &#8211; rgb(255,20,147);  Hex:ff1493[/c],[br]
                                        [c]"greenyellow"    &#8211; rgb(173,255,47);  Hex:adff2f[/c],[br]
                                        etc.)
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
        use \trql\vaesoli\Vaesoli       as v;
        use \trql\userstory\UserStory   as UserStory;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

        if ( ! defined( 'USERSTORY_CLASS_VERSION' ) )
            require_once( 'd:/websites/snippet-center/trql.userstory.class.php' );

        $o = new UserStory();

        echo &quot;&lt;style&gt;\n&quot;;

          echo "span.ustag { padding: 5px; border-radius:4px; margin-right: 3px;}\n";
          echo "span.ustag::before { content : ' '}\n";
          echo "span.ustag::after { content : ' '}\n";
          echo "span.crimson { background: crimson; color: white;}\n";
          echo "span.deeppink { background: deeppink;}\n";
          echo "span.chartreuse{ background: chartreuse;}\n";
          echo "span.aquamarine{ background: aquamarine;}\n";
          echo "span.maroon{ background: maroon; color: white;}\n";
          echo "span.Expedite::after,\n";
          echo "span.Bug::after { content : '! '}\n";

        echo &quot;&lt;/style&gt;\n&quot;;

        [b]$o->addtag( "Expedite"  ,"crimson"      );
        $o->addtag( "Danger"    ,"deeppink"     );
        $o->addtag( "OK"        ,"chartreuse"   );
        $o->addtag( "Retest"    ,"aquamarine"   );
        $o->addtag( "Bug"       ,"maroon"       );[/b]

        echo $o->renderTags();
        var_dump( $o->tags );
        *}

        *}}
    */
    /* ================================================================================ */
    public function addTag( $szTitle,$szColor )
    /*---------------------------------------*/
    {
        $this->tags[] = array( 'title' => $szTitle,'color' => $szColor );
        return ( $this );
    }   /* End of UserStory.addTag() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*renderTags( [$szTitle] )=

        Render the HTML of the tags defined in the %class%

        {*params
            $szTitle    (string)        Title of the tag to render or [c]null[/c] if all
                                        tags must be rendered.
        *}

        {*return
            (string)    The HTML code of the tag(s)
        *}

        {*example
        use \trql\vaesoli\Vaesoli       as v;
        use \trql\userstory\UserStory   as UserStory;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'USERSTORY_CLASS_VERSION' ) )
            require_once( 'trql.userstory.class.php' );

        $o = new UserStory();

        echo &quot;&lt;style&gt;\n&quot;;

          echo "span.ustag { padding: 5px; border-radius:4px; margin-right: 3px;}\n";
          echo "span.ustag::before,\n";
          echo "span.ustag::after { content : ' '}\n";
          echo "span.crimson { background: crimson; color: white;}\n";
          echo "span.deeppink { background: deeppink;}\n";
          echo "span.Expedite::after { content : '! '}\n";

        echo &quot;&lt;/style&gt;\n&quot;;

        $o->addtag( "Expedite","crimson"  );
        $o->addtag( "Danger"  ,"deeppink" );

        [b]echo "&lt;p&gt;",$o->renderTags(),"&lt;/p&gt;\n;            // Render all tags
        echo "&lt;p&gt;",$o->renderTags('Expedite'),"&lt;/p&gt;\n"; // Render the 'Expedite' tag[/b]

        var_dump( $o->tags );
        *}

        *}}
    */
    /* ================================================================================ */
    public function renderTags( $szTitle = null )
    /*-----------------------------------------*/
    {
        $szRetVal = '';

        if ( is_null( $szTitle ) )
        {
            foreach( $this->tags as $aTag )
            {
                $szRetVal .= "<span class=\"ustag {$aTag['title']} {$aTag['color']}\">{$aTag['title']}</span>\n";
            }
        }
        else
        {
            foreach( $this->tags as $aTag )
            {
                if ( $aTag['title'] === $szTitle )
                {
                    $szRetVal .= "<span class=\"ustag {$aTag['title']} {$aTag['color']}\">{$aTag['title']}</span>\n";
                    break;
                }
            }
        }

        end:
        return ( $szRetVal );
    }

    /* ================================================================================ */
    /** {{*whoAmI()=

        Returns the name of the class

        {*params
        *}

        {*return
            (string)        The name of the class (with no namespace)
        *}

        *}}
    */
    /* ================================================================================ */
    public function whoAmI() : string
    /*--------------------*/
    {
        return ( $this->self['name'] );
    }   /* End of UserStory.WhoAmI() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*identity()=

        Returns a brief HTML

        {*params
        *}

        {*return
            (string)        HTML Code corresponding to the current object. Used when 
                            rendering a task/user story in a @class.TaskBoard or 
                            @class.KanbanBoard.
        *}

        *}}
    */
    /* ================================================================================ */
    public function identity() : string
    /*------------------------------*/
    {
        $szRetVal = '';

        /* {*todo Redefine the identitity method in terms of as (who) I need (what) because
                  (*why*) *} */

        $szRetVal = "<span class=\"identity\"><b class=\"name\">{$this->name}</b>: "                                .
            ( ! empty( $this->priority ) ? ( ' (<span class="priority">' . $this->priority . '</span>)' ) : '' )    .
            ( ! empty( $this->agent    ) ? ( ' (<span class="agent">'    . $this->agent    . '</span>)' ) : '' )    .
            " <span class=\"description\">{$this->description}</span>"                                              .
            ( $this->attention ? '<span class="attention" title="Attention!"></span>' : '' )                        .
            ( $this->late      ? '<span class="late" title="Late!"></span>'           : '' )                        .
            " <span class=\"credits\" title=\"Requires {$this->credits} credits\">{$this->credits}</span></span>";

        return ( $szRetVal );
    }   /* End of UserStory.identity() ================================================ */
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
    }   /* End of UserStory.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class UserStory ========================================================= */
/* ==================================================================================== */
