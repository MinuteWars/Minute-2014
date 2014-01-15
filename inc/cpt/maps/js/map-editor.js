/*
|--------------------------------------------------------------------------
| Minute Wars Map Editor
|--------------------------------------------------------------------------
|
| This controls the backend map editor
|
*/
jQuery(function($){
    var $editor = $('#the-map-editor');
    var $mapWidth = $('#acf-field-map_width');
    var $mapHeight = $('#acf-field-map_height');
    var $fog = $('#acf-field-fog_of_war-1');
    var $tiles = null;
    var $brushes = $('#the-map-editor-brushes a');
    var currentBrush = 'grass';
    var mapWidth = 15;
    var mapHeight = 10;
    var mousedown = false;  //Is the mouse clicked?

    var settings = {
        // Dimensions for the base sizes
        baseSize: {
            width:  32,
            height: 32
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Handle global clicks
    |--------------------------------------------------------------------------
    */
    $(document).mousedown(function(){mousedown = true;})
        .mouseup(function(){mousedown = false;});

    /*
    |--------------------------------------------------------------------------
    | Update the map dimentions
    |--------------------------------------------------------------------------
    */
    function updateMapDimensions(){
        var x, y;
        mapWidth = $mapWidth.val();
        mapHeight = $mapHeight.val();

        // Exit if invalid size
        if(!mapWidth || mapWidth < 10 || mapWidth > 30 ||
        !mapHeight || mapHeight < 10 || mapHeight > 30) return;

        // Resize the map
        $editor.width(settings.baseSize.width * mapWidth);
        $editor.height(settings.baseSize.height * mapHeight);

        //- - - - - - - - - - - - - - - - - - - - - - - -
        // Add the tiles and rebind events
        //- - - - - - - - - - - - - - - - - - - - - - - -
        for(x = 0; x < mapWidth; x++){
            for(y = 0; y < mapHeight; y++){
                $editor.append('<div class="tile grass"></div>');
            }
        }
        $tiles = $('.tile', $editor);
        $tiles.mousedown(function(){mousedown = true; changeTile($(this));})
            .mouseenter(function(){changeTile($(this));});
    }
    updateMapDimensions();
    //- - - - - - - - - - - - - - - - - - - - - - - -
    // Events
    //- - - - - - - - - - - - - - - - - - - - - - - -
    $mapWidth.change(function(){
        updateMapDimensions();
    });
    $mapHeight.change(function(){
        updateMapDimensions();
    });

    /*
    |--------------------------------------------------------------------------
    | Change a tile
    |--------------------------------------------------------------------------
    |
    | TODO: Add touch support
    |
    */
    function changeTile($this){
        if(!mousedown) return;
        $this.attr('class', 'tile').addClass(currentBrush);
        console.log($this.attr('class'));
    }

    /*
    |--------------------------------------------------------------------------
    | Select a new brush
    |--------------------------------------------------------------------------
    */
    $brushes.click(function(){
        var $this = $(this);
        $brushes.removeClass('selected');
        currentBrush = $this.attr('class');
        console.log(currentBrush);
        $this.addClass('selected');
        return false;
    });
});