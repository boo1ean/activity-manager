<?php

namespace app\controllers;

use Yii;
use app\models\EventForm;
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
        if (Yii::$app->getUser()->getIsGuest()) {
            Yii::$app->getResponse()->redirect(array('site/login'));
        } else {
            $eventForm = new EventForm();
            $event     = new Event();

            echo $this->render('add',
                array(
                    'model' => $eventForm,
                    'event' => $event
                )
            );
        }
    }

    /**
     * Just save stuff here
     */
    public function actionSave() {
        $b = 1;
        if (Yii::$app->getUser()->getIsGuest()) {
            Yii::$app->getResponse()->redirect(array('site/login'));
        } else {
            if (Yii::$app->getRequest()->getIsPost()) {
                $eventForm = new EventForm();

                if ($eventForm->load($_POST) && $eventForm->saveEvent()) {
                    Yii::$app->getResponse()->redirect(array('event/dashboard'));
                } else {
                    $eventID = Yii::$app->getRequest()->getPost('id', null);
                    $event = (!empty($eventID))
                        ? Event::findByID($eventID)
                        : new Event();

                    $eventForm->setAttributes($_POST);

                    echo $this->render('add', array('model'  => $eventForm));
                }

            } else {
                Yii::$app->getResponse()->redirect(array('site/error'));
            }
        }
    }

    /**
     * Remove event
     */
    public function actionRemove() {
        // TODO: implement
    }

    /**
     * Send invitation to user
     */
    public function actionNotify() {
        // TODO: implement
    }

    /**
     * Probably user is able to edit his event
     *
     * @param int|null $id
     */
    public function actionEdit($id = null) {
        if (Yii::$app->getUser()->getIsGuest()) {
            Yii::$app->getResponse()->redirect(array('site/login'));
        } else {
            if (!$id) {
                Yii::$app->getResponse()->redirect(array('site/error'));
            }

            /**
             * @var $event \app\models\Event
             */
            $event = Event::findByID($id);
            if (!$event) {
                Yii::$app->getResponse()->redirect(array('site/error'));
            } else {
                $eventForm = new EventForm();
                $eventForm->setAttributes($event->toArray());

                echo $this->render('add', array('model' => $eventForm));
            }
        }
    }

    /**
     * Also event can be deleted by user if something gonna wrong
     *
     * @param int|null $id
     */
    public function actionDelete($id = null) {
        // TODO: implement
        echo "Are you sure to delete this?";
    }

    /**
     * User is able to invite other users to take part in his event
     *
     * @param int|null $id
     */
    public function actionInvite($id = null) {
        // TODO: implement
        echo "Invite people";
    }

    public function actionDetails($id = null) {
        // TODO: implement
        echo "Event details";
    }
}

