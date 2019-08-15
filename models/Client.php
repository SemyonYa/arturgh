<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Array_;
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
 * @property int $level
 * @property int $parent_id
 * @property int $on_delete
 * @property int $region_id
 * @property int $user_id
 *
 * @property Region $region
 * @property Client[] $children
 * @property Client[] $parents
 * @property Client $parent
 * @property string $fio
 * @property string $fioSnils
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
            [['name_f', 'name_i', 'name_o', 'birth', 'region_id', 'user_id'], 'required'],
            [['birth'], 'safe'],
            [['place_reg', 'place_live'], 'string'],
            [['parent_id', 'on_delete', 'region_id', 'user_id', 'level'], 'integer'],
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
            'level' => 'Уровень',
        ];
    }

    public function getFio()
    {
        return $this->name_f . ' ' . mb_substr($this->name_i, 0, 1) . '.' . mb_substr($this->name_i, 0, 1) . '.';
    }

    public function getFioSnils()
    {
        return $this->name_f . ' ' . $this->name_i . ' ' . $this->name_i . ' (' . $this->snils . ')';
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

    /**
     * @return Client
     */
    public function getParent()
    {
        return $this->parent_id ? Client::findOne($this->parent_id) : null;
    }

    public function getChildren()
    {
        return Client::find()->where(['parent_id' => $this->id])->all();
    }

    public function hasChildren()
    {
        return Client::find()->where(['parent_id' => $this->id])->one() != null;
    }

    public function getParents(Array $current = []) {
        if ($this->parent_id) {
            $client = Client::findOne($this->parent_id);
            $current[] = $client;
            if ($client->parent_id) {
                $current = $client->getParents($current);
            }
        }
        return $current;
    }

    public function setLevel() {
        $this->level = count($this->getParents()) + 1;
    }

    public function printChildren()
    {
        foreach ($this->children as $child) {
            if ($child->hasChildren()) {
                echo '<div class="panel-group" id="accordion' . $child->id . '" role="tablist" aria-multiselectable="true">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading" role="tab" id="heading' . $child->id . '">';
                echo '<h4 class="panel-title">';
                echo '<a role="button" data-toggle="collapse" data-parent="#accordion' . $child->id . '" href="#collapse' . $child->id . '" aria-expanded="true" aria-controls="collapse' . $child->id . '">';
                echo $child->fio . ' (level ' . $child->level . ')';
                echo '</a>';
                echo ' <span class="glyphicon glyphicon-eye-open" title="Быстрый просмотр" onclick="alert(\'Окно с краткими данными (можно также вставить финансовую информацию)\')"></span> ';
                echo ' <span class="glyphicon glyphicon-user" title="Перейти к карточке" onclick="GoTo(\'/client/view?id=' . $child->id . '\')"></span> ';
                echo ' <span class="glyphicon glyphicon-file" title="Отчёт по клиенту" onclick="alert(\'Переходим на страницу с отчётом по клиенту\')"></span> ';
                echo '</h4>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<div id="collapse' . $child->id . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $child->id . '">';
                echo '<div class="panel-body">';
                $child->printChildren();
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="client-net-non-children">'. '<span>&bull;</span>' . $child->fio . ' (level ' . $child->level . ')';
                echo ' <span class="glyphicon glyphicon-eye-open" title="Быстрый просмотр" onclick="alert(\'Окно с краткими данными (можно также вставить финансовую информацию)\')"></span> ';
                echo ' <span class="glyphicon glyphicon-user" title="Перейти к карточке" onclick="GoTo(\'/client/view?id=' . $child->id . '\')"></span> ';
                echo ' <span class="glyphicon glyphicon-file" title="Отчёт по клиенту" onclick="alert(\'Переходим на страницу с отчётом по клиенту\')"></span> ';
                echo '</div>';
            }
        }
    }

//    public function validateParent($attribute, $params) {
//        if ($this->attribute)
//    }
}
