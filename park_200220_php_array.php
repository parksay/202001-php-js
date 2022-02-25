<?php 

$array = array(
            "foo"
            , "bar"
            , "hello"
            , "world"
        );


$array = array(
    "foo"   => "bar",
    42      => 24,
    "multi" => array(
                    "dimensional" => array(
                                            "array" => "foo",
                                            "dummy1" => "dummy1-1"
                                            ),
                    "dummy2" => array("dummy2-1" => "dummy2-1-1",
                                        "dummy2-2" => "dummy2-2-1",
                                        "dummy2-3" => "dummy2-3-1"
                                    ),
                    "dummy3" => array("dummy3-1" => "dummy3-1-1",
                                        "dummy3-2" => "dummy3-2-1",
                                        "dummy3-3" => "dummy3-3-1"
                                    ),
                    ),
    "dummy4"=> array("dummy4-1" => array(
                                        "dummy4-1-1" => "this is dummy",
                                        "dummy4-1-2" => "it's dummy",
                                        ),
                    "dummy4-2" => array(
                                        "dummy4-2-1" => "hello",
                                        "dummy4-2-2" => "world",
                                        ),
                    ),
); 
echo  $array["multi"]["dimensional"]["array"]; // foo
echo $array["dummy4"]["dummy4-2"]["dummy4-2-1"]; // hello



$arrTest[0] = "hello";
$arrTest[0][0] = "why";
echo $arrTest[0]; // 結果: wello

//解釈==>
$arrTest = array();
$arrTest[0] = "hello";     
// ==> $arrTest = array(0 => "hello");
$arrTest[0][0] = "why";    
// ==> ($arrTest[0])[0] = "hello"[0];
// ==> "hello"[0] = "h";
// ==> "hello"[0] = "h" = "why";
// ==> "hello"[0] = "h" = "w";
echo $arrTest[0]; // "wello"
echo $arrTest[0][0]; // "w"


$arrTest = array( 0 => "hello" ); 
// ==> $arrTest = array(); 
// ==> $arrTest[0] = "hello";
$arrTest[0] = array( 0 => "why" );  
// ==> $arrTest[0]を既存の"hello"の代わりにarray( 0 => "why" )に書き換える 
// ==> $arrTest[0] = array();
// ==> $arrTest[0][0] = "why";
echo $arrTest[0][0]; // "why"

///////////
$arrT = array("orange", "banana");
array_push($arrT, "apple");
array_push($arrT, "grape"); //arrayの中に要素を追加
array_push($aarT, "strawberry", "blueberry", "raspberry"); //複数の要素を追加することもできる
echo  $arrT[3]; //結果 : grape

$arrTe = array();
$arrTe["hey"] = "hello";
echo $arrTe["hey"]; //結果 : hello

$arrTes = array();
$arrTes["hey"] = array();
$arrTes["hey"]["hi"] = "what";
echo $arrTes["hey"]["hi"]; //結果 : what;

array_change_key_case(); //arrayのkeyを全部小文字や大文字に変換してくれる
array_chunk(); //arrayの要素を指摘した数ずつに分けてくれる
array_column(); //arrayの中で同じkeyを持っている値だけを集合させて新しいarrayを作る。そのarrayはarray("key1","key2", ...);もできるしarray("key1" => "value1","key2" => "value2",);の形にもできる。
array_combine(); //二つのarrayを結合して一つのarrayを作る。一方はkeyとした、他の一方はvalueとして指定して新しいarrayを作る
array_count_values(); //一つのarrayの中でvalueが重複されて入ってるとき、どんなvalueが何回入ってるかcount
array_key_exists(); //キーが存在するかどうかを調べる。
array_keys(); //arrayの全てのkeyを持って来て新しいarrayを生成。特定的なvalueのkeyだけを持ってくるのもできる。
array_values(); //arrayの全てのvalueを持って来て新しいarrayを生成。
array_map(); //arrayのvalueを一つずつ出してfunctionの引数として入れる。複数のarrayのvalueをsetで引数に入れることもできる。つまり、mapTest(arrFirst[0],arrSecond[0],arrThird[0]);,mapTest(arrFirst[1],arrSecond[1],arrThird[1]);mapTest(arrFirst[2],arrSecond[2],arrThird[2]);,のようにすることができる
array_merge(); //arrayの後ろに他のarrayを繋げる結合する。同じkeyに値がそれぞれ入ってる場合の処理は表現によって違う
array_multisort(); //複数のarrayの中の要素をsortする。各arrayの同じ順番の要素をsetで一緒にsortすることもできる
array_pad(); //arrayが指定した長さになるように前か後ろに任意の値で埋める
array_pop(); //arrayの最後のvalueを出した後その要素をarrayから消す
array_push(); //arrayの最後に他のarrayを加える。複数のarrayも可能
array_replace(); //arrayの上に他のarrayを上書する。同じkeyがそれぞれある場合はその要素を書き換える。
array_reverse(); //arrayの要素の順番を逆にする。keyも一緒にするかどうかはオプション
array_search(); //arrayの中で指定したvalueを検索して、そのkeyを返す
array_shift(); //arrayの要素を一つずつ左のほうに動かす。
array_unshift(); //arrayの要素を右のほうに動かす。最初には指定した要素を追加する
array_slice(); //arrayの一部分を取得して新しいarrayで返す
array_unique(); //arrayの中でvalueが重複した要素があったらその要素を削除
count(); //arrayの要素の数を数える
extract(); //arrayの中で指定したkeyのvalueを見つけて出す。配列か配列の中の配列か、関係なく。同じkeyの要素が階層だけが違ってそれぞれある場合はド地価はprefixで指定
in_array(); //arrayの中に指定したvalueがあるかどうか調べる


?>
