1. CSS
    tr.thead {
        background-COLOR:#AABBCC !important;
    }
    
    =>上はできない、下はできる。cssがもう一括的に適用されている状態では、指定範囲がもっと詳しければ詳しいほど適用優先順位が高い。trに適用/tdに適用
   
    #content table tbody tr td.t_head {
        background-COLOR:#AABBCC !important;
    }

2. template 
    2-1) php - table表示
        考えるべきの対象が大きすぎる場合は小さい単位に分けてから考えればもっと考えやすい。
        それは「諦める」のではなく、もっと根本まで入って理解し始めて
        底から理解の紐を捕らえて少しずつ昇ってくるのです。

        例えばserver側からlistを取ってきてその中身でtableを作りたいです。
        しかし上の行と同じ項目なら空欄で、上の行から内容が変わった時だけに
        項目を出力したいです。このような時、cellの内容を全部一変数に
        入れてから最後にそれをechoで出力しようとしたら結構難しくなります。
        複雑になります。
        それで、一行を各cellに分けてから、それぞれにあたる変数を与えてあげます。
        その各変数にdataの内容をそれぞれ入れておいて最後に出力します。
        このようにしたらもっと考えやすくなります。
        プログラミングに置いて、大きい対象をもっと小さい部品に分けて考えるのは
        凄く強力な考え方だと言うことを学びました。
        <?php $list = $this->listFromServer;?>
        <?php 
            $flgLayerFirst = 0;
            $flgLayerSecond = 0;
            $tagOpen = "<td>";
            $tagClose = "</td>";
            foreach ( $list as $row) {
                $contentLayerFirst = '';
                $contentLayerSecond = '';
                $contentLayerThird = '';
                if ($row["id_layer1"] != $flgLayerFirst) {
                    $flgLayerFirst = $row["id_layer1"];
                    $contentLayerFirst = $tagOpen.$row["content_layer1"].$tagClose;
                }
                if ( $row["id_layer2"] != $flgLayerSecond) {
                    $contentLayerSecond = $tagOpen.$row["content_layer2"].$tagClose;
                    $flgLayerSecond = $row["id_layer2"];
                }
                if ( $row["id_layer3"] ) {
                    $contentLayerThird = $tagOpen.$row["content_layer3"].$tagClose;
                }
                echo $contentLayerFirst.$contentLayerSecond.$contentLayerThird;
            }
        ?> 
   <script>
    2-2) JavaScript - serverからもらった値をhtmlの要素に入れる
        function fillingOutVals(json) {
        const result = ajaxJsonData(json);
        const data = result.detail;
        const eleArray = [  //このような書き方自体がよく活用できるものとして
            { idArray: ["#input_text_id1", "#input_text_id1_hidden"], columnKey: "input_text_id1" }, //同じ値を複数の要素にそれぞれ入れる場合
            { idArray: ["#input_text_id2", "#input_text_id2_hidden"], columnKey: "input_text_id2" },
            { idArray: ["#input_select_id"], columnKey: "input_select_id" }, //selectボックス
            { idArray: ["#display_test_num"], columnKey: "test_num" },    //数字
            { idArray: ["#test_checkbox"], columnKey: "test_checkbox" },  //checkboxボタン
        ];
        var checkbox_flg = false;
        eleArray.forEach(function (element) { //eleArrayの行を一行ずつを取得
            element.idArray.forEach(function (eleId) { //eleArrayの一行のidArrayの要素を一つずつ取得
                jQuery(eleId).val(data[element.columnKey]); // eleArrayのidArrayの値をselectorとして入れて、htmlの要素を取得、そしてその要素のvalueとしてeleArrayのcolumnKeyを入れる
                if (eleId == "#display_test_checkbox" && data[element.columnKey] == 1) {  //そのHTMLの要素がcheckboxならvalueを入れるのではなくcheckを付けてください。uniformのcssもそこに会わせて適用してください。
                    $("#display_test_checkbox").prop('checked', true);
                    $("#display_test_checkbox").uniform();
                    checkbox_flg = true;
                }
            });
        });
        if (checkbox_flg){
            document.getElementById("display_test_num").value = document.getElementById("display_test_num").value * 10; //check付いていたら*10倍
        } else {
            jQuery("#display_test_checkbox").attr("value", 0);
            jQuery("#display_test_checkbox").prop('checked', false);
            jQuery("#display_test_checkbox").uniform(); //checkboxのチェックを外して.uniform();するだけでその上層のspanとかdivとかの属性も全部checkboxの状態によって変わる
        }

3.JavaScript
    3-1) HTMLの要素を消したい時の処理
        jQuery(".target_remove").remove();

    
    3-2) 括弧の注意点
        a) (float)jQuery(".input_num").value = 100; //結果：エラー
                // (float) の命令が「jQuery(".input_num").value」ではなく「jQuery」に適用されます。
                // つまり、こういう風になってしまいます。
                // (( float )( jQuery ))(".input_num").value = 100; 

        b) (float)( jQuery(".input_num").value ) = 100; 
                // (float) の命令が「jQuery(".input_num").value」につくように強制的に指定。

    3-3) error防止
        for (let key in dataArray) {
            let dataVal = (dataArray[key] == null) ? "" : dataArray[key];　//問答無用で let dataVal = dataArray[key]; で宣言したらdataArray[key]というデータがない場合はエラーになるので一旦確認してから入れるようにします。
            const ele = container.querySelector("[name='" + key + "']");
            if (ele) { //一旦取ってきますが見つからないとundefinedになるのでエラーぬなるかもしれません。それでまたif文で確認します。
                if (key == "test_date") { //特別に他の部分とは違う処理を行いたい時
                    container.querySelector("[name='" + key + "']").innerHTML = dataVal;
                } else if (key != "test_checkbox") {
                    container.querySelector("[name='" + key + "']").value = dataVal;
                }
            }
        }