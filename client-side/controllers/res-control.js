var app = angular.module('mainApp', []);
app.controller('resCtrl', function($scope) {
  $scope.destinations = [
    {location: "Brisbane, Australia", activities: ["City Tours", "Sports", "Cycling", "Museums", "Boating"]},
    {location: "Vancouver, Canada", activities: ["Sailing", "Beach", "Hiking", "Museums", "Boating"]},
    {location: "New York City, United States", activities: ["City Tours", "Parks and Recreation", "Museums", "Theatre"]},
    {location: "Berlin, Germany", activities: ["City Tours", "Cycling", "Museums"]},
    {location: "Cancun, Mexico", activities: ["City Tours", "Sports", "Cycling", "Museums", "Boating"]}
  ];
  $scope.hider = false;
  $scope.destHider = true;
  $scope.counter = 0;
  $scope.hideWarning = function() {
    $scope.counter++;
    if ($scope.counter > 1)
    {
      $scope.hider = true;
      $scope.destHider = false;
    }
  };
  $scope.resetActivities = function() {
    $scope.destHider = true;
    $scope.hider = false;
    $scope.counter = 0;
  };
});