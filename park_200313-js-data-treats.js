1．server側と front側との dataのやり取り処理
    1-1) PHPでの処理。front側にこのようなデータ型でデータを送る
    $this->_renderJson(["result" => false, "testValue"  => "Thank you. This is test value"]);

    1-2) JavaScriptでの処理。
    $.get("/test/ajax-return-value-test", dataToServ)
            .done(function (dataFromServ) {
                if (dataFromServ.result) {
                    const html = ajaxHtmlData(dataFromServ);
                    controller.openResultModal(html);
                } else {
                    console.log(dataFromServ); ---a)
                    console.log(dataFromServ.testValue);  ----b)
                }
            });

    1-3) consoleの出力結果。
        a)
            {"result":false,"testValue":{"testValue":["100\u6524\u5b29\u4ee1\u5845\u1667\u5115\u249b\u3054\u146\u334f\u1260\u5325\u9524\u9252"]}}
        b)
            undefined
                何故ならデータ型がJavaScriptからは知らないデータ型だから

    1-4) server側から返してもらったデータはJavaScriptが読めるデータ型に変換しなければいけない。
            dataFromServ = ajaxJsonData(dataFromServ);
            console.log(dataFromServ); ---a)
            console.log(dataFromServ.testValue);  ----b)

    1-5) consoleの出力結果。
        a)
        {result: false, testValue: {…}}
            -result: false
            -testValue: ["Thank you. This is test value"]
            -__proto__: Object
            -__proto__: Object
        b)
            Thank you. This is test value


2. serverとfrontでデータのやり取りをする時、データ型の仕組み
    本来はserver側からfrontに返すデータ型はhtmlかJSONかどちか一つにした方がいいです。
    エラーの時と成功の時と返すデータのtypeが違うんだったら処理が悪くなります。
    front側からの受け取る処理は成功と失敗と別々でしなければならないので複雑になるからす。
    簡単な表示なら、frontから処理する必要がないように、server側でrenderingしてからfrontに返すのがいいです。
    しかしeventの処理とか複雑な処理がまた必要な場合は一旦frontに送ってJavScriptから処理した方がいいです。


3. JavaScript - arrayからkeyを取得して処理
    for(var key in arrayTest) {
        document.querySelector("#display_" + key).innerText = arrayTest[key];
    }


4. JavaScript - 複数のhtml dom elementのデータをarrayに変換する (IEではサポートしてありません。jQuery().find()を使いましょう)
    var arrayEle = Array.from(document.getElementsByClassName("test-class"));
    arrayEle.forEach(function(element, index) {
        element.innerHTML = "";
        element.innerText = "";
    });


5. JavaScript - innerHTML / innerText
    1) innerHTML - html要素として入れる。tagが使える(保安のため注意)
            document.getElementById("resultSearchStaff").innerHTML = "hello<br>this is test";
                hello
                this is test
    2) innerText - textとして入れる。ただのtextなのでtagがあってもtextとしてそのまま出力 (大文字 /　小文字　要注意、innerTEXTは認識できない)
            document.getElementById("resultSearchStaff").innerHTML = "hello<br>this is test";
                hello<br>this is test


6. JavaScript - refactoring
    1)変更前
        jQuery("#" + eleId).dialog("close");
        jQuery("#" + eleId).html("");
    2)変更後
        const eleTarget = jQuery("#" + eleId);
        eleTarget.dialog("close");
        eleTarget.html("");


7. JavaScript - var / let / const
    1) var - 再宣言、再代入、両方ともできる 
    2) let - 再宣言はできない、再代入はできる
    3) const - 再宣言、再代入、両方ともできない


8. print array in php 
    foreach (array_keys($summary) as $key) {
            error_log($key . " = " . $summary[$key]);
        }