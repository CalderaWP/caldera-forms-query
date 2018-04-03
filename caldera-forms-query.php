<?php
/**
 * Plugin Name:     Caldera Query
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     caldera-forms-query
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 */


include_once __DIR__ .'/vendor/autoload.php';

if( function_exists( 'add_action' ) ){
	add_action( 'caldera_forms_includes_complete', function(){
		$x=  1;

		$entry = new \calderawp\CalderaFormsQuery\Select\Entry(
			new \calderawp\CalderaFormsQuery\MySqlBuilder(),
			'wp_cf_form_entries'
		);
		$entry->queryByFormsId( 'cf12345' );
		$entry->addOrderBy( 'form_id', false );
		$sql = $entry->getPreparedSql();
		$x= 1;




	});
}

