<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */

if ( ! defined( 'ABSPATH' ) ) exit;

Timber::render( array( 'sidebar.twig' ), $data );
