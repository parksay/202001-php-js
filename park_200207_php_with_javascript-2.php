1. refactoring
    1)先週書いた活性/非活性のメソッドを下記のように修正して見ました。
    //.inner_flgをcheckする時に、　
    //.outer_flgのcheckが付いている上に、.require_input_flgがcheck付いていたら
    //.inner_flgの値としてこれを入れておいてください
    row.find(".inner_flg").on("change", function (e) {
        row.find(".inner_input").get(0).disabled = !e.target.checked;
        if (document.getElementById("require_input_flg").checked) {
            if (row.find('.outer_flg').get(0).checked == true) {
                if (row.find(".inner_flg").get(0).checked == true) {
                    var inputNum = row.find(".outer_input").attr("value") ? row.find(".outer_input").attr("value") : 0;
                    var requireNum = jQuery(document).find("#require_input_count").attr("value") ? jQuery(document).find("#require_input_count").attr("value") : 0;
                    var resultNum = parseFloat(inputNum) * parseFloat(requireNum);
                    row.find(".inner_input").get(0).value = Math.round(resultNum);
                }
            }
        }
    });
    // 共通イベント
    row.find(".outer_flg").on("change", function (e){ 
        //.input_unit_priceが使えるか使えないかは.outer_flgと一緒になるように決めてください
        row.find(".outer_input").get(0).disabled = !row.find('.outer_flg').get(0).checked;
        //.outer_flgをcheckする場合は.inner_flgも一緒に使えるようにしてください
        if (row.find(".outer_flg").attr("checked") && row.find('.outer_flg').get(0).checked == TRUE) {
            row.find(".inner_flg").removeAttr("disabled");
        } 
        //.unit_lagのcheckを外す時、.inner_flgがcheck付いている状態だったら、そのcheckも一緒に外してください。
        if (row.find(".outer_flg").attr("checked") == NULL && row.find('.outer_flg').get(0).checked == FALSE) {
            if (row.find(".inner_flg").attr("checked") == "checked") {
                row.find(".inner_flg").attr("checked", false);
                row.find("td.inner").not(".outer_flg").find("span").removeClass("checked");
            }
            //そして次に .inner_flgを使えないようにしてください
            row.find(".inner_flg").disabled = true;
            row.find(".inner_flg").attr("disabled", "disabled");
            row.find(".inner_input").get(0).disabled = true;
        }
    });
    2) 先週アップロードしたchatterの内容にはありませんでしたが他の部分のeventメソッド部分も追加しました。
    // rowに.test_checkboxがある場合はそこにこのようなイベントを掛けてください。
        row.find(".test_checkbox").on("change", function (e) {
            row.find(".test_text").get(0).disabled = !e.target.checked;
            
            if (row.find(".test_checkbox").attr("checked")) {
                row.find(".test_span").removeClass("disabled");
                row.find("test_select").removeAttr("disabled");
                
            } else {
                row.find(".test_span").addClass("disabled");
                row.find("test_select").attr("disabled", "disabled");
            }
        });
        上記のメソッドを下記のように修正して見ました。
    //dedicated data　専用　イベント
    // rowに.test_checkboxがある場合はそこにこのようなイベントを掛けてください。
        if (row.find(".test_checkbox").get(0) != null) {
            row.find(".test_checkbox").on("change", function (e) {
                if (row.find(".test_text").get(0) != null) {
                    row.find(".test_text").get(0).disabled = !row.find(".test_checkbox").get(0).checked;
                    row.find("test_select").get(0).disabled = !row.find(".test_checkbox").get(0).checked;
                    row.find(".test_span").toggleClass("disabled", !row.find(".test_checkbox").get(0).checked);
                }
            });
        }


2. jQuery(selector1).find(selector2) のreturn値
    2-1) jQuery(this).find(".test_checkbox"); ==> 
        返してくれる値が「null」、「false」、「length(0)」になることはありません。
        例えばfind()の引数になにか存在していないことを書いてみればわかります。
        console.log( JSON.stringify(jQuery(this).find(".dfhidsjdfjoisjoidf2348739")) ); 
        のように出力して見れば下記のようなデータを返してくれます

        jQuery(this).find(".dfhidsjdfjoisjoidf2348739");
        ==> {"length":0,"prevObject":{"0":{},"length":1},"selector":".dfhidsjdfjoisjoidf2348739"}


        それでif文を使ってHTML要素が存在しているかどうか確認したい場合は下記のように書いたらいけます。
        if ( jQuery(this).find(".test_checkbox").get(0) != null && jQuery(this).find(".test_text").get(0) != null ) {
            someting
        }

    2-2) .find()の結果はなにかjQueryからの返してくれるJavaScript Object。その内容は調べてみるべきですが、.find().get(0)はevetnObject.target(0)と似ているものです。

3. checkboxのチェック状態を確認する方法と各方法によるreturn値
jQuery(this).find('.outer_flg').get(0).checked;  
==> TRUE / FALSE　のブリアン型の値を返してくれます
alert(document.getElementById("require_input_flg").checked);   // returns true / false
alert(document.getElementById("require_input_flg").getAttribute("checked")); // returns "checked" / undefined?(not sure please google)



4. PHP表現
条件文にif()の中身と同じく、なにか表現とか変数のみを入れたら、それがundefinedの場合はfalse,値がある場合はtrueになる
var inputNum = jQuery(this).find(".outer_input").attr("value") ? jQuery(this).find(".outer_input").attr("value") : 0;
var inputNum = document.getElementById("require_input_flg").checked ? jQuery(this).find(".outer_input").attr("value") : 0;
var inputNum = document.getElementById("require_input_flg").getAttribute("checked") ? jQuery(this).find(".outer_input").attr("value") : 0;


5. eventメソッドの引数
$(document).on('click', '#button', function(event, p1, p2){
});
    5-1) 引数として一番目はevent Object、その後第2引数、第3引数等は自由
    5-2) eventメソッドの第一引数はイベントその自体です。つまりイベントの変化内容を持っているDOM Event Object。変化の対象、変化の状態などが入ってるオブジェックトです。
    その属性や内容はeventの種類によって違います。例えばcheckboxならcheck,textなら入力した後、入力欄の外をクリックしたりtabしたりするなどとなります。
    詳しくは検索してみましょう。
