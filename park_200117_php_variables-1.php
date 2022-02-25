

1. 表現
PHPは表現志向言語です。ほとんど全てが表現です。いい例としては前と後、増加と減少があります。
他の言語ユーザーも「変数++」や「変数--」には馴染みがあるでしょう。
これらは増加や減少文です。PHPではCと同じく「前ー増加」と「後ー増加」二種類があります。
「前ー増加」と「後ー増加」は基本的に同じ機能です。
「前ー増加」は「++$var」と書いて、PHPは変数の値を読み込む前に変数を増加させます。（それで名前が「前ー増加」です。
「後ー増加」は「$var++」と書いて、PHPは変数の値を読み込んだ後に増加します。（それで名前が「後ー増加」です。）


一番よく使う表現は比較文です。これらはTRUEやFALSEで判断されます。このような表現は条件文などでよく使われている表現です。
PHPは下記のような表現を提供します。
> (より大きい)
>= (より大きい、または同じ)
== (同じ)
!= (同じではない)
< (より小さい)
<= (より小さい、または同じ)
=== (データ型と値が両方とも同じ)
!== (データ型または値のいずれかが同じではない)

変数を1ずつ増加するのは簡単に「$a++」や「++$a」になるのはもうご存知ですだと思います。
しかし1より大きい数、例えば3をを増加単位にしたい場合はどうしたらいいでしょうか？
「$a++」や「++$a」を3回書くのもできますが、それは明らかに非効率で不便なやり方だと思います。
もっと実用的なのは「$a = $a + 3」でしょう。「a」の値を読み込んで3を足して「a」に入れます。つまり、「a」は3増加します。
PHPではC言語のような他の言語と同じく、もっと明確で簡単な書き方を提供していまうす。
「aの現在の値を取ってそこに3を足してからaに入れる」のは「$a += 3」で書くことができます。
二つの演算子を結合して応用することもできます。例）「$a -= 5（aの値を取って５を引いてaに入れる）」、「$b *= 7（bの値を取って７を掛けてbに入れる）」等


2.PHPでは変数を必ず初期化する必要はありませんがいい練習になります。
初期化されてない変数はデータ型によって下記のような初期値を与えられます。
boolean => FALSE / integer, float => 0 / string, array => 空白

3．データ型
    Scalar types
        1.integer
        2. float
        3. boolean
        4. string
    Compound types
        5. array
        6. object
    Special types
        7. resource
        8. null


    1-1)integer
        1)少なくとも1桁の数
        2)素数ではない
        3)正の数でも負の数でもできる
        4)integerは2進数、8進数、10進数、16進数等で扱うことができる
            - $a = 1234; (10進数) / $a = 0123; (8進数) / $a = 0x12AB; (16進数) / $a = 0b1234; (2進数)
    1-2) float
    floatは小数点がある数
    1-3) boolean
        booleanはTRUEやFALSEのいずれかになる（0 = false, 1 = true）
    1-4) string
    アルファベット、数字、文字などが入っている変数。宣言する時はダブルクォーテーションで囲む。
    シングルクォーテーションでもできるのはできますが扱うのが少し違う
    1-5) array
        arrayは中に多数の変数が入っている一つの変数
    1-6) object
        objectはデータとそのデータの処理が入っているいdデータ型
    1-7) resource
        正式なだーた型ではないですがレファレンスｙリソースなどが入っている変数。データベースでよく使われている。
    1-8) null
        NULLはただ一つの値を持っている特別な変数。NULLデータ型は何も入っていない変数。
        変数が値を与えられていないで宣言されると自動でNULLとなります。大文字で書くのが慣行。



4.データタイプ変換（キャスト）
(string) $a	変数「a」をstringとして扱う。
(int) $a	変数「a」をintegerとして扱う。
(float) $a	変数「a」をfloatとして扱う。
(bool) $a	変数「a」をbooleanとして扱う。
(array) $a	変数「a」をarrayとして扱う。
(object) $a	変数「a」をobjectとして扱う。
(unset) $a	変数「a」をNULLとして扱う。


is_string() stringかどうかを確認する
is_int()　integerかどうかを確認する
is_float()　floatかどうかを確認する
is_bool ()　booleanかどうかを確認する
is_object()　objectかどうかを確認する
is_array()　arrayかどうかを確認する
is_resource() resourceかどうか確認する
is_null()　NULLかどうか確認する


5．変数の中身判断
値	            if($var)	isset	empty	is_null
$var=1	        true	    true	false	false
$var="";	    false	    true	true	false
$var="0";	    false	    true	true	false
$var=0;	        false	    true	true	false
$var=NULL;	    false	    false	true	true
$var	        false	    false	true	true
$var=array()	false	    true	true	false
$var=array(1)	true	    true	false	false


6．内蔵変数
Superglobals : script全体の中で全てのscopeが利用できる内蔵変数 ($GLOBALS, $_SERVER, $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION, $_REQUEST, $_ENV等)
$GLOBALS : global scopeの全ての変数を参照
$_SERVER : サーバー環境情報（'argv','argc','GATEWAY_INTERFACE','SERVER_ADDR','SERVER_SOFTWARE','SERVER_PROTOCOL','REQUEST_METHOD','HTTP_HOST','HTTPS'等)
$_GET : HTTPのGET変数
$_POST : HTTPのPOST変数
$_FILES : HTTPのFile Upload変数
$_REQUEST : HTTPのRequest変数
$_SESSION : Sessionの変数
$_ENV : Evironmentの変数
$_COOKIE : HTTPのCookies変数
$php_errormsg : エラーメッセージの変数
$HTTP_RAW_POST_DATA : アレイではなくPOSTデータをそのまま取得
$http_response_header : HTTPのresponse headersを取得(HTTP, DATE, SERVER,Content-Length等)
$argc : scriptに渡された要素の数
$argv : scriptに渡された要素のアレイ（ただ$argv[0]はいつもscriptのフィル名）








