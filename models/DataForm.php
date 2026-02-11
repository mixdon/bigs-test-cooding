<?php

namespace app\models;

use yii\db\ActiveRecord;

class DataForm extends ActiveRecord
{
    public $tinggi_badan;
    public $berat_badan;
    public $keluhan;
    public $riwayat_penyakit;
    public $keterangan_riwayat;

    public static function tableName()
    {
        return 'data_form';
    }

    public function rules()
    {
        return [
            [['id_registrasi','tinggi_badan','berat_badan'],'required'],
            [['id_registrasi'],'integer'],
            [['data'],'safe'],
            [['is_delete'],'boolean'],

            [['tinggi_badan'],'number','min'=>50,'max'=>250],
            [['berat_badan'],'number','min'=>1,'max'=>300],

            [['keluhan','keterangan_riwayat'],'string'],
            [['riwayat_penyakit'],'boolean'],

            ['id_registrasi','unique','targetAttribute'=>'id_registrasi']
        ];
    }

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)) return false;

        $this->data = json_encode([
            'tinggi_badan'=>$this->tinggi_badan,
            'berat_badan'=>$this->berat_badan,
            'keluhan'=>$this->keluhan,
            'imt'=>$this->hitungIMT(),
            'kategori_imt'=>$this->getKategoriIMT(),
            'riwayat_penyakit'=>$this->riwayat_penyakit,
            'keterangan_riwayat'=>$this->keterangan_riwayat
        ]);

        if($insert){
            $this->is_delete = false;
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if($this->data){
            $json = json_decode($this->data,true);

            $this->tinggi_badan = $json['tinggi_badan'] ?? null;
            $this->berat_badan  = $json['berat_badan'] ?? null;
            $this->keluhan      = $json['keluhan'] ?? null;
            $this->riwayat_penyakit = $json['riwayat_penyakit'] ?? false;
            $this->keterangan_riwayat = $json['keterangan_riwayat'] ?? null;
        }
    }

    public function hitungIMT()
    {
        if(!$this->tinggi_badan || !$this->berat_badan) return null;

        $t = $this->tinggi_badan/100;
        return round($this->berat_badan/($t*$t),2);
    }

    public function getKategoriIMT()
    {
        $imt = $this->hitungIMT();
        if(!$imt) return null;

        if($imt<18.5) return 'Kurus';
        if($imt<=25) return 'Normal';
        if($imt<=27) return 'Gemuk';
        return 'Obesitas';
    }

    public function getRegistrasi()
    {
        return $this->hasOne(Registrasi::class,['id_registrasi'=>'id_registrasi']);
    }
}