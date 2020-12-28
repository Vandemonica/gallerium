document.getElementById('su-Btn').disabled = true;

var _namStat = false;
var _sanStat = false;
var _verStat = false;

function SanCheck(input, pesan){
    var _inp = document.getElementById(input);
    var _pesan = document.getElementById(pesan);

    if(_inp.value.length < 8){
        _pesan.innerHTML = "<a class='xMark'>&#10005;</a> Panjang sandi minimal 8 karakter";
    }
    else if(_inp.value.length >= 8){
        _pesan.innerHTML = "<a class='cMark'>&#10003;</a> Ok";
        _sanStat = true;
    }
    else{
        _pesan.innerHTML = null;
    }
}

function SanCheckV(input, sandi, pesan){
    var _san = document.getElementById(sandi);
    var _inp = document.getElementById(input);
    var _pesan = document.getElementById(pesan);


    if(_inp.value != _san.value){
        _pesan.innerHTML = "<a class='xMark'>&#10005;</a> Konfirmasi tidak sama";
        document.getElementById('su-Btn').disabled = true;
    }
    else if(_inp.value == _san.value){
        _pesan.innerHTML = "<a class='cMark'>&#10003;</a> Ok";
        document.getElementById('su-Btn').disabled = false;
        _verStat = true;
    }
    else{
        _pesan.innerHTML = null;
        document.getElementById('su-Btn').disabled = true;
    }
}

$(document).ready(function(){
    $('#NI').on('keyup', function(){
        $('#NP').load("./php/xdafs.php?nam=" + $('#NI').val());
    });
});
