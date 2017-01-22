		var windowWidth = this.innerWidth;	
		if (windowWidth > 800) {
			for (var i = 0;i < 30; i++){
				var invaderType = getRandomIntInclusive(1,10);
				var bubbleSize = getRandomIntInclusive(5,9);
				var bubbleOpacity = getRandomIntInclusive(3,7);
				var cloudSpeed = getRandomIntInclusive(7, 30);
				var swaySpeed = getRandomIntInclusive(1,8);
				var x = getRandomIntInclusive(50, windowWidth-50);
				
				var newdiv = document.createElement("DIV");
				newdiv.setAttribute("class", "bubble invader_"+invaderType);
				newdiv.setAttribute("style", "left: "+x+'px; \
				    -webkit-transform: scale(0.' +bubbleSize +'); \
					-moz-transform: scale(0.' +bubbleSize +'); \
					transform: scale(0.' +bubbleSize +'); \
					opacity: 0.'+bubbleOpacity+'; \
					-webkit-animation: moveclouds '+cloudSpeed+'s linear infinite, sideWays '+swaySpeed+'s ease-in-out infinite alternate; \
					-moz-animation: moveclouds '+cloudSpeed+'s linear infinite, sideWays '+swaySpeed+'s ease-in-out infinite alternate; \
					-o-animation: moveclouds '+cloudSpeed+'s linear infinite, sideWays '+swaySpeed+'s ease-in-out infinite alternate; \
				');
				document.body.appendChild(newdiv);
			}
		}
		
		// Returns a random integer between min (included) and max (included)
		// Using Math.round() will give you a non-uniform distribution!
		function getRandomIntInclusive(min, max) {
		  min = Math.ceil(min);
		  max = Math.floor(max);
		  return Math.floor(Math.random() * (max - min + 1)) + min;
		}
		