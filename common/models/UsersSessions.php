<?php

namespace common\models;

use Yii;
use common\models\User;
use yii\i18n\Formatter;


/**
 * This is the model class for table "usersSessions".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $start
 * @property integer $end
 *
 * @property User $user
 */
class UsersSessions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usersSessions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'start'], 'required'],
            [['user_id', 'start', 'end'], 'integer'],
            [['id'], 'string', 'max' => 64],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'start' => 'Start',
            'end' => 'End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /*
     * start the session
     */
    public function start($username) {
        $formate = new Formatter();
        $session = new UsersSessions();
        $userr = User::findOne(['username' => $username]);
        $session->id = Yii::$app->session->id;
        $session->user_id = $userr->getAttribute('id');
        $session->start =  (int)$formate->asTimestamp(date("Y-m-d H:i:s"));
        $session->save();
    }
    
    /*
     * end the session
     */
    public function end(){        
        $formate = new Formatter();
        $session = UsersSessions::findOne(['id' => Yii::$app->session->id]);
        $session->end = (int)$formate->asTimestamp(date("Y-m-d H:i:s"));
        $session->save();
    }
}
