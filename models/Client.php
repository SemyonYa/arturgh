<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $name_f
 * @property string $name_i
 * @property string $name_o
 * @property string $birth
 * @property string $place_reg
 * @property string $place_live
 * @property string $inn
 * @property string $snils
 * @property int $parent_id
 * @property int $on_delete
 * @property int $region_id
 * @property int $user_id
 *
 * @property Region $region
 * @property User $user
 * @property Payment[] $payments
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_f', 'name_i', 'birth', 'region_id', 'user_id'], 'required'],
            [['birth'], 'safe'],
            [['place_reg', 'place_live'], 'string'],
            [['parent_id', 'on_delete', 'region_id', 'user_id'], 'integer'],
            [['name_f', 'name_i', 'name_o', 'inn', 'snils'], 'string', 'max' => 45],
            [['snils'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_f' => 'Фамилия',
            'name_i' => 'Имя',
            'name_o' => 'Отчество',
            'birth' => 'Дата рождения',
            'place_reg' => 'Место регистрации',
            'place_live' => 'Место проживания',
            'inn' => 'ИНН',
            'snils' => 'СНИЛС',
            'parent_id' => 'Пришёл от',
            'on_delete' => 'На удаление',
            'region_id' => 'Регион',
        ];
    }

    public function getFio() {
        return $this->name_f . ' ' . substr($this->name_i, 0, 1) . '.' . substr($this->name_i, 0, 1) . '.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['client_id' => 'id']);
    }
}
