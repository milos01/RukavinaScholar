(function(angular){
app.controller('dropzoneSolutionController', function($scope, $element, $compile, selectedFilesService, removeFileS3Service){
  $scope.init = function (solutionDescription) {
    $scope.solutionDescription = solutionDescription;
  };
  if($('.modUpdate').css('display') == 'none'){
    $scope.summernotePostSolutionOptions = {
      height:300,
      toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            // ['height', ['height']]
          ]
    }
    Dropzone.options.dropzoneForm2= {
      addRemoveLinks: true,
      acceptedFiles: ".png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z",
      removedfile: function(file){
                      var _ref;
                      var name = file.name;
                      selectedFilesService.selectedFiles.splice(file.name, 1);
                      removeFileS3Service.remove(name).then(function (){});
                      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

      },
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 15, // MB
      dictDefaultMessage: "<strong>Drop files or click here to upload. (max. 15MB)<br>Accepted files: .png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z</strong>",
      accept: function(file, done) {
        selectedFilesService.selectedFiles.push(file.name);
        // var el = angular.element('<div class="container" style="margin-left:-15px;width:60px" ><i class="fa fa-file-o fa-3x" aria-hidden="true" style="color:#c5c5c5"></i><p style="margin-left: 3px">test</p></div>');
        // $compile(el)($scope);
        // elm = $element.find("#filesHolder");
        // console.log(elm);
        // elm.append(el);
        if (file.name == "a.jpg") {
          done("Naha, you don't.");
        }
        else { done(); }
      }
    };
  }
});
})(angular);