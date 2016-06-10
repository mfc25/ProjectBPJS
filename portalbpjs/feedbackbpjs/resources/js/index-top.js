$(document).ready(function(){
    var pjg = $(".tanggal").length;
    var a;
    for(a = 0; a < pjg; a++){
        var splitTgl = new Array(3),
            tgl      = "",
            strTgl   = $(".tanggal").eq(a).html();
            splitTgl = strTgl.split("-");
            tgl      = splitTgl[2] + "-" + splitTgl[1] + "-" + splitTgl[0];
            $(".tanggal").eq(a).html(tgl);
    }
});