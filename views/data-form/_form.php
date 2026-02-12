<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4 position-relative">

        <h4 class="fw-bold mb-4">Pengkajian Keperawatan</h4>

        <?php $form = ActiveForm::begin([
            'options'=>['class'=>'row gy-4'],
            'id' => 'data-form'
        ]); ?>

        <?= $form->field($model,'id_registrasi')->hiddenInput()->label(false) ?>

        <!-- 1. Cara Masuk Pasien -->
        <div class="col-12">
            <div class="section-title">1. Cara Masuk Pasien</div>
            <?= $form->field($model,'cara_masuk')->radioList([
                'Jalan'=>'Jalan tanpa bantuan',
                'Kursi'=>'Kursi roda tanpa bantuan',
                'Bed'=>'Tempat tidur dorong',
                'Lainnya'=>'Lainnya'
            ])->label(false) ?>
        </div>

        <!-- 2. Anamnesis -->
        <div class="col-12">
            <div class="section-title">2. Anamnesis</div>
        </div>

        <div class="col-md-4">
            <?= $form->field($model,'jenis_anamnesis')->radioList([
                'Auto'=>'Autoanamnesis',
                'Allo'=>'Aloanamnesis'
            ])->hint('Pilih jenis anamnesis pasien') ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model,'diperoleh_dari')->textInput(['placeholder'=>'Diperoleh dari siapa informasi anamnesis?']) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model,'hubungan')->textInput(['placeholder'=>'Hubungan dengan pasien']) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model,'alergi')->textInput(['placeholder'=>'Tuliskan riwayat alergi pasien, jika ada']) ?>
        </div>

        <!-- 3. Keluhan Utama -->
        <div class="col-12">
            <div class="section-title">3. Keluhan Utama</div>
            <?= $form->field($model,'keluhan')->textarea([
                'rows'=>3,
                'placeholder'=>'Tuliskan keluhan utama pasien'
            ])->label(false) ?>
        </div>

        <!-- 4. Pemeriksaan Fisik -->
        <div class="col-12">
            <div class="section-title">4. Pemeriksaan Fisik</div>
        </div>

        <div class="col-md-6">
            <div class="sub-title">a. Keadaan Umum</div>
            <?= $form->field($model,'keadaan_umum')->radioList([
                'Tidak tampak sakit'=>'Tidak tampak sakit',
                'Sakit ringan'=>'Sakit ringan',
                'Sedang'=>'Sedang',
                'Berat'=>'Berat'
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <div class="sub-title">b. Warna Kulit</div>
            <?= $form->field($model,'warna_kulit')->radioList([
                'Normal'=>'Normal',
                'Sianosis'=>'Sianosis',
                'Pucat'=>'Pucat',
                'Kemerahan'=>'Kemerahan'
            ])->label(false) ?>
        </div>

        <div class="col-md-3">
            <div class="sub-title">Kesadaran</div>
            <?= $form->field($model,'kesadaran')->radioList([
                'Compos Mentis'=>'Compos Mentis',
                'Apatis'=>'Apatis',
                'Somnolen'=>'Somnolen',
                'Sopor'=>'Sopor',
                'Soporokoma'=>'Soporokoma',
                'Koma'=>'Koma'
            ])->label(false) ?>
        </div>

        <div class="col-md-3">
            <div class="sub-title">Tanda Vital</div>
            <?= $form->field($model,'td')->textInput(['placeholder'=>'120/80 mmHg']) ?>
            <?= $form->field($model,'nadi')->textInput(['placeholder'=>'x/menit']) ?>
            <?= $form->field($model,'rr')->textInput(['placeholder'=>'x/menit']) ?>
            <?= $form->field($model,'suhu')->textInput(['placeholder'=>'°C']) ?>
        </div>

        <div class="col-md-3">
            <div class="sub-title">Fungsional</div>
            <?= $form->field($model,'alat_bantu')->textInput() ?>
            <?= $form->field($model,'prothesa')->textInput() ?>
            <?= $form->field($model,'cacat_tubuh')->textInput() ?>
            <?= $form->field($model,'adl')->radioList([
                'Mandiri'=>'Mandiri',
                'Dibantu'=>'Dibantu'
            ]) ?>
            <?= $form->field($model,'riwayat_jatuh')->radioList([
                'Ya'=>'Ya',
                'Tidak'=>'Tidak'
            ]) ?>
        </div>

        <div class="col-md-3">
            <div class="sub-title">Antropometri</div>
            <?= $form->field($model,'bb')->textInput(['type'=>'number','step'=>'0.01']) ?>
            <?= $form->field($model,'tb')->textInput(['type'=>'number','step'=>'0.01']) ?>
            <?= $form->field($model,'pb')->textInput() ?>
            <?= $form->field($model,'lk')->textInput() ?>
        </div>

        <div class="col-md-3">
            <div class="sub-title">c. Status Gizi</div>
            <?= $form->field($model,'status_gizi')->textInput([
                'readonly'=>true,
                'placeholder'=>'Otomatis dari IMT'
            ]) ?>
        </div>

        <!-- 5. Riwayat Penyakit Sekarang -->
        <div class="col-12">
            <div class="section-title">5. Riwayat Penyakit Sekarang</div>
            <?= $form->field($model,'riwayat_sekarang')->textarea(['rows'=>2]) ?>
        </div>

        <!-- 6. Riwayat Penyakit Sebelumnya -->
        <div class="col-12">
            <div class="section-title">6. Riwayat Penyakit Sebelumnya</div>
            <?= $form->field($model,'riwayat_dahulu')->radioList([
                'DM'=>'DM',
                'Hipertensi'=>'Hipertensi',
                'Jantung'=>'Jantung',
                'Lain-lain'=>'Lain-lain'
            ])->label(false) ?>
        </div>

        <!-- 7. Riwayat Penyakit -->
        <div class="col-12">
            <div class="section-title">7. Riwayat Penyakit</div>
            <?= $form->field($model,'riwayat_penyakit')->radioList([
                'Tidak'=>'Tidak',
                'Ya'=>'Ya'
            ]) ?>
        </div>

        <!-- 8. Riwayat Penyakit Keluarga -->
        <div class="col-12">
            <div class="section-title">8. Riwayat Penyakit Keluarga</div>
            <?= $form->field($model,'riwayat_keluarga')->textInput() ?>
        </div>

        <!-- 9. Riwayat Operasi -->
        <div class="col-12">
            <div class="section-title">9. Riwayat Operasi</div>
            <?= $form->field($model,'riwayat_operasi')->radioList([
                'Tidak'=>'Tidak',
                'Ya'=>'Ya'
            ], ['class'=>'riwayat_operasi_radio']) ?>

            <div id="operasi_detail" style="display:none;">
                <?= $form->field($model,'operasi_apa')->textInput() ?>
                <?= $form->field($model,'operasi_kapan')->textInput() ?>
            </div>
        </div>

        <!-- 10. Riwayat Rawat Inap -->
        <div class="col-12">
            <div class="section-title">10. Riwayat Rawat Inap</div>
            <?= $form->field($model,'riwayat_rawat_inap')->radioList([
                'Tidak'=>'Tidak',
                'Ya'=>'Ya'
            ], ['class'=>'rawat_inap_radio']) ?>

            <div id="rawat_detail" style="display:none;">
                <?= $form->field($model,'rs_penyakit')->textInput() ?>
                <?= $form->field($model,'rs_kapan')->textInput() ?>
            </div>
        </div>

        <!-- 11. Pengkajian Risiko Jatuh -->
        <div class="col-12">
            <div class="section-title">
                11. Pengkajian Risiko Jatuh Pasien (Morse Fall Scale)
            </div>
        </div>

        <!-- Score Summary -->
        <div class="col-md-3">
            <div class="morse-summary-box text-center">
                <div class="morse-total-display">0</div>
                <div class="morse-label">Total Skor</div>
                <div class="morse-kategori-display morse-low">
                    Risiko Rendah
                </div>
            </div>

            <?= $form->field($model,'rj_total')->hiddenInput(['class'=>'input-morse-total'])->label(false) ?>
            <?= $form->field($model,'rj_kategori')->hiddenInput(['class'=>'input-morse-kategori'])->label(false) ?>
        </div>

        <!-- Morse Detail -->
        <div class="col-md-9">
            <div class="row gy-3 morse-group">

                <!-- 1 -->
                <div class="col-md-6">
                    <?= $form->field($model,'rj_riwayat_jatuh')->radioList([
                        25=>'Ya, terdapat riwayat jatuh dalam 3 bulan terakhir (25)',
                        0=>'Tidak ada riwayat jatuh (0)'
                    ])->label('1. Riwayat jatuh (3 bulan terakhir)') ?>
                </div>

                <!-- 2 -->
                <div class="col-md-6">
                    <?= $form->field($model,'rj_diagnosa_sekunder')->radioList([
                        15=>'Ya, memiliki lebih dari 1 diagnosa medis (15)',
                        0=>'Tidak / hanya 1 diagnosa (0)'
                    ])->label('2. Diagnosa medis sekunder (>1 diagnosa)') ?>
                </div>

                <!-- 3 -->
                <div class="col-md-6">
                    <?= $form->field($model,'rj_alat_bantu')->radioList([
                        0=>'Mandiri / Kursi roda / Dibantu perawat (0)',
                        15=>'Menggunakan tongkat / walker (15)',
                        30=>'Berpegangan pada furniture / benda sekitar (30)'
                    ])->label('3. Alat bantu jalan yang digunakan') ?>
                </div>

                <!-- 4 -->
                <div class="col-md-6">
                    <?= $form->field($model,'rj_iv')->radioList([
                        20=>'Ya, terpasang infus / IV line / heparin lock (20)',
                        0=>'Tidak terpasang infus (0)'
                    ])->label('4. Terpasang infus / akses IV') ?>
                </div>

                <!-- 5 -->
                <div class="col-md-6">
                    <?= $form->field($model,'rj_cara_berjalan')->radioList([
                        0=>'Normal / tirah baring / imobilisasi (0)',
                        10=>'Lemah (10)',
                        20=>'Terganggu / perlu bantuan / tidak stabil (20)'
                    ])->label('5. Cara berjalan / berpindah') ?>
                </div>

                <!-- 6 -->
                <div class="col-md-6">
                    <?= $form->field($model,'rj_status_mental')->radioList([
                        0=>'Orientasi baik terhadap kemampuan diri (0)',
                        15=>'Lupa keterbatasan diri / overestimate kemampuan (15)'
                    ])->label('6. Status mental') ?>
                </div>

            </div>
        </div>

        <!-- TOMBOL -->
        <div class="col-12 d-flex justify-content-end gap-2 mt-4">
            <?= Html::a('Kembali', ['index'], ['class'=>'btn btn-outline-secondary']) ?>
            <?= Html::submitButton('Simpan', ['class'=>'btn btn-primary px-4']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs("

function toggleOperasi(){
    if($('.riwayat_operasi_radio input:checked').val()=='Ya'){
        $('#operasi_detail').slideDown();
    } else {
        $('#operasi_detail').slideUp();
    }
}

function toggleRawat(){
    if($('.rawat_inap_radio input:checked').val()=='Ya'){
        $('#rawat_detail').slideDown();
    } else {
        $('#rawat_detail').slideUp();
    }
}

/*  MORSE CALCULATION  */

function kategoriMorse(total){
    if(total <= 24) return {text:'Risiko Rendah', class:'morse-low'};
    if(total <= 44) return {text:'Risiko Sedang', class:'morse-medium'};
    return {text:'Risiko Tinggi', class:'morse-high'};
}

function hitungMorse(){
    var total = 0;

    $('.morse-group input:checked').each(function(){
        total += parseInt($(this).val()) || 0;
    });

    var hasil = kategoriMorse(total);

    $('.morse-total-display').text(total);
    $('.input-morse-total').val(total);

    $('.morse-kategori-display')
        .removeClass('morse-low morse-medium morse-high')
        .addClass(hasil.class)
        .text(hasil.text);

    $('.input-morse-kategori').val(hasil.text);
}

$(document).ready(function(){

    toggleOperasi();
    toggleRawat();
    hitungMorse();

    $('.riwayat_operasi_radio input').change(toggleOperasi);
    $('.rawat_inap_radio input').change(toggleRawat);
    $('.morse-group input').change(hitungMorse);

});
");
?>

<style>
    /*  MORSE CLEAN STYLE  */

    .morse-summary-box {
        background: #f8f9fa;
        border-radius: 14px;
        padding: 20px;
        border: 1px solid #e9ecef;
    }

    .morse-total-display {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #0d6efd;
    }

    .morse-label {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .morse-kategori-display {
        font-size: 16px;
        font-weight: 600;
    }

    .morse-low {
        color: #198754;
    }

    .morse-medium {
        color: #fd7e14;
    }

    .morse-high {
        color: #dc3545;
    }
</style>