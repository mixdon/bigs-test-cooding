<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\DataForm;
use app\models\Registrasi;
use Mpdf\Mpdf;

class DataFormController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DataForm::find()
                ->where(['is_delete' => false])
                ->with('registrasi')
                ->orderBy(['id_form_data' => SORT_DESC]),
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate($id_registrasi)
    {
        $registrasi = Registrasi::findOne($id_registrasi);
        if (!$registrasi) {
            throw new NotFoundHttpException('Registrasi tidak ditemukan');
        }

        $existing = DataForm::find()
            ->where(['id_registrasi' => $id_registrasi, 'is_delete' => false])
            ->one();

        if ($existing) {
            return $this->redirect(['update', 'id' => $existing->id_form_data]);
        }

        $model = new DataForm();
        $model->id_registrasi = $id_registrasi;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_form_data]);
        }

        return $this->render('create', [
            'model' => $model,
            'registrasi' => $registrasi
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $registrasi = $model->registrasi;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_form_data]);
        }

        return $this->render('update', [
            'model' => $model,
            'registrasi' => $registrasi
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_delete = true;
        $model->save(false);

        return $this->redirect(['index']);
    }

    public function actionEditRegistrasi($id_registrasi)
    {
        $model = Registrasi::findOne($id_registrasi);
        if (!$model) {
            throw new NotFoundHttpException('Registrasi tidak ditemukan');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/registrasi/view', 'id_registrasi' => $model->id_registrasi]);
        }

        return $this->render('/registrasi/update', ['model' => $model]);
    }

    protected function findModel($id)
    {
        $model = DataForm::find()
            ->where(['id_form_data' => $id, 'is_delete' => false])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data tidak ditemukan');
    }

    // Fungsi tunggal untuk generate PDF
    protected function generatePdfFile($model)
    {
        $data = $model->data ? json_decode($model->data, true) : [];
        $registrasi = $model->registrasi;

        $content = $this->renderPartial('print', [
            'model' => $model,
            'data' => $data,
            'registrasi' => $registrasi
        ]);

        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15
        ]);

        $pdf->WriteHTML($content);

        $filename = 'hasil-pemeriksaan-' . $model->id_form_data . '.pdf';
        $filePath = Yii::getAlias('@webroot/uploads/pdf/' . $filename);

        // simpan PDF di server
        $pdf->Output($filePath, \Mpdf\Output\Destination::FILE);

        return $filePath;
    }

    // Action generate PDF dan redirect ke download
    public function actionDownloadPdf($id)
    {
        $model = $this->findModel($id);
        $filePath = $this->generatePdfFile($model);

        return \Yii::$app->response->sendFile($filePath, basename($filePath));
    }
}