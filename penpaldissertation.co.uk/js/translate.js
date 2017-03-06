
var dictionary = {
        'Login': {
            'en': 'Login',
            'gr': 'Anmeldung',
        },'Register':{
            'en': 'Register',
            'gr': 'Registrieren',
		}, 'Learn More' :{
		    'en': 'Learn More',
            'gr': 'Über uns',
		}, 'The easy':{
		    'en': 'The easy way to learn German online!',
            'gr': 'Die einfache Möglichkeit, Englisch online zu lernen',		
		}, 'Why you':{
		    'en': 'Why you should use PenPal!',
		    'gr': 'Warum solltest du PenPal benutzen?',
		
		}, 'Research has':{
		    'en': 'Research has shown that learning through games and visiual aids can greatly increase your chances of learning and remembering a language!',
		    'gr': 'Die Forschung hat gezeigt, dass das Lernen durch Spiele und visuelle Hilfsmittel Ihre Chancen des Lernens und der Erinnerung an eine Sprache stark erhöhen kann!',
		}, 'RESEARCH': {
            'en': 'Research',
            'gr': 'Forschung',
		}, 'Learn': {
            'en': 'Learn languages quickly',
            'gr': 'Sprachen schnell lernen',
		}, 'There is': {
		    'en': 'There is a large amount of evidence linking increased retention of information when it is obtained through interative games!',
			'gr': 'Es gibt eine große Menge an Beweisen, die eine erhöhte Speicherung von Informationen verknüpfen, wenn sie durch interaktive Spiele erhalten wird',
		}, 'Using the help': {
            'en': 'Using the help and tuition of your PenPal, you will see quick gains in ability!',
            'gr': 'Mit der Hilfe und dem Unterricht Ihres Brieffreundes, sehen Sie schnelle Gewinne in der Fähigkeit!',
			}
		
		
};
var langs = ['en', 'gr'];
var current_lang_index = 0;
var current_lang = langs[current_lang_index];

window.change_lang = function() {
    current_lang_index = ++current_lang_index % 2;
    current_lang = langs[current_lang_index];
    translate();
}

function translate() {
    $("[data-translate]").each(function(){
        var key = $(this).data('translate');
        $(this).html(dictionary[key][current_lang] || "N/A");
			document.cookie= "username=john doe";
    });

}

	
	
