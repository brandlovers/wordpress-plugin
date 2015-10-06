<?php

/**
 *
 * @author Brandlovers
 * @version 1.0.0
 */
class BLCommentsAdmin
{
    /**
     * Plugin options
     *
     * @access private
     * @var array
     */
    private $options = [
        [
            'id' => 'data-num-comments',
            'name' => 'Number of comments',
            'type' => 'number',
            'input' => 'number',
            'place' => 'element',
        ],
        [
            'id' => 'data-show-profile-face',
            'name' => 'Display profile face',
            'type' => 'text',
            'input' => 'checkbox',
            'place' => 'element',
            'value' => '1',
        ],
        [
            'id' => 'data-color',
            'name' => 'Color',
            'type' => 'color',
            'input' => 'text',
            'place' => 'element',
        ],
        [
            'id' => 'data-font-color',
            'name' => 'Font color',
            'type' => 'color',
            'input' => 'text',
            'place' => 'element',
        ],
        [
            'id' => 'data-language',
            'name' => 'Language',
            'type' => 'text',
            'input' => 'select',
            'place' => 'script',
            'options' => [
                'pt' => 'Portuguese',
                'en' => 'English'
            ]
        ]
    ];

    /**
     * Options group
     *
     * @const
     */
    const OPTIONS_GROUP = 'bl_comments_options';

    /**
     * Options name
     *
     * @const
     */
    const OPTIONS_NAME = 'bl_comments';

    /**
     * Class constructor
     *
     * @access public
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Register plugin page
     *
     * @access public
     * @return void
     */
    public function add_plugin_page()
    {
        add_options_page(
            'Settings Admin',
            'BL Comments',
            'manage_options',
            'bl-comments-settings-admin',
            array($this, 'create_admin_page')
        );
    }

    /**
     * Print settings page
     *
     * @access public
     * @return void
     */
    public function create_admin_page()
    {
        ?>
        <div class="wrap">
            <h2>BL Comments Settings</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields('bl_comments_options');
                do_settings_sections('bl-comments-settings-admin');
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     *
     * @access public
     * @return void
     */
    public function page_init()
    {
        register_setting(
            self::OPTIONS_GROUP, // Option group
            self::OPTIONS_NAME, // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'default_settings', // ID
            'Default settings', // Title
            array($this, 'print_section_info'), // Callback
            'bl-comments-settings-admin' // Page
        );

        $options = $this->options;
        foreach ($options as $option) {
            add_settings_field(
                $option['id'], // ID
                $option['name'], // Title
                array($this, 'displayField'), // Callback
                'bl-comments-settings-admin', // Page
                'default_settings', // Section
                $option
            );
        }
        $options = get_option(self::OPTIONS_NAME);
    }

    /**
     * Display field by arguments
     *
     * @access public
     * @param array $arguments
     * @return void
     */
    public function displayField($arguments)
    {
        $options = get_option(self::OPTIONS_NAME);
        if ($arguments['input'] == 'select') {
            $element = sprintf(
                "<select id=\"%s\" name=\"%s\">",
                $arguments['id'],
                sprintf(
                    '%s[%s]',
                    self::OPTIONS_NAME,
                    $arguments['id']
                )
            );
            foreach ($arguments['options'] as $value => $name) {
                $element .= "<option value=\"$value\"";
                if (isset($options[$arguments['id']]) && $options[$arguments['id']] == $value) {
                    $element .= " selected ";
                }
                $element .= ">$name</option>";
            }
            $element .= "</select>";
        } else if ($arguments['input'] == 'checkbox') {
            $element = "<input type=\"checkbox\" name=\"%s\" value=\"%s\"";
            if (isset($options[$arguments['id']]) && $options[$arguments['id']] == 1) {
                $element .= " checked ";
            }
            $element .= ">";
            $element = sprintf(
                $element,
                sprintf(
                    '%s[%s]',
                    self::OPTIONS_NAME,
                    $arguments['id']
                ),
                $arguments['value']
            );
        } else {
            $value = isset($options[$arguments['id']]) ? esc_attr($options[$arguments['id']]) : '';
            $element = sprintf(
                "<input type=\"%s\" id=\"%s\" name=\"%s\" value=\"%s\" />",
                $arguments['type'],
                $arguments['id'],
                sprintf(
                    '%s[%s]',
                    self::OPTIONS_NAME,
                    $arguments['id']
                ),
                $value
            );
        }

        echo $element;
    }

    /**
     * Sanitize each setting field as needed
     *
     * @access public
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $options = $this->options;
        foreach($options as $key => $option) {
            if (isset($input[$option['id']])) {
                if ($option['type'] == 'number') {
                    $input[$option['id']] = absint($input[$option['id']]);
                } else if ($option['type'] == 'text') {
                    $input[$option['id']] = sanitize_text_field($input[$option['id']]);
                }

            }
        }

        return $input;
    }

    /**
     * Print the Section text
     *
     * @access public
     * @return void
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
}

