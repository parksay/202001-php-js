<?php 
    $handle = fopen($path, "r");
    $rowData = array();
    while (($data = self::fgetcsvReg($handle)) !== false) {
        $toEncoding   = mb_internal_encoding();
        mb_convert_variables($toEncoding, array("UTF-8", "SJIS-win"), $data);
        $rowData[$row] = $data;
        $row++;
    }
    fclose($handle);
?>

/mb_convert_variables ( string $to_encoding , mixed $from_encoding , mixed $vars [, mixed &$... ] ) : string
$varsのcharacter encodingを$from_encodingから$to_encodingに変換

/preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] ) : int
$subjectの中でregular expressionとしての$patternを検索します。検索結果があったら$matchesに入れます。入れる順は$flagsに従います。
最初の検索結果が見つかったらそのあと最後まで検索します。
*regular expressionというのは文字列のパタンを表現する文法です。これを利用すれば文字列のパタンを指定してそのパタン通りになっている部分を
他の文字列から検索することができます。その文法は例えば下記のようにあります。

    * - 前の文字が0個以上。
    + - 前の文字が1個以上。
    ^ - 後ろの文字で文字列が始まる。
    $ - 前の文字で文字列が終わる。
    {数字} - 前の文字が数字の回数で繰り返される。
    {数字1, 数字2} - 前の文字が数字1と数字2の間の回数で繰り返される。

これを利用して例えば電話番号を検索することとしたら下記のようになりまる。

    080で始まる電話番号検索
    <?php 
        $text = "
            016-7709-2348
            080-3624-5523
            080-123-4567
            080-hell-oworld
            080-2345-6789
        ";

        preg_match_all('080-\d{4}-\d{4}', $text, $matches);
        var_dump($matches);
    ?>
参考資料
https://blog.naver.com/songblue61/221800820174

/preg_quote ( string $str [, string $delimiter = NULL ] ) : string
This is useful if you have a run-time string that you need to match in some text and the string may contain special regex characters.
$strの中でregular expression syntaxの部分である文字を全部見つけてそれぞれの前に"\"を入れます

    <?php
        $keywords = '$40 for a g3/400';
        $keywords = preg_quote($keywords, '/');
        echo $keywords; // returns \$40 for a g3\/400
    ?>

/fopen ( string $filename , string $mode [, bool $use_include_path = FALSE [, resource $context ]] ) : resource
streamを通して$filenameをresourceに連結します。

/fgets ( resource $handle [, int $length ] ) : string
$handleファイルから一行を取得する。その一行は$length-1byteを読み込むか、改行まで読み込むか、ファイルの終わりまで読み込むかする。
もし$lengthの引数がなかったら行の終わりまで読み込む

    <?php
        $handle = &fopen("/test.txt", "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                echo $buffer;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
    ?>

/fclose ( resource $handle ) : bool
$handleで指定したresourceを消去

/feof ( resource $handle ) : bool
$handleがファイルの終わりまで届いたがどうか確認する