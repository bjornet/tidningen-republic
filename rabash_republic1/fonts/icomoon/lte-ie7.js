/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-FRIA_search-01' : '&#xe000;',
			'icon-FRIA_meny_pil_right-01' : '&#xe001;',
			'icon-FRIA_meny_pil_ner-01' : '&#xe002;',
			'icon-FRIA_ikon_twitter-01' : '&#xe003;',
			'icon-FRIA_ikon_spara-01' : '&#xe004;',
			'icon-FRIA_ikon_skrivut-01' : '&#xe005;',
			'icon-FRIA_ikon_kommentera-01' : '&#xe00a;',
			'icon-FRIA_ikon_facebook-01' : '&#xe00b;',
			'icon-FRIA_ikon_google-01' : '&#xe008;',
			'icon-FRIA_ikon_dela-01' : '&#xe00c;',
			'icon-FRIA_bildspel_pil_right-01' : '&#xe00e;',
			'icon-FRIA_bildspel_pil_left-01' : '&#xe010;',
			'icon-FRIA_citat-01' : '&#xe006;',
			'icon-FRIA_colossalis_debatt-01' : '&#xe007;',
			'icon-FRIA_colossalis_fordjupning-01' : '&#xe009;',
			'icon-FRIA_colossalis_kalendarium-01' : '&#xe00d;',
			'icon-FRIA_colossalis_mest_last-01' : '&#xe012;',
			'icon-FRIA_colossalis_recension-01' : '&#xe014;',
			'icon-FRIA_colossalis_synpunkten-01' : '&#xe015;',
			'icon-FRIA_colossalis_mest_kommenterat-01' : '&#xe013;',
			'icon-FRIA_ikon_bildtext-01' : '&#xe016;',
			'icon-FRIA_ikon_stang' : '&#xe017;',
			'icon-FRIA_citat-01-2' : '&#xe018;',
			'icon-FRIA_colossalis_inledare-01' : '&#xe00f;',
			'icon-FRIA_ikon_read-01' : '&#xe019;',
			'icon-FRIA_colossalis_las_ocksa-02' : '&#xe01a;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};