<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "userExam".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $exam_id
 * @property string $answers
 * @property integer $mark
 * @property integer $end
 */
class UserExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userExam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'exam_id'], 'required'],
            [['user_id', 'exam_id', 'end', 'failed'], 'integer'],
            [[ 'mark','answers'], 'string'],
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
            'exam_id' => 'Exam ID',
            'answers' => 'Answers',
            'mark' => 'Mark',
            'end' => 'End',
            'failed' => 'Failed',
        ];
    }
}
