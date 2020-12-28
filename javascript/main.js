var _NavBtn = document.getElementById("NavBtn");
var _Nav = document.getElementById("Navigasi");
var _PopBtn = document.getElementById("PopBtn");

// untuk memunculkan navigasi
function NavShow(){
    if(_Nav.style.display == "block"){
        _Nav.style.display = "none";
    }
    else{
        _Nav.style.display = "block";
    }
}

// untuk menambahkan 'mark'
function Mark(id){
    let _MarkEl = document.getElementById("Mark"+id);

    // request ajax
    $.ajax({
        type: "GET",
        url: "./php/xmark.php?id="+id,
        // jika success
        success: ()=>{
            // jika class saat ini == mark, maka  ganti jadi marked
            if(_MarkEl.className == "Mark"){
                _MarkEl.className = "Marked";
            }
            // selain itu maka sebaliknya
            else{
                _MarkEl.className = "Mark";
            }
        }
    });
}

// untuk memunculkan image pop ketika image di postingan di click
function Open(id, img){
    // ambil nama image yg dikirim dari parameter
    let _Image = img;

    // ambil text dari postingan
    let _Capt = document.getElementById("cap"+id).innerHTML;
    let _By = document.getElementById("by"+id).innerHTML;

    // deklarasi wadah pada pop image
    let _PopUp = document.getElementById("Pop");
    let _ImgVes = document.getElementById("ImgPop");
    let _CaptVes = document.getElementById("CaptPop");
    let _ByVes = document.getElementById("ByPop");

    // pindahkan text dari postingan ke pop image
    _ByVes.innerHTML = _By;
    _CaptVes.innerHTML = _Capt;
    _ImgVes.src = "image/"+_Image;

    // display = block (agar muncul)
    _PopUp.style.display = "block";
}

// untuk menyembunyikan pop image
function HidePop(){
    document.getElementById("Pop").style.display = "none";
}


// event listener
_PopBtn.addEventListener("click", HidePop);
_NavBtn.addEventListener("click", NavShow);

