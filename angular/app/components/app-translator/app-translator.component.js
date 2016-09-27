class AppTranslatorController{
    constructor($translate, ToastService){
        'ngInject';
        this.ToastService = ToastService;
        this.$translate = $translate;
    }

    changeLanguage(langKey){
        this.$translate.use(langKey);
        this.ToastService.show('Idioma cambiado exitosamente');
    }
}

export const AppTranslatorComponent = {
    templateUrl: './views/app/components/app-translator/app-translator.component.html',
    controller: AppTranslatorController,
    controllerAs: 'vm',
    bindings: {}
}
