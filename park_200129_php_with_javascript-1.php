1.サーバーにキーワードを送って結果を取ってくる流れ

    1) javascript - client side : クライアント側からサーバー側に送る引数はajaxのpost関数を呼び出す時にパラメーターとして入れる

        ajaxTest = function (input_keyword) {
            var client_flg = false;
            $checkbox1 = document.getElementById("user_check");
            if ($checkbox1.checked) {
                client_flg = true;
            } 
            jQuery.post("/ajax/search-by-keyword/", { flag: client_flg, params: input_keyword })
                .done(function (data) {
                    var result = BurnAjax.json(data);
                    if (result.flag == true) {
                        var params = result.params;
                        var count = params.length;
                        var display = document.getElementById("result_display");
                        display.innerHTML = result.params;
                    }
                }
        }



    2) php - server side : $this->_getParam("");  => クライアント側から引数を取得数方法。JAVAだったらメソッドを定義するときに受け取るべき
    public function searchByKeyword()
    {
        $result = array();
        $result["flag"] = false;
        if (self::_isAjax()) {
            $params = array();
            $params["keyword"] = $this->_getParam("input_keyword");
            $data = (new Db_Search_TitleList)->searchKeyword($params["keyword"]);
            foreach ($data as $key => $value) {
                $data[$key]["title"] = (new DB_TitleList)->toString($value["title"]);
            }
            $result["flag"] = true;
            $result["params"] = $data;
        }
        $this->_renderJson($result);
    }
    

    3) php - DB side : ZendFramworkのメソッドを勉強する
    public function searchKeyword($param_id)
        {
            $model = new Db_Tbl_UnitPriceList;

            $detail = new Db_Tbl_UnitPriceListDetails;
            $alias = "table1";

            $select = $this->_getDbSelect();
            $select->from(array("{$alias}" => $detail::TABLENAME));
            $select->where("{$alias}.mst_id = ?", $param_id);

            return $this->_query($select);
        }

2.画面の要素をクリックした時そのテーブルの同じ行にある他のボタンが非活性になるイベント
    public function disable_event (row) {
        row.find(".btn_toggle").on("change", function (e) {
            row.find(".target_toggle").get(0).disabled = !e.target.checked; //1)
        });
        if ( row.find(".article") != null) {
            row.find(".article").on("change", function (e) {
                row.find(".input_textbox").get(0).disabled = !e.target.checked;
                row.find(".btn_toggle").disabled = !e.target.checked;
                row.find(".target_toggle").get(0).disabled = !e.target.checked;
                
                
                if(row.find(".btn_toggle").attr("checked")=="checked"){ //2)
                    row.find(".btn_toggle").attr("checked",false); //3)
                    row.find("td.cell-checkbox").not(".article").find("span").removeClass("checked"); //4)
                    
                }
                if( row.find(".article").attr("checked") ){ //5
                    row.find(".btn_toggle").removeAttr("disabled");
                    row.find(".input_select").removeAttr("disabled");
                    row.find(".div_select").removeClass("disabled");
                    
                } else{
                    row.find(".btn_toggle").attr("disabled", "disabled");
                    row.find(".input_select").attr("disabled", "disabled");
                    row.find(".div_select").addClass("disabled");
                }
            });
        }
    }
    2)チェックボタンをクリックした時、その値は"checked"になっている。ここで 4)だけ書いたら画面上に見えるのはチェックボタンが外せるように見えますが、
    これはCSSを変えるのだけです。それでチェックボタンの値は"checked"になっているまま変わりません。それで　1)の部分と順番が間違ってしまい、またクリックしないとCSSとはすれ違います。
    それで、チェックボタンの値を変える部分(3)とCSSを変える部分(4)が一緒に必要です。
    ちなみに、チェックボタンがcheckedになｔってる状態なら　2)の結果は"checked"になり、チェックが外されてる状態なら"undefiened"になります。

    5)チェックボタンの活性化、非活性化は下記のように書くと思いました。
    jQuery("checkbox").attr("disabled","true");
    jQuery("checkbox").attr("disabled","false");
    しかしこれは間違っています。"disabled"があればそのまま非活性になりますので
    jQuery("selector").removeAttr("disabled");
    のようにそもそも"disabled"という属性を消します。


