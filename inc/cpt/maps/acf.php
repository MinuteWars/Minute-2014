<?php /*
|--------------------------------------------------------------------------
| Map Editor
|--------------------------------------------------------------------------
|
| Custom field for ACF
| https://github.com/elliotcondon/acf-field-type-template/blob/master/%7B%7Bfield_name%7D%7D-v4.php
|
*/
class acf_field_map_editor extends acf_field
{
        // vars
        var $settings, // will hold info such as dir / path
        $defaults; // will hold default field options


        /*
        *  __construct
        *
        *  Set name / label needed for actions / filters
        *
        *  @since        3.6
        *  @date        23/01/13
        */
        function __construct()
        {
                // vars
                $this->name = 'map_editor';
                $this->label = __('Map Editor');
                $this->category = __("Minute Wars",'acf'); // Basic, Content, Choice, etc
                $this->defaults = array(
                    'data' => ''
                );


                // do not delete!
    parent::__construct();


    // settings
                $this->settings = array(
                        'path' => apply_filters('acf/helpers/get_path', __FILE__),
                        'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
                        'version' => '1.0.0'
                );

        }


        /*
        *  create_options()
        *
        *  Create extra options for your field. This is rendered when editing a field.
        *  The value of $field['name'] can be used (like bellow) to save extra data to the $field
        *
        *  @type        action
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $field        - an array holding all the field's data
        */

        function create_options($field)
        {
                // defaults?
                /*
                $field = array_merge($this->defaults, $field);
                */

                // key is needed in the field names to correctly save the data
                $key = $field['name'];
        }


        /*
        *  create_field()
        *
        *  Create the HTML interface for your field
        *
        *  @param        $field - an array holding all the field's data
        *
        *  @type        action
        *  @since        3.6
        *  @date        23/01/13
        */

        function create_field( $field )
        {
                // defaults?
                /*
                $field = array_merge($this->defaults, $field);
                */

                // perhaps use $field['preview_size'] to alter the markup?


                // create Field HTML
                ?>
                <div id="the-map-editor-wrap">
                    <div id="the-map-editor">
                    </div>
                </div>
                <menu id="the-map-editor-brushes">
                    <a href="#" class="grass selected"></a>
                    <a href="#" class="grass-tree"></a>
                </menu>
                <?php
        }


        /*
        *  input_admin_enqueue_scripts()
        *
        *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
        *  Use this action to add css + javascript to assist your create_field() action.
        *
        *  $info        http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
        *  @type        action
        *  @since        3.6
        *  @date        23/01/13
        */

        function input_admin_enqueue_scripts()
        {
                // Note: This function can be removed if not used
                wp_enqueue_script('underscore');
                wp_enqueue_script('acf-input-map_editor', $this->settings['dir'] . 'js/map-editor.js', array('underscore'), $this->settings['version'], true);
                wp_enqueue_style('acf-input-map_editor', $this->settings['dir'] . 'css/map-editor.css', null, $this->settings['version']);
        }


        /*
        *  input_admin_head()
        *
        *  This action is called in the admin_head action on the edit screen where your field is created.
        *  Use this action to add css and javascript to assist your create_field() action.
        *
        *  @info        http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
        *  @type        action
        *  @since        3.6
        *  @date        23/01/13
        */

        function input_admin_head()
        {
                // Note: This function can be removed if not used
        }


        /*
        *  field_group_admin_enqueue_scripts()
        *
        *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
        *  Use this action to add css + javascript to assist your create_field_options() action.
        *
        *  $info        http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
        *  @type        action
        *  @since        3.6
        *  @date        23/01/13
        */

        function field_group_admin_enqueue_scripts()
        {
                // Note: This function can be removed if not used
        }


        /*
        *  field_group_admin_head()
        *
        *  This action is called in the admin_head action on the edit screen where your field is edited.
        *  Use this action to add css and javascript to assist your create_field_options() action.
        *
        *  @info        http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
        *  @type        action
        *  @since        3.6
        *  @date        23/01/13
        */

        function field_group_admin_head()
        {
                // Note: This function can be removed if not used
        }


        /*
        *  load_value()
        *
        *  This filter is appied to the $value after it is loaded from the db
        *
        *  @type        filter
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $value - the value found in the database
        *  @param        $post_id - the $post_id from which the value was loaded from
        *  @param        $field - the field array holding all the field options
        *
        *  @return        $value - the value to be saved in te database
        */

        function load_value($value, $post_id, $field)
        {
                // Note: This function can be removed if not used
                return $value;
        }


        /*
        *  update_value()
        *
        *  This filter is appied to the $value before it is updated in the db
        *
        *  @type        filter
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $value - the value which will be saved in the database
        *  @param        $post_id - the $post_id of which the value will be saved
        *  @param        $field - the field array holding all the field options
        *
        *  @return        $value - the modified value
        */

        function update_value($value, $post_id, $field)
        {
                // Note: This function can be removed if not used
                return $value;
        }


        /*
        *  format_value()
        *
        *  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
        *
        *  @type        filter
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $value        - the value which was loaded from the database
        *  @param        $post_id - the $post_id from which the value was loaded
        *  @param        $field        - the field array holding all the field options
        *
        *  @return        $value        - the modified value
        */

        function format_value($value, $post_id, $field)
        {
                // defaults?
                /*
                $field = array_merge($this->defaults, $field);
                */

                // perhaps use $field['preview_size'] to alter the $value?


                // Note: This function can be removed if not used
                return $value;
        }


        /*
        *  format_value_for_api()
        *
        *  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
        *
        *  @type        filter
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $value        - the value which was loaded from the database
        *  @param        $post_id - the $post_id from which the value was loaded
        *  @param        $field        - the field array holding all the field options
        *
        *  @return        $value        - the modified value
        */

        function format_value_for_api($value, $post_id, $field)
        {
                // defaults?
                /*
                $field = array_merge($this->defaults, $field);
                */

                // perhaps use $field['preview_size'] to alter the $value?


                // Note: This function can be removed if not used
                return $value;
        }


        /*
        *  load_field()
        *
        *  This filter is appied to the $field after it is loaded from the database
        *
        *  @type        filter
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $field - the field array holding all the field options
        *
        *  @return        $field - the field array holding all the field options
        */

        function load_field($field)
        {
                // Note: This function can be removed if not used
                return $field;
        }


        /*
        *  update_field()
        *
        *  This filter is appied to the $field before it is saved to the database
        *
        *  @type        filter
        *  @since        3.6
        *  @date        23/01/13
        *
        *  @param        $field - the field array holding all the field options
        *  @param        $post_id - the field group ID (post_type = acf)
        *
        *  @return        $field - the modified field
        */

        function update_field($field, $post_id)
        {
                // Note: This function can be removed if not used
                return $field;
        }


}


// create field
new acf_field_map_editor();