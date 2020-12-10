<?php


namespace App\Controllers;

use App\Models\Contributeur;

class AdminController extends Controller {

    public function accueil() {
        $this->isConnected(['admin']);

        return $this->view('admin/accueil', [
            'title' => 'Accueil',
        ]);
    }

    public function contributor() {
        $this->isConnected(['admin']);

        $contributors = Contributeur::all();

        return $this->view('admin/contributorManagement', [
            'title' => 'Contributeur',
            'contributors' => $contributors
        ]);
    }

    public function addContributorPage() {
        $this->isConnected(['admin']);

        return $this->view('admin/addContributor', [
            'title' => 'Ajouter Contributeur',
        ]);
    }

    public function addContributor() {
        $this->isConnected(['admin']);

        $infos = array_filter($_POST);
        if (count($infos) < 3) {
            return header('Location: '. SCRIPT_NAME .'/immersailles.php/admin/addContributor');
        }
        Contributeur::create($infos['username'], $infos['email'], $infos['password']);
        return header('Location: '. SCRIPT_NAME .'/immersailles.php/admin/contributors');
    }

    public function deleteContributor(int $idProfil) {
        $this->isConnected(['admin']);

        Contributeur::deleteProfil($idProfil);
        return header('Location: '. SCRIPT_NAME .'/immersailles.php/admin/contributors');
    }
}