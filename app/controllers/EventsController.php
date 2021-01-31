<?php

namespace app\controllers;

use app\models\Bougie;
use app\models\Event;
use core\Application;
use core\Controller;
use core\Session;

/**
 * Class EventsController
 * @package app\controllers
 */
class EventsController extends Controller
{
    /**
     * Affiche tous les events
     */
    public function index()
    {
        $this->view->render("events/index", [
            'events' => Event::all()
        ]);
    }

    /**
     * Affiche le formulaire de création d'un event
     */
    public function addForm()
    {
        $this->view->render("events/add");
    }

    /**
     * Ajoute un event
     */
    public function add()
    {
        $event = [
            'name' => $this->request->post('name')
        ];

        if (Event::unique($event['name'], "name"))
        {
            Event::create($event);
            Session::addSuccess("Ajout réussi", "L\'évènement a bien été ajouté.");
            $this->redirect('/events');
        }
        else
        {
            Session::addError("Ajout impossible", "Cet évènement existe déjà");
            Session::setOld(['name' => $event['name']]);
            $this->redirect('/events/add');
        }
    }

    /**
     * Affiche les détails d'un event
     * @param mixed $id Identifiant de l'event
     */
    public function show($id)
    {
        $this->view->render("events/show", [
            'event' => Event::findOrFail($id)
        ]);
    }

    /**
     * Affiche le formulaire de modification d'un event
     * @param mixed $id Identifiant de l'event
     */
    public function updateForm($id)
    {
        $this->view->render("events/update", [
            'event' => Event::findOrFail($id)
        ]);
    }

    /**
     * Modifie un event
     * @param mixed $id Identifiant de l'event
     */
    public function update($id)
    {
        $event = [
            'name' => $this->request->post('name')
        ];

        Session::addSuccess("Modification réussie", "L\'évènement a bien été modifié.");

        Event::update($id, $event);

        $this->redirect('/events');

    }

    /**
     * Affiche le formulaire de suppression d'un event
     * @param mixed $id Identifiant de l'event
     */
    public function deleteForm($id)
    {
        $this->view->render("events/delete", [
            'event' => Event::findOrFail($id)
        ]);
    }

    /**
     * Supprime un event
     * @param mixed $id Identifiant de l'event
     */
    public function delete($id)
    {
        $event = Event::findOrFail($id);

        foreach ($event->bougies() as $bougie)
        {
            Event::raw("DELETE FROM `events` WHERE `id_bougie` = $bougie->id_bougie AND `id_event` = $event->id");
        }

        Event::delete($id);
        Session::addSuccess("Suppression réussie", "L\'évènement a bien été supprimé.");

        $this->redirect('/events');
    }

    /**
     * Affiche les détails des associations via la table assciation events
     * @param mixed $idEvent Identifiant de l'event
     */
    public function assocBougieForm($idEvent)
    {
        $bougies = Bougie::all();
        $event = Event::findOrFail($idEvent);

        $remainingBougies = [];

        foreach ($bougies as $bougie)
        {
            if (!in_array($bougie, $event->bougies()))
            {
                $remainingBougies[] = $bougie;
            }
        }

        $this->view->render("events/assocBougie", [
            'event' => $event,
            'bougies' => $remainingBougies,
            'assocBougies' => $event->bougies()
        ]);
    }

    /**
     * Ajoute une association bougie - event dans la table events
     * @param mixed $idEvent Identifiant de l'event
     */
    public function assocBougie($idEvent)
    {
        $event = Event::findOrFail($idEvent);

        $bougie = Bougie::find($this->request->post('id_bougie'));

        if ($bougie === false)
        {
            Session::addError("Association impossible", "La bougie n\'existe pas.");
        }
        else
        {
            Application::$app->db->save("events", [
                "id_event" => $event->id,
                "id_bougie" => $this->request->post('id_bougie')
            ]);
        }

        $this->redirect("/events/$event->id/assocbougie");
    }

    /**
     * Affiche le formulaire de suppression d'une association event - bougie
     * @param mixed $idEvent Identifiant de l'event
     * @param mixed $idBougie Identifiant de la bougie
     */
    public function deleteAssocBougieForm($idEvent, $idBougie)
    {
        $this->view->render("events/deleteAssoc", [
            'id_event' => $idEvent,
            'id_bougie' => $idBougie
        ]);
    }

    /**
     * Affiche le formulaire de suppression d'une association event - bougie
     * @param mixed $idEvent Identifiant de l'event
     * @param mixed $idBougie Identifiant de la bougie
     */
    public function deleteAssocBougie($idEvent, $idBougie)
    {
        $event = Event::findOrFail($idEvent);
        $bougie = Bougie::findOrFail($idBougie);

        Application::$app->db->deleteWhere("events", "id_event = $event->id AND id_bougie = $bougie->id_bougie");

        Session::addSuccess("Suppression réussie", "L\'association a bien été supprimée.");

        $this->redirect("/events/$event->id/assocbougie");
    }
}
