export function TranslatorConfig($translateProvider){
    'ngInject';
    $translateProvider.translations('en', {
        TITLE: 'Hello',
        FOO: 'This is a paragraph',
        BUTTON_TEXT_EN: 'english',
        BUTTON_TEXT_ES: 'Spanish',
        iniciar_sesion: 'Start adventure',
        registrarse: 'Register'
    });

    $translateProvider.translations('es', {
        TITLE: 'Hola',
        FOO: 'Este es un parrafo',
        BUTTON_TEXT_EN: 'Ingles',
        BUTTON_TEXT_ES: 'Español',
        iniciar_sesion: 'Iniciar aventura',
        registrarse: 'Registrarse'
    });

    $translateProvider.preferredLanguage('es');

    $translateProvider.useSanitizeValueStrategy('escape');
}
