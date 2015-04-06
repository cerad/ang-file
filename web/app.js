(function(angular) { 'use strict';

var appModule = angular.module('CeradFileApp', ['angularFileUpload']);

/* =========================================================
 * Seems to work as advertised
 */
appModule.controller('CeradFileUploadController', ['$scope', '$upload', function ($scope, $upload) 
{
  $scope.username = 'username';
  $scope.$watch('files', function () 
  {
    $scope.upload($scope.files);
  });
  $scope.upload = function(files) 
  {
    if (files && files.length) 
    {
      for (var i = 0; i < files.length; i++) 
      {
        var file = files[i];
        $upload.upload(
        {
          url: 'upload.php',
          fields: {'username': $scope.username},
          file: file 
        })
        .progress(function (evt) 
        {
          var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
          console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
        })
        .success(function (data, status, headers, config) 
        {
          console.log('file ' + config.file.name + 'uploaded. Response: ' + data);
        });
      }
    }
  };
}]);
/* ===========================================================
 * This directive seems to work fine under chrome and firefox
 * but ie 11 and safari do not support it yet
 * looks like Blob/FileSaver is the way to go
 */
appModule.directive('fileDownload', function() 
{
  return {
    restrict: 'E',
    template: '<a href="" class="btn btn-primary" ng-click="downloadFile()">Download</a>',
    scope: true,
    link: function(scope, element, attr) 
    {
      var anchor = angular.element(element.children()[0]);

      // When the download starts, disable the link
      scope.$on('download-start', function() 
      {
        anchor.attr('disabled', 'disabled');
      });
      // When the download finishes, attach the data to the link. Enable the link and change its appearance.
      scope.$on('downloaded', function(event, data) 
      {
        anchor.attr({
          href: 'data:text/plain;base64,' + data,
          download: attr.filename
        })
        .removeAttr('disabled')
        .text('Save')
        .removeClass('btn-primary')
        .addClass('btn-success');
 
        // Also overwrite the download pdf function to do nothing.
        //scope.downloadFile = function() {};
      });
    },
    controller: ['$scope', '$attrs', '$http', function($scope, $attrs, $http) 
    {
      $scope.downloadFile = function() 
      {
        $scope.$emit('download-start');
        $http.get($attrs.url).then(function(response) 
        {
          $scope.$emit('downloaded', response.data);
        });
      };
    }]
  };
});
})(angular);
