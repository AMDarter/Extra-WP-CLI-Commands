# WP-CLI-Commands

# Extra WP-CLI Commands - Staff Usage

**Plugin Name**: Extra WP-CLI Commands  
**Version**: 1.0  
**Author**: Anthony M. Darter  
**Author URI**: [https://anthonymdarter.com](https://anthonymdarter.com)

### Overview

The Extra WP-CLI Commands plugin provides a set of custom commands designed for WordPress site management by technical staff members. These commands simplify certain tasks that would otherwise be more cumbersome to perform via the WordPress admin panel. This plugin is intended for use by staff or developers who have direct access to the WordPress CLI (Command Line Interface).

### Requirements

- **WordPress**: This plugin requires an active WordPress installation.
- **WP-CLI**: Must have WP-CLI installed and configured on your server to use these commands.
- **Permissions**: Staff must have proper permissions to execute WP-CLI commands (typically SSH access to the server).

### Installation

1. **Upload Plugin**: Upload the `extra-wp-cli-commands` directory to your WordPress plugin directory (`/wp-content/plugins/`).
2. **Activate Plugin**: Go to the WordPress admin dashboard, navigate to the **Plugins** page, and activate the "Extra WP-CLI Commands" plugin.

### Usage

The `extra` command group offers various commands for managing site content more efficiently. Below are the commands available in this version of the plugin.

#### Available Commands

1. **Help Command**
   ```
   wp extra help
   ```

- **Description**: Displays a list of all available commands within the `extra` command group.
- **Example**: Run `wp extra help` to see the available commands.

2. **Delete All Images from Media Library**
   ```
   wp extra delete_all_images [--force-delete]
   ```

- **Description**: Deletes all image attachments in the WordPress media library.
- **Options**:
  - `--force-delete`: Permanently delete images without moving them to the trash.
- **Example**: Run `wp extra delete_all_images --force-delete` to permanently delete all images.

### Safety Note

These commands are **powerful** and should be used with care.

### Author

Created by Anthony M. Darter. For more plugins or inquiries, visit [https://anthonymdarter.com](https://anthonymdarter.com).

### License

This plugin is licensed under the [MIT License](https://opensource.org/licenses/MIT).

### Support

For support or questions regarding the usage of these WP-CLI commands, please reach out to the development team or refer to the official WP-CLI documentation for general command usage.
