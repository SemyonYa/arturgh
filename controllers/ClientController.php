<?php

namespace app\controllers;

use app\models\Au;
use Yii;
use app\models\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ClientController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        Au::isManager();
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $clients = Client::find()->all();
        return $this->render('index', compact('clients'));
    }

    /**
     * Displays a single Client model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();
        $model->user_id = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            $model->setLevel();
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setLevel();
            if ($model->parent_id) {
                $parent_parents = $model->parent->parents;
                foreach ($parent_parents as $client) {
                    if ($client->id === $model->id) {
                        $parent_error = 'Недопустимое значение';
                        return $this->render('update', compact('model', 'parent_error'));
                    }
                }
            }
            if ($model->save()) {
                return $this->redirect('/client/view?id=' . $model->id);
            }
        }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionParentList($id, $parent_id)
    {
        $this->layout = 'empty';
        $clients = Client::find()->where(['!=', 'id', $id])->andWhere(['on_delete' => 0])->all();
        return $this->render('parent-list', compact('clients', 'parent_id'));
    }
}
