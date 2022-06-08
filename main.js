var btnSearchBox = document.getElementById("searchBox3");
function enable() {
  if (btnSearchBox.style.display === "none") {
    btnSearchBox.style.display = "block";
  } else {
    btnSearchBox.style.display = "none";
  }
}
var images = document.getElementById("images");

function loadfile(event) {
  var output = document.getElementById("output_image");
  output.src = URL.createObjectURL(event.target.files[0]);
}

// Show hide password
document.getElementById("showpassword").addEventListener("click", function () {
  var checkbox = document.getElementById("showpassword");
  var inputbox = document.getElementById("password");
  if (checkbox.checked == true) {
    inputbox.setAttribute("type", "text");
  } else {
    inputbox.setAttribute("type", "password");
  }
});

function ani() {
  var section = document.getElementById("test");
  section.className = "scale-down";
  //   section.className="scale-down";
  // document.getElementById('button').addEventListener('click', function(){
  // setTimeout(windowdelay, 1000);
  // })
}
//  function delay(){
//     ani();
//   }
//function windowdelay(){
// window.open('./3dprinterandcnc.php');
//}

function search(){
 document.getElementById("searchBox3").value ='';
 addEventListener('click',function(event){
   if(event.click=13){
     
   }
 })

}

window.onbeforeunload = function (e) {
  document.getElementById("link").className = "test-a";
};

// document.getElementById("menu-bar1").addEventListener("click",function(){
//   console.log("hello");
//       document.getElementById("menu-bar").style.display="block";
// })
//document.getElementById("menu-bar").style.display = "none";

function spred(){
  console.log("Hello You Clicked Me");
  document.getElementById("menu-bar").style.display="flex";
  document.getElementById("menu-bar1").style.display="none";
  document.getElementById("cancel").style.display = "flex";
}

function cancel(){
  document.getElementById("menu-bar").style.display = "none";
  document.getElementById("menu-bar1").style.display = "flex";
  document.getElementById("cancel").style.display = "none";
}