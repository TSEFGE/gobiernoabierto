<?php
 session_start();
/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
include( "./Editor-PHP-1.5.6/php/DataTables.php" );
 
// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;
 
// Build our Editor instance and process the data coming from _POST
    if($_SESSION['userLevel']==-1){
            Editor::inst( $db, 'db_users' )
        ->fields(
            Field::inst( 'db_users.id' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'db_users.name' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'db_users.username' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'db_users.correo' ),
            Field::inst( 'db_users.idUnidad' ),
            Field::inst( 'db_users.level' ),
            Field::inst( 'db_users.create_at' )->validator( 'Validate::dateFormat', array(
                    "format"  => Format::DATE_ISO_8601,
                    "message" => "Introduce la fecha en el formato AAAA/MM/DD"
                ) )
                ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
            Field::inst( 'db_users.update_at' )->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
            Field::inst( 'unidad.nombre' ),
            Field::inst( 'unidad.id' )
        )
        ->leftJoin( 'unidad', 'unidad.id', '=', 'db_users.idUnidad' )
        ->where('db_users.activacion', 2 , '=')
        ->process( $_POST )
        ->json();
        }
    ?>