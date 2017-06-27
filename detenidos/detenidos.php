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
    if($_SESSION['userLevel']==3){
            Editor::inst( $db, 'detenido' )
        ->fields(
            Field::inst( 'detencion.id' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'detenido.nombre' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'detenido.paterno' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'detenido.materno' ),
            Field::inst( 'detenido.sexo' ),
            Field::inst( 'detenido.fechaNacimiento' )->validator( 'Validate::dateFormat', array(
                    "format"  => Format::DATE_ISO_8601,
                    "message" => "Introduce la fecha en el formato AAAA/MM/DD"
                ) )
                ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
            Field::inst( 'detencion.fechaInicio' )
                ->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
            Field::inst( 'detencion.fechaFin' )
                ->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
            Field::inst( 'unidad.nombre' ),
            Field::inst( 'detencion.ubicacion'),
            Field::inst( 'unidad.id' )
        )
        ->leftJoin( 'detencion', 'detenido.id', '=', 'detencion.idDetenido' )
        ->leftJoin( 'unidad', 'unidad.id', '=', 'detencion.idUnidad' )
        ->where('idUsuario',$_SESSION['idUsuario'],"=")
        ->process( $_POST )
        ->json();
        }else if($_SESSION['userLevel']==2){
            Editor::inst( $db, 'detenido' )
        ->fields(
            Field::inst( 'detencion.id' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'detenido.nombre' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'detenido.paterno' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'detenido.materno' ),
            Field::inst( 'detenido.sexo' ),
            Field::inst( 'detenido.fechaNacimiento' )->validator( 'Validate::dateFormat', array(
                    "format"  => Format::DATE_ISO_8601,
                    "message" => "Introduce la fecha en el formato AAAA/MM/DD"
                ) )
                ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
            Field::inst( 'detencion.fechaInicio' )
                ->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
            Field::inst( 'detencion.fechaFin' )
                ->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
            Field::inst( 'unidad.nombre' ),
            Field::inst( 'detencion.ubicacion'),
            Field::inst( 'unidad.id' )
        )
        ->leftJoin( 'detencion', 'detenido.id', '=', 'detencion.idDetenido' )
        ->leftJoin( 'unidad', 'unidad.id', '=', 'detencion.idUnidad' )
        ->where('detencion.idUnidad',$_SESSION['idUnidad'],"=")
        ->process( $_POST )
        ->json();
        }
        else if($_SESSION['userLevel']==1){

            Editor::inst( $db, 'detenido' )
            ->fields(
                Field::inst( 'detencion.id' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'detenido.nombre' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'detenido.paterno' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'detenido.materno' ),
                Field::inst( 'detenido.sexo' ),
                Field::inst( 'detenido.fechaNacimiento' )->validator( 'Validate::dateFormat', array(
                        "format"  => Format::DATE_ISO_8601,
                        "message" => "Introduce la fecha en el formato AAAA/MM/DD"
                    ) )
                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
                Field::inst( 'detencion.fechaInicio' )
                    ->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
                Field::inst( 'detencion.fechaFin' )
                    ->validator( 'Validate::numeric' )->setFormatter( 'Format::ifEmpty', null ),
                Field::inst( 'unidad.nombre' ),
                Field::inst( 'detencion.ubicacion'),
                Field::inst( 'unidad.id' )
            )
            ->leftJoin( 'detencion', 'detenido.id', '=', 'detencion.idDetenido' )
            ->leftJoin( 'unidad', 'unidad.id', '=', 'detencion.idUnidad' )
            ->process( $_POST )
            ->json();
        }
    ?>