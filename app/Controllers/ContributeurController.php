<?php


namespace App\Controllers;


class ContributeurController extends Controller {

    public function accueil() {
        $this->isConnected(['contributeur']);

        return $this->view('contributeur/accueil', [
            'title' => 'Accueil',
        ]);
    }
}