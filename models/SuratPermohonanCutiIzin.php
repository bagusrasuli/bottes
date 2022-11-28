<?php

namespace app\models;

use yii\base\Model;
use Yii;

/**
 * This is the model class for table "surat_permohonan_cuti_izin".
 *
 * @property int $id_surat_permohonan
 * @property string $identitas_pegawai
 * @property string|null $jabatan
 * @property string|null $unit
 * @property string|null $tmt
 * @property string|null $periode
 * @property string|null $tanggal_mulai_cuti
 * @property string|null $tanggal_selesai_cuti
 * @property string|null $sisa_cuti
 * @property string|null $tanggal_masuk_kerja
 * @property string|null $alasan_pengajuan_cuti
 * @property string|null $jenis_cuti
 * @property string|null $created_at
 * @property string|null $created_by
 */
class SuratPermohonanCutiIzin extends Model
{
    public $tanggal_temp;
    public $keterangan_temp;
    public $virtual_cek_button;

    public $identitas_pegawai;
    public $jenis_cuti;
    public $tanggal_selesai_cuti;
    public $alasan_pengajuan_cuti;
    public $created_at;
    public $tanggal_kecuali;
    public $keterangan_kecuali;
    public $jumlah_cuti;
    public $ket_validasi;
    public $jabatan;
    public $unit;
    public $tmt;
    public $periode;
    public $sisa_cuti;
    public $string;
    public $csv;

    public $tanggal_masuk_kerja;
    public $is_input_hrd;
    public $lampiran_2;

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identitas_pegawai', 'jenis_cuti', 'tanggal_mulai_cuti', 'tanggal_selesai_cuti', 'alasan_pengajuan_cuti', 'tanggal_masuk_kerja'], 'required'],
            [['tanggal_mulai_cuti',  'created_at', 'identitas_pegawai', 'tanggal_kecuali', 'keterangan_kecuali', 'tanggal_temp', 'keterangan_temp', 'jumlah_cuti', 'ket_validasi', 'lampiran_1', 'virtual_cek_button', 'is_input_hrd'], 'safe'],
            [['jabatan', 'unit', 'tmt', 'periode', 'sisa_cuti', 'created_by'], 'string', 'max' => 100],
            [['lampiran_1', 'lampiran_2'], 'file', 'extensions' => 'png, jpg, jpeg, pdf, xls, xlsx, xls, csv', 'maxSize' => 5120 * 1000, 'skipOnEmpty' => true, 'wrongExtension' => 'Hanya eksitensi file berikut yang diperbolehkan: {extensions}.'],
            // [['lampiran_1', 'lampiran_2'], 'file', 'extensions' => '*', 'maxSize' => 5120 * 1000, 'skipOnEmpty' =>true, 'wrongExtension' => 'Hanya eksitensi file berikut yang diperbolehkan: {extensions}.'],
        ];
    }
}
