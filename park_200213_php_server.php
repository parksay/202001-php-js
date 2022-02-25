1-1) order.phtml
    <fieldset style = "float: right; padding-right:0;">
        <form id="order_form" method="POST" action="">
            <?php $this->button()->orderBtn(); ?>
        </form>
    </fieldset>


2-1) OrderButton.php
    <?php
    public function orderBtn()
        {
            $btnName = ($this->view->request[Model_Clothes::COLOR] == "1") ? "white" : "black";
            echo "<input type='button' id='order_by_color' class='order_button'  value='{$btnName}' />";
        }
    ?>

3-1) order.js
    orderButton = function () {
        let color = document.getElementById("selected_color").value;
        let clothes_id = document.getElementById("selected_id").value;
        var attr = "";
        switch (color) {
            case "11":
                attr = "clothes/order/color/white/";
                break;
            case "12":
            default:
                attr = "clothes/order/color/black/";
                break;
        }
        attr = attr + clothes_id;
        jQuery("form#order_form").attr("action", attr);
        jQuery("form#order_form").submit();
        return false;
    };


*上記のように書いた部分を下記のように修正しました。


2-2) OrderButton.php
  <?php
    public function orderBtn()
    {
        $btnName = "";
        $uri = "";
        $clothesColor = $this->view->request[Model_Clothes::COLOR];
        $clothesId = $this->view->request[Model_Clothes::ID_NUM];;
        switch ($clothesColor) {
            case Model_Clothes_Color::WHITE: //"11"ですがこんな簡単なことでも他の人が分かりずらくなる可能性があるのでmodelから値を取得してくる
                $btnName = "WHITE";
                $uri  = "clothes/order/color/white/";
                break;
            case Model_Clothes_Color::BLACK:
                $btnName = "BLACK";
                $uri  = "clothes/order/color/black/";
                break;
        }
        $uri .= $clothesId;
        return "<input type='button' id='order_by_color' class='order_button' data-uri='{$uri}' value='{$btnName}' />";
    }
    2-2-1)helperは他の人がどこで使ってるか分からないのであまり触らないほうがいい。
    2-2-2)helperからもviewに入ってるdataが使える
    2-2-3)keyやvalueを扱う時はなるべくmodelを使う
    2-2-4)htmlのattributeにdataを一緒に付けることができる。attributeの名前としてdata-yourKeyを付けてvalueにはdataを入れる
    2-2-5)helperからはechoではなくreturnで値を渡す
    2-2-6)URL処理などはfrontよりbackで処理するのが安全　

    ?>
3-2) order.js

        $("#order_by_color").on("click", function (e) {
        window.open(e.target.dataset.uri);
        
        3-2-1)上でdata-uriというattributeで付けておいたdataをelement.dataset.yourKeyのような形で使える



1-2) order.phtml

    <div class="new_header">
            <?php $this->button()->goBack("old-header_button"); ?>
            <fieldset class="later-added_button">
                <?= $this->button()->orderBtn(); ?>
            </fieldset>
    </div>
    1-2-1)new_header / later-added_buttonをよく見てください。

1-3) order.css

    .new_header {
        display: flex;
        margin-top: 40px;
    }

    .new_header > * {
        flex: 2;
        padding-left: 0;
        padding-right: 0;
    }

    #content .old_header  {
        margin-top: 0;
    }

    .later-added_button { 
        text-align: right;
    }
    1-3-1) display: flex; => その中の要素を横並びまたは縦並びにする。基本は横並びになっている
    1-3-2) 変更前は.old_headerが外側でそのmargin-top属性が40pxになっていて
        内側のnew_headerがmargin-top属性が0pxになっていた。
        変更後は.old_headerを無効化して、他の要素と横並びしてその二つを一緒に含めて.new_headerの中に入れたから
        .new_headerのmargin-top属性を新しく40pxにする。

4) Clothes.php

    Class  Model_Clothes
        {
            /* カラム名 */
            const ID_NUM   = "id_num";
            const COLOR   = "color";
            const SIZE   = "SIZE";
            const COST  = "COST";

            ---------
            -------
            ----
        }