var portfoliopostsbtn = document.getElementById('portfolio-posts-btn');
var portfoliopostcontainer = document.getElementById('portfolio-posts-container');

if(portfoliopostsbtn){
	portfoliopostsbtn.addEventListener("click",function(){
		var ourRequest = new XMLHttpRequest();
		ourRequest.open('GET', magicalData.siteURL + '/wp-json/wp/v2/posts?categories=12&order=asc');
		ourRequest.onload = function(){
			if(ourRequest.status >= 200 && ourRequest.status < 400){
				var data = JSON.parse(ourRequest.responseText);
				createHTML(data);
				portfoliopostsbtn.remove();
			} else {
				console.log("We connected to the server, but it returned an error.");
			}
		};
		ourRequest.onerror = function(){
			console.log("Connection Error");
		};
		ourRequest.send();
});	
}

function createHTML(postdata){
	var htmlString = '';
	for (var i = 0; i < postdata.length; i++) {
		htmlString += '<h1>' + postdata[i].title.rendered + '</h1>';
		htmlString += postdata[i].content.rendered;
	}
	portfoliopostcontainer.innerHTML = htmlString;
}

//Quick add post
var quickaddbtn = document.querySelector('#quick-add-btn');
if(quickaddbtn){
	quickaddbtn.addEventListener("click", function(){
		var ourpostdata = {
			'title': document.querySelector('.quick-post [name="title"]').value,
			'content': document.querySelector('.quick-post [name="content"]').value,
			'categories': document.querySelector('.quick-post [name="category"]').value,
			'status': 'publish'
		}

		var createPost = new XMLHttpRequest();
		createPost.open('POST',magicalData.siteURL + '/wp-json/wp/v2/posts');
		createPost.setRequestHeader('X-WP-Nonce',magicalData.nonce);
		createPost.setRequestHeader('Content-Type','application/json;charset=UTF-8');
		createPost.send(JSON.stringify(ourpostdata));
		createPost.onreadystatechange = function(){
			if(createPost.readyState == 4){
				if(createPost.status == 201){
					document.querySelector('.quick-post [name="title"]').value = '';
					document.querySelector('.quick-post [name="content"]').value = '';
					document.querySelector('.quick-post [name="category"]').value = '';
				}else {
					alert("Error - Try again");
				}
			}
		}
	});
}