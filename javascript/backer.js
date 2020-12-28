function ShowSandi(el1, el2){
    var _SI = document.getElementById(el1);
    var _VI = document.getElementById(el2) || 0;

    if(_SI.type == "password"){
        _SI.type = "text";
        _VI.type = "text";
    }
    else{
        _SI.type = "password";
        _VI.type = "password";
    }
}