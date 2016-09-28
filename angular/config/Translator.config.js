export function TranslatorConfig($translateProvider){
    'ngInject';

    $translateProvider.useStaticFilesLoader({
        prefix: 'lang/locale-',
        suffix: '.json'
    });

    $translateProvider.preferredLanguage('es');
    $translateProvider.fallbackLanguage('es');
    // remember language
    $translateProvider.useLocalStorage();
    $translateProvider.useSanitizeValueStrategy('escape');
}
