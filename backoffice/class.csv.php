<?php
class CSV{
    static function export($datas,$filename){
        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
        $i = 0;
        foreach($datas as $v){
            $v['INSCRIPTION'] = date('d/m/Y',strtotime($v['INSCRIPTION']));
            if($i==0){
                echo '"'.implode('";"',array_keys($v)).'"'."\n";
            }
            echo '"'.mb_convert_encoding(implode('";"',$v).'"', 'UTF-16LE', 'UTF-8')."\n";
            $i++;
        }
    }

}