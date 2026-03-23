<?php
/**
 * WordPress Core Functions Stub
 * This file provides basic function declarations for WordPress core functions
 * to help Intelephense recognize them and avoid false positive errors.
 */

// Core WordPress functions
function language_attributes(): void {}
function bloginfo(string $show = ''): void {}
function wp_head(): void {}
function body_class(string|array $class = ''): void {}
function wp_body_open(): void {}
function wp_nav_menu(array $args = []): void {}
function get_terms(array|string $args = [], array $deprecated = []): array { return []; }
function is_wp_error(mixed $thing): bool { return false; }
function get_term_link(object|int|string $term, string $taxonomy = ''): string { return ''; }
function home_url(string $path = '', string|null $scheme = null): string { return ''; }
function has_custom_logo(): bool { return false; }
function the_custom_logo(): void {}
function get_search_query(bool $escaped = true): string { return ''; }
function wp_enqueue_script(string $handle, string $src = '', array $deps = [], string|bool|null $ver = false, bool $in_footer = false): void {}
function wp_enqueue_style(string $handle, string $src = '', array $deps = [], string|bool|null $ver = false, string $media = 'all'): void {}
function add_action(string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1): bool { return true; }

// WooCommerce functions
function wc_get_page_permalink(string $page): string { return ''; }
function wc_get_cart_url(): string { return ''; }
function WC(): WC_Core { return new WC_Core(); }

// Translation functions
function esc_html_e(string $text, string $domain = 'default'): void {}
function esc_attr_e(string $text, string $domain = 'default'): void {}
function esc_html(string $text): string { return $text; }
function esc_url(string $url, array $protocols = null, string $_context = 'display'): string { return $url; }
function esc_attr(string $text): string { return $text; }
function absint(mixed $maybeint): int { return 0; }

// Classes
class WP_Error {
    public function __construct(string $code = '', string $message = '', mixed $data = '') {}
}

class WC_Core {
    public $cart;
    public function __construct() {
        $this->cart = new WC_Cart();
    }
}

class WC_Cart {
    public function get_cart_contents_count(): int { return 0; }
}

// Constants
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);