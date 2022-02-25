prototypeはあるobjectを生成する時、objectの根幹は構成している基礎です。
prototypeはもっと厳密に言えばprototype ojectとprototype linkがあります。
普通はこの二つを一緒に混用してprototypeと言います。
概念的に関してはprototype link、使い方に関してはprototype objectが主に使われています。

生成されたobjectをconsole.logで出力して見れば「__proto__」という項目が出てきます。
この「__proto__」というのはobejctが生成されるとき参照した原型であります。
これがprototype linkです。
console.logには他に「prototype」もあります。
これがprototype objectです。

objectを作るためにはfunctionを定義して、そのfunctionを実行することで該当のobjectを作ることができます。
この場合functionが定義されるとき、そのfunctionにはprototype objectも一緒に生成されて付いてきます。
functionが定義される時、そのfunctionで生成されるobjectをサンプルとして一つ作って置きます。
後これからfunctionによって生成されるobjectがこのサンプルを参照するように用意しておきます。
つまり、このサンプル役割のobjectがprototype objectです。

そうすれば生成されたobjectは全部一つのprototype objectを与えられて、
そのprototype objectを参照している状態になります。
結果的に一つのfunctionから生まれたobjectは全部一つのobjectを参照することとなります。
これ何が出来るようになるかというと、objectがばらばで生成されても同じデータとか関数等を共有している場合がありますね。
そんな時にprototype objectにデータを入れて置いたらあちこちでも一つのdataを共有するのができます。
このようなことができるようにしてくれるのがprototype objectです。

何で面倒くさく複雑にこのような処理をすべきであるんでしょうかね。
結論から言うとobjectの数が増えれば増えるほどメモリーに負担を掛けることになります。
prototype objectを通して一つのデータを共有していないと下記のような問題があります。
例えばPersonというobjectがあります。

	function Person(){
		this.japanese = "人間";
		this.species = "Homo sapiens";
		this.biological = "hominidae";
	}

	var tom = new Person();
	var jay = new Person();
	console.log(tom.japanese); // 人間
	console.log(jay.japanese); // 人間

	このPersonというobjectは日本語、生物学、分類学によってそれぞれ違う呼び方があります。
	その内容をPersonの各objectがそれぞれ持っていることにします。
	tomという人も、jayという人も、同じ呼び方を情報として持っています。
	この二人だけではなく人間なら皆一緒です。
	ということにすると、問題は人間の数です。世界の人々が全部それぞれ
	日本語、生物学、分類学の呼び方を情報として持っていることとなります。
	となるとその情報量はものすごい量となります。それも皆同じ情報です。
	これはデータ保存に使うメモリーを無駄にすることです。
	
	このような問題を解決するためにprototype objectを使います。
	今は"人間"というobjectはそれぞれ同じ情報を持っています。
	これを、"人間"というobjectなら皆適用される特徴をまとめて
	"人間の特徴"という他のobjectを一つだけ作ります。
	そして"人間"というobjectは全部"人間の特徴"というobjectを参照するようにします。
	この場合"人間の特徴"に該当するのがprototype objectです。
	これをコードにすると下記のようになります。

	/////////////////////////////////////////////

	function Person(){}

	Person.prototype.japanese = "人間";
	Person.prototype.species = "Homo sapiens";
	Person.prototype.biological = "hominidae";

	let tom = new Person();
	let jay = new Person();

	console.log(tom.japanese) // 人間
	console.log(jay.japanese) // 人間

	//////////////////////////////////////////////////
	
	tomはPersonから生まれたobjectですのでPerson.prototypeを参照しています。
	でもprototypeからの値を取得する時は、tom.prototype.japanese;ではなくtom.japanese;だけで呼びます。
	自動でtomの属性からjapaneseを探してみてそこになければ上位のscopeで探します。
	そこにもなければまたそこから上位のscopeで探すのを繰り返します。
	JavaScriptで全てのobjectは自分を生成するのに使った原型objectを参照しています。
	この参照linkをprototype linkと言います。
	つまり、JavaScriptでは全てのobjectが自分の原型objectを参照していて、
	その原型objectがprototype objectで、その参照がprototype linkです。

	JavaScriptでfunctionが定義される時、実は裏では二つのことが行われます。
	一つ目はそのfunctionにconstructor資格が与えられること。
	これができたらそのfunctionを使って"new"という命令でobjectを生成するのが出来るようになります。
	二つ目はそのfunctionを使ってobjectを一つ作って置くこと。
	これがprototype objectです。そのfunctionで作ったobjectはこれからこのprotytpe objectを参照するようになります。
	これまでがfunctionが定義される時に裏で自動に行われる二つのことです。

	全てのobjectはfunctionから生成され、functionは定義される時一つのobjectを持って生成されます。
	そしてfunctionから生成されるobjectはそのfunctionのprototype objectを参照してして共通のデータを共有しているのが出来るようになります。
	prototype obejctは自分を作ったfunctionを参照し、functionは一緒に生成されたprototype objectを参照しています。
	一番上位のfunctionは object()で、このfunctionも同じくprototype objectを持ってます。
	person, array, function, object等全部funcionとprototype objectがあります。Person() / Array() / function() / Object() ...
	各objectが参照しているprototype linkを追いかけて上位の上位の上位に行けば最後にはobjectがあります。
	このような仕組みをprototype chainと言います。
	このようなprototype構造でJavaScriptは客体志向プログラムを具現しています。
	これがJavaScriptがprototype基盤プログラムだと呼ばれている理由です。
参考資料
https://medium.com/@bluesh55/javascript-prototype-%EC%9D%B4%ED%95%B4%ED%95%98%EA%B8%B0-f8e67c286b67
http://insanehong.kr/post/javascript-prototype/
http://www.nextree.co.kr/p7323/