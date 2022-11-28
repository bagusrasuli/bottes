<?php

namespace app\models;

use yii\base\Model;

class VirtualModel extends Model
{
    public $string1;
    public $string2;
    public $string3;
    public $string4;
    public $string5;
    public $string6;
    public $string7;
    public $string8;
    public $string9;
    public $string10;
    public $string11;
    public $string12;
    public $string13;
    public $string14;
    public $string15;
    public $string16;
    public $string17;
    public $string18;
    public $string19;
    public $string20;

    public $tanggal1;
    public $tanggal2;
    public $tanggal3;
    public $tanggal4;


    public function rules()
    {
        return [
            [[
                'string1', 'string2','string3', 'string4', 'string5', 
                'string6', 'string7', 'string8', 'string9', 'string10', 
                'string11', 'string12','string13', 'string14', 'string15',
                'string16', 'string17', 'string18', 'string19', 'string20', 
            ], 'safe'],
            [['tanggal1', 'tanggal2', 'tanggal3', 'tanggal4'],'date']
        ];
    }
}
