<?php

namespace app\models;

use yii\db\ActiveRecord;

class DataForm extends ActiveRecord
{
    // 1. Properti publik sesuai form
    public $cara_masuk;
    public $jenis_anamnesis;
    public $diperoleh_dari;
    public $hubungan;
    public $alergi;
    public $keluhan;
    public $keadaan_umum;
    public $warna_kulit;
    public $kesadaran;
    public $td;
    public $nadi;
    public $rr;
    public $suhu;
    public $alat_bantu;
    public $prothesa;
    public $cacat_tubuh;
    public $adl;
    public $riwayat_jatuh;
    public $bb;
    public $tb;
    public $pb;
    public $lk;
    public $imt;
    public $status_gizi;
    public $riwayat_sekarang;
    public $riwayat_dahulu;
    public $riwayat_penyakit; 
    public $riwayat_keluarga;
    public $riwayat_operasi;
    public $operasi_apa;
    public $operasi_kapan;
    public $riwayat_rawat_inap;
    public $rs_penyakit;
    public $rs_kapan;
    public $nama_petugas;
    public $rj_riwayat_jatuh;      
    public $rj_diagnosa_sekunder;  
    public $rj_alat_bantu;         
    public $rj_iv;                 
    public $rj_cara_berjalan;      
    public $rj_status_mental;      
    public $rj_total;
    public $rj_kategori;

    // 2. Nama tabel
    public static function tableName()
    {
        return 'data_form';
    }

    // 3. Rules validasi
    public function rules()
    {
        return [
            [['id_registrasi'], 'required'],
            [['id_registrasi'], 'integer'],
            [['data'], 'safe'],
            [['is_delete'], 'boolean'],
            [['bb', 'tb', 'pb', 'lk', 'imt', 'nadi', 'rr', 'suhu'], 'number'],
            [['cara_masuk','jenis_anamnesis','diperoleh_dari','hubungan','alergi'],'string'],
            [['keluhan'], 'string'],
            [['keadaan_umum','warna_kulit','kesadaran'],'safe'],
            [['td','alat_bantu','prothesa','cacat_tubuh','adl','riwayat_jatuh'],'string'],
            [['riwayat_sekarang','riwayat_dahulu','riwayat_penyakit','riwayat_keluarga'],'safe'],
            [['riwayat_operasi','operasi_apa','operasi_kapan'],'safe'],
            [['riwayat_rawat_inap','rs_penyakit','rs_kapan'],'safe'],
            [['nama_petugas'],'string'],
            ['id_registrasi','unique'],
            [['rj_riwayat_jatuh','rj_diagnosa_sekunder','rj_iv'], 'string'],
            [['rj_riwayat_jatuh','rj_diagnosa_sekunder','rj_alat_bantu','rj_iv','rj_cara_berjalan','rj_status_mental','rj_total'], 'integer'],
            [['rj_kategori'],'string'],
            
        ];
    }

    // 4. Labels
    public function attributeLabels()
    {
        return [
            'id_registrasi'       => 'ID Registrasi',
            'cara_masuk'          => 'Cara Masuk Pasien',
            'jenis_anamnesis'     => 'Jenis Anamnesis',
            'diperoleh_dari'      => 'Diperoleh Dari',
            'hubungan'            => 'Hubungan dengan Pasien',
            'alergi'              => 'Riwayat Alergi',
            'keluhan'             => 'Keluhan Utama',
            'keadaan_umum'        => 'Keadaan Umum',
            'warna_kulit'         => 'Warna Kulit',
            'kesadaran'           => 'Kesadaran',
            'td'                  => 'Tekanan Darah (mmHg)',
            'nadi'                => 'Nadi (x/menit)',
            'rr'                  => 'Frekuensi Pernapasan (x/menit)',
            'suhu'                => 'Suhu Tubuh (°C)',
            'alat_bantu'          => 'Alat Bantu',
            'prothesa'            => 'Prothesa',
            'cacat_tubuh'         => 'Cacat Tubuh',
            'adl'                 => 'Aktivitas Kehidupan Sehari-hari (ADL)',
            'riwayat_jatuh'       => 'Riwayat Jatuh',
            'bb'                  => 'Berat Badan (kg)',
            'tb'                  => 'Tinggi Badan (cm)',
            'pb'                  => 'Lingkar Perut (cm)',
            'lk'                  => 'Lingkar Kepala (cm)',
            'imt'                 => 'Indeks Massa Tubuh (IMT)',
            'status_gizi'         => 'Status Gizi (dihitung dari IMT)',
            'riwayat_sekarang'    => 'Riwayat Penyakit Sekarang',
            'riwayat_dahulu'      => 'Riwayat Penyakit Dahulu',
            'riwayat_penyakit'    => 'Riwayat Penyakit (Ya/Tidak)',
            'riwayat_keluarga'    => 'Riwayat Penyakit Keluarga',
            'riwayat_operasi'     => 'Riwayat Operasi',
            'operasi_apa'         => 'Jenis Operasi',
            'operasi_kapan'       => 'Kapan Operasi Dilakukan',
            'riwayat_rawat_inap'  => 'Riwayat Rawat Inap',
            'rs_penyakit'         => 'Rumah Sakit / Penyakit',
            'rs_kapan'            => 'Kapan Dirawat',
            'nama_petugas'        => 'Nama Petugas',
        ];
    }

