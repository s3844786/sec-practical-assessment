function hashPassword(){
     var input = document.getElementById("password").value;
     var hash = SHA256.hash(input);
     document.getElementById("password").value = hash;
}