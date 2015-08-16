<?php
/**
 * Popaganda 2015 Theme Customizer
 *
 * @package Popaganda 2015
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function popa15_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// clean up
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');

	// add theme options
	$wp_customize->add_section('popa15_settings',	array(
		'title' => 'Popa15-inställningar',
		'priority' => 0
	));

	// visa köp biljett nu-bubblan
	$wp_customize->add_setting('show_buytix', array(
		'default' => false
	));
	$wp_customize->add_control('show_buytix',	array(
		'section' => 'popa15_settings',
		'label' => 'Köp biljett nu!',
		'description' => 'Visa "Köp biljett nu"-bubbla på förstasidan?',
		'type' => 'radio',
		'choices' => array(true => 'Ja', false => 'Nej')
	));

	// visa speldagar i artistnätet?
	$wp_customize->add_setting('show_day', array(
		'default' => false
	));
	$wp_customize->add_control('show_day',	array(
		'section' => 'popa15_settings',
		'label' => 'Speldagar',
		'description' => 'Visa speldagar i artistinfo (kräver att speltid anges i "time" under "Custom fields" för varje artist, i formatet YYYY-MM-DD HH:MM)?',
		'type' => 'radio',
		'choices' => array(true => 'Ja', false => 'Nej')
	));

	// visa spelschema?
	$wp_customize->add_setting('show_schedule', array(
		'default' => false
	));
	$wp_customize->add_control('show_schedule',	array(
		'section' => 'popa15_settings',
		'label' => 'Spelschema',
		'description' => 'Visa spelschema ovanför artistinfo (kräver att speltid anges i "time" under "Custom fields" för varje artist, i formatet YYYY-MM-DD HH:MM)?',
		'type' => 'radio',
		'choices' => array(true => 'Ja', false => 'Nej')
	));
}
add_action( 'customize_register', 'popa15_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function popa15_customize_preview_js() {
	wp_enqueue_script( 'popa15_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'popa15_customize_preview_js' );
