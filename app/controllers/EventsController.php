<?php

namespace app\controllers;

use app\models\Event;
use core\Controller;
use core\Session;

class EventsController extends Controller
{

    public function index()
    {
        $this->view->render("events/index", [
            'events' => Event::all()
        ]);
    }

    public function addForm()
    {
        $this->view->render("events/add");
    }

    public function add()
    {
        $event = [
            'name' => $this->request->post('name')
        ];

        if (Event::unique($event['name'], "name"))
        {
            Event::create($event);
            Session::addSuccess("Ajout réussi", "L\'event a bien été ajouté.");
            $this->redirect('/events');
        }
        else
        {
            Session::addError("Ajout impossible", "Cet event existe déjà");
            Session::setOld(['name' => $event['name']]);
            $this->redirect('/events/add');
        }
    }

    public function show($id)
    {
        $this->view->render("events/show", [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("events/update", [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function update($id)
    {
        $event = [
            'name' => $this->request->post('name')
        ];

        Session::addSuccess("Modification réussie", "L\'event a bien été modifié.");

        Event::update($id, $event);

        $this->redirect('/events');

    }

    public function deleteForm($id)
    {
        $this->view->render("events/delete", [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);

        if (count($event->bougies()) != 0)
        {
            Session::addError("Suppression impossible", "L\'events a encore des bougies.");
        }
        else
        {
            Event::delete($id);
            Session::addSuccess("Suppression réussie", "L\'event a bien été supprimé.");
        }
        $this->redirect('/events');
    }
}
