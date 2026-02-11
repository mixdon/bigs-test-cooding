<?php

namespace app\controllers;

use Yii;
use app\models\Registrasi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RegistrasiController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Registrasi::find()->orderBy(['id_registrasi' => SORT_DESC]),
            'pagination' => ['pageSize' => 10]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id_registrasi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_registrasi)
        ]);
    }

    public function actionCreate()
    {
        $model = new Registrasi();

        if ($model->isNewRecord && empty($model->no_registrasi)) {
            $no = (int) date('YmdHis');

            while (Registrasi::find()->where(['no_registrasi' => $no])->exists()) {
                $no++;
            }

            $model->no_registrasi = $no;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'view',
                'id_registrasi' => $model->id_registrasi
            ]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id_registrasi)
    {
        $model = $this->findModel($id_registrasi);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'view',
                'id_registrasi' => $model->id_registrasi
            ]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id_registrasi)
    {
        $this->findModel($id_registrasi)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Registrasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }
}