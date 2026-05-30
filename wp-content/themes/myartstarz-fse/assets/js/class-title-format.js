(function () {
	var TIME_RE = /(\s+)(\d{1,2}):(\d{2})\s*[-–]\s*(\d{1,2}):(\d{2})(\s*[ap]\.?m\.?)?\s*$/i;

	function inferPeriods(startH, endH) {
		// Class hours run 8am–8pm. Start hour 8–11 = am, 12 or 1–7 = pm.
		var startPm = (startH === 12) || (startH >= 1 && startH <= 7);
		var endPm;
		if (startPm) {
			endPm = true;
		} else {
			// Start is am (8–11). End is pm if it's 12, or earlier numerically than start (e.g., 9–1).
			endPm = (endH === 12) || (endH < startH);
		}
		return { start: startPm ? 'pm' : 'am', end: endPm ? 'pm' : 'am' };
	}

	function formatTime(m) {
		var startH = parseInt(m[2], 10);
		var startM = m[3];
		var endH = parseInt(m[4], 10);
		var endM = m[5];
		if (m[6]) {
			// Already has am/pm — leave the original text as-is.
			return m[0].replace(/^\s+/, '');
		}
		var p = inferPeriods(startH, endH);
		return startH + ':' + startM + p.start + '–' + endH + ':' + endM + p.end;
	}

	function formatTitle(el) {
		if (el.dataset.masTimeFormatted === '1') return;
		var text = el.textContent;
		var m = text.match(TIME_RE);
		if (!m) {
			el.dataset.masTimeFormatted = '1';
			return;
		}
		var datePart = text.slice(0, m.index);
		var timePart = formatTime(m);
		el.textContent = '';
		el.appendChild(document.createTextNode(datePart));
		var span = document.createElement('span');
		span.className = 'mas-class-time';
		span.textContent = timePart;
		el.appendChild(span);
		el.dataset.masTimeFormatted = '1';
	}

	function run(root) {
		var scope = root || document;
		var titles = scope.querySelectorAll(
			'.wc-block-product-template .wp-block-post-title a, ' +
			'.wc-block-product-template .wp-block-post-title'
		);
		titles.forEach(function (el) {
			var target = el.tagName === 'A' ? el : (el.querySelector('a') || el);
			formatTitle(target);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () { run(); });
	} else {
		run();
	}

	var observer = new MutationObserver(function (mutations) {
		for (var i = 0; i < mutations.length; i++) {
			var added = mutations[i].addedNodes;
			for (var j = 0; j < added.length; j++) {
				if (added[j].nodeType === 1) run(added[j]);
			}
		}
	});
	observer.observe(document.body, { childList: true, subtree: true });
})();
