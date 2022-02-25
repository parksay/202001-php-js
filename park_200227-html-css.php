1-1) 変更前 - phtml 
    <table class="list" style="table-layout: fixed; width: 100%; word-wrap:break-word;" >
        <thead>
            <tr>
                <th style="width: 5%">タイトル1</th>
                <th style="width: 10%">タイトル2</th>
                <th style="width: 10%">タイトル3</th>
                <th style="width: 40%">タイトル4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 5%">内容1</td>
                <td style="width: 10%">内容2</td>
                <td style="width: 10%">内容3</td>
                <td style="width: 40%">内容4</td>
            </tr>
        </tbody>
    </table>
        a) table layout - 各列の幅を指定
        b) style="table-layout: fixed;" => cellの内容に関わらず各列の幅を指定した通りに固定
        c) style="width: 100%; => table全体の幅を指定する
        d) style="word-wrap:break-word;"　=>　一つの列の幅は固定されたまま、その中でcellの内容が幅を超えたら改行しながら内容を全部表示(cellの高さは高くなる)

1-2) 変更後 - phtml 
    <table class="list">
        <thead>
            <tr>
                <th class = "width_narr">タイトル1</th>
                <th class = "width_mid">タイトル2</th>
                <th class = "width_mid">タイトル3</th>
                <th class = "width_wide">タイトル4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class = "width_narr">内容1</td>
                <td class = "width_mid">内容2</td>
                <td class = "width_mid">内容3</td>
                <td class = "width_wide">内容4</td>
            </tr>
        </tbody>
    </table>

1-3) 変更後 - css
    table.list {
        table-layout: fixed; width: 100%; word-wrap:break-word;
    }
    table.list .width_narr {
        width: 5%;
    }
    table.list .width_mid {
        width: 10%;
    }
    table.list .width_wide {
        width: 40%;
    }
        a) CSSはphtmlからより別のCSSファイルから設定したほうがいい



2) print_r()の使い方

<?php 
    error_log($displayData);
        a) error_logに(string)$displayData を出力
    
    $displayData = print_r($dataName, true);
        b) 第２引数がTRUEだったら$displayData の出力値を取得してreturn値として返してくれる。それを変数の中に入れる
    print_r($displayData); 
        c) $displayData の中に入ってる文字列を出力
    error_log( print_r($dataName, true) );
        d) 上記と同様
?>

3) php in_array() 活用
<?php
    $dataClassify = in_array($dataName["radio_class"], array(1,2,3))  ? $dataName["radio_class"] : 1;
    a) $dataClassify の値が (1, 2, 3) のいずれかになって欲しい時。値の範囲を保証したい時
    switch ($dataClassify) {
    case 1 :
        $result = "process case 1";
        break;
    case 2 : 
        $result = "process case 2";
        break;
    case 3 :
        $result = "process case 3";
        break;
    }
?>

4) JavaScript checked radio button selector / チェックが付いている状態のradioボタンに接近するselector
alert( jQuery('.radio_class:checked').val() );
    a) classが"radio_class"であるelementの中で選択されている(:checked)radioのvalueを選択、それを出力
alert( jQuery('.radio_class :checked').val() );
    b) NULL 空白があるため認識できなくなる => 結果は NULL