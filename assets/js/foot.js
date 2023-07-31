var div = document.createElement('div');
div.innerHTML = "<p>"+
				""+
				""+
				""+
				""+
				""+
				""+
				"</p>";
// set style
div.style.color = '#000';
div.style.backgroundColor = '#fff';
div.style.marginBottom = '0';
div.style.textAlign = 'center';
div.style.padding = '10px';
div.style.position ='fixed';
div.style.bottom ='0';
div.style.left ='0';
div.style.right ='0';
// better to use CSS though - just set class
div.setAttribute('class', 'myclass'); // and make sure myclass has some styles in css
document.body.appendChild(div);

