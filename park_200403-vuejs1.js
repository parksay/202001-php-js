javascriptの開発ではTemplateという概念がとても重要です。サーバーからJSONでresponseを受けてJavascript Objectに変換したりデータの処理をしたりした後、
DOMにデータを反映する一連の流れが結局UI開発の核心となるためです。 Javascript開発はデータ+HTMLの結合だと思われます。
実際にDOMの操作に多くのロードが発生するためVirtual DOMを投入したりtemplate作業をフレーム段で出来るように支援するようにしています。
そのような背景の中でVue.jsがあります。
参考資料
12bme.tistory.com/193

// test - html
<body>
    <div id = "test">
        <div>{{ big }}</div>
            <span>{{ hey }}</span>
        <div>{{ direPrin }}</div>
    </div>
</body>

// test - javaScript 
const vueTest = new Vue({

data : { hey : "yo", big : "world", coman : "which" },
methods: { tesMe: function(){ return true; }, thyea : function(){ return false; } },
computed: { direPrin: function(){ return "print test"; } },

}).$mount("#test");


// bindTest - html
<body>
    <div id = "bindTest"><input v-model="btest"> 
        <p>value = {{ btest }}</p>
    </div>
</body>

// bindTest - javaScript 
const vueModel  = new Vue({
    el : "#bindTest", // also works $mount("#bindTest"); in the end of func 
    data : {
        btest : "hello big",
    },
    methods : {

    },
    computed : {
        bset : function(){return "result";},
    },

});

// checkTest1 - html
<body>
    <div id = "checkTest1">
        <input type = "checkbox" v-model="boolVal" id="checkTest"> 
        <label for="checkTest">{{ boolVal }}</label>
        <p>value = {{ boolVal }}</p>
    </div>
</body>

// checkTest1 - javaScript
const checkboxSingle  = new Vue({
    el : "#checkTest1",
    data : {
        boolVal : true,
    },
    methods : {

    },
});

// checkTest2 - html
<body>
    <div id = "checkTest2">
        <input type = "checkbox" v-model="ctest" id="hello big" value = "hello big"> 
        <label for="hello big">hello big</label>
        <input type = "checkbox" v-model="ctest" id="world" value = "world"> 
        <label for="world">world</l abel>
        <input type = "checkbox" v-model="ctest" id="testing" value = "testing"> 
        <label for="testing">testing</label>
        <input type = "checkbox" v-model="ctest" id="checksCho" value = "checksCho"> 
        <label for="checksCho">checksCho</label>
        <p>value = {{ ctest }}</p>
    </div>
</body>

// checkTest2 - javaScript
const checkboxArray  = new Vue({
    el : "#checkTest2", // also works $mount("#bindTest"); in the end of func 
    data : {
        ctest : ["hello big","world","checksCho","testing"],
    },
    methods : {

    },
});

// import
<head>
<script src="vue/vue.js"></script>
<script src="vue/jQuery.js"></script>
</head>
<body>
bodyタグの中でvue.jsとjqueryは使うべきですのでheadにimportしなければいけません。
</body>
<script src="vue/vue-sample.js"></script>
しかしvue.jsを使って画面の処理をするのはまずbodyがDOMにloadされた後になりますので
jsを呼び出すのはbodyよりあとにならなけらばいけません。
もしくはjQueryを活用してcall stackに入れてわざわざ遅めに実行されるようにしなけらばいけません。