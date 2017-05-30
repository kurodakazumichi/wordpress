/* wordpressでjQueryを使うときは以下のように記載する。 */
jQuery(function($){

    // canvas取得、jQueryで取得する場合は以下のように0番目のオリジナルのDOMが必要
    var canvas = $("#sample")[0];
    
    var context = canvas.getContext("2d");
    canvas.width = 400;
    canvas.height = 400;
    
    context.globalConpositeOperation = "source-over";
    
    (function(){

            // ------------------------------------------------------------
            // 面の塗りを設定する（単一色）
            // ------------------------------------------------------------
            context.fillStyle = "rgba(128,128,128,0.5)";

            // ------------------------------------------------------------
            // 円を描画
            // ------------------------------------------------------------
            context.beginPath();
            context.arc(200 , 200 , 150 , 0 , (Math.PI * 2));
            context.fill();

    })();
    
});