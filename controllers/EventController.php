<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Event;

/**
 * Class EventController is common controller for listing and CRUD events
 *
 * @package app\controllers
 */
class EventController extends Controller {

    /**
     * List of upcoming events in which user can take part or be invited
     */
    public function actionDashboard() {
        $events = Event::getEventList(true);
        echo $this->render('dashboard', array('events' => $events));
    }

    /**
     * User is able to create his own events
     */
    public function actionAdd() {
        // TODO: implement
        echo "New event";
    }

    /**
     * Probably user is able to edit his event
     *
     * @param int|null $eventID
     */
    public function actionEdit($eventID = null) {
        // TODO: implement
        echo "Edit event";
    }

    /**
     * Just save stuff here
     */
    public function actionSave() {
        // TODO: implement
    }

    /**
     * Also event can be deleted by user if something gonna wrong
     *
     * @param int|null $eventID
     */
    public function actionDelete($eventID = null) {
        // TODO: implement
        echo "Are you sure to delete this?";
    }

    /**
     * User is able to invite other users to take part in his event
     *
     * @param int|null $eventID
     */
    public function actionInvite($eventID = null) {
        // TODO: implement
        echo "Invite people";
    }

    public function actionDetails($eventID = null) {
        // TODO: implement
        echo "Event details";
    }
}

