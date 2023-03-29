console.log("hello world");
function getImagepreview(event){
    console.log(event.target.files[0]);
  var image = URL.createObjectURL(event.target.files[0]);
  var image_div = document.getElementById('preview');
  console.log(image_div);
  var newImage = document.createElement('img');
  newImage.setAttribute("class", "imagePreview");
  newImage.src = image;
  image_div.appendChild(newImage);
}
