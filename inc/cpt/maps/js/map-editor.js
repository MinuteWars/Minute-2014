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
    var tile = [];  //Contains references to the tiles
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
        mapWidth = parseInt($mapWidth.val());
        mapHeight = parseInt($mapHeight.val());

        // Exit if invalid size
        if(!mapWidth || mapWidth < 10 || mapWidth > 30 ||
        !mapHeight || mapHeight < 10 || mapHeight > 30) return;

        // Resize the map
        $editor.width(settings.baseSize.width * mapWidth);
        $editor.height(settings.baseSize.height * mapHeight);

        //- - - - - - - - - - - - - - - - - - - - - - - -
        // Add the tiles and rebind events
        //- - - - - - - - - - - - - - - - - - - - - - - -
        for(x = 0; x < mapWidth; x++)
            tile[x] = [];

        for(y = 0; y < mapHeight; y++){
            for(x = 0; x < mapWidth; x++){
                $editor.append('<div class="tile grass"></div>');
                tile[x][y] = $('.tile', $editor).last();
                tile[x][y].data('coord', {x: x, y: y})
                    .data('tile', 'grass');
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
    | $this:    Tile to change
    | changeTo: brush-class to force change to
    */
    function changeTile($this, changeTo){
        if(!mousedown) return;
        var x = $this.data('coord').x;
        var y = $this.data('coord').y;
        
        //###############################################
        // Set update surrounding tiles to reflect this one
        //###############################################
        if(!changeTo){
            changeTo = currentBrush;
            switch(changeTo){
                //- - - - - - - - - - - - - - - - - - - - - - - -
                // Grass
                //- - - - - - - - - - - - - - - - - - - - - - - -
                case 'grass':
                    //north
                    if(y > 0){
                        if(tile[x][y-1].data('tile') == 'mountain-with-peak') changeTile(tile[x][y-1], 'mountain');
                        if(tile[x][y-1].data('tile') == 'mountain-small-with-peak') changeTile(tile[x][y-1], 'mountain-small');
                        if(tile[x][y-1].data('tile') == 'grass-with-peak') changeTile(tile[x][y-1], 'grass');
                        if(tile[x][y-1].data('tile') == 'grass-with-peak-and-shadow') changeTile(tile[x][y-1], 'grass-with-shadow');
                    }
                    //east
                    if(x+1 != mapWidth){
                        if(tile[x+1][y].data('tile') == 'tree-with-shadow') changeTile(tile[x+1][y], 'tree');
                        if(tile[x+1][y].data('tile') == 'grass-with-shadow') changeTile(tile[x+1][y], 'grass');
                        if(tile[x+1][y].data('tile') == 'grass-with-peak-and-shadow') changeTile(tile[x+1][y], 'grass-with-peak');
                    }
                    //south
                    if(y+1 != mapHeight){
                        if(_.indexOf(['mountain', 'mountain-with-peak'], tile[x][y+1].data('tile')) != -1) changeTo = 'grass-with-peak';
                        if(_.indexOf(['mountain-small', 'mountain-small-with-peak'], tile[x][y+1].data('tile')) != -1) {
                            changeTo = 'grass-with-peak';
                            changeTile(tile[x][y+1], 'mountain');
                        }
                    }
                    //west
                    if(x > 0){
                        if(_.indexOf(['tree', 'tree-with-shadow', 'mountain', 'mountain-with-peak', 'mountain-small', 'mountain-with-peak'], tile[x-1][y].data('tile')) != -1){
                            if(changeTo !== 'grass-with-peak') changeTo = 'grass-with-shadow';
                            else changeTo = 'grass-with-peak-and-shadow';
                        }
                    }
                break;

                //- - - - - - - - - - - - - - - - - - - - - - - -
                // Tree
                //- - - - - - - - - - - - - - - - - - - - - - - -
                case 'tree':
                    //north
                    if(y > 0){
                        if(tile[x][y-1].data('tile') == 'grass-with-peak') changeTile(tile[x][y-1], 'grass');
                        if(tile[x][y-1].data('tile') == 'grass-with-peak-and-shadow') changeTile(tile[x][y-1], 'grass-with-shadow');
                        if(tile[x][y-1].data('tile') == 'mountain-with-peak') changeTile(tile[x][y-1], 'mountain');
                        if(tile[x][y-1].data('tile') == 'mountain-small-with-peak') changeTile(tile[x][y-1], 'mountain-small');
                    }
                    //east
                    if(x+1 != mapWidth){
                        if(tile[x+1][y].data('tile') == 'grass') changeTile(tile[x+1][y], 'grass-with-shadow');
                        if(tile[x+1][y].data('tile') == 'grass-with-peak') changeTile(tile[x+1][y], 'grass-with-peak-and-shadow');
                        if(tile[x+1][y].data('tile') == 'tree') changeTile(tile[x+1][y], 'tree-with-shadow');
                    }
                    //south
                    if(y+1 != mapHeight){
                        if(tile[x][y+1].data('tile') == 'mountain') changeTile(tile[x][y+1], 'mountain-small');
                        if(tile[x][y+1].data('tile') == 'mountain-with-peak') changeTile(tile[x][y+1], 'mountain-small-with-peak');
                    }
                    //west
                    if(x > 0){
                        if(_.indexOf(['tree', 'tree-with-shadow', 'mountain', 'mountain-with-peak', 'mountain-small', 'mountain-small-with-peak'], tile[x-1][y].data('tile')) != -1) changeTo = 'tree-with-shadow';
                    }
                break;

                //- - - - - - - - - - - - - - - - - - - - - - - -
                // Mountain
                //- - - - - - - - - - - - - - - - - - - - - - - -
                case 'mountain':
                    //north
                    if(y > 0){
                        if(tile[x][y-1].data('tile') == 'grass') changeTile(tile[x][y-1], 'grass-with-peak');
                        if(tile[x][y-1].data('tile') == 'grass-with-shadow') changeTile(tile[x][y-1], 'grass-with-peak-and-shadow');
                        if(_.indexOf(['tree', 'tree-with-shadow'], tile[x][y-1].data('tile')) != -1) changeTo = 'mountain-small';
                        if(tile[x][y-1].data('tile') == 'mountain') changeTile(tile[x][y-1], 'mountain-with-peak');
                        if(tile[x][y-1].data('tile') == 'mountain-small') changeTile(tile[x][y-1], 'mountain-small-with-peak');
                    }
                    //east
                    if(x+1 != mapWidth){
                        if(tile[x+1][y].data('tile') == 'grass') changeTile(tile[x+1][y], 'grass-with-shadow');
                        if(tile[x+1][y].data('tile') == 'tree') changeTile(tile[x+1][y], 'tree-with-shadow');
                        if(tile[x+1][y].data('tile') == 'grass-with-peak') changeTile(tile[x+1][y], 'grass-with-peak-and-shadow');
                    }
                    //south
                    if(y+1 != mapHeight){
                        if(_.indexOf(['mountain', 'mountain-with-peak'], tile[x][y+1].data('tile')) != -1) {
                            if(changeTo == 'mountain-small') changeTo = 'mountain-small-with-peak';
                            else changeTo = 'mountain-with-peak';
                        }
                    }
                break;
            }
        }
        $this.attr('class', 'tile').addClass(changeTo)
            .data('tile', changeTo);
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
        $this.addClass('selected');
        return false;
    });
});