    // 5. Before save, hitung IMT & status gizi, simpan ke JSON
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Set waktu create & update
        if ($insert) {
            $this->create_time_at = date('Y-m-d H:i:s');
            $this->is_delete = false;
        } else {
            $this->update_time_at = date('Y-m-d H:i:s');
        }

        // Hitung IMT & status gizi
        $this->imt = $this->hitungIMT();
        $this->status_gizi = $this->getKategoriIMT();
        $this->rj_total = $this->hitungRisikoJatuh();
        $this->rj_kategori = $this->getKategoriRisikoJatuh();

        // Simpan ke JSON
        $this->data = json_encode([
            'cara_masuk'=>$this->cara_masuk,
            'jenis_anamnesis'=>$this->jenis_anamnesis,
            'diperoleh_dari'=>$this->diperoleh_dari,
            'hubungan'=>$this->hubungan,
            'alergi'=>$this->alergi,
            'keluhan'=>$this->keluhan,
            'keadaan_umum'=>$this->keadaan_umum,
            'warna_kulit'=>$this->warna_kulit,
            'kesadaran'=>$this->kesadaran,
            'td'=>$this->td,
            'nadi'=>$this->nadi,
            'rr'=>$this->rr,
            'suhu'=>$this->suhu,
            'alat_bantu'=>$this->alat_bantu,
            'prothesa'=>$this->prothesa,
            'cacat_tubuh'=>$this->cacat_tubuh,
            'adl'=>$this->adl,
            'riwayat_jatuh'=>$this->riwayat_jatuh,
            'bb'=>$this->bb,
            'tb'=>$this->tb,
            'pb'=>$this->pb,
            'lk'=>$this->lk,
            'imt'=>$this->imt,
            'status_gizi'=>$this->status_gizi,
            'riwayat_sekarang'=>$this->riwayat_sekarang,
            'riwayat_dahulu'=>$this->riwayat_dahulu,
            'riwayat_penyakit'=>$this->riwayat_penyakit,
            'riwayat_keluarga'=>$this->riwayat_keluarga,
            'riwayat_operasi'=>$this->riwayat_operasi,
            'operasi_apa'=>$this->operasi_apa,
            'operasi_kapan'=>$this->operasi_kapan,
            'riwayat_rawat_inap'=>$this->riwayat_rawat_inap,
            'rs_penyakit'=>$this->rs_penyakit,
            'rs_kapan'=>$this->rs_kapan,
            'rj_riwayat_jatuh'=>$this->rj_riwayat_jatuh,
            'rj_diagnosa_sekunder'=>$this->rj_diagnosa_sekunder,
            'rj_alat_bantu'=>$this->rj_alat_bantu,
            'rj_iv'=>$this->rj_iv,
            'rj_cara_berjalan'=>$this->rj_cara_berjalan,
            'rj_status_mental'=>$this->rj_status_mental,
            'rj_total'=>$this->rj_total,
            'rj_kategori'=>$this->rj_kategori,
        ]);

        return true;
    }

    // 6. Setelah load, decode JSON ke properti
    public function afterFind()
    {
        parent::afterFind();

        if ($this->data) {
            $d = json_decode($this->data, true);
            foreach ($d as $k => $v) {
                if (property_exists($this, $k)) {
                    $this->$k = $v;
                }
            }
        }
    }

    // 7. Hitung IMT → **public**
    public function hitungIMT()
    {
        if (!$this->bb || !$this->tb) return null;
        $tb = $this->tb / 100;
        return round($this->bb / ($tb * $tb), 2);
    }

    // 8. Kategori Gizi → **public getKategoriIMT()**
    public function getKategoriIMT()
    {
        $imt = $this->hitungIMT();
        if ($imt === null) return null;

        if ($imt < 18.5) return 'Kurus';
        if ($imt < 25) return 'Normal';
        if ($imt < 30) return 'Gemuk';
        return 'Obesitas';
    }

    // 9. Relasi ke tabel Registrasi
    public function getRegistrasi()
    {
        return $this->hasOne(Registrasi::class, ['id_registrasi'=>'id_registrasi']);
    }

    // 10. Hitung resiko jatuh
    public function hitungRisikoJatuh()
    {
        return
            (int)$this->rj_riwayat_jatuh +
            (int)$this->rj_diagnosa_sekunder +
            (int)$this->rj_alat_bantu +
            (int)$this->rj_iv +
            (int)$this->rj_cara_berjalan +
            (int)$this->rj_status_mental;
    }

    public function getKategoriRisikoJatuh()
    {
        $total = (int)$this->rj_total;

        if ($total <= 24) {
            return 'Risiko Rendah';
        } elseif ($total <= 44) {
            return 'Risiko Sedang';
        } else {
            return 'Risiko Tinggi';
        }
    }
}