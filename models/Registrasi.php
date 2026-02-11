<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Registrasi extends ActiveRecord
{
    public static function tableName()
    {
        return 'registrasi';
    }

    public function rules()
    {
        return [
            // WAJIB
            [['nama_pasien','tanggal_lahir'], 'required'],

            // INTEGER
            [['no_registrasi','no_rekam_medis','nik'], 'integer'],

            [['tanggal_lahir'], 'safe'],

            [['no_registrasi'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'no_registrasi' => 'No Registrasi',
            'no_rekam_medis' => 'No Rekam Medis',
            'nama_pasien' => 'Nama Pasien',
            'tanggal_lahir' => 'Tanggal Lahir',
            'nik' => 'NIK',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_time_at',
                'updatedAtAttribute' => 'update_time_at',
                'value' => new Expression('NOW()')
            ]
        ];
    }

    // 🔥 AUTO GENERATE NOMOR
    public function beforeValidate()
    {
        if ($this->isNewRecord && empty($this->no_registrasi)) {

            // format INT: YmdHis
            $this->no_registrasi = (int) date('YmdHis');

            // anti bentrok
            while (self::find()->where(['no_registrasi'=>$this->no_registrasi])->exists()) {
                $this->no_registrasi++;
            }
        }

        return parent::beforeValidate();
    }

    public function getDataForm()
    {
        return $this->hasOne(DataForm::class, ['id_registrasi' => 'id_registrasi']);
    }
}