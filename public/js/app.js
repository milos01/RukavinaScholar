
(function (angular) {
Dropzone.autoDiscover = false;
// socket = io('http://localhost:3000');
app = angular.module('kbkApp', ['ui.bootstrap', 'restangular', 'ngSanitize', 'ui.footable', 'btford.socket-io', 'toastr', 'summernote', 'thatisuday.dropzone'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

app.config(function(RestangularProvider, dropzoneOpsProvider) {
  // Restangular config
  RestangularProvider.setBaseUrl('/api/application');
  RestangularProvider.setErrorInterceptor(function(response) {
    if (response.status === 500) {
        $log.info("internal server error");
        return true;
    }
    return true;
  });
  // Dropzone config
  dropzoneOpsProvider.setOptions({
    url: '/api/application/uploadProblem',
    addRemoveLinks: true,
    maxFilesize: 15,
    acceptedFiles: ".png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z",
    paramName: "file",
    dictDefaultMessage: "<strong>Drop files or click here to upload. (max. 15MB)<br>Accepted files: .png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z</strong>",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});
})(angular);
