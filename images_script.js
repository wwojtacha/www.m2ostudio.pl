
function enlargeImage() {
  document.getElementById("img01").src = this.src;
  document.getElementById("caption").innerHTML = this.alt;
  document.getElementById('myModal').style.display = "block";
  document.getElementByTagName("header").style.display = "none";
  document.getElementById("logo").style.display = "none";
  document.getElementById("navBar").style.display = "none";
}

(function() {
  var images = document.getElementsByClassName("myImg");
  for (i = 0; i < images.length; i++) {
    images[i].onclick = enlargeImage;
  }
})();

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

//// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  document.getElementById("myModal").style.display = "none";
  document.getElementById("logo").style.display = "block";
  document.getElementById("navBar").style.display = "block";
} 


