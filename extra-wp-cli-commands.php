<?php
/*
Plugin Name: Extra WP-CLI Commands
Description: Custom WP-CLI commands for site management.
Version: 1.0
Author: Anthony M. Darter
Author URI: https://www.anthonydarter.com
*/

if (!defined('ABSPATH')) {
    exit;
}

/** @disregard P1011 Undefined constant WP_CLI */
if (!defined('WP_CLI') || !WP_CLI || !class_exists('WP_CLI')) {
    return;
}

WP_CLI::add_command('extra', 'ExtraCommands');

class ExtraCommands
{
    private $colorRed = "\033[31m";
    private $colorGreen = "\033[32m";
    private $colorBlue = "\033[34m";
    private $colorReset = "\033[0m";

    /**
     * Wrap message in green color for the terminal.
     * @param string $message
     * @return string
     */
    private function green(string $message): string
    {
        return $this->colorGreen . $message . $this->colorReset;
    }

    /**
     * Wrap message in red color for the terminal.
     * @param string $message
     * @return string
     */
    private function red(string $message): string
    {
        return $this->colorRed . $message . $this->colorReset;
    }

    /**
     * Wrap message in blue color for the terminal.
     * @param string $message
     * @return string
     */
    private function blue(string $message): string
    {
        return $this->colorBlue . $message . $this->colorReset;
    }

    /**
     * Help command for the 'extra' command group.
     * 
     * Command: wp extra help
     *
     * @when after_wp_load
     * @param array $args Positional arguments.
     * @param array $assoc_args Associative arguments.
     * @return void
     */
    public function help(array $args = [], array $assoc_args = []): void
    {
        // Introduction to the custom WP-CLI commands
        WP_CLI::line("========================================");
        WP_CLI::line("Extra WP-CLI Commands");
        WP_CLI::line("========================================");
        WP_CLI::line("A set of extra commands for managing a WordPress site.");
        WP_CLI::line("");

        // Usage information
        WP_CLI::line("Usage:");
        WP_CLI::line("  wp extra <command> [<args>] [--<assoc_args>]");
        WP_CLI::line("");

        // List available commands with brief explanations
        WP_CLI::line("Available commands:");
        WP_CLI::line("  wp extra list                 - List available commands.");
        WP_CLI::line("  wp extra delete_all_images    - Deletes all images in the media library.");
        WP_CLI::line("    --force-delete              - (optional) Permanently delete images without moving to trash.");
        WP_CLI::line("");

        // Closing line for better readability
        WP_CLI::line("----------------------------------------");
    }

    /**
     * Deletes all images (attachments) in the Media Library.
     *
     * Command: wp extra delete_all_images [--force-delete]
     * 
     * <force-delete>
     *  : Force delete images without moving to trash.
     *
     * @when after_wp_load
     * @param array $args Positional arguments.
     * @param array $assoc_args Associative arguments.
     * @return void
     */
    public function delete_all_images(array $args = [], array $assoc_args = []): void
    {
        $image_ids = get_posts([
            'numberposts' => -1,
            'post_type'   => 'attachment',
            'post_mime_type' => 'image',
            'fields'      => 'ids',
        ]);

        if (empty($image_ids)) {
            WP_CLI::success($this->green("No images found to delete."));
            return;
        }

        $forceDelete = isset($assoc_args['force-delete']) ? true : false;

        foreach ($image_ids as $image_id) {
            $response = wp_delete_attachment($image_id, $forceDelete);
            if ($response === false || $response === null) {
                WP_CLI::error($this->red("Failed to delete image ID: " . $image_id));
                continue;
            }
            WP_CLI::line($this->green("Deleted image ID: " . $image_id));
        }

        WP_CLI::success($this->green(count($image_ids) . " images have been deleted."));
    }
}
