<?php

namespace Views;

use Models\User;

/**
 * Class SecretaryView
 *
 * All view for secretary (Forms, tables, messages)
 *
 * @package Views
 */
class SecretaryView extends UserView
{

    /**
     * Display the creation form
     *
     * @return string
     */
    public function displayFormSecretary() {
        return '
        <h2> Compte secrétaire </h2>
        <p class="lead">Pour créer des secrétaires, remplissez ce formulaire avec les valeurs demandées.</p>
        ' . $this->displayBaseForm('Secre');
    }

    /**
     * Display a button for download all schedules
     */
    public function displayWelcomeAdmin() {
        return '
        <div class="row">
            <div class="col-6 mx-auto col-md-6 order-md-1">
                <img src="' . TV_PLUG_PATH . '/public/img/background.png" alt="Logo Amu" class="img-fluid mb-3 mb-md-0">
            </div>
            <div class="col-md-6 order-md-2 text-center text-md-left pr-md-5">
                <h1 class="mb-3 bd-text-purple-bright">' . get_bloginfo("name") . '</h1>
                <p class="lead">
                    Créer des informations pour toutes les télévisions connectées, les informations seront affichées sur chaque télévisions en plus des informations déjà publiées.
                    Les informations des télévisions peuvent contenir du texte, des images et même des pdf.
                </p>
                <p class="lead mb-4">Vous pouvez faire de même avec les alertes des télévisions connectées.</p>
                <p class="lead mb-4">Les informations seront affichés dans la partie de droite des télévisions et les alertes dans la partie rouge en bas des téléviseurs.</p>
                <div class="row mx-n2">
                    <div class="col-md px-2">
                        <a href="' . esc_url(get_permalink(get_page_by_title("Créer une information"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Créer une information</a>
                    </div>
                    <div class="col-md px-2">
                        <a href="' . esc_url(get_permalink(get_page_by_title("Créer une alerte"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Créer une alerte</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="masthead-followup row m-0 border border-white">
            <div class="col-md-6 p-3 p-md-5 bg-light border border-white">
                <h3><img src="' . TV_PLUG_PATH . '/public/img/+.png" alt="Ajouter une information/alerte" class="logo">Ajouter</h3>
                <p>Ajouter une information ou une alerte. Elles seront affichées le lendemain sur toutes les télévisions</p>
                <a href="' . esc_url(get_permalink(get_page_by_title("Créer une information"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Créer une information</a>
                <hr class="half-rule">
                <a href="' . esc_url(get_permalink(get_page_by_title("Créer une alerte"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Créer une alerte</a>
            </div>
            <div class="col-md-6 p-3 p-md-5 bg-light border border-white">
                <h3><img src="' . TV_PLUG_PATH . '/public/img/gestion.png" alt="voir les informations/alertes" class="logo">Gérer</h3>
                <p>Voir toutes les informations et alertes déjà publiées. Vous pouvez les supprimers, les modifiers ou bien juste les regarder</p>
                <a href="' . esc_url(get_permalink(get_page_by_title("Gestion des informations"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Voir mes informations</a>
                <hr class="half-rule">
                <a href="' . esc_url(get_permalink(get_page_by_title("Gestion des alertes"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Voir mes alertes</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto col-md-6 order-md-2">
                <img src="' . TV_PLUG_PATH . '/public/img/user.png" alt="Logo utilisateur" class="img-fluid mb-3 mb-md-0">
            </div>
            <div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
                <h2 class="mb-3 bd-text-purple-bright">Les utilisateurs</h2>
                <p class="lead">Vous pouvez ajouter des utilisateurs qui pourront à leur tour ajouter des informations et des alertes.</p>
                <p class="lead mb-4">Ils pourront aussi gérer leurs informations et leurs alertes.</p>
                <div class="row mx-n2">
                    <div class="col-md px-2">
                        <a href="' . esc_url(get_permalink(get_page_by_title("Créer un utilisateur"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Créer un utilisateur</a>
                    </div>
                    <div class="col-md px-2">
                        <a href="' . esc_url(get_permalink(get_page_by_title("Gestion des utilisateurs"))) . '" class="btn btn-lg button_presentation_ecran w-100 mb-3">Voir les utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto col-md-6 order-md-1">
                <img src="' . TV_PLUG_PATH . '/public/img/update.png" alt="Logo mise à jour" class="img-fluid mb-3 mb-md-0">
            </div>
            <div class="col-md-6 order-md-2 text-center text-md-left pr-md-5">
                <h2 class="mb-3 bd-text-purple-bright">Mettre à jour</h2>
                <p class="lead">Vous pouvez mettre à jour les emplois du temps du site.</p>
                <p class="lead mb-4">Mettre à jour, permet aussi de synchroniser les informations et les alertes postées depuis le site de l\'administration</p>
                <form method="post">
                    <button type="submit" class="btn btn-lg button_presentation_ecran" name="updatePluginEcranConnecte">Mettre à jour</button>
                </form>
            </div>
        </div>';
    }

    /**
     * Display all secretary
     *
     * @param $users    User[]
     *
     * @return string
     */
    public function displayAllSecretary($users) {
        $title = 'Secrétaires';
        $name = 'Secre';
        $header = ['Login'];

        $row = array();
        $count = 0;
        foreach ($users as $user) {
            ++$count;
            $row[] = [$count, $this->buildCheckbox($name, $user->getId()), $user->getLogin()];
        }

        return $this->displayAll($name, $title, $header, $row, 'Secre');
    }

    /**
     * Ask to the user to choose an user
     */
    public function displayNoUser() {
        return '<p class="alert alert-danger">Veuillez choisir un utilisateur </p>';
    }
}
