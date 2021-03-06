<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\InviteForm;
use app\models\EventForm;
use yii\web\Controller;
use app\models\Event;

/**
 * Class EventController is common controller for listing and CRUD events
 *
 * @package app\controllers
 */
class EventController extends Controller {

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'yii\web\CaptchaAction',
            ),
        );
    }

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
        if (Yii::$app->getUser()->getIsGuest()) {
            Yii::$app->getResponse()->redirect(array('site/login'));
        } else {
            if (Yii::$app->getRequest()->getIsPost()) {
                $eventForm = new EventForm();

                if ($eventForm->load($_POST) && $eventForm->saveEvent()) {
                    Yii::$app->getResponse()->redirect(array('event/dashboard'));
                } else {
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
        if (Yii::$app->getUser()->getIsGuest()) {
            Yii::$app->getResponse()->redirect(array('site/login'));
        } else {
            if (Yii::$app->getRequest()->getIsPost()) {
                $eventID = Yii::$app->getRequest()->getPost('id', null);
                if (!empty($eventID)) {
                    $event = Event::findByID($eventID);
                    if ($event) {
                        Event::deleteAll(array('id' => $eventID));
                        Yii::$app->getResponse()->redirect(array('event/dashboard'));
                    }
                } else {
                    Yii::$app->getResponse()->redirect(array('site/error'));
                }
            } else {
                Yii::$app->getResponse()->redirect(array('site/error'));
            }
        }
    }

    /**
     * Send invitation to user
     */
    public function actionNotify() {
        if (Yii::$app->getUser()->getIsGuest()) {
            Yii::$app->getResponse()->redirect(array('site/login'));
        } else {
            if (Yii::$app->getRequest()->getIsPost()) {
                $inviteForm = new InviteForm();

                if ($inviteForm->load($_POST) && $inviteForm->sendInvitation()) {
                    Yii::$app->getResponse()->redirect(array('event/dashboard'));
                } else {
                    $inviteForm->setAttributes($_POST);
                    /**
                     * @var $event \app\models\Event
                     */
                    $event = Event::findByID($inviteForm->event_id);
                    $emailList = User::getEmailList();
                    echo $this->render('invite',
                        array(
                            'model'     => $inviteForm,
                            'event'     => $event,
                            'emailList' => $emailList
                        )
                    );
                }

            } else {
                Yii::$app->getResponse()->redirect(array('site/error'));
            }
        }
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
            }

            echo $this->render('delete', array('event' => $event));
        }
    }

    /**
     * User is able to invite other users to take part in his event
     *
     * @param int|null $id
     */
    public function actionInvite($id = null) {
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
                $inviteForm = new InviteForm();
                $inviteForm->event_id = $event->id;

                $emailList = User::getEmailList();

                echo $this->render('invite',
                    array(
                        'model'     => $inviteForm,
                        'event'     => $event,
                        'emailList' => $emailList
                    )
                );
            }
        }
    }

    public function actionDetails($id = null) {
        // TODO: implement
        echo "Event details";
    }
}

