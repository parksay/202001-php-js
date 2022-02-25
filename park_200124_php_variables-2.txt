1. constant
    constantキーワードを使う時はscalar dataのみ入れることができます。PHP5.6からはarrayもできます。resourceもできますが予想しなかったエラーを防止のため使わないように勧告します。
    constantは簡単に変数名だけで取得するのができます。variableとは違い、変数名の前に「$」を付ける必要はありません。
    下記は普通のvariableとconstantとの違いです。
    1）constantは前に「$」を付けない
    2)PHP5.3の前にはconstantは「define()」関数を通して宣言する
    3)variableのscopeとは関係なく、constantはどこからでも接近できる
    4)constantは一度値を与えられたら再定義や取り消しはできない

    5)宣言されたないconstを使うをPHPはその変数名をstring(CONSTANT vs "CONSTANT")でそのまま使うと判断します。（これはPHP7.2から削除されます）
    「const」キーワードを使って宣言したら「define()」を使って宣言するのとは違い、最高scopeで使います。つまり、functionやloop、if、try/catch等では宣言できません

    5) constantの宣言
        <?php
            define("CONSTANT", "Hello world.");
            echo CONSTANT; // 結果： "Hello world."
            echo Constant; // 結果： "Constant" と警告
        ?>

    6) constを使って宣言

            <?php
                //　PHP 5.3.0
                const CONSTANT = 'Hello World';
                echo CONSTANT;

                // PHP 5.6.0
                const ANOTHER_CONST = CONSTANT.'; Goodbye World';
                echo ANOTHER_CONST;

                const ANIMALS = array('dog', 'cat', 'bird');
                echo ANIMALS[1]; // 結果："cat"

                //PHP 7
                define('ANIMALS', array(
                    'dog',
                    'cat',
                    'bird'
                ));
                echo ANIMALS[1]; // 結果："cat"
            ?>



2. variables variable
    1) 変数名を多様に使うのが便利なところもあります。つまり、変数名が状況によって変わることができます。
    変数の値を取得して、他の変数の名前として使うことができます。
    下記の例では「$」マークを二つ使えば「hello」が変数の名前となります。

    2)変数名の例
    <?php
        $a = 'hello';
    ?>

    <?php
        $$a = 'world';
    ?>

    この時点でPHP symbol treeには二つの変数が保存されます。
    「$a」の中身は「hello」、「$hello」の中身は「world」になります。

    下記の二つの表現は同じ結果をだします。
    <?php
        $a = 'hello';
        $$a = 'world';
        echo "$a ${$a}";　//結果：hello world
        echo "$a $hello";　//結果：hello world
    ?>

    3) これをarrayで使うためにはまず曖昧を解決する必要があります。
    例えば、$$a[1]と書いたらそれが「$$a」の一番目の要素を意味するか、それとも「$a[1]」の名前の変数を意味するか。
    最初の方は「${$a}[1]」と書き、次の方は${$a[1]}と書きます。

    4) array変数名の例

    <?php
        class foo {
            var $bar = 'I am bar.';
            var $arr = array('I am A.', 'I am B.', 'I am C.');
            var $r   = 'I am r.';
        }

        $foo = new foo();
        $bar = 'bar';
        $baz = array('foo', 'bar', 'baz', 'quux');
        echo $foo->$bar . "\n";　//結果：I am bar.
        echo $foo->{$baz[1]} . "\n";　//結果：I am bar.

        $start = 'b';
        $end   = 'ar';
        echo $foo->{$start . $end} . "\n";　//結果：I am bar.

        $arr = 'arr';
        echo $foo->{$arr[1]} . "\n";　//結果：I am r.

    ?>
