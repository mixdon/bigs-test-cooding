<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Registrasi;
use app\models\DataForm;
use DateTime;
use yii\helpers\Json;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        $totalRegistrasi = (int) Registrasi::find()->count();
        $totalForm       = (int) DataForm::find()->count();

        $belumInput = (int) Registrasi::find()
            ->alias('r')
            ->leftJoin('data_form df', 'df.id_registrasi = r.id_registrasi')
            ->where(['df.id_registrasi' => null])
            ->count();

        $latestRegistrasi = Registrasi::find()
            ->orderBy(['create_time_at' => SORT_DESC])
            ->limit(5)
            ->all();

        $registrasi = Registrasi::find()
            ->with('dataForm')
            ->all();

        $imts = [];
        $usia = [];
        $keluhanCounts = [];
        $today = new DateTime();

        foreach ($registrasi as $r) {
            $df = $r->dataForm;

            // IMT dari jsonb
            if ($df && $df->data) {
                $json = is_array($df->data) ? $df->data : json_decode($df->data, true);

                if (isset($json['imt']) && is_numeric($json['imt'])) {
                    $imts[] = (float) $json['imt'];
                }

                if (!empty($json['keluhan'])) {
                    $key = (string) $json['keluhan'];
                    $keluhanCounts[$key] = ($keluhanCounts[$key] ?? 0) + 1;
                }
            }

            // Usia
            if ($r->tanggal_lahir) {
                $dob = new DateTime($r->tanggal_lahir);
                $usia[] = $today->diff($dob)->y;
            }
        }

        return $this->render('index', [
            'totalRegistrasi'   => $totalRegistrasi,
            'totalForm'         => $totalForm,
            'belumInput'        => $belumInput,
            'latestRegistrasi'  => $latestRegistrasi,
            'imtsJson'          => Json::encode($imts),
            'usiaJson'          => Json::encode($usia),
            'keluhanKeysJson'   => Json::encode(array_keys($keluhanCounts)),
            'keluhanValuesJson' => Json::encode(array_values($keluhanCounts)),
        ]);
    }
}