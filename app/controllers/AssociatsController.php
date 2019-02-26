<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\controllers;

use cursophp7\app\repository\AssociatRepository;
use cursophp7\app\entity\Associat;
use cursophp7\app\utils\File;
use cursophp7\core\App;
use cursophp7\core\Response;
use Dompdf\Dompdf;
use cursophp7\app\exceptions\FileException;
use cursophp7\app\exceptions\ValidationException;
use cursophp7\core\helpers\FlashMessage;

/**
 * Description of AssociatsController
 *
 * @author Adrian Ciucurenco
 */
class AssociatsController {

    public function associats() {

        $errores = FlashMessage::get('erroresAsso', []);
        $nombre = FlashMessage::get('nombreAsso');
        $descripcion = FlashMessage::get('descripAsso');
        $mensajeConfirmacion = FlashMessage::get('mensajeAsso');

        $associatRepository = new AssociatRepository();

        $asociados = $associatRepository->findAll();

        Response::renderView('associats', 'layout', compact('nombre', 'descripcion', 'mensajeConfirmacion', 'asociados', 'errores'));
    }

    public function nou() {
        $user = App::get('appUser');
        try {
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));

            $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
            $imagen = new File('imagen', $tiposAceptados);

            $imagen->saveUploadFile(Associat::RUTA_IMAGES);

            $asso = new Associat($nombre, $imagen->getFileName(), $descripcion);
            $associatRepository = new AssociatRepository();
            $associatRepository->guarda($asso);

            $message = "Se ha guardado un nuevo asociado: " . $nombre;

            FlashMessage::set('mensajeAsso', $message);
            FlashMessage::noset('nombreAsso');
            FlashMessage::noset('descripAsso');
        } catch (ValidationException $ex) {
            FlashMessage::set('erroresAsso', [$ex->getMessage()]);
        } catch (FileException $ex) {
            FlashMessage::set('erroresAsso', [$ex->getMessage()]);
        }

        App::get('router')->redirect('associats');
    }

    public function delete(int $id) {
        $assoRepository = App::getRepository(AssociatRepository::class);
        $associat = $assoRepository->find($id);
        $assoRepository->delete($associat);
        Response::renderView('redirect', 'layout', compact('associat'));
        App::get('router')->redirect('associats');
    }

    public function modify() {

        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $imagen;
        $asso;
        try {
            $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
            $imagen = new File('imagen', $tiposAceptados);
            $imagen->saveUploadFile(Associat::RUTA_IMAGES);
            $asso = new Associat($nombre, $imagen->getFileName(), $descripcion);
        } catch (FileException $ex) {
            $asso = new Associat($nombre, FlashMessage::get('associatModifyImagen'), $descripcion);
        }

        $asso->setId(intval(FlashMessage::get('associatModifyId')));

        $associatRepository = new AssociatRepository();
        $associatRepository->modifica($asso);

        FlashMessage::noset('associatModify');

        App::get('router')->redirect('associats');
    }

    public function showModify(int $id) {
        $assoRepository = App::getRepository(AssociatRepository::class);
        $associat = $assoRepository->find($id);
        Response::renderView('show-modify', 'layout', compact('associat'));
    }

    public function imprimir() {
        $associats = App::getRepository(AssociatRepository::class)->findAll();
        $html = '<h1>Lista de asociados</h1>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach (($associats ?? []) as $asociado) {
            $html .= '<tr>
                        <th>' . $asociado->getId() . '</th>
                        <td>
                            <img width=250
                                src="' . $asociado->getRutaImages() . '"
                                alt="' . $asociado->getDescripcion() . '"
                                title="' . $asociado->getDescripcion() . '">
                        </td>
                        <td>' . $asociado->getNombre() . '</td>
                        <td>' . $asociado->getDescripcion() . '</td>
                    </tr>';
        }
                        
        $html .= '</tbody>
                </table>';
                            
        $pdf = new DOMPDF();
        $pdf->set_paper("A4", "portrait");
        $pdf->load_html(utf8_decode($html));
        $pdf->render();
        $pdf->stream('Asociados.pdf');
    }

}
