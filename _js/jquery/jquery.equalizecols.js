function $() {
	var elements = new Array();
	for (var i=0;i<arguments .length;i++) {
		var element = arguments[i];
		if (typeof element == 'string') element = document.getElementById(element);
		if (arguments.length == 1) return element;
		elements.push(element);
	}
	return elements;
}

var BoxHeights = {
	maxh: 0,
	boxes: Array(),
	num: 0,
	equalise: function() {
		this.num = arguments.length;
		for (var i=0;i<this.num;i++) if (!$(arguments[i])) return;
		this.boxes = arguments;
		this.maxheight();
		for (var i=0;i<this.num;i++) $(arguments[i]).style.height = this.maxh+"px";
	},
	maxheight: function() {
		var heights = new Array();
		for (var i=0;i<this.num;i++) {
			if (navigator.userAgent.toLowerCase().indexOf('opera') == -1) {
				heights.push($(this.boxes[i]).scrollHeight);
			} else {
				heights.push($(this.boxes[i]).offsetHeight);
			}
		}
		heights.sort(this.sortNumeric);
		this.maxh = heights[this.num-1];
	},
	sortNumeric: function(f,s) {
		return f-s;
	}
}