<?php

namespace app\libs\helpers\mail;

use Yii;
use PHPMailer;

/**
 * @class Mailer provides simple wrapper on PHPMailer lib
 */
class Mailer extends PHPMailer {

    const DEFAULT_CHARSET     = 'utf-8';
    const DEFAULT_SENDER_NAME = 'Activity Manager';
    const DEFAULT_SENDER_MAIL = 'no-reply@actman.loc';

    /**
     * @param bool $exceptions
     */
    public function __construct($exceptions = false)
    {
        parent::__construct($exceptions);

        $this->Host       = Yii::$app->params['smtp_host'];
        $this->Username   = Yii::$app->params['smtp_user'];
        $this->Password   = Yii::$app->params['smtp_pwd'];
        $this->Port       = Yii::$app->params['smtp_port'];
        $this->SMTPSecure = Yii::$app->params['smtp_secure'];
        $this->CharSet    = self::DEFAULT_CHARSET;
        $this->SMTPAuth   = true;
        $this->isSMTP();
        $this->isHtml(true);
    }

    /**
     * Simplified form of PHPMailer::Send()
     *
     * @param $to
     * @param $subject
     * @param $body
     * @param string $from
     * @return bool
     */
    public function send($to, $subject, $body, $from = self::DEFAULT_SENDER_MAIL) {
        $this->Subject = $subject;
        $this->Body    = $body;
        $this->AddAddress($to);
        $this->SetFrom($from, self::DEFAULT_SENDER_NAME);

        return parent::Send();
    }

}