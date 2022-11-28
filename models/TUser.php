<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user".
 *
 * @property int $id
 * @property string $chat_id
 * @property string $nama
 * @property string|null $jabatan
 * @property string|null $github_id
 * @property string|null $username
 * @property string|null $no_wa
 * @property string $nik
 * @property string $nik_temp
 * @property string|null $branch
 * @property string|null $waktu
 * @property string $mode
 * @property string $mode_date
 * @property int $valid
 * @property string $valid_ket
 * @property int $employee_id
 */
class TUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'nama', 'nik', 'nik_temp', 'mode', 'mode_date', 'valid_ket', 'employee_id'], 'required'],
            [['waktu', 'mode_date'], 'safe'],
            [['valid', 'employee_id'], 'integer'],
            [['valid_ket'], 'string'],
            [['chat_id', 'nik', 'nik_temp'], 'string', 'max' => 30],
            [['nama'], 'string', 'max' => 60],
            [['jabatan'], 'string', 'max' => 40],
            [['github_id', 'no_wa', 'branch'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 32],
            [['mode'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'github_id' => 'Github ID',
            'username' => 'Username',
            'no_wa' => 'No Wa',
            'nik' => 'Nik',
            'nik_temp' => 'Nik Temp',
            'branch' => 'Branch',
            'waktu' => 'Waktu',
            'mode' => 'Mode',
            'mode_date' => 'Mode Date',
            'valid' => 'Valid',
            'valid_ket' => 'Valid Ket',
            'employee_id' => 'Employee ID',
        ];
    }
}
