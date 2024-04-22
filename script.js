var currentGallery = 1;
var totalGalleries = 2; 
var currentGalleryContent = ""; 

function loadGallery() {
    var xhr = new XMLHttpRequest(); 
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            currentGalleryContent = this.responseText;
            document.getElementById("galleryContainer").innerHTML = currentGalleryContent;
            currentGallery = 1; 
            toggleGalleryButtons(); 
            document.getElementById("loadGalleryButton").style.display = "none"; // Menyembunyikan tombol "Load Gallery"
        }
    };
    xhr.open("GET", "gallery1.html", true); 
    xhr.send();
}

function nextGallery() {
    currentGallery = currentGallery === totalGalleries ? 1 : currentGallery + 1; 
    loadGalleryContent();
}

function previousGallery() {
    currentGallery = currentGallery === 1 ? totalGalleries : currentGallery - 1;
    loadGalleryContent();
}

function loadGalleryContent() {
    var xhr = new XMLHttpRequest(); 
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            currentGalleryContent = this.responseText;
            document.getElementById("galleryContainer").innerHTML = currentGalleryContent;
            toggleGalleryButtons(); 
        }
    };
    xhr.open("GET", "gallery" + currentGallery + ".html", true); 
    xhr.send(); 
}

function toggleGalleryButtons() {
    if (currentGallery === 1) {
        document.getElementById("previousGalleryButton").style.display = "none";
        document.getElementById("nextGalleryButton").style.display = "inline-block";
    } else {
        document.getElementById("previousGalleryButton").style.display = "inline-block";
        document.getElementById("nextGalleryButton").style.display = "none";
    }
}

var currentBlog = 1; 
var totalBlog = 2; 
var currentBlogContent = ""; 

function loadBlog() {
    var xhr = new XMLHttpRequest(); 
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            currentBlogContent = this.responseText;
            document.getElementById("blogContainer").innerHTML = currentBlogContent;
            currentBlog = 1; 
            toggleBlogButtons(); 
            document.getElementById("loadBlogButton").style.display = "none"; // Menyembunyikan tombol "Load Blog"
        }
    };
    xhr.open("GET", "blog1.html", true); 
    xhr.send(); 
}

function nextBlog() {
    currentBlog = currentBlog === totalBlog ? 1 : currentBlog + 1; 
    loadBlogContent();
}

function previousBlog() {
    currentBlog = currentBlog === 1 ? totalBlog : currentBlog - 1; 
    loadBlogContent();
}

function loadBlogContent() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            currentBlogContent = this.responseText;
            document.getElementById("blogContainer").innerHTML = currentBlogContent;
            toggleBlogButtons();
        }
    };
    xhr.open("GET", "blog" + currentBlog + ".html", true); 
    xhr.send(); 
}

function toggleBlogButtons() {
    if (currentBlog === 1) {
        document.getElementById("previousBlogButton").style.display = "none";
        document.getElementById("nextBlogButton").style.display = "inline-block";
    } else {
        document.getElementById("previousBlogButton").style.display = "inline-block";
        document.getElementById("nextBlogButton").style.display = "none";
    }
}
