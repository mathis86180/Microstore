<?php
namespace MicroStore\other;
class Tableau
{
    static function getTableau()
    {
        $tableau = array();
        for ($i = 0; $i < 10; $i++) {
            array_push($tableau, $i);
        }
        for ($j = 0; $j < 15; $j++) {
            array_push($tableau, '');
        }
        shuffle($tableau);

        $rtrn = '<table border="/1/">';
        for ($i = 0; $i < 5; $i++) {
            $rtrn .= '<tr >';
            for ($j = 0; $j < 5; $j++) {

                $rtrn .= '<td class="btn-sm" id="colorChange">' . $tableau[$j + $i * 5] . '</td>';
            }
            $rtrn .= '</tr>';
        }
        $rtrn .= '</table>';

        return $rtrn;
    }

}
?